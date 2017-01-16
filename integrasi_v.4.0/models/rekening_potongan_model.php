<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Rekening_potongan_model extends CI_Model  {
	
	var $table = 'ms_pot_spm_rek';

	function __contsruct(){
        parent::Model();
    }
	
	function insert($data){
       return $this->db->insert("ms_pot_spm_rek", $data);
	}
	
	function update($data, $kode){
		return $this->db->update("ms_pot_spm_rek", $data, array('kode' => $kode));	
	}
	
	function delete($kode){
		return $this->db->delete("ms_pot_spm_rek", array('kode' => $kode));	
	}
	
	public function get_by_id($id){
		$this->db->from($this->table);
		$this->db->where('kode',$id);
		$query = $this->db->get();

		return $query->row();
	}
	
	public function get_list(){
		$this->db->select("ms_pot_spm_rek.kd_pot_rek as rekening, ms_rek_5.nm_rek_5 as nm_rekening, ms_pot_spm.kd_pot as potongan, ms_pot_spm.nm_pot as nm_potongan, ms_rek_1.kd_rek_1 as akun, ms_rek_2.kd_rek_2 as kelompok, ms_rek_3.kd_rek_3 as jenis, ms_rek_4.kd_rek_4 as obyek, ms_rek_5.kd_rek_5 as rincian, ms_rek_5.nm_rek_5 as nama");
		$this->db->join('ms_pot_spm', 'ms_pot_spm.kode = ms_pot_spm_rek.kd_pot');		
		$this->db->join('ms_rek_1', 'ms_rek_1.kode = ms_pot_spm_rek.kd_rek_1');
		$this->db->join('ms_rek_2', 'ms_rek_2.kode = ms_pot_spm_rek.kd_rek_2');
		$this->db->join('ms_rek_3', 'ms_rek_3.kode = ms_pot_spm_rek.kd_rek_3');
		$this->db->join('ms_rek_4', 'ms_rek_4.kode = ms_pot_spm_rek.kd_rek_4');
		$this->db->join('ms_rek_5', 'ms_rek_5.kode = ms_pot_spm_rek.kd_rek_5');
        $query = $this->db->get('ms_pot_spm_rek');
        return $query->result();
    }
	
	public function grid_all($select="", $sidx="", $sord="", $limit="", $start="", $where="", $like=""){
		$this->db->select($select);
		$this->db->from("ms_pot_spm");
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
			return false;
		}
	}

}