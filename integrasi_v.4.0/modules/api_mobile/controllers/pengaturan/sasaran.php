<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	require APPPATH.'/libraries/REST_Controller.php';

	class sasaran extends REST_Controller {

		public function __construct()
		{
			parent::__construct();
			$this->load->model('sasaran_model');
		}
						
		//grid : url api
		// get : metode request
		public function grid_get($tujuan_kode="")
		{
			if ($tujuan_kode){
				$where_sasaran['sasaran.tujuan']	= $tujuan_kode;
				$sasaran = $this->sasaran_model->grid_all('sasaran.*', 'sasaran.sasaran', 'ASC', 0, 0, $where_sasaran);
			} else {
				$sasaran = $this->sasaran_model->grid_all('sasaran.*', 'sasaran.sasaran', 'ASC');
			}
			
			if(empty($sasaran)){
				$this->response(array('success' => false, 'message' => 'Tidak ada data sasaran', 'responseCode' => 406), 406);
			} else {
				$this->response(array('success' => true, 'message' => 'Success', 'responseCode' => 200, 'data' => $sasaran), 200);
			}
		}

	}

/* End of file sasaran.php */
/* Location: ./application/controllers/sasaran.php */