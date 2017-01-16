<?php
class Unit_organisasi_model extends CI_Model  {
	
	function insert($data){
       return $this->db->insert("unit_organisasi", $data);
	}
	
	function update($data, $kode){
		return $this->db->update("unit_organisasi", $data, array('unit_organisasi_kode' => $kode));	
	}
	
	function delete($kode){
		return $this->db->delete("unit_organisasi", array('unit_organisasi_kode' => $kode));	
	}
	
	public function get($select="", $where=""){
		$this->db->select($select);
		$this->db->from("unit_organisasi");
		$this->db->join("urusan", "unit_organisasi.urusan_kode=urusan.urusan_kode", "left");
		$this->db->join("urusan_unit", "unit_organisasi.urusan_unit_kode=urusan_unit.urusan_unit_kode", "left");
		$this->db->join("urusan_sub", "unit_organisasi.urusan_sub_kode=urusan_sub.urusan_sub_kode", "left");
		if ($where){$this->db->where($where);}
		$this->db->order_by('unit_organisasi.unit_organisasi_kode','DESC');
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
		$this->db->from("unit_organisasi");
		$this->db->join("urusan", "unit_organisasi.urusan_kode=urusan.urusan_kode", "left");
		$this->db->join("urusan_unit", "unit_organisasi.urusan_unit_kode=urusan_unit.urusan_unit_kode", "left");
		$this->db->join("urusan_sub", "unit_organisasi.urusan_sub_kode=urusan_sub.urusan_sub_kode", "left");
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
		$this->db->select("unit_organisasi_kode");
		$this->db->from("unit_organisasi");
		$this->db->join("urusan", "unit_organisasi.urusan_kode=urusan.urusan_kode", "left");
		$this->db->join("urusan_unit", "unit_organisasi.urusan_unit_kode=urusan_unit.urusan_unit_kode", "left");
		$this->db->join("urusan_sub", "unit_organisasi.urusan_sub_kode=urusan_sub.urusan_sub_kode", "left");
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