<!-- Main Content -->
<div class="container-fluid">
	<div class="side-body padding-top">
		<h3 class="page-title">Control Panel <small>indikator</small></h3>
		<div class="row">
            <div class="col-xs-12">
				<div class="bs-example">
					<ol class="breadcrumb">
						<li class="active"><i class="fa fa-home"></i> <a href="<?php echo site_url('dashboard');?>">Home</a></li>
						<li class="active"><a href="<?php echo site_url('pengaturan');?>">Control Panel</a></li>
						<li class="active"><a href="<?php echo site_url('pengaturan/indikator');?>">Indikator</a></li>
					</ol>
				</div>
            </div>
        </div>
<!-- END PAGE HEADER-->
			<!-- BEGIN FORM -->
			<div class="panel panel-success">
				<div class="panel-heading"><i class="fa fa-gears"></i> Pengaturan Sistem Informasi Integrasi</div>
				<div class="panel-body">
				<div class="portlet-body" style="display: block;">
							<form class="form-horizontal" role="form">							
								<div class="form-body">									
										<div class="col-md-12">
											<div class="form-group">
												<label class="control-label col-md-2" for="tujuan_nama">Tujuan :</label>
												<div class="col-md-10">
                                                	<p class="form-control-static"><?php echo $tujuan_nama;?></p>
                                                </div>
											</div>
										</div>								
										<div class="col-md-12">
											<div class="form-group">
												<label class="control-label col-md-2" for="sasaran_nama">Sasaran :</label>
												<div class="col-md-10">
                                                	<p class="form-control-static"><?php echo $sasaran_nama;?></p>
                                                </div>
											</div>
										</div>								
										<div class="col-md-12">
											<div class="form-group">
												<label class="control-label col-md-2" for="indikator">Indikator :</label>
												<div class="col-md-10">
                                                	<p class="form-control-static"><?php echo $indikator;?></p>
                                                </div>
											</div>										
										</div>
									
									<h3 class="form-section">Anggaran Murni</h3>
									<div class="row">
										<div class="col-md-11">
											<div class="form-group">
												<label class="control-label col-md-2" for="tahun2013">Tahun 2013 : <?php echo $tahun2013;?></label>
												<label class="control-label col-md-2" for="tahun2014">Tahun 2014 : <?php echo $tahun2014;?></label>
												<label class="control-label col-md-2" for="tahun2015">Tahun 2015 : <?php echo $tahun2015;?></label>
												<label class="control-label col-md-2" for="tahun2016">Tahun 2016 : <?php echo $tahun2016;?></label>
												<label class="control-label col-md-2" for="tahun2017">Tahun 2017 : <?php echo $tahun2017;?></label>
											</div>
										</div>								
									</div>
									<h3 class="form-section">Anggaran Perubahan</h3>
									<div class="row">
										<div class="col-md-11">
											<div class="form-group">
												<label class="control-label col-md-2" for="retahun2013">Tahun 2013 : <?php echo $retahun2013;?></label>
												<label class="control-label col-md-2" for="retahun2014">Tahun 2014 : <?php echo $retahun2014;?></label>
												<label class="control-label col-md-2" for="retahun2015">Tahun 2015 : <?php echo $retahun2015;?></label>
												<label class="control-label col-md-2" for="retahun2016">Tahun 2016 : <?php echo $retahun2016;?></label>
												<label class="control-label col-md-2" for="retahun2017">Tahun 2017 : <?php echo $retahun2017;?></label>
											</div>
										</div>								
									</div>									
								</div>
								<div class="form-actions">
									<div class="row">
										<div class="col-md-6">
											<div class="row">
												<div class="col-md-offset-3 col-md-9">
													<a href="<?php echo site_url('pengaturan/indikator/edit/'.$kode);?>" class="btn btn-success"><i class="fa fa-pencil"></i> Ubah Data</a>
													<a href="<?php echo site_url('pengaturan/indikator');?>" class="btn btn-default"><i class="fa fa-reply"></i> Kembali</a>
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
			<!-- END SAMPLE TABLE PORTLET-->
	</div>
</div>