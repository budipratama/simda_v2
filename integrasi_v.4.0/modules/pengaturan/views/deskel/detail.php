<!-- Main Content -->
   <section class="content">
		<h2>Detail Desa/Kelurahan <small>entri data &amp; informasi detail</small></h2>  
			<div class="body">
				<ol class="breadcrumb breadcrumb-col-cyan">
					<li><a href="<?php echo site_url('dashboard');?>"><i class="material-icons">home</i> Home</a></li>
					<li><a href="<?php echo site_url('pengaturan');?>"> Control Panel</a></li>
					<li class="active"> Desa/Kelurahan</li>
					<li class="active"> Detail</li>
				</ol>
			</div>
            <!-- Multiple Items To Be Open -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header bg-teal">
						<h2>Control Panel<small>Data Detail <?php echo $skpd_nama;?></small></h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="<?php echo site_url('pengaturan/deskel');?>"><i class="material-icons">reply</i> Kembali</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <div class="row clearfix">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
									<form class="form-horizontal" role="form">							
										<div class="form-body">
											<h3 class="form-section">Identitas </h3>
											<div class="row">
												<div class="col-md-12">
													<div class="form-group">
														<label class="control-label col-md-2" for="urusan_kode">Urusan :</label>
														<div class="col-md-10">
															<p class="form-control-static"><?php echo $urusan_nama;?></p>
														</div>
													</div>
												</div>
											</div>
											<div class="row">
											
												<div class="col-md-4">
													<div class="form-group">
														<label class="control-label col-md-6" for="urusan_kode">Kode Kecamatan :</label>
														<div class="col-md-4">
															<p class="form-control-static"><?php echo $skpd_kd; ?></p>
														</div>
													</div>
												</div>
											
												<div class="col-md-3">
													<div class="form-group">
														<label class="control-label col-md-6" for="skpd_nomor">Nomor :</label>
														<div class="col-md-4">
															<p class="form-control-static"><?php echo $skpd_nomor; ?></p>
														</div>
													</div>
												</div>
												<div class="col-md-5">
													<div class="form-group">
														<label class="control-label col-md-5" for="skpd_nama">Nama :</label>
														<div class="col-md-4">
															<p class="form-control-static"><?php echo $skpd_nama; ?></p>
														</div>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-12">
													<div class="form-group">
														<label class="control-label col-md-2" for="skpd_pimpinan">Pimpinan :</label>
														<div class="col-md-10">
															<p class="form-control-static"><?php echo $skpd_pimpinan;?></p>
														</div>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-12">
													<div class="form-group">
														<label class="control-label col-md-2" for="skpd_status">Jenis :</label>
														<div class="col-md-10">
															<p class="form-control-static"><?php echo $skpd_status;?></p>
														</div>
													</div>
												</div>
											</div>
											
											<h3 class="form-section">Informasi Kontak</h3>
											<div class="row">
												<div class="col-md-12">
													<div class="form-group">
														<label class="control-label col-md-2" for="skpd_alamat">Alamat :</label>
														<div class="col-md-10">
															<p class="form-control-static"><?php echo $skpd_alamat;?></p>
														</div>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-4">
													<div class="form-group">
														<label class="control-label col-md-6" for="skpd_telepon">Telepon :</label>
														<div class="col-md-6">
															<p class="form-control-static"><?php echo $skpd_telepon; ?></p>
														</div>
													</div>
												</div>
												<div class="col-md-3">
													<div class="form-group">
														<label class="control-label col-md-6" for="skpd_fax">Fax :</label>
														<div class="col-md-6">
															<p class="form-control-static"><?php echo $skpd_fax; ?></p>
														</div>
													</div>
												</div>
												<div class="col-md-5">
													<div class="form-group">
														<label class="control-label col-md-4" for="skpd_email">Email :</label>
														<div class="col-md-8">
															<p class="form-control-static"><?php echo $skpd_email;?></p>
														</div>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-12">
													<div class="form-group">
														<label class="control-label col-md-2" for="skpd_website">Website :</label>
														<div class="col-md-10">
															<p class="form-control-static"><?php echo $skpd_website;?></p>
														</div>
													</div>
												</div>
											</div>
											<h3 class="form-section">Informasi Status</h3>
											<div class="row">
												<div class="col-md-4">
													<div class="form-group">
														<label class="control-label col-md-6" for="skpd_aktif">Tahun Aktifasi :</label>
														<div class="col-md-6">
															<p class="form-control-static"><?php echo $skpd_aktif; ?></p>
														</div>
													</div>
												</div>
												<div class="col-md-2">
													<div class="form-group">
														<label class="control-label" for="skpd_entri">Entri Data :</label>														
														<div class="switch"><label>NO<input type="checkbox" name="skpd_entri" id="skpd_entri" <?php echo $skpd_entri;?> disabled><span class="lever"></span>YES</label></div>
													</div>
												</div>
												<div class="col-md-2">
													<div class="form-group">
														<label class="control-label" for="skpd_kegiatan">Kegiatan Lainnya :</label>
														<div class="switch"><label>OFF<input type="checkbox" name="skpd_kegiatan" id="skpd_kegiatan" <?php echo $skpd_kegiatan;?> disabled><span class="lever"></span>ON</label></div>
													</div>
												</div>
												<div class="col-md-3">
													<div class="form-group">
														<label class="control-label" for="skpd_lokasi">Lokasi Kegiatan :</label>
														<div class="switch"><label>DISABLE<input type="checkbox" name="skpd_lokasi" id="skpd_lokasi" <?php echo $skpd_lokasi;?> disabled><span class="lever"></span>ENABLE</label></div>
													</div>
												</div>
											</div>
										</div>
										<div class="form-actions">
											<div class="row">
												<div class="col-md-6">
													<div class="row">
														<div class="col-md-offset-3 col-md-9">
															<a href="<?php echo site_url('pengaturan/deskel/edit/'.$skpd_kode);?>" class="btn btn-primary waves-effect">Ubah Data</a>
															<a href="<?php echo site_url('pengaturan/deskel');?>" class="btn btn-default waves-effect">Kembali</a>
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