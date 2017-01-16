<!-- Main Content -->
<div class="container-fluid">
	<div class="side-body padding-top">
		<h3 class="page-title">Pra Rencana Kerja <small>entri data &amp; informasi detail</small></h3>
		<div class="row">
            <div class="col-xs-12">
				<div class="bs-example">
					<ol class="breadcrumb">
						<li class="active"><i class="fa fa-home"></i> <a href="<?php echo site_url('dashboard');?>">Home</a></li>
						<li class="active"><a href="<?php echo site_url('pra-rencana-kerja');?>">Pra Rencana Kerja</a></li>
					</ol>
				</div><br>
				<div class="panel panel-info">
					<div class="panel-heading">NOTE: <li>Fiture Transfer <i class="fa fa-refresh"></i> merupakan fasilitas bagi Anda untuk mencopy data yang sudah dientri, jadi Anda tidak usah repot-repot mengisi semua form isian pilihan dari awal lagi.</li>
					<li>Fitur ini diharapkan dapat mempermudah dan mempercepat proses entri data kegiatan Anda.</li></div>
				</div>
            </div>
        </div>
<!-- END PAGE HEADER-->
			<!-- BEGIN FORM -->
            <div class="panel panel-success">
				<div class="panel-heading"><i class="fa fa-search"></i> Pencarian Pra Rencana Kerja</div>
				<div class="panel-body">
				<form action="<?php echo site_url('parameter/rekening-sub/cari');?>" class="form-horizontal" method="post">
					<div class="form-group">
						<label class="control-label col-md-1">Tahun <span class="required">*</span></label>
						<div class="col-md-4">
							<?php combobox('db', $tahun, 'tahun', 'tahun', 'tahun', $tahun_, '', 'Pilih Tahun Anggaran', 'class="select2_category form-control" tabindex="1" title="Silahkan Pilih Tahun Anggaran" required="required"'); ?>
						</div>
						<label class="control-label col-md-2">SKPD Pelaksana</label>
						<div class="col-md-4">
                            <?php if ($skpd_aktive == 'yes') { combobox('db', $skpd, 'skpd_kode', 'skpd_kode', 'skpd_nama', $skpd_, '', 'Semua SKPD Pelaksana', 'class="select2_category form-control" tabindex="1"'); 
								} else { 
									echo '<select class="select2_category form-control" name="skpd_kode" id="skpd_kode" data-placeholder="Pilih SKPD Pelaksana" tabindex="1" required="required">
									<option value="'.$skpd_kode.'" selected>'.$skpd_nama.'</option>
									</select>';
								} ?>
						</div>
					</div>
					<!--/row-->												
					<div class="form-group">
						<label class="control-label col-md-1">Kecamatan</label>
						<div class="col-md-4">
							<?php if ($kecamatan_aktive == 'yes') { combobox('db', $kecamatan, 'kecamatan_kode', 'skpd_kd', 'skpd_nama', $kecamatan_, 'show_form_deskel_by_kecamatan();', 'Semua Kecamatan', 'class="select2_category form-control" tabindex="1"'); 
								} else {
									echo '<select class="select2_category form-control" name="kecamatan_kode" id="kecamatan_kode" data-placeholder="Pilih Kecamatan" tabindex="1" required="required">
									<option value="'.$kecamatan_kode.'" selected>'.$kecamatan_nama.'</option>
									</select>';
								} ?>
						</div>
						
						<div class="col-md-6">
							<div class="form-group" id="tampil_combobox_deskel_by_kecamatan">
								<label class="control-label col-md-4" for="deskel_kode">Desa/Kelurahan</label>
							<div class="col-md-7">
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
					</div>
					<!--/row-->												
					<div class="form-group">
						<label class="control-label col-md-1" for="kegiatan">Nama Kegiatan</label>
						<div class="col-md-4">
							<input type="text" class="form-control" name="kegiatan" id="kegiatan" value="<?php echo $kegiatan_;?>" placeholder="Kegiatan...">
						</div>
						<label class="control-label col-md-2">Belanja Langsung</label>
						<div class="col-md-1">
							<input type="radio" name="tipe_kode" id="tipe_kode" value="1" <?php echo ($tipe_ == 1)?'checked':'';?>>
						</div>	
						<label class="control-label col-md-2">Belanja Tidak Langsung</label>
						<div class="col-md-1">
							<input type="radio" name="tipe_kode" id="tipe_kode" value="2" <?php echo ($tipe_ == 2)?'checked':'';?>> 
						</div>
					</div>
					<!--/row-->											
					<div style="margin-left:500px;">
						<div class="col-md-12">
							<div class="col-md-offset-1 col-md-12">
								<button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Cari</button>
								<a href="<?php echo site_url('pra-rencana-kerja');?>" id="confirmasiHapus" class="btn btn-default"><i class="fa fa-eraser"></i> Clear</a>
								
							<div class="btn-group" style="margin-left:100px;">
								<button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-plus"></i> Pra Rencana Kerja <span class="caret"></span></button>
								<ul class="dropdown-menu" role="menu">
									<li><a href="<?php echo site_url('pra-rencana-kerja/belanja-langsung');?>">Belanja Langsung</a></li>
									<li><a href="<?php echo site_url('pra-rencana-kerja/belanja-tidak-langsung');?>">Belanja Tidak Langsung</a></li>
								</ul>
							</div>
							</div>
						</div>
					</div>
					<!--/row-->							
					</form>
				<!-- END FORM-->
				</div>
			</div>
			<!-- END SAMPLE TABLE PORTLET-->
<div class="clearfix" id="hasil"></div>
<?php if ($tahun_) { ?>
            
		<div class="panel panel-primary">
			<div class="panel-heading"><i class="fa fa-list"></i> Daftar Usulan Masyarakat</div>
			<div class="panel-body">
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
								<th style="width:20px">No</th>
								<th class="hidden-xs">Nama Kegiatan</th>
								<th style="width:200px">Lokasi</th>
								<th style="width:200px">SKPD/Kecamatan</th>
								<th style="width:120px; text-align:center;">Transfer</th>
								<th style="width:90px; text-align:center;">Actions</th>
							</tr>
							</thead>
							<tbody>
							</tbody>
							</table>
						</div>
			</div>
		</div>
			<?php } else { ?>
			<div class="row" style="height:200px;"></div>
			<?php } ?>
	</div>
</div>
	<!-- END CONTENT -->
	
	<script>
	function show_form_deskel_by_kecamatan(){
		var kecamatan_kode = $('select[name=kecamatan_kode]').val();
		load('pra_rencana_kerja/tampil_combobox_deskel_by_kecamatan/'+kecamatan_kode, '#tampil_combobox_deskel_by_kecamatan');
	}
	</script>