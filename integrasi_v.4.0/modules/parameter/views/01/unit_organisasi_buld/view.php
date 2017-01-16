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
				<a href="<?php echo site_url('parameter');?>" class="btn btn-default"><i class="fa fa-reply"></i> Kembali</a>
					<a class="btn btn-success" title="Tambah" href="<?php echo site_url('parameter/unit-organisasi-blud/add');?>"><i class="fa fa-plus"> BULD</i></a>
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
				<table id="example1" class="table table-striped table-bordered table-hover">
					<thead><tr>
					<th style="text-align:center; width:50px">Urusan</th>
					<th style="text-align:center; width:50px">Bidang</th>
					<th style="text-align:center; width:50px">Unit</th>
					<th style="text-align:center; width:50px">Sub</th>
					<th style="text-align:center;">Uraian Nama Sub Unit</th>								
					<!--<th style="text-align:center; width:60px">Actions</th>-->
					</tr></thead>
					<tbody><?php if(isset($sub)) : ?><?php foreach($sub as $list) : ?>
						<tr>
						<td style="text-align:center;"><?php echo $list->id_tipe; ?></td>
						<td style="text-align:center;"><?php echo $list->id_urusan; ?></td>
						<td style="text-align:center;"><?php echo $list->id_skpd; ?></a></td>
						<td style="text-align:center;"><?php echo $list->id_sub; ?></a></td>
						<td><?php echo $list->sub_nama; ?></td>
						<!--<td style="text-align:center;">										
						<a class="btn btn-sm btn-warning" title="Ubah" href="<?php echo base_url(); ?>parameter/unit_organisasi/edit/<?php echo $list->task_id; ?>" value="<?php echo $list->kode; ?>"><i class="fa fa-pencil"></i></a>
						<a class="btn btn-sm btn-danger" title="Hapus" onclick="return confirm('Are you sure?')" value="<?php echo $list->kode; ?>" href="<?php echo base_url(); ?>parameter/unit_organisasi/delete/<?php echo $task->task_id; ?>/<?php echo $this->uri->segment(1); ?>" ><i class="fa fa-trash-o"></i></a>
						</td>-->
						</tr>
						<?php endforeach; ?><?php endif; ?>
					</tbody>
					</table>
				<!-- END FORM-->
				</div>
			</div>
			</div>
			</div>
			<!-- END SAMPLE TABLE PORTLET-->
</div>
<!-- END CONTENT -->