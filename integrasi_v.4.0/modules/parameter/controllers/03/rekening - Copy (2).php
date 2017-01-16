<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rekening extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();	
		$this->load->model('Tipe_model');	
		$this->load->model('Akun_model');	
		$this->load->model('Kelompok_model');	
		$this->load->model('Jenis_model');	
		$this->load->model('Obyek_model');	
		$this->load->model('Rincian_model');	
		$this->load->library('Datatables');
	}
	
	public function index()	{
		$admin_log 	= $this->auth->is_login_admin();
		{
			$container['sidebar']['view']					= 'admin/sidebar';
			$container['sidebar']['dataset']['aktive_menu'] = 60;
			$container['content']['view']					= 'parameter/rekening/view';
			
			$header['admin_log']							= $admin_log;
			$this->load->view('admin/head');
			$this->load->view('admin/header', $header);
			$this->load->view('admin/container', $container);
			$this->load->view('admin/footer');
		}
	}
	
	public function jenis()	{
		$admin_log 	= $this->auth->is_login_admin();
		{
			$container['sidebar']['view']					= 'admin/sidebar';
			$container['sidebar']['dataset']['aktive_menu'] = 60;
			$container['content']['view']					= 'parameter/rekening/jenis';
			
			$header['admin_log']							= $admin_log;
			$this->load->view('admin/head');
			$this->load->view('admin/header', $header);
			$this->load->view('admin/container', $container);
			$this->load->view('admin/footer');
		}
	}
	
	function jenisv() {
		$where_datatable	= 'akun IN (\'1\')';
		$this->datatables->select('nomor, kode, akun, kelompok, no, jenis_nama')
		->add_column('Actions', $this->get_buttonsj($tipe, '$1'),'kode')
		->search_column('jenis_nama')
		->from('(SELECT @ROW_NUMBER  := @ROW_NUMBER + 1 as nomor, jenis.kode, jenis.akun, jenis.kelompok, jenis.no, jenis.jenis_nama FROM (SELECT @ROW_NUMBER := 0) ROWNUMBER, jenis WHERE akun_sort IN (\'1\') ORDER BY jenis.kode ASC) jenis');
        echo $this->datatables->generate();
    }
	
	function get_buttonsj ($tipe, $id) {
		$ci= & get_instance();
		$ci->load->helper('url');
		$html  = '<div style="text-align:center;white-space: nowrap;">';
		$html .= '<a href="'. site_url($ci->uri->segment(1) . '/rekening/editj/'.$id) .'" class="btn btn-sm btn-warning" title="Ubah"><i class="fa fa-pencil"></i></a>';
		$html .= '<a href="'. site_url($ci->uri->segment(1) . '/rekening/deletej/'.$id) .'" class="btn btn-sm btn-danger" title="Hapus" data-placement="left" onclick="return confirm(\'Apakah anda yakin? \nAkan menghapus data\');"><i class="fa fa-trash-o"></i></a>';
		$html .= '</div>';
		return $html;
	}
	
	public function addj() {
		$admin_log = $this->auth->is_login_admin();
		$container['sidebar']['view']					= 'admin/sidebar';
		$container['sidebar']['dataset']['aktive_menu'] = 60;
		$container['content']['view']					= 'parameter/rekening/addj';
		$container['content']['dataset']				= '';
		
		$where_akun											= 'akun_sort IN (\'1\')';
		$where_saldo										= 'tipe_sort IN (\'3\',\'4\')';
		$container['content']['dataset']['akun']			= $this->Akun_model->grid_all('kode, akun_nama', 'akun_nama', '', '', '', $where_akun);
		$container['content']['dataset']['saldo']			= $this->Tipe_model->grid_all('tipe_kode, tipe_nama', 'tipe_nama', '', '', '', $where_saldo);
		
		$jenis = $this->Jenis_model->get('jenis.*', array('jenis.kode'=>$this->uri->segment(4)));
		$container['content']['dataset']['kode']			= $jenis->kode;
		$container['content']['dataset']['jenis_nama']		= $jenis->jenis_nama;
		$container['content']['dataset']['saldo_normal']	= $jenis->saldo_normal;
		
		$header['admin_log']							= $admin_log;
		$this->load->view('admin/head');
		$this->load->view('admin/header', $header);
		$this->load->view('admin/container', $container);
		$this->load->view('admin/footer');
	}
	
	public function insertj() {
		$admin_log = $this->auth->is_login_admin();

		$this->form_validation->set_rules('aaa_kode', 'Akun', 'trim|required|xss_clean');
		$this->form_validation->set_rules('bbb_kode', 'Kelompok', 'trim|required|xss_clean');
		$this->form_validation->set_rules('sss_kode', 'Saldo_normal', 'trim|required|xss_clean');
		$this->form_validation->set_rules('jenis', 'Jenis_nama', 'trim|required|xss_clean');
		
		if($this->form_validation->run() == FALSE)
		{
			$container['sidebar']['view']					= 'admin/sidebar';
			$container['sidebar']['dataset']['aktive_menu'] = 60;
			$container['content']['view']					= 'parameter/rekening/addj';
			
			$where_akun											= 'akun_sort IN (\'1\')';
			$where_saldo										= 'tipe_sort IN (\'3\',\'4\')';
			$container['content']['dataset']['akun']			= $this->Akun_model->grid_all('kode, akun_nama', 'akun_nama', '', '', '', $where_akun);
			$container['content']['dataset']['saldo']			= $this->Tipe_model->grid_all('tipe_kode, tipe_nama', 'tipe_nama', '', '', '', $where_saldo);
			
			$header['admin_log']							= $admin_log;
			$this->load->view('admin/head');
			$this->load->view('admin/header', $header);
			$this->load->view('admin/container', $container);
			$this->load->view('admin/footer');
		} else {
			
			$insert['akun']			= $this->input->post('aaa_kode');
			$insert['kelompok']		= $this->input->post('bbb_kode');
			$insert['saldo_normal']	= $this->input->post('sss_kode');
			$insert['jenis_nama']	= $this->input->post('jenis');
						
			$query = $this->Jenis_model->insert($insert);
			
			$this->session->set_flashdata('success','<div class="alert fresh-color alert-info fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><strong>Success!</strong> Data "JENIS" telah berhasil ditambahkan</div>');
			
			redirect('parameter/rekening', 'refresh');
		}

	}
	
	public function editj() {
		$admin_log = $this->auth->is_login_admin();
		$container['sidebar']['view']					= 'admin/sidebar';
		$container['sidebar']['dataset']['aktive_menu'] = 60;
		$container['content']['view']					= 'parameter/rekening/editj';
		
		$where_akun											= 'akun_sort IN (\'1\')';
		$where_saldo										= 'tipe_sort IN (\'3\',\'4\')';
		$container['content']['dataset']['akun']			= $this->Akun_model->grid_all('kode, akun_nama', 'akun_nama', '', '', '', $where_akun);
		$container['content']['dataset']['saldo']			= $this->Tipe_model->grid_all('tipe_kode, tipe_nama', 'tipe_nama', '', '', '', $where_saldo);
		$container['content']['dataset']['kelompok']		= $this->Kelompok_model->grid_all('kode, kelompok_nama', 'kelompok_nama', 'ASC');
		
		$jenis = $this->Jenis_model->get('jenis.*', array('jenis.kode'=>$this->uri->segment(4)));
		
		$container['content']['dataset']['kode']		= $jenis->kode;
		$container['content']['dataset']['akun_']		= $jenis->akun;
		$container['content']['dataset']['kelompok_']	= $jenis->kelompok;
		$container['content']['dataset']['jenis']		= $jenis->jenis_nama;
		$container['content']['dataset']['saldo_']		= $jenis->saldo_normal;
		
		$header['admin_log']							= $admin_log;
		$this->load->view('admin/head');
		$this->load->view('admin/header', $header);
		$this->load->view('admin/container', $container);
		$this->load->view('admin/footer');
	}
	
	public function updatej()
	{
		$admin_log = $this->auth->is_login_admin();
		
		$this->form_validation->set_rules('sss_kode', 'Saldo_normal', 'trim|required|xss_clean');
		$this->form_validation->set_rules('jenis', 'Jenis_nama', 'trim|required|xss_clean');
		
		if($this->form_validation->run() == FALSE)
		{
			$container['sidebar']['view']					= 'admin/sidebar';
			$container['sidebar']['dataset']['aktive_menu'] = 60;
			$container['content']['view']					= 'parameter/rekening/editj';
			
			$where_akun											= 'akun_sort IN (\'1\')';
			$where_saldo										= 'tipe_sort IN (\'3\',\'4\')';
			$container['content']['dataset']['akun']			= $this->Akun_model->grid_all('kode, akun_nama', 'akun_nama', '', '', '', $where_akun);
			$container['content']['dataset']['saldo']			= $this->Tipe_model->grid_all('tipe_kode, tipe_nama', 'tipe_nama', '', '', '', $where_saldo);
			$container['content']['dataset']['kelompok']		= $this->Kelompok_model->grid_all('kode, kelompok_nama', 'kelompok_nama', 'ASC');
			
			$jenis = $this->Jenis_model->get('jenis.*', array('jenis.kode'=>$this->uri->segment(4)));
			
			$container['content']['dataset']['kode']		= $jenis->kode;
			$container['content']['dataset']['akun_']		= $jenis->akun;
			$container['content']['dataset']['kelompok_']	= $jenis->kelompok;
			$container['content']['dataset']['jenis']		= $jenis->jenis_nama;
			$container['content']['dataset']['saldo_']		= $jenis->saldo_normal;
			
			$header['admin_log']							= $admin_log;
			$this->load->view('admin/head');
			$this->load->view('admin/header', $header);
			$this->load->view('admin/container', $container);
			$this->load->view('admin/footer');
		} else {
								
			$update['saldo_normal']	= $this->input->post('sss_kode');
			$update['jenis_nama']	= $this->input->post('jenis');
			
			$query = $this->Jenis_model->update($update, $this->input->post('kode'));

			$this->session->set_flashdata('success','<div class="alert fresh-color alert-warning fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><strong>Success!</strong> Data "JENIS" telah berhasil diubah</div>');
			
			redirect('parameter/rekening', 'refresh');
		}
	}
	
	public function obyek()	{
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
	
	function obyekv() {
		$where_datatable	= 'akun IN (\'1\')';
		$this->datatables->select('nomor, kode, akun, kelompok, jenis, no, obyek_nama')
		->add_column('Actions', $this->get_buttonsj($tipe, '$1'),'kode')
		->search_column('jenis_nama')
		->from('(SELECT @ROW_NUMBER  := @ROW_NUMBER + 1 as nomor, obyek.kode, obyek.akun, obyek.kelompok, obyek.jenis, obyek.no, obyek.obyek_nama FROM (SELECT @ROW_NUMBER := 0) ROWNUMBER, obyek WHERE akun_sort IN (\'1\') ORDER BY obyek.kode ASC) obyek');
        echo $this->datatables->generate();
    }
	
	function get_buttonso ($tipe, $id) {
		$ci= & get_instance();
		$ci->load->helper('url');
		$html  = '<div style="text-align:center;white-space: nowrap;">';
		$html .= '<a href="'. site_url($ci->uri->segment(1) . '/rekening/edito/'.$id) .'" class="btn btn-sm btn-warning" title="Ubah"><i class="fa fa-pencil"></i></a>';
		$html .= '<a href="'. site_url($ci->uri->segment(1) . '/rekening/deleteo/'.$id) .'" class="btn btn-sm btn-danger" title="Hapus" data-placement="left" onclick="return confirm(\'Apakah anda yakin? \nAkan menghapus data\');"><i class="fa fa-trash-o"></i></a>';
		$html .= '</div>';
		return $html;
	}
	
	public function addo() {
		$admin_log = $this->auth->is_login_admin();
		$container['sidebar']['view']					= 'admin/sidebar';
		$container['sidebar']['dataset']['aktive_menu'] = 60;
		$container['content']['view']					= 'parameter/rekening/addo';
		$container['content']['dataset']				= '';
		
		$where_akun											= 'akun_sort IN (\'1\')';
		$where_saldo										= 'tipe_sort IN (\'3\',\'4\')';
		$container['content']['dataset']['akun']			= $this->Akun_model->grid_all('kode, akun_nama', 'akun_nama', '', '', '', $where_akun);
		$container['content']['dataset']['saldo']			= $this->Tipe_model->grid_all('tipe_kode, tipe_nama', 'tipe_nama', '', '', '', $where_saldo);
		
		$jenis = $this->Jenis_model->get('jenis.*', array('jenis.kode'=>$this->uri->segment(4)));
		$container['content']['dataset']['kode']			= $jenis->kode;
		$container['content']['dataset']['jenis_nama']		= $jenis->jenis_nama;
		$container['content']['dataset']['saldo_normal']	= $jenis->saldo_normal;
		
		$header['admin_log']							= $admin_log;
		$this->load->view('admin/head');
		$this->load->view('admin/header', $header);
		$this->load->view('admin/container', $container);
		$this->load->view('admin/footer');
	}
	
	public function inserto() {
		$admin_log = $this->auth->is_login_admin();

		$this->form_validation->set_rules('aaa_kode', 'Akun', 'trim|required|xss_clean');
		$this->form_validation->set_rules('bbb_kode', 'Kelompok', 'trim|required|xss_clean');
		$this->form_validation->set_rules('ccc_kode', 'Jenis', 'trim|required|xss_clean');
		$this->form_validation->set_rules('obyek', 'Obyek_nama', 'trim|required|xss_clean');
		
		if($this->form_validation->run() == FALSE)
		{
			$container['sidebar']['view']					= 'admin/sidebar';
			$container['sidebar']['dataset']['aktive_menu'] = 60;
			$container['content']['view']					= 'parameter/rekening/addo';
			
			$where_akun											= 'akun_sort IN (\'1\')';
			$where_saldo										= 'tipe_sort IN (\'3\',\'4\')';
			$container['content']['dataset']['akun']			= $this->Akun_model->grid_all('kode, akun_nama', 'akun_nama', '', '', '', $where_akun);
			$container['content']['dataset']['saldo']			= $this->Tipe_model->grid_all('tipe_kode, tipe_nama', 'tipe_nama', '', '', '', $where_saldo);
			
			$header['admin_log']							= $admin_log;
			$this->load->view('admin/head');
			$this->load->view('admin/header', $header);
			$this->load->view('admin/container', $container);
			$this->load->view('admin/footer');
		} else {
			
			$insert['akun']			= $this->input->post('aaa_kode');
			$insert['kelompok']		= $this->input->post('bbb_kode');
			$insert['jenis']		= $this->input->post('ccc_kode');
			$insert['obyek_nama']	= $this->input->post('obyek');
						
			$query = $this->Obyek_model->insert($insert);
			
			$this->session->set_flashdata('success','<div class="alert fresh-color alert-info fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><strong>Success!</strong> Data "OBYEK" telah berhasil ditambahkan</div>');
			
			redirect('parameter/rekening/obyek', 'refresh');
		}

	}
	
	public function edito() {
		$admin_log = $this->auth->is_login_admin();
		$container['sidebar']['view']					= 'admin/sidebar';
		$container['sidebar']['dataset']['aktive_menu'] = 60;
		$container['content']['view']					= 'parameter/rekening/edito';
		
		$where_akun											= 'akun_sort IN (\'1\')';
		$where_saldo										= 'tipe_sort IN (\'3\',\'4\')';
		$container['content']['dataset']['akun']			= $this->Akun_model->grid_all('kode, akun_nama', 'akun_nama', '', '', '', $where_akun);
		$container['content']['dataset']['saldo']			= $this->Tipe_model->grid_all('tipe_kode, tipe_nama', 'tipe_nama', '', '', '', $where_saldo);
		$container['content']['dataset']['kelompok']		= $this->Kelompok_model->grid_all('kode, kelompok_nama', 'kelompok_nama', 'ASC');
		$container['content']['dataset']['jenis']			= $this->Jenis_model->grid_all('kode, jenis_nama', 'jenis_nama', 'ASC');
		
		$obyek = $this->Obyek_model->get('obyek.*', array('obyek.kode'=>$this->uri->segment(4)));
		
		$container['content']['dataset']['kode']		= $obyek->kode;
		$container['content']['dataset']['akun_']		= $obyek->akun;
		$container['content']['dataset']['kelompok_']	= $obyek->kelompok;
		$container['content']['dataset']['jenis_']		= $obyek->jenis;
		$container['content']['dataset']['obyek']		= $obyek->obyek_nama;
		
		$header['admin_log']							= $admin_log;
		$this->load->view('admin/head');
		$this->load->view('admin/header', $header);
		$this->load->view('admin/container', $container);
		$this->load->view('admin/footer');
	}
	
	public function updateo()
	{
		$admin_log = $this->auth->is_login_admin();
		
		$this->form_validation->set_rules('obyek', 'Obyek_nama', 'trim|required|xss_clean');
		
		if($this->form_validation->run() == FALSE)
		{
			$container['sidebar']['view']					= 'admin/sidebar';
			$container['sidebar']['dataset']['aktive_menu'] = 60;
			$container['content']['view']					= 'parameter/rekening/edito';
			
			$where_akun											= 'akun_sort IN (\'1\')';
			$where_saldo										= 'tipe_sort IN (\'3\',\'4\')';
			$container['content']['dataset']['akun']			= $this->Akun_model->grid_all('kode, akun_nama', 'akun_nama', '', '', '', $where_akun);
			$container['content']['dataset']['saldo']			= $this->Tipe_model->grid_all('tipe_kode, tipe_nama', 'tipe_nama', '', '', '', $where_saldo);
			$container['content']['dataset']['kelompok']		= $this->Kelompok_model->grid_all('kode, kelompok_nama', 'kelompok_nama', 'ASC');
			$container['content']['dataset']['jenis']			= $this->Jenis_model->grid_all('kode, jenis_nama', 'jenis_nama', 'ASC');
			
			$obyek = $this->Obyek_model->get('obyek.*', array('obyek.kode'=>$this->uri->segment(4)));
		
			$container['content']['dataset']['kode']		= $obyek->kode;
			$container['content']['dataset']['akun_']		= $obyek->akun;
			$container['content']['dataset']['kelompok_']	= $obyek->kelompok;
			$container['content']['dataset']['jenis_']		= $obyek->jenis;
			$container['content']['dataset']['obyek']		= $obyek->obyek_nama;
			
			$header['admin_log']							= $admin_log;
			$this->load->view('admin/head');
			$this->load->view('admin/header', $header);
			$this->load->view('admin/container', $container);
			$this->load->view('admin/footer');
		} else {
			
			$update['obyek_nama']	= $this->input->post('obyek');
			
			$query = $this->Obyek_model->update($update, $this->input->post('kode'));

			$this->session->set_flashdata('success','<div class="alert fresh-color alert-warning fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><strong>Success!</strong> Data "OBYEK" telah berhasil diubah</div>');
			
			redirect('parameter/rekening/obyek', 'refresh');
		}
	}
	
	public function rincian() {
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
	
	function rincianv() {
		$where_datatable	= 'akun IN (\'1\')';
		$this->datatables->select('nomor, kode, akun, kelompok, jenis, obyek, no, rincian_nama')
		->add_column('Actions', $this->get_buttonsj($tipe, '$1'),'kode')
		->search_column('jenis_nama')
		->from('(SELECT @ROW_NUMBER  := @ROW_NUMBER + 1 as nomor, rincian.kode, rincian.akun, rincian.kelompok, rincian.jenis, rincian.obyek, rincian.no, rincian.rincian_nama FROM (SELECT @ROW_NUMBER := 0) ROWNUMBER, rincian WHERE akun_sort IN (\'1\') ORDER BY rincian.kode ASC) rincian');
        echo $this->datatables->generate();
    }
	
	function get_buttonsr ($tipe, $id) {
		$ci= & get_instance();
		$ci->load->helper('url');
		$html  = '<div style="text-align:center;white-space: nowrap;">';
		$html .= '<a href="'. site_url($ci->uri->segment(1) . '/rekening/editr/'.$id) .'" class="btn btn-sm btn-warning" title="Ubah"><i class="fa fa-pencil"></i></a>';
		$html .= '<a href="'. site_url($ci->uri->segment(1) . '/rekening/deleter/'.$id) .'" class="btn btn-sm btn-danger" title="Hapus" data-placement="left" onclick="return confirm(\'Apakah anda yakin? \nAkan menghapus data\');"><i class="fa fa-trash-o"></i></a>';
		$html .= '</div>';
		return $html;
	}
	
	public function addr() {
		$admin_log = $this->auth->is_login_admin();
		$container['sidebar']['view']					= 'admin/sidebar';
		$container['sidebar']['dataset']['aktive_menu'] = 60;
		$container['content']['view']					= 'parameter/rekening/addr';
		$container['content']['dataset']				= '';
		
		$where_akun											= 'akun_sort IN (\'1\')';
		$where_saldo										= 'tipe_sort IN (\'3\',\'4\')';
		$container['content']['dataset']['akun']			= $this->Akun_model->grid_all('kode, akun_nama', 'akun_nama', '', '', '', $where_akun);
		$container['content']['dataset']['saldo']			= $this->Tipe_model->grid_all('tipe_kode, tipe_nama', 'tipe_nama', '', '', '', $where_saldo);
		$container['content']['dataset']['kelompok']		= $this->Kelompok_model->grid_all('kode, kelompok_nama', 'kelompok_nama', 'ASC');
		$container['content']['dataset']['jenis']			= $this->Jenis_model->grid_all('kode, jenis_nama', 'jenis_nama', 'ASC');
		$container['content']['dataset']['obyek']			= $this->Obyek_model->grid_all('kode, obyek_nama', 'obyek_nama', 'ASC');
		
		$rincian = $this->Rincian_model->get('rincian.*', array('rincian.kode'=>$this->uri->segment(4)));
		
		$container['content']['dataset']['kode']		= $rincian->kode;
		$container['content']['dataset']['akun_']		= $rincian->akun;
		$container['content']['dataset']['kelompok_']	= $rincian->kelompok;
		$container['content']['dataset']['jenis_']		= $rincian->jenis;
		$container['content']['dataset']['obyek_']		= $rincian->obyek;
		$container['content']['dataset']['rincian']		= $rincian->rincian_nama;
		$container['content']['dataset']['peraturan']	= $rincian->peraturan;
		
		$header['admin_log']							= $admin_log;
		$this->load->view('admin/head');
		$this->load->view('admin/header', $header);
		$this->load->view('admin/container', $container);
		$this->load->view('admin/footer');
	}
	
	public function insertr() {
		$admin_log = $this->auth->is_login_admin();

		$this->form_validation->set_rules('aaa_kode', 'Akun', 'trim|required|xss_clean');
		$this->form_validation->set_rules('bbb_kode', 'Kelompok', 'trim|required|xss_clean');
		$this->form_validation->set_rules('ccc_kode', 'Jenis', 'trim|required|xss_clean');
		$this->form_validation->set_rules('ddd_kode', 'Obyek', 'trim|required|xss_clean');
		$this->form_validation->set_rules('rincian', 'Rincian_nama', 'trim|required|xss_clean');
		$this->form_validation->set_rules('ppp_kode', 'Peraturan', 'trim|required|xss_clean');
		
		if($this->form_validation->run() == FALSE)
		{
			$container['sidebar']['view']					= 'admin/sidebar';
			$container['sidebar']['dataset']['aktive_menu'] = 60;
			$container['content']['view']					= 'parameter/rekening/addr';
			
			$where_akun											= 'akun_sort IN (\'1\')';
			$where_saldo										= 'tipe_sort IN (\'3\',\'4\')';
			$container['content']['dataset']['akun']			= $this->Akun_model->grid_all('kode, akun_nama', 'akun_nama', '', '', '', $where_akun);
			$container['content']['dataset']['saldo']			= $this->Tipe_model->grid_all('tipe_kode, tipe_nama', 'tipe_nama', '', '', '', $where_saldo);
			
			$header['admin_log']							= $admin_log;
			$this->load->view('admin/head');
			$this->load->view('admin/header', $header);
			$this->load->view('admin/container', $container);
			$this->load->view('admin/footer');
		} else {
			
			$insert['akun']			= $this->input->post('aaa_kode');
			$insert['kelompok']		= $this->input->post('bbb_kode');
			$insert['jenis']		= $this->input->post('ccc_kode');
			$insert['obyek']		= $this->input->post('ddd_kode');
			$insert['rincian_nama']	= $this->input->post('rincian');
			$insert['peraturan']	= $this->input->post('ppp_kode');
						
			$query = $this->Rincian_model->insert($insert);
			
			$this->session->set_flashdata('success','<div class="alert fresh-color alert-info fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><strong>Success!</strong> Data "RINCIAN" telah berhasil ditambahkan</div>');
			
			redirect('parameter/rekening/rincian', 'refresh');
		}

	}
	
	public function editr() {
		$admin_log = $this->auth->is_login_admin();
		$container['sidebar']['view']					= 'admin/sidebar';
		$container['sidebar']['dataset']['aktive_menu'] = 60;
		$container['content']['view']					= 'parameter/rekening/editr';
		
		$where_akun											= 'akun_sort IN (\'1\')';
		$where_saldo										= 'tipe_sort IN (\'3\',\'4\')';
		$container['content']['dataset']['akun']			= $this->Akun_model->grid_all('kode, akun_nama', 'akun_nama', '', '', '', $where_akun);
		$container['content']['dataset']['saldo']			= $this->Tipe_model->grid_all('tipe_kode, tipe_nama', 'tipe_nama', '', '', '', $where_saldo);
		$container['content']['dataset']['kelompok']		= $this->Kelompok_model->grid_all('kode, kelompok_nama', 'kelompok_nama', 'ASC');
		$container['content']['dataset']['jenis']			= $this->Jenis_model->grid_all('kode, jenis_nama', 'jenis_nama', 'ASC');
		$container['content']['dataset']['obyek']			= $this->Obyek_model->grid_all('kode, obyek_nama', 'obyek_nama', 'ASC');
		
		$rincian = $this->Rincian_model->get('rincian.*', array('rincian.kode'=>$this->uri->segment(4)));
		
		$container['content']['dataset']['kode']		= $rincian->kode;
		$container['content']['dataset']['akun_']		= $rincian->akun;
		$container['content']['dataset']['kelompok_']	= $rincian->kelompok;
		$container['content']['dataset']['jenis_']		= $rincian->jenis;
		$container['content']['dataset']['obyek_']		= $rincian->obyek;
		$container['content']['dataset']['rincian']		= $rincian->rincian_nama;
		$container['content']['dataset']['peraturan']	= $rincian->peraturan;
		
		$header['admin_log']							= $admin_log;
		$this->load->view('admin/head');
		$this->load->view('admin/header', $header);
		$this->load->view('admin/container', $container);
		$this->load->view('admin/footer');
	}
	
	public function updater()
	{
		$admin_log = $this->auth->is_login_admin();
		
		$this->form_validation->set_rules('rincian', 'Rincian_nama', 'trim|required|xss_clean');
		$this->form_validation->set_rules('peraturan', 'Peraturan', 'trim|required|xss_clean');
		
		if($this->form_validation->run() == FALSE)
		{
			$container['sidebar']['view']					= 'admin/sidebar';
			$container['sidebar']['dataset']['aktive_menu'] = 60;
			$container['content']['view']					= 'parameter/rekening/editr';
			
			$where_akun											= 'akun_sort IN (\'1\')';
			$where_saldo										= 'tipe_sort IN (\'3\',\'4\')';
			$container['content']['dataset']['akun']			= $this->Akun_model->grid_all('kode, akun_nama', 'akun_nama', '', '', '', $where_akun);
			$container['content']['dataset']['saldo']			= $this->Tipe_model->grid_all('tipe_kode, tipe_nama', 'tipe_nama', '', '', '', $where_saldo);
			$container['content']['dataset']['kelompok']		= $this->Kelompok_model->grid_all('kode, kelompok_nama', 'kelompok_nama', 'ASC');
			$container['content']['dataset']['jenis']			= $this->Jenis_model->grid_all('kode, jenis_nama', 'jenis_nama', 'ASC');
			$container['content']['dataset']['obyek']			= $this->Obyek_model->grid_all('kode, obyek_nama', 'obyek_nama', 'ASC');
			
			$rincian = $this->Rincian_model->get('rincian.*', array('rincian.kode'=>$this->uri->segment(4)));
		
			$container['content']['dataset']['kode']		= $rincian->kode;
			$container['content']['dataset']['akun_']		= $rincian->akun;
			$container['content']['dataset']['kelompok_']	= $rincian->kelompok;
			$container['content']['dataset']['jenis_']		= $rincian->jenis;
			$container['content']['dataset']['obyek_']		= $rincian->obyek;
			$container['content']['dataset']['rincian']		= $rincian->rincian;
			
			$header['admin_log']							= $admin_log;
			$this->load->view('admin/head');
			$this->load->view('admin/header', $header);
			$this->load->view('admin/container', $container);
			$this->load->view('admin/footer');
		} else {
			
			$update['rincian_nama']	= $this->input->post('rincian');
			$update['peraturan']	= $this->input->post('peraturan');
			
			$query = $this->Rincian_model->update($update, $this->input->post('kode'));

			$this->session->set_flashdata('success','<div class="alert fresh-color alert-warning fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><strong>Success!</strong> Data "RINCIAN" telah berhasil diubah</div>');
			
			redirect('parameter/rekening/rincian', 'refresh');
		}
	}
	
	public function deletej()
	{
		if ($this->uri->segment(4)){			
			$this->Jenis_model->delete($this->uri->segment(4));
			$this->Jenis_model->delete1($this->uri->segment(4));
			$this->Jenis_model->delete2($this->uri->segment(4));
			$this->session->set_flashdata('success','<div class="alert fresh-color alert-danger fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><strong>Success!</strong> Data "JENIS" telah berhasil dihapus</div>');
		} 

		redirect('parameter/rekening', 'refresh');
	}
	
	public function deleteo()
	{
		if ($this->uri->segment(4)){
			$this->Obyek_model->delete1($this->uri->segment(4));
			$this->Obyek_model->delete2($this->uri->segment(4));
			$this->session->set_flashdata('success','<div class="alert fresh-color alert-danger fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><strong>Success!</strong> Data "OBYEK" telah berhasil dihapus</div>');
		} 

		redirect('parameter/rekening/obyek', 'refresh');
	}
	
	public function deleter()
	{
		if ($this->uri->segment(4)){
			$this->Rincian_model->delete($this->uri->segment(4));
			$this->session->set_flashdata('success','<div class="alert fresh-color alert-danger fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><strong>Success!</strong> Data "RINCIAN" telah berhasil dihapus</div>');
		} 

		redirect('parameter/rekening/rincian', 'refresh');
	}
	
	public function tampil_combobox_akun_by_kelompok(){
		$akun_kode = $this->uri->segment(4);
		if ($akun_kode){
			$data_kelompok = $this->Kelompok_model->grid_all('kelompok.kode, kelompok.kelompok_nama', 'kelompok.kelompok_nama', '', '', '', array('kelompok.akun'=>$akun_kode));			
			echo '<label class="control-label col-md-3" for="bbb_kode">Kelompok :</label>';
			echo '<div class="col-md-8">';
				combobox('db', $data_kelompok, 'bbb_kode', 'kode', 'kelompok_nama', '', 'show_form_kelompok_by_jenis();', 'Pilih Kelompok ...', 'class="select2_category form-control" required="required"');
			echo '</div>';
		}
	}
	
	public function tampil_combobox_kelompok_by_jenis(){
		$kelompok_kode = $this->uri->segment(4);
		if ($kelompok_kode){
			$data_jenis = $this->Jenis_model->grid_all('jenis.kode, jenis.jenis_nama', 'jenis.jenis_nama', '', '', '', array('jenis.kelompok'=>$kelompok_kode));
			echo '<label class="control-label col-md-3" for="ccc_kode">Jenis :</label>';
			echo '<div class="col-md-8">';
				combobox('db', $data_jenis, 'ccc_kode', 'kode', 'jenis_nama', '', 'show_form_jenis_by_obyek();', 'Pilih Jenis ...', 'class="select2_category form-control" required="required"');
			echo '</div>';
		}
	}
	
	public function tampil_combobox_jenis_by_obyek(){
		$jenis_kode = $this->uri->segment(4);
		if ($jenis_kode){
			$data_obyek = $this->Obyek_model->grid_all('obyek.kode, obyek.obyek_nama', 'obyek.obyek_nama', '', '', '', array('obyek.jenis'=>$jenis_kode));
			echo '<label class="control-label col-md-3" for="ddd_kode">Obyek :</label>';
			echo '<div class="col-md-8">';
				combobox('db', $data_obyek, 'ddd_kode', 'kode', 'obyek_nama', '', 'show_form_obyek_by_rincian();', 'Pilih Obyek ...', 'class="select2_category form-control" required="required"');
			echo '</div>';
		}
	}
	
	public function tampil_combobox_obyek_by_rincian(){
		$obyek_kode = $this->uri->segment(4);
		if ($obyek_kode){
			$data_rincian = $this->Rincian_model->grid_all('rincian.kode, rincian.rincian_nama', 'rincian.rincian_nama', '', '', '', array('rincian.obyek'=>$obyek_kode));
			echo '<label class="control-label col-md-3" for="ddd_kode">Rincian Obyek :</label>';
			echo '<div class="col-md-8">';
				combobox('db', $data_rincian, 'eee_kode', 'kode', 'rincian_nama', '', '', 'Pilih Rincian Obyek ...', 'class="select2_category form-control" required="required"');
			echo '</div>';
		}
	}
	
}