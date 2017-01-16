<!-- BEGIN CONTENT -->
	<div class="page-content-wrapper">
		<div class="page-content">
			<!-- BEGIN PAGE HEADER-->
			<h3 class="page-title">
			Hasil RKPD Perubahan <small>entri data &amp; informasi detail</small>
			</h3>
			<div class="page-bar">
				<ul class="page-breadcrumb">
					<li>
						<i class="fa fa-home"></i>
						<a href="<?php echo site_url('dashboard');?>">Home</a>
						<i class="fa fa-angle-right"></i>
					</li>
                    <li>
						<a href="<?php echo site_url('rkpd/perubahan');?>">RKPD</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="<?php echo site_url('rkpd/perubahan');?>">Perubahan</a>
					</li>
				</ul>
			</div>
            <!-- END PAGE HEADER-->
			<?php if ($this->session->flashdata('success')) { echo $this->session->flashdata('success');} ?>
			
			<!-- BEGIN FORM -->
			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN SAMPLE TABLE PORTLET-->
					<div class="portlet box green">
									<div class="portlet-title">
										<div class="caption">
											<i class="fa fa-search"></i>Pencarian Hasil RKPD Perubahan
										</div>
										<div class="tools">
											<a href="javascript:;" class="<?php echo (isset($formCari)?'expand':'collapse')?>" data-original-title="From Pencarian" title="From Pencarian"></a>
										</div>
									</div>
									<div class="portlet-body form" style="<?php echo (isset($formCari)?'display:none;':'')?>">
										<!-- BEGIN FORM-->
										<form action="<?php echo site_url('rkpd/perubahan/cari');?>" class="form-horizontal" method="post">
											<div class="form-body">
												<h3 class="form-section">Informasi Pencarian</h3>
												<div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-3">Tahun <span class="required">*</span></label>
															<div class="col-md-9">
															<?php combobox('db', $tahun, 'tahun', 'tahun', 'tahun', $tahun_, '', 'Pilih Tahun Anggaran', 'class="select2_category form-control" tabindex="1" title="Silahkan Pilih Tahun Anggaran" required="required"'); ?>
															</div>
														</div>
													</div>
													<!--/span-->
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-3">SKPD Pelaksana</label>
															<div class="col-md-9">
															<?php if ($skpd_aktive == 'yes') { combobox('db', $skpd, 'skpd_kode', 'skpd_kode', 'skpd_nama', $skpd_, '', 'Semua SKPD Pelaksana', 'class="select2_category form-control" tabindex="1"'); 
															} else { 
															echo '<select class="select2_category form-control" name="skpd_kode" id="skpd_kode" data-placeholder="Pilih SKPD Pelaksana" tabindex="1" required="required">
															<option value="'.$skpd_kode.'" selected>'.$skpd_nama.'</option>
															</select>';
															} ?>
															</div>
														</div>
													</div>
													<!--/span-->
												</div>
												<!--/row-->
												<div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-3">Kecamatan</label>
															<div class="col-md-9">
															<?php if ($kecamatan_aktive == 'yes') { combobox('db', $kecamatan, 'kecamatan_kode', 'skpd_kd', 'skpd_nama', $kecamatan_, 'show_form_deskel_by_kecamatan();', 'Semua Kecamatan', 'class="select2_category form-control" tabindex="1"'); 
															} else {
															echo '<select class="select2_category form-control" name="kecamatan_kode" id="kecamatan_kode" data-placeholder="Pilih Kecamatan" tabindex="1" required="required">
															<option value="'.$kecamatan_kode.'" selected>'.$kecamatan_nama.'</option>
															</select>';
															} ?>
															</div>
														</div>
													</div>
													<!--/span-->
													<div class="col-md-6">
														<div class="form-group" id="tampil_combobox_deskel_by_kecamatan">
															<label class="control-label col-md-3" for="deskel_kode">Desa/Kelurahan</label>
															<div class="col-md-9">
															<?php if ($deskel_ == 'deskel' || $deskel_ == ''){ ?>
																<select class="form-control select2_category" name="deskel_kode" id="deskel_kode">
																	<option value="">Semua Desa/Kelurahan</option>
																</select>
															<?php } else {
															combobox('db', $deskel, 'deskel_kode', 'skpd_kd', 'skpd_nama', $deskel_, '', 'Semua Desa/Kelurahan', 'class="select2_category form-control" tabindex="1"');
															} ?>
															</div>
														</div>
													</div>
													<!--/span-->
												</div>
												<!--/row-->
												<div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-3" for="kegiatan">Nama Kegiatan</label>
															<div class="col-md-9">
																<input type="text" class="form-control" name="kegiatan" id="kegiatan" value="<?php echo $kegiatan_;?>" placeholder="Kegiatan...">
															</div>
														</div>
													</div>
													<!--/span-->
                                                    <div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-3">Jenis Belanja</label>
															<div class="radio-list">
																<label class="radio-inline">
																<input type="radio" name="tipe_kode" id="tipe_kode" value="1" <?php echo ($tipe_ == 1)?'checked':'';?>> Belanja Langsung </label>
																<label class="radio-inline">
																<input type="radio" name="tipe_kode" id="tipe_kode" value="2" <?php echo ($tipe_ == 2)?'checked':'';?>> Belanja Tidak Langsung </label>
															</div>
														</div>
													</div>
													<!--/span-->
												</div>
												<!--/row-->
											</div>
											
											<div class="form-actions">
												<div class="row">
													<div class="col-md-12">
														<div class="row">
															<div class="col-md-offset-1 col-md-12">
																<button type="submit" class="btn green"><i class="fa fa-check"></i>  Cari Hasil RKPD Perubahan</button>
																<a href="<?php echo site_url('rkpd/perubahan');?>" class="btn default"> <i class="fa fa-times"></i> Bersihkan Hasil Pencarian</a>
																<!--
																<div class="btn-group" style="margin-left:100px;">
																	<button type="button" class="btn blue dropdown-toggle" data-toggle="dropdown"><i class="fa fa-plus"></i> Tambah Hasil RKPD Perubahan</button>
																	<button type="button" class="btn blue dropdown-toggle" data-toggle="dropdown"><i class="fa fa-angle-down"></i></button>
																	<ul class="dropdown-menu" role="menu">
																	<li>
																		<a href="<?php echo site_url('rkpd/perubahan/belanja-langsung');?>">Belanja Langsung</a>
																	</li>
																	<li>
																		<a href="<?php echo site_url('rkpd/perubahan/belanja-tidak-langsung');?>">Belanja Tidak Langsung</a>
																	</li>
																	</ul>
																</div>
																-->
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
            <div class="clearfix" id="hasil"></div>
			<?php if ($tahun_) { ?>
            <div class="row">
				<div class="col-md-12">
					<div class="portlet box blue">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-bars"></i>Daftar Hasil RKPD Perubahan
							</div>
						</div>
						<script>
							var ajax_source_url = '<?php echo site_url($this->uri->segment(1) . '/' . $this->uri->segment(2) . '/datatable/' . $this->uri->segment(4) . '/' . $this->uri->segment(5) . '/' . $this->uri->segment(6) . '/' . $this->uri->segment(7) . '/' . $this->uri->segment(8) . '/' . $this->uri->segment(9)); ?>';
							var ajax_source_field = [
										{ "data": "nomor" },
										{ "data": "kegiatan" },
										{ "data": "alamat" },
										{ "data": "sumber_nama" },
										{ "data": "skpd_nama" },
										{ "data": "status_nama" },
										{ "data": "Actions" }
									];
						</script>
						<div class="portlet-body">
							<table class="table table-striped table-bordered table-hover" id="tableUtama">
							<thead>
							<tr>
								<th style="width:20px">No</th>
								<th class="hidden-xs">Nama Kegiatan</th>
								<th style="width:150px">Lokasi</th>
								<th style="width:130px;text-align:center;">Sumber</th>
								<th style="width:150px">SKPD Pelaksana</th>
								<th style="width:100px;text-align:center;">Transfer</th>
								<th style="width:110px"> </th>
							</tr>
							</thead>
							<tbody>
							
							</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			<?php } else { ?>
			<div class="row" style="height:200px;">
			</div>
			<?php } ?>
		</div>
	</div>
	<!-- END CONTENT -->
	
	<a href="#successInsert" data-toggle="modal"></a>
	<div id="successInsert" class="modal fade" role="dialog" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
					<h4 class="modal-title"><strong>Success!</strong> Tambah Rencana Kerja Perubahan</h4>
				</div>
				<div class="modal-body">
					 Data rencana kerja murni telah berhasil ditambahkan !
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
					<h4 class="modal-title"><strong>Success!</strong> Ubah Rencana Kerja Perubahan</h4>
				</div>
				<div class="modal-body">
					 Data rencana kerja murni telah berhasil diperbaharui !
				</div>
				<div class="modal-footer">
					<button type="button" class="btn green" data-dismiss="modal">OK</button>
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
					<h4 class="modal-title"><strong>Success!</strong> Hapus Rencana Kerja Perubahan</h4>
				</div>
				<div class="modal-body">
					 Data rencana kerja murni telah berhasil dihapus !
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
					<h4 class="modal-title"><strong>Success!</strong> Transfer Rencana Kerja Perubahan</h4>
				</div>
				<div class="modal-body">
					 Data rencana kerja murni telah berhasil ditransfer ke musrenbang kabupaten!
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
					<h4 class="modal-title"><strong>Warning!</strong> Transfer Musrenbang Kabupaten</h4>
				</div>
				<div class="modal-body">
					Data rencana kerja murni sudah ditransfer ke musrenbang kabupaten!
				</div>
				<div class="modal-footer">
					<button type="button" class="btn yellow" data-dismiss="modal">OK</button>
				</div>
			</div>
		</div>
	</div>
	
	<a href="#warningAPBD" data-toggle="modal"></a>
	<div id="warningAPBD" class="modal fade" role="dialog" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
					<h4 class="modal-title"><strong>Warning!</strong> APBD Kabupaten</h4>
				</div>
				<div class="modal-body">
					APBD Kabupaten tidak mencukupi! Silahkan hubungi administrator untuk informasi anggarannya.
				</div>
				<div class="modal-footer">
					<button type="button" class="btn yellow" data-dismiss="modal">OK</button>
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
					<h4 class="modal-title"><strong>Warning!</strong> Waktu Entri Sudah Habis!</h4>
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
	
	<script>
	function show_form_deskel_by_kecamatan(){
		var kecamatan_kode = $('select[name=kecamatan_kode]').val();
		load('rkpd/perubahan/tampil_combobox_deskel_by_kecamatan/'+kecamatan_kode, '#tampil_combobox_deskel_by_kecamatan');
	}
	</script>