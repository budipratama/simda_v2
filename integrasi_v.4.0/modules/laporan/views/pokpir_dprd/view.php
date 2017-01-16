<!-- BEGIN CONTENT -->
	<div class="page-content-wrapper">
		<div class="page-content">
			<!-- BEGIN PAGE HEADER-->
			<h3 class="page-title">
			Pokok-Pokok Pikiran DPRD <small>cetak laporan</small>
			</h3>
			<div class="page-bar">
				<ul class="page-breadcrumb">
					<li>
						<i class="fa fa-home"></i>
						<a href="<?php echo site_url('dashboard');?>">Home</a>
						<i class="fa fa-angle-right"></i>
					</li>
                    <li>
						<a href="<?php echo site_url('laporan');?>">Laporan</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="#">Pokok-Pokok Pikiran DPRD</a>
					</li>
				</ul>
			</div>
            <!-- END PAGE HEADER-->
			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN SAMPLE TABLE PORTLET-->
					<div class="portlet box green">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-bookmark"></i>Cetak Rekap Pokok-Pokok Pikiran DPRD
							</div>
						</div>
						<div class="portlet-body form">
							<!-- BEGIN FORM-->
							<form action="<?php echo site_url('laporan/pokpir-dprd/preview');?>" class="horizontal-form" method="post">
								<div class="form-body">
									<div class="row">
										<div class="col-md-3">
											<div class="form-group">
												<label class="control-label" for="tanggal">Tanggal Laporan <span class="required">*</span> :</label>
												<div class="input-group input-medium date date-picker" data-date-format="yyyy-mm-dd">
													<input type="text" class="form-control" name="tanggal" id="tanggal" value="<?php echo date("Y-m-d");?>" readonly>
													<span class="input-group-btn">
													<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
													</span>
												</div>
											</div>
										</div>									
										<div class="col-md-3">
											<div class="form-group">
												<label class="control-label" for="tahun">Tahun Anggaran <span class="required">*</span> :</label>
												<?php combobox('db', $tahun, 'tahun', 'tahun', 'tahun', '', '', 'Pilih Tahun Anggaran', 'class="select2_category form-control" required="required"'); ?>
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<label class="control-label" for="anggota">Anggota DPRD :</label>
												<?php combobox('db', $anggota_dprd, 'anggota', 'admin_user', 'admin_nama', '', '', 'Semua Anggota DPRD', 'class="select2_category form-control"'); ?>
											</div>
										</div>
									</div>
									
								</div>
								
								<div class="form-actions">
									<div class="row">
										<div class="col-md-9">
											<div class="row">
												<div class="col-md-offset-3 col-md-9">
													<button type="submit" name="cetak" class="btn green"><i class="fa fa-check"></i> Lihat Laporan Pokok Pikiran DPRD</button>
													<a href="#" onClick="history.go(-1); return false;" class="btn default"><i class="fa fa-times"></i> Batal</a>
												</div>
											</div>
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
			<div class="row" style="height:300px;">
			</div>
		</div>
		
	</div>