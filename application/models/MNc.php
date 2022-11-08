<?php defined('BASEPATH') OR exit('No direct script access allowed');

class MNc extends CI_Model {

	function report(){
        $query = $this->db->query("SELECT COUNT(*) total, MONTHNAME(tanggal) AS bulan FROM tr_nc WHERE status_nc='Closed' GROUP BY MONTH(tanggal)");
         
        if($query->num_rows() > 0){
            foreach($query->result() as $data){
                $hasil[] = $data;
            }
            return $hasil;
        }
    }

    function getRekapClose(){
        $query = $this->db->query("SELECT * FROM tr_nc_rekap_close WHERE tahun='".date('Y')."'");
         
        if($query->num_rows() > 0){
            foreach($query->result() as $data){
                $hasil[] = $data;
            }
            return $query->result();
        }
    }
	
    function getRekapOpen(){
        $query = $this->db->query("SELECT * FROM tr_nc_rekap_open WHERE tahun='".date('Y')."'");
         
        if($query->num_rows() > 0){
            foreach($query->result() as $data){
                $hasil[] = $data;
            }
            return $query->result();
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

    function getLevelNC(){
        $query = $this->db->query("SELECT * FROM m_level_nc");
         
        if($query->num_rows() > 0){
            foreach($query->result() as $data){
                $hasil[] = $data;
            }
            return $hasil;
        }
    }

    function getDisposisi(){
        $query = $this->db->query("SELECT * FROM m_disposisi");
         
        if($query->num_rows() > 0){
            foreach($query->result() as $data){
                $hasil[] = $data;
            }
            return $hasil;
        }
    }

    function getSumberNC(){
        $query = $this->db->query("SELECT * FROM m_sumber_nc");
         
        if($query->num_rows() > 0){
            foreach($query->result() as $data){
                $hasil[] = $data;
            }
            return $hasil;
        }
    }

    function getNCByProjectId($project_id){
        $query = $this->db->query("SELECT * FROM tr_nc WHERE project_id='".$project_id."'");
         
        if($query->num_rows() > 0){
            foreach($query->result() as $data){
                $hasil[] = $data;
            }
            return $hasil;
        }
    }

    function getTahun(){
        $query = $this->db->query("SELECT YEAR(tanggal) AS tahun FROM tr_nc GROUP BY YEAR(tanggal)");
         
        if($query->num_rows() > 0){
            return $query->result();
        }
    }

    function cariNC($type_nc, $tanggal_awal, $tanggal_akhir, $level_nc, $sumber_nc, $disposisi){

        $array = array(
            'type_nc' => $type_nc,
            'level_nc' => $level_nc,
            'sumber_nc' => $sumber_nc,
            'disposisi_pm' => $disposisi
        );

        $where ="";
        foreach ($array as $key => $value) {
            if ($value <> ""){
                $where .= $key ."='".$value."' OR ";
            }
        }

        if ($tanggal_awal !=null && $tanggal_akhir !=""){
            $where  .= " tanggal >= '".$tanggal_awal."' AND ";
            $where  .= " tanggal <= '".$tanggal_akhir."'";
        }else{
            $find = 'OR';
            $replace = ' ';
            $result = preg_replace(strrev("/$find/"),strrev($replace),strrev($where),1);
            $where = strrev($result);
        }

        if ($type_nc=="" && $level_nc=="" && $sumber_nc=="" && $disposisi=="" && $tanggal_awal =="" && $tanggal_akhir==""){
            $query = "SELECT * FROM tr_nc ".$where."";
        }else{
            $query = "SELECT * FROM tr_nc WHERE ".$where."";
        }
        
        return $this->db->query($query)->result();
    }

    function getPresentaseClose($bulan, $tahun, $project_id, $status){
        //Rumus TOTAL CLOSE/TOTAL NC
        //Rumus total close/total_nc * 100
        /*
        $where_jml = array('MONTH(tanggal)' => $bulan, 
            'YEAR(tanggal)' => $tahun, 
            'project_id' => $project_id
        );
        */

        $where_jml = array('YEAR(tanggal)' => $tahun, 
            'project_id' => $project_id
        );

        $where_close = array('MONTH(tanggal)' => $bulan, 
            'YEAR(tanggal)' => $tahun, 
            'project_id' => $project_id, 
            'status_nc' => $status);

        $total_nc=0;
        $total_close=0;

        $jml_nc = $this->db->get_where('tr_nc', $where_jml);
        if ($jml_nc->num_rows() > 0){
            $total_nc=$jml_nc->num_rows();
        }

        $jml_close = $this->db->get_where('tr_nc', $where_close);
        if ($jml_close->num_rows() > 0){
            $total_close=$jml_close->num_rows();
        }

        if ($total_nc==0 && $total_close==0){
            $prosentase = 0;
        }else{
            $prosentase = round(($total_close/$total_nc) * 100,2);
        }

        return $prosentase;
    }
}