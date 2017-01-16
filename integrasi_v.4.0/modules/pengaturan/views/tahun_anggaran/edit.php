<!-- BEGIN CONTENT -->
	<div class="page-content-wrapper">
		<div class="page-content">
			<!-- BEGIN PAGE HEADER-->
			<h3 class="page-title">
			Ubah Tahun Anggaran
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
						<a href="#">Ubah</a>
					</li>
				</ul>
			</div>
			
            <div class="note note-warning">
				<p>
					NOTE: Silahkan isi form Tahun Anggaran ini dengan data-data yang valid!. Sesuai dengan arahan dari BAPPEDA Kabupaten Sukabumi.
				</p>
			</div>
			<?php echo validation_errors(); ?>
            <!-- END PAGE HEADER-->
			<!-- BEGIN FORM -->
			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN SAMPLE TABLE PORTLET-->
					<div class="portlet box green">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-pencil"></i>Ubah Tahun Anggaran
							</div>
						</div>
						<div class="portlet-body form">
							<!-- BEGIN FORM-->
							<form action="<?php echo site_url('pengaturan/tahun_anggaran/update/'.$tahun);?>" class="horizontal-form" method="post">							
								<input type="hidden" name="tahun_hidden" value="<?php echo $tahun; ?>" />
								<div class="form-body">
									<div class="row">
										<div class="col-md-2">
											<div class="form-group">
												<label class="control-label" for="tahun">Tahun :</label>
												<input type="text" class="form-control" name="tahun" id="tahun" value="<?php echo $tahun; ?>" placeholder="" required="required">
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-2">
											<div class="form-group">
												<label class="control-label" for="status">Status :</label>
												<input type="checkbox" name="status" id="status" <?php echo $status; ?> class="make-switch" data-on-text="&nbsp;ENABLE&nbsp;" data-off-text="&nbsp;DISABLE&nbsp;" data-on-color="success" data-off-color="default">
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-2">
											<div class="form-group">
												<label class="control-label" for="murni">Murni :</label>
												<input type="checkbox" name="murni" id="murni" <?php echo $murni; ?> class="make-switch" data-on-text="&nbsp;ENABLE&nbsp;" data-off-text="&nbsp;DISABLE&nbsp;" data-on-color="success" data-off-color="default">
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-2">
											<div class="form-group">
												<label class="control-label" for="perubahan">Perubahan :</label>
												<input type="checkbox" name="perubahan" id="perubahan" <?php echo $perubahan; ?> class="make-switch" data-on-text="&nbsp;ENABLE&nbsp;" data-off-text="&nbsp;DISABLE&nbsp;" data-on-color="success" data-off-color="default">
											</div>
										</div>
									</div>
								</div>
								<div class="form-actions">
									<div class="row">
										<div class="col-md-6">
											<div class="row">
												<div class="col-md-offset-3 col-md-9">
													<button type="submit" class="btn green"><i class="fa fa-check"></i> Simpan Data</button>
													<a href="<?php echo site_url('pengaturan/tahun_anggaran');?>" class="btn default"><i class="fa fa-times"></i> Batal</a>
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