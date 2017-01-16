<?php
class Rka_model extends CI_Model  {

	function __contsruct(){
        parent::Model();
    }
	
	function insert($data){
       return $this->db->insert("rka", $data);
	}
	
	function insertr($data){
       return $this->db->insert("rka_rincian", $data);
	}
	
	function inserts($data){
       return $this->db->insert("rka_sub", $data);
	}
	
	function inserta1($data){
       return $this->db->insert("anggaran_kas", $data);
	}
	
	function inserta($data, $id){
		$this->db->where('rka',$id);
		$q = $this->db->get('anggaran_kas');

		if ( $q->num_rows() > 0 ) {
			$this->db->where('rka',$id);
			$this->db->update('anggaran_kas',$data, array('rka' => $id));
		} else {
			//$this->db->set('kode', $id);
			$this->db->insert('anggaran_kas',$data);
		}
	}
	
	function update($data, $kode){
		return $this->db->update("rka", $data, array('kode' => $kode));	
	}
	
	function updater($data, $kode){
		return $this->db->update("rka_rincian", $data, array('kode' => $kode));	
	}
	
	function updates($data, $kode){
		return $this->db->update("rka_sub", $data, array('kode' => $kode));	
	}
	
	function delete0($kode){
		return $this->db->delete("rka", array('kode' => $kode));	
	}
	
	function delete1($kode){
		return $this->db->join("rka_rincian", "rka.kode = rka_rincian.rka")
					->where("rka_rincian.rka", $kode)
					->delete("rka_rincian");	
	}
	
	function delete2($kode){
		return $this->db->join("rka_sub", "rka_rincian.kode = rka_sub.rka")
					->where("rka_sub.rka", $kode)
					->delete("rka_sub");	
	}
	
	function delete3($kode){
		return $this->db->join("rka_sub", "rka_rincian.kode = rka_sub.rka_rincian")
					->where("rka_sub.rka_rincian", $kode)
					->delete("rka_sub");	
	}
	
	function delete4($kode){
		return $this->db->delete("rka_rincian", array('kode' => $kode));	
	}
	
	function delete5($kode){
		return $this->db->delete("rka_sub", array('kode' => $kode));	
	}
	
	public function create_task($data){
		$insert = $this->db->insert('rka_sub', $data);
		return $insert;
    }
	
	public function get_list_name($list_id){
        $this->db->where('kode',$list_id);
        $query = $this->db->get('rka_rincian');
        return $query->row()->kode;
    }
	
	public function get_bl($list_id,$active = true){
        $this->db->select('rka.kode as task_id, rka.no');
		$this->db->order_by('rka.kode','DESC');
        $this->db->from('rka');
        $this->db->where('rka.anggaran_kode',$list_id);
        if($active == true){
            $this->db->where('rka.tipe_kode',1);
        } else {
            $this->db->where('rka.tipe_kode',2);
        }
        $query = $this->db->get();
        if($query->num_rows() < 1){
            return FALSE;
        }
        return $query->row();        
    }
	
	public function bl($id){
		$this->db->select('rka.kode as task_id,
		rka.no, rka.program, rka.anggaran_kode,
		skpd.skpd_nama as id_skpd,
		skpd.urusan as id_urusan,
		skpd.skpd_alamat as id_alamat,		
		tipe.no as id_tipe,
		akun.no as id_akun,
		akun.akun_nama as nama_akun,
		anggaran.kegiatan as id_kegiatan,
		anggaran.tahun as id_tahun,
		program.program as id_program,
		kelompok.no as id_kelompok,
		jenis.no as id_jenis,
		obyek.no as id_obyek,
		rincian.no as id_rincian,
		rincian.rincian_nama as nama_rincian');
		$this->db->order_by('rka.kode','DESC');
        $this->db->from('rka');
		$this->db->join('skpd', 'skpd.skpd_kode = rka.skpd');
		$this->db->join('tipe', 'tipe.tipe_kode = rka.sumber');
		$this->db->join('anggaran', 'anggaran.kode = rka.anggaran_kode');
		$this->db->join('program', 'program.kode = rka.program');
		$this->db->join('akun', 'akun.kode = rka.akun');
		$this->db->join('kelompok', 'kelompok.kode = rka.kelompok');
		$this->db->join('jenis', 'jenis.kode = rka.jenis');
		$this->db->join('obyek', 'obyek.kode = rka.obyek');
		$this->db->join('rincian', 'rincian.kode = rka.rincian');
        $this->db->where('rka.kode',$id);
        $query = $this->db->get();
         if($query->num_rows() != 1){
            return FALSE;
        }
        return $query->row();
    }
	
	public function belanja($list_id,$active = true){
        $this->db->select('rka.kode as task_id,		
		rka.no,	tipe.no as id_tipe,
		akun.no as id_akun,
		anggaran.kegiatan as id_kegiatan,
		program.program as id_program,
		kelompok.no as id_kelompok,
		jenis.no as id_jenis,
		obyek.no as id_obyek,
		rincian.no as id_rincian,
		rincian.rincian_nama as nama_rincian');
		$this->db->order_by('rka.kode','ASC');
        $this->db->from('rka');
		$this->db->join('tipe', 'tipe.tipe_kode = rka.sumber');
		$this->db->join('anggaran', 'anggaran.kode = rka.anggaran_kode');
		$this->db->join('program', 'program.kode = rka.program');
		$this->db->join('akun', 'akun.kode = rka.akun');
		$this->db->join('kelompok', 'kelompok.kode = rka.kelompok');
		$this->db->join('jenis', 'jenis.kode = rka.jenis');
		$this->db->join('obyek', 'obyek.kode = rka.obyek');
		$this->db->join('rincian', 'rincian.kode = rka.rincian');
        $this->db->where('rka.anggaran_kode',$list_id);
        if($active == true){
            $this->db->where('rka.tipe_kode',1);
        } else {
            $this->db->where('rka.tipe_kode',2);
        }
        $query = $this->db->get();
        if($query->num_rows() < 1){
            return FALSE;
        }
        return $query->result();        
    }
	
	public function rka($list_id,$active = true){
        $this->db->select('rka.kode as task_id,		
		rka.no,	anggaran.kegiatan as id_kegiatan,
		program.program as id_program,
		tipe.no as id_tipe,
		akun.no as id_akun,
		akun.akun_nama as nama_akun,
		kelompok.no as id_kelompok,
		kelompok.kelompok_nama as nama_kelompok,
		jenis.no as id_jenis,
		jenis.jenis_nama as nama_jenis,
		obyek.nomor as id_obyek,
		obyek.obyek_nama as nama_obyek,
		rincian.nomor as id_rincian,
		rincian.rincian_nama as nama_rincian');
		$this->db->order_by('rka.kode','ASC');
        $this->db->from('rka');
		$this->db->join('tipe', 'tipe.tipe_kode = rka.sumber');
		$this->db->join('anggaran', 'anggaran.kode = rka.anggaran_kode');
		$this->db->join('program', 'program.kode = rka.program');
		$this->db->join('akun', 'akun.kode = rka.akun');
		$this->db->join('kelompok', 'kelompok.kode = rka.kelompok');
		$this->db->join('jenis', 'jenis.kode = rka.jenis');
		$this->db->join('obyek', 'obyek.kode = rka.obyek');
		$this->db->join('rincian', 'rincian.kode = rka.rincian');
        $this->db->where('rka.anggaran_kode',$list_id);
        if($active == true){
            $this->db->where('rka.tipe_kode',1);
        } else {
            $this->db->where('rka.tipe_kode',2);
        }
        $query = $this->db->get();
        if($query->num_rows() < 1){
            return FALSE;
        }
        return $query->result();        
    }
	
	public function get_rka($list_id,$active = true){
        $this->db->select('rka.kode as task_id,		
		rka.no,	anggaran.kegiatan as id_kegiatan,
		program.program as id_program,
		tipe.no as id_tipe,
		akun.no as id_akun,
		akun.akun_nama as nama_akun,
		kelompok.no as id_kelompok,
		kelompok.kelompok_nama as nama_kelompok,
		jenis.no as id_jenis,
		jenis.jenis_nama as nama_jenis,
		obyek.nomor as id_obyek,
		obyek.obyek_nama as nama_obyek,
		rincian.nomor as id_rincian,
		rincian.rincian_nama as nama_rincian');
		$this->db->order_by('rka.kode','ASC');
        $this->db->from('rka');
		$this->db->join('tipe', 'tipe.tipe_kode = rka.sumber');
		$this->db->join('anggaran', 'anggaran.kode = rka.anggaran_kode');
		$this->db->join('program', 'program.kode = rka.program');
		$this->db->join('akun', 'akun.kode = rka.akun');
		$this->db->join('kelompok', 'kelompok.kode = rka.kelompok');
		$this->db->join('jenis', 'jenis.kode = rka.jenis');
		$this->db->join('obyek', 'obyek.kode = rka.obyek');
		$this->db->join('rincian', 'rincian.kode = rka.rincian');
        $this->db->where('rka.anggaran_kode',$list_id);
        if($active == true){
            $this->db->where('rka.tipe_kode',1);
        } else {
            $this->db->where('rka.tipe_kode',2);
        }
        $query = $this->db->get();
        if($query->num_rows() < 1){
            return FALSE;
        }
        return $query->row();        
    }
	
	public function blr($list_id,$active = true){
        $this->db->select('rka_rincian.rka as task_id,		
		rka_rincian.no, rka_rincian.rka, rka_rincian.uraian, rka_rincian.anggaran_kode');
		$this->db->order_by('rka_rincian.kode','DESC');
        $this->db->from('rka_rincian');
        $this->db->where('rka_rincian.rka',$list_id);
        if($active == true){
            $this->db->where('rka_rincian.tipe_kode',1);
        } else {
            $this->db->where('rka_rincian.tipe_kode',2);
        }
        $query = $this->db->get();
        if($query->num_rows() < 1){
            return FALSE;
        }
        return $query->row();        
    }
	
	public function rincian($list_id,$active = true){
        $this->db->select('rka_rincian.kode, rka_rincian.rka as task_id,		
		rka_rincian.no, rka_rincian.rka, rka_rincian.uraian');
		$this->db->order_by('rka_rincian.kode','ASC');
        $this->db->from('rka_rincian');
        $this->db->where('rka_rincian.rka',$list_id);
        if($active == true){
            $this->db->where('rka_rincian.tipe_kode',1);
        } else {
            $this->db->where('rka_rincian.tipe_kode',2);
        }
        $query = $this->db->get();
        if($query->num_rows() < 1){
            return FALSE;
        }
        return $query->result();        
    }
	
	public function get_rincian($list_id,$active = true){
        $this->db->select('rka_rincian.kode, rka_rincian.rka as task_id,		
		rka_rincian.no, rka_rincian.rka, rka_rincian.uraian, rka_rincian.anggaran_kode');
		$this->db->order_by('rka_rincian.kode','ASC');
        $this->db->from('rka_rincian');
        $this->db->where('rka_rincian.kode',$list_id);
        if($active == true){
            $this->db->where('rka_rincian.tipe_kode',1);
        } else {
            $this->db->where('rka_rincian.tipe_kode',2);
        }
        $query = $this->db->get();
        if($query->num_rows() < 1){
            return FALSE;
        }
        return $query->row();        
    }
	
	public function bls($list_id,$active = true){
        $this->db->select('rka_sub.rka as task_id,
		rka_sub.no, rka_sub.uraian');
		$this->db->order_by('rka_sub.kode','DESC');
        $this->db->from('rka_sub');
        $this->db->where('rka_sub.rka_rincian',$list_id);
        if($active == true){
            $this->db->where('rka_sub.tipe_kode',1);
        } else {
            $this->db->where('rka_sub.tipe_kode',2);
        }
        $query = $this->db->get();
        if($query->num_rows() < 1){
            return FALSE;
        }
        return $query->row();        
    }
	
	public function sub($list_id,$active = true){
        $this->db->select('rka_sub.kode, rka_sub.rka as task_id,		
		rka_sub.no, rka_sub.uraian, rka_sub.satuan, 
		rka_sub.volume, rka_sub.harga, rka_sub.total');
		$this->db->order_by('rka_sub.kode','DESC');
        $this->db->from('rka_sub');
        $this->db->where('rka_sub.rka_rincian',$list_id);
        if($active == true){
            $this->db->where('rka_sub.tipe_kode',1);
        } else {
            $this->db->where('rka_sub.tipe_kode',2);
        }
        $query = $this->db->get();
        if($query->num_rows() < 1){
            return FALSE;
        }
        return $query->result();        
    }
	
	public function get_sub($id){
		$this->db->select('rka_sub.anggaran_kode, anggaran.kegiatan as id_kegiatan, 
		rka_rincian.no as no_rincian, rka_rincian.uraian as id_rincian');
		$this->db->order_by('rka_sub.kode','DESC');
        $this->db->from('rka_sub');
		$this->db->join('anggaran', 'anggaran.kode = rka_sub.anggaran_kode');
		$this->db->join('rka_rincian', 'rka_rincian.kode = rka_sub.rka_rincian');
        $this->db->where('rka_sub.kode',$id);
        $query = $this->db->get();
         if($query->num_rows() != 1){
            return FALSE;
        }
        return $query->row();
    }
	
	public function sum($list_id,$active = true){
        $this->db->select('rka_sub.rka as task_id,		
		rka_sub.no, rka_sub.uraian, rka_sub.total');
		$this->db->select_sum('total');
		$this->db->order_by('rka_sub.kode','ASC');
        $this->db->from('rka_sub');
        $this->db->where('rka_sub.kode',$list_id);
        if($active == true){
            $this->db->where('rka_sub.tipe_kode',1);
        } else {
            $this->db->where('rka_sub.tipe_kode',2);
        }
        $query = $this->db->get();
        if($query->num_rows() < 1){
            return FALSE;
        }
        return $query->result();        
    }
	
	public function get_sum($list_id){
		$this->db->select_sum('total');		
		$this->db->from('rka_sub');
		$this->db->where('rka_sub.rka',$list_id);
		$query = $this->db->get();
		return $query->row()->total;
    }
	
	public function jum($list_id,$active = true){
		$where = ('anggaran_kode AND rka');
        $this->db->select('rka_sub.rka as task_id,		
		rka_sub.no, rka_sub.uraian, rka_sub.total');
		$this->db->select_sum('total');
		$this->db->order_by('rka_sub.kode','ASC');
        $this->db->from('rka_sub');
		$this->db->where($where);
        if($active == true){
            $this->db->where('rka_sub.tipe_kode',1);
        } else {
            $this->db->where('rka_sub.tipe_kode',2);
        }
        $query = $this->db->get();
        if($query->num_rows() < 1){
            return FALSE;
        }
        return $query->result();        
    }
	
	public function get($select="", $where=""){
		$this->db->select($select);
		$this->db->from("rka");
		$this->db->join("skpd", "rka.skpd=skpd.skpd_kode", "left");
		$this->db->join("program", "rka.program=program.kode", "left");
		$this->db->join("anggaran", "rka.anggaran_kode=anggaran.kode", "left");
		$this->db->join("akun", "rka.akun=akun.kode", "left");
		$this->db->join("kelompok", "rka.kelompok=kelompok.kode", "left");
		$this->db->join("jenis", "rka.jenis=jenis.kode", "left");
		$this->db->join("obyek", "rka.obyek=obyek.kode", "left");
		$this->db->join("rincian", "rka.rincian=rincian.kode", "left");
		if ($where){$this->db->where($where);}
		$this->db->order_by('rka.kode','DESC');
		$this->db->limit(1);
		$query = $this->db->get();
		if ($query->num_rows() == 1){
			return $query->row();
		} else {
			return FALSE;
		}
	}
	
	public function getr($id){
		$this->db->select('rka_rincian.kode as id_kode, rka_rincian.uraian as id_uraian, rka_rincian.no as id_no,
		rka_rincian.rka as id_rka, rka_rincian.anggaran_kode as id_anggaran, anggaran.kegiatan as id_kegiatan');
		$this->db->order_by('rka_rincian.kode','DESC');
        $this->db->from('rka_rincian');
		$this->db->join('anggaran', 'anggaran.kode = rka_rincian.anggaran_kode');
        $this->db->where('rka_rincian.kode',$id);
        $query = $this->db->get();
         if($query->num_rows() != 1){
            return FALSE;
        }
        return $query->row();
    }
	
	public function gets($select="", $where=""){
		$this->db->select($select);
		$this->db->from("rka_sub");
		$this->db->join('anggaran', 'anggaran.kode = rka_sub.anggaran_kode');
		if ($where){$this->db->where($where);}
		$this->db->order_by('rka_sub.kode','DESC');
		$this->db->limit(1);
		$query = $this->db->get();
		if ($query->num_rows() == 1){
			return $query->row();
		} else {
			return FALSE;
		}
	}
	
	public function getak($select="", $where=""){
		$this->db->select($select);
		$this->db->from("anggaran_kas");		
		$this->db->join("skpd", "anggaran_kas.skpd=skpd.skpd_kode", "left");
		$this->db->join("program", "anggaran_kas.program=program.kode", "left");
		$this->db->join("anggaran", "anggaran_kas.anggaran_kode=anggaran.kode", "left");
		if ($where){$this->db->where($where);}
		$this->db->order_by('anggaran_kas.kode','DESC');
		$this->db->limit(1);
		$query = $this->db->get();
		if ($query->num_rows() == 1){
			return $query->row();
		} else {
			return FALSE;
		}
	}
	
	public function grid_all_baru1($select="", $sidx="", $sord="", $limit="", $start="", $where="", $like=""){
		$this->db->select($select);
		$this->db->from("rka");
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
			return FALSE;
		}
	}
	
	public function view($list_id,$active = true){
        $this->db->select('program.program as id_program, program.nomor as no_program, skpd.skpd_nama as id_skpd, 
		skpd.urusan as id_urusan, urusan.urusan as nama_urusan, urusan.jenis as jenis_urusan, skpd.skpd_nomor as no_skpd,
		skpd.skpd_alamat as alamat_skpd, skpd.skpd_status as status_skpd, anggaran.kegiatan as id_anggaran, anggaran.nomor as no_anggaran,
		anggaran_bl.hp_ukur as hpu_anggaran, anggaran_bl.hp_target as hpt_anggaran, anggaran_bl.hp_satuan as hps_anggaran,
		anggaran_bl.kh_ukur as khu_anggaran, anggaran_bl.kh_target as kht_anggaran, anggaran_bl.kh_satuan as khs_anggaran,
		anggaran_bl.hk_ukur as hku_anggaran, anggaran_bl.hk_target as hkt_anggaran, anggaran_bl.hk_satuan as hks_anggaran');
        $this->db->from('rka');
		$this->db->join('skpd', 'skpd.skpd_kode = rka.skpd');
		$this->db->join('urusan', 'urusan.kode = rka.urusan');
		$this->db->join('program', 'program.kode = rka.program');
		$this->db->join('anggaran', 'anggaran.kode = rka.anggaran_kode');
		$this->db->join('anggaran_bl', 'anggaran_bl.kode = rka.anggaran_kode');
		$this->db->where('sumber AND skpd');
		$query = $this->db->get('');
        return $query->row();        
    }
	
	public function getOnly($select="", $where="", $like=""){
		$this->db->select($select);
		$this->db->from("rka");
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
			return FALSE;
		}
	}
	
	public function getOnlyr($select="", $where="", $like=""){
		$this->db->select($select);
		$this->db->from("rka_rincian");
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
			return FALSE;
		}
	}
	
	public function getOnlys($select="", $where="", $like=""){
		$this->db->select($select);
		$this->db->from("rka_sub");
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
			return FALSE;
		}
	}	

	public function grid_ak($tipe="", $select="", $sidx="", $sord="", $limit="", $start="", $where="", $like="", $group_by=""){
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
				return FALSE;
			}
		} else {
			$this->db->select($select);
			$this->db->from("anggaran_kas");
			$this->db->join("anggaran", "anggaran_kas.anggaran_kode=anggaran.kode", "left");
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
				return FALSE;
			}
		}
	}
	
	public function count_bl($where="", $like=""){
		$this->db->select("rka.kode");
		$this->db->from("rka");
		$this->db->join("anggaran", "rka.anggaran_kode=anggaran.kode", "left");
		$this->db->join("anggaran_bl", "rka.anggaran_kode=anggaran_bl.anggaran_kode", "left");
		$this->db->join("skpd", "rka.skpd=skpd.skpd_kode", "left");
		$this->db->join("urusan", "skpd.urusan=urusan.kode", "left");
		$this->db->join("program", "rka.program=program.kode", "left");
		$this->db->join("obyek", "rka.obyek=obyek.kode", "left");
		$this->db->join("rincian", "rka.rincian=rincian.kode", "left");
		$this->db->join("rka_rincian", "rka.kode=rka_rincian.rka", "left");
		$this->db->join("rka_sub", "rka.kode=rka_sub.rka", "left");		
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
			$this->db->from("rka");
			$this->db->join("anggaran", "rka.anggaran_kode=anggaran.kode", "left");
			$this->db->join("skpd", "rka.skpd=skpd.skpd_kode", "left");
			$this->db->join("urusan", "skpd.urusan=urusan.kode", "left");
			$this->db->join("program", "rka.program=program.kode", "left");
			$this->db->join("obyek", "rka.obyek=obyek.kode", "left");
			$this->db->join("rincian", "rka.rincian=rincian.kode", "left");
			$this->db->join("rka_rincian", "rka.kode=rka_rincian.rka", "left");
			$this->db->join("rka_sub", "rka.kode=rka_sub.rka", "left");
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
		} else {
			$this->db->select($select);
			$this->db->from("rka");
			$this->db->join("anggaran", "rka.anggaran_kode=anggaran.kode", "left");
			$this->db->join("anggaran_bl", "rka.anggaran_kode=anggaran_bl.anggaran_kode", "left");
			$this->db->join("skpd", "rka.skpd=skpd.skpd_kode", "left");
			$this->db->join("urusan", "skpd.urusan=urusan.kode", "left");
			$this->db->join("program", "rka.program=program.kode", "left");
			$this->db->join("obyek", "rka.obyek=obyek.kode", "left");
			$this->db->join("rincian", "rka.rincian=rincian.kode", "left");
			$this->db->join("rka_rincian", "rka.kode=rka_rincian.rka", "left");
			$this->db->join("rka_sub", "rka.kode=rka_sub.rka", "left");
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