<?php
class Akun_model extends CI_Model  {

	function __contsruct(){
        parent::Model();
    }
	
	public function get_akun($id){
       $this->db->select("kode, kd_rek_1 as no, nm_rek_1 as akun");
        $this->db->from('ms_rek_1');
        $this->db->where('kode',$id);
        $query = $this->db->get();
         if($query->num_rows() != 1){
            return FALSE;
        }
        return $query->row();
    }
	
	public function get_list(){
		$this->db->select("kode, kd_rek_1 as no, nm_rek_1 as akun");
        $query = $this->db->get('ms_rek_1');
        return $query->result();
    }

	public function grid_all($select="", $sidx="", $sord="", $limit="", $start="", $where="", $like=""){
		$this->db->select($select);
		$this->db->from("ms_rek_1");
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