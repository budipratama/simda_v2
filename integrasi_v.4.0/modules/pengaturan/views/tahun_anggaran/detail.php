<!-- BEGIN CONTENT -->
	<div class="page-content-wrapper">
		<div class="page-content">
			<!-- BEGIN PAGE HEADER-->
			<h3 class="page-title">
			Detail Tahun Anggaran
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
						<a href="<?php echo site_url('pengaturan/tahun_anggaran');?>">Tahun Anggaran</a>
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
								<i class="fa fa-pencil"></i>Data Detail: <?php echo $tahun; ?>
							</div>
						</div>
						<div class="portlet-body form">
							<!-- BEGIN FORM-->
							<form class="form-horizontal" role="form">							
								<div class="form-body">
									<div class="row">
										<div class="col-md-4">
											<div class="form-group">
												<label class="control-label col-md-6" for="tahun">Tahun :</label>
                                                <div class="col-md-6">
                                                	<p class="form-control-static"><?php echo $tahun; ?></p>
                                                </div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-4">
											<div class="form-group">
												<label class="control-label col-md-6" for="status">Status :</label>
												<div class="col-md-6">
                                                	<input type="checkbox" readonly="readonly" name="status" id="status" <?php echo $status;?> class="make-switch" data-on-text="&nbsp;ENABLE&nbsp;" data-off-text="&nbsp;DISABLE&nbsp;" data-on-color="success" data-off-color="default">
                                                </div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-4">
											<div class="form-group">
												<label class="control-label col-md-6" for="murni">Murni :</label>
												<div class="col-md-6">
                                                	<input type="checkbox" readonly="readonly" name="murni" id="murni" <?php echo $murni;?> class="make-switch" data-on-text="&nbsp;ENABLE&nbsp;" data-off-text="&nbsp;DISABLE&nbsp;" data-on-color="success" data-off-color="default">
                                                </div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-4">
											<div class="form-group">
												<label class="control-label col-md-6" for="perubahan">Perubahan :</label>
												<div class="col-md-6">
                                                	<input type="checkbox" readonly="readonly" name="perubahan" id="perubahan" <?php echo $perubahan;?> class="make-switch" data-on-text="&nbsp;ENABLE&nbsp;" data-off-text="&nbsp;DISABLE&nbsp;" data-on-color="success" data-off-color="default">
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
													<a href="<?php echo site_url('pengaturan/tahun_anggaran/edit/'.$tahun);?>" class="btn green"><i class="fa fa-pencil"></i> Ubah Data</a>
													<a href="<?php echo site_url('pengaturan/tahun_anggaran');?>" class="btn default"><i class="fa fa-reply"></i> Kembali</a>
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