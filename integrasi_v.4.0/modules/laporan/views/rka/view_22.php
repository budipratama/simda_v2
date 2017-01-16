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
                            <h2>Cetak Laporan  RKA SKPD 2.2<small>Rekapitulasi Anggaran Belanja Langsung</small></h2>
                            <ul class="header-dropdown m-r--5">
								<li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="<?php echo site_url('laporan');?>">Back</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
						<div class="body">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs tab-nav-right" role="tablist">
                                <li role="presentation"><a href="<?php echo site_url('laporan/rka');?>">RKA SKPD 1</a></li>
                                <li role="presentation" class="active"><a href="#22" data-toggle="tab">RKA SKPD 2.2</a></li>
                                <li role="presentation"><a href="<?php echo site_url('laporan/rka/v_221');?>">RKA SKPD 2.2.1</a></li>
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content">
                            <div class="body">
                                <div role="tabpanel" class="tab-pane fade in active" id="22">
                                    <b></b>
                                    <p><form action="<?php echo site_url('laporan/rka/preview_22');?>" id="form_validation" enctype="multipart/form-data" method="POST">
										<div class="row clearfix">																			
											<div class="col-md-12">
												<p><b>SKPD Pelaksana <span class="required">*</span></b></p>
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
												
										<div class="row clearfix">
											<div class="col-md-4">
												<p><b>Jenis Anggaran <span class="required">*</span></b></p>
												<div class="form-group form-float">
												<div class="form-line" id="tampil_combobox_tahapan_by_skpd">
													<?php if ($skpd_aktive == 'no') { combobox('db', $tahapan, 'kode_tahapan', 'kode', 'nama', '', 'show_form_tujuan_by_misi();', 'Pilih ...', 'class="form-control show-tick" data-live-search="true" tabindex="1" required="required"'); 
													} else {
													echo '<select class="select2_category form-control" name="misi_kode" id="misi_kode" data-placeholder="Pilih Misi Kabupaten Bekasi" tabindex="1" required="required">';
													}
													?>
													</select>
												</div>
												</div>
											</div>
											<div class="col-md-4">
												<p><b>Jenis Belanja <span class="required">*</span></b></p>
												<div class="form-group form-float">
													<div class="form-line" id="tampil_combobox_belanja_by_tahapan">	
														<select name="bbb_kode" id="bbb_kode" class="form-control show-tick" data-live-search="true" tabindex="1" required="required"></select>
													</div>
												</div>
											</div>
											<div class="col-md-4">
												<p><b>Tahun Anggaran <span class="required">*</span></b></p>
												<div class="form-group form-float">
													<div class="form-line" id="tampil_combobox_tahun_by_belanja">	
														<select name="ccc_kode" id="ccc_kode" class="form-control show-tick" data-live-search="true" tabindex="1" required="required"></select>
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
														<input type="text" class="form-control" name="nama_pimpinan" id="nama_pimpinan" style="text-align:center;" value="<?php echo $nama_tim;?>">
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
												<a href="<?php echo site_url('laporan/rka/v_22');?>" class="btn default">Kembali</a>
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
            <!-- #END# Tabs With Custom Animations -->
        </div>
    </section>
<!-- END CONTENT -->
<script>
	function show_form_tahapan_by_skpd(){
		var skpd_kode = $('select[name=skpd_kode]').val();
		load('laporan/rka/tampil_combobox_tahapan_by_skpd/'+skpd_kode, '#tampil_combobox_tahapan_by_skpd');
		load('laporan/rka/tampil_combobox_belanja_by_tahapan/', '#tampil_combobox_belanja_by_tahapan');
		load('laporan/rka/tampil_combobox_tahun_by_belanja/', '#tampil_combobox_tahun_by_belanja');
	}
	
	function show_form_belanja_by_tahapan(){
		var skpd_kode = $('select[name=skpd_kode]').val();
		var kode_tahapan = $('select[name=kode_tahapan]').val();
		load('laporan/rka/tampil_combobox_belanja_by_tahapan/'+skpd_kode+'/'+kode_tahapan, '#tampil_combobox_belanja_by_tahapan');
		load('laporan/rka/tampil_combobox_tahun_by_belanja/', '#tampil_combobox_tahun_by_belanja');
		load('laporan/rka/tampil_combobox_program_by_tahun/', '#tampil_combobox_program_by_tahun');
	}
	
	function show_form_tahun_by_belanja(){
		var skpd_kode = $('select[name=skpd_kode]').val();
		var belanja_kode = $('select[name=belanja_kode]').val();
		var kode_tahapan = $('select[name=kode_tahapan]').val();
		load('laporan/rka/tampil_combobox_tahun_by_belanja/'+skpd_kode+'/'+belanja_kode+'/'+kode_tahapan, '#tampil_combobox_tahun_by_belanja');		
		load('laporan/rka/tampil_combobox_program_by_tahun/', '#tampil_combobox_program_by_tahun');
	}
</script>