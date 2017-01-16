<!-- BEGIN CONTENT -->
	<div class="page-content-wrapper">
		<div class="page-content">
			<!-- BEGIN PAGE HEADER-->
			<h3 class="page-title">
			Hasil Musrenbang Kabupaten Perubahan <small>entri data &amp; informasi detail</small>
			</h3>
			<div class="page-bar">
				<ul class="page-breadcrumb">
					<li>
						<i class="fa fa-home"></i>
						<a href="<?php echo site_url('dashboard');?>">Home</a>
						<i class="fa fa-angle-right"></i>
					</li>
                    <li>
						<a href="#">Musrenbang</a>
						<i class="fa fa-angle-right"></i>
					</li>
                    <li>
						<a href="#">Kabupaten</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="#">Perubahan</a>
					</li>
				</ul>
			</div>
			<!--
            <div class="note note-warning">
				<p>
					NOTE: Ini hanya contoh. Data ini hanya sebagai gambaran saja untuk kedepannya.
				</p>
			</div>
			<div class="alert alert-warning fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><i class="fa-lg fa fa-warning"></i> Peringatan, Ini hanya contoh dashboard. Data ini hanya sebagai gambaran saja untuk kedepannya dan belum menggunakan data real.</div>
			-->
            <!-- END PAGE HEADER-->
			<!-- BEGIN FORM -->
			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN SAMPLE TABLE PORTLET-->
					<div class="portlet box green">
									<div class="portlet-title">
										<div class="caption">
											<i class="fa fa-search"></i>Pencarian Hasil Musrenbang Kabupaten Perubahan
										</div>
										<div class="tools">
											<a href="javascript:;" class="expand" data-original-title="" title=""></a>
											<!-- <a href="javascript:;" class="remove" data-original-title="" title=""></a> -->
										</div>
									</div>
									<div class="portlet-body form" style="display: none;">
										<!-- BEGIN FORM-->
										<form action="#" class="form-horizontal">
											<div class="form-body">
												<h3 class="form-section">Informasi Pencarian</h3>
												<div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-3">Tahun</label>
															<div class="col-md-9">
																<select class="form-control select2_category">
																	<option value="">2015</option>
																	<option value="">2016</option>
																	<option value="">2017</option>
																</select>
															</div>
														</div>
													</div>
													<!--/span-->
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-3">SKPD Pelaksana</label>
															<div class="col-md-9">
																<select class="form-control select2_category">
																	<option value="Category 1">Semua SKPD Pelaksana</option>
																	<option value="Category 2">Dinas Binamarga</option>
																	<option value="Category 3">Dinas Pendidikan</option>
																	<option value="Category 4">Dinas Kesehatan</option>
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
															<label class="control-label col-md-3">Kecamatan</label>
															<div class="col-md-9">
																<select class="form-control select2_category">
																	<option value="">Semua Kecamatan</option>
																	<option value="">Kecamatan Babelan</option>
																	<option value="">Kecamatan Bojongmangu</option>
																</select>
															</div>
														</div>
													</div>
													<!--/span-->
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-3">Desa/Kelurahan</label>
															<div class="col-md-9">
																<select class="form-control select2_category">
																	<option value="">Semua Desa dan Kelurahan</option>
																	<option value="">Kelurahan Setu</option>
																	<option value="">Desa Bojongmagu</option>
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
															<label class="control-label col-md-3">Nama Kegiatan</label>
															<div class="col-md-9">
																<input type="text" class="form-control" placeholder="Kegiatan...">
															</div>
														</div>
													</div>
													<!--/span-->
                                                    <div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-3">Jenis Anggaran</label>
															<div class="col-md-9">
																<select class="form-control select2_category">
																	<option value="0">Semua Jenis Anggaran</option>
																	<option value="1">Belanja Langsung</option>
																	<option value="2">Belanja Tidak Langsung</option>
																</select>
															</div>
														</div>
													</div>
													<!--/span-->
												</div>
												<!--/row-->
											</div>
											<div class="form-actions">
												<div class="row">
													<div class="col-md-6">
														<div class="row">
															<div class="col-md-offset-3 col-md-9">
																<button type="submit" class="btn green">Cari Informasi</button>
																<button type="button" class="btn default">Batal</button>
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
            
			<div class="row">
				<div class="col-md-12">
                	<div class="portlet" align="right">
                		<a href="<?php echo site_url('musrenbang/kabupaten/perubahan');?>" class="btn default"><i class="fa fa-times"></i> Bersihkan Hasil Pencarian </a>
                		<div class="btn-group">
                        	<button type="button" class="btn green dropdown-toggle" data-toggle="dropdown">Tambah Musrenbang Kabupaten Perubahan</button>
							<button type="button" class="btn green dropdown-toggle" data-toggle="dropdown"><i class="fa fa-angle-down"></i></button>
							<ul class="dropdown-menu" role="menu">
							<li>
								<a href="<?php echo site_url('musrenbang/kabupaten/belanja-langsung/add');?>">Belanja Langsung</a>
							</li>
                            <li>
								<a href="<?php echo site_url('musrenbang/kabupaten/belanja-tidak-langsung/add');?>">Belanja Tidak Langsung</a>
							</li>
							</ul>
						</div>
                    </div>
                </div>
            </div>
			<div class="clearfix"></div>

            <div class="row">
				<div class="col-md-12">
					<div class="portlet box blue">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-bars"></i>Daftar Hasil Musrenbang Kabupaten Perubahan
							</div>
							<div class="tools">
								<a href="javascript:;" class="collapse"></a>
								<!-- <a href="javascript:;" class="remove"></a> -->
							</div>
						</div>
						<div class="portlet-body">
							<table class="table table-striped table-bordered table-hover" id="sample_6">
							<thead>
							<tr>
								<th class="hidden-xs">
									Nama Kegiatan
								</th>
								<th class="hidden-xs">
									Lokasi
								</th>
								<th class="hidden-xs">
									Total Biaya
								</th>
								<th class="hidden-xs">
									SKPD Pelaksana
								</th>
								<th>
									
								</th>
							</tr>
							</thead>
							<tbody>
							<tr>
								<td>
									Pembangunan Gedung Sekolah Baru SDN Karangsentosa 04
								</td>
								<td>
									Kabupaten Bekasi
								</td>
								<td align="right">
									Rp1.000.000.000
								</td>
								<td>
									Dinas Kesehatan
								</td>
								<td>
                                    <a href="#" class="btn default btn-sm purple" title="Detail"><i class="fa fa-file-text"></i></a>
									<a href="#" class="btn default btn-sm yellow" title="Ubah"><i class="fa fa-pencil"></i></a>
                                    <a href="#" class="btn default btn-sm red" title="Hapus"><i class="fa fa-trash-o"></i></a>
								</td>
							</tr>
							<tr>
								<td>
									Pembangunan ruang perpustakaan SDN karang Indah 02
								</td>
								<td>
									Kecamatan Bojongmangu
								</td>
								<td align="right">
									Rp150.000.000
								</td>
								<td>
									Dinas Bina Marga
								</td>
								<td>
                                    <a href="#" class="btn default btn-sm purple" title="Detail"><i class="fa fa-file-text"></i></a>
									<a href="#" class="btn default btn-sm yellow" title="Ubah"><i class="fa fa-pencil"></i></a>
                                    <a href="#" class="btn default btn-sm red" title="Hapus"><i class="fa fa-trash-o"></i></a>
								</td>
							</tr>
							</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
		
	</div>
	<!-- END CONTENT -->