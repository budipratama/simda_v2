<!-- Main Content -->
   <section class="content">
		<h2>Laporan<small> rekap kegiatan & data statistik</small></h2>  
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
                        <div class="header bg-blue-grey">
                            <h2>
                                Laporan <small> Sistem Informasi</small>
                            </h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="javascript:void(0);"><i class="material-icons">reply</i> Kembali</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>                        
						<div class="body">
						<?php 
							if ($admin_log['level_kode'] == 4) { 
							?>
							<h4>Hasil Musrenbang Tingkat Desa dan Kelurahan</h4>
							<a href="<?php echo site_url('laporan/musrenbang-desa');?>" class="icon-btn">
                                <i class="material-icons">account_balance</i>
                                <div>MUSRENBANG DESA</div>
							</a>
							<a href="<?php echo site_url('laporan/musrenbang-kelurahan');?>" class="icon-btn">
								<i class="material-icons">account_balance</i>
                                <div>MUSRENBANG KELURAHAN</div>
							</a><hr>
							
							<h4>Hasil Musrenbang Kecamatan dan Pra Rencana Kerja</h4>
							<a href="<?php echo site_url('laporan/musrenbang-kecamatan');?>" class="icon-btn">
								<i class="material-icons">account_balance</i>
                                <div>MUSRENBANG KECAMATAN</div>
							</a>
							<a href="<?php echo site_url('laporan/pra-rencana-kerja');?>" class="icon-btn">
                                <i class="material-icons">account_balance</i>
                                <div>PRA RENCANA KERJA</div>
							</a><hr>
							
							<h4>Rencana Kerja, Hasil Musrenbang Kabupaten, RKPD dan KUA &amp; PPAS</h4>
							<a href="<?php echo site_url('laporan/rencana-kerja');?>" class="icon-btn">
                                <i class="material-icons">account_balance</i>
                                <div>RENCANA KERJA</div>
							</a>
							<a href="<?php echo site_url('laporan/musrenbang-kabupaten');?>" class="icon-btn">
                                <i class="material-icons">account_balance</i>
                                <div>MUSRENBANG KABUPATEN</div>
							</a>
							<a href="<?php echo site_url('laporan/rkpd');?>" class="icon-btn">
                                <i class="material-icons">account_balance</i>
                                <div>RKPD</div>
							</a>
							<a href="<?php echo site_url('laporan/kua-ppas');?>" class="icon-btn">
                                <i class="material-icons">account_balance</i>
                                <div>KUA & PPAS</div>
							</a>
							<a href="<?php echo site_url('laporan/pra-apbd');?>" class="icon-btn">
                                <i class="material-icons">account_balance</i>
                                <div>PRA APBD KABUPATEN</div>
							</a><hr>
							<?php
							} else if ($admin_log['level_kode'] == 14) { 
							?>
							<h4>Hasil Musrenbang Tingkat Desa</h4>
							<a href="<?php echo site_url('laporan/musrenbang-desa');?>" class="icon-btn">
                                <i class="material-icons">account_balance</i>
                                <div>MUSRENBANG DESA</div>
							</a><hr>
							<?php
							} else if ($admin_log['level_kode'] == 15) { 
							?>
							<h4>Hasil Musrenbang Tingkat Kelurahan</h4>
							<a href="<?php echo site_url('laporan/musrenbang-kelurahan');?>" class="icon-btn">
                                <i class="material-icons">account_balance</i>
                                <div>MUSRENBANG KELURAHAN</div>
							</a><hr>
							<?php
							} else {
							?>
							
							<h4>Hasil Musrenbang Tingkat Desa dan Kelurahan</h4>
							<a href="<?php echo site_url('laporan/musrenbang-desa');?>" class="icon-btn">
                                <i class="material-icons">account_balance</i>
                                <div>MUSRENBANG DESA</div>
							</a>
							<a href="<?php echo site_url('laporan/musrenbang-kelurahan');?>" class="icon-btn">
                                <i class="material-icons">account_balance</i>
                                <div>MUSRENBANG KELURAHAN</div>
							</a><hr>
							
							<h4>Hasil Usulan Masyarakat, Pokok-Pokok Pikiran DPRD, Musrenbang Kecamatan dan Pra Rencana Kerja</h4>
							<a href="<?php echo site_url('laporan/usulan-masyarakat');?>" class="icon-btn">
                                <i class="material-icons">account_balance</i>
                                <div>USULAN MASYARAKAT</div>
							</a>
							<a href="<?php echo site_url('laporan/pokpir-dprd');?>" class="icon-btn">
                                <i class="material-icons">account_balance</i>
                                <div>POKOK PIKIRAN DPRD</div>
							</a>
							<a href="<?php echo site_url('laporan/musrenbang-kecamatan');?>" class="icon-btn">
                                <i class="material-icons">account_balance</i>
                                <div>MUSRENBANG KECAMATAN</div>
							</a>
							<a href="<?php echo site_url('laporan/pra-rencana-kerja');?>" class="icon-btn">
                                <i class="material-icons">account_balance</i>
                                <div>PRA RENCANA KERJA</div>
							</a><hr>
							
							<h4>Rencana Kerja, Hasil Musrenbang Kabupaten, RKPD dan KUA &amp; PPAS</h4>
							<a href="<?php echo site_url('laporan/rencana-kerja');?>" class="icon-btn">
                                <i class="material-icons">account_balance</i>
                                <div>RENCANA KERJA</div>
							</a>
							<a href="<?php echo site_url('laporan/musrenbang-kabupaten');?>" class="icon-btn">
                                <i class="material-icons">account_balance</i>
                                <div>MUSRENBANG KABUPATEN</div>
							</a>
							<a href="<?php echo site_url('laporan/rkpd');?>" class="icon-btn">
                                <i class="material-icons">account_balance</i>
                                <div>RKPD</div>
							</a>
							<a href="<?php echo site_url('laporan/kua-ppas');?>" class="icon-btn">
                                <i class="material-icons">account_balance</i>
                                <div>KUA & PPAS</div>
							</a>
							<a href="<?php echo site_url('laporan/pra-apbd');?>" class="icon-btn">
                                <i class="material-icons">account_balance</i>
                                <div>PRA APBD KABUPATEN</div>
							</a><hr>
							
							<h4>RKA, Anggaran Kas dan DPA</h4>
							<a href="<?php echo site_url('laporan/rka');?>" class="icon-btn">
                                <i class="material-icons">account_balance</i>
                                <div>RKA</div>
							</a>
						<!--<a href="<?php echo site_url('laporan/anggaran-kas');?>" class="icon-btn">
                                <i class="material-icons">account_balance</i>
                                <div>Anggaran Kas</div>
							</a>-->
							<a href="<?php echo site_url('laporan/dpa');?>" class="icon-btn">
                                <i class="material-icons">account_balance</i>
                                <div>DPA</div>
							</a><hr>
							<?php
							}
							?>
							<?php if ($admin_log['level_kode'] == 1) { ?>
							<h4>Rekap Laporan Berdasarkan Kategori </h4>
							<a href="<?php echo site_url('laporan/skpd');?>" class="icon-btn">
                                <i class="material-icons">account_balance</i>
                                <div>SKPD PELAKSANA</div>
							</a>
							<a href="<?php echo site_url('laporan/urusan');?>" class="icon-btn">
                                <i class="material-icons">account_balance</i>
                                <div>URUSAN</div>
							</a>
							<a href="<?php echo site_url('laporan/program');?>" class="icon-btn">
                                <i class="material-icons">account_balance</i>
                                <div>PROGRAM</div>
							</a>
							<a href="<?php echo site_url('laporan/indikator');?>" class="icon-btn">
                                <i class="material-icons">account_balance</i>
                                <div>INDIKATOR SASARAN</div>
							</a>
							<a href="<?php echo site_url('laporan/indikator-belum-terpakai');?>" class="icon-btn">
                                <i class="material-icons">account_balance</i>
                                <div>INDIKATOR BELUM TERPAKAI</div>
							</a>
							<?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Tabs With Custom Animations -->
        </div>
    </section>