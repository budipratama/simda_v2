<!-- Main Content -->
<div class="container-fluid">
<div class="side-body padding-top">
	<h3 class="page-title">Parameter Rekening <small> rekening</small></h3>		
		<div class="row">
			<div class="col-xs-12">
				<div class="bs-example">
				<ol class="breadcrumb">
					<li class="active"><i class="fa fa-home"></i> <a href="<?php echo site_url('dashboard');?>">Home</a></li>
					<li class="active"><a href="<?php echo site_url('parameter');?>"> Parameter</a></li>
					<li class="active"><a href="<?php echo site_url('parameter/rekening');?>"> Rekening</a></li>
					<li class="active"><a href="<?php echo site_url('parameter/rekening/add');?>"> Tambah</a></li>
					<li class="active"><a href="<?php echo site_url('parameter/rekening/detail');?>"> Rekening</a></li>
				</ol>
				</div>
			</div>
		</div>
				<div class="col-md-12">
                	<div class="portlet" align="right">
                		<a href="<?php echo site_url('parameter/rekening/add');?>" class="btn btn-default"><i class="fa fa-reply"></i> Kembali</a>
						<a href="<?php echo site_url('parameter/rekening/addj');?>" class="btn btn-success"><i class="fa fa-plus"></i> Rekening</a>
                    </div>
                </div>		

			<?php if ($this->session->flashdata('success')) { echo $this->session->flashdata('success');} ?>
            <script>
				var ajax_source_url = '<?php echo site_url($this->uri->segment(1) . '/' . $this->uri->segment(2) . '/detailv'); ?>';
				var ajax_source_field =	  [ { "data": "nomor" },
											{ "data": "akun_nama" },
											{ "data": "kelompok_nama" },
											{ "data": "jenis_nama" },
											{ "data": "obyek_nama" },
											{ "data": "rincian_nama" },
											{ "data": "Actions" } ];
			</script>
			<!-- END PAGE HEADER-->
			<div class="row">
			<div class="col-md-12">
				<div class="panel panel-success">
				<div class="panel-heading"><i class="fa fa-bars"></i> Data Unit Organisasi BLUD</div>
				<div class="panel-body">
						<div class="portlet-body">
							<table class="table table-striped table-bordered table-hover" id="tableUtama">
							<thead>
							<tr>
								<th style="width:25px">No</th>
                                <th class="hidden-xs">Akun</th>
								<th class="hidden-xs" style="text-align:center;">Kelompok</th>
								<th class="hidden-xs" style="text-align:center;">Jenis</th>
								<th class="hidden-xs" style="text-align:center;">Obyek</th>
								<th class="hidden-xs" style="text-align:center;">Rincian Obyek</th>
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
	<a href="#successUpdate" data-toggle="modal"></a>
	<div id="successUpdate" class="modal fade" role="dialog" aria-hidden="true">
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
					<button type="button" class="btn green" data-dismiss="modal">OK</button>
				</div>
			</div>
		</div>
	</div>