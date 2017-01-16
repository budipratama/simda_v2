<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Jenis_akrual_model extends CI_Model  {
	
	var $table = 'ms_akrual_3';

	function __contsruct(){
        parent::Model();
    }
	
	function insert($data){
       return $this->db->insert("ms_akrual_3", $data);
	}
	
	function update($data, $kode){
		return $this->db->update("ms_akrual_3", $data, array('kode' => $kode));	
	}
	
	function delete($kode){
		return $this->db->delete("ms_akrual_3", array('kode' => $kode));	
	}
	
	function delete1($kode){
		return $this->db->join("ms_akrual_4", "ms_akrual_3.kode = ms_akrual_4.kode")
					->where("ms_akrual_4.kd_akrual_3", $kode)
					->delete("ms_akrual_4");	
	}
	
	function delete2($kode){
		return $this->db->join("ms_akrual_5", "ms_akrual_3.kode = ms_akrual_5.kode")
					->where("ms_akrual_5.kd_akrual_3", $kode)
					->delete("ms_akrual_5");	
	}
	
	public function get_by_id($id) {
		$this->db->from($this->table);
		$this->db->where('kode',$id);
		$query = $this->db->get();

		return $query->row();
	}
	
	public function get_jenis($id){
		$this->db->select('ms_akrual_3.kd_akrual_3 as no, ms_akrual_3.kode as jenis, ms_akrual_1.kode as akun, ms_akrual_2.kode as kelompok');		
        $this->db->from('ms_akrual_3');
		$this->db->join('ms_akrual_1', 'ms_akrual_1.kode = ms_akrual_3.kd_akrual_1');
		$this->db->join('ms_akrual_2', 'ms_akrual_2.kode = ms_akrual_3.kd_akrual_2');
        $this->db->where('ms_akrual_3.kode',$id);
        $query = $this->db->get();
			if($query->num_rows() != 1){
				return FALSE;
        }
        return $query->row();
    }
	
	public function get_list($id){
        $this->db->select('ms_akrual_3.kode as list_id, ms_akrual_3.kd_akrual_1, ms_akrual_3.kd_akrual_3 as no, ms_akrual_3.nm_akrual_3 as jenis, ms_akrual_3.saldo_normal');
        $this->db->from('ms_akrual_3');
		$this->db->join('ms_akrual_1', 'ms_akrual_1.kode = ms_akrual_3.kd_akrual_1');
		$this->db->join('ms_akrual_2', 'ms_akrual_2.kode = ms_akrual_3.kd_akrual_2');
        $this->db->where('ms_akrual_3.kd_akrual_2',$id);
        $query = $this->db->get();
			if($query->num_rows() < 1){
				return FALSE;
        }
        return $query->result();        
    }
	
	public function get_task($id){
        $this->db->select('ms_akrual_3.kd_akrual_3 as no');
		$this->db->order_by('ms_akrual_3.kode','DESC');
        $this->db->from('ms_akrual_3');
        $this->db->where('ms_akrual_3.kd_akrual_2',$id);
        $query = $this->db->get();
        if($query->num_rows() < 1){
            return FALSE;
        }
        return $query->row();
    }
	
	public function grid_all($select="", $sidx="", $sord="", $limit="", $start="", $where="", $like="", $group=""){
		$this->db->select($select);
		$this->db->from("ms_akrual_3");
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
	
	public function getOnly($select="", $where="", $like=""){
		$this->db->select($select);
		$this->db->from("ms_akrual_3");
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
	
}