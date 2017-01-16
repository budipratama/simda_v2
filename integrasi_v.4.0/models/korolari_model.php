<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Korolari_model extends CI_Model  {
	
	var $table = 'ms_korolari';

	function __contsruct(){
        parent::Model();
    }
	
	function insert($data){
       return $this->db->insert("ms_korolari", $data);
	}
	
	function update($data, $kode){
		return $this->db->update("ms_korolari", $data, array('kode' => $kode));	
	}
	
	function delete($kode){
		return $this->db->delete("ms_korolari", array('kode' => $kode));	
	}
	
	public function get_list(){
		$this->db->select("kode_rek1.kd_rek_1 as rek1, kode_rek2.kd_rek_2 as rek2, kode_rek3.kd_rek_3 as rek3, kode_rek4.kd_rek_4 as rek4, kode_rek5.kd_rek_5 as rek5, kode_rek5.nm_rek_5 as rek6, kode_deb1.kd_rek_1 as deb1, kode_deb2.kd_rek_2 as deb2, kode_deb3.kd_rek_3 as deb3, kode_deb4.kd_rek_4 as deb4, kode_deb5.kd_rek_5 as deb5, kode_deb5.nm_rek_5 as deb6, kode_kre1.kd_rek_1 as kre1, kode_kre2.kd_rek_2 as kre2, kode_kre3.kd_rek_3 as kre3, kode_kre4.kd_rek_4 as kre4, kode_kre5.kd_rek_5 as kre5, kode_kre5.nm_rek_5 as kre6");
		$this->db->join('ms_rek_1 as kode_rek1', 'kode_rek1.kode = ms_korolari.kd_rek_1');
		$this->db->join('ms_rek_2 as kode_rek2', 'kode_rek2.kode = ms_korolari.kd_rek_2');
		$this->db->join('ms_rek_3 as kode_rek3', 'kode_rek3.kode = ms_korolari.kd_rek_3');
		$this->db->join('ms_rek_4 as kode_rek4', 'kode_rek4.kode = ms_korolari.kd_rek_4');
		$this->db->join('ms_rek_5 as kode_rek5', 'kode_rek5.kode = ms_korolari.kd_rek_5');		
		$this->db->join('ms_rek_1 as kode_deb1', 'kode_deb1.kode = ms_korolari.d_rek_1');
		$this->db->join('ms_rek_2 as kode_deb2', 'kode_deb2.kode = ms_korolari.d_rek_2');
		$this->db->join('ms_rek_3 as kode_deb3', 'kode_deb3.kode = ms_korolari.d_rek_3');
		$this->db->join('ms_rek_4 as kode_deb4', 'kode_deb4.kode = ms_korolari.d_rek_4');
		$this->db->join('ms_rek_5 as kode_deb5', 'kode_deb5.kode = ms_korolari.d_rek_5');
		$this->db->join('ms_rek_1 as kode_kre1', 'kode_kre1.kode = ms_korolari.k_rek_1');
		$this->db->join('ms_rek_2 as kode_kre2', 'kode_kre2.kode = ms_korolari.k_rek_2');
		$this->db->join('ms_rek_3 as kode_kre3', 'kode_kre3.kode = ms_korolari.k_rek_3');
		$this->db->join('ms_rek_4 as kode_kre4', 'kode_kre4.kode = ms_korolari.k_rek_4');
		$this->db->join('ms_rek_5 as kode_kre5', 'kode_kre5.kode = ms_korolari.k_rek_5');
        $query = $this->db->get('ms_korolari');
        return $query->result();
    }

}