<?php
class Indikator_skpd_model extends CI_Model  {

	function __contsruct(){
        parent::Model();
    }
	
	function insert($data){
       return $this->db->insert("skpd_indikator", $data);
	}
	
	function update($data, $kode){
		return $this->db->update("skpd_indikator", $data, array('kode' => $kode));	
	}
	
	function delete($kode){
		return $this->db->delete("skpd_indikator", array('kode' => $kode));	
	}
	
	public function get($select="", $where=""){
		$this->db->select($select);
		$this->db->from("skpd_indikator");
		$this->db->join("visi", "skpd_indikator.visi=visi.kode", "left");
		$this->db->join("misi", "skpd_indikator.misi=misi.kode", "left");
		$this->db->join("tujuan", "skpd_indikator.tujuan=tujuan.kode", "left");
		$this->db->join("urusan", "skpd_indikator.urusan=urusan.kode", "left");
		$this->db->join("sasaran", "skpd_indikator.sasaran=sasaran.kode", "left");
		$this->db->join("indikator", "skpd_indikator.indikator=indikator.kode", "left");
		$this->db->join("program", "skpd_indikator.program=program.kode", "left");
		$this->db->join("skpd", "skpd_indikator.skpd=skpd.skpd_kode", "left");
		if ($where){$this->db->where($where);}
		$this->db->order_by('skpd_indikator.kode','DESC');
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
		$this->db->from("skpd_indikator");
		$this->db->join("visi", "skpd_indikator.visi=visi.kode", "left");
		$this->db->join("misi", "skpd_indikator.misi=misi.kode", "left");
		$this->db->join("tujuan", "skpd_indikator.tujuan=tujuan.kode", "left");
		$this->db->join("urusan", "skpd_indikator.urusan=urusan.kode", "left");
		$this->db->join("sasaran", "skpd_indikator.sasaran=sasaran.kode", "left");
		$this->db->join("indikator", "skpd_indikator.indikator=indikator.kode", "left");
		$this->db->join("program", "skpd_indikator.program=program.kode", "left");
		$this->db->join("skpd", "skpd_indikator.skpd=skpd.skpd_kode", "left");
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
		$this->db->select("skpd_indikator.kode");
		$this->db->from("skpd_indikator");
		$this->db->join("visi", "skpd_indikator.visi=visi.kode", "left");
		$this->db->join("misi", "skpd_indikator.misi=misi.kode", "left");
		$this->db->join("tujuan", "skpd_indikator.tujuan=tujuan.kode", "left");
		$this->db->join("urusan", "skpd_indikator.urusan=urusan.kode", "left");
		$this->db->join("sasaran", "skpd_indikator.sasaran=sasaran.kode", "left");
		$this->db->join("indikator", "skpd_indikator.indikator=indikator.kode", "left");
		$this->db->join("program", "skpd_indikator.program=program.kode", "left");
		$this->db->join("skpd", "skpd_indikator.skpd=skpd.skpd_kode", "left");
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