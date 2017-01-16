<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
	<div class="page-content">
			<!-- BEGIN PAGE HEADER-->
			
	<div class="row">
	<div id="breadcrumb" <div class="page-bar">>
		<a href="#" class="show-sidebar">
			<i class="fa fa-bars"></i>
		</a>
		<ol class="breadcrumb pull-left">
			<li><a href="<?php echo site_url('dashboard');?>">Home</a></li>
			<li><a href="#">Dashboard</a></li>
		</ol>
	</div>
	</div>
	
			<h3 class="page-title">
			Dashboard <small>reports & statistics</small>
			</h3>
            <!-- ALERT WARNING
			<div class="alert alert-warning fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><i class="fa-lg fa fa-warning"></i> Peringatan, Ini hanya contoh dashboard. Data ini hanya sebagai gambaran saja untuk kedepannya dan belum menggunakan data real.</div>
			-->
            <!-- END PAGE HEADER-->
			
			<!-- BEGIN DASHBOARD STATS -->
			<?php
			if ($admin_log['level_kode'] == 14 || $admin_log['level_kode'] == 15){
			?>
			<div class="row">
				<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
					<div class="dashboard-stat blue">
						<div class="visual">
							<i class="fa fa-book"></i>
						</div>
						<div class="details">
							<div class="number">
								<?php echo $jml_kegiatan;?>
							</div>
							<div class="desc">
								Kegiatan 
							</div>
						</div>
						<a class="more" href="#">
						&nbsp;<i class="m-icon-swapright m-icon-white"></i>
						</a>
					</div>
				</div>
				<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
					<div class="dashboard-stat red">
						<div class="visual">
							<i class="fa fa-edit"></i>
						</div>
						<div class="details">
							<div class="number">
								<?php echo $jml_kegiatan_proses;?>
							</div>
							<div class="desc">
								Kegiatan yang Diproses
							</div>
						</div>
						<a class="more" href="#">
						&nbsp;<i class="m-icon-swapright m-icon-white"></i>
						</a>
					</div>
				</div>
				<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
					<div class="dashboard-stat yellow">
						<div class="visual">
							<i class="fa fa-suitcase"></i>
						</div>
						<div class="details">
							<div class="number">
								<?php echo rupiah($anggaran_kegiatan_proses);?>
							</div>
							<div class="desc">
								Anggaran Kegiatan yang Diproses
							</div>
						</div>
						<a class="more" href="#">
						&nbsp;<i class="m-icon-swapright m-icon-white"></i>
						</a>
					</div>
				</div>
			</div>
			<?php
			} else {
			?>
			<br><div class="row">
					<div class="col-xs-12">
						<div class="row">
							<div class="col-xs-12">
								<div id="ow-summary" class="row">
									<div class="col-xs-12">
									<div class="row">
									<div class="col-xs-12">
										<div class="row">
											<div class="col-xs-4"><a class="more" href="<?php echo site_url('musrenbang/kecamatan');?>">
											Musrenbang Kecamatan<i class="m-icon-swapright m-icon-white"></i>
											</a><b><?php echo rupiah($musrenbang_kecamatan);?></b></div>
											<div class="col-xs-4"><a class="more" href="<?php echo site_url('musrenbang/kabupaten');?>">
											Musrenbang Kabupaten <i class="m-icon-swapright m-icon-white"></i>
											</a><b><?php echo rupiah($musrenbang_kabupaten);?></b></div>
										</div>
										<div class="row">
											<div class="col-xs-4"><a class="more" href="<?php echo site_url('rencana-kerja/murni');?>">
											Rencana Kerja <i class="m-icon-swapright m-icon-white"></i>
											</a><b><?php echo rupiah($rencana_kerja);?></b></div>
											<div class="col-xs-4"><a class="more" href="<?php echo site_url('pra-rencana-kerja');?>">
											Pra Rencana Kerja <i class="m-icon-swapright m-icon-white"></i>
											</a><b><?php echo rupiah($pra_rencana_kerja);?></b></div>
										</div>
										<div class="row">
											<div class="col-xs-4"><a class="more" href="<?php echo site_url('rkpd/murni');?>">
											RKPD Kabupaten <i class="m-icon-swapright m-icon-white"></i>
											</a><b><?php echo rupiah($rkpd);?></b></div>
											<div class="col-xs-4"><a class="more" href="<?php echo site_url('kua-ppas/murni');?>">
											KUA & PPAS Kabupaten <i class="m-icon-swapright m-icon-white"></i>
											</a><b><?php echo rupiah($kua_ppas);?></b></div>
										</div>
									</div>
									</div>
									</div>
								</div>
							</div>
						</div>
					</div>
			</div>
			<!-- END DASHBOARD STATS -->
			<div class="clearfix">
			</div><br>
			<div class="row">
				<div class="col-md-12 col-sm-12">
					<!-- BEGIN PORTLET-->
					<div class="portlet solid grey-cararra bordered">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-bar-chart-o"></i>Rencana Kerja Pembangunan Tahun 2016
							</div>
						</div>
						<div class="portlet-body">
							<div id="site_activities_loading">
								<img src="<?php echo base_url('public/templates/rkpd_v.4.0/admin/layout/img/loading.gif');?>" alt="Loading..."/>
							</div>
							<div id="site_activities_content" class="display-none">
								<div id="site_activities" style="height: 428px;">
								</div>
							</div>
							<div style="margin: 20px 0 10px 30px">
								<div class="row">
									<div class="col-md-2 col-sm-2 col-xs-6 text-stat">
										<span class="label label-sm label-blue">
										Musrenbang Kecamatan : </span>
										<h3>0 Kegiatan</h3>
									</div>
									<div class="col-md-2 col-sm-2 col-xs-6 text-stat">
										<span class="label label-sm label-red">
										Pra Rencana Kerja : </span>
										<h3>0 Kegiatan</h3>
									</div>
									<div class="col-md-2 col-sm-2 col-xs-6 text-stat">
										<span class="label label-sm label-yellow">
										Rencana Kerja : </span>
										<h3>0 Kegiatan</h3>
									</div>
									<div class="col-md-2 col-sm-2 col-xs-6 text-stat">
										<span class="label label-sm label-green">
										Musrenbang Kabupaten : </span>
										<h3>0 Kegiatan</h3>
									</div>
									<div class="col-md-2 col-sm-2 col-xs-6 text-stat">
										<span class="label label-sm label-gold">
										RKPD Kabupaten : </span>
										<h3>0 Kegiatan</h3>
									</div>
									<div class="col-md-2 col-sm-2 col-xs-6 text-stat">
										<span class="label label-sm label-purple">
										KUA &amp; PPAS Kabupaten: </span>
										<h3>0 Kegiatan</h3>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- END PORTLET-->
				</div>
			</div>
			<?php } ?>
		</div>
		
	</div>
	<!-- END CONTENT -->