<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Akses_bidang extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Akses_bidang_model');
		$this->load->model('Skpd_model');
		$this->load->model('Admin_level_model');
	}
		
	public function index()
	{	
		$admin_log = $this->auth->is_login_admin();
		$container['sidebar']['view']					= 'admin/sidebar';
		$container['sidebar']['dataset']['aktive_menu'] = 20;
		$container['content']['view']	= 'pengaturan/akses_bidang/view';
		$container['content']['dataset']= '';
		$header['admin_log']			= $admin_log;
		
		$container['content']['dataset']['admin_level']	= $this->Admin_level_model->grid_all('admin_level_kode, admin_level_nama', 'admin_level_nama', 'ASC', '', '', 'admin_level_status = \'A\' AND admin_level_nama LIKE \'Bidang%\'');
		$container['content']['dataset']['status']		= array(4=>'Kecamatan', 5=>'SKPD', 14=>'Desa', 15=>'Kelurahan');
		$container['content']['dataset']['skpd']		= $this->Skpd_model->grid_all('skpd_kode, skpd_nama', 'skpd_nama', 'ASC', '', '', 'skpd_status IN (\'SKPD\')');
		
		$container['content']['dataset']['admin_level_kode'] = $this->input->post('admin_level_kode');
		$container['content']['dataset']['skpd_status'] = $this->input->post('skpd_status');
		
		$this->load->view('admin/head');
		$this->load->view('admin/header', $header);
		$this->load->view('admin/container', $container);
		$this->load->view('admin/footer');
	}
	
	public function insert()
	{
		$admin_log = $this->auth->is_login_admin();

		$this->form_validation->set_rules('admin_level_kode', 'Kelompok Pengguna', 'trim|required|xss_clean');
		$this->form_validation->set_rules('skpd_status', 'SKPD', 'trim|required|xss_clean');
		
		if($this->form_validation->run() == FALSE)
		{
			$container['sidebar']['view']					= 'admin/sidebar';
			$container['sidebar']['dataset']['aktive_menu'] = 20;
			$container['content']['view']					= 'pengaturan/akses_bidang/view';
			$container['content']['dataset']['admin_level']	= $this->Admin_level_model->grid_all('admin_level_kode, admin_level_nama', 'admin_level_nama', 'ASC', '', '', array('admin_level_status'=>'A'));
			$container['content']['dataset']['status']		= array(4=>'Kecamatan', 5=>'SKPD', 14=>'Desa', 15=>'Kelurahan');
			$container['content']['dataset']['skpd']		= $this->Skpd_model->grid_all('skpd_kode, skpd_nama', 'skpd_nama', 'ASC', '', '', 'skpd_status IN (\'SKPD\')');
			
			$container['content']['dataset']['admin_level_kode'] = $this->input->post('admin_level_kode');
			$container['content']['dataset']['skpd_status'] = $this->input->post('skpd_status');
		
			$header['admin_log']							= $admin_log;
			$this->load->view('admin/head');
			$this->load->view('admin/header', $header);
			$this->load->view('admin/container', $container);
			$this->load->view('admin/footer');
		} else {
			$admin_level_kode = $this->input->post('admin_level_kode');
			$skpd_status = $this->input->post('skpd_status');
			$skpd = $this->input->post('skpd');
			
			if (!empty($admin_level_kode)){
				if (!empty($skpd)) {
					foreach($skpd as $item){
						$where['akses_bidang.admin_level_kode'] = $admin_level_kode;
						$where['akses_bidang.skpd_kode'] = $item;
						$jmlRow = $this->Akses_bidang_model->count_all($where);
						if($jmlRow < 1) {
							$dataskpd = array(
							   'skpd_kode' => $item,
							   'admin_level_kode' => $admin_level_kode
							);
							$this->Akses_bidang_model->insert($dataskpd);
						}
					}
				}
				
				$sKd = 0;
				if (!empty($skpd)) {
					foreach($skpd as $items){
						$nKd[] = "'$items'";
					}
						
					$sKd = implode(",", $nKd);
				}
				
				if($skpd_status == '4'){
					$skpd_status = 'Kecamatan';
				} else if($skpd_status == '5'){
					$skpd_status = 'SKPD';
				} else if($skpd_status == '14'){
					$skpd_status = 'Desa';
				} else if($skpd_status == '15'){
					$skpd_status = 'Kelurahan';
				} else {
					$skpd_status = 'SKPD';
				}
				
				$query = $this->db->query("SELECT * FROM akses_bidang LEFT JOIN skpd ON akses_bidang.skpd_kode=skpd.skpd_kode WHERE akses_bidang.skpd_kode NOT IN ($sKd) AND akses_bidang.admin_level_kode = '$admin_level_kode' AND skpd.skpd_status IN ('$skpd_status')");
				if ($query->num_rows() > 0)
				{
				   foreach ($query->result() as $row)
				   {
					  $this->db->query("DELETE FROM akses_bidang WHERE akses_bidang_kode='".$row->akses_bidang_kode."'");
				   }
				}
			}
			
			$this->session->set_flashdata('success','<div class="alert alert-success fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><strong>Success!</strong> Data akses bidang telah berhasil ditambahkan.</div>');
			
			redirect('pengaturan/akses_bidang', 'refresh');
		}

	}
	
	public function tampil_form_akses_bidang(){
		$admin_level_kode = $this->uri->segment(4);
		$skpd_status = $this->uri->segment(5);
		if ($admin_level_kode){
			if($skpd_status == '4'){
				$skpd_status = 'Kecamatan';
			} else if($skpd_status == '5'){
				$skpd_status = 'SKPD';
			} else if($skpd_status == '14'){
				$skpd_status = 'Desa';
			} else if($skpd_status == '15'){
				$skpd_status = 'Kelurahan';
			}
			
			$data_skpd = $this->Skpd_model->grid_all('skpd_kode, skpd_nama', 'skpd_nama', 'ASC', '', '', 'skpd_status IN (\''.$skpd_status.'\')');
			
			if ($data_skpd){
				foreach($data_skpd as $row){
					$checked_skpd = ($this->Akses_bidang_model->count_all(array('akses_bidang.admin_level_kode'=>$admin_level_kode, 'akses_bidang.skpd_kode'=>$row->skpd_kode)) > 0)?'checked':'';
					echo '<div class="row">';
						echo '<div class="col-md-12">';
							echo '<div class="form-group">';
								echo '<label class="control-label" for="skpd_'.$row->skpd_kode.'"><input type="checkbox" name="skpd[]" id="skpd_'.$row->skpd_kode.'" value="'.$row->skpd_kode.'" '.$checked_skpd.'> '.$row->skpd_nama.'</label>';
							echo '</div>';
						echo '</div>';
					echo '</div>';
				}
			}
		} else {
			$data_skpd = $this->Skpd_model->grid_all('skpd_kode, skpd_nama', 'skpd_nama', 'ASC', '', '', 'skpd_status IN (\'SKPD\')');
			
			if ($data_skpd){
				foreach($data_skpd as $row){
					echo '<div class="row">';
						echo '<div class="col-md-12">';
							echo '<div class="form-group">';
								echo '<label class="control-label" for="skpd_'.$row->skpd_kode.'"><input type="checkbox" name="skpd[]" id="skpd_'.$row->skpd_kode.'" value="'.$row->skpd_kode.'"> '.$row->skpd_nama.'</label>';
							echo '</div>';
						echo '</div>';
					echo '</div>';
				}
			}
		}
	}
}
