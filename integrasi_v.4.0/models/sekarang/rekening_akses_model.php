<?php
class Rekening_akses_model extends CI_Model  {

	function __contsruct(){
        parent::Model();
    }
	
	function insert($data){
       return $this->db->insert("rekening_akses", $data);
	}
	
	function update($data, $kode){
		return $this->db->update("rekening_akses", $data, array('rekening_akses_kode' => $kode));	
	}
	
	function delete($kode){
		return $this->db->delete("rekening_akses", array('rekening_akses_kode' => $kode));	
	}
	
	public function get($select="", $where=""){
		$this->db->select($select);
		$this->db->from("rekening_akses");
		$this->db->join("rekening_akun", "rekening_akses.akun_kode=rekening_akun.akun_kode", "left");
		$this->db->join("rekening", "rekening_akses.rekening_kode=rekening.rekening_kode", "left");
		if ($where){$this->db->where($where);}
		$this->db->order_by('rekening_akses.rekening_akses_kode','DESC');
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
		$this->db->from("rekening_akses");
		$this->db->join("rekening_akun", "rekening_akses.akun_kode=rekening_akun.akun_kode", "left");
		$this->db->join("rekening", "rekening_akses.rekening_kode=rekening.rekening_kode", "left");
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
		$this->db->select("rekening_akses_kode");
		$this->db->from("rekening_akses");
		$this->db->join("rekening_akun", "rekening_akses.akun_kode=rekening_akun.akun_kode", "left");
		$this->db->join("rekening", "rekening_akses.rekening_kode=rekening.rekening_kode", "left");
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