<!-- Main Content -->
<div class="container-fluid">
	<div class="side-body padding-top">
		<h3 class="page-title">Ubah Hasil Pra Rencana Kerja <small>anggaran belanja langsung</small></h3>
		<div class="row">
			<div class="col-xs-12">
				<div class="bs-example">
					<ol class="breadcrumb">
						<li class="active"><i class="fa fa-home"></i> <a href="<?php echo site_url('dashboard');?>">Home</a></li>
						<li class="active"><a href="<?php echo site_url('rencana-kerja/murni');?>">Pra Rencana Kerja</a></li>
						<li class="active"><a href="#"> Ubah</a></li>
					</ol>
				</div>
			</div>
		</div>		
<!-- END PAGE HEADER-->
			<?php echo validation_errors(); ?>
			<!-- BEGIN FORM -->
			<div class="panel panel-success">
				<div class="panel-heading"><i class="fa fa-pencil-square-o"></i> Ubah Rencana Kerja</div>
					<div class="panel-body">
						<!-- BEGIN FORM-->
							<form action="" class="horizontal-form" enctype="multipart/form-data" method="post"><br><br><br><br>
								<div class="form-actions"><center><a href="#" onClick="history.go(-1); return false;" class="btn btn-warning"><i class="fa fa-reply"></i> Kembali</a></div><br><br><br><br>
							</form>
						<!-- END FORM-->
					</div>
			</div>
		<!-- END SAMPLE TABLE PORTLET-->     
	</div>	
</div>
<!-- END CONTENT -->