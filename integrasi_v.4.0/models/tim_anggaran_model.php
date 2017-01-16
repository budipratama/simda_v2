<?php
class Tim_anggaran_model extends CI_Model  {

	function __contsruct(){
        parent::Model();
    }
	
	function insert($data){
       return $this->db->insert("tim_anggaran", $data);
	}
	
	function update($data, $kode){
		return $this->db->update("tim_anggaran", $data, array('kode' => $kode));	
	}
	
	function delete($kode){
		return $this->db->delete("tim_anggaran", array('kode' => $kode));	
	}
	
	public function get_all($select="", $sidx="", $sord="", $limit="", $start="", $where="", $like=""){
		$this->db->select('skpd.skpd_kode as id_kode, skpd.skpd_no, skpd.skpd_nama, skpd.skpd_pimpinan, urusan.urusan as id_urusan');
		$this->db->order_by('skpd.skpd_nama','ASC');
        $this->db->from('skpd');
		$this->db->join('urusan', 'skpd.urusan = urusan.kode');
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
	
	public function get_data($id){
		$this->db->select('skpd.skpd_kode as id_kode, skpd.skpd_no, skpd.skpd_nama, skpd.skpd_pimpinan, urusan.urusan as id_urusan');
		$this->db->order_by('skpd.skpd_nama','ASC');
        $this->db->from('skpd');
		$this->db->join('urusan', 'skpd.urusan = urusan.kode');
        $this->db->where('skpd.skpd_kode',$id);
        $query = $this->db->get();
         if($query->num_rows() != 1){
            return FALSE;
        }
        return $query->row();
    }
	
	public function get_list($list_id)	{
		$this->db->select('tim_anggaran.kode as id_kode, tim_anggaran.no, tim_anggaran.nama, tim_anggaran.nip, tim_anggaran.jabatan, skpd.skpd_nama as id_skpd');
		$this->db->order_by('tim_anggaran.kode','ASC');
        $this->db->from('tim_anggaran');
		$this->db->join('skpd', 'tim_anggaran.skpd = skpd.skpd_kode');
		$this->db->where('tim_anggaran.skpd',$list_id);
        $query = $this->db->get();
        return $query->result();
    }
	
	public function get_tim(){ 
		$this->db->where('tim_anggaran.kode_tim',1);
        $query = $this->db->get('tim_anggaran');
        return $query->result();
    }
	
	public function get_doc($list_id,$active = true){
        $this->db->select('*');
		$this->db->order_by('tim_anggaran.kode','DESC');
        $this->db->from('tim_anggaran');
        $this->db->where('tim_anggaran.skpd',$list_id);
        if($active == true){
            $this->db->where('tim_anggaran.kode_tim',1);
        } else {
            $this->db->where('tim_anggaran.kode_tim',4);
        }
        $query = $this->db->get();
        if($query->num_rows() < 1){
            return FALSE;
        }
        return $query->row();        
    }
	
	public function get_all_lists1()	{
        $query = $this->db->get('tim_anggaran');
        return $query->result();
    }
	
	public function completed(){
        $this->db->select('tim_anggaran.no');
		$this->db->order_by('tim_anggaran.kode','DESC');
        $this->db->from('tim_anggaran');
        $query = $this->db->get();
        if($query->num_rows() < 1){
            return FALSE;
        }
        return $query->row();
    }
	
	public function get($select="", $where=""){
		$this->db->select($select);
		$this->db->from("tim_anggaran");
		if ($where){$this->db->where($where);}
		$this->db->order_by('tim_anggaran.kode','DESC');
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
		$this->db->from("tim_anggaran");
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
		$this->db->from("tim_anggaran");
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