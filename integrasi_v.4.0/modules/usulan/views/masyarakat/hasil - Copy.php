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
			<li><a href="<?php echo site_url('dashboard');?>">Home</a></li>
			<li><a href="<?php echo site_url('usulan/masyarakat/hasil');?>">Hasil Usulan Masyarakat</a></li>
		</ol>
	</div>
	</div>
			
			<h3 class="page-title">
			Hasil <small>Usulan Masyarakat</small>
			</h3>
            <!-- END PAGE HEADER-->
			<!-- BEGIN DASHBOARD STATS -->
			
<!-- BEGIN FORM -->
<div class="row">
	<div class="col-xs-12 col-sm-12">
		<div class="box">
			<div class="box-header">
				<div class="box-name">
					<i class="fa fa-search"></i>
					<span>Pencarian Usulan Masyarakat</span>
				</div>
				<div class="no-move"></div>
			</div>
			<div class="box-content">
				<h4 class="page-header">Informasi Pencarian</h4>
				<!-- BEGIN FORM-->
				<form action="<?php echo site_url('usulan/masyarakat/cari');?>" class="form-horizontal" method="post" role="form">
					<div class="form-group">
						<label class="control-label col-md-2" for="tahun">Tahun <span class="required">*</span></label>
						<div class="col-md-4">
							<!-- combobox('jenis=db,1d,2d', 'array', 'name', 'value', 'value_name', 'selected', 'js', 'label', 'script') -->
							<?php combobox('db', $tahun, 'tahun', 'tahun', 'tahun', $tahun_, '', 'Pilih Tahun Anggaran', 'class="select2_category form-control" title="Pilih Tahun Anggaran" tabindex="1" required="required"'); ?>
						</div>
						<label class="col-sm-2 control-label">SKPD Pelaksana</label>
						<div class="col-sm-4">
							<?php combobox('db', $skpd, 'skpd_kode', 'skpd_kode', 'skpd_nama', $skpd_, '', 'Semua SKPD Pelaksana', 'class="select2_category form-control" tabindex="1"'); ?>
						</div>
					</div>
					<div class="form-group has-success has-feedback">
						<label class="col-sm-2 control-label">Kecamatan</label>
						<div class="col-sm-4">
							<?php combobox('db', $kecamatan, 'kecamatan_kode', 'skpd_kd', 'skpd_nama', $kecamatan_, '', 'Semua Kecamatan', 'class="select2_category form-control" tabindex="1"'); ?>
						</div>
						<label class="col-sm-2 control-label">Desa/Kelurahan</label>
						<div class="col-sm-4">
							<select class="form-control select2_category" name="deskel_kode" id="deskel_kode">
								<option value="">Semua Desa dan Kelurahan</option>
							</select>
						</div>
					</div>
					<div class="form-group has-success has-feedback">
						<label class="col-sm-2 control-label">Nama Kegiatan</label>
						<div class="col-sm-4">
							<input type="text" name="kegiatan" id="kegiatan" value="<?php echo $kegiatan_; ?>" class="form-control" placeholder="Kegiatan...">
						</div>
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
							<a href="<?php echo site_url('usulan/masyarakat/hasil');?>" class="btn btn-default btn-xs">
							<span><i class="fa fa-eraser"></i></span>
								Clear
							</a>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
// Run Select2 plugin on elements
function DemoSelect2(){
	$('#s2_with_tag').select2({placeholder: "Select OS"});
	$('#s2_country').select2();
}
// Run timepicker
function DemoTimePicker(){
	$('#input_time').timepicker({setDate: new Date()});
}
$(document).ready(function() {
	// Create Wysiwig editor for textare
	TinyMCEStart('#wysiwig_simple', null);
	TinyMCEStart('#wysiwig_full', 'extreme');
	// Add slider for change test input length
	FormLayoutExampleInputLength($( ".slider-style" ));
	// Initialize datepicker
	$('#input_date').datepicker({setDate: new Date()});
	// Load Timepicker plugin
	LoadTimePickerScript(DemoTimePicker);
	// Add tooltip to form-controls
	$('.form-control').tooltip();
	LoadSelect2Script(DemoSelect2);
	// Load example of form validation
	LoadBootstrapValidatorScript(DemoFormValidator);
	// Add drag-n-drop feature to boxes
	WinMove();
});
</script>

			
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
						{ "data": "biaya" },
						{ "data": "nama" },
						{ "data": "Actions" }
						];
				</script>
						<div class="portlet-body">
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
							<tbody>
							<!--
							<tr>
								<td>1</td>
								<td>Pengadaan meubelair SDN 02 Karangmekar</td>
								<td>Karangmekar Kecamatan Kedungwaringin</td>
								<td align="right">Rp153.000.000</td>
								<td>Mariani</td>
								<td>
									<a href="<?php echo site_url('usulan/detail/1');?>" class="btn default btn-xs purple">
									<i class="fa fa-file-text"></i> Detail </a>
								</td>
							</tr>
							-->
							</tbody>
							</table>
						</div>
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