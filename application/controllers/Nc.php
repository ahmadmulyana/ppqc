<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Nc extends CI_Controller {

	private $nc;

	function __construct() {
        parent::__construct();

        $this->load->model('MNc');
        $this->nc = $this->MNc;
        $this->cek_aktif();
	}
	
	public function cek_aktif() {
		if ($this->session->userdata('admin_valid') == false && $this->session->userdata('admin_id') == "") {
			redirect('login');
		} 
	}

	public function getData(){
		$project_id = $this->session->userdata('project_id');

		$tahun = $this->input->post('tahun');
		$status = $this->input->post('status');

		if ($status=="All"){
			$this->db->order_by("id", "DESC");
			$data = $this->db->get_where('tr_nc', array('project_id'=>$project_id, 'YEAR(tanggal)' => $tahun))->result();
		}else{
			$this->db->order_by("id", "DESC");
			$data = $this->db->get_where('tr_nc', array('project_id'=>$project_id, 'YEAR(tanggal)' => $tahun, 'status_nc' => $status))->result();
		}
		
		echo json_encode($data);
	}

	function getSummary($bulan, $tahun, $project_id, $status) {
        $this->db->select('*');
        $this->db->from('tr_nc as pel');
        $this->db->where('MONTH(pel.tanggal)',$bulan);
        $this->db->where('YEAR(pel.tanggal)',$tahun);
        $this->db->where('project_id',$project_id);
        $this->db->where('status_nc',$status);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->num_rows(); //$query->result();
            } else {
            return 0;
        }
    }   

    public function getChart(){
    	$default=0;
      	$project_id = $this->session->userdata('project_id');
      	$tahun = $this->input->post('tahun', true);

      	if (empty($tahun)){
      		$tahun =date('Y');
      	}

      	for ($i = 1; $i <= 12; $i++){
	        $bulan[] = getBulan($i); 
	        $cekTotalClose = $this->getSummary($i, $tahun, $project_id,'Closed');
	        $presentase = $this->nc->getPresentaseClose($i, $tahun, $project_id,'Closed');
	        
	        $value[] = (float) $cekTotalClose; 
	        $value_presentase[] = (float) $presentase;
	        $cekTotalOpen = $this->getSummary($i, $tahun, $project_id,'Open');
	        $value_open[] = (float) $cekTotalOpen; 

	        $response['bulan'] = $bulan;
			$response['value'] = $value;
			$response['presentase'] = $value_presentase;
			$response['value_open'] = $value_open;
      	}
      	echo json_encode($response);
    }

	public function nc_user()
	{
		
		$project_id = $this->session->userdata('project_id');
		$cekRekap = $this->db->get_where('tr_nc_rekap_close', array('project_id'=>$project_id))->num_rows();

		if ($cekRekap <= 0){
			for ($x = 1; $x <= 10; $x++) {
		  		$data = array(
		  			'project_id' => $project_id,
		  			'bulan' => $x,
		  			'tahun' => date('Y')
		  		);

		  		$this->db->insert('tr_nc_rekap_close', $data);
		  		$this->db->insert('tr_nc_rekap_open', $data);
			} 
		}
		
 		$data['controller'] = $this; 
		$data['project_id'] = $project_id;

		$project = $this->db->get_where('mproyek', array('id' => $this->session->userdata('project_id')))->result();
		$data['nama_project'] = $this->db->get_where('mproyek', array('id'=>$project_id))->row()->nama_proyek;
		$this->session->set_userdata('nama_project', $data['nama_project']);
		
		$data['project'] = $project;

		if (empty($status_nc)){
			$this->db->order_by("id", "DESC");
			$data_nc = $this->db->get_where('tr_nc', array('project_id'=>$project_id))->result();
			$data['status_nc'] = "All";
		}elseif($status_nc=="All"){
			$this->db->order_by("id", "DESC");
			$data['status_nc'] = $status_nc;
			$data_nc = $this->db->get_where('tr_nc', array('project_id'=>$project_id))->result();
		}else{
			$this->db->order_by("id", "DESC");
			$data['status_nc'] = $status_nc;
			$data_nc = $this->db->get_where('tr_nc', array('project_id'=>$project_id, 'status_nc' => $status_nc))->result();
		}
		
		$data['data_nc'] = $data_nc;

		$total_closing = $this->db->get_where('tr_nc', array('project_id'=>$project_id, 'status_nc' => 'Closed'))->num_rows();
		$total_nc = $this->db->get_where('tr_nc', array('project_id'=>$project_id))->num_rows();
		if ($total_nc > 0){
			$data['total_closing'] = round(($total_closing * 100) / $total_nc);
		}else{
			$data['total_closing'] = 0;
		}
		
        $bulan_sebelumnya =  date('m', strtotime(date('2022-01') . '- 1 month'));
        $tahun_sebelumnya =  date('Y', strtotime(date('2022-01') . '- 1 month'));
        
		$query_open_bulan_sebelumnya = $this->db->query("SELECT COUNT(status_nc) as count FROM tr_nc WHERE status_nc ='Open' AND  MONTH(tanggal)='".$bulan_sebelumnya."' AND YEAR(tanggal)='".$tahun_sebelumnya."'"); 
		$query_close_bulan_sebelumnya = $this->db->query("SELECT COUNT(status_nc) as count FROM tr_nc WHERE status_nc ='Closed' AND  MONTH(tanggal)='".$bulan_sebelumnya."' AND YEAR(tanggal)='".$tahun_sebelumnya."'"); 

		
		$query_open_bulan_berjalan = $this->db->query("SELECT COUNT(status_nc) as count FROM tr_nc WHERE status_nc ='Open' AND project_id='".$project_id."' AND MONTH(CURDATE())"); 
		$query_close_bulan_berjalan = $this->db->query("SELECT COUNT(status_nc) as count FROM tr_nc WHERE status_nc ='Closed' AND project_id='".$project_id."' AND MONTH(CURDATE())"); 
		
        $jumlah_open = array($query_open_bulan_sebelumnya->row()->count + $query_open_bulan_berjalan->row()->count);
        $jumlah_close = array($query_close_bulan_sebelumnya->row()->count + $query_close_bulan_berjalan->row()->count);

        $data['open'] = json_encode(array_merge(array_column($query_open_bulan_sebelumnya->result(), 'count'), 
        array_column($query_open_bulan_berjalan->result(),'count'), $jumlah_open),JSON_NUMERIC_CHECK);


        $data['close'] = json_encode(array_merge(array_column($query_close_bulan_sebelumnya->result(), 'count'), 
       	 	array_column($query_close_bulan_berjalan->result(),'count'), $jumlah_close),JSON_NUMERIC_CHECK);

        $data['closed'] = $this->nc->getRekapClose();
        $data['opened'] = $this->nc->getRekapOpen();
        $data['tahun'] = $this->nc->getTahun();
        $data['page'] = 'nc_user';
        $this->load->view('template/header', $data);
        
        $data['addjs'] = $this->load->view('pages/nc/ncjs','',true);
		$this->load->view('pages/nc/nc_detail_user', $data);
		$this->load->view('template/footer', $data);
	}
	
	/*Akses Admin*/
	public function nc_admin()
	{
		
		$project_id = $this->session->userdata('project_id');
		$data['project_id'] = $project_id;

		$project = $this->db->get('mproyek')->result();
		$data['project'] = $project;

		$this->session->set_userdata('project_id', $project_id);

		if (empty($status_nc)){
			$data_nc = $this->db->get('tr_nc')->result();
			$data['status_nc'] = "All";
		}elseif($status_nc=="All"){
			$data['status_nc'] = $status_nc;
			$data_nc = $this->db->get_where('tr_nc', array('project_id'=>$project_id))->result();
		}else{
			$data['status_nc'] = $status_nc;
			$data_nc = $this->db->get_where('tr_nc', array('project_id'=>$project_id, 'status_nc' => $status_nc))->result();
		}
		
		$data['data_nc'] = $data_nc;

		$total_closing = $this->db->get_where('tr_nc', array('project_id'=>$project_id, 'status_nc' => 'Closed'))->num_rows();
		$total_nc = $this->db->get_where('tr_nc', array('project_id'=>$project_id))->num_rows();
		if ($total_nc > 0){
			$data['total_closing'] = round(($total_closing * 100) / $total_nc);
		}else{
			$data['total_closing'] = 0;
		}
		
        $bulan_sebelumnya =  date('m', strtotime(date('2022-01') . '- 1 month'));
        $tahun_sebelumnya =  date('Y', strtotime(date('2022-01') . '- 1 month'));
        
		$query_open_bulan_sebelumnya = $this->db->query("SELECT COUNT(status_nc) as count FROM tr_nc WHERE status_nc ='Open' AND  MONTH(tanggal)='".$bulan_sebelumnya."' AND YEAR(tanggal)='".$tahun_sebelumnya."'"); 
		$query_close_bulan_sebelumnya = $this->db->query("SELECT COUNT(status_nc) as count FROM tr_nc WHERE status_nc ='Closed' AND  MONTH(tanggal)='".$bulan_sebelumnya."' AND YEAR(tanggal)='".$tahun_sebelumnya."'"); 

		
		$query_open_bulan_berjalan = $this->db->query("SELECT COUNT(status_nc) as count FROM tr_nc WHERE status_nc ='Open' AND project_id='".$project_id."' AND MONTH(CURDATE())"); 
		$query_close_bulan_berjalan = $this->db->query("SELECT COUNT(status_nc) as count FROM tr_nc WHERE status_nc ='Closed' AND project_id='".$project_id."' AND MONTH(CURDATE())"); 
		
        $jumlah_open = array($query_open_bulan_sebelumnya->row()->count + $query_open_bulan_berjalan->row()->count);
        $jumlah_close = array($query_close_bulan_sebelumnya->row()->count + $query_close_bulan_berjalan->row()->count);

        $data['open'] = json_encode(array_merge(array_column($query_open_bulan_sebelumnya->result(), 'count'), 
        array_column($query_open_bulan_berjalan->result(),'count'), $jumlah_open),JSON_NUMERIC_CHECK);


        $data['close'] = json_encode(array_merge(array_column($query_close_bulan_sebelumnya->result(), 'count'), 
       	 	array_column($query_close_bulan_berjalan->result(),'count'), $jumlah_close),JSON_NUMERIC_CHECK);

        $data['closed'] = $this->nc->getRekapClose();
        $data['opened'] = $this->nc->getRekapOpen();
        $data['tahun'] = $this->nc->getTahun();

        $data['page'] = 'nc_admin';
		$this->load->view('template/header', $data);
		$data['addjs'] = $this->load->view('pages/nc/ncjs','',true);
		$this->load->view('pages/nc/admin/nc_detail_admin', $data);
		$this->load->view('template/footer', $data);
	}

	public function add_nc()
	{
		$data['page'] = 'add_nc';
		
		$data['type_nc'] = $this->db->get('m_type_nc')->result();
		$data['level_nc'] = $this->db->get('m_level_nc')->result();
		$data['pekerjaan'] = $this->db->get('m_pekerjaan')->result();
		$data['disposisi'] = $this->db->get('m_disposisi')->result();
		$data['sumber_nc'] = $this->db->get('m_sumber_nc')->result();
		$data['bahan'] = $this->db->get('m_bahan')->result();

		$data['som'] = $this->db->get('m_som')->result();
		$data['mandor'] = $this->db->get('m_mandor')->result();
		$data['gsp'] = $this->db->get('m_gsp')->result();
		$data['sp'] = $this->db->get('m_sp')->result();

		$this->load->view('template/header', $data);
		$this->load->view('pages/nc/add_nc', $data);
		$this->load->view('template/footer', $data);
	}

	public function edit_nc()
	{
		$id = $this->uri->segment(3, 0);

		$this->session->set_userdata('nc_id', $id);

		$data['page'] = 'edit_nc';

		$data['data'] = $this->db->get_where('tr_nc', array('id'=> $id))->row();
		$data['type_nc'] = $this->db->get('m_type_nc')->result();
		$data['level_nc'] = $this->db->get('m_level_nc')->result();
		$data['pekerjaan'] = $this->db->get('m_pekerjaan')->result();
		$data['disposisi'] = $this->db->get('m_disposisi')->result();
		$data['bahan'] = $this->db->get('m_bahan')->result();
		$data['orang'] = $this->db->get('m_orang')->result();
		$data['cara'] = $this->db->get('m_cara')->result();
		$data['alat'] = $this->db->get('m_alat')->result();
		$data['lingkungan'] = $this->db->get('m_lingkungan')->result();

		$data['photo_temuan'] = $this->db->get_where('tr_nc_temuan', array('nc_id'=> $id))->result();

		$data['step'] = $this->db->get_where('tr_nc_log', array('nc_id'=>$id))->row()->step;

		$this->load->view('template/header', $data);
		$this->load->view('pages/nc/edit_nc', $data);
		$this->load->view('template/footer', $data);
	}

	public function lihat_nc()
	{
		$id = $this->uri->segment(3, 0);

		$this->session->set_userdata('nc_id', $id);

		$data['page'] = 'lihat_nc';

		$data['data'] = $this->db->get_where('tr_nc', array('id'=> $id))->row();
		$data['type_nc'] = $this->db->get('m_type_nc')->result();
		$data['level_nc'] = $this->db->get('m_level_nc')->result();
		$data['pekerjaan'] = $this->db->get('m_pekerjaan')->result();
		$data['disposisi'] = $this->db->get('m_disposisi')->result();
		
		$data['photo_temuan'] = $this->db->get_where('tr_nc_temuan', array('nc_id'=> $id))->result();
		$data['photo_investigasi'] = $this->db->get_where('tr_nc_investigasi', array('nc_id'=> $id))->result();
		$data['photo_realisasi'] = $this->db->get_where('tr_nc_realisasi', array('nc_id'=> $id))->result();

		$this->load->view('template/header', $data);
		$this->load->view('pages/nc/lihat_nc', $data);
		$this->load->view('template/footer', $data);
	}

	public function save()
	{
		$project_id = $this->security->xss_clean($this->input->post('project_id'));
		$nomor_nc = $this->security->xss_clean($this->input->post('nomor_nc'));
		$lokasi = $this->security->xss_clean($this->input->post('lokasi'));
		$tanggal = $this->security->xss_clean($this->input->post('tanggal'));
		$pekerjaan = $this->security->xss_clean($this->input->post('pekerjaan'));
		$nama_project = $this->security->xss_clean($this->input->post('nama_project'));
		$uraian_temuan = $this->security->xss_clean($this->input->post('uraian_temuan'));
		
		$sumber_nc = $this->security->xss_clean($this->input->post('sumber_nc'));
		$status = $this->security->xss_clean($this->input->post('status'));

		$mandor_id = $this->security->xss_clean($this->input->post('mandor'));
		$mandor = $this->db->get_where('m_mandor', array('id' => $mandor_id))->row()->nama_lengkap;

		$som_id = $this->security->xss_clean($this->input->post('som_nc'));
		$som_nc = $this->db->get_where('m_som', array('id' => $som_id))->row()->nama_lengkap;

		$gps_id = $this->security->xss_clean($this->input->post('gps_nc'));
		$gps_nc = $this->db->get_where('m_gsp', array('id' => $gps_id))->row()->nama_lengkap;

		$sp_id = $this->security->xss_clean($this->input->post('sp_nc'));
		$sp_nc = $this->db->get_where('m_sp', array('id' => $sp_id))->row()->nama_lengkap;

		$isTemuan = $this->security->xss_clean($this->input->post('isTemuan'));

		$this->form_validation->set_rules('nomor_nc', 'Nomor NC', 'required');
		$this->form_validation->set_rules('lokasi', 'Lokasi', 'required');
		$this->form_validation->set_rules('tanggal', 'Tanggal', 'required');
		$this->form_validation->set_rules('uraian_temuan', 'Uraian', 'required');
		$this->form_validation->set_rules('sumber_nc', 'Sumber NC', 'required');
		$this->form_validation->set_rules('som_nc', 'SOM', 'required');
		$this->form_validation->set_rules('gps_nc', 'GPS', 'required');
		$this->form_validation->set_rules('sp_nc', 'SP', 'required');
		$this->form_validation->set_rules('mandor', 'Mandor', 'required');

		if(!$this->form_validation->run()) {
			$ret_arr['status'] 	= "failed";
			$ret_arr['project_id'] 	= $this->input->post('project_id');
			$ret_arr['caption']	= validation_errors();
			j($ret_arr);
			exit();
		}

		if ($isTemuan=="Y"){
			$arr = array(
				'nomor_nc' 			=> $nomor_nc,
				'lokasi' 			=> $lokasi,
				'tanggal' 			=> $tanggal,
				'pekerjaan' 		=> $pekerjaan,
				'uraian_temuan' 	=> $uraian_temuan,
				'project_id'  		=> $project_id,
				'nama_project'  	=> $nama_project,
				'sumber_nc' 		=> $sumber_nc,
				'som_nc' 			=> $som_nc,
				'som_id' 			=> $som_id,
				'gps_nc' 			=> $gps_nc,
				'gps_id' 			=> $gps_id,
				'sp_nc' 			=> $sp_nc,
				'sp_id' 			=> $sp_id,
				'mandor' 			=> $mandor,
				'mandor_id' 		=> $mandor_id,
				'status_nc' 		=> $status,
				'created_by'	 	=> $this->session->userdata('admin_id')
			);
		}else{
			$arr = array(
				'nomor_nc' 			=> $nomor_nc,
				'project_id'  		=> $project_id,
				'uraian_temuan' 	=> $uraian_temuan,
				'tanggal' 			=> $tanggal,
				'type_nc' 			=> $type_nc,
				'sumber_nc' 		=> $sumber_nc,
				'som_nc' 			=> $som_nc,
				'som_id' 			=> $som_id,
				'gps_nc' 			=> $gps_nc,
				'gps_id' 			=> $gps_id,
				'sp_nc' 			=> $sp_nc,
				'sp_id' 			=> $sp_id,
				'mandor' 			=> $mandor,
				'mandor_id' 		=> $mandor_id,
				'level_nc' 			=> $level_nc,
				'tanggal_closing' 	=> $tanggal_closing,
				'lokasi' 			=> $lokasi,
				'status' 			=> $status,
				'pekerjaan' 		=> $pekerjaan,
				'realisasi_biaya'	=> $realisasi_biaya,
				'bahan'				=> $bahan,
				'alat'				=> $alat,
				'cara'				=> $cara,
				'lingkungan'		=> $lingkungan,
				'orang'				=> $orang
			);
		}
		
		$result = $this->db->insert('tr_nc', $arr);
		$lastid = $this->db->insert_id();

		$this->db->insert('tr_nc_log', array('step'=>1, 'nc_id' => $lastid));

		$bulan = $this->db->query("SELECT DATE_FORMAT('".$tanggal."', '%c') as bulan")->row()->bulan;

		$this->db->where('project_id', $project_id);
		$this->db->where('bulan', $bulan);
		$this->db->update('tr_nc_rekap_open', array('total' => 1));

		$image = $this->db->get_where('temp_image', array('type'=>1))->result();

		foreach ($image as $r) {
			$arr_temuan = array(
				'nc_id' => $lastid,
				'file' =>$r->file
			);	
			$this->db->insert('tr_nc_temuan', $arr_temuan);
		}
		
		$this->db->where('type', '1');
		$hapus_temp = $this->db->delete('temp_image');

		$ket 	= "";
		if ($result){
			$ret_arr['status'] 	= "ok";
			$ret_arr['project_id'] 	= $project_id;
			$ret_arr['caption']	= $ket." sukses";
			j($ret_arr);
			exit();
		}
	}

	public function update()
	{
		
		$type_nc = $this->security->xss_clean($this->input->post('type_nc'));
		$uraian_investigasi = $this->security->xss_clean($this->input->post('uraian_investigasi'));
		$referensi = $this->security->xss_clean($this->input->post('referensi'));
		$level_nc = $this->security->xss_clean($this->input->post('level_nc'));

		$this->form_validation->set_rules('level_nc', 'Level', 'required');
		$this->form_validation->set_rules('type_nc', 'Type NC', 'required');
		$this->form_validation->set_rules('uraian_investigasi', 'Uraian', 'required');
		$this->form_validation->set_rules('referensi', 'Referensi', 'required');
		
		$bahan = $this->security->xss_clean($this->input->post('bahan'));
		$alat = $this->security->xss_clean($this->input->post('alat'));
		$cara = $this->security->xss_clean($this->input->post('cara'));
		$lingkungan = $this->security->xss_clean($this->input->post('lingkungan'));
		$orang = $this->security->xss_clean($this->input->post('orang'));

		$project_id = $this->security->xss_clean($this->input->post('project_id'));

		$arr = array(
			'uraian_investigasi' => $uraian_investigasi,
			'type_nc' 			=> $type_nc,
			'referensi' 		=> $referensi,
			'level_nc' 			=> $level_nc,
			'bahan'				=> $bahan,
			'alat'				=> $alat,
			'cara'				=> $cara,
			'lingkungan'		=> $lingkungan,
			'orang'				=> $orang
		);

		if(!$this->form_validation->run()) {
			$ret_arr['status'] 	= "failed";
			$ret_arr['project_id'] 	= $this->input->post('project_id');
			$ret_arr['url_back'] 	= "nc/edit_nc/".$this->session->userdata('nc_id')."#step-2"; 
			$ret_arr['caption']	= validation_errors();
			j($ret_arr);
			exit();
		}

		$where = array('id' => $this->session->userdata('nc_id'));
		$this->db->where($where);
		$result = $this->db->update('tr_nc', $arr);

		$this->db->where('nc_id', $this->session->userdata('nc_id'));
		$this->db->update('tr_nc_log', array('step'=>2));

		$image = $this->db->get_where('temp_image', array('type'=>2))->result();

		foreach ($image as $r) {
			$arr_temuan = array(
				'nc_id' => $this->session->userdata('nc_id'),
				'file' =>$r->file
			);	

			$this->db->insert('tr_nc_investigasi', $arr_temuan);

		}
		
		$this->db->where('type', '2');
		$hapus_temp = $this->db->delete('temp_image');

		$ket 	= "";
		if ($result){
			$ret_arr['status'] 	= "ok";
			$ret_arr['project_id'] = $project_id;
			$ret_arr['nc_id'] 	= $this->session->userdata('nc_id');
			$ret_arr['caption']	= $ket." sukses";
			j($ret_arr);
			exit();
		}

	}

	public function saveTindakLanjut()
	{

		$disposisi_pm = $this->security->xss_clean($this->input->post('disposisi_pm'));
		$tanggal_rencana = $this->security->xss_clean($this->input->post('tanggal_rencana'));
		$uraian_tindak_lanjut = $this->security->xss_clean($this->input->post('uraian_tindak_lanjut'));

		$this->form_validation->set_rules('disposisi_pm', 'Disposisi', 'required');
		$this->form_validation->set_rules('tanggal_rencana', 'Tanggal', 'required');
		$this->form_validation->set_rules('uraian_tindak_lanjut', 'Uraian', 'required');

		$project_id = $this->security->xss_clean($this->input->post('project_id'));

		if(!$this->form_validation->run()) {
			$ret_arr['status'] 	= "failed";
			$ret_arr['project_id'] 	= $this->input->post('project_id');
			$ret_arr['url_back'] 	= "nc/edit_nc/".$this->session->userdata('nc_id')."#step-3"; 
			$ret_arr['caption']	= validation_errors();
			j($ret_arr);
			exit();
		}

		$arr = array(
			'disposisi_pm' 			=> $disposisi_pm,
			'tanggal_rencana' 		=> $tanggal_rencana,
			'uraian_tindak_lanjut'	=> $uraian_tindak_lanjut,
		);

		$where = array('id' => $this->session->userdata('nc_id'));
		$this->db->where($where);
		$result = $this->db->update('tr_nc', $arr);

		$this->db->where('nc_id', $this->session->userdata('nc_id'));
		$this->db->update('tr_nc_log', array('step'=>3));

		$ket 	= "";
		if ($result){
			$ret_arr['status'] 	= "ok";
			$ret_arr['project_id'] = $project_id;
			$ret_arr['nc_id'] 	= $this->session->userdata('nc_id');
			$ret_arr['caption']	= $ket." sukses";
			j($ret_arr);
			exit();
		}
	}

	public function saveClosing()
	{

		$status_nc = $this->security->xss_clean($this->input->post('status_nc'));
		$tanggal_closing = $this->security->xss_clean($this->input->post('tanggal_closing'));
		$realisasi_biaya = $this->security->xss_clean($this->input->post('realisasi_biaya'));

		$this->form_validation->set_rules('status_nc', 'Status', 'required');
		$this->form_validation->set_rules('tanggal_closing', 'Tanggal', 'required');
		$this->form_validation->set_rules('realisasi_biaya', 'Biaya', 'required');

		$project_id = $this->security->xss_clean($this->input->post('project_id'));

		if(!$this->form_validation->run()) {
			$ret_arr['status'] 	= "failed";
			$ret_arr['project_id'] 	= $this->input->post('project_id');
			$ret_arr['url_back'] 	= "nc/edit_nc/".$this->session->userdata('nc_id')."#step-4"; 
			$ret_arr['caption']	= validation_errors();
			j($ret_arr);
			exit();
		}

		$arr = array(
			'status_nc' 		=> $status_nc,
			'tanggal_closing' 	=> $tanggal_closing,
			'realisasi_biaya'	=> $realisasi_biaya,
		);

		$where = array('id' => $this->session->userdata('nc_id'));
		$this->db->where($where);
		$result = $this->db->update('tr_nc', $arr);

		$image = $this->db->get_where('temp_image', array('type'=>3))->result();

		foreach ($image as $r) {
			$arr_temuan = array(
				'nc_id' => $this->session->userdata('nc_id'),
				'file' => $r->file
			);	

			$this->db->insert('tr_nc_realisasi', $arr_temuan);

		}
		
		$bulan = $this->db->query("SELECT DATE_FORMAT('".$tanggal_closing."', '%c') as bulan")->row()->bulan;

		$this->db->where('project_id', $project_id);
		$this->db->where('bulan', $bulan);
		$this->db->update('tr_nc_rekap_close', array('total' => 1));

		$this->db->where('type', '3');
		$hapus_temp = $this->db->delete('temp_image');

		$ket 	= "";
		if ($result){
			$ret_arr['status'] 	= "ok";
			$ret_arr['project_id'] = $project_id;
			$ret_arr['nc_id'] 	= $this->session->userdata('project_id');
			$ret_arr['caption']	= $ket." sukses";
			j($ret_arr);
			exit();
		}

	}

	public function list_laporan()
	{
		$data['page'] = 'list_laporan';
		$data['type_nc'] = $this->nc->getTypeNC();

		$this->load->view('template/header', $data);
		if ($this->session->userdata('admin_level')==3){
			$data['project'] = $this->db->get('mproyek')->result();
			$data['addjs'] = $this->load->view('pages/nc/ncjs','',true);
			$this->load->view('pages/nc/admin/list_laporan_detail', $data);
		}else{
			$id = $this->session->userdata('project_id');
			$data['nama_project'] = $this->db->get_where('mproyek', array('id'=>$id))->row()->nama_proyek;

			$this->load->view('pages/nc/list_laporan_detail', $data);
		}
		
		$this->load->view('template/footer', $data);

	}

	public function getDataLaporan(){
		$type_nc = $this->nc->getTypeNC();

		$default=0;
        $project_id = $this->session->userdata('project_id');
        $januari = date( 'Y' ) . '-01-01';
        foreach($type_nc as $result){
            $type[] = $result->type_nc; 

            $where = array(
              'type_nc'=>$result->type_nc, 
              'project_id' => $project_id,
              'tanggal >=' => $januari,
              'tanggal <=' => date('Y-m-d')
            );

            $cekTotal = $this->db->get_where('tr_nc', $where)->num_rows();
            if ($cekTotal==0){
              $value[] = (float) $default; 
            }else{
              $value[] = (float) $cekTotal; 
            }

            $where = array(
              'type_nc'=>$result->type_nc, 
              'project_id' => $project_id,
              'MONTH(tanggal)' => date('m'),
              'YEAR(tanggal)' => date('Y')
            );

            $cekTotal = $this->db->get_where('tr_nc', $where)->num_rows();
            if ($cekTotal==0){
              $value_bulan_berjalan[] = (float) $default; 
            }else{
              $value_bulan_berjalan[] = (float) $cekTotal; 
            }

            $messages[] = array(
                  'name' => $result->type_nc,
                  'y' => (float) $cekTotal
            );
        }

        $data['type'] 	= $type; 
        $data['messages'] 	= $messages; 
        $data['value_bulan_berjalan'] = $value_bulan_berjalan; 
        $data['value'] = $value; 
        echo json_encode($data);
	}

	public function uploadNC(){
		$upload_dir = './uploads/nc/';
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

		  $this->db->insert('temp_image', $arr);

		  $nc_id = $this->session->userdata('nc_id');
		  $arr = array(
		  	'file' => $file_nc,
		  	'nc_id' => $nc_id
		  );

		  echo $filename;

		}
	}

	public function removeImage(){
		$target_dir = './uploads/nc/';
		$request = $_POST['request'];
		if($request == 2){ 
		  $filename = $target_dir.$_POST['name'];  
		  unlink($filename); 
		  exit;
		}
	}

	public function getImage(){
		// Upload directory
		$target_dir = "./uploads/nc/";

		$request = 1;
		if(isset($_POST['request'])){
			$request = $_POST['request'];
		}

		// Upload file
		if($request == 1){
			$target_file = $target_dir . basename($_FILES["file"]["name"]);

			$msg = "";
			if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_dir.$_FILES['file']['name'])) {
			    $msg = "Successfully uploaded";
			}else{
			    $msg = "Error while uploading";
			}
			echo $msg;
			exit;
		}

		// Read files from 
		if($request == 2){
			$file_list = array();
			
			// Target directory
			$dir = $target_dir;
			if (is_dir($dir)){
			 
			    if ($dh = opendir($dir)){

			        // Read files
			        while (($file = readdir($dh)) !== false){

			            if($file != '' && $file != '.' && $file != '..'){

			            	$cek = $this->db->get_where('tr_nc_temuan', array('file' => $file, 'nc_id' => $this->session->userdata('nc_id')))->num_rows();
			            	if ($cek > 0){
			            		// File path
				                $file_path = $target_dir.$file;
				 
				                // Check its not folder
				                if(!is_dir($file_path)){
				                    $size = filesize($file_path);
				                    $file_list[] = array('name'=>$file,'size'=>$size,'path'=> "../../".$file_path);
				      
				                }
			            	}
			                
			            }
			 
			        }
			        closedir($dh);
			    }
			}

			echo json_encode($file_list);
			exit;
		}
	}

	public function getImageInvestigasi(){
		$target_dir = "./uploads/nc/";

		$request = 1;
		if(isset($_POST['request'])){
			$request = $_POST['request'];
		}

		if($request == 1){
			$target_file = $target_dir . basename($_FILES["file"]["name"]);

			$msg = "";
			if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_dir.$_FILES['file']['name'])) {
			    $msg = "Successfully uploaded";
			}else{
			    $msg = "Error while uploading";
			}
			echo $msg;
			exit;
		}

		// Read files from 
		if($request == 2){
			$file_list = array();
			
			// Target directory
			$dir = $target_dir;
			if (is_dir($dir)){
			 
			    if ($dh = opendir($dir)){

			        // Read files
			        while (($file = readdir($dh)) !== false){

			            if($file != '' && $file != '.' && $file != '..'){

			            	$cek = $this->db->get_where('tr_nc_investigasi', array('file' => $file, 'nc_id' => $this->session->userdata('nc_id')))->num_rows();
			            	if ($cek > 0){
			            		// File path
				                $file_path = $target_dir.$file;
				 
				                // Check its not folder
				                if(!is_dir($file_path)){
				                    
				                    $size = filesize($file_path);

				                    $file_list[] = array('name'=>$file,'size'=>$size,'path'=> "../../".$file_path);
				      
				                }
			            	}
			                
			            }
			 
			        }
			        closedir($dh);
			    }
			}

			echo json_encode($file_list);
			exit;
		}
	}

	public function getImageRealisasi(){
		// Upload directory
		$target_dir = "./uploads/nc/";

		$request = 1;
		if(isset($_POST['request'])){
			$request = $_POST['request'];
		}

		// Upload file
		if($request == 1){
			$target_file = $target_dir . basename($_FILES["file"]["name"]);

			$msg = "";
			if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_dir.$_FILES['file']['name'])) {
			    $msg = "Successfully uploaded";
			}else{
			    $msg = "Error while uploading";
			}
			echo $msg;
			exit;
		}

		// Read files from 
		if($request == 2){
			$file_list = array();
			
			// Target directory
			$dir = $target_dir;
			if (is_dir($dir)){
			 
			    if ($dh = opendir($dir)){

			        // Read files
			        while (($file = readdir($dh)) !== false){

			            if($file != '' && $file != '.' && $file != '..'){

			            	$cek = $this->db->get_where('tr_nc_realisasi', array('file' => $file, 'nc_id' => $this->session->userdata('nc_id')))->num_rows();
			            	if ($cek > 0){
			            		// File path
				                $file_path = $target_dir.$file;
				 
				                // Check its not folder
				                if(!is_dir($file_path)){
				                    
				                    $size = filesize($file_path);

				                    $file_list[] = array('name'=>$file,'size'=>$size,'path'=> "../../".$file_path);
				      
				                }
			            	}
			                
			            }
			 
			        }
			        closedir($dh);
			    }
			}

			echo json_encode($file_list);
			exit;
		}
	}

	function setProjectId(){
		$project_id = $this->input->post('project_id');
		$this->session->set_userdata('project_id', $project_id);
		$nama_project = $this->db->get_where('mproyek', array('id'=>$project_id))->row()->nama_proyek;
		$this->session->set_userdata('nama_project', $nama_project);

		$status = $this->input->post('status');
		if ($status=="All"){
			$data = $this->db->get_where('tr_nc', array('project_id'=>$project_id))->result();
		}else{
			$data = $this->db->get_where('tr_nc', array('project_id'=>$project_id, 'status_nc' => $status))->result();
		}
		
		echo json_encode($data);
	}

	public function evaluasi(){
		$data['grafik'] = $this->nc->getTypeNC();
		$data['page'] ="cari_nc";
		$this->load->view('template/header', $data);

		$data['level_nc'] = $this->db->get('m_level_nc')->result();
		$data['sumber_nc'] = $this->db->get('m_sumber_nc')->result();
		$data['type_nc'] = $this->db->get('m_type_nc')->result();
		$data['disposisi'] = $this->db->get('m_disposisi')->result();
		$data['data_nc'] = $this->nc->cariNC($type_nc, $tanggal_awal, $tanggal_akhir , $level_nc, $sumber_nc, $disposisi);

		$data['addjs'] = $this->load->view('pages/nc/ncjs','',true);
		if ($this->session->userdata('admin_level')==3){
			$this->load->view('pages/nc/admin/cari_nc_admin', $data);
		}else{
			$this->load->view('pages/nc/cari_nc_user', $data);
		}
		$this->load->view('template/footer', $data);
	}

	public function cariData(){
		$type_nc = $this->input->post('type_nc');
		$tanggal_awal = $this->input->post('tanggal_awal');
		$tanggal_akhir = $this->input->post('tanggal_akhir');
		$level_nc = $this->input->post('level_nc');
		$sumber_nc = $this->input->post('sumber_nc');
		$disposisi = $this->input->post('disposisi');

		$data = $this->nc->cariNC($type_nc, $tanggal_awal, $tanggal_akhir ,$level_nc, $sumber_nc, $disposisi);

		echo json_encode($data);
	}

	function array_ulang (){
		
		$type_nc ="1";
		$level_nc="";
		$sumber_nc ="oke";

		$array = array(
            'type_nc' => $type_nc,
            'level_nc' => $level_nc,
            'sumber_nc' => $sumber_nc
        );

        $where ="";
        $lenght = count($array);

        foreach ($array as $key => $value) {
        	if ($value !=""){
        		if ($lenght == count($array)){
        			$where .= $key ."='".$value."' ";
        		}else{
        			$where .= $key ."='".$value."' OR ";
        		}
        		
        	}
        }


        $query ="SELECT * FROM ".$where;
        echo $query; //count($array);

	}


	public function cari_nc()
	{
		
		$type_nc = $this->input->post('type_nc');
		$tanggal_awal = $this->input->post('tanggal_awal');
		$tanggal_akhir = $this->input->post('tanggal_akhir');
		$level_nc = $this->input->post('level_nc');
		$sumber_nc = $this->input->post('sumber_nc');
		$disposisi = $this->input->post('disposisi');

		$data['grafik'] = $this->nc->getTypeNC();

		if (!empty($type_nc)){

			$data['page'] ="cari_nc";
			$this->load->view('template/header', $data);

			$data['level_nc'] = $this->db->get('m_level_nc')->result();
			$data['sumber_nc'] = $this->db->get('m_sumber_nc')->result();
			$data['type_nc'] = $this->db->get('m_type_nc')->result();
			$data['disposisi'] = $this->db->get('m_disposisi')->result();
			$data['data_nc'] = $this->nc->cariNC($type_nc, $tanggal_awal, $tanggal_akhir, $level_nc, $sumber_nc, $disposisi);

			$data['addjs'] = $this->load->view('pages/nc/ncjs','',true);
			if ($this->session->userdata('admin_level')==3){
				$this->load->view('pages/nc/admin/cari_nc_admin', $data);
			}else{
				$this->load->view('pages/nc/cari_nc_user', $data);
			}
			$this->load->view('template/footer', $data);
		}else{
			$data['page'] ="cari_nc";
			$this->load->view('template/header', $data);

			$data['level_nc'] = $this->db->get('m_level_nc')->result();
			$data['sumber_nc'] = $this->db->get('m_sumber_nc')->result();
			$data['type_nc'] = $this->db->get('m_type_nc')->result();
			$data['disposisi'] = $this->db->get('m_disposisi')->result();
			$data['data_nc'] = $this->db->get('tr_nc')->result();
			$data['project'] = $this->db->get('tr_nc')->result();

			$data['addjs'] = $this->load->view('pages/nc/ncjs','',true);
			if ($this->session->userdata('admin_level')==3){
				$this->load->view('pages/nc/admin/cari_nc_admin', $data);
			}else{
				$this->load->view('pages/nc/cari_nc_user', $data);
			}

			$this->load->view('template/footer', $data);
		}
		
	}

	public function cari_nc_detail($project_id)
	{

		$data['page'] ="cari_nc_detail";
		$data['level_nc'] = $this->nc->getLevelNC();
		$data['disposisi'] = $this->nc->getDisposisi();
		$data['sumber_nc'] = $this->nc->getSumberNC();

		$this->load->view('template/header', $data);
		$this->load->view('pages/nc/cari_nc_detail', $data);
		$this->load->view('template/footer', $data);

	}
	
	public function getImages(){
		$target_dir = "./uploads/nc/";

		$request = 1;
		if(isset($_GET['request'])){
			$request = $_GET['request'];
		}

		// Upload file
		if($request == 1){
			$target_file = $target_dir . basename($_FILES["file"]["name"]);

			$msg = "";
			if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_dir.$_FILES['file']['name'])) {
			    $msg = "Successfully uploaded";
			}else{
			    $msg = "Error while uploading";
			}
			echo $msg;
			exit;
		}

		// Read files from 
		if($request == 2){
			$file_list = array();
			
			// Target directory
			$dir = $target_dir;
			if (is_dir($dir)){
			 
			    if ($dh = opendir($dir)){

			        // Read files
			        while (($file = readdir($dh)) !== false){

			            if($file != '' && $file != '.' && $file != '..'){

			            	$cek = $this->db->get_where('tr_nc_temuan', array('file' => $file, 'nc_id' => $this->session->userdata('nc_id')))->num_rows();
			            	if ($cek > 0){
			            		// File path
				                $file_path = $target_dir.$file;
				 
				                // Check its not folder
				                if(!is_dir($file_path)){
				                    
				                    $size = filesize($file_path);

				                    $file_list[] = array('name'=>$file,'size'=>$size,'path'=> "../../".$file_path);
				      
				                }
			            	}
			                
			            }
			 
			        }
			        closedir($dh);
			    }
			}

			echo json_encode($file_list);
			exit;
		}
	}

}
