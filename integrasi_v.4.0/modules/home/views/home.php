	<section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>HOME</h2>
            </div>
            <!-- Widgets -->
            <div class="row clearfix">			
				<div class="col-lg-5 col-md-7 col-sm-7 col-xs-12">
                    <div class="info-box bg-teal hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">question_answer</i>
                        </div>
                        <div class="content">
                            <div class="text">Kegiatan Musrenbang</div>
							<div class="number count-to" data-from="0" data-to="<?php echo $hasil_musrenbang;?>" data-speed="1000" data-fresh-interval="20"></div>							
                        </div>
                    </div>
                </div>
				<div class="col-lg-5 col-md-7 col-sm-7 col-xs-12">
                    <div class="info-box bg-pink hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">work</i>
                        </div>
                        <div class="content">
                            <div class="text">Kegiatan Musrenbang Diproses SKPD</div>
                            <div class="number count-to" data-from="0" data-to="<?php echo $hasil_musrenbang_proses;?>" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
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