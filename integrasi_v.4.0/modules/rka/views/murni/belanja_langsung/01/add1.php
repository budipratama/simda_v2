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
						<li class="active"> Belanja</li>
					</ol>
				</div>
			</div>
		</div>
				<div class="col-md-12">
                	<div class="portlet" align="right">
                		<a href="<?php echo site_url('rka');?>" class="btn btn-default"><i class="fa fa-reply"></i> Kembali</a>
                    </div>
                </div>
			<!-- END PAGE HEADER-->
			<div class="clearfix"></div>
			<?php echo validation_errors(); ?>
			<?php if ($this->session->flashdata('success')) { echo $this->session->flashdata('success');} ?>		
				<div class="card-body">
				<div class="panel panel-default">
					<div class="panel-body">
					<p align="center"><b><?php echo strtoupper($skpd);?></b></p>
						<div class="col-md-6"><label class="control-label col-md-2">Program</label><p>: <?php echo $program;?></p></div>
						<div class="col-md-6"><p align="right">.</p></div>
						<div class="col-md-6"><label class="control-label col-md-2">Kegiatan</label><p>: <?php echo $kegiatan;?></p></div>					
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
						<li role="step" class="active">
							<a href="#step1" id="step1-tab" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true">								
								<div class="step-title"><div class="title">Belanja</div></div>
							</a>
						</li>
						<li role="step" ><a><div class="step-title"><div class="title">Rincian Belanja</div></div></a></li>
						<li role="step" ><a><div class="step-title"><div class="title">Sub Rincian Belanja</div></div></a></li>
						<li role="step" ><a><div class="step-title"><div class="title">History</div></div></a></li>
					</ul>
					<div class="tab-content">
						<div role="tabpanel" class="tab-pane fade in active" id="step1" aria-labelledby="home-tab">
							<div class="portlet-body">
							<table id="example1" class="table table-striped table-bordered table-hover">
								<thead><tr>
									<th style="text-align:center; width:60px">Kode Rekening</th>
									<th style="text-align:center;">Uraian</th>
									<th style="text-align:center; width:60px">Sumber</th>
									<th style="text-align:center; width:60px">Actions</th>
								</tr></thead>
								<tbody><?php if(isset($rka)) : ?><?php foreach($rka as $list) : ?>
								<tr>
									<td style="text-align:center;"><?php echo $list->id_akun; ?> . <?php echo $list->id_kelompok; ?> . <?php echo $list->id_jenis; ?> . <?php echo $list->id_obyek; ?> . <?php echo $list->id_rincian; ?></td>
									<td><a href="<?php echo base_url(); ?>rka/murni/rincian/<?php echo $list->task_id; ?>"><?php echo $list->nama_rincian; ?></a></td>
									<td style="text-align:center;"><?php echo $list->sumber; ?></td>
									<td style="text-align:center;">										
									<!--<a class="btn btn-sm btn-warning" title="Ubah" href="<?php echo base_url(); ?>parameter/belanja-wajib/edit/<?php echo $list->task_id; ?>" value="<?php echo $list->kode; ?>"><i class="fa fa-pencil"></i></a>
									<a class="btn btn-sm btn-danger" title="Hapus" onclick="return confirm('Are you sure?')" value="<?php echo $list->kode; ?>" href="<?php echo base_url(); ?>parameter/murni/add/delete/<?php echo $list->task_id; ?>/<?php echo $this->uri->segment(1); ?>" ><i class="fa fa-trash-o"></i></a>
									--></td>
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