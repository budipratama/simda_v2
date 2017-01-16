<!-- BEGIN CONTENT -->
	<div class="page-content-wrapper">
		<div class="page-content">
			<!-- BEGIN PAGE HEADER-->
			<h3 class="page-title">
			Musrenbang Kelurahan <small>cetak laporan</small>
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
						<a href="#">Musrenbang Kelurahan</a>
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
								<i class="fa fa-bookmark"></i>Cetak Laporan Musrenbang Kelurahan
							</div>
						</div>
						<div class="portlet-body form">
							<!-- BEGIN FORM-->
							<form action="<?php echo site_url('laporan/musrenbang-kelurahan/preview');?>" class="horizontal-form" method="post">
								<div class="form-body">
									<div class="row">
										<div class="col-md-3">
											<div class="form-group">
												<label class="control-label" for="tanggal">Tanggal Laporan :</label>
												<div class="input-group input-medium date date-picker" data-date-format="yyyy-mm-dd">
													<input type="text" class="form-control" name="tanggal" id="tanggal" value="<?php echo date("Y-m-d");?>" readonly>
													<span class="input-group-btn">
													<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
													</span>
												</div>
											</div>
										</div>									
									</div>
									
									<div class="row">
										<div class="col-md-3">
											<div class="form-group">
												<label class="control-label" for="tahun">Tahun <span class="required">*</span> :</label>
												<?php combobox('db', $tahun, 'tahun', 'tahun', 'tahun', '', '', 'Pilih Tahun Anggaran', 'class="select2_category form-control" required="required"'); ?>
											</div>
										</div>
									
										<div class="col-md-9">
											<div class="form-group">
												<label class="control-label" for="skpd">SKPD/Kecamatan <span class="required">*</span> :</label>
												<?php if ($skpd_aktive == 'yes') { combobox('db', $skpd, 'skpd_kode', 'skpd_kode', 'skpd_nama', '', '', 'Semua SKPD/Kecamatan', 'class="select2_category form-control"'); 
												} else { 
												echo '<select class="select2_category form-control" name="skpd_kode" id="skpd_kode" data-placeholder="SKPD/Kecamatan" tabindex="1" required="required">
												<option value="'.$skpd_kode.'" selected>'.$skpd_nama.'</option>
												</select>';
												} ?>
											</div>
										</div>
									</div>
									
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">Jenis Anggaran :</label><br>
												<label class="radio-inline">
												<input type="radio" name="tipe_kode" id="tipe_kode" value="1" checked> Belanja Langsung </label>
												<label class="radio-inline">
												<input type="radio" name="tipe_kode" id="tipe_kode" value="2"> Belanja Tidak Langsung </label>
												
											</div>
										</div>
										<!--/span-->
									</div>
									
									<div class="row">
                                       <div class="col-md-5">
											<div class="form-group">
												<label class="control-label">Kecamatan</label>
												<!-- combobox('jenis=db,1d,2d', 'array', 'name', 'value', 'value_name', 'selected', 'js', 'label', 'script') -->
												<?php if ($kecamatan_aktive == 'yes') { combobox('db', $kecamatan, 'kecamatan_kode', 'skpd_kd', 'skpd_nama', '', 'show_form_deskel_by_kecamatan();', 'Semua Kecamatan', 'class="select2_category form-control" tabindex="1" required="required"'); 
												} else {
												echo '<select class="select2_category form-control" name="kecamatan_kode" id="kecamatan_kode" data-placeholder="Pilih Kecamatan" tabindex="1" required="required">
												<option value="'.$kecamatan_kode.'" selected>'.$kecamatan_nama.'</option>
												</select>';
												} ?>
											</div>
										</div>
										<!--/span-->
										<div class="col-md-5">
											<div class="form-group" id="tampil_combobox_deskel_by_kecamatan">
												<label class="control-label" for="deskel_kode">Desa</label>
												<?php
												if ($admin_log['level_kode'] == 15){
													echo '<select class="select2_category form-control" name="deskel_kode" id="deskel_kode" data-placeholder="Pilih Desa" tabindex="1" required="required">
													<option value="'.$deskel_kode.'" selected>'.$deskel_nama.'</option>
													</select>';
												} else if ($admin_log['level_kode'] == 4){
													combobox('db', $deskel, 'deskel_kode', 'skpd_kd', 'skpd_nama', '', '', 'Semua Desa', 'class="select2_category form-control" tabindex="1"'); 
												} else { ?>
												<select class="form-control select2_category" name="deskel_kode" id="deskel_kode">
													<option value="">Semua Desa</option>
												</select>
												<?php
												}?>
											</div>
										</div>
										<!--/span-->
									</div>
									
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label" for="nama_pimpinan">Nama Pimpinan :</label>
												<input type="text" class="form-control" name="nama_pimpinan" id="nama_pimpinan" value="" placeholder="">
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label class="control-label" for="pangkat">Pangkat/Gol :</label>
												<input type="text" class="form-control" name="pangkat" id="pangkat" value="" placeholder="">
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label" for="nip">NIP :</label>
												<input type="text" class="form-control" name="nip" id="nip" value="" placeholder="">
											</div>
										</div>
									</div>
									
								</div>
								
								<div class="form-actions">
									<div class="row">
										<div class="col-md-9">
											<div class="row">
												<div class="col-md-offset-3 col-md-9">
													<button type="submit" name="cetak" class="btn green"><i class="fa fa-check"></i> Lihat Laporan Musrenbang Kelurahan</button>
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
			<div class="row" style="height:200px;">
			</div>
		</div>
		
	</div>
	
	<script>
	function show_form_deskel_by_kecamatan(){
		var kecamatan_kode = $('select[name=kecamatan_kode]').val();
		load('laporan/musrenbang-kelurahan/tampil_combobox_deskel_by_kecamatan/'+kecamatan_kode, '#tampil_combobox_deskel_by_kecamatan');
	}
	</script>