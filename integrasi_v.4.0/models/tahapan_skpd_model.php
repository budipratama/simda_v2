<?php
class Tahapan_skpd_model extends CI_Model  {

	function __contsruct(){
        parent::Model();
    }
	
	function insert($data){
       return $this->db->insert("tahapan_skpd", $data);
	}
	
	function update($data, $kode){
		return $this->db->update("tahapan_skpd", $data, array('kode' => $kode));	
	}
	
	function delete($kode){
		return $this->db->delete("tahapan_skpd", array('kode' => $kode));	
	}
	
	public function get($select="", $where=""){
		$this->db->select($select);
		$this->db->from("tahapan_skpd");
		if ($where){$this->db->where($where);}
		$this->db->order_by('kode','DESC');
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
		$this->db->from("tahapan_skpd");
		$this->db->join("skpd", "tahapan_skpd.skpd_kode=skpd.skpd_kode", "left");
		$this->db->join("tahapan", "tahapan_skpd.tahapan_kode=tahapan.kode", "left");
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
		$this->db->from("tahapan_skpd");
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