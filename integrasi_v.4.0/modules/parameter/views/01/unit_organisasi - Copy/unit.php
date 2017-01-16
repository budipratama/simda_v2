<!-- Main Content -->
<div class="container-fluid">
<div class="side-body padding-top">
	<h3 class="page-title">Parameter <small> unit organisasi</small></h3>		
		<div class="row">
			<div class="col-xs-12">
				<div class="bs-example">
				<ol class="breadcrumb">
					<li class="active"><i class="fa fa-home"></i> <a href="<?php echo site_url('dashboard');?>">Home</a></li>
					<li class="active"><a href="<?php echo site_url('parameter');?>"> Parameter</a></li>
					<li class="active"><a href="<?php echo site_url('parameter/unit-organisasi');?>"> Unit Organisasi</a></li>
					<li class="active"><a href="<?php echo site_url('parameter/unit-organisasi/unit');?>"> Unit</a></li>
				</ol>
				</div>
			</div>
		</div>
				<div class="col-md-12">
                	<div class="portlet" align="right">
                		<a href="<?php echo site_url('parameter/unit-organisasi');?>" class="btn btn-default"><i class="fa fa-reply"></i> Kembali</a>
						<a href="<?php echo site_url('parameter/unit-organisasi/unitadd');?>" class="btn btn-success"><i class="fa fa-plus"></i> Tambah Unit</a>						
                    </div>
                </div>
			<div class="clearfix"></div>
			<?php if ($this->session->flashdata('success')) { echo $this->session->flashdata('success');} ?>
            <script>
				var ajax_source_url = '<?php echo site_url($this->uri->segment(1) . '/' . $this->uri->segment(2) . '/datatableunit'); ?>';
				var ajax_source_field =   [ { "data": "nomor" },
											{ "data": "bidang_nama" },
											{ "data": "bidang_unit" },
											{ "data": "Actions" } ];
			</script>
			<!-- END PAGE HEADER-->
			<div class="row">
			<div class="col-md-12">
				<div class="panel panel-success">
				<div class="panel-heading"><i class="fa fa-bars"></i> Data Unit</div>
				<div class="panel-body">
						<div class="portlet-body">
							<table class="table table-striped table-bordered table-hover" id="tableUtama">
							<thead>
							<tr>
								<th style="width:25px">No</th>
                                <th class="hidden-xs">Bidang</th>
								<th class="hidden-xs" style="text-align:center;">Unit</th>
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