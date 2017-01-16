<?php
class Urusan_model extends CI_Model  {

	function __contsruct(){
        parent::Model();
    }

//baru

	function insert($data){
       return $this->db->insert("urusan", $data);
	}
	
	function update($data, $kode){
		return $this->db->update("urusan", $data, array('kode' => $kode));	
	}
	
	public function get($select="", $where=""){
		$this->db->select($select);
		$this->db->from("urusan");
		$this->db->join('ms_fungsi', 'ms_fungsi.kode = urusan.kd_fungsi');
		$this->db->join('ms_urusan', 'ms_urusan.kode = urusan.kd_urusan');
		if ($where){$this->db->where($where);}
		$this->db->order_by('urusan.kode','DESC');
		$this->db->limit(1);
		$query = $this->db->get();
		if ($query->num_rows() == 1){
			return $query->row();
		} else {
			return false;
		}
	}
	
	public function get_list_tasks($id){
        $this->db->select('urusan.kode as task_id, urusan.urusan, urusan.nomor as no_urusan, ms_fungsi.no as no_fungsi, ms_urusan.nm_urusan');
        $this->db->from('urusan');
		$this->db->join('ms_fungsi', 'ms_fungsi.kode = urusan.kd_fungsi');
		$this->db->join('ms_urusan', 'ms_urusan.kode = urusan.kd_urusan');
        $this->db->where('urusan.kd_urusan',$id);
        $query = $this->db->get();
         if($query->num_rows() < 1){
            return FALSE;
        }
        return $query->result();
    }
	
	public function get_list($id){
        $this->db->select('urusan.nomor, urusan.kd_urusan as id_urusan');
        $this->db->from('urusan');
        $this->db->where('kode',$id);
        $query = $this->db->get();
         if($query->num_rows() != 1){
            return FALSE;
        }
        return $query->row();
    }
	
	public function grid_all($select="", $sidx="", $sord="", $limit="", $start="", $where="", $like="", $group=""){
		$this->db->select($select);
		$this->db->from("urusan");
		$this->db->join("ms_fungsi", "ms_fungsi.kode = urusan.kd_fungsi", "left");
		$this->db->join("ms_urusan", "urusan.kd_urusan=ms_urusan.kode", "left");
		$this->db->join("skpd", "skpd.urusan=urusan.kode", "left");
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
	
	public function grid_fs($select="", $sidx="", $sord="", $limit="", $start="", $where="", $like=""){
		$this->db->select($select);
		$this->db->from("ms_fungsi");
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
	
	public function grid_us($select="", $sidx="", $sord="", $limit="", $start="", $where="", $like=""){
		$this->db->select($select);
		$this->db->from("ms_urusan");
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
	
//lama	
/*
	
	function insert($data){
       return $this->db->insert("urusan", $data);
	}
	
	function update($data, $kode){
		return $this->db->update("urusan", $data, array('kode' => $kode));	
	}
	
	function delete($kode){
		return $this->db->delete("urusan", array('kode' => $kode));	
	}
	
	public function get_task($id){
        $this->db->where('kode',$id);
        $query = $this->db->get('urusan');
        return $query->row();
    }
	
	public function get_list($id){
        $this->db->select('*');
        $this->db->from('urusan');
        $this->db->where('kode',$id);
        $query = $this->db->get();
         if($query->num_rows() != 1){
            return FALSE;
        }
        return $query->row();
    }
	
	public function get($select="", $where=""){
		$this->db->select($select);
		$this->db->from("urusan");
		$this->db->join("tipe", "urusan.tipe=tipe.tipe_kode", "left");
		if ($where){$this->db->where($where);}
		$this->db->order_by('urusan.kode','DESC');
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
		$this->db->from("urusan");
		$this->db->join("tipe", "urusan.tipe=tipe.tipe_kode", "left");
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
		$this->db->from("urusan");
		$this->db->join("tipe", "urusan.tipe=tipe.tipe_kode", "left");
		if ($where){$this->db->where($where);}
		if ($like){
			foreach($like as $key => $value){ 
			$this->db->like($key, $value); 
			}
		}
		$query = $this->db->get();
		return $query->num_rows();
	}
	
*/
	
}