<!-- Main Content -->
<div class="container-fluid">
<div class="side-body padding-top">
	<h3 class="page-title">Parameter <small> rekening</small></h3>		
		<div class="row">
			<div class="col-xs-12">
				<div class="bs-example">
				<ol class="breadcrumb">
					<li class="active"><i class="fa fa-home"></i> <a href="<?php echo site_url('dashboard');?>">Home</a></li>
					<li class="active"><a href="<?php echo site_url('parameter');?>"> Parameter</a></li>
					<li class="active"><a href="<?php echo site_url('parameter/rekening');?>"> Rekening</a></li>
				</ol>
				</div>
			</div>
		</div>
			<div class="col-md-12">
                <div class="portlet" align="right"><a href="<?php echo site_url('parameter/rekening');?>" class="btn btn-default"><i class="fa fa-reply"></i> Kembali</a></div>
			</div>		
			<!-- END PAGE HEADER-->
			<div class="clearfix"></div>
			<?php echo validation_errors(); ?>
			<?php if ($this->session->flashdata('success')) { echo $this->session->flashdata('success');} ?>
			<div class="row">
			<div class="col-md-12">
            <div class="panel panel-success">
				<div class="panel-heading"><i class="fa fa-bars"></i> Rekening</div>
				<div class="panel-body">
				<div class="portlet-body" style="display: block;">
					<a href="<?php echo site_url('parameter/rekening/jenis');?>" class="icon-btn"><i class="fa fa-plus"></i><div>Jenis</div></a>								
					<a href="<?php echo site_url('parameter/rekening/obyek');?>" class="icon-btn"><i class="fa fa-plus"></i><div>Obyek</div></a>                            
					<a href="<?php echo site_url('parameter/rekening/rincian');?>" class="icon-btn"><i class="fa fa-plus"></i><div>Rincian Obyek</div></a>
					</div>							
				</div>
				<div class="panel-body">				
				<!-- BEGIN FORM -->
				<form action="" class="form-horizontal" method="post"><br>
					<div class="form-group">
						<div class="col-md-5">
						<div class="form-group" id="">
							<label class="control-label col-md-2" for="aaa_kode">Akun :</label>
							<div class="col-md-10">
							<?php combobox('db', $akun, 'aaa_kode', 'akun_kode', 'akun_nama', '', 'show_form_akun_by_kelompok();', 'Pilih Akun', 'class="select2_category form-control" tabindex="1" required="required"'); ?>
							</div>
						</div>
						</div>						
						<div class="col-md-7">
						<div class="form-group" id="tampil_combobox_akun_by_kelompok">
							<label class="control-label col-md-3" for="bbb_kode">Kelompok :</label>
							<div class="col-md-8">
							<select class="select2_category form-control" name="bbb_kode" id="bbb_kode" data-placeholder="Pilih Sasaran" required="required"></select>
							</div>
						</div>
						</div>
					</div>
					<!--/row-->
					<div class="form-group">
						<div class="col-md-10">
						<div class="form-group" id="tampil_combobox_kelompok_by_jenis">
							<label class="control-label col-md-3" for="ccc_kode">Jenis :</label>
							<div class="col-md-8">
							<select class="select2_category form-control" name="ccc_kode" id="ccc_kode" data-placeholder="Pilih Sasaran" required="required"></select>
							</div>
						</div>
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-10">
						<div class="form-group" id="tampil_combobox_jenis_by_obyek">
							<label class="control-label col-md-3" for="ddd_kode">Obyek :</label>
							<div class="col-md-8">
							<select class="select2_category form-control" name="ddd_kode" id="ddd_kode" data-placeholder="Pilih Sasaran" required="required"></select>
							</div>
						</div>
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-10">
						<div class="form-group" id="tampil_combobox_obyek_by_rincian">
							<label class="control-label col-md-3" for="eee_kode">Rincian Obyek :</label>
							<div class="col-md-8">
							<select class="select2_category form-control" name="eee_kode" id="eee_kode" data-placeholder="Pilih Sasaran" required="required"></select>
							</div>
						</div>
						</div>
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