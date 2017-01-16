<!-- Main Content -->
   <section class="content">
		<h2>Daftar Program <small>entri data &amp; informasi detail</small></h2>  
			<div class="body">
				<ol class="breadcrumb breadcrumb-col-cyan">
					<li><a href="<?php echo site_url('dashboard');?>"><i class="material-icons">home</i> Home</a></li>
					<li><a href="<?php echo site_url('pengaturan');?>"> Control Panel</a></li>
					<li class="active"> Program</li>
				</ol>
			</div>
            <!-- Multiple Items To Be Open -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header bg-teal">
						<h2>Control Panel<small>Data Program</small></h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
										<li><a href="#" data-toggle="modal" data-target="#addProgram"><i class="material-icons">add_circle</i> Program</a></li>
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
												{ "data": "no_program" },
												{ "data": "program" },
												{ "data": "hasil_program" },
												{ "data": "Actions" }
											];
										</script>
										<div class="portlet-body">
											<table class="table table-striped table-bordered table-hover" id="tableUtama">
											<thead>
											<tr>
												<th style="width:60px">Urusan</th>
												<th style="width:65px">Program</th>
												<th style="text-align:center;">Uraian Nama Program</th>
												<th style="text-align:center;">Hasil Program</th>
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
	<a href="#addProgram" data-toggle="modal"></a>
	<div id="addProgram" class="modal fade" role="dialog" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
					<h4 class="modal-title"><center>Tambah Program</center></h4><hr>
				</div>
				<form action="<?php echo site_url('pengaturan/program/insert');?>" class="form-horizontal" method="post">
				<div class="modal-body">
					<div class="form-body">
						<div class="body">
                            <div class="row clearfix">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
									<div class="col-md-12">
										<p><b>Urusan <span class="required">*</span></b></p>
										<?php combobox('db', $urusan, 'urusan_kode', 'kode', 'urusan', '', '', 'Pilih Urusan', 'class="form-control show-tick" data-live-search="true" tabindex="1" required="required"'); ?>
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
                                        <input type="text" class="form-control" name="nomor" id="nomor" required>
                                        <label class="form-label">Nomor Program</label>
                                    </div>
									</div>
                                </div>
								<div class="col-md-9">
									<div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="program" id="program" required>
                                        <label class="form-label">Nama Program</label>
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
                                        <input type="text" class="form-control" name="hasil_program" id="hasil_program" required>
                                        <label class="form-label">Hasil Program</label>
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