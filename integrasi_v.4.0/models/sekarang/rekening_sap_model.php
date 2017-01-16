<?php
class Rekening_sap_model extends CI_Model  {

	function __contsruct(){
        parent::Model();
    }
	
	function insert($data){
       return $this->db->insert("rekening_sap", $data);
	}
	
	function update($data, $kode){
		return $this->db->update("rekening_sap", $data, array('kode' => $kode));	
	}
	
	function delete($kode){
		return $this->db->delete("rekening_sap", array('kode' => $kode));	
	}
	
	public function get_dagri(){ 
		$this->db->select('rincian.rincian_nama as rincian_nama, rincian.nomor as id_rincian,
		akun.no as id_akun,
		jenis.no as id_jenis,
		kelompok.no as id_kelompok,
		obyek.nomor as id_obyek');
		$this->db->order_by('rekening_sap.kode','DESC');
		$this->db->from('rekening_sap');
		$this->db->join('akun', 'akun.kode = rekening_sap.akun_dagri');
		$this->db->join('jenis', 'jenis.kode = rekening_sap.jenis_dagri');
		$this->db->join('kelompok', 'kelompok.kode = rekening_sap.kelompok_dagri');
		$this->db->join('obyek', 'obyek.kode = rekening_sap.obyek_dagri');
		$this->db->join('rincian', 'rincian.kode = rekening_sap.rincian_dagri');
        $query = $this->db->get('');
        return $query->result();
    }
	
	public function get_sap(){ 
		$this->db->select('rincian.rincian_nama as rincian_nama, rincian.nomor as id_rincian,
		akun.no as id_akun,
		jenis.no as id_jenis,
		kelompok.no as id_kelompok,
		obyek.nomor as id_obyek');
		$this->db->from('rekening_sap');
		$this->db->join('akun', 'akun.kode = rekening_sap.akun_sap');
		$this->db->join('jenis', 'jenis.kode = rekening_sap.jenis_sap');
		$this->db->join('kelompok', 'kelompok.kode = rekening_sap.kelompok_sap');
		$this->db->join('obyek', 'obyek.kode = rekening_sap.obyek_sap');
		$this->db->join('rincian', 'rincian.kode = rekening_sap.rincian_sap');
        $query = $this->db->get('');
        return $query->row();
    }
	
	public function grid_all($select="", $sidx="", $sord="", $limit="", $start="", $where="", $like=""){
		$this->db->select($select);
		$this->db->from("rekening_sap");
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
		$this->db->from("rekening_sap");
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