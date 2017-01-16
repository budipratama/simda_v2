<!-- Main Content -->   
   <section class="content">
		<h2>RKA Perubahan<small> entri data &amp; informasi detail</small></h2>  
			<div class="body">
				<ol class="breadcrumb breadcrumb-col-cyan">
					<li><a href="<?php echo site_url('dashboard');?>"><i class="material-icons">home</i> Home</a></li>
					<li><a href="<?php echo site_url('rka/perubahan');?>"> RKA</a></li>
					<li class="active"> Perubahan</li>
				</ol>
			</div>	
            <!-- Multiple Items To Be Open -->
			<?php if ($this->session->flashdata('success')) { echo $this->session->flashdata('success');} ?>
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="body">
                            <div class="row clearfix">
								<div class="panel-heading" role="tab" id="headingOne_19" data-toggle="tooltip" data-placement="top" title="Form Pencairan">
									<h4 class="panel-title">
									<a href="<?php echo site_url('rka/perubahan');?>">
									<p class="col-cyan"><i class="material-icons">perm_contact_calendar</i> Form Pencairan</a></p>
									</h4>
								</div>											
                                           <div id="collapseOne_19" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne_19">
												<div class="body" style="<?php echo (isset($formCari)?'display:none;':'')?>">
												<form action="<?php echo site_url('rka/perubahan/cari');?>" class="form-horizontal" method="post">
													<div class="row clearfix">
														<div class="col-md-3">
															<p><b>Tahun <span class="required">*</span></b></p>
															<?php combobox('db', $tahun, 'tahun', 'tahun', 'tahun', $tahun_, '', 'Pilih Tahun Anggaran', 'class="form-control show-tick" data-live-search="true" tabindex="1" required="required"'); ?>
														</div>								
														<div class="col-md-3">
															<p><b>SKPD Pelaksana</b></p>
															<?php if ($skpd_aktive == 'yes') { combobox('db', $skpd, 'skpd_kode', 'skpd_kode', 'skpd_nama', $skpd_, '', 'Semua SKPD Pelaksana', 'class="form-control show-tick" data-live-search="true" tabindex="1"'); 
															} else { 
															echo '<select class="form-control show-tick" name="skpd_kode" id="skpd_kode" data-placeholder="Pilih SKPD Pelaksana" class="form-control show-tick" data-live-search="true" tabindex="1" required="required">
															<option value="'.$skpd_kode.'" selected>'.$skpd_nama.'</option>
															</select>';
															} ?>
														</div>								
														<div class="col-md-3">
															<p><b>Kecamatan</b></p>
															<?php if ($kecamatan_aktive == 'yes') { combobox('db', $kecamatan, 'kecamatan_kode', 'skpd_kd', 'skpd_nama', $kecamatan_, 'show_form_deskel_by_kecamatan();', 'Semua Kecamatan', 'class="form-control show-tick" data-live-search="true" tabindex="1"'); 
															} else {
															echo '<select class="select2_category form-control" name="kecamatan_kode" id="kecamatan_kode" data-placeholder="Pilih Kecamatan" class="form-control show-tick" data-live-search="true" tabindex="1" required="required">
															<option value="'.$kecamatan_kode.'" selected>'.$kecamatan_nama.'</option>
															</select>';
															} ?>
														</div>								
														<div class="col-md-3">
															<p><b>Desa/Kelurahan</b></p>
															<div class="form-group" id="tampil_combobox_deskel_by_kecamatan">
															<?php if ($deskel_ == 'deskel' || $deskel_ == ''){ ?>
															<select class="form-control show-tick" data-live-search="true" name="deskel_kode" id="deskel_kode">
															<option value="">Semua Desa/Kelurahan</option>
															</select>
															<?php } else {
															combobox('db', $deskel, 'deskel_kode', 'skpd_kd', 'skpd_nama', $deskel_, '', 'Semua Desa/Kelurahan', 'class="form-control show-tick" data-live-search="true" tabindex="1"');
															} ?>									
															</div>
														</div>
														<div class="body">
														<div class="col-md-8">															
															<div class="form-group form-group-sm">
															<div class="form-line">
															<p><b>Nama Kegiatan</b></p>
																<input type="text" class="form-control" name="kegiatan" id="kegiatan" value="<?php echo $kegiatan_;?>" placeholder="Kegiatan...">
															</div>
															</div>
														</div>														
														<div class="col-md-3">
															<p><b>Jenis Belanja</b></p>
															<div class="demo-radio-button">
																<input type="radio" name="tipe_kode" class="with-gap" id="radio_3" value="1" <?php echo ($tipe_ == 1)?'checked':'';?>>
																<label for="radio_3">Belanja Langsung</label>
																<input type="radio" name="tipe_kode" class="with-gap" id="radio_4" value="2" <?php echo ($tipe_ == 2)?'checked':'';?> disabled>
																<label for="radio_4">Belanja Tidak Langsung</label>
															</div>
														</div>
														</div>													
													</div><div class="col-md-3"></div>
														<div class="col-md-3"><div class="btn-group"></div></div>
														<div class="button-demo">
															<button type="submit" class="btn btn-primary waves-effect">CARI</button>
														</div>
												</div>
											</form>
                                            </div>                                       
										<?php if ($tahun_) { ?>
										<div class="body">
										<script>
											var ajax_source_url = '<?php echo site_url($this->uri->segment(1) . '/' . $this->uri->segment(2) . '/datatable/' . $this->uri->segment(4) . '/' . $this->uri->segment(5) . '/' . $this->uri->segment(6) . '/' . $this->uri->segment(7) . '/' . $this->uri->segment(8) . '/' . $this->uri->segment(9)); ?>';
											var ajax_source_field = [
											{ "data": "nomor" },
											{ "data": "kegiatan" },
											{ "data": "alamat" },
											{ "data": "sumber_nama" },
											{ "data": "skpd_nama" },
											{ "data": "Actions" }
										];
										</script>
										<div class="portlet-body">
											<table class="table table-striped table-bordered table-hover" id="tableUtama">
											<thead>
											<tr>							
												<th style="width:10px">No</th>
												<th style="width:150px; text-align:center;">Nama Kegiatan</th>
												<th>Lokasi</th>
												<th style="width:100px;text-align:center;">Sumber</th>
												<th>SKPD/Kecamatan</th>
												<th style="width:20px; text-align:center;">Actions</th>
											</tr>
											</thead>
											<tbody></tbody>
											</table>
										</div>
										</div>
								<?php } else { ?>
								<?php } ?>
							</div>	
						</div>
					</div>
				</div>
			</div>
	</section>
	<a href="#successDelete" data-toggle="modal"></a>
	<div id="successDelete" class="modal fade" role="dialog" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
					<h4 class="modal-title"><strong>Warning!</strong> Hapus RKA Perubahan</h4>
				</div>
				<div class="modal-body">
					 Data <font color="green"><strong>"Rencana RKA Perubahan"</strong></font> telah berhasil dihapus !</font>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn green" data-dismiss="modal">OK</button>
				</div>
			</div>
		</div>
	</div>
<!-- #END# Multiple Items To Be Open -->
	<script>
	function show_form_deskel_by_kecamatan(){
		var kecamatan_kode = $('select[name=kecamatan_kode]').val();
		load('rka/perubahan/tampil_combobox_deskel_by_kecamatan/'+kecamatan_kode, '#tampil_combobox_deskel_by_kecamatan');
	}
	</script>