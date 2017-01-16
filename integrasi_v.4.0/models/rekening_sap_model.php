<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Rekening_sap_model extends CI_Model  {
	
	var $table = 'ms_lra_rek';

	function __contsruct(){
        parent::Model();
    }
	
	function insert($data){
       return $this->db->insert("ms_lra_rek", $data);
	}
	
	function update($data, $kode){
		return $this->db->update("ms_lra_rek", $data, array('kode' => $kode));	
	}
	
	function delete($kode){
		return $this->db->delete("ms_lra_rek", array('kode' => $kode));	
	}
	
	public function get_list(){
		$this->db->select("*");
	//	$this->db->join('ms_rek_1 as kode_rek1', 'kode_rek1.kode = ms_korolari.kd_rek_1');
        $query = $this->db->get('ms_lra_rek');
        return $query->result();
    }

}