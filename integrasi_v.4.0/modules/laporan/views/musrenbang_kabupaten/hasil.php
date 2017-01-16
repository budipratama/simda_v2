<?php
if ($excel == TRUE){
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment;Filename=Laporan_Musrenbang_Kabupaten_".date("d_m_Y_H_i_s").".xls");
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=Windows-1252">
<title>LAPORAN MUSRENBANG KABUPATEN</title>
<style>
@page {
	margin:0px;
	width:330mm;
	height:215mm;
}
body {
	font-family: Verdana, Geneva, sans-serif;
	font-size: 12px;
}
h1 {
	padding: 0px;
	margin: 0px;
	font-size: 16px;
	text-align: center;
	font-weight:bold;
	padding-bottom:10px;
	margin-top:-10px;
	text-transform:uppercase;
}
h2 {
	padding: 0px;
	margin: 0px;
	font-size: 14px;
	text-align: center;
	font-weight:bold;
	padding-bottom:10px;
	margin-top:-10px;
	text-transform:uppercase;
}
.wrapper {
	padding: 0px 50px 10px 50px;
}
.atasnama td {
	text-align: center;
}
.right_colom {
	padding-left: 400px;
}
.data_colom {
	padding-left: 30px;	 
}
.data_table {
	border-collapse: collapse;
}
.data_table th {
	vertical-align:middle;
	text-align: center;
	font-size: 11px;
	font-weight: bold;
	height: 30px;
	border: 1px  solid #999;
	background:#FF0;
}
.data_table td {
	vertical-align:middle;
	text-align: left;
	font-size: 11px;
	border: 1px  solid #999;
 	padding-left: 5px;
	padding-right: 5px;
	font-family:Tahoma, Geneva, sans-serif;
	height: 20px;
}
td span {
	text-align: left;
	font-size: 11px;
	height: 20px;
 	padding-left: 5px;
	padding-top: 5px;
	text-decoration: underline;
	font-style: italic;
}
.data_table1 {
	border-collapse: collapse;
}
.data_table1 td {
	vertical-align:middle;
	text-align: left;
	font-size: 12px;
	height: 13px;
 	padding-left: 5px;
}
.specialy {
	text-align:center;
}
#catatan {
	float:left;
	width:400px;
	height:60px;
	-webkit-border-radius: 8px;
	-moz-border-radius: 8px;
	border-radius: 8px;
	border:1px #999 solid;
	text-align:left;
	font-weight:bold;
	color:#666;
	padding:5px;
}
@media print {
	.data_table th {
		vertical-align:middle;
		text-align: center;
		font-size: 11px;
		font-weight: bold;
		height: 30px;
		border: 1px  solid #999;
		background-color:#FF0;
	}
}
</style>
</head>

<body>
<table width="1400" height="550" border="0" cellspacing="0" cellpadding="4" align="center" class="wrapper">
<tr>
	<td colspan="3">
	<h2>DAFTAR HASIL MUSRENBANG KABUPATEN TAHUN <?php echo $laporan_tahun;?></h2>
	<h2><?php echo strtoupper($nama_skpd);?><br>KABUPATEN BEKASI</h2>
	</td>
</tr>
<tr>
	<td colspan="3">
	<table width="100%" border="0" cellspacing="0" cellpadding="3" class="data_table">
    <tr style="border-bottom:#999 solid 2px;">
		<th rowspan="3" width="50">No</th>
		<th rowspan="3" width="150">Uraian Urusan, Organisasi, Program, dan Kegiatan</th>
		<th rowspan="3" width="70">Prioritas Daerah</th>
		<th rowspan="3" width="70">Sasaran Daerah</th>
		<th rowspan="3" width="70">Indikator Sasaran</th>
		<th rowspan="3" width="80">Lokasi</th>
		<th colspan="9">Indikator Kerja</th>
		<th colspan="5">Biaya</th>
		<th rowspan="3" width="110">Perkiraan Maju</th>
		<th colspan="3">Keterangan</th>
    </tr>
    <tr style="border-bottom:#999 solid 2px;">
		<th colspan="3">Hasil Program</th>
		<th colspan="3">Keluaran Kegiatan</th>
		<th colspan="3">Hasil Kegiatan</th>
		<th rowspan="2" width="100">APBD Kab./Kota</th>
		<th rowspan="2" width="100">APBD Provinsi</th>
		<th rowspan="2" width="100">APBN</th>
		<th rowspan="2" width="100">Sumber Dana Lainnya</th>
		<th rowspan="2" width="100">Total</th>
		<th rowspan="2" width="100"><?php echo $skpd_status; ?><br>Pengusul</th>
		<th rowspan="2" width="50">Jenis Kegiatan</th>
		<th rowspan="2" width="50">Sumber Kegiatan</th>
    </tr>
    <tr style="border-bottom:#999 solid 2px;">
		<th width="100">Tolak Ukur</th>
		<th width="50">Target</th>
		<th width="50">Satuan</th>
		<th width="100">Tolak Ukur</th>
		<th width="50">Target</th>
		<th width="50">Satuan</th>
		<th width="100">Tolak Ukur</th>
		<th width="50">Target</th>
		<th width="50">Satuan</th>
    </tr>
<?php
$total_apbd 	= 0;
$total_apbdp 	= 0;
$total_apbn 	= 0;
$total_lain 	= 0;
$grand_total 	= 0;
$total_maju 	= 0;

if ($jumlah_data > 0){
	
	$jenis_urusan = array('1'=>'wajib', '2'=>'pilihan');
	$tahapan_kode = '8';
	//Looping jenis urusan
	for ($i=1; $i <= 2; $i++){
		
		$where_jenis['anggaran.tahapan_kode'] = $tahapan_kode;
		$where_jenis['anggaran.tahun'] 	= $laporan_tahun;
		if ($laporan_kecamatan != 'semua'){ $where_jenis['anggaran.kecamatan_kode']	= $laporan_kecamatan; }
		if ($laporan_deskel != 'semua'){ $where_jenis['anggaran.deskel_kode']	= $laporan_deskel; }
		if ($laporan_skpd != 'semua'){ $where_jenis['skpd.skpd_kode'] 	= $laporan_skpd; }
		$where_jenis['urusan.jenis'] 	= $jenis_urusan[$i];
		
		//Cek Jumlah data pada Jenis Urusan
		if ($this->Anggaran_model->count_bl($where_jenis) > 0){
		?>
		<tr style="font-weight:bold; background:#9F0;">
			<td align="center"><?php echo $i;?></td>
			<td colspan="23">URUSAN <?php echo strtoupper($jenis_urusan[$i]);?></td>
		</tr>
			<?php
			//Looping Urusan Berdasarkan Jenis
			foreach ($this->Anggaran_model->grid_all('1', 'urusan.kode as urusan_kode, urusan.nomor as urusan_nomor, urusan.urusan as urusan_nama', 'urusan.nomor', 'ASC', '', '', $where_jenis, '', 'anggaran_bl.urusan_kode') as $row){
				$where_urusan['anggaran.tahapan_kode'] 	= $tahapan_kode;
				$where_urusan['anggaran.tahun'] 	= $laporan_tahun;
				if ($laporan_kecamatan != 'semua'){ $where_urusan['anggaran.kecamatan_kode']= $laporan_kecamatan; }
				if ($laporan_deskel != 'semua'){ $where_urusan['anggaran.deskel_kode']	= $laporan_deskel; }
				if ($laporan_skpd != 'semua'){ $where_urusan['skpd.skpd_kode'] 	= $laporan_skpd; }
				$where_urusan['urusan.kode'] 		= $row->urusan_kode;
				
				//Cek Jumlah data pada Urusan
				if ($this->Anggaran_model->count_bl($where_urusan) > 0){
					?>
					<tr style="font-weight:bold;font-style:italic;">
						<td align="center"><?php echo $i.".".$row->urusan_nomor;?></td>
						<td colspan="23"><?php echo $row->urusan_nama;?></td>
					</tr>
					<?php
				}
				
				//Looping SKPD berdasarkan urusan
				foreach ($this->Anggaran_model->grid_all('1', 'skpd.skpd_kode, skpd.skpd_nomor, skpd.skpd_nama as skpd_nama', 'skpd.skpd_kode', 'ASC', '', '', $where_urusan, '', 'skpd.skpd_kode') as $subrow){
				?>
				<tr style="font-weight:bold; background:#FF0;">
        			<td align="center"><?php echo $i.".".$row->urusan_nomor.".".$subrow->skpd_nomor;?></td>
            		<td colspan="23" style="padding-left:10px;"><?php echo $subrow->skpd_nama;?></td>
        		</tr>
					<?php
					//Cek Urusan rutin SKPD
					if ($this->Skpd_model->count_all(array('skpd_kode'=>$subrow->skpd_kode, 'urusan'=>$row->urusan_kode)) == 1){
						
						$where_skpd_rutin['anggaran.tahapan_kode'] 	= $tahapan_kode;
						$where_skpd_rutin['anggaran.tahun'] 		= $laporan_tahun;
						if ($laporan_kecamatan != 'semua'){ $where_skpd_rutin['anggaran.kecamatan_kode']= $laporan_kecamatan; }
						if ($laporan_deskel != 'semua'){ $where_skpd_rutin['anggaran.deskel_kode']	= $laporan_deskel; }
						$where_skpd_rutin['urusan.kode'] 			= 1;
						$where_skpd_rutin['skpd.skpd_kode'] 		= $subrow->skpd_kode;
						
						//Looping Program berdasarkan SKPD -> Urusan Rutin
						foreach ($this->Anggaran_model->grid_all('1', 'SUM(anggaran_bl.apbd_kab) as subjumlah_apbdkab, SUM(anggaran_bl.apbd_prov) as subjumlah_apbdprov, SUM(anggaran_bl.apbn) as subjumlah_apbn, SUM(anggaran_bl.sumberlain) as subjumlah_lainnya, SUM(anggaran_bl.apbd_kab+anggaran_bl.apbd_prov+anggaran_bl.apbn+anggaran_bl.sumberlain) as subjumlah_total, SUM(anggaran_bl.perkiraan_maju) as subjumlah_maju, program.kode as program_kode, program.nomor as program_nomor, program.program as program_nama', 'program.nomor', 'ASC', '', '', $where_skpd_rutin, '', 'program.kode') as $subsubrow){
							
							$where_program_rutin['anggaran.tahapan_kode'] 	= $tahapan_kode;
							$where_program_rutin['anggaran.tahun'] 			= $laporan_tahun;
							if ($laporan_kecamatan != 'semua'){ $where_program_rutin['anggaran.kecamatan_kode']= $laporan_kecamatan; }
							if ($laporan_deskel != 'semua'){ $where_program_rutin['anggaran.deskel_kode']	= $laporan_deskel; }
							$where_program_rutin['urusan.kode'] 			= 1;
							$where_program_rutin['skpd.skpd_kode'] 			= $subrow->skpd_kode;
							$where_program_rutin['program.kode'] 			= $subsubrow->program_kode;
							$kegiatan_nomor									= 1;
							
							//Cek Jumlah data pada Program
							if ($this->Anggaran_model->count_bl($where_program_rutin) > 0){
								
								//Penjumlahan total Biaya
								$total_apbd		= $total_apbd + $subsubrow->subjumlah_apbdkab;
								$total_apbdp	= $total_apbdp + $subsubrow->subjumlah_apbdprov;
								$total_apbn 	= $total_apbn + $subsubrow->subjumlah_apbn;
								$total_lain 	= $total_lain + $subsubrow->subjumlah_lainnya;
								$grand_total 	= $grand_total + $subsubrow->subjumlah_total;
								$total_maju 	= $total_maju + $subsubrow->subjumlah_maju;
							?>
							<tr style="font-weight:bold; font-style:italic;">
								<td align="center"><?php echo $i.".".$row->urusan_nomor.".".$subrow->skpd_nomor.".".$subsubrow->program_nomor;?></td>
								<td colspan="14" style="padding-left:20px;"><?php echo $subsubrow->program_nama;?></td>
								<td style="text-align:right;"><?php echo rupiah3($subsubrow->subjumlah_apbdkab);?></td>
								<td style="text-align:right;"><?php echo rupiah3($subsubrow->subjumlah_apbdprov);?></td>
								<td style="text-align:right;"><?php echo rupiah3($subsubrow->subjumlah_apbn);?></td>
								<td style="text-align:right;"><?php echo rupiah3($subsubrow->subjumlah_lainnya);?></td>
								<td style="text-align:right;"><?php echo rupiah3($subsubrow->subjumlah_total);?></td>
								<td style="text-align:right;"><?php echo rupiah3($subsubrow->subjumlah_maju);?></td>
								<td colspan="3"></td>
							</tr>
							<?php
							} //endif Cek Jumlah data pada Program
							
							//Looping Kegiatan berdasarkan Program  -> Urusan Rutin
							foreach ($this->Anggaran_model->grid_all('1', 'anggaran.kegiatan, anggaran.alamat, anggaran_bl.hp_ukur, anggaran_bl.hp_target, anggaran_bl.hp_satuan, anggaran_bl.kh_ukur, anggaran_bl.kh_target, anggaran_bl.kh_satuan, anggaran_bl.hk_ukur, anggaran_bl.hk_target, anggaran_bl.hk_satuan, anggaran_bl.apbd_kab, anggaran_bl.apbd_prov, anggaran_bl.apbn, anggaran_bl.sumberlain, anggaran_bl.perkiraan_maju, sifat.sifat_nama, sumber.sumber_nama, (anggaran_bl.apbd_kab+anggaran_bl.apbd_prov+anggaran_bl.apbn+anggaran_bl.sumberlain) as rencana_total, skpd.skpd_nama as skpd_nama, urusan.urusan as urusan_nama, sasaran.sasaran as sasaran_nama, prioritas.prioritas as prioritas_nama, program.program as program_nama, indikator.indikator as indikator_nama', 'anggaran.kegiatan', 'ASC', '', '', $where_program_rutin, '', 'anggaran.kode') as $kegiatanrow){
							if ($kegiatan_nomor < 10) {
								$kegiatan_nomor = "0".$kegiatan_nomor;
							} else {
								$kegiatan_nomor = $kegiatan_nomor;
							}
							
							?>
							<tr>
								<td align="center"><?php echo $i.".".$row->urusan_nomor.".".$subrow->skpd_nomor.".".$subsubrow->program_nomor.".".$kegiatan_nomor;?></td>
                                <td style="padding-left:25px;"><?php echo $kegiatanrow->kegiatan;?></td>
                                <td><?php echo $kegiatanrow->prioritas_nama;?></td>
                                <td><?php echo $kegiatanrow->sasaran_nama;?></td>
                                <td><?php echo $kegiatanrow->indikator_nama;?></td>
                                <td><?php echo $kegiatanrow->alamat;?></td>
                                <td style="text-align:center;"><?php echo $kegiatanrow->hp_ukur;?></td>
                                <td style="text-align:center;"><?php echo $kegiatanrow->hp_target;?></td>
                                <td><?php echo $kegiatanrow->hp_satuan;?></td>
                                <td style="text-align:center;"><?php echo $kegiatanrow->kh_ukur;?></td>
                                <td style="text-align:center;"><?php echo $kegiatanrow->kh_target;?></td>
                                <td><?php echo $kegiatanrow->kh_satuan;?></td>
                                <td style="text-align:center;"><?php echo $kegiatanrow->hk_ukur;?></td>
                                <td style="text-align:center;"><?php echo $kegiatanrow->hk_target;?></td>
                                <td><?php echo $kegiatanrow->hk_satuan;?></td>
                                <td style="text-align:right;"><?php echo rupiah3($kegiatanrow->apbd_kab);?></td>
                                <td style="text-align:right;"><?php echo rupiah3($kegiatanrow->apbd_prov);?></td>
                                <td style="text-align:right;"><?php echo rupiah3($kegiatanrow->apbn);?></td>
                                <td style="text-align:right;"><?php echo rupiah3($kegiatanrow->sumberlain);?></td>
                                <td style="text-align:right;"><?php echo rupiah3($kegiatanrow->rencana_total);?></td>
                                <td style="text-align:right;"><?php echo rupiah3($kegiatanrow->perkiraan_maju);?></td>
                                <td><?php echo $kegiatanrow->skpd_nama;?></td>
                                <td><?php echo $kegiatanrow->sifat_nama;?></td>
                                <td><?php echo $kegiatanrow->sumber_nama;?></td>
							</tr>
							
							<?php			
							$kegiatan_nomor++;
							
							} //endforeach Looping Kegiatan berdasarkan Program  -> Urusan Rutin
						} //endforeach Looping Program berdasarkan SKPD  -> Urusan Rutin
					} //endif Cek Urusan rutin SKPD
					
					$where_skpd['anggaran.tahapan_kode']	= $tahapan_kode;
					$where_skpd['anggaran.tahun'] 			= $laporan_tahun;
					if ($laporan_kecamatan != 'semua'){ $where_skpd['anggaran.kecamatan_kode']	= $laporan_kecamatan; }
					if ($laporan_deskel != 'semua'){ $where_skpd['anggaran.deskel_kode']		= $laporan_deskel; }
					$where_skpd['urusan.kode']				= $row->urusan_kode;
					$where_skpd['anggaran.skpd_kode'] 		= $subrow->skpd_kode;
					
					//Looping Program berdasarkan SKPD
					foreach ($this->Anggaran_model->grid_all('1', 'SUM(anggaran_bl.apbd_kab) as subjumlah_apbdkab, SUM(anggaran_bl.apbd_prov) as subjumlah_apbdprov, SUM(anggaran_bl.apbn) as subjumlah_apbn, SUM(anggaran_bl.sumberlain) as subjumlah_lainnya, SUM(anggaran_bl.apbd_kab+anggaran_bl.apbd_prov+anggaran_bl.apbn+anggaran_bl.sumberlain) as subjumlah_total, SUM(anggaran_bl.perkiraan_maju) as subjumlah_maju, program.kode as program_kode, program.nomor as program_nomor, program.program as program_nama', 'program.nomor', 'ASC', '', '', $where_skpd, '', 'anggaran_bl.program_kode') as $subsubrow){
						
						$where_program['anggaran.tahapan_kode']	= $tahapan_kode;
						$where_program['anggaran.tahun'] 		= $laporan_tahun;
						if ($laporan_kecamatan != 'semua'){ $where_program['anggaran.kecamatan_kode']= $laporan_kecamatan; }
						if ($laporan_deskel != 'semua'){ $where_program['anggaran.deskel_kode']	= $laporan_deskel; }
						$where_program['urusan.kode'] 			= $row->urusan_kode;
						$where_program['anggaran.skpd_kode'] 	= $subrow->skpd_kode;
						$where_program['program.kode'] 			= $subsubrow->program_kode;
						$kegiatan_nomor								= 1;
						
						//Cek Jumlah data pada Program
						if ($this->Anggaran_model->count_bl($where_program) > 0){
							
							//Penjumlahan total Biaya
							$total_apbd		= $total_apbd + $subsubrow->subjumlah_apbdkab;
							$total_apbdp	= $total_apbdp + $subsubrow->subjumlah_apbdprov;
							$total_apbn 	= $total_apbn + $subsubrow->subjumlah_apbn;
							$total_lain 	= $total_lain + $subsubrow->subjumlah_lainnya;
							$grand_total 	= $grand_total + $subsubrow->subjumlah_total;
							$total_maju 	= $total_maju + $subsubrow->subjumlah_maju;
							?>
							<tr style="font-weight:bold; font-style:italic;">
								<td align="center"><?php echo $i.".".$row->urusan_nomor.".".$subrow->skpd_nomor.".".$subsubrow->program_nomor;?></td>
									<td colspan="14" style="padding-left:20px;"><?php echo $subsubrow->program_nama;?></td>
									<td style="text-align:right;"><?php echo rupiah3($subsubrow->subjumlah_apbdkab);?></td>
									<td style="text-align:right;"><?php echo rupiah3($subsubrow->subjumlah_apbdprov);?></td>
									<td style="text-align:right;"><?php echo rupiah3($subsubrow->subjumlah_apbn);?></td>
									<td style="text-align:right;"><?php echo rupiah3($subsubrow->subjumlah_lainnya);?></td>
									<td style="text-align:right;"><?php echo rupiah3($subsubrow->subjumlah_total);?></td>
									<td style="text-align:right;"><?php echo rupiah3($subsubrow->subjumlah_maju);?></td>
									<td colspan="3"></td>
							</tr>
						<?php 
						} //endif Cek Jumlah data pada Program
						
						//Looping Kegiatan berdasarkan Program
						foreach ($this->Anggaran_model->grid_all('1', 'anggaran.kegiatan, anggaran.alamat, anggaran_bl.hp_ukur, anggaran_bl.hp_target, anggaran_bl.hp_satuan, anggaran_bl.kh_ukur, anggaran_bl.kh_target, anggaran_bl.kh_satuan, anggaran_bl.hk_ukur, anggaran_bl.hk_target, anggaran_bl.hk_satuan, anggaran_bl.apbd_kab, anggaran_bl.apbd_prov, anggaran_bl.apbn, anggaran_bl.sumberlain, anggaran_bl.perkiraan_maju, sifat.sifat_nama, sumber.sumber_nama, (anggaran_bl.apbd_kab+anggaran_bl.apbd_prov+anggaran_bl.apbn+anggaran_bl.sumberlain) as rencana_total, skpd.skpd_nama as skpd_nama, urusan.urusan as urusan_nama, sasaran.sasaran as sasaran_nama, prioritas.prioritas as prioritas_nama, program.program as program_nama, indikator.indikator as indikator_nama', 'anggaran.kegiatan', 'ASC', '', '', $where_program, '', 'anggaran.kode') as $kegiatanrow){
						if ($kegiatan_nomor < 10) {
							$kegiatan_nomor = "0".$kegiatan_nomor;
						} else {
							$kegiatan_nomor = $kegiatan_nomor;
						}
						?>
						<tr>
							<td align="center"><?php echo $i.".".$row->urusan_nomor.".".$subrow->skpd_nomor.".".$subsubrow->program_nomor.".".$kegiatan_nomor;?></td>
                            <td style="padding-left:25px;"><?php echo $kegiatanrow->kegiatan;?></td>
                            <td><?php echo $kegiatanrow->prioritas_nama;?></td>
                            <td><?php echo $kegiatanrow->sasaran_nama;?></td>
                            <td><?php echo $kegiatanrow->indikator_nama;?></td>
                            <td><?php echo $kegiatanrow->alamat;?></td>
                            <td style="text-align:center;"><?php echo $kegiatanrow->hp_ukur;?></td>
                            <td style="text-align:center;"><?php echo $kegiatanrow->hp_target;?></td>
                            <td><?php echo $kegiatanrow->hp_satuan;?></td>
                            <td style="text-align:center;"><?php echo $kegiatanrow->kh_ukur;?></td>
                            <td style="text-align:center;"><?php echo $kegiatanrow->kh_target;?></td>
                            <td><?php echo $kegiatanrow->kh_satuan;?></td>
                            <td style="text-align:center;"><?php echo $kegiatanrow->hk_ukur;?></td>
                            <td style="text-align:center;"><?php echo $kegiatanrow->hk_target;?></td>
                            <td><?php echo $kegiatanrow->hk_satuan;?></td>
                            <td style="text-align:right;"><?php echo rupiah3($kegiatanrow->apbd_kab);?></td>
                            <td style="text-align:right;"><?php echo rupiah3($kegiatanrow->apbd_prov);?></td>
                            <td style="text-align:right;"><?php echo rupiah3($kegiatanrow->apbn);?></td>
                            <td style="text-align:right;"><?php echo rupiah3($kegiatanrow->sumberlain);?></td>
                            <td style="text-align:right;"><?php echo rupiah3($kegiatanrow->rencana_total);?></td>
                            <td style="text-align:right;"><?php echo rupiah3($kegiatanrow->perkiraan_maju);?></td>
                            <td><?php echo $kegiatanrow->skpd_nama;?></td>
                            <td><?php echo $kegiatanrow->sifat_nama;?></td>
                            <td><?php echo $kegiatanrow->sumber_nama;?></td>
						</tr>
						<?php			
						$kegiatan_nomor++;
						} //endforeach Looping Kegiatan berdasarkan Program
					} //endforeach Looping Program berdasarkan SKPD
				} //endforeach Looping SKPD berdasarkan urusan
			} //endforeach Looping Urusan
		} //endif Jumlah data pada Jenis Urusan
	} //endfor akhir looping jenis
} else {
?>
	<tr style="font-weight:bold; background:#9F0;">
		<td colspan="23" align="center">Belum ada data.</td>
	</tr>
<?php
}
?>
	<tr style="font-weight:bold;font-size:14px;">
    	<th colspan="15" align="center">TOTAL</th>
        <th style="text-align:right;"><?php echo rupiah3($total_apbd);?></th>
        <th style="text-align:right;"><?php echo rupiah3($total_apbdp);?></th>
        <th style="text-align:right;"><?php echo rupiah3($total_apbn);?></th>
        <th style="text-align:right;"><?php echo rupiah3($total_lain);?></th>
        <th style="text-align:right;"><?php echo rupiah3($grand_total);?></th>
        <th style="text-align:right;"><?php echo rupiah3($total_maju);?></th>
        <th colspan="3"></th>
    </tr>
	</table>
    </td>
    </tr>
    <tr>
        <td colspan="3" height="50"></td>
	</tr>
    <tr>
    <td colspan="3">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      	<col style=" width: 10%;" />
        <col style=" width: 23%;" />
        <col style=" width: 34%;" />
        <col style=" width: 30%;" />
      <tr>      	
        <td width="10%">&nbsp;</td>
        <td width="23%">&nbsp;</td>
        <td width="35%">&nbsp;</td>
        <td width="30%">&nbsp;</td>
      </tr>
	</td>
	<tr>
        <td colspan="3" rowspan="3"></td>
        <td style="text-align:left;">Bekasi, <?php echo dateIndo($laporan_tanggal); ?><br />
		</td>
      </tr>
      <tr style="height:40px;">
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td style="text-align:left;"><strong style="text-decoration:underline;"><?php echo $laporan_pimpinan;?></strong><br /><?php echo $laporan_pangkat;?><br />NIP : <?php echo $laporan_nip;?></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td style="text-align:center;">&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td colspan="4">&nbsp;</td>
        </tr>
    </table>
    </td>
    </tr>	
  <tr>
    <td colspan="3">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      	<col style=" width: 10%;" />
        <col style=" width: 23%;" />
        <col style=" width: 34%;" />
        <col style=" width: 30%;" />
      <tr>      	
        <td width="10%">&nbsp;</td>
        <td width="23%">&nbsp;</td>
        <td width="35%">&nbsp;</td>
        <td width="30%">&nbsp;</td>
      </tr>
      <tr>
        <td colspan="3" rowspan="3">&nbsp;</td>
        <td style="text-align:center;">&nbsp;</td>
      </tr>
      <tr style="height:40px;">
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td style="text-align:center;">&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td style="text-align:center;">&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td colspan="4">&nbsp;</td>
        </tr>
    </table></td>
    </tr>
  <tr>
    <td colspan="3"></td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</td></tr></table>
</body>
</html>