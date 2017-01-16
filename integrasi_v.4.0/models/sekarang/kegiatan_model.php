<?php
class Kegiatan_model extends CI_Model  {

	function __contsruct(){
        parent::Model();
    }
	
	function insert($data){
       return $this->db->insert("program_kegiatan", $data);
	}
	
	function update($data, $kode){
		return $this->db->update("program_kegiatan", $data, array('kode' => $kode));	
	}
	
	function delete($kode){
		return $this->db->delete("program_kegiatan", $data, array('kode' => $kode));	
	}
	
	public function get($select="", $where=""){
		$data = "";
		$this->db->select($select);
		$this->db->from("program_kegiatan");
		$this->db->join("program", "program_kegiatan.program=program.kode", "left");
		$this->db->join("urusan", "program_kegiatan.urusan=urusan.kode", "left");
		if ($where){$this->db->where($where);}
		$this->db->order_by('program_kegiatan.kode','DESC');
		$this->db->limit(1);
		$Q = $this->db->get();
		if ($Q->num_rows() > 0){
			$data = $Q->row();
		}
		$Q->free_result();
	}
	
	public function grid_all($select="", $sidx="", $sord="", $limit="", $start="", $where="", $like=""){
		$data = "";
		$this->db->select($select);
		$this->db->from("program_kegiatan");
		$this->db->join("program", "program_kegiatan.program=program.kode", "left");
		$this->db->join("urusan", "program_kegiatan.urusan=urusan.kode", "left");
		if ($where){$this->db->where($where);}
		if ($like){
			foreach($like as $key => $value){ 
			$this->db->like($key, $value); 
			}
		}
		if ($sidx && $sord) {$this->db->order_by($sidx,$sord);}
		if (!empty($limit)) {$this->db->limit($limit,$start);}
		$Q = $this->db->get();
		if ($Q->num_rows() > 0){
			$data=$Q->result();
		}
		$Q->free_result();
		return $data;
	}
	
	public function count_all($where="", $like=""){
		$this->db->select("program_kegiatan.kode");
		$this->db->from("program_kegiatan");
		$this->db->join("program", "program_kegiatan.program=program.kode", "left");
		$this->db->join("urusan", "program_kegiatan.urusan=urusan.kode", "left");
		if ($where){$this->db->where($where);}
		if ($like){
			foreach($like as $key => $value){ 
			$this->db->like($key, $value); 
			}
		}
		$Q=$this->db->get();
		$data = $Q->num_rows();
		return $data;
	}
}