<!-- Main Content -->
   <section class="content">
		<h2>Daftar Indikator per SKPD <small>entri data &amp; informasi detail</small></h2>  
			<div class="body">
				<ol class="breadcrumb breadcrumb-col-cyan">
					<li><a href="<?php echo site_url('dashboard');?>"><i class="material-icons">home</i> Home</a></li>
					<li><a href="<?php echo site_url('pengaturan');?>"> Control Panel</a></li>
					<li class="active"> Indikator per SKPD</li>
				</ol>
			</div>
            <!-- Multiple Items To Be Open -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header bg-teal">
						<h2>Control Panel<small>Data Indikator per SKPD</small></h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
										<li><a href="#" data-toggle="modal" data-target="#addSKPD"><i class="material-icons">add_circle</i> Indikator SKPD</a></li>
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
												{ "data": "nomor" },
												{ "data": "no" },
												{ "data": "skpd_nama" },
												{ "data": "indikator_nama" },
												{ "data": "Actions" }
											];
										</script>
										<div class="portlet-body">
											<table class="table table-striped table-bordered table-hover" id="tableUtama">
											<thead>
											<tr>
												<th style="width:60px">No</th>
												<th style="width:60px">Urusan</th>
												<th style="text-align:center;">SKPD</th>
												<th style="text-align:center;">Indikator</th>
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
				<form action="<?php echo site_url('pengaturan/indikator_skpd/cari');?>" class="form-horizontal" method="post">
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
					<h4 class="modal-title">Tambah Indikator SKPD</h4>
				</div>
				<form action="<?php echo site_url('pengaturan/indikator-skpd/insert');?>" class="form-horizontal" method="post">
				<input type="hidden" name="tahun" value="<?php echo $tahun_;?>">
				<div class="modal-body">
					<div class="form-body">
						<div class="body">
                            <div class="row clearfix">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
									<div class="col-md-6">
									<div class="form-group">
										<p><b>Visi <span class="required">*</span></b></p>
										<?php combobox('db', $visi, 'visi_kode', 'kode', 'visi', '', '', 'Pilih Visi', 'class="form-control show-tick" data-live-search="true" tabindex="1" required="required"'); ?>
									</div>
									</div>
									<div class="col-md-6">
									<div class="form-group">
										<p><b>Misi <span class="required">*</span></b></p>
										<?php combobox('db', $misi, 'misi_kode', 'kode', 'misi', '', 'show_form_tujuan_by_misi();', 'Pilih Misi', 'class="form-control show-tick" data-live-search="true" tabindex="1" required="required"'); ?>
									</div>
									</div>
									<br><br><br><br>
								</div>
							</div>
						</div>
						<div class="body">
                            <div class="row clearfix">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
									<div class="col-md-6">
									<div class="form-group" id="tampil_combobox_tujuan_by_misi">
										<p><b>Tujuan <span class="required">*</span></b></p>
										<select class="form-control show-tick" data-live-search="true" tabindex="1"  name="tujuan_kode" id="tujuan_kode" data-placeholder="Pilih Tujuan" required="required"></select>
									</div>
									</div>
									<div class="col-md-6">
									<div class="form-group" id="tampil_combobox_sasaran_by_tujuan">
										<p><b>Sasaran <span class="required">*</span></b></p>
										<select class="form-control show-tick" data-live-search="true" tabindex="1"  name="tujuan_kode" id="tujuan_kode" data-placeholder="Pilih Tujuan" required="required"></select>
									</div>
									</div>
									<br><br><br><br>
								</div>
							</div>
						</div>
						<div class="body">
                            <div class="row clearfix">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
									<div class="col-md-6">
									<div class="form-group" id="tampil_combobox_indikator_by_sasaran">
										<p><b>Indikator <span class="required">*</span></b></p>
										<select class="form-control show-tick" data-live-search="true" tabindex="1"  name="tujuan_kode" id="tujuan_kode" data-placeholder="Pilih Tujuan" required="required"></select>
									</div>
									</div>
									<div class="col-md-6">
									<div class="form-group">
										<p><b>Urusan <span class="required">*</span></b></p>
										<?php combobox('db', $urusan, 'urusan_kode', 'kode', 'urusan', '', 'show_form_program_by_urusan();', 'Pilih Urusan', 'class="form-control show-tick" data-live-search="true" tabindex="1" required="required"'); ?>
									</div>
									</div>
									<br><br><br><br>
								</div>
							</div>
						</div>
						<div class="body">
                            <div class="row clearfix">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
									<div class="col-md-6">
									<div class="form-group" id="tampil_combobox_program_by_urusan">
										<p><b>Program <span class="required">*</span></b></p>
										<select class="form-control show-tick" data-live-search="true" tabindex="1"  name="tujuan_kode" id="tujuan_kode" data-placeholder="Pilih Tujuan" required="required"></select>
									</div>
									</div>
									<div class="col-md-6">
									<div class="form-group">
										<p><b>SKPD <span class="required">*</span></b></p>
										<?php combobox('db', $skpd, 'skpd_kode', 'skpd_kode', 'skpd_nama', '', '', 'Pilih SKPD', 'class="form-control show-tick" data-live-search="true" tabindex="1" required="required"'); ?>
									</div>
									</div>
									<br><br><br><br>
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
<script>
	function show_form_tujuan_by_misi(){
		var misi_kode = $('select[name=misi_kode]').val();
		load('pengaturan/indikator_skpd/tampil_combobox_tujuan_by_misi/'+misi_kode, '#tampil_combobox_tujuan_by_misi');
		load('pengaturan/indikator_skpd/tampil_combobox_sasaran_by_tujuan/', '#tampil_combobox_sasaran_by_tujuan');
		load('pengaturan/indikator_skpd/tampil_combobox_indikator_by_sasaran/', '#tampil_combobox_indikator_by_sasaran');
		load('pengaturan/indikator_skpd/tampil_combobox_program_by_urusan/', '#tampil_combobox_program_by_urusan');
	}
	
	function show_form_sasaran_by_tujuan(){
		var tujuan_kode = $('select[name=tujuan_kode]').val();
		load('pengaturan/indikator_skpd/tampil_combobox_sasaran_by_tujuan/'+tujuan_kode, '#tampil_combobox_sasaran_by_tujuan');
		load('pengaturan/indikator_skpd/tampil_combobox_indikator_by_sasaran/', '#tampil_combobox_indikator_by_sasaran');
		load('pengaturan/indikator_skpd/tampil_combobox_program_by_urusan/', '#tampil_combobox_program_by_urusan');
	}
	
	function show_form_indikator_by_sasaran(){
		var sasaran_kode = $('select[name=sasaran_kode]').val();
		load('pengaturan/indikator_skpd/tampil_combobox_indikator_by_sasaran/'+sasaran_kode, '#tampil_combobox_indikator_by_sasaran');
		load('pengaturan/indikator_skpd/tampil_combobox_program_by_urusan/', '#tampil_combobox_program_by_urusan');
	}
	
	function show_form_program_by_urusan(){
		var urusan_kode = $('select[name=urusan_kode]').val();
		load('pengaturan/indikator_skpd/tampil_combobox_program_by_urusan/'+urusan_kode, '#tampil_combobox_program_by_urusan');
	}	
</script>