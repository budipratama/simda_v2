<!-- Main Content -->
<div class="container-fluid">
	<div class="side-body padding-top">
		<h3 class="page-title">Daftar Indikator <small>entri data &amp; informasi detail</small></h3>
		<div class="row">
            <div class="col-xs-12">
				<div class="bs-example">
					<ol class="breadcrumb">
						<li class="active"><i class="fa fa-home"></i> <a href="<?php echo site_url('dashboard');?>">Home</a></li>
						<li class="active"><a href="<?php echo site_url('pengaturan');?>">Control Panel</a></li>
						<li class="active"><a href="#">Indikator</a></li>
					</ol>
				</div>
			</div>
        </div>
<!-- END PAGE HEADER-->
			<!-- BEGIN FORM -->
			<div class="row">
				<div class="col-md-12">
                	<div class="portlet" align="right">
                		<a href="<?php echo site_url('pengaturan/indikator');?>" class="btn btn-default"><i class="fa fa-times"></i> Clear </a>
                		<a href="<?php echo site_url('pengaturan/indikator/add');?>" class="btn btn-success"><i class="fa fa-plus"></i> Indikator </a>
                    </div>
                </div>
            </div>
            <div class="panel panel-success">
				<div class="panel-heading"><i class="fa fa-bars"></i> Daftar Indikator</div>
				<div class="panel-body">
				<?php if ($this->session->flashdata('success')) { echo $this->session->flashdata('success');} ?>
            <script>
				var ajax_source_url = '<?php echo site_url('pengaturan/indikator/datatable'); ?>';
				var ajax_source_field = [
										{ "data": "nomor" },
										{ "data": "indikator" },
										{ "data": "sasaran_nama" },
										{ "data": "Actions" }
									];
			</script>
						<div class="portlet-body">
							<table class="table table-striped table-bordered table-hover" id="tableUtama">
							<thead>
							<tr>
								<th style="width:25px">No</th>
                                <th class="hidden-xs">Indikator</th>
                                <th class="hidden-xs">Sasaran</th>
								<th style="min-width:110px"></th>
							</tr>
							</thead>
							<tbody>
							</tbody>
							</table>
						</div>
				</div>
			</div>
			<!-- END SAMPLE TABLE PORTLET-->
	</div>
</div>
<!-- END CONTENT -->