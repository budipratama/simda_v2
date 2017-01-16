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
				<div class="portlet-body form">
					<div class="form-body">
						<div class="row">
							<div class="col-md-12">
								<div style="display:block;"><iframe frameborder="0" width="100%" height="600" name="form_laporan" src="<?php echo site_url('rka/murni/hasil');?>"></iframe></div>
							</div>
						</div>
					</div>						
					<div class="form-actions">
						<div class="row">
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-offset-4">
									<!--<button type="submit" class="btn btn-info" onclick="javascript:parent.form_laporan.print()"><i class="fa fa-print"></i> Print</button>-->
										<a href="<?php echo site_url('rka/murni/hasil/excel');?>" class="btn btn-success"><i class="fa fa-file-excel-o"></i> Download Excel</a>
										<a href="<?php echo site_url('rka/murni/hasil2');?>" class="btn btn-danger"><i class="fa fa-file-pdf-o"></i> Download PDF</a>
										<a href="#" onClick="history.go(-1); return false;" class="btn default"><i class="fa fa-reply"></i> Kembali</a>
									</div>
								</div>
							</div>
							<div class="col-md-6"></div>
						</div>
					</div>
				</div>	
				<!-- END FORM-->
				</div>
			</div>
			</div>
			</div>
			<!-- END SAMPLE TABLE PORTLET-->
</div>
<!-- END CONTENT -->