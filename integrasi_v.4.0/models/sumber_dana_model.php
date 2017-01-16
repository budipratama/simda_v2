<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Sumber_dana_model extends CI_Model  {
	
	var $table = 'ms_sumber_dana';

	function __contsruct(){
        parent::Model();
    }
	
	function insert($data){
       return $this->db->insert("ms_sumber_dana", $data);
	}
	
	function update($data, $kode){
		return $this->db->update("ms_sumber_dana", $data, array('kode' => $kode));	
	}
	
	function delete($kode){
		return $this->db->delete("ms_sumber_dana", array('kode' => $kode));	
	}
	
	public function get_by_id($id){
		$this->db->from($this->table);
		$this->db->where('kode',$id);
		$query = $this->db->get();

		return $query->row();
	}
	
	public function get_list(){
		$this->db->select("kd_sumber as sumber, nm_sumber as nama");
        $query = $this->db->get('ms_sumber_dana');
        return $query->result();
    }
	
	public function grid_all($select="", $sidx="", $sord="", $limit="", $start="", $where="", $like=""){
		$this->db->select($select);
		$this->db->from("ms_sumber_dana");
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