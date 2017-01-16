<!-- Main Content -->
<div class="container-fluid">
<div class="side-body padding-top">
	<!-- END PAGE HEADER-->
		<div class="row">
		<div class="col-md-12">
           <div class="panel panel-primary">
			<!-- BEGIN FORM -->
			<div class="portlet-body form">
				<div class="form-body">
					<div class="row">
						<div class="col-md-12">
							<div style="display:block;"><iframe frameborder="0" width="100%" height="600" name="form_laporan" src="<?php echo site_url('rka/murni/hasil');?>"></iframe></div>
						</div>
					</div>
				</div>
				<div class="form-actions">
					<center>
						<a href="<?php echo site_url('rka/murni/hasil/pdf');?>" class="btn btn-danger"><i class="fa fa-file-pdf-o"></i> Download PDF</a>
						<!--<a href="<?php echo site_url('rka/murni/sub/'.$kode);?>" class="btn default"><i class="fa fa-reply"></i> Kembali</a>-->
						<a href="#" onClick="history.go(-1); return false;" class="btn default"><i class="fa fa-reply"></i> Kembali</a>
					</center>	
				</div>
			</div>	
			<!-- END FORM-->
		</div>
		</div>
		</div>
	<!-- END SAMPLE TABLE PORTLET-->
</div>
<!-- END CONTENT -->