<!-- BEGIN CONTENT -->
	<div class="page-content-wrapper">
		<div class="page-content">
			<!-- BEGIN PAGE HEADER-->
			<h3 class="page-title">
			Detail Pra Rencana Kerja <small>anggaran belanja tidak langsung</small>
			</h3>
			<div class="page-bar">
				<ul class="page-breadcrumb">
					<li>
						<i class="fa fa-home"></i>
						<a href="<?php echo site_url('dashboard');?>">Home</a>
						<i class="fa fa-angle-right"></i>
					</li>
                    <li>
						<a href="<?php echo site_url('pra-rencana-kerja');?>">Pra Rencana Kerja</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="#">Detail Belanja Tidak Langsung</a>
					</li>
				</ul>
			</div>
			
            <!-- END PAGE HEADER-->
			<!-- BEGIN FORM -->
			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN SAMPLE TABLE PORTLET-->
					<div class="portlet box green">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-pencil"></i>Data Detail Pra Rencana Kerja
							</div>
						</div>
						<div class="portlet-body form">
							<!-- BEGIN FORM-->
							<form class="form-horizontal" role="form">							
								<div class="form-body">
                                    <h3 class="form-section"><?php echo $kegiatan;?></h3>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label class="control-label col-md-2" for="tahun">Tahun Anggaran :</label>
												<div class="col-md-10">
                                                	<p class="form-control-static"><b><?php echo $tahun;?></b></p>
                                                </div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label class="control-label col-md-2" for="skpd">SKPD Pelaksana :</label>
                                                <div class="col-md-10">
                                                	<p class="form-control-static"><?php echo $skpd;?></p>
                                                </div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label class="control-label col-md-2" for="kegiatan">Nama Kegiatan :</label>
												<div class="col-md-10">
                                                	<p class="form-control-static"><?php echo $kegiatan;?></p>
                                                </div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-3">
											<div class="form-group">
												<label class="control-label col-md-8" for="volume">Volume :</label>
												<div class="col-md-4">
                                                	<p class="form-control-static"><?php echo $volume;?></p>
                                                </div>
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<label class="control-label col-md-8" for="kesepakatan">Asumsi Biaya :</label>
												<div class="col-md-4">
                                                	<p class="form-control-static" style="font-size:14px;font-weight:bold;"><?php echo rupiah($biaya);?></p>
                                                </div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label class="control-label col-md-2" for="biaya">Calon Penerima :</label>
												<div class="col-md-10">
                                                	<p class="form-control-static"><?php echo $penerima;?></p>
                                                </div>
											</div>
										</div>
									</div>
									
									<h3 class="form-section">Lokasi Kegiatan</h3>
									<div class="row">
										<div class="col-md-8">
											<div class="form-group">
												<label class="control-label col-md-3" for="alamat">Alamat :</label>
												<div class="col-md-5">
                                                	<p class="form-control-static"><?php echo $alamat;?></p>
                                                </div>
											</div>
										</div>
										<div class="col-md-2">
											<div class="form-group">
												<label class="control-label col-md-4" for="rt">RT :</label>
												<div class="col-md-8">
                                                	<p class="form-control-static"><?php echo $rt;?></p>
                                                </div>
											</div>
										</div>
										<div class="col-md-2">
											<div class="form-group">
												<label class="control-label col-md-4" for="rw">RW :</label>
												<div class="col-md-8">
                                                	<p class="form-control-static"><?php echo $rw;?></p>
                                                </div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-4">
											<div class="form-group">
												<label class="control-label col-md-6" for="deskel">Desa/Kelurahan :</label>
												<div class="col-md-6">
                                                	<p class="form-control-static"><?php echo $deskel;?></p>
                                                </div>
											</div>
										</div>
										<div class="col-md-8">
											<div class="form-group">
												<label class="control-label col-md-4" for="kecamatan">Kecamatan :</label>
												<div class="col-md-8">
                                                	<p class="form-control-static"><?php echo $kecamatan;?></p>
                                                </div>
											</div>
										</div>
									</div>
									
									<h3 class="form-section">Data Pendukung</h3>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label col-md-6" for="proposal">Proposal :</label>
												<div class="col-md-6">
                                                	<input type="checkbox" name="proposal" readonly="readonly" id="proposal" <?php echo $proposal;?> class="make-switch" data-on-text="&nbsp;ADA&nbsp;" data-off-text="&nbsp;TIDAK&nbsp;" data-on-color="primary" data-off-color="default">
                                                </div>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label class="control-label col-md-6" for="verifikasi">Verifikasi :</label>
												<div class="col-md-6">
                                                	<input type="checkbox" readonly="readonly" name="verifikasi" id="verifikasi" <?php echo $verifikasi;?> class="make-switch" data-on-text="&nbsp;SUDAH&nbsp;" data-off-text="&nbsp;BELUM&nbsp;" data-on-color="success" data-off-color="default">
                                                </div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label class="control-label col-md-3" for="skpd_alamat">Foto Keadaan Sekarang :</label>
												<div class="col-md-9">
                                                	<p class="form-control-static">Tidak ada foto.</p>
                                                </div>
											</div>
										</div>
									</div>
									
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label class="control-label col-md-3" for="koordinat">Titik Koordinat :</label>
												<div class="col-md-4">
                                                	<div class="input-group">
                                                        <input type="text" class="form-control" placeholder="-6.238634, 107.140463" readonly="readonly">
                                                        <span class="input-group-btn">
                                                        <a class="btn red" href="#myModal" data-toggle="modal"><span class="fa fa-map-marker"></span> Lihat Lokasi</a>
                                                        </span>
                                                    </div>
                                                </div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label class="control-label col-md-3" for="catatan">Catatan :</label>
												<div class="col-md-9">
                                                	<p class="form-control-static"><?php echo $catatan;?></p>
                                                </div>
											</div>
										</div>
									</div>
								</div>
								<div class="form-actions">
									<div class="row">
										<div class="col-md-12">
											<div class="row">
												<div class="col-md-offset-3 col-md-9">
													<a href="#" onClick="history.go(-1); return false;" class="btn default"><i class="fa fa-reply"></i> Kembali</a>
													<a href="<?php echo site_url('pra-rencana-kerja/edit/'.$kode);?>" class="btn green"><i class="fa fa-pencil"></i> Ubah</a>
													<a href="<?php echo site_url('pra-rencana-kerja/transfer/'.$kode);?>" class="btn blue"><i class="fa fa-paper-plane"></i> Transfer ke Rencana Kerja</a>
												</div>
											</div>
										</div>
										<div class="col-md-6">
										</div>
									</div>
								</div>
								
							</form>
							<!-- END FORM-->
						</div>
					</div>
					<!-- END SAMPLE TABLE PORTLET-->
				</div>
			</div>
		</div>
	</div>