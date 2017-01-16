<!-- Main Content -->
<div class="container-fluid">
<div class="side-body padding-top">
	<h3 class="page-title">Parameter <small> Rekening Korolari</small></h3>		
		<div class="row">
			<div class="col-xs-12">
				<div class="bs-example">
				<ol class="breadcrumb">
					<li class="active"><i class="fa fa-home"></i> <a href="<?php echo site_url('dashboard');?>">Home</a></li>
					<li class="active"><a href="<?php echo site_url('parameter');?>"> Parameter</a></li>
					<li class="active"><a href="<?php echo site_url('parameter/korolari');?>"> Rekening Korolari</a></li>
				</ol>
				</div>
			</div>
		</div>	
			<div class="col-md-12">
				<div class="portlet" align="right">				
					<a href="<?php echo site_url('parameter');?>" class="btn btn-default"><i class="fa fa-reply"></i> Kembali</a>
					<a class="btn btn-success" title="Tambah" href="<?php echo site_url('parameter/korolari/add');?>"><i class="fa fa-plus"> Korolari</i></a>
				</div>
			</div>
			<!-- END PAGE HEADER-->
			<div class="clearfix"></div>
			<?php echo validation_errors(); ?>
			<?php if ($this->session->flashdata('success')) { echo $this->session->flashdata('success');} ?>
			<div class="row">
			<div class="col-md-12">
            <div class="panel panel-primary">
				<div class="panel-heading"><i class="fa fa-bars"></i> DATA Rekening Korolari</div>
				<div class="panel-body">				
				<!-- BEGIN FORM -->								
				<table id="example1" class="table table-striped table-bordered table-hover">
					<thead><tr>
					<th style="text-align:center; width:50px">Kd Rek</th>
					<th style="text-align:center;">Uraian Rekening</th>
					<th style="text-align:center; width:50px">Kd Debet</th>
					<th style="text-align:center;">Uraian Rekening Debet</th>
					<th style="text-align:center; width:50px">Kd Kredit</th>
					<th style="text-align:center;">Uraian Rekening Kredit</th>
					<!-- <th style="text-align:center; width:60px">Actions</th> -->
					</tr></thead>
					<tbody><?php if(isset($rek)) : ?><?php foreach($rek as $list) : ?>
						<tr>
						<td style="text-align:center;"><?php echo $list->id_akun; ?>.<?php echo $list->id_kelompok; ?>.<?php echo $list->id_jenis; ?>.<?php echo $list->id_obyek; ?>.<?php echo $list->id_rincian; ?></td>
						<td><?php echo $list->rincian_nama; ?></td>
						<td style="text-align:center;"><?php echo $debet->id_akun; ?>.<?php echo $debet->id_kelompok; ?>.<?php echo $debet->id_jenis; ?>.<?php echo $debet->id_obyek; ?>.<?php echo $debet->id_rincian; ?></td>
						<td><?php echo $debet->rincian_nama; ?></td>
						<td style="text-align:center;"><?php echo $kredit->id_akun; ?>.<?php echo $kredit->id_kelompok; ?>.<?php echo $kredit->id_jenis; ?>.<?php echo $kredit->id_obyek; ?>.<?php echo $kredit->id_rincian; ?></td>
						<td><?php echo $kredit->rincian_nama; ?></td>
						<!-- <td style="text-align:center;">
						<a class="btn btn-sm btn-warning" title="Ubah" href="<?php echo base_url(); ?>parameter/korolari/edit/<?php echo $list->task_id; ?>" value="<?php echo $list->kode; ?>"><i class="fa fa-pencil"></i></a>
						<a class="btn btn-sm btn-danger" title="Hapus" onclick="return confirm('Are you sure?')" value="<?php echo $list->kode; ?>" href="<?php echo base_url(); ?>parameter/korolari/delete/<?php echo $task->task_id; ?>/<?php echo $this->uri->segment(1); ?>" ><i class="fa fa-trash-o"></i></a>
						</td> -->
						</tr>
						<?php endforeach; ?><?php endif; ?>
					</tbody>
					</table>
				<!-- END FORM -->
				</div>
			</div>
			</div>
			</div>
			<!-- END SAMPLE TABLE PORTLET -->
</div>
<!-- END CONTENT -->