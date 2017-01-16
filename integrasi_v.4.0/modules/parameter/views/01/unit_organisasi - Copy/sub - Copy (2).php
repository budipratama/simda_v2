<!-- Main Content -->
<div class="container-fluid">
<div class="side-body padding-top">
	<h3 class="page-title">Parameter <small> unit organisasi</small></h3>		
		<div class="row">
			<div class="col-xs-12">
				<div class="bs-example">
				<ol class="breadcrumb">
					<li class="active"><i class="fa fa-home"></i> <a href="<?php echo site_url('dashboard');?>">Home</a></li>
					<li class="active"><a href="<?php echo site_url('parameter');?>"> Parameter</a></li>
					<li class="active"><a href="<?php echo site_url('parameter/unit-organisasi');?>"> Unit Organisasi</a></li>
					<li class="active"><a href="<?php echo site_url('parameter/unit-organisasi/sub');?>"> Tambah Sub Unit</a></li>
				</ol>
				</div>
			</div>
		</div>
			<!-- END PAGE HEADER-->
			<div class="clearfix"></div>
			<?php echo validation_errors(); ?>
			<?php if ($this->session->flashdata('success')) { echo $this->session->flashdata('success');} ?>
			<div class="row">
			<div class="col-md-12">
            <div class="panel panel-success">
				<div class="panel-heading"><i class="fa fa-bars"></i> Tambah Sub Unit</div>	
				<div class="panel-body">				
				<!-- BEGIN FORM -->
				<form action="<?php echo site_url('parameter/unit-organisasi/addsub');?>" class="form-horizontal" method="post"><br>
					<div class="form-group">
						<div class="col-md-5">
						<div class="form-group" id="">
							<label class="control-label col-md-2" for="unit_kode">Urusan :</label>
							<div class="col-md-10">
							<?php combobox('db', $bidang_tipe, 'tipe_kode', 'tipe_kode', 'tipe_nama', '', 'show_form_bidang_by_unit();', 'Pilih Urusan', 'class="select2_category form-control" tabindex="1" required="required"'); ?>	
							</div>
						</div>
						</div>						
						<div class="col-md-6">
						<div class="form-group" id="tampil_combobox_bidang_by_unit">
							<label class="control-label col-md-2" for="bbb_kode">Bidang :</label>
							<div class="col-md-10">
							<select class="select2_category form-control" name="bbb_kode" id="bbb_kode" data-placeholder="Pilih Sasaran" required="required"></select>
							</div>
						</div>
						</div>
					</div>
					<!--/row-->												
					<div class="form-group">
						<div class="col-md-5">
						<div class="form-group" id="tampil_combobox_unit_by_bidang">
							<label class="control-label col-md-2" for="ccc_kode">Unit :</label>
							<div class="col-md-10">
							<select class="select2_category form-control" name="ccc_kode" id="ccc_kode" data-placeholder="Pilih Sasaran" required="required"></select>
							</div>
						</div>
						</div>
						<div class="col-md-6">
						<div class="form-group" id="tampil_combobox_sub_by_bidang">
							<label class="control-label col-md-2" for="ddd_kode">Sub Unit :</label>
							<div class="col-md-10">
							<input type="text" class="form-control" name="ddd_kode" id="ddd_kode" placeholder="Masukan Sub Unit ...." required="required">
							</div>
						</div>
						</div>
					</div>
					<!--/row-->
					<div class="form-group">
						<div class="col-md-offset-8 col-md-8">
						<button type="submit" class="btn green"><i class="fa fa-check"></i> Simpan Data 11</button>
						
							<button type="submit" class="btn green"><i class="fa fa-check"></i> Simpan Data</button>
							<a href="<?php echo site_url('parameter/unit-organisasi/');?>" class="btn default"><i class="fa fa-times"></i> Batal</a>
						</div>
					</div>
				</form>
				<!-- END FORM-->
				</div>
			</div>
			</div>
			</div>

			<!-- END SAMPLE TABLE PORTLET-->
</div>
<!-- END CONTENT -->	
	<script>	
		function show_form_bidang_by_unit(){
		var tipe_kode = $('select[name=tipe_kode]').val();
		load('parameter/unit-organisasi/tampil_combobox_bidang_by_unit/'+tipe_kode, '#tampil_combobox_bidang_by_unit');
	}
	
	function show_form_unit_by_bidang(){
		var tipe_kode = $('select[name=tipe_kode]').val();
		var bbb_kode = $('select[name=bbb_kode]').val();
		load('parameter/unit-organisasi/tampil_combobox_unit_by_bidang/'+tipe_kode+'/'+bbb_kode, '#tampil_combobox_unit_by_bidang');
	}
	</script>