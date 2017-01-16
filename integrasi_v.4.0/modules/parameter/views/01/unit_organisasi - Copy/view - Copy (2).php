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
							<?php combobox('db', $bidang_tipe, 'tipe_kode', 'tipe_kode', 'tipe_nama', '', 'show_form_misi_by_skpd();', 'Pilih Urusan', 'class="select2_category form-control" tabindex="1" required="required"'); ?>	
							</div>
						</div>
						</div>						
						<div class="col-md-6">
						<div class="form-group" id="tampil_combobox_misi_by_skpd">
							<label class="control-label col-md-2" for="bidang_kode">Bidang :</label>
							<div class="col-md-10">
							<select class="select2_category form-control" name="bidang_kode" id="bidang_kode" data-placeholder="Pilih Sasaran Daerah" tabindex="1" required="required"></select>
							</div>
						</div>
						</div>
					</div>
					<!--/row-->												
					<div class="form-group">
						<div class="col-md-5">
						<div class="form-group" id="tampil_combobox_tujuan_by_misi">
							<label class="control-label col-md-2" for="bidang_unit_kode">Unit :</label>
							<select class="select2_category form-control" name="bidang_unit_kode" id="bidang_unit_kode" data-placeholder="Pilih Sasaran Daerah" tabindex="1" required="required">
							</select>
						</div>
						</div>						
						<div class="col-md-6">
						<div class="form-group" id="tampil_combobox_sasaran_by_tujuan">
							<label class="control-label col-md-2" for="bidang_sub_kode">Sub Unit :</label>
							<select class="select2_category form-control" name="bidang_sub_kode" id="bidang_sub_kode" data-placeholder="Pilih Sasaran Daerah" tabindex="1" required="required">
							</select>
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
	function show_form_misi_by_skpd(){
		var tipe_kode = $('select[name=tipe_kode]').val();
		load('parameter/unit-organisasi/tampil_combobox_misi_by_skpd/'+tipe_kode, '#tampil_combobox_misi_by_skpd');
		load('parameter/unit-organisasi/tampil_combobox_tujuan_by_misi/', '#tampil_combobox_tujuan_by_misi');
		load('parameter/unit-organisasi/tampil_combobox_sasaran_by_tujuan/', '#tampil_combobox_sasaran_by_tujuan');
		load('parameter/unit-organisasi/tampil_combobox_indikator_by_sasaran/', '#tampil_combobox_indikator_by_sasaran');
		load('parameter/unit-organisasi/tampil_combobox_urusan_by_indikator/', '#tampil_combobox_urusan_by_indikator');
		load('parameter/unit-organisasi/tampil_combobox_program_by_urusan/', '#tampil_combobox_program_by_urusan');
	}
	
	function show_form_tujuan_by_misi(){
		var tipe_kode = $('select[name=tipe_kode]').val();
		var bidang_kode = $('select[name=bidang_kode]').val();
		load('parameter/unit-organisasi/tampil_combobox_tujuan_by_misi/'+tipe_kode+'/'+bidang_kode, '#tampil_combobox_tujuan_by_misi');
		load('parameter/unit-organisasi/tampil_combobox_sasaran_by_tujuan/', '#tampil_combobox_sasaran_by_tujuan');
		load('parameter/unit-organisasi/tampil_combobox_indikator_by_sasaran/', '#tampil_combobox_indikator_by_sasaran');
		load('parameter/unit-organisasi/tampil_combobox_urusan_by_indikator/', '#tampil_combobox_urusan_by_indikator');
		load('parameter/unit-organisasi/tampil_combobox_program_by_urusan/', '#tampil_combobox_program_by_urusan');
	}
	
	function show_form_sasaran_by_tujuan(){
		var tipe_kode = $('select[name=tipe_kode]').val();
		var bidang_unit_kode = $('select[name=bidang_unit_kode]').val();
		load('parameter/unit-organisasi/tampil_combobox_sasaran_by_tujuan/'+tipe_kode+'/'+bidang_unit_kode, '#tampil_combobox_sasaran_by_tujuan');
		load('parameter/unit-organisasi/tampil_combobox_indikator_by_sasaran/', '#tampil_combobox_indikator_by_sasaran');
		load('parameter/unit-organisasi/tampil_combobox_urusan_by_indikator/', '#tampil_combobox_urusan_by_indikator');
		load('parameter/unit-organisasi/tampil_combobox_program_by_urusan/', '#tampil_combobox_program_by_urusan');
	}
	
	function show_form_indikator_by_sasaran(){
		var tipe_kode = $('select[name=tipe_kode]').val();
		var bidang_unit_kode = $('select[name=bidang_unit_kode]').val();
		var bidang_sub_kode = $('select[name=bidang_sub_kode]').val();
		load('parameter/unit-organisasi/tampil_combobox_indikator_by_sasaran/'+tipe_kode+'/'+bidang_unit_kode+'/'+bidang_sub_kode, '#tampil_combobox_indikator_by_sasaran');
		load('parameter/unit-organisasi/tampil_combobox_urusan_by_indikator/', '#tampil_combobox_urusan_by_indikator');
		load('parameter/unit-organisasi/tampil_combobox_program_by_urusan/', '#tampil_combobox_program_by_urusan');
	}
	</script>