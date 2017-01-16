<?php
class Organisasi_blud_model extends CI_Model  {

	function __contsruct(){
        parent::Model();
    }
	
	function insert($data){
       return $this->db->insert("organisasi_blud", $data);
	}
	
	function update($data, $kode){
		return $this->db->update("organisasi_blud", $data, array('kode' => $kode));	
	}
	
	function delete($kode){
		return $this->db->delete("organisasi_blud", array('kode' => $kode));	
	}
	
	public function get_all_lists(){ 
		$this->db->select('sub.sub_nama as sub_nama, sub.no as id_sub,
		tipe.no as id_tipe,
		urusan.no as id_urusan,
		skpd.skpd_no as id_skpd');
		$this->db->order_by('organisasi_blud.kode','DESC');
		$this->db->from('organisasi_blud');
		$this->db->join('tipe', 'tipe.tipe_kode = organisasi_blud.tipe');
		$this->db->join('urusan', 'urusan.kode = organisasi_blud.urusan');
		$this->db->join('skpd', 'skpd.skpd_kode = organisasi_blud.skpd');
		$this->db->join('sub', 'sub.kode = organisasi_blud.sub');
		$this->db->where('organisasi_blud.tipe_sort',1);
        $query = $this->db->get('');
        return $query->result();
    }
	
	public function get($select="", $where=""){
		$this->db->select($select);
		$this->db->from("organisasi_blud");
		if ($where){$this->db->where($where);}
		$this->db->order_by('organisasi_blud.kode','DESC');
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
		$this->db->from("organisasi_blud");
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
		$this->db->from("organisasi_blud");
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