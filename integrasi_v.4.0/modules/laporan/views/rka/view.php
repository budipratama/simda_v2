<!-- Main Content --><section class="content">
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
                            <h2>Cetak Laporan<small> RKA SKPD</small></h2>
                            <ul class="header-dropdown m-r--5">
								<li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="<?php echo site_url('laporan');?>">Back</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
						<div class="body">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs tab-nav-right" role="tablist">
                                <li role="presentation" class="active"><a href="#1" data-toggle="tab">RKA SKPD 1</a></li>
                                <li role="presentation"><a href="<?php echo site_url('laporan/rka/v_22');?>">RKA SKPD 2.2</a></li>
                                <li role="presentation"><a href="<?php echo site_url('laporan/rka/v_221');?>">RKA SKPD 2.2.1</a></li>
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade in active" id="1">
                                    <b>Rincian Anggaran Pendapatan</b>
                                    <p>
                                        1
                                    </p>
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
<script>
	function show_form_tahapan_by_skpd(){
		var skpd_kode = $('select[name=skpd_kode]').val();
		load('laporan/rka/tampil_combobox_tahapan_by_skpd/'+skpd_kode, '#tampil_combobox_tahapan_by_skpd');
		load('laporan/rka/tampil_combobox_belanja_by_tahapan/', '#tampil_combobox_belanja_by_tahapan');
		load('laporan/rka/tampil_combobox_tahun_by_belanja/', '#tampil_combobox_tahun_by_belanja');
		load('laporan/rka/tampil_combobox_program_by_tahun/', '#tampil_combobox_program_by_tahun');
		load('laporan/rka/tampil_combobox_kegiatan_by_program/', '#tampil_combobox_kegiatan_by_program');
	}
	
	function show_form_belanja_by_tahapan(){
		var skpd_kode = $('select[name=skpd_kode]').val();
		var kode_tahapan = $('select[name=kode_tahapan]').val();
		load('laporan/rka/tampil_combobox_belanja_by_tahapan/'+skpd_kode+'/'+kode_tahapan, '#tampil_combobox_belanja_by_tahapan');
		load('laporan/rka/tampil_combobox_tahun_by_belanja/', '#tampil_combobox_tahun_by_belanja');
		load('laporan/rka/tampil_combobox_program_by_tahun/', '#tampil_combobox_program_by_tahun');
		load('laporan/rka/tampil_combobox_kegiatan_by_program/', '#tampil_combobox_kegiatan_by_program');
	}
	
	function show_form_tahun_by_belanja(){
		var skpd_kode = $('select[name=skpd_kode]').val();
		var belanja_kode = $('select[name=belanja_kode]').val();
		var kode_tahapan = $('select[name=kode_tahapan]').val();
		load('laporan/rka/tampil_combobox_tahun_by_belanja/'+skpd_kode+'/'+belanja_kode+'/'+kode_tahapan, '#tampil_combobox_tahun_by_belanja');		
		load('laporan/rka/tampil_combobox_program_by_tahun/', '#tampil_combobox_program_by_tahun');
		load('laporan/rka/tampil_combobox_kegiatan_by_program/', '#tampil_combobox_kegiatan_by_program');
	}
	
	function show_form_program_by_tahun(){
		var skpd_kode = $('select[name=skpd_kode]').val();
		var tahun_kode = $('select[name=tahun_kode]').val();
		var belanja_kode = $('select[name=belanja_kode]').val();
		var kode_tahapan = $('select[name=kode_tahapan]').val();
		load('laporan/rka/tampil_combobox_program_by_tahun/'+skpd_kode+'/'+tahun_kode+'/'+belanja_kode+'/'+kode_tahapan, '#tampil_combobox_program_by_tahun');
		load('laporan/rka/tampil_combobox_kegiatan_by_program/', '#tampil_combobox_kegiatan_by_program');
	}
	
	function show_form_kegiatan_by_program(){
		var skpd_kode = $('select[name=skpd_kode]').val();
		var program_kode = $('select[name=program_kode]').val();
		var tahun_kode = $('select[name=tahun_kode]').val();
		var belanja_kode = $('select[name=belanja_kode]').val();
		var kode_tahapan = $('select[name=kode_tahapan]').val();
		load('laporan/rka/tampil_combobox_kegiatan_by_program/'+skpd_kode+'/'+program_kode+'/'+tahun_kode+'/'+belanja_kode+'/'+kode_tahapan, '#tampil_combobox_kegiatan_by_program');
	}
</script>