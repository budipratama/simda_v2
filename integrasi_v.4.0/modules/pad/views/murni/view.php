<!-- Main Content -->   
   <section class="content">
		<h2>Pendapatan Asli Daerah Murni<small> entri data &amp; informasi detail</small></h2>  
			<div class="body">
				<ol class="breadcrumb breadcrumb-col-cyan">
					<li><a href="<?php echo site_url('dashboard');?>"><i class="material-icons">home</i> Home</a></li>
					<li><a href="<?php echo site_url('pad/murni');?>"> PAD</a></li>
					<li class="active"> Murni</li>
				</ol>
			</div>	
            <!-- Multiple Items To Be Open -->
			<?php if ($this->session->flashdata('success')) { echo $this->session->flashdata('success');} ?>
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="body">
                            <div class="row clearfix">
								<div class="panel-heading" role="tab" id="headingOne_19" data-toggle="tooltip" data-placement="top" title="Form Pencairan">
									<h4 class="panel-title">
									<a href="<?php echo site_url('pad/murni');?>">
									<p class="col-cyan"><i class="material-icons">perm_contact_calendar</i> Form Pencairan</a></p>
									</h4>
								</div>
							<div id="collapseOne_19" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne_19">
							<div class="body" style="<?php echo (isset($formCari)?'display:none;':'')?>">
								<form action="<?php echo site_url('pad/murni/cari');?>" class="form-horizontal" method="post">
									<div id="form" class="row clearfix">
										<div class="col-md-3">
											<p><b>Tahun <span class="required">*</span></b></p>
											<?php combobox('db', $tahun, 'tahun', 'tahun', 'tahun', $tahun_, '', 'Pilih Tahun Anggaran', 'class="form-control show-tick" data-live-search="true" tabindex="1" required="required"'); ?>
										</div>
										<div class="col-md-3">
											<p><b>SKPD Pelaksana</b></p>
											<?php if ($skpd_aktive == 'yes') { combobox('db', $skpd, 'skpd_kode', 'skpd_kode', 'skpd_nama', $skpd_, '', 'Semua SKPD Pelaksana', 'class="form-control show-tick" data-live-search="true" tabindex="1"'); 
											} else { 
											echo '<select class="form-control show-tick" name="skpd_kode" id="skpd_kode" data-placeholder="Pilih SKPD Pelaksana" class="form-control show-tick" data-live-search="true" tabindex="1" required="required">
											<option value="'.$skpd_kode.'" selected>'.$skpd_nama.'</option>
											</select>';
											} ?>
										</div>
										<div class="body">
										<div class="col-md-8">
											<div class="form-group form-group-sm">
											<div class="form-line">
											<p><b>Nama Kegiatan</b></p>
												<input type="text" class="form-control" name="kegiatan" id="kegiatan" value="<?php echo $kegiatan_;?>" placeholder="Kegiatan...">
											</div>
											</div>
										</div>
										<div class="col-md-3">
											<p><b>Jenis Belanja</b></p>
											<div class="demo-radio-button">
												<input type="radio" name="tipe_kode" class="with-gap" id="radio_3" value="1" <?php echo ($tipe_ == 1)?'checked':'';?>>
												<label for="radio_3">Belanja Langsung</label>
												<input type="radio" name="tipe_kode" class="with-gap" id="radio_4" value="2" <?php echo ($tipe_ == 2)?'checked':'';?>>
												<label for="radio_4">Belanja Tidak Langsung</label>
											</div>
										</div>
										</div>
									</div>
									<div class="col-md-4"><a class="btn btn-warning btn-circle waves-effect waves-circle waves-float" href="<?php echo site_url('pad/murni');?>" title="Refresh"><i class="material-icons">autorenew</i></a></div>		
									<div id="cari" class="button-demo">
										<button class="btn bg-cyan waves-effect m-b-15" type="button"  onclick="dShow()" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">Tambah PAD</button>
										<button type="submit" class="btn btn-primary waves-effect">CARI</button>
									</div>
								</form>
								<div class="col-md-12">
								<div class="collapse" id="collapseExample">
									<div class="panel-group full-body" id="accordion_18" role="tablist" aria-multiselectable="true">
                                        <div class="panel panel-col-blue-grey">
                                            <div id="collapseOne_18" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne_18">
                                                <div class="panel-body">
                                                    <form action="<?php echo site_url('pad/murni/pad');?>" class="form-horizontal" method="post">
													<div class="row clearfix">
														<div class="col-md-3">
															<p><b>Tahun <span class="required">*</span></b></p>
															<?php combobox('db', $tahun, 'tahun', 'tahun', 'tahun', $tahun_, '', 'Pilih Tahun Anggaran', 'class="form-control show-tick" data-live-search="true" tabindex="1" required="required"'); ?>
														</div>
														<div class="col-md-3">
															<p><b>SKPD Pelaksana <span class="required">*</span></b></p>
															<?php if ($skpd_aktive == 'yes') { combobox('db', $skpd, 'skpd_kode', 'skpd_kode', 'skpd_nama', $skpd_, '', 'Semua SKPD Pelaksana', 'class="form-control show-tick" data-live-search="true" tabindex="1" required="required"'); 
															} else { 
																echo '<select class="form-control show-tick" name="skpd_kode" id="skpd_kode" data-placeholder="Pilih SKPD Pelaksana" class="form-control show-tick" data-live-search="true" tabindex="1" required="required">
																<option value="'.$skpd_kode.'" selected>'.$skpd_nama.'</option>
																</select>';
															} ?>
														</div>
														<div class="col-md-3">
															<p><b>Jenis Belanja <span class="required">*</span></b></p>
															<div class="demo-radio-button">
																<input type="radio" name="tipe_kode" class="with-gap" id="bl" value="1" <?php echo ($tipe_ == 1)?'checked':'';?>>
																<label for="bl">Belanja Langsung</label>
																<input type="radio" name="tipe_kode" class="with-gap" id="btl" value="2" <?php echo ($tipe_ == 2)?'checked':'';?> disabled>
																<label for="btl">Belanja Tidak Langsung</label>
															</div>
														</div>
														<div class="button-demo">
															<button type="submit" class="btn bg-cyan waves-effect m-b-15">SUBMIT</button>
														</div>
													</div>
													</form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
								</div>
								</div>
							</div>
							</div>
							<?php if ($tahun_) { ?>
							<div class="body">
								<script>
								var ajax_source_url = '<?php echo site_url($this->uri->segment(1) . '/' . $this->uri->segment(2) . '/datatable/' . $this->uri->segment(4) . '/' . $this->uri->segment(5) . '/' . $this->uri->segment(6) . '/' . $this->uri->segment(7) . '/' . $this->uri->segment(8) . '/' . $this->uri->segment(9)); ?>';
								var ajax_source_field = [
									{ "data": "id_akun" },
									{ "data": "id_kelompok" },
									{ "data": "id_jenis" },
									{ "data": "id_obyek" },
									{ "data": "id_rincian" },
									{ "data": "nama_rincian" },
									{ "data": "Actions" }
									];
								</script>
							<div class="portlet-body">
								<table class="table table-striped table-bordered table-hover" id="tableUtama">
								<thead>
									<tr>
										<th style="width:40px">Akun</th>
										<th style="width:70px">Kelompok</th>
										<th style="width:40px">Jenis</th>
										<th style="width:45px">Obyek</th>
										<th style="width:55px">Rincian</th>
										<th>Uraian</th>
										<th style="width:80px; text-align:center;">Actions</th>
									</tr>
								</thead>
								<tbody></tbody>
								</table>
							</div>
							</div>
							<?php } else { ?>
							<?php } ?>
							</div>	
						</div>
					</div>
				</div>
			</div>
	</section>
	<a href="#successInsert" data-toggle="modal"></a>
	<div id="successInsert" class="modal fade" role="dialog" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
					<h4 class="modal-title"><strong>Success!</strong> Tambah PAD Murni</h4>
				</div>
				<div class="modal-body">
					 Data <font color="green"><strong>"Pendapatan Asli Daerah"</strong></font> telah berhasil disimpan !</font>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn green" data-dismiss="modal">OK</button>
				</div>
			</div>
		</div>
	</div><a href="#successDelete" data-toggle="modal"></a>
	<div id="successDelete" class="modal fade" role="dialog" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
					<h4 class="modal-title"><strong>Warning!</strong> Hapus PAD Murni</h4>
				</div>
				<div class="modal-body">
					 Data <font color="green"><strong>"Pendapatan Asli Daerah"</strong></font> telah berhasil dihapus !</font>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn green" data-dismiss="modal">OK</button>
				</div>
			</div>
		</div>
	</div>
<!-- #END# Multiple Items To Be Open -->
<script>
	function show_form_deskel_by_kecamatan(){
		var kecamatan_kode = $('select[name=kecamatan_kode]').val();
		load('rka/murni/tampil_combobox_deskel_by_kecamatan/'+kecamatan_kode, '#tampil_combobox_deskel_by_kecamatan');
	}
</script>
<script type="text/javascript"> 
	function dShow()
	{document.getElementById("cari").style.visibility="hidden";
	document.getElementById("form").style.visibility="hidden";}
</script>