<?php
class Skpd_model extends CI_Model  {

	function __contsruct(){
        parent::Model();
    }

	function insert($data){
       return $this->db->insert("skpd", $data);
	}
	
	function update($data, $kode){
		return $this->db->update("skpd", $data, array('skpd_kode' => $kode));	
	}
	
	function delete($kode){
		return $this->db->delete("skpd", array('skpd_kode' => $kode));	
	}
	
	public function get($select="", $where="", $like=""){
		$this->db->select($select);
		$this->db->from("skpd");
		$this->db->join("urusan", "skpd.urusan=urusan.kode", "left");
		if ($where){$this->db->where($where);}
		$this->db->order_by('skpd.skpd_kode','DESC');
		$this->db->limit(1);
		if ($like){
			foreach($like as $key => $value){ 
			$this->db->like($key, $value); 
			}
		}
		$query = $this->db->get();
		if ($query->num_rows() == 1){
			return $query->row();
		} else {
			return false;
		}
	}
	
	public function get_list($id){
		$this->db->select('skpd.skpd_kode as id_skpd, skpd.skpd_nomor as no_skpd, urusan.kode as urusan, ms_urusan.kode as id_urusan');
        $this->db->from('skpd');
		$this->db->join('urusan', 'urusan.kode = skpd.urusan');
		$this->db->join('ms_urusan', 'ms_urusan.kode = urusan.kd_urusan');
        $this->db->where('skpd.skpd_kode',$id);
        $query = $this->db->get();
         if($query->num_rows() != 1){
            return FALSE;
        }
        return $query->row();
    }
	
	public function grid_all($select="", $sidx="", $sord="", $limit="", $start="", $where="", $like=""){
		$this->db->select($select);
		$this->db->from("skpd");
        $this->db->join('urusan', 'urusan.kode = skpd.urusan');
		$this->db->join('ms_urusan', 'ms_urusan.kode = urusan.kd_urusan');
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
	
	public function get_list_tasks($id){
		$this->db->select('skpd.skpd_nama, skpd.skpd_nomor, skpd.skpd_kode as task_id, ms_urusan.no as no_urusan');
        $this->db->from('skpd');
        $this->db->join('urusan', 'urusan.kode = skpd.urusan');
		$this->db->join('ms_urusan', 'ms_urusan.kode = urusan.kd_urusan');
        $this->db->where('skpd.urusan',$id);
        $query = $this->db->get();
         if($query->num_rows() < 1){
            return FALSE;
        }
        return $query->result();
    }
	
	public function count_all($where="", $like=""){
		$this->db->select("skpd_kode, urusan, skpd_kd");
		$this->db->from("skpd");
		if ($where){$this->db->where($where);}
		if ($like){
			foreach($like as $key => $value){ 
			$this->db->like($key, $value); 
			}
		}
		$query = $this->db->get();
		return $query->num_rows();
	}
	
//lama	
/*	
	public function get($select="", $where=""){
		$this->db->select($select);
		$this->db->from("skpd");
		$this->db->join("urusan", "skpd.urusan=urusan.kode", "left");
		if ($where){$this->db->where($where);}
		$this->db->order_by('skpd.skpd_kode','DESC');
		$this->db->limit(1);
		$query = $this->db->get();
		if ($query->num_rows() == 1){
			return $query->row();
		} else {
			return false;
		}
	}
	
	public function get_all_lists(){ 
		$this->db->select('skpd.skpd_nama, skpd.skpd_no, tipe.no as id_tipe, skpd.skpd_kode as task_id, urusan.no as id_urusan');
		$this->db->order_by('urusan.no','ASC');
		$this->db->from('skpd');
		$this->db->join('tipe', 'tipe.tipe_kode = skpd.tipe');
		$this->db->join('urusan', 'urusan.kode = skpd.urusan');
		$this->db->where('skpd.tipe_sort',1);
        $query = $this->db->get('');
        return $query->result();
    }
	
	public function get_task($id){
        $this->db->where('skpd_kode',$id);
        $query = $this->db->get('skpd');
        return $query->row();
    }
	
	public function get_list($id){
        $this->db->select('*');
        $this->db->from('skpd');
        $this->db->where('skpd_kode',$id);
        $query = $this->db->get();
         if($query->num_rows() != 1){
            return FALSE;
        }
        return $query->row();
    }
	
	public function get_data($list_id,$active = true){
        $this->db->select('skpd.skpd_no');
		$this->db->order_by('skpd.skpd_kode','DESC');
        $this->db->from('skpd');
        $this->db->join('tipe_', 'tipe_.kode = skpd.tipe');
        $this->db->join('urusan', 'urusan.kode = skpd.urusan');
        $this->db->where('skpd.urusan',$list_id);
        if($active == true){
            $this->db->where('skpd.tipe_sort',0);
        } else {
            $this->db->where('skpd.tipe_sort',1);
        }
        $query = $this->db->get();
        if($query->num_rows() < 1){
            return FALSE;
        }
        return $query->row();
    }
	
	public function get_list_tasks($list_id,$active = true){
        $this->db->select('
            skpd.skpd_nama,
            skpd.skpd_no,
            skpd.tipe,
            skpd.skpd_kode as task_id,
            tipe.no as tipe_id
            ');
		$this->db->order_by('skpd.skpd_no','ASC');
        $this->db->from('skpd');
        $this->db->join('tipe', 'tipe.tipe_kode = skpd.tipe');
        $this->db->join('urusan', 'urusan.kode = skpd.urusan');
        $this->db->where('skpd.urusan',$list_id);
        if($active == true){
            $this->db->where('skpd.tipe_sort',1);
        } else {
            $this->db->where('skpd.tipe_sort',2);
        }
        $query = $this->db->get();
        if($query->num_rows() < 1){
            return FALSE;
        }
        return $query->result();
    }
	
	public function get($select="", $where=""){
		$this->db->select($select);
		$this->db->from("skpd");
		$this->db->join("urusan", "skpd.urusan=urusan.kode", "left");
		if ($where){$this->db->where($where);}
		$this->db->order_by('skpd.skpd_kode','DESC');
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
		$this->db->from("skpd");
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
	
*/	
}