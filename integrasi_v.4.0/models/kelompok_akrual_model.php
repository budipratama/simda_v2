<?php
class Kelompok_akrual_model extends CI_Model  {

	function __contsruct(){
        parent::Model();
    }
	
	public function get_kelompok($id){
		$this->db->select('ms_akrual_2.kode as kelompok, ms_akrual_2.kd_akrual_2 as no, ms_akrual_1.kode as akun');
        $this->db->from('ms_akrual_2');
		$this->db->join('ms_akrual_1', 'ms_akrual_1.kode = ms_akrual_2.kd_akrual_1');
        $this->db->where('ms_akrual_2.kode',$id);
        $query = $this->db->get();
			if($query->num_rows() != 1){
				return FALSE;
        }
        return $query->row();
    }
	
	public function get_list($id){
        $this->db->select('ms_akrual_2.kode as list_id, ms_akrual_2.kd_akrual_2 as no, ms_akrual_2.nm_akrual_2 as kelompok');
        $this->db->from('ms_akrual_2');
		$this->db->join('ms_akrual_1', 'ms_akrual_1.kode = ms_akrual_2.kd_akrual_1');
        $this->db->where('ms_akrual_2.kd_akrual_1',$id);
        $query = $this->db->get();
			if($query->num_rows() < 1){
				return FALSE;
        }
        return $query->result();        
    }
	
}