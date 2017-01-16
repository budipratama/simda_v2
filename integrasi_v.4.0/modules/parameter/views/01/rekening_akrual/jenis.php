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
			<?php echo validation_errors(); ?>
			<?php if ($this->session->flashdata('success')) { echo $this->session->flashdata('success');} ?>
			<div class="row">
			<div class="col-md-12">
            <div class="panel panel-primary">
				<div class="panel-heading"><i class="fa fa-bars"></i> Rekening Akrual</div>
				<div class="panel-body">				
				<!-- BEGIN FORM -->	
				<div class="step">
					<ul class="nav nav-tabs nav-justified" role="tablist">
					<li role="step" ><a><div class="step-title"><div class="title">Akun</div></div></a></li>
					<li role="step" ><a href="#" onClick="history.go(-1); return false;"><div class="step-title"><div class="title">Kelompok</div></div></a></li>
						<li role="step" class="active">
							<a href="#step1" id="step1-tab" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true">								
								<div class="step-title"><div class="title">Jenis</div></div>
							</a>
						</li>
						<li role="step" ><a><div class="step-title"><div class="title">Obyek</div></div></a></li>
						<li role="step" ><a><div class="step-title"><div class="title">Rincian</div></div></a></li>
					</ul>
					<div class="tab-content">
						<div role="tabpanel" class="tab-pane fade in active" id="step1" aria-labelledby="home-tab">
							<div class="portlet-body">
							<a class="btn btn-sm btn-success" title="Tambah" href="<?php echo base_url(); ?>parameter/rekening-akrual/addj/<?php echo $list->kode; ?>"><i class="fa fa-plus"> Jenis</i></a>
							<table class="table table-striped table-bordered table-hover" width="50%" cellspacing="5" cellpadding="5">
								<tr>
								<th style="text-align:center; width:100px">Akun</th>
								<th style="text-align:center; width:100px">Kelompok</th>
								<th style="text-align:center; width:100px">Jenis</th>
								<th style="text-align:center;">Uraian Rekening Jenis</th>
								<th style="text-align:center; width:110px">Saldo Normal</th>
								<th style="text-align:center; width:110px">Action</th>
								</tr><?php if($completed_tasks) : ?>
									<ul><?php foreach($completed_tasks as $task) : ?>
										<tr>
										<td style="text-align:center;"><?php echo $akun->no; ?></td>
										<td style="text-align:center;"><?php echo $kelompok->no; ?></a></td>
										<td style="text-align:center;"><?php echo $task->no; ?></a></td>
										<td><a href="<?php echo base_url(); ?>parameter/rekening-akrual/obyek/<?php echo $task->task_id; ?>"><?php echo $task->jenis_nama; ?></a></td>
										<td style="text-align:center;"><?php echo $task->saldo_normal; ?></a></td>
										<td style="text-align:center;">										
										<a class="btn btn-sm btn-warning" title="Ubah" href="<?php echo base_url(); ?>parameter/rekening-akrual/editj/<?php echo $task->task_id; ?>" value="<?php echo $task->kode; ?>"><i class="fa fa-pencil"></i></a>
										<a class="btn btn-sm btn-danger" title="Hapus" onclick="return confirm('Are you sure?')" href="<?php echo base_url(); ?>parameter/rekening-akrual/deletej/<?php echo $list->kode; ?>" value="<?php echo $task->kode; ?>"><i class="fa fa-trash-o"></i></a>
										</td>
										</tr>
									<?php endforeach; ?></ul>
									<?php else : ?><td>-</td><td>-</td><td>-</td><td style="text-align:center; width:500px">Tidak ada data pada tabel ini</td><td>-</td><td>-</td><?php endif; ?>
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