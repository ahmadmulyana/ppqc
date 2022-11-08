<?php defined('BASEPATH') OR exit('No direct script access allowed');

class MDashboard extends CI_Model {

	function getSummaryNC($status=null){
        if ($status==null){
            $query = $this->db->query("SELECT COUNT(*) total FROM tr_nc");
        }else{
            $query = $this->db->query("SELECT COUNT(*) total FROM tr_nc WHERE status_nc='".$status."'");
        }
        
        if($query->num_rows() > 0){
            return $query->row()->total;
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

    function getWeekProyek(){
        $query = $this->db->query("SELECT * FROM mproyek WHERE YEARWEEK(periode_start_date)=YEARWEEK(NOW())");

        if($query->num_rows() > 0){
            return $query->result();
        }
        
    }

    function getInspeksi(){
        $user_id = $this->session->userdata('admin_id');
        if ($this->session->userdata('admin_level')=="3"){
            $query = $this->db->query("SELECT * FROM tr_inspeksi");
            if($query->num_rows() > 0){
                return $query->result();
            }
        }else{
            $query = $this->db->query("SELECT * FROM tr_inspeksi WHERE user_id='".$user_id."'");
            if($query->num_rows() > 0){
                return $query->result();
            }
        }
        
    }

    function getCSS(){
        $query = $this->db->query("SELECT * FROM mproyek_progress WHERE tahun=YEAR(NOW())");
        if($query->num_rows() > 0){
            return $query->result();
        }
    }
}