<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Hak_akses extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Menu_model');
		$this->load->model('Menu_admin_model');
		$this->load->model('Admin_level_model');
	}
		
	public function index()
	{	
		$admin_log = $this->auth->is_login_admin();
		$container['sidebar']['view']					= 'admin/sidebar';
		$container['sidebar']['dataset']['aktive_menu'] = 20;
		$container['content']['view']					= 'pengaturan/hak_akses/view';
		$container['content']['dataset']				= '';
		$header['admin_log']							= $admin_log;
		
		$container['content']['dataset']['admin_level']	= $this->Admin_level_model->grid_all('admin_level_kode, admin_level_nama', 'admin_level_nama', 'ASC', '', '', array('admin_level_status'=>'A'));
		$container['content']['dataset']['menu']		= $this->Menu_model->grid_all('menu_kode, menu_nama', 'menu_urutan', 'ASC', '', '', 'menu_level = \'1\' AND menu_status = \'A\'');
		
		$container['content']['dataset']['admin_level_kode'] = $this->input->post('admin_level_kode');
		$container['content']['dataset']['menu_subkode'] = $this->input->post('menu_status');
		
		$this->load->view('admin/head');
		$this->load->view('admin/header', $header);
		$this->load->view('admin/container', $container);
		$this->load->view('admin/footer');
	}
	
	public function insert()
	{
		$admin_log = $this->auth->is_login_admin();

		$this->form_validation->set_rules('admin_level_kode', 'Kelompok Pengguna', 'trim|required|xss_clean');
		
		if($this->form_validation->run() == FALSE)
		{
			$container['sidebar']['view']					= 'admin/sidebar';
			$container['sidebar']['dataset']['aktive_menu'] = 20;
			$container['content']['view']					= 'pengaturan/hak_akses/view';
			$container['content']['dataset']['admin_level']	= $this->Admin_level_model->grid_all('admin_level_kode, admin_level_nama', 'admin_level_nama', 'ASC', '', '', array('admin_level_status'=>'A'));
			$container['content']['dataset']['menu']		= $this->Menu_model->grid_all('menu_kode, menu_nama', 'menu_urutan', 'ASC', '', '', 'menu_level = \'1\' AND menu_status = \'A\'');
			
			$container['content']['dataset']['admin_level_kode'] = $this->input->post('admin_level_kode');
			$container['content']['dataset']['menu_subkode']= $this->input->post('menu_status');
		
			$header['admin_log']							= $admin_log;
			$this->load->view('admin/head');
			$this->load->view('admin/header', $header);
			$this->load->view('admin/container', $container);
			$this->load->view('admin/footer');
		} else {
			$admin_level_kode = $this->input->post('admin_level_kode');
			$menu_subkode = $this->input->post('menu_subkode');
			$menu = $this->input->post('menu');
			
			if (!empty($admin_level_kode)){
				if (!empty($menu)) {
					foreach($menu as $item){
						$where['menu_admin.admin_level_kode'] = $admin_level_kode;
						$where['menu_admin.menu_kode'] = $item;
						$jmlRow = $this->Menu_admin_model->count_all($where);
						if($jmlRow < 1) {
							$datamenu = array(
							   'menu_kode' => $item,
							   'admin_level_kode' => $admin_level_kode
							);
							$this->Menu_admin_model->insert($datamenu);
						}
					}
				}
				
				$sKd = 0;
				if (!empty($menu)) {
					foreach($menu as $items){
						$nKd[] = "'$items'";
					}
						
					$sKd = implode(",", $nKd);
				}
				
				if (empty($menu_subkode)){
					$query = $this->db->query("SELECT * FROM menu_admin LEFT JOIN menu ON menu_admin.menu_kode=menu.menu_kode WHERE menu_admin.menu_kode NOT IN ($sKd) AND menu_admin.admin_level_kode = '$admin_level_kode' AND menu.menu_level='1'");
					if ($query->num_rows() > 0)
					{
					   foreach ($query->result() as $row)
					   {
						  $this->db->query("DELETE FROM menu_admin WHERE menu_admin_kode='".$row->menu_admin_kode."'");
					   }
					}
				
				} else {
					$query = $this->db->query("SELECT * FROM menu_admin LEFT JOIN menu ON menu_admin.menu_kode=menu.menu_kode WHERE menu_admin.menu_kode NOT IN ($sKd) AND menu_admin.admin_level_kode = '$admin_level_kode' AND menu.menu_subkode='$menu_subkode'");
					if ($query->num_rows() > 0){
						foreach ($query->result() as $row){
							$listquery = $this->db->query("SELECT * FROM menu_admin LEFT JOIN menu ON menu_admin.menu_kode=menu.menu_kode WHERE menu_admin.menu_kode NOT IN ($sKd) AND menu_admin.admin_level_kode = '$admin_level_kode' AND menu.menu_subkode='".$row->menu_kode."'");
							if ($listquery->num_rows() > 0){
								foreach ($listquery->result() as $row2){
									$listquery2 = $this->db->query("SELECT * FROM menu_admin LEFT JOIN menu ON menu_admin.menu_kode=menu.menu_kode WHERE menu_admin.menu_kode NOT IN ($sKd) AND menu_admin.admin_level_kode = '$admin_level_kode' AND menu.menu_subkode='".$row2->menu_kode."'");
									if ($listquery2->num_rows() > 0){
										foreach ($listquery2->result() as $row3){
											$this->db->query("DELETE FROM menu_admin WHERE menu_admin_kode='".$row3->menu_admin_kode."'");
										}
									}
									$this->db->query("DELETE FROM menu_admin WHERE menu_admin_kode='".$row2->menu_admin_kode."'");
								}
							}
							$this->db->query("DELETE FROM menu_admin WHERE menu_admin_kode='".$row->menu_admin_kode."'");
						}
					}
				}
			}
			
			$this->session->set_flashdata('success','<div class="alert alert-success fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><strong>Success!</strong> Data akses bidang telah berhasil disimpan.</div>');
			
			redirect('pengaturan/hak_akses', 'refresh');
		}

	}
	
	public function tampil_form_hak_akses(){
		$admin_level_kode = $this->uri->segment(4);
		$menu_subkode = $this->uri->segment(5);

		if ($admin_level_kode){
			if (empty($menu_subkode)){
				$data_menu = $this->Menu_model->grid_all('menu_kode, menu_nama', 'menu_urutan', 'ASC', '', '', 'menu_level = \'1\' AND menu_status = \'A\'');
				
				if ($data_menu){
					foreach($data_menu as $row){
						$checked_menu = ($this->Menu_admin_model->count_all(array('menu_admin.admin_level_kode'=>$admin_level_kode, 'menu_admin.menu_kode'=>$row->menu_kode)) > 0)?'checked':'';
						echo '<div class="row">';
							echo '<div class="col-md-12">';
								echo '<div class="form-group">';
									echo '<label class="control-label" for="menu_'.$row->menu_kode.'"><input type="checkbox" name="menu[]" id="menu_'.$row->menu_kode.'" value="'.$row->menu_kode.'" '.$checked_menu.'> '.$row->menu_nama.'</label>';
								echo '</div>';
							echo '</div>';
						echo '</div>';
					}
				}
			} else {
				$data_menu = $this->Menu_model->grid_all('menu_kode, menu_nama', 'menu_urutan', 'ASC', '', '', 'menu_status = \'A\' AND menu_subkode = \''.$menu_subkode.'\'');
				if ($data_menu){
					foreach($data_menu as $row){
						$checked_menu = ($this->Menu_admin_model->count_all(array('menu_admin.admin_level_kode'=>$admin_level_kode, 'menu_admin.menu_kode'=>$row->menu_kode)) > 0)?'checked':'';
						echo '<div class="row">';
							echo '<div class="col-md-12">';
								echo '<div class="form-group">';
									echo '<label class="control-label" for="menu_'.$row->menu_kode.'"><input type="checkbox" name="menu[]" id="menu_'.$row->menu_kode.'" value="'.$row->menu_kode.'" '.$checked_menu.'> '.$row->menu_nama.'</label>';
								echo '</div>';
							echo '</div>';
						echo '</div>';
						$data_menu2 = $this->Menu_model->grid_all('menu_kode, menu_nama', 'menu_urutan', 'ASC', '', '', 'menu_status = \'A\' AND menu_subkode = \''.$row->menu_kode.'\'');
						if ($data_menu2){
							foreach($data_menu as $row){
								$checked_menu = ($this->Menu_admin_model->count_all(array('menu_admin.admin_level_kode'=>$admin_level_kode, 'menu_admin.menu_kode'=>$row->menu_kode)) > 0)?'checked':'';
								echo '<div class="row">';
									echo '<div class="col-md-1">&bnsp;</div>';
									echo '<div class="col-md-11">';
										echo '<div class="form-group">';
											echo '<label class="control-label" for="menu_'.$row->menu_kode.'"><input type="checkbox" name="menu[]" id="menu_'.$row->menu_kode.'" value="'.$row->menu_kode.'" '.$checked_menu.'> '.$row->menu_nama.'</label>';
										echo '</div>';
									echo '</div>';
								echo '</div>';
							}
						}
					}
				}
			}
		} else {
			$data_menu = $this->Menu_model->grid_all('menu_kode, menu_nama', 'menu_urutan', 'ASC', '', '', 'menu_level = \'1\' AND menu_status = \'A\'');
			
			if ($data_menu){
				foreach($data_menu as $row){
					echo '<div class="row">';
						echo '<div class="col-md-12">';
							echo '<div class="form-group">';
								echo '<label class="control-label" for="menu_'.$row->menu_kode.'"><input type="checkbox" name="menu[]" id="menu_'.$row->menu_kode.'" value="'.$row->menu_kode.'"> '.$row->menu_nama.'</label>';
							echo '</div>';
						echo '</div>';
					echo '</div>';
				}
			}
		}
	}
}
