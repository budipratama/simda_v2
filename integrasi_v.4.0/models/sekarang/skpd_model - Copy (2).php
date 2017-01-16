<?php
class Sub_model extends CI_Model  {

	function __contsruct(){
        parent::Model();
    }
	
	function insert($data){
       return $this->db->insert("sub", $data);
	}
	
	function update($data, $kode){
		return $this->db->update("sub", $data, array('kode' => $kode));	
	}
	
	function delete($kode){
		return $this->db->delete("sub", array('kode' => $kode));	
	}
	
	public function get_task_data($id){
        $this->db->where('kode',$id);
        $query = $this->db->get('sub');
        return $query->row();
    }
	
	public function get_list($id){
        $this->db->select('*');
        $this->db->from('sub');
        $this->db->where('kode',$id);
		$this->db->order_by('sub.kode','DESC');
        $query = $this->db->get();
         if($query->num_rows() != 1){
            return FALSE;
        }
        return $query->row();
    }
	
	public function get_data($list_id,$active = true){
        $this->db->select('skpd.no');
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
            tipe_.tipe_nama as saldo_id
            ');
		$this->db->order_by('skpd.skpd_no','ASC');
        $this->db->from('skpd');
        $this->db->join('tipe_', 'tipe_.kode = skpd.tipe');
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
	
}