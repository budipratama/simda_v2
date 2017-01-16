<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	require APPPATH.'/libraries/REST_Controller.php';

	class Program extends REST_Controller {

		public function __construct()
		{
			parent::__construct();
			$this->load->model('program_model');
		}
		
		// grid = nama fungsi
		// get = metode request, yang digunakan get dan post.
		public function grid_get()
		{
			$program = $this->program_model->grid_all('program.*', 'kode', 'ASC');
			if(empty($program)){
				$this->response(array('success' => false, 'message' => 'Tidak ada data program', 'responseCode' => 406), 406);
			} else {
				$this->response(array('success' => true, 'message' => 'Success', 'responseCode' => 200, 'data' => $program), 200);
			}
		}
	}

/* End of file program.php */
/* Location: ./application/controllers/program.php */