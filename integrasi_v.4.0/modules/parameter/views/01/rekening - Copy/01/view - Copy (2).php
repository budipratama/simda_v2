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
				</div>
            </div>
        </div>
<!-- END PAGE HEADER-->
			<!-- BEGIN FORM -->
            <div class="panel panel-success">
				<div class="panel-heading"><i class="fa fa-search"></i> Pencarian Pra Rencana Kerja</div>
				<div class="panel-body">
				<form action="<?php echo site_url('parameter/rekening/cari');?>" class="form-horizontal" method="post">
					<div class="form-group">
						<label class="control-label col-md-1">Akun <span class="required">*</span></label>
						<div class="col-md-4">
							<?php combobox('db', $akun, 'aaa_kode', 'akun_kode', 'akun_nama', $akun_, 'show_form_akun_by_kelompok();', 'Pilih Akun', 'class="select2_category form-control" tabindex="1" required="required"'); ?>
						</div>
						<div class="col-md-6">
							<div class="form-group" id="tampil_combobox_akun_by_kelompok">
								<label class="control-label col-md-4" for="deskel_kode">Kelompok</label>
							<div class="col-md-7">
								<?php if ($deskel_ == 'deskel' || $deskel_ == ''){ ?>
									<select class="form-control select2_category" name="deskel_kode" id="deskel_kode">
										<option value="">Semua Kelompok</option>
									</select>
								<?php } else {
									combobox('db', $kelompok, 'bbb_kode', 'kode', 'rekening_kelompok', $kelompok_, '', 'Semua Kelompok', 'class="select2_category form-control" tabindex="1"');
									} ?>
							</div>
							</div>
						</div>
					</div>
					<!--/row-->												
					<div class="form-group">
						<div class="col-md-6">
							<div class="form-group" id="tampil_combobox_kelompok_by_jenis">
								<label class="control-label col-md-4" for="deskel_kode">Jenis</label>
							<div class="col-md-7">
								<?php if ($deskel_ == 'deskel' || $deskel_ == ''){ ?>
									<select class="form-control select2_category" name="deskel_kode" id="deskel_kode">
										<option value="">Semua Jenis</option>
									</select>
								<?php } else {
									combobox('db', $jenis, 'ccc_kode', 'kode', 'rekening_jenis', $jenis_, '', 'Semua Jenis', 'class="select2_category form-control" tabindex="1"');
									} ?>
							</div>
							</div>
						</div>
					</div>
					<!--/row-->											
					<div style="margin-left:900px;">
						<div class="col-md-12">
							<div class="col-md-offset-1 col-md-12">
								<button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Cari</button>
								<a href="<?php echo site_url('parameter/rekening');?>" id="confirmasiHapus" class="btn btn-default"><i class="fa fa-eraser"></i> Clear</a>
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
<?php if ($akun_) { ?>
            
		<div class="panel panel-primary">
			<div class="panel-heading"><i class="fa fa-list"></i> Daftar Usulan Masyarakat</div>
			<div class="panel-body">
						<script>
							var ajax_source_url = '<?php echo site_url($this->uri->segment(1) . '/datatable/' . $this->uri->segment(3) . '/' . $this->uri->segment(4) . '/' . $this->uri->segment(5)); ?>';
							var ajax_source_field = [
										{ "data": "nomor" },
										{ "data": "akun_nama" },
										{ "data": "kelompok_nama" },
										{ "data": "jenis_nama" },
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
		load('parameter/rekening/tampil_combobox_deskel_by_kecamatan/'+kecamatan_kode, '#tampil_combobox_deskel_by_kecamatan');
	}
	
	function show_form_akun_by_kelompok(){
		var aaa_kode = $('select[name=aaa_kode]').val();
		load('parameter/rekening/tampil_combobox_akun_by_kelompok/'+aaa_kode, '#tampil_combobox_akun_by_kelompok');
	}
	
	function show_form_kelompok_by_jenis(){
		var bbb_kode = $('select[name=bbb_kode]').val();
		load('parameter/rekening/tampil_combobox_kelompok_by_jenis/'+bbb_kode, '#tampil_combobox_kelompok_by_jenis');
	}
	
	function show_form_jenis_by_obyek(){
		var ccc_kode = $('select[name=ccc_kode]').val();
		load('parameter/rekening/tampil_combobox_jenis_by_obyek/'+ccc_kode, '#tampil_combobox_jenis_by_obyek');
	}
	
	function show_form_obyek_by_rincian(){
		var ddd_kode = $('select[name=ddd_kode]').val();
		load('parameter/rekening/tampil_combobox_obyek_by_rincian/'+ddd_kode, '#tampil_combobox_obyek_by_rincian');
	}
	</script>