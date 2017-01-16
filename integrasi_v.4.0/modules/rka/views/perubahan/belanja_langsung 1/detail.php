<!-- Main Content -->   
   <section class="content">
		<h2>RKA Perubahan <small> anggaran belanja langsung</small></h2>  
			<div class="body">
				<ol class="breadcrumb breadcrumb-col-blue-grey">
					<li><a href="<?php echo site_url('dashboard');?>"><i class="material-icons">home</i> Home</a></li>
					<li><a href="<?php echo site_url('rka/perubahan');?>"> RKA</a></li>
					<li class="active"> Detail Perubahan</li>
				</ol>
			</div>	
            <!-- Multiple Items To Be Open -->
			<?php if ($this->session->flashdata('success')) { echo $this->session->flashdata('success');} ?>
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
						<div class="header"><h2><b><?php echo strtoupper ($kegiatan);?></b></h2></div>
                        <div class="body">
                            <div class="row clearfix">
							<div class="body">
							<form action="<?php echo site_url('pra-rencana-kerja/insert/bl');?>" id="form_validation" enctype="multipart/form-data" method="POST">
								<div class="row clearfix">
									<div class="col-md-3">
										<p><b>Tahun :</b></p>
										<div class="form-group form-float">
											<div class="form-line">										
											<?php echo $tahun;?>
											</div>								
										</div>								
									</div>								
									<div class="col-md-9">
										<p><b>SKPD Pelaksana :</b></p>
										<div class="form-group form-float">
											<div class="form-line">
											<?php echo strtoupper($skpd);?>
											</div>
										</div>
									</div>
								</div>
								<div class="row clearfix">
									<div class="col-md-12">
										<p><b>Visi Kabupaten Bekasi :</b></p>
										<div class="form-group form-float">
											<div class="form-line">										
											<?php echo $visi;?>
											</div>								
										</div>								
									</div>
								</div>
								<div class="row clearfix">
									<div class="col-md-12">
										<p><b>Misi Kabupaten Bekasi :</b></p>
										<div class="form-group form-float">
											<div class="form-line">										
											<?php echo $misi;?>
											</div>								
										</div>								
									</div>
								</div>
								<div class="row clearfix">								
									<div class="col-md-6">
										<p><b>Prioritas Daerah :</b></p>
										<div class="form-group form-float">
											<div class="form-line">										
											<?php echo $prioritas;?>
											</div>								
										</div>								
									</div>
									<div class="col-md-6">
										<p><b>Tujuan Anggaran :</b></p>
										<div class="form-group form-float">
											<div class="form-line">										
											<?php echo $tujuan;?>
											</div>								
										</div>								
									</div>
								</div>								
								<div class="row clearfix">
									<div class="col-md-6">
										<p><b>Sasaran Daerah :</b></p>
										<div class="form-group form-float">
											<div class="form-line">										
											<?php echo $sasaran;?>
											</div>								
										</div>								
									</div>
									<div class="col-md-6">
										<p><b>Indikator Sasaran :</b></p>
										<div class="form-group form-float">
											<div class="form-line">										
											<?php echo $indikator;?>
											</div>								
										</div>								
									</div>									
								</div>
								<div class="row clearfix">
									<div class="col-md-6">
										<p><b>Urusan :</b></p>
										<div class="form-group form-float">
											<div class="form-line">										
											<?php echo $prioritas;?>
											</div>								
										</div>								
									</div>
									<div class="col-md-6">
										<p><b>Program :</b></p>
										<div class="form-group form-float">
											<div class="form-line">										
											<?php echo $program;?>
											</div>								
										</div>								
									</div>									
								</div>
								<div class="row clearfix">
									<div class="col-md-4">
										<p><b>Jenis Kegiatan :</b></p>
										<div class="form-group form-float">
											<div class="form-line">										
											<?php echo $jenis_kegiatan;?>
											</div>								
										</div>								
									</div>
									<div class="col-md-4">
										<p><b>Kesepakatan :</b></p>
										<div class="form-group form-float">
											<div class="form-line">										
											<?php echo $kesepakatan;?>
											</div>								
										</div>								
									</div>
									<div class="col-md-4">
										<p><b>Urutan :</b></p>
										<div class="form-group form-float">
											<div class="form-line">
											<?php echo $urutan;?>
											</div>
										</div>
									</div>
								</div>
							<h3 class="form-section"><b>Indikator Hasil Program</b></h3>
								<div class="row clearfix">
									<div class="col-md-12">
										<p><b>Tolak Ukur :</b></p>
										<div class="form-group form-float">
											<div class="form-line">
											<?php echo $hp_ukur;?>
											</div>
										</div>
									</div>
								</div>
								<div class="row clearfix">
									<div class="col-md-6">
										<p><b>Target :</b></p>
										<div class="form-group form-float">
											<div class="form-line">
											<?php echo $hp_target;?>
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<p><b>Satuan :</b></p>
										<div class="form-group form-float">
											<div class="form-line">
											<?php echo $hp_satuan;?>
											</div>
										</div>
									</div>
								</div>
							<h3 class="form-section"><b>Indikator Keluaran Kegiatan</b></h3>
								<div class="row clearfix">
									<div class="col-md-12">
										<p><b>Tolak Ukur :</b></p>
										<div class="form-group form-float">
											<div class="form-line">
											<?php echo $hp_ukur;?>
											</div>
										</div>
									</div>
								</div>
								<div class="row clearfix">
									<div class="col-md-6">
										<p><b>Target :</b></p>
										<div class="form-group form-float">
											<div class="form-line">
											<?php echo $kh_target;?>
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<p><b>Satuan :</b></p>
										<div class="form-group form-float">
											<div class="form-line">
											<?php echo $kh_satuan;?>
											</div>
										</div>
									</div>
								</div>
							<h3 class="form-section"><b>Indikator Hasil Kegiatan</b></h3>
								<div class="row clearfix">
									<div class="col-md-12">
										<p><b>Tolak Ukur :</b></p>
										<div class="form-group form-float">
											<div class="form-line">
											<?php echo $hk_ukur;?>
											</div>
										</div>
									</div>
								</div>
								<div class="row clearfix">
									<div class="col-md-6">
										<p><b>Target :</b></p>
										<div class="form-group form-float">
											<div class="form-line">
											<?php echo $hk_target;?>
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<p><b>Satuan :</b></p>
										<div class="form-group form-float">
											<div class="form-line">
											<?php echo $hk_satuan;?>
											</div>
										</div>
									</div>
								</div>
							<h3 class="form-section"><b>Asumsi Biaya Pendanaan</b></h3>
								<div class="row clearfix">
									<div class="col-md-4">
										<p><b>APBD Kabupaten :</b></p>
										<div class="form-group form-float">
											<div class="form-line">
											<?php echo rupiah($apbd_kab);?>
											</div>
										</div>
									</div>
									<div class="col-md-4">
										<p><b>APBD Provinsi :</b></p>
										<div class="form-group form-float">
											<div class="form-line">
											<?php echo rupiah($apbd_prov);?>
											</div>
										</div>
									</div>
									<div class="col-md-4">
										<p><b>APBN/PHLN :</b></p>
										<div class="form-group form-float">
											<div class="form-line">
											<?php echo rupiah($apbn);?>
											</div>
										</div>
									</div>									
								</div>
									
								<div class="row clearfix">
									<div class="col-md-4">
										<p><b>Sumber Lainnya :</b></p>
										<div class="form-group form-float">
											<div class="form-line">
											<?php echo rupiah($sumberlain);?>
											</div>
										</div>
									</div>
									<div class="col-md-4">
										<p><b>Total Pendanaan :</b></p>
										<div class="form-group form-float">
											<div class="form-line">
											<?php echo rupiah($apbd_kab + $apbd_prov + $apbn + $sumberlain);?>
											</div>
										</div>
									</div>
									<div class="col-md-4">
										<p><b>Perkiraan Maju :</b></p>
										<div class="form-group form-float">
											<div class="form-line">
											<?php echo rupiah($perkiraan_maju);?>
											</div>
										</div>
									</div>									
								</div>								
								<h3 class="form-section"><b>Lokasi Kegiatan</b></h3>
								<input type="hidden" name="lokasi_kode" value="3">
								<div class="row clearfix">
									<div class="col-md-5">
										<p><b>Kecamatan :</b></p>
										<div class="form-group form-float">
											<div class="form-line">
											<?php if ($kecamatan_kode) { echo $kecamatan; } ?>
											</div>
										</div>
									</div>
									<div class="col-md-5">
										<p><b>Desa/Kelurahan :</b></p>
										<div class="form-group form-float">
											<div class="form-line">
											<?php if ($deskel_kode) { echo $deskel; } ?>
											</div>
										</div>
									</div>
									<div class="col-md-1">
										<p><b>RT :</b></p>
										<div class="form-group form-float">
											<div class="form-line">
											<?php echo $rt;?>
											</div>
										</div>
									</div>
									<div class="col-md-1">
										<p><b>RW :</b></p>
										<div class="form-group form-float">
											<div class="form-line">
											<?php echo $rw;?>
											</div>
										</div>
									</div>									
								</div>
								<div class="row clearfix">
									<div class="col-md-12">
										<p><b>Alamat :</b></p>
										<div class="form-group form-float">
											<div class="form-line">
											<?php echo $alamat;?>
											</div>
										</div>
									</div>	
								</div>
								<h3 class="form-section"><b>Data Pendukung</b></h3>
								<div class="row clearfix">
									<div class="col-md-12">
										<p><b>Foto Lokasi : </b></p>
										<div class="form-group form-float">
											<?php foreach($foto as $row){
												echo "<div class=\"col-md-2\"><img src=\"".base_url('/public/uploads/pictures/pra_rencana_kerja/'.$row)."\" style=\"width:100%\" /></div>";
											} ?>
										</div>
									</div>	
								</div>
								<div class="row clearfix">
									<div class="col-md-4">
										<p><b>Latitude, Longitude (Titik Koordinat) :</b></p>
										<div class="form-group form-float">
											<div class="form-line">
											<?php echo $koordinat;?>
											</div>											
										</div>
									</div>	
									<div class="col-md-3">
										<a class="btn btn-danger" href="#mapmodals" data-toggle="modal"><span class="fa fa-map-marker"></span> Lihat Lokasi</a>
									</div>
								</div>
								<div class="row clearfix">
									<div class="col-md-12">
										<p><b>Catatan :</b></p>
										<div class="form-group form-float">
											<div class="form-line">
											<?php echo $catatan;?>
											</div>
										</div>
									</div>	
								</div>
								<a href="#" onClick="history.go(-1); return false;" class="btn btn-default">Kembali</a>									
                            </form>
							</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div id="mapmodals" class="modal fade" role="dialog" aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
									<h4 class="modal-title">Google Maps</h4>
								</div>
								<div class="modal-body">
									 <div id="map-container" style="width:100%;height:420px"></div>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
								</div>
							</div>
						</div>
					</div>
					<!-- END SAMPLE TABLE PORTLET-->
				</div>
			</div>
	</section>
<!-- #END# Multiple Items To Be Open -->	
  <!-- END CONTENT -->