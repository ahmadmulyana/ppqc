<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master extends CI_Controller {

	function __construct() {
        parent::__construct();
        $this->cek_aktif();
	}
	
	public function cek_aktif() {
		if ($this->session->userdata('admin_valid') == false && $this->session->userdata('admin_id') == "") {
			redirect('login');
		} 
	}

	public function nc() {
		
		$uri2 = $this->uri->segment(2);
		$uri3 = $this->uri->segment(3);
		$uri4 = $this->uri->segment(4);

		//var post from json
		$p = json_decode(file_get_contents('php://input'));

		//return as json
		$jeson = array();
		$a['data'] = $this->db->query("SELECT m_areapekerjaan_nc.* FROM m_areapekerjaan_nc")->result();
		if ($uri3 == "det") {
			$a = $this->db->query("SELECT * FROM m_areapekerjaan_nc WHERE id = '$uri4'")->row();

			if ($a){
				j($a);	
			}else{
				$a['data'] ="tidak ada";
				j($a);	
			}
			
			exit();
		} else if ($uri3 == "simpan") {
			$ket 	= "";
			if ($p->id != 0) {
				$this->db->query("UPDATE m_areapekerjaan_nc SET nama = '".bersih($p,"nama")."', instagram = '".bersih($p,"instagram")."'
								WHERE id = '".bersih($p,"id")."'");
				$ket = "edit";
			} else {
				$ket = "tambah";
				$tgl = date('Y-m-d');

				$this->db->query("INSERT INTO m_areapekerjaan_nc VALUES (null, '".bersih($p,"type_nc")."','".$tgl."')");
			}
			
			$ret_arr['status'] 	= "ok";
			$ret_arr['caption']	= $ket." sukses";
			j($ret_arr);
			exit();
		} else if ($uri3 == "hapus") {
			$this->db->query("DELETE FROM ykb_regional WHERE id = '".$uri4."'");
			$ret_arr['status'] 	= "ok";
			$ret_arr['caption']	= "hapus sukses";
			j($ret_arr);
			exit();
		} else if ($uri3 == "data") {
			$start = $this->input->post('start');
	        $length = $this->input->post('length');
	        $draw = $this->input->post('draw');
	        $search = $this->input->post('search');

	        $d_total_row = $this->db->query("SELECT id FROM ykb_regional a WHERE a.nama LIKE '%".$search['value']."%'")->num_rows();
	    
	        $q_datanya = $this->db->query("SELECT a.*
											FROM ykb_regional a
	                                        WHERE a.nama LIKE '%".$search['value']."%' ORDER BY a.id ASC LIMIT ".$start.", ".$length."")->result_array();
	        $data = array();
	        $no = ($start+1);

	        foreach ($q_datanya as $d) {
	            $data_ok = array();
	            $data_ok[0] = $no++;
	            $data_ok[1] = $d['nama'];
	            $data_ok[2] = $d['instagram'];
	            $data_ok[3] = '<div class="btn-group">
                          <a href="#" onclick="return m_mapel_e('.$d['id'].');" class="btn btn-info btn-xs"><i class="glyphicon glyphicon-pencil" style="margin-left: 0px; color: #fff"></i> &nbsp;&nbsp;Edit</a>
                          <a href="#" onclick="return m_mapel_h('.$d['id'].');" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-remove" style="margin-left: 0px; color: #fff"></i> &nbsp;&nbsp;Hapus</a>
                         ';

	            $data[] = $data_ok;
	        }

	        $json_data = array(
	                    "draw" => $draw,
	                    "iTotalRecords" => $d_total_row,
	                    "iTotalDisplayRecords" => $d_total_row,
	                    "data" => $data
	                );
	        j($json_data);
	        exit;
		} else {
			$a['p']	= "m_regional";
		}
		$this->load->view('aaa', $a);
	}


	public function nc_simpan() {
		$type_nc = $this->input->post('type_nc');
		$id = $this->input->post('id');

		$ket 	= "";
		$tgl = date('Y-m-d');

		$user_id = $this->session->userdata('admin_id');

		if ($id != 0) {
			$this->db->query("UPDATE m_type_nc SET type_nc = '".$type_nc."'
							WHERE id = '".$id."'");
			$ket = "edit";
		} else {
			$ket = "tambah";
			$this->db->query("INSERT INTO m_type_nc VALUES (null, '".$type_nc."','".$tgl."','".$user_id."')");
		}
		
		$ret_arr['status'] 	= "ok";
		$ret_arr['caption']	= $ket." sukses";
		j($ret_arr);
		
	}

	public function nc_edit(){
		$uri2 = $this->uri->segment(2);
		$uri3 = $this->uri->segment(3);
		$uri4 = $this->uri->segment(4);

		$a = $this->db->query("SELECT * FROM m_type_nc WHERE id = '$uri3'")->row();
		if ($a){
			j($a);	
		}else{
			$a['status'] =false;
			$a['data'] ="tidak ada";
			j($a);	
		}
		
		exit();
	}

	public function nc_hapus(){
		$uri2 = $this->uri->segment(2);
		$uri3 = $this->uri->segment(3);
		$uri4 = $this->uri->segment(4);
		
		$this->db->query("DELETE FROM m_type_nc WHERE id = '".$uri3."'");
		$ret_arr['status'] 	= "ok";
		$ret_arr['caption']	= "hapus sukses";
		j($ret_arr);
		exit();
	}

	
	// master nc
	public function type_nc()
	{
		$data_type = $this->db->get('m_type_nc')->result();
		$data['type'] = $data_type;
		$page['page'] ="type_nc";
		$this->load->view('template/header', $page);
		$this->load->view('pages/master/type_nc', $data);
		$this->load->view('template/footer', $page);
	}

	public function sumber_nc()
	{
		$data['data'] = $this->db->get('m_sumber_nc')->result();
		$page['page'] ="sumber_nc";
		$this->load->view('template/header', $page);
		$this->load->view('pages/master/sumber_nc', $data);
		$this->load->view('template/footer', $page);
	}

	public function sumber_nc_simpan() {
		$sumber_nc = $this->input->post('sumber_nc');
		$id = $this->input->post('id');

		$ket 	= "";
		$tgl = date('Y-m-d');

		$user_id = $this->session->userdata('admin_id');

		if ($id != 0) {
			$this->db->query("UPDATE m_sumber_nc SET sumber_nc = '".$sumber_nc."'
							WHERE id = '".$id."'");
			$ket = "edit";
		} else {
			$ket = "tambah";
			$this->db->query("INSERT INTO m_sumber_nc VALUES (null, '".$sumber_nc."','".$tgl."','".$user_id."')");
		}
		
		$ret_arr['status'] 	= "ok";
		$ret_arr['caption']	= $ket." sukses";
		j($ret_arr);
		
	}

	public function sumber_nc_hapus(){
		$uri3 = $this->uri->segment(3);
		
		$this->db->query("DELETE FROM m_sumber_nc WHERE id = '".$uri3."'");
		$ret_arr['status'] 	= "ok";
		$ret_arr['caption']	= "hapus sukses";
		j($ret_arr);
		exit();
	}


	/* Level NC */

	public function level_nc()
	{
		$data_type = $this->db->get('m_level_nc')->result();
		$data['type'] = $data_type;
		$page['page'] ="level_nc";
		$this->load->view('template/header', $page);
		$this->load->view('pages/master/level_nc', $data);
		$this->load->view('template/footer', $page);
	}

	public function level_nc_edit(){
		$uri2 = $this->uri->segment(2);
		$uri3 = $this->uri->segment(3);
		$uri4 = $this->uri->segment(4);

		$a = $this->db->query("SELECT * FROM m_level_nc WHERE id = '$uri3'")->row();
		if ($a){
			j($a);	
		}else{
			$a['status'] =false;
			$a['data'] ="tidak ada";
			j($a);	
		}
		
		exit();
	}
	
	public function level_nc_simpan() {
		$level_nc = $this->input->post('level_nc');
		$id = $this->input->post('id');

		$ket 	= "";
		$tgl = date('Y-m-d');

		$user_id = $this->session->userdata('admin_id');

		if ($id != 0) {
			$this->db->query("UPDATE m_level_nc SET level_nc = '".$level_nc."'
							WHERE id = '".$id."'");
			$ket = "edit";
		} else {
			$ket = "tambah";
			$this->db->query("INSERT INTO m_level_nc VALUES (null, '".$level_nc."','".$tgl."','".$user_id."')");
		}
		
		$ret_arr['status'] 	= "ok";
		$ret_arr['caption']	= $ket." sukses";
		j($ret_arr);
		
	}

	public function level_nc_hapus(){
		$uri3 = $this->uri->segment(3);
		
		$this->db->query("DELETE FROM m_level_nc WHERE id = '".$uri3."'");
		$ret_arr['status'] 	= "ok";
		$ret_arr['caption']	= "hapus sukses";
		j($ret_arr);
		exit();
	}

	// master nc
	public function type_pekerjaan()
	{
		$data_type = $this->db->get('m_pekerjaan')->result();

		$data['m_pekerjaan'] = $this->db->get('m_pekerjaan')->result();
		$page['page'] ="type_pekerjaan";

		$this->load->view('template/header', $page);
		$this->load->view('pages/master/type_pekerjaan', $data);
		$this->load->view('template/footer', $page);
	}

	public function type_pekerjaan_simpan() {

		$pekerjaan = $this->input->post('pekerjaan');
		$satuan = $this->input->post('satuan');
		$id = $this->input->post('id');

		$ket 	= "";
		$tgl = date('Y-m-d');

		$user_id = $this->session->userdata('admin_id');

		if ($id != 0) {
			$this->db->query("UPDATE m_pekerjaan SET pekerjaan = '".$pekerjaan."', satuan = '".$satuan."'
							WHERE id = '".$id."'");
			$ket = "edit";
		} else {
			$ket = "tambah";
			$this->db->query("INSERT INTO m_pekerjaan VALUES (null, '".$pekerjaan."','".$satuan."','".$tgl."','".$user_id."')");
		}
		
		$ret_arr['status'] 	= "ok";
		$ret_arr['caption']	= $ket." sukses";
		j($ret_arr);
		
	}

	public function type_pekerjaan_edit(){
		$uri2 = $this->uri->segment(2);
		$uri3 = $this->uri->segment(3);
		$uri4 = $this->uri->segment(4);

		$a = $this->db->query("SELECT * FROM m_pekerjaan WHERE id = '$uri3'")->row();
		if ($a){
			j($a);	
		}else{
			$a['status'] =false;
			$a['data'] ="tidak ada";
			j($a);	
		}
		
		exit();
	}

	public function type_pekerjaan_hapus(){
		$uri3 = $this->uri->segment(3);
		
		$this->db->query("DELETE FROM m_pekerjaan WHERE id = '".$uri3."'");
		$ret_arr['status'] 	= "ok";
		$ret_arr['caption']	= "hapus sukses";
		j($ret_arr);
		exit();
	}



	// master item survey
	public function item_survey()
	{
		$data_type = $this->db->get('m_survey')->result();

		$data['m_pekerjaan'] = $this->db->get('m_survey')->result();
		$page['page'] ="item_survey";

		$this->load->view('template/header', $page);
		$this->load->view('pages/master/item_survey', $data);
		$this->load->view('template/footer', $page);
	}

	public function item_survey_simpan() {
		$p = json_decode(file_get_contents('php://input'));

		$ket 	= "";
		$tgl = date('Y-m-d');

		$user_id = $this->session->userdata('admin_id');

		if ($p->id != 0) {
			$this->db->query("UPDATE m_survey SET survey = '".bersih($p,"pekerjaan")."'
							WHERE id = '".bersih($p,"id")."'");
			$ket = "edit";
		} else {
			$ket = "tambah";
			$this->db->query("INSERT INTO m_survey VALUES (null, '".bersih($p,"pekerjaan")."','".$tgl."','".$user_id."')");
		}
		
		$ret_arr['status'] 	= "ok";
		$ret_arr['caption']	= $ket." sukses";
		j($ret_arr);
		
	}

	public function item_survey_edit(){
		$uri3 = $this->uri->segment(3);

		$a = $this->db->query("SELECT * FROM m_survey WHERE id = '$uri3'")->row();
		if ($a){
			j($a);	
		}else{
			$a['status'] =false;
			$a['data'] ="tidak ada";
			j($a);	
		}
		
		exit();
	}

	public function item_survey_hapus(){
		$uri3 = $this->uri->segment(3);
		
		$this->db->query("DELETE FROM m_survey WHERE id = '".$uri3."'");
		$ret_arr['status'] 	= "ok";
		$ret_arr['caption']	= "hapus sukses";
		j($ret_arr);
		exit();
	}


	/* Kriteria Penilaian */
	public function kriteria_penilaian()
	{
		$data['data'] = $this->db->get('m_kriteria_penilaian')->result();
		$data['pekerjaan'] = $this->db->get('m_pekerjaan')->result();
		$page['page'] ="kriteria_penilaian";
		$this->load->view('template/header', $page);
		$this->load->view('pages/master/kriteria_penilaian', $data);
		$this->load->view('template/footer', $page);
	}

	public function kriteria_penilaian_simpan() {
		$kriteria = $this->input->post('kriteria');
		$pekerjaan = $this->input->post('pekerjaan');
		$id = $this->input->post('id');

		$ket 	= "";
		$tgl = date('Y-m-d');

		$user_id = $this->session->userdata('admin_id');

		if ($id != 0) {
			$this->db->query("UPDATE m_kriteria_penilaian SET kriteria = '".$kriteria."'
							WHERE id = '".$id."'");
			$ket = "edit";
		} else {
			$ket = "tambah";
			$this->db->query("INSERT INTO m_kriteria_penilaian VALUES (null, '".$pekerjaan."', '".$kriteria."','".$tgl."','".$user_id."')");
		}
		
		$ret_arr['status'] 	= "ok";
		$ret_arr['caption']	= $ket." sukses";
		j($ret_arr);
		
	}

	public function kriteria_penilaian_edit(){
		$uri3 = $this->uri->segment(3);

		$a = $this->db->query("SELECT * FROM m_kriteria_penilaian WHERE id = '$uri3'")->row();
		if ($a){
			j($a);	
		}else{
			$a['status'] =false;
			$a['data'] ="tidak ada";
			j($a);	
		}
		
		exit();
	}

	public function kriteria_penilaian_hapus(){
		$uri3 = $this->uri->segment(3);
		
		$this->db->query("DELETE FROM m_kriteria_penilaian WHERE id = '".$uri3."'");
		$ret_arr['status'] 	= "ok";
		$ret_arr['caption']	= "hapus sukses";
		j($ret_arr);
		exit();
	}


	// master ventor
	public function vendor()
	{
		$data_type = $this->db->get('m_vendor')->result();

		$data['data'] = $this->db->get('m_vendor')->result();
		$page['page'] ="vendor";

		$this->load->view('template/header', $page);
		$this->load->view('pages/master/vendor', $data);
		$this->load->view('template/footer', $page);
	}

	public function vendor_simpan() {
		$p = json_decode(file_get_contents('php://input'));

		$ket 	= "";
		$tgl = date('Y-m-d');

		$user_id = $this->session->userdata('admin_id');

		if ($p->id != 0) {
			$this->db->query("UPDATE m_vendor SET nama_vendor = '".bersih($p,"nama_vendor")."',
							alamat = '".bersih($p,"alamat")."',
							email = '".bersih($p,"email")."',
							telepon = '".bersih($p,"telepon")."'
							WHERE id = '".bersih($p,"id")."'");
			$ket = "edit";
		} else {
			$ket = "tambah";
			$this->db->query("INSERT INTO m_vendor VALUES (null, '".bersih($p,"nama_vendor")."','".bersih($p,"alamat")."','".bersih($p,"email")."','".bersih($p,"telepon")."','".$tgl."','".$user_id."')");
		}
		
		$ret_arr['status'] 	= "ok";
		$ret_arr['caption']	= $ket." sukses";
		j($ret_arr);
		
	}

	public function vendor_edit(){
		$uri3 = $this->uri->segment(3);

		$a = $this->db->query("SELECT * FROM m_vendor WHERE id = '$uri3'")->row();
		if ($a){
			j($a);	
		}else{
			$a['status'] =false;
			$a['data'] ="tidak ada";
			j($a);	
		}
		
		exit();
	}

	public function vendor_hapus(){
		$uri3 = $this->uri->segment(3);
		
		$this->db->query("DELETE FROM m_vendor WHERE id = '".$uri3."'");
		$ret_arr['status'] 	= "ok";
		$ret_arr['caption']	= "hapus sukses";
		j($ret_arr);
		exit();
	}

	// master supplier
	public function supplier()
	{
		$data_type = $this->db->get('m_supplier')->result();

		$data['data'] = $this->db->get('m_supplier')->result();
		$page['page'] ="supplier";

		$this->load->view('template/header', $page);
		$this->load->view('pages/master/supplier', $data);
		$this->load->view('template/footer', $page);
	}

	public function supplier_simpan() {
		$p = json_decode(file_get_contents('php://input'));

		$ket 	= "";
		$tgl = date('Y-m-d');

		$user_id = $this->session->userdata('admin_id');

		if ($p->id != 0) {
			$this->db->query("UPDATE m_supplier SET nama_supplier = '".bersih($p,"nama_vendor")."',
							alamat = '".bersih($p,"alamat")."',
							email = '".bersih($p,"email")."',
							telepon = '".bersih($p,"telepon")."'
							WHERE id = '".bersih($p,"id")."'");
			$ket = "edit";
		} else {
			$ket = "tambah";
			$this->db->query("INSERT INTO m_supplier VALUES (null, '".bersih($p,"nama_vendor")."','".bersih($p,"alamat")."','".bersih($p,"email")."','".bersih($p,"telepon")."','".$tgl."','".$user_id."')");
		}
		
		$ret_arr['status'] 	= "ok";
		$ret_arr['caption']	= $ket." sukses";
		j($ret_arr);
		
	}

	public function supplier_edit(){
		$uri3 = $this->uri->segment(3);

		$a = $this->db->query("SELECT * FROM m_supplier WHERE id = '$uri3'")->row();
		if ($a){
			j($a);	
		}else{
			$a['status'] =false;
			$a['data'] ="tidak ada";
			j($a);	
		}
		
		exit();
	}

	public function supplier_hapus(){
		$uri3 = $this->uri->segment(3);
		
		$this->db->query("DELETE FROM m_supplier WHERE id = '".$uri3."'");
		$ret_arr['status'] 	= "ok";
		$ret_arr['caption']	= "hapus sukses";
		j($ret_arr);
		exit();
	}

}
