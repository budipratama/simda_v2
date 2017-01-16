<!-- Main Content -->
            <div class="container-fluid">
                <div class="side-body padding-top">
				<h3 class="page-title">Dashboard <small> reports & statistics</small></h3>
					<div class="row">
                        <div class="col-xs-12">
							<div class="bs-example">
								<ol class="breadcrumb">
									<li class="active"><i class="fa fa-home"></i> <a href="<?php echo site_url('dashboard');?>"> Home</a></li>
									<li class="active"><a href="#"> Dashboard</a></li>
								</ol>
							</div>
                        </div>
                    </div>
					<?php if ($admin_log['level_kode'] == 14 || $admin_log['level_kode'] == 15){ ?>				
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
								<font size="5" face="verdana" color=""><?php echo $jml_kegiatan_proses;?></font>
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
								<font size="5" face="verdana" color=""><?php echo rupiah($anggaran_kegiatan_proses);?></font>
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
			<?php } else { ?>
					<br><div class="row">
                        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                            <a href="<?php echo site_url('musrenbang/kecamatan');?>">
                                <div class="card blue summary-inline">
                                    <div class="card-body">
                                        <i class="icon fa fa-comments fa-4x"></i>
                                        <div class="content">
                                            <div class="title"><font size="5" face="verdana" color=""><?php echo rupiah($musrenbang_kecamatan);?></font></div>
                                            <div class="sub-title">Musrenbang Kecamatan</div>
                                        </div>
                                        <div class="clear-both"></div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                            <a href="<?php echo site_url('pra-rencana-kerja');?>">
                                <div class="card green summary-inline">
                                    <div class="card-body">
										<i class="icon fa fa-edit fa-4x"></i>                                        
                                        <div class="content">
                                            <div class="title"><font size="5" face="verdana" color=""><?php echo rupiah($pra_rencana_kerja);?></font></div>
                                            <div class="sub-title">Pra Rencana Kerja</div>
                                        </div>
                                        <div class="clear-both"></div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                            <a href="<?php echo site_url('rencana-kerja/murni');?>">
                                <div class="card green summary-inline">
                                    <div class="card-body">
                                        <i class="icon fa fa-tags fa-4x"></i>
                                        <div class="content">
                                            <div class="title"><font size="5" face="verdana" color=""><?php echo rupiah($rencana_kerja);?></font></div>
                                            <div class="sub-title">Rencana Kerja</div>
                                        </div>
                                        <div class="clear-both"></div>
                                    </div>
                                </div>
                            </a>
                        </div>
						
						<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                            <a href="<?php echo site_url('musrenbang/kabupaten');?>">
                                <div class="card blue summary-inline">
                                    <div class="card-body">
                                        <i class="icon fa fa-inbox fa-4x"></i>
                                        <div class="content">
                                            <div class="title"><font size="5" face="verdana" color=""><?php echo rupiah($musrenbang_kabupaten);?></font></div>
                                            <div class="sub-title">Musrenbang Kabupaten</div>
                                        </div>
                                        <div class="clear-both"></div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                            <a href="<?php echo site_url('rkpd/murni');?>">
                                <div class="card yellow summary-inline">
                                    <div class="card-body">
										<i class="icon fa fa-dropbox fa-4x"></i>                                        
                                        <div class="content">
                                            <div class="title"><font size="5" face="verdana" color=""><?php echo rupiah($rkpd);?></font></div>
                                            <div class="sub-title">RKPD Kabupaten</div>
                                        </div>
                                        <div class="clear-both"></div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                            <a href="<?php echo site_url('kua-ppas/murni');?>">
                                <div class="card red summary-inline">
                                    <div class="card-body">
                                        <i class="icon fa fa-legal fa-4x"></i>
                                        <div class="content">
                                            <div class="title"><font size="5" face="verdana" color=""><?php echo rupiah($kua_ppas);?></font></div>
                                            <div class="sub-title">KUA & PPAS Kabupaten</div>
                                        </div>
                                        <div class="clear-both"></div>
                                    </div>
                                </div>
                            </a>
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
										<span class="label label-sm label-green">
										Pra Rencana Kerja : </span>
										<h3>0 Kegiatan</h3>
									</div>
									<div class="col-md-2 col-sm-2 col-xs-6 text-stat">
										<span class="label label-sm label-green">
										Rencana Kerja : </span>
										<h3>0 Kegiatan</h3>
									</div>
									<div class="col-md-2 col-sm-2 col-xs-6 text-stat">
										<span class="label label-sm label-blue">
										Musrenbang Kabupaten : </span>
										<h3>0 Kegiatan</h3>
									</div>
									<div class="col-md-2 col-sm-2 col-xs-6 text-stat">
										<span class="label label-sm label-gold">
										RKPD Kabupaten : </span>
										<h3>0 Kegiatan</h3>
									</div>
									<div class="col-md-2 col-sm-2 col-xs-6 text-stat">
										<span class="label label-sm label-red">
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
        </div>