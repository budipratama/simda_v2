<?php
class Anggaran_model extends CI_Model  {

	function __contsruct(){
        parent::Model();
    }
	
	function insert($table="anggaran", $data){
       return $this->db->insert($table, $data);
	}
	
	function update($table="anggaran", $data, $where){
		return $this->db->update($table, $data, $where);	
	}
	
	function delete($table="anggaran", $where){
		return $this->db->delete($table, $where);	
	}
	
	public function get($tipe="", $select="", $where="", $like=""){
		if ($tipe == 2){
			$this->db->select($select);
			$this->db->from("anggaran");
			$this->db->join("skpd", "anggaran.skpd_kode=skpd.skpd_kode", "left");
			$this->db->join("skpd as pelaksana", "anggaran.pelaksana_kode=pelaksana.skpd_kode", "left");
			$this->db->join("lokasi", "anggaran.lokasi_kode=lokasi.lokasi_kode", "left");
			$this->db->join("skpd as kecamatan", "anggaran.kecamatan_kode=kecamatan.skpd_kd", "left");
			$this->db->join("skpd as deskel", "anggaran.deskel_kode=deskel.skpd_kd", "left");
			$this->db->join("proses", "anggaran.proses_kode=proses.proses_kode", "left");
			$this->db->join("tahapan", "anggaran.tahapan_kode=tahapan.kode", "left");
			$this->db->join("penambahan", "anggaran.penambahan_kode=penambahan.penambahan_kode", "left");
			$this->db->join("anggaran as perubahan", "anggaran.perubahan_id=perubahan.kode", "left");
			$this->db->join("perubahan_status", "anggaran.perubahan_status_kode=perubahan_status.perubahan_status_kode", "left");
			$this->db->join("anggaran_btl", "anggaran.kode=anggaran_btl.anggaran_kode", "left");
			if ($tipe){$this->db->where("anggaran.tipe_kode", $tipe);}
			if ($where){$this->db->where($where);}
			if ($like){
				foreach($like as $key => $value){ 
				$this->db->like($key, $value); 
				}
			}
			$this->db->order_by('anggaran.kode','DESC');
			$this->db->limit(1);
			$query = $this->db->get();
			if ($query->num_rows() == 1){
				return $query->row();
			} else {
				return false;
			}
			
		} else {
			$this->db->select($select);
			$this->db->from("anggaran");
			$this->db->join("skpd", "anggaran.skpd_kode=skpd.skpd_kode", "left");
			$this->db->join("skpd as pelaksana", "anggaran.pelaksana_kode=pelaksana.skpd_kode", "left");
			$this->db->join("lokasi", "anggaran.lokasi_kode=lokasi.lokasi_kode", "left");
			$this->db->join("skpd as kecamatan", "anggaran.kecamatan_kode=kecamatan.skpd_kd", "left");
			$this->db->join("skpd as deskel", "anggaran.deskel_kode=deskel.skpd_kd", "left");
			$this->db->join("proses", "anggaran.proses_kode=proses.proses_kode", "left");
			$this->db->join("tahapan", "anggaran.tahapan_kode=tahapan.kode", "left");
			$this->db->join("sumber", "anggaran.sumber_kode=sumber.sumber_kode", "left");
			$this->db->join("penambahan", "anggaran.penambahan_kode=penambahan.penambahan_kode", "left");
			$this->db->join("anggaran as perubahan", "anggaran.perubahan_id=perubahan.kode", "left");
			$this->db->join("perubahan_status", "anggaran.perubahan_status_kode=perubahan_status.perubahan_status_kode", "left");
			$this->db->join("anggaran_bl", "anggaran.kode=anggaran_bl.anggaran_kode", "left");
			$this->db->join("visi", "anggaran_bl.visi_kode=visi.kode", "left");
			$this->db->join("misi", "anggaran_bl.misi_kode=misi.kode", "left");
			$this->db->join("prioritas", "anggaran_bl.prioritas_kode=prioritas.kode", "left");
			$this->db->join("tujuan", "anggaran_bl.tujuan_kode=tujuan.kode", "left");
			$this->db->join("sasaran", "anggaran_bl.sasaran_kode=sasaran.kode", "left");
			$this->db->join("indikator", "anggaran_bl.indikator_kode=indikator.kode", "left");
			$this->db->join("urusan", "anggaran_bl.urusan_kode=urusan.kode", "left");
			$this->db->join("program", "anggaran_bl.program_kode=program.kode", "left");
			$this->db->join("sifat", "anggaran_bl.sifat_kode=sifat.sifat_kode", "left");
			$this->db->join("kesepakatan", "anggaran_bl.kesepakatan_kode=kesepakatan.kode", "left");
			if ($tipe){$this->db->where("anggaran.tipe_kode", $tipe);}
			if ($where){$this->db->where($where);}
			if ($like){
				foreach($like as $key => $value){ 
				$this->db->like($key, $value); 
				}
			}
			$this->db->order_by('anggaran.kode','DESC');
			$this->db->limit(1);
			$query = $this->db->get();
			if ($query->num_rows() == 1){
				return $query->row();
			} else {
				return false;
			}
		}
	}
	
	public function getOnly($select="", $where="", $like=""){
		$this->db->select($select);
		$this->db->from("anggaran");
		if ($where){$this->db->where($where);}
		if ($like){
			foreach($like as $key => $value){ 
			$this->db->like($key, $value); 
			}
		}
		$this->db->order_by('kode','DESC');
		$this->db->limit(1);
		$query = $this->db->get();
		if ($query->num_rows() == 1){
			return $query->row();
		} else {
			return false;
		}
	}
	
	public function getOnli($select="", $where="", $like=""){
		$this->db->select($select);
		$this->db->from("anggaran_bl");
		if ($where){$this->db->where($where);}
		if ($like){
			foreach($like as $key => $value){ 
			$this->db->like($key, $value); 
			}
		}
		$this->db->order_by('kode','DESC');
		$this->db->limit(1);
		$query = $this->db->get();
		if ($query->num_rows() == 1){
			return $query->row();
		} else {
			return false;
		}
	}
	
	public function grid_all($tipe="", $select="", $sidx="", $sord="", $limit="", $start="", $where="", $like="", $group_by=""){
		if ($tipe == "2"){
			$this->db->select($select);
			$this->db->from("anggaran");
			$this->db->join("skpd", "anggaran.skpd_kode=skpd.skpd_kode", "left");
			$this->db->join("skpd as pelaksana", "anggaran.pelaksana_kode=pelaksana.skpd_kode", "left");
			$this->db->join("lokasi", "anggaran.lokasi_kode=lokasi.lokasi_kode", "left");
			$this->db->join("proses", "anggaran.proses_kode=proses.proses_kode", "left");
			$this->db->join("tahapan", "anggaran.tahapan_kode=tahapan.kode", "left");
			$this->db->join("penambahan", "anggaran.penambahan_kode=penambahan.penambahan_kode", "left");
			$this->db->join("perubahan_status", "anggaran.perubahan_status_kode=perubahan_status.perubahan_status_kode", "left");
			$this->db->join("anggaran_btl", "anggaran.kode=anggaran_btl.anggaran_kode", "left");
			if ($tipe){$this->db->where("anggaran.tipe_kode", $tipe);}
			if ($where){$this->db->where($where);}
			if ($like){
				foreach($like as $key => $value){ 
				$this->db->like($key, $value); 
				}
			}
			if ($group_by){$this->db->group_by($group_by);}
			if ($sidx && $sord) {$this->db->order_by($sidx,$sord);}
			if (!empty($limit)) {$this->db->limit($limit,$start);}
			$query = $this->db->get();
			if ($query->num_rows() > 0){
				return $query->result();
			} else {
				return false;
			}
		} else {
			$this->db->select($select);
			$this->db->from("anggaran");
			$this->db->join("skpd", "anggaran.skpd_kode=skpd.skpd_kode", "left");
			$this->db->join("skpd as pelaksana", "anggaran.pelaksana_kode=pelaksana.skpd_kode", "left");
			$this->db->join("lokasi", "anggaran.lokasi_kode=lokasi.lokasi_kode", "left");
			$this->db->join("proses", "anggaran.proses_kode=proses.proses_kode", "left");
			$this->db->join("tahapan", "anggaran.tahapan_kode=tahapan.kode", "left");
			$this->db->join("sumber", "anggaran.sumber_kode=sumber.sumber_kode", "left");
			$this->db->join("skpd kecamatan", "anggaran.kecamatan_kode=kecamatan.skpd_kd", "left");
			$this->db->join("skpd deskel", "anggaran.deskel_kode=deskel.skpd_kd", "left");
			$this->db->join("penambahan", "anggaran.penambahan_kode=penambahan.penambahan_kode", "left");
			$this->db->join("perubahan_status", "anggaran.perubahan_status_kode=perubahan_status.perubahan_status_kode", "left");
			$this->db->join("anggaran_bl", "anggaran.kode=anggaran_bl.anggaran_kode", "left");
			//$this->db->join("anggaran_bl as anggaran_sebelum", "anggaran.sumber_id=anggaran_sebelum.anggaran_kode", "left");
			$this->db->join("visi", "anggaran_bl.visi_kode=visi.kode", "left");
			$this->db->join("misi", "anggaran_bl.misi_kode=misi.kode", "left");
			$this->db->join("prioritas", "anggaran_bl.prioritas_kode=prioritas.kode", "left");
			$this->db->join("tujuan", "anggaran_bl.tujuan_kode=tujuan.kode", "left");
			$this->db->join("sasaran", "anggaran_bl.sasaran_kode=sasaran.kode", "left");
			$this->db->join("indikator", "anggaran_bl.indikator_kode=indikator.kode", "left");
			$this->db->join("urusan", "anggaran_bl.urusan_kode=urusan.kode", "left");
			$this->db->join("program", "anggaran_bl.program_kode=program.kode", "left");
			$this->db->join("sifat", "anggaran_bl.sifat_kode=sifat.sifat_kode", "left");
			$this->db->join("kesepakatan", "anggaran_bl.kesepakatan_kode=kesepakatan.kode", "left");
			if ($tipe){$this->db->where("anggaran.tipe_kode", $tipe);}
			if ($where){$this->db->where($where);}
			if ($like){
				foreach($like as $key => $value){ 
				$this->db->like($key, $value); 
				}
			}
			if ($group_by){$this->db->group_by($group_by);}
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
	
	public function count_all($where="", $like=""){
		$this->db->select("anggaran.kode");
		$this->db->from("anggaran");
		if ($where){$this->db->where($where);}
		if ($like){
			foreach($like as $key => $value){ 
			$this->db->like($key, $value); 
			}
		}
		$query = $this->db->get();
		return $query->num_rows();
	}
	
	public function count_bl($where="", $like=""){
		$this->db->select("anggaran.kode");
		$this->db->from("anggaran");
		$this->db->join("skpd", "anggaran.skpd_kode=skpd.skpd_kode", "left");
		$this->db->join("anggaran_bl", "anggaran.kode=anggaran_bl.anggaran_kode", "left");
		$this->db->join("visi", "anggaran_bl.visi_kode=visi.kode", "left");
		$this->db->join("misi", "anggaran_bl.misi_kode=misi.kode", "left");
		$this->db->join("prioritas", "anggaran_bl.prioritas_kode=prioritas.kode", "left");
		$this->db->join("tujuan", "anggaran_bl.tujuan_kode=tujuan.kode", "left");
		$this->db->join("sasaran", "anggaran_bl.sasaran_kode=sasaran.kode", "left");
		$this->db->join("indikator", "anggaran_bl.indikator_kode=indikator.kode", "left");
		$this->db->join("urusan", "anggaran_bl.urusan_kode=urusan.kode", "left");
		$this->db->join("program", "anggaran_bl.program_kode=program.kode", "left");
		if ($where){$this->db->where($where);}
		if ($like){
			foreach($like as $key => $value){ 
			$this->db->like($key, $value); 
			}
		}
		$query = $this->db->get();
		return $query->num_rows();
	}
	
	public function grid_report($tipe="", $select="", $sidx="", $sord="", $limit="", $start="", $where="", $like="", $group_by=""){
		if ($tipe == "2"){
			$this->db->select($select);
			$this->db->from("anggaran");
			$this->db->join("skpd", "anggaran.skpd_kode=skpd.skpd_kode", "left");
			$this->db->join("status", "anggaran.status=status.status_kode", "left");
			$this->db->join("skpd pelaksana", "anggaran.pelaksana_kode=pelaksana.skpd_kode", "left");
			$this->db->join("skpd kecamatan", "anggaran.kecamatan_kode=kecamatan.skpd_kd", "left");
			$this->db->join("skpd deskel", "anggaran.deskel_kode=deskel.skpd_kd", "left");
			$this->db->join("anggaran_btl", "anggaran.kode=anggaran_btl.anggaran_kode", "left");
			if ($tipe){$this->db->where("anggaran.tipe_kode", $tipe);}
			if ($where){$this->db->where($where);}
			if ($like){
				foreach($like as $key => $value){ 
				$this->db->like($key, $value); 
				}
			}
			if ($group_by){$this->db->group_by($group_by);}
			if ($sidx && $sord) {$this->db->order_by($sidx,$sord);}
			if (!empty($limit)) {$this->db->limit($limit,$start);}
			$query = $this->db->get();
			if ($query->num_rows() > 0){
				return $query->result();
			} else {
				return false;
			}
		} else {
			$this->db->select($select);
			$this->db->from("anggaran");
			$this->db->join("skpd", "anggaran.skpd_kode=skpd.skpd_kode", "left");
			$this->db->join("status", "anggaran.status=status.status_kode", "left");
			$this->db->join("skpd pelaksana", "anggaran.pelaksana_kode=pelaksana.skpd_kode", "left");
			$this->db->join("skpd kecamatan", "anggaran.kecamatan_kode=kecamatan.skpd_kd", "left");
			$this->db->join("skpd deskel", "anggaran.deskel_kode=deskel.skpd_kd", "left");
			$this->db->join("anggaran_bl", "anggaran.kode=anggaran_bl.anggaran_kode", "left");
			if ($tipe){$this->db->where("anggaran.tipe_kode", $tipe);}
			if ($where){$this->db->where($where);}
			if ($like){
				foreach($like as $key => $value){ 
				$this->db->like($key, $value); 
				}
			}
			if ($group_by){$this->db->group_by($group_by);}
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
}