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
					<li class="active">BLUD</li>
				</ol>
				</div>
			</div>
		</div>	
			<div class="col-md-12">
				<div class="portlet" align="right">
					<a href="<?php echo site_url('parameter/unit-organisasi-blud');?>" class="btn btn-default"><i class="fa fa-reply"></i> Kembali</a>
				</div>
			</div>
			<!-- END PAGE HEADER-->
			<div class="clearfix"></div>
			<?php echo validation_errors(); ?>
			<?php if ($this->session->flashdata('success')) { echo $this->session->flashdata('success');} ?>
			<div class="row">
			<div class="col-md-12">
            <div class="panel panel-primary">
				<div class="panel-heading"><i class="fa fa-bars"></i> DATA BLUD</div>
				<div class="panel-body">				
				<!-- BEGIN FORM -->	
				<div class="portlet-body">							
					<table id="example1" class="table table-striped table-bordered table-hover">
						<thead><tr>
							<th style="text-align:center; width:50px">Urusan</th>
							<th style="text-align:center; width:50px">Bidang</th>
							<th style="text-align:center; width:50px">Unit</th>
							<th style="text-align:center;">Uraian Unit</th>
						</tr></thead>
							<tbody><?php if(isset($unit)) : ?><?php foreach($unit as $list) : ?>
								<tr>
								<td style="text-align:center;"><?php echo $list->id_tipe; ?></td>
								<td style="text-align:center;"><?php echo $list->id_urusan; ?></td>
								<td style="text-align:center;"><?php echo $list->skpd_no; ?></a></td>
								<td><a href="<?php echo base_url(); ?>parameter/unit-organisasi-blud/sub/<?php echo $list->task_id; ?>"><?php echo $list->skpd_nama; ?></a></td>
								</tr>
							<?php endforeach; ?><?php endif; ?>
							</tbody>
					</table>		
				</div>
				<!-- END FORM-->
				</div>
			</div>
			</div>
			</div>
			<!-- END SAMPLE TABLE PORTLET-->
</div>
<!-- END CONTENT -->