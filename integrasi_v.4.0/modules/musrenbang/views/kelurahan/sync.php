<!-- BEGIN CONTENT -->
	<div class="page-content-wrapper">
		<div class="page-content">
			<!-- BEGIN PAGE HEADER-->
			<h3 class="page-title">
			Hasil Musrenbang Kelurahan <small>entri data &amp; informasi detail</small>
			</h3>
			<div class="page-bar">
				<ul class="page-breadcrumb">
					<li>
						<i class="fa fa-home"></i>
						<a href="<?php echo site_url('dashboard');?>">Home</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="<?php echo site_url('musrenbang/kelurahan');?>">Musrenbang Kelurahan</a>
						<i class="fa fa-angle-right"></i>
					</li>
                    <li>
						<a href="#">Sync</a>
					</li>
				</ul>
			</div>
            <!-- END PAGE HEADER-->
			<?php if ($this->session->flashdata('success')) { echo $this->session->flashdata('success');} else { echo $this->session->flashdata('error');} ?>
			
			<!-- BEGIN FORM -->
			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN SAMPLE TABLE PORTLET-->
					<div class="portlet box green">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-refresh"></i>Sinkronisasi Musrenbang Kelurahan
							</div>
							<div class="tools">
								<a href="javascript:;" class="<?php echo (isset($formCari)?'expand':'collapse')?>" data-original-title="From Pencarian" title="From Pencarian"></a>
							</div>
						</div>
						<div class="portlet-body form" style="<?php echo (isset($formCari)?'display:none;':'')?>">
							<!-- BEGIN FORM-->
							<form action="<?php echo site_url('musrenbang/kelurahan/sync-process');?>" class="form-horizontal" method="post">
								<div class="form-body">
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label col-md-3">Sinkronisasi <span class="required">*</span></label>
												<div class="col-md-9">
												<?php combobox('2d', $jenis, 'jenis', 'jenis', 'jenis', $jenis_, '', 'Pilih Sinkronisasi', 'class="select2_category form-control" tabindex="1" title="Silahkan Pilih Sinkronisasi" required="required"'); ?>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label col-md-3">Tahun <span class="required">*</span></label>
												<div class="col-md-9">
												<?php combobox('db', $tahun, 'tahun', 'tahun', 'tahun', $tahun_, '', 'Pilih Tahun Anggaran', 'class="select2_category form-control" tabindex="2" title="Silahkan Pilih Tahun Anggaran" required="required"'); ?>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label col-md-3">Jenis Belanja</label>
												<div class="radio-list">
													<label class="radio-inline">
													<input type="radio" name="tipe" id="tipe" value="1" <?php echo ($tipe_ == 1 || $tipe_ == '')?'checked':'';?>> Belanja Langsung </label>
													<label class="radio-inline">
													<input type="radio" name="tipe" id="tipe" value="2" <?php echo ($tipe_ == 2)?'checked':'';?>> Belanja Tidak Langsung </label>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label col-md-3">Kecamatan <span class="required">*</span></label>
												<div class="col-md-9">
												<?php if ($kecamatan_aktive == 'yes') { combobox('db', $kecamatan, 'kecamatan_kode', 'skpd_kd', 'skpd_nama', $kecamatan_, 'show_form_deskel_by_kecamatan();', 'Pilih Kecamatan', 'class="select2_category form-control" tabindex="1" required="required"'); 
												} else {
												echo '<select class="select2_category form-control" name="kecamatan_kode" id="kecamatan_kode" data-placeholder="Pilih Kecamatan" tabindex="1" required="required">
												<option value="'.$kecamatan_kode.'" selected>'.$kecamatan_nama.'</option>
												</select>';
												} ?>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group" id="tampil_combobox_deskel_by_kecamatan">
												<label class="control-label col-md-3" for="deskel_kode">Kelurahan <span class="required">*</span></label>
												<div class="col-md-9">
												<?php if ($deskel_ == 'deskel' || $deskel_ == ''){ 
													if ($admin_log['level_kode'] == 15){
														echo '<select class="select2_category form-control" name="deskel_kode" id="deskel_kode" data-placeholder="Pilih Kelurahan" tabindex="1" required="required">
														<option value="'.$deskel_kode.'" selected>'.$deskel_nama.'</option>
														</select>';
													} else if ($admin_log['level_kode'] == 4){
														combobox('db', $deskel, 'deskel_kode', 'skpd_kd', 'skpd_nama', $deskel_, '', 'Pilih Kelurahan', 'class="select2_category form-control" tabindex="1" required="required"'); 
													} else { ?>
														<select class="form-control select2_category" name="deskel_kode" id="deskel_kode">
															<option value="">Pilih Kelurahan</option>
														</select>
														<?php
													}
												} else {
													if ($deskel_aktive == 'yes') { combobox('db', $deskel, 'deskel_kode', 'skpd_kd', 'skpd_nama', $deskel_, '', 'Pilih Kelurahan', 'class="select2_category form-control" tabindex="1" required="required"'); 
													} else {
													echo '<select class="select2_category form-control" name="deskel_kode" id="deskel_kode" data-placeholder="Pilih Kelurahan" tabindex="1" required="required">
													<option value="'.$deskel_kode.'" selected>'.$deskel_nama.'</option>
													</select>';
													}
												} ?>
												</div>
											</div>
										</div>
										<!--/span-->
									</div>
								</div>
								<div class="form-actions">
									<div class="row">
										<div class="col-md-12">
											<div class="row">
												<div class="col-md-offset-1 col-md-12">
													<button type="submit" name="process" value="process" class="btn green"><i class="fa fa-check"></i>  Tampilkan</button>
													<a href="<?php echo site_url('musrenbang/kelurahan');?>" class="btn default"> <i class="fa fa-reply"></i> Kembali</a>
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
			<?php if ($jenis_ == 1) { ?>
            <div class="row">
				<div class="col-md-12">
					<div class="portlet box blue">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-bars"></i>Informasi Sinkronisasi Online - Download
							</div>
						</div>
						<div class="portlet-body form">
							<?php
							if ($connection_status){
								if ($jumlah_data > 0){
								?>
								<br />
									<div class="row">
										<div class="col-md-12" style="padding-left: 20px;padding-right: 20px">
											<table class="table table-bordered">
												<thead>
													<tr>
														<th class="text-center" width="50">#</th>
														<th class="text-center" width="150">Nomor</th>
														<th class="text-center">Nama Kegiatan Online</th>
														<th class="text-center">Nama Kegiatan Offline</th>
														<th class="text-center" width="80">Status</th>
													</tr>
												</thead>
												<tbody>
												<?php
												if ($grid_musrenbang){
													$i = 1;
													foreach($grid_musrenbang as $row_musrenbang){
														$nomor		= $row_musrenbang->nomor;
														$status 	= "<label class=\"label label-info\">Baru</label>";
														$kegiatan 	= "";
														$lokasi 	= "";
														if (isset($grid_musrenbang_->$nomor)){
															$status 	= "<label class=\"label label-danger\">Duplikat</label>";
															$kegiatan 	= $grid_musrenbang_->$nomor->kegiatan;
															$lokasi 	= $grid_musrenbang_->$nomor->alamat;
														}
														?>
														<tr>
															<td class="text-center"><?php echo $i; ?></td>
															<td><input type="hidden" name="nomor[]" value="<?php echo $row_musrenbang->nomor; ?>" /><?php echo $row_musrenbang->nomor; ?></td>
															<td><?php echo $row_musrenbang->kegiatan; ?></td>
															<td><?php echo $kegiatan; ?></td>
															<td class="text-center"><div id="progress-<?php echo $row_musrenbang->nomor; ?>"><?php echo $status; ?></div></td>
														</tr>
														<?php
													$i++;
													}
												}
												?>
												</tbody>
											</table>
										</div>
									</div>
									<div class="form-actions">
										<div class="row">
											<div class="col-md-12">
												<div class="row">
												<?php if ($jumlah_sama > 0){ ?>
													<div class="col-md-offset-1 col-md-12">
														<button type="button" id="btnsync_all" class="btn green" onclick="proses_sync_all();"> <i class="fa fa-check"></i> Proses Semua</button>
														<button type="button" id="btnsync_part" class="btn yellow" onclick="proses_sync_part();"> <i class="fa fa-check"></i> Proses Sebagian</button>
														<a href="<?php echo site_url('musrenbang/kelurahan/sync');?>" class="btn default"> <i class="fa fa-reply"></i> Kembali</a>
													</div>
												<?php } else { ?>
													<div class="col-md-offset-1 col-md-12">
														<button type="button" id="btnsync_part" class="btn yellow" onclick="proses_sync_part();"> <i class="fa fa-check"></i> Proses</button>
														<a href="<?php echo site_url('musrenbang/kelurahan/sync');?>" class="btn default"> <i class="fa fa-reply"></i> Kembali</a>
													</div>
												<?php } ?>
												</div>
											</div>
											<div class="col-md-6">
											</div>
										</div>
									</div>
								<?php } else { ?>
								<div class="form-body">
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label class="col-md-12">Tidak ada data yang disinkronisasi</label>
											</div>
										</div>
									</div>
								</div>
								<?php 
								}
							} else { 
								?>
								<div class="form-body">
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label class="col-md-12"><br /><div class="alert alert-danger"><strong>Tidak Terhubung!</strong> Tidak ada koneksi ke RKPD Online Kabupaten Bekasi. Silahkan hubungkan komputer Anda ke Internet</div></label>
											</div>
										</div>
									</div>
								</div>
								<?php
							}
							?>
						</div>
					</div>
				</div>
			</div>
			<?php } else if ($jenis_ == 2) { ?>
			<div class="row">
				<div class="col-md-12">
					<div class="portlet box blue">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-bars"></i>Informasi Sinkronisasi Online - Upload
							</div>
						</div>
						<div class="portlet-body form">
							<?php
							if ($connection_status === true){
								if ($jumlah_data > 0){
								?>
								<br />
									<div class="row">
										<div class="col-md-12" style="padding-left: 20px;padding-right: 20px">
											<table class="table table-bordered">
												<thead>
													<tr>
														<th class="text-center" width="50">#</th>
														<th class="text-center" width="150">Nomor</th>
														<th class="text-center">Nama Kegiatan Offline</th>
														<th class="text-center">Nama Kegiatan Online</th>
														<th class="text-center" width="80">Status</th>
													</tr>
												</thead>
												<tbody>
												<?php
												if ($grid_musrenbang){
													$i = 1;
													foreach($grid_musrenbang as $row_musrenbang){
														$nomor		= $row_musrenbang->nomor;
														$status 	= "<label class=\"label label-info\">Baru</label>";
														$kegiatan 	= "";
														$lokasi 	= "";
														if (isset($grid_musrenbang_->$nomor)){
															$status 	= "<label class=\"label label-danger\">Duplikat</label>";
															$kegiatan 	= $grid_musrenbang_->$nomor->kegiatan;
															$lokasi 	= $grid_musrenbang_->$nomor->alamat;
														}
														?>
														<tr>
															<td class="text-center"><?php echo $i; ?></td>
															<td><input type="hidden" name="nomor[]" value="<?php echo $row_musrenbang->nomor; ?>" /><?php echo $row_musrenbang->nomor; ?></td>
															<td><?php echo $row_musrenbang->kegiatan; ?></td>
															<td><?php echo $kegiatan; ?></td>
															<td class="text-center"><div id="progress-<?php echo $row_musrenbang->nomor; ?>"><?php echo $status; ?></div></td>
														</tr>
														<?php
													$i++;
													}
												}
												?>
												</tbody>
											</table>
										</div>
									</div>
									<div class="form-actions">
										<div class="row">
											<div class="col-md-12">
												<div class="row">
												<?php if ($jumlah_sama > 0){ ?>
													<div class="col-md-offset-1 col-md-12">
														<button type="button" id="btnsync_all" class="btn green" onclick="proses_sync_all();"> <i class="fa fa-check"></i> Proses Semua</button>
														<button type="button" id="btnsync_part" class="btn yellow" onclick="proses_sync_part();"> <i class="fa fa-check"></i> Proses Sebagian</button>
														<a href="<?php echo site_url('musrenbang/kelurahan/sync');?>" class="btn default"> <i class="fa fa-reply"></i> Kembali</a>
													</div>
												<?php } else { ?>
													<div class="col-md-offset-1 col-md-12">
														<button type="button" id="btnsync_part" class="btn yellow" onclick="proses_sync_part();"> <i class="fa fa-check"></i> Proses</button>
														<a href="<?php echo site_url('musrenbang/kelurahan/sync');?>" class="btn default"> <i class="fa fa-reply"></i> Kembali</a>
													</div>
												<?php } ?>
												</div>
											</div>
											<div class="col-md-6">
											</div>
										</div>
									</div>
								<?php } else { ?>
								<div class="form-body">
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label class="col-md-12">Tidak ada data yang disinkronisasi</label>
											</div>
										</div>
									</div>
								</div>
								<?php 
								}
							} else { 
								?>
								<div class="form-body">
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label class="col-md-12"><br /><div class="alert alert-danger"><strong>Tidak Terhubung!</strong> Tidak ada koneksi ke RKPD Online Kabupaten Bekasi. Silahkan hubungkan komputer Anda ke Internet</div></label>
											</div>
										</div>
									</div>
								</div>
								<?php
							}
							?>
						</div>
					</div>
				</div>
			</div>
			<?php } else if ($jenis_ == 3) { ?>
			<div class="row">
				<div class="col-md-12">
					<div class="portlet box blue">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-bars"></i>Informasi Import Data
							</div>
						</div>
						<div class="portlet-body form">
							<form action="<?php echo site_url('musrenbang/kelurahan/sync_preview/'.$jenis_.'/'.$tahun_.'/'.$tipe_.'/'.$kecamatan_.'/'.$deskel_);?>" class="form-horizontal" method="post" enctype="multipart/form-data">
								<div class="form-body">
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label class="control-label col-md-3">Import File</label>
												<div class="col-md-6">
													<div class="input-group">
														<input type="file" name="userfile" class="form-control" placeholder="" required accept="text/csv" />
														<div class="input-group-btn">
															<input type="submit" name="import_data" value="Import" class="btn btn-primary" />
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="col-md-6">
										</div>
									</div>
								</div>
							</form>
							<form action="<?php echo site_url('musrenbang/kelurahan/sync_preview/'.$jenis_.'/'.$tahun_.'/'.$tipe_.'/'.$kecamatan_.'/'.$deskel_);?>" class="form-horizontal" method="post" enctype="multipart/form-data">
								<?php
								if ($jumlah_data > 0){
									?>
									<input type="hidden" name="filename" value="<?php echo $filename; ?>" />
									<div class="row">
										<div class="col-md-12" style="padding-left: 20px;padding-right: 20px">
											<table class="table table-bordered">
												<thead>
													<tr>
														<th class="text-center" width="50">#</th>
														<th class="text-center" width="150">Nomor</th>
														<th class="text-center">Nama Kegiatan Import</th>
														<th class="text-center">Nama Kegiatan Offline</th>
														<th class="text-center" width="80">Status</th>
													</tr>
												</thead>
												<tbody>
												<?php
												if ($grid_musrenbang){
													$i = 1;
													foreach($grid_musrenbang as $row_musrenbang){
														$nomor		= $row_musrenbang->nomor;
														$status 	= "<label class=\"label label-info\">Baru</label>";
														$kegiatan 	= "";
														$lokasi 	= "";
														if (isset($grid_musrenbang_->$nomor)){
															$status 	= "<label class=\"label label-danger\">Duplikat</label>";
															$kegiatan 	= $grid_musrenbang_->$nomor->kegiatan;
															$lokasi 	= $grid_musrenbang_->$nomor->alamat;
														}
														?>
														<tr>
															<td class="text-center"><?php echo $i; ?></td>
															<td><input type="hidden" name="nomor[]" value="<?php echo $row_musrenbang->nomor; ?>" /><?php echo $row_musrenbang->nomor; ?></td>
															<td><?php echo $row_musrenbang->kegiatan; ?></td>
															<td><?php echo $kegiatan; ?></td>
															<td class="text-center"><div id="progress-<?php echo $row_musrenbang->nomor; ?>"><?php echo $status; ?></div></td>
														</tr>
														<?php
													$i++;
													}
												}
												?>
												</tbody>
											</table>
										</div>
									</div>
									<div class="form-actions">
										<div class="row">
											<div class="col-md-12">
												<div class="row">
												<?php if ($jumlah_sama > 0){ ?>
													<div class="col-md-offset-1 col-md-12">
														<button type="submit" name="btnimport_all" value="all" id="btnimport_all" class="btn green"> <i class="fa fa-check"></i> Proses Semua</button>
														<button type="submit" name="btnimport_part" value="part" id="btnimport_part" class="btn yellow"> <i class="fa fa-check"></i> Proses Sebagian</button>
														<a href="<?php echo site_url('musrenbang/kelurahan/sync');?>" class="btn default"> <i class="fa fa-reply"></i> Kembali</a>
													</div>
												<?php } else { ?>
													<div class="col-md-offset-1 col-md-12">
														<button type="submit" name="btnimport_part" value="part" id="btnimport_part" class="btn yellow"> <i class="fa fa-check"></i> Proses</button>
														<a href="<?php echo site_url('musrenbang/kelurahan/sync');?>" class="btn default"> <i class="fa fa-reply"></i> Kembali</a>
													</div>
												<?php } ?>
												</div>
											</div>
											<div class="col-md-6">
											</div>
										</div>
									</div>									
									<?php
								}
								?>
							</form>
						</div>
					</div>
				</div>
			</div>
			<?php } else if ($jenis_ == 4) { ?>
			<div class="row">
				<div class="col-md-12">
					<div class="portlet box blue">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-bars"></i>Informasi Export Data
							</div>
						</div>
						<div class="portlet-body form">
							<?php
							if ($jumlah_data > 0){
							?>
							<br />
								<div class="row">
									<div class="col-md-12" style="padding-left: 20px;padding-right: 20px">
										<table class="table table-bordered">
											<thead>
												<tr>
													<th class="text-center" width="50">#</th>
													<th class="text-center" width="150">Nomor</th>
													<th class="text-center">Nama Kegiatan</th>
													<th class="text-center">Lokasi</th>
												</tr>
											</thead>
											<tbody>
											<?php
											if ($grid_musrenbang){
												$i = 1;
												foreach($grid_musrenbang as $row_musrenbang){
													?>
													<tr>
														<td class="text-center"><?php echo $i; ?></td>
														<td><?php echo $row_musrenbang->nomor; ?></td>
														<td><?php echo $row_musrenbang->kegiatan; ?></td>
														<td><?php echo $row_musrenbang->alamat; ?></td>
													</tr>
													<?php
												$i++;
												}
											}
											?>
											</tbody>
										</table>
									</div>
								</div>
								<div class="form-actions">
									<div class="row">
										<div class="col-md-12">
											<div class="row">											
												<div class="col-md-offset-1 col-md-12">
													<a href="<?php echo site_url('musrenbang/kelurahan/export_do/'.$jenis_.'/'.$tahun_.'/'.$tipe_.'/'.$kecamatan_.'/'.$deskel_);?>" class="btn green"> <i class="fa fa-check"></i> Proses</a>
													<a href="<?php echo site_url('musrenbang/kelurahan/sync');?>" class="btn default"> <i class="fa fa-reply"></i> Kembali</a>
												</div>
											</div>
										</div>
										<div class="col-md-6">
										</div>
									</div>
								</div>
							<?php } else { ?>
							<div class="form-body">
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label class="col-md-12">Tidak ada data yang disinkronisasi</label>
										</div>
									</div>
								</div>
							</div>
							<?php } ?>
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
	<script>
	function show_form_deskel_by_kecamatan(){
		var kecamatan_kode = $('select[name=kecamatan_kode]').val();
		load('musrenbang/kelurahan/tampil_combobox_deskel_by_kecamatan/'+kecamatan_kode, '#tampil_combobox_deskel_by_kecamatan');
	}
	
	function show_form_pagedata(){
		var jenis	= $('select[name=jenis]').val();
		var tahun	= $('select[name=tahun]').val();
		var tipe	= document.querySelector('input[name="tipe"]:checked').value;
		load('musrenbang/kelurahan/tampil_combobox_pagedata/'+jenis+'/'+tahun+'/'+tipe, '#tampil_combobox_pagedata');
	}
	
	function proses_sync_all(){
		<?php
		if ($jenis_ == 1){
			?>
			if (confirm('Apakah Anda yakin akan memproses sinkronisasi ini?\nData kegiatan Tahun <?php echo $tahun_; ?> Jenis <?php echo $tipe_nama; ?> yang ada di RKPD Offline akan digantikan dengan data dari RKPD Online')) {
				sync_data("#btnsync_all", "<?php echo site_url('musrenbang/kelurahan/sync_do_'); ?>", "<?php echo $jenis_; ?>", "<?php echo $tahun_; ?>", "<?php echo $tipe_; ?>", "semua");
			}
			<?php
		} else if ($jenis_ == 2){
			?>
			if (confirm('Apakah Anda yakin akan memproses sinkronisasi ini?\nData kegiatan Tahun <?php echo $tahun_; ?> Jenis <?php echo $tipe_nama; ?> yang ada di RKPD Online akan digantikan dengan data dari RKPD Offline')) {
				sync_data("#btnsync_all", "<?php echo site_url('musrenbang/kelurahan/sync_do_'); ?>", "<?php echo $jenis_; ?>", "<?php echo $tahun_; ?>", "<?php echo $tipe_; ?>", "semua");
			}
			<?php
		}
		?>
	}
	
	function proses_sync_part(){
		if (confirm('Apakah Anda yakin akan memproses sinkronisasi ini?')) {
			sync_data("#btnsync_part", "<?php echo site_url('musrenbang/kelurahan/sync_do_'); ?>", "<?php echo $jenis_; ?>", "<?php echo $tahun_; ?>", "<?php echo $tipe_; ?>", "sebagian");
		}
	}
	</script>