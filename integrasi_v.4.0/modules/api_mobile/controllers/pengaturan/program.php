<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	require APPPATH.'/libraries/REST_Controller.php';

	class program extends REST_Controller {

		public function __construct()
		{
			parent::__construct();
			$this->load->model('program_model');
		}
					
		//grid : url api 
		// get : metode request 
		public function grid_get($urusan_kode="")
		{
			if ($urusan_kode){
				$where_program['program.urusan']	= $urusan_kode;
				$program = $this->program_model->grid_all('program.*', 'program.program', 'ASC', 0, 0, $where_program);
			} else {
				$program = $this->program_model->grid_all('program.*', 'program.program', 'ASC');
			}
			
			if(empty($program)){
				$this->response(array('success' => false, 'message' => 'Tidak ada data program', 'responseCode' => 406), 406);
			} else {
				$this->response(array('success' => true, 'message' => 'Success', 'responseCode' => 200, 'data' => $program), 200);
			}
		}
		
		public function get_get($program_kode="")
		{
			if ($program_kode){
				//query belum masih salah
				$program = $this->program_model->get('program.*', array('program.kode'=>$program_kode));
				if(empty($program)){
					$this->response(array('success' => false, 'message' => 'Tidak ada data program', 'responseCode' => 406), 406);
				} else {
					$this->response(array('success' => true, 'message' => 'Success', 'responseCode' => 200, 'data' => $program), 200);
				}
			} else {
				$this->response(array('success' => false, 'message' => 'Paramter tidak ada', 'responseCode' => 400), 400);
			}
		}
	}

/* End of file program.php */
/* Location: ./application/controllers/program.php */