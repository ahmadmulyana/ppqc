<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Assesment extends CI_Controller {

	function __construct() {
        parent::__construct();
        $this->cek_aktif();
	}
	
	public function cek_aktif() {
		if ($this->session->userdata('admin_valid') == false && $this->session->userdata('admin_id') == "") {
			redirect('login');
		} 
	}
	
	/* Assesment Item Pekerjaan */
	public function index()
	{

		if ($this->session->userdata('admin_level') == "3"){
			$project = $this->db->get('mproyek')->result();
			
		}else{
			$project = $this->db->get_where('mproyek', array('id' => $this->session->userdata('project_id')))->result();
		}
		
		$data['project'] = $project;
		$data['page'] = 'assesment_pekerjaan';
		$this->load->view('template/header', $data);
		$this->load->view('pages/assesment/pekerjaan/index', $data);
		$this->load->view('template/footer', $data);

	}

	public function assesment_detail()
	{
		
		$data['page'] = 'assesment_detail';
		if ($this->session->userdata('admin_level') == "3"){
			$project = $this->db->get('mproyek')->result();
			
		}else{
			$project = $this->db->get_where('mproyek', array('id' => $this->session->userdata('project_id')))->result();
		}
		
		$data['project'] = $project;

		$project_id = $this->uri->segment(3, 0);

		$data['nama_project'] = $this->db->get_where('mproyek', array('id'=>$project_id))->row()->nama_proyek;
		$data['kode_project'] = $this->db->get_where('mproyek', array('id'=>$project_id))->row()->kode_proyek;

		$this->session->set_userdata('nama_project', $data['nama_project']);
		$this->session->set_userdata('kode_project', $data['kode_project']);
		$this->session->set_userdata('project_id', $project_id);
		
		$project = $this->db->get('m_pekerjaan')->result();
		$data['pekerjaan'] = $project;

		$project = $this->db->get('m_vendor')->result();
		$data['vendor'] = $project;

		$query ="SELECT id, pekerjaan_id, COUNT(*) jumlah, nama_pekerjaan, SUM(nilai_pekerjaan) AS sum_nilai_pekerjaan, SUM(nc_pekerjaan) AS sum_nc_pekerjaan, SUM(koreksi) as sum_koreksi FROM tr_assesment_pekerjaan WHERE project_id='".$this->session->userdata('project_id')."' GROUP BY pekerjaan_id";

		$project = $this->db->query($query);
		$data['assesment'] = $project->result();
		$data['addjs'] = $this->load->view('pages/assesment/pekerjaan/pekerjaanjs','',true);
		$this->load->view('template/header', $data);
		$this->load->view('pages/assesment/pekerjaan/detail', $data);
		$this->load->view('template/footer', $data);
	}

	public function assesment_pekerjaan_edit($pekerjaan_id)
	{
		
		$rest = $this->db->get_where('tr_assesment_pekerjaan', array('pekerjaan_id' => $pekerjaan_id ));
		$data['pekerjaan'] = $rest->result();
		$data['nama_pekerjaan'] = $rest->row()->nama_pekerjaan;

		$data['page'] = 'assesment_pekerjaan_edit';
		$data['addjs'] = $this->load->view('pages/assesment/assesmentjs','',true);
		$this->load->view('template/header', $data);
		$this->load->view('pages/assesment/pekerjaan/edit', $data);
		$this->load->view('template/footer', $data);
	}

	public function save() {
		$pekerjaan_id = $this->security->xss_clean($this->input->post('nama_pekerjaan', TRUE));
		$vendor_id = $this->security->xss_clean($this->input->post('nama_vendor', TRUE));
		$satuan_pekerjaan = $this->security->xss_clean($this->input->post('satuan_pekerjaan', TRUE));
		$nilai_pekerjaan = $this->security->xss_clean($this->input->post('nilai_pekerjaan', TRUE));
		$parameter_pekerjaan = $this->security->xss_clean($this->input->post('nilai_pekerjaan', TRUE));
		$nc_pekerjaan = $this->security->xss_clean($this->input->post('nc_pekerjaan', TRUE));

		$this->form_validation->set_rules('nama_pekerjaan', 'Nama Pekerjaan', 'required');
		$this->form_validation->set_rules('nama_vendor', 'Nama vendor', 'required');
		$this->form_validation->set_rules('satuan_pekerjaan', 'Satuan', 'required');
		$this->form_validation->set_rules('nilai_pekerjaan', 'Jumlah Sampling', 'required');
		$this->form_validation->set_rules('nc_pekerjaan', 'Nilai NC', 'required');

		if(!$this->form_validation->run()) {
			$ret_arr['status'] 	= "failed";
			$ret_arr['caption']	= validation_errors();
			j($ret_arr);
			exit();
		}else{

			if ($nc_pekerjaan > $nilai_pekerjaan){
				$ret_arr['status'] 	= "failed";
				$ret_arr['caption']	= "Nilai NC Melebihi Jumlah Sampling";
				j($ret_arr);
				exit();
			}
			$nama_pekerjaan = $this->db->get_where('m_pekerjaan', array('id' => $pekerjaan_id))->row()->pekerjaan;
			$nama_vendor = $this->db->get_where('m_vendor', array('id' => $vendor_id))->row()->nama_vendor;

			$ket 	= "";
			$tgl = date('Y-m-d');

			$user_id = $this->session->userdata('admin_id');

			$ket = "tambah";
				$this->db->query("INSERT INTO tr_assesment_pekerjaan (id, project_id, pekerjaan_id, nama_pekerjaan, satuan_pekerjaan, nilai_pekerjaan, parameter_pekerjaan, nc_pekerjaan, vendor_id, nama_vendor, user_id) 
					VALUES (null, '".$this->session->userdata('project_id')."', '".$pekerjaan_id."', '".$nama_pekerjaan."','".$satuan_pekerjaan."','".$nilai_pekerjaan."','".$parameter_pekerjaan."','".$nc_pekerjaan."','".$vendor_id."','".$nama_vendor."','".$user_id."')");
			
			$ret_arr['status'] 	= "ok";
			$ret_arr['project_id'] 	= $this->session->userdata('project_id');
			$ret_arr['caption']	= $ket." sukses";
			j($ret_arr);
		}
	}

	function hapus($id){
		$this->db->where('id', $id);
		$this->db->delete('tr_assesment_pekerjaan');
		redirect('assesment/assesment_detail/'.$this->session->userdata('project_id'));
	}


	function getDataSatuan($id){
		$data = $this->db->get_where('m_pekerjaan', array('id' => $id))->row();
		$ret_arr['status'] 	= "ok";
		$ret_arr['satuan'] 	= $data->satuan;

		j($ret_arr);
	}
	
	/* Akhir Assesment Item Pekerjaan */


	/* Assesment Item Material */
	public function assesment_material()
	{

		if ($this->session->userdata('admin_level') == "3"){
			$project = $this->db->get('mproyek')->result();
			
		}else{
			$project = $this->db->get_where('mproyek', array('id' => $this->session->userdata('project_id')))->result();
		}
		
		$data['project'] = $project;
		$data['page'] = 'assesment_material';
		$this->load->view('template/header', $data);
		$this->load->view('pages/assesment/material/list', $data);
		$this->load->view('template/footer', $data);

	}

	public function assesment_material_detail()
	{
		
		$data['page'] = 'assesment_material_detail';
		if ($this->session->userdata('admin_level') == "3"){
			$project = $this->db->get('mproyek')->result();
			
		}else{
			$project = $this->db->get_where('mproyek', array('id' => $this->session->userdata('project_id')))->result();
		}
		
		$data['project'] = $project;

		$project_id = $this->uri->segment(3, 0);

		$data['nama_project'] = $this->db->get_where('mproyek', array('id'=>$project_id))->row()->nama_proyek;
		$data['kode_project'] = $this->db->get_where('mproyek', array('id'=>$project_id))->row()->kode_proyek;

		$this->session->set_userdata('nama_project', $data['nama_project']);
		$this->session->set_userdata('kode_project', $data['kode_project']);
		$this->session->set_userdata('project_id', $project_id);
		
		$project = $this->db->get('m_pekerjaan')->result();
		$data['pekerjaan'] = $project;

		$data['supplier'] = $this->db->get('m_supplier')->result();

		$project = $this->db->query("SELECT id, pekerjaan_id, COUNT(*) jumlah, nama_pekerjaan, SUM(nilai_pekerjaan) AS sum_nilai_pekerjaan, SUM(nc_pekerjaan) AS sum_nc_pekerjaan, SUM(koreksi) as sum_koreksi FROM tr_assesment_material WHERE project_id='".$this->session->userdata('project_id')."' GROUP BY pekerjaan_id");

		$data['assesment'] = $project->result();

		$this->load->view('template/header', $data);
		$this->load->view('pages/assesment/material/detail', $data);
		$this->load->view('template/footer', $data);
	}
	
	public function material_edit($pekerjaan_id)
	{
		
		$rest = $this->db->get_where('tr_assesment_material', array('pekerjaan_id' => $pekerjaan_id ));
		$data['pekerjaan'] = $rest->result();
		$data['nama_pekerjaan'] = $rest->row()->nama_pekerjaan;

		$data['page'] = 'assesment_pekerjaan_edit';
		$data['addjs'] = $this->load->view('pages/assesment/assesmentjs','',true);
		$this->load->view('template/header', $data);
		$this->load->view('pages/assesment/material/edit', $data);
		$this->load->view('template/footer', $data);
	}

	public function save_material() {

		$pekerjaan_id = $this->input->post('nama_pekerjaan', TRUE);
		$supplier_id = $this->input->post('nama_vendor', TRUE);
		$satuan_pekerjaan = $this->input->post('satuan_pekerjaan', TRUE);
		$nilai_pekerjaan = $this->input->post('nilai_pekerjaan', TRUE);
		$nc_pekerjaan = $this->input->post('nc_pekerjaan', TRUE);

		$nama_pekerjaan = $this->db->get_where('m_pekerjaan', array('id' => $pekerjaan_id))->row()->pekerjaan;
		$nama_supplier = $this->db->get_where('m_supplier', array('id' => $supplier_id))->row()->nama_supplier;

		$ket 	= "";
		$tgl = date('Y-m-d');

		$user_id = $this->session->userdata('admin_id');

		$ket = "tambah";
			$this->db->query("INSERT INTO tr_assesment_material (id, project_id, pekerjaan_id, nama_pekerjaan, satuan_pekerjaan, nilai_pekerjaan, nc_pekerjaan, supplier_id, nama_supplier, user_id) 
				VALUES (null, '".$this->session->userdata('project_id')."', '".$pekerjaan_id."', '".$nama_pekerjaan."','".$satuan_pekerjaan."','".$nilai_pekerjaan."','".$nc_pekerjaan."','".$supplier_id."','".$nama_supplier."','".$user_id."')");
		
		$ret_arr['status'] 	= "ok";
		$ret_arr['project_id'] 	= $this->session->userdata('project_id');
		$ret_arr['caption']	= $ket." sukses";
		j($ret_arr);
		
	}

	function hapus_material($id){
		$this->db->where('id', $id);
		$this->db->delete('tr_assesment_material');
		redirect('assesment/assesment_material_detail/'.$this->session->userdata('project_id'));
	}

	/* Akhir Assesment Item Material */

	public function update(){
		if(isset($_POST['field']) && isset($_POST['value']) && isset($_POST['id'])){
		    $field = $_POST['field']; 
		    $value = $_POST['value']; 
		    $editid = $_POST['id'];
		    $tabel = $_POST['mode'];
		    
		    $query = "UPDATE $tabel SET ".$field."='".$value."' WHERE id=".$editid;
		    $this->db->query($query);
		    echo 1;
		}else{
		    echo 0;
		}
	}	

	/* Summary Assesment */
	public function summaryachiement()
	{
		
		if ($this->session->userdata('admin_level') == "3"){
			$project = $this->db->get('mproyek')->result();
			
		}else{
			$project = $this->db->get_where('mproyek', array('id' => $this->session->userdata('project_id')))->result();
		}
		
		$data['project'] = $project;
		$data['page'] = 'summaryachiement';
		$this->load->view('template/header', $data);
		$data['addjs'] = $this->load->view('pages/assesment/assesmentjs','',true);
		$this->load->view('pages/assesment/summary', $data);
		$this->load->view('template/footer', $data);

	}

	public function getChart(){
    	$default=0;
      	$project_id = $this->session->userdata('project_id');
      	$tabul = $this->input->post('tabul', true);

      	if (empty($tabul)){
      		$tabul =date('Ym');
      	}

      	$pekerjaan = $this->db->get('m_pekerjaan')->result();

      	$prosentase_total =0;

      	foreach ($pekerjaan as $row) {
      		$data = $this->db->query("SELECT round(SUM(koreksi)/COUNT(koreksi),2) as total FROM tr_assesment_pekerjaan WHERE nama_pekerjaan ='".$row->pekerjaan."' AND tabul='".$tabul."'")->row();

      		if ($data->total == null){
      			$value[] =0;
      		}else{
      			$value[] = (float) $data->total;
      		}
      		
      		$nama_pekerjaan[] = $row->pekerjaan;
      		$response['pakerjaan'] = $nama_pekerjaan;
      		$response['total'] = $value;

      	}

      	$material = $this->db->get('m_pekerjaan')->result();

      	foreach ($material as $row) {
      		$data = $this->db->query("SELECT SUM(koreksi) as total FROM tr_assesment_material WHERE nama_pekerjaan ='".$row->pekerjaan."' AND tabul='".$tabul."'")->row();
      		$total_material[] = (float) $data->total;
      		$response['total_material'] = $total_material;
      	}

      	echo json_encode($response);
    }

}
