<!-- Main Content -->
   <section class="content">
		<h2>Parameter<small> data umum pemda</small></h2>  
			<div class="body">
				<ol class="breadcrumb breadcrumb-col-cyan">
					<li><a href="<?php echo site_url('dashboard');?>"><i class="material-icons">home</i> Home</a></li>
					<li><a href="<?php echo site_url('parameter');?>"> Parameter</a></li>
					<li class="active"> Data Umum Pemda</li>
				</ol>
			</div>
            <!-- Multiple Items To Be Open -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">                        
						<div class="row">
                        <div class="col-xs-12">
						<h2 class="form-section"><center><b>PEMERINTAH KABUPATEN BEKASI</b></center></h2><br>
							<!-- BEGIN FORM-->
							<form class="form-horizontal" role="form">	
								<div class="col-md-12">
                                    <div class="row row-example">
										<div class="col-sm-3">                                            
                                            <div class="col-md-10">
												<?php 
												foreach($foto as $row){
												echo "<div class=\"col-md-10\"><img src=\"".base_url('/public/dist/img/logo.jpg')."\" style=\"width:150%\" /></div>";
												}
												?>
											</div>
                                                
                                        </div>									
                                        <div class="col-sm-4">
                                            <div class="panel panel-default">
                                                <div class="panel-heading">Pemda</div>
                                                <div class="panel-body">
                                                    <label class="col-md-5" for="pemda">Nama Pemda : </label>
													<label class="col-md-12"><?php echo $pemda;?></label>
                                                </div>
												<div class="panel-body">
                                                    <label class="col-md-5" for="ibukota">IbuKota Pemda : </label>
													<label class="col-md-12"><?php echo $ibukota;?></label>
                                                </div>
												<div class="panel-body">
                                                    <label class="col-md-5" for="alamat">Alamat Pemda : </label>
													<label class="col-md-12"><?php echo $alamat;?></label>
                                                </div>
                                            </div>
                                        </div>
										<div class="col-sm-4">
                                            <div class="panel panel-default">
                                                <div class="panel-heading">Kepala Daerah</div>
                                                <div class="panel-body">
                                                    <label class="col-md-5" for="kepala_daerah">Nama : </label>
													<label class="col-md-12"><?php echo $kepala_daerah;?></label>
                                                </div>
												<div class="panel-body">
                                                    <label class="col-md-5" for="jabatan_daerah">Jabatan : </label>
													<label class="col-md-12"><?php echo $jabatan_daerah;?></label>
                                                </div>
                                            </div>
                                        </div>
									</div>
								
								<div class="sub-title"></div>
                                    <div class="row row-example">
                                        <div class="col-sm-4">
                                            <div class="panel panel-default">
                                                <div class="panel-heading">Sekretaris Daerah</div>
                                                <div class="panel-body">
                                                    <label class="col-md-5" for="sekretaris_daerah">Nama : </label>
													<label class="col-md-12"><?php echo $sekretaris_daerah;?></label>
                                                </div>
												<div class="panel-body">
													<label class="col-md-5" for="sekretaris_nip">NIP : </label>
													<label class="col-md-12"><?php echo $sekretaris_nip;?></label>                                                    
                                                </div>
												<div class="panel-body">
                                                    <label class="col-md-5" for="sekretaris_jabatan">Jabatan : </label>
													<label class="col-md-12"><?php echo $sekretaris_jabatan;?></label>
                                                </div>
                                            </div>
                                        </div>
										<div class="col-sm-4">
                                            <div class="panel panel-default">
                                                <div class="panel-heading">Kepala Badan / Bagian Keuangan</div>
                                                <div class="panel-body">
                                                    <label class="col-md-5" for="kepala_keuangan">Nama : </label>
													<label class="col-md-12"><?php echo $kepala_keuangan;?></label>
                                                </div>
												<div class="panel-body">
                                                    <label class="col-md-5" for="keuangan_nip">NIP : </label>
													<label class="col-md-12"><?php echo $keuangan_nip;?></label>  
                                                </div>
												<div class="panel-body">
                                                    <label class="col-md-5" for="keuangan_nip">Jabatan : </label>
													<label class="col-md-12"><?php echo $keuangan_nip;?></label>
                                                </div>
                                            </div>
                                        </div>
									</div>
								
								<div class="sub-title"></div>
                                    <div class="row row-example">
                                        <div class="col-sm-4">
                                            <div class="panel panel-default">
                                                <div class="panel-heading">Kepala Fungsi Anggaran</div>
                                                <div class="panel-body">
                                                    <label class="col-md-5" for="kepala_anggaran">Nama : </label>
													<label class="col-md-12"><?php echo $kepala_anggaran;?></label>
                                                </div>
												<div class="panel-body">
                                                    <label class="col-md-5" for="anggaran_nip">NIP : </label>
													<label class="col-md-12"><?php echo $anggaran_nip;?></label>  
                                                </div>
												<div class="panel-body">
                                                    <label class="col-md-5" for="anggaran_jabatan">Jabatan : </label>
													<label class="col-md-12"><?php echo $anggaran_jabatan;?></label>
                                                </div>
                                            </div>
                                        </div>
										<div class="col-sm-4">
                                            <div class="panel panel-default">
                                                <div class="panel-heading">Kepala Fungsi Verifikasi</div>
                                                <div class="panel-body">
                                                    <label class="col-md-5" for="kepala_verifikasi">Nama : </label>
													<label class="col-md-12"><?php echo $kepala_verifikasi;?></label>
                                                </div>
												<div class="panel-body">
                                                    <label class="col-md-5" for="verifikasi_nip">NIP : </label>
													<label class="col-md-12"><?php echo $verifikasi_nip;?></label>  
                                                </div>
												<div class="panel-body">
                                                    <label class="col-md-5" for="verifikasi_jabatan">Jabatan : </label>
													<label class="col-md-12"><?php echo $verifikasi_jabatan;?></label>
                                                </div>
                                            </div>
                                        </div>
										<div class="col-sm-4">
                                            <div class="panel panel-default">
                                                <div class="panel-heading">Kepala Fungsi Perbendaharaan</div>
                                                <div class="panel-body">
                                                    <label class="col-md-5" for="kepala_perbendaharaan">Nama : </label>
													<label class="col-md-12"><?php echo $kepala_perbendaharaan;?></label>
                                                </div>
												<div class="panel-body">
                                                    <label class="col-md-5" for="perbendaharaan_nip">NIP : </label>
													<label class="col-md-12"><?php echo $perbendaharaan_nip;?></label>  
                                                </div>
												<div class="panel-body">
                                                    <label class="col-md-5" for="perbendaharaan_jabatan">Jabatan : </label>
													<label class="col-md-12"><?php echo $perbendaharaan_jabatan;?></label>
                                                </div>
                                            </div>
                                        </div>
									</div>

								<div class="sub-title"></div>
                                    <div class="row row-example">
                                        <div class="col-sm-4">
                                            <div class="panel panel-default">
                                                <div class="panel-heading">Kepala Fungsi Pembukuan</div>
                                                <div class="panel-body">
                                                    <label class="col-md-5" for="kepala_pembukuan">Nama : </label>
													<label class="col-md-12"><?php echo $kepala_pembukuan;?></label>
                                                </div>
												<div class="panel-body">
                                                    <label class="col-md-5" for="pembukuan_nip">NIP : </label>
													<label class="col-md-12"><?php echo $pembukuan_nip;?></label>  
                                                </div>
												<div class="panel-body">
                                                    <label class="col-md-5" for="pembukuan_jabatan">Jabatan : </label>
													<label class="col-md-12"><?php echo $pembukuan_jabatan;?></label>
                                                </div>
                                            </div>
                                        </div>
										<div class="col-sm-4">
                                            <div class="panel panel-default">
                                                <div class="panel-heading">Kuasa BUD</div>
                                                <div class="panel-body">
                                                    <label class="col-md-5" for="kuasa_bud">Nama : </label>
													<label class="col-md-12"><?php echo $kuasa_bud;?></label>
                                                </div>
												<div class="panel-body">
                                                    <label class="col-md-5" for="bud_nip">NIP : </label>
													<label class="col-md-12"><?php echo $bud_nip;?></label>  
                                                </div>
												<div class="panel-body">
                                                    <label class="col-md-5" for="bud_jabatan">Jabatan : </label>
													<label class="col-md-12"><?php echo $bud_jabatan;?></label>
                                                </div>
                                            </div>
                                        </div>
										<div class="col-sm-4">
                                            <div class="panel panel-default">
                                                <div class="panel-heading">Atasan Langsung Kuasa BUD</div>
                                                <div class="panel-body">
                                                    <label class="col-md-5" for="atasan_bud">Nama : </label>
													<label class="col-md-12"><?php echo $atasan_bud;?></label>
                                                </div>
												<div class="panel-body">
                                                    <label class="col-md-5" for="atasan_budnip">NIP : </label>
													<label class="col-md-12"><?php echo $atasan_budnip;?></label>  
                                                </div>
												<div class="panel-body">
                                                    <label class="col-md-5" for="atasan_budjabatan">Jabatan : </label>
													<label class="col-md-12"><?php echo $atasan_budjabatan;?></label>
                                                </div>
                                            </div>
                                        </div>
									</div>

									<div class="row">
										<div class="col-md-6">
												<div class="col-md-offset-3 col-md-9">
													<a href="<?php echo site_url('parameter/data-umum-pemda/edit/'.$kode);?>" class="btn btn-success">Ubah</a>														
													<a class="btn btn-default" href="<?php echo site_url('parameter/data-umum-pemda');?>">Kembali</a>
												</div>
										</div>
									</div><br>
								</div>
							</form>
							<!-- END FORM--> 
                    </div>						
                    </div>
                </div>
            </div>
            <!-- #END# Tabs With Custom Animations -->
        </div>
    </section>