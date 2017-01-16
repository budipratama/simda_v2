<!-- BEGIN CONTENT -->
	<div class="page-content-wrapper">
		<div class="page-content">
			<!-- BEGIN PAGE HEADER-->
			<h3 class="page-title">
			Parameter <small> BBBBB</small>
			</h3>
			<div class="page-bar">
				<ul class="page-breadcrumb">
					<li>
						<i class="fa fa-home"></i>
						<a href="<?php echo site_url('dashboard');?>">Home</a>
						<i class="fa fa-angle-right"></i>
					</li>
                    <li>
						<a href="<?php echo site_url('draf-apbd');?>">Parameter</a>
						<i class="fa fa-angle-right"></i>
					</li>
                     <li>
						<a href="#">Unit Organisasi</a>
					</li>
				</ul>
			</div>
			
            <div class="note note-warning">
				<p>
					NOTE: Silahkan isi form tambah Pra APBD Kabupaten ini dengan data-data yang valid!. Sesuai dengan arahan dari BAPPEDA Kabupaten Bekasi.
				</p>
			</div>
			<!-- END PAGE HEADER-->
			<?php echo validation_errors(); ?>
			<!-- BEGIN FORM -->
			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN SAMPLE TABLE PORTLET-->
					<div class="portlet box green">
									<div class="portlet-title">
										<div class="caption">
											<i class="fa fa-paper-plane"></i>Tambah Pra APBD Kabupaten
										</div>
									</div>
									<div class="portlet-body form">
										<!-- BEGIN FORM-->
										<form action="<?php echo site_url('draf-apbd/murni/insert/bl');?>" class="horizontal-form" enctype="multipart/form-data" method="post">
											<div class="form-body">
												<h3 class="form-section">Detail Kegiatan</h3>
												<input type="hidden" name="lokasi_kode" value="3">
                                                <div class="row">
                                                	<div class="col-md-5">
                                                    	<div class="form-group">
															<label class="control-label">Bidang <span class="required">*</span> :</label>
															<?php combobox('db', $bidang, 'kecamatan_kode', 'bidang_kd', 'bidang_nama', '', 'show_form_deskel_by_kecamatan();', 'Pilih Bidang', 'class="select2_category form-control" tabindex="1" required="required"'); ?>
														</div>
                                                    </div>
                                                    <!--/span-->
                                                    <div class="col-md-5">
                                                    	<div class="form-group" id="tampil_combobox_deskel_by_kecamatan">
															<label class="control-label" for="deskel_kode">Unit :</label>
															<select class="select2_category form-control" name="deskel_kode" id="deskel_kode" data-placeholder="Pilih Desa/Kelurahan" tabindex="1" required="required">
															</select>
														</div>
                                                    </div>
                                                    <!--/span-->
                                                    <div class="col-md-5">
                                                    	<div class="form-group" id="tampil_combobox_deskel_by_kecamatan1">
															<label class="control-label" for="deskel_kode">Sub Unit :</label>
															<select class="select2_category form-control" name="deskel_kode" id="deskel_kode" data-placeholder="Pilih Desa/Kelurahan" tabindex="1" required="required">
															</select>
														</div>
                                                    </div>
                                                    <!--/span-->
                                                </div>
                                                <!--/row-->

                                                
                                                
												
											</div>
											<div class="form-actions">
												<div class="row">
													<div class="col-md-6">
														<div class="row">
															<div class="col-md-offset-3 col-md-9">
																<button type="submit" class="btn green"><i class="fa fa-check"></i> Simpan & Tambah Data</button>
																<a href="<?php echo site_url('draf-apbd/murni');?>" class="btn default"><i class="fa fa-times"></i> Batal</a>
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
	<!-- END CONTENT -->
	
    <script>	
	function show_form_deskel_by_kecamatan(){
		var kecamatan_kode = $('select[name=kecamatan_kode]').val();
		load('parameter/unit-organisasi/tampil_combobox_deskel_by_kecamatan2/'+kecamatan_kode, '#tampil_combobox_deskel_by_kecamatan');
	}	
	
	function show_form_deskel_by_kecamatan1(){
		var kecamatan_kode = $('select[name=kecamatan_kode]').val();
		load('parameter/unit-organisasi/tampil_combobox_deskel_by_kecamatan3/'+kecamatan_kode, '#tampil_combobox_deskel_by_kecamatan1');
	}	
	</script>
   