<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public $project_id;
	private $dashboard;

	public function __construct() {
        parent::__construct();

        $this->load->model('MDashboard');
        $this->dashboard = $this->MDashboard;

        $this->cek_aktif();
        $project_id = $this->session->userdata('project_id');
	}
	
	public function cek_aktif() {
		if ($this->session->userdata('admin_valid') == false && $this->session->userdata('admin_id') == "") {
			redirect('login');
		} 
	}

	public function index()
	{
		$this->cek_aktif();
		$data['page'] = 'dashboard';
		$data['totalNCClose'] = $this->dashboard->getSummaryNC('Closed');
		$data['totalNCOpen'] = $this->dashboard->getSummaryNC('Open');
		$data['totalNC'] = $this->dashboard->getSummaryNC('');

		$data['proyekWeek'] = $this->dashboard->getWeekProyek();
		$data['inspeksi'] = $this->dashboard->getInspeksi();
		
		$this->load->view('template/header', $data);
		$this->load->view('pages/dashboard', $data);
		$this->load->view('template/footer', $data);
	}

	public function assessment_supplier()
	{
		$data['page'] = '';
		$this->load->view('template/header');
		$this->load->view('pages/assesment/assesment_detail_supplier');
		$this->load->view('template/footer');
	}
	
	public function qsia_admin()
	{
		if ($this->session->userdata('admin_level') == "3"){
			$project = $this->db->get('mproyek')->result();
			
		}else{
			$project = $this->db->get_where('mproyek', array('id' => $this->session->userdata('project_id')))->result();
		}
		$data['project'] = $project;

		$data['page'] = 'qsia';
		$this->load->view('template/header', $data);
		$this->load->view('pages/qsia/index', $data);
		$this->load->view('template/footer', $data);
	}

	
	public function qsia_detail()
	{
		$data['page'] = '';
		$this->load->view('template/header', $data);
		$this->load->view('pages/qsia/qsia_detail', $data);
		$this->load->view('template/footer', $data);

	}
		
	public function observasi()
	{
		$data['page'] = 'observasi';
		if ($this->session->userdata('admin_level') == "3"){
			$project = $this->db->get('mproyek')->result();
			
		}else{
			$project = $this->db->get_where('mproyek', array('id' => $this->session->userdata('project_id')))->result();
		}
		
		$data['project'] = $project;
		$this->load->view('template/header', $data);
		$this->load->view('pages/observasi/index', $data);
		$this->load->view('template/footer', $data);
	}

	// user
	public function user()
	{
		$this->db->where('level_id !=', '3');
		$data['user'] = $this->db->get('m_users')->result();
		$data['page'] = 'personal';
		$this->load->view('template/header', $data);
		$this->load->view('pages/user/index', $data);
		$this->load->view('template/footer', $data);
	}
	// end user
	
	

	// profile
	public function profile()
	{
		$data['page'] = 'profile';
		$this->load->view('template/header', $data);
		$this->load->view('pages/profile/index', $data);
		$this->load->view('template/footer', $data);
	}
	
	public function general()
	{
		$data['page'] = 'general';

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
		
		$this->load->view('template/header', $data);
		$this->load->view('pages/general/index', $data);
		$this->load->view('template/footer', $data);
	}
	

	function upload()
	{
		if(isset($_FILES['file']['name'])){

		   /* Getting file name */
		   $filename = $_FILES['file']['name'];
		   $tipe = $this->input->post('tipe', TRUE);

		   /* Location */
		   $location = "uploads/general/".$filename;
		   $imageFileType = pathinfo($location,PATHINFO_EXTENSION);
		   $imageFileType = strtolower($imageFileType);

		   /* Valid extensions */
		   $valid_extensions = array("jpg","jpeg","png");

		   $response = 0;
		   /* Check file extension */
		   if(in_array(strtolower($imageFileType), $valid_extensions)) {
		      /* Upload file */
		      if(move_uploaded_file($_FILES['file']['tmp_name'],$location)){
		         $response = $location;
		         $num_rows = $this->db->get_where('m_setting', array('tipe' => $tipe))->num_rows();
		         if ($num_rows > 0 ){
		         	$this->db->where('tipe', $tipe);
		         	$this->db->update('m_setting', array('files' => $filename));
		         }else{
		         	$this->db->insert('m_setting', array('files' => $filename, 'tipe' => $tipe));
		         }
		      }
		   }

		   echo $response;
		   exit;
		}

		echo 0;
	}

}
