<!-- Main Content -->
<div class="container-fluid">
<div class="side-body padding-top">
	<h3 class="page-title">Parameter <small> Tim Anggaran</small></h3>		
		<div class="row">
			<div class="col-xs-12">
				<div class="bs-example">
				<ol class="breadcrumb">
					<li class="active"><i class="fa fa-home"></i> <a href="<?php echo site_url('dashboard');?>">Home</a></li>
					<li class="active"><a href="<?php echo site_url('parameter');?>"> Parameter</a></li>
					<li class="active"><a href="<?php echo site_url('parameter/tim-anggaran');?>"> Tim Anggaran</a></li>
				</ol>
				</div>
			</div>
		</div>	
				<div class="col-md-12">
                	<div class="portlet" align="right">
                		<a href="<?php echo site_url('parameter');?>" class="btn btn-default"><i class="fa fa-reply"></i> Kembali</a>
						<a class="btn btn-success" title="Tambah" href="<?php echo site_url('parameter/tim-anggaran/add');?>"><i class="fa fa-plus"> Tim Anggaran</i></a>
                    </div>
                </div>
			<!-- END PAGE HEADER-->
			<div class="clearfix"></div>
			<?php echo validation_errors(); ?>
			<?php if ($this->session->flashdata('success')) { echo $this->session->flashdata('success');} ?>
			<div class="row">
			<div class="col-md-12">
            <div class="panel panel-primary">
				<div class="panel-heading"><i class="fa fa-bars"></i> Data Tim Anggaran</div>
				<div class="panel-body">				
				<!-- BEGIN FORM -->
				<div class="portlet-body">							
				<table id="example1" class="table table-striped table-bordered table-hover">
					<thead><tr>
						<th style="text-align:center; width:50px">Kode Tim</th>
						<th style="text-align:center; width:50px">No. Urut</th>
						<th style="text-align:center;">Nama</th>
						<th style="text-align:center;">Nip</th>
						<th style="text-align:center;">Jabatan</th>
						<th style="text-align:center; width:60px">Action</th>
					</tr></thead>
						<tbody><?php if(isset($tim)) : ?> <?php foreach($tim as $list) : ?>
							<tr>
							<td style="text-align:center;"><?php echo $list->kode_tim; ?></td>
							<td style="text-align:center;"><?php echo $list->no; ?></td>
							<td><?php echo $list->nama; ?></a></td>
							<td style="text-align:center;"><?php echo $list->nip; ?></td>
							<td><?php echo $list->jabatan; ?></a></td>
							<td style="text-align:center;">										
							<a class="btn btn-sm btn-warning" title="Ubah" href="<?php echo base_url(); ?>parameter/tim-anggaran/edit/<?php echo $list->kode; ?>"><i class="fa fa-pencil"></i></a>
							<a class="btn btn-sm btn-danger" title="Hapus" onclick="return confirm('Are you sure?')" href="<?php echo base_url(); ?>parameter/tim-anggaran/delete/<?php echo $list->kode; ?>/<?php echo $this->uri->segment(1); ?>" ><i class="fa fa-trash-o"></i></a>
							</td>
							</tr>
						<?php endforeach; ?><?php endif; ?>
						</tbody>
				</table>
				</div>
				<!-- END FORM-->
			</div>
			</div>
			</div>
			<!-- END SAMPLE TABLE PORTLET-->
</div>
<!-- END CONTENT -->