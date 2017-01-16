<?php
class Indikator_model extends CI_Model  {

	function __contsruct(){
        parent::Model();
    }
	
	function insert($data){
       return $this->db->insert("indikator", $data);
	}
	
	function update($data, $kode){
		return $this->db->update("indikator", $data, array('kode' => $kode));	
	}
	
	function delete($kode){
		return $this->db->delete("indikator", array('kode' => $kode));	
	}
	
	public function get($select="", $where=""){
		$this->db->select($select);
		$this->db->from("indikator");
		$this->db->join("sasaran", "indikator.sasaran=sasaran.kode", "left");
		$this->db->join("tujuan", "sasaran.tujuan=tujuan.kode", "left");
		if ($where){$this->db->where($where);}
		$this->db->order_by('indikator.kode','DESC');
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
		$this->db->from("indikator");
		$this->db->join("sasaran", "indikator.sasaran=sasaran.kode", "left");
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
		$this->db->select("kode");
		$this->db->from("indikator");
		$this->db->join("sasaran", "indikator.sasaran=sasaran.kode", "left");
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