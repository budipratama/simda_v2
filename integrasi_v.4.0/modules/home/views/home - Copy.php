<!-- Main Content -->
            <div class="container-fluid">
                <div class="side-body padding-top">
				<h3 class="page-title">Selamat Datang <small>di Sistem Informasi Integrasi Online Kabupaten Bekasi</small></h3>
				
					<div class="row">
                        <div class="col-xs-12">
							<div class="bs-example">
								<ol class="breadcrumb">
									<li class="active"><i class="fa fa-home"></i> <a href="<?php echo site_url();?>"> Home</a></li>
									<li class="active"><a href="#">Selamat Datang</a></li>
								</ol>
							</div><br>
							<div class="alert alert-info" role="alert">
								Sistem Informasi Integrasi ini dikembangkan oleh Pemda Kabupaten Bekasi untuk meningkatkan kualitas Sistem Perencanaan Tahunan Kabupaten Bekasi yang berbasis Hasil Musrenbang, Rencana Kerja Satuan Kerja Perangkat Daerah (Renja SKPD) dan Usulan Masyarakat di Kabupaten Bekasi.
							</div>
                        </div>
                    </div>
									
                    <div class="row">
                        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                            <a href="#">
                                <div class="card yellow summary-inline">
                                    <div class="card-body">
                                        <i class="icon fa fa-comments fa-4x"></i>
                                        <div class="content">
                                            <div class="title"><font size="5" face="comic sans ms" color=""><?php echo rupiah2($hasil_musrenbang);?> Kegiatan</font></div>
                                            <div class="sub-title">Hasil Musrenbang</div>
                                        </div>
                                        <div class="clear-both"></div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                            <a href="#">
                                <div class="card green summary-inline">
                                    <div class="card-body">
										<i class="icon fa fa-inbox fa-4x"></i>                                        
                                        <div class="content">
                                            <div class="title"><font size="5" face="verdana" color=""><?php echo rupiah2($hasil_musrenbang_proses);?> Kegiatan</font></div>
                                            <div class="sub-title">Hasil Musrenbang Diproses SKPD</div>
                                        </div>
                                        <div class="clear-both"></div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                            <a href="#">
                                <div class="card blue summary-inline">
                                    <div class="card-body">
                                        <i class="icon fa fa-tags fa-4x"></i>
                                        <div class="content">
                                            <div class="title"><font size="5" face="verdana" color=""><?php echo rupiah(0);?></font></div>
                                            <div class="sub-title">Hasil Musrenbang Disetujui</div>
                                        </div>
                                        <div class="clear-both"></div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<!-- END CONTENT -->
	<script language="javascript" type="text/javascript">
	function link(anchor){
		document.location.href = '<?php echo site_url('');?>'+anchor;
		return false;
	}
	</script>		