<!-- Main Content -->
   <section class="content">
		<h2>Daftar Urusan <small>entri data &amp; informasi detail</small></h2>  
			<div class="body">
				<ol class="breadcrumb breadcrumb-col-cyan">
					<li><a href="<?php echo site_url('dashboard');?>"><i class="material-icons">home</i> Home</a></li>
					<li><a href="<?php echo site_url('pengaturan');?>"> Control Panel</a></li>
					<li class="active"> Urusan</li>
				</ol>
			</div>
            <!-- Multiple Items To Be Open -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header bg-teal">
						<h2>Control Panel<small>Data Urusan</small></h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
										<li><a href="#" data-toggle="modal" data-target="#addUrusan"><i class="material-icons">add_circle</i> Urusan</a></li>
                                        <li><a href="<?php echo site_url('parameter');?>"><i class="material-icons">reply</i> Kembali</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
						<?php if ($tahun_) { ?>
                        <div class="body">
                            <div class="row clearfix">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <div class="tab-content">
                                        <div role="tabpanel" class="tab-pane animated fadeInRight active" id="home_animation_2">
                                        <b><?php echo validation_errors(); ?><?php if ($this->session->flashdata('success')) { echo $this->session->flashdata('success');} ?></b>
										<script>
											var ajax_source_url = '<?php echo site_url($this->uri->segment(1) . '/' . $this->uri->segment(2) . '/datatable/' . $this->uri->segment(4));?>';
											var ajax_source_field = [
											{ "data": "no" },
											{ "data": "nm_urusan" },
											{ "data": "urusan" },
											{ "data": "Actions" }
											];
										</script>
										<div class="portlet-body">
											<table class="table table-striped table-bordered table-hover" id="tableUtama">
											<thead>
											<tr>
												<th style="width:60px">Urusan</th>
												<th style="text-align:center; width:140px">Jenis Urusan</th>
												<th style="text-align:center;">Uraian Nama Urusan</th>
												<th style="text-align:center; width:120px;">Actions</th>
											</tr>
											</thead>
											<tbody></tbody>
											</table>
										</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
						<?php } ?>
                    </div>
                </div>
            </div>
		<!-- #END# Tabs With Custom Animations -->
    </section>
<!-- END Main Content -->
	<a href="#addUrusan" data-toggle="modal"></a>
	<div id="addUrusan" class="modal fade" role="dialog" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
					<h4 class="modal-title"><center>Tambah Urusan</center></h4><hr>
				</div>
				<form action="<?php echo site_url('pengaturan/urusan/insert');?>" class="form-horizontal" method="post">
				<input type="hidden" name="tahun" value="<?php echo $tahun_;?>">
				<div class="modal-body">
					<div class="form-body">
						<div class="body">
                            <div class="row clearfix">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
									<div class="col-md-6">
										<p><b>Jenis Urusan <span class="required">*</span></b></p>
										<?php combobox('db', $urusan, 'bbb_kode', 'kode', 'nm_urusan', '', '', 'Pilih Urusan', 'class="form-control show-tick" data-live-search="true" tabindex="1" required="required"'); ?>
									</div>
									<div class="col-md-6">
										<p><b>Fungsi <span class="required">*</span></b></p>
											<?php combobox('db', $fungsi, 'fungsi', 'kode', 'nm_fungsi', '', '', 'Pilih Fungsi', 'class="form-control show-tick" data-live-search="true" tabindex="1" required="required"'); ?>
									</div><br><br><br><br><br>
								</div>
							</div>
						</div>
						<div class="body">
                            <div class="row clearfix">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
								<div class="col-md-3">
									<div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="nomor" id="nomor" required>
                                        <label class="form-label">Nomor</label>
                                    </div>
									</div>
                                </div>
								<div class="col-md-9">
									<div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="urusan" id="urusan" required>
                                        <label class="form-label">Nama Urusan</label>
                                    </div>
									</div>
                                </div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary waves-effect">OK</button>
				</div>
				</form>
			</div>
		</div>
	</div>