<?php
class Bidang_indikator_model extends CI_Model  {

	function __contsruct(){
        parent::Model();
    }
	
	function insert($data){
       return $this->db->insert("bidang_indikator", $data);
	}
	
	function update($data, $kode){
		return $this->db->update("bidang_indikator", $data, array('kode' => $kode));	
	}
	
	function delete($kode){
		return $this->db->delete("bidang_indikator", array('kode' => $kode));	
	}
	
	public function get($select="", $where=""){
		$this->db->select($select);
		$this->db->from("bidang_indikator");
		$this->db->join("tipe", "bidang_indikator.tipe=tipe.tipe_kode", "left");
		$this->db->join("urusan", "bidang_indikator.urusan=urusan.kode", "left");
		$this->db->join("bidang_unit", "bidang_indikator.bidang_unit=bidang_unit.kode", "left");
		$this->db->join("bidang_sub", "bidang_indikator.bidang_sub=bidang_sub.kode", "left");
		if ($where){$this->db->where($where);}
		$this->db->order_by('bidang_indikator.kode','DESC');
		$this->db->limit(1);
		$query = $this->db->get();
		if ($query->num_rows() == 1){
			return $query->row();
		} else {
			return false;
		}
	}
	
	public function grid_all($select="", $sidx="", $sord="", $limit="", $start="", $where="", $like="", $group=""){
		$this->db->select($select);
		$this->db->from("bidang_indikator");
		$this->db->join("tipe", "bidang_indikator.tipe=tipe.tipe_kode", "left");
		$this->db->join("urusan", "bidang_indikator.urusan=urusan.kode", "left");
		$this->db->join("bidang_unit", "bidang_indikator.bidang_unit=bidang_unit.kode", "left");
		$this->db->join("bidang_sub", "bidang_indikator.bidang_sub=bidang_sub.kode", "left");
		if ($where){$this->db->where($where, NULL, FALSE);}
		if ($like){
			foreach($like as $key => $value){ 
			$this->db->like($key, $value); 
			}
		}
		if ($group){$this->db->group_by($group);}
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
		$this->db->select("bidang_indikator.kode");
		$this->db->join("tipe", "bidang_indikator.tipe=tipe.tipe_kode", "left");
		$this->db->join("urusan", "bidang_indikator.urusan=urusan.kode", "left");
		$this->db->join("bidang_unit", "bidang_indikator.bidang_unit=bidang_unit.kode", "left");
		$this->db->join("bidang_sub", "bidang_indikator.bidang_sub=bidang_sub.kode", "left");
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