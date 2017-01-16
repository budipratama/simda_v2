<?php
class Korolari_model extends CI_Model  {

	function __contsruct(){
        parent::Model();
    }
	
	function insert($data){
       return $this->db->insert("korolari", $data);
	}
	
	function update($data, $kode){
		return $this->db->update("korolari", $data, array('kode' => $kode));	
	}
	
	function delete($kode){
		return $this->db->delete("korolari", array('kode' => $kode));	
	}
	
	public function get_rek(){ 
		$this->db->select('rincian.rincian_nama as rincian_nama, rincian.nomor as id_rincian,
		akun.no as id_akun,
		jenis.no as id_jenis,
		kelompok.no as id_kelompok,
		obyek.nomor as id_obyek');
		$this->db->order_by('korolari.kode','DESC');
		$this->db->from('korolari');
		$this->db->join('akun', 'akun.kode = korolari.akun_rek');
		$this->db->join('jenis', 'jenis.kode = korolari.jenis_rek');
		$this->db->join('kelompok', 'kelompok.kode = korolari.kelompok_rek');
		$this->db->join('obyek', 'obyek.kode = korolari.obyek_rek');
		$this->db->join('rincian', 'rincian.kode = korolari.rincian_rek');
        $query = $this->db->get('');
        return $query->result();
    }
	
	public function get_debet(){ 
		$this->db->select('rincian.rincian_nama as rincian_nama, rincian.nomor as id_rincian,
		akun.no as id_akun,
		jenis.no as id_jenis,
		kelompok.no as id_kelompok,
		obyek.nomor as id_obyek');
		$this->db->from('korolari');
		$this->db->join('akun', 'akun.kode = korolari.akun_debet');
		$this->db->join('jenis', 'jenis.kode = korolari.jenis_debet');
		$this->db->join('kelompok', 'kelompok.kode = korolari.kelompok_debet');
		$this->db->join('obyek', 'obyek.kode = korolari.obyek_debet');
		$this->db->join('rincian', 'rincian.kode = korolari.rincian_debet');
        $query = $this->db->get('');
        return $query->row();
    }
	
	public function get_kredit(){ 
		$this->db->select('rincian.rincian_nama as rincian_nama, rincian.nomor as id_rincian,
		akun.no as id_akun,
		jenis.no as id_jenis,
		kelompok.no as id_kelompok,
		obyek.nomor as id_obyek');
		$this->db->from('korolari');
		$this->db->join('akun', 'akun.kode = korolari.akun_kredit');
		$this->db->join('jenis', 'jenis.kode = korolari.jenis_kredit');
		$this->db->join('kelompok', 'kelompok.kode = korolari.kelompok_kredit');
		$this->db->join('obyek', 'obyek.kode = korolari.obyek_kredit');
		$this->db->join('rincian', 'rincian.kode = korolari.rincian_kredit');
        $query = $this->db->get('');
        return $query->row();
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