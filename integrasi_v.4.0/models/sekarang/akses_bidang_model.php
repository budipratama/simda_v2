<?php
class Akses_bidang_model extends CI_Model  {

	function __contsruct(){
        parent::Model();
    }
	
	function insert($data){
       return $this->db->insert("akses_bidang", $data);
	}
	
	function update($data, $kode){
		return $this->db->update("akses_bidang", $data, array('akses_bidang_kode' => $kode));	
	}
	
	function delete($kode){
		return $this->db->delete("akses_bidang", array('akses_bidang_kode' => $kode));	
	}
	
	public function get($select="", $where=""){
		$this->db->select($select);
		$this->db->from("akses_bidang");
		$this->db->join("skpd", "akses_bidang.skpd_kode=skpd.skpd_kode", "left");
		$this->db->join("admin_level", "akses_bidang.admin_level_kode=admin_level.admin_level_kode", "left");
		if ($where){$this->db->where($where);}
		$this->db->order_by('akses_bidang.akses_bidang_kode','DESC');
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
		$this->db->from("akses_bidang");
		$this->db->join("skpd", "akses_bidang.skpd_kode=skpd.skpd_kode", "left");
		$this->db->join("admin_level", "akses_bidang.admin_level_kode=admin_level.admin_level_kode", "left");
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
		$this->db->select("akses_bidang_kode");
		$this->db->from("akses_bidang");
		$this->db->join("skpd", "akses_bidang.skpd_kode=skpd.skpd_kode", "left");
		$this->db->join("admin_level", "akses_bidang.admin_level_kode=admin_level.admin_level_kode", "left");
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