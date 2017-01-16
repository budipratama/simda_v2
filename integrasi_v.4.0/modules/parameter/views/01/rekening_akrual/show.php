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
				<div class="portlet-body" style="display: block;">
					<a href="<?php echo site_url('parameter/rekening-akrual/add');?>" class="icon-btn"><i class="fa fa-plus"></i><div>Jenis</div></a>
					</div>							
				</div>
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
							<a href="<?php echo site_url('parameter/rekening/obyek');?>">
								<div class="icon glyphicon glyphicon-circle-arrow-right" style="font-size:30px;color:black"></div>
									<div class="step-title">
									<div class="title">Obyek</div>
									<div class="description">Rekening Akrual</div>
									</div>
							</a>
						</li>
						<li role="step">
							<a href="<?php echo site_url('parameter/rekening/rincian');?>" >
								<div class="icon glyphicon glyphicon-circle-arrow-right" style="font-size:30px;color:black"></div>
									<div class="step-title">
									<div class="title">Rincian Obyek</div>
									<div class="description">Rekening Akrual</div>
								</div>
							</a>
						</li>
					</ul>
					<div class="tab-content">
						<div role="tabpanel" class="tab-pane fade in active" id="step1" aria-labelledby="home-tab">
							<div class="portlet-body">											
								
								
							
<h4> Current Open Tasks</h4>
<div style="max-width:500px;"><?php echo $akun->akun_body; ?></div>	
<?php if($completed_tasks) : ?>
    <ul>
    <?php foreach($completed_tasks as $task) : ?>
        <li><a href="<?php echo base_url(); ?>parameter/rekening-akrual/show/<?php echo $task->task_id; ?>"><?php echo $task->kelompok_nama; ?></a></li>
    <?php endforeach; ?>
    </ul>
<?php else : ?>
    <p>There are no current tasks</p>
<?php endif; ?>
<br />
<h4> Recently Completed</h4>
<?php if($uncompleted_tasks) : ?>
    <ul>
    <?php foreach($uncompleted_tasks as $task) : ?>
        <li><a href="<?php echo base_url(); ?>parameter/rekening-akrual/show/<?php echo $task->task_id; ?>"><?php echo $task->kelompok_nama; ?></li></a>
    <?php endforeach; ?>
    </ul>
<?php else : ?>
     <p>There are no completed tasks</p>
<?php endif; ?>
<hr />
								
								
								
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