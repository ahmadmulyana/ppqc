<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Css extends CI_Controller {

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
		
		if ($this->session->userdata('admin_level') == "3") { 
			$data['page'] = 'css';
		
			if ($this->session->userdata('admin_level') == "3"){
				$project = $this->db->get('mproyek')->result();
				
			}else{
				$project = $this->db->get_where('mproyek', array('id' => $this->session->userdata('project_id')))->result();
			}

			$data['project'] = $project;
			$data['item_survey'] = $this->db->query("SELECT survey FROM m_survey")->result();
			
			$data['addjs'] = $this->load->view('pages/css/cssjs','',true);
			$this->load->view('template/header', $data);
			$this->load->view('pages/css/index', $data);
			$this->load->view('template/footer', $data);
		}else{
			$this->detail();
		}
	}

	public function saveData()
	{
		
		$project_id = $this->input->post('project_id');
		$proses_kerja1 = $this->input->post('proses_kerja1');
		$proses_kerja2 = $this->input->post('proses_kerja2');

		$user_id = $this->session->userdata('admin_id');

		$cek_data = $this->db->get_where('tr_css', array('project_id'=>$project_id))->num_rows();
		if ($cek_data > 0 ) {

			$arr = array(
				'pengelolaan_proses_kerja_50' => $proses_kerja1,
				'pengelolaan_proses_kerja_100' => $proses_kerja2
			);

			$this->db->where('project_id', $project_id);
			$result =  $this->db->update('tr_css', $arr);
		}else{

			$arr = array(
				'project_id' => $project_id,
				'pengelolaan_proses_kerja_50' => $proses_kerja1,
				'pengelolaan_proses_kerja_100' => $proses_kerja2,
				'user_id' => $user_id
			);

			$result = $this->db->insert('tr_css', $arr);	
		}

		j($result);
	}

	
	public function detail()
	{
		
		if ($this->session->userdata('admin_level') == "3") { 
			$project_id = $this->uri->segment(3, 0);
		}else{
			$project_id = $this->session->userdata('project_id');
		}

		$data['nama_project'] = $this->db->get_where('mproyek', array('id'=>$project_id))->row()->nama_proyek;

		$this->session->set_userdata('nama_project', $data['nama_project']);
		$this->session->set_userdata('project_id', $project_id);

		$project = $this->db->get_where('tr_css', array('project_id'=>$project_id))->row();
		$data['project'] = $project;

		//bim_tbl_3d_model progress
		$rprogress = $this->db->query("SELECT realisasi FROM mproyek_progress  WHERE proyek_id ='".$project_id."' ORDER BY id DESC limit 1")->row();

		if ($rprogress){
			$data['progress'] = $rprogress->realisasi;
		}else{
			$data['progress'] = 0;
		}
		
		$cek_data = $this->db->get_where('tr_css_detail', array('project_id' => $project_id));
		if ($cek_data->num_rows() <= 0){
			$row = $this->db->get('m_survey');
			foreach ($row->result() as $r) {
				$a = array(
					'project_id' => $project_id,
					'survey_id' => $r->id,
				);

				$this->db->insert('tr_css_detail', $a);
			}

			$SQL = "SELECT a.*, b.survey FROM tr_css_detail a INNER JOIN m_survey b ON a.survey_id = b.id WHERE a.project_id='".$project_id."'";
			$data['survey'] = $this->db->query($SQL)->result();
		}else{
			$SQL = "SELECT a.*, b.survey FROM tr_css_detail a INNER JOIN m_survey b ON a.survey_id = b.id WHERE a.project_id='".$project_id."'";
			$data['survey'] = $this->db->query($SQL)->result();
		}

		$data['item_survey'] = $this->db->query("SELECT survey FROM m_survey")->result();

		$hasil = $this->db->query("SELECT * FROM tr_css_files WHERE project_id='".$project_id."'");
		
		if ($hasil->num_rows() >0){
			$data['hari'] = $hasil->row()->tanggal;
		}else{
			$data['hari'] = date('Y-m-d h:m:s');
		}
		
		$data['files'] = $hasil->result();

		$data['page'] = 'css_detail';
		$data['addjs'] = $this->load->view('pages/css/cssjs','',true);
		$this->load->view('template/header', $data);
		$this->load->view('pages/css/css_detail', $data);
		$this->load->view('template/footer', $data);

	}

	public function getChart(){
      	$project_id = $this->session->userdata('project_id');

      	$cek_data = $this->db->get_where('tr_css_detail', array('project_id' => $project_id));
		if ($cek_data->num_rows() <= 0){
			$row = $this->db->get('m_survey');
			foreach ($row->result() as $r) {
				$a = array(
					'project_id' => $project_id,
					'survey_id' => $r->id,
				);

				$this->db->insert('tr_css_detail', $a);
			}

			$SQL = "SELECT a.*, b.survey FROM tr_css_detail a INNER JOIN m_survey b ON a.survey_id = b.id WHERE a.project_id='".$project_id."'";
			$survey = $this->db->query($SQL)->result();
		}else{
			$SQL = "SELECT a.*, b.survey FROM tr_css_detail a INNER JOIN m_survey b ON a.survey_id = b.id WHERE a.project_id='".$project_id."'";
			$survey = $this->db->query($SQL)->result();
		}

		foreach($survey as $result){
            $bulan[] = $result->survey; 
            $value50[] = (float) $result->nilai50; 
            $value100[] = (float) $result->nilai100;

            $response['bulan'] = $bulan;
			$response['value50'] = $value50;
			$response['value100'] = $value100;
        }

        echo json_encode($response);

    }

	public function update(){
		if(isset($_POST['field']) && isset($_POST['value']) && isset($_POST['id'])){
		    $field = $_POST['field']; 
		    $value = $_POST['value']; 
		    $editid = $_POST['id'];
		    $tanggal = date('Y-m-d');
		    
		    $query = "UPDATE tr_css_detail SET ".$field."='".$value."', tanggal ='".$tanggal."' WHERE id=".$editid;
		    $this->db->query($query);
		    
		    echo 1;
		}else{
		    echo 0;
		}

	}

	public function uploadFile(){

		$type_css = $this->input->post('type_css', TRUE);

		$liveflname = $_FILES['file']['name'];
		
		$file = preg_replace('/\s+/', '_', $_FILES['file']['name']);

		$kaboom = explode(".",$liveflname);
      	$fileExt = end($kaboom);

      	$db_file_name = uniqid().rand(100000000000,999999999999).".".$fileExt;

      	$file_places = 'uploads/css/'.$db_file_name;

      	$fl_ext = pathinfo($file_places, PATHINFO_EXTENSION);
		$fl_ext = strtolower($fl_ext);

		$image_ext = array("jpg","png","jpeg","gif","pdf","xlsx","xls");

		$results = 0;
		if(in_array($fl_ext,$image_ext)){

		  if(move_uploaded_file($_FILES['file']['tmp_name'],$file_places)){
		  	$project_id = $this->input->post('project_id', TRUE);
		  	$nama_file = $this->input->post('nama_file', TRUE);

		  	if ($type_css==2){
		  		$cek_data = $this->db->get_where('tr_css_files', array('project_id'=>$project_id));
		  		if ($cek_data->num_rows()==1){

		  			$arr_temuan = array(
						'nama_file_nilai' => $file,
						'files_nilai' => $db_file_name,
						'tanggal_nilai' => date("Y-m-d H:i:s"),
						'lengkap' => '2'
					);	

					$this->db->where('id', $cek_data->row()->id);
					$this->db->update('tr_css_files', $arr_temuan);
		  		}else{
		  			$arr_temuan = array(
						'nama_file' => $file,
						'files' => $db_file_name,
						'project_id'=> $project_id,
						'tanggal' => date("Y-m-d H:i:s"),
						'type_css' => '2'
					);	

					$this->db->insert('tr_css_files', $arr_temuan);
		  		}

		  		$results = 1;
		  	}

		  	/*
			$cek_data = $this->db->get_where('tr_css_files', array('project_id'=>$project_id));
			if ($cek_data->num_rows()==1){

				if ($type_css==2){
					$arr_temuan = array(
						'nama_file' => $file,
						'files' => $db_file_name,
						'project_id'=> $project_id,
						'tanggal' => date("Y-m-d H:i:s"),
						'type_css' => '2'
					);	

					$this->db->insert('tr_css_files', $arr_temuan);
				}else{
					$arr_temuan = array(
						'nama_file_nilai' => $file,
						'files_nilai' => $db_file_name,
						'tanggal_nilai' => date("Y-m-d H:i:s"),
						'lengkap' => '2'
					);	

					$this->db->where('id', $cek_data->row()->id);
					$this->db->update('tr_css_files', $arr_temuan);
				}
				

				$results = 1;

			}else{
				if ($type_css==1){
					$arr_temuan = array(
						'nama_file' => $file,
						'files' => $db_file_name,
						'project_id'=> $project_id,
						'tanggal' => date("Y-m-d H:i:s")
					);	

					$this->db->insert('tr_css_files', $arr_temuan);
				}else{
					$arr_temuan = array(
						'nama_file' => $file,
						'files' => $db_file_name,
						'project_id'=> $project_id,
						'tanggal' => date("Y-m-d H:i:s"),
						'type_css' => '2'
					);	

					$this->db->insert('tr_css_files', $arr_temuan);
				}
				
		    	$results = 1;
			}
			*/
			
		  }
		}

		echo $results;
	}

	public function getChartCSS50(){
    	$default=0;
      	$project_id = $this->session->userdata('project_id');
      	$tahun = $this->input->post('tahun', true);

      	if (empty($tahun)){
      		$tahun =date('Y');
      	}

      	for ($i = 1; $i <= 12; $i++){
	        $bulan[] = getBulan($i); 

	        /*
	        $cekTotalClose = $this->getSummary($i, $tahun, $project_id,'Closed');
	        $presentase = $this->nc->getPresentaseClose($i, $tahun, $project_id,'Closed');
	        
	        $value[] = (float) $cekTotalClose; 
	        $value_presentase[] = (float) $presentase;
	        $cekTotalOpen = $this->getSummary($i, $tahun, $project_id,'Open');
	        $value_open[] = (float) $cekTotalOpen; 

	        */

	        $cekTotal = $this->getSummary50($i, $tahun);
			$value[] = (float) $cekTotal; 
	        //$value_presentase[] = (float) $i;
	       // $cekTotalOpen = $this->getSummary($i, $tahun, $project_id,'Open');
	       // $value_open[] = (float) $cekTotalOpen; 

	        $response['bulan'] = $bulan;
			$response['value'] = $value;
			//$response['presentase'] = $value_presentase;
			//$response['value_open'] = $value_open;
			

      	}
      	echo json_encode($response);
    }

    public function getChartCSS100(){
    	$default=0;
      	$project_id = $this->session->userdata('project_id');
      	$tahun = $this->input->post('tahun', true);

      	if (empty($tahun)){
      		$tahun =date('Y');
      	}

      	for ($i = 1; $i <= 12; $i++){
	        $bulan[] = getBulan($i); 
	        $cekTotal = $this->getSummary100($i, $tahun);
			$value[] = (float) $cekTotal; 
	        
	        $response['bulan'] = $bulan;
			$response['value'] = $value;
      	}
      	echo json_encode($response);
    }

    function getSummary50($bulan, $tahun) {

    	//https://jsfiddle.net/BlackLabel/fdw5pran
        $this->db->select('AVG(nilai50) as total');
        $this->db->from('tr_css_detail as a');
        $this->db->where('MONTH(a.tanggal)',$bulan);
        $this->db->where('YEAR(a.tanggal)',$tahun);
       // $this->db->where('project_id',$project_id);
       // $this->db->where('status_nc',$status);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row()->total; 
            } else {
            return 0;
        }
    }

    function getSummary100($bulan, $tahun) {

    	//https://jsfiddle.net/BlackLabel/fdw5pran
        $this->db->select('AVG(nilai100) as total');
        $this->db->from('tr_css_detail as a');
        $this->db->where('MONTH(a.tanggal)',$bulan);
        $this->db->where('YEAR(a.tanggal)',$tahun);
       // $this->db->where('project_id',$project_id);
       // $this->db->where('status_nc',$status);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row()->total; 
            } else {
            return 0;
        }
    } 
	
}
