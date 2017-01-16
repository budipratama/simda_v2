<!-- BEGIN CONTENT -->
	<div class="page-content-wrapper">
		<div class="page-content">
			<!-- BEGIN PAGE HEADER-->
			<h3 class="page-title">
			Tambah Menu
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
						<a href="<?php echo site_url('pengaturan/menu');?>">Menu</a>
						<i class="fa fa-angle-right"></i>
					</li>
                     <li>
						<a href="#">Tambah</a>
					</li>
				</ul>
			</div>
			
            <div class="note note-warning">
				<p>
					NOTE: Silahkan isi form Menu ini dengan data-data yang valid!. Sesuai dengan arahan dari BAPPEDA Kabupaten Bekasi.
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
								<i class="fa fa-pencil"></i>Tambah Menu
							</div>
						</div>
						<div class="portlet-body form">
							<!-- BEGIN FORM-->
							<form action="<?php echo site_url('pengaturan/menu/insert');?>" class="horizontal-form" method="post">
								<div class="form-body">
									<div class="row">
										<div class="col-md-2">
											<div class="form-group">
												<label class="control-label" for="menu_level">Level Menu<span class="required">*</span> :</label>
                                                <!-- combobox('jenis=db,1d,2d', 'array', 'name', 'value', 'value_name', 'selected', 'js', 'label', 'script') -->
												<?php combobox('1d', $level, 'menu_level', '', '', '', 'show_form_menu_subkode();', 'none', 'class="select2_category form-control" tabindex="1" required="required" autofocus'); ?>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-8">
											<div class="form-group">
												<label class="control-label" for="menu_nama">Menu Nama<span class="required">*</span> :</label>
												<input type="text" class="form-control" name="menu_nama" id="menu_nama" placeholder="" required="requiredss">
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label class="control-label" for="menu_deskripsi">Deskripsi :</label>
												<input type="text" class="form-control" name="menu_deskripsi" id="menu_deskripsi" placeholder="">
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label" for="menu_url">URL<span class="required">*</span> :</label>
												<input type="text" class="form-control" name="menu_url" id="menu_url" placeholder="" required="required">
											</div>
										</div>
										<div class="col-md-2">
											<div class="form-group">
												<label class="control-label" for="menu_urutan">Urutan<span class="required">*</span> :</label>
												<input type="text" class="form-control" name="menu_urutan" id="menu_urutan" placeholder="" required="required">
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label class="control-label" for="menu_icon">Icon :</label>
												<input type="text" class="form-control" name="menu_icon" id="menu_icon" placeholder="">
											</div>
										</div>
									</div>
									<div class="row" id="tampil_combobox_menu_subkode">
									</div>
								</div>
								
								<div class="form-actions">
									<div class="row">
										<div class="col-md-6">
											<div class="row">
												<div class="col-md-offset-3 col-md-9">
													<button type="submit" class="btn green"><i class="fa fa-check"></i> Simpan Data</button>
													<a href="<?php echo site_url('pengaturan/menu');?>" class="btn default"><i class="fa fa-times"></i> Batal</a>
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
	function show_form_menu_subkode(){
		var menu_level = $('select[name=menu_level]').val();
		load('pengaturan/menu/tampil_combobox_menu_subkode/'+menu_level, '#tampil_combobox_menu_subkode');
	}
	
	</script>