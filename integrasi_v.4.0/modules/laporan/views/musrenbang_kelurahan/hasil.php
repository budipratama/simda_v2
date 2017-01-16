<?php
if ($excel == TRUE){
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment;Filename=Laporan_Musrenbang_Kelurahan_".date("d_m_Y_H_i_s").".xls");
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=Windows-1252">
<title>LAPORAN MUSRENBANG KELURAHAN</title>
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
	<h2>DAFTAR HASIL MUSRENBANG KELURAHAN TAHUN <?php echo $laporan_tahun;?></h2>
	<h2>KABUPATEN BEKASI</h2>
	</td>
</tr>
<tr>
	<td colspan="3">
	<table width="100%" border="0" cellspacing="0" cellpadding="3" class="data_table">
    <tr style="border-bottom:#999 solid 2px;">
		<th rowspan="2" width="50">No</th>
		<th rowspan="2" width="150">Kegiatan</th>
		<th rowspan="2" width="80">Kecamatan</th>
		<th rowspan="2" width="80">Desa</th>
		<th rowspan="2" width="80">Lokasi</th>
		<th colspan="3">Indikator Hasil Kegiatan</th>
		<th rowspan="2" width="60">Prioritas</th>
		<th rowspan="2" width="150">Asumsi Biaya</th>
    </tr>
    <tr style="border-bottom:#999 solid 2px;">
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

$subtotal_apbd 	= 0;
$subtotal_apbdp = 0;
$subtotal_apbn 	= 0;
$subtotal_lain 	= 0;
$subgrand_total = 0;
$subtotal_maju 	= 0;

if ($jumlah_data > 0){
	
	$tahapan_kode = '3';
	if ($laporan_kecamatan != 'semua'){ $where_kecamatan = " AND anggaran.kecamatan_kode = '$laporan_kecamatan' "; } else { $where_kecamatan = ""; }
	if ($laporan_deskel != 'semua'){ $where_deskel = " AND anggaran.deskel_kode = '$laporan_deskel' "; } else { $where_deskel = ""; }
	if ($laporan_skpd != 'semua'){ $where_skpd = " AND anggaran.pelaksana_kode = '$laporan_skpd' "; } else { $where_skpd = ""; }
						
	$query_kecamatan	= $this->db->query("SELECT SUM(anggaran_bl.apbd_kab) as subjumlah_apbdkab, SUM(anggaran_bl.apbd_prov) as subjumlah_apbdprov, SUM(anggaran_bl.apbn) as subjumlah_apbn, SUM(anggaran_bl.sumberlain) as subjumlah_lainnya, SUM(anggaran_bl.apbd_kab+anggaran_bl.apbd_prov+anggaran_bl.apbn+anggaran_bl.sumberlain) as subjumlah_total, SUM(anggaran_bl.perkiraan_maju) as subjumlah_maju, kecamatan.skpd_kd as kecamatan_kode, kecamatan.skpd_nama as kecamatan_nama
											FROM anggaran 
											LEFT JOIN anggaran_bl ON anggaran.kode=anggaran_bl.anggaran_kode 
											LEFT JOIN skpd kecamatan ON anggaran.kecamatan_kode=kecamatan.skpd_kd
											WHERE anggaran.tahun='".$laporan_tahun."' AND 
												  anggaran.tahapan_kode='".$tahapan_kode."' AND
												  anggaran.tipe_kode='".$laporan_tipe."' 
												  $where_kecamatan $where_deskel $where_skpd 
											GROUP BY anggaran.kecamatan_kode
											ORDER BY kecamatan.skpd_nama ASC");
	
	$jumlah_kecamatan = $query_kecamatan->num_rows();
	$data_kecamatan = $query_kecamatan->result();
	$kecamatan_nomor = 1;
	if ($jumlah_kecamatan > 0){
		foreach($data_kecamatan as $row_kecamatan){
			$total_apbd		= $total_apbd + $row_kecamatan->subjumlah_apbdkab;
			$total_apbdp	= $total_apbdp + $row_kecamatan->subjumlah_apbdprov;
			$total_apbn 	= $total_apbn + $row_kecamatan->subjumlah_apbn;
			$total_lain 	= $total_lain + $row_kecamatan->subjumlah_lainnya;
			$grand_total 	= $grand_total + $row_kecamatan->subjumlah_total;
			$total_maju 	= $total_maju + $row_kecamatan->subjumlah_maju;
			?>
			<tr style="font-weight:bold; background:#FF0;">
				<td align="center"><?php echo $kecamatan_nomor;?></td>
				<td colspan="9" style="padding-left:0px;"><?php echo $row_kecamatan->kecamatan_nama;?></td>
			</tr>
			<?php
			$query_desa	= $this->db->query("SELECT SUM(anggaran_bl.apbd_kab) as subjumlah_apbdkab, SUM(anggaran_bl.apbd_prov) as subjumlah_apbdprov, SUM(anggaran_bl.apbn) as subjumlah_apbn, SUM(anggaran_bl.sumberlain) as subjumlah_lainnya, SUM(anggaran_bl.apbd_kab+anggaran_bl.apbd_prov+anggaran_bl.apbn+anggaran_bl.sumberlain) as subjumlah_total, SUM(anggaran_bl.perkiraan_maju) as subjumlah_maju, desa.skpd_kd as desa_kode, desa.skpd_nama as desa_nama
													FROM anggaran 
													LEFT JOIN anggaran_bl ON anggaran.kode=anggaran_bl.anggaran_kode 
													LEFT JOIN skpd desa ON anggaran.deskel_kode=desa.skpd_kd
													WHERE anggaran.tahun='".$laporan_tahun."' AND 
														  anggaran.tahapan_kode='".$tahapan_kode."' AND
														  anggaran.tipe_kode='1' AND 
														  anggaran.kecamatan_kode='".$row_kecamatan->kecamatan_kode."' $where_kecamatan $where_deskel $where_skpd 
													GROUP BY anggaran.deskel_kode
													ORDER BY desa.skpd_nama ASC");
			
			$jumlah_desa = $query_desa->num_rows();
			$data_desa = $query_desa->result();
			$desa_nomor = 1;
			if ($jumlah_desa > 0){
				foreach($data_desa as $row_desa){
						?>
						<tr style="font-style:italic">
							<td align="center"><?php echo $kecamatan_nomor.'.'.$kecamatan_nomor;?></td>
							<td colspan="9" style="padding-left:10px;"><?php echo $row_desa->desa_nama;?></td>
						</tr>
						<?php
						$where_kegiatan['anggaran.tahapan_kode']	= $tahapan_kode;
						$where_kegiatan['anggaran.tahun'] 			= $laporan_tahun;
						if ($laporan_kecamatan != 'semua'){ $where_kegiatan['anggaran.kecamatan_kode']= $laporan_kecamatan; }
						if ($laporan_deskel != 'semua'){ $where_kegiatan['anggaran.deskel_kode']	= $laporan_deskel; }
						if ($laporan_skpd != 'semua'){ $where_kegiatan['anggaran.pelaksana_kode'] 	= $laporan_skpd; }
						$where_kegiatan['anggaran.deskel_kode'] 	= $row_desa->desa_kode;
						$kegiatan_nomor								= 1;
						
						if ($this->Anggaran_model->count_bl($where_kegiatan) > 0){
							foreach ($this->Anggaran_model->grid_all('1', 'anggaran.kegiatan, anggaran.alamat, anggaran.rt, anggaran.rw, anggaran_bl.hp_ukur, anggaran_bl.hp_target, anggaran_bl.hp_satuan, anggaran_bl.kh_ukur, anggaran_bl.kh_target, anggaran_bl.kh_satuan, anggaran_bl.hk_ukur, anggaran_bl.hk_target, anggaran_bl.hk_satuan, anggaran_bl.apbd_kab, anggaran_bl.apbd_prov, anggaran_bl.apbn, anggaran_bl.sumberlain, anggaran_bl.perkiraan_maju, anggaran_bl.urutan, sifat.sifat_nama, sumber.sumber_nama, deskel.skpd_nama as deskel_nama, kecamatan.skpd_nama as kecamatan_nama, (anggaran_bl.apbd_kab+anggaran_bl.apbd_prov+anggaran_bl.apbn+anggaran_bl.sumberlain) as rencana_total, skpd.skpd_nama as skpd_nama', 'anggaran.kegiatan', 'ASC', '', '', $where_kegiatan, '', 'anggaran.kode') as $kegiatanrow){
								?>
								<tr>
									<td align="center"><?php echo $kecamatan_nomor.".".$desa_nomor.".".$kegiatan_nomor;?></td>
									<td style="padding-left:25px;"><?php echo $kegiatanrow->kegiatan;?></td>
									<td><?php echo $kegiatanrow->kecamatan_nama;?></td>
									<td><?php echo $kegiatanrow->deskel_nama;?></td>
									<td><?php echo $kegiatanrow->alamat;?></td>
									<td style="text-align:center;"><?php echo $kegiatanrow->hk_ukur;?></td>
									<td style="text-align:center;"><?php echo $kegiatanrow->hk_target;?></td>
									<td><?php echo $kegiatanrow->hk_satuan;?></td>
									<td style="text-align:right;"><?php echo $kegiatanrow->urutan;?></td>
									<td style="text-align:right;"><?php echo rupiah3($kegiatanrow->apbd_kab);?></td>
								</tr>
								<?php
								$kegiatan_nomor++;
							}
						}
					$desa_nomor++;
				}
			}
			$kecamatan_nomor++;
		}
	}
} else {
?>
	<tr style="font-weight:bold; background:#9F0;">
		<td colspan="23" align="center">Belum ada data.</td>
	</tr>
<?php
}
?>
	<tr style="font-weight:bold;font-size:14px;">
    	<th colspan="9" align="center">TOTAL</th>
        <th style="text-align:right;"><?php echo rupiah3($total_apbd);?></th>
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