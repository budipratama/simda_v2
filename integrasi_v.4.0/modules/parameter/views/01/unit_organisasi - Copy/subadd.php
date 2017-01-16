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
					<li class="active"><a href="<?php echo site_url('parameter/unit-organisasi/subadd');?>"> Tambah Sub Unit</a></li>
				</ol>
				</div>
			</div>
		</div>
			<!-- END PAGE HEADER-->
			<div class="clearfix"></div>
			<?php if ($this->session->flashdata('success')) { echo $this->session->flashdata('success');} ?>
			<div class="row">
			<div class="col-md-12">
            <div class="panel panel-success">
				<div class="panel-heading"><i class="fa fa-bars"></i> Data Unit Organisasi</div>			
				<!-- BEGIN FORM -->
				<form action="" class="form-horizontal" method="post">				
					<div class="col-md-8">									
										<div class="col-md-3">
											<div class="form-group">
												<label class="control-label" for="aaa_kode">Urusan <span class="required">*</span> :</label>
												<?php combobox('db', $tipe, 'aaa_kode', 'tipe_kode', 'tipe_nama', '', 'show_form_bidang_by_unit();', 'Pilih Tipe', 'class="select2_category form-control" tabindex="1" required="required"'); ?>
											</div>
										</div>
										<div class="col-md-12">
											<div class="form-group" id="tampil_combobox_bidang_by_unit">
												<label class="control-label" for="bbb_kode">Bidang <span class="required">*</span> :</label>
												<?php combobox('db', $urusan, 'bbb_kode', 'kode', 'urusan', '', '', 'Pilih Bidang', 'class="select2_category form-control" tabindex="1" required="required"'); ?>
											</div>
										</div>
										<div class="col-md-12">
											<div class="form-group" id="tampil_combobox_unit_by_bidang">
												<label class="control-label" for="ccc_kode">Unit <span class="required">*</span> :</label>
												<?php combobox('db', $unit, 'ccc_kode', 'kode', 'bidang_unit', '', '', 'Pilih Unit', 'class="select2_category form-control" tabindex="1" required="required"'); ?>
											</div>
										</div>
										<div class="col-md-12">
											<div class="form-group">
												<label class="control-label" for="ddd_kode">Sub <span class="required">*</span> :</label>
												<input type="text" class="form-control" name="ddd_kode" id="ddd_kode" placeholder="" required="required">
											</div>
										</div>
					</div>
										<div class="form-group">
											<div class="col-md-offset-8 col-md-8">
												<button type="submit" class="btn green"><i class="fa fa-check"></i> Simpan Data</button>
												<a href="<?php echo site_url('parameter/unit-organisasi/');?>" class="btn default"><i class="fa fa-times"></i> Batal</a>
											</div>
										</div>
				</form>
				<!-- END FORM-->
				
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
		var bidang_kode = $('select[name=bidang_kode]').val();
		load('parameter/unit-organisasi/tampil_combobox_unit_by_bidang/'+tipe_kode+'/'+bidang_kode, '#tampil_combobox_unit_by_bidang');
	}
	</script>