<!-- Main Content -->
<div class="container-fluid">
<div class="side-body padding-top">
	<h3 class="page-title">Parameter <small> Tim Anggaran</small></h3>		
		<div class="row">
			<div class="col-xs-12">
				<div class="bs-example">
				<ol class="breadcrumb">
					<li class="active"><i class="fa fa-home"></i> <a href="<?php echo site_url('dashboard');?>">Home</a></li>
					<li class="active"><a href="<?php echo site_url('parameter');?>"> Parameter</a></li>
					<li class="active"><a href="<?php echo site_url('parameter/tim-anggaran');?>"> Tim Anggaran</a></li>
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
				<div class="panel-heading"><i class="fa fa-bars"></i> Data Tim Anggaran</div>	
				<div class="panel-body">				
				<!-- BEGIN FORM -->
				<form action="<?php echo site_url('parameter/tim-anggaran/edit/'.$kode);?>" class="form-horizontal" method="post"><br>	
				<input type="hidden" name="kode" value="<?php echo $kode; ?>" />	
					<div class="form-group">
						<div class="col-md-10">
						<div class="form-group">
							<label class="control-label col-md-3" for="aaa_kode">Kode Tim <span class="required">*</span> :</label>
							<div class="col-md-1">
							<input type="text" class="form-control" name="aaa_kode" id="aaa_kode" maxlength="1" onkeypress="return isNumberKey(event)" value="<?php echo $aaa_kode;?>" required="required">
							</div>
							<label>1: TIM ANGGARAN, 2: DITELITI OLEH, 3: TIM ASISTENSI</label>							
						</div>
						</div>
					</div>
					<!--/row-->
					<div class="form-group">
						<div class="col-md-10">
						<div class="form-group">
							<label class="control-label col-md-3" for="bbb_kode">No. Urut :</label>
							<div class="col-md-1">
							<input type="text" class="form-control" name="bbb_kode" id="bbb_kode" value="<?php echo $bbb_kode;?>" readonly="readonly">
							</div>
						</div>
						</div>
					</div>	
					<div class="form-group">
						<div class="col-md-10">
						<div class="form-group">
							<label class="control-label col-md-3" for="ccc_kode">Nama <span class="required">*</span> :</label>
							<div class="col-md-7">
							<input type="text" class="form-control" name="ccc_kode" id="ccc_kode" value="<?php echo $ccc_kode;?>" required="required">
							</div>
						</div>
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-10">
						<div class="form-group">
							<label class="control-label col-md-3" for="ddd_kode">NIP <span class="required">*</span> :</label>
							<div class="col-md-3">
							<input type="text" class="form-control" name="ddd_kode" id="ddd_kode" maxlength="18" onkeypress="return isNumber(event)" value="<?php echo $ddd_kode;?>" required="required">
							</div>
						</div>
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-10">
						<div class="form-group">
							<label class="control-label col-md-3" for="eee_kode">Jabatan <span class="required">*</span> :</label>
							<div class="col-md-7">
							<input type="text" class="form-control" name="eee_kode" id="eee_kode" value="<?php echo $eee_kode;?>" required="required">
							</div>
						</div>
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-offset-9">
							<button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Simpan</button>
							<a href="<?php echo site_url('parameter/tim-anggaran');?>" class="btn default"><i class="fa fa-reply"></i> Kembali</a>
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