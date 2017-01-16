<!-- Main Content -->
<div class="container-fluid">
	<div class="side-body padding-top">
		<h3 class="page-title">Parameter <small>korolari</small></h3>
		<div class="row">
            <div class="col-xs-12">
				<div class="bs-example">
					<ol class="breadcrumb">
						<li class="active"><i class="fa fa-home"></i> <a href="<?php echo site_url('dashboard');?>">Home</a></li>
						<li class="active"><a href="<?php echo site_url('parameter');?>">Parameter</a></li>
						<li class="active"><a href="<?php echo site_url('parameter/korolari');?>">Korolari</a></li>
					</ol>
				</div>
            </div>
        </div>
            <!-- END PAGE HEADER-->			
			<?php if ($this->session->flashdata('success')) { echo $this->session->flashdata('success');} ?>
			<!-- BEGIN FORM -->
			<div class="panel panel-success">
				<div class="panel-heading"><i class="fa fa-search"></i> Pencarian Pra APBD Kabupaten Murni</div>
				<div class="panel-body">
				<form action="<?php echo site_url('parameter/korolari/cari');?>" class="form-horizontal" method="post">
					<div class="form-group">
						<label class="control-label col-md-1">Tahun <span class="required">*</span></label>
						<div class="col-md-4">
							<?php combobox('db', $akun, 'kode_aaa', 'kode', 'akun_nama', $tahun_, '', 'Pilih Tahun Anggaran', 'class="select2_category form-control" tabindex="1" title="Silahkan Pilih Tahun Anggaran" required="required"'); ?>
						</div>
						<label class="control-label col-md-2">SKPD Pelaksana</label>
						<div class="col-md-4">
                            <?php if ($skpd_aktive == 'yes') { combobox('db', $kelompok, 'kode', 'kode', 'kelompok_nama', $kelompok_, '', 'Semua SKPD Pelaksana', 'class="select2_category form-control" tabindex="1"'); 
								} else { 
									echo '<select class="select2_category form-control" name="skpd_kode" id="skpd_kode" data-placeholder="Pilih SKPD Pelaksana" tabindex="1" required="required">
									<option value="'.$kode.'" selected>'.$kelompok_nama.'</option>
									</select>';
								} ?>
						</div>
					</div>
					<!--/row-->												
					<div class="form-group">
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
								<a href="<?php echo site_url('parameter/korolari');?>" id="confirmasiHapus" class="btn btn-default"><i class="fa fa-eraser"></i> Clear</a>							</div>
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
			<div class="panel-heading"><i class="fa fa-list"></i> Daftar RKPD Murni</div>
			<div class="panel-body">
						<script>
							var ajax_source_url = '<?php echo site_url($this->uri->segment(1) . '/' . $this->uri->segment(2) . '/datatable/' . $this->uri->segment(4) . '/' . $this->uri->segment(5) . '/' . $this->uri->segment(6) . '/' . $this->uri->segment(7) . '/' . $this->uri->segment(8) . '/' . $this->uri->segment(9)); ?>';
							var ajax_source_field = [
										{ "data": "nomor" },
										{ "data": "kegiatan" },
										{ "data": "alamat" },
										{ "data": "sumber_nama" },
										{ "data": "skpd_nama" },
										{ "data": "perubahan_status_nama" },
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
								<th style="width:80px" style="align:center;">Status</th>
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
					<h4 class="modal-title"><strong>Success!</strong> Tambah Pra APBD Kabupaten Murni</h4>
				</div>
				<div class="modal-body">
					 Data Pra APBD Kabupaten Murni telah berhasil ditambahkan !
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
					<h4 class="modal-title"><strong>Success!</strong> Ubah Pra APBD Kabupaten Murni</h4>
				</div>
				<div class="modal-body">
					 Data Pra APBD Kabupaten Murni telah berhasil diperbaharui !
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
					<h4 class="modal-title"><strong>Success!</strong> Hapus Pra APBD Kabupaten Murni</h4>
				</div>
				<div class="modal-body">
					 Data Pra APBD Kabupaten Murni telah berhasil dihapus !
				</div>
				<div class="modal-footer">
					<button type="button" class="btn green" data-dismiss="modal">OK</button>
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
		load('kua-ppas/murni/tampil_combobox_deskel_by_kecamatan/'+kecamatan_kode, '#tampil_combobox_deskel_by_kecamatan');
	}
	</script>