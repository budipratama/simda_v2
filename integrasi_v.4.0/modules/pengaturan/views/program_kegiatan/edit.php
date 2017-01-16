<!-- BEGIN CONTENT -->
	<div class="page-content-wrapper">
		<div class="page-content">
			<!-- BEGIN PAGE HEADER-->
			<h3 class="page-title">
			Ubah Kegiatan
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
						<a href="<?php echo site_url('pengaturan/program_kegiatan');?>">Kegiatan</a>
						<i class="fa fa-angle-right"></i>
					</li>
                     <li>
						<a href="#">Ubah</a>
					</li>
				</ul>
			</div>
			
            <div class="note note-warning">
				<p>
					NOTE: Silahkan isi form Kegiatan ini dengan data-data yang valid!. Sesuai dengan arahan dari BAPPEDA Kabupaten Bekasi.
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
								<i class="fa fa-pencil"></i>Ubah Kegiatan
							</div>
						</div>
						<div class="portlet-body form">
							<!-- BEGIN FORM-->
							<form action="<?php echo site_url('pengaturan/program_kegiatan/update/'.$kode);?>" class="horizontal-form" method="post">							
								<input type="hidden" name="kode" value="<?php echo $kode; ?>" />
								<div class="form-body">
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label class="control-label" for="urusan_kode">Urusan<span class="required">*</span> :</label>
												<?php combobox('db', $urusan, 'urusan_kode', 'kode', 'urusan', $urusan_kode, 'show_form_program_by_urusan();', 'Pilih Urusan', 'class="select2_category form-control" tabindex="1" required="required"'); ?>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group" id="tampil_combobox_program">
												<label class="control-label" for="program_kode">Program<span class="required">*</span> :</label>
												<?php combobox('db', $program, 'program_kode', 'kode', 'program', $program_kode, '', 'Pilih Program', 'class="select2_category form-control" required="required"'); ?>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-2">
											<div class="form-group">
												<label class="control-label" for="no">Urutan<span class="required">*</span> :</label>
												<input type="text" class="form-control" name="no" id="no" value="<?php echo $no; ?>" placeholder="" required="required">
											</div>
										</div>
										<div class="col-md-10">
											<div class="form-group">
												<label class="control-label" for="kegiatan">Kegiatan<span class="required">*</span> :</label>
												<input type="text" class="form-control" name="kegiatan" id="kegiatan" value="<?php echo $kegiatan; ?>" placeholder="" required="required">
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
													<a href="<?php echo site_url('pengaturan/program_kegiatan');?>" class="btn default"><i class="fa fa-times"></i> Batal</a>
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
	var site_url = "<?php echo site_url();?>";
	function load(page,div){
		$.ajax({
			url: site_url+page,
			success: function(response){
				$(div).html(response);
			},
		dataType:"html"
		});
		return false;
	}
	
	function show_form_program_by_urusan(){
		var urusan_kode = $('select[name=urusan_kode]').val();
		load('pengaturan/program_kegiatan/tampil_combobox_program/'+urusan_kode, '#tampil_combobox_program');
	}
	
	</script>