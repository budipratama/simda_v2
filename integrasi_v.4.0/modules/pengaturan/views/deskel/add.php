<!-- BEGIN CONTENT -->
	<div class="page-content-wrapper">
		<div class="page-content">
			<!-- BEGIN PAGE HEADER-->
			<h3 class="page-title">
			Tambah Desa/Kelurahan
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
						<a href="<?php echo site_url('pengaturan/deskel');?>">Desa/Kelurahan</a>
						<i class="fa fa-angle-right"></i>
					</li>
                     <li>
						<a href="#">Tambah</a>
					</li>
				</ul>
			</div>
			
            <div class="note note-warning">
				<p>
					NOTE: Silahkan isi form Desa/Kelurahan ini dengan data-data yang valid!. Sesuai dengan arahan dari BAPPEDA Kabupaten Bekasi.
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
								<i class="fa fa-pencil"></i>Tambah Desa/Kelurahan
							</div>
						</div>
						<div class="portlet-body form">
							<!-- BEGIN FORM-->
							<form action="<?php echo site_url('pengaturan/deskel/insert');?>" class="horizontal-form" method="post">
								<div class="form-body">
									<h3 class="form-section">Identitas</h3>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label class="control-label" for="urusan_kode">Urusan<span class="required">*</span> :</label>
                                                <!-- combobox('jenis=db,1d,2d', 'array', 'name', 'value', 'value_name', 'selected', 'js', 'label', 'script') -->
												<?php combobox('db', $urusan, 'urusan_kode', 'kode', 'urusan', '', '', 'Pilih Urusan', 'class="select2_category form-control" tabindex="1" required="required" autofocus'); ?>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-2">
											<div class="form-group">
												<label class="control-label" for="skpd_kd">Kode <span class="required">*</span> :</label>
												<input type="text" class="form-control" name="skpd_kd" id="skpd_kd" placeholder="3216XXXXXX" required="required">
											</div>
										</div>
										<div class="col-md-2">
											<div class="form-group">
												<label class="control-label" for="skpd_nomor">Nomor  :</label>
												<input type="text" class="form-control" name="skpd_nomor" id="skpd_nomor" placeholder="">
											</div>
										</div>
										<div class="col-md-8">
											<div class="form-group">
												<label class="control-label" for="skpd_nama">Nama Desa/Kelurahan<span class="required">*</span> :</label>
												<input type="text" class="form-control" name="skpd_nama" id="skpd_nama" placeholder="Deskel " required="required">
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label" for="skpd_pimpinan">Pimpinan<span class="required">*</span> :</label>
												<input type="text" class="form-control" name="skpd_pimpinan" id="skpd_pimpinan" placeholder="" required="required">
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label" for="skpd_status">Jenis<span class="required">*</span> :</label>
												<div class="radio-list">
													<label class="radio-inline" for="skpd_status_desa">
													<input type="radio" name="skpd_status" id="skpd_status_desa" value="Desa" required="required"> Desa</label>
													<label class="radio-inline" for="skpd_status_kelurahan">
													<input type="radio" name="skpd_status" id="skpd_status_kelurahan" value="Kelurahan" required="required"> Kelurahan</label>
												</div>
											</div>
										</div>
									</div>
									
									<h3 class="form-section">Informasi Kontak</h3>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label class="control-label" for="skpd_alamat">Alamat<span class="required">*</span> :</label>
												<input type="text" class="form-control" name="skpd_alamat" id="skpd_alamat" placeholder="" required="required">
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-3">
											<div class="form-group">
												<label class="control-label" for="skpd_telepon">Telepon<span class="required">*</span> :</label>
												<input type="text" class="form-control" name="skpd_telepon" id="skpd_telepon" placeholder="" required="required">
											</div>
                                        </div>
                                        <div class="col-md-3">
											<div class="form-group">
												<label class="control-label" for="skpd_fax">Fax :</label>
												<input type="text" class="form-control" name="skpd_fax" id="skpd_fax" placeholder="">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label" for="skpd_email">Email :</label>
												<input type="email" class="form-control" name="skpd_email" id="skpd_email" placeholder="alamatemail@bekasikab.go.id">
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label" for="skpd_website">Website :</label>
												<input type="url" class="form-control" name="skpd_website" id="skpd_website" placeholder="http://www.bekasikab.go.id">
											</div>
										</div>
									</div>
									
									<h3 class="form-section">Informasi Status</h3>
									<div class="row">
										<div class="col-md-3">
											<div class="form-group">
												<label class="control-label" for="skpd_aktif">Tahun Aktifasi :</label>
                                                <!-- combobox('jenis=db,1d,2d', 'array', 'name', 'value', 'value_name', 'selected', 'js', 'label', 'script') -->
												<?php combobox('db', $tahun, 'skpd_aktif', 'tahun', 'tahun', '', '', 'Default', 'class="select2_category form-control" tabindex="1"'); ?>
											</div>
										</div>
										<div class="col-md-2">
											<div class="form-group">
												<label class="control-label" for="skpd_entri">Entri Data :</label>
												<input type="checkbox" name="skpd_entri" id="skpd_entri" checked class="make-switch" data-on-text="&nbsp;YES&nbsp;" data-off-text="&nbsp;NO&nbsp;" data-on-color="primary" data-off-color="default">
											</div>
										</div>
										<div class="col-md-2">
											<div class="form-group">
												<label class="control-label" for="skpd_kegiatan">Kegiatan Lainnya :</label>
												<input type="checkbox" name="skpd_kegiatan" id="skpd_kegiatan" class="make-switch" data-on-text="&nbsp;ON&nbsp;" data-off-text="&nbsp;OFF&nbsp;" data-on-color="success" data-off-color="default">
											</div>
										</div>
										<div class="col-md-2">
											<div class="form-group">
												<label class="control-label" for="skpd_lokasi">Lokasi Kegiatan :</label>
												<input type="checkbox" name="skpd_lokasi" id="skpd_lokasi" checked class="make-switch" data-on-text="&nbsp;ENABLE&nbsp;" data-off-text="&nbsp;DISABLE&nbsp;" data-on-color="danger" data-off-color="default">
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
													<a href="<?php echo site_url('pengaturan/deskel');?>" class="btn default"><i class="fa fa-times"></i> Batal</a>
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