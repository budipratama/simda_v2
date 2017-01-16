<!-- Main Content -->
<div class="container-fluid">
	<div class="side-body padding-top">
	<h3 class="page-title">Detail RKA SKPD <small> Belanja Langsung</small></h3>				
		<div class="row">
			<div class="col-xs-12">
				<div class="bs-example">
					<ol class="breadcrumb">
						<li class="active"><i class="fa fa-home"></i> <a href="<?php echo site_url('dashboard');?>">Home</a></li>
						<li class="active"><a href="<?php echo site_url('rka/murni');?>">RKA</a></li>
						<li class="active">Belanja Langsung</li>
						<li class="active">View</li>
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
            <div class="panel panel-primary">
				<div class="panel-heading"><i class="fa fa-bars"></i> Data Kode Rekening</div>
				<div class="panel-body">
				<!-- BEGIN FORM -->
				<form action="<?php echo site_url('rka/murni/preview/'.$kode);?>" class="horizontal-form" method="post">
					<div class="form-body">
					<div class="row">
						<div class="col-md-3">
							<div class="form-group">
							<label class="control-label" for="tanggal">Tanggal Laporan <span class="required">*</span> :</label>
								<div class="input-group input-medium date date-picker" data-date-format="yyyy-mm-dd">
								<input type="text" class="form-control" name="tanggal" id="tanggal" value="<?php echo date("Y-m-d");?>" readonly>
								<span class="input-group-btn"><button class="btn default" type="button"><i class="fa fa-calendar"></i></button></span>
								</div>
							</div>
						</div>
							<div class="col-md-3">
								<div class="form-group">
									<label class="control-label" for="tahun">Tahun Anggaran :</label>
									<input type="text" class="form-control" name="tahun" id="tahun" value="<?php echo $tahun_;?>" readonly>
								</div>
							</div>									
							<div class="col-md-3">
								<div class="form-group">
									<label class="control-label" for="anggaran_kode">Anggaran Belanja Langsung :</label>
									<input type="text" class="form-control" name="anggaran_kode" id="anggaran_kode" value="<?php echo $rka_;?>" readonly>
								</div>
							</div>
							
							<div class="col-md-3">
								<div class="form-group">
									<label class="control-label" for="skpd">SKPD :</label>
									<input type="text" class="form-control" name="skpd" id="skpd" value="<?php echo $skpd_;?>" readonly>
								</div>
							</div>
									
							<div class="col-md-3">
								<div class="form-group">
									<label class="control-label" for="kecamatan">Kecamatan <span class="required">*</span> :</label>
									<?php combobox('db', $kecamatan, 'kecamatan', 'skpd_nama', 'skpd_nama', $kecamatan_, 'show_form_deskel_by_kecamatan();', 'Pilih Kecamatan', 'class="select2_category form-control" tabindex="1" required="required"'); ?>
								</div>
							</div>
					</div>
					</div>
						<div class="form-group">
						<div class="col-md-offset-9">
							<button type="submit" name="cetak" class="btn btn-success" title="View"><i class="fa fa-check"></i> Lihat Rekap</button>
							<a href="<?php echo base_url(); ?>rka/murni/sub/<?php echo $kode; ?>" class="btn btn-default"><i class="fa fa-reply"></i> Kembali</a>
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
	function show_form_deskel_by_kecamatan(){
		var kecamatan_kode = $('select[name=kecamatan_kode]').val();
		load('rka/murni/tampil_combobox_deskel_by_kecamatan2/'+kecamatan_kode, '#tampil_combobox_deskel_by_kecamatan');
	}
</script>