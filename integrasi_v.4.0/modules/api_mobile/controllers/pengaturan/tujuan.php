<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	require APPPATH.'/libraries/REST_Controller.php';

	class tujuan extends REST_Controller {

		public function __construct()
		{
			parent::__construct();
			$this->load->model('tujuan_model');
		}
				
		//grid : url api
		// get : metode request
		public function grid_get($misi_kode="")
		{
			if ($misi_kode){
				$where_tujuan['tujuan.misi'] = $misi_kode;
				$tujuan = $this->tujuan_model->grid_all('*', 'tujuan.tujuan', 'ASC', 0, 0, $where_tujuan);
			} else {
				$tujuan = $this->tujuan_model->grid_all('*', 'tujuan.tujuan', 'ASC');
			}
			
			if(empty($tujuan)){
				$this->response(array('success' => false, 'message' => 'Tidak ada data Tujuan', 'responseCode' => 406), 406);
			} else {
				$this->response(array('success' => true, 'message' => 'Success', 'responseCode' => 200, 'data' => $tujuan), 200);
			}
		}

	}

/* End of file tujuan.php */
/* Location: ./application/controllers/tujuan.php */