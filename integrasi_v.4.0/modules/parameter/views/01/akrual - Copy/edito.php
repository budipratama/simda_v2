<!-- Main Content -->
<div class="container-fluid">
<div class="side-body padding-top">
	<h3 class="page-title">Parameter <small> Rekening Akrual</small></h3>		
		<div class="row">
			<div class="col-xs-12">
				<div class="bs-example">
				<ol class="breadcrumb">
					<li class="active"><i class="fa fa-home"></i> <a href="<?php echo site_url('dashboard');?>">Home</a></li>
					<li class="active"><a href="<?php echo site_url('parameter');?>"> Parameter</a></li>
					<li class="active"><a href="<?php echo site_url('parameter/akrual');?>"> Rekening Akrual</a></li>
					<li class="active"> Obyek</li>
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
				<div class="panel-heading"><i class="fa fa-bars"></i> Data Obyek</div>
				<div class="panel-body">				
				<!-- BEGIN FORM -->	
				<div class="step">
					<ul class="nav nav-tabs nav-justified" role="tablist">
					<li role="step" ><a><div class="step-title"><div class="title">Akun</div></div></a></li>
					<li role="step" ><a><div class="step-title"><div class="title">Kelompok</div></div></a></li>
						<li role="step" ><a><div class="step-title"><div class="title">Jenis</div></div></a></li>
						<li role="step" class="active">
							<a href="#step1" id="step1-tab" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true">								
								<div class="step-title"><div class="title">Obyek</div></div>
							</a>
						</li>
						<li role="step" ><a><div class="step-title"><div class="title">Rincian</div></div></a></li>
					</ul>
					<div class="tab-content">
					<form action="<?php echo site_url('parameter/akrual/edito/'.$this_task->kode);?>" class="form-horizontal" method="post"><br>
						<input type="hidden" name="kode" value="<?php echo $this_task->kode; ?>"/>
						<div role="tabpanel" class="tab-pane fade in active" id="step1" aria-labelledby="home-tab">
							<div class="portlet-body">							
							<table class="table table-striped table-bordered table-hover" width="50%" cellspacing="5" cellpadding="5">
								<tr>
								<th style="text-align:center; width:100px">Obyek</th>
								<th style="text-align:center;">Uraian Rekening Obyek</th>
								</tr>
									<ul>
										<tr>
										<td style="text-align:center;"><input type="text" class="form-control" name="ccc_kode" value="<?php echo $this_task->no; ?>" readonly="readonly"></td>
										<td><input type="text" class="form-control" name="ddd_kode" value="<?php echo $this_task->obyek_nama; ?>" required="required"></td>
										</tr>
							</table>												
							<div class="form-group">
								<div class="col-md-offset-9">								
									<button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Simpan</button>
									<a href="#" onClick="history.go(-1); return false;" class="btn btn-default"><i class="fa fa-times"></i> Batal</a>
								</div>
							</div>							
							</div>
						</div>
					<div role="tabpanel" class="tab-pane fade" id="step2" aria-labelledby="profile-tab">
						<p>??</p> 
					</div>
					<div role="tabpanel" class="tab-pane fade" id="step3" aria-labelledby="dropdown1-tab">
						<p>??</p>
					</div>
					</form>
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