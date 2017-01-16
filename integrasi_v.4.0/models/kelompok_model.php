<?php
class Kelompok_model extends CI_Model  {

	function __contsruct(){
        parent::Model();
    }
	
	public function get_kelompok($id){
		$this->db->select('ms_rek_2.kode as kelompok, ms_rek_2.kd_rek_2 as no, ms_rek_1.kode as akun');
        $this->db->from('ms_rek_2');
		$this->db->join('ms_rek_1', 'ms_rek_1.kode = ms_rek_2.kd_rek_1');
        $this->db->where('ms_rek_2.kode',$id);
        $query = $this->db->get();
			if($query->num_rows() != 1){
				return FALSE;
        }
        return $query->row();
    }
	
	public function get_list($id){
        $this->db->select('ms_rek_2.kode as list_id, ms_rek_2.kd_rek_2 as no, ms_rek_2.nm_rek_2 as kelompok');
        $this->db->from('ms_rek_2');
		$this->db->join('ms_rek_1', 'ms_rek_1.kode = ms_rek_2.kd_rek_1');
        $this->db->where('ms_rek_2.kd_rek_1',$id);
        $query = $this->db->get();
			if($query->num_rows() < 1){
				return FALSE;
        }
        return $query->result();        
    }
	
	public function grid_all($select="", $sidx="", $sord="", $limit="", $start="", $where="", $like=""){
		$this->db->select($select);
		$this->db->from("ms_rek_2");
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
	
}