<!-- BEGIN CONTENT -->
	<div class="page-content-wrapper">
		<div class="page-content">
			<!-- BEGIN PAGE HEADER-->
			<h3 class="page-title">
			Detail Menu
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
						<a href="<?php echo site_url('pengaturan/menu');?>">Menu</a>
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
								<i class="fa fa-pencil"></i>Data Detail: <?php echo $menu_nama; ?>
							</div>
						</div>
						<div class="portlet-body form">
							<!-- BEGIN FORM-->
							<form class="form-horizontal" role="form">							
								<div class="form-body">
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label class="control-label col-md-2" for="menu_level">Menu Level :</label>
												<div class="col-md-10">
                                                	<p class="form-control-static"><?php echo $menu_level;?></p>
                                                </div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label class="control-label col-md-2" for="menu_nama">Menu Nama :</label>
												<div class="col-md-10">
                                                	<p class="form-control-static"><?php echo $menu_nama;?></p>
                                                </div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label class="control-label col-md-2" for="menu_deskripsi">Deskripsi :</label>
												<div class="col-md-10">
                                                	<p class="form-control-static"><?php echo $menu_deskripsi;?></p>
                                                </div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label col-md-4" for="menu_url">Url :</label>
												<div class="col-md-8">
                                                	<p class="form-control-static"><?php echo $url = ($menu_url == '#')?$menu_url:site_url($menu_url); ?></p>
                                                </div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-4">
											<div class="form-group">
												<label class="control-label col-md-6" for="menu_urutan">Urutan :</label>
												<div class="col-md-6">
                                                	<p class="form-control-static"><?php echo $menu_urutan;?></p>
                                                </div>
											</div>
										</div>
										<div class="col-md-8">
											<div class="form-group">
												<label class="control-label col-md-4" for="menu_icon">Icon :</label>
												<div class="col-md-8">
                                                	<p class="form-control-static"><?php echo $menu_icon;?></p>
                                                </div>
											</div>
										</div>
									</div>
									<?php if ($menu_level > 1){?>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label class="control-label col-md-2" for="menu_subkode">Menu Utama :</label>
												<div class="col-md-10">
                                                	<p class="form-control-static"><?php echo $menu_subkode;?></p>
                                                </div>
											</div>
										</div>
									</div>
									<?php } ?>
								</div>
								<div class="form-actions">
									<div class="row">
										<div class="col-md-6">
											<div class="row">
												<div class="col-md-offset-3 col-md-9">
													<a href="<?php echo site_url('pengaturan/menu/edit/'.$menu_kode);?>" class="btn green"><i class="fa fa-pencil"></i> Ubah Data</a>
													<a href="<?php echo site_url('pengaturan/menu');?>" class="btn default"><i class="fa fa-reply"></i> Kembali</a>
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