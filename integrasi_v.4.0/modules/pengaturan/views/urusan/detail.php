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
									<form class="form-horizontal" role="form">							
										<div class="form-body">
											<div class="row">
												<div class="col-md-12">
													<div class="form-group">
													<div class="col-md-2">
														<p><b>Jenis Urusan :</b></p>
														<p class="form-control-static"><?php echo $kd_urusan;?></p>
													</div>
													<div class="col-md-6">
														<p><b>Fungsi :</b></p>
														<p class="form-control-static"><?php echo $kd_fungsi;?></p>
													</div>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-12">
													<div class="form-group">
													<div class="col-md-2">
														<p><b>Nomor Urusan :</b></p>
														<p class="form-control-static"><?php echo $nomor;?></p>
													</div>
													<div class="col-md-10">
														<p><b>Nama Urusan :</b></p>
														<p class="form-control-static"><?php echo $nm_urusan;?></p>
													</div>
													</div>
												</div>
											</div>
										</div>
										<div class="form-actions">
											<div class="row">
												<div class="col-md-offset-6 col-md-6">
													<a href="<?php echo site_url('pengaturan/urusan/edit/'.$kode);?>" class="btn btn-primary waves-effect">Ubah Data</a>
													<a href="<?php echo site_url('pengaturan/urusan');?>" class="btn btn-default waves-effect">Kembali</a>
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