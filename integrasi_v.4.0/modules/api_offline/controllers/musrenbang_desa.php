<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	require APPPATH.'/libraries/REST_Controller.php';

	class Musrenbang_desa extends REST_Controller {
		
		private $tahapan;

		public function __construct()
		{
			parent::__construct();
			$this->load->model('Admin_model');
			$this->load->model('Tahapan_model');
			$this->load->model('Tahapan_skpd_model');
			$this->load->model('api_offline/Anggaran_model');
			$this->load->model('api_offline/Key_model');
			$this->tahapan	= 2;
		}

		public function grid_get()
		{
			$tahapan 	= $this->tahapan;
			$tahun 		= $this->uri->segment(4);
			$tipe 		= $this->uri->segment(5);
			$pelaksana 	= ($this->uri->segment(6))?$this->uri->segment(6):'skpd';
			$kecamatan 	= ($this->uri->segment(7))?$this->uri->segment(7):'kecamatan';
			$deskel 	= ($this->uri->segment(8))?$this->uri->segment(8):'deskel';
			
			if ($tahun && $tipe){
				$key = $this->Key_model->get('admin_user', array('key_value'=>getHeader()));
				$admin = $this->Admin_model->get('admin.admin_user, admin.skpd_kode', array('admin_user'=>$key->admin_user));
				$skpd = $admin->skpd_kode;
				
				if ($pelaksana == 'skpd' && $kecamatan == 'kecamatan' && $deskel == 'deskel'){
					$where = 'anggaran.skpd_kode = \''.$skpd.'\' AND anggaran.tipe_kode = \''.$tipe.'\' AND anggaran.tahun = \''.$tahun.'\' AND anggaran.tahapan_kode = \''.$tahapan.'\'';
				} else if ($kecamatan == 'kecamatan' && $deskel == 'deskel'){
					$where = 'anggaran.skpd_kode = \''.$skpd.'\' AND anggaran.tipe_kode = \''.$tipe.'\' AND anggaran.tahun = \''.$tahun.'\' AND anggaran.tahapan_kode = \''.$tahapan.'\' AND anggaran.pelaksana_kode = \''.$pelaksana.'\'';
				} else if ($pelaksana == 'skpd' && $deskel == 'deskel'){
					$where = 'anggaran.skpd_kode = \''.$skpd.'\' AND anggaran.tipe_kode = \''.$tipe.'\' AND anggaran.tahun = \''.$tahun.'\' AND anggaran.tahapan_kode = \''.$tahapan.'\' AND anggaran.kecamatan_kode = \''.$kecamatan.'\'';
				} else if ($pelaksana == 'skpd'){
					$where = 'anggaran.skpd_kode = \''.$skpd.'\' AND anggaran.tipe_kode = \''.$tipe.'\' AND anggaran.tahun = \''.$tahun.'\' AND anggaran.tahapan_kode = \''.$tahapan.'\' AND anggaran.kecamatan_kode = \''.$kecamatan.'\' AND anggaran.deskel_kode = \''.$deskel.'\'';
				} else if ($deskel == 'deskel'){
					$where = 'anggaran.skpd_kode = \''.$skpd.'\' AND anggaran.tipe_kode = \''.$tipe.'\' AND anggaran.tahun = \''.$tahun.'\' AND anggaran.tahapan_kode = \''.$tahapan.'\' AND anggaran.pelaksana_kode = \''.$pelaksana.'\' AND anggaran.kecamatan_kode = \''.$kecamatan.'\'';
				} else {
					$where = 'anggaran.skpd_kode = \''.$skpd.'\' AND anggaran.tipe_kode = \''.$tipe.'\' AND anggaran.tahun = \''.$tahun.'\' AND anggaran.tahapan_kode = \''.$tahapan.'\' AND anggaran.pelaksana_kode = \''.$pelaksana.'\' AND anggaran.kecamatan_kode = \''.$kecamatan.'\' AND anggaran.deskel_kode = \''.$deskel.'\'';
				}
		
				if ($tipe == 1){
					$anggaran 		=  $this->Anggaran_model->grid_bl('anggaran.*, anggaran_bl.*', 'anggaran.nomor', 'ASC', '', '', $where);
				} else {
					$anggaran 		=  $this->Anggaran_model->grid_btl('anggaran.*, anggaran_btl.*', 'anggaran.nomor', 'ASC', '', '', $where);
				}
				
				if(empty($anggaran)){
					$this->response(array('success' => false, 'message' => 'Tidak ada data hasil musrenbang', 'responseCode' => 406), 406);
				} else {
					$this->response(array('success' => true, 'message' => 'Success', 'responseCode' => 200, 'data' => $anggaran), 200);
				}
			} else {
				$this->response(array('success' => false, 'message' => 'Paramter tidak ada', 'responseCode' => 400), 400);
			}
		}
		
		public function get_get()
		{
			$tahapan 	= $this->tahapan;
			$nomor 		= $this->uri->segment(4);
			
			if ($nomor){
				$where['nomor']	= $nomor;
				$anggaran 		=  $this->Anggaran_model->getOnly('*', $where);
				
				if(empty($anggaran)){
					$this->response(array('success' => false, 'message' => 'Tidak ada data hasil musrenbang', 'responseCode' => 406), 406);
				} else {
					$this->response(array('success' => true, 'message' => 'Success', 'responseCode' => 200, 'data' => $anggaran), 200);
				}
			} else {
				$this->response(array('success' => false, 'message' => 'Paramter tidak ada', 'responseCode' => 400), 400);
			}
		}
		
		public function get_full_get()
		{
			$tahapan 	= $this->tahapan;
			$nomor 		= $this->uri->segment(4);
			
			if ($nomor){
				$where['nomor']	= $nomor;
				$anggaran 		=  $this->Anggaran_model->getOnly('*', $where);
				
				if(empty($anggaran)){
					$this->response(array('success' => false, 'message' => 'Tidak ada data hasil musrenbang', 'responseCode' => 406), 406);
				} else {
					if ($anggaran->tipe_kode == 1){
						$anggaran_ = $this->Anggaran_model->get_bl('1', '*', $where);
					} else {
						$anggaran_ = $this->Anggaran_model->get_btl('2', '*', $where);
					}
					$this->response(array('success' => true, 'message' => 'Success', 'responseCode' => 200, 'data' => $anggaran_), 200);
				}
			} else {
				$this->response(array('success' => false, 'message' => 'Paramter tidak ada', 'responseCode' => 400), 400);
			}
		}
		
		public function count_get()
		{
			$tahapan 	= $this->tahapan;
			$tahun 		= $this->uri->segment(4);
			$tipe 		= $this->uri->segment(5);
			$pelaksana 	= ($this->uri->segment(6))?$this->uri->segment(6):'skpd';
			$kecamatan 	= ($this->uri->segment(7))?$this->uri->segment(7):'kecamatan';
			$deskel 	= ($this->uri->segment(8))?$this->uri->segment(8):'deskel';
			
			if ($tahun){
				$key = $this->Key_model->get('admin_user', array('key_value'=>getHeader()));
				$admin = $this->Admin_model->get('admin.admin_user, admin.skpd_kode', array('admin_user'=>$key->admin_user));
				$skpd = $admin->skpd_kode;
				
				if ($pelaksana == 'skpd' && $kecamatan == 'kecamatan' && $deskel == 'deskel'){
					$where = 'anggaran.skpd_kode = \''.$skpd.'\' AND anggaran.tipe_kode = \''.$tipe.'\' AND anggaran.tahun = \''.$tahun.'\' AND anggaran.tahapan_kode = \''.$tahapan.'\'';
				} else if ($kecamatan == 'kecamatan' && $deskel == 'deskel'){
					$where = 'anggaran.skpd_kode = \''.$skpd.'\' AND anggaran.tipe_kode = \''.$tipe.'\' AND anggaran.tahun = \''.$tahun.'\' AND anggaran.tahapan_kode = \''.$tahapan.'\' AND anggaran.pelaksana_kode = \''.$pelaksana.'\'';
				} else if ($pelaksana == 'skpd' && $deskel == 'deskel'){
					$where = 'anggaran.skpd_kode = \''.$skpd.'\' AND anggaran.tipe_kode = \''.$tipe.'\' AND anggaran.tahun = \''.$tahun.'\' AND anggaran.tahapan_kode = \''.$tahapan.'\' AND anggaran.kecamatan_kode = \''.$kecamatan.'\'';
				} else if ($pelaksana == 'skpd'){
					$where = 'anggaran.skpd_kode = \''.$skpd.'\' AND anggaran.tipe_kode = \''.$tipe.'\' AND anggaran.tahun = \''.$tahun.'\' AND anggaran.tahapan_kode = \''.$tahapan.'\' AND anggaran.kecamatan_kode = \''.$kecamatan.'\' AND anggaran.deskel_kode = \''.$deskel.'\'';
				} else if ($deskel == 'deskel'){
					$where = 'anggaran.skpd_kode = \''.$skpd.'\' AND anggaran.tipe_kode = \''.$tipe.'\' AND anggaran.tahun = \''.$tahun.'\' AND anggaran.tahapan_kode = \''.$tahapan.'\' AND anggaran.pelaksana_kode = \''.$pelaksana.'\' AND anggaran.kecamatan_kode = \''.$kecamatan.'\'';
				} else {
					$where = 'anggaran.skpd_kode = \''.$skpd.'\' AND anggaran.tipe_kode = \''.$tipe.'\' AND anggaran.tahun = \''.$tahun.'\' AND anggaran.tahapan_kode = \''.$tahapan.'\' AND anggaran.pelaksana_kode = \''.$pelaksana.'\' AND anggaran.kecamatan_kode = \''.$kecamatan.'\' AND anggaran.deskel_kode = \''.$deskel.'\'';
				}
		
				$anggaran 		=  $this->Anggaran_model->count_all($where);
				
				if(empty($anggaran)){
					$this->response(array('success' => false, 'message' => 'Tidak ada data hasil musrenbang', 'responseCode' => 406), 406);
				} else {
					$this->response(array('success' => true, 'message' => 'Success', 'responseCode' => 200, 'data' => $anggaran), 200);
				}
			} else {
				$this->response(array('success' => false, 'message' => 'Paramter tidak ada', 'responseCode' => 400), 400);
			}
		}
		
		public function save_post()
		{
			$key = $this->Key_model->get('admin_user', array('key_value'=>getHeader()));
			$admin = $this->Admin_model->get('admin.admin_user, admin.skpd_kode', array('admin_user'=>$key->admin_user));
			$skpd = $admin->skpd_kode;
			
			$waktuEntri	= $this->Tahapan_model->get('selesai', array('kode' => $this->tahapan));
			$tahapanSKPD = $this->Tahapan_skpd_model->count_all(array('skpd_kode' => $admin->skpd_kode, 'tahapan_kode' => $this->tahapan));
			$waktuSekarang = date("Y-m-d H:i:s");
			if ($waktuEntri->selesai < $waktuSekarang && $tahapanSKPD == 0 && $admin->admin_level_kode != 1){
				$this->response(array('success' => false, 'message' => 'Waktu entri', 'responseCode' => 406), 406);
			} else {
				if ($this->input->post('nomor') && $this->input->post('skpd_kode')){
					if ($this->input->post('file')){
						$timestamp = explode(" ",microtime());
						$currenttimemilis = round(($timestamp[0]*1000000) + ($timestamp[1]*1000));
						
						$new_file		= $this->input->post('nomor'). '' . $currenttimemilis . '' . str_shuffle($currenttimemilis) . '.' . end(explode(".", basename($this->input->post('file'))));
						file_put_content('./public/uploads/documents/musrenbang_desa/'.$new_file, $this->input->post('file_'));
						$insert['file'] = $new_file;
					} else {
						$insert['file'] = $this->input->post('file');
					}
					if ($this->input->post('foto')){
						$foto = $this->input->post('foto');
						$foto_ = $this->input->post('foto_');
						$filename = array();
						$i = 0;
						$ds_foto = explode(';', $foto);
						foreach($foto_ as $row_foto){
							$timestamp = explode(" ",microtime());
							$currenttimemilis = round(($timestamp[0]*1000000) + ($timestamp[1]*1000));
						
							$new_file		= $this->input->post('nomor'). '' . $currenttimemilis . '' . str_shuffle($currenttimemilis) . '.' . end(explode(".", basename($ds_foto[$i])));
							$filename[] 	= $new_file;
							file_put_content('./public/uploads/pictures/musrenbang_desa/'.$new_file, $row_foto);
							$i++;
						} 
						$insert['foto']					= implode(';', $filename);
					} else {
						$insert['foto']					= $this->input->post('foto');
					}
					
					$insert['nomor']				= $this->input->post('nomor');
					$insert['skpd_kode']			= $this->input->post('skpd_kode');
					$insert['pelaksana_kode']		= $this->input->post('pelaksana_kode');
					$insert['tahun']				= $this->input->post('tahun');
					$insert['kegiatan']				= $this->input->post('kegiatan');
					$insert['lokasi_kode']			= $this->input->post('lokasi_kode');
					$insert['kecamatan_kode']		= $this->input->post('kecamatan_kode');
					$insert['deskel_kode']			= $this->input->post('deskel_kode');
					$insert['rw']					= $this->input->post('rw');
					$insert['rt']					= $this->input->post('rt');
					$insert['alamat']				= $this->input->post('alamat');
					$insert['koordinat']			= $this->input->post('koordinat');
					$insert['catatan']				= $this->input->post('catatan');
					$insert['status']				= $this->input->post('status');
					$insert['proses_kode']			= $this->input->post('proses_kode');
					$insert['sumber_kode']			= $this->input->post('sumber_kode');
					$insert['sumber_id']			= $this->input->post('sumber_id');
					$insert['sumber_nomor']			= $this->input->post('sumber_nomor');
					$insert['tahapan_kode']			= $this->input->post('tahapan_kode');
					$insert['tanggal']				= $this->input->post('tanggal');
					$insert['penambahan_kode']		= $this->input->post('penambahan_kode');
					$insert['perubahan_id']			= $this->input->post('perubahan_id');
					$insert['perubahan_status_kode']= $this->input->post('perubahan_status_kode');
					$insert['admin_user']			= $this->input->post('admin_user');
					$insert['tipe_kode']			= $this->input->post('tipe_kode');
					$insert['proposal']				= $this->input->post('proposal');
					$insert['verifikasi']			= $this->input->post('verifikasi');
					$insert_anggaran = $this->Anggaran_model->insert('anggaran', $insert);
					 
					$anggaran = $this->Anggaran_model->getOnly('kode', array('nomor'=>$this->input->post('nomor'), 'tipe_kode'=>$this->input->post('tipe_kode')));
					if ($this->input->post('tipe_kode') == 1){
						$insert_bl['anggaran_kode']		= $anggaran->kode;
						$insert_bl['visi_kode']			= $this->input->post('visi_kode');
						$insert_bl['misi_kode']			= $this->input->post('misi_kode');
						$insert_bl['prioritas_kode']	= $this->input->post('prioritas_kode');
						$insert_bl['tujuan_kode']		= $this->input->post('tujuan_kode');
						$insert_bl['sasaran_kode']		= $this->input->post('sasaran_kode');
						$insert_bl['indikator_kode']	= $this->input->post('indikator_kode');
						$insert_bl['urusan_kode']		= $this->input->post('urusan_kode');
						$insert_bl['program_kode']		= $this->input->post('program_kode');
						$insert_bl['sifat_kode']		= $this->input->post('sifat_kode');
						$insert_bl['kesepakatan_kode']	= $this->input->post('kesepakatan_kode');
						$insert_bl['urutan']			= $this->input->post('urutan');
						$insert_bl['hp_ukur']			= $this->input->post('hp_ukur');
						$insert_bl['hp_target']			= $this->input->post('hp_target');
						$insert_bl['hp_satuan']			= $this->input->post('hp_satuan');
						$insert_bl['kh_ukur']			= $this->input->post('kh_ukur');
						$insert_bl['kh_target']			= $this->input->post('kh_target');
						$insert_bl['kh_satuan']			= $this->input->post('kh_satuan');
						$insert_bl['hk_ukur']			= $this->input->post('hk_ukur');
						$insert_bl['hk_target']			= $this->input->post('hk_target');
						$insert_bl['hk_satuan']			= $this->input->post('hk_satuan');
						$insert_bl['apbd_kab']			= $this->input->post('apbd_kab');
						$insert_bl['apbd_prov']			= $this->input->post('apbd_prov');
						$insert_bl['apbn']				= $this->input->post('apbn');
						$insert_bl['sumberlain']		= $this->input->post('sumberlain');
						$insert_bl['perkiraan_maju']	= $this->input->post('perkiraan_maju');
						$insert_anggaran_bl = $this->Anggaran_model->insert('anggaran_bl', $insert_bl);
					} else {
						$insert_btl['anggaran_kode']	= $anggaran->kode;
						$insert_btl['volume']			= $this->input->post('volume');
						$insert_btl['biaya']			= $this->input->post('biaya');
						$insert_btl['penerima']			= $this->input->post('penerima');
						$insert_anggaran_btl = $this->Anggaran_model->insert('anggaran_btl', $insert_btl);
					}
					
					if ($insert_anggaran && ($insert_anggaran_bl || $insert_anggaran_btl)){
						$this->response(array('success' => true, 'message' => 'Sukses', 'responseCode' => 200, 'data' => $insert), 200);
					} else {
						$this->response(array('success' => false, 'message' => 'Gagal', 'responseCode' => 406), 406);
					}
				} else {
					$this->response(array('success' => false, 'message' => 'Paramter tidak ada', 'responseCode' => 400), 400);
				}
			}	
		}	
		
		public function delete_post()
		{
			$tahun		= $this->input->post('tahun');	
			$tipe		= $this->input->post('tipe');	
			$nomor		= $this->input->post('nomor');	
			if ($tahun && $tipe){
				$key = $this->Key_model->get('admin_user', array('key_value'=>getHeader()));
				$admin = $this->Admin_model->get('admin.admin_user, admin.skpd_kode', array('admin_user'=>$key->admin_user));
				$skpd = $admin->skpd_kode;
				
				$where['tahun']		= $tahun;
				$where['tipe_kode']	= $tipe;
				$where['skpd_kode']	= $skpd;
				if ($nomor){
					$where['nomor']	= $nomor;
				}
				$anggaran = $this->Anggaran_model->grid_all('anggaran.kode, anggaran.foto, anggaran.file', 'anggaran.kode', 'ASC', '', '', $where);
				if ($anggaran){
					foreach($anggaran as $row){
						if ($row->foto){
							$foto = explode(';', $row->foto);
							if ($foto){
								foreach($foto as $row2){
									if ($row2){
										if (file_exists('./public/uploads/pictures/musrenbang_desa/'.$row2)){
											unlink('./public/uploads/pictures/musrenbang_desa/'.$row2);
										}
									}
								}
							}
						}
						if ($row->file){
							if (file_exists('./public/uploads/documents/musrenbang_desa/'.$row->file)){
								unlink('./public/uploads/documents/musrenbang_desa/'.$row->file);
							}
						}
						
						if ($tipe == 1){
							$this->Anggaran_model->delete('anggaran_bl', array('anggaran_kode' => $row->kode)); 
						} else {
							$this->Anggaran_model->delete('anggaran_btl', array('anggaran_kode' => $row->kode));
						}
					}
					$delete_anggaran = $this->Anggaran_model->delete('anggaran', $where);
					$this->response(array('success' => true, 'message' => 'Berhasil', 'responseCode' => 200), 200);
				} else {
					$this->response(array('success' => false, 'message' => 'Tidak ada data musrenbang', 'responseCode' => 406), 406);
				}
			} else {
				$this->response(array('success' => false, 'message' => 'Paramter tidak ada', 'responseCode' => 400), 400);
			}
		}
	}

/* End of file skpd.php */
/* Location: ./application/controllers/skpd.php */