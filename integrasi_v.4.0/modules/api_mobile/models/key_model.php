<?php
class Key_model extends CI_Model  {

	function __contsruct(){
        parent::Model();
    }
	
	public function get($select="", $where=""){
		$this->db->select($select);
		$this->db->from("keys");
		if ($where){$this->db->where($where);}
		$this->db->order_by('key_id','DESC');
		$this->db->limit(1);
		$query = $this->db->get();
		if ($query->num_rows() == 1){
			return $query->row();
		} else {
			return false;
		}
	}
}