<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Sub_model extends CI_Model  {
	
	var $table = 'ms_sub_modal';

	function __contsruct(){
        parent::Model();
    }

	function inserts($data){
       return $this->db->insert("ms_sub", $data);
	}
	
	function updates($data, $kode){
		return $this->db->update("ms_sub", $data, array('kode' => $kode));	
	}

	function delete1($kode){
		return $this->db->delete("ms_sub", array('kode' => $kode));	
	}

	function insert($data){
       return $this->db->insert("ms_sub_modal", $data);
	}
	
	function update($data, $kode){
		return $this->db->update("ms_sub_modal", $data, array('kode' => $kode));	
	}
	
	function delete($kode){
		return $this->db->delete("ms_sub_modal", array('kode' => $kode));	
	}

	
	public function get_task_data($id){
        $this->db->where('kode',$id);
        $query = $this->db->get('ms_sub');
        return $query->row();
    }
	
	public function get($select="", $where=""){
		$this->db->select($select);
		$this->db->from("ms_sub");
		if ($where){$this->db->where($where);}
		$this->db->order_by('ms_sub.kode','DESC');
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
		$this->db->from("ms_sub");
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
	
	public function get_list_tasks($list_id,$active = true){
        $this->db->select('ms_sub.nm_sub, ms_sub.no, ms_sub.kd_urusan, ms_sub.urusan, ms_sub.kode as task_id, ms_urusan.no as no_urusan, urusan.nomor as urusan_id');
		$this->db->order_by('ms_sub.kode','ASC');
        $this->db->from('ms_sub');
        $this->db->join('urusan', 'urusan.kode = ms_sub.urusan');
		$this->db->join('ms_urusan', 'ms_urusan.kode = urusan.kd_urusan');
        $this->db->join('skpd', 'skpd.skpd_kode = ms_sub.kd_skpd');
        $this->db->where('ms_sub.kd_skpd',$list_id);
        if($active == true){
            $this->db->where('ms_sub.tipe_sort',1);
        } else {
            $this->db->where('ms_sub.tipe_sort',2);
        }
        $query = $this->db->get();
        if($query->num_rows() < 1){
            return FALSE;
        }
        return $query->result();
    }
	
	public function get_by_id($id) {
		$this->db->from($this->table);
		$this->db->where('kode',$id);
		$query = $this->db->get();

		return $query->row();
	}
	
	public function get_list_sub($id){
		$this->db->select('ms_sub_modal.kode as list_id, ms_sub_modal.kd_sub_modal as no, ms_sub_modal.nm_sub_modal as sub, ms_rek_1.kd_rek_1 as akun, ms_rek_2.kd_rek_2 as kelompok, ms_rek_3.kd_rek_3 as jenis, ms_rek_4.kd_rek_4 as obyek, ms_rek_5.kd_rek_5 as rincian');
		$this->db->join('ms_rek_1', 'ms_rek_1.kode = ms_sub_modal.kd_rek_1');
		$this->db->join('ms_rek_2', 'ms_rek_2.kode = ms_sub_modal.kd_rek_2');
		$this->db->join('ms_rek_3', 'ms_rek_3.kode = ms_sub_modal.kd_rek_3');
		$this->db->join('ms_rek_4', 'ms_rek_4.kode = ms_sub_modal.kd_rek_4');
		$this->db->join('ms_rek_5', 'ms_rek_5.kode = ms_sub_modal.kd_rek_5');
		$this->db->where('ms_sub_modal.kd_rek_5',$id);
        $query = $this->db->get('ms_sub_modal');
        return $query->result();
    }
	
	public function get_task($id){
        $this->db->select('ms_sub_modal.kd_sub_modal as no');
		$this->db->order_by('ms_sub_modal.kode','DESC');
        $this->db->from('ms_sub_modal');
        $this->db->where('ms_sub_modal.kd_rek_5',$id);
        $query = $this->db->get();
        if($query->num_rows() < 1){
            return FALSE;
        }
        return $query->row();
    }
	
	public function getOnlys($select="", $where="", $like=""){
		$this->db->select($select);
		$this->db->from("ms_sub_modal");
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