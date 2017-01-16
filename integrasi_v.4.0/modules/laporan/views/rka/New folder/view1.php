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
                                <div class="col-xs-12 ol-sm-12 col-md-12 col-lg-12">
                                    <div class="panel-group" id="accordion_17" role="tablist" aria-multiselectable="true">
                                        <div class="panel panel-col-cyan">
                                            <div class="panel-heading" role="tab" id="headingTwo_17">
                                                <h4 class="panel-title">
                                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion_17" href="#collapseTwo_17" aria-expanded="false"
                                                       aria-controls="collapseTwo_17">
                                                        <i class="material-icons">cloud_download</i> RKA SKPD 2.2
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapseTwo_17" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo_17">
                                                <div class="panel-body">
                                                    Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute,
                                                    non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum
                                                    eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid
                                                    single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh
                                                    helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.
                                                    Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table,
                                                    raw denim aesthetic synth nesciunt you probably haven't heard of them
                                                    accusamus labore sustainable VHS.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel panel-col-teal">
                                            <div class="panel-heading" role="tab" id="headingThree_17">
                                                <h4 class="panel-title">
                                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion_17" href="#collapseThree_17" aria-expanded="false"
                                                       aria-controls="collapseThree_17">
                                                        <i class="material-icons">contact_phone</i> RKA SKPD 2.2.1
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapseThree_17" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree_17">
                                            <div class="panel-body">
												<div class="body">
												<form action="<?php echo site_url('laporan/rka/laporan_221');?>" id="form_validation" enctype="multipart/form-data" method="POST">
												<div class="row clearfix">
													<div class="col-md-4">
														<p><b>Jenis Anggaran <span class="required">*</span></b></p>
														<div class="form-group form-float">
															<div class="form-line">
															<?php combobox('db', $tahapan, 'kode_tahapan', 'kode', 'nama', '', 'show_form_belanja_by_anggaran();', 'Pilih ...', 'class="form-control show-tick" data-live-search="true" tabindex="1" required="required"');?>
															</div>
														</div>
													</div>
													<div class="col-md-4">
														<p><b>Jenis Belanja <span class="required">*</span></b></p>
														<div class="form-group form-float">
															<div class="form-line" id="tampil_combobox_belanja_by_anggaran">	
																<select name="bbb_kode" id="bbb_kode" class="form-control show-tick" data-live-search="true" tabindex="1" required="required"></select>
															</div>
														</div>
													</div>
													<div class="col-md-4">
														<p><b>Tahun Anggaran<span class="required">*</span></b></p>
														<div class="form-group form-float">
															<div class="form-line" id="tampil_combobox_tahun_by_belanja">	
																<select name="ccc_kode" id="ccc_kode" class="form-control show-tick" data-live-search="true" tabindex="1" required="required"></select>
															</div>
														</div>
													</div>
												</div>
												<div class="row clearfix">
													<div class="col-md-12">
														<p><b>SKPD Pelaksana <span class="required">*</span></b></p>
														<div class="form-group form-float">
															<div class="form-line" id="tampil_combobox_skpd_by_tahun">	
																<select name="ddd_kode" id="ddd_kode" class="form-control show-tick" data-live-search="true" tabindex="1" required="required"></select>
															</div>
														</div>
													</div>
												</div>
												<div class="row clearfix">
													<div class="col-md-5">
														<p><b>Program <span class="required">*</span></b></p>
														<div class="form-group form-float">
															<div class="form-line" id="tampil_combobox_program_by_skpd">	
																<select name="eee_kode" id="eee_kode" class="form-control show-tick" data-live-search="true" tabindex="1" required="required"></select>
															</div>
														</div>
													</div>
													<div class="col-md-7">
														<p><b>Kegiatan <span class="required">*</span></b></p>
														<div class="form-group form-float">
															<div class="form-line" id="tampil_combobox_kegiatan_by_program">	
																<select name="fff_kode" id="fff_kode" class="form-control show-tick" data-live-search="true" tabindex="1" required="required"></select>
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
                </div>
            </div>
            <!-- #END# Tabs With Custom Animations -->
        </div>
    </section>
<!-- END CONTENT -->
<script>
	function show_form_belanja_by_anggaran(){
		var kode_tahapan = $('select[name=kode_tahapan]').val();
		load('laporan/rka/tampil_combobox_belanja_by_anggaran/'+kode_tahapan, '#tampil_combobox_belanja_by_anggaran');
		load('laporan/rka/tampil_combobox_tahun_by_belanja/', '#tampil_combobox_tahun_by_belanja');
		load('laporan/rka/tampil_combobox_skpd_by_tahun/', '#tampil_combobox_skpd_by_tahun');
	}
	function show_form_tahun_by_belanja(){
		var kode_tipe = $('select[name=kode_tipe]').val();
		load('laporan/rka/tampil_combobox_tahun_by_belanja/'+kode_tipe, '#tampil_combobox_tahun_by_belanja');
		load('laporan/rka/tampil_combobox_skpd_by_tahun/', '#tampil_combobox_skpd_by_tahun');
	}
	function show_form_skpd_by_tahun(){
		var kode_tahun = $('select[name=kode_tahun]').val();
		load('laporan/rka/tampil_combobox_skpd_by_tahun/'+kode_tahun, '#tampil_combobox_skpd_by_tahun');		
		load('laporan/rka/tampil_combobox_program_by_skpd/', '#tampil_combobox_program_by_skpd');
		load('laporan/rka/tampil_combobox_kegiatan_by_program/', '#tampil_combobox_kegiatan_by_program');
	}
	function show_form_program_by_skpd(){
		var kode_skpd = $('select[name=kode_skpd]').val();
		load('laporan/rka/tampil_combobox_program_by_skpd/'+kode_skpd, '#tampil_combobox_program_by_skpd');
		load('laporan/rka/tampil_combobox_kegiatan_by_program/'+kode_skpd, '#tampil_combobox_kegiatan_by_program');
	}
	function show_form_kegiatan_by_program(){
		var kode_program = $('select[name=kode_program]').val();
		load('laporan/rka/tampil_combobox_kegiatan_by_program/'+kode_program, '#tampil_combobox_kegiatan_by_program');
	}
</script>