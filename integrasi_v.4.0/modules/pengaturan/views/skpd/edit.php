<!-- Main Content -->
   <section class="content">
		<h2>Daftar Satuan Kerja Perangkat Daerah (SKPD) <small>entri data &amp; informasi detail</small></h2>  
			<div class="body">
				<ol class="breadcrumb breadcrumb-col-cyan">
					<li><a href="<?php echo site_url('dashboard');?>"><i class="material-icons">home</i> Home</a></li>
					<li><a href="<?php echo site_url('pengaturan');?>"> Control Panel</a></li>
					<li class="active"> Detail SKPD</li>
				</ol>
			</div>
            <!-- Multiple Items To Be Open -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header bg-teal">
						<h2>Control Panel<small>Data SKPD</small></h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="<?php echo site_url('pengaturan/skpd');?>"><i class="material-icons">reply</i> Kembali</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <div class="row clearfix">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
									<form action="<?php echo site_url('pengaturan/skpd/update/'.$skpd_kode);?>" class="horizontal-form" method="post">							
										<input type="hidden" name="skpd_kode" value="<?php echo $skpd_kode; ?>" />
										<div class="form-body">
											<h3 class="form-section">Identitas SKPD</h3>
											<div class="row">
												<div class="col-md-12">
													<div class="form-group">
														<label class="control-label" for="urusan_kode">Urusan :</label>
														<?php combobox('db', $urusan, 'urusan_kode', 'kode', 'urusan', $urusan_kode, '', 'Pilih Urusan', 'class="form-control show-tick" data-live-search="true" tabindex="1" required="required" autofocus'); ?>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-2">
													<div class="form-group">
													<div class="form-line">
														<label class="control-label" for="skpd_nomor">Nomor SKPD :</label>
														<input type="text" class="form-control" name="skpd_nomor" id="skpd_nomor" value="<?php echo $skpd_nomor; ?>" placeholder="">
													</div>
													</div>
												</div>
												<div class="col-md-10">
													<div class="form-group">
													<div class="form-line">
														<label class="control-label" for="skpd_nama">Nama SKPD<span class="required">*</span> :</label>
														<input type="text" class="form-control" name="skpd_nama" id="skpd_nama" value="<?php echo $skpd_nama; ?>" placeholder="" required="required">
													</div>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-12">
													<div class="form-group">
													<div class="form-line">
														<label class="control-label" for="skpd_kewenangan">Kewenangan :</label>
														<input type="text" class="form-control" name="skpd_kewenangan" id="skpd_kewenangan" value="<?php echo $skpd_kewenangan; ?>" placeholder="">
													</div>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-6">
													<div class="form-group">
													<div class="form-line">
														<label class="control-label" for="skpd_pimpinan">Pimpinan<span class="required">*</span> :</label>
														<input type="text" class="form-control" name="skpd_pimpinan" id="skpd_pimpinan" value="<?php echo $skpd_pimpinan; ?>" placeholder="" required="required">
													</div>
													</div>
												</div>
											</div>											
											<h3 class="form-section">Informasi Kontak</h3>
											<div class="row">
												<div class="col-md-12">
													<div class="form-group">
													<div class="form-line">
														<label class="control-label" for="skpd_alamat">Alamat :</label>
														<input type="text" class="form-control" name="skpd_alamat" id="skpd_alamat" value="<?php echo $skpd_alamat; ?>" placeholder="" required="required">
													</div>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-3">
													<div class="form-group">
													<div class="form-line">
														<label class="control-label" for="skpd_telepon">Telepon :</label>
														<input type="text" class="form-control" name="skpd_telepon" id="skpd_telepon" value="<?php echo $skpd_telepon; ?>" placeholder="" required="required">
													</div>
													</div>
												</div>
												<div class="col-md-3">
													<div class="form-group">
													<div class="form-line">
														<label class="control-label" for="skpd_fax">Fax :</label>
														<input type="text" class="form-control" name="skpd_fax" id="skpd_fax" value="<?php echo $skpd_fax; ?>" placeholder="">
													</div>
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
													<div class="form-line">
														<label class="control-label" for="skpd_email">Email :</label>
														<input type="email" class="form-control" name="skpd_email" id="skpd_email" value="<?php echo $skpd_email; ?>" placeholder="">
													</div>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-8">
													<div class="form-group">
													<div class="form-line">
														<label class="control-label" for="skpd_website">Website :</label>
														<input type="url" class="form-control" name="skpd_website" id="skpd_website" value="<?php echo $skpd_website; ?>" placeholder="">
													</div>
													</div>
												</div>
											</div>
											<h3 class="form-section">Informasi Status</h3>
											<div class="row">
												<div class="col-md-3">
													<div class="form-group">
														<label class="control-label" for="skpd_aktif">Tahun Aktifasi :</label>
														<?php combobox('db', $tahun, 'skpd_aktif', 'tahun', 'tahun', $skpd_aktif, '', 'Default', 'class="select2_category form-control" tabindex="1"'); ?>
													</div>
												</div>
												<div class="col-md-2">
													<div class="form-group">
														<label class="control-label" for="skpd_entri">Entri Data :</label>														
														<div class="switch"><label>NO<input type="checkbox" name="skpd_entri" id="skpd_entri" <?php echo $skpd_entri;?> ><span class="lever"></span>YES</label></div>
													</div>
												</div>
												<div class="col-md-2">
													<div class="form-group">
														<label class="control-label" for="skpd_kegiatan">Kegiatan Lainnya :</label>
														<div class="switch"><label>OFF<input type="checkbox" name="skpd_kegiatan" id="skpd_kegiatan" <?php echo $skpd_kegiatan;?> ><span class="lever"></span>ON</label></div>
													</div>
												</div>
												<div class="col-md-3">
													<div class="form-group">
														<label class="control-label" for="skpd_lokasi">Lokasi Kegiatan :</label>
														<div class="switch"><label>DISABLE<input type="checkbox" name="skpd_lokasi" id="skpd_lokasi" <?php echo $skpd_lokasi;?> ><span class="lever"></span>ENABLE</label></div>
													</div>
												</div>
											</div>
										</div>
										<div class="form-actions">
											<div class="row">
												<div class="col-md-6">
													<div class="row">
														<div class="col-md-offset-3 col-md-9">
															<button type="submit" class="btn btn-primary waves-effect">Simpan Data</button>
															<a href="<?php echo site_url('pengaturan/skpd');?>" class="btn btn-default waves-effect">Batal</a>
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
                </div>
            </div>
		<!-- #END# Tabs With Custom Animations -->
    </section>
<!-- END Main Content -->