<!-- Main Content -->   
   <section class="content">
		<h2>Pra Rencana Kerja <small> entri data &amp; informasi detail</small></h2>  
			<div class="body">
				<ol class="breadcrumb breadcrumb-col-cyan">
					<li><a href="<?php echo site_url('dashboard');?>"><i class="material-icons">home</i> Home</a></li>
					<li><a href="<?php echo site_url('pra-rencana-kerja');?>"> Pra Rencana Kerja</a></li>
					<li class="active"> Form Pencairan</li>
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
									<a href="<?php echo site_url('pra-rencana-kerja');?>">
									<p class="col-cyan"><i class="material-icons">perm_contact_calendar</i> Form Pencairan</a></p>
									</h4>
								</div>
								<div id="collapseOne_19" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne_19">
									<div class="body" style="<?php echo (isset($formCari)?'display:none;':'')?>">
										<form action="<?php echo site_url('pra-rencana-kerja/cari');?>" class="form-horizontal" method="post">
											<div class="row clearfix">
												<div class="col-md-2">
													<p><b>Tahun :</b></p>
													<?php combobox('db', $tahun, 'tahun', 'tahun', 'tahun', $tahun_1, '', 'Pilih Tahun Anggaran', 'class="form-control show-tick" data-live-search="true" tabindex="1" disabled');?>
													<input type="hidden" name="tahun" value="<?php echo $tahun_1;?>">
												</div>
												<div class="col-md-4">
													<p><b>SKPD Pelaksana :</b></p>
													<?php if ($skpd_aktive == 'yes') { combobox('db', $skpd, 'skpd_kode', 'skpd_kode', 'skpd_nama', $skpd_, '', 'Semua SKPD Pelaksana', 'class="form-control show-tick" data-live-search="true" tabindex="1"'); 
													} else { 
													echo '<select class="form-control show-tick" name="skpd_kode" id="skpd_kode" data-placeholder="Pilih SKPD Pelaksana" class="form-control show-tick" data-live-search="true" tabindex="1" required="required">
													<option value="'.$skpd_kode.'" selected>'.$skpd_nama.'</option>
													</select>';
													} ?>
												</div>
												<div class="col-md-3">
													<p><b>Kecamatan :</b></p>
													<?php if ($kecamatan_aktive == 'yes') { combobox('db', $kecamatan, 'kecamatan_kode', 'skpd_kd', 'skpd_nama', $kecamatan_, 'show_form_deskel_by_kecamatan();', 'Semua Kecamatan', 'class="form-control show-tick" data-live-search="true" tabindex="1"'); 
													} else {
													echo '<select class="select2_category form-control" name="kecamatan_kode" id="kecamatan_kode" data-placeholder="Pilih Kecamatan" class="form-control show-tick" data-live-search="true" tabindex="1" required="required">
													<option value="'.$kecamatan_kode.'" selected>'.$kecamatan_nama.'</option>
													</select>';
													} ?>
												</div>
												<div class="col-md-3">
													<p><b>Desa/Kelurahan :</b></p>
													<div class="form-group" id="tampil_combobox_deskel_by_kecamatan">
													<?php if ($deskel_ == 'deskel' || $deskel_ == ''){ ?>
													<select class="form-control show-tick" data-live-search="true" name="deskel_kode" id="deskel_kode">
													<option value="">Semua Desa/Kelurahan</option>
													</select>
													<?php } else {
													combobox('db', $deskel, 'deskel_kode', 'skpd_kd', 'skpd_nama', $deskel_, 'Semua Desa/Kelurahan', 'class="form-control show-tick" data-live-search="true" tabindex="1"');
													} ?>
													</div>
												</div>
												<div class="body">
												<div class="col-md-8">
													<div class="form-group form-group-sm">
													<div class="form-line">
													<p><b>Nama Kegiatan :</b></p>
														<input type="text" class="form-control" name="kegiatan" id="kegiatan" value="<?php echo $kegiatan_;?>" placeholder="Kegiatan...">
													</div>
													</div>
												</div>
												<div class="col-md-3">
													<p><b>Jenis Belanja :</b></p>
													<div class="demo-radio-button">
														<input type="radio" name="tipe_kode" class="with-gap" id="radio_3" value="1" <?php echo ($tipe_ == 1)?'checked':'';?>>
														<label for="radio_3">Belanja Langsung</label>
														<input type="radio" name="tipe_kode" class="with-gap" id="radio_4" value="2" <?php echo ($tipe_ == 2)?'checked':'';?> disabled>
														<label for="radio_4">Belanja Tidak Langsung</label>
													</div>
												</div>
												</div>
											</div><div class="col-md-4"></div>
												<div class="col-md-6">
													<div class="btn-group">
													<button type="button" class="btn bg-teal dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Tambah Belanja <span class="caret"></span></button>
														<ul class="dropdown-menu">
														<li><a href="<?php echo site_url('pra-rencana-kerja/belanja-langsung');?>">Belanja Langsung</a></li>
													<!--<li><a href="<?php echo site_url('pra-rencana-kerja/belanja-tidak-langsung');?>">Belanja Tidak Langsung</a></li>-->
														</ul>
													</div>
													<button type="submit" class="btn btn-primary waves-effect">CARI</button>
												</div>
										</form>
									</div>
								</div>
								<?php if ($tahun_) { ?>
								<div class="body">
									<script>
										var ajax_source_url = '<?php echo site_url($this->uri->segment(1) . '/datatable/' . $this->uri->segment(3) . '/' . $this->uri->segment(4) . '/' . $this->uri->segment(5) . '/' . $this->uri->segment(6) . '/' . $this->uri->segment(7) . '/' . $this->uri->segment(8)); ?>';
										var ajax_source_field = [
										{ "data": "nomor" },
										{ "data": "kegiatan" },
										{ "data": "alamat" },
										{ "data": "skpd_nama" },
										{ "data": "status_nama" },
										{ "data": "Actions" }
										];
									</script>
									<div class="portlet-body">
										<table class="table table-hover table-bordered" id="tableUtama">
										<thead>
										<tr>
											<th style="width:30px">No</th>
											<th>Nama Kegiatan</th>
											<th>Lokasi</th>
											<th style="width:140px;text-align:center;">SKPD/Kecamatan</th>												
											<th style="width:80px;text-align:center;">Transfer</th>
											<th style="width:80px; text-align:center;">Actions</th>												
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
<!-- #END# Multiple Items To Be Open -->	
	<a href="#successInsert" data-toggle="modal"></a>
	<div id="successInsert" class="modal fade" role="dialog" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
					<h4 class="modal-title"><strong>Success!</strong> Tambah Pra Rencana Kerja</h4>
				</div>
				<div class="modal-body">
					 Data <font color="green"><strong>"Pra Rencana Kerja"</strong></font> telah berhasil ditambahkan !
				</div>
				<div class="modal-footer">
					<button type="button" class="btn green" data-dismiss="modal">OK</button>
				</div>
			</div>
		</div>
	</div>
	<a href="#successUpdate" data-toggle="modal"></a>
	<div id="successUpdate" class="modal fade" role="dialog" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
					<h4 class="modal-title"><strong>Success!</strong> Edit Pra Rencana Kerja</h4>
				</div>
				<div class="modal-body">
					 Data <font color="green"><strong>"Pra Rencana Kerja"</strong></font> telah berhasil diubah !
				</div>
				<div class="modal-footer">
					<button type="button" class="btn green" data-dismiss="modal">OK</button>
				</div>
			</div>
		</div>
	</div>
	<a href="#successTransfer" data-toggle="modal"></a>
	<div id="successTransfer" class="modal fade" role="dialog" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
					<h4 class="modal-title"><strong>Success!</strong> Transfer Pra Rencana Kerja</h4>
				</div>
				<div class="modal-body">
					 Data <font color="green"><strong>"Pra Rencana Kerja"</strong></font> telah berhasil ditransfer ke <font color="blue"><strong>"Rencana Kerja"</strong></font>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn green" data-dismiss="modal">OK</button>
				</div>
			</div>
		</div>
	</div>
	<a href="#warningTransfer" data-toggle="modal"></a>
	<div id="warningTransfer" class="modal fade" role="dialog" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
					<h4 class="modal-title"><strong>Warning!</strong> Transfer Pra Rencana Kerja</h4>
				</div>
				<div class="modal-body">
					 Data <font color="green"><strong>"Pra Rencana Kerja"</strong></font> sudah ditransfer ke <font color="blue"><strong>"Rencana Kerja"</strong></font>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn green" data-dismiss="modal">OK</button>
				</div>
			</div>
		</div>
	</div>
	<a href="#warningEntri" data-toggle="modal"></a>
	<div id="warningEntri" class="modal fade" role="dialog" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
					<h4 class="modal-title"><strong>Warning!</strong> Waktu Entri Sudah Habis</h4>
				</div>
				<div class="modal-body">
					Proses entri data di tutup. Untuk informasi lebih lanjut hubungi administrator!
				</div>
				<div class="modal-footer">
					<button type="button" class="btn yellow" data-dismiss="modal">OK</button>
				</div>
			</div>
		</div>
	</div>
	<a href="#successDelete" data-toggle="modal"></a>
	<div id="successDelete" class="modal fade" role="dialog" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
					<h4 class="modal-title"><strong>Warning!</strong> Hapus Pra Rencana Kerja</h4>
				</div>
				<div class="modal-body">
					 Data <font color="green"><strong>"Pra Rencana Kerja"</strong></font> telah berhasil dihapus !</font>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn green" data-dismiss="modal">OK</button>
				</div>
			</div>
		</div>
	</div>
	<script>
	function show_form_deskel_by_kecamatan(){
		var kecamatan_kode = $('select[name=kecamatan_kode]').val();
		load('pra-rencana-kerja/tampil_combobox_deskel_by_kecamatan/'+kecamatan_kode, '#tampil_combobox_deskel_by_kecamatan');
	}
	</script>