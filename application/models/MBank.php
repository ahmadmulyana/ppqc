<?php defined('BASEPATH') OR exit('No direct script access allowed');

class MBank extends CI_Model {

	function getData(){
        $this->db->select('tr_bank_data.*, mproyek.nama_proyek, m_pekerjaan.pekerjaan, m_kriteria_penilaian.kriteria');
        $this->db->from('tr_bank_data');
        $this->db->join('mproyek', 'mproyek.id = tr_bank_data.project_id');
        $this->db->join('m_pekerjaan', 'm_pekerjaan.id = tr_bank_data.pekerjaan_id');
        $this->db->join('m_kriteria_penilaian', 'm_kriteria_penilaian.id = tr_bank_data.kriteria_penilaian_id');
        $query = $this->db->get()->result();
        return $query;
    }
	
    function getDataByPekerjaan($id){
        $this->db->select('tr_bank_data.*, mproyek.nama_proyek, m_pekerjaan.pekerjaan, m_kriteria_penilaian.kriteria');
        $this->db->from('tr_bank_data');
        $this->db->join('mproyek', 'mproyek.id = tr_bank_data.project_id');
        $this->db->join('m_pekerjaan', 'm_pekerjaan.id = tr_bank_data.pekerjaan_id');
        $this->db->join('m_kriteria_penilaian', 'm_kriteria_penilaian.id = tr_bank_data.kriteria_penilaian_id');
        $this->db->where('tr_bank_data.pekerjaan_id', $id);
        $query = $this->db->get()->result();
        return $query;
    }

    function getDataById($id){
        $query = $this->db->query("SELECT * FROM tr_bank_data WHERE id='".$id."'");
        
        if($query->num_rows() > 0){
            return $query->row();
        }
    }

    function getTypeNC(){
        $query = $this->db->query("SELECT * FROM m_type_nc");
         
        if($query->num_rows() > 0){
            foreach($query->result() as $data){
                $hasil[] = $data;
            }
            return $hasil;
        }
    }
}