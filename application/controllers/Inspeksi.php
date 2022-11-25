<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Inspeksi extends CI_Controller {

	function __construct() {
        parent::__construct();
        $this->load->model('MInspeksi');
        $this->cek_aktif();
	}
	
	public function index()
	{

		$user_id = $this->session->userdata('admin_id');
		$data['page'] = 'inspeksi';
		
		if ($this->session->userdata('admin_level') == "3"){
			$project = $this->db->get('mproyek')->result();
			
		}else{
			$project = $this->db->get_where('mproyek', array('id' => $this->session->userdata('project_id')))->result();
		}

		$data['project'] = $project;
		$data['inspeksi'] = $this->db->get_where('tr_inspeksi', array('user_id' => $user_id))->result();
		
		$data['pm'] = $this->db->get_where('musers', array('level_id' => '2'))->result();
		$data['mwt'] = $this->db->get_where('tr_mwt', array('user_id' => $user_id))->result();

		$this->load->view('template/header', $data);
		$this->load->view('pages/inspeksi/index', $data);
		$this->load->view('template/footer', $data);
	}

	public function cek_aktif() {
		if ($this->session->userdata('admin_valid') == false && $this->session->userdata('admin_id') == "") {
			redirect('login');
		} 
	}
	
	public function save() {

		$project = $this->input->post('project', TRUE);
		$tanggal = $this->input->post('tanggal', TRUE);
		$keterangan = $this->input->post('keterangan', TRUE);

		$user_id = $this->session->userdata('admin_id');

		
		$hasil = $this->db->query("INSERT INTO tr_inspeksi (project_id, tanggal, keterangan, user_id) 
				VALUES ('".$this->session->userdata('project_id')."', '".$tanggal."', '".$keterangan."','".$user_id."')");
		
		if ($hasil){
			redirect('inspeksi');
		}
		
	}

	public function saveMWT() {

		$project = $this->input->post('project', TRUE);
		$tanggal = $this->input->post('tanggal', TRUE);
		$keterangan = $this->input->post('keterangan', TRUE);

		$user_id = $this->session->userdata('admin_id');
		$pm_id = $this->input->post('pm', TRUE);
		
		$hasil = $this->db->query("INSERT INTO tr_mwt (project_id, tanggal, keterangan, user_id, pm_id) 
				VALUES ('".$this->session->userdata('project_id')."', '".$tanggal."', '".$keterangan."','".$user_id."','".$pm_id."')");
		
		if ($hasil){
			redirect('inspeksi');
		}
		
	}

	public function createExcel() {

		$fileName = "Inspeksi_".date('Ymd')."_".rand().".xlsx";
		$employeeData = $this->MInspeksi->inspeksiList();
		$spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'DAFTAR INSPEKSI');
		$sheet->setCellValue('A3', 'No');
        $sheet->setCellValue('B3', 'Tanggal');
        $sheet->setCellValue('C3', 'Keterangan');
        $sheet->setCellValue('D3', 'Type');
		$sheet->setCellValue('E3', 'Project Id');
        $rows = 4;
        $no=1;
        foreach ($employeeData as $val){
            $sheet->setCellValue('A' . $rows, "$no");
            $sheet->setCellValue('B' . $rows, $val['tanggal']);
            $sheet->setCellValue('C' . $rows, $val['keterangan']);
            $sheet->setCellValue('D' . $rows, $val['type_inspeksi']);
			$sheet->setCellValue('E' . $rows, $val['project_id']);
            $rows++;
            $no++;
        } 
        $writer = new Xlsx($spreadsheet);
		$writer->save("uploads/excel/".$fileName);
		header("Content-Type: application/vnd.ms-excel");
        redirect(base_url()."/uploads/excel/".$fileName);              
    } 

    public function validasi()
	{
		$data['page'] = 'validasi';

		$sql ="SELECT a.*, b.nama_lengkap, c.nama_proyek FROM tr_inspeksi a INNER JOIN m_users b ON a.user_id = b.id INNER JOIN mproyek c ON a.project_id = c.id";
		$data['data'] = $this->db->query($sql)->result();
		$this->load->view('template/header', $data);
		$this->load->view('pages/inspeksi/validasi', $data);
		$this->load->view('template/footer', $data);
	}  
	
}
