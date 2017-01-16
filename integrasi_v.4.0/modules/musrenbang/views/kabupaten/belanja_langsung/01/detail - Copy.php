<!-- BEGIN CONTENT -->
	<div class="page-content-wrapper">
		<div class="page-content">
			<!-- BEGIN PAGE HEADER-->
			<h3 class="page-title">
			Detail Musrenbang Kabupaten <small>anggaran belanja langsung</small>
			</h3>
			<div class="page-bar">
				<ul class="page-breadcrumb">
					<li>
						<i class="fa fa-home"></i>
						<a href="<?php echo site_url('dashboard');?>">Home</a>
						<i class="fa fa-angle-right"></i>
					</li>
                    <li>
						<a href="<?php echo site_url('musrenbang/kabupaten');?>">Musrenbang Kabupaten</a>
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
								<i class="fa fa-pencil"></i>Data Detail Musrenbang Kabupaten
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
                                                	<p class="form-control-static"><?php echo strtoupper($skpd);?></p>
                                                </div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label class="control-label col-md-2" for="visi">Visi :</label>
                                                <div class="col-md-10">
                                                	<p class="form-control-static"><?php echo $visi;?></p>
                                                </div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label class="control-label col-md-2" for="misi">Misi :</label>
                                                <div class="col-md-10">
                                                	<p class="form-control-static"><?php echo $misi;?></p>
                                                </div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label class="control-label col-md-2" for="prioritas">Prioritas :</label>
                                                <div class="col-md-10">
                                                	<p class="form-control-static"><?php echo $prioritas;?></p>
                                                </div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label class="control-label col-md-2" for="tujuan">Tujuan Anggaran :</label>
                                                <div class="col-md-10">
                                                	<p class="form-control-static"><?php echo $tujuan;?></p>
                                                </div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label class="control-label col-md-2" for="sasaran">Sasaran :</label>
                                                <div class="col-md-10">
                                                	<p class="form-control-static"><?php echo $sasaran;?></p>
                                                </div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label class="control-label col-md-2" for="indikator">Indikator :</label>
                                                <div class="col-md-10">
                                                	<p class="form-control-static"><?php echo $indikator;?></p>
                                                </div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label class="control-label col-md-2" for="urusan">Urusan :</label>
                                                <div class="col-md-10">
                                                	<p class="form-control-static"><?php echo $urusan;?></p>
                                                </div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label class="control-label col-md-2" for="program">Program :</label>
                                                <div class="col-md-10">
                                                	<p class="form-control-static"><?php echo $program;?></p>
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
										
									<h3 class="form-section">Indikator Hasil Program</h3>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label class="control-label col-md-2" for="hp_ukur">Tokal Ukur :</label>
												<div class="col-md-10">
                                                	<p class="form-control-static"><?php echo $hp_ukur;?></p>
                                                </div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label col-md-4" for="hp_target">Target :</label>
												<div class="col-md-8">
                                                	<p class="form-control-static"><?php echo $hp_target;?></p>
                                                </div>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label col-md-4" for="hp_satuan">Satuan :</label>
												<div class="col-md-8">
                                                	<p class="form-control-static"><?php echo $hp_satuan;?></p>
                                                </div>
											</div>
										</div>
									</div>
									
									<h3 class="form-section">Indikator Keluaran Kegiatan</h3>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label class="control-label col-md-2" for="kh_ukur">Tokal Ukur :</label>
												<div class="col-md-10">
                                                	<p class="form-control-static"><?php echo $kh_ukur;?></p>
                                                </div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label col-md-4" for="kh_target">Target :</label>
												<div class="col-md-8">
                                                	<p class="form-control-static"><?php echo $kh_target;?></p>
                                                </div>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label col-md-4" for="kh_satuan">Satuan :</label>
												<div class="col-md-8">
                                                	<p class="form-control-static"><?php echo $kh_satuan;?></p>
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
									
									<h3 class="form-section">Asumsi Biaya Pendanaan </h3>
									<div class="row">
										<div class="col-md-4">
											<div class="form-group">
												<label class="control-label col-md-6" for="apbd_kab">APBD Kabupaten :</label>
												<div class="col-md-6">
                                                	<p class="form-control-static"><?php echo rupiah($apbd_kab);?></p>
                                                </div>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label class="control-label col-md-6" for="apbd_prov">APBD Provinsi :</label>
												<div class="col-md-6">
                                                	<p class="form-control-static"><?php echo rupiah($apbd_prov);?></p>
                                                </div>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label class="control-label col-md-6" for="apbd_prov">APBN/PHLN :</label>
												<div class="col-md-6">
                                                	<p class="form-control-static"><?php echo rupiah($apbn);?></p>
                                                </div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-4">
											<div class="form-group">
												<label class="control-label col-md-6" for="apbd_prov">Sumber Lainnya :</label>
												<div class="col-md-6">
                                                	<p class="form-control-static"><?php echo rupiah($sumberlain);?></p>
                                                </div>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label class="control-label col-md-6" for="total_pendanaan">Total Pendanaan :</label>
												<div class="col-md-6">
                                                	<p class="form-control-static"><b><?php echo rupiah($apbd_kab + $apbd_prov + $apbn + $sumberlain);?></b></p>
                                                </div>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label class="control-label col-md-6" for="apbd_kab">Perkiraan Maju :</label>
												<div class="col-md-6">
                                                	<p class="form-control-static"><?php echo rupiah($perkiraan_maju);?></p>
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
												<label class="control-label col-md-4" for="alamat">RT :</label>
												<div class="col-md-8">
                                                	<p class="form-control-static"><?php echo $rt;?></p>
                                                </div>
											</div>
										</div>
										<div class="col-md-2">
											<div class="form-group">
												<label class="control-label col-md-4" for="alamat">RW :</label>
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
													<a href="<?php echo site_url('musrenbang/kabupaten/edit/'.$kode);?>" class="btn green"><i class="fa fa-pencil"></i> Ubah</a>
													<a href="<?php echo site_url('musrenbang/kabupaten/transfer/'.$kode);?>" class="btn blue"><i class="fa fa-paper-plane"></i> Transfer ke RKPD Kabupaten</a>
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