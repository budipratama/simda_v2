<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	require APPPATH.'/libraries/REST_Controller.php';

	class Indikator_skpd extends REST_Controller {

		public function __construct()
		{
			parent::__construct();
			$this->load->model('indikator_skpd_model');
		}
		
		// grid = nama fungsi
		// get = metode request, yang digunakan get dan post.
		public function grid_get()
		{
			$indikator_skpd = $this->indikator_skpd_model->grid_all('skpd_indikator.*', 'skpd_indikator.kode', 'ASC');
			if(empty($indikator_skpd)){
				$this->response(array('success' => false, 'message' => 'Tidak ada data indikator skpd rutin', 'responseCode' => 406), 406);
			} else {
				$this->response(array('success' => true, 'message' => 'Success', 'responseCode' => 200, 'data' => $indikator_skpd), 200);
			}
		}
	}

/* End of file indikator_skpd.php */
/* Location: ./application/controllers/indikator_skpd.php */