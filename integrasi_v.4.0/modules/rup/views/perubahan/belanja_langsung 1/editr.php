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
						<li class="active">edit Rincian Belanja</li>
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
				<div class="step">
					<ul class="nav nav-tabs nav-justified" role="tablist">
						<li role="step" ><a><div class="step-title"><div class="title">Belanja</div></div></a></li>
						<li role="step" class="active"><a><div class="step-title"><div class="title">Rincian Belanja</div></div></a></li>
						<li role="step" ><a><div class="step-title"><div class="title">Sub Rincian Belanja</div></div></a></li>
						<li role="step" ><a><div class="step-title"><div class="title">History</div></div></a></li>
					</ul>
					<div class="tab-content">
					<form action="<?php echo site_url('rka/murni/editr/'.$kode);?>" class="form-horizontal" method="post"><br>
					<input type="hidden" name="kode" value="<?php echo $kode; ?>"/>					
						<div role="tabpanel" class="tab-pane fade in active" id="step1" aria-labelledby="home-tab">
							<div class="portlet-body">
							<table class="table table-striped table-bordered table-hover" width="50%" cellspacing="5" cellpadding="5">
								<tr>
								<th style="text-align:center; width:100px">No</th>
								<th style="text-align:center;">Uraian</th>
								</tr>
									<ul>
										<tr>
										<td><input type="text" class="form-control" name="no_kode" value="<?php echo $no; ?>" readonly="readonly"></td>
										<td><input type="text" class="form-control" name="aaa_kode" value="<?php echo $uraian; ?>" placeholder="Enter text here ..." required="required"></td>
										</tr>
									</ul>
							</table>
							<div class="form-group">
								<div class="col-md-offset-9">
									<button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Simpan</button>
									<a href="<?php echo base_url(); ?>rka/murni/rincian/<?php echo $rka;?>" class="btn btn-default"><i class="fa fa-times"></i> Batal</a>
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