<!-- Main Content -->
	<section class="content">
		<h2>RKA<small> cetak laporan</small></h2>  
			<div class="body">
				<ol class="breadcrumb breadcrumb-col-cyan">
					<li><a href="<?php echo site_url('dashboard');?>"><i class="material-icons">home</i> Home</a></li>
					<li><a href="<?php echo site_url('laporan');?>"> Laporan</a></li>
				</ol>
			</div>
            <!-- Multiple Items To Be Open -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header bg-pink">
                            <h2>Cetak Laporan<small> Belanja Langsung</small></h2>
                            <ul class="header-dropdown m-r--5">
								<li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="javascript:void(0);">Back</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
						<div class="body">
						<div class="row clearfix">
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<div class="body">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs tab-nav-right" role="tablist">
                                <li role="presentation" class="active"><a href="#home" data-toggle="tab">RKA SKPD 2.2</a></li>
                                <li role="presentation"><a href="#profile" data-toggle="tab">RKA SKPD 2.2.1</a></li>
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade in active" id="home">
                                    <b><?php if ($this->session->flashdata('success')) { echo $this->session->flashdata('success');} ?></b>
									<p><form action="<?php echo site_url('laporan/rka/preview1/'.$kode);?>" id="form_validation" class="horizontal-form" method="post">
										<input type="hidden" name="tahun" value="<?php echo $tahun;?>"/>
										<input type="hidden" name="anggaran_kode" value="<?php echo $kode;?>"/>
										<input type="hidden" name="skpd" value="<?php echo $skpd;?>"/>
										<input type="hidden" name="kode" value="<?php echo $id_kode;?>"/>
										<div class="row">
											<div class="col-md-3">
												<div class="form-group">
													<label class="control-label" for="tanggal">Tanggal Laporan :</label>
													<div class="input-group input-medium date date-picker" data-date-format="yyyy-mm-dd">
														<input type="text" class="form-control" name="tanggal" id="tanggal" value="<?php echo date("Y-m-d");?>" readonly>
														<span class="input-group-btn">
														<button class="btn default" type="button"><i class="material-icons">today</i></button>
														</span>
													</div>
												</div>
											</div>
										</div>
										<h5>Form TandaTangan :</h5><br>
										<div class="row">
											<div class="col-md-6">
												<div class="form-group form-float">
													<div class="form-line">
														<input type="text" class="form-control" name="nama_pimpinan" id="nama_pimpinan" style="text-align:center;" value="<?php echo $nama_tim;?>" required>
														<label class="form-label" for="nama_pimpinan">Nama Pimpinan :</label>
													</div>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<div class="form-group form-float">
													<div class="form-line">
														<input type="text" class="form-control" name="pangkat" id="pangkat" style="text-align:center;" value="<?php echo $jabatan_tim;?>" required>
														<label class="form-label" for="pangkat">Jabatan :</label>
													</div>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<div class="form-group form-float">
													<div class="form-line">
														<input type="text" class="form-control" name="nip" id="nip" style="text-align:center;" value="<?php echo $nip_tim;?>" required>
														<label class="form-label" for="nip">NIP :</label>
													</div>
												</div>
											</div>
										</div>												
										<!--<div class="form-group">
											<div class="col-md-offset-9">
												<button type="submit" class="btn btn-primary waves-effect" name="cetak">Lihat Laporan</button>											
												<a href="<?php echo site_url('laporan');?>" class="btn default">Kembali</a>
											</div>
										</div>-->
									</form></p>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="profile">
                                    <b></b>
                                    <p><form action="<?php echo site_url('laporan/rka/preview2/'.$kode);?>" id="form_validation" class="horizontal-form" method="post">
										<input type="input" name="tahun" value="2017"/>
										<input type="input" name="anggaran_kode" value="<?php echo $kode;?>"/>
										<input type="input" name="kode" value="<?php echo $id_kode;?>"/>
										<div class="row">
											<div class="col-md-3">
												<div class="form-group">
													<label class="control-label" for="tanggal">Tanggal Laporan :</label>
													<div class="input-group input-medium date date-picker" data-date-format="yyyy-mm-dd">
														<input type="text" class="form-control" name="tanggal" id="tanggal" value="<?php echo date("Y-m-d");?>" readonly>
														<span class="input-group-btn">
														<button class="btn default" type="button"><i class="material-icons">today</i></button>
														</span>
													</div>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
											<label class="form-label" for="skpd">SKPD/Kecamatan :</label>
												<div class="form-group form-float">
													<div class="form-line">													
													<?php if ($skpd_aktive == 'yes') { combobox('db', $skpd, 'skpd_kode', 'skpd_kode', 'skpd_nama', '', '', 'Semua SKPD/Kecamatan', 'class="form-control show-tick" data-live-search="true" tabindex="1"');
													} else { 
													echo '<select class="select2_category form-control" name="skpd_kode" id="skpd_kode" data-placeholder="SKPD/Kecamatan" tabindex="1" required="required">
													<option value="'.$skpd_kode.'" selected>'.$skpd_nama.'</option>
													</select>';
													} ?>
													</div>
												</div>
											</div>
										</div>	
										<div class="row">
											<div class="col-md-6">
											<label class="form-label" for="program">Program :</label>
												<div class="form-group form-float">
													<div class="form-line">													
													<!--<?php combobox('db', $skpd, 'skpd_kode', 'skpd_kode', 'skpd_nama', '', '', 'Semua Program', 'class="form-control show-tick" data-live-search="true" tabindex="1"'); ?> -->
													</div>
												</div>
											</div>
										</div>										
										<div class="row">
											<div class="col-md-6">
											<label class="form-label" for="kegiatan">Kegiatan :</label>
												<div class="form-group form-float">
													<div class="form-line">													
														<?php combobox('db', $anggaran, 'kode', 'kode', 'kegiatan', '', '', 'Semua Kegiatan', 'class="form-control show-tick" data-live-search="true" tabindex="1"'); ?> 
													</div>
												</div>
											</div>
										</div>
										
										<h5>Form TandaTangan :</h5><br>
										<div class="row">
											<div class="col-md-6">
												<div class="form-group form-float">
													<div class="form-line">
														<input type="text" class="form-control" name="nama_pimpinan" id="nama_pimpinan" style="text-align:center;" value="<?php echo $nama_tim;?>" required>
														<label class="form-label" for="nama_pimpinan">Nama Pimpinan :</label>
													</div>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<div class="form-group form-float">
													<div class="form-line">
														<input type="text" class="form-control" name="pangkat" id="pangkat" style="text-align:center;" value="<?php echo $jabatan_tim;?>" required>
														<label class="form-label" for="pangkat">Jabatan :</label>
													</div>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<div class="form-group form-float">
													<div class="form-line">
														<input type="text" class="form-control" name="nip" id="nip" style="text-align:center;" value="<?php echo $nip_tim;?>" required>
														<label class="form-label" for="nip">NIP :</label>
													</div>
												</div>
											</div>
										</div>												
										<div class="form-group">
											<div class="col-md-offset-9">
												<button type="submit" class="btn btn-primary waves-effect" name="cetak">Lihat Laporan</button>											
												<a href="<?php echo site_url('laporan');?>" class="btn default">Kembali</a>
											</div>
										</div>
									</form></p>
                                </div>
                            </div>
                        </div>
						</div>
						</div>
						</div>
                    </div>
                </div>
            </div>
            <!-- #END# Tabs With Custom Animations -->
        </div>
    </section>
<!-- END CONTENT -->