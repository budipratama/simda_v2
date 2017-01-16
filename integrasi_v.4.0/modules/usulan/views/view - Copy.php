<!-- Main Content -->
            <div class="container-fluid">
                <div class="side-body padding-top">
				<h3 class="page-title">Hasil <small> Usulan Masyarakat</small></h3>
				
					<div class="row">
                        <div class="col-xs-12">
							<div class="bs-example">
								<ol class="breadcrumb">
									<li class="active"><i class="fa fa-home"></i> <a href="<?php echo site_url('dashboard');?>">Home</a></li>
									<li class="active"><a href="<?php echo site_url('usulan');?>"> Hasil Usulan Masyarakat</a></li>
								</ol>
							</div>
                        </div>
                    </div>
									
                    <div class="row">
                    <div class="panel panel-success">
						<div class="panel-heading"><i class="fa fa-search"></i> Pencarian Usulan Masyarakat</div>
						<div class="panel-body">
						<form action="<?php echo site_url('usulan/cari');?>" class="form-horizontal" method="post">
											<div class="form-body">
												<h3 class="form-section">Informasi Pencarian</h3>
												<div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-3" for="tahun">Tahun <span class="required">*</span></label>
															<div class="col-md-9">
                                                            <!-- combobox('jenis=db,1d,2d', 'array', 'name', 'value', 'value_name', 'selected', 'js', 'label', 'script') -->
															<?php combobox('db', $tahun, 'tahun', 'tahun', 'tahun', $tahun_, '', 'Pilih Tahun Anggaran', 'class="select2_category form-control" title="Pilih Tahun Anggaran" tabindex="1" required="required"'); ?>
															</div>
														</div>
													</div>
													<!--/span-->
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-3" for="skpd_kode">SKPD Pelaksana</label>
															<div class="col-md-9">
                                                            <!-- combobox('jenis=db,1d,2d', 'array', 'name', 'value', 'value_name', 'selected', 'js', 'label', 'script') -->
															<?php combobox('db', $skpd, 'skpd_kode', 'skpd_kode', 'skpd_nama', $skpd_, '', 'Semua SKPD Pelaksana', 'class="select2_category form-control" tabindex="1"'); ?>
															</div>
														</div>
													</div>
													<!--/span-->
												</div>
												<!--/row-->
												<div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-3" for="kecamatan_kode">Kecamatan</label>
															<div class="col-md-9">
                                                            <!-- combobox('jenis=db,1d,2d', 'array', 'name', 'value', 'value_name', 'selected', 'js', 'label', 'script') -->
															<?php combobox('db', $kecamatan, 'kecamatan_kode', 'skpd_kd', 'skpd_nama', $kecamatan_, '', 'Semua Kecamatan', 'class="select2_category form-control" tabindex="1"'); ?>
															</div>
														</div>
													</div>
													<!--/span-->
													<div class="col-md-6">
														<div class="form-group" id="tampil_combobox_deskel">
															<label class="control-label col-md-3" for="deskel_kode">Desa/Kelurahan</label>
															<div class="col-md-9">
																<select class="form-control select2_category" name="deskel_kode" id="deskel_kode">
																	<option value="">Semua Desa dan Kelurahan</option>
																</select>
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
																<input type="text" name="kegiatan" id="kegiatan" value="<?php echo $kegiatan_; ?>" class="form-control" placeholder="Kegiatan...">
															</div>
														</div>
													</div>
													<!--/span-->
												</div>
												<!--/row-->
											</div>
					<div class="clearfix"></div>
					<div class="form-group">
						<div class="col-sm-offset-8 col-sm-1">
							<button type="submit" class="btn btn-primary btn-xs">
							<span><i class="fa fa-check"></i></span>
								Cari
							</button>
						</div>
						<div class="col-sm-2">
							<a href="<?php echo site_url('usulan');?>" class="btn btn-default btn-xs">
							<span><i class="fa fa-eraser"></i></span>
								Clear
							</a>
						</div>
					</div>
				</form>	
					</div>
					</div>
                    </div>

<?php if ($tahun_) { ?>	
	<div class="row">
		<div class="panel panel-primary">
			<div class="panel-heading"><i class="fa fa-list"></i> Daftar Usulan Masyarakat</div>
			<div class="panel-body">
				<script>
							var ajax_source_url = '<?php echo site_url($this->uri->segment(1) . '/datatable/' . $this->uri->segment(3) . '/' . $this->uri->segment(4) . '/' . $this->uri->segment(5) . '/' . $this->uri->segment(6) . '/' . $this->uri->segment(7) . '/' . $this->uri->segment(8)); ?>';
							var ajax_source_field = [
										{ "data": "nomor" },
										{ "data": "kegiatan" },
										{ "data": "alamat" },
										{ "data": "biaya" },
										{ "data": "nama" },
										{ "data": "Actions" }
									];
						</script>
						
						<table class="table table-striped table-bordered table-hover" id="tableUtama">
							<thead>
							<tr>
								<th style="width:20px">No</th>
								<th>Nama Kegiatan</th>
								<th style="width:200px">Lokasi</th>
								<th style="width:200px">Asumsi Biaya</th>
								<th style="width:110px">Pengirim</th>
								<th style="width:100px; text-align:center;">Aksi</th>
							</tr>
							</thead>
						</table>
						

			<?php } else { ?>
			<div class="row" style="height:200px;"></div>
			<?php } ?>	
 
			</div>
		</div>
	</div>
					
	
                </div>
            </div>
        </div>