<section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>DASHBOARD</h2>
            </div>

            <!-- Widgets -->
            <div class="row clearfix">
				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box-3 bg-light-green hover-zoom-effect">
                        <div class="icon">
                            <i class="material-icons">question_answer</i>
                        </div>
                        <div class="content">
                            <div class="text">Musrenbang</div>
                            <div class="number count-to" data-from="0" data-to="<?php echo $hasil_musrenbang;?>" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
				
				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box-3 bg-pink hover-zoom-effect">
                        <div class="icon">
                            <i class="material-icons">playlist_add_check</i>
                        </div>
                        <div class="content">
                            <div class="text">Musrenbang Diproses SKPD</div>
                            <div class="number count-to" data-from="0" data-to="<?php echo $hasil_musrenbang_proses;?>" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
				
				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box-3 bg-cyan hover-zoom-effect">
                        <div class="icon">
                            <i class="material-icons">question_answer</i>
                        </div>
                        <div class="content">
                            <div class="text">Musrenbang Disetujui</div>
                            <div class="number count-to" data-from="0" data-to="<?php echo $hasil_musrenbang;?>" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
				
				

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
            <!-- #END# Widgets -->
            <!-- CPU Usage -->
       
                <!-- #END# Browser Usage -->
            </div>

    </section>
	<script language="javascript" type="text/javascript">
	function link(anchor){
		document.location.href = '<?php echo site_url('');?>'+anchor;
		return false;
	}
	</script>