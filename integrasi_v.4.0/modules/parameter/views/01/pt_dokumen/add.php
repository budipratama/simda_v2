<!-- Main Content -->
<div class="container-fluid">
<div class="side-body padding-top">
	<h3 class="page-title">Parameter <small> Penanda Tanggan Dokumen</small></h3>		
		<div class="row">
			<div class="col-xs-12">
				<div class="bs-example">
				<ol class="breadcrumb">
					<li class="active"><i class="fa fa-home"></i> <a href="<?php echo site_url('dashboard');?>">Home</a></li>
					<li class="active"><a href="<?php echo site_url('parameter');?>">Parameter</a></li>
					<li class="active"><a href="<?php echo site_url('parameter/pt-dokumen');?>">Penanda Tanggan Dokumen</a></li>
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
				<div class="panel-heading"><i class="fa fa-bars"></i> Data Penanda Tanggan Dokumen</div>	
				<div class="panel-body">				
				<!-- BEGIN FORM -->				
				<form action="<?php echo site_url('parameter/pt-dokumen/add');?>" class="form-horizontal" method="post"><br>
				<input type="hidden" value="<?php printf( "%01d", $doc->no++ ); ?>" />
				<input type="text" value="<?php echo $doc->kode; ?>"><br>
				<input type="text" name="id_skpd" value="<?php echo $skpd->id_kode; ?>"><br>
				<input type="text" value="4"><br>
					<div class="form-group">
						<div class="col-md-10">
						<div class="form-group">
							<label class="control-label col-md-3" for="aaa_kode">No. Urut :</label>
							<div class="col-md-1">
							<input type="text" class="form-control" name="aaa_kode" id="bbb_kode" value="<?php printf( "%01d", $doc->no++ ); ?>" readonly="readonly">
							</div>
						</div>
						</div>
					</div>	
					<div class="form-group">
						<div class="col-md-10">
						<div class="form-group">
							<label class="control-label col-md-3" for="bbb_kode">Nama <span class="required">*</span> :</label>
							<div class="col-md-7">
							<input type="text" class="form-control" name="bbb_kode" id="ccc_kode" required="required">
							</div>
						</div>
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-10">
						<div class="form-group">
							<label class="control-label col-md-3" for="ccc_kode">NIP <span class="required">*</span> :</label>
							<div class="col-md-3">
							<input type="text" class="form-control" name="ccc_kode" id="ddd_kode" required="required">
							</div>
						</div>
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-10">
						<div class="form-group">
							<label class="control-label col-md-3" for="ddd_kode">Jabatan <span class="required">*</span> :</label>
							<div class="col-md-7">
							<input type="text" class="form-control" name="ddd_kode" id="eee_kode" required="required">
							</div>
						</div>
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-10">
						<div class="form-group">
							<label class="control-label col-md-3" for="ddd_kode">Dokumen <span class="required">*</span> :</label>
							<div class="col-md-7">

							</div>
						</div>
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-offset-9">
							<!--<button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Simpan</button>-->
							<a href="<?php echo site_url('parameter/pt-dokumen/tim/'.$doc->skpd);?>" class="btn btn-default"><i class="fa fa-times"></i> Batal</a>
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
		function isNumberKey(evt) {
		  var charCode = (evt.which) ? evt.which : event.keyCode
		   if (charCode > 31 && (charCode < 48 || charCode > 57))
 
		    return false;
		  return true;
		}
	</script>