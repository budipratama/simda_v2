<?php
class Tahun_model extends CI_Model  {

	function __contsruct(){
        parent::Model();
    }
	
	function insert($data){
       return $this->db->insert("tahun", $data);
	}
	
	function update($data, $tahun){
		return $this->db->update("tahun", $data, array('tahun' => $tahun));	
	}
	
	function delete($tahun){
		return $this->db->delete("tahun", array('tahun' => $tahun));	
	}
	
	public function get($select="", $where=""){
		$this->db->select($select);
		$this->db->from("tahun");
		if ($where){$this->db->where($where);}
		$this->db->order_by('tahun.tahun','DESC');
		$this->db->limit(1);
		$query = $this->db->get();
		if ($query->num_rows() == 1){
			return $query->row();
		} else {
			return false;
		}
	}
	
	public function grid_all($select="", $sidx="", $sord="", $limit="", $start="", $where="", $like=""){
		$this->db->select($select);
		$this->db->from("tahun");
		if ($where){$this->db->where($where);}
		if ($like){
			foreach($like as $key => $value){ 
			$this->db->like($key, $value); 
			}
		}
		if ($sidx && $sord) {$this->db->order_by($sidx,$sord);}
		if (!empty($limit)) {$this->db->limit($limit,$start);}
		$query = $this->db->get();
		if ($query->num_rows() > 0){
			return $query->result();
		} else {
			return false;
		}
	}
	
	public function count_all($where="", $like=""){
		$this->db->select("tahun");
		$this->db->from("tahun");
		if ($where){$this->db->where($where);}
		if ($like){
			foreach($like as $key => $value){ 
			$this->db->like($key, $value); 
			}
		}
		$query = $this->db->get();
		return $query->num_rows();
	}
}