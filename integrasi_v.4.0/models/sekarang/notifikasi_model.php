<?php
class Notifikasi_model extends CI_Model  {

	function __contsruct(){
        parent::Model();
    }
	
	function insert($data){
       return $this->db->insert("tabel_pesan", $data);
	}
	

	
}