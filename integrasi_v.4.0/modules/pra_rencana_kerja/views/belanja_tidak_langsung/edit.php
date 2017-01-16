<!-- BEGIN CONTENT -->
	<div class="page-content-wrapper">
		<div class="page-content">
			<!-- BEGIN PAGE HEADER-->
			<h3 class="page-title">
			Ubah Pra Rencana Kerja <small>anggaran tidak langsung</small>
			</h3>
			<div class="page-bar">
				<ul class="page-breadcrumb">
					<li>
						<i class="fa fa-home"></i>
						<a href="<?php echo site_url('dashboard');?>">Home</a>
						<i class="fa fa-angle-right"></i>
					</li>
                    <li>
						<a href="<?php echo site_url('pra-rencana-kerja');?>">Pra Rencana Kerja</a>
						<i class="fa fa-angle-right"></i>
					</li>
                     <li>
						<a href="#">Ubah Belanja Tidak Langsung</a>
					</li>
				</ul>
			</div>
            
            <div class="note note-warning">
				<p>
					NOTE: Silahkan isi form pra rencana kerja ini dengan data-data yang valid!. Sesuai dengan arahan dari BAPPEDA Kabupaten Bekasi.
				</p>
			</div>
			<!-- END PAGE HEADER-->
			<?php echo validation_errors(); ?>
			<!-- BEGIN FORM -->
			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN SAMPLE TABLE PORTLET-->
					<div class="portlet box green">
									<div class="portlet-title">
										<div class="caption">
											<i class="fa fa-pencil"></i>Ubah Pra Rencana Kerja
										</div>
									</div>
									<div class="portlet-body form">
										<!-- BEGIN FORM-->
										<form action="<?php echo site_url('pra-rencana-kerja/update/btl/'.$kode);?>" class="horizontal-form" enctype="multipart/form-data" method="post">
											<div class="form-body">
												<h3 class="form-section">Detail Kegiatan</h3>
												<div class="row">
													<div class="col-md-3">
														<div class="form-group">
															<label class="control-label" for="tahun">Tahun Anggaran <span class="required">*</span> :</label>
                                                            <!-- combobox('jenis=db,1d,2d', 'array', 'name', 'value', 'value_name', 'selected', 'js', 'label', 'script') -->
															<?php combobox('db', $tahun, 'tahun', 'tahun', 'tahun', $tahun_, '', 'Pilih Tahun Anggaran', 'class="select2_category form-control" tabindex="1" required="required"'); ?>
														</div>
													</div>
													<!--/span-->
                                                	<div class="col-md-9">
														<div class="form-group">
															<label class="control-label" for="skpd_kode">SKPD Pelaksana <span class="required">*</span> :</label>
                                                            <!-- combobox('jenis=db,1d,2d', 'array', 'name', 'value', 'value_name', 'selected', 'js', 'label', 'script') -->
															<?php combobox('db', $skpd, 'skpd_kode', 'skpd_kode', 'skpd_nama', $skpd_, '', 'Pilih SKPD Pelaksana', 'class="select2_category form-control" tabindex="1" required="required"'); ?>
														</div>
													</div>
													<!--/span-->
                                                </div>    
												<!--/row-->
												
                                                <div class="row">
                                                	<div class="col-md-12">
														<div class="form-group">
															<label class="control-label" for="kegiatan">Nama Kegiatan <span class="required">*</span> :</label>
															<input type="text" class="form-control" name="kegiatan" value="<?php echo $kegiatan;?>" id="kegiatan" required="required">
														</div>
													</div>
													<!--/span-->
                                                </div>
                                                <!--/row-->
                                                
                                                <div class="row">
                                                	<div class="col-md-6">
														<div class="form-group">
															<label class="control-label" for="volume">Volume <span class="required">*</span> :</label>
															<input type="text" class="form-control" name="volume" value="<?php echo $volume;?>" id="volume" placeholder="" required="required">
														</div>
													</div>
													<!--/span-->
                                                    <div class="col-md-3">
														<div class="form-group">
															<label class="control-label" for="biaya">Estimasi Biaya (Rp) <span class="required">*</span> :</label>
															<input type="text" class="form-control" name="biaya" value="<?php echo $biaya;?>" id="biaya" style="text-align:right;" onkeypress="return isNumber(event)" placeholder="0" required="required">
														</div>
													</div>
													<!--/span-->
                                                </div>
                                                <!--/row-->
                                                
                                                <div class="row">
                                               		<div class="col-md-12">
														<div class="form-group">
															<label class="control-label" for="penerima">Calon Penerima <span class="required">*</span> :</label>
															<input type="text" class="form-control" name="penerima" value="<?php echo $penerima; ?>" id="penerima" placeholder="">
														</div>
													</div>
													<!--/span-->
                                                </div>
                                                
                                                <h3 class="form-section">Lokasi Kegiatan</h3>
                                                <input type="hidden" name="lokasi_kode" value="3">
												<div class="row">
                                                	<div class="col-md-5">
                                                    	<div class="form-group">
															<label class="control-label">Kecamatan <span class="required">*</span> :</label>
                                                            <!-- combobox('jenis=db,1d,2d', 'array', 'name', 'value', 'value_name', 'selected', 'js', 'label', 'script') -->
															<?php combobox('db', $kecamatan, 'kecamatan_kode', 'skpd_kd', 'skpd_nama', $kecamatan_, 'show_form_deskel_by_kecamatan();', 'Pilih Kecamatan', 'class="select2_category form-control" tabindex="1" required="required"'); ?>
														</div>
                                                    </div>
                                                    <!--/span-->
                                                    <div class="col-md-5">
                                                    	<div class="form-group" id="tampil_combobox_deskel_by_kecamatan">
															<label class="control-label">Desa/Kelurahan <span class="required">*</span> :</label>
															<?php combobox('db', $deskel, 'deskel_kode', 'skpd_kd', 'skpd_nama', $deskel_, '', 'Pilih Desa/Kelurahan', 'class="select2_category form-control"'); ?>
														</div>
                                                    </div>
                                                    <!--/span-->
                                                    <div class="col-md-1">
                                                    	<div class="form-group">
															<label class="control-label" for="rw">RW :</label>
															<input type="text" class="form-control" name="rw" value="<?php echo $rw;?>" id="rw" placeholder="" maxlength="3">
														</div>
                                                    </div>
                                                    <!--/span-->
                                                    <div class="col-md-1">
                                                    	<div class="form-group">
															<label class="control-label" for="rt">RT :</label>
															<input type="text" class="form-control" name="rt" value="<?php echo $rt;?>" id="rt" placeholder="" maxlength="3">
														</div>
                                                    </div>
                                                    <!--/span-->
                                                </div>
                                                <!--/row-->


                                                
                                                <div class="row">
                                                	<div class="col-md-12">
                                                    	<div class="form-group">
															<label class="control-label" for="alamat">Alamat <span class="required">*</span> :</label>
															<input type="text" class="form-control" name="alamat" value="<?php echo $alamat;?>" id="alamat" placeholder="">
														</div>
                                                    </div>
                                                    <!--/span-->
                                                </div>
                                                <!--/row-->
                                                
                                                <h3 class="form-section">Data Pendukung</h3>
												<style>
												.photo-preview { margin-top:-115px;}
												</style>
												<div class="row">
													<div class="col-md-3">
														<div class="form-group">
															<label class="control-label" for="proposal">Proposal :</label>
															<input type="checkbox" name="proposal" id="proposal" <?php echo $proposal;?> class="make-switch" data-on-text="&nbsp;ADA&nbsp;" data-off-text="&nbsp;TIDAK&nbsp;" data-on-color="primary" data-off-color="default">
														</div>
													</div>
													<div class="col-md-3">
														<div class="form-group">
															<label class="control-label" for="verifikasi">Verifikasi :</label>
															<input type="checkbox" name="verifikasi" id="verifikasi" <?php echo $verifikasi;?> class="make-switch" data-on-text="&nbsp;SUDAH&nbsp;" data-off-text="&nbsp;BELUM&nbsp;" data-on-color="success" data-off-color="default">
														</div>
													</div>
												</div>
                                                <div class="row">
													<div class="col-md-5">
														<label class="control-label">Foto Keadaan Sekarang :</label>
													</div>
												</div>
												<div class="row">
													<?php for($i=0;$i<6;$i++){?>
                                                	<div class="col-md-2 box-image">
														<input type="file" name="photo[<?php echo $i; ?>]" id="photo<?php echo $i; ?>" style="display:none;" />
														<div class="btn-photo" onclick="$('#photo<?php echo $i; ?>').click();" style="border:1px solid #cdcdcd; padding-bottom:30px;cursor:pointer;">
															&nbsp;
															<span class="fa fa-plus" style="display:block;text-align:center;padding:25px;"></span>
														</div>
														<div id="photo-preview<?php echo $i; ?>" class="photo-preview" style="display: none;"><img src="" id="img-preview<?php echo $i; ?>" style="width:100%;height:auto;" /></div>
														<div id="action-preview<?php echo $i; ?>" class="action-preview" style="display: none;">
															<span>
																<i class="fa fa-times" style="position: absolute; right:0px;" id="cancel-upload<?php echo $i; ?>" class="cancel-upload" title="Remove">&nbsp;</i>
															</span>
														</div>
														&nbsp;
													</div>
													<?php } ?>
                                                </div>
                                                <!--/row-->
                                                
                                                <div class="row">
                                                	<div class="col-md-5">
														<div class="form-group"><!-- Memberikan Jarak --></div>
                                                    </div>
                                                </div>
                                                <!--/row-->
                                                
                                                <div class="row">
                                                	<div class="col-md-5">
														<div class="form-group">
                                                        	<label class="control-label">Latitude, Longitude (Titik Koordinat) :</label>
                                                        	<div class="input-group">
                                                                <input type="text" class="form-control" placeholder="-6.238634, 107.140463" readonly="readonly">
                                                                <span class="input-group-btn">
                                                                <a class="btn red" href="#myModal" data-toggle="modal"><span class="fa fa-map-marker"></span> Ambil Lokasi</a>
                                                                </span>
                                                            </div>
														</div>
													</div>
                                                </div>
                                                <!--/row-->
                                                
                                                <div class="row">
                                                	<div class="col-md-12">
                                                    	<div class="form-group">
															<label class="control-label" for="catatan">Catatan :</label>
															<textarea class="form-control" name="catatan" id="catatan"><?php echo $catatan;?></textarea>
														</div>
                                                    </div>
                                                    <!--/span-->
                                                </div>
                                                <!--/row-->
                                                
											</div>
											<div class="form-actions">
												<div class="row">
													<div class="col-md-6">
														<div class="row">
															<div class="col-md-offset-3 col-md-9">
																<button type="submit" class="btn green"><i class="fa fa-check"></i> Simpan Data</button>
																<a href="#" onClick="history.go(-1); return false;" class="btn default"><i class="fa fa-times"></i> Batal</a>
															</div>
														</div>
													</div>
													<div class="col-md-6">
													</div>
												</div>
											</div>
                                            
										</form>
										<!-- END FORM-->
									</div>
								</div>
                                <!-- Peta Google-->
                               	<div id="myModal" class="modal fade" role="dialog" aria-hidden="true">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
											<h4 class="modal-title">Google Maps</h4>
										</div>
										<div class="modal-body">
											<iframe src="http://map.google.com/" width="100%" height="420"></iframe>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
											<button type="button" class="btn btn-primary"><i class="fa fa-check"></i> Simpan Lokasi</button>
										</div>
									</div>
								</div>
							</div>
					<!-- END SAMPLE TABLE PORTLET-->
				</div>
			</div>
     
		</div>
		
	</div>
	<!-- END CONTENT -->
    <script>
	function show_form_deskel_by_kecamatan(){
		var kecamatan_kode = $('select[name=kecamatan_kode]').val();
		load('pra-rencana-kerja/tampil_combobox_deskel_by_kecamatan2/'+kecamatan_kode, '#tampil_combobox_deskel_by_kecamatan');
	}
	
	</script>