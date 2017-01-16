<?php
class Anggaran_kas_model extends CI_Model  {

	function __contsruct(){
        parent::Model();
    }
	
	public function count_bl($where="", $like=""){
		$this->db->select("anggaran_kas.kode");
		$this->db->from("anggaran_kas");
		$this->db->join("anggaran", "anggaran_kas.anggaran_kode=anggaran.kode", "left");
		$this->db->join("rka", "anggaran_kas.rka=rka.kode", "left");
		$this->db->join("anggaran_bl", "rka.anggaran_kode=anggaran_bl.anggaran_kode", "left");
		$this->db->join("obyek", "rka.obyek=obyek.kode", "left");
		$this->db->join("rincian", "rka.rincian=rincian.kode", "left");
		$this->db->join("tipe", "rka.sumber=tipe.tipe_kode", "left");
		$this->db->join("rka_rincian", "anggaran_kas.rka=rka_rincian.rka", "left");
		$this->db->join("rka_sub", "anggaran_kas.rka=rka_sub.rka", "left");
		$this->db->join("skpd", "anggaran_kas.skpd=skpd.skpd_kode", "left");
		$this->db->join("program", "anggaran_kas.program=program.kode", "left");
		$this->db->join("urusan", "skpd.urusan=urusan.kode", "left");
		if ($where){$this->db->where($where);}
		if ($like){
			foreach($like as $key => $value){ 
			$this->db->like($key, $value); 
			}
		}
		$query = $this->db->get();
		return $query->num_rows();
	}
	
	public function grid_all($tipe="", $select="", $sidx="", $sord="", $limit="", $start="", $where="", $like="", $group_by=""){
		if ($tipe == "2"){
			$this->db->select($select);
			$this->db->from("anggaran_kas");
			$this->db->join("anggaran", "anggaran_kas.anggaran_kode=anggaran.kode", "left");
			$this->db->join("rka", "anggaran_kas.rka=rka.kode", "left");
			$this->db->join("anggaran_bl", "rka.anggaran_kode=anggaran_bl.anggaran_kode", "left");
			$this->db->join("obyek", "rka.obyek=obyek.kode", "left");
			$this->db->join("rincian", "rka.rincian=rincian.kode", "left");
			$this->db->join("tipe", "rka.sumber=tipe.tipe_kode", "left");
			$this->db->join("rka_rincian", "anggaran_kas.rka=rka_rincian.rka", "left");
			$this->db->join("rka_sub", "anggaran_kas.rka=rka_sub.rka", "left");
			$this->db->join("skpd", "anggaran_kas.skpd=skpd.skpd_kode", "left");
			$this->db->join("program", "anggaran_kas.program=program.kode", "left");
			$this->db->join("urusan", "skpd.urusan=urusan.kode", "left");
			if ($tipe){$this->db->where("anggaran_kas.tipe_kode", $tipe);}
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
			$this->db->from("anggaran_kas");
			$this->db->join("anggaran", "anggaran_kas.anggaran_kode=anggaran.kode", "left");
			$this->db->join("rka", "anggaran_kas.rka=rka.kode", "left");
			$this->db->join("anggaran_bl", "rka.anggaran_kode=anggaran_bl.anggaran_kode", "left");
			$this->db->join("obyek", "rka.obyek=obyek.kode", "left");
			$this->db->join("rincian", "rka.rincian=rincian.kode", "left");
			$this->db->join("tipe", "rka.sumber=tipe.tipe_kode", "left");
			$this->db->join("rka_rincian", "anggaran_kas.rka=rka_rincian.rka", "left");
			$this->db->join("rka_sub", "anggaran_kas.rka=rka_sub.rka", "left");
			$this->db->join("skpd", "anggaran_kas.skpd=skpd.skpd_kode", "left");
			$this->db->join("program", "anggaran_kas.program=program.kode", "left");
			$this->db->join("urusan", "skpd.urusan=urusan.kode", "left");
			if ($tipe){$this->db->where("anggaran_kas.tipe_kode", $tipe);}
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