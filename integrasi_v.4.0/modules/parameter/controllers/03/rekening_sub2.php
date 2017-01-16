<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rekening_sub extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();	
		$this->load->model('Tipe_model');
		$this->load->model('Akun_model');			
		$this->load->model('Kelompok_model');			
		$this->load->model('Jenis_model');
		$this->load->model('Obyek_model');
		$this->load->model('Rincian_model');	
		$this->load->model('Sub_rincian_model');	
		$this->load->library('Datatables');
	}
	
	public function index()	{
		$admin_log 	= $this->auth->is_login_admin();
		{
			$container['sidebar']['view']					= 'admin/sidebar';
			$container['sidebar']['dataset']['aktive_menu'] = 60;
			$container['content']['view']					= 'parameter/rekening_sub/view';
			
			$header['admin_log']							= $admin_log;
			$this->load->view('admin/head');
			$this->load->view('admin/header', $header);
			$this->load->view('admin/container', $container);
			$this->load->view('admin/footer');
		}
	}
	
	function datatable() {
		$this->datatables->select('nomor, kode, sub_nama, nama_obyek, rincian_nama')
		->add_column('Actions', $this->get_buttons($tipe, '$1'),'kode')
		->search_column('rincian_nama')
        ->from('(SELECT @ROW_NUMBER  := @ROW_NUMBER + 1 as nomor, sub_rincian.kode, sub_rincian.sub_nama, obyek.obyek_nama as nama_obyek, rincian.rincian_nama as rincian_nama FROM (SELECT @ROW_NUMBER := 0) ROWNUMBER,
		sub_rincian LEFT JOIN obyek ON sub_rincian.obyek=obyek.kode
					LEFT JOIN rincian ON sub_rincian.rincian=rincian.kode
		ORDER BY sub_rincian.sub_nama ASC) sub_rincian');
        echo $this->datatables->generate();
    }
	
	function get_buttons ($tipe, $id) {
		$ci= & get_instance();
		$ci->load->helper('url');
		$html  = '<div style="text-align:center;white-space: nowrap;">';
		$html .= '<a href="'. site_url($ci->uri->segment(1) . '/rekening_sub/edit/'.$id) .'" class="btn btn-sm btn-warning" title="Ubah"><i class="fa fa-pencil"></i></a>';
		$html .= '<a href="'. site_url($ci->uri->segment(1) . '/rekening_sub/delete/'.$id) .'" class="btn btn-sm btn-danger" title="Hapus" data-placement="left" onclick="return confirm(\'Apakah anda yakin? \nAkan menghapus data\');"><i class="fa fa-trash-o"></i></a>';
		$html .= '</div>';
		return $html;
	}
	
	public function add() {
		$admin_log = $this->auth->is_login_admin();
		$container['sidebar']['view']					= 'admin/sidebar';
		$container['sidebar']['dataset']['aktive_menu'] = 60;
		$container['content']['view']					= 'parameter/rekening_sub/add';
		$container['content']['dataset']				= '';		
		
		$where_akun											= 'akun_sort IN (\'1\')';
		$where_kelompok										= 'akun IN (\'5\')';
		$where_jenis										= 'akun IN (\'5\')';
		$where_obyek										= 'akun IN (\'5\')';
		$where_rincian										= 'akun IN (\'5\')';
		$container['content']['dataset']['akun']			= $this->Akun_model->grid_all('kode, akun_nama', 'akun_nama', '', '', '', $where_akun);
		$container['content']['dataset']['kelompok']		= $this->Kelompok_model->grid_all('kode, kelompok_nama', 'kelompok_nama', '', '', '', $where_kelompok);
		$container['content']['dataset']['jenis']			= $this->Jenis_model->grid_all('kode, jenis_nama', 'jenis_nama', '', '', '', $where_jenis);
		$container['content']['dataset']['obyek']			= $this->Obyek_model->grid_all('kode, obyek_nama', 'obyek_nama', '', '', '', $where_obyek);
		$container['content']['dataset']['rincian']			= $this->Rincian_model->grid_all('kode, rincian_nama', 'rincian_nama', '', '', '', $where_rincian);
		$container['content']['dataset']['akun_']			= '5';
		$container['content']['dataset']['kelompok_']		= '16';
		$container['content']['dataset']['jenis_']			= '65';
		
		$header['admin_log']							= $admin_log;
		$this->load->view('admin/head');
		$this->load->view('admin/header', $header);
		$this->load->view('admin/container', $container);
		$this->load->view('admin/footer');
	}
	
	public function insert() {
		$admin_log = $this->auth->is_login_admin();

		$this->form_validation->set_rules('ddd_kode', 'Obyek', 'trim|required|xss_clean');
		$this->form_validation->set_rules('eee_kode', 'Rincian', 'trim|required|xss_clean');
		$this->form_validation->set_rules('sub_rincian', 'Sub_nama', 'trim|required|xss_clean');
		
		if($this->form_validation->run() == FALSE)
		{
			$container['sidebar']['view']					= 'admin/sidebar';
			$container['sidebar']['dataset']['aktive_menu'] = 60;
			$container['content']['view']					= 'parameter/rekening_sub/add';
			
			$where_akun										= 'akun_sort IN (\'1\')';
			$where_kelompok									= 'akun IN (\'5\')';
			$where_jenis									= 'akun IN (\'5\')';
			$where_obyek									= 'akun IN (\'5\')';
			$where_rincian									= 'akun IN (\'5\')';
			$container['content']['dataset']['akun']		= $this->Akun_model->grid_all('kode, akun_nama', 'akun_nama', '', '', '', $where_akun);
			$container['content']['dataset']['kelompok']	= $this->Kelompok_model->grid_all('kode, kelompok_nama', 'kelompok_nama', '', '', '', $where_kelompok);
			$container['content']['dataset']['jenis']		= $this->Jenis_model->grid_all('kode, jenis_nama', 'jenis_nama', '', '', '', $where_jenis);
			$container['content']['dataset']['obyek']		= $this->Obyek_model->grid_all('kode, obyek_nama', 'obyek_nama', '', '', '', $where_obyek);
			$container['content']['dataset']['rincian']		= $this->Rincian_model->grid_all('kode, rincian_nama', 'rincian_nama', '', '', '', $where_rincian);
			$container['content']['dataset']['akun_']		= '5';
			$container['content']['dataset']['kelompok_']	= '16';
			$container['content']['dataset']['jenis_']		= '65';
			
			$header['admin_log']							= $admin_log;
			$this->load->view('admin/head');
			$this->load->view('admin/header', $header);
			$this->load->view('admin/container', $container);
			$this->load->view('admin/footer');
		} else {
			
			$insert['akun']		= 5;
			$insert['kelompok']	= 16;
			$insert['jenis']	= 65;
			$insert['obyek']	= $this->input->post('ddd_kode');
			$insert['rincian']	= $this->input->post('eee_kode');
			$insert['sub_nama']	= $this->input->post('sub_rincian');
						
			$query = $this->Sub_rincian_model->insert($insert);
			
			$this->session->set_flashdata('success','<div class="alert fresh-color alert-info fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><strong>Success!</strong> Data "SUB RINCIAN" telah berhasil ditambahkan</div>');
			
			redirect('parameter/rekening-sub', 'refresh');
		}

	}
	
	public function edit() {
		$admin_log = $this->auth->is_login_admin();
		$container['sidebar']['view']					= 'admin/sidebar';
		$container['sidebar']['dataset']['aktive_menu'] = 60;
		$container['content']['view']					= 'parameter/rekening_sub/edit';
		
		$where_akun										= 'akun_sort IN (\'1\')';
		$where_kelompok									= 'akun IN (\'5\')';
		$where_jenis									= 'akun IN (\'5\')';
		$where_obyek									= 'akun IN (\'5\')';
		$where_rincian									= 'akun IN (\'5\')';
		$container['content']['dataset']['akun']		= $this->Akun_model->grid_all('kode, akun_nama', 'akun_nama', '', '', '', $where_akun);
		$container['content']['dataset']['kelompok']	= $this->Kelompok_model->grid_all('kode, kelompok_nama', 'kelompok_nama', '', '', '', $where_kelompok);
		$container['content']['dataset']['jenis']		= $this->Jenis_model->grid_all('kode, jenis_nama', 'jenis_nama', '', '', '', $where_jenis);
		$container['content']['dataset']['obyek']		= $this->Obyek_model->grid_all('kode, obyek_nama', 'obyek_nama', '', '', '', $where_obyek);
		$container['content']['dataset']['rincian']		= $this->Rincian_model->grid_all('kode, rincian_nama', 'rincian_nama', '', '', '', $where_rincian);
		$container['content']['dataset']['akun_']		= '5';
		$container['content']['dataset']['kelompok_']	= '16';
		$container['content']['dataset']['jenis_']		= '65';
		
		$sub_rincian = $this->Sub_rincian_model->get('sub_rincian.*', array('sub_rincian.kode'=>$this->uri->segment(4)));
		
		$container['content']['dataset']['kode']		= $sub_rincian->kode;
		$container['content']['dataset']['akun_']		= $sub_rincian->akun;
		$container['content']['dataset']['kelompok_']	= $sub_rincian->kelompok;
		$container['content']['dataset']['jenis_']		= $sub_rincian->jenis;
		$container['content']['dataset']['obyek_']		= $sub_rincian->obyek;
		$container['content']['dataset']['rincian_']	= $sub_rincian->rincian;
		$container['content']['dataset']['sub_rincian']	= $sub_rincian->sub_nama;
		
		$header['admin_log']							= $admin_log;
		$this->load->view('admin/head');
		$this->load->view('admin/header', $header);
		$this->load->view('admin/container', $container);
		$this->load->view('admin/footer');
	}
	
	public function update()
	{
		$admin_log = $this->auth->is_login_admin();
		
		$this->form_validation->set_rules('ddd_kode', 'Obyek', 'trim|required|xss_clean');
		$this->form_validation->set_rules('eee_kode', 'Rincian', 'trim|required|xss_clean');
		$this->form_validation->set_rules('sub_rincian', 'Sub_nama', 'trim|required|xss_clean');
		
		if($this->form_validation->run() == FALSE)
		{
			$container['sidebar']['view']					= 'admin/sidebar';
			$container['sidebar']['dataset']['aktive_menu'] = 60;
			$container['content']['view']					= 'parameter/rekening_sub/edit';
			
			$where_akun										= 'akun_sort IN (\'1\')';
			$where_kelompok									= 'akun IN (\'5\')';
			$where_jenis									= 'akun IN (\'5\')';
			$where_obyek									= 'akun IN (\'5\')';
			$where_rincian									= 'akun IN (\'5\')';
			$container['content']['dataset']['akun']		= $this->Akun_model->grid_all('kode, akun_nama', 'akun_nama', '', '', '', $where_akun);
			$container['content']['dataset']['kelompok']	= $this->Kelompok_model->grid_all('kode, kelompok_nama', 'kelompok_nama', '', '', '', $where_kelompok);
			$container['content']['dataset']['jenis']		= $this->Jenis_model->grid_all('kode, jenis_nama', 'jenis_nama', '', '', '', $where_jenis);
			$container['content']['dataset']['obyek']		= $this->Obyek_model->grid_all('kode, obyek_nama', 'obyek_nama', '', '', '', $where_obyek);
			$container['content']['dataset']['rincian']		= $this->Rincian_model->grid_all('kode, rincian_nama', 'rincian_nama', '', '', '', $where_rincian);
			$container['content']['dataset']['akun_']		= '5';
			$container['content']['dataset']['kelompok_']	= '16';
			$container['content']['dataset']['jenis_']		= '65';
		
			$sub_rincian = $this->Sub_rincian_model->get('sub_rincian.*', array('sub_rincian.kode'=>$this->uri->segment(4)));
		
			$container['content']['dataset']['kode']		= $sub_rincian->kode;
			$container['content']['dataset']['akun_']		= $sub_rincian->akun;
			$container['content']['dataset']['kelompok_']	= $sub_rincian->kelompok;
			$container['content']['dataset']['jenis_']		= $sub_rincian->jenis;
			$container['content']['dataset']['obyek_']		= $sub_rincian->obyek;
			$container['content']['dataset']['rincian_']	= $sub_rincian->rincian;
			$container['content']['dataset']['sub_rincian']	= $sub_rincian->sub_nama;
			
			$header['admin_log']							= $admin_log;
			$this->load->view('admin/head');
			$this->load->view('admin/header', $header);
			$this->load->view('admin/container', $container);
			$this->load->view('admin/footer');
		} else {
			
			$update['akun']		= 5;
			$update['kelompok']	= 16;
			$update['jenis']	= 65;
			$update['obyek']	= $this->input->post('ddd_kode');
			$update['rincian']	= $this->input->post('eee_kode');
			$update['sub_nama']	= $this->input->post('sub_rincian');
			
			$query = $this->Sub_rincian_model->update($update, $this->input->post('kode'));

			$this->session->set_flashdata('success','<div class="alert fresh-color alert-warning fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><strong>Success!</strong> Data "SUB RINCIAN" telah berhasil diubah</div>');
			
			redirect('parameter/rekening_sub', 'refresh');
		}
	}
	
	public function delete()
	{
		if ($this->uri->segment(4)){
			$this->Sub_rincian_model->delete($this->uri->segment(4));
			$this->session->set_flashdata('success','<div class="alert fresh-color alert-danger fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><strong>Success!</strong> Data "SUB RINCIAN" telah berhasil dihapus</div>');
		} 

		redirect('parameter/rekening_sub', 'refresh');
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