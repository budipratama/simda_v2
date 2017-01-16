<!-- Main Content -->
<div class="container-fluid">
<div class="side-body padding-top">
	<h3 class="page-title">Parameter <small> Rekening Sub Rincian Belanja Modal</small></h3>		
		<div class="row">
			<div class="col-xs-12">
				<div class="bs-example">
				<ol class="breadcrumb">
					<li class="active"><i class="fa fa-home"></i> <a href="<?php echo site_url('dashboard');?>">Home</a></li>
					<li class="active"><a href="<?php echo site_url('parameter');?>"> Parameter</a></li>
					<li class="active"><a href="<?php echo site_url('parameter/rekening-sub');?>"> Rekening Sub Rincian Belanja Modal</a></li>
					<li class="active"> Sub Rincian</li>
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
				<div class="panel-heading"><i class="fa fa-bars"></i> Data Sub Rincian</div>
				<div class="panel-body">				
				<!-- BEGIN FORM -->	
				<div class="step">
					<ul class="nav nav-tabs nav-justified" role="tablist">
						<li role="step" ><a><div class="step-title"><div class="title">Obyek</div></div></a></li>
						<li role="step" ><a><div class="step-title"><div class="title">Rincian</div></div></a></li>
						<li role="step" class="active">
							<a href="#step1" id="step1-tab" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true">								
								<div class="step-title"><div class="title">Sub Rincian</div></div>
							</a>
						</li>
					</ul>
					<div class="tab-content">
					<input type="hidden" value="<?php printf( "%01d", $sub->no++); ?>" />
					<form action="<?php echo site_url('parameter/rekening-sub/add/'.$kode->id);?>" class="form-horizontal" method="post" >
						<div role="tabpanel" class="tab-pane fade in active" id="step1" aria-labelledby="home-tab">
							<div class="portlet-body">
							<table class="table table-striped table-bordered table-hover" width="50%" cellspacing="5" cellpadding="5">
								<tr>
								<th style="text-align:center; width:100px">Sub Rincian</th>
								<th style="text-align:center;">Uraian Sub Rincian Belanja Modal</th>
								</tr>
									<ul>
										<tr>
										<input type="hidden" class="form-control" name="aaa_kode" value=<?php echo $rincian->akun; ?> readonly="readonly">
										<input type="hidden" class="form-control" name="bbb_kode" value=<?php echo $rincian->kelompok; ?> readonly="readonly">
										<input type="hidden" class="form-control" name="ccc_kode" value=<?php echo $rincian->jenis; ?> readonly="readonly">
										<input type="hidden" class="form-control" name="ddd_kode" value=<?php echo $rincian->obyek; ?> readonly="readonly">
										<input type="hidden" class="form-control" name="eee_kode" value=<?php echo $rincian->kode; ?> readonly="readonly">
										<td><input type="text" class="form-control" name="ggg_kode" value=<?php printf( "%01d", $sub->no ); ?> placeholder="Kode ..." readonly="readonly"></td>
										<input type="hidden" class="form-control" name="fff_kode" value=<?php printf( "%02d", $sub->no ); ?> placeholder="Kode ..." readonly="readonly"></td>
										<td><input type="text" class="form-control" name="sss_kode" placeholder="Input Sub Rincian ..." required="required"></td>
										</tr>
									</ul>
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