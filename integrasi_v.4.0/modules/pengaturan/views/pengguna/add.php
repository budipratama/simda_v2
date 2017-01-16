<!-- BEGIN CONTENT -->
	<div class="page-content-wrapper">
		<div class="page-content">
			<!-- BEGIN PAGE HEADER-->
			<h3 class="page-title">
			Tambah Pengguna
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
						<a href="#">Tambah</a>
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
								<i class="fa fa-pencil"></i>Tambah Pengguna
							</div>
						</div>
						<div class="portlet-body form">
							<!-- BEGIN FORM-->
							<form action="<?php echo site_url('pengaturan/pengguna/insert');?>" class="horizontal-form" method="post">
								<div class="form-body">
									<h3 class="form-section">Hak Akses</h3>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label" for="admin_user">Username <span class="required">*</span> :</label>
												<input type="text" class="form-control" name="admin_user" id="admin_user" placeholder="" required="required">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label" for="admin_pass">Password <span class="required">*</span> :</label>
												<input type="password" class="form-control" name="admin_pass" id="admin_pass" placeholder="" required="required">
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label" for="admin_level_kode">Kelompok <span class="required">*</span> :</label>
												<?php combobox('db', $admin_level, 'admin_level_kode', 'admin_level_kode', 'admin_level_nama', '', 'show_form_admin_level_kode();', 'Pilih Kelompok Pengguna', 'class="select2_category form-control" required="required"'); ?>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group" id="tampil_combobox_skpd_kode">
											</div>
										</div>
									</div>
									
									<h3 class="form-section">Biodata</h3>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label" for="admin_nama">Nama <span class="required">*</span> :</label>
												<input type="text" class="form-control" name="admin_nama" id="admin_nama" placeholder="" required="required">
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label class="control-label" for="admin_alamat">Alamat <span class="required">*</span> :</label>
												<input type="text" class="form-control" name="admin_alamat" id="admin_alamat" placeholder="" required="required">
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-4">
											<div class="form-group">
												<label class="control-label" for="admin_telepon">Telepon/HP <span class="required">*</span> :</label>
												<input type="text" class="form-control" name="admin_telepon" id="admin_telepon" placeholder="" required="required">
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