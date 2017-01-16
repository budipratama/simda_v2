<!-- BEGIN CONTENT -->
	<div class="page-content-wrapper">
		<div class="page-content">
			<!-- BEGIN PAGE HEADER-->
			<h3 class="page-title">
			Daftar Akses Bidang <small>entri data &amp; informasi detail</small>
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
						<a href="#">Akses Bidang</a>
					</li>
				</ul>
			</div>
            <!-- END PAGE HEADER-->
			<form action="<?php echo site_url('pengaturan/akses_bidang/insert');?>" class="horizontal-form" method="post">
			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN SAMPLE TABLE PORTLET-->
					<div class="portlet box green">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-search"></i>Opsi Akses Bidang
							</div>
						</div>
						<div class="portlet-body form" style="display: block;">
							<!-- BEGIN FORM-->
								<div class="form-body">
									<!--/row-->
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label class="control-label col-md-2">Pilih Bidang</label>
												<div class="col-md-4">
													<?php combobox('db', $admin_level, 'admin_level_kode', 'admin_level_kode', 'admin_level_nama', '', 'show_form_akses_bidang();', 'Pilih Bidang', 'class="select2_category form-control" required="required"'); ?>
												</div>
												<label class="control-label col-md-2">Pilih Lembaga</label>
												<div class="col-md-4">
													<?php combobox('2d', $status, 'skpd_status', '', '', 5, 'show_form_akses_bidang();', 'none', 'class="select2_category form-control" required="required"'); ?>
												</div>
											</div>
										</div>
									</div>
									<!--/row-->
								</div>
							<!-- END FORM-->
						</div>
					</div>
					<!-- END SAMPLE TABLE PORTLET-->
				</div>
			</div>
			<div class="clearfix"></div>
			<?php if ($this->session->flashdata('success')) { echo $this->session->flashdata('success');} ?>
            <?php echo validation_errors(); ?>
            <!-- END PAGE HEADER-->
			<!-- BEGIN FORM -->
			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN SAMPLE TABLE PORTLET-->
					<div class="portlet box blue">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-pencil"></i>Hak Akses Bidang
							</div>
						</div>
						<div class="portlet-body form">
							<!-- BEGIN FORM-->
								<div class="form-body" id="tampil_form_akses_bidang">
									<?php 
									
									if ($skpd){
									$no = 1;
									foreach($skpd as $row){
									?>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label class="control-label" for="skpd_<?php echo $row->skpd_kode; ?>"><input type="checkbox" name="skpd[]" id="skpd_<?php echo $row->skpd_kode; ?>" value="<?php echo $row->skpd_kode; ?>"> <?php echo $row->skpd_nama; ?></label>
											</div>
										</div>
									</div>
									<?php
									}
									}
									?>
								</div>
								
								<div class="form-actions">
									<div class="row">
										<div class="col-md-6">
											<div class="row">
												<div class="col-md-offset-3 col-md-9">
													<button type="submit" class="btn green"><i class="fa fa-check"></i> Simpan Data</button>
													<a href="<?php echo site_url('pengaturan/akses_bidang');?>" class="btn default"><i class="fa fa-times"></i> Batal</a>
												</div>
											</div>
										</div>
										<div class="col-md-6">
										</div>
									</div>
								</div>
								
							
							<!-- END FORM-->
						</div>
					</div>
					<!-- END SAMPLE TABLE PORTLET-->
				</div>
			</div>
			</form>
		</div>
		
	</div>
	<!-- END CONTENT -->
	<script>
	function show_form_akses_bidang(){
		var admin_level_kode = ($('select[name=admin_level_kode]').val() != "")?$('select[name=admin_level_kode]').val():"0";
		var skpd_status = $('select[name=skpd_status]').val();
		load('pengaturan/akses_bidang/tampil_form_akses_bidang/'+admin_level_kode+'/'+skpd_status, '#tampil_form_akses_bidang');
	}
	
	</script>