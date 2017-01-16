<!-- Main Content -->
<div class="container-fluid">
	<div class="side-body padding-top">
	<h3 class="page-title">Detail RKA <small> belanja langsung</small></h3>				
		<div class="row">
			<div class="col-xs-12">
				<div class="bs-example">
					<ol class="breadcrumb">
						<li class="active"><i class="fa fa-home"></i> <a href="<?php echo site_url('dashboard');?>">Home</a></li>
						<li class="active"><a href="<?php echo site_url('rka/murni');?>"> RKA</a></li>
						<li class="active"> Belanja Langsung</li>
						<li class="active"> Rincian Belanja</li>
					</ol>
				</div>
			</div>
		</div>
				<div class="col-md-12">
                	<div class="portlet" align="right">
                		<a href="<?php echo site_url('rka');?>" class="btn btn-default"><i class="fa fa-reply"></i> Kembali</a>
						<a class="btn btn-success" title="Tambah" href="<?php echo site_url('rka/murni/adds/'.$bl->task_id);?>"><i class="fa fa-plus"> Sub</i></a>
                    </div>
                </div>
			<!-- END PAGE HEADER-->
			<div class="clearfix"></div>
			<?php echo validation_errors(); ?>
			<?php if ($this->session->flashdata('success')) { echo $this->session->flashdata('success');} ?>		
				<div class="card-body">
				<div class="panel panel-default">
					<div class="panel-body">
					<p align="center"><b><?php echo strtoupper($rka->id_skpd);?></b></p>
						<div class="col-md-6"><label class="control-label col-md-2">Program</label><p>: <?php echo $rka->id_program; ?></p></div>
						<div class="col-md-6"><p align="right">.</p></div>
						<div class="col-md-6"><label class="control-label col-md-2">Kegiatan</label><p>: <?php echo $rka->id_kegiatan; ?></p></div>				
						<div class="col-md-6"><p align="right">.</p></div>
						<div class="col-md-6"><label class="control-label col-md-2">Rekening</label><p>: <?php echo $rka->id_akun;?>.<?php echo $rka->id_kelompok;?>.<?php echo $rka->id_jenis;?>.<?php echo $rka->id_obyek;?>.<?php echo $rka->id_rincian;?> <?php echo $rka->nama_rincian;?></p></div>
						<div class="col-md-6"><p align="right">.</p></div>
						<div class="col-md-6"><label class="control-label col-md-2">Rincian</label><p>: <?php echo $rincian->no; ?>. <?php echo $rincian->uraian; ?></p></div>				
					</div>
				</div>									
				</div>
			<div class="row">
			<div class="col-md-12">
            <div class="panel panel-primary">
				<div class="panel-heading"><i class="fa fa-bars"></i> Data Kode Rekening</div>
				<div class="panel-body">
				<!-- BEGIN FORM -->
				<div class="step">
					<ul class="nav nav-tabs nav-justified" role="tablist">
						<li role="step" ><a><div class="step-title"><div class="title">Belanja</div></div></a></li>
						<li role="step" ><a href="#" onClick="history.go(-1); return false;"><div class="step-title"><div class="title">Rincian Belanja</div></div></a></li>
						<li role="step" class="active">
							<a href="#step1" id="step1-tab" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true">								
								<div class="step-title"><div class="title">Sub Rincian Belanja</div></div>
							</a>
						</li>						
						<li role="step" ><a><div class="step-title"><div class="title">History</div></div></a></li>
					</ul>
					<div class="tab-content">
						<div role="tabpanel" class="tab-pane fade in active" id="step1" aria-labelledby="home-tab">
							<div class="portlet-body">
							<table id="example1" class="table table-striped table-bordered table-hover">
								<thead><tr>
									<th style="text-align:center; width:60px">No</th>
									<th style="text-align:center;">Uraian</th>
								</tr></thead>
								<tbody><?php if($sub) : ?><?php foreach($sub as $task) : ?>
								<tr>
									<td style="text-align:center;"><?php echo $task->no; ?></td>
									<td><a href="<?php echo base_url(); ?>rka/murni/sub/<?php echo $task->task_id; ?>"><?php echo $task->uraian; ?></a></td>
								</tr>
								<?php endforeach; ?><?php endif; ?>
							</table>				
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
<a href="#warningEdit" data-toggle="modal"></a>
	<div id="warningEdit" class="modal fade" role="dialog" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
					<h4 class="modal-title"><strong>Warning!</strong></h4>
				</div>
				<div class="modal-body">
					 Data Rekening <font color="red"><strong>"Permanen!"</strong></font>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn blue" data-dismiss="modal">OK</button>
				</div>
			</div>
		</div>
	</div>
	
<a href="#warningHapus" data-toggle="modal"></a>
	<div id="warningHapus" class="modal fade" role="dialog" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
					<h4 class="modal-title"><strong>Warning!</strong></h4>
				</div>
				<div class="modal-body">
					 Data Rekening <font color="red"><strong>"Permanen!"</strong></font>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn blue" data-dismiss="modal">OK</button>
				</div>
			</div>
		</div>
	</div>