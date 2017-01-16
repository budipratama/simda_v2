<!-- BEGIN CONTENT -->
	<div class="page-content-wrapper">
		<div class="page-content">
			<!-- BEGIN PAGE HEADER-->
			<h3 class="page-title">
			Tambah Pra APBD Kabupaten <small>anggaran belanja langsung</small>
			</h3>
			<div class="page-bar">
				<ul class="page-breadcrumb">
					<li>
						<i class="fa fa-home"></i>
						<a href="<?php echo site_url('dashboard');?>">Home</a>
						<i class="fa fa-angle-right"></i>
					</li>
                    <li>
						<a href="<?php echo site_url('draf-apbd');?>">Pra APBD Kabupaten</a>
						<i class="fa fa-angle-right"></i>
					</li>
                     <li>
						<a href="#">Tambah Belanja Langsung</a>
					</li>
				</ul>
			</div>
			
            <div class="note note-warning">
				<p>
					NOTE: Silahkan isi form tambah Pra APBD Kabupaten ini dengan data-data yang valid!. Sesuai dengan arahan dari BAPPEDA Kabupaten Bekasi.
				</p>
			</div>
			<!-- END PAGE HEADER-->
			<?php echo validation_errors(); ?>
			<!-- BEGIN FORM -->
			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN SAMPLE TABLE PORTLET-->
					<div class="portlet box green">
									<div class="portlet-title">
										<div class="caption">
											<i class="fa fa-paper-plane"></i>Tambah Pra APBD Kabupaten
										</div>
									</div>
									<div class="portlet-body form">
										<!-- BEGIN FORM-->
										<form action="<?php echo site_url('draf-apbd/murni/insert/bl');?>" class="horizontal-form" enctype="multipart/form-data" method="post">
											<div class="form-body">
												<h3 class="form-section">Detail Kegiatan</h3>
												<div class="row">
													<div class="col-md-3">
														<div class="form-group">
															<label class="control-label" for="tahun">Tahun Anggaran <span class="required">*</span> :</label>
															<?php combobox('db', $tahun, 'tahun', 'tahun', 'tahun', '', '', 'Pilih Tahun Anggaran', 'class="select2_category form-control" tabindex="1" required="required"'); ?>
														</div>
													</div>
													<!--/span-->
                                                	<div class="col-md-9">
														<div class="form-group">
															<label class="control-label" for="skpd_kode">SKPD Pelaksana <span class="required">*</span> :</label>
															<?php if ($skpd_aktive == 'yes') { combobox('db', $skpd, 'skpd_kode', 'skpd_kode', 'skpd_nama', '', 'show_form_misi_by_skpd();', 'Pilih SKPD Pelaksana', 'class="select2_category form-control" tabindex="1" required="required"'); 
															} else { 
															echo '<select class="select2_category form-control" name="skpd_kode" id="skpd_kode" data-placeholder="Pilih SKPD Pelaksana" tabindex="1" required="required">
															<option value="'.$skpd_kode.'" selected>'.$skpd_nama.'</option>
															</select>';
															} ?>
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
														<div class="form-group" id="tampil_combobox_misi_by_skpd">
															<label class="control-label" for="misi_kode">Misi Kabupaten Bekasi <span class="required">*</span> :</label>
															<?php if ($skpd_aktive == 'no') { combobox('db', $misi, 'misi_kode', 'misi_kode', 'misi_nama', '', 'show_form_tujuan_by_misi();', 'Pilih Misi', 'class="select2_category form-control" tabindex="1" required="required"'); 
															} else {
															echo '<select class="select2_category form-control" name="misi_kode" id="misi_kode" data-placeholder="Pilih Misi Kabupaten Bekasi" tabindex="1" required="required">';
															}
															?>
															</select>
														</div>
													</div>
													<!--/span-->
                                                </div>
                                                <!--/row-->
												
                                                <div class="row">
                                                	<div class="col-md-6">
														<div class="form-group">
															<label class="control-label" for="prioritas_kode">Prioritas Daerah <span class="required">*</span> :</label>
															<?php combobox('db', $prioritas, 'prioritas_kode', 'kode', 'prioritas', '', '', 'Pilih Prioritas', 'class="select2_category form-control" tabindex="1" required="required"'); ?>
														</div>
													</div>
													<!--/span-->
                                                	<div class="col-md-6">
														<div class="form-group" id="tampil_combobox_tujuan_by_misi">
															<label class="control-label" for="tujuan_kode">Tujuan Anggaran <span class="required">*</span> :</label>
															<select class="select2_category form-control" name="tujuan_kode" id="tujuan_kode" data-placeholder="Pilih Tujuan Anggaran" tabindex="1" required="required">
															</select>
														</div>
													</div>
													<!--/span-->
                                                </div>
                                                <!--/row-->
												<div class="row">
                                                	<div class="col-md-6">
														<div class="form-group" id="tampil_combobox_sasaran_by_tujuan">
															<label class="control-label" for="sasaran_kode">Sasaran Daerah <span class="required">*</span> :</label>
															<select class="select2_category form-control" name="sasaran_kode" id="sasaran_kode" data-placeholder="Pilih Sasaran Daerah" tabindex="1" required="required">
															</select>
														</div>
													</div>
													<!--/span-->
                                                	<div class="col-md-6">
														<div class="form-group" id="tampil_combobox_indikator_by_sasaran">
															<label class="control-label" for="indikator_kode">Indikator Sasaran <span class="required">*</span> :</label>
															<select class="select2_category form-control" name="indikator_kode" id="indikator_kode" data-placeholder="Pilih Indikator Sasaran" tabindex="1" required="required">
															</select>
														</div>
													</div>
													<!--/span-->
                                                </div>
                                                <!--/row-->
                                                <div class="row">
                                                	<div class="col-md-6">
														<div class="form-group" id="tampil_combobox_urusan_by_indikator">
															<label class="control-label" for="urusan_kode">Urusan <span class="required">*</span> :</label>
															<select class="select2_category form-control" name="urusan_kode" id="urusan_kode" data-placeholder="Pilih Urusan" tabindex="1" required="required">
															</select>
														</div>
													</div>
													<!--/span-->
                                                	<div class="col-md-6">
														<div class="form-group" id="tampil_combobox_program_by_urusan">
															<label class="control-label" for="program_kode">Program <span class="required">*</span> :</label>
															<select class="select2_category form-control" name="program_kode" id="program_kode" data-placeholder="Pilih Program" tabindex="1" required="required">
															</select>
														</div>
													</div>
													<!--/span-->
                                                </div>
                                                <!--/row-->
                                                
                                                <div class="row">
                                                	<div class="col-md-12">
														<div class="form-group" id="tampil_combobox_kegiatan_by_program">
															<label class="control-label" for="kegiatan">Nama Kegiatan <span class="required">*</span> :</label>
															<input type="text" class="form-control" name="kegiatan" id="kegiatan" required="required">
														</div>
													</div>
													<!--/span-->
                                                </div>
                                                <!--/row-->
                                                
												<div class="row">
                                                	<div class="col-md-12">
														<div class="form-group" id="tampil_combobox_kegiatan_lainnya">
															
														</div>
													</div>
													<!--/span-->
                                                </div>
                                                <!--/row-->
                                                
                                                <div class="row">
                                                	<div class="col-md-5">
														<div class="form-group">
															<label class="control-label">Jenis Kegiatan <span class="required">*</span> :</label>
															<div class="radio-list">
																<?php radiolist($sifat, 'sifat_kode', 'sifat_kode', 'sifat_nama', 1);?>
															</div>
														</div>
													</div>
													<!--/span-->
                                                    <div class="col-md-4">
														<div class="form-group">
															<label class="control-label">Kesepakatan <span class="required">*</span> :</label>
															<div class="radio-list">
																<?php radiolist($kesepakatan, 'kesepakatan_kode', 'kode', 'nama', 1);?>
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
														<div class="form-group" id="tampil_combobox_hasil_by_program">
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
															<label class="control-label" for="apbd_kab">APBD Kabupaten <span class="required">*</span> : </label>
															<input type="text" class="form-control" name="apbd_kab" id="apbd_kab" style="text-align:right;" onkeypress="return isNumber(event)" onkeyup="totalAsumsi()" placeholder="0" required="required">
														</div>
													</div>
													<!--/span-->
                                                    <div class="col-md-4">
														<div class="form-group">
															<label class="control-label" for="apbd_prov">APBD Provinsi :</label>
															<input type="text" class="form-control" name="apbd_prov" id="apbd_prov" style="text-align:right;" onkeypress="return isNumber(event)" onkeyup="totalAsumsi()" placeholder="0">
														</div>
													</div>
													<!--/span-->
                                                    <div class="col-md-4">
														<div class="form-group">
															<label class="control-label" for="apbn">APBN/PHLN :</label>
															<input type="text" class="form-control" name="apbn" style="text-align:right;" onkeypress="return isNumber(event)" onkeyup="totalAsumsi()" id="apbn" placeholder="0">
														</div>
													</div>
													<!--/span-->
                                                </div>
                                                <!--/row-->
                                                
                                                <div class="row">
                                                	<div class="col-md-4">
														<div class="form-group">
															<label class="control-label" for="sumberlain">Sumber Lainnya :</label>
															<input type="text" class="form-control" name="sumberlain" id="sumberlain" style="text-align:right;" onkeypress="return isNumber(event)" onkeyup="totalAsumsi()" placeholder="0">
														</div>
													</div>
													<!--/span-->
                                                    <div class="col-md-4">
														<div class="form-group">
															<label class="control-label" for="total_asumsi"><strong>Total Pendanaan</strong> :</label>
															<input type="text" class="form-control" name="total_asumsi" id="total_asumsi" style="text-align:right;font-weight:bold;" placeholder="0" readonly="readonly">
														</div>
													</div>
													<!--/span-->
                                                    <div class="col-md-4">
														<div class="form-group">
															<label class="control-label" for="perkiraan_maju">Perkiraan Maju :</label>
															<input type="text" class="form-control" name="perkiraan_maju" id="perkiraan_maju" onkeypress="return isNumber(event)" style="text-align:right;" placeholder="0">
														</div>
													</div>
													<!--/span-->
                                                </div>
                                                <!--/row-->
                                               
                                                <h3 class="form-section">Lokasi Kegiatan</h3>
												<input type="hidden" name="lokasi_kode" value="3">
                                                <div class="row">
                                                	<div class="col-md-5">
                                                    	<div class="form-group">
															<label class="control-label">Kecamatan <span class="required">*</span> :</label>
                                                            <!-- combobox('jenis=db,1d,2d', 'array', 'name', 'value', 'value_name', 'selected', 'js', 'label', 'script') -->
															<?php combobox('db', $kecamatan, 'kecamatan_kode', 'skpd_kd', 'skpd_nama', '', 'show_form_deskel_by_kecamatan();', 'Pilih Kecamatan', 'class="select2_category form-control" tabindex="1" required="required"'); ?>
														</div>
                                                    </div>
                                                    <!--/span-->
                                                    <div class="col-md-5">
                                                    	<div class="form-group" id="tampil_combobox_deskel_by_kecamatan">
															<label class="control-label" for="deskel_kode">Desa/Kelurahan <span class="required">*</span> :</label>
															<select class="select2_category form-control" name="deskel_kode" id="deskel_kode" data-placeholder="Pilih Desa/Kelurahan" tabindex="1" required="required">
															</select>
														</div>
                                                    </div>
                                                    <!--/span-->
                                                    <div class="col-md-1">
                                                    	<div class="form-group">
															<label class="control-label" for="rw">RW :</label>
															<input type="text" class="form-control" name="rw" id="rw" placeholder="" maxlength="3">
														</div>
                                                    </div>
                                                    <!--/span-->
                                                    <div class="col-md-1">
                                                    	<div class="form-group">
															<label class="control-label" for="rt">RT :</label>
															<input type="text" class="form-control" name="rt" id="rt" placeholder="" maxlength="3">
														</div>
                                                    </div>
                                                    <!--/span-->
                                                </div>
                                                <!--/row-->

                                                
                                                <div class="row">
                                                	<div class="col-md-12">
                                                    	<div class="form-group">
															<label class="control-label" for="alamat">Alamat/Tempat Kegiatan <span class="required">*</span> :</label>
															<input type="text" class="form-control" name="alamat" id="alamat" placeholder="" required="required">
														</div>
                                                    </div>
                                                    <!--/span-->
                                                </div>
                                                <!--/row-->
												
                                                <h3 class="form-section">Data Pendukung</h3>
												<style>
												.photo-preview { margin-top:-115px;}
												</style>
												<div class="row">
													<div class="col-md-3">
														<div class="form-group">
															<label class="control-label" for="proposal">Proposal :</label>
															<input type="checkbox" name="proposal" id="proposal" class="make-switch" data-on-text="&nbsp;ADA&nbsp;" data-off-text="&nbsp;TIDAK&nbsp;" data-on-color="primary" data-off-color="default">
														</div>
													</div>
													<div class="col-md-3">
														<div class="form-group">
															<label class="control-label" for="verifikasi">Verifikasi :</label>
															<input type="checkbox" name="verifikasi" id="verifikasi" class="make-switch" data-on-text="&nbsp;SUDAH&nbsp;" data-off-text="&nbsp;BELUM&nbsp;" data-on-color="success" data-off-color="default">
														</div>
													</div>
												</div>
                                                <div class="row">
													<div class="col-md-5">
														<label class="control-label">Foto Keadaan Sekarang :</label>
													</div>
												</div>
												<div class="row">
													<?php for($i=0;$i<6;$i++){?>
                                                	<div class="col-md-2 box-image">
														<input type="file" name="photo[<?php echo $i; ?>]" id="photo<?php echo $i; ?>" style="display:none;" />
														<div class="btn-photo" onclick="$('#photo<?php echo $i; ?>').click();" style="border:1px solid #cdcdcd; padding-bottom:30px;cursor:pointer;">
															&nbsp;
															<span class="fa fa-plus" style="display:block;text-align:center;padding:25px;"></span>
														</div>
														<div id="photo-preview<?php echo $i; ?>" class="photo-preview" style="display: none;"><img src="" id="img-preview<?php echo $i; ?>" style="width:100%;height:auto;" /></div>
														<div id="action-preview<?php echo $i; ?>" class="action-preview" style="display: none;">
															<span>
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
                                                        	<label class="control-label">Latitude, Longitude (Titik Koordinat) :</label>
                                                        	<div class="input-group">
                                                                <input type="text" class="form-control" placeholder="-6.238634, 107.140463" readonly="readonly">
                                                                <span class="input-group-btn">
                                                                <a class="btn red" href="#myModal" data-toggle="modal"><span class="fa fa-map-marker"></span> Ambil Lokasi</a>
                                                                </span>
                                                            </div>
														</div>
													</div>
                                                </div>
                                                <!--/row-->
												
												<div class="row">
                                                	<div class="col-md-12">
                                                    	<div class="form-group">
															<label class="control-label" for="catatan">Catatan :</label>
															<textarea class="form-control" name="catatan" id="catatan"></textarea>
														</div>
                                                    </div>
                                                    <!--/span-->
                                                </div>
                                                <!--/row-->
												
											</div>
											<div class="form-actions">
												<div class="row">
													<div class="col-md-6">
														<div class="row">
															<div class="col-md-offset-3 col-md-9">
																<button type="submit" class="btn green"><i class="fa fa-check"></i> Simpan & Tambah Data</button>
																<a href="<?php echo site_url('draf-apbd/murni');?>" class="btn default"><i class="fa fa-times"></i> Batal</a>
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
	<!-- END CONTENT -->
    <script>	
	function show_form_misi_by_skpd(){
		var skpd_kode = $('select[name=skpd_kode]').val();
		load('draf-apbd/murni/tampil_combobox_misi_by_skpd/'+skpd_kode, '#tampil_combobox_misi_by_skpd');
		load('draf-apbd/murni/tampil_combobox_tujuan_by_misi/', '#tampil_combobox_tujuan_by_misi');
		load('draf-apbd/murni/tampil_combobox_sasaran_by_tujuan/', '#tampil_combobox_sasaran_by_tujuan');
		load('draf-apbd/murni/tampil_combobox_indikator_by_sasaran/', '#tampil_combobox_indikator_by_sasaran');
		load('draf-apbd/murni/tampil_combobox_urusan_by_indikator/', '#tampil_combobox_urusan_by_indikator');
		load('draf-apbd/murni/tampil_combobox_program_by_urusan/', '#tampil_combobox_program_by_urusan');
	}
	
	function show_form_tujuan_by_misi(){
		var skpd_kode = $('select[name=skpd_kode]').val();
		var misi_kode = $('select[name=misi_kode]').val();
		load('draf-apbd/murni/tampil_combobox_tujuan_by_misi/'+skpd_kode+'/'+misi_kode, '#tampil_combobox_tujuan_by_misi');
		load('draf-apbd/murni/tampil_combobox_sasaran_by_tujuan/', '#tampil_combobox_sasaran_by_tujuan');
		load('draf-apbd/murni/tampil_combobox_indikator_by_sasaran/', '#tampil_combobox_indikator_by_sasaran');
		load('draf-apbd/murni/tampil_combobox_urusan_by_indikator/', '#tampil_combobox_urusan_by_indikator');
		load('draf-apbd/murni/tampil_combobox_program_by_urusan/', '#tampil_combobox_program_by_urusan');
	}
	
	function show_form_sasaran_by_tujuan(){
		var skpd_kode = $('select[name=skpd_kode]').val();
		var tujuan_kode = $('select[name=tujuan_kode]').val();
		load('draf-apbd/murni/tampil_combobox_sasaran_by_tujuan/'+skpd_kode+'/'+tujuan_kode, '#tampil_combobox_sasaran_by_tujuan');
		load('draf-apbd/murni/tampil_combobox_indikator_by_sasaran/', '#tampil_combobox_indikator_by_sasaran');
		load('draf-apbd/murni/tampil_combobox_urusan_by_indikator/', '#tampil_combobox_urusan_by_indikator');
		load('draf-apbd/murni/tampil_combobox_program_by_urusan/', '#tampil_combobox_program_by_urusan');
	}
	
	function show_form_indikator_by_sasaran(){
		var skpd_kode = $('select[name=skpd_kode]').val();
		var tujuan_kode = $('select[name=tujuan_kode]').val();
		var sasaran_kode = $('select[name=sasaran_kode]').val();
		load('draf-apbd/murni/tampil_combobox_indikator_by_sasaran/'+skpd_kode+'/'+tujuan_kode+'/'+sasaran_kode, '#tampil_combobox_indikator_by_sasaran');
		load('draf-apbd/murni/tampil_combobox_urusan_by_indikator/', '#tampil_combobox_urusan_by_indikator');
		load('draf-apbd/murni/tampil_combobox_program_by_urusan/', '#tampil_combobox_program_by_urusan');
	}
	
	function show_form_urusan_by_indikator(){
		var skpd_kode = $('select[name=skpd_kode]').val();
		var tujuan_kode = $('select[name=tujuan_kode]').val();
		var indikator_kode = $('select[name=indikator_kode]').val();
		load('draf-apbd/murni/tampil_combobox_urusan_by_indikator/'+skpd_kode+'/'+tujuan_kode+'/'+indikator_kode, '#tampil_combobox_urusan_by_indikator');
		load('draf-apbd/murni/tampil_combobox_program_by_urusan/', '#tampil_combobox_program_by_urusan');
	}
	
	function show_form_program_by_urusan(){
		var skpd_kode = $('select[name=skpd_kode]').val();
		var urusan_kode = $('select[name=urusan_kode]').val();
		load('draf-apbd/murni/tampil_combobox_program_by_urusan/'+skpd_kode+'/'+urusan_kode, '#tampil_combobox_program_by_urusan');
	}
	
	function show_form_kegiatan_by_program(){
		var skpd_kode = $('select[name=skpd_kode]').val();
		var urusan_kode = $('select[name=urusan_kode]').val();
		var program_kode = $('select[name=program_kode]').val();
		load('draf-apbd/murni/tampil_combobox_kegiatan_by_program/'+urusan_kode+'/'+program_kode+'/'+skpd_kode, '#tampil_combobox_kegiatan_by_program');
		load('draf-apbd/murni/tampil_combobox_hasil_by_program/'+program_kode, '#tampil_combobox_hasil_by_program');
	}
	
	function show_form_kegiatan_lainnya(){
		var kegiatan = $('select[name=kegiatan]').val();
		load('draf-apbd/murni/tampil_kegiatan_lainnya/'+kegiatan, '#tampil_combobox_kegiatan_lainnya');
	}

	function show_form_deskel_by_kecamatan(){
		var kecamatan_kode = $('select[name=kecamatan_kode]').val();
		load('draf-apbd/murni/tampil_combobox_deskel_by_kecamatan2/'+kecamatan_kode, '#tampil_combobox_deskel_by_kecamatan');
	}
	
	</script>
   