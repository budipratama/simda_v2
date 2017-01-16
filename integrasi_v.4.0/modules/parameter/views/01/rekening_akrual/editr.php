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
								<th style="text-align:center; width:100px">Obyek</th>
								<th style="text-align:center; width:100px">Rincian</th>
								<th style="text-align:center;">Uraian Rekening Rincian</th>
								<th style="text-align:center; width:100px">Peraturan</th>
								</tr>
									<ul>
										<tr>
										<td style="text-align:center;"><?php echo $akun->no; ?></td>
										<td style="text-align:center;"><?php echo $kelompok->no; ?></a></td>
										<td style="text-align:center;"><?php echo $jenis->no; ?></a></td>
										<td style="text-align:center;"><?php echo $obyek->no; ?></a></td>
										<td style="text-align:center;"><?php echo $rincian->no; ?></a></td>
										<td><input type="text" class="form-control" name="rincian_nama" value="<?php echo $this_task->rincian_nama; ?>" required="required"></td>
										<td><input type="text" class="form-control" name="peraturan" value="<?php echo $this_task->peraturan; ?>" required="required"></td>
										</tr>
							</table>												
							<div class="form-group">
								<div class="col-md-offset-9">
								<!--Submit Buttons-->
<?php $data = array("value" => "Update Task",
                    "name" => "submit",
                    "class" => "btn btn-primary"); ?>
<p>
    <?php echo form_submit($data); ?>
</p>
<?php echo form_close(); ?>

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