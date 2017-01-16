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
				<div class="panel-heading"><i class="fa fa-bars"></i> Sub Rekening</div>
				<div class="panel-body">
				<div class="portlet-body" style="display: block;">                          
					<a href="<?php echo site_url('parameter/rekening-sub/add');?>" class="icon-btn"><i class="fa fa-plus"></i><div>Sub Rincian</div></a>
					</div>							
				</div>
				<div class="panel-body">				
				<!-- BEGIN FORM -->	
                                    <div class="step">
                                        <ul class="nav nav-tabs nav-justified" role="tablist">
                                            <li role="step">
                                                <a href="#" id="step3-tab" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true"> 
                                                    <div class="icon glyphicon glyphicon-remove-sign" style="font-size:30px;color:black"></div>
                                                    <div class="step-title">
                                                        <div class="title">Jenis</div>
                                                        <div class="description">Rekening</div>
                                                    </div>
                                                </a>
                                            </li>
                                            <li role="step">
												<a href="#" id="step3-tab" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true"> 
                                                    <div class="icon glyphicon glyphicon-remove-sign" style="font-size:30px;color:black"></div>
                                                    <div class="step-title">
                                                        <div class="title">Obyek</div>
                                                        <div class="description">Rekening</div>
                                                    </div>
                                                </a>
                                            </li>
											<li role="step">
                                                <a href="#" id="step3-tab" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true"> 
                                                    <div class="icon glyphicon glyphicon-remove-sign" style="font-size:30px;color:black"></div>
                                                    <div class="step-title">
                                                        <div class="title">Rincian Obyek</div>
                                                        <div class="description">Rekening</div>
                                                    </div>
                                                </a>
                                            </li>
											<li role="step" class="active step-success">
                                                <a href="#step3" id="step4-tab" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true"> 
                                                    <div class="icon glyphicon glyphicon-ok-sign" style="font-size:40px;color:white"></div>
                                                    <div class="step-title">
                                                        <div class="title">Sub Rincian</div>
                                                        <div class="description">Rekening Sub Rincian Belanja Modal</div>
                                                    </div>
                                                </a>
                                            </li>
                                        </ul>
                                        <div class="tab-content">
                                            <div role="tabpanel" class="tab-pane fade in active" id="step1" aria-labelledby="home-tab">
                                                <div class="portlet-body">
													<table class="table table-striped table-bordered table-hover" id="tableUtama">
													<thead>
														<tr>
														<th style="width:25px">No</th>
														<th class="hidden-xs" style="text-align:center;">Obyek</th>
														<th class="hidden-xs" style="text-align:center;">Rincian Obyek</th>
														<th class="hidden-xs" style="text-align:center;">Sub Rincian</th>
														<th style="text-align:center; width:60px">Actions</th>
														</tr>
													</thead>
													<tbody></tbody>
													</table>
												</div>
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
	<script>
	var ajax_source_url = '<?php echo site_url($this->uri->segment(1) . '/' . $this->uri->segment(2) . '/datatable'); ?>';
	var ajax_source_field =	  [ { "data": "nomor" }, { "data": "nama_obyek" }, { "data": "rincian_nama" }, { "data": "sub_nama" }, { "data": "Actions" } ];
	</script>