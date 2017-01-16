<!-- Main Content -->
<div class="container-fluid">
<div class="side-body padding-top">
	<h3 class="page-title">Parameter <small> Rekening Sub Rincian Belanja Modal</small></h3>		
		<div class="row">
			<div class="col-xs-12">
				<div class="bs-example">
				<ol class="breadcrumb">
					<li class="active"><i class="fa fa-home"></i> <a href="<?php echo site_url('dashboard');?>">Home</a></li>
					<li class="active"><a href="<?php echo site_url('parameter');?>"> Parameter</a></li>
					<li class="active"><a href="<?php echo site_url('parameter/rekening-sub');?>"> Rekening Sub Rincian Belanja Modal</a></li>					
					<li class="active"><a href="<?php echo site_url('parameter/rekening-sub/add');?>"> Tambah</a></li>
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
            <div class="panel panel-info">
				<div class="panel-heading"><i class="fa fa-bars"></i> Rekening Sub</div>	
				<div class="panel-body">				
				<!-- BEGIN FORM -->
				<form action="<?php echo site_url('parameter/rekening-sub/insert');?>" class="form-horizontal" method="post"><br>
					<div class="form-group">
						<div class="col-md-5">
						<div class="form-group">
							<label class="control-label col-md-2" for="aaa_kode">Akun<span class="required">*</span> :</label>
							<div class="col-md-10">
							<?php combobox('db', $akun, 'aaa_kode', 'kode', 'akun_nama', $akun_, '', 'Pilih Akun', 'class="select2_category form-control" tabindex="1" required="required" disabled'); ?>
							</div>
						</div>
						</div>						
						<div class="col-md-7">
						<div class="form-group">
							<label class="control-label col-md-3" for="bbb_kode">Kelompok :</label>
							<div class="col-md-8">
							<?php combobox('db', $kelompok, 'bbb_kode', 'kode', 'kelompok_nama', $kelompok_, '', 'Pilih Kelompok', 'class="select2_category form-control" tabindex="1" required="required" disabled'); ?>
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
							<?php combobox('db', $jenis, 'ccc_kode', 'kode', 'jenis_nama', $jenis_, '', 'Pilih Jenis', 'class="select2_category form-control" tabindex="1" required="required" disabled'); ?>
							</div>
						</div>
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-10">
						<div class="form-group" id="tampil_combobox_kelompok_by_jenis">
							<label class="control-label col-md-3" for="ddd_kode">Obyek :</label>
							<div class="col-md-8">
							<?php combobox('db', $obyek, 'ddd_kode', 'kode', 'obyek_nama', '', '', 'Pilih Obyek', 'class="select2_category form-control" tabindex="1" required="required"'); ?>
							</div>
						</div>
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-10">
						<div class="form-group" id="tampil_combobox_kelompok_by_jenis">
							<label class="control-label col-md-3" for="eee_kode">Rincian :</label>
							<div class="col-md-8">
							<?php combobox('db', $rincian, 'eee_kode', 'kode', 'rincian_nama', '', '', 'Pilih Rincian', 'class="select2_category form-control" tabindex="1" required="required"'); ?>
							</div>
						</div>
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-10">
						<div class="form-group">
							<label class="control-label col-md-3" for="sub_rincian">Sub Rincian :</label>
							<div class="col-md-8">
							<input type="text" class="form-control" name="sub_rincian" id="sub_rincian" placeholder="Input Sub Rincian ..." required="required">
							</div>
						</div>
						</div>
					</div>					
					<div class="form-group">
						<div class="col-md-offset-9">
							<button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Simpan</button>
							<a href="<?php echo site_url('parameter/rekening-sub');?>" class="btn default"><i class="fa fa-reply"></i> Kembali</a>
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