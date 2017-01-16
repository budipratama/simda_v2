<!-- Main Content -->
            <div class="container-fluid">
                <div class="side-body padding-top">
				<h3 class="page-title">Detail RKPD Murni <small>anggaran belanja langsung</small></h3>
				
					<div class="row">
                        <div class="col-xs-12">
							<div class="bs-example">
								<ol class="breadcrumb">
									<li class="active"><i class="fa fa-home"></i> <a href="<?php echo site_url('dashboard');?>">Home</a></li>
									<li class="active"><a href="<?php echo site_url('rkpd/murni');?>"> RKPD Murni</a></li>
									<li class="active"><a href="#"> Detail Belanja Langsung</a></li>
								</ol>
							</div>
                        </div>
                    </div>		

					<div class="row">
                        <div class="col-xs-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title">
                                        <div class="title"><h2><b><?php echo $kegiatan;?></b><h2></div>
                                    </div>
                                </div>
                                <div class="card-body">
							<!-- BEGIN FORM-->
							<form class="form-horizontal" role="form">							
								<div class="form-body">
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
										
									<hr><h4 class="form-section"><b>Indikator Hasil Program</b></h4>
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
									
									<hr><h4 class="form-section"><b>Indikator Keluaran Kegiatan</b></h4>
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
									
									<hr><h4 class="form-section"><b>Indikator Hasil Kegiatan</b></h4>
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
									
									<hr><h4 class="form-section"><b>Asumsi Biaya Pendanaan</b></h4>
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
									
									<hr><h4 class="form-section"><b>Lokasi Kegiatan</b></h4>
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
                                                	<p class="form-control-static"><?php if ($deskel_kode) { echo $deskel; } ?></p>
                                                </div>
											</div>
										</div>
										<div class="col-md-8">
											<div class="form-group">
												<label class="control-label col-md-4" for="kecamatan">Kecamatan :</label>
												<div class="col-md-8">
                                                	<p class="form-control-static"><?php if ($kecamatan_kode) { echo $kecamatan; } ?></p>
                                                </div>
											</div>
										</div>
									</div>
									
									<hr><h4 class="form-section"><b>Data Pendukung</b></h4>
									<div class="row">
										<div class="col-md-4">
											<div class="form-group">
												<label class="control-label col-md-6" for="proposal">Proposal :</label>
												<div class="col-md-6">
                                                	<input type="checkbox" name="proposal" readonly="readonly" id="proposal" <?php echo $proposal;?> class="make-switch" data-on-text="&nbsp;ADA&nbsp;" data-off-text="&nbsp;TIDAK&nbsp;" data-on-color="primary" data-off-color="default">
                                                </div>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label class="control-label col-md-5" for="verifikasi">Verifikasi :</label>
												<div class="col-md-7">
                                                	<input type="checkbox" readonly="readonly" name="verifikasi" id="verifikasi" <?php echo $verifikasi;?> class="make-switch" data-on-text="&nbsp;SUDAH&nbsp;" data-off-text="&nbsp;BELUM&nbsp;" data-on-color="success" data-off-color="default">
                                                </div>
											</div>
										</div>
									</div>
									
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label class="control-label col-md-2" for="skpd_alamat">Foto Lokasi :</label>
												<div class="col-md-10">
													<?php 
													foreach($foto as $row){
														echo "<div class=\"col-md-2\"><img src=\"".base_url('/public/uploads/pictures/pra_rencana_kerja/'.$row)."\" style=\"width:100%\" /></div>";
													}
													?>
                                                </div>
											</div>
										</div>
									</div>
									
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
											<label class="control-label col-md-2" for="koordinat">(Titik Koordinat) :</label>
											<div class="col-md-4">
												<div class="input-group">
													<input type="text" class="form-control" name="koordinat" id="koordinat"  placeholder="<?php echo $koordinat; ?>" readonly="readonly">
													<a class="btn btn-danger" href="#mapmodals" data-toggle="modal"><span class="fa fa-map-marker"></span> Lihat Lokasi</a>
												</div>
											</div>
											</div>
										</div>
									</div>
									
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label class="control-label col-md-2" for="catatan">Catatan :</label>
												<div class="col-md-9">
                                                	<p class="form-control-static"><?php echo $catatan;?></p>
                                                </div>
											</div>
										</div>
									</div>
								</div>								
								
								<div class="row">
								<div style="margin-left:83px;">
									<div class="col-md-12">
										<div class="col-md-offset-1 col-md-12">
										<a href="#" onClick="history.go(-1); return false;" class="btn btn-default"><i class="fa fa-reply"></i> Kembali</a>
										<a href="<?php echo site_url('rkpd/murni/transfer/'.$kode);?>" class="btn btn-info"><i class="fa fa-paper-plane"></i> Transfer ke KUA & PPAS</a>
										</div>
										<div class="col-md-6"></div>
									</div>
								</div>
								</div>								
								
							</form>
							<!-- END FORM--> 
			
                                </div>
                            </div>
                        </div>
                    </div>
					
			<div class="row">
				<div class="col-md-12">
					<div id="mapmodals" class="modal fade" role="dialog" aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
									<h4 class="modal-title">Google Maps</h4>
								</div>
								<div class="modal-body">
									 <div id="map-container" style="width:100%;height:420px"></div>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
								</div>
							</div>
						</div>
					</div>
					<!-- END SAMPLE TABLE PORTLET-->
				</div>
			</div>

                </div>
            </div>
        </div>
<!-- END CONTENT -->