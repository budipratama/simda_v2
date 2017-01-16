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
				</ol>
				</div>
			</div>
		</div>
				<div class="col-md-12">
                	<div class="portlet" align="right">
                		<a href="<?php echo site_url('parameter');?>" class="btn btn-default"><i class="fa fa-reply"></i> Kembali</a> 
						<a href="<?php echo site_url('parameter/unit-organisasi/unit');?>" class="btn btn-success"><i class="fa fa-plus"></i> Tambah Unit</a>
						<a href="<?php echo site_url('parameter/unit-organisasi/sub');?>" class="btn btn-success"><i class="fa fa-plus"></i> Tambah Sub Unit</a>					
						<a href="<?php echo site_url('parameter/unit-organisasi/add');?>" class="btn btn-success"><i class="fa fa-plus"></i> Tambah</a>					
                    </div>
                </div>	
			<!-- END PAGE HEADER-->
			<div class="clearfix"></div>
			<?php if ($this->session->flashdata('success')) { echo $this->session->flashdata('success');} ?>
			<div class="row">
			<div class="col-md-12">
            <div class="panel panel-success">
				<div class="panel-heading"><i class="fa fa-bars"></i> Data Unit Organisasi</div>
				<div class="panel-body">
				<!-- BEGIN FORM -->
				<form action="" class="form-horizontal" method="post"><br>
					<div class="form-group">
						<div class="col-md-5">
						<div class="form-group" id="">
							<label class="control-label col-md-2" for="unit_kode">Urusan :</label>
							<div class="col-md-10">
							<?php combobox('db', $misi, 'misi_kode', 'tipe_kode', 'tipe_nama', '', 'show_form_tujuan_by_misi();', 'Pilih Misi', 'class="select2_category form-control" tabindex="1" required="required"'); ?>
							</div>
						</div>
						</div>						
						<div class="col-md-6">
						<div class="form-group" id="tampil_combobox_tujuan_by_misi">
							<label class="control-label col-md-2" for="bidang_kode">Bidang :</label>
							<div class="col-md-10"></div>
						</div>
						</div>
					</div>
					<!--/row-->												
					<div class="form-group">
						<div class="col-md-5">
						<div class="form-group" id="tampil_combobox_sasaran_by_tujuan">
							<label class="control-label col-md-2" for="unit_kode">Unit :</label>
							<div class="col-md-10"></div>
						</div>
						</div>						
						<div class="col-md-6">
						<div class="form-group" id="tampil_combobox_sasaran_by_sasaran">
							<label class="control-label col-md-2" for="sub_kode">Sub Unit :</label>
							<div class="col-md-10"></div>
						</div>
						</div>
					</div>
					<!--/row-->
					
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
	
	function show_form_sub_by_bidang(){
		var tipe_kode = $('select[name=tipe_kode]').val();
		var bbb_kode = $('select[name=bbb_kode]').val();
		load('parameter/unit-organisasi/tampil_combobox_sub_by_bidang/'+tipe_kode+'/'+bbb_kode, '#tampil_combobox_sub_by_bidang');
	}
	
	function show_form_tujuan_by_misi(){
		var misi_kode = $('select[name=misi_kode]').val();
		load('parameter/unit-organisasi/tampil_combobox_tujuan_by_misi/'+misi_kode, '#tampil_combobox_tujuan_by_misi');
	}
	
	function show_form_sasaran_by_tujuan(){
		var tujuan_kode = $('select[name=tujuan_kode]').val();
		load('parameter/unit-organisasi/tampil_combobox_sasaran_by_tujuan/'+tujuan_kode, '#tampil_combobox_sasaran_by_tujuan');
	}
	
	function show_form_sasaran_by_sasaran(){
		var sasaran_kode = $('select[name=sasaran_kode]').val();
		load('parameter/unit-organisasi/tampil_combobox_sasaran_by_sasaran/'+sasaran_kode, '#tampil_combobox_sasaran_by_sasaran');
	}
	</script>