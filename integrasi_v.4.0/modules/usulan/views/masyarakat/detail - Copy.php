<!-- BEGIN CONTENT -->
	<div class="page-content-wrapper">
		<div class="page-content">
		<!-- BEGIN PAGE HEADER-->			
	<div class="row">
	<div id="breadcrumb" <div class="page-bar">
		<a href="#" class="show-sidebar">
			<i class="fa fa-bars"></i>
		</a>
		<ol class="breadcrumb pull-left">
			<li><a href="<?php echo site_url();?>">Home</a></li>
			<li><a href="<?php echo site_url('usulan/masyarakat/hasil');?>">Hasil Usulan Masyarakat</a></li>
			<li><a href="#">Detail</a></li>
		</ol>
	</div>
	</div>
			<h3 class="page-title">
			Pengisian <small>Usulan Masyarakat</small>
			</h3>
            <!-- END PAGE HEADER-->
			<!-- BEGIN DASHBOARD STATS -->
			
<!-- BEGIN FORM -->
<div class="row">
	<div class="col-xs-12 col-sm-12">
		<div class="box">
			<div class="box-header">
				<div class="box-name">
					<i class="fa fa-pencil-square-o"></i>
					<span>Data Detail Usulan Masyarakat</span>
				</div>
				<div class="no-move"></div>
			</div>
			<div class="box-content">
				<h4 class="page-header">Identitas Pengirim</h4>
				<form class="form-horizontal" role="form">							
								<div class="form-body">
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label class="control-label col-md-2" for="urusan_kode">Nama :</label>
												<div class="col-md-10">
                                                	<p class="form-control-static"><?php echo $nama; ?></p>
                                                </div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label class="control-label col-md-2" for="skpd_nomor">Instansi :</label>
                                                <div class="col-md-10">
                                                	<p class="form-control-static"><?php echo $instansi; ?></p>
                                                </div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label class="control-label col-md-2" for="skpd_nomor">Jabatan :</label>
                                                <div class="col-md-10">
                                                	<p class="form-control-static"><?php echo $jabatan; ?></p>
                                                </div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label class="control-label col-md-2" for="skpd_nama">Alamat :</label>
                                                <div class="col-md-10">
                                                	<p class="form-control-static"><?php echo $alamat; ?></p>
                                                </div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label class="control-label col-md-2" for="skpd_kewenangan">Telepon / HP :</label>
												<div class="col-md-10">
                                                	<p class="form-control-static"><?php echo $telepon; ?></p>
                                                </div>
											</div>
										</div>
									</div>
										
									<hr><h3 class="form-section">Informasi Usulan</h3>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label class="control-label col-md-2" for="skpd_alamat">Nama Kegiatan :</label>
												<div class="col-md-10">
                                                	<p class="form-control-static"><?php echo $kegiatan; ?></p>
                                                </div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-4">
											<div class="form-group">
												<label class="control-label col-md-6" for="skpd_telepon">Volume :</label>
												<div class="col-md-6">
                                                	<p class="form-control-static"><?php echo $volume; ?></p>
                                                </div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-4">
											<div class="form-group">
												<label class="control-label col-md-6" for="skpd_telepon">Perkiraan Biaya :</label>
												<div class="col-md-6">
                                                	<p class="form-control-static"><?php echo rupiah($biaya); ?></p>
                                                </div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label class="control-label col-md-2" for="skpd_email">Kecamatan :</label>
												<div class="col-md-10">
                                                	<p class="form-control-static"><?php echo $nama_kecamatan; ?></p>
                                                </div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label class="control-label col-md-2" for="skpd_website">Desa/Kelurahan :</label>
												<div class="col-md-10">
                                                	<p class="form-control-static"><?php echo $nama_deskel; ?></p>
                                                </div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label class="control-label col-md-2" for="skpd_website">RT/RW :</label>
												<div class="col-md-10">
                                                	<p class="form-control-static"><?php echo $rt.'/'.$rw; ?></p>
                                                </div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label class="control-label col-md-2" for="skpd_website">Alamat :</label>
												<div class="col-md-10">
                                                	<p class="form-control-static"><?php echo $alamat; ?></p>
                                                </div>
											</div>
										</div>
									</div>
                                    <div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label class="control-label col-md-2" for="skpd_website">SKPD Pelaksana :</label>
												<div class="col-md-10">
                                                	<p class="form-control-static"><?php echo $nama_pelaksana; ?></p>
                                                </div>
											</div>
										</div>
									</div>
									
									<hr><h3 class="form-section">Data Pendukung</h3>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label class="control-label col-md-2" for="skpd_alamat">Foto Lokasi :</label>
												<div class="col-md-10">
													<?php 
													foreach($foto as $row){
														echo "<div class=\"col-md-2\"><img src=\"".base_url('public/uploads/pictures/usulan_masyarakat/'.$row)."\" style=\"width:100%\" /></div>";
													}
													?>
													</p>
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
                                                        <input type="text" class="form-control" name="koordinat" id="koordinat"  placeholder="<?php echo $koordinat; ?>" readonly="readonly">
                                                        <span class="input-group-btn">
                                                        <a class="btn red btn-xs" href="#mapmodals" data-toggle="modal"><span class="fa fa-map-marker"></span> Lihat Lokasi</a>
                                                        </span>
                                                    </div>
                                                </div>
											</div>
										</div>
									</div>
									
								</div>
								<div class="form-actions">
									<div class="row">
										<div class="col-md-6">
											<div class="row">
												<div class="col-md-offset-3 col-md-9">
													<a href="<?php echo site_url('usulan/masyarakat/hasil');?>" class="btn default btn-xs"><i class="fa fa-reply"></i> Kembali</a>
												</div>
											</div>
										</div>
										<div class="col-md-6">
										</div>
									</div>
								</div>
								
							</form>
			</div>
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
									<button type="button" class="btn btn-primary" id="simpan_lokasi" data-dismiss="modal"><i class="fa fa-check"></i> Simpan Lokasi</button>
								</div>
							</div>
						</div>
					</div>
					<!-- END SAMPLE TABLE PORTLET-->
				</div>
			</div>
	</div>
	<!-- END CONTENT -->
    <script>
	function show_form_deskel_by_kecamatan(){
		var kecamatan_kode = $('select[name=kecamatan_kode]').val();
		load('usulan/masyarakat/tampil_combobox_deskel_by_kecamatan/'+kecamatan_kode, '#tampil_combobox_deskel_by_kecamatan');
	}
	</script>