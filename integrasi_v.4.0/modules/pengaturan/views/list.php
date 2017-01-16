<!-- Main Content -->
   <section class="content">
		<h2>Control Panel <small>pengaturan &amp; keamanan</small></h2>  
			<div class="body">
				<ol class="breadcrumb breadcrumb-col-cyan">
					<li><a href="<?php echo site_url('dashboard');?>"><i class="material-icons">home</i> Home</a></li>
					<li><a href="<?php echo site_url('pengaturan');?>"> Laporan</a></li>
				</ol>
			</div>
				<div class="panel panel-warning">
					<div class="panel-heading"><i class="fa-lg fa fa-warning"></i> Diharapkan untuk berhati-hati dalam merubah data yang ada dipengaturan ini, karna akan berdampak pada sistem secara keseluruhan.</div>
				</div>
            <!-- Multiple Items To Be Open -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header bg-blue-grey">
                            <h2>
                                Pengaturan <small> Sistem Informasi</small>
                            </h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="<?php echo site_url('dashboard');?>"><i class="material-icons">reply</i> Dashboard</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>                        
						<div class="body">
						<h4>Pengaturan SKPD, Kecamatan &amp; Deskel</h4>                            
                            <a href="<?php echo site_url('pengaturan/skpd');?>" class="icon-btn">
                                <i class="material-icons">account_balance</i>
                                <div>SKPD</div>
							</a>                            
							<a href="<?php echo site_url('pengaturan/kecamatan');?>" class="icon-btn">
								<i class="material-icons">business</i>
								<div>Kecamatan</div>
							</a>                            
                            <a href="<?php echo site_url('pengaturan/deskel');?>" class="icon-btn">
								<i class="material-icons">home</i>
								<div>Deskel</div>
							</a><hr>
                            
                            <h4>Pengaturan Pengguna &amp; Hak Akses</h4>                            
                            <a href="<?php echo site_url('pengaturan/tahun-anggaran');?>" class="icon-btn">
                                <i class="material-icons">event_available</i>
                                <div>Tahun Anggaran</div>
							</a>							
							<a href="<?php echo site_url('pengaturan/waktu-entri');?>" class="icon-btn">
                                <i class="material-icons">av_timer</i>
                                <div>Waktu Entri</div>
							</a>                            
							<a href="<?php echo site_url('pengaturan/pengguna');?>" class="icon-btn">
								<i class="material-icons">account_box</i>
								<div>Pengguna</div>
								<!-- <span class="badge badge-danger"> 2 </span> -->
							</a>                            
                            <a href="<?php echo site_url('pengaturan/kelompok-pengguna');?>" class="icon-btn">
								<i class="material-icons">contacts</i>
								<div>Kelompok</div>
								<!-- <span class="badge badge-danger"> 2 </span> -->
							</a>							
                        	<a href="<?php echo site_url('pengaturan/hak-akses');?>" class="icon-btn">
                                <i class="material-icons">remove_red_eye</i>
                                <div>Hak Akses</div>
                                <!-- <span class="badge badge-success"> 4</span> -->
							</a>								
                            <a href="<?php echo site_url('pengaturan/akses-bidang');?>" class="icon-btn">
                                <i class="material-icons">remove_red_eye</i>
                                <div>Akses Bidang</div>
							</a>                            
                            <a href="<?php echo site_url('pengaturan/menu');?>" class="icon-btn">
                                <i class="material-icons">menu</i>
                                <div>Menu</div>
							</a><hr>
                            
                            <h4>Pengaturan Khusus</h4>                            
                            <a href="<?php echo site_url('pengaturan/visi');?>" class="icon-btn">
                                <i class="material-icons">settings_voice</i>
                                <div>Visi</div>
							</a>                            
							<a href="<?php echo site_url('pengaturan/misi');?>" class="icon-btn">
								<i class="material-icons"> settings_input_svideo</i>
								<div>Misi</div>
								<!-- <span class="badge badge-danger"> 2 </span> -->
							</a>                            
                            <a href="<?php echo site_url('pengaturan/prioritas');?>" class="icon-btn">
								<i class="material-icons">assignment_turned_in</i>
								<div>Prioritas</div>
								<!-- <span class="badge badge-danger"> 2 </span> -->
							</a>							
                        	<a href="<?php echo site_url('pengaturan/tujuan');?>" class="icon-btn">
                                <i class="material-icons">camera</i>
                                <div>Tujuan</div>
                                <!-- <span class="badge badge-success"> 4</span> -->
							</a>								
                            <a href="<?php echo site_url('pengaturan/sasaran');?>" class="icon-btn">
                                <i class="material-icons">filter_tilt_shift</i>
                                <div>Sasaran</div>
							</a>                            
                            <a href="<?php echo site_url('pengaturan/indikator');?>" class="icon-btn">
                                <i class="material-icons">card_travel</i>
                                <div>Indikator</div>
							</a>                            
                            <a href="<?php echo site_url('pengaturan/urusan');?>" class="icon-btn">
                                <i class="material-icons">cloud</i>
                                <div>Urusan</div>
							</a>                            
                            <a href="<?php echo site_url('pengaturan/program');?>" class="icon-btn">
                                <i class="material-icons">import_contacts</i>
                                <div>Program</div>
							</a>                            
                            <a href="<?php echo site_url('pengaturan/program-kegiatan');?>" class="icon-btn">
                                <i class="material-icons">next_week</i>
                                <div>Kegitan</div>
							</a>                            
                            <a href="<?php echo site_url('pengaturan/program-rutin');?>" class="icon-btn">
                                <i class="material-icons">account_balance</i>
                                <div>Anggaran Rutin</div>
							</a>                            
                            <a href="<?php echo site_url('pengaturan/indikator-skpd');?>" class="icon-btn">
                                <i class="material-icons">swap_calls</i>
                                <div>Indikator SKPD</div>
							</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Tabs With Custom Animations -->
        </div>
    </section>