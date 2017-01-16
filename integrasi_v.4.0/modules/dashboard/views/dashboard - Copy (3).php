<section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>DASHBOARD</h2>
            </div>
            <!-- Widgets -->
			<?php if ($admin_log['level_kode'] == 14 || $admin_log['level_kode'] == 15){ ?>
			
            <div class="row clearfix">
				<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                    <div class="info-box bg-pink hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">equalizer</i>
                        </div>
                        <div class="content">
                            <div class="text">Kegiatan</div>
                            <div class="number"><?php echo $jml_kegiatan;?></div>
                        </div>
                    </div>
                </div>
				<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                    <div class="info-box bg-teal hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">event_note</i>
                        </div>
                        <div class="content">
                            <div class="text">Kegiatan yang Diproses</div>
                            <div class="number"><?php echo $jml_kegiatan_proses;?></div>
                        </div>
                    </div>
                </div>		
				<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                    <div class="info-box bg-purple hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">speaker_notes</i>
                        </div>
                        <div class="content">
                            <div class="text">Anggaran Kegiatan yang Diproses</div>
                            <div class="number"><?php echo rupiah($anggaran_kegiatan_proses);?></div>
                        </div>
                    </div>
                </div>
            </div>
			<!-- #END# -->
			<?php } else { ?> 
			<div class="row clearfix">	
				<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                    <div class="info-box-3 bg-light-green hover-zoom-effect">
					<a href="<?php echo site_url('musrenbang/kecamatan');?>">
                        <div class="icon">
                            <i class="material-icons">gps_fixed</i>
                        </div>
                        <div class="content">
                            <div class="text">Musrenbang Kecamatan</div>
                            <div class="number"><?php echo rupiah($musrenbang_kecamatan);?></div>
                        </div>
                    </a>
					</div>
                </div>
				<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                    <div class="info-box-3 bg-cyan hover-zoom-effect">
					<a href="<?php echo site_url('pra-rencana-kerja');?>">
                        <div class="icon">
                            <i class="material-icons">gps_fixed</i>
                        </div>
                        <div class="content">
                            <div class="text">Pra Rencana Kerja</div>
                            <div class="number"><?php echo rupiah($pra_rencana_kerja);?></div>
                        </div>
                    </a>
					</div>
                </div>			
				<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                    <div class="info-box-3 bg-blue hover-zoom-effect">
					<a href="<?php echo site_url('rencana-kerja/murni');?>">
                        <div class="icon">
                            <i class="material-icons">gps_fixed</i>
                        </div>
                        <div class="content">
                            <div class="text"> Rencana Kerja</div>
                            <div class="number"><?php echo rupiah($rencana_kerja);?></div>
                        </div>
					</a>
                    </div>
                </div>
				<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                    <div class="info-box-3 bg-green hover-zoom-effect">
					<a href="<?php echo site_url('musrenbang/kabupaten');?>">
                        <div class="icon">
                            <i class="material-icons">gps_fixed</i>
                        </div>
                        <div class="content">
                            <div class="text"> Musrenbang Kabupaten</div>
                            <div class="number"><?php echo rupiah($musrenbang_kabupaten);?></div>
                        </div>
					</a>
                    </div>
                </div>
				<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                    <div class="info-box-3 bg-purple hover-zoom-effect">
					<a href="<?php echo site_url('rkpd/murni');?>">
                        <div class="icon">
                            <i class="material-icons">gps_fixed</i>
                        </div>
                        <div class="content">
                            <div class="text"> RKPD Kabupaten</div>
                            <div class="number"><?php echo rupiah($rkpd);?></div>
                        </div>
					</a>
                    </div>
                </div>     
				<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                    <div class="info-box-3 bg-deep-purple hover-zoom-effect">
					<a href="<?php echo site_url('kua-ppas/murni');?>">
                        <div class="icon">
                            <i class="material-icons">gps_fixed</i>
                        </div>
                        <div class="content">
                            <div class="text"> KUA & PPAS Kabupaten</div>
                            <div class="number"><?php echo rupiah($kua_ppas);?></div>
                        </div>
					</a>
                    </div>
                </div>
            </div>
			<?php } ?>
    </section>
	<script language="javascript" type="text/javascript">
	function link(anchor){
		document.location.href = '<?php echo site_url('');?>'+anchor;
		return false;
	}
	</script>