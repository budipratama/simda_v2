<!-- BEGIN CONTENT -->
	<div class="page-content-wrapper">
		<div class="page-content">
			<!-- BEGIN PAGE HEADER-->
			<h3 class="page-title">
			Ubah Kelompok Pengguna
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
						<a href="<?php echo site_url('pengaturan/kelompok_pengguna');?>">Kelompok Pengguna</a>
						<i class="fa fa-angle-right"></i>
					</li>
                     <li>
						<a href="#">Ubah</a>
					</li>
				</ul>
			</div>
			
            <div class="note note-warning">
				<p>
					NOTE: Silahkan isi form Kelompok Pengguna ini dengan data-data yang valid!. Sesuai dengan arahan dari BAPPEDA Kabupaten Bekasi.
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
								<i class="fa fa-pencil"></i>Ubah Kelompok Pengguna
							</div>
						</div>
						<div class="portlet-body form">
							<!-- BEGIN FORM-->
							<form action="<?php echo site_url('pengaturan/kelompok_pengguna/update/'.$admin_level_kode);?>" class="horizontal-form" method="post">							
								<input type="hidden" name="admin_level_kode" value="<?php echo $admin_level_kode; ?>" />
								<div class="form-body">
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label class="control-label" for="admin_level_nama">Kelompok<span class="required">*</span> :</label>
												<input type="text" class="form-control" name="admin_level_nama" id="admin_level_nama" value="<?php echo $admin_level_nama; ?>" placeholder="" required="required">
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
													<a href="<?php echo site_url('pengaturan/kelompok_pengguna');?>" class="btn default"><i class="fa fa-times"></i> Batal</a>
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