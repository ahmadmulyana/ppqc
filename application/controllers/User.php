<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function add()
	{
		
		$data['level'] = $this->db->get('mlevel')->result();
		$data['project'] = $this->db->get('mproyek')->result();
		$data['page'] = 'user/add';
		$this->load->view('template/header', $data);
		$this->load->view('pages/user/add', $data);
		$this->load->view('template/footer', $data);
	}

	public function save(){
		$project= $this->security->xss_clean( $this->input->post('project') );
		$nama_lengkap= $this->security->xss_clean( $this->input->post('nama_lengkap') );
		$email= $this->security->xss_clean( $this->input->post('email') );
		$nrp= $this->security->xss_clean( $this->input->post('nrp') );
		$password= $this->security->xss_clean( $this->input->post('password') );
		$level= $this->security->xss_clean( $this->input->post('level') );

		$this->form_validation->set_rules('project', 'project', 'required');
		$this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'required');
		$this->form_validation->set_rules('nrp', 'NRP', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_rules('level', 'Level', 'required');
		$this->form_validation->set_rules('email', 'Email', 'trim|required');

		if(!$this->form_validation->run()) {
			$this->session->set_flashdata('msg_alert', validation_errors());
			redirect('user/add');
			exit();
		}else{
			$arr = array(
				'nama_lengkap' => $nama_lengkap,
				'project_id' => $project,
				'email' => $email,
				'level_id' => $level,
				'nrp' => $nrp,
				'sandi' => md5($password),
				'username' => $email
			);

			$rest = $this->db->insert('m_users', $arr);
			redirect('home/user');
		}
	}

	public function update(){
		$id = $this->security->xss_clean( $this->input->post('id') );
		$project= $this->security->xss_clean( $this->input->post('project') );
		$nama_lengkap= $this->security->xss_clean( $this->input->post('nama_lengkap') );
		$email= $this->security->xss_clean( $this->input->post('email') );
		$nrp= $this->security->xss_clean( $this->input->post('nrp') );
		$level= $this->security->xss_clean( $this->input->post('level') );

		$this->form_validation->set_rules('project', 'project', 'required');
		$this->form_validation->set_rules('nama_lengkap', 'nama_lengkap', 'required');
		$this->form_validation->set_rules('nrp', 'nrp', 'required');
		$this->form_validation->set_rules('level', 'level', 'required');
		$this->form_validation->set_rules('email', 'Email', 'trim|required');

		if(!$this->form_validation->run()) {
			$this->session->set_flashdata('msg_alert', validation_errors());
			redirect( site_url('user/add') );
		}

		$arr = array(
			'nama_lengkap' => $nama_lengkap,
			'project_id' => $project,
			'email' => $email,
			'level_id' => $level,
			'nrp' => $nrp,
			'sandi' => md5($password),
			'username' => $email
		);

		$this->db->where('id', $id);
		$rest = $this->db->update('m_users', $arr);
		redirect('home/user');

	}

	function edit($id){
		$data['level'] = $this->db->get('mlevel')->result();
		$data['project'] = $this->db->get('mproyek')->result();
		$data['user'] = $this->db->get_where('m_users', array('id'=> $id))->row();

		$data['page'] = '';
		$this->load->view('template/header', $data);
		$this->load->view('pages/user/edit', $data);
		$this->load->view('template/footer', $data);

	}

	function delete($id){
		$this->db->where('id', $id);
		$this->db->delete('m_users');
		redirect('home/user');
	}
}
