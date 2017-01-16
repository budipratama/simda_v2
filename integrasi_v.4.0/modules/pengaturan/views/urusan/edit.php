<!-- Main Content -->
   <section class="content">
		<h2>Detail Urusan <small>entri data &amp; informasi detail</small></h2>  
			<div class="body">
				<ol class="breadcrumb breadcrumb-col-cyan">
					<li><a href="<?php echo site_url('dashboard');?>"><i class="material-icons">home</i> Home</a></li>
					<li><a href="<?php echo site_url('pengaturan');?>"> Control Panel</a></li>
					<li class="active"> Detail Urusan</li>
				</ol>
			</div>
            <!-- Multiple Items To Be Open -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header bg-teal">
						<h2>Control Panel<small>Data Urusan</small></h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="<?php echo site_url('pengaturan/urusan');?>"><i class="material-icons">reply</i> Kembali</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <div class="row clearfix">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
									<form action="<?php echo site_url('pengaturan/urusan/update/'.$kode);?>" class="horizontal-form" method="post">							
									<input type="hidden" name="kode" value="<?php echo $kode; ?>" />
										<div class="form-body">
											<div class="row">
												<div class="col-md-12">
													<div class="form-group">
													<div class="col-md-6">
														<p><b>Jenis Urusan <span class="required">*</span> :</b></p>
														<?php combobox('db', $urusan, 'bbb_kode', 'kode', 'nm_urusan', $kd_urusan, '', 'Pilih Urusan', 'class="form-control show-tick" data-live-search="true" tabindex="1" required="required"'); ?>
													</div>
													<div class="col-md-6">
														<p><b>Fungsi <span class="required">*</span> :</b></p>
															<?php combobox('db', $fungsi, 'fungsi', 'kode', 'nm_fungsi', $kd_fungsi, '', 'Pilih Fungsi', 'class="form-control show-tick" data-live-search="true" tabindex="1" required="required"'); ?>
													</div>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-2">
													<div class="form-group form-float">
													<div class="form-line">
														<label class="control-label" for="nomor">Nomor <span class="required">*</span> :</label>
														<input type="text" class="form-control" name="nomor" id="nomor" value="<?php echo $nomor; ?>" placeholder="" required="required">
													</div>
													</div>
												</div>
												<div class="col-md-10">
													<div class="form-group form-float">
													<div class="form-line">
														<label class="control-label" for="urusan">Urusan <span class="required">*</span> :</label>
														<input type="text" class="form-control" name="urusan" id="urusan" value="<?php echo $nm_urusan; ?>" placeholder="" required="required">
													</div>
													</div>
												</div>
											</div>
										</div>
										<div class="form-actions">
											<div class="row">
												<div class="col-md-offset-6 col-md-6">
													<button type="submit" class="btn btn-primary waves-effect"> Simpan Data</button>
													<a href="<?php echo site_url('pengaturan/urusan');?>" class="btn default"> Batal</a>
												</div>
											</div>
										</div>
									</form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
		<!-- #END# Tabs With Custom Animations -->
    </section>
<!-- END Main Content -->