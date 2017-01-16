<?php
class Admin_model extends CI_Model {

	function __contsruct(){
        parent::Model();
    }
	
	function validasi($username, $password, $tahun){
		$where = "admin.skpd_kode AND admin_tahun.skpd_id";
        $this->db->select("admin_user, admin_nama, admin_level_kode, skpd_kode, tahun, skpd_id");
        $this->db->from("admin");
		$this->db->from("admin_tahun");
		$this->db->where('admin_user', $username);
		$this->db->where('admin_pass', md5($password));
		$this->db->where('tahun', $tahun);
		$this->db->where($where);
		$this->db->limit(1);
		$query = $this->db->get();
		if ($query->num_rows() == 1){
			return $query->result();
		} else {
			return false;
		}
	}
	
	function insert($data){
       return $this->db->insert("admin", $data);
	}
	
	function update($data, $kode){
		return $this->db->update("admin", $data, array('admin_user' => $kode));	
	}
	
	function delete($kode){
		return $this->db->delete("admin", array('admin_user' => $kode));	
	}
	
	public function get($select="", $where=""){
		$this->db->select($select);
		$this->db->from("admin");
		$this->db->join("admin_level", "admin.admin_level_kode=admin_level.admin_level_kode", "left");
		$this->db->join("skpd", "admin.skpd_kode=skpd.skpd_kode", "left");
		if ($where){$this->db->where($where);}
		$this->db->order_by('admin.admin_user','DESC');
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
		$this->db->from("admin");
		$this->db->join("admin_level", "admin.admin_level_kode=admin_level.admin_level_kode", "left");
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
		$this->db->select("admin_user");
		$this->db->from("admin");
		$this->db->join("admin_level", "admin.admin_level_kode=admin_level.admin_level_kode", "left");
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