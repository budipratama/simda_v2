<?php
class Belanja_wajib_model extends CI_Model  {

	function __contsruct(){
        parent::Model();
    }
	
	function insert($data){
       return $this->db->insert("belanja_wajib", $data);
	}
	
	function update($data, $kode){
		return $this->db->update("belanja_wajib", $data, array('kode' => $kode));	
	}
	
	function delete($kode){
		return $this->db->delete("belanja_wajib", array('kode' => $kode));	
	}
	
	public function get_task_data($id){
        $this->db->where('kode',$id);
        $query = $this->db->get('belanja_wajib');
        return $query->row();
    }
	
	public function get_all(){ 
		$this->db->select('belanja_wajib.kode as task_id,
		akun.no as id_akun,
		kelompok.no as id_kelompok,
		jenis.no as id_jenis,
		obyek.nomor as id_obyek,
		rincian.nomor as id_rincian,
		rincian.rincian_nama as nama_rincian');
		$this->db->order_by('belanja_wajib.kelompok','ASC');
        $this->db->from('belanja_wajib');
		$this->db->join('akun', 'akun.kode = belanja_wajib.akun');
		$this->db->join('kelompok', 'kelompok.kode = belanja_wajib.kelompok');
		$this->db->join('jenis', 'jenis.kode = belanja_wajib.jenis');
		$this->db->join('obyek', 'obyek.kode = belanja_wajib.obyek');
		$this->db->join('rincian', 'rincian.kode = belanja_wajib.rincian');
        $query = $this->db->get();
        return $query->result();
    }
	
	public function get_list($id){
        $this->db->select('*');
        $this->db->from('akun');
        $this->db->where('kode',$id);
        $query = $this->db->get();
         if($query->num_rows() != 1){
            return FALSE;
        }
        return $query->row();
    }
	
	public function get($select="", $where=""){
		$this->db->select($select);
		$this->db->from("belanja_wajib");
		if ($where){$this->db->where($where);}
		$this->db->order_by('belanja_wajib.kode','ASC');
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
		$this->db->from("akun");
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
		$this->db->from("akun");
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