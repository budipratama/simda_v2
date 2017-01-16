<?php defined('BASEPATH') OR exit('No direct script access allowed');

class mycontroller extends CI_Controller{

  public function __construct() {
    parent::__construct();
    $this->load->model('mymodels');
    $this->load->model('Jenis_model');
  }

  public function index() {
		$admin_log 	= $this->auth->is_login_admin();
		{
			$container['sidebar']['view']					= 'admin/sidebar';
			$container['sidebar']['dataset']['aktive_menu'] = 60;
			$container['content']['view']					= 'parameter/mycontroller/tampildata';
		
		    $this->db->order_by('kode','DESC');
			$query 											= $this->db->get('ms_rek_3');
			$container['jenis'] 							= $query->result();
			
			$header['admin_log']							= $admin_log;
			$this->load->view('admin/head');
			$this->load->view('admin/header', $header);
			$this->load->view('admin/container', $container);
			$this->load->view('admin/tables');
		}
	}

  function urltambah(){
    $url = $this->load->view('parameter/mycontroller/tambahdata',true);
    return $url;
  }

  function tambahdata(){
    $nama = $this->input->post('nama');
    $tlpn = $this->input->post('tlpn');
    $alamat = $this->input->post('alamat');
    $jk = $this->input->post('jk');
    $data = array('nama'=>$nama,
                  'tlpn'=>$tlpn,
                  'alamat'=>$alamat,
                  'JK'=>$jk);
    if ($this->mymodels->insertdata($data)) {
	// echo json_encode(array("kondisi" => "berhasil"));
	echo json_encode(array("status" => TRUE));
    }
  }

  function editdataview(){
    $id 		= $this->input->post('id');
    $query 		= $this->db->get_where('ms_rek_3', array('kode'=>$id));
    $result 	= $query->result();
	
	$where_saldo								= 'kode IN (\'1\',\'22\')';			
	$container['saldo']							= $this->Jenis_model->grid_all('saldo_normal, saldo_normal', 'saldo_normal', 'ASC', '', '', $where_saldo, '', 'ms_rek_3.kode');
   
	$container['jenis']		= $query->result();
   
	$url = $this->load->view('parameter/mycontroller/editdata', $container);
    return $url;
  }

  function editdata(){
    $id = $this->input->post('id');
    $nama = $this->input->post('nama');
    $tlpn = $this->input->post('tlpn');
    $alamat = $this->input->post('alamat');
    $jk = $this->input->post('jk');
    $data = array('nama'=>$nama,
                  'tlpn'=>$tlpn,
                  'alamat'=>$alamat,
                  'JK'=>$jk);
    if ($this->mymodels->updatedata($id, $data)) {
        echo json_encode(array("kondisi" => "berhasil"));
      }
  }

  function hapusdata(){
    $id = $this->input->post('id');
    if ($this->mymodels->deletedata($id)) {
      echo json_encode(array("kondisi" => "berhasil"));
    }
  }

}
