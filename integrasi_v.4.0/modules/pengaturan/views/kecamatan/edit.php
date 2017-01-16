<!-- BEGIN CONTENT -->
	<div class="page-content-wrapper">
		<div class="page-content">
			<!-- BEGIN PAGE HEADER-->
			<h3 class="page-title">
			Ubah Kecamatan
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
						<a href="<?php echo site_url('pengaturan/kecamatan');?>">Kecamatan</a>
						<i class="fa fa-angle-right"></i>
					</li>
                     <li>
						<a href="#">Ubah</a>
					</li>
				</ul>
			</div>
			
            <div class="note note-warning">
				<p>
					NOTE: Silahkan isi form Kecamatan ini dengan data-data yang valid!. Sesuai dengan arahan dari BAPPEDA Kabupaten Bekasi.
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
								<i class="fa fa-pencil"></i>Ubah Kecamatan
							</div>
						</div>
						<div class="portlet-body form">
							<!-- BEGIN FORM-->
							<form action="<?php echo site_url('pengaturan/kecamatan/update/'.$skpd_kode);?>" class="horizontal-form" method="post">							
								<input type="hidden" name="skpd_kode" value="<?php echo $skpd_kode; ?>" />
                                <input type="hidden" name="skpd_kd_hidden" value="<?php echo $skpd_kd; ?>" />
								<div class="form-body">
									<h3 class="form-section">Identitas Kecamatan</h3>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label class="control-label" for="urusan_kode">Urusan<span class="required">*</span> :</label>
												<?php combobox('db', $urusan, 'urusan_kode', 'kode', 'urusan', $urusan_kode, '', 'Pilih Urusan', 'class="select2_category form-control" tabindex="1" required="required" autofocus'); ?>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-2">
											<div class="form-group">
												<label class="control-label" for="skpd_kd">Kode Kecamatan<span class="required">*</span> :</label>
												<input type="text" class="form-control" name="skpd_kd" id="skpd_kd" value="<?php echo $skpd_kd; ?>" placeholder="" required="required">
											</div>
										</div>
										<div class="col-md-2">
											<div class="form-group">
												<label class="control-label" for="skpd_nomor">Nomor Kecamatan :</label>
												<input type="text" class="form-control" name="skpd_nomor" id="skpd_nomor" value="<?php echo $skpd_nomor; ?>" placeholder="">
											</div>
										</div>
										<div class="col-md-8">
											<div class="form-group">
												<label class="control-label" for="skpd_nama">Nama Kecamatan<span class="required">*</span> :</label>
												<input type="text" class="form-control" name="skpd_nama" id="skpd_nama" value="<?php echo $skpd_nama; ?>" placeholder="" required="required">
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label" for="skpd_pimpinan">Pimpinan<span class="required">*</span> :</label>
												<input type="text" class="form-control" name="skpd_pimpinan" id="skpd_pimpinan" value="<?php echo $skpd_pimpinan; ?>" placeholder="" required="required">
											</div>
										</div>
									</div>
									
									<h3 class="form-section">Informasi Kontak</h3>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label class="control-label" for="skpd_alamat">Alamat<span class="required">*</span> :</label>
												<input type="text" class="form-control" name="skpd_alamat" id="skpd_alamat" value="<?php echo $skpd_alamat; ?>" placeholder="" required="required">
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-3">
											<div class="form-group">
												<label class="control-label" for="skpd_telepon">Telepon<span class="required">*</span> :</label>
												<input type="text" class="form-control" name="skpd_telepon" id="skpd_telepon" value="<?php echo $skpd_telepon; ?>" placeholder="" required="required">
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<label class="control-label" for="skpd_fax">Fax :</label>
												<input type="text" class="form-control" name="skpd_fax" id="skpd_fax" value="<?php echo $skpd_fax; ?>" placeholder="">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label" for="skpd_email">Email :</label>
												<input type="email" class="form-control" name="skpd_email" id="skpd_email" value="<?php echo $skpd_email; ?>" placeholder="">
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-8">
											<div class="form-group">
												<label class="control-label" for="skpd_website">Website :</label>
												<input type="url" class="form-control" name="skpd_website" id="skpd_website" value="<?php echo $skpd_website; ?>" placeholder="">
											</div>
										</div>
									</div>
									<h3 class="form-section">Informasi Status</h3>
									<div class="row">
										<div class="col-md-3">
											<div class="form-group">
												<label class="control-label" for="skpd_aktif">Tahun Aktifasi :</label>
                                                <!-- combobox('jenis=db,1d,2d', 'array', 'name', 'value', 'value_name', 'selected', 'js', 'label', 'script') -->
												<?php combobox('db', $tahun, 'skpd_aktif', 'tahun', 'tahun', $skpd_aktif, '', 'Default', 'class="select2_category form-control" tabindex="1"'); ?>
											</div>
										</div>
										<div class="col-md-2">
											<div class="form-group">
												<label class="control-label" for="skpd_entri">Entri Data :</label>
												<input type="checkbox" name="skpd_entri" id="skpd_entri" <?php echo $skpd_entri;?> class="make-switch" data-on-text="&nbsp;YES&nbsp;" data-off-text="&nbsp;NO&nbsp;" data-on-color="primary" data-off-color="default">
											</div>
										</div>
										<div class="col-md-2">
											<div class="form-group">
												<label class="control-label" for="skpd_kegiatan">Kegiatan Lainnya :</label>
												<input type="checkbox" name="skpd_kegiatan" id="skpd_kegiatan" <?php echo $skpd_kegiatan;?> class="make-switch" data-on-text="&nbsp;ON&nbsp;" data-off-text="&nbsp;OFF&nbsp;" data-on-color="success" data-off-color="default">
											</div>
										</div>
										<div class="col-md-2">
											<div class="form-group">
												<label class="control-label" for="skpd_lokasi">Lokasi Kegiatan :</label>
												<input type="checkbox" name="skpd_lokasi" id="skpd_lokasi" <?php echo $skpd_lokasi;?> class="make-switch" data-on-text="&nbsp;ENABLE&nbsp;" data-off-text="&nbsp;DISABLE&nbsp;" data-on-color="danger" data-off-color="default">
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
													<a href="<?php echo site_url('pengaturan/kecamatan');?>" class="btn default"><i class="fa fa-times"></i> Batal</a>
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