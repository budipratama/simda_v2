<!-- Main Content -->
   <section class="content">
		<h2>RKA Murni<small> anggaran belanja langsung</small></h2>  
			<div class="body">
				<ol class="breadcrumb breadcrumb-col-cyan">
					<li><a href="<?php echo site_url('dashboard');?>"><i class="material-icons">home</i> Home</a></li>
					<li><a href="<?php echo site_url('rka/murni');?>"> RKA</a></li>
					<li class="active"> Add RUP Penyedia</li>
				</ol>
			</div>
            <!-- Multiple Items To Be Open -->
			<?php if ($this->session->flashdata('success')) { echo $this->session->flashdata('success');} ?>
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
						<div class="header"><h2>Tambah Rencana Umum Pengadaan <small>Paket Penyedia</small></h2></div>
                        <div class="body">
                            <div class="row clearfix">
							<div class="body">
							<form action="<?php echo site_url('rka/murni/addPenyedia/bl/'.$kode);?>" id="form_validation" enctype="multipart/form-data" method="post">
								<div class="row clearfix">
									<div class="col-md-3">
										<p><b>Tahun <span class="required">*</span></b></p>
										<div class="form-group form-float">
											<div class="form-line">
											<input type="hidden" class="form-control" name="tahun" id="tahun" value="<?php echo $tahun_ ?>">
												<?php combobox('db', $tahun, 'tahun', 'tahun', 'tahun', $tahun_, '', 'Pilih ...', 'class="form-control show-tick" data-live-search="true" tabindex="1" disabled'); ?>
											</div>								
										</div>								
									</div>								
									<div class="col-md-7">
										<p><b>SKPD Pelaksana <span class="required">*</span></b></p>
										<div class="form-group form-float">
											<div class="form-line">
											<input type="hidden" class="form-control" name="skpd_kode" id="skpd_kode" value="<?php echo $skpd_?>">
												<?php combobox('db', $skpd, 'skpd_kode', 'skpd_kode', 'skpd_nama', $skpd_, 'show_form_misi_by_skpd();', 'Pilih SKPD Pelaksana', 'class="select2_category form-control" tabindex="1" disabled'); ?>
											</div>
										</div>
									</div>
								</div>
								<div class="row clearfix">
									<div class="col-md-10">
										<p><b>Nama Kegiatan :</b></p>
										<div class="form-group form-float">
											<div class="form-line">										
												<input type="hidden" name="kegiatan" id="kegiatan" value="<?php echo $kegiatan;?>">
												<input type="text" value="<?php echo $kegiatan; ?>" class="form-control" disabled>
											</div>								
										</div>								
									</div>
								</div>								
								<div class="row clearfix">
									<div class="col-md-10">
										<p><b>Nama Paket Pengadaan :</b></p>
										<div class="form-group form-float">
											<div class="form-line">										
												<?php combobox('db', $paket, 'paket_kode', 'kode', 'rincian_nama', '', '', 'Pilih ..', 'class="form-control show-tick" data-live-search="true" tabindex="1" required="required"');?>
											</div>								
										</div>								
									</div>
								</div>
								<div class="row clearfix">
									<div class="col-md-10">
										<p><b>Lokasi :</b></p>
										<div class="form-group form-float">
											<div class="form-line">										
												<input type="hidden" name="alamat" id="alamat" value="<?php echo $alamat;?>">
												<input type="text" value="<?php echo $alamat;?>" class="form-control" disabled>
											</div>								
										</div>								
									</div>
								</div>
								<div class="row clearfix">
									<div class="col-md-3">
										<p><b>Jenis Belanja :</b></p>
										<div class="form-group form-float">
											<div class="form-line">										
												<?php combobox('db', $belanja, 'belanja_kode', 'kode', 'jenis_nama', '', '', 'Pilih ...', 'class="form-control show-tick" data-live-search="true" tabindex="1" required="required"');?>
											</div>								
										</div>								
									</div>
									<div class="col-md-3">
										<p><b>Jenis Pengadaan :</b></p>
										<div class="form-group form-float">
											<div class="form-line">										
												<?php combobox('db', $pengadaan, 'pengadaan_kode', 'kode', 'jenis_nama', '', '', 'Pilih ...', 'class="form-control show-tick" data-live-search="true" tabindex="1" required="required"');?>
											</div>								
										</div>								
									</div>
									<div class="col-md-4">										
										<div class="form-group form-float">
										<div class="form-line">
											<input type="text" class="form-control" name="volume" id="volume" required="required">
											<label class="form-label">Volume :</label>
										</div>
										</div>								
									</div>
								</div>
								<hr><h4 class="form-section"><b>DANA</b></h4>
								<div class="row clearfix">
									<div class="col-md-3">
										<p><b>Sumber Dana :</b></p>
										<div class="form-group form-float">
											<div class="form-line">										
											<?php combobox('db', $sumber, 'sumber_kode', 'kode', 'jenis_nama', '', '', 'Pilih ...', 'class="form-control show-tick" data-live-search="true" tabindex="1" required="required"');?>
											</div>								
										</div>								
									</div>
									<div class="col-md-3">
										<p><b>Kode DPA :</b></p>
										<div class="form-group form-float">
											<div class="form-line">										
											<input type="text" class="form-control" name="dpa_kode" id="dpa_kode">
											</div>								
										</div>								
									</div>
									<div class="col-md-4">
										<p><b>Pagu :</b></p>
										<div class="form-group form-float">
										<div class="form-line">
											<input type="hidden" name="pagu_kode" id="pagu_kode" value="<?php echo $apbd_kab+$apbd_prov+$apbn+$sumberlain;?>">
											<input type="text" class="form-control" style="text-align:right;" value="<?php echo rupiah1($apbd_kab+$apbd_prov+$apbn+$sumberlain);?>" disabled>
										</div>
										</div>								
									</div>
								</div>
								<hr><h4 class="form-section"><b>PELAKSANAAN PEMILIHAN PENYEDIA</b></h4>
								<div class="row clearfix">
									<div class="col-md-4">
										<p><b>Metode Pemilihan Penyedia :</b></p>
										<div class="form-group form-float">
											<div class="form-line">										
											<?php combobox('db', $metode, 'penyedia_kode', 'kode', 'jenis_nama', '', '', 'Pilih ...', 'class="form-control show-tick" data-live-search="true" tabindex="1" required="required"');?>
											</div>
										</div>
									</div>
									
									<div class="col-md-2">
									<p><b>Awal :</b></p>
										<div class="form-group form-float">
											<div class="input-group input-medium date date-picker" data-date-format="yyyy-mm-dd">
												<input type="text" class="form-control" name="pem_awal" id="pem_awal" required="required" readonly>
												<span class="input-group-btn"><button class="btn default" type="button"><i class="material-icons">today</i></button></span>
											</div>
										</div>
									</div>
									<div class="col-md-2">
									<p><b>Akhir :</b></p>
										<div class="form-group form-float">
											<div class="input-group input-medium date date-picker" data-date-format="yyyy-mm-dd">
												<input type="text" class="form-control" name="pem_akhir" id="pem_akhir" required="required" readonly>
												<span class="input-group-btn"><button class="btn default" type="button"><i class="material-icons">today</i></button></span>
											</div>
										</div>
									</div>
								</div>
								<hr><h4 class="form-section"><b>PELAKSANAAN PEKERJAAN</b></h4>
								<div class="row clearfix">									
									<div class="col-md-2">
									<p><b>Awal :</b></p>
										<div class="form-group form-float">
											<div class="input-group input-medium date date-picker" data-date-format="yyyy-mm-dd">
												<input type="text" class="form-control" name="pek_awal" id="pek_awal" required="required" readonly>
												<span class="input-group-btn"><button class="btn default" type="button"><i class="material-icons">today</i></button></span>
											</div>
										</div>
									</div>
									<div class="col-md-2">
									<p><b>Akhir :</b></p>
										<div class="form-group form-float">
											<div class="input-group input-medium date date-picker" data-date-format="yyyy-mm-dd">
												<input type="text" class="form-control" name="pek_akhir" id="pek_akhir" required="required" readonly>
												<span class="input-group-btn"><button class="btn default" type="button"><i class="material-icons">today</i></button></span>
											</div>
										</div>
									</div>
									<div class="col-md-6">
									<p><b>Catatan :</b></p>
										<div class="form-group form-float">
										<div class="form-line">
											<textarea name="catatan" id= "catatan" cols="30" rows="1" class="form-control no-resize"><?php echo $catatan;?></textarea>
										</div>
										</div>
									</div>
								</div>
								<button class="btn btn-primary waves-effect" type="submit">Transfer Murni</button>
								<a href="#" onClick="history.go(-1); return false;" class="btn btn-default">Batal</a>
                            </form>
							</div>
							</div>
						</div>
					</div>
				</div>
			</div>
	</section>
<!-- #END# Multiple Items To Be Open -->	
  <!-- END CONTENT -->