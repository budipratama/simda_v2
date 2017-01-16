<?php
class Akun_akrual_model extends CI_Model  {

	function __contsruct(){
        parent::Model();
    }
	
	public function get_akun($id){
       $this->db->select("kode, kd_akrual_1 as no, nm_akrual_1 as akun");
        $this->db->from('ms_akrual_1');
        $this->db->where('kode',$id);
        $query = $this->db->get();
         if($query->num_rows() != 1){
            return FALSE;
        }
        return $query->row();
    }
	
	public function get_list(){
		$this->db->select("kode, kd_akrual_1 as no, nm_akrual_1 as akun");
        $query = $this->db->get('ms_akrual_1');
        return $query->result();
    }
	
}