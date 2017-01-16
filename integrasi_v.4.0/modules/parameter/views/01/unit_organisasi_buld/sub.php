<!-- Main Content -->
<div class="container-fluid">
<div class="side-body padding-top">
	<h3 class="page-title">Parameter <small> Unit Organisasi BLUD</small></h3>		
		<div class="row">
			<div class="col-xs-12">
				<div class="bs-example">
				<ol class="breadcrumb">
					<li class="active"><i class="fa fa-home"></i> <a href="<?php echo site_url('dashboard');?>">Home</a></li>
					<li class="active"><a href="<?php echo site_url('parameter');?>"> Parameter</a></li>
					<li class="active"><a href="<?php echo site_url('parameter/unit-organisasi-blud');?>"> Unit Organisasi BLUD</a></li>
				</ol>
				</div>
			</div>
		</div>	
				<div class="col-md-12">
                	<div class="portlet" align="right">
					<a href="<?php echo site_url('parameter/unit-organisasi-blud/add');?>" class="btn btn-default"><i class="fa fa-reply"></i> Kembali</a>
                    </div>
                </div>
			<!-- END PAGE HEADER-->
			<div class="clearfix"></div>
			<?php echo validation_errors(); ?>
			<?php if ($this->session->flashdata('success')) { echo $this->session->flashdata('success');} ?>
			<div class="row">
			<div class="col-md-12">
            <div class="panel panel-primary">
				<div class="panel-heading"><i class="fa fa-bars"></i> Unit Organisasi BLUD</div>
				<div class="panel-body">				
				<!-- BEGIN FORM -->	
				<div class="step">
					<ul class="nav nav-tabs nav-justified" role="tablist">
						<li role="step" ><a><div class="step-title"><div class="title">Urusan</div></div></a></li>						
						<li role="step" ><a><div class="step-title"><div class="title">Bidang</div></div></a></li>						
						<li role="step" ><a><div class="step-title"><div class="title">Sub</div></div></a></li>
						<li role="step" class="active">
							<a href="#step1" id="step1-tab" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true">								
								<div class="step-title"><div class="title">Sub Unit</div></div>
							</a>
						</li>
					</ul>
					<div class="tab-content">
					<form action="<?php echo site_url('parameter/unit_organisasi_blud/sub/'.$kode->id);?>" class="form-horizontal" method="post" >
						<div role="tabpanel" class="tab-pane fade in active" id="step1" aria-labelledby="home-tab">
							<div class="portlet-body">							
							<table id="example1" class="table table-striped table-bordered table-hover">
								<thead><tr>
								<th style="text-align:center; width:50px">Urusan</th>
								<th style="text-align:center; width:50px">Bidang</th>
								<th style="text-align:center; width:50px">Unit</th>
								<th style="text-align:center; width:50px">Sub Unit</th>
								<th style="text-align:center;">Uraian Sub Unit</th>								
								<th style="text-align:center; width:50px">Action</th>
								</tr></thead>
									<tbody><?php if($completed) : ?><?php foreach($completed as $task) : ?>
										<tr>
										<td style="text-align:center;"><input type="hidden" name="aaa_kode" value="<?php echo $task->tipe; ?>"><?php echo $task->tipe_id; ?></td>
										<td style="text-align:center;"><input type="hidden" name="bbb_kode" value="<?php echo $task->urusan; ?>"><?php echo $task->urusan_id; ?></td>
										<td style="text-align:center;"><input type="hidden" name="ccc_kode" value="<?php echo $unit->skpd_kode; ?>"><?php echo $unit->skpd_no; ?></td>
										<td style="text-align:center;"><input type="hidden" name="ddd_kode" value="<?php echo $task->task_id; ?>"><?php echo $task->no; ?></td>
										<td><input type="hidden" name="eee_kode" value="<?php echo $task->sub_nama; ?>"><?php echo $task->sub_nama; ?></td>
										<td><button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Pilih</button></td>
										</tr>
                                      <?php endforeach; ?><?php else : ?><td>-</td><td>-</td><td>-</td><td>-</td><td style="text-align:center; width:500px">Tidak ada data pada tabel ini</td><td>-</td><?php endif; ?>
									</tbody>
							</table>		
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