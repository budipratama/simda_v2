<?php
class Rka_pad_model extends CI_Model  {

	function __contsruct(){
        parent::Model();
    }
	
	function insert($data){
       return $this->db->insert("rka_pad", $data);
	}
	
	function insertr($data){
       return $this->db->insert("rka_padrinc", $data);
	}
	
	function update($data, $kode){
		return $this->db->update("rka_pad", $data, array('kode' => $kode));	
	}
	
	function delete0($kode){
		return $this->db->delete("rka_pad", array('kode' => $kode));	
	}
	
	function delete1($kode){
		return $this->db->join("rka_rincian", "rka.kode = rka_rincian.rka")
					->where("rka_rincian.rka", $kode)
					->delete("rka_rincian");	
	}

	function delete2($kode){
		return $this->db->delete("rka_rincian", array('kode' => $kode));	
	}
	
	public function rincian($list_id,$active = true){
        $this->db->select('rka_padrinc.kode, rka_padrinc.rka_pad as task_id, rka_padrinc.uraian, rka_padrinc.no');
		$this->db->order_by('rka_padrinc.kode','ASC');
        $this->db->from('rka_padrinc');
        $this->db->where('rka_padrinc.rka_pad',$list_id);
        if($active == true){
            $this->db->where('rka_padrinc.tipe_kode',1);
        } else {
            $this->db->where('rka_padrinc.tipe_kode',2);
        }
        $query = $this->db->get();
        if($query->num_rows() < 1){
            return FALSE;
        }
        return $query->result();        
    }
	
	public function bl($id){
		$this->db->select('rka_pad.kode as task_id, skpd.skpd_kode as id_skpd, skpd.skpd_nama as nama_skpd, akun.no as id_akun, kelompok.no as id_kelompok, jenis.no as id_jenis, obyek.no as id_obyek, rincian.no as id_rincian, rincian.rincian_nama as nama_rincian');
		$this->db->order_by('rka_pad.kode','DESC');
        $this->db->from('rka_pad');
		$this->db->join('skpd', 'skpd.skpd_kode = rka_pad.skpd');
		$this->db->join('akun', 'akun.kode = rka_pad.akun');
		$this->db->join('kelompok', 'kelompok.kode = rka_pad.kelompok');
		$this->db->join('jenis', 'jenis.kode = rka_pad.jenis');
		$this->db->join('obyek', 'obyek.kode = rka_pad.obyek');
		$this->db->join('rincian', 'rincian.kode = rka_pad.rincian');
        $this->db->where('rka_pad.kode',$id);
        $query = $this->db->get();
         if($query->num_rows() != 1){
            return FALSE;
        }
        return $query->row();
    }
	
	public function blr($list_id,$active = true){
        $this->db->select('rka_padrinc.rka_pad as task_id, rka_padrinc.no, rka_padrinc.uraian');
		$this->db->order_by('rka_padrinc.kode','DESC');
        $this->db->from('rka_padrinc');
        $this->db->where('rka_padrinc.rka_pad',$list_id);
        if($active == true){
            $this->db->where('rka_padrinc.tipe_kode',1);
        } else {
            $this->db->where('rka_padrinc.tipe_kode',2);
        }
        $query = $this->db->get();
        if($query->num_rows() < 1){
            return FALSE;
        }
        return $query->row();        
    }
	
	public function get_rincian($list_id,$active = true){
        $this->db->select('rka_padrinc.kode, rka_padrinc.rka_pad as task_id, rka_padrinc.no, rka_padrinc.uraian');
		$this->db->order_by('rka_padrinc.kode','ASC');
        $this->db->from('rka_padrinc');
        $this->db->where('rka_padrinc.kode',$list_id);
        if($active == true){
            $this->db->where('rka_padrinc.tipe_kode',1);
        } else {
            $this->db->where('rka_padrinc.tipe_kode',2);
        }
        $query = $this->db->get();
        if($query->num_rows() < 1){
            return FALSE;
        }
        return $query->row();        
    }
	
}