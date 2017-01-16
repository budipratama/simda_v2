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

										<h5>Form TandaTangan :</h5><br>

									</form></p>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="221">
                                    <b></b>
                                    <p><form action="<?php echo site_url('laporan/rka/preview2/'.$kode);?>" id="form_validation" enctype="multipart/form-data" class="horizontal-form" method="post">
										<div class="row">
											
										</div>
										
										<div class="row clearfix">
											<div class="col-md-3">
												<p><b>Jenis Belanja</b></p>
													<div class="demo-radio-button">
														<input type="radio" name="tipe_kode" class="with-gap" id="radio_3" value="1" <?php echo ($tipe_ == 1)?'checked':'';?> checked>
														<label for="radio_3">Belanja Langsung</label>
														<input type="radio" name="tipe_kode" class="with-gap" id="radio_4" value="2" <?php echo ($tipe_ == 2)?'checked':'';?> disabled>
														<label for="radio_4">Belanja Tidak Langsung</label>
													</div>
											</div>
										</div>
											
										<div class="row clearfix">				
											<div class="col-md-3">
												<p><b>Tahun <span class="required">*</span></b></p>
												<?php combobox('db', $tahun, 'tahun', 'tahun', 'tahun', $tahun_, '', 'Pilih Tahun Anggaran', 'class="form-control show-tick" data-live-search="true" tabindex="1" required="required"'); ?>
											</div>
											<div class="col-md-6">
											<label class="form-label" for="skpd">SKPD Pelaksana :</label>
												<div class="form-group form-float">
													<div class="form-line">
													<?php if ($skpd_aktive == 'yes') { combobox('db', $skpd, 'aaa_kode', 'skpd_kode', 'skpd_nama', '', 'show_form_program_by_skpd();', 'kosong', 'class="form-control show-tick" data-live-search="true" tabindex="1"');
													} else { 
													echo '<select class="select2_category form-control" name="aaa_kode" id="aaa_kode" data-placeholder="SKPD/Kecamatan" tabindex="1" required="required">
													<option value="">kosong</option>
													<option value="'.$skpd_kode.'" selected>'.$skpd_nama.'</option>
													</select>';
													} ?>
													</div>
													<p class="font-italic col-orange">(kosong = Semua Program)</p>
												</div>
											</div>
										</div>
										<div class="row clearfix">
											<div class="col-md-10">
												<p><b>Program :</b></p>
												<div class="form-group form-float">
													<div class="form-line" id="tampil_combobox_program_by_skpd">
														<select name="bbb_kode" id="bbb_kode" class="form-control show-tick" data-live-search="true" tabindex="1"><option value="">Semua Program</option></select>															
													</div>
												</div>
											</div>
										</div>
										<div class="row clearfix">
											<div class="col-md-10">
												<p><b>Kegiatan :</b></p>
												<div class="form-group form-float">
													<div class="form-line" id="tampil_combobox_kegiatan_by_program">
														<select name="ccc_kode" id="ccc_kode" class="form-control show-tick" data-live-search="true" tabindex="1"><option value="">Semua Kegiatan</option></select>
													</div>
												</div>
											</div>
										</div>										
										<h5>Form TandaTangan :</h5><br>
										<div class="row clearfix">
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
										<div class="row clearfix">
											<div class="col-md-6">
												<div class="form-group form-float">
													<div class="form-line">
														<input type="text" class="form-control" name="nama_pimpinan" id="nama_pimpinan" style="text-align:center;" value="<?php echo $nama_tim;?>" required>
														<label class="form-label" for="nama_pimpinan">Nama Pimpinan :</label>
													</div>
												</div>
											</div>
										</div>
										<div class="row clearfix">
											<div class="col-md-6">
												<div class="form-group form-float">
													<div class="form-line">
														<input type="text" class="form-control" name="pangkat" id="pangkat" style="text-align:center;" value="<?php echo $jabatan_tim;?>">
														<label class="form-label" for="pangkat">Jabatan :</label>
													</div>
												</div>
											</div>
										</div>
										<div class="row clearfix">
											<div class="col-md-6">
												<div class="form-group form-float">
													<div class="form-line">
														<input type="text" class="form-control" name="nip" id="nip" style="text-align:center;" value="<?php echo $nip_tim;?>">
														<label class="form-label" for="nip">NIP :</label>
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
		load('laporan/rka/tampil_combobox_kegiatan_by_program/', '#tampil_combobox_kegiatan_by_program');
	}
	function show_form_kegiatan_by_program(){
		var bbb_kode = $('select[name=bbb_kode]').val();
		load('laporan/rka/tampil_combobox_kegiatan_by_program/'+bbb_kode, '#tampil_combobox_kegiatan_by_program');
	}
</script>