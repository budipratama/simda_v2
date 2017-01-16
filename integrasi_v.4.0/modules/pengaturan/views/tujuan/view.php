<!-- BEGIN CONTENT -->
	<div class="page-content-wrapper">
		<div class="page-content">
			<!-- BEGIN PAGE HEADER-->
			<h3 class="page-title">
			Daftar Tujuan <small>entri data &amp; informasi detail</small>
			</h3>
			<div class="page-bar">
				<ul class="page-breadcrumb">
					<li>
						<i class="fa fa-home"></i>
						<a href="<?php echo site_url('dashboard');?>">Home</a>
						<i class="fa fa-angle-right"></i>
					</li>
                    <li>
						<a href="<?php echo site_url('pengaturan');?>">Control Panel</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="#">Tujuan</a>
					</li>
				</ul>
			</div>
            <!-- END PAGE HEADER-->
			            
			<div class="row">
				<div class="col-md-12">
                	<div class="portlet" align="right">
                		<a href="<?php echo site_url('pengaturan/tujuan');?>" class="btn default"><i class="fa fa-times"></i> Bersihkan Hasil Pencarian </a>
                		<a href="<?php echo site_url('pengaturan/tujuan/add');?>" class="btn green"><i class="fa fa-plus"></i> Tambah Tujuan </a>
                    </div>
                </div>
            </div>
			<div class="clearfix"></div>
			<?php if ($this->session->flashdata('success')) { echo $this->session->flashdata('success');} ?>
            <script>
				var ajax_source_url = '<?php echo site_url($this->uri->segment(1) . '/' . $this->uri->segment(2) . '/datatable'); ?>';
				var ajax_source_field = [
										{ "data": "nomor" },
										{ "data": "tujuan" },
										{ "data": "misi_nama" },
										{ "data": "Actions" }
									];
			</script>
			<div class="row">
				<div class="col-md-12">
					<div class="portlet box blue">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-bars"></i>Daftar Tujuan
							</div>
						</div>
						<div class="portlet-body">
							<table class="table table-striped table-bordered table-hover" id="tableUtama">
							<thead>
							<tr>
								<th style="width:25px">No</th>
                                <th class="hidden-xs">Tujuan</th>
                                <th class="hidden-xs">Misi</th>
								<th style="min-width:110px"></th>
							</tr>
							</thead>
							<tbody>
							</tbody>
							</table>
						</div>
					</div>
				</div>
                
			</div>
		</div>
		
	</div>
	<!-- END CONTENT -->