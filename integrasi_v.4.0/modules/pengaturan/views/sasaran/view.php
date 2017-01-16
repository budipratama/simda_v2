<!-- BEGIN CONTENT -->
	<div class="page-content-wrapper">
		<div class="page-content">
			<!-- BEGIN PAGE HEADER-->
			<h3 class="page-title">
			Daftar Sasaran <small>entri data &amp; informasi detail</small>
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
						<a href="#">Sasaran</a>
					</li>
				</ul>
			</div>
            <!-- END PAGE HEADER-->
			            
			<div class="row">
				<div class="col-md-12">
                	<div class="portlet" align="right">
                		<a href="<?php echo site_url('pengaturan/sasaran');?>" class="btn default"><i class="fa fa-times"></i> Bersihkan Hasil Pencarian </a>
                		<a href="<?php echo site_url('pengaturan/sasaran/add');?>" class="btn green"><i class="fa fa-plus"></i> Tambah Sasaran </a>
                    </div>
                </div>
            </div>
			<div class="clearfix"></div>
			<?php if ($this->session->flashdata('success')) { echo $this->session->flashdata('success');} ?>
            <script>
				var ajax_source_url = '<?php echo site_url($this->uri->segment(1) . '/' . $this->uri->segment(2) . '/datatable'); ?>';
				var ajax_source_field = [
										{ "data": "nomor" },
										{ "data": "sasaran" },
										{ "data": "tujuan_nama" },
										{ "data": "Actions" }
									];
			</script>
			<div class="row">
				<div class="col-md-12">
					<div class="portlet box blue">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-bars"></i>Daftar Sasaran
							</div>
						</div>
						<div class="portlet-body">
							<table class="table table-striped table-bordered table-hover" id="tableUtama">
							<thead>
							<tr>
								<th style="width:25px">No</th>
                                <th class="hidden-xs">Sasaran</th>
                                <th class="hidden-xs">Tujuan</th>
								<th style="min-width:110px"></th>
							</tr>
							</thead>
							<tbody>
							<?php 
							if ($grid){
							$no = 1;
							foreach($grid as $row){
							?>
							<tr>
								<td align="center">
									<?php echo $no; ?>
								</td>
                                <td>
									<?php echo $row->sasaran; ?>
								</td>
								<td>
									<?php echo $row->tujuan_nama; ?>
								</td>
								<td>
                                    <a href="<?php echo site_url('pengaturan/sasaran/detail/'.$row->kode); ?>" class="btn default btn-sm purple" title="Detail"><i class="fa fa-file-text"></i></a>
									<a href="<?php echo site_url('pengaturan/sasaran/edit/'.$row->kode); ?>" class="btn default btn-sm yellow" title="Ubah"><i class="fa fa-pencil"></i></a>
                                    <a href="<?php echo site_url('pengaturan/sasaran/delete/'.$row->kode); ?>" class="btn default btn-sm red" data-placement="left" data-toggle="confirmation" data-original-title="Apakah Anda yakin akan menghapus data ini ?"><i class="fa fa-trash-o"></i></a>
								</td>
							</tr>
							<?php 
							$no = $no+1;
							}
							}
							?>
							</tbody>
							</table>
						</div>
					</div>
				</div>
                
			</div>
		</div>
		
	</div>
	<!-- END CONTENT -->