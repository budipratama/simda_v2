<!-- BEGIN CONTENT -->
	<div class="page-content-wrapper">
		<div class="page-content">
			<!-- BEGIN PAGE HEADER-->
			<h3 class="page-title">
			Tambah Indikator per SKPD
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
						<a href="<?php echo site_url('pengaturan/indikator-skpd');?>">Indikator per SKPD</a>
						<i class="fa fa-angle-right"></i>
					</li>
                     <li>
						<a href="#">Tambah</a>
					</li>
				</ul>
			</div>
			
            <div class="note note-warning">
				<p>
					NOTE: Silahkan isi form Indikator per SKPD ini dengan data-data yang valid!. Sesuai dengan arahan dari BAPPEDA Kabupaten Bekasi.
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
								<i class="fa fa-pencil"></i>Tambah Indikator per SKPD
							</div>
						</div>
						<div class="portlet-body form">
							<!-- BEGIN FORM-->
							<form action="<?php echo site_url('pengaturan/indikator-skpd/insert');?>" class="horizontal-form" method="post">
								<div class="form-body">
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label class="control-label" for="visi_kode">Visi<span class="required">*</span> :</label>
												<?php combobox('db', $visi, 'visi_kode', 'kode', 'visi', '', '', 'Pilih Visi', 'class="select2_category form-control" tabindex="1" required="required"'); ?>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label class="control-label" for="misi_kode">Misi<span class="required">*</span> :</label>
												<?php combobox('db', $misi, 'misi_kode', 'kode', 'misi', '', 'show_form_tujuan_by_misi();', 'Pilih Misi', 'class="select2_category form-control" tabindex="1" required="required"'); ?>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group" id="tampil_combobox_tujuan_by_misi">
												<label class="control-label" for="tujuan_kode">Tujuan<span class="required">*</span> :</label>
												<select class="select2_category form-control" name="tujuan_kode" id="tujuan_kode" data-placeholder="Pilih Tujuan" required="required">
												</select>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group" id="tampil_combobox_sasaran_by_tujuan">
												<label class="control-label" for="sasaran_kode">Sasaran<span class="required">*</span> :</label>
												<select class="select2_category form-control" name="sasaran_kode" id="sasaran_kode" data-placeholder="Pilih Sasaran" required="required">
												</select>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group" id="tampil_combobox_indikator_by_sasaran">
												<label class="control-label" for="indikator_kode">Indikator<span class="required">*</span> :</label>
												<select class="select2_category form-control" name="indikator_kode" id="indikator_kode" data-placeholder="Pilih Indikator" required="required">
												</select>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label class="control-label" for="urusan_kode">Urusan<span class="required">*</span> :</label>
												<?php combobox('db', $urusan, 'urusan_kode', 'kode', 'urusan', '', 'show_form_program_by_urusan();', 'Pilih Urusan', 'class="select2_category form-control" tabindex="1" required="required"'); ?>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group" id="tampil_combobox_program_by_urusan">
												<label class="control-label" for="program_kode">Program<span class="required">*</span> :</label>
												<select class="select2_category form-control" name="program_kode" id="program_kode" data-placeholder="Pilih Program" required="required">
												</select>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label class="control-label" for="skpd_kode">Nama SKPD<span class="required">*</span> :</label>
												<?php combobox('db', $skpd, 'skpd_kode', 'skpd_kode', 'skpd_nama', '', '', 'Pilih SKPD', 'class="select2_category form-control" tabindex="1" required="required"'); ?>
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
													<a href="<?php echo site_url('pengaturan/indikator_skpd');?>" class="btn default"><i class="fa fa-times"></i> Batal</a>
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
	function show_form_tujuan_by_misi(){
		var misi_kode = $('select[name=misi_kode]').val();
		load('pengaturan/indikator_skpd/tampil_combobox_tujuan_by_misi/'+misi_kode, '#tampil_combobox_tujuan_by_misi');
	}
	
	function show_form_sasaran_by_tujuan(){
		var tujuan_kode = $('select[name=tujuan_kode]').val();
		load('pengaturan/indikator_skpd/tampil_combobox_sasaran_by_tujuan/'+tujuan_kode, '#tampil_combobox_sasaran_by_tujuan');
	}
	
	function show_form_indikator_by_sasaran(){
		var sasaran_kode = $('select[name=sasaran_kode]').val();
		load('pengaturan/indikator_skpd/tampil_combobox_indikator_by_sasaran/'+sasaran_kode, '#tampil_combobox_indikator_by_sasaran');
	}
	
	function show_form_program_by_urusan(){
		var urusan_kode = $('select[name=urusan_kode]').val();
		load('pengaturan/indikator_skpd/tampil_combobox_program_by_urusan/'+urusan_kode, '#tampil_combobox_program_by_urusan');
	}
	
	</script>