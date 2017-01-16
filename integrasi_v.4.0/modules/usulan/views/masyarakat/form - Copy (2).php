<!-- Main Content -->
            <div class="container-fluid">
                <div class="side-body padding-top">
				<h3 class="page-title">Pengisian <small>Usulan Masyarakat</small></h3>
				
					<div class="row">
                        <div class="col-xs-12">
							<div class="bs-example">
								<ol class="breadcrumb">
									<li class="active"><i class="fa fa-home"></i> <a href="<?php echo site_url();?>"> Home</a></li>
									<li class="active"><a href="<?php echo site_url('usulan/masyarakat/form');?>"> From Usulan Masyarakat</a></li>
									<li class="active"><a href="#"> Pengisian</a></li>
								</ol>
							</div><br>
							<div class="alert alert-info" role="alert">
								NOTE: Silahkan isi Form Usulan Masyarakat ini dengan data-data yang valid!
							</div>
                        </div>
                    </div>		

					<div class="row">
                        <div class="col-xs-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title">
                                        <div class="title">Biodata Pengirim</div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <form action="<?php echo site_url('usulan/masyarakat/pengisian');?>" enctype="multipart/form-data" method="post">
                                    <div class="row">
										<div class="col-md-3">
											<div class="form-group">
												<label class="control-label" for="nama">Nama <span class="required">*</span> :</label>
												<input type="text" class="form-control" name="nama" id="nama" required="required">
											</div>
										</div>
									</div> 
                                    
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label" for="instansi">Instansi :</label>
												<input type="text" class="form-control" name="instansi" id="instansi">
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label" for="jabatan">Jabatan :</label>
												<input type="text" class="form-control" name="jabatan" id="jabatan">
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-8">
											<div class="form-group">
												<label class="control-label" for="alamat_pengusul">Alamat <span class="required">*</span> :</label>
												<input type="text" class="form-control" name="alamat_pengusul" id="alamat_pengusul" required="required">
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-3">
											<div class="form-group">
												<label class="control-label" for="telepon">Telepon <span class="required">*</span> :</label>
												<input type="text" class="form-control" name="telepon" id="telepon" required="required">
											</div>
										</div>
									</div>
									
									<hr><h3 class="form-section">Detail Kegiatan</h3>
									<div class="row">
										<div class="col-md-3">
											<div class="form-group">
												<label class="control-label" for="tahun">Tahun Anggaran <span class="required">*</span> :</label>
												<!-- combobox('jenis=db,1d,2d', 'array', 'name', 'value', 'value_name', 'selected', 'js', 'label', 'script') -->
												<?php combobox('db', $tahun, 'tahun', 'tahun', 'tahun', '', '', 'Pilih Tahun Anggaran', 'class="select2_category form-control" tabindex="1" required="required"'); ?>
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
												<input type="text" class="form-control" name="kegiatan" id="kegiatan" required="required">
											</div>
										</div>
										<!--/span-->
									</div>
									<!--/row-->
									
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label" for="volume">Volume <span class="required">*</span> :</label>
												<input type="text" class="form-control" name="volume" id="volume" placeholder="" required="required">
											</div>
										</div>
										<!--/span-->
										<div class="col-md-3">
											<div class="form-group">
												<label class="control-label" for="biaya">Estimasi Biaya (Rp) <span class="required">*</span> :</label>
												<input type="text" class="form-control" name="biaya" id="biaya" style="text-align:right;" onkeypress="return isNumber(event)" placeholder="0" required="required">
											</div>
										</div>
										<!--/span-->
									</div>
									<!--/row-->
									
									<hr><h3 class="form-section">Lokasi Kegiatan</h3>
									<input type="hidden" name="lokasi_kode" value="3">
									<div class="row">
										<div class="col-md-5">
											<div class="form-group">
												<label class="control-label">Kecamatan <span class="required">*</span> :</label>
												<?php combobox('db', $kecamatan, 'kecamatan_kode', 'skpd_kd', 'skpd_nama', '', 'show_form_deskel_by_kecamatan();', 'Pilih Kecamatan', 'class="select2_category form-control" tabindex="1" required="required"'); ?>
											</div>
										</div>
										<!--/span-->
										<div class="col-md-5">
											<div class="form-group" id="tampil_combobox_deskel_by_kecamatan">
												<label class="control-label">Desa <span class="required">*</span> :</label>
												<select class="select2_category form-control" data-placeholder="Pilih Desa" tabindex="1" required="required"></select>
											</div>
										</div>
										<!--/span-->
										<div class="col-md-1">
											<div class="form-group">
												<label class="control-label" for="rw">RW :</label>
												<input type="text" class="form-control" name="rw" id="rw" placeholder="">
											</div>
										</div>
										<!--/span-->
										<div class="col-md-1">
											<div class="form-group">
												<label class="control-label" for="rt">RT :</label>
												<input type="text" class="form-control" name="rt" id="rt" placeholder="">
											</div>
										</div>
										<!--/span-->
									</div>
									<!--/row-->

									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label class="control-label" for="alamat">Alamat <span class="required">*</span> :</label>
												<input type="text" class="form-control" name="alamat" id="alamat" placeholder="">
											</div>
										</div>
										<!--/span-->
									</div>
									<!--/row-->
									
									<hr><h3 class="form-section">Data Pendukung</h3>
												<div class="row">
													<div class="col-md-5">
														<label class="control-label">Foto Keadaan Sekarang :</label>
													</div>
												</div>
												<div class="row">
													<?php for($i=0;$i<6;$i++){?>
                                                	<div class="col-md-2 box-image">
														<input type="hidden" name="delete_foto[<?php echo $i; ?>]" id="delete_foto<?php echo $i; ?>" value="" />
														<input type="hidden" name="foto[<?php echo $i; ?>]" id="foto<?php echo $i; ?>" value="" />
														<input type="file" name="photo[<?php echo $i; ?>]" id="photo<?php echo $i; ?>" style="display:none;" accept="image/x-png, image/gif, image/jpeg" />
														<div class="btn-photo" onclick="$('#photo<?php echo $i; ?>').click();" style="border:1px solid #cdcdcd; padding-bottom:30px;cursor:pointer;">
															&nbsp;
															<span class="fa fa-plus" style="display:block;text-align:center;padding:25px;"></span>
														</div>
														<div id="photo-preview<?php echo $i; ?>" class="photo-preview" style="display: none;"><img src="" id="img-preview<?php echo $i; ?>" style="width:100%;height:auto;" /></div>
														<div id="action-preview<?php echo $i; ?>" class="action-preview" style="display: none;">
															<div class="action-block">
																<i class="fa fa-times" style="position: absolute;" id="cancel-upload<?php echo $i; ?>" class="cancel-upload" title="Remove" style="cursor:pointer;">&nbsp;</i>
															</div>
														</div>
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
													<input type="text" class="form-control" name="koordinat" id="koordinat" placeholder="-6.364551, 107.172446" readonly="readonly">
													<a class="btn btn-danger" href="#mapmodals" data-toggle="modal"><span class="fa fa-map-marker"></span> Ambil Lokasi</a>
												</div>
											</div>
										</div>
									</div>
									<!--/row-->
									
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label class="control-label" for="catatan">Catatan :</label>
												<textarea class="form-control" name="catatan" id="catatan"></textarea>
											</div>
										</div>
										<!--/span-->
									</div>
									<!--/row-->
									
	
								<div class="form-actions">
									<div class="row">
										<div class="col-md-6">
											<div class="row">
												<div class="col-md-offset-3 col-md-9">
													<button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Simpan</button>
													<a href="#" onClick="history.go(-1); return false;" class="btn btn-default"><i class="fa fa-times"></i> Batal</a>
												</div>
											</div>
										</div>
										<div class="col-md-6">
										</div>
									</div>
								</div>
									
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
					
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
									<button type="button" class="btn btn-primary" id="simpan_lokasi" data-dismiss="modal"><i class="fa fa-check"></i> Simpan Lokasi</button>
								</div>
							</div>
						</div>
					</div>

					
                </div>
            </div>
        </div>
	<!-- END CONTENT -->
    <script>
	function show_form_deskel_by_kecamatan(){
		var kecamatan_kode = $('select[name=kecamatan_kode]').val();
		load('usulan/masyarakat/tampil_combobox_deskel_by_kecamatan/'+kecamatan_kode, '#tampil_combobox_deskel_by_kecamatan');
	}
	
	</script>