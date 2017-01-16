<!-- Main Content -->
<?php $query_hasil = $this->db->query("SELECT SUM(rka_sub.total) as totalRKA FROM rka_sub WHERE rka_sub.tipe_kode= '1' AND rka_sub.anggaran_kode='".$id_anggaran."' "); $data_hasil = $query_hasil->result(); foreach($data_hasil as $task){ ?>
<section class="content">
		<h2>Anggaran Kas Murni<small> anggaran belanja langsung</small></h2>  
			<div class="body">
				<ol class="breadcrumb breadcrumb-col-cyan">
					<li><a href="<?php echo site_url('dashboard');?>"><i class="material-icons">home</i> Home</a></li>
					<li><a href="<?php echo site_url('anggaran-kas/murni');?>"> Anggaran Kas</a></li>
					<li class="active"> Laporan</li>
				</ol>
			</div>
            <!-- Multiple Items To Be Open -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
							<p align="center"><b><?php echo strtoupper($skpd);?></b></p>					
							<p class="control-label col-md-10">Program &nbsp;:&nbsp; <?php echo $program;?></p><p align="right"><b>.</b></p>
							<p class="control-label col-md-10">Kegiatan &nbsp;:&nbsp;<?php echo $kegiatan;?></p><p align="right"><b>Jumlah</b></p>
                            <p class="control-label col-md-10">Rekening &nbsp;:&nbsp;<?php echo $akun;?>.<?php echo $kelompok;?>.<?php echo $jenis;?>.<?php echo $obyek;?>.<?php echo $rincian_;?> <?php echo $rincian;?></p><p align="right"><b><?php echo rupiah2($task->totalRKA);?></b></p>						
							<?php } ?>
							<ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <button type="button" class="btn bg-black waves-effect waves-light">ACTIONS</button>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a title="Kembali" href="<?php echo base_url(); ?>anggaran-kas/murni/sub/<?php echo $kode; ?>"><i class="material-icons">reply</i> Kembali</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <div class="row clearfix">
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
									<form action="<?php echo site_url('anggaran-kas/murni/previewa/'.$rka);?>" class="horizontal-form" method="post">
										<div class="form-body">
											<div class="row">
												<input type="input" name="tahun" value="<?php echo $tahun; ?>" />
												<input type="input" name="anggaran_kode" value="<?php echo $id_anggaran; ?>" />
												<input type="input" name="skpd" value="<?php echo $skpd_; ?>" />						
												<input type="input" name="kode" value="<?php echo $kode; ?>" />										
											</div>
										</div><br>
										<p align="center"><b>yang bertandatangan :</b></p>
										<table class="table table-striped table-bordered table-hover">
											<thead><tr>
												<th style="text-align:center;">Nama</th>
												<th style="text-align:center;">Nip</th>
												<th style="text-align:center;">Jabatan</th>
											</tr></thead>
											<?php $query_tim = mysql_query("SELECT * FROM tim_anggaran WHERE tim_anggaran.kode_tim= '4' AND tim_anggaran.skpd = '".$skpd."' GROUP BY tim_anggaran.kode ORDER BY tim_anggaran.kode ASC"); while($row_tim=mysql_fetch_array($query_tim)){ ?>
											<tbody>
												<tr>
												<td><?php echo $row_tim['nama']; ?></a></td>
												<td style="text-align:center;"><?php echo $row_tim['nip']; ?></td>
												<td><?php echo $row_tim['jabatan']; ?></a></td>
												</tr>
											<?php } ?>
											</tbody>
										</table>
										<div class="form-actions">
											<div class="col-md-offset-9">
												<button type="submit" name="cetak" class="btn btn-primary" title="View">Lihat Rekap</button>
												<a href="<?php echo base_url(); ?>anggaran-kas/murni/sub/<?php echo $kode; ?>" class="btn btn-default">Kembali</a>
											</div><br>	
										</div>	
									</form>
								</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Tabs With Custom Animations -->
        </div>
    </section>
<script>
	function show_form_deskel_by_kecamatan(){
		var kecamatan_kode = $('select[name=kecamatan_kode]').val();
		load('anggaran-kas/murni/tampil_combobox_deskel_by_kecamatan2/'+kecamatan_kode, '#tampil_combobox_deskel_by_kecamatan');
	}
</script>