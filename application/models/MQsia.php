<?php defined('BASEPATH') OR exit('No direct script access allowed');

class MQsia extends CI_Model {

	public function getDataSummary($nilai_id='', $tabul)
	{
		
		$sql_total_nilai = "SELECT SUM(nilai) AS total FROM tr_nilai_qsia a INNER JOIN m_nilai_item b ON a.nilai_item_id = b.id WHERE a.nilai_id='".$nilai_id."' AND a.nilai >=0 AND tabul='".$tabul."'";
		$hasil = $this->db->query($sql_total_nilai)->row()->total;

		if ($hasil){
			return $hasil;
		}else{
			return 0;
		}

	}

	public function getDataSummaryMaksimal($nilai_id='', $tabul)
	{
		
		$sql_total_nilai = "SELECT SUM(nilai_maksimal) AS total FROM tr_nilai_qsia a INNER JOIN m_nilai_item b ON a.nilai_item_id = b.id WHERE a.nilai_id='".$nilai_id."' AND a.nilai >=0 AND tabul='".$tabul."'";
		$hasil = $this->db->query($sql_total_nilai)->row()->total;

		if ($hasil){
			return $hasil;
		}else{
			return 0;
		}

	}

	public function getTotalMaksimal($project_id='', $tabul='')
	{
		
		$sql_total_nilai = "SELECT SUM(nilai_maksimal) AS total FROM tr_nilai_qsia a WHERE a.project_id='".$project_id."' AND a.nilai >=0";
		$hasil = $this->db->query($sql_total_nilai)->row()->total;

		if ($hasil){
			return $hasil;
		}else{
			return 0;
		}

	}

	public function getData($nilai_id='', $project_id='', $tabul='')
	{
		
		$hasil = $this->db->query("SELECT a.id, a.nilai, a.nilai_maksimal, b.item_penilaian FROM tr_nilai_qsia a INNER JOIN m_nilai_item b ON a.nilai_item_id = b.id WHERE a.nilai_id='".$nilai_id."' AND a.project_id='".$project_id."' AND tabul='".$tabul."'")->result();

		if ($hasil){
			return $hasil;
		}else{
			return 0;
		}

	}
	
}

