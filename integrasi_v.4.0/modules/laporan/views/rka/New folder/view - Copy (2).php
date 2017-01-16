<!-- Main Content -->
	<section class="content">
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
						<div class="body">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs tab-nav-right" role="tablist">
                                <li role="presentation" class="active"><a href="#22" data-toggle="tab">RKA SKPD 2.2</a></li>
                                <li role="presentation"><a href="#221" data-toggle="tab">RKA SKPD 2.2.1</a></li>
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade in active" id="22">
                                    <b><?php if ($this->session->flashdata('success')) { echo $this->session->flashdata('success');} ?></b>
									<p><form action="<?php echo site_url('laporan/rka/preview1/'.$kode);?>" id="form_validation" class="horizontal-form" method="post">
										<input type="hidden" name="tahun" value="<?php echo $tahun;?>"/>
										<input type="hidden" name="anggaran_kode" value="<?php echo $kode;?>"/>
										<input type="hidden" name="skpd" value="<?php echo $skpd;?>"/>
										<input type="hidden" name="kode" value="<?php echo $id_kode;?>"/>

										<h5>Form TandaTangan :</h5><br>





									<div class="col-md-9">
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


										
										<!--<div class="form-group">
											<div class="col-md-offset-9">
												<button type="submit" class="btn btn-primary waves-effect" name="cetak">Lihat Laporan</button>											
												<a href="<?php echo site_url('laporan');?>" class="btn default">Kembali</a>
											</div>
										</div>-->
									</form></p>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="221">
                                    <b></b>
                                    <p><form action="<?php echo site_url('laporan/rka/preview2/'.$kode);?>" id="form_validation" enctype="multipart/form-data" class="horizontal-form" method="post">
										<input type="input" name="tahun" value="2017"/>
										<input type="input" name="anggaran_kode" value=""/>
										<input type="input" name="kode" value="<?php echo $id_kode;?>"/>
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
										<div class="row">
											<div class="col-md-6">
											<label class="form-label" for="skpd">SKPD Pelaksana :</label>
												<div class="form-group form-float">
													<div class="form-line">
													<select name="aaa_kode" id="aaa_kode" class="form-control show-tick" data-live-search="true" onchange="show_form_program_by_skpd();" tabindex="1">
														<option value="">kosong</option>
														<option value="<?php echo $skpd_kode;?>"><?php echo $skpd_nama;?></option>
													</select>													
													</div>
													<p class="font-italic col-orange">(kosong = Semua Program)</p>
												</div>
											</div>
										</div>										
										
									
										
										
											<div class="row clearfix">
												<div class="col-md-10">
													<p><b>Program <span class="required">*</span></b></p>
													<div class="form-group form-float">
														<div class="form-line" id="tampil_combobox_program_by_skpd">
															<select name="bbb_kode" id="bbb_kode" class="form-control show-tick" data-live-search="true" tabindex="1"><option value="">Semua Program</option></select>															
														</div>
													</div>
												</div>
											</div>
											<div class="row clearfix">
												<div class="col-md-10">
													<p><b>Kegiatan <span class="required">*</span></b></p>
													<div class="form-group form-float">
														<div class="form-line" id="tampil_combobox_kegiatan_by_program1">
															<select name="ccc_kode" id="ccc_kode" class="form-control show-tick" data-live-search="true" tabindex="1"><option value="">Semua Kegiatan</option></select>
														</div>
													</div>
												</div>
											</div>
										
										<h5>Form TandaTangan :</h5><br>
										<div class="row">
											<div class="col-md-6">
												<div class="form-group form-float">
													<div class="form-line">
														<input type="text" class="form-control" name="nama_pimpinan" id="nama_pimpinan" style="text-align:center;" value="<?php echo $nama_tim;?>">
														<label class="form-label" for="nama_pimpinan">Nama Pimpinan :</label>
													</div>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<div class="form-group form-float">
													<div class="form-line">
														<input type="text" class="form-control" name="pangkat" id="pangkat" style="text-align:center;" value="<?php echo $jabatan_tim;?>">
														<label class="form-label" for="pangkat">Jabatan :</label>
													</div>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<div class="form-group form-float">
													<div class="form-line">
														<input type="text" class="form-control" name="nip" id="nip" style="text-align:center;" value="<?php echo $nip_tim;?>">
														<label class="form-label" for="nip">NIP : required</label>
													</div>
												</div>
											</div>
										</div>												
										<div class="form-group">
											<div class="col-md-offset-9">
												<button type="submit" class="btn btn-primary waves-effect" name="cetak">Lihat Laporan</button>											
												<a href="<?php echo site_url('laporan');?>" class="btn default">Kembali</a>
											</div>
										</div>
									</form></p>
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
	function show_form_program_by_skpd(){
		var aaa_kode = $('select[name=aaa_kode]').val();
		load('laporan/rka/tampil_combobox_program_by_skpd/'+aaa_kode, '#tampil_combobox_program_by_skpd');
		load('laporan/rka/tampil_combobox_kegiatan_by_program1/', '#tampil_combobox_kegiatan_by_program1');
	}
	function show_form_kegiatan_by_program(){
		var bbb_kode = $('select[name=bbb_kode]').val();
		load('laporan/rka/tampil_combobox_kegiatan_by_program1/'+bbb_kode, '#tampil_combobox_kegiatan_by_program1');
	}
	</script>
	
 <script>
	function show_form_misi_by_skpd(){
		var skpd_kode = $('select[name=skpd_kode]').val();
		load('laporan/rka/tampil_combobox_misi_by_skpd/'+skpd_kode, '#tampil_combobox_misi_by_skpd');
		load('laporan/rka/tampil_combobox_tujuan_by_misi/', '#tampil_combobox_tujuan_by_misi');
		load('laporan/rka/tampil_combobox_sasaran_by_tujuan/', '#tampil_combobox_sasaran_by_tujuan');
		load('laporan/rka/tampil_combobox_indikator_by_sasaran/', '#tampil_combobox_indikator_by_sasaran');
		load('laporan/rka/tampil_combobox_urusan_by_indikator/', '#tampil_combobox_urusan_by_indikator');
		load('laporan/rka/tampil_combobox_program_by_urusan/', '#tampil_combobox_program_by_urusan');
	}
	
	function show_form_tujuan_by_misi(){
		var skpd_kode = $('select[name=skpd_kode]').val();
		var misi_kode = $('select[name=misi_kode]').val();
		load('laporan/rka/tampil_combobox_tujuan_by_misi/'+skpd_kode+'/'+misi_kode, '#tampil_combobox_tujuan_by_misi');
		load('laporan/rka/tampil_combobox_sasaran_by_tujuan/', '#tampil_combobox_sasaran_by_tujuan');
		load('laporan/rka/tampil_combobox_indikator_by_sasaran/', '#tampil_combobox_indikator_by_sasaran');
		load('laporan/rka/tampil_combobox_urusan_by_indikator/', '#tampil_combobox_urusan_by_indikator');
		load('laporan/rka/tampil_combobox_program_by_urusan/', '#tampil_combobox_program_by_urusan');
	}
	
	function show_form_sasaran_by_tujuan(){
		var skpd_kode = $('select[name=skpd_kode]').val();
		var tujuan_kode = $('select[name=tujuan_kode]').val();
		load('laporan/rka/tampil_combobox_sasaran_by_tujuan/'+skpd_kode+'/'+tujuan_kode, '#tampil_combobox_sasaran_by_tujuan');
		load('laporan/rka/tampil_combobox_indikator_by_sasaran/', '#tampil_combobox_indikator_by_sasaran');
		load('laporan/rka/tampil_combobox_urusan_by_indikator/', '#tampil_combobox_urusan_by_indikator');
		load('laporan/rka/tampil_combobox_program_by_urusan/', '#tampil_combobox_program_by_urusan');
	}
	
	function show_form_indikator_by_sasaran(){
		var skpd_kode = $('select[name=skpd_kode]').val();
		var tujuan_kode = $('select[name=tujuan_kode]').val();
		var sasaran_kode = $('select[name=sasaran_kode]').val();
		load('laporan/rka/tampil_combobox_indikator_by_sasaran/'+skpd_kode+'/'+tujuan_kode+'/'+sasaran_kode, '#tampil_combobox_indikator_by_sasaran');
		load('laporan/rka/tampil_combobox_urusan_by_indikator/', '#tampil_combobox_urusan_by_indikator');
		load('laporan/rka/tampil_combobox_program_by_urusan/', '#tampil_combobox_program_by_urusan');
	}
	
	function show_form_urusan_by_indikator(){
		var skpd_kode = $('select[name=skpd_kode]').val();
		var tujuan_kode = $('select[name=tujuan_kode]').val();
		var indikator_kode = $('select[name=indikator_kode]').val();
		load('laporan/rka/tampil_combobox_urusan_by_indikator/'+skpd_kode+'/'+tujuan_kode+'/'+indikator_kode, '#tampil_combobox_urusan_by_indikator');
		load('laporan/rka/tampil_combobox_program_by_urusan/', '#tampil_combobox_program_by_urusan');
	}
	
	function show_form_program_by_urusan(){
		var skpd_kode = $('select[name=skpd_kode]').val();
		var urusan_kode = $('select[name=urusan_kode]').val();
		load('laporan/rka/tampil_combobox_program_by_urusan/'+skpd_kode+'/'+urusan_kode, '#tampil_combobox_program_by_urusan');
	}
	
	function show_form_kegiatan_by_program1(){
		var skpd_kode = $('select[name=skpd_kode]').val();
		var urusan_kode = $('select[name=urusan_kode]').val();
		var program_kode = $('select[name=program_kode]').val();
		load('laporan/rka/tampil_combobox_kegiatan_by_program/'+urusan_kode+'/'+program_kode+'/'+skpd_kode, '#tampil_combobox_kegiatan_by_program');
		load('laporan/rka/tampil_combobox_hasil_by_program/'+program_kode, '#tampil_combobox_hasil_by_program');
	}
	
	function show_form_kegiatan_lainnya(){
		var kegiatan = $('select[name=kegiatan]').val();
		load('laporan/rka/tampil_kegiatan_lainnya/'+kegiatan, '#tampil_combobox_kegiatan_lainnya');
	}
</script>