<?php
class Api_model extends CI_Model {
    
	public function check_header_key($key)
	{
		$CI =& get_instance();
		$table_name = $CI->config->item('rest_keys_table');
		
		$results = array();
		$this->db->select('a.key_value');
		$this->db->from($table_name.' a');
		$this->db->where('a.key_value = \''.$key.'\' ');
		$query = $this->db->get();
		if ($query->num_rows() > 0){
			$results = $query->row();
		}
		$query->free_result();
		return $results;
	}
	
	public function check_header()
	{
		$CI =& get_instance();
		$key_name = $CI->config->item('rest_key_name');
		
		$header = apache_request_headers();
		$header_key = "";
		$header_value = "";
		foreach ($header as $key => $value){
			if ($key == 'rkpdonlineapikey'){
				$header_key = $key;
				$header_value = $value;
			}
		}
		
		if ($header_key == "rkpdonlineapikey" && $header_value != "" && $this->check_header_key($header_value)){
			$infoHeader = "Success";
		} else {
			$infoHeader = "Unauthorized";
		}
		return $infoHeader;
	}
	
	public function check_static_header()
	{
		$CI =& get_instance();
		$key_name = $CI->config->item('rest_key_name');
		
		$header = apache_request_headers();
		$header_key = "";
		$header_value = "";
		foreach ($header as $key => $value){
			if ($key == 'rkpdonlineapikey'){
				$header_key = $key;
				$header_value = $value;
			}
		}
		
		if ($header_key == "rkpdonlineapikey" && $header_value == "rkpdbekasikabgoid"){
			$infoHeader = "Success";
		} else {
			$infoHeader = "Unauthorized";
		}
		return $infoHeader;
	}
}
?>