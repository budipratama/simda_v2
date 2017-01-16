<!-- BEGIN CONTENT -->
	<div class="page-content-wrapper">
		<div class="page-content">
			<!-- BEGIN PAGE HEADER-->
			<h3 class="page-title">
			Misi Kabupaten Bekasi <small>entri data &amp; informasi detail</small>
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
						<a href="#">Misi</a>
					</li>
				</ul>
			</div>
            <!-- END PAGE HEADER-->
			            
			<div class="row">
				<div class="col-md-12">
                	<div class="portlet" align="right">
                		<a href="<?php echo site_url('pengaturan/misi');?>" class="btn default"><i class="fa fa-times"></i> Bersihkan Hasil Pencarian </a>
                		<a href="<?php echo site_url('pengaturan/misi/add');?>" class="btn green"><i class="fa fa-plus"></i> Tambah Misi </a>
                    </div>
                </div>
            </div>
			<div class="clearfix"></div>
			<?php if ($this->session->flashdata('success')) { echo $this->session->flashdata('success');} ?>
            <script>
				var ajax_source_url = '<?php echo site_url($this->uri->segment(1) . '/' . $this->uri->segment(2) . '/datatable'); ?>';
				var ajax_source_field = [
										{ "data": "nomor" },
										{ "data": "misi" },
										{ "data": "Actions" }
									];
			</script>
			<div class="row">
				<div class="col-md-12">
					<div class="portlet box blue">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-bars"></i>Daftar Misi
							</div>
						</div>
						<div class="portlet-body">
							<table class="table table-striped table-bordered table-hover" id="tableUtama">
							<thead>
							<tr>
								<th style="width:25px">No</th>
                                <th class="hidden-xs">Misi</th>
								<th style="width:105px"></th>
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