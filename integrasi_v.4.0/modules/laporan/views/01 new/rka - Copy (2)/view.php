<!-- Main Content --><section class="content">
		<h2>RKA<small> cetak laporan</small></h2>  
			<div class="body">
				<ol class="breadcrumb breadcrumb-col-cyan">
					<li><a href="<?php echo site_url('dashboard');?>"><i class="material-icons">home</i> Home</a></li>
					<li><a href="<?php echo site_url('laporan');?>"> Laporan</a></li>
				</ol>
			</div>
            <!-- Multiple Items To Be Open -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
						<div class="header bg-pink">
                            <h2>Cetak Laporan<small> Belanja Langsung</small></h2>
                            <ul class="header-dropdown m-r--5">
								<li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="javascript:void(0);">Back</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <div class="row clearfix">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <!-- Tab panes -->									
									<div class="body">
										<div class="row clearfix">
											<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
											<form action="<?php echo site_url('anggaran-kas/murni/preview/'.$kode);?>" id="form_validation" class="horizontal-form" method="post">
												<div class="row">
													<div class="col-md-7">
													<p>SKPD Pelaksana <span class="required">*</span></p>
														<div class="form-group form-float">
														<div class="form-line">
														<?php if ($skpd_aktive == 'yes') { combobox('db', $skpd, 'skpd_kode', 'skpd_kode', 'skpd_nama', '', 'show_form_tahapan_by_skpd();', 'Pilih SKPD Pelaksana', 'class="form-control show-tick" data-live-search="true" tabindex="1" required="required"'); 
														} else { 
														echo '<select class="select2_category form-control" name="skpd_kode" id="skpd_kode" data-placeholder="Pilih SKPD Pelaksana" tabindex="1" required="required">
														<option value="'.$skpd_kode.'" selected>'.$skpd_nama.'</option>
														</select>';
														} ?>
														</div>
														</div>
													</div>
												</div>
												
												<div class="row">	
													<div class="col-md-3">
														<p>Jenis Anggaran <span class="required">*</span></p>
														<div class="form-group form-float">														
														<div class="form-line" id="tampil_combobox_tahapan_by_skpd">
														</div>
														</div>
													</div>
													
													<div class="col-md-4">
														<p>Jenis Belanja <span class="required">*</span></p>
														<div class="form-group form-float">														
														<div class="form-line" id="tampil_combobox_tahapan_by_tipe">
														</div>
														</div>
													</div>
												</div>

												<div class="row">													
													
													<div class="col-md-3">
													<p>Tahun <span class="required">*</span></p>
														<div class="form-group form-float">
														<div class="form-line" id="tampil_combobox_tipe_by_tahun">
														</div>
														</div>
													</div>
												</div>

												<div class="row">
													<div class="col-md-10">
													<p>Program</p>
													<div class="form-group form-float">
														<div class="form-line" id="tampil_combobox_tahun_by_program">
															<select name="bbb_kode" id="bbb_kode" class="form-control show-tick" data-live-search="true" tabindex="1"><option value="">Semua Program</option></select>															
														</div>
													</div>
													</div>
												</div>
												
												<div class="row">
													<div class="col-md-10">
													<p>Kegiatan</p>
													<div class="form-group form-float">
														<div class="form-line" id="tampil_combobox_kegiatan_by_program">
															<select name="ccc_kode" id="ccc_kode" class="form-control show-tick" data-live-search="true" tabindex="1"><option value="">Semua Kegiatan</option></select>
														</div>
													</div>
													</div>
												</div>
												
												<h4>Form TandaTangan :</h4><br>
												<div class="row">
													<div class="col-md-3">													
														<div class="form-group">
															<p>Tanggal Laporan</p>
															<div class="input-group input-medium date date-picker" data-date-format="yyyy-mm-dd">
																<input type="text" class="form-control" name="tanggal" id="tanggal" value="<?php echo date("Y-m-d");?>" readonly>
																<span class="input-group-btn">
																<button class="btn default" type="button"><i class="material-icons">today</i></button>
																</span>
															</div>
														</div>
													</div>
												</div>
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
														<a href="<?php echo site_url('anggaran-kas/murni/belanja/'.$kode);?>" class="btn default">Kembali</a>
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
<script>
	function show_form_tahapan_by_skpd(){
		var skpd_kode = $('select[name=skpd_kode]').val();
		load('laporan/rka/tampil_combobox_tahapan_by_skpd/'+skpd_kode, '#tampil_combobox_tahapan_by_skpd');
	}
	function show_form_tahapan_by_tipe(){
		var tipe_kode = $('select[name=tipe_kode]').val();
		load('laporan/rka/tampil_combobox_tahapan_by_tipe/'+tipe_kode, '#tampil_combobox_tahapan_by_tipe');
	}
	function show_form_tipe_by_tahun(){
		var tahun_kode = $('select[name=tahun_kode]').val();
		load('laporan/rka/tampil_combobox_tipe_by_tahun/'+tahun_kode, '#tampil_combobox_tipe_by_tahun');
	}
	function show_form_tahun_by_program(){
		var program_kode = $('select[name=program_kode]').val();
		load('laporan/rka/tampil_combobox_tahun_by_program/'+program_kode, '#tampil_combobox_tahun_by_program');
	}

	
	
	
	
	function show_form_program_by_skpd(){
		var aaa_kode = $('select[name=aaa_kode]').val();
		load('laporan/rka/tampil_combobox_program_by_skpd/'+aaa_kode, '#tampil_combobox_program_by_skpd');
		load('laporan/rka/tampil_combobox_kegiatan_by_program/', '#tampil_combobox_kegiatan_by_program');
	}
	function show_form_kegiatan_by_program(){
		var bbb_kode = $('select[name=bbb_kode]').val();
		load('laporan/rka/tampil_combobox_kegiatan_by_program/'+bbb_kode, '#tampil_combobox_kegiatan_by_program');
	}
</script>