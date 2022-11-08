<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bank_data extends CI_Controller {
	private $bank;

	function __construct() {
        parent::__construct();

        $this->load->model('MBank');
        $this->bank = $this->MBank;

        $this->cek_aktif();
	}
	
	public function cek_aktif() {
		if ($this->session->userdata('admin_valid') == false && $this->session->userdata('admin_id') == "") {
			redirect('login');
		} 
	}
	
	public function setPekerjaan(){
		$this->session->set_userdata('pekerjaan_id', $this->input->post('pekerjaan_id'));
	}

	public function admin()
	{

		$pekerjaan_id = $this->uri->segment(3, 0);

		$data['pekerjaan_id'] = $pekerjaan_id;
		$project = $this->db->get('mproyek')->result();
		$data['project'] = $project;

		if (!empty($pekerjaan_id)){
			$data['bank'] = $this->bank->getDataByPekerjaan($pekerjaan_id);
		}else{
			$data['bank'] = $this->bank->getData();
		}
		
		$data['page'] = 'bank_data/akses_admin';
		$data['pekerjaan'] = $this->db->get('m_pekerjaan')->result();
		$data['penilaian'] = $this->db->get('m_nilai')->result();

		$this->load->view('template/header', $data);
		$this->load->view('pages/bank/akses_admin', $data);
		$this->load->view('template/footer', $data);
	}

	public function user()
	{

		$pekerjaan_id = $this->uri->segment(3, 0);
		$data['pekerjaan_id'] = $pekerjaan_id;

		$project_id = $this->session->userdata('project_id');

		$data['project_id'] = $this->db->get_where('mproyek', array('id'=>$project_id))->row()->id;
		
		if (!empty($pekerjaan_id)){
			$data['bank'] = $this->bank->getDataByPekerjaan($pekerjaan_id);
		}else{
			$data['bank'] = $this->bank->getData();
		}

		$data['page'] = 'bank_data/user';
		$data['penilaian'] = $this->db->get('m_nilai')->result();
		$data['pekerjaan'] = $this->db->get('m_pekerjaan')->result();

		$this->load->view('template/header', $data);
		$this->load->view('pages/bank/akses_user', $data);
		$this->load->view('template/footer', $data);

	}

	public function getDataBank()
	{

		$pekerjaan_id = $this->input->post('pekerjaan_id', TRUE);
		$data['pekerjaan_id'] = $pekerjaan_id;
		
		if (!empty($pekerjaan_id)){
			$data['bank'] = $this->bank->getDataByPekerjaan($pekerjaan_id);
		}else{
			$data['bank'] = $this->bank->getData();
		}

		$view = $this->load->view('pages/bank/images', $data);
		$respon['view'] = $view;
		echo json_encode($respon);
	}

	function hapus($id){

		$filename = $this->bank->getDataById($id)->nama_file;
		$path = './uploads/bank_data/'.$filename;

		if (file_exists($path)) {
		    unlink($path);

		    $this->db->where('id', $id);
			$this->db->delete('tr_bank_data');
			$ret_arr['status'] 	= "ok";
			$ret_arr['caption']	= "hapus berhasil";
			j($ret_arr);
			exit();
		} else {
			$ret_arr['status'] 	= "ok";
			$ret_arr['caption']	= "hapus gagal";
			j($ret_arr);
			exit();
		}
	}

	function getDataPenilaian(){
		$pekerjaan_id = $this->input->post('pekerjaan_id');
		$data = $this->db->query("SELECT * FROM m_kriteria_penilaian WHERE pekerjaan_id='".$pekerjaan_id."'")->result();
		echo json_encode($data);
	}

	public function uploadFile(){
		$upload_dir = './uploads/bank_data/';
		if (!empty($_FILES)) 
		{ 
		  
			$file_nc = preg_replace('/\s+/', '_', $_FILES['file']['name']);

			$tmpFile = $_FILES['file']['tmp_name'];
			$filename = $upload_dir.'/'.$file_nc;
			move_uploaded_file($tmpFile,$filename);

			$type = $_POST['type'];
			  
			$arr = array(
			  	'file' => $file_nc,
			  	'type' => $type
			);

			$project_id = $this->input->post('project_id', TRUE);
			$pekerjaan = $this->input->post('pekerjaan', TRUE);
			$penilaian = $this->input->post('kriteria_penilaian', TRUE);

			$arr_temuan = array(
				'nama_file' =>$file_nc,
				'project_id' => $project_id,
				'pekerjaan_id' => $pekerjaan,
				'kriteria_penilaian_id' => $penilaian,
				'created_by' => $this->session->userdata('admin_id'),
				'tgl_input' => date('Y-m-d')
			);	

			$this->db->insert('tr_bank_data', $arr_temuan);
		}
	}

	public function removeImage(){
		$target_dir = './uploads/';
		$request = $_POST['request'];
		if($request == 2){ 
		  $filename = $target_dir.$_POST['name'];  
		  unlink($filename); 
		  exit;
		}
	}
}
