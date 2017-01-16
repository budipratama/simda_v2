<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rekening extends CI_Controller {
	
	public function __construct() {
		parent::__construct();	
		$this->load->model('Rekening_akses_model');
		$this->load->model('Rekening_model');
		$this->load->model('Rekening_akun_model');
		$this->load->model('Rekening_kelompok_model');
		$this->load->model('Rekening_jenis_model');	
		$this->load->model('Rekening_obyek_model');	
		$this->load->model('Rekening_rincian_model');
		
		$this->load->model('Person_model','rekening');

		$this->load->model('Kesepakatan_model');	
		$this->load->library('Datatables');
		
		$this->load->model('Menu_model');
		$this->load->model('Menu_admin_model');
		$this->load->model('Admin_level_model');
	}
	
	public function index() {
		$admin_log 	= $this->auth->is_login_admin();
		{
			$container['sidebar']['view']					= 'admin/sidebar';
			$container['sidebar']['dataset']['aktive_menu'] = 60;
			$container['content']['view']					= 'parameter/rekening/view';

			$where_akun										= 'akun_sort IN (\'1\', \'2\')';
			$container['content']['dataset']['akun']		= $this->Rekening_akun_model->grid_all('akun_kode, akun_nama', 'akun_nama', '', '', '', $where_akun);
			
			$header['admin_log']							= $admin_log;
			$this->load->view('admin/head');
			$this->load->view('admin/header', $header);
			$this->load->view('admin/container', $container);
			$this->load->view('admin/footer');
			$this->load->helper('url');
		}
	}
	
	public function ajax_list() {
		$list = $this->rekening->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $rekening) {
			$no++;
			$row = array();
			$row[] = $rekening->kode;
			$row[] = $rekening->rekening_akun;
			$row[] = $rekening->rekening_kelompok;
			$row[] = $rekening->rekening_jenis;
			$row[] = $rekening->rekening_obyek;
			$row[] = $rekening->rekening_rincian;
			$row[] = $rekening->dob;

			//add html for action
			$row[] = '<center><a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_person('."'".$rekening->kode."'".')"><i class="glyphicon glyphicon-pencil"></i></a>
				  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_person('."'".$rekening->kode."'".')"><i class="glyphicon glyphicon-trash"></i></a>';
		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->rekening->count_all(),
						"recordsFiltered" => $this->rekening->count_filtered(),
						"data" => $data, );
		//output to json format
		echo json_encode($output);
	}

	public function ajax_edit($id) {
		$data = $this->rekening->get_by_id($id);
		echo json_encode($data);
	}

	public function ajax_add() {
		$data = array(
			'rekening_akun'	 	 => $this->input->post('rekening_akun'),
			'rekening_kelompok'	 => $this->input->post('rekening_kelompok'),
			'rekening_jenis'	 => $this->input->post('rekening_jenis'),
			'rekening_obyek'	 => $this->input->post('rekening_obyek'),
			'rekening_rincian'	 => $this->input->post('rekening_rincian'),
			'dob'				 => $this->input->post('dob'), );
		$insert = $this->rekening->save($data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_update() {
		$data = array(
			'rekening_akun'	 	 => $this->input->post('rekening_akun'),
			'rekening_kelompok'	 => $this->input->post('rekening_kelompok'),
			'rekening_jenis'	 => $this->input->post('rekening_jenis'),
			'rekening_obyek'	 => $this->input->post('rekening_obyek'),
			'rekening_rincian'	 => $this->input->post('rekening_rincian'),
			'dob'				 => $this->input->post('dob'), );
		$this->rekening->update(array('id' => $this->input->post('id')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_delete($id) {
		$this->rekening->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}
	
	public function detail()
	{
		$admin_log = $this->auth->is_login_admin();
		$container['sidebar']['view']					= 'admin/sidebar';
		$container['sidebar']['dataset']['aktive_menu'] = 60;
		$container['content']['view']					= 'parameter/rekening/detail';
		$container['content']['dataset']				= '';
		$header['admin_log']							= $admin_log;
		
		$this->load->view('admin/head');
		$this->load->view('admin/header', $header);
		$this->load->view('admin/container', $container);
		$this->load->view('admin/footer');
	}
	
	function detailv()
    {
		$this->datatables->select('nomor, kode, kelompok_nama, akun_nama, jenis_nama, obyek_nama, rincian_nama')
		->add_column('Actions', get_buttons('$1'),'kode')
		->search_column('kelompok_nama, akun_nama, jenis_nama, obyek_nama, rincian_nama')
        ->from('(SELECT @ROW_NUMBER  := @ROW_NUMBER + 1 as nomor, rekening.kode, rekening_kelompok.rekening_kelompok as kelompok_nama, rekening_akun.akun_nama, rekening_jenis.rekening_jenis as jenis_nama, rekening_obyek.rekening_obyek as obyek_nama, rekening_rincian.rekening_rincian as rincian_nama 
		FROM (SELECT @ROW_NUMBER := 0) ROWNUMBER, rekening LEFT JOIN rekening_akun ON rekening.rekening_akun=rekening_akun.akun_kode LEFT JOIN rekening_kelompok ON rekening.rekening_kelompok=rekening_kelompok.kode LEFT JOIN rekening_jenis ON rekening.rekening_jenis=rekening_jenis.kode LEFT JOIN rekening_obyek ON rekening.rekening_obyek=rekening_obyek.kode LEFT JOIN rekening_rincian ON rekening.rekening_rincian=rekening_rincian.kode
		ORDER BY rekening_kelompok.rekening_kelompok ASC) rekening');
        
        echo $this->datatables->generate();
    }
	
}	