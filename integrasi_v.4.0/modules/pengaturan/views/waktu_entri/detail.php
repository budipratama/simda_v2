<!-- BEGIN CONTENT -->
	<div class="page-content-wrapper">
		<div class="page-content">
			<!-- BEGIN PAGE HEADER-->
			<h3 class="page-title">
			Detail Waktu Entri
			</h3>
			<div class="page-bar">
				<ul class="page-breadcrumb">
					<li>
						<i class="fa fa-home"></i>
						<a href="<?php echo site_url('dashboard');?>">Home</a>
						<i class="fa fa-angle-right"></i>
					</li>
                    <li>
						<a href="<?php echo site_url('pengaturan');?>">Control Panel</a>
						<i class="fa fa-angle-right"></i>
					</li>
                    <li>
						<a href="<?php echo site_url('pengaturan/waktu-entri');?>">Waktu Entri</a>
						<i class="fa fa-angle-right"></i>
					</li>
                     <li>
						<a href="#">Detail</a>
					</li>
				</ul>
			</div>
			
            <!-- END PAGE HEADER-->
			<!-- BEGIN FORM -->
			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN SAMPLE TABLE PORTLET-->
					<div class="portlet box green">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-pencil"></i>Data Detail: <?php echo $nama; ?>
							</div>
						</div>
						<div class="portlet-body form">
							<!-- BEGIN FORM-->
							<form action="<?php echo site_url('pengaturan/tahapan-skpd/insert');?>" class="form-horizontal" method="post">
								<input type="hidden" name="tahapan_kode" value="<?php echo $kode;?>">
								<div class="form-body">
									<div class="row">
										<div class="col-md-4">
											<div class="form-group">
												<label class="control-label col-md-6" for="nama">Nama :</label>
                                                <div class="col-md-6">
                                                	<p class="form-control-static"><?php echo $nama; ?></p>
                                                </div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-4">
											<div class="form-group">
												<label class="control-label col-md-6" for="mulai">Tanggal Mulai :</label>
												<div class="col-md-6">
                                                	<p class="form-control-static"><?php echo $mulai;?></p>
                                                </div>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label class="control-label col-md-6" for="selesai">Tanggal Selesai :</label>
												<div class="col-md-6">
                                                	<p class="form-control-static"><?php echo $selesai;?></p>
                                                </div>
											</div>
										</div>
									</div>
								</div>
								<div class="form-actions">
									<div class="row">
										<div class="col-md-12">
											<div class="row">
												<div class="col-md-offset-1 col-md-6">
													<?php combobox('db', $skpd, 'skpd_kode', 'skpd_kode', 'skpd_nama', '', '', 'Pilih SKPD Pelaksana', 'class="select2_category form-control" title="Pilih SKPD Pelaksana" required="required"'); ?>
												</div>
												<div class="col-md-5">
													<button type="submit" class="btn green"><i class="fa fa-plus"></i> Tambah</button>
													<a href="<?php echo site_url('pengaturan/waktu_entri');?>" class="btn default"><i class="fa fa-reply"></i> Kembali</a>
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
					<div class="portlet box blue">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-bars"></i>Daftar SKPD Dikasih Akses 
							</div>
						</div>
						<div class="portlet-body">
							<table class="table table-striped table-bordered table-hover" id="tableUtama">
							<thead>
							<tr>
								<th style="width:25px">No</th>
                                <th>Nama SKPD</th>
								<th style="width:70px;text-align:center;">Aksi</th>
							</tr>
							</thead>
							<tbody>
							<?php 
							if ($tahapan_skpd){
							$no = 1;
							foreach($tahapan_skpd as $row){
							?>
							<tr>
								<td><?php echo $no;?></td>
                                <td><?php echo $row->skpd_nama;?></td>
								<td style="text-align:center;">
									<a href="<?php echo site_url('pengaturan/tahapan-skpd/delete/'.$row->kode.'/'.$row->tahapan_kode); ?>" class="btn default btn-sm red" data-placement="left" data-toggle="confirmation" data-original-title="Apakah Anda yakin akan menghapus data ini ?"><i class="fa fa-trash-o"></i></a>
								</td>
							</tr>
							<?php 
							$no++;
							} 
							}
							?>
							</tbody>
							</table>
						</div>
					</div>
				</div>
                
			</div>
		</div>
	</div>
	
	<a href="#successInsert" data-toggle="modal"></a>
	<div id="successInsert" class="modal fade" role="dialog" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
					<h4 class="modal-title"><strong>Success!</strong> Tambah Tahapan SKPD Pelaksana</h4>
				</div>
				<div class="modal-body">
					 Data Tahapan SKPD Pelaksana telah berhasil ditambahkan !
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
					<h4 class="modal-title"><strong>Success!</strong> Hapus Tahapan SKPD Pelaksana</h4>
				</div>
				<div class="modal-body">
					 Data Tahapan SKPD Pelaksana telah berhasil dihapus !
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
					<h4 class="modal-title"><strong>Warning!</strong> Tahapan SKPD Sudah Terdaftar!</h4>
				</div>
				<div class="modal-body">
					SKPD Pelaksana sudah terdaftar sebagai SKPD yang diberikan akses!
				</div>
				<div class="modal-footer">
					<button type="button" class="btn yellow" data-dismiss="modal">OK</button>
				</div>
			</div>
		</div>
	</div>