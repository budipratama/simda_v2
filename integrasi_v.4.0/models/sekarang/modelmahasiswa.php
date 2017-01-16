<?php 
class ModelMahasiswa extends CI_Model{
    
    function getDataMahasiswa(){
        return $this->db->get('mahasiswa')->result();
    }
    
    function insertDataMahasiswa($data){
        $this->db->insert('mahasiswa',$data);    
    }
    
    function DataMahasiswa($nim){
        return $this->db->get_where('mahasiswa',array('nim'=>$nim))->result();        
    }
    
    function updateMahasiswa($data = array()){
        $this->db->where('nim',$data['nim'])->update('mahasiswa',$data);
    }
    
    function deleteMahasiswa($nim) {
        $this->db->where('nim',$nim)->delete('mahasiswa');    
    }
}
?>
