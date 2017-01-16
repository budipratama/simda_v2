<!-- Main Content -->
<?php $query_hasil = $this->db->query("SELECT SUM(rka_sub.total) as totalRKA FROM rka_sub WHERE rka_sub.tipe_kode= '1' AND rka_sub.rka='".$id_kode."' "); $data_hasil = $query_hasil->result(); foreach($data_hasil as $task){ ?>
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
							<p align="center"><b><?php echo strtoupper($skpd);?></b></p>					
							<p class="control-label col-md-10">Program &nbsp;:&nbsp; <?php echo $program;?></p><p align="right"><b>.</b></p>
							<p class="control-label col-md-10">Kegiatan &nbsp;:&nbsp;<?php echo $kegiatan;?></p><p align="right"><b>Jumlah</b></p>
                            <p class="control-label col-md-10">Rekening &nbsp;:&nbsp;<?php echo $akun;?>.<?php echo $kelompok;?>.<?php echo $jenis;?>.<?php echo $obyek;?>.<?php echo $rincian_;?> <?php echo $rincian;?></p><p align="right"><b><?php echo rupiah($task->totalRKA);?></b></p>						
							<ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <button type="button" class="btn bg-black waves-effect waves-light">ACTIONS</button>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
										<!--<li><a title="Print" href="<?php echo site_url('anggaran-kas/murni/viewa/'.$id_anggaran);?>"><i class="material-icons">print</i> Print Anggaran</a></li>-->
										<li><a title="Kembali" href="<?php echo base_url(); ?>anggaran-kas/murni/belanja/<?php echo $id_anggaran;?>"><i class="material-icons">reply</i> Kembali</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
						<div class="row clearfix">
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<!-- Nav tabs -->
							<ul class="nav nav-tabs tab-nav-right" role="tablist">
								<li><a href="javascript:void(0);" data-toggle="tab">Belanja</a></li>
								<li role="presentation" class="active"><a href="#home_animation_2" data-toggle="tab">Rencana</a></li>
							</ul>
							<!-- Tab panes -->									
							<div class="body">
							<div class="row clearfix">
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
								<div role="tabpanel" class="tab-pane fade in active" id="step1" aria-labelledby="home-tab">
								<div class="portlet-body">
									<table class="table table-striped table-bordered table-hover" width="50%" cellspacing="5" cellpadding="5"><ul><tr>
										<td><input type="text" class="form-control" placeholder="Total Anggaran" readonly="readonly"></td>
										<td><input type="text" class="form-control" placeholder="<?php echo rupiah($task->totalRKA);?>" readonly="readonly"></td>
									</tr></ul></table><br>
								<div class="body">
									<div class="row clearfix">
									<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"> 
									<form action="<?php echo site_url('anggaran-kas/murni/rencana');?>" name="form" method="POST">
									<input type="hidden" name="kode_anggaran" value="<?php echo $id_anggaran;?>">
									<input type="hidden" name="kode_program" value="<?php echo $id_program;?>">
									<input type="hidden" name="kode_skpd" value="<?php echo $id_skpd;?>">
									<input type="hidden" name="kode_total" value="<?php echo $task->totalRKA;?>">
									<?php } ?>
										<div class="row clearfix">
											<div class="col-md-4">
											<div class="form-group form-float">
												<div class="form-line">
													<input type="text" class="form-control" value="<?php echo rupiah2($jan_kode);?>" placeholder="0" style="text-align:right;" disabled>
													<label class="form-label" for="bbb_kode">Januari</label>
												</div>
											</div>
											</div>

											<div class="col-md-4">
											<div class="form-group form-float">
												<div class="form-line">
													<input type="text" class="form-control" value="<?php echo rupiah2($mei_kode);?>" placeholder="0" style="text-align:right;" disabled>
													<label class="form-label" for="bbb_kode">Mei</label>
												</div>
											</div>
											</div>

											<div class="col-md-4">
											<div class="form-group form-float">
												<div class="form-line">
													<input type="text" class="form-control" value="<?php echo rupiah2($sep_kode);?>" placeholder="0" style="text-align:right;" disabled>
													<label class="form-label" for="bbb_kode">September</label>
												</div>
											</div>
											</div>
										</div>

										<div class="row clearfix">
											<div class="col-md-4">
											<div class="form-group form-float">
												<div class="form-line">
													<input type="text" class="form-control" value="<?php echo rupiah2($feb_kode);?>" placeholder="0" style="text-align:right;" disabled>
													<label class="form-label" for="bbb_kode">Februari</label>
												</div>
											</div>
											</div>

											<div class="col-md-4">
											<div class="form-group form-float">
												<div class="form-line">
													<input type="text" class="form-control" value="<?php echo rupiah2($jun_kode);?>" placeholder="0" style="text-align:right;" disabled>
													<label class="form-label" for="bbb_kode">Juni</label>
												</div>
											</div>
											</div>

											<div class="col-md-4">
											<div class="form-group form-float">
												<div class="form-line">
													<input type="text" class="form-control" value="<?php echo rupiah2($okt_kode);?>" placeholder="0" style="text-align:right;" disabled>
													<label class="form-label" for="bbb_kode">Oktober</label>
												</div>
											</div>
											</div>
										</div>

										<div class="row clearfix">
											<div class="col-md-4">
											<div class="form-group form-float">
												<div class="form-line">
													<input type="text" class="form-control" value="<?php echo rupiah2($mar_kode);?>" placeholder="0" style="text-align:right;" disabled>
													<label class="form-label" for="bbb_kode">Maret</label>
												</div>
											</div>
											</div>

											<div class="col-md-4">
											<div class="form-group form-float">
												<div class="form-line">
													<input type="text" class="form-control" value="<?php echo rupiah2($jul_kode);?>" placeholder="0" style="text-align:right;" disabled>
													<label class="form-label" for="bbb_kode">Juli</label>
												</div>
											</div>
											</div>

											<div class="col-md-4">
											<div class="form-group form-float">
												<div class="form-line">
													<input type="text" class="form-control" value="<?php echo rupiah2($nov_kode);?>" placeholder="0" style="text-align:right;" disabled>
													<label class="form-label" for="bbb_kode">November</label>
												</div>
											</div>
											</div>
										</div>

										<div class="row clearfix">
											<div class="col-md-4">
											<div class="form-group form-float">
												<div class="form-line">
													<input type="text" class="form-control" value="<?php echo rupiah2($apr_kode);?>" placeholder="0" style="text-align:right;" disabled>
													<label class="form-label" for="bbb_kode">April</label>
												</div>
											</div>
											</div>
											
											<div class="col-md-4">
											<div class="form-group form-float">
												<div class="form-line">
													<input type="text" class="form-control" value="<?php echo rupiah2($ags_kode);?>" placeholder="0" style="text-align:right;" disabled>
													<label class="form-label" for="bbb_kode">Agustus</label>
												</div>
											</div>
											</div>
																
											<div class="col-md-4">
											<div class="form-group form-float">
												<div class="form-line">
													<input type="text" class="form-control" value="<?php echo rupiah2($des_kode);?>" placeholder="0" style="text-align:right;" disabled>
													<label class="form-label" for="bbb_kode">Desember</label>
												</div>
											</div>
											</div>
										</div>
				
										<div class="row clearfix">
										<div class="col-md-offset-9">
											<a class="btn btn-success" href="<?php echo base_url(); ?>anggaran-kas/murni/add/<?php echo $id_kode;?>">isi Rencana</a>
											<a href="<?php echo site_url('anggaran-kas/murni/belanja/'.$id_anggaran);?>" class="btn default">Kembali</a>
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