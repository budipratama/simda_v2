<?php
class Usulan_model extends CI_Model  {

	function __contsruct(){
        parent::Model();
    }
	
	function insert($data){
       return $this->db->insert("usulan", $data);
	}
	
	function update($data, $where){
		return $this->db->update("usulan", $data, $where);	
	}
	
	function delete($where){
		return $this->db->delete("usulan", $where);	
	}
	
	public function get($select="", $where="", $like=""){
		$this->db->select($select);
		$this->db->from("usulan");
		$this->db->join("skpd as pelaksana", "usulan.pelaksana_kode=pelaksana.skpd_kode", "left");
		$this->db->join("skpd as kecamatan", "usulan.kecamatan_kode=kecamatan.skpd_kd", "left");
		$this->db->join("skpd as deskel", "usulan.deskel_kode=deskel.skpd_kd", "left");
		if ($where){$this->db->where($where);}
		if ($like){
			foreach($like as $key => $value){ 
			$this->db->like($key, $value); 
			}
		}
		$this->db->order_by('usulan.kode','DESC');
		$this->db->limit(1);
		$query = $this->db->get();
		if ($query->num_rows() == 1){
			return $query->row();
		} else {
			return false;
		}
	}
	
	public function getOnly($select="", $where="", $like=""){
		$this->db->select($select);
		$this->db->from("usulan");
		if ($where){$this->db->where($where);}
		if ($like){
			foreach($like as $key => $value){ 
			$this->db->like($key, $value); 
			}
		}
		$this->db->order_by('kode','DESC');
		$this->db->limit(1);
		$query = $this->db->get();
		if ($query->num_rows() == 1){
			return $query->row();
		} else {
			return false;
		}
	}
	
	public function grid_all($select="", $sidx="", $sord="", $limit="", $start="", $where="", $like="", $group_by=""){
		$this->db->select($select);
		$this->db->from("usulan");
		$this->db->join("skpd as pelaksana", "usulan.pelaksana_kode=pelaksana.skpd_kode", "left");
		$this->db->join("skpd as kecamatan", "usulan.kecamatan_kode=kecamatan.skpd_kd", "left");
		$this->db->join("skpd as deskel", "usulan.deskel_kode=deskel.skpd_kd", "left");
		if ($where){$this->db->where($where);}
		if ($like){
			foreach($like as $key => $value){ 
			$this->db->like($key, $value); 
			}
		}
		if ($group_by){$this->db->group_by($group_by);}
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
		$this->db->select("usulan.kode");
		$this->db->from("usulan");
		$this->db->join("skpd as pelaksana", "usulan.pelaksana_kode=pelaksana.skpd_kode", "left");
		$this->db->join("skpd as kecamatan", "usulan.kecamatan_kode=kecamatan.skpd_kd", "left");
		$this->db->join("skpd as deskel", "usulan.deskel_kode=deskel.skpd_kd", "left");
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