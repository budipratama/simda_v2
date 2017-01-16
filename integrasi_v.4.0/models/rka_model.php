<?php
class Rka_model extends CI_Model  {

	function __contsruct(){
        parent::Model();
    }
	
	// sudah
	function insert($data){
       return $this->db->insert("ta_belanja", $data);
	}
	
	// sudah
	function insertr($data){
       return $this->db->insert("ta_belanja_rinc", $data);
	}
	
	// sudah
	function inserts($data){
       return $this->db->insert("ta_belanja_rinc_sub", $data);
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
	
	// sudah
	function update($data, $kode){
		return $this->db->update("ta_belanja", $data, array('kode' => $kode));	
	}
	
	// sudah
	function updater($data, $kode){
		return $this->db->update("ta_belanja_rinc", $data, array('kode' => $kode));	
	}
	
	// sudah
	function updates($data, $kode){
		return $this->db->update("ta_belanja_rinc_sub", $data, array('kode' => $kode));	
	}
	
	// sudah
	function delete0($kode){
		return $this->db->delete("ta_belanja", array('kode' => $kode));	
	}
	
	function delete1($kode){
		return $this->db->join("ta_belanja_rinc", "kd_belanja.kode = ta_belanja_rinc.kd_belanja")
					->where("ta_belanja_rinc.kd_belanja", $kode)
					->delete("ta_belanja_rinc");	
	}
	
	function delete2($kode){
		return $this->db->join("ta_belanja_rinc_sub", "ta_belanja_rinc.kode = ta_belanja_rinc_sub.kd_belanja")
					->where("ta_belanja_rinc_sub.kd_belanja", $kode)
					->delete("ta_belanja_rinc_sub");	
	}
	
	function delete3($kode){
		return $this->db->join("ta_belanja_rinc_sub", "ta_belanja_rinc.kode = ta_belanja_rinc_sub.kd_belanja_rinc")
					->where("ta_belanja_rinc_sub.kd_belanja_rinc", $kode)
					->delete("ta_belanja_rinc_sub");	
	}
	
	// sudah
	function delete4($kode){
		return $this->db->delete("ta_belanja_rinc", array('kode' => $kode));	
	}
	
	// sudah
	function delete5($kode){
		return $this->db->delete("ta_belanja_rinc_sub", array('kode' => $kode));	
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
	
	// sudah
	public function get_bl($list_id,$active = true){
        $this->db->select('ta_belanja.kode as task_id, ta_belanja.no');
		$this->db->order_by('ta_belanja.kode','DESC');
        $this->db->from('ta_belanja');
        $this->db->where('ta_belanja.kd_anggaran',$list_id);
        if($active == true){
            $this->db->where('ta_belanja.tipe_bl',1);
        } else {
            $this->db->where('ta_belanja.tipe_bl',2);
        }
        $query = $this->db->get();
        if($query->num_rows() < 1){
            return FALSE;
        }
        return $query->row();        
    }
	
	// sudah
	public function bl($id){
		$this->db->select('ta_belanja.kode as task_id,
		ta_belanja.no, ta_belanja.kd_program, ta_belanja.kd_anggaran,
		skpd.skpd_nama as id_skpd,
		skpd.urusan as id_urusan,
		skpd.skpd_alamat as id_alamat,		
		tipe.no as id_tipe,		
		ms_rek_1.kd_rek_1 as id_akun,
		ms_rek_1.nm_rek_1 as nama_akun,		
		anggaran.kegiatan as id_kegiatan,
		anggaran.tahun as id_tahun,
		program.program as id_program,		
		ms_rek_2.kd_rek_2 as id_kelompok,
		ms_rek_3.kd_rek_3 as id_jenis,
		ms_rek_4.kd_rek_4 as id_obyek,
		ms_rek_5.kd_rek_5 as id_rincian,
		ms_rek_5.nm_rek_5 as nama_rincian');
		$this->db->order_by('ta_belanja.kode','DESC');
        $this->db->from('ta_belanja');
		$this->db->join('skpd', 'skpd.skpd_kode = ta_belanja.kd_skpd');	
		$this->db->join('tipe', 'tipe.tipe_kode = ta_belanja.kd_sumber');
		$this->db->join('anggaran', 'anggaran.kode = ta_belanja.kd_anggaran');
		$this->db->join('program', 'program.kode = ta_belanja.kd_program');
		$this->db->join('ms_rek_1', 'ms_rek_1.kode = ta_belanja.kd_rek_1');
		$this->db->join('ms_rek_2', 'ms_rek_2.kode = ta_belanja.kd_rek_2');
		$this->db->join('ms_rek_3', 'ms_rek_3.kode = ta_belanja.kd_rek_3');
		$this->db->join('ms_rek_4', 'ms_rek_4.kode = ta_belanja.kd_rek_4');
		$this->db->join('ms_rek_5', 'ms_rek_5.kode = ta_belanja.kd_rek_5');
        $this->db->where('ta_belanja.kode',$id);
        $query = $this->db->get();
         if($query->num_rows() != 1){
            return FALSE;
        }
        return $query->row();
    }
	
	// sudah
	public function belanja($list_id,$active = true){
        $this->db->select('ta_belanja.kode as task_id,
		ta_belanja.no,
		tipe.no as id_tipe,
		ms_rek_1.kd_rek_1 as id_akun,
		anggaran.kegiatan as id_kegiatan,
		program.program as id_program,
		ms_rek_2.kd_rek_2 as id_kelompok,
		ms_rek_3.kd_rek_3 as id_jenis,
		ms_rek_4.kd_rek_4 as id_obyek,
		ms_rek_5.kd_rek_5 as id_rincian,
		ms_rek_5.nm_rek_5 as nama_rincian');
		$this->db->order_by('ta_belanja.kode','ASC');
        $this->db->from('ta_belanja');
		$this->db->join('tipe', 'tipe.tipe_kode = ta_belanja.kd_sumber');
		$this->db->join('anggaran', 'anggaran.kode = ta_belanja.kd_anggaran');
		$this->db->join('program', 'program.kode = ta_belanja.kd_program');
		$this->db->join('ms_rek_1', 'ms_rek_1.kode = ta_belanja.kd_rek_1');
		$this->db->join('ms_rek_2', 'ms_rek_2.kode = ta_belanja.kd_rek_2');
		$this->db->join('ms_rek_3', 'ms_rek_3.kode = ta_belanja.kd_rek_3');
		$this->db->join('ms_rek_4', 'ms_rek_4.kode = ta_belanja.kd_rek_4');
		$this->db->join('ms_rek_5', 'ms_rek_5.kode = ta_belanja.kd_rek_5');
        $this->db->where('ta_belanja.kd_anggaran',$list_id);
        if($active == true){
            $this->db->where('ta_belanja.tipe_bl',1);
        } else {
            $this->db->where('ta_belanja.tipe_bl',2);
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
	
	// sudah
	public function blr($list_id,$active = true){
        $this->db->select('ta_belanja_rinc.kd_belanja as task_id,		
		ta_belanja_rinc.no_rinc as no, 
		ta_belanja_rinc.kd_belanja, 
		ta_belanja_rinc.keterangan as uraian, 
		ta_belanja_rinc.kd_belanja');
		$this->db->order_by('ta_belanja_rinc.kode','DESC');
        $this->db->from('ta_belanja_rinc');
        $this->db->where('ta_belanja_rinc.kd_belanja',$list_id);
        if($active == true){
            $this->db->where('ta_belanja_rinc.tipe_bl',1);
        } else {
            $this->db->where('ta_belanja_rinc.tipe_bl',2);
        }
        $query = $this->db->get();
        if($query->num_rows() < 1){
            return FALSE;
        }
        return $query->row();        
    }
	
	// sudah
	public function rincian($list_id,$active = true){
        $this->db->select('ta_belanja_rinc.kode, 
		ta_belanja_rinc.kd_belanja as task_id,		
		ta_belanja_rinc.no_rinc, 
		ta_belanja_rinc.keterangan as uraian');
		$this->db->order_by('ta_belanja_rinc.kode','ASC');
        $this->db->from('ta_belanja_rinc');
        $this->db->where('ta_belanja_rinc.kd_belanja',$list_id);
        if($active == true){
            $this->db->where('ta_belanja_rinc.tipe_bl',1);
        } else {
            $this->db->where('ta_belanja_rinc.tipe_bl',2);
        }
        $query = $this->db->get();
        if($query->num_rows() < 1){
            return FALSE;
        }
        return $query->result();        
    }
	
	// sudah baru ini
	public function get_rincian($list_id,$active = true){
        $this->db->select('ta_belanja_rinc.kode as id_kode, 
		ta_belanja_rinc.kd_belanja as task_id,
		ta_belanja_rinc.no_rinc as no,
		ta_belanja_rinc.keterangan as uraian, 
		ta_belanja_rinc.kd_anggaran,
		anggaran.kegiatan, program.program,		
		ms_rek_1.kd_rek_1 as id_akun, 
		ms_rek_2.kd_rek_2 as id_kelompok,
		ms_rek_3.kd_rek_3 as id_jenis, 
		ms_rek_4.kd_rek_4 as id_obyek, 
		ms_rek_5.kd_rek_5 as id_rincian, 
		ms_rek_5.nm_rek_5 as nama_rincian		
		');
		$this->db->order_by('ta_belanja_rinc.kode','ASC');
        $this->db->from('ta_belanja_rinc');		
		$this->db->join('anggaran', 'anggaran.kode = ta_belanja_rinc.kd_anggaran');
		$this->db->join('anggaran_bl', 'anggaran_bl.anggaran_kode = anggaran.kode');
		$this->db->join('program', 'program.kode = anggaran_bl.program_kode');
		$this->db->join('skpd', 'skpd.skpd_kode = ta_belanja_rinc.kd_skpd');
		$this->db->join('ta_belanja', 'ta_belanja.kode = ta_belanja_rinc.kd_belanja');
		$this->db->join('ms_rek_1', 'ms_rek_1.kode = ta_belanja.kd_rek_1');
		$this->db->join('ms_rek_2', 'ms_rek_2.kode = ta_belanja.kd_rek_2');
		$this->db->join('ms_rek_3', 'ms_rek_3.kode = ta_belanja.kd_rek_3');
		$this->db->join('ms_rek_4', 'ms_rek_4.kode = ta_belanja.kd_rek_4');
		$this->db->join('ms_rek_5', 'ms_rek_5.kode = ta_belanja.kd_rek_5');
        $this->db->where('ta_belanja_rinc.kode',$list_id);
        if($active == true){
            $this->db->where('ta_belanja_rinc.tipe_bl',1);
        } else {
            $this->db->where('ta_belanja_rinc.tipe_bl',2);
        }
        $query = $this->db->get();
        if($query->num_rows() < 1){
            return FALSE;
        }
        return $query->row();        
    }

	// sudah
	public function bls($list_id,$active = true){
        $this->db->select('ta_belanja_rinc_sub.kd_belanja as task_id,
		ta_belanja_rinc_sub.no, ta_belanja_rinc_sub.keterangan');
		$this->db->order_by('ta_belanja_rinc_sub.kode','DESC');
        $this->db->from('ta_belanja_rinc_sub');
        $this->db->where('ta_belanja_rinc_sub.kd_belanja_rinc',$list_id);
        if($active == true){
            $this->db->where('ta_belanja_rinc_sub.tipe_bl',1);
        } else {
            $this->db->where('ta_belanja_rinc_sub.tipe_bl',2);
        }
        $query = $this->db->get();
        if($query->num_rows() < 1){
            return FALSE;
        }
        return $query->row();        
    }
	
	// sudah
	public function sub($list_id,$active = true){
        $this->db->select('ta_belanja_rinc_sub.kode, 
		ta_belanja_rinc_sub.kd_belanja as task_id,
		ta_belanja_rinc_sub.no, ta_belanja_rinc_sub.keterangan
		');
		$this->db->order_by('ta_belanja_rinc_sub.kode','DESC');
        $this->db->from('ta_belanja_rinc_sub');
        $this->db->where('ta_belanja_rinc_sub.kd_belanja_rinc',$list_id);
        if($active == true){
            $this->db->where('ta_belanja_rinc_sub.tipe_bl',1);
        } else {
            $this->db->where('ta_belanja_rinc_sub.tipe_bl',2);
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
	
	// sudah
	public function get($select="", $where=""){
		$this->db->select($select);
		$this->db->from("ta_belanja");
		$this->db->join('skpd', 'skpd.skpd_kode = ta_belanja.kd_skpd');	
		$this->db->join('anggaran', 'anggaran.kode = ta_belanja.kd_anggaran');
		$this->db->join('program', 'program.kode = ta_belanja.kd_program');
		$this->db->join('ms_rek_1', 'ms_rek_1.kode = ta_belanja.kd_rek_1');
		$this->db->join('ms_rek_2', 'ms_rek_2.kode = ta_belanja.kd_rek_2');
		$this->db->join('ms_rek_3', 'ms_rek_3.kode = ta_belanja.kd_rek_3');
		$this->db->join('ms_rek_4', 'ms_rek_4.kode = ta_belanja.kd_rek_4');
		$this->db->join('ms_rek_5', 'ms_rek_5.kode = ta_belanja.kd_rek_5');
		if ($where){$this->db->where($where);}
		$this->db->order_by('ta_belanja.kode','DESC');
		$this->db->limit(1);
		$query = $this->db->get();
		if ($query->num_rows() == 1){
			return $query->row();
		} else {
			return FALSE;
		}
	}
	
	// sudah
	public function getr($select="", $where=""){
		$this->db->select($select);
		$this->db->from("ta_belanja_rinc");
		if ($where){$this->db->where($where);}
		$this->db->order_by('ta_belanja_rinc.kode','DESC');
		$this->db->limit(1);
		$query = $this->db->get();
		if ($query->num_rows() == 1){
			return $query->row();
		} else {
			return FALSE;
		}
	}
	
	public function getr1($id){
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
	
	// sudah
	public function getOnly($select="", $where="", $like=""){
		$this->db->select($select);
		$this->db->from("ta_belanja");
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
	
	//sudah
	public function getOnlyr($select="", $where="", $like=""){
		$this->db->select($select);
		$this->db->from("ta_belanja_rinc");
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
	
	//sudah
	public function getOnlys($select="", $where="", $like=""){
		$this->db->select($select);
		$this->db->from("ta_belanja_rinc_sub");
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