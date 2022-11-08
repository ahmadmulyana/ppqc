<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Qsia extends CI_Controller {

	private $qsia;

	function __construct() {
        parent::__construct();

        $this->load->model('MQsia');
        $this->qsia = $this->MQsia;

        $this->cek_aktif();
	}
	
	public function cek_aktif() {
		if ($this->session->userdata('admin_valid') == false && $this->session->userdata('admin_id') == "") {
			redirect('login');
		} 
	}
	
	public function index()
	{
		
		if ($this->session->userdata('tabul') == "") {
			$tabul=date('Ym');
		}else{
			$tabul=$this->session->userdata('tabul');
		}

		$project_id = $this->session->userdata('project_id');

		$rest_project = $this->db->get_where('mproyek', array('id'=>$project_id))->row();
		$data['nama_project'] = $rest_project->nama_proyek;
		$data['status_lock'] = $rest_project->status_lock;

		$this->session->set_userdata('status_lock', $rest_project->status_lock);
		$this->session->set_userdata('nama_project', $data['nama_project']);
		$this->session->set_userdata('project_id', $project_id);

		$project = $this->db->get_where('tr_css', array('project_id'=>$project_id))->row();
		$data['project'] = $project;


		$SQL = "SELECT a.nilai_id, b.item_penilaian, SUM(a.nilai) AS nil, SUM(a.nilai_maksimal) AS nil_mak, (sum(a.nilai)/sum(a.nilai_maksimal))*100 as nilai FROM tr_nilai_qsia a INNER JOIN m_nilai b ON a.nilai_id = b.id WHERE a.nilai > 0 AND a.project_id = '".$project_id."' AND tabul='".$tabul."' GROUP BY nilai_id";
		$hasil = $this->db->query($SQL)->result();
		$data['nilai'] = $hasil;

		$data['total_nilai_1'] = $this->qsia->getDataSummary("1", $tabul);
		$data['total_nilai_2'] = $this->qsia->getDataSummary("2", $tabul);
		$data['total_nilai_3'] = $this->qsia->getDataSummary("3", $tabul);
		$data['total_nilai_4'] = $this->qsia->getDataSummary("4", $tabul);
		$data['total_nilai_5'] = $this->qsia->getDataSummary("5", $tabul);

		$data['total_nilai_max_1'] = $this->qsia->getDataSummaryMaksimal("1", $tabul);
		$data['total_nilai_max_2'] = $this->qsia->getDataSummaryMaksimal("2", $tabul);
		$data['total_nilai_max_3'] = $this->qsia->getDataSummaryMaksimal("3", $tabul);
		$data['total_nilai_max_4'] = $this->qsia->getDataSummaryMaksimal("4", $tabul);
		$data['total_nilai_max_5'] = $this->qsia->getDataSummaryMaksimal("5", $tabul);

		$data['total_nilai_potensi'] = $this->qsia->getTotalMaksimal($project_id, $tabul);

		$data['page'] = 'qsia_detail';
		$data['addjs'] = $this->load->view('pages/qsia/qsiajs','',true);


		$this->load->view('template/header', $data);
		$this->load->view('pages/qsia/qsia_detail', $data);
		$this->load->view('template/footer', $data);
	}

	public function add()
	{
		$nilai = $this->db->get('m_nilai_item');
		$user_id = $this->session->userdata('admin_id');
		$project_id = $this->session->userdata('project_id');

		if ($this->session->userdata('tabul') == "") {
			$tabul=date('Ym');
		}else{
			$tabul=$this->session->userdata('tabul');
		}

		foreach ($nilai->result() as $r) {

			$cek_data = $this->db->get_where('tr_nilai_qsia', 
				array(
					'project_id'=>$this->session->userdata('project_id'),
					'nilai_item_id' => $r->id,
					'tabul' => $tabul
				)
			)->num_rows();

			if ($cek_data == 0 ){
				$a = array (
					'nilai_id' => $r->nilai_id,
					'nilai_item_id' => $r->id,
					'nilai_maksimal' => 0,
					'project_id' => $this->session->userdata('project_id'),
					'user_id' => $user_id,
					'tabul' => $tabul
				);
				$this->db->insert('tr_nilai_qsia', $a);
			}
		}

		$data['total_nilai_perencanaan'] = $this->qsia->getDataSummary("1", $tabul);
		$data['total_nilai_max_perencanaan'] = $this->qsia->getDataSummaryMaksimal("1", $tabul);
		
		$data['total_nilai_kordinasi'] = $this->qsia->getDataSummary("2", $tabul);
		$data['total_nilai_max_koordinasi'] = $this->qsia->getDataSummaryMaksimal("2", $tabul);

		$data['total_nilai_sumber_daya'] = $this->qsia->getDataSummary("3", $tabul);
		$data['total_nilai_max_sumber_daya'] = $this->qsia->getDataSummaryMaksimal("3", $tabul);

		$data['total_nilai_penunjang'] = $this->qsia->getDataSummary("4", $tabul);
		$data['total_nilai_max_penunjang'] = $this->qsia->getDataSummaryMaksimal("4", $tabul);

		$data['total_nilai_proses'] = $this->qsia->getDataSummary("5", $tabul);
		$data['total_nilai_max_proses'] = $this->qsia->getDataSummaryMaksimal("5", $tabul);

		$data['perencanaan'] = $this->qsia->getData("1", $project_id, $tabul);
		$data['koordinasi'] = $this->qsia->getData("2", $project_id, $tabul);
		$data['sumber_daya'] = $this->qsia->getData("3", $project_id, $tabul);
		$data['penunjang'] = $this->qsia->getData("4", $project_id, $tabul);
		$data['proses'] = $this->qsia->getData("5", $project_id, $tabul);

		$data['page'] = 'qsia/add';

		$this->load->view('template/header', $data);
		$this->load->view('pages/qsia/qsia_add', $data);
		$this->load->view('template/footer', $data);

	}

	public function saveData()
	{
		
		$project_id = $this->session->userdata('project_id');
		$id = $this->input->post('id');
		$nilai = $this->input->post('nilai');

		if ($this->session->userdata('tabul') == "") {
			$tabul=date('Ym');
		}else{
			$tabul=$this->session->userdata('tabul');
		}

		if ($nilai >= 0){
			$nilai_maksimal =4;
		}else{
			$nilai_maksimal =0;
		}
		$user_id = $this->session->userdata('admin_id');

		$where = array(
			'id' => $id
		);

		$cek_data = $this->db->get_where('tr_nilai_qsia', $where)->num_rows();
		if ($cek_data > 0 ) {

			$arr = array(
				'nilai' => $nilai,
				'nilai_maksimal' => $nilai_maksimal,
				'tanggal' => date('Y-m-d')
			);

			$where = array(
				'id' => $id,
			);

			$this->db->where($where);
			$result =  $this->db->update('tr_nilai_qsia', $arr);
		}
		
		$ket 	= "";
		if ($result){
			$ret_arr['status'] 	= "ok";
			$ret_arr['project_id'] 	= $project_id;
			$ret_arr['caption']	= $ket." sukses";
			$ret_arr['total_1']	= $this->qsia->getDataSummary("1", $tabul);
			$ret_arr['total_2']	= $this->qsia->getDataSummary("2", $tabul);
			$ret_arr['total_3']	= $this->qsia->getDataSummary("3", $tabul);
			$ret_arr['total_4']	= $this->qsia->getDataSummary("4", $tabul);
			$ret_arr['total_5']	= $this->qsia->getDataSummary("5", $tabul);

			$ret_arr['total_1_1']	= $this->qsia->getDataSummaryMaksimal("1", $tabul); 
			$ret_arr['total_2_1']	= $this->qsia->getDataSummaryMaksimal("2", $tabul); 
			$ret_arr['total_3_1']	= $this->qsia->getDataSummaryMaksimal("3", $tabul); 
			$ret_arr['total_4_1']	= $this->qsia->getDataSummaryMaksimal("4", $tabul); 
			$ret_arr['total_5_1']	= $this->qsia->getDataSummaryMaksimal("5", $tabul); 

			j($ret_arr);
			exit();
		}

	}

	
	function lock(){

		$id = $this->input->post('id', TRUE);
		
		$ket ="Lock";
		$data = $this->db->get_where('mproyek', array('id'=>$id));
		if ($data->num_rows() > 0 ) {
			$status_lock = $data->row()->status_lock;
			if ($status_lock=="Y"){
				$this->db->where('id', $id);
				$this->db->update('mproyek', array('status_lock'=>"N"));
			}else{
				$this->db->where('id', $id);
				$this->db->update('mproyek', array('status_lock'=>"Y"));
			}
		}
		$ret_arr['caption']	= $ket." sukses";
		$ret_arr['status'] 	= "ok";
		j($ret_arr);
	}

	function simpanSessi(){
		$tabul = $this->input->post('tabul', TRUE);
		$this->session->set_userdata('tabul', $tabul);

		$tabul_asli = $this->input->post('tabul_asli', TRUE);
		$this->session->set_userdata('tabul_asli', $tabul_asli);

		echo json_encode(array('pesan' => "success"));
	}

	function getDataByTabul(){
		$tabul = $this->input->post('tabul', TRUE);
		$project_id = $this->session->userdata('project_id');
		$SQL = "SELECT a.nilai_id, b.item_penilaian, SUM(a.nilai) AS nil, SUM(a.nilai_maksimal) AS nil_mak, (sum(a.nilai)/sum(a.nilai_maksimal))*100 as nilai FROM tr_nilai_qsia a INNER JOIN m_nilai b ON a.nilai_id = b.id WHERE a.nilai > 0 AND a.project_id = '".$project_id."' AND tabul='".$tabul."' GROUP BY nilai_id";
		$hasil = $this->db->query($SQL)->result();
		$data['nilai'] = $hasil;

		/*
		$data['total_nilai_1'] = $this->qsia->getDataSummary("1", $tabul);
		$data['total_nilai_2'] = $this->qsia->getDataSummary("2", $tabul);
		$data['total_nilai_3'] = $this->qsia->getDataSummary("3", $tabul);
		$data['total_nilai_4'] = $this->qsia->getDataSummary("4", $tabul);
		$data['total_nilai_5'] = $this->qsia->getDataSummary("5", $tabul);

		$data['total_nilai_max_1'] = $this->qsia->getDataSummaryMaksimal("1", $tabul);
		$data['total_nilai_max_2'] = $this->qsia->getDataSummaryMaksimal("2", $tabul);
		$data['total_nilai_max_3'] = $this->qsia->getDataSummaryMaksimal("3", $tabul);
		$data['total_nilai_max_4'] = $this->qsia->getDataSummaryMaksimal("4", $tabul);
		$data['total_nilai_max_5'] = $this->qsia->getDataSummaryMaksimal("5", $tabul);

		$data['total_nilai_potensi'] = $this->qsia->getTotalMaksimal($project_id, $tabul);
		*/
		
		echo json_encode($hasil);
	}

	function getDataGrafikByTabul(){
		$tabul = $this->input->post('tabul', TRUE);

		if ($tabul==""){
			$tabul = $this->session->userdata('tabul');
			if ($this->session->userdata('tabul')==""){
				$tabul = date('Ym');
			}
		}

		$data['total_nilai_1'] = (float) $this->qsia->getDataSummary("1", $tabul);
		$data['total_nilai_2'] = (float) $this->qsia->getDataSummary("2", $tabul);
		$data['total_nilai_3'] = (float) $this->qsia->getDataSummary("3", $tabul);
		$data['total_nilai_4'] = (float) $this->qsia->getDataSummary("4", $tabul);
		$data['total_nilai_5'] = (float) $this->qsia->getDataSummary("5", $tabul);
		j($data);
	}


	/* Akses Admin */

	public function detail_admin($project_id)
	{
		
		if ($this->session->userdata('tabul') == "") {
			$tabul=date('Ym');
		}else{
			$tabul=$this->session->userdata('tabul');
		}

		$this->session->set_userdata('project_id', $project_id);

		$rest_project = $this->db->get_where('mproyek', array('id'=>$project_id))->row();
		$data['nama_project'] = $rest_project->nama_proyek;
		$data['status_lock'] = $rest_project->status_lock;

		$this->session->set_userdata('nama_project', $data['nama_project']);
		$this->session->set_userdata('project_id', $project_id);

		$project = $this->db->get_where('tr_css', array('project_id'=>$project_id))->row();
		$data['project'] = $project;


		$SQL = "SELECT a.nilai_id, b.item_penilaian, SUM(a.nilai) AS nil, SUM(a.nilai_maksimal) AS nil_mak, (sum(a.nilai)/sum(a.nilai_maksimal))*100 as nilai FROM tr_nilai_qsia a INNER JOIN m_nilai b ON a.nilai_id = b.id WHERE a.nilai > 0 AND a.project_id = '".$project_id."' AND tabul='".$tabul."' GROUP BY nilai_id";
		$hasil = $this->db->query($SQL)->result();
		$data['nilai'] = $hasil;

		$data['total_nilai_1'] = $this->qsia->getDataSummary("1", $tabul);
		$data['total_nilai_2'] = $this->qsia->getDataSummary("2", $tabul);
		$data['total_nilai_3'] = $this->qsia->getDataSummary("3", $tabul);
		$data['total_nilai_4'] = $this->qsia->getDataSummary("4", $tabul);
		$data['total_nilai_5'] = $this->qsia->getDataSummary("5", $tabul);

		$data['total_nilai_max_1'] = $this->qsia->getDataSummaryMaksimal("1", $tabul);
		$data['total_nilai_max_2'] = $this->qsia->getDataSummaryMaksimal("2", $tabul);
		$data['total_nilai_max_3'] = $this->qsia->getDataSummaryMaksimal("3", $tabul);
		$data['total_nilai_max_4'] = $this->qsia->getDataSummaryMaksimal("4", $tabul);
		$data['total_nilai_max_5'] = $this->qsia->getDataSummaryMaksimal("5", $tabul);

		$data['total_nilai_potensi'] = $this->qsia->getTotalMaksimal($project_id, $tabul);

		$data['page'] = 'qsia_detail';
		$data['addjs'] = $this->load->view('pages/qsia/qsiajs','',true);

		$this->load->view('template/header', $data);
		$this->load->view('pages/qsia/qsia_detail', $data);
		$this->load->view('template/footer', $data);
	}

}
