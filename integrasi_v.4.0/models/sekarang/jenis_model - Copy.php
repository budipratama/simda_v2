<?php
class Jenis_model extends CI_Model  {

	function __contsruct(){
        parent::Model();
    }
	
	function insert($data){
       return $this->db->insert("ms_rek_3", $data);
	}
	
	function update($data, $kode){
		return $this->db->update("ms_rek_3", $data, array('kode' => $kode));	
	}
	
	function delete($kode){
		return $this->db->delete("ms_rek_3", array('kode' => $kode));	
	}
	
	function delete1($kode){
		return $this->db->join("ms_rek_4", "ms_rek_3.kode = ms_rek_4.kode")
					->where("ms_rek_4.kd_rek_3", $kode)
					->delete("ms_rek_4");	
	}
	
	function delete2($kode){
		return $this->db->join("ms_rek_5", "ms_rek_3.kode = ms_rek_5.kode")
					->where("ms_rek_5.kd_rek_3", $kode)
					->delete("ms_rek_5");	
	}

	
	public function get_task($id){
        $this->db->select('ms_rek_3.no');
		$this->db->order_by('ms_rek_3.kode','DESC');
        $this->db->from('ms_rek_3');
        $this->db->where('ms_rek_3.kd_rek_2',$id);
        $query = $this->db->get();
        if($query->num_rows() < 1){
            return FALSE;
        }
        return $query->row();
    }
	
	public function get_jenis($id){
		$this->db->select('ms_rek_3.no, ms_rek_1.kode as akun, ms_rek_2.kode as kelompok');		
        $this->db->from('ms_rek_3');
		$this->db->join('ms_rek_1', 'ms_rek_1.kode = ms_rek_3.kd_rek_1');
		$this->db->join('ms_rek_2', 'ms_rek_2.kode = ms_rek_3.kd_rek_2');
        $this->db->where('ms_rek_3.kode',$id);
        $query = $this->db->get();
			if($query->num_rows() != 1){
				return FALSE;
        }
        return $query->row();
    }
	
	public function get_list($id){
        $this->db->select('ms_rek_3.kode as list_id, ms_rek_3.kd_rek_1, ms_rek_3.no, ms_rek_3.nm_rek_3 as jenis, ms_rek_3.saldo_normal');
        $this->db->from('ms_rek_3');
		$this->db->join('ms_rek_1', 'ms_rek_1.kode = ms_rek_3.kd_rek_1');
		$this->db->join('ms_rek_2', 'ms_rek_2.kode = ms_rek_3.kd_rek_2');
        $this->db->where('ms_rek_3.kd_rek_2',$id);
        $query = $this->db->get();
			if($query->num_rows() < 1){
				return FALSE;
        }
        return $query->result();        
    }
	
	public function getOnly($select="", $where="", $like=""){
		$this->db->select($select);
		$this->db->from("ms_rek_3");
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
	


/*			

	public function get_task($id){
        $this->db->where('kode',$id);
        $query = $this->db->get('jenis');
        return $query->row();
    }
	
	public function get_task_data($id){
        $this->db->where('kode',$id);
        $query = $this->db->get('jenis');
        return $query->row();
    }
	
	public function get_list($id){
        $this->db->select('*');
        $this->db->from('jenis');
        $this->db->where('kode',$id);
		$this->db->order_by('jenis.kode','DESC');
        $query = $this->db->get();
         if($query->num_rows() != 1){
            return FALSE;
        }
        return $query->row();
    }
	
	public function completed($list_id,$active = true){
        $this->db->select('jenis.no');
		$this->db->order_by('jenis.kode','DESC');
        $this->db->from('jenis');
        $this->db->join('tipe', 'tipe.tipe_kode = jenis.saldo_normal');
        $this->db->join('kelompok', 'kelompok.kode = jenis.kelompok');
        $this->db->where('jenis.kelompok',$list_id);
        if($active == true){
            $this->db->where('jenis.akun_sort',1);
        } else {
            $this->db->where('jenis.akun_sort',2);
        }
        $query = $this->db->get();
        if($query->num_rows() < 1){
            return FALSE;
        }
        return $query->row();
    }
	
	public function uncompleted($list_id,$active = true){
        $this->db->select('jenis.no');
		$this->db->order_by('jenis.kode','DESC');
        $this->db->from('jenis');
        $this->db->join('tipe', 'tipe.tipe_kode = jenis.saldo_normal');
        $this->db->join('kelompok', 'kelompok.kode = jenis.kelompok');
        $this->db->where('jenis.kelompok',$list_id);
        if($active == true){
            $this->db->where('jenis.akun_sort',2);
        } else {
            $this->db->where('jenis.akun_sort',1);
        }
        $query = $this->db->get();
        if($query->num_rows() < 1){
            return FALSE;
        }
        return $query->row();
    }
	
	public function get_list_tasks($list_id,$active = true){
        $this->db->select('
            jenis.jenis_nama,
            jenis.no,
            jenis.akun,
            jenis.saldo_normal,
            jenis.kode as task_id,
            tipe.tipe_nama as saldo_id,
			akun.no as akun_id
            ');
		$this->db->order_by('jenis.kode','ASC');
        $this->db->from('jenis');
		$this->db->join('akun', 'akun.kode = jenis.akun');
        $this->db->join('tipe', 'tipe.tipe_kode = jenis.saldo_normal');
        $this->db->join('kelompok', 'kelompok.kode = jenis.kelompok');
        $this->db->where('jenis.kelompok',$list_id);
        if($active == true){
            $this->db->where('jenis.akun_sort',1);
        } else {
            $this->db->where('jenis.akun_sort',2);
        }
        $query = $this->db->get();
        if($query->num_rows() < 1){
            return FALSE;
        }
        return $query->result();
    }
	
	public function get($select="", $where=""){
		$this->db->select($select);
		$this->db->from("jenis");
		$this->db->join("akun", "jenis.akun=akun.kode", "left");
		$this->db->join("kelompok", "jenis.kelompok=kelompok.kode", "left");
		if ($where){$this->db->where($where);}
		$this->db->order_by('jenis.kode','DESC');
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
		$this->db->from("jenis");
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
	
	public function grid_alli($select="", $sidx="", $sord="", $limit="", $start="", $where="", $like=""){
		$this->db->select($select);
		$this->db->from("jenis_");
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
		$this->db->select("kode");
		$this->db->from("jenis");
		$this->db->join("kelompok", "jenis.kelompok=kelompok.kode", "left");
		if ($where){$this->db->where($where);}
		if ($like){
			foreach($like as $key => $value){ 
			$this->db->like($key, $value); 
			}
		}
		$query = $this->db->get();
		return $query->num_rows();
	}
	
	public function getOnly($select="", $where="", $like=""){
		$this->db->select($select);
		$this->db->from("jenis");
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
*/
	
}