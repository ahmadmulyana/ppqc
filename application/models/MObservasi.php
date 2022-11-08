<?php defined('BASEPATH') OR exit('No direct script access allowed');

class MObservasi extends CI_Model {

	public function getData($project_id='')
	{
		$this->db->select('tr_observasi.*, m_pekerjaan.pekerjaan');
		$this->db->from('tr_observasi');
		$this->db->join('m_pekerjaan', 'tr_observasi.pekerjaan_id = m_pekerjaan.id');
		$this->db->where('tr_observasi.project_id', $project_id);
		return $this->db->get()->result();
	}
	
}