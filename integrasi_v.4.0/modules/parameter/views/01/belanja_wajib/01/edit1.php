<!-- Main Content -->
            <div class="container-fluid">
                <div class="side-body padding-top">
				<h3 class="page-title">Parameter <small>data umum pemda</small></h3>
				
					<div class="row">
                        <div class="col-xs-12">
							<div class="bs-example">
								<ol class="breadcrumb">
									<li class="active"><i class="fa fa-home"></i> <a href="<?php echo site_url('dashboard');?>">Home</a></li>
									<li class="active"><a href="<?php echo site_url('parameter');?>"> Parameter</a></li>
									<li class="active"><a href="#"> Data Umum Pemda</a></li>
									<li class="active"><a href="#"> Edit</a></li>
								</ol>
							</div>
                        </div>
                    </div>			
					<?php echo validation_errors(); ?>
					<div class="row">
                        <div class="col-xs-12">
                            <div class="card">
                                <h2 class="form-section"><center><b>PEMERINTAH KABUPATEN BEKASI</b></center></h2>
                                <div class="card-body">
							<!-- BEGIN FORM-->
							<form action="<?php echo site_url('parameter/data-umum-pemda/update/'.$kode);?>" class="horizontal-form" method="post">	
								<input type="hidden" name="kode" value="<?php echo $kode; ?>" />							
								<div class="col-md-12">
                                    <div class="row row-example">					
                                        <div class="col-sm-4">
                                            <div class="panel panel-default">
                                                <div class="panel-heading">Pemda</div>
                                                <div class="panel-body">
                                                    <label class="control-label" for="pemda">Nama Pemda: </label>
													<input type="text" class="form-control" name="pemda" id="pemda" value="<?php echo $pemda;?>">
                                                </div>
												<div class="panel-body">
                                                    <label class="control-label" for="ibukota">IbuKota Pemda : </label>
													<input type="text" class="form-control" name="ibukota" id="ibukota" value="<?php echo $ibukota;?>">
                                                </div>
												<div class="panel-body">
                                                    <label class="control-label" for="alamat">Alamat Pemda : </label>
													<input type="text" class="form-control" name="alamat" id="alamat" value="<?php echo $alamat;?>">
                                                </div>
                                            </div>
                                        </div>
										<div class="col-sm-4">
                                            <div class="panel panel-default">
                                                <div class="panel-heading">Kepala Daerah</div>
                                                <div class="panel-body">
                                                    <label class="control-label" for="kepala_daerah">Nama : </label>
													<input type="text" class="form-control" name="kepala_daerah" id="kepala_daerah" value="<?php echo $kepala_daerah;?>">
                                                </div>
												<div class="panel-body">
                                                    <label class="control-label" for="jabatan_daerah">Jabatan : </label>
													<input type="text" class="form-control" name="jabatan_daerah" id="jabatan_daerah" value="<?php echo $jabatan_daerah;?>">
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
                                                    <label class="control-label" for="sekretaris_daerah">Nama : </label>
													<input type="text" class="form-control" name="sekretaris_daerah" id="sekretaris_daerah" value="<?php echo $sekretaris_daerah;?>">
                                                </div>
												<div class="panel-body">
                                                    <label class="control-label" for="sekretaris_nip">NIP : </label>
													<input type="text" class="form-control" name="sekretaris_nip" id="sekretaris_nip" value="<?php echo $sekretaris_nip;?>">
                                                </div>
												<div class="panel-body">
                                                    <label class="control-label" for="sekretaris_jabatan">Jabatan : </label>
													<input type="text" class="form-control" name="sekretaris_jabatan" id="sekretaris_jabatan" value="<?php echo $sekretaris_jabatan;?>">
                                                </div>
                                            </div>
                                        </div>
										<div class="col-sm-4">
                                            <div class="panel panel-default">
                                                <div class="panel-heading">Kepala Badan / Bagian Keuangan</div>
                                                <div class="panel-body">
                                                    <label class="control-label" for="kepala_keuangan">Nama : </label>
													<input type="text" class="form-control" name="kepala_keuangan" id="kepala_keuangan" value="<?php echo $kepala_keuangan;?>">
                                                </div>
												<div class="panel-body">
                                                    <label class="control-label" for="keuangan_nip">NIP : </label>
													<input type="text" class="form-control" name="keuangan_nip" id="keuangan_nip" value="<?php echo $keuangan_nip;?>">
                                                </div>
												<div class="panel-body">
                                                    <label class="control-label" for="keuangan_jabatan">Jabatan : </label>
													<input type="text" class="form-control" name="keuangan_jabatan" id="keuangan_jabatan" value="<?php echo $keuangan_jabatan;?>">
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
                                                    <label class="control-label" for="kepala_anggaran">Nama : </label>
													<input type="text" class="form-control" name="kepala_anggaran" id="kepala_anggaran" value="<?php echo $kepala_anggaran;?>">
                                                </div>
												<div class="panel-body">
                                                    <label class="control-label" for="anggaran_nip">NIP : </label>
													<input type="text" class="form-control" name="anggaran_nip" id="anggaran_nip" value="<?php echo $anggaran_nip;?>">
                                                </div>
												<div class="panel-body">
                                                    <label class="control-label" for="anggaran_jabatan">Jabatan : </label>
													<input type="text" class="form-control" name="anggaran_jabatan" id="anggaran_jabatan" value="<?php echo $anggaran_jabatan;?>">
                                                </div>
                                            </div>
                                        </div>
										<div class="col-sm-4">
                                            <div class="panel panel-default">
                                                <div class="panel-heading">Kepala Fungsi Verifikasi</div>
                                                <div class="panel-body">
                                                    <label class="control-label" for="kepala_verifikasi">Nama : </label>
													<input type="text" class="form-control" name="kepala_verifikasi" id="kepala_verifikasi" value="<?php echo $kepala_verifikasi;?>">
                                                </div>
												<div class="panel-body">
                                                    <label class="control-label" for="verifikasi_nip">NIP : </label>
													<input type="text" class="form-control" name="verifikasi_nip" id="verifikasi_nip" value="<?php echo $verifikasi_nip;?>">
                                                </div>
												<div class="panel-body">
                                                    <label class="control-label" for="verifikasi_jabatan">Jabatan : </label>
													<input type="text" class="form-control" name="verifikasi_jabatan" id="verifikasi_jabatan" value="<?php echo $verifikasi_jabatan;?>">
                                                </div>
                                            </div>
                                        </div>
										<div class="col-sm-4">
                                            <div class="panel panel-default">
                                                <div class="panel-heading">Kepala Fungsi Perbendaharaan</div>
                                                <div class="panel-body">
                                                    <label class="control-label" for="kepala_perbendaharaan">Nama : </label>
													<input type="text" class="form-control" name="kepala_perbendaharaan" id="kepala_perbendaharaan" value="<?php echo $kepala_perbendaharaan;?>">
                                                </div>
												<div class="panel-body">
                                                    <label class="control-label" for="perbendaharaan_nip">NIP : </label>
													<input type="text" class="form-control" name="perbendaharaan_nip" id="perbendaharaan_nip" value="<?php echo $perbendaharaan_nip;?>">
                                                </div>
												<div class="panel-body">
                                                    <label class="control-label" for="perbendaharaan_jabatan">Jabatan : </label>
													<input type="text" class="form-control" name="perbendaharaan_jabatan" id="perbendaharaan_jabatan" value="<?php echo $perbendaharaan_jabatan;?>">
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
                                                    <label class="control-label" for="kepala_pembukuan">Nama : </label>
													<input type="text" class="form-control" name="kepala_pembukuan" id="kepala_pembukuan" value="<?php echo $kepala_pembukuan;?>">
                                                </div>
												<div class="panel-body">
                                                    <label class="control-label" for="pembukuan_nip">NIP : </label>
													<input type="text" class="form-control" name="pembukuan_nip" id="pembukuan_nip" value="<?php echo $pembukuan_nip;?>">
                                                </div>
												<div class="panel-body">
                                                    <label class="control-label" for="pembukuan_jabatan">Jabatan : </label>
													<input type="text" class="form-control" name="pembukuan_jabatan" id="pembukuan_jabatan" value="<?php echo $pembukuan_jabatan;?>">
                                                </div>
                                            </div>
                                        </div>
										<div class="col-sm-4">
                                            <div class="panel panel-default">
                                                <div class="panel-heading">Kuasa BUD</div>
                                                <div class="panel-body">
                                                    <label class="control-label" for="kuasa_bud">Nama : </label>
													<input type="text" class="form-control" name="kuasa_bud" id="kuasa_bud" value="<?php echo $kuasa_bud;?>">
                                                </div>
												<div class="panel-body">
                                                    <label class="control-label" for="bud_nip">NIP : </label>
													<input type="text" class="form-control" name="bud_nip" id="bud_nip" value="<?php echo $bud_nip;?>">
                                                </div>
												<div class="panel-body">
                                                    <label class="control-label" for="bud_jabatan">Jabatan : </label>
													<input type="text" class="form-control" name="bud_jabatan" id="bud_jabatan" value="<?php echo $bud_jabatan;?>">
                                                </div>
                                            </div>
                                        </div>
										<div class="col-sm-4">
                                            <div class="panel panel-default">
                                                <div class="panel-heading">Atasan Langsung Kuasa BUD</div>
                                                <div class="panel-body">
                                                    <label class="control-label" for="atasan_bud">Nama : </label>
													<input type="text" class="form-control" name="atasan_bud" id="atasan_bud" value="<?php echo $atasan_bud;?>">
                                                </div>
												<div class="panel-body">
                                                    <label class="control-label" for="atasan_budnip">NIP : </label>
													<input type="text" class="form-control" name="atasan_budnip" id="atasan_budnip" value="<?php echo $atasan_budnip;?>">
                                                </div>
												<div class="panel-body">
                                                    <label class="control-label" for="atasan_budjabatan">Jabatan : </label>
													<input type="text" class="form-control" name="atasan_budjabatan" id="atasan_budjabatan" value="<?php echo $atasan_budjabatan;?>">
                                                </div>
                                            </div>
                                        </div>
									</div>									
									
								<div class="form-actions">
									<div class="row">
										<div class="col-md-6">
											<div class="row">
												<div class="col-md-offset-3 col-md-9">
													<button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Simpan & Ubah Data</button>
													<a href="#" onClick="history.go(-1); return false;" class="btn btn-default"><i class="fa fa-reply"></i> Batal</a>
												</div>
											</div>
										</div>
										<div class="col-md-6"></div>
									</div>
								</div>	
									
							</form>
							<!-- END FORM--> 			
                                </div>
                            </div>
                        </div>
                    </div>
				<!-- END FORM--> 	
					</div>
				</div>
			</div>
<!-- END CONTENT -->