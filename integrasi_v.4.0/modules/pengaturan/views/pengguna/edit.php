<!-- BEGIN CONTENT -->
	<div class="page-content-wrapper">
		<div class="page-content">
			<!-- BEGIN PAGE HEADER-->
			<h3 class="page-title">
			Ubah Pengguna
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
						<a href="#">Ubah</a>
					</li>
				</ul>
			</div>
			
            <div class="note note-warning">
				<p>
					NOTE: Silahkan isi form Pengguna ini dengan data-data yang valid!. Sesuai dengan arahan dari BAPPEDA Kabupaten Bekasi.
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
								<i class="fa fa-pencil"></i>Ubah Pengguna
							</div>
						</div>
						<div class="portlet-body form">
							<!-- BEGIN FORM-->
							<form action="<?php echo site_url('pengaturan/pengguna/update/'.$admin_user);?>" class="horizontal-form" method="post">							
								<input type="hidden" name="admin_user" value="<?php echo $admin_user; ?>" />
                                <input type="hidden" name="admin_user_hidden" value="<?php echo $admin_user; ?>" />
								<div class="form-body">
									<h3 class="form-section">Hak Akses</h3>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label" for="admin_user">Username <span class="required">*</span> :</label>
												<input type="text" class="form-control" name="admin_user" id="admin_user" value="<?php echo $admin_user; ?>" placeholder="" required="required">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label" for="admin_pass">Ubah Password :</label>
												<input type="password" class="form-control" name="admin_pass" id="admin_pass" value="<?php echo $admin_pass; ?>" placeholder="">
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label" for="admin_level_kode">Kelompok <span class="required">*</span> :</label>
												<?php combobox('db', $admin_level, 'admin_level_kode', 'admin_level_kode', 'admin_level_nama', $admin_level_kode, 'show_form_admin_level_kode();', 'Pilih Kelompok Pengguna', 'class="select2_category form-control" required="required"'); ?>
											</div>
										</div>
									<?php if (in_array($admin_level_kode, array('4', '5', '14', '15')) == FALSE){?>
										<div class="col-md-6">
											<div class="form-group" id="tampil_combobox_skpd_kode">
												
											</div>
										</div>
									</div>
									<?php } else { ?>
										<div class="col-md-6">
											<div class="form-group" id="tampil_combobox_skpd_kode">
												<label class="control-label" for="skpd_kode">Nama <?php echo $skpd_status; ?> <span class="required">*</span> :</label>
												<?php combobox('db', $skpd, 'skpd_kode', 'skpd_kode', 'skpd_nama', $skpd_kode, '', 'Pilih '.$skpd_status, 'class="select2_category form-control" required="required"'); ?>
											</div>
										</div>
									</div>
									<?php } ?>
									
									<h3 class="form-section">Biodata</h3>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label" for="admin_nama">Nama <span class="required">*</span> :</label>
												<input type="text" class="form-control" name="admin_nama" id="admin_nama" value="<?php echo $admin_nama; ?>" placeholder="" required="required">
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label class="control-label" for="admin_alamat">Alamat <span class="required">*</span> :</label>
												<input type="text" class="form-control" name="admin_alamat" id="admin_alamat" value="<?php echo $admin_alamat; ?>" placeholder="" required="required">
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-4">
											<div class="form-group">
												<label class="control-label" for="admin_telepon">Telepon/HP <span class="required">*</span> :</label>
												<input type="text" class="form-control" name="admin_telepon" id="admin_telepon" value="<?php echo $admin_telepon; ?>" placeholder="" required="required">
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
													<a href="<?php echo site_url('pengaturan/pengguna');?>" class="btn default"><i class="fa fa-times"></i> Batal</a>
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
	<script>
	function show_form_admin_level_kode(){
		var admin_level_kode = $('select[name=admin_level_kode]').val();
		load('pengaturan/pengguna/tampil_combobox_skpd/'+admin_level_kode, '#tampil_combobox_skpd_kode');
	}
	
	</script>