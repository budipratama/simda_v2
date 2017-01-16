<!-- Main Content -->
<?php $query_data = mysql_query("SELECT tim_anggaran.nama as nama_tim, tim_anggaran.jabatan as jabatan_tim, tim_anggaran.nip as nip_tim FROM rka INNER JOIN tim_anggaran ON rka.skpd=tim_anggaran.skpd WHERE rka.tipe_kode= '1' AND rka.skpd='".$skpd."' ORDER BY rka.kode ASC"); $data = mysql_fetch_array($query_data); $nama_tim = $data[nama_tim]; $jabatan_tim = $data[jabatan_tim]; $nip_tim = $data[nip_tim]; ?>
   <section class="content">
		<h2>RKA Perubahan<small> anggaran belanja langsung</small></h2>  
			<div class="body">
				<ol class="breadcrumb breadcrumb-col-cyan">
					<li><a href="<?php echo site_url('dashboard');?>"><i class="material-icons">home</i> Home</a></li>
					<li><a href="<?php echo site_url('rka/perubahan');?>"> RKA</a></li>
					<li class="active"> Laporan</li>
				</ol>
			</div>
            <!-- Multiple Items To Be Open -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
							<p align="center"><b><?php echo strtoupper($skpd_);?></b></p>
							<p class="control-label col-md-10">Program &nbsp;:&nbsp; <?php echo $program_?></p>
							<p class="control-label col-md-10">Kegiatan &nbsp;:&nbsp; <?php echo $kegiatan; ?></p>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <button type="button" class="btn bg-black waves-effect waves-light">ACTIONS</button>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a title="Kembali" href="<?php echo base_url(); ?>rka/perubahan/belanja/<?php echo $kode;?>"><i class="material-icons">reply</i> Kembali</a></li>
                                    </ul>
                                </li>
                            </ul>
							<div class="panel-body"><?php echo validation_errors(); ?><?php if ($this->session->flashdata('success')) { echo $this->session->flashdata('success');} ?></div>
                        </div>
                        <div class="body">
                            <div class="row clearfix">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <!-- Tab panes -->									
									<div class="body">
										<div class="row clearfix">
											<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
											<form action="<?php echo site_url('rka/perubahan/preview/'.$kode);?>" id="form_validation" class="horizontal-form" method="post">
												<input type="hidden" name="tahun" value="<?php echo $tahun; ?>" />
												<input type="hidden" name="anggaran_kode" value="<?php echo $kode; ?>" />
												<input type="hidden" name="skpd" value="<?php echo $skpd; ?>" />
												<input type="hidden" name="kode" value="<?php echo $id_kode; ?>" />
												<div class="row">
													<div class="col-md-3">
														<div class="form-group">
															<label class="control-label" for="tanggal">Tanggal Laporan :</label>
															<div class="input-group input-medium date date-picker" data-date-format="yyyy-mm-dd">
																<input type="text" class="form-control" name="tanggal" id="tanggal" value="<?php echo date("Y-m-d");?>" readonly>
																<span class="input-group-btn">
																<button class="btn default" type="button"><i class="material-icons">today</i></button>
																</span>
															</div>
														</div>
													</div>
												</div>
												<h5>Form TandaTangan :</h5><br>
												<div class="row">
													<div class="col-md-6">
														<div class="form-group form-float">
														<div class="form-line">
															<input type="text" class="form-control" name="nama_pimpinan" id="nama_pimpinan" style="text-align:center;" value="<?php echo $nama_tim;?>" required>
															<label class="form-label" for="nama_pimpinan">Nama Pimpinan :</label>
														</div>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-6">
														<div class="form-group form-float">
														<div class="form-line">
															<input type="text" class="form-control" name="pangkat" id="pangkat" style="text-align:center;" value="<?php echo $jabatan_tim;?>" required>
															<label class="form-label" for="pangkat">Jabatan :</label>
														</div>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-6">
														<div class="form-group form-float">
														<div class="form-line">
															<input type="text" class="form-control" name="nip" id="nip" style="text-align:center;" value="<?php echo $nip_tim;?>" required>
															<label class="form-label" for="nip">NIP :</label>
														</div>
														</div>
													</div>
												</div>												
												<div class="form-group">
													<div class="col-md-offset-9">
														<button type="submit" class="btn btn-primary waves-effect" name="cetak">Lihat Laporan</button>											
														<a href="<?php echo site_url('rka/perubahan/belanja/'.$kode);?>" class="btn default">Kembali</a>
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
            <!-- #END# Tabs With Custom Animations -->
        </div>
    </section>
<!-- END CONTENT -->