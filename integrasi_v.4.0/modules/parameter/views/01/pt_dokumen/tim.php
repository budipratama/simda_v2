<!-- Main Content -->
<div class="container-fluid">
<div class="side-body padding-top">
	<h3 class="page-title">Parameter <small> Penanda Tanggan Dokumen</small></h3>		
		<div class="row">
			<div class="col-xs-12">
				<div class="bs-example">
				<ol class="breadcrumb">
					<li class="active"><i class="fa fa-home"></i> <a href="<?php echo site_url('dashboard');?>">Home</a></li>
					<li class="active"><a href="<?php echo site_url('parameter');?>">Parameter</a></li>
					<li class="active"><a href="<?php echo site_url('parameter/pt-dokumen');?>">Penanda Tanggan Dokumen</a></li>
				</ol>
				</div>
			</div>
		</div>	
				<div class="col-md-12">
                	<div class="portlet" align="right">
                		<a href="<?php echo site_url('parameter/pt-dokumen');?>" class="btn btn-default"><i class="fa fa-reply"></i> Kembali</a>
						<a class="btn btn-success" title="Tambah" href="<?php echo site_url('parameter/pt-dokumen/add/'.$skpd->id_kode);?>"><i class="fa fa-plus"> Data</i></a>
                    </div>
                </div>
			<!-- END PAGE HEADER-->
			<div class="clearfix"></div>
			<?php echo validation_errors(); ?>
			<?php if ($this->session->flashdata('success')) { echo $this->session->flashdata('success');} ?>
			<div class="row">
			<div class="col-md-12">
            <div class="panel panel-primary">
				<div class="panel-heading"><i class="fa fa-bars"></i> Data Penanda Tanggan Dokumen</div>
				<div class="panel-body">				
				<!-- BEGIN FORM -->
				<div class="portlet-body">							
				<table id="example1" class="table table-striped table-bordered table-hover">
					<thead><tr>
					<th style="text-align:center;">Nama Organisasi</th>
					<th style="text-align:center;">Nama</th>
					<th style="text-align:center;">Jabatan</th>
						<th style="text-align:center;">Nip</th>
					</tr></thead>
						<tbody><?php if(isset($tim)) : ?> <?php foreach($tim as $list) : ?>
							<tr>
							<td><?php echo $list->id_skpd; ?></td>
							<td><?php echo $list->nama; ?></td>
							<td><?php echo $list->jabatan; ?></td>
							<td><?php echo $list->nip; ?></td>
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