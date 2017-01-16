<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
		<div class="page-content">
		<!-- BEGIN PAGE HEADER-->			
	<div class="row">
	<div id="breadcrumb" <div class="page-bar">>
		<a href="#" class="show-sidebar">
			<i class="fa fa-bars"></i>
		</a>
		<ol class="breadcrumb pull-left">
			<li><a href="<?php echo site_url();?>">Home</a></li>
			<li><a href="<?php echo site_url('eksekutif/musrenbang-desa');?>">Eksekutif Musrenbang Desa</a></li>
		</ol>
	</div>
	</div>
			<h3 class="page-title">
			Hasil Eksekutif Musrenbang Desa <small>entri data &amp; informasi detail</small>
			</h3>
            <!-- END PAGE HEADER-->
			<?php if ($this->session->flashdata('success')) { echo $this->session->flashdata('success');} ?>
			
			
<!-- BEGIN FORM -->
<div class="row">
	<div class="col-xs-12 col-sm-12">
		<div class="box">
			<div class="box-header">
				<div class="box-name">
					<i class="fa fa-search"></i>
					<span>Pencarian Hasil Eksekutif Musrenbang Desa</span>
				</div>
			</div>
			<div class="box-content">
				<h4 class="page-header">Informasi Pencarian</h4>
				<!-- BEGIN FORM-->
				<form action="<?php echo site_url('eksekutif/musrenbang-desa/cari');?>" class="form-horizontal" method="post">
											<div class="form-body">
												<div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-3">Tahun <span class="required">*</span></label>
															<div class="col-md-9">
                                                            <!-- combobox('jenis=db,1d,2d', 'array', 'name', 'value', 'value_name', 'selected', 'js', 'label', 'script') -->
															<?php combobox('db', $tahun, 'tahun', 'tahun', 'tahun', $tahun_, '', 'Pilih Tahun Anggaran', 'class="select2_category form-control" tabindex="1" title="Silahkan Pilih Tahun Anggaran" required="required"'); ?>
															</div>
														</div>
													</div>
													<!--/span-->
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-3">SKPD Pelaksana</label>
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
															<label class="control-label col-md-3">Kecamatan</label>
															<div class="col-md-9">
                                                            <!-- combobox('jenis=db,1d,2d', 'array', 'name', 'value', 'value_name', 'selected', 'js', 'label', 'script') -->
															<?php
															combobox('db', $kecamatan, 'kecamatan_kode', 'skpd_kd', 'skpd_nama', $kecamatan_, 'show_form_deskel_by_kecamatan();', 'Semua Kecamatan', 'class="select2_category form-control" tabindex="1"'); 
															?>
															</div>
														</div>
													</div>
													<!--/span-->
													<div class="col-md-6">
														<div class="form-group" id="tampil_combobox_deskel_by_kecamatan">
															<label class="control-label col-md-3" for="deskel_kode">Desa</label>
															<div class="col-md-9">
															<?php 
															combobox('db', $deskel, 'deskel_kode', 'skpd_kd', 'skpd_nama', $deskel_, '', 'Semua Desa', 'class="select2_category form-control" tabindex="1"'); 
															?>
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
					<div class="clearfix"></div>
					<div class="form-group">
						<div class="col-sm-offset-8 col-sm-1">
							<button type="submit" class="btn btn-primary btn-xs">
							<span><i class="fa fa-check"></i></span>
								Cari
							</button>
						</div>
						<div class="col-sm-2">
							<a href="<?php echo site_url('eksekutif/musrenbang-desa');?>" class="btn btn-default btn-xs">
							<span><i class="fa fa-eraser"></i></span>
								Clear
							</a>
						</div>
					</div>
				</form>
				<!-- END FORM-->
			</div>
		</div>
	</div>
</div>
			
	<div class="clearfix"></div>
	<?php if ($tahun_) { ?>		
	<div class="row">
	<div class="col-xs-12 col-sm-12">
		<div class="box">
			<div class="box-header">
				<div class="box-name">
					<i class="fa fa-search"></i>
					<span>Daftar Usulan Masyarakat</span>
				</div>
				<div class="no-move"></div>
			</div>
			<div class="box-content">
				<script>
							var ajax_source_url = '<?php echo site_url($this->uri->segment(1) . '/' . $this->uri->segment(2) . '/datatable/' . $this->uri->segment(4) . '/' . $this->uri->segment(5) . '/' . $this->uri->segment(6) . '/' . $this->uri->segment(7) . '/' . $this->uri->segment(8) . '/' . $this->uri->segment(9)); ?>';
							var ajax_source_field = [
										{ "data": "nomor" },
										{ "data": "kegiatan" },
										{ "data": "alamat" },
										{ "data": "skpd_nama" },
										{ "data": "Actions" }
									];
						</script>
						<div class="portlet-body">
							<table class="table table-striped table-bordered table-hover" id="tableUtama">
							<thead>
							<tr>
								<th style="width:20px">No</th>
								<th class="hidden-xs">Nama Kegiatan</th>
								<th style="width:200px">Lokasi</th>
								<th style="width:200px">SKPD Pelaksana</th>
								<th style="width:100px; text-align:center;">Aksi</th>
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
	<script>
	function show_form_deskel_by_kecamatan(){
		var kecamatan_kode = $('select[name=kecamatan_kode]').val();
		load('eksekutif/musrenbang-desa/tampil_combobox_deskel_by_kecamatan/'+kecamatan_kode, '#tampil_combobox_deskel_by_kecamatan');
	}
	</script>