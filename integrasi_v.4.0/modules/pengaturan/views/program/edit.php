<!-- Main Content -->
   <section class="content">
		<h2>Edit Program <small>entri data &amp; informasi detail</small></h2>
			<div class="body">
				<ol class="breadcrumb breadcrumb-col-cyan">
					<li><a href="<?php echo site_url('dashboard');?>"><i class="material-icons">home</i> Home</a></li>
					<li><a href="<?php echo site_url('pengaturan');?>"> Control Panel</a></li>
					<li class="active"> Edit Program</li>
				</ol>
			</div>
            <!-- Multiple Items To Be Open -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header bg-teal">
						<h2>Control Panel<small>Data Program</small></h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="<?php echo site_url('pengaturan/program');?>"><i class="material-icons">reply</i> Kembali</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <div class="row clearfix">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
									<form action="<?php echo site_url('pengaturan/program/update/'.$kode);?>" class="horizontal-form" method="post">							
										<input type="hidden" name="kode" value="<?php echo $kode; ?>" />
										<div class="form-body">
											<div class="row">
												<div class="col-md-12">
													<div class="form-group">
														<label class="control-label" for="urusan_kode">Urusan <span class="required">*</span> :</label>
														<?php combobox('db', $urusan, 'urusan_kode', 'kode', 'urusan', $urusan_kode, '', 'Pilih Urusan', 'class="select2_category form-control" tabindex="1" required="required"'); ?>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-2">
													<div class="form-group">
														<label class="control-label" for="nomor">Nomor <span class="required">*</span> :</label>
														<input type="text" class="form-control" name="nomor" id="nomor" value="<?php echo $nomor; ?>" placeholder="" required="required">
													</div>
												</div>
												<div class="col-md-10">
													<div class="form-group">
														<label class="control-label" for="program">Program <span class="required">*</span> :</label>
														<input type="text" class="form-control" name="program" id="program" value="<?php echo $program; ?>" placeholder="" required="required">
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-12">
													<div class="form-group">
														<label class="control-label" for="hasil_program">Hasil Program <span class="required">*</span> :</label>
														<input type="text" class="form-control" name="hasil_program" id="hasil_program" value="<?php echo $hasil_program; ?>" placeholder="" required="required">
													</div>
												</div>
											</div>
										</div>
										<div class="form-actions">
											<div class="row">
												<div class="col-md-offset-6 col-md-6">
													<button type="submit" class="btn btn-primary waves-effect"> Simpan Data</button>
													<a href="<?php echo site_url('pengaturan/program');?>" class="btn btn-default waves-effect">Batal</a>
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