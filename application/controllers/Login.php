<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	public function index()
	{
		
		if ($this->session->userdata('admin_valid') == false && $this->session->userdata('admin_id') == "") {

			$banner = $this->db->get_where('m_setting', array('tipe' => "1"));

			if ($banner->num_rows() > 0 ) {
				$data['banner'] = $banner->row()->files;
			}else{
				$data['banner'] = "";
			}

			$logo = $this->db->get_where('m_setting', array('tipe' => "2"));
			if ($logo->num_rows() > 0 ) {
				$data['logo'] = $logo->row()->files;
			}else{
				$data['logo'] = "";
			}

			$this->load->view('login', $data);
		} else{
			redirect('home');
		}
	}

	public function act_login(){

		$username= $this->security->xss_clean( $this->input->post('username') );
		$sandi= $this->security->xss_clean( $this->input->post('sandi') );

		$this->form_validation->set_rules('username', 'username', 'required');
		$this->form_validation->set_rules('sandi', 'sandi', 'required');
		
		if(!$this->form_validation->run()) {
			$this->session->set_flashdata('message_login_error', validation_errors());
			redirect( site_url() );
		}

		$hasil = $this->db->query("SELECT * FROM m_users WHERE username ='".$username."' AND sandi='".md5($sandi)."'");

		if ($hasil->num_rows() > 0 ){
			$data = $hasil->row();

			$data = array(
                    'admin_id' => $data->id,
                    'admin_user' => $data->username,
                    'admin_level' => $data->level_id,
					'admin_valid' => true,
					'project_id' => $data->project_id,
					'nama_lengkap' => $data->nama_lengkap
                    );
			$this->session->set_userdata($data);
			redirect('home');
		}else{
			$this->session->set_flashdata('message_login_error', 'Login Gagal, pastikan username dan password benar!');
			redirect( site_url() );
		}

	}

	public function logout() {
		$data = array(
                    'admin_id' 		=> "",
                    'admin_user' 	=> "",
                    'admin_level' 	=> "",
                    'admin_konid' 	=> "",
                    'admin_nama' 	=> "",
					'project_id' 	=> "",
					'nama_project' 	=> "",
					'admin_valid' 	=> false
                    );
        $this->session->set_userdata($data);
		redirect('');
	}
}