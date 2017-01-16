<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends CI_Controller {

	protected $response = NULL;
	protected $_zlib_oc = FALSE;
	
	public function __construct()
	{
		parent::__construct();
		$this->load->library('format');
		$this->load->config('rest');
		$this->load->model('Admin_model');
		$this->load->model('Api_model');
		$this->response = new stdClass();		
		$this->_zlib_oc = @ini_get('zlib.output_compression');
	}
	
	private function post($post) 
	{
		return isset($_POST[$post]) ? $_POST[$post] : '';
	}

	private function get($get) 
	{
		return isset($_GET[$get]) ? $_GET[$get] : '';
	}
	
	private function put($put) 
	{
		return isset($_PUT[$put]) ? $_PUT[$put] : '';
	}
	
	private function delete($delete) 
	{
		return isset($_DELETE[$delete]) ? $_DELETE[$delete] : '';
	}
				
	private function response($data = null, $http_code = null)
	{
		global $CFG;

		// If data is NULL and not code provide, error and bail
		if ($data === NULL && $http_code === null)
		{
			$http_code = 404;

			// create the output variable here in the case of $this->response(array());
			$output = NULL;
		}

		// If data is NULL but http code provided, keep the output empty
		else if ($data === NULL && is_numeric($http_code))
		{
			$output = NULL;
		}

		// Otherwise (if no data but 200 provided) or some data, carry on camping!
		else
		{
			// Is compression requested?
			if ($CFG->item('compress_output') === TRUE && $this->_zlib_oc == FALSE)
			{
				if (extension_loaded('zlib'))
				{
					if (isset($_SERVER['HTTP_ACCEPT_ENCODING']) AND strpos($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip') !== FALSE)
					{
						ob_start('ob_gzhandler');
					}
				}
			}

			is_numeric($http_code) OR $http_code = 200;
			header('Content-Type: application/json');
			$output = $output = $this->format->factory($data)->{'to_json'}();
						
		}

		set_status_header($http_code);

		// If zlib.output_compression is enabled it will compress the output,
		// but it will not modify the content-length header to compensate for
		// the reduction, causing the browser to hang waiting for more data.
		// We'll just skip content-length in those cases.
		if ( ! $this->_zlib_oc && ! $CFG->item('compress_output'))
		{
			header('Content-Length: ' . strlen($output));
		}

		exit($output);
	}
	
	/* Private Data Methods */

	private function _generate_key()
	{
		$this->load->helper('security');
		do
		{
			$salt = do_hash('rkpdonlinekabbekasi_' . time() . mt_rand());
			$new_key = substr($salt, 0, config_item('rest_key_length'));
		}
		// Already in the DB? Fail. Try again
		while (self::_key_exists($new_key));

		return $new_key;
	}
	
	// --------------------------------------------------------------------
	
	private function _get_key($key)
	{
		return $this->db->where(config_item('rest_key_column'), $key)->get(config_item('rest_keys_table'))->row();
	}

	// --------------------------------------------------------------------

	private function _key_exists($key)
	{
		return $this->db->where(config_item('rest_key_column'), $key)->count_all_results(config_item('rest_keys_table')) > 0;
	}

	// --------------------------------------------------------------------
	
	private function _adminuser_exists($admin_user)
	{
		return $this->db->where('admin_user', $admin_user)->count_all_results(config_item('rest_keys_table')) > 0;
	}

	// --------------------------------------------------------------------

	private function _insert_key($key, $admin_user, $data)
	{
		$timestamp = explode(" ",microtime());
		$currenttimemilis = round(($timestamp[0]*1000000) + ($timestamp[1]*1000));
		//$currenttimemilis = time();  
		
		$data[config_item('rest_key_column')] = $key;
		$data['key_id'] = $currenttimemilis;
		$data['admin_user'] = $admin_user;
		$data['date_created'] = time();
		
		// $exp 		= time()-60;
		// $this->db->where("date_created < ".$exp."")->delete(config_item('rest_keys_table'));
		
		return $this->db->set($data)->insert(config_item('rest_keys_table'));
	}

	// --------------------------------------------------------------------

	private function _update_key($key, $data)
	{
		return $this->db->where(config_item('rest_key_column'), $key)->update(config_item('rest_keys_table'), $data);
	}

	// --------------------------------------------------------------------

	private function _delete_key($key)
	{
		return $this->db->where(config_item('rest_key_column'), $key)->delete(config_item('rest_keys_table'));
	}
	
	// --------------------------------------------------------------------

	private function _delete_adminuser($adminuser)
	{
		return $this->db->where('admin_user', $adminuser)->delete(config_item('rest_keys_table'));
	}
	
	public function damel_keys()
	{
		$method = strtolower($this->input->server('REQUEST_METHOD'));
		if($method == 'post'){
			$username 	= $this->input->post('username');
			//$skpd 		= $this->input->post('skpd');
			if ($username){
				if ($this->Admin_model->count_all(array('admin.admin_user'=>$username)) > 0){
					// Build a new key
					$key = self::_generate_key();
					
					// If no key level provided, give them a rubbish one
					$level = $this->post('levels') ? $this->post('levels') : 1;
					$ignore_limits = $this->post('ignore_limits') ? $this->post('ignore_limits') : 1;
					$model = new stdClass();
					if(self::_key_exists($this->input->post('keys')) == true){
						self::_delete_key($this->input->post('keys'));
						
						// Insert the new key
						if (self::_insert_key($key, $username, array('levels' => $level, 'ignore_limits' => $ignore_limits))) {
							$model->key_value = $key;
							self::response(array('success' => true, 'message' => 'Success', 'responseCode' => 200, 'data' => $model), 200);								
						} else {
							self::response(array('success' => false, 'message' => 'Could not save the key.', 'responseCode' => 500), 500); // 500 = Internal Server Error
						}
					} else {
						// Insert the new key
						if (self::_insert_key($key, $username, array('levels' => $level, 'ignore_limits' => $ignore_limits))) {
							$model->key_value = $key;
							self::response(array('success' => true, 'message' => 'Success', 'responseCode' => 200, 'data' => $model), 200);
						} else {
							self::response(array('success' => false, 'message' => 'Could not save the key.', 'responseCode' => 500), 500); // 500 = Internal Server Error
						}
					}
				} else {
					self::response(array('success' => false, 'message' => 'Tidak ada data', 'responseCode' => 406), 406);
				}
			} else {
				self::response(array('success' => false, 'message' => 'Paramter tidak ada', 'responseCode' => 400), 400);
			}
		} else {
			self::response(array('status' => false, 'error' => 'Unknown method.'), 403);
		}
	}
	
	public function hapus_keys()
	{
		$method = strtolower($this->input->server('REQUEST_METHOD'));
		if($method == 'post'){			
			if(self::_key_exists($this->input->post('keys')) == true){
				self::_delete_key($this->input->post('keys'));
				self::response(array('success' => true, 'message' => 'You Proces has been Closed', 'responseCode' => 200), 200);
			} else {
				self::response(array('success' => false, 'message' => 'Key Not Generated', 'responseCode' => 404), 404);
			}
		} else {
			self::response(array('status' => false, 'error' => 'Unknown method.'), 403);
		}
	}
}

/* End of file auth.php */
/* Location: ./application/controllers/auth.php */