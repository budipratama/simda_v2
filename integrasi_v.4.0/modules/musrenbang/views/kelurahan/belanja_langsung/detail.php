<!-- BEGIN CONTENT -->
	<div class="page-content-wrapper">
		<div class="page-content">
			<!-- BEGIN PAGE HEADER-->
			<h3 class="page-title">
			Detail Hasil Musrenbang Kelurahan <small>anggaran belanja langsung</small>
			</h3>
			<div class="page-bar">
				<ul class="page-breadcrumb">
					<li>
						<i class="fa fa-home"></i>
						<a href="<?php echo site_url('dashboard');?>">Home</a>
						<i class="fa fa-angle-right"></i>
					</li>
                    <li>
						<a href="<?php echo site_url('musrenbang/kelurahan');?>">Musrenbang Kelurahan</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="#">Detail Belanja Langsung</a>
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
								<i class="fa fa-pencil"></i>Data Detail Musrenbang Kelurahan
							</div>
						</div>
						<div class="portlet-body form">
							<!-- BEGIN FORM-->
							<form class="form-horizontal" role="form">							
								<div class="form-body">
                                    <h3 class="form-section">Data Kegiatan: <?php echo $kegiatan;?></h3>
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
												<label class="control-label col-md-8" for="jenis_kegiatan">Jenis Kegiatan :</label>
												<div class="col-md-4">
                                                	<p class="form-control-static"><?php echo $jenis_kegiatan;?></p>
                                                </div>
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<label class="control-label col-md-8" for="kesepakatan">Kesepakatan :</label>
												<div class="col-md-4">
                                                	<p class="form-control-static"><?php echo $kesepakatan;?></p>
                                                </div>
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<label class="control-label col-md-8" for="urutan">Urutan :</label>
												<div class="col-md-4">
                                                	<p class="form-control-static"><?php echo $urutan;?></p>
                                                </div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label class="control-label col-md-2" for="biaya">Asumsi Biaya :</label>
												<div class="col-md-10">
                                                	<p class="form-control-static" style="font-size:14px;font-weight:bold;"><?php echo rupiah($biaya);?></p>
                                                </div>
											</div>
										</div>
									</div>
										
									<h3 class="form-section">Indikator Hasil Kegiatan</h3>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label class="control-label col-md-2" for="hk_ukur">Tokal Ukur :</label>
												<div class="col-md-10">
                                                	<p class="form-control-static"><?php echo $hk_ukur;?></p>
                                                </div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label col-md-4" for="hk_target">Target :</label>
												<div class="col-md-8">
                                                	<p class="form-control-static"><?php echo $hk_target;?></p>
                                                </div>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label col-md-4" for="hk_satuan">Satuan :</label>
												<div class="col-md-8">
                                                	<p class="form-control-static"><?php echo $hk_satuan;?></p>
                                                </div>
											</div>
										</div>
									</div>
									
									<h3 class="form-section">Lokasi Kegiatan</h3>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label class="control-label col-md-3" for="alamat">Alamat :</label>
												<div class="col-md-5">
                                                	<p class="form-control-static"><?php echo $alamat;?></p>
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
										<div class="col-md-12">
											<div class="form-group">
												<label class="control-label col-md-3" for="file">Preview File Proposal:</label>
												<div class="col-md-9">
													<?php
													if ($file){
														?>
														<p class="form-control-static"><a href="<?php echo site_url("musrenbang/desa/previewfile/".$kode)?>" target="_blank">Preview</a></p>
														<?php
													} else {
														?>
														Tidak ada file proposal
														<?php
													}
													?>
                                                </div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label class="control-label col-md-3" for="skpd_alamat">Foto Keadaan Sekarang :</label>
												<div class="col-md-9">
												<?php
												if ($foto){
													$photos = explode(';', $foto);
													$i = 1;
													$jml_foto = count($photos);
													foreach($photos as $row){
														if ($i == 1 || $i % 3 == 1){
															echo '<div class="row">';
														}
													?>
													<div class="col-md-3 box-image box-image-detail">
														<div class="photo-detail" style="display:block;overflow:hidden">
															<img src="<?php echo base_url('public/uploads/pictures/musrenbang_kelurahan/'.$row)?>" alt="" style="width:100%;">
														</div>
													</div>
													<?php
													if ($i % 3 == 0 || $i == $jml_foto){
														echo '</div>';
													}
													$i++;
													}
												}else {
													?>
													<div class="col-md-12">
                                                	<p class="form-control-static">Tidak ada foto.</p>
													</div>
													<?php
												}
												?>
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
													<a href="<?php echo site_url('musrenbang/kelurahan/edit/'.$kode);?>" class="btn green"><i class="fa fa-pencil"></i> Ubah</a>
													<?php if ($admin_log['level_kode'] == '4'){ ?>
													<a href="<?php echo site_url('musrenbang/kelurahan/transfer/'.$kode);?>" class="btn blue"><i class="fa fa-paper-plane"></i> Transfer ke Musrenbang Kecamatan</a>
													<?php } ?>
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