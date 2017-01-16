<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Bank_model extends CI_Model  {
	
	var $table = 'ms_bank';

	function __contsruct(){
        parent::Model();
    }
	
	function insert($data){
       return $this->db->insert("ms_bank", $data);
	}
	
	function update($data, $kode){
		return $this->db->update("ms_bank", $data, array('kode' => $kode));	
	}
	
	function delete($kode){
		return $this->db->delete("ms_bank", array('kode' => $kode));	
	}
	
	public function get_by_id($id){
		$this->db->from($this->table);
		$this->db->where('kode',$id);
		$query = $this->db->get();

		return $query->row();
	}
	
	public function get_list(){
		$this->db->select("ms_bank.kd_bank as no, ms_bank.nm_bank as bank, ms_bank.no_rekening as rekening, ms_rek_1.kd_rek_1 as akun, ms_rek_2.kd_rek_2 as kelompok, ms_rek_3.kd_rek_3 as jenis, ms_rek_4.kd_rek_4 as obyek, ms_rek_5.kd_rek_5 as rincian, ms_rek_5.nm_rek_5 as nama");
		$this->db->join('ms_rek_1', 'ms_rek_1.kode = ms_bank.kd_rek_1');
		$this->db->join('ms_rek_2', 'ms_rek_2.kode = ms_bank.kd_rek_2');
		$this->db->join('ms_rek_3', 'ms_rek_3.kode = ms_bank.kd_rek_3');
		$this->db->join('ms_rek_4', 'ms_rek_4.kode = ms_bank.kd_rek_4');
		$this->db->join('ms_rek_5', 'ms_rek_5.kode = ms_bank.kd_rek_5');
        $query = $this->db->get('ms_bank');
        return $query->result();
    }

}