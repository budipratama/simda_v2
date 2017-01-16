<!-- Main Content -->   
   <section class="content">
		<h2>Tambah Pra Rencana Kerja <small> anggaran belanja langsung</small></h2>  
			<div class="body">
				<ol class="breadcrumb breadcrumb-col-blue-grey">
					<li><a href="<?php echo site_url('dashboard');?>"><i class="material-icons">home</i> Home</a></li>
					<li><a href="<?php echo site_url('pra-rencana-kerja');?>"> Pra Rencana Kerja</a></li>
					<li class="active"> Tambah</li>
				</ol>
			</div>	
            <!-- Multiple Items To Be Open -->
			<?php if ($this->session->flashdata('success')) { echo $this->session->flashdata('success');} ?>
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
						<div class="header"><h2>Detail Kegiatan</h2></div>
                        <div class="body">
                            <div class="row clearfix">
							<div class="body">
							<form action="<?php echo site_url('pra-rencana-kerja/insert/bl');?>" id="form_validation" enctype="multipart/form-data" method="POST">
								<div class="row clearfix">
									<div class="col-md-3">
										<p><b>Tahun <span class="required">*</span></b></p>
										<div class="form-group form-float">
											<div class="form-line">										
											<?php combobox('db', $tahun, 'tahun', 'tahun', 'tahun', $tahun_, '', 'Pilih Tahun Anggaran', 'class="form-control show-tick" data-live-search="true" tabindex="1" required="required"'); ?>
											</div>								
										</div>								
									</div>								
									<div class="col-md-3">
										<p><b>SKPD Pelaksana <span class="required">*</span></b></p>
										<div class="form-group form-float">
											<div class="form-line">
											<?php if ($skpd_aktive == 'yes') { combobox('db', $skpd, 'skpd_kode', 'skpd_kode', 'skpd_nama', '', 'show_form_misi_by_skpd();', 'Pilih SKPD Pelaksana', 'class="form-control show-tick" data-live-search="true" tabindex="1" required="required"'); 
											} else { 
											echo '<select class="select2_category form-control" name="skpd_kode" id="skpd_kode" data-placeholder="Pilih SKPD Pelaksana" tabindex="1" required="required">
											<option value="'.$skpd_kode.'" selected>'.$skpd_nama.'</option>
											</select>';
											} ?>
											</div>
										</div>
									</div>
								</div>
								<div class="row clearfix">
									<div class="col-md-12">
										<p><b>Visi Kabupaten Bekasi :</b></p>
										<div class="form-group form-float">
											<div class="form-line">										
											<?php echo $visi->visi;?>
											</div>								
										</div>								
									</div>
								</div>
								<div class="row clearfix">
									<div class="col-md-12">
										<div class="form-group form-float">
											<div class="form-line" id="tampil_combobox_misi_by_skpd">
												<label class="control-label" for="misi_kode">Misi Kabupaten Bekasi <span class="required">*</span> :</label>
												<?php if ($skpd_aktive == 'no') { combobox('db', $misi, 'misi_kode', 'misi_kode', 'misi_nama', '', 'show_form_tujuan_by_misi();', 'Pilih Misi', 'class="form-control show-tick" data-live-search="true" tabindex="1" required="required"'); 
												} else {
												echo '<select class="select2_category form-control" name="misi_kode" id="misi_kode" data-placeholder="Pilih Misi Kabupaten Bekasi" tabindex="1" required="required">';
												}
												?>
												</select>
											</div>								
										</div>								
									</div>
								</div>
								<div class="row clearfix">
									<div class="col-md-6">
										<div class="form-group form-float">
											<div class="form-line">
												<label class="control-label" for="prioritas_kode">Prioritas Daerah <span class="required">*</span> :</label>
												<?php combobox('db', $prioritas, 'prioritas_kode', 'kode', 'prioritas', '', '', 'Pilih Prioritas', 'class="form-control show-tick" data-live-search="true" tabindex="1" required="required"');  ?>
												</select>
											</div>								
										</div>								
									</div>
									<div class="col-md-6">
										<div class="form-group form-float">
											<div class="form-line" id="tampil_combobox_tujuan_by_misi">
												<label class="control-label" for="tujuan_kode">Tujuan Anggaran <span class="required">*</span> :</label>
												<select class="form-control show-tick" data-live-search="true" tabindex="1" required="required"></select>
											</div>								
										</div>								
									</div>
								</div>
								<div class="row clearfix">
									<div class="col-md-6">
										<div class="form-group form-float">
											<div class="form-line" id="tampil_combobox_sasaran_by_tujuan">
												<label class="control-label" for="sasaran_kode">Sasaran Daerah <span class="required">*</span> :</label>
												<select name="sasaran_kode" id="sasaran_kode" class="form-control show-tick" data-live-search="true" tabindex="1" required="required"></select>
											</div>								
										</div>								
									</div>
									<div class="col-md-6">
										<div class="form-group form-float">
											<div class="form-line" id="tampil_combobox_indikator_by_sasaran">
												<label class="control-label" for="indikator_kode">Indikator Sasaran <span class="required">*</span> :</label>
												<select name="indikator_kode" id="indikator_kode" class="form-control show-tick" data-live-search="true" tabindex="1" required="required"></select>
											</div>								
										</div>								
									</div>
								</div>
								<div class="row clearfix">
									<div class="col-md-6">
										<div class="form-group form-float">
											<div class="form-line" id="tampil_combobox_urusan_by_indikator">
												<label class="control-label" for="urusan_kode">Urusan <span class="required">*</span> :</label>
												<select name="urusan_kode" id="urusan_kode" class="form-control show-tick" data-live-search="true" tabindex="1" required="required"></select>
											</div>								
										</div>								
									</div>
									<div class="col-md-6">
										<div class="form-group form-float">
											<div class="form-line" id="tampil_combobox_program_by_urusan">
												<label class="control-label" for="program_kode">Program <span class="required">*</span> :</label>
												<select name="program_kode" id="program_kode" class="form-control show-tick" data-live-search="true" tabindex="1" required="required"></select>
											</div>								
										</div>								
									</div>
								</div>
								<div class="form-group form-float">
                                    <div class="form-line" id="tampil_combobox_kegiatan_by_program">
                                        <input type="text" class="form-control" name="kegiatan" id="kegiatan" required>
                                        <label class="form-label">Name Kegiatan</label>
                                    </div>
                                </div>			
								<div class="form-group form-float" id="tampil_combobox_kegiatan_lainnya"></div>
								<div class="row clearfix">
									<div class="col-md-5">
									<label class="control-label">Jenis Kegiatan :</label>
										<div class="form-group">
										<input type="radio" name="sifat_kode" value="1" id="baru" class="with-gap" checked>
										<label for="baru">Baru</label>
										<input type="radio" name="sifat_kode" value="2" id="lanjutan" class="with-gap">
										<label for="lanjutan">Lanjutan</label>									
										<input type="radio" name="sifat_kode" value="3" id="rehabilitasi" class="with-gap">
										<label for="rehabilitasi">Rehabilitasi</label>									
										<input type="radio" name="sifat_kode" value="4" id="perluasan" class="with-gap">
										<label for="perluasan">Perluasan</label>
										</div>
									</div>
									<div class="col-md-5">
										<label class="control-label">Kesepakatan :</label> 
										<div class="form-group">
										<input type="radio" name="kesepakatan_kode" value="1" id="prioritas" class="with-gap" checked>
										<label for="prioritas">Prioritas</label>
										<input type="radio" name="kesepakatan_kode" value="2" id="bukan_prioritas" class="with-gap">
										<label for="bukan_prioritas">Bukan Prioritas</label>									
										<input type="radio" name="kesepakatan_kode" value="3" id="debet" class="with-gap">
										<label for="debet">Debet</label>									
										<input type="radio" name="kesepakatan_kode" value="4" id="kredit" class="with-gap">
										<label for="kredit">Kredit</label>
										</div>		
									</div>
									<div class="col-md-2">
										<div class="form-group form-float">
										<div class="form-line">
											<input type="text" class="form-control" name="urutan" id="urutan" required>
											<label class="form-label">Urutan Kegiatan</label>
										</div>
										</div>	
									</div>
								</div>
							<h3 class="form-section"><b>Indikator Hasil Program</b></h3>
								<div class="row clearfix">
									<div class="col-md-12">
										<div class="form-group form-float">
										<div class="form-line" id="tampil_combobox_hasil_by_program">
											<input type="text" class="form-control" name="hp_ukur" id="hp_ukur" required>
											<label class="form-label">Tolak Ukur</label>
										</div>
										</div>	
									</div>
								</div>
								<div class="row clearfix">
									<div class="col-md-6">
										<div class="form-group form-float">
										<div class="form-line">
											<input type="text" class="form-control" name="hp_target" id="hp_target" required>
											<label class="form-label">Target</label>
										</div>
										</div>	
									</div>
									<div class="col-md-6">
										<div class="form-group form-float">
										<div class="form-line">
											<input type="text" class="form-control" name="hp_satuan" id="hp_satuan" required>
											<label class="form-label">Satuan</label>
										</div>
										</div>	
									</div>
								</div>
							<h3 class="form-section"><b>Indikator Keluaran Kegiatan</b></h3>
								<div class="row clearfix">
									<div class="col-md-12">
										<div class="form-group form-float">
										<div class="form-line" id="tampil_combobox_hasil_by_program">
											<input type="text" class="form-control" name="kh_ukur" id="kh_ukur" >
											<label class="form-label">Tolak Ukur</label>
										</div>
										</div>	
									</div>
								</div>
								<div class="row clearfix">
									<div class="col-md-6">
										<div class="form-group form-float">
										<div class="form-line">
											<input type="text" class="form-control" name="kh_target" id="kh_target" >
											<label class="form-label">Target</label>
										</div>
										</div>	
									</div>
									<div class="col-md-6">
										<div class="form-group form-float">
										<div class="form-line">
											<input type="text" class="form-control" name="kh_satuan" id="kh_satuan" >
											<label class="form-label">Satuan</label>
										</div>
										</div>	
									</div>
								</div>
							<h3 class="form-section"><b>Indikator Hasil Kegiatan</b></h3>
								<div class="row clearfix">
									<div class="col-md-12">
										<div class="form-group form-float">
										<div class="form-line" id="tampil_combobox_hasil_by_program">
											<input type="text" class="form-control" name="hk_ukur" id="hk_ukur" >
											<label class="form-label">Tolak Ukur</label>
										</div>
										</div>	
									</div>
								</div>
								<div class="row clearfix">
									<div class="col-md-6">
										<div class="form-group form-float">
										<div class="form-line">
											<input type="text" class="form-control" name="hk_target" id="hk_target" >
											<label class="form-label">Target</label>
										</div>
										</div>	
									</div>
									<div class="col-md-6">
										<div class="form-group form-float">
										<div class="form-line">
											<input type="text" class="form-control" name="hk_satuan" id="hk_satuan" >
											<label class="form-label">Satuan</label>
										</div>
										</div>	
									</div>
								</div>
							<h3 class="form-section"><b>Asumsi Biaya Pendanaan</b></h3>
								<div class="row clearfix">
									<div class="col-md-4">
										<div class="form-group form-float">
										<div class="form-line">
											<input type="text" class="form-control" name="apbd_kab" id="apbd_kab" style="text-align:right;" onkeypress="return isNumber(event)" onkeyup="totalAsumsi()" placeholder="0" required>
										<label class="form-label" for="apbd_kab">APBD Kabupaten </label>
										</div>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group form-float">
										<div class="form-line">
											<input type="text" class="form-control" name="apbd_prov" id="apbd_prov" style="text-align:right;" onkeypress="return isNumber(event)" onkeyup="totalAsumsi()" placeholder="0">
										<label class="form-label" for="apbd_prov">APBD Provinsi </label>
										</div>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group form-float">
										<div class="form-line">
											<input type="text" class="form-control" name="apbn" id="apbn" style="text-align:right;" onkeypress="return isNumber(event)" onkeyup="totalAsumsi()" placeholder="0">
										<label class="form-label" for="apbn">APBN/PHLN </label>
										</div>
										</div>
									</div>									
								</div>									
								<div class="row clearfix">
									<div class="col-md-4">
										<div class="form-group form-float">
										<div class="form-line">
											<input type="text" class="form-control" name="sumberlain" id="sumberlain" style="text-align:right;" onkeypress="return isNumber(event)" onkeyup="totalAsumsi()" placeholder="0">
										<label class="form-label" for="sumberlain">Sumber Lainnya </label>
										</div>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group form-float">
										<div class="form-line">
											<input type="text" class="form-control" name="total_asumsi" id="total_asumsi" style="text-align:right;font-weight:bold;" placeholder="0" disabled>
										<label class="form-label" for="total_asumsi">Total Pendanaan </label>
										</div>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group form-float">
										<div class="form-line">
											<input type="text" class="form-control" name="perkiraan_maju" id="perkiraan_maju" style="text-align:right;" onkeypress="return isNumber(event)" onkeyup="totalAsumsi()" placeholder="0">
										<label class="form-label" for="perkiraan_maju">Perkiraan Maju </label>
										</div>
										</div>
									</div>									
								</div>								
								<h3 class="form-section"><b>Lokasi Kegiatan</b></h3>
								<input type="hidden" name="lokasi_kode" value="3">
								<div class="row clearfix">
									<div class="col-md-5">
										<label class="control-label" for="kecamatan">Kecamatan <span class="required">*</span> :</label>
										<div class="form-group form-float">
											<div class="form-line">
											<?php combobox('db', $kecamatan, 'kecamatan_kode', 'skpd_kd', 'skpd_nama', '', 'show_form_deskel_by_kecamatan();', 'Pilih Kecamatan', 'class="form-control show-tick" data-live-search="true" tabindex="1" required="required"'); ?>
											</div>								
										</div>								
									</div>
									<div class="col-md-5">
										<div class="form-group form-float">
											<div class="form-line" id="tampil_combobox_deskel_by_kecamatan">
												<label class="control-label" for="deksel">Desa/Kelurahan <span class="required">*</span> :</label>
												<select name="deksel" id="deksel" class="form-control show-tick" data-live-search="true" tabindex="1" required="required"></select>
											</div>								
										</div>								
									</div>
									<div class="col-md-1">
										<div class="form-group form-float">
										<div class="form-line">
											<input type="text" class="form-control" name="rt" id="rt" required maxlength="3">
											<label class="form-label">RT</label>
										</div>
										</div>	
									</div>
									<div class="col-md-1">
										<div class="form-group form-float">
										<div class="form-line">
											<input type="text" class="form-control" name="rw" id="rw" required maxlength="3">
											<label class="form-label">RW</label>
										</div>
										</div>	
									</div>
								</div>
								<div class="row clearfix">
									<div class="col-md-12">
										<div class="form-group form-float">
										<div class="form-line">
											<input type="text" class="form-control" name="alamat" id="alamat" required>
											<label class="form-label">Alamat</label>
										</div>
										</div>	
									</div>
								</div>
							<h3 class="form-section"><b>Data Pendukung</b></h3>
							<div class="row">
								<div class="col-md-3">
									<div class="form-group">
										<label class="control-label" for="proposal">File TOR/KAK/RAB :</label>
										<input type="file" name="file" id="file" class="form-control">
										<span class="help-block">e.g: 5500 0000 0000 0004 </span>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-5">
									<label class="control-label">Foto Keadaan Sekarang <span class="required">*</span> :</label>
								</div>
							</div>
							<div class="row">
								<?php for($i=0;$i<6;$i++){?>
									<div class="col-md-2 box-image">
									<input type="hidden" name="delete_foto<?php echo $i; ?>" id="delete_foto<?php echo $i; ?>" value="" />
									<input type="hidden" name="foto<?php echo $i; ?>" id="foto<?php echo $i; ?>" value="" />
									<input type="file" name="photo<?php echo $i; ?>" id="photo<?php echo $i; ?>" style="display:none;" accept="image/x-png, image/gif, image/jpeg" />
										<div class="btn-photo" onclick="$('#photo<?php echo $i; ?>').click();" style="border:1px solid #cdcdcd; padding-bottom:20px;cursor:pointer;">
											<div id="photo-preview<?php echo $i; ?>" class="photo-preview" style="display: none;">
												<img src="" id="img-preview<?php echo $i; ?>" class="img-responsive">																																
											</div>
										</div>
										<div id="action-preview<?php echo $i; ?>" class="action-preview" style="display: none;">
											<div class="action-block">																											
												<a href="javascript:void(0);" class="thumbnail<?php echo $i; ?>">
													<i class="material-icons" style="position: absolute; text-align:center;" id="cancel-upload<?php echo $i; ?>" class="cancel-upload" title="Remove" style="cursor:pointer;">report_problem</i>
												</a>
											</div>
										</div>															
									</div>
								<?php } ?>
							</div>
							<div class="row">
								<div class="col-md-5">
									<div class="form-group"><!-- Memberikan Jarak --></div>
								</div>
							</div>							
							<div class="row">
								<div class="col-md-5">
									<div class="form-group">
										<label class="control-label" for="koordinat">Latitude, Longitude (Titik Koordinat) <span class="required">*</span> :</label>
										<input type="text" class="form-control" name="koordinat" id="koordinat" required="required" readonly="readonly">
										<a class="btn btn-danger" href="#mapmodals" data-toggle="modal"><span class="fa fa-map-marker"></span> Ambil Lokasi</a>
									</div>
								</div>
							</div>												
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <textarea name="catatan" id= "catatan" cols="30" rows="1" class="form-control no-resize" required></textarea>
                                        <label class="form-label">Catatan</label>
                                    </div>
                                </div>
                                <button class="btn btn-primary waves-effect" type="submit">SUBMIT</button>
								<a href="#" onClick="history.go(-1); return false;" class="btn btn-default">Batal</a>
                            </form>
							</div>
							</div>
						</div>
					</div>
				</div>
			</div>
					<!-- Peta Google-->
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
									<button type="button" class="btn btn-primary waves-effect" id="simpan_lokasi" data-dismiss="modal">Simpan Lokasi</button>
								</div>
							</div>
						</div>
					</div>
					<!-- END SAMPLE TABLE PORTLET-->
	</section>
<!-- #END# Multiple Items To Be Open -->	
  <!-- END CONTENT -->
	
    <script>
	function show_form_misi_by_skpd(){
		var skpd_kode = $('select[name=skpd_kode]').val();
		load('pra-rencana-kerja/tampil_combobox_misi_by_skpd/'+skpd_kode, '#tampil_combobox_misi_by_skpd');
		load('pra-rencana-kerja/tampil_combobox_tujuan_by_misi/', '#tampil_combobox_tujuan_by_misi');
		load('pra-rencana-kerja/tampil_combobox_sasaran_by_tujuan/', '#tampil_combobox_sasaran_by_tujuan');
		load('pra-rencana-kerja/tampil_combobox_indikator_by_sasaran/', '#tampil_combobox_indikator_by_sasaran');
		load('pra-rencana-kerja/tampil_combobox_urusan_by_indikator/', '#tampil_combobox_urusan_by_indikator');
		load('pra-rencana-kerja/tampil_combobox_program_by_urusan/', '#tampil_combobox_program_by_urusan');
	}
	
	function show_form_tujuan_by_misi(){
		var skpd_kode = $('select[name=skpd_kode]').val();
		var misi_kode = $('select[name=misi_kode]').val();
		load('pra-rencana-kerja/tampil_combobox_tujuan_by_misi/'+skpd_kode+'/'+misi_kode, '#tampil_combobox_tujuan_by_misi');
		load('pra-rencana-kerja/tampil_combobox_sasaran_by_tujuan/', '#tampil_combobox_sasaran_by_tujuan');
		load('pra-rencana-kerja/tampil_combobox_indikator_by_sasaran/', '#tampil_combobox_indikator_by_sasaran');
		load('pra-rencana-kerja/tampil_combobox_urusan_by_indikator/', '#tampil_combobox_urusan_by_indikator');
		load('pra-rencana-kerja/tampil_combobox_program_by_urusan/', '#tampil_combobox_program_by_urusan');
	}
	
	function show_form_sasaran_by_tujuan(){
		var skpd_kode = $('select[name=skpd_kode]').val();
		var tujuan_kode = $('select[name=tujuan_kode]').val();
		load('pra-rencana-kerja/tampil_combobox_sasaran_by_tujuan/'+skpd_kode+'/'+tujuan_kode, '#tampil_combobox_sasaran_by_tujuan');
		load('pra-rencana-kerja/tampil_combobox_indikator_by_sasaran/', '#tampil_combobox_indikator_by_sasaran');
		load('pra-rencana-kerja/tampil_combobox_urusan_by_indikator/', '#tampil_combobox_urusan_by_indikator');
		load('pra-rencana-kerja/tampil_combobox_program_by_urusan/', '#tampil_combobox_program_by_urusan');
	}
	
	function show_form_indikator_by_sasaran(){
		var skpd_kode = $('select[name=skpd_kode]').val();
		var tujuan_kode = $('select[name=tujuan_kode]').val();
		var sasaran_kode = $('select[name=sasaran_kode]').val();
		load('pra-rencana-kerja/tampil_combobox_indikator_by_sasaran/'+skpd_kode+'/'+tujuan_kode+'/'+sasaran_kode, '#tampil_combobox_indikator_by_sasaran');
		load('pra-rencana-kerja/tampil_combobox_urusan_by_indikator/', '#tampil_combobox_urusan_by_indikator');
		load('pra-rencana-kerja/tampil_combobox_program_by_urusan/', '#tampil_combobox_program_by_urusan');
	}
	
	function show_form_urusan_by_indikator(){
		var skpd_kode = $('select[name=skpd_kode]').val();
		var tujuan_kode = $('select[name=tujuan_kode]').val();
		var indikator_kode = $('select[name=indikator_kode]').val();
		load('pra-rencana-kerja/tampil_combobox_urusan_by_indikator/'+skpd_kode+'/'+tujuan_kode+'/'+indikator_kode, '#tampil_combobox_urusan_by_indikator');
		load('pra-rencana-kerja/tampil_combobox_program_by_urusan/', '#tampil_combobox_program_by_urusan');
	}
	
	function show_form_program_by_urusan(){
		var skpd_kode = $('select[name=skpd_kode]').val();
		var urusan_kode = $('select[name=urusan_kode]').val();
		load('pra-rencana-kerja/tampil_combobox_program_by_urusan/'+skpd_kode+'/'+urusan_kode, '#tampil_combobox_program_by_urusan');
	}
	
	function show_form_kegiatan_by_program(){
		var skpd_kode = $('select[name=skpd_kode]').val();
		var urusan_kode = $('select[name=urusan_kode]').val();
		var program_kode = $('select[name=program_kode]').val();
		load('pra-rencana-kerja/tampil_combobox_kegiatan_by_program/'+urusan_kode+'/'+program_kode+'/'+skpd_kode, '#tampil_combobox_kegiatan_by_program');
		load('pra-rencana-kerja/tampil_combobox_hasil_by_program/'+program_kode, '#tampil_combobox_hasil_by_program');
	}
	
	function show_form_kegiatan_lainnya(){
		var kegiatan = $('select[name=kegiatan]').val();
		load('pra-rencana-kerja/tampil_kegiatan_lainnya/'+kegiatan, '#tampil_combobox_kegiatan_lainnya');
	}

	function show_form_deskel_by_kecamatan(){
		var kecamatan_kode = $('select[name=kecamatan_kode]').val();
		load('pra-rencana-kerja/tampil_combobox_deskel_by_kecamatan2/'+kecamatan_kode, '#tampil_combobox_deskel_by_kecamatan');
	}
	
	function show_form_lokasi_deskel_by_kecamatan(){
		var lokasi_kecamatan = $('select[name=lokasi_kecamatan]').val();
		load('pra-rencana-kerja/tampil_combobox_deskel_by_kecamatan3/'+lokasi_kecamatan, '#tampil_combobox_lokasi_deskel_by_kecamatan');
	}
	function show_form_alamat(){
		var lokasi_skpd = $('select[name=lokasi_skpd]').val();
		load('pra-rencana-kerja/tampil_input_alamat/'+lokasi_skpd, '#tampil_input_alamat');
	}
	
	function addLokasi() {
        var btnLokasiKategori = document.getElementById('lokasi_kode');
        var inputLokasiKegiatan = document.getElementById('lokasi_kegiatan');
        var lokasi_skpd = document.getElementById('lokasi_skpd');
        var lokasi_alamat = document.getElementById('lokasi_alamat');
        var lokasi_kecamatan = document.getElementById('lokasi_kecamatan');
        var lokasi_deskel = document.getElementById('lokasi_deskel');
        var lokasi_tujuan = document.getElementById('lokasi_tujuan');
        var lokasi_tujuan2 = document.getElementById('lokasi_tujuan2');
        var tempLokasi = document.getElementById('lokasi_kegiatan').value;
		if ($('input[name=lokasi_kode]:checked').length > 0) {
			var lokasi_kode = document.querySelector('input[name="lokasi_kode"]:checked').value;
			if (lokasi_kode == '1'){
				if (lokasi_skpd.value == ""){
					alert("SKPD Harus Diisi");
				} else {
					if (lokasi_alamat.value == "" || lokasi_alamat.value == "-"){
						tempLokasi = tempLokasi + "" + lokasi_skpd.options[lokasi_skpd.selectedIndex].text + "; ";
					} else {
						tempLokasi = tempLokasi + "" + lokasi_skpd.options[lokasi_skpd.selectedIndex].text + ", " + lokasi_alamat.value + "; ";
					}
				}
			} else if (lokasi_kode == '2'){
			} else if (lokasi_kode == '3'){
				if (lokasi_kecamatan.value == ""){
					alert("Kecamatan Harus Diisi");
				} else {
					if (lokasi_tujuan.value == "" || lokasi_tujuan.value == "-"){
						if (lokasi_deskel.value == ""){
							tempLokasi = tempLokasi + "Kec. " + lokasi_kecamatan.options[lokasi_kecamatan.selectedIndex].text + "; ";
						} else {
							tempLokasi = tempLokasi + "Desa/Kel. " + lokasi_deskel.options[lokasi_deskel.selectedIndex].text + ", Kec. " + lokasi_kecamatan.options[lokasi_kecamatan.selectedIndex].text + "; ";
						}
					} else {						
						if (lokasi_deskel.value == ""){
							tempLokasi = tempLokasi + lokasi_tujuan.value + ", Kec. " + lokasi_kecamatan.options[lokasi_kecamatan.selectedIndex].text + "; ";
						} else {
							tempLokasi = tempLokasi + lokasi_tujuan.value + ", Desa/Kel. " + lokasi_deskel.options[lokasi_deskel.selectedIndex].text + ", Kec. " + lokasi_kecamatan.options[lokasi_kecamatan.selectedIndex].text + "; ";
						}
					}
				}
			} else if (lokasi_kode == '4'){
				if (lokasi_tujuan2.value == ""){
					alert("Tujuan Lokasi Harus Diisi");
				} else {
					tempLokasi = tempLokasi + lokasi_tujuan2.value + "; ";
				}
			} else if (lokasi_kode == '5'){
				if (lokasi_tujuan2.value == ""){
					alert("Tujuan Lokasi Harus Diisi");
				} else {
					tempLokasi = tempLokasi + lokasi_tujuan2.value + "; ";
				}
			}
		}
		document.getElementById('lokasi_kegiatan').value = tempLokasi;
	}
	
	function clearLokasi() {
        document.getElementById('lokasi_kegiatan').value = '';
        document.getElementById('lokasi_kegiatan').focus();
    }
	
	function checkLokasiKategori() {
        var btnLokasiKategori = document.getElementById('lokasi_kode');
		if ($('input[name=lokasi_kode]:checked').length > 0) {
			var lokasi_kode = document.querySelector('input[name="lokasi_kode"]:checked').value;
			if (lokasi_kode == '1'){
				document.getElementById('form_lokasi_skpd').style.display = 'block';
				document.getElementById('form_lokasi_alamat').style.display = 'block';
				document.getElementById('form_lokasi_tambah').style.display = 'block';
				
				document.getElementById('form_lokasi_kecdeskel').style.display = 'none';
				document.getElementById('form_lokasi_tujuan').style.display = 'none';
				document.getElementById('form_lokasi_tujuan2').style.display = 'none';
				
				document.getElementById('lokasi_kegiatan').value = '';
			} else if (lokasi_kode == '2'){
				document.getElementById('form_lokasi_skpd').style.display = 'none';
				document.getElementById('form_lokasi_alamat').style.display = 'none';
				document.getElementById('form_lokasi_tambah').style.display = 'none';
				document.getElementById('form_lokasi_kecdeskel').style.display = 'none';
				document.getElementById('form_lokasi_tujuan').style.display = 'none';
				document.getElementById('form_lokasi_tujuan2').style.display = 'none';
				
				document.getElementById('lokasi_kegiatan').value = 'Seluruh Kabupaten Bekasi';
			} else if (lokasi_kode == '3'){
				document.getElementById('form_lokasi_kecdeskel').style.display = 'block';
				document.getElementById('form_lokasi_tujuan').style.display = 'block';
				document.getElementById('form_lokasi_tambah').style.display = 'block';
				
				document.getElementById('form_lokasi_skpd').style.display = 'none';
				document.getElementById('form_lokasi_alamat').style.display = 'none';
				document.getElementById('form_lokasi_tujuan2').style.display = 'none';
				
				document.getElementById('lokasi_kegiatan').value = '';
			} else if (lokasi_kode == '4'){
				document.getElementById('form_lokasi_tujuan2').style.display = 'block';
				document.getElementById('form_lokasi_tambah').style.display = 'block';
				
				document.getElementById('form_lokasi_skpd').style.display = 'none';
				document.getElementById('form_lokasi_tujuan').style.display = 'none';
				document.getElementById('form_lokasi_alamat').style.display = 'none';
				document.getElementById('form_lokasi_kecdeskel').style.display = 'none';
				
				document.getElementById('lokasi_kegiatan').value = '';
			} else if (lokasi_kode == '5'){
				document.getElementById('form_lokasi_tujuan2').style.display = 'block';
				document.getElementById('form_lokasi_tambah').style.display = 'block';
				
				document.getElementById('form_lokasi_skpd').style.display = 'none';
				document.getElementById('form_lokasi_tujuan').style.display = 'none';
				document.getElementById('form_lokasi_alamat').style.display = 'none';
				document.getElementById('form_lokasi_kecdeskel').style.display = 'none';
				
				document.getElementById('lokasi_kegiatan').value = '';
			}
		}
	}
	</script>