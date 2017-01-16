<!-- BEGIN CONTENT -->
	<div class="page-content-wrapper">
		<div class="page-content">
			<!-- BEGIN PAGE HEADER-->
			<h3 class="page-title">
			Detail Pengguna
			</h3>
			<div class="page-bar">
				<ul class="page-breadcrumb">
					<li>
						<i class="fa fa-home"></i>
						<a href="<?php echo site_url('dashboard');?>">Home</a>
						<i class="fa fa-angle-right"></i>
					</li>
                    <li>
						<a href="<?php echo site_url('pengaturan');?>">Control Panel</a>
						<i class="fa fa-angle-right"></i>
					</li>
                    <li>
						<a href="<?php echo site_url('pengaturan/pengguna');?>">Pengguna</a>
						<i class="fa fa-angle-right"></i>
					</li>
                     <li>
						<a href="#">Detail</a>
					</li>
				</ul>
			</div>
			
            <!-- END PAGE HEADER-->
			<!-- BEGIN FORM -->
			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN SAMPLE TABLE PORTLET-->
					<div class="portlet box green">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-pencil"></i>Data Detail: <?php echo $admin_user; ?>
							</div>
						</div>
						<div class="portlet-body form">
							<!-- BEGIN FORM-->
							<form class="form-horizontal" role="form">							
								<div class="form-body">
                                    <h3 class="form-section">Hak Akses </h3>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label class="control-label col-md-2" for="admin_user">Username :</label>
												<div class="col-md-10">
                                                	<p class="form-control-static"><?php echo $admin_user;?></p>
                                                </div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label class="control-label col-md-2" for="admin_pass">Password :</label>
												<div class="col-md-10">
                                                	<p class="form-control-static">****************</p>
                                                </div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label class="control-label col-md-2" for="admin_level_nama">Kelompok :</label>
												<div class="col-md-10">
                                                	<p class="form-control-static"><?php echo $admin_level_nama;?></p>
                                                </div>
											</div>
										</div>
									</div>
									<?php if (in_array($admin_level_kode, array('4', '5', '14', '15')) == TRUE){?>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label class="control-label col-md-2" for="skpd_nama"><?php echo $skpd_status; ?> :</label>
												<div class="col-md-10">
                                                	<p class="form-control-static"><?php echo $skpd_nama;?></p>
                                                </div>
											</div>
										</div>
									</div>
									<?php } ?>
									
									<h3 class="form-section">Biodata </h3>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label class="control-label col-md-2" for="admin_nama">Nama :</label>
												<div class="col-md-10">
                                                	<p class="form-control-static"><?php echo $admin_nama;?></p>
                                                </div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label class="control-label col-md-2" for="admin_alamat">Alamat :</label>
												<div class="col-md-10">
                                                	<p class="form-control-static"><?php echo $admin_alamat;?></p>
                                                </div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label class="control-label col-md-2" for="admin_telepon">Telepon/HP :</label>
												<div class="col-md-10">
                                                	<p class="form-control-static"><?php echo $admin_telepon;?></p>
                                                </div>
											</div>
										</div>
									</div>
								</div>
								<div class="form-actions">
									<div class="row">
										<div class="col-md-6">
											<div class="row">
												<div class="col-md-offset-3 col-md-9">
													<a href="<?php echo site_url('pengaturan/pengguna/edit/'.$admin_user);?>" class="btn green"><i class="fa fa-pencil"></i> Ubah Data</a>
													<a href="<?php echo site_url('pengaturan/pengguna');?>" class="btn default"><i class="fa fa-reply"></i> Kembali</a>
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
					<!-- END SAMPLE TABLE PORTLET-->
				</div>
			</div>
     
		</div>
		
	</div>