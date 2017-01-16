<!-- Main Content -->
<?php $first = ""; $last = ""; $hasil = ""; if(isset($_POST["Hitung"])) { if(isset($_POST["first"])) $first = $_POST["first"]; else $first = 0; if(isset($_POST["last"])) $last = $_POST["last"]; else $last = 0; $hasil = ($first / $last); } ?>
<section class="content">
		<h2>Anggaran Kas Murni<small> anggaran belanja langsung</small></h2>  
			<div class="body">
				<ol class="breadcrumb breadcrumb-col-cyan">
					<li><a href="<?php echo site_url('dashboard');?>"><i class="material-icons">home</i> Home</a></li>
					<li><a href="<?php echo site_url('anggaran-kas/murni');?>"> Anggaran Kas</a></li>
					<li class="active"> Rencana</li>
				</ol>
			</div>
            <!-- Multiple Items To Be Open -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
						<?php $query_hasil = $this->db->query("SELECT SUM(rka_sub.total) as totalRKA FROM rka_sub WHERE rka_sub.tipe_kode= '1' AND rka_sub.anggaran_kode='".$kode."' "); $data_hasil = $query_hasil->result(); foreach($data_hasil as $task){ ?>
							<p align="center"><b><?php  echo rupiah2 ($task->totalRKA); ?></b></p> <?php } ?>

							<p class="control-label col-md-10">Anggaran &nbsp;:&nbsp; <?php echo $kode;?></p><p align="right"><b>.</b></p>
							<p class="control-label col-md-10">Tahun &nbsp;:&nbsp; <?php echo $tahun;?></p><p align="right"><b>.</b></p>
							
							<p class="control-label col-md-10">Program &nbsp;:&nbsp; <?php echo $program;?></p><p align="right"><b>.</b></p>
							<p class="control-label col-md-10">Kegiatan &nbsp;:&nbsp; <?php echo $kegiatan;?></p><p align="right"><b>Jumlah</b></p>
                            <p class="control-label col-md-10">Rincian &nbsp;&nbsp;&nbsp;:&nbsp;<?php echo $rincian->no; ?> . <?php echo $rincian->uraian; ?></p><p align="right"><b><?php echo rupiah($jumlah);?></b></p>
							<ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <button type="button" class="btn bg-black waves-effect waves-light">ACTIONS</button>
                                    </a>
                                    <ul class="dropdown-menu pull-right">                                     
                                        <li><a title="Kembali" href="<?php echo base_url(); ?>anggaran-kas/murni/sub/<?php echo $rincian->kode; ?>"><i class="material-icons">reply</i> Kembali</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
						<div class="row clearfix">
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<!-- Nav tabs -->
							<ul class="nav nav-tabs tab-nav-right" role="tablist">
								<li><a href="javascript:void(0);">Belanja</a></li>
								<li><a href="javascript:void(0);">Rincian Belanja</a></li>
								<li role="presentation" class="active"><a href="#home_animation_2" data-toggle="tab">Sub Rincian Belanja</a></li>
							</ul>
							<!-- Tab panes -->									
							<div class="body">
							<div class="row clearfix">
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
								<div role="tabpanel" class="tab-pane fade in active" id="step1" aria-labelledby="home-tab">
								<div class="portlet-body">
									<table class="table table-striped table-bordered table-hover" width="50%" cellspacing="5" cellpadding="5">
									<tr>
										<th style="text-align:center; width:100px">No</th>
										<th style="text-align:center;">Uraian</th>
									</tr><ul><tr>
										<td><input type="text" class="form-control" name="no_kode" value="<?php printf( "%01d", $bls->no ); ?>" placeholder="Kode ..." readonly="readonly"></td>
										<td><input type="text" class="form-control" name="aaa_kode" placeholder="Enter text here ..." required="required"></td>
									</tr></ul></table><br>
								<div class="body">
									<div class="row clearfix">
									<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
									<form action="" name="formku" method="POST">
										<div class="row clearfix">
										<div class="col-md-6">
											<div class="form-group form-float">
												<div class="form-line">
													<?php $query_hasil = $this->db->query("SELECT SUM(rka_sub.total) as totalRKA FROM rka_sub WHERE rka_sub.tipe_kode= '1' AND rka_sub.anggaran_kode='".$kode."' "); $data_hasil = $query_hasil->result(); foreach($data_hasil as $task){ ?>
													<input type="text" class="form-control" name="first" id="first" value="<?php echo ($task->totalRKA); ?>" maxlength="16" style="text-align:right;">
													<label class="form-label" for="bbb_kode">Anggaran</label>
													
										<input type="text" id="stok" value="<?php echo ($task->totalRKA); ?>">
													<?php } ?>
												</div>
											</div>
										</div>
										
										

										
										
										</div>
										<input type="text" value="<?php echo $a=round($hasil, -3); ?>">
										<input type="text" name="last" id="last" value="12">
															
										<div class="form-group">
										<div class="col-md-offset-11">
											<button class="btn btn-primary waves-effect" type="submit" name="Hitung" id="Hitung">Bagi Rata</button>																	
										</div>
										</div>														
															
															<div class="row clearfix">
																<div class="col-md-4">
																<div class="form-group form-float">
																	<div class="form-line">
																		<input type="text" class="form-control" name="" id="hasil" value="<?php echo $a;?>" maxlength="16" style="text-align:right;">
																		<label class="form-label" for="bbb_kode">Januari</label>
																	</div>
																</div>
																</div>
																
																<div class="col-md-4">
																<div class="form-group form-float">
																	<div class="form-line">
																		<input type="text" class="form-control" name="" id="hasil" value="<?php echo $a;?>" maxlength="16" style="text-align:right;">
																		<label class="form-label" for="bbb_kode">Mei</label>
																	</div>
																</div>
																</div>
																
																<div class="col-md-4">
																<div class="form-group form-float">
																	<div class="form-line">
																		<input type="text" class="form-control" name="" id="hasil" value="<?php echo $a;?>" maxlength="16" style="text-align:right;">
																		<label class="form-label" for="bbb_kode">September</label>
																	</div>
																</div>
																</div>
															</div>
															
															<div class="row clearfix">
																<div class="col-md-4">
																<div class="form-group form-float">
																	<div class="form-line">
																		<input type="text" class="form-control" name="" id="hasil" value="<?php echo $a;?>" maxlength="16" style="text-align:right;">
																		<label class="form-label" for="bbb_kode">Februari</label>
																	</div>
																</div>
																</div>
																
																<div class="col-md-4">
																<div class="form-group form-float">
																	<div class="form-line">
																		<input type="text" class="form-control" name="" id="hasil" value="<?php echo $a;?>" maxlength="16" style="text-align:right;">
																		<label class="form-label" for="bbb_kode">Juni</label>
																	</div>
																</div>
																</div>
																
																<div class="col-md-4">
																<div class="form-group form-float">
																	<div class="form-line">
																		<input type="text" class="form-control" name="" id="hasil" value="<?php echo $a;?>" maxlength="16" style="text-align:right;">
																		<label class="form-label" for="bbb_kode">Oktober</label>
																	</div>
																</div>
																</div>
															</div>
															
															<div class="row clearfix">
																<div class="col-md-4">
																<div class="form-group form-float">
																	<div class="form-line">
																		<input type="text" class="form-control" name="" id="hasil" value="<?php echo $a;?>" maxlength="16" style="text-align:right;">
																		<label class="form-label" for="bbb_kode">Maret</label>
																	</div>
																</div>
																</div>
																
																<div class="col-md-4">
																<div class="form-group form-float">
																	<div class="form-line">
																		<input type="text" class="form-control" name="" id="hasil" value="<?php echo $a;?>" maxlength="16" style="text-align:right;">
																		<label class="form-label" for="bbb_kode">Juli</label>
																	</div>
																</div>
																</div>
																
																<div class="col-md-4">
																<div class="form-group form-float">
																	<div class="form-line">
																		<input type="text" class="form-control" name="" id="hasil" value="<?php echo $a;?>" maxlength="16" style="text-align:right;">
																		<label class="form-label" for="bbb_kode">November</label>
																	</div>
																</div>
																</div>
															</div>
															
															<div class="row clearfix">
																<div class="col-md-4">
																<div class="form-group form-float">
																	<div class="form-line">
																		<input type="text" class="form-control" name="" id="hasil" value="<?php echo $a;?>" maxlength="16" style="text-align:right;">
																		<label class="form-label" for="bbb_kode">April</label>
																	</div>
																</div>
																</div>
																
																<div class="col-md-4">
																<div class="form-group form-float">
																	<div class="form-line">
																		<input type="text" class="form-control" name="" id="hasil" value="<?php echo $a;?>" maxlength="16" style="text-align:right;">
																		<label class="form-label" for="bbb_kode">Agustus</label>
																	</div>
																</div>
																</div>
																
																<div class="col-md-4">
																<div class="form-group form-float">
																	<div class="form-line">
																		<input type="text" class="form-control" name="" id="hasil" value="<?php echo $a;?>" maxlength="16" style="text-align:right;">
																		<label class="form-label" for="bbb_kode">Desember</label>
																	</div>
																</div>
																</div>
															</div>
										
<input type="text" id="jumlah">
				<button id="tambah" class="btn">Tambah</button>
				
												<div class="form-group">
										<div class="col-md-offset-11">
											<button class="btn btn-primary waves-effect" type="submit">Simpan</button>																	
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
							</div>
						</div>
						</div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Tabs With Custom Animations -->
        </div>
    </section>
<!-- END CONTENT -->
<script src="<?php echo base_url('public/templates/integrasi_v.4.0/js/rencana/jquery.js');?>"></script>
<script>
	var jumlah;
	var stok;
		$(function(){
	//jika tombol tambah di klik
		$("#tambah").click(function(){
		stok=$("#stok").val();
		jumlah=$("#jumlah").val();
		if(jumlah > stok){
			alert("Stok Kelebihan");
			$("#jumlah").focus();
		return false; }
		if(jumlah < stok){
			alert("Stok Kurang");
			$("#jumlah").focus();
		return false; }
		});
	return true });
</script>