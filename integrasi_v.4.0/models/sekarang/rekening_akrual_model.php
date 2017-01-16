<?php
class Rekening_akrual_model extends CI_Model  {

	function __contsruct(){
        parent::Model();
    }
	
	function insert($data){
       return $this->db->insert("rekening", $data);
	}
	
	function update($data, $kode){
		return $this->db->update("rekening", $data, array('rekening_kode' => $kode));	
	}
	
	function delete($kode){
		return $this->db->delete("rekening", array('rekening_kode' => $kode));	
	}
	
	public function get_list_tasks($active = true){
        $this->db->select('
            rekening_akrual.akrual_nama,
            rekening_akrual.akrual_body,
            rekening_akrual.kode as akrual_kode,
            akun.akun_nama,
            akun.kode
            ');
        $this->db->from('rekening_akrual');
        $this->db->join('akun', 'akun.kode = rekening_akrual.akun_kode');
        $this->db->where('rekening_akrual.akun_kode',$active);
        if($active == true){
            $this->db->where('akun.akun_sort',1);
        } else {
            $this->db->where('akun.akun_sort',0);
        }
        $query = $this->db->get();
        if($query->num_rows() < 1){
            return FALSE;
        }
        return $query->result();        
    }
	
	public function get($select="", $where=""){
		$this->db->select($select);
		$this->db->from("rekening");
		if ($where){$this->db->where($where);}
		$this->db->order_by('rekening.rekening_kode','DESC');
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
		$this->db->from("rekening");
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
	
	public function count_all($where="", $like=""){
		$this->db->select("rekening_kode");
		$this->db->from("rekening");
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