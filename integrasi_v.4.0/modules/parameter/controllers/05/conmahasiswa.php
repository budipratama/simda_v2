<?php
class ConMahasiswa extends CI_Controller{
    function __construct() {
        parent::__construct();
        $this->load->model('modelmahasiswa');
    }
    
    function index() {
        $data['mahasiswa'] = $this->modelmahasiswa->getDataMahasiswa();
        $this->load->view('mahasiswa/viewmahasiswa',$data);
    }
	
	public function index1()	{
		$admin_log 	= $this->auth->is_login_admin();
		{
			$container['sidebar']['view']					= 'admin/sidebar';
			$container['sidebar']['dataset']['aktive_menu'] = 60;
			$container['content']['view']					= 'parameter/mahasiswa/viewmahasiswa';
			
			$container['mahasiswa'] 						= $this->modelmahasiswa->getDataMahasiswa();
			
			$header['admin_log']							= $admin_log;
			$this->load->view('admin/head');
			$this->load->view('admin/header', $header);
			$this->load->view('admin/container', $container);
			$this->load->view('admin/tables');
		}
	}
    
    function tambah() {
        if($_POST == NULL) {
            $data['judul'] = 'Input Data Mahasiswa';
            $this->load->view('mahasiswa/inputmahasiswa');
        }
        else {
            $nim = $this->input->post('nim');
            $nama = $this->input->post('nama');
            $jurusan = $this->input->post('jurusan');
            $angkatan = $this->input->post('angkatan');
            $ipk = $this->input->post('ipk');            
            
            $data=array(
                'nim' => $nim,
                'nama'    => $nama,
                'jurusan'    => $jurusan,
                'angkatan'    => $angkatan,
                'ipk'    => $ipk            
            );
            
            $this->modelmahasiswa->insertDataMahasiswa($data);
            
             $out['mahasiswa'] = $this->modelmahasiswa->getDataMahasiswa();
          //$this->load->view("data",$out);    
        
        
        }
    }
    
    function edit($nim = NULL) {
        $data['mahasiswa'] = $this->modelmahasiswa->DataMahasiswa($nim);
        $this->load->view('mahasiswa/editmahasiswa',$data);    
    }
    
    function update(){
        $nim = $this->input->post('nim');
        $nama = $this->input->post('nama');
        $jurusan = $this->input->post('jurusan');
        $angkatan = $this->input->post('angkatan');
        $ipk = $this->input->post('ipk');            
        
        $data=array(
            'nim' => $nim,
            'nama'    => $nama,
            'jurusan'    => $jurusan,
            'angkatan'    => $angkatan,
            'ipk'    => $ipk            
        );
        
        $this->modelmahasiswa->updateMahasiswa($data);
           
    }
    
    function delete($nim){
        
        $this->modelmahasiswa->deleteMahasiswa($nim);    
    }
}
?>