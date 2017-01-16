<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	require APPPATH.'/libraries/REST_Controller.php';

	class Misi extends REST_Controller {

		public function __construct()
		{
			parent::__construct();
			$this->load->model('misi_model');
		}
		
		// grid = nama fungsi
		// get = metode request, yang digunakan get dan post.
		public function grid_get()
		{
			$misi = $this->misi_model->grid_all('*', 'kode', 'ASC');
			if(empty($misi)){
				$this->response(array('success' => false, 'message' => 'Tidak ada data misi', 'responseCode' => 406), 406);
			} else {
				$this->response(array('success' => true, 'message' => 'Success', 'responseCode' => 200, 'data' => $misi), 200);
			}
		}
	}

/* End of file misi.php */
/* Location: ./application/controllers/misi.php */