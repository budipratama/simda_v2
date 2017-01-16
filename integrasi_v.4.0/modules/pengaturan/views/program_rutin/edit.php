<!-- Main Content -->
   <section class="content">
		<h2>Anggaran Urusan Rutin <small>entri data &amp; informasi detail</small></h2>  
			<div class="body">
				<ol class="breadcrumb breadcrumb-col-cyan">
					<li><a href="<?php echo site_url('dashboard');?>"><i class="material-icons">home</i> Home</a></li>
					<li><a href="<?php echo site_url('pengaturan');?>"> Control Panel</a></li>
					<li class="active"> Anggaran Urusan Rutin</li>
				</ol>
			</div>
            <!-- Multiple Items To Be Open -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header bg-teal">
						<h2>Control Panel<small> Anggaran Urusan Rutin</small></h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="<?php echo site_url('pengaturan');?>"><i class="material-icons">reply</i> Kembali</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <div class="row clearfix">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <div class="tab-content">
									<?php if ($this->session->flashdata('success')) { echo $this->session->flashdata('success');} ?>
									<?php echo validation_errors(); ?>
									<form action="<?php echo site_url('pengaturan/program_rutin/update/'.$kode);?>" class="horizontal-form" method="post">							
										<input type="hidden" name="kode" value="<?php echo $kode; ?>"/>
										<div class="form-body">
											<h3 class="form-section">Anggaran Murni</h3>
											<div class="row">
												<div class="col-md-4">
													<div class="form-group form-group-sm">
														<div class="form-line">
															<label class="control-label" for="anggaran2013">Tahun 2013 <span class="required">*</span> :</label>													
															<input type="text" class="form-control" name="anggaran2013" id="anggaran2013" value="<?php echo $anggaran2013; ?>" onkeypress="return isNumber(event)" style="text-align:right;" placeholder="" required="required">
														</div>
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group form-group-sm">
														<div class="form-line">
															<label class="control-label" for="anggaran2014">Tahun 2014 <span class="required">*</span> :</label>
															<input type="text" class="form-control" name="anggaran2014" id="anggaran2014" value="<?php echo $anggaran2014; ?>" onkeypress="return isNumber(event)" style="text-align:right;" placeholder="" required="required">
														</div>
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group form-group-sm">
														<div class="form-line">
															<label class="control-label" for="anggaran2015">Tahun 2015 <span class="required">*</span> :</label>
															<input type="text" class="form-control" name="anggaran2015" id="anggaran2015" value="<?php echo $anggaran2015; ?>" onkeypress="return isNumber(event)" style="text-align:right;" placeholder="" required="required">
														</div>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-4">
													<div class="form-group form-group-sm">
														<div class="form-line">
															<label class="control-label" for="anggaran2016">Tahun 2016 <span class="required">*</span> :</label>
															<input type="text" class="form-control" name="anggaran2016" id="anggaran2016" value="<?php echo $anggaran2016; ?>" onkeypress="return isNumber(event)" style="text-align:right;" placeholder="" required="required">
														</div>
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group form-group-sm">
														<div class="form-line">
															<label class="control-label" for="anggaran2017">Tahun 2017 <span class="required">*</span> :</label>
															<input type="text" class="form-control" name="anggaran2017" id="anggaran2017" value="<?php echo $anggaran2017; ?>" onkeypress="return isNumber(event)" style="text-align:right;" placeholder="" required="required">
														</div>
													</div>
												</div>
											</div>
											
											<h3 class="form-section">Anggaran Perubahan</h3>
											<div class="row">
												<div class="col-md-4">
													<div class="form-group form-group-sm">
														<div class="form-line">
															<label class="control-label" for="reanggaran2013">Tahun 2013 <span class="required">*</span> :</label>
															<input type="text" class="form-control" name="reanggaran2013" id="reanggaran2013" value="<?php echo $reanggaran2013; ?>" onkeypress="return isNumber(event)" style="text-align:right;" placeholder="">
														</div>
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group form-group-sm">
														<div class="form-line">
															<label class="control-label" for="reanggaran2014">Tahun 2014 <span class="required">*</span> :</label>
															<input type="text" class="form-control" name="reanggaran2014" id="reanggaran2014" value="<?php echo $reanggaran2014; ?>" onkeypress="return isNumber(event)" style="text-align:right;" placeholder="">
														</div>
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group form-group-sm">
														<div class="form-line">
															<label class="control-label" for="reanggaran2015">Tahun 2015 <span class="required">*</span> :</label>
															<input type="text" class="form-control" name="reanggaran2015" id="reanggaran2015" value="<?php echo $reanggaran2015; ?>" onkeypress="return isNumber(event)" style="text-align:right;" placeholder="">
														</div>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-4">
													<div class="form-group form-group-sm">
														<div class="form-line">
															<label class="control-label" for="reanggaran2016">Tahun 2016 <span class="required">*</span> :</label>
															<input type="text" class="form-control" name="reanggaran2016" id="reanggaran2016" value="<?php echo $reanggaran2016; ?>" onkeypress="return isNumber(event)" style="text-align:right;" placeholder="">
														</div>
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group form-group-sm">
														<div class="form-line">
															<label class="control-label" for="reanggaran2017">Tahun 2017 <span class="required">*</span> :</label>
															<input type="text" class="form-control" name="reanggaran2017" id="reanggaran2017" value="<?php echo $reanggaran2017; ?>" onkeypress="return isNumber(event)" style="text-align:right;" placeholder="">
														</div>
													</div>
												</div>
											</div>
										</div>
										
										<div class="form-actions">
											<div class="row">
												<div class="col-md-6">
													<div class="row">
														<div class="col-md-offset-3 col-md-9">
															<button type="submit" class="btn btn-primary waves-effect">Simpan Data</button>
															<a href="<?php echo site_url('pengaturan');?>" class="btn default">Batal</a>
														</div>
													</div>
												</div>
												<div class="col-md-6">
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
            </div>
		<!-- #END# Tabs With Custom Animations -->
    </section>
<!-- END Main Content -->