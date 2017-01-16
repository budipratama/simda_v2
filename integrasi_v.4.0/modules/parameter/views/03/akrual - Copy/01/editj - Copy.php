<!-- Main Content -->
<div class="container-fluid">
<div class="side-body padding-top">
	<h3 class="page-title">Parameter <small> rekening akrual</small></h3>		
		<div class="row">
			<div class="col-xs-12">
				<div class="bs-example">
				<ol class="breadcrumb">
					<li class="active"><i class="fa fa-home"></i> <a href="<?php echo site_url('dashboard');?>">Home</a></li>
					<li class="active"><a href="<?php echo site_url('parameter');?>"> Parameter</a></li>
					<li class="active"><a href="<?php echo site_url('parameter/rekening-akrual');?>"> Rekening Akrual</a></li>
					<li class="active"><a href="<?php echo site_url('parameter/rekening-akrual');?>"> Jenis</a></li>
				</ol>
				</div>
			</div>
		</div>	
			<!-- END PAGE HEADER-->
			<div class="clearfix"></div>
			<div class="row">
			<div class="col-md-12">
            <div class="panel panel-primary">
				<div class="panel-heading"><i class="fa fa-bars"></i> Rekening Akrual</div>
				<div class="panel-body">				
				<!-- BEGIN FORM -->	
				<div class="step">
					<ul class="nav nav-tabs nav-justified" role="tablist">
						<li role="step" class="active step-success">
							<a href="#step1" id="step1-tab" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true">
								<div class="icon glyphicon glyphicon-ok-sign" style="font-size:40px;color:white"></div>
									<div class="step-title">
									<div class="title">Jenis</div>
									<div class="description">Rekening Akrual</div>
								</div>
							</a>
						</li>
						<li role="step" >
							<a href="#step2" id="step2-tab" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true">
								<div class="icon glyphicon glyphicon-circle-arrow-right" style="font-size:30px;color:black"></div>
									<div class="step-title">
									<div class="title">Obyek</div>
									<div class="description">Rekening Akrual</div>
								</div>
							</a>
						</li>
						<li role="step">
							<a>
								<div class="icon glyphicon glyphicon-circle-arrow-right" style="font-size:30px;color:black"></div>
									<div class="step-title">
									<div class="title">Rincian Obyek</div>
									<div class="description">Rekening Akrual</div>
								</div>
							</a>
						</li>
					</ul>
					<?php echo validation_errors('<p class="text-error">'); ?>
					<?php echo form_open('parameter/rekening-akrual/editr/'.$this->uri->segment(3).''); ?>
					<div class="tab-content">
						<div role="tabpanel" class="tab-pane fade in active" id="step1" aria-labelledby="home-tab">
							<div class="portlet-body">							
							<table class="table table-striped table-bordered table-hover" width="50%" cellspacing="5" cellpadding="5">
								<tr>
								<th style="text-align:center; width:100px">Akun</th>
								<th style="text-align:center; width:100px">Kelompok</th>
								<th style="text-align:center; width:100px">Jenis</th>
								<th style="text-align:center;">Uraian Rekening Rincian</th>
								<th style="text-align:center; width:120px">Saldo Normal</th>
								</tr>
									<ul>
										<tr>
										<td style="text-align:center;"><?php echo $this_task->akun; ?></td>
										<td style="text-align:center;"><?php echo $this_task->kelompok; ?></a></td>
										<td style="text-align:center;"><input type="text" class="form-control" name="ccc_kode" value="<?php echo $this_task->no; ?>" required="required"></td>
										<td><input type="text" class="form-control" name="ddd_kode" value="<?php echo $this_task->jenis_nama; ?>" required="required"></td>
										<td style="text-align:center;"><input type="text" class="form-control" name="eee_kode" value="<?php echo $this_task->saldo_normal; ?>" required="required"></td>
										</tr>
							</table>												
							<div class="form-group">
								<div class="col-md-offset-9">								
									<button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Simpan</button>
									<a href="#" onClick="history.go(-1); return false;" class="btn btn-default"><i class="fa fa-times"></i> Batal</a>
									<?php echo form_close(); ?>
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