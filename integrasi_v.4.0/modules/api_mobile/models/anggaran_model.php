<?php
class Anggaran_model extends CI_Model  {

	function __contsruct(){
        parent::Model();
    }
	
	function insert($table="anggaran", $data){
       return $this->db->insert($table, $data);
	}
	
	function update($table="anggaran", $data, $where){
		return $this->db->update($table, $data, $where);	
	}
	
	function delete($table="anggaran", $where){
		return $this->db->delete($table, $where);	
	}
		
	public function grid_all($select="", $sidx="", $sord="", $limit="", $start="", $where="", $like="", $group_by=""){
		$this->db->select($select);
		$this->db->from("anggaran");
		if ($where){$this->db->where($where);}
		if ($like){
			foreach($like as $key => $value){ 
			$this->db->like($key, $value); 
			}
		}
		if ($group_by){$this->db->group_by($group_by);}
		if ($sidx && $sord) {$this->db->order_by($sidx,$sord);}
		if (!empty($limit)) {$this->db->limit($limit,$start);}
		$query = $this->db->get();
		if ($query->num_rows() > 0){
			return $query->result();
		} else {
			return false;
		}
	}
	
	public function grid_bl($select="", $sidx="", $sord="", $limit="", $start="", $where="", $like="", $group_by=""){
		$this->db->select($select);
		$this->db->from("anggaran");
		$this->db->join("anggaran_bl", "anggaran.kode=anggaran_bl.anggaran_kode", "left");
		if ($where){$this->db->where($where);}
		if ($like){
			foreach($like as $key => $value){ 
			$this->db->like($key, $value); 
			}
		}
		if ($group_by){$this->db->group_by($group_by);}
		if ($sidx && $sord) {$this->db->order_by($sidx,$sord);}
		if (!empty($limit)) {$this->db->limit($limit,$start);}
		$query = $this->db->get();
		if ($query->num_rows() > 0){
			return $query->result();
		} else {
			return false;
		}
	}
	
	public function grid_btl($select="", $sidx="", $sord="", $limit="", $start="", $where="", $like="", $group_by=""){
		$this->db->select($select);
		$this->db->from("anggaran");
		$this->db->join("anggaran_btl", "anggaran.kode=anggaran_btl.anggaran_kode", "left");
		if ($where){$this->db->where($where);}
		if ($like){
			foreach($like as $key => $value){ 
			$this->db->like($key, $value); 
			}
		}
		if ($group_by){$this->db->group_by($group_by);}
		if ($sidx && $sord) {$this->db->order_by($sidx,$sord);}
		if (!empty($limit)) {$this->db->limit($limit,$start);}
		$query = $this->db->get();
		if ($query->num_rows() > 0){
			return $query->result();
		} else {
			return false;
		}
	}
}