<!-- Main Content -->
   <section class="content">
		<h2>Daftar Satuan Kerja Perangkat Daerah (SKPD) <small>entri data &amp; informasi detail</small></h2>  
			<div class="body">
				<ol class="breadcrumb breadcrumb-col-cyan">
					<li><a href="<?php echo site_url('dashboard');?>"><i class="material-icons">home</i> Home</a></li>
					<li><a href="<?php echo site_url('pengaturan');?>"> Control Panel</a></li>
					<li class="active"> SKPD</li>
				</ol>
			</div>
            <!-- Multiple Items To Be Open -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header bg-teal">
						<h2>Control Panel<small>Data SKPD</small></h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
										<li><a href="#" data-toggle="modal" data-target="#addSKPD"><i class="material-icons">add_circle</i> SKPD</a></li>
                                        <li><a href="<?php echo site_url('pengaturan');?>"><i class="material-icons">reply</i> Kembali</a></li>
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
												{ "data": "skpd_nomor" },
												{ "data": "skpd_nama" },
												{ "data": "skpd_pimpinan" },
												{ "data": "Actions" }
											];
										</script>
										<div class="portlet-body">
											<table class="table table-striped table-bordered table-hover" id="tableUtama">
											<thead>
											<tr>
												<th style="width:60px">Urusan</th>
												<th style="width:50px">SKPD</th>
												<th style="text-align:center;">Uraian Nama SKPD</th>
												<th style="text-align:center;">Pimpinan</th>
												<th style="text-align:center; width:130px;">Actions</th>
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
	<a href="#tahunAnggaran" data-toggle="modal"></a>
	<div id="tahunAnggaran" class="modal fade" role="dialog" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
					<h4 class="modal-title">Pilih Tahun Anggaran</h4>
				</div>
				<form action="<?php echo site_url('pengaturan/skpd/cari');?>" class="form-horizontal" method="post">
				<div class="modal-body">
				<div class="col-md-3"></div>
					<div class="col-md-6">
						<?php combobox('db', $tahun, 'tahun', 'tahun', 'tahun', $tahun_, '', 'Tahun Anggaran', 'class="form-control show-tick" data-live-search="true" tabindex="1" required="required"'); ?>
					</div>
				<div class="col-md-3"></div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary waves-effect">OK</button>
				</div>
				</form>
			</div>
		</div>
	</div>	
	<a href="#addSKPD" data-toggle="modal"></a>
	<div id="addSKPD" class="modal fade" role="dialog" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
					<h4 class="modal-title"><center>Tambah SKPD</center></h4><hr>
				</div>
				<form action="<?php echo site_url('pengaturan/skpd/insert');?>" class="form-horizontal" method="post">
				<div class="modal-body">
					<div class="form-body">
						<div class="body">
                            <div class="row clearfix">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
									<div class="col-md-12">
										<p><b>Urusan <span class="required">*</span></b></p>
										<?php combobox('db', $urusan, 'aaa_kode', 'kode', 'urusan', '', '', 'Pilih Urusan', 'class="form-control show-tick" data-live-search="true" tabindex="1" required="required"'); ?>
									</div><br><br><br><br>
								</div>
							</div>
						</div>
						<div class="body">
                            <div class="row clearfix">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
								<div class="col-md-3">
									<div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="skpd_nomor" id="skpd_nomor" placeholder="00" required>
                                        <label class="form-label">Nomor SKPD</label>
                                    </div>
									</div>
                                </div>
								<div class="col-md-9">
									<div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="skpd_nama" id="skpd_nama" required>
                                        <label class="form-label">Nama SKPD</label>
                                    </div>
									</div>
                                </div>
								</div>
							</div>
						</div><br>
						<div class="body">
                            <div class="row clearfix">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
								<div class="col-md-12">
									<div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="skpd_kewenangan" id="skpd_kewenangan" required>
                                        <label class="form-label">Kewenangan</label>
                                    </div>
									</div>
                                </div>
								</div>
							</div>
						</div><br>
						<div class="body">
                            <div class="row clearfix">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
								<div class="col-md-12">
									<div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="skpd_pimpinan" id="skpd_pimpinan" required>
                                        <label class="form-label">Pimpinan</label>
                                    </div>
									</div>
                                </div>
								</div>
							</div>
						</div><br>
						<div class="body">
                            <div class="row clearfix">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
								<div class="col-md-12">
									<div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="skpd_alamat" id="skpd_alamat" required>
                                        <label class="form-label">Alamat</label>
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