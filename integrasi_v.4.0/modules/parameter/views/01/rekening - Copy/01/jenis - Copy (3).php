<script src="<?php echo base_url('public/01/jquery/jquery-2.1.4.min.js')?>"></script>
<!-- Main Content -->
<div class="container-fluid">
<div class="side-body padding-top">
	<h3 class="page-title">Parameter <small> rekening</small></h3>		
		<div class="row">
			<div class="col-xs-12">
				<div class="bs-example">
				<ol class="breadcrumb">
					<li class="active"><i class="fa fa-home"></i> <a href="<?php echo site_url('dashboard');?>">Home</a></li>
					<li class="active"><a href="<?php echo site_url('parameter');?>"> Parameter</a></li>
					<li class="active"><a href="<?php echo site_url('parameter/rekening');?>"> Rekening</a></li>
					<li class="active"><a href="<?php echo site_url('parameter/rekening/jenis');?>"> Jenis</a></li>
				</ol>
				</div>
			</div>
		</div>
		<div class="col-md-12">
                	<div class="portlet" align="right">
                		<a href="<?php echo site_url('parameter');?>" class="btn btn-default"><i class="fa fa-reply"></i> Kembali</a>                		
                		<a href="<?php echo site_url('parameter/rekening/jenis/#add', 'refresh');?>" class="btn btn-info"><i class="fa fa-plus"></i> Jenis</a>                		
                    </div>
                </div>
			<!-- END PAGE HEADER-->
			<div class="clearfix"></div>
			<?php echo validation_errors(); ?>
			<?php if ($this->session->flashdata('success')) { echo $this->session->flashdata('success');} ?>
            <script>
				var ajax_source_url = '<?php echo site_url($this->uri->segment(1) . '/' . $this->uri->segment(2) . '/datatable'); ?>';
				var ajax_source_field =	  [ { "data": "nomor" },
											{ "data": "akun_nama" },
											{ "data": "kelompok_nama" },
											{ "data": "jenis_nama" },
											{ "data": "Actions" } ];
			</script>
			<div class="row">
			<div class="col-md-12">
            <div class="panel panel-success">
				<div style="font-size:20pt" class="panel-heading"><i class="fa fa-bars"></i> Rekening</div>
				<div class="panel-body">				
				<!-- BEGIN FORM -->
						<div class="portlet-body">
							<table class="table table-striped table-bordered table-hover" id="tableUtama">
							<thead>
							<tr>
								<th style="width:25px">No</th>
                                <th class="hidden-xs">Nama Pemda</th>
								<th class="hidden-xs" style="text-align:center;">IbuKota Pemda</th>
								<th class="hidden-xs" style="text-align:center;">Alamat Pemda</th>
								<th style="width:110px"><center>Actions</th>
							</tr>
							</thead>
							<tbody></tbody>
							</table>
						</div>			
				</div>
			</div>
			</div>
			</div>
			<!-- END SAMPLE TABLE PORTLET-->
</div>
<!-- END CONTENT -->
	<a href="#add" data-toggle="modal"></a>
	<div id="add" class="modal fade" role="dialog" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
					<h4 class="modal-title"><strong>Success!</strong> Ubah Data Umum Pemda</h4>
				</div>
				<div class="modal-body">
					 Parameter <font color="green"><strong>"Data Umum Pemda"</strong></font> telah berhasil diperbaharui !
				</div>
				<div class="modal-footer">
				<a href="<?php echo site_url('parameter/rekening/jenis');?>" class="btn green">OK</a>
					<button type="button" class="btn green" data-dismiss="modal">.:XxX:.</button>
				</div>
			</div>
		</div>
	</div>
	
	<a href="#edit" data-toggle="modal"></a>
	<div id="edit" class="modal fade" role="dialog" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
					<h4 class="modal-title"><strong>Success!</strong> Ubah Data Umum Pemda</h4>
				</div>
				<div class="modal-body">
					 Parameter <font color="green"><strong>"Data Umum Pemda"</strong></font> telah berhasil diperbaharui !
				</div>
				<div class="modal-footer">
				<a href="<?php echo site_url('parameter/rekening/jenis');?>" class="btn green">OK</a>
					<button type="button" class="btn green" data-dismiss="modal">.:XxX:.</button>
				</div>
			</div>
		</div>
	</div>