<?php
class Data_model extends CI_Model  {

	function __contsruct() {
        parent::Model();
    }
    
	function get_rka(){
		$this->db->select('rka.kode as id_rka, rka.no, obyek.nomor as obyek_no, obyek.obyek_nama as obyek_nama');
        $this->db->from('rka');
		$this->db->join('obyek', 'rka.obyek = obyek.kode');
		$this->db->join('rka_sub', 'rka.kode = rka_sub.kode');
		$this->db->where('rka.tipe_kode',1);
		$this->db->or_where('rka.jenis',63);
		$this->db->or_where('rka.tahun',2017);
		$this->db->or_where('rka.anggaran_kode',6);
		$this->db->group_by('rka.kode'); 
		$this->db->order_by('rka.kode', 'ASC'); 
        $query = $this->db->get('');
        return $query->result();
    }
	
	function get_rka1(){
		$this->db->select('rka.kode as id_rka, rka.no, obyek.nomor as obyek_no, obyek.obyek_nama as obyek_nama');
        $this->db->from('rka');
		$this->db->join('obyek', 'rka.obyek = obyek.kode');
		$this->db->join('rka_sub', 'rka.kode = rka_sub.kode');
		$this->db->where('rka.tipe_kode',1);
		$this->db->or_where('rka.jenis',63);
		$this->db->or_where('rka.tahun',2017);
		$this->db->or_where('rka.anggaran_kode',6);
		$this->db->group_by('rka.kode'); 
		$this->db->order_by('rka.kode', 'ASC'); 
        $query = $this->db->get('');
        return $query->num_rows();
    }
	
	function get_rincian(){
		$this->db->select('rka_rincian.kode as id_rincian, rka_rincian.no as rincian_no, rka_rincian.uraian as rincian_nama');
        $this->db->from('rka_rincian');
		$this->db->join('rka', 'rka.kode = rka_rincian.kode');
		$this->db->where('rka_rincian.tipe_kode',1);
		$this->db->or_where('rka.tahun',2017);
		$this->db->or_where('rka_rincian.rka',1);
		$this->db->group_by('rka_rincian.kode'); 
		$this->db->order_by('rka_rincian.kode', 'ASC'); 
        $query = $this->db->get('');
        return $query->result();
    }
	
	function get_sub(){
		$this->db->select('rka_sub.kode as id_sub, rka_sub.rka, rka_sub.total, rka_sub.harga, rka_sub.satuan, rka_sub.volume, rka_sub.no as rincian_no, rka_sub.uraian');
        $this->db->from('rka_sub');
		$this->db->join('rka', 'rka.kode = rka_sub.kode');
		$this->db->where('rka_sub.tipe_kode',1);
		$this->db->or_where('rka_sub.rka');
		$this->db->or_where('rka_sub.rka_rincian');
		$this->db->group_by('rka_sub.kode'); 
		$this->db->order_by('rka_sub.kode', 'ASC'); 
        $query = $this->db->get('');
        return $query->result();
    }
	
	function select_rka($list_id){
		$this->db->select('rka.no, rincian.rincian_nama as nama_rincian');
        $this->db->from('rka');
		$this->db->join('rincian', 'rincian.kode = rka.rincian');
        $query = $this->db->get('');
        return $query->result();
    }
	
	function select_rincian($list_id){
		$this->db->select('rka_rincian.no, rincian.rincian_nama as nama_rincian');
        $this->db->from('rka_rincian');
		$this->db->join('rincian', 'rincian.kode = rka_rincian.rka');
        $query = $this->db->get('');
        return $query->result();
    }
	
	function select_data($list_id){
		$this->db->select('rka.no, rincian.rincian_nama as nama_rincian');
        $this->db->from('rka');
		$this->db->join('rincian', 'rincian.kode = rka.rincian');
        $query = $this->db->get('');
        return $query->result();
    }
	
	function select_get($list_id) {
        $query = $this->db->get('rka_sub');
        return $query->row();
    }
	
	function select_num($list_id) {
		$this->db->select('*');
        $this->db->from('rka_sub');
        $query = $this->db->get('');
        return $query->num_rows();
    }
}