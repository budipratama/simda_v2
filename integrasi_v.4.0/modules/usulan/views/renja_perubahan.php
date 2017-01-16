<!-- BEGIN CONTENT -->
	<div class="page-content-wrapper">
		<div class="page-content">
			<!-- BEGIN PAGE HEADER-->
			<h3 class="page-title">
			Transfer Usulan Masyarakat ke Rencana Kerja Perubahan <small>anggaran belanja langsung</small>
			</h3>
			<div class="page-bar">
				<ul class="page-breadcrumb">
					<li>
						<i class="fa fa-home"></i>
						<a href="<?php echo site_url('dashboard');?>">Home</a>
						<i class="fa fa-angle-right"></i>
					</li>
                    <li>
						<a href="<?php echo site_url('usulan');?>">Usulan Masyarakat</a>
						<i class="fa fa-angle-right"></i>
					</li>                    
                    <li>
						<a href="<?php echo site_url('transfer');?>">Transfer</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="#">Rencana Kerja Perubahan</a>
					</li>
				</ul>
			</div>
			
            <div class="note note-warning">
				<p>
					NOTE: Silahkan isi form Transfer Usulan Masyarakat ke Rencana Kerja Perubahan ini dengan data-data yang valid!. Sesuai dengan arahan dari BAPPEDA Kabupaten Bekasi.
				</p>
			</div>
            <!--
			<div class="alert alert-warning fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><i class="fa-lg fa fa-warning"></i> Peringatan, Ini hanya contoh dashboard. Data ini hanya sebagai gambaran saja untuk kedepannya dan belum menggunakan data real.</div>
			-->
            <!-- END PAGE HEADER-->
			<!-- BEGIN FORM -->
			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN SAMPLE TABLE PORTLET-->
					<div class="portlet box green">
									<div class="portlet-title">
										<div class="caption">
											<i class="fa fa-pencil"></i>Transfer Usulan Masyarakat ke Rencana Kerja Perubahan
										</div>
									</div>
									<div class="portlet-body form">
										<!-- BEGIN FORM-->
										<form action="#" class="horizontal-form">
											<div class="form-body">
												<h3 class="form-section">Detail Kegiatan</h3>
												<div class="row">
													<div class="col-md-3">
														<div class="form-group">
															<label class="control-label" for="tahun">Tahun Anggaran :</label>
                                                            <!-- combobox('jenis=db,1d,2d', 'array', 'name', 'value', 'value_name', 'selected', 'js', 'label', 'script') -->
															<?php combobox('db', $tahun, 'tahun', 'tahun', 'tahun', '', '', 'Pilih Tahun Anggaran', 'class="select2_category form-control" tabindex="1" required="required"'); ?>
														</div>
													</div>
													<!--/span-->
                                                	<div class="col-md-9">
														<div class="form-group">
															<label class="control-label" for="skpd_kode">SKPD Pelaksana :</label>
                                                            <!-- combobox('jenis=db,1d,2d', 'array', 'name', 'value', 'value_name', 'selected', 'js', 'label', 'script') -->
															<?php combobox('db', $skpd, 'skpd_kode', 'skpd_kode', 'skpd_nama', '', 'show_form_misi();', 'Pilih SKPD Pelaksana', 'class="select2_category form-control" tabindex="1" required="required"'); ?>
														</div>
													</div>
													<!--/span-->
                                                </div>    
												<!--/row-->
												<div class="row">
													<div class="col-md-12">
														<div class="form-group">
															<label class="control-label">Visi Kabupaten Bekasi :</label>
															<label class="control-label"><?php echo $visi->visi;?>.</label>
                                                        </div>
													</div>
													<!--/span-->
												</div>
												<!--/row-->
                                                
                                                <div class="row">
                                                	<div class="col-md-12">
														<div class="form-group" id="tampil_combobox_misi_skpd">
															<label class="control-label" for="misi_kode">Misi Kabupaten Bekasi :</label>
															<select class="select2_category form-control" name="misi_kode" id="misi_kode" data-placeholder="Pilih Misi Kabupaten Bekasi" tabindex="1">
															</select>
														</div>
													</div>
													<!--/span-->
                                                </div>
                                                <!--/row-->
                                                
                                                <div class="row">
                                                	<div class="col-md-6">
														<div class="form-group">
															<label class="control-label" for="prioritas_kode">Prioritas Daerah :</label>
                                                            <!-- combobox('jenis=db,1d,2d', 'array', 'name', 'value', 'value_name', 'selected', 'js', 'label', 'script') -->
															<?php combobox('db', $prioritas, 'prioritas_kode', 'kode', 'prioritas', '', '', 'Pilih Prioritas', 'class="select2_category form-control" tabindex="1" required="required"'); ?>
														</div>
													</div>
													<!--/span-->
                                                	<div class="col-md-6">
														<div class="form-group" id="tampil_combobox_tujuan_misi">
															<label class="control-label" for="tujuan_kode">Tujuan Anggaran :</label>
															<select class="select2_category form-control" name="tujuan_kode" id="tujuan_kode" data-placeholder="Pilih Tujuan Anggaran" tabindex="1">
															</select>
														</div>
													</div>
													<!--/span-->
                                                </div>
                                                <!--/row-->
                                                
                                                <div class="row">
                                                	<div class="col-md-6">
														<div class="form-group" id="tampil_combobox_sasaran_tujuan">
															<label class="control-label" for="sasaran_kode">Sasaran Daerah :</label>
															<select class="select2_category form-control" name="sasaran_kode" id="sasaran_kode" data-placeholder="Pilih Sasaran Daerah" tabindex="1">
															</select>
														</div>
													</div>
													<!--/span-->
                                                	<div class="col-md-6">
														<div class="form-group" id="tampil_combobox_indikator_sasaran">
															<label class="control-label" for="indikator_kode">Indikator Sasaran :</label>
															<select class="select2_category form-control" name="indikator_kode" id="indikator_kode" data-placeholder="Pilih Indikator Sasaran" tabindex="1">
															</select>
														</div>
													</div>
													<!--/span-->
                                                </div>
                                                <!--/row-->
                                                
                                                <div class="row">
                                                	<div class="col-md-6">
														<div class="form-group" id="tampil_combobox_urusan_skpd">
															<label class="control-label" for="urusan_kode">Urusan :</label>
															<select class="select2_category form-control" name="urusan_kode" id="urusan_kode" data-placeholder="Pilih Sasaran Daerah" tabindex="1">
															</select>
														</div>
													</div>
													<!--/span-->
                                                	<div class="col-md-6">
														<div class="form-group" id="tampil_combobox_program_urusan_skpd">
															<label class="control-label" for="program_kode">Program :</label>
															<select class="select2_category form-control" name="program_kode" id="program_kode" data-placeholder="Pilih Sasaran Daerah" tabindex="1">
															</select>
														</div>
													</div>
													<!--/span-->
                                                </div>
                                                <!--/row-->
                                                
                                                <div class="row">
                                                	<div class="col-md-12">
														<div class="form-group" id="tampil_combobox_program_kegiatan_program">
															<label class="control-label" for="kegiatan">Nama Kegiatan :</label>
															<input type="text" class="form-control" name="kegiatan" id="kegaitan" placeholder="">
														</div>
													</div>
													<!--/span-->
                                                </div>
                                                <!--/row-->
                                                
                                                <div class="row">
                                                	<div class="col-md-5">
														<div class="form-group">
															<label class="control-label">Jenis Kegiatan :</label>
															<div class="radio-list">
																<?php radiolist($sifat, 'sifat_kode', 'sifat_kode', 'sifat_nama');?>
															</div>
														</div>
													</div>
													<!--/span-->
                                                    <div class="col-md-4">
														<div class="form-group">
															<label class="control-label">Kesepakatan :</label>
															<div class="radio-list">
																<?php radiolist($kesepakatan, 'kesepakatan_kode', 'kode', 'nama');?>
															</div>
														</div>
													</div>
													<!--/span-->
                                                    <div class="col-md-2">
														<div class="form-group">
															<label class="control-label" for="urutan">Urutan Kegiatan :</label>
															<input type="text" class="form-control" name="urutan" id="urutan" placeholder="">
														</div>
													</div>
													<!--/span-->
                                                </div>
                                                <!--/row-->
                                                
                                                <h3 class="form-section">Indikator Hasil Program</h3>
                                                <div class="row">
                                                	<div class="col-md-12">
														<div class="form-group">
															<label class="control-label" for="hp_ukur">Tolak Ukur :</label>
															<input type="text" class="form-control" name="hp_ukur" id="hp_ukur" placeholder="">
														</div>
													</div>
													<!--/span-->
                                                </div>
                                                <!--/row-->
                                                <div class="row">
                                                	<div class="col-md-6">
														<div class="form-group">
															<label class="control-label" for="hp_target">Target :</label>
															<input type="text" class="form-control" name="hp_target" id="hp_target" placeholder="">
														</div>
													</div>
													<!--/span-->
                                                    <div class="col-md-6">
														<div class="form-group">
															<label class="control-label" for="hp_satuan">Satuan :</label>
															<input type="text" class="form-control" name="hp_satuan" id="hp_satuan" placeholder="">
														</div>
													</div>
													<!--/span-->
                                                </div>
                                                <!--/row-->
                                                
                                                <h3 class="form-section">Indikator Keluaran Kegiatan</h3>
                                                <div class="row">
                                                	<div class="col-md-12">
														<div class="form-group">
															<label class="control-label" for="kh_ukur">Tolak Ukur :</label>
															<input type="text" class="form-control" name="kh_ukur" id="kh_ukur" placeholder="">
														</div>
													</div>
													<!--/span-->
                                                </div>
                                                <!--/row-->
                                                <div class="row">
                                                	<div class="col-md-6">
														<div class="form-group">
															<label class="control-label" for="kh_target">Target :</label>
															<input type="text" class="form-control" name="kh_target" id="kh_target" placeholder="">
														</div>
													</div>
													<!--/span-->
                                                    <div class="col-md-6">
														<div class="form-group">
															<label class="control-label" for="kh_satuan">Satuan :</label>
															<input type="text" class="form-control" name="kh_satuan" id="kh_satuan" placeholder="">
														</div>
													</div>
													<!--/span-->
                                                </div>
                                                <!--/row-->
                                                
                                                <h3 class="form-section">Indikator Hasil Kegiatan</h3>
                                                <div class="row">
                                                	<div class="col-md-12">
														<div class="form-group">
															<label class="control-label" for="hk_ukur">Tolak Ukur :</label>
															<input type="text" class="form-control" name="hk_ukur" id="hk_ukur" placeholder="">
														</div>
													</div>
													<!--/span-->
                                                </div>
                                                <!--/row-->
                                                <div class="row">
                                                	<div class="col-md-6">
														<div class="form-group">
															<label class="control-label" for="hk_target">Target :</label>
															<input type="text" class="form-control" name="hk_target" id="hk_target" placeholder="">
														</div>
													</div>
													<!--/span-->
                                                    <div class="col-md-6">
														<div class="form-group">
															<label class="control-label" for="hp_satuan">Satuan :</label>
															<input type="text" class="form-control" name="hk_satuan" id="hk_satuan" placeholder="">
														</div>
													</div>
													<!--/span-->
                                                </div>
                                                <!--/row-->
                                                
                                                <h3 class="form-section">Asumsi Biaya Pendanaan</h3>
                                                <div class="row">
                                                	<div class="col-md-4">
														<div class="form-group">
															<label class="control-label" for="apbd_kab">APBD Kabupaten : </label>
															<input type="text" class="form-control" name="apbd_kab" id="apbd_kab" style="text-align:right;" value="0" onkeypress="return isNumber(event)" onkeyup="totalAsumsi()" placeholder="">
														</div>
													</div>
													<!--/span-->
                                                    <div class="col-md-4">
														<div class="form-group">
															<label class="control-label" for="apbd_prov">APBD Provinsi :</label>
															<input type="text" class="form-control" name="apbd_prov" id="apbd_prov" style="text-align:right;" value="0" onkeypress="return isNumber(event)" onkeyup="totalAsumsi()" placeholder="">
														</div>
													</div>
													<!--/span-->
                                                    <div class="col-md-4">
														<div class="form-group">
															<label class="control-label" for="apbn">APBN/PHLN :</label>
															<input type="text" class="form-control" name="apbn" style="text-align:right;" value="0" onkeypress="return isNumber(event)" onkeyup="totalAsumsi()" id="apbn" placeholder="">
														</div>
													</div>
													<!--/span-->
                                                </div>
                                                <!--/row-->
                                                
                                                <div class="row">
                                                	<div class="col-md-4">
														<div class="form-group">
															<label class="control-label" for="sumberlain">Sumber Lainnya :</label>
															<input type="text" class="form-control" name="sumberlain" id="sumberlain" style="text-align:right;" value="0" onkeypress="return isNumber(event)" onkeyup="totalAsumsi()" placeholder="">
														</div>
													</div>
													<!--/span-->
                                                    <div class="col-md-4">
														<div class="form-group">
															<label class="control-label" for="total_asumsi"><strong>Total Pendanaan</strong> :</label>
															<input type="text" class="form-control" name="total_asumsi" id="total_asumsi" style="text-align:right;font-weight:bold;" value="0" placeholder="" readonly="readonly">
														</div>
													</div>
													<!--/span-->
                                                    <div class="col-md-4">
														<div class="form-group">
															<label class="control-label" for="perkiraan_maju">Perkiraan Maju :</label>
															<input type="text" class="form-control" name="perkiraan_maju" id="perkiraan_maju" onkeypress="return isNumber(event)" style="text-align:right;" value="0" placeholder="">
														</div>
													</div>
													<!--/span-->
                                                </div>
                                                <!--/row-->
                                                
                                                <h3 class="form-section">Lokasi Kegiatan</h3>
                                                <div class="row">
                                                	<div class="col-md-12">
														<div class="form-group">
                                                        	<label class="control-label">Jenis Lokasi</label>
                                                        	<div class="radio-list">
																<?php radiolist($lokasi, 'lokasi_kode', 'lokasi_kode', 'lokasi_nama');?>
															</div>
														</div>
													</div>
													<!--/span-->
                                                </div>
                                                <!--/row-->
                                                
                                                <div class="row">
                                                	<div class="col-md-5">
                                                    	<div class="form-group">
															<label class="control-label">Kecamatan :</label>
                                                            <!-- combobox('jenis=db,1d,2d', 'array', 'name', 'value', 'value_name', 'selected', 'js', 'label', 'script') -->
															<?php combobox('db', $kecamatan, 'kecamatan_kode', 'kecamatan_kode', 'kecamatan_nama', '', 'show_form_deskel();', 'Pilih Kecamatan', 'class="select2_category form-control" tabindex="1" required="required"'); ?>
														</div>
                                                    </div>
                                                    <!--/span-->
                                                    <div class="col-md-5">
                                                    	<div class="form-group" id="tampil_combobox_deskel">
															<label class="control-label">Desa/Kelurahan :</label>
															<select class="select2_category form-control" data-placeholder="Pilih Desa/Kelurahan" tabindex="1">
															</select>
														</div>
                                                    </div>
                                                    <!--/span-->
                                                    <div class="col-md-1">
                                                    	<div class="form-group">
															<label class="control-label" for="rw">RW :</label>
															<input type="text" class="form-control" name="rw" id="rw" placeholder="">
														</div>
                                                    </div>
                                                    <!--/span-->
                                                    <div class="col-md-1">
                                                    	<div class="form-group">
															<label class="control-label" for="rt">RT :</label>
															<input type="text" class="form-control" name="rt" id="rt" placeholder="">
														</div>
                                                    </div>
                                                    <!--/span-->
                                                </div>
                                                <!--/row-->

                                                
                                                <div class="row">
                                                	<div class="col-md-12">
                                                    	<div class="form-group">
															<label class="control-label" for="alamat">Alamat/Tempat Kegiatan :</label>
															<input type="text" class="form-control" name="alamat" id="alamat" placeholder="">
														</div>
                                                    </div>
                                                    <!--/span-->
                                                </div>
                                                <!--/row-->
                                                
                                                <h3 class="form-section">Data Pendukung</h3>
                                                <div class="row">
                                                	<?php for($i=0;$i<6;$i++){?>
                                                	<div class="col-md-2 box-image">
														<input type="file" name="photo[<?php echo $i; ?>]" id="photo<?php echo $i; ?>" style="display:none;" />
														<div class="btn-photo" onclick="$('#photo<?php echo $i; ?>').click();">
															&nbsp;
															<span class="fa fa-plus" style="display:block;text-align:center;padding:25px;"></span>
														</div>
														<div id="photo-preview<?php echo $i; ?>" class="photo-preview" style="display: none;"><img src="" id="img-preview<?php echo $i; ?>" style="width:100%;height:auto;" /></div>
														<div id="action-preview<?php echo $i; ?>" class="action-preview" style="display: none;">
															<span>
																<i class="fa fa-check" style="position: absolute; left:0px;" id="accept-upload<?php echo $i; ?>" class="accept-upload" title="Upload">&nbsp;</i>
																<i class="fa fa-times" style="position: absolute; right:0px;" id="cancel-upload<?php echo $i; ?>" class="cancel-upload" title="Remove">&nbsp;</i>
															</span>
														</div>
														&nbsp;
													</div>
													<?php } ?>
                                                </div>
                                                <!--/row-->
                                                                                                
                                                <div class="row">
                                                	<div class="col-md-5">
														<div class="form-group"><!-- Memberikan Jarak --></div>
                                                    </div>
                                                </div>
                                                <!--/row-->
                                                
                                                <div class="row">
                                                	<div class="col-md-5">
														<div class="form-group">
                                                        	<label class="control-label">Latitude, Longitude (GPS Lokasi) :</label>
                                                        	<div class="input-group">
                                                                <input type="text" id="latlong" name="gps" class="form-control" placeholder="-6.99383223 , 107.74648674" readonly="readonly">
                                                                <span class="input-group-btn">
                                                                <a class="btn red" href="#mapsGoogle" data-toggle="modal"><span class="fa fa-map-marker"></span> Ambil Lokasi</a>
                                                                </span>
                                                            </div>
														</div>
													</div>
                                                </div>
                                                <!--/row-->
											</div>
											<div class="form-actions">
												<div class="row">
													<div class="col-md-6">
														<div class="row">
															<div class="col-md-offset-3 col-md-9">
																<button type="submit" class="btn green"><i class="fa fa-check"></i> Simpan Data</button>
																<button type="button" class="btn default"><i class="fa fa-times"></i> Batal</button>
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
                                <!-- Peta Google-->
                               	<div id="mapsGoogle" class="modal fade" role="dialog" aria-hidden="true">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
											<h4 class="modal-title">Google Maps</h4>
										</div>
										<div class="modal-body">
											<input type="hidden" id="latitudelongitude">
											<div id="map-canvas" style="display:block;width:100%;height:420px;"></div>
										<div class="modal-footer">
											<button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Keluar</button>
											<button type="button" class="btn btn-primary" id="btn-save-coord" data-dismiss="modal"><i class="fa fa-check"></i> Simpan Lokasi</button>
										</div>
									</div>
								</div>
							</div>
					<!-- END SAMPLE TABLE PORTLET-->
				</div>
			</div>
     
		</div>
		
	</div>
	<!-- END CONTENT -->
    
    <script type="text/javascript">
	var map;
	var geocoder;
	var marker;
	var infowindow;

	function initialize() {
		var latlng = new google.maps.LatLng(-6.8908423, 107.6149398);
		var myOptions = {
			zoom: 14,
			center: latlng,
			mapTypeControl: false,
			scaleControl: false,
			overviewMapControl: false,
			streetViewControl: false,
			panControl: false,
			zoomControl: false
		};
		map = new google.maps.Map(document.getElementById("map-canvas"),
				myOptions);
		geocoder = new google.maps.Geocoder();
		marker = new google.maps.Marker({
			position: latlng,
			map: map
		});

		map.streetViewControl = false;
		infowindow = new google.maps.InfoWindow({
			content: "<div style='width: 160px;text-align: center;'>(-6.8908423, 107.6149398)</div>"
		});

		google.maps.event.addListener(map, 'click', function(event) {
			marker.setPosition(event.latLng);

			var yeri = event.latLng;

			var latlongi = "<div style='width: 160px;text-align: center;'>(" + yeri.lat().toFixed(6) + " , " +
					+yeri.lng().toFixed(6) + ")</div>";

			infowindow.setContent(latlongi);

			document.getElementById('latitudelongitude').value = yeri.lat().toFixed(6) + ", " + yeri.lng().toFixed(6);
		});
		infowindow.open(map, marker);
	}
	
	function loadScript() {
		var script = document.createElement('script');
		script.type = 'text/javascript';
		script.src = 'https://maps.googleapis.com/maps/api/js?sensor=false&' +
				'callback=initialize';
		document.body.appendChild(script);
	}

	window.onload = loadScript;

	</script>