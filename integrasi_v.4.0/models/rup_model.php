<?php
class Rup_model extends CI_Model  {

	function __contsruct(){
        parent::Model();
    }
		
	function insert($table="rup", $data){
       return $this->db->insert($table, $data);
	}
	
	public function grid_jenis($select="", $sidx="", $sord="", $limit="", $start="", $where="", $like=""){
		$this->db->select($select);
		$this->db->from("rup_jenis");
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
	public function grid_metode($select="", $sidx="", $sord="", $limit="", $start="", $where="", $like=""){
		$this->db->select($select);
		$this->db->from("rup_metode");
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
	
	public function grid_rka($select="", $sidx="", $sord="", $limit="", $start="", $where="", $like=""){
		$this->db->select($select);
		$this->db->from("rka");
		$this->db->join('rincian', 'rincian.kode = rka.rincian');
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
	
	public function getOnly($select="", $where="", $like=""){
		$this->db->select($select);
		$this->db->from("rup");
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
	
	public function get_task($list_id,$active = true){
        $this->db->select('rup.kode as id_kode, rup.pagu, rup.metode, rup.sumber, rup.aktif, anggaran.kegiatan as nama_kegiatan');
		$this->db->order_by('rup.kode','ASC');
        $this->db->from('rup');
		$this->db->join('anggaran', 'anggaran.kode = rup.anggaran_kode');
        $this->db->where('rup.anggaran_kode',$list_id);
        if($active == true){
            $this->db->where('rup.tipe_rup',1);
        } else {
            $this->db->where('rup.tipe_rup',2);
        }
        $query = $this->db->get();
        if($query->num_rows() < 1){
            return FALSE;
        }
        return $query->result();        
    }
	
	public function get_laporan($select="", $where=""){
		$this->db->select($select);
		$this->db->from("anggaran");
		$this->db->join("anggaran_bl", "anggaran.kode=anggaran_bl.anggaran_kode", "left");
		$this->db->join("program", "anggaran_bl.program_kode=program.kode", "left");
		if ($where){$this->db->where($where);}
		$this->db->order_by('anggaran.kode','DESC');
		$this->db->limit(1);
		$query = $this->db->get();
		if ($query->num_rows() == 1){
			return $query->row();
		} else {
			return false;
		}
	}
	
	public function get($tipe="", $select="", $where="", $like=""){
		if ($tipe == 2){
			$this->db->select($select);
			$this->db->from("rup");
			$this->db->join("rincian", "rup.rincian=rincian.kode", "left");
			$this->db->join("anggaran", "rup.anggaran_kode=anggaran.kode", "left");			
			$this->db->join("anggaran_bl", "rup.anggaran_kode=anggaran_bl.anggaran_kode", "left");
			$this->db->join("skpd", "anggaran.skpd_kode=skpd.skpd_kode", "left");
			$this->db->join("rup_jenis", "rup.jenis_belanja=rup_jenis.kode", "left");
			$this->db->join("rup_metode", "rup.metode=rup_metode.kode", "left");
			if ($tipe){$this->db->where("rup.tipe_kode", $tipe);}
			if ($where){$this->db->where($where);}
			if ($like){
				foreach($like as $key => $value){ 
				$this->db->like($key, $value); 
				}
			}
			$this->db->order_by('rup.kode','DESC');
			$this->db->limit(1);
			$query = $this->db->get();
			if ($query->num_rows() == 1){
				return $query->row();
			} else {
				return false;
			}			
		} else {
			$this->db->select($select);
			$this->db->from("rup");
			$this->db->join("rincian", "rup.rincian=rincian.kode", "left");
			$this->db->join("anggaran", "rup.anggaran_kode=anggaran.kode", "left");			
			$this->db->join("anggaran_bl", "rup.anggaran_kode=anggaran_bl.anggaran_kode", "left");
			$this->db->join("skpd", "anggaran.skpd_kode=skpd.skpd_kode", "left");
			$this->db->join("rup_jenis", "rup.jenis_belanja=rup_jenis.kode", "left");
			$this->db->join("rup_metode", "rup.metode=rup_metode.kode", "left");
			if ($tipe){$this->db->where("rup.tipe_kode", $tipe);}
			if ($where){$this->db->where($where);}
			if ($like){
				foreach($like as $key => $value){ 
				$this->db->like($key, $value); 
				}
			}
			$this->db->order_by('rup.kode','DESC');
			$this->db->limit(1);
			$query = $this->db->get();
			if ($query->num_rows() == 1){
				return $query->row();
			} else {
				return false;
			}
		}
	}
	
	public function get_list1($id){
        $this->db->select('rup_jenis.jenis_nama as pengadaan');
        $this->db->from('rup');
		$this->db->join("rup_jenis", "rup.jenis_pengadaan=rup_jenis.kode", "left");
        $this->db->where('rup.kode',$id);
        $query = $this->db->get();
         if($query->num_rows() != 1){
            return FALSE;
        }
        return $query->row();
    }
	
	public function get_list2($id){
        $this->db->select('rup_jenis.jenis_nama as sumber');
        $this->db->from('rup');
		$this->db->join("rup_jenis", "rup.sumber_dana=rup_jenis.kode", "left");
        $this->db->where('rup.kode',$id);
        $query = $this->db->get();
         if($query->num_rows() != 1){
            return FALSE;
        }
        return $query->row();
    }
		
	public function get_bl($select="", $sidx="", $sord="", $limit="", $start="", $where="", $like="", $group=""){
		$this->db->select($select);
		$this->db->from("anggaran");
		$this->db->join("tahapan", "anggaran.tahapan_kode=tahapan.kode", "left");		
		$this->db->join("tipe", "anggaran.tipe_kode=tipe.tipe_kode", "left");
		$this->db->join("skpd", "anggaran.skpd_kode=skpd.skpd_kode", "left");
		$this->db->join("tahun", "anggaran.tahun=tahun.tahun", "left");
		$this->db->join("anggaran_bl", "anggaran.kode=anggaran_bl.anggaran_kode", "left");
		$this->db->join("program", "anggaran_bl.program_kode=program.kode", "left");
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
	
	public function grid_all($select="", $sidx="", $sord="", $limit="", $start="", $where="", $like="", $group=""){
		$this->db->select($select);
		$this->db->from("anggaran");
		$this->db->join("skpd", "anggaran.skpd_kode=skpd.skpd_kode", "left");
		$this->db->join("skpd as pelaksana", "anggaran.pelaksana_kode=pelaksana.skpd_kode", "left");
		$this->db->join("tipe", "anggaran.tipe_kode=tipe.tipe_kode", "left");
		$this->db->join("tahun", "anggaran.tahun=tahun.tahun", "left");
		$this->db->join("lokasi", "anggaran.lokasi_kode=lokasi.lokasi_kode", "left");
		$this->db->join("proses", "anggaran.proses_kode=proses.proses_kode", "left");
		$this->db->join("tahapan", "anggaran.tahapan_kode=tahapan.kode", "left");
		$this->db->join("penambahan", "anggaran.penambahan_kode=penambahan.penambahan_kode", "left");
		$this->db->join("perubahan_status", "anggaran.perubahan_status_kode=perubahan_status.perubahan_status_kode", "left");
		$this->db->join("anggaran_bl", "anggaran.kode=anggaran_bl.anggaran_kode", "left");
		$this->db->join("program", "anggaran_bl.program_kode=program.kode", "left");
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
	
	public function grid_all1($tipe="", $select="", $sidx="", $sord="", $limit="", $start="", $where="", $like="", $group_by=""){
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
			$this->db->from("rka");
			$this->db->join("skpd", "rka.skpd=skpd.skpd_kode", "left");
			$this->db->join("obyek", "rka.obyek=obyek.kode", "left");
		//	$this->db->join("anggaran_bl", "anggaran.kode=anggaran_bl.anggaran_kode", "left");
		//	$this->db->join("program", "anggaran_bl.program_kode=program.kode", "left");
			if ($tipe){$this->db->where("rka.tipe_kode", $tipe);}
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