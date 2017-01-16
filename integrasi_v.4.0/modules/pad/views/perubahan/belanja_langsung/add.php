<!-- Main Content -->
   <section class="content">
		<h2>RKA Perubahan<small> anggaran belanja langsung</small></h2>  
			<div class="body">
				<ol class="breadcrumb breadcrumb-col-cyan">
					<li><a href="<?php echo site_url('dashboard');?>"><i class="material-icons">home</i> Home</a></li>
					<li><a href="<?php echo site_url('rka/perubahan');?>"> RKA</a></li>
					<li class="active"> Add Belanja</li>
				</ol>
			</div>
            <!-- Multiple Items To Be Open -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
							<p align="center"><b><?php echo strtoupper($skpd_);?></b></p>
							<p class="control-label col-md-10">Program &nbsp;:&nbsp; <?php echo $program_?></p>
							<p class="control-label col-md-10">Kegiatan &nbsp;:&nbsp; <?php echo $kegiatan; ?></p>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <button type="button" class="btn bg-black waves-effect waves-light">ACTIONS</button>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a title="Kembali" href="<?php echo base_url(); ?>rka/perubahan/belanja/<?php echo $kode;?>"><i class="material-icons">reply</i> Kembali</a></li>
                                    </ul>
                                </li>
                            </ul>
							<div class="panel-body"><?php echo validation_errors(); ?><?php if ($this->session->flashdata('success')) { echo $this->session->flashdata('success');} ?></div>
                        </div>
                        <div class="body">
                            <div class="row clearfix">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <!-- Nav tabs -->
                                    <ul class="nav nav-tabs tab-nav-right" role="tablist">
                                        <li role="presentation" class="active"><a href="#home_animation_1" data-toggle="tab">Belanja</a></li>
                                        <li><a href="javascript:void(0);">Rincian Belanja</a></li>
                                        <li><a href="javascript:void(0);">Sub Rincian Belanja</a></li>
                                    </ul>
                                    <!-- Tab panes -->									
									<div class="body">
										<div class="row clearfix">
											<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
											<form action="<?php echo site_url('rka/perubahan/belanja_langsung');?>" id="form_validation" enctype="multipart/form-data" method="POST">
												<input type="hidden" value="<?php printf( "%01d", $bl->no++ ); ?>" />
												<input type="hidden" name="no_kode" id="no_kode" value="<?php printf( "%01d", $bl->no ); ?>" />
												<input type="hidden" name="id_kode" id="id_kode" value="<?php echo $kode;?>" />
												<input type="hidden" name="program_kode" id="program_kode" value="<?php echo $program;?>" />
												<input type="hidden" name="thn_kode" id="thn_kode" value="<?php echo $tahun;?>" />
												<input type="hidden" name="skpd_kode" id="skpd_kode" value="<?php echo $skpd;?>" />				
												<input type="hidden" name="urusan_kode" id="urusan_kode" value="<?php echo $urusan;?>" />
											<div class="row clearfix">
												<div class="col-md-6">
													<p><b>Akun <span class="required">*</span></b></p>
													<div class="form-group form-float">
														<div class="form-line">										
														<?php combobox('db', $akun, 'aaa_kode', 'kode', 'akun_nama', '', 'show_form_akun_by_kelompok();', 'Pilih Akun', 'class="form-control show-tick" data-live-search="true" tabindex="1" required="required"'); ?>
														</div>								
													</div>								
												</div>								
												<div class="col-md-6">
													<p><b>Kelompok <span class="required">*</span></b></p>
													<div class="form-group form-float">
														<div class="form-line" id="tampil_combobox_akun_by_kelompok">	
															<select name="bbb_kode" id="bbb_kode" class="form-control show-tick" data-live-search="true" tabindex="1" required="required"></select>
														</div>
													</div>
												</div>
											</div>
											<div class="row clearfix">						
												<div class="col-md-6">
													<p><b>Jenis <span class="required">*</span></b></p>
													<div class="form-group form-float">
														<div class="form-line" id="tampil_combobox_kelompok_by_jenis">
															<select name="ccc_kode" id="ccc_kode" class="form-control show-tick" data-live-search="true" tabindex="1" required="required"></select>
														</div>
													</div>
												</div>			
												<div class="col-md-6">
													<p><b>Obyek <span class="required">*</span></b></p>
													<div class="form-group form-float">
														<div class="form-line" id="tampil_combobox_jenis_by_obyek">
															<select name="ddd_kode" id="ddd_kode" class="form-control show-tick" data-live-search="true" tabindex="1" required="required"></select>
														</div>
													</div>
												</div>
											</div>
											<div class="row clearfix">		
												<div class="col-md-6">
													<p><b>Rincian <span class="required">*</span></b></p>
													<div class="form-group form-float">
														<div class="form-line" id="tampil_combobox_obyek_by_rincian">
															<select name="eee_kode" id="eee_kode" class="form-control show-tick" data-live-search="true" tabindex="1" required="required"></select>
														</div>
													</div>
												</div>			
												<div class="col-md-6">
													<p><b>Sumber Dana <span class="required">*</span></b></p>
													<div class="form-group form-float">
														<div class="form-line">
															<?php combobox('db', $sumber, 'sss_kode', 'tipe_kode', 'tipe_nama', '', '', 'Pilih Sumber ...', 'class="form-control show-tick" data-live-search="true" tabindex="1" required="required"'); ?>
														</div>
													</div>
												</div>
											</div>
											<div class="form-group">
												<div class="col-md-offset-9">
													<button class="btn btn-primary waves-effect" type="submit">Simpan</button>
													<a href="<?php echo base_url(); ?>rka/perubahan/belanja/<?php echo $kode;?>" class="btn btn-default">Batal</a>
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
	function show_form_akun_by_kelompok(){
		var aaa_kode = $('select[name=aaa_kode]').val();
		load('rka/perubahan/tampil_combobox_akun_by_kelompok/'+aaa_kode, '#tampil_combobox_akun_by_kelompok');
		load('rka/perubahan/tampil_combobox_kelompok_by_jenis/', '#tampil_combobox_kelompok_by_jenis');
		load('rka/perubahan/tampil_combobox_jenis_by_obyek/', '#tampil_combobox_jenis_by_obyek');
		load('rka/perubahan/tampil_combobox_obyek_by_rincian/', '#tampil_combobox_obyek_by_rincian');
	}
	
	function show_form_kelompok_by_jenis(){
		var bbb_kode = $('select[name=bbb_kode]').val();
		load('rka/perubahan/tampil_combobox_kelompok_by_jenis/'+bbb_kode, '#tampil_combobox_kelompok_by_jenis');
		load('rka/perubahan/tampil_combobox_jenis_by_obyek/', '#tampil_combobox_jenis_by_obyek');
		load('rka/perubahan/tampil_combobox_obyek_by_rincian/', '#tampil_combobox_obyek_by_rincian');
	}
	
	function show_form_jenis_by_obyek(){
		var ccc_kode = $('select[name=ccc_kode]').val();
		load('rka/perubahan/tampil_combobox_jenis_by_obyek/'+ccc_kode, '#tampil_combobox_jenis_by_obyek');
		load('rka/perubahan/tampil_combobox_obyek_by_rincian/', '#tampil_combobox_obyek_by_rincian');
	}
	
	function show_form_obyek_by_rincian(){
		var ddd_kode = $('select[name=ddd_kode]').val();
		load('rka/perubahan/tampil_combobox_obyek_by_rincian/'+ddd_kode, '#tampil_combobox_obyek_by_rincian');
	}
	</script>