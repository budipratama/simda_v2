<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mymodels extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  public function insertdata($data){
    if ($this->db->insert('data',$data)) {
      return true;
    }
  }

  public function updatedata($id,$data){
    $this->db->set($data);
    $this->db->where('id',$id);
    if ($this->db->update('data',$data)) {
      return true;
    }
  }

  public function deletedata($id){
    if ($this->db->delete('data','id = '.$id)) {
      return true;
    }
  }
  
  	public function get_list(){
		$this->db->select("*");
        $query = $this->db->get('data');
        return $query->result();
    }

}