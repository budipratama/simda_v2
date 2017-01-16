<!-- BEGIN CONTENT -->
	<div class="page-content-wrapper">
		<div class="page-content">
			<!-- BEGIN PAGE HEADER-->
			<h3 class="page-title">
			Rekap Indikator Belum Terpakai <small>cetak laporan</small>
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
						<a href="#">Indikator Belum Terpakai</a>
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
								<i class="fa fa-bookmark"></i>Cetak Rekap Indikator Belum Terpakai
							</div>
						</div>
						<div class="portlet-body form">
							<!-- BEGIN FORM-->
							<form action="<?php echo site_url('laporan/indikator-belum-terpakai/preview');?>" class="horizontal-form" method="post">
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
									
										<div class="col-md-4">
											<div class="form-group">
												<label class="control-label" for="tahapan">Tahapan Anggaran <span class="required">*</span> :</label>
												<select name="tahapan" id="tahapan" data-placeholder="Pilih Tahapan" class="select2_category form-control" required="required">
													<option value=''>Pilih Tahapan</option>
													<option value='5'>Pra Rencana Kerja</option>
													<option value='6'>Rencana Kerja Murni</option>
													<option value='7'>Rencana Kerja Perubahan</option>
													<option value='8'>Musrenbang Kabupaten</option>
													<option value='9'>RKPD Murni</option>
													<option value='10'>RKPD Perubahan</option>
													<option value='11'>KUA & PPAS Murni</option>
													<option value='12'>KUA & PPAS Perubahan</option>
												</select>
											</div>
										</div>
									</div>
									
								</div>
								
								<div class="form-actions">
									<div class="row">
										<div class="col-md-9">
											<div class="row">
												<div class="col-md-offset-3 col-md-9">
													<button type="submit" name="cetak" class="btn green"><i class="fa fa-check"></i> Lihat Rekap Indikator Belum Terpakai</button>
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