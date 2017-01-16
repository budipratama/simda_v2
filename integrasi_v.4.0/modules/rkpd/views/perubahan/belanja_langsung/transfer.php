<!-- Main Content -->   
   <section class="content">
		<h2>RKPD Perubahan<small> anggaran belanja langsung</small></h2>  
			<div class="body">
				<ol class="breadcrumb breadcrumb-col-cyan">
					<li><a href="<?php echo site_url('dashboard');?>"><i class="material-icons">home</i> Home</a></li>
					<li><a href="<?php echo site_url('rkpd/murni');?>"> RKPD</a></li>
					<li class="active"> Transfer Perubahan</li>
				</ol>
			</div>	
            <!-- Multiple Items To Be Open -->
			<?php if ($this->session->flashdata('success')) { echo $this->session->flashdata('success');} ?>
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
						<div class="header"><h2>Detail Kegiatan</h2></div>
                        <div class="body">
                            <div class="row clearfix">
							<div class="body">
							<form action="<?php echo site_url('rkpd/perubahan/doTransfer/bl/'.$kode);?>" id="form_validation" enctype="multipart/form-data" method="post">
								<div class="row clearfix">
									<div class="col-md-3">
										<p><b>Tahun <span class="required">*</span></b></p>
										<div class="form-group form-float">
											<div class="form-line">
											<input type="hidden" class="form-control" name="tahun" id="tahun" value="<?php echo $tahun_ ?>">
												<?php combobox('db', $tahun, 'tahun', 'tahun', 'tahun', $tahun_, '', 'Pilih Tahun Anggaran', 'class="form-control show-tick" data-live-search="true" tabindex="1" disabled'); ?>
											</div>								
										</div>								
									</div>								
									<div class="col-md-9">
										<p><b>SKPD Pelaksana <span class="required">*</span></b></p>
										<div class="form-group form-float">
											<div class="form-line">
											<input type="hidden" class="form-control" name="skpd_kode" id="skpd_kode" value="<?php echo $skpd_?>">
												<?php combobox('db', $skpd, 'skpd_kode', 'skpd_kode', 'skpd_nama', $skpd_, 'show_form_misi_by_skpd();', 'Pilih SKPD Pelaksana', 'class="select2_category form-control" tabindex="1" disabled'); ?>
											</div>
										</div>
									</div>
								</div>
								<div class="row clearfix">
									<div class="col-md-12">
										<p><b>Visi Kabupaten Bekasi :</b></p>
										<div class="form-group form-float">
											<div class="form-line">										
												<?php echo $visi->visi;?>
											</div>								
										</div>								
									</div>
								</div>
								<div class="row clearfix">
									<div class="col-md-12">
										<div class="form-group form-float">
											<div class="form-line" id="tampil_combobox_misi_by_skpd">
												<label class="control-label" for="misi_kode">Misi Kabupaten Bekasi <span class="required">*</span> :</label>
												<input type="hidden" name="misi_kode" id="misi" value="<?php echo $misi_;?>">
													<?php combobox('db', $misi, 'misi_kode', 'misi_kode', 'misi_nama', $misi_, 'show_form_tujuan_by_misi();', 'Pilih Misi', 'class="select2_category form-control" tabindex="1" disabled'); ?>
											</div>								
										</div>								
									</div>
								</div>
								<div class="row clearfix">
									<div class="col-md-6">
										<div class="form-group form-float">
											<div class="form-line">
												<label class="control-label" for="prioritas_kode">Prioritas Daerah <span class="required">*</span> :</label>
												<input type="hidden" name="prioritas_kode" id="prioritas" value="<?php echo $prioritas_;?>">
                                                	<?php combobox('db', $prioritas, 'prioritas_kode', 'kode', 'prioritas', $prioritas_, '', 'Pilih Prioritas', 'class="select2_category form-control" tabindex="1" disabled'); ?>
											</div>								
										</div>								
									</div>
									<div class="col-md-6">
										<div class="form-group form-float">
											<div class="form-line" id="tampil_combobox_tujuan_by_misi">
												<label class="control-label" for="tujuan_kode">Tujuan Daerah <span class="required">*</span> :</label>
												<input type="hidden" name="tujuan_kode" id="tujuan" value="<?php echo $tujuan_;?>" readonly="readonly">
                                                	<?php combobox('db', $tujuan, 'tujuan_kode', 'tujuan_kode', 'tujuan_nama', $tujuan_, 'show_form_sasaran_by_tujuan();', 'Pilih Tujuan', 'class="select2_category form-control" tabindex="1" disabled'); ?>
											</div>								
										</div>								
									</div>
								</div>
								<div class="row clearfix">
									<div class="col-md-6">
										<div class="form-group form-float">
											<div class="form-line" id="tampil_combobox_sasaran_by_tujuan">
												<label class="control-label" for="sasaran_kode">Sasaran Daerah <span class="required">*</span> :</label>
												<input type="hidden" name="sasaran_kode" id="sasaran" value="<?php echo $sasaran_;?>">
                                                	<?php combobox('db', $sasaran, 'sasaran_kode', 'sasaran_kode', 'sasaran_nama', $sasaran_, 'show_form_indikator_by_sasaran();', 'Pilih Sasaran', 'class="select2_category form-control" tabindex="1" disabled'); ?>
                                            </div>								
										</div>								
									</div>
									<div class="col-md-6">
										<div class="form-group form-float">
											<div class="form-line" id="tampil_combobox_indikator_by_sasaran">
												<label class="control-label" for="indikator_kode">Indikator Sasaran <span class="required">*</span> :</label>
												<input type="hidden" name="indikator_kode" id="indikator" value="<?php echo $indikator_;?>">
                                                	<?php combobox('db', $indikator, 'indikator_kode', 'indikator_kode', 'indikator_nama', $indikator_, 'show_form_urusan_by_indikator();', 'Pilih Indikator', 'class="select2_category form-control" tabindex="1" disabled'); ?>
											</div>								
										</div>								
									</div>
								</div>
								<div class="row clearfix">
									<div class="col-md-6">
										<div class="form-group form-float">
											<div class="form-line" id="tampil_combobox_urusan_by_indikator">
												<label class="control-label" for="urusan_kode">Urusan <span class="required">*</span> :</label>
												<input type="hidden" name="urusan_kode" id="urusan" value="<?php echo $urusan_;?>">
                                                	<?php combobox('db', $urusan, 'urusan_kode', 'urusan_kode', 'urusan_nama', $urusan_, 'show_form_program_by_urusan();', 'Pilih Urusan', 'class="select2_category form-control" tabindex="1" disabled'); ?>
											</div>								
										</div>								
									</div>
									<div class="col-md-6">
										<div class="form-group form-float">
											<div class="form-line" id="tampil_combobox_program_by_urusan">
												<label class="control-label" for="program_kode">Program <span class="required">*</span> :</label>
												<input type="hidden" name="program_kode" id="program" value="<?php echo $program_;?>">
                                                	<?php combobox('db', $program, 'program_kode', 'program_kode', 'program_nama', $program_, 'show_form_kegiatan_by_program();', 'Pilih Program', 'class="select2_category form-control" tabindex="1" disabled'); ?>
											</div>								
										</div>								
									</div>
								</div>
								<div class="form-group form-float">
									<label class="form-label">Nama Kegiatan <span class="required">*</span> :</label>
                                    <div class="form-line" id="tampil_combobox_kegiatan_by_program">
                                       <input type="text" name="kegiatan" id="kegiatan" value="<?php echo $kegiatan; ?>" class="form-control" readonly="readonly">
									</div>
                                </div>
								<div class="row clearfix">
									<div class="col-md-5">
										<label class="control-label">Jenis Kegiatan :</label>
										<div class="form-group">
										<input type="hidden" name="sifat_kode" id="sifat_kode" value="<?php echo $sifat_;?>" class="form-control">
										<?php combobox('db', $sifat, 'sifat_kode', 'sifat_kode', 'sifat_nama', $sifat_, '', 'Pilih Jenis Kegiatan', 'class="form-control show-tick" data-live-search="true" tabindex="1" disabled'); ?>
										</div>
									</div>
									<div class="col-md-5">
										<label class="control-label">Kesepakatan :</label> 
										<div class="form-group">
										<input type="hidden" name="kesepakatan_kode" id="kesepakatan_kode" value="<?php echo $kesepakatan_;?>" class="form-control">
										<?php combobox('db', $kesepakatan, 'kesepakatan_kode', 'kode', 'nama', $kesepakatan_, '', 'Pilih Kesepakatan', 'class="form-control show-tick" data-live-search="true" tabindex="1" disabled'); ?>
										</div>		
									</div>
									<div class="col-md-2">
										<div class="form-group form-float">
											<label class="form-label">Urutan Kegiatan</label>
										<div class="form-line">
											<input type="text" name="urutan" id="urutan" value="<?php echo $urutan;?>" class="form-control" readonly="readonly"> 
										</div>
										</div>	
									</div>
								</div>
							<h3 class="form-section"><b>Indikator Hasil Program</b></h3>
								<div class="row clearfix">
									<div class="col-md-12">
										<div class="form-group form-float">
											<label class="form-label">Tolak Ukur</label>
										<div class="form-line" id="tampil_combobox_hasil_by_program">
											<input type="text" name="hp_ukur" id="hp_ukur" value="<?php echo $hp_ukur;?>" class="form-control" readonly="readonly">
										</div>
										</div>	
									</div>
								</div>
								<div class="row clearfix">
									<div class="col-md-6">
										<div class="form-group form-float">
											<label class="form-label">Target</label>
										<div class="form-line">
											<input type="text" name="hp_target" id="hp_target" value="<?php echo $hp_target;?>" class="form-control" readonly="readonly">
										</div>
										</div>	
									</div>
									<div class="col-md-6">
										<div class="form-group form-float">
											<label class="form-label">Satuan</label>
										<div class="form-line">
											<input type="text" name="hp_satuan" id="hp_satuan" value="<?php echo $hp_satuan;?>" class="form-control" readonly="readonly">
										</div>
										</div>	
									</div>
								</div>
							<h3 class="form-section"><b>Indikator Keluaran Kegiatan</b></h3>
								<div class="row clearfix">
									<div class="col-md-12">
										<div class="form-group form-float">
											<label class="form-label">Tolak Ukur</label>
										<div class="form-line" id="tampil_combobox_hasil_by_program">
											<input type="text" name="kh_ukur" id="kh_ukur" value="<?php echo $kh_ukur;?>" class="form-control" readonly="readonly">
										</div>
										</div>	
									</div>
								</div>
								<div class="row clearfix">
									<div class="col-md-6">
										<div class="form-group form-float">
											<label class="form-label">Target</label>
										<div class="form-line">
											<input type="text" name="kh_target" id="kh_target" value="<?php echo $kh_target;?>" class="form-control" readonly="readonly">
										</div>
										</div>	
									</div>
									<div class="col-md-6">
										<div class="form-group form-float">
											<label class="form-label">Satuan</label>
										<div class="form-line">
											<input type="text" name="kh_satuan" id="kh_satuan" value="<?php echo $kh_satuan;?>" class="form-control" readonly="readonly">
										</div>
										</div>	
									</div>
								</div>
							<h3 class="form-section"><b>Indikator Hasil Kegiatan</b></h3>
								<div class="row clearfix">
									<div class="col-md-12">
										<div class="form-group form-float">
											<label class="form-label">Tolak Ukur</label>
										<div class="form-line" id="tampil_combobox_hasil_by_program">
											<input type="text" name="hk_ukur" id="hk_ukur" value="<?php echo $hk_ukur;?>" class="form-control" readonly="readonly">
										</div>
										</div>	
									</div>
								</div>
								<div class="row clearfix">
									<div class="col-md-6">
										<div class="form-group form-float">
											<label class="form-label">Target</label>
										<div class="form-line">
											<input type="text" name="hk_target" id="hk_target" value="<?php echo $hk_target;?>" class="form-control" readonly="readonly">
										</div>
										</div>	
									</div>
									<div class="col-md-6">
										<div class="form-group form-float">
											<label class="form-label">Satuan</label>
										<div class="form-line">
											<input type="text" name="hk_satuan" id="hk_satuan" value="<?php echo $hk_satuan;?>" class="form-control" readonly="readonly">
										</div>
										</div>	
									</div>
								</div>
							<h3 class="form-section"><b>Asumsi Biaya Pendanaan</b></h3>
								<div class="row clearfix">
									<div class="col-md-4">
										<div class="form-group form-float">
										<label class="form-label" for="apbd_kab">APBD Kabupaten </label>
										<div class="form-line">
											<input type="text" class="form-control" name="apbd_kab" id="apbd_kab" value="<?php echo $apbd_kab;?>" style="text-align:right;" onkeypress="return isNumber(event)" onkeyup="totalAsumsi()" placeholder="0" readonly="readonly">
										</div>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group form-float">
										<label class="form-label" for="apbd_prov">APBD Provinsi </label>
										<div class="form-line">
											<input type="text" class="form-control" name="apbd_prov" id="apbd_prov" value="<?php echo $apbd_prov;?>" style="text-align:right;" onkeypress="return isNumber(event)" onkeyup="totalAsumsi()" placeholder="0" readonly="readonly">
										</div>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group form-float">
										<label class="form-label" for="apbn">APBN/PHLN </label>
										<div class="form-line">
											<input type="text" class="form-control" name="apbn" id="apbn" value="<?php echo $apbn;?>" style="text-align:right;" onkeypress="return isNumber(event)" onkeyup="totalAsumsi()" placeholder="0" readonly="readonly">
										</div>
										</div>
									</div>									
								</div>									
								<div class="row clearfix">
									<div class="col-md-4">
										<div class="form-group form-float">
										<label class="form-label" for="sumberlain">Sumber Lainnya </label>
										<div class="form-line">
											<input type="text" class="form-control" name="sumberlain" id="sumberlain" value="<?php echo $sumberlain;?>" style="text-align:right;" onkeypress="return isNumber(event)" onkeyup="totalAsumsi()" placeholder="0" readonly="readonly">
										</div>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group form-float">
										<label class="form-label" for="total_asumsi">Total Pendanaan </label>
										<div class="form-line">
											<input type="text" class="form-control" name="total_asumsi" id="total_asumsi" value="<?php echo rupiah2($total_asumsi);?>" style="text-align:right;font-weight:bold;" placeholder="0" disabled>
										</div>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group form-float">
										<label class="form-label" for="perkiraan_maju">Perkiraan Maju </label>
										<div class="form-line">
											<input type="text" class="form-control" name="perkiraan_maju" id="perkiraan_maju" value="<?php echo $perkiraan_maju;?>" style="text-align:right;" onkeypress="return isNumber(event)" onkeyup="totalAsumsi()" placeholder="0" readonly="readonly">
										</div>
										</div>
									</div>									
								</div>								
								<h3 class="form-section"><b>Lokasi Kegiatan</b></h3>
								<input type="hidden" name="lokasi_kode" value="3">
								<div class="row clearfix">
									<div class="col-md-5">
										<label class="control-label" for="kecamatan">Kecamatan <span class="required">*</span> :</label>
										<div class="form-group form-float">
											<div class="form-line">
											<input type="hidden" name="kecamatan_kode" value="<?php echo $kecamatan_;?>" class="form-control">
											<?php combobox('db', $kecamatan, 'kecamatan_kode', 'skpd_kd', 'skpd_nama', $kecamatan_, 'show_form_deskel_by_kecamatan();', 'Pilih Kecamatan', 'class="form-control show-tick" data-live-search="true" tabindex="1" disabled'); ?>
											</div>								
										</div>								
									</div>
									<div class="col-md-5">
										<div class="form-group form-float">
											<div class="form-line" id="tampil_combobox_deskel_by_kecamatan">
												<label class="control-label" for="deksel">Desa/Kelurahan <span class="required">*</span> :</label>
												<input type="hidden" name="deskel_kode" value="<?php echo $deskel_;?>" class="form-control">
												<?php 
												if ($deskel_ != ''){
												combobox('db', $deskel, 'deskel_kode', 'skpd_kd', 'skpd_nama', $deskel_, '', 'Pilih Desa/Kelurahan', 'class="select2_category form-control" tabindex="1" disabled'); 
												} else {
												?>
												<select name="deskel_kode" id="deskel_kode" class="form-control show-tick" data-live-search="true" tabindex="1" required="required"></select>
												<?php } ?>												
											</div>								
										</div>								
									</div>
									<div class="col-md-1">
										<div class="form-group form-float">
											<label class="form-label">RT</label>
										<div class="form-line">
											<input type="text" class="form-control" name="rt" id="rt" value="<?php echo $rt; ?>" required maxlength="3" readonly="readonly">
										</div>
										</div>	
									</div>
									<div class="col-md-1">
										<div class="form-group form-float">
											<label class="form-label">RW</label>
										<div class="form-line">
											<input type="text" class="form-control" name="rw" id="rw" value="<?php echo $rw; ?>" required maxlength="3" readonly="readonly">
										</div>
										</div>	
									</div>
								</div>
								<div class="row clearfix">
									<div class="col-md-12">
										<div class="form-group form-float">
											<label class="form-label">Alamat</label>
										<div class="form-line">
											<input type="text" name="alamat" value="<?php echo $alamat;?>" class="form-control" readonly="readonly">
										</div>
										</div>	
									</div>
								</div>
							<h3 class="form-section"><b>Data Pendukung</b></h3>
							<div class="row">
								<div class="col-md-5">
									<label class="control-label">Foto Keadaan Sekarang <span class="required">*</span> :</label>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<?php foreach($foto_ as $row){
											echo "<div class=\"col-md-2\"><img src=\"".base_url('/public/uploads/pictures/pra_rencana_kerja/'.$row)."\" style=\"width:100%\" /></div>";
										} ?>
										<input type="hidden" class="form-control" name="foto" id="foto" value="<?php echo $foto; ?>" required="required" readonly="readonly">
									</div>
								</div>
							</div>										
							<div class="row">
								<div class="col-md-5">
									<div class="form-group">
										<label class="control-label" for="koordinat">Latitude, Longitude (Titik Koordinat) :</label>
										<input type="text" class="form-control" name="koordinat" id="koordinat" value="<?php echo $koordinat; ?>">
										<a class="btn btn-danger" href="#mapmodals" data-toggle="modal"><span class="fa fa-map-marker"></span> Ambil Lokasi</a>
									</div>
								</div>
							</div>												
                                <div class="form-group form-float">
                                        <label class="form-label">Catatan</label>
                                    <div class="form-line">
                                        <textarea name="catatan" id= "catatan" cols="30" rows="1" class="form-control no-resize" readonly="readonly"><?php echo $catatan; ?></textarea>
                                    </div>
                                </div>
                                <button class="btn btn-primary waves-effect" type="submit">Transfer Perubahan</button>
								<a href="#" onClick="history.go(-1); return false;" class="btn btn-default">Batal</a>
                            </form>
							</div>
							</div>
						</div>
					</div>
				</div>
			</div>
					<!-- Peta Google-->
					<div id="mapmodals" class="modal fade" role="dialog" aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
									<h4 class="modal-title">Google Maps</h4>
								</div>
								<div class="modal-body">
									 <div id="map-container" style="width:100%;height:420px"></div>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
								</div>
							</div>
						</div>
					</div>
					<!-- END SAMPLE TABLE PORTLET-->
	</section>
<!-- #END# Multiple Items To Be Open -->	
  <!-- END CONTENT -->