<!-- BEGIN CONTENT -->
	<div class="page-content-wrapper">
		<div class="page-content">
			<!-- BEGIN PAGE HEADER-->
			<h3 class="page-title">
			Daftar Hak Akses <small>entri data &amp; informasi detail</small>
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
						<a href="#">Hak Akses</a>
					</li>
				</ul>
			</div>
			<?php if ($this->session->flashdata('success')) { echo $this->session->flashdata('success');} ?>
            <?php echo validation_errors(); ?>
            <!-- END PAGE HEADER-->
			<form action="<?php echo site_url('pengaturan/hak-akses/insert');?>" class="horizontal-form" method="post">
			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN SAMPLE TABLE PORTLET-->
					<div class="portlet box green">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-search"></i>Opsi Hak Akses
							</div>
						</div>
						<div class="portlet-body form" style="display: block;">
							<!-- BEGIN FORM-->
								<div class="form-body">
									<!--/row-->
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label class="control-label col-md-3">Pilih Kelompok Pengguna</label>
												<div class="col-md-3">
													<?php combobox('db', $admin_level, 'admin_level_kode', 'admin_level_kode', 'admin_level_nama', '', 'show_form_hak_akses();', 'Pilih Kelompok Pengguna', 'class="select2_category form-control" required="required"'); ?>
												</div>
												<label class="control-label col-md-3">Pilih Menu Utama</label>
												<div class="col-md-3">
													<?php combobox('db', $menu, 'menu_subkode', 'menu_kode', 'menu_nama', '', 'show_form_hak_akses();', 'Menu Utama', 'class="select2_category form-control"'); ?>
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
            <!-- END PAGE HEADER-->
			<!-- BEGIN FORM -->
			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN SAMPLE TABLE PORTLET-->
					<div class="portlet box blue">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-pencil"></i>Hak Hak Akses
							</div>
						</div>
						<div class="portlet-body form">
							<!-- BEGIN FORM-->
								<div class="form-body" id="tampil_form_hak_akses">
									<?php 
									if ($menu){
									$no = 1;
									foreach($menu as $row){
									?>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label class="control-label" for="menu_<?php echo $row->menu_kode; ?>"><input type="checkbox" name="menu[]" id="menu_<?php echo $row->menu_kode; ?>" value="<?php echo $row->menu_kode; ?>"> <?php echo $row->menu_nama; ?></label>
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
													<a href="<?php echo site_url('pengaturan/hak_akses');?>" class="btn default"><i class="fa fa-times"></i> Batal</a>
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
	function show_form_hak_akses(){
		var admin_level_kode = ($('select[name=admin_level_kode]').val() != "")?$('select[name=admin_level_kode]').val():"0";
		var menu_subkode = $('select[name=menu_subkode]').val();
		load('pengaturan/hak_akses/tampil_form_hak_akses/'+admin_level_kode+'/'+menu_subkode, '#tampil_form_hak_akses');
	}
	
	</script>