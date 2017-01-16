<?php
class Rekening_model extends CI_Model  {

	function __contsruct(){
        parent::Model();
    }
	
	function insert($data){
       return $this->db->insert("rekening", $data);
	}
	
	function update($data, $kode){
		return $this->db->update("rekening", $data, array('rekening_kode' => $kode));	
	}
	
	function delete($kode){
		return $this->db->delete("rekening", array('rekening_kode' => $kode));	
	}
	
	public function get($select="", $where=""){
		$this->db->select($select);
		$this->db->from("rekening");
		$this->db->join("rekening_akun", "rekening.tipe_=rekening_akun.akun_kode", "left");
		$this->db->join("rekening_jenis", "rekening.rekening_jenis=rekening_jenis.kode", "left");
		$this->db->join("rekening_kelompok", "rekening.rekening_kelompok=rekening_kelompok.kode", "left");
		$this->db->join("rekening_obyek", "rekening.rekening_obyek=rekening_obyek.kode", "left");
		$this->db->join("rekening_rincian", "rekening.rekening_rincian=rekening_rincian.kode", "left");
		if ($where){$this->db->where($where);}
		$this->db->order_by('rekening.rekening_kode','DESC');
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
		$this->db->from("rekening");
		$this->db->join("rekening_akun", "rekening.tipe_=rekening_akun.akun_kode", "left");
		$this->db->join("rekening_jenis", "rekening.rekening_jenis=rekening_jenis.kode", "left");
		$this->db->join("rekening_kelompok", "rekening.rekening_kelompok=rekening_kelompok.kode", "left");
		$this->db->join("rekening_obyek", "rekening.rekening_obyek=rekening_obyek.kode", "left");
		$this->db->join("rekening_rincian", "rekening.rekening_rincian=rekening_rincian.kode", "left");
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
		$this->db->select("rekening_kode");
		$this->db->from("rekening");
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