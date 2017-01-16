<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rekening extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();	
		$this->load->model('Rekening_akses_model');
		$this->load->model('Rekening_model');
		$this->load->model('Rekening_akun_model');
		$this->load->model('Rekening_kelompok_model');
		$this->load->model('Rekening_jenis_model');	
		$this->load->model('Rekening_obyek_model');	
		$this->load->model('Rekening_rincian_model');

		$this->load->model('Kesepakatan_model');	
		$this->load->library('Datatables');
		
		$this->load->model('Menu_model');
		$this->load->model('Menu_admin_model');
		$this->load->model('Admin_level_model');
	}
	
	public function index()
	{
		$admin_log 	= $this->auth->is_login_admin();
		{
			$container['sidebar']['view']					= 'admin/sidebar';
			$container['sidebar']['dataset']['aktive_menu'] = 60;
			$container['content']['view']					= 'parameter/rekening/view';

			$where_akun											= 'akun_sort IN (\'1\')';
			$container['content']['dataset']['akun']			= $this->Rekening_akun_model->grid_all('akun_kode, akun_nama', 'akun_nama', '', '', '', $where_akun);
			
			$header['admin_log']							= $admin_log;
			$this->load->view('admin/head');
			$this->load->view('admin/header', $header);
			$this->load->view('admin/container', $container);
			$this->load->view('admin/footer');
		}
	}
	
	public function add()
	{
		$admin_log 	= $this->auth->is_login_admin();
		{
			$container['sidebar']['view']					= 'admin/sidebar';
			$container['sidebar']['dataset']['aktive_menu'] = 60;
			$container['content']['view']					= 'parameter/rekening/add';

			$where_akun											= 'akun_sort IN (\'1\', \'2\')';
			$container['content']['dataset']['akun']			= $this->Rekening_akun_model->grid_all('akun_kode, akun_nama', 'akun_nama', '', '', '', $where_akun);

			$header['admin_log']							= $admin_log;
			$this->load->view('admin/head');
			$this->load->view('admin/header', $header);
			$this->load->view('admin/container', $container);
			$this->load->view('admin/footer');
		}
	}
	
	public function jenis()
	{
		$admin_log = $this->auth->is_login_admin();
		$container['sidebar']['view']					= 'admin/sidebar';
		$container['sidebar']['dataset']['aktive_menu'] = 60;
		$container['content']['view']					= 'parameter/rekening/jenis';
		$container['content']['dataset']				= '';
		$header['admin_log']							= $admin_log;
		
		$this->load->view('admin/head');
		$this->load->view('admin/header', $header);
		$this->load->view('admin/container', $container);
		$this->load->view('admin/footer');
	}
	
	public function addj()
	{
		$admin_log = $this->auth->is_login_admin();
		$container['sidebar']['view']					= 'admin/sidebar';
		$container['sidebar']['dataset']['aktive_menu'] = 60;
		$container['content']['view']					= 'parameter/rekening/addj';
		
		$where_a										= 'kode IN (\'3\', \'4\')';
		$container['content']['dataset']['saldo']		= $this->Kesepakatan_model->grid_all('kode, nama', 'kode', '', '', '', $where_a);
		
		$where_akun										= 'akun_sort IN (\'1\')';
		$container['content']['dataset']['akun']		= $this->Rekening_akun_model->grid_all('akun_kode, akun_nama', 'akun_nama', '', '', '', $where_akun);
		$header['admin_log']							= $admin_log;
		
		$this->load->view('admin/head');
		$this->load->view('admin/header', $header);
		$this->load->view('admin/container', $container);
		$this->load->view('admin/footer');
	}
	
	function jenisv()
    {
        $this->datatables->select('nomor, kode, rekening_jenis, rekening_akun, kelompok_nama')
		->add_column('Actions', get_buttons('$1'),'kode')
		->search_column('tujuan, misi_nama')
        ->from('(SELECT @ROW_NUMBER  := @ROW_NUMBER + 1 as nomor, rekening_jenis.kode, rekening_jenis.rekening_jenis, rekening_jenis.rekening_akun, rekening_kelompok.rekening_kelompok as kelompok_nama FROM (SELECT @ROW_NUMBER := 0) ROWNUMBER, rekening_jenis LEFT JOIN rekening_kelompok ON rekening_jenis.rekening_kelompok=rekening_kelompok.kode ORDER BY rekening_jenis.rekening_jenis) rekening_jenis');
        
        echo $this->datatables->generate();
    }
	
	public function obyek()
	{
		$admin_log = $this->auth->is_login_admin();
		$container['sidebar']['view']					= 'admin/sidebar';
		$container['sidebar']['dataset']['aktive_menu'] = 60;
		$container['content']['view']					= 'parameter/rekening/obyek';
		$container['content']['dataset']				= '';
		$header['admin_log']							= $admin_log;
		
		$this->load->view('admin/head');
		$this->load->view('admin/header', $header);
		$this->load->view('admin/container', $container);
		$this->load->view('admin/footer');
	}
	
	function obyekv()
    {
        $this->datatables->select('nomor, kode, rekening_obyek, jenis_nama')
		->add_column('Actions', get_buttons('$1'),'kode')
		->search_column('tujuan, misi_nama')
        ->from('(SELECT @ROW_NUMBER  := @ROW_NUMBER + 1 as nomor, rekening_obyek.kode, rekening_obyek.rekening_obyek, rekening_jenis.rekening_jenis as jenis_nama FROM (SELECT @ROW_NUMBER := 0) ROWNUMBER, rekening_obyek LEFT JOIN rekening_jenis ON rekening_obyek.rekening_jenis=rekening_jenis.kode ORDER BY rekening_obyek.rekening_obyek ASC) rekening_obyek');
        
        echo $this->datatables->generate();
    }
	
	public function rincian()
	{
		$admin_log = $this->auth->is_login_admin();
		$container['sidebar']['view']					= 'admin/sidebar';
		$container['sidebar']['dataset']['aktive_menu'] = 60;
		$container['content']['view']					= 'parameter/rekening/rincian';
		$container['content']['dataset']				= '';
		$header['admin_log']							= $admin_log;
		
		$this->load->view('admin/head');
		$this->load->view('admin/header', $header);
		$this->load->view('admin/container', $container);
		$this->load->view('admin/footer');
	}
	
	function rincianv()
    {
        $this->datatables->select('nomor, kode, rekening_rincian, obyek_nama')
		->add_column('Actions', get_buttons('$1'),'kode')
		->search_column('tujuan, misi_nama')
        ->from('(SELECT @ROW_NUMBER  := @ROW_NUMBER + 1 as nomor, rekening_rincian.kode, rekening_rincian.rekening_rincian, rekening_obyek.rekening_obyek as obyek_nama FROM (SELECT @ROW_NUMBER := 0) ROWNUMBER, rekening_rincian LEFT JOIN rekening_obyek ON rekening_rincian.rekening_obyek=rekening_obyek.kode ORDER BY rekening_rincian.rekening_rincian ASC) rekening_rincian');
        
        echo $this->datatables->generate();
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
	
	public function tampil_combobox_akun_by_kelompok(){
		$akun_kode = $this->uri->segment(4);
		if ($akun_kode){
			$data_kelompok = $this->Rekening_kelompok_model->grid_all('rekening_kelompok.kode, rekening_kelompok.rekening_kelompok', 'rekening_kelompok.rekening_kelompok', '', '', '', array('rekening_kelompok.rekening_akun'=>$akun_kode));			
			echo '<label class="control-label col-md-3" for="bbb_kode">Kelompok :</label>';
			echo '<div class="col-md-8">';
				combobox('db', $data_kelompok, 'bbb_kode', 'kode', 'rekening_kelompok', '', 'show_form_kelompok_by_jenis();', 'Pilih Kelompok', 'class="select2_category form-control" required="required"');
			echo '</div>';
		}
	}
	
	public function tampil_combobox_kelompok_by_jenis(){
		$kelompok_kode = $this->uri->segment(4);
		if ($kelompok_kode){
			$data_jenis = $this->Rekening_jenis_model->grid_all('rekening_jenis.kode, rekening_jenis.rekening_jenis', 'rekening_jenis.rekening_jenis', '', '', '', array('rekening_jenis.rekening_kelompok'=>$kelompok_kode));
			echo '<label class="control-label col-md-3" for="ccc_kode">Jenis :</label>';
			echo '<div class="col-md-8">';
				combobox('db', $data_jenis, 'ccc_kode', 'kode', 'rekening_jenis', '', 'show_form_jenis_by_obyek();', 'Pilih Jenis', 'class="select2_category form-control" required="required"');
			echo '</div>';
		}
	}
	
	public function tampil_combobox_jenis_by_obyek(){
		$jenis_kode = $this->uri->segment(4);
		if ($jenis_kode){
			$data_obyek = $this->Rekening_obyek_model->grid_all('rekening_obyek.kode, rekening_obyek.rekening_obyek', 'rekening_obyek.rekening_obyek', '', '', '', array('rekening_obyek.rekening_jenis'=>$jenis_kode));
			echo '<label class="control-label col-md-3" for="ddd_kode">Obyek :</label>';
			echo '<div class="col-md-8">';
				combobox('db', $data_obyek, 'ddd_kode', 'kode', 'rekening_obyek', '', 'show_form_obyek_by_rincian();', 'Pilih Obyek', 'class="select2_category form-control" required="required"');
			echo '</div>';
		}
	}
	
	public function tampil_combobox_obyek_by_rincian(){
		$obyek_kode = $this->uri->segment(4);
		if ($obyek_kode){
			$data_rincian = $this->Rekening_rincian_model->grid_all('rekening_rincian.kode, rekening_rincian.rekening_rincian', 'rekening_rincian.rekening_rincian', '', '', '', array('rekening_rincian.rekening_obyek'=>$obyek_kode));
			echo '<label class="control-label col-md-3" for="ddd_kode">Rincian Obyek :</label>';
			echo '<div class="col-md-8">';
				combobox('db', $data_rincian, 'eee_kode', 'kode', 'rekening_rincian', '', '', 'Pilih Rincian Obyek', 'class="select2_category form-control" required="required"');
			echo '</div>';
		}
	}
	
}