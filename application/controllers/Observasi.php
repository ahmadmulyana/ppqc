<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Observasi extends CI_Controller {

	private $observasi;

	function __construct() {
        parent::__construct();
        $this->cek_aktif();
        $this->load->model('MObservasi');
        $this->observasi = $this->MObservasi;
	}
	
	public function cek_aktif() {
		if ($this->session->userdata('admin_valid') == false && $this->session->userdata('admin_id') == "") {
			redirect('login');
		} 
	}
	
	public function detail()
	{

		$project_id = $this->uri->segment(3, 0);

		$data['project_id'] = $project_id;
		$data['pekerjaan'] = $this->db->get('m_pekerjaan')->result();
		$data['observasi'] = $this->observasi->getData($project_id);

		$data['page'] = '';
		$this->load->view('template/header', $data);
		$this->load->view('pages/observasi/observasi_detail', $data);
		$this->load->view('template/footer', $data);
	}

	public function save(){
		
		$project_id = $this->input->post('project_id', TRUE);
		$pekerjaan = $this->input->post('pekerjaan', TRUE);
		$dampak_masalah = $this->input->post('dampak_masalah', TRUE);
		$uraian_potensi_masalah = $this->input->post('uraian_potensi_masalah', TRUE);
		$tanggal = $this->input->post('tanggal', TRUE);

		$project= $this->security->xss_clean( $this->input->post('project_id') );
		$pekerjaan= $this->security->xss_clean( $this->input->post('pekerjaan') );
		$dampak_masalah= $this->security->xss_clean( $this->input->post('dampak_masalah') );
		$uraian_potensi_masalah= $this->security->xss_clean( $this->input->post('uraian_potensi_masalah') );
		$tanggal= $this->security->xss_clean( $this->input->post('tanggal') );

		$this->form_validation->set_rules('project_id', 'project_id', 'required');
		$this->form_validation->set_rules('pekerjaan', 'pekerjaan', 'required');
		$this->form_validation->set_rules('uraian_potensi_masalah', 'uraian_potensi_masalah', 'required');
		$this->form_validation->set_rules('tanggal', 'tanggal', 'required');
		$this->form_validation->set_rules('dampak_masalah', 'dampak_masalah', 'trim|required');

		if(!$this->form_validation->run()) {
			$this->session->set_flashdata('msg_alert', validation_errors());
			redirect('observasi/detail/'.$project_id);	
		}

		$arr = array(
			'project_id' => $project_id,
			'pekerjaan_id' => $pekerjaan,
			'tanggal' => $tanggal,
			'dampak_masalah' => $dampak_masalah,
			'uraian_potensi_masalah' => $uraian_potensi_masalah,
			'created_by' => $this->session->userdata('admin_id')
		);

		$rest = $this->db->insert('tr_observasi', $arr);
		if ($rest){
			$this->session->set_flashdata('msg_alert', "Data Berhasil disimpan ...");
			redirect('observasi/detail/'.$project_id);	
		}
		
	}

	public function update() {
		$id = $this->input->post('id');
		$level = $this->input->post('level');

		$ket 	= "";
		$tgl = date('Y-m-d');

		$user_id = $this->session->userdata('admin_id');

		$this->db->query("UPDATE tr_observasi SET level = '".$level."'
							WHERE id = '".$id."'");
		
		$ret_arr['status'] 	= "ok";
		$ret_arr['caption']	= $ket." sukses";
		j($ret_arr);
	}

}
