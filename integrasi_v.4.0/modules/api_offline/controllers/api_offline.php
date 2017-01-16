<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	require APPPATH.'/libraries/REST_Controller.php';

	class Api_offline extends REST_Controller {

		public function __construct()
		{
			parent::__construct();
		}
		
		public function Index_get()
		{
			$res = array('message' => 'RKPD Offline API');
			$this->response($res);
		}
	}

/* End of file api_offline.php */
/* Location: ./application/controllers/api_offline.php */