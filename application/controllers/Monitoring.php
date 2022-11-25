<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Monitoring extends CI_Controller {

	function __construct() {
        parent::__construct();
        $this->cek_aktif();
	}

	public function cek_aktif() {
		if ($this->session->userdata('admin_valid') == false && $this->session->userdata('admin_id') == "") {
			redirect('login');
		} 
	}

	public function index()
	{
		$this->load->view('monitoring.php');
	}
	
}
