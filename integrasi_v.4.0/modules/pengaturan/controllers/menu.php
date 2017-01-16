<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Menu extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Menu_model');
		$this->load->library('Datatables');
	}
	
	function datatable()
    {
        $this->datatables->select('nomor, menu_kode, menu_nama, menu_url')
		->add_column('menu_url', site_url(). '$1','menu_url')
		->add_column('Actions', get_buttons('$1'),'menu_kode')
		->search_column('menu_nama, menu_url')
        ->from('(SELECT @ROW_NUMBER  := @ROW_NUMBER + 1 as nomor, menu_kode, menu_nama, menu_url FROM (SELECT @ROW_NUMBER := 0) ROWNUMBER, menu WHERE (menu_status = \'A\') ORDER BY menu_nama ASC) menu');
        
        echo $this->datatables->generate();
    }
		
	public function index()
	{	
		$admin_log = $this->auth->is_login_admin();
		$container['sidebar']['view']					= 'admin/sidebar';
		$container['sidebar']['dataset']['aktive_menu'] = 20;
		$container['content']['view']					= 'pengaturan/menu/view';
		$container['content']['dataset']				= '';
		$header['admin_log']							= $admin_log;
		
		$container['content']['dataset']['grid']		= $this->Menu_model->grid_all('menu.*', 'menu_kode', 'ASC', '', '', array('menu_status'=>'A'));
		
		$this->load->view('admin/head');
		$this->load->view('admin/header', $header);
		$this->load->view('admin/container', $container);
		$this->load->view('admin/footer');
	}
	
	public function add()
	{
		$admin_log = $this->auth->is_login_admin();
		$container['sidebar']['view']					= 'admin/sidebar';
		$container['sidebar']['dataset']['aktive_menu'] = 20;
		$container['content']['view']					= 'pengaturan/menu/add';
		$container['content']['dataset']['level']		= array(1, 2, 3);
		
		$header['admin_log']							= $admin_log;
		$this->load->view('admin/head');
		$this->load->view('admin/header', $header);
		$this->load->view('admin/container', $container);
		$this->load->view('admin/footer');
	}
	
	public function insert()
	{
		$admin_log = $this->auth->is_login_admin();

		$this->form_validation->set_rules('menu_level', 'Menu Level', 'trim|required|xss_clean');
		$this->form_validation->set_rules('menu_nama', 'Menu Nama', 'trim|required|xss_clean');
		$this->form_validation->set_rules('menu_url', 'URL', 'trim|required|xss_clean');
		$this->form_validation->set_rules('menu_urutan', 'Urutan', 'trim|required|xss_clean');
		
		if($this->form_validation->run() == FALSE)
		{
			$container['sidebar']['view']					= 'admin/sidebar';
			$container['sidebar']['dataset']['aktive_menu'] = 20;
			$container['content']['view']					= 'pengaturan/menu/add';
			$container['content']['dataset']['level']		= array(1, 2, 3);
			$header['admin_log']							= $admin_log;
			$this->load->view('admin/head');
			$this->load->view('admin/header', $header);
			$this->load->view('admin/container', $container);
			$this->load->view('admin/footer');
		} else {
			
			$insert['menu_level']		= $this->input->post('menu_level');
			$insert['menu_nama']		= $this->input->post('menu_nama');
			$insert['menu_deskripsi']	= $this->input->post('menu_deskripsi');
			$insert['menu_url']			= $this->input->post('menu_url');
			$insert['menu_urutan']		= $this->input->post('menu_urutan');
			$insert['menu_icon']		= $this->input->post('menu_icon');
			$insert['menu_subkode']		= $this->input->post('menu_subkode');
			$insert['menu_status']		= 'A';
						
			$query = $this->Menu_model->insert($insert);
			
			$this->session->set_flashdata('success','<div class="alert alert-success fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><strong>Success!</strong> Data menu baru telah berhasil ditambahkan.</div>');
			
			redirect('pengaturan/menu', 'refresh');
		}

	}
	
	public function edit()
	{
		$admin_log = $this->auth->is_login_admin();
		$container['sidebar']['view']					= 'admin/sidebar';
		$container['sidebar']['dataset']['aktive_menu'] = 20;
		$container['content']['view']					= 'pengaturan/menu/edit';
		$container['content']['dataset']['level']		= array(1, 2, 3);
		$container['content']['dataset']['menu']		= $this->Menu_model->grid_all('menu.*', 'menu_kode', 'ASC', '', '', array('menu_status'=>'A'));
		
		$menu = $this->Menu_model->get('menu.*', array('menu.menu_kode'=>$this->uri->segment(4)));
		
		$container['content']['dataset']['menu_kode']		= $menu->menu_kode;
		$container['content']['dataset']['menu_nama']		= $menu->menu_nama;
		$container['content']['dataset']['menu_deskripsi']	= $menu->menu_deskripsi;
		$container['content']['dataset']['menu_url']		= $menu->menu_url;
		$container['content']['dataset']['menu_level']		= $menu->menu_level;
		$container['content']['dataset']['menu_subkode']	= $menu->menu_subkode;
		$container['content']['dataset']['menu_urutan']		= $menu->menu_urutan;
		$container['content']['dataset']['menu_icon']		= $menu->menu_icon;
		
		$header['admin_log']								= $admin_log;
		$this->load->view('admin/head');
		$this->load->view('admin/header', $header);
		$this->load->view('admin/container', $container);
		$this->load->view('admin/footer');
	}
	
	public function update()
	{
		$admin_log = $this->auth->is_login_admin();

		$this->form_validation->set_rules('menu_level', 'Menu Level', 'trim|required|xss_clean');
		$this->form_validation->set_rules('menu_nama', 'Menu Nama', 'trim|required|xss_clean');
		$this->form_validation->set_rules('menu_url', 'URL', 'trim|required|xss_clean');
		$this->form_validation->set_rules('menu_urutan', 'Urutan', 'trim|required|xss_clean');
		
		if($this->form_validation->run() == FALSE)
		{
			$container['sidebar']['view']					= 'admin/sidebar';
			$container['sidebar']['dataset']['aktive_menu'] = 20;
			$container['content']['view']					= 'pengaturan/menu/edit';
			$container['content']['dataset']['level']		= array(1, 2, 3);
			$container['content']['dataset']['menu']		= $this->Menu_model->grid_all('menu.*', 'menu_kode', 'ASC', '', '', array('menu_status'=>'A'));
			
			$menu = $this->Menu_model->get('menu.*', array('menu.menu_kode'=>$this->uri->segment(4)));
			
			$container['content']['dataset']['menu_kode']		= $menu->menu_kode;
			$container['content']['dataset']['menu_nama']		= $menu->menu_nama;
			$container['content']['dataset']['menu_deskripsi']	= $menu->menu_deskripsi;
			$container['content']['dataset']['menu_url']		= $menu->menu_url;
			$container['content']['dataset']['menu_level']		= $menu->menu_level;
			$container['content']['dataset']['menu_subkode']	= $menu->menu_subkode;
			$container['content']['dataset']['menu_urutan']		= $menu->menu_urutan;
			$container['content']['dataset']['menu_icon']		= $menu->menu_icon;
			
			$header['admin_log']								= $admin_log;
			$this->load->view('admin/head');
			$this->load->view('admin/header', $header);
			$this->load->view('admin/container', $container);
			$this->load->view('admin/footer');
		} else {
			$update['menu_nama']		= $this->input->post('menu_nama');	
			$update['menu_deskripsi']	= $this->input->post('menu_deskripsi');	
			$update['menu_url']			= $this->input->post('menu_url');	
			$update['menu_level']		= $this->input->post('menu_level');	
			$update['menu_subkode']		= $this->input->post('menu_subkode');	
			$update['menu_urutan']		= $this->input->post('menu_urutan');	
			$update['menu_icon']		= $this->input->post('menu_icon');	
						
			$query = $this->Menu_model->update($update, $this->input->post('menu_kode'));

			$this->session->set_flashdata('success','<div class="alert alert-success fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><strong>Success!</strong> Data menu telah berhasil diubah.</div>');
			
			redirect('pengaturan/menu', 'refresh');
		}
	}
	
	public function detail()
	{
		$admin_log = $this->auth->is_login_admin();
		$container['sidebar']['view']					= 'admin/sidebar';
		$container['sidebar']['dataset']['aktive_menu'] = 20;
		$container['content']['view']					= 'pengaturan/menu/detail';
		$container['content']['dataset']['level']		= array(1, 2, 3);
		
		$menu = $this->Menu_model->get('menu.*', array('menu.menu_kode'=>$this->uri->segment(4)));
		
		$container['content']['dataset']['menu_kode']		= $menu->menu_kode;
		$container['content']['dataset']['menu_nama']		= $menu->menu_nama;
		$container['content']['dataset']['menu_deskripsi']	= $menu->menu_deskripsi;
		$container['content']['dataset']['menu_url']		= $menu->menu_url;
		$container['content']['dataset']['menu_level']		= $menu->menu_level;
		$container['content']['dataset']['menu_subkode']	= $menu->menu_subkode;
		$container['content']['dataset']['menu_urutan']		= $menu->menu_urutan;
		$container['content']['dataset']['menu_icon']		= $menu->menu_icon;
		
		$header['admin_log']								= $admin_log;
		$this->load->view('admin/head');
		$this->load->view('admin/header', $header);
		$this->load->view('admin/container', $container);
		$this->load->view('admin/footer');
	}
	
	
	public function delete()
	{
		if ($this->uri->segment(4)){
			//$this->Menu_model->delete($this->uri->segment(4));
			
			$update['menu_status']	= 'H';			
			$this->Menu_model->update($update, $this->uri->segment(4));
			
			$this->session->set_flashdata('success','<div class="alert alert-success fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><strong>Success!</strong> Data menu telah berhasil dihapus.</div>');
		} 

		redirect('pengaturan/menu', 'refresh');
	}
	
	public function tampil_combobox_menu_subkode(){
		$menu_level = $this->uri->segment(4) - 1;
		$data_menu_utama = $this->Menu_model->grid_all('menu_kode, menu_nama', 'menu_kode', 'ASC', '', '', array('menu.menu_level' => $menu_level), '');
		if ($menu_level > 0){
		echo '<div class="col-md-4">';
			echo '<div class="form-group">';
				echo '<label class="control-label" for="menu_subkode">Pilih Menu Utama :</label>';
				combobox('db', $data_menu_utama, 'menu_subkode', 'menu_kode', 'menu_nama', '', '', 'Pilih Menu Utama', 'class="select2_category form-control" required="required"');
			echo '</div>';
		echo '</div>';
		}
	}
}
