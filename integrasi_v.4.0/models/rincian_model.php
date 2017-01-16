<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Rincian_model extends CI_Model  {
	
	var $table = 'ms_rek_5';

	function __contsruct(){
        parent::Model();
    }
	
	function insert($data){
       return $this->db->insert("ms_rek_5", $data);
	}
	
	function update($data, $kode){
		return $this->db->update("ms_rek_5", $data, array('kode' => $kode));	
	}
	
	function delete2($kode){
		return $this->db->delete("ms_rek_5", array('kode' => $kode));	
	}
	
	public function get_by_id($id) {
		$this->db->from($this->table);
		$this->db->where('kode',$id);
		$query = $this->db->get();
			return $query->row();
	}
	
	public function get_task($id){
        $this->db->select('ms_rek_5.kd_rek_5 as no');
		$this->db->order_by('ms_rek_5.kode','DESC');
        $this->db->from('ms_rek_5');
        $this->db->where('ms_rek_5.kd_rek_4',$id);
        $query = $this->db->get();
        if($query->num_rows() < 1){
            return FALSE;
        }
        return $query->row();
    }

	public function get_rincian($id){
        $this->db->select('ms_rek_5.kode as rincian, ms_rek_5.kd_rek_4 as no, ms_rek_1.kode as akun, ms_rek_2.kode as kelompok, ms_rek_3.kode as jenis, ms_rek_4.kode as obyek');
        $this->db->from('ms_rek_5');
		$this->db->join('ms_rek_1', 'ms_rek_1.kode = ms_rek_5.kd_rek_1');
		$this->db->join('ms_rek_2', 'ms_rek_2.kode = ms_rek_5.kd_rek_2');
		$this->db->join('ms_rek_3', 'ms_rek_3.kode = ms_rek_5.kd_rek_3');
		$this->db->join('ms_rek_4', 'ms_rek_4.kode = ms_rek_5.kd_rek_4');
        $this->db->where('ms_rek_5.kode',$id);
        $query = $this->db->get();
			if($query->num_rows() != 1){
				return FALSE;
        }
        return $query->row();
    }
	
	public function get_list($id){
        $this->db->select('ms_rek_5.kode as list_id, ms_rek_5.kd_rek_1, ms_rek_5.kd_rek_5 as no, ms_rek_5.nm_rek_5 as rincian, ms_rek_5.peraturan, ms_rek_1.kd_rek_1 as akun, ms_rek_2.kd_rek_2 as kelompok, ms_rek_3.kd_rek_3 as jenis, ms_rek_4.nm_rek_4 as obyek');
        $this->db->from('ms_rek_5');
		$this->db->join('ms_rek_1', 'ms_rek_1.kode = ms_rek_5.kd_rek_1');
		$this->db->join('ms_rek_2', 'ms_rek_2.kode = ms_rek_5.kd_rek_2');
		$this->db->join('ms_rek_3', 'ms_rek_3.kode = ms_rek_5.kd_rek_3');
		$this->db->join('ms_rek_4', 'ms_rek_4.kode = ms_rek_5.kd_rek_4');
        $this->db->where('ms_rek_5.kd_rek_4',$id);
        $query = $this->db->get();
			if($query->num_rows() < 1){
				return FALSE;
        }
        return $query->result();        
    }
	
	public function getOnly($select="", $where="", $like=""){
		$this->db->select($select);
		$this->db->from("ms_rek_5");
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
	
	public function get($select="", $where=""){
		$this->db->select($select);
		$this->db->from("ms_rek_5");
		if ($where){$this->db->where($where);}
		$this->db->order_by('ms_rek_5.kode','DESC');
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
		$this->db->from("ms_rek_5");
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
	
	public function get_list_rincian($id){
		$this->db->select('ms_rek_5.kode as list_id, ms_rek_5.kd_rek_5 as no, ms_rek_5.nm_rek_5 as rincian');
		$this->db->where('ms_rek_5.kd_rek_4',$id);
        $query = $this->db->get('ms_rek_5');
        return $query->result();
    }
	
	public function count_all($where="", $like=""){
		$this->db->select("kode");
		$this->db->from("ms_rek_5");
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