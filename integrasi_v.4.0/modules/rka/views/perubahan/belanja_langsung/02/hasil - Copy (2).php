<?php
if ($excel == TRUE){
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment;Filename=Laporan_RKA_".date("d_m_Y_H_i_s").".xls");
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=Windows-1252">
<title>LAPORAN RKA</title>
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
<table width="830" border="0" cellspacing="0" cellpadding="4" align="center" class="wrapper">
  <tr>
    <td colspan="3" style="text-align:center; font-weight: bold; font-size: 15px; padding: 0px;"></td>
  </tr>   
  <tr>
    <td colspan="3" style="text-align:center; font-weight: bold; font-size: 15px; padding: 0px;"><p align="right"></td>
	
  </tr>
  <tr>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="data_table">	
	<tr style="font-weight:bold;">
		<td style="text-align:center;" rowspan="2" colspan="1"><center><img src="<?php echo base_url('public/dist/img/logo.jpg');?>" width="50" height="50"></center></td>		
		<td style="text-align:center;" colspan="6">RENCANA KERJA DAN ANGGARAN<br>SATUAN KERJA PERANGKAT DAERAH</td>
		<td style="text-align:center;" rowspan="2" colspan="1">Formulir<br>RKA SKPD<br>2.2.1</td>
    </tr>
	<tr style="font-weight:bold;">
		<td style="text-align:center;" colspan="6">PEMERINTAH KABUPATEN BEKASI<br>Tahun Anggaran <?php echo $laporan_tahun; ?></td>
    </tr>	
	<?php
	$query_get = $this->db->query("SELECT program.program as id_program, program.nomor as no_program, skpd.skpd_nama as id_skpd, 
	skpd.urusan as id_urusan, urusan.urusan as nama_urusan, urusan.jenis as jenis_urusan, skpd.skpd_nomor as no_skpd,
	skpd.skpd_alamat as alamat_skpd, skpd.skpd_status as status_skpd, anggaran.kegiatan as id_anggaran, anggaran.nomor as no_anggaran,
	anggaran_bl.hp_ukur as hpu_anggaran, anggaran_bl.hp_target as hpt_anggaran, anggaran_bl.hp_satuan as hps_anggaran,
	anggaran_bl.kh_ukur as khu_anggaran, anggaran_bl.kh_target as kht_anggaran, anggaran_bl.kh_satuan as khs_anggaran,
	anggaran_bl.hk_ukur as hku_anggaran, anggaran_bl.hk_target as hkt_anggaran, anggaran_bl.hk_satuan as hks_anggaran
	FROM rka 
	LEFT JOIN program ON rka.program=program.kode
	LEFT JOIN skpd ON rka.skpd=skpd.skpd_kode
	LEFT JOIN urusan ON rka.urusan=urusan.kode
	LEFT JOIN anggaran ON rka.anggaran_kode=anggaran.kode
	LEFT JOIN anggaran_bl ON rka.anggaran_kode=anggaran_bl.kode
	WHERE rka.tipe_kode= '1'
	AND rka.kode='".$laporan_kode."'
	AND rka.tahun='".$laporan_tahun."'
	AND rka.anggaran_kode='".$laporan_anggaran."' 
	GROUP BY rka.kode ORDER BY rka.kode ASC");
		$data_get			= $query_get->result();
		$jumlah_get			= $query_get->num_rows();
		if ($jumlah_get > 0){
			foreach($data_get as $row_get) {	
	?>
	<tr>
		<td style="text-align:left; font-size:10px;" colspan="2" >Urusan Pemerintahaan</td>
		<td style="text-align:left; font-size:10px;" colspan="1" >: 1.<?php echo $row_get->id_urusan; ?></td>
		<td style="text-align:left; font-size:10px;" colspan="5" ><?php echo $row_get->jenis_urusan; ?> <?php echo $row_get->nama_urusan; ?></td>
    </tr>
	<tr>
		<td style="text-align:left; font-size:10px;" colspan="2" >Organisasi</td>
		<td style="text-align:left; font-size:10px;" colspan="1" >: 1.<?php echo $row_get->id_urusan; ?> . 1.<?php echo $row_get->id_urusan; ?>.<?php echo $row_get->no_skpd; ?></td>
		<td style="text-align:left; font-size:10px;" colspan="5" ><?php echo $row_get->id_skpd; ?></td>
    </tr>
	<tr>
		<td style="text-align:left; font-size:10px;" colspan="2" >Program</td>
		<td style="text-align:left; font-size:10px;" colspan="1" >: 1.<?php echo $row_get->id_urusan; ?> . 1.<?php echo $row_get->id_urusan; ?>.<?php echo $row_get->no_skpd; ?> . <?php echo $row_get->no_program; ?></td>
		<td style="text-align:left; font-size:10px;" colspan="5" ><?php echo $row_get->id_program; ?></td>
    </tr>
	<tr>
		<td style="text-align:left; font-size:10px;" colspan="2" >Kegiatan</td>
		<td style="text-align:left; font-size:10px;" colspan="1" >: 1.<?php echo $row_get->id_urusan; ?> . 1.<?php echo $row_get->id_urusan; ?>.<?php echo $row_get->no_skpd; ?> . <?php echo $row_get->no_program; ?> . <?php echo $row_get->no_anggaran; ?></td>
		<td style="text-align:left; font-size:10px;" colspan="5" ><?php echo $row_get->id_anggaran; ?></td>
    </tr>
	<tr><td style="text-align:left; font-size:10px;" colspan="8" >Lokasi Kegiatan &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; : &nbsp; <?php echo $row_get->alamat_skpd; ?></td></tr>	
	<tr>
		<td style="text-align:left; font-size:10px;" colspan="3" >Jumlah Tahun n - 1 &nbsp;&nbsp;&nbsp; : &nbsp; Rp</td>
		<td style="text-align:left; font-size:10px;" colspan="5" ><?php echo rupiah1 (); ?></td>
    </tr>	
	<tr>
		<td style="text-align:left; font-size:10px;" colspan="3" >Jumlah Tahun n &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; : &nbsp; Rp</td>
		<?php $query_jumlah = mysql_query("SELECT SUM(total) FROM rka_sub WHERE rka_sub.tipe_kode= '1' AND rka_sub.anggaran_kode='".$laporan_anggaran."' ORDER BY rka_sub.kode ASC"); $data = mysql_fetch_array($query_jumlah); $jumlah = $data[0];?>
		<td style="text-align:left; font-size:10px;" colspan="5" ><?php echo rupiah1 ($jumlah); ?> &nbsp; <i>(<?php echo Terbilang ($jumlah); ?> rupiah )</i></td>
    </tr>	
	<tr>
		<td style="text-align:left; font-size:10px;" colspan="3" >Jumlah Tahun n + 1 &nbsp;&nbsp;&nbsp;: &nbsp; Rp</td>
		<td style="text-align:left; font-size:10px;" colspan="5" ><?php echo rupiah1 (); ?></td>
    </tr>	
	<tr>
		<td style="text-align:left; font-size:10px;" colspan="2" >CAPAIAN PROGRAM</td>
		<td style="text-align:left; font-size:10px;" colspan="3" ><?php echo $row_get->hpu_anggaran; ?></td>
		<td style="text-align:left; font-size:10px;" colspan="3" ><?php echo $row_get->hpt_anggaran; ?>&nbsp;<?php echo $row_get->hps_anggaran; ?></td>
    </tr>
	<tr>
		<td style="text-align:left; font-size:10px;" colspan="2" >MASUKAN</td>
		<td style="text-align:left; font-size:10px;" colspan="3" >Jumlah Dana</td>
		<td style="text-align:left; font-size:10px;" colspan="3" >Rp. <?php echo rupiah2 ($jumlah); ?></td>
    </tr>
	<tr>
		<td style="text-align:left; font-size:10px;" colspan="2" >KELUARAN</td>
		<td style="text-align:left; font-size:10px;" colspan="3" ><?php echo $row_get->khu_anggaran; ?></td>
		<td style="text-align:left; font-size:10px;" colspan="3" ><?php echo $row_get->kht_anggaran; ?> <?php echo $row_get->khs_anggaran; ?></td>
    </tr>
	<tr>
		<td style="text-align:left; font-size:10px;" colspan="2" >HASIL</td>
		<td style="text-align:left; font-size:10px;" colspan="3" ><?php echo $row_get->hku_anggaran; ?></td>
		<td style="text-align:left; font-size:10px;" colspan="3" ><?php echo $row_get->hkt_anggaran; ?> <?php echo $row_get->hks_anggaran; ?></td>
    </tr>
	<tr><td style="text-align:left; font-size:10px;" colspan="8" >Kelompok Sasaran Kegiatan &nbsp; &nbsp; &nbsp; : <?php echo $row_get->status_skpd; ?></td></tr>	
	<?php } } ?>
	<tr style="font-weight:bold;">
		<td style="text-align:center; font-size:10px;" colspan="8">RINCIAN ANGGARAN BELANJA LANGSUNG MENURUT PROGRAM DAN PER KEGIATAN<br>SATUAN KERJA PERANGKAT DAERAH</td>
    </tr>
	<tr style="font-weight:bold;">
	<td style="text-align:center;" rowspan="2" width="55">KODE<br>REKENING</td>
	<td style="text-align:center;" colspan="3" rowspan="2" width="55">URAIAN</td>
	<td style="text-align:center;" colspan="3" width="55">Rincian Perhitungan</td>
	<td style="text-align:center;" colspan="1" rowspan="2" width="55">JUMLAH<br>(Rp)</td>
    </tr>	
		<tr style="font-weight:bold;">
			<td style="text-align:center;" colspan="1" width="55">Volume</td>
			<td style="text-align:center;" colspan="1" >Satuan</td>
			<td style="text-align:center;" width="60" colspan="1">Harga Satuan</td>
		</tr>		
		<tr style="font-weight:bold; background:#7FFFD4;">
			<td style="text-align:center; padding: 0px; height: 20px;">1</td>
			<td style="text-align:center; padding: 0px; height: 20px;" colspan="3">2</td>
			<td style="text-align:center; padding: 0px; height: 20px;" colspan="1">3</td>
			<td style="text-align:center; padding: 0px; height: 20px;" colspan="1">4</td>
			<td style="text-align:center; padding: 0px; height: 20px;" colspan="1">5</td>
			<td style="text-align:center; padding: 0px; height: 20px;" colspan="1">6</td>
		</tr>
		<tr style="font-weight:bold; background:#B0C4DE;">
			<td style="text-align:left;">5</td>
			<td style="text-align:left;" colspan="3">BELANJA</td>
			<td colspan="4" style="text-align:right;"><?php echo rupiah1 ($jumlah); ?></td>
		</tr>
		<tr style="font-weight:bold; background:#B0C4DE ;">
			<td style="text-align:left;">5.2</td>
			<td style="text-align:left;" colspan="3">BELANJA LANGSUNG</td>
			<td colspan="4" style="text-align:right;"><?php echo rupiah1 ($jumlah); ?>
		</tr>		
	<?php
	$peserta = array("Budi", "Wati");
	
	echo $peserta[0];
	echo "<br/>";

        $nilai["Budi"] = 15;
        $nilai["Wati"] = 25;

	echo $nilai["Budi"];
	echo "<br/>";
	
	
	
	
	$jenis_belanja 	= array('1'=>'63 Belanja Pegawai', '2'=>'64 Belanja Barang dan Jasa', '3'=>'65 Belanja Modal');
	for ($i=1; $i < 4; $i++){	
		$query_jenis 	= $this->db->query("SELECT rka.kode as id_rka, rka_sub.total, SUM(rka_sub.total) as totalRKA FROM rka_sub LEFT JOIN rka ON rka.kode=rka_sub.rka WHERE rka_sub.tipe_kode= '1' AND rka.jenis='".$jenis_belanja[$i]."' AND rka.tahun='".$laporan_tahun."' AND rka.anggaran_kode='".$laporan_anggaran."' AND rka.kode GROUP BY rka.kode ORDER BY rka.kode ASC");
		$data_jenis 	= $query_jenis->result();
		?>
		<tr style="font-weight:bold; background:#DCDCDC ;">
			<td align="center">5.2.<?php echo $i;?></td>
			<td colspan="3"><?php echo ($jenis_belanja[$i]);?></td>
			<td colspan="4" style="text-align:right;">
			<?php if($data_jenis): foreach($data_jenis as $task):  echo rupiah1 ($task->totalRKA);  endforeach;  endif; ?>			
			</td>
		</tr>
		<?php			
		$query_id = $this->db->query("SELECT rka.kode as id_rka, rka.no, obyek.nomor as obyek_no, obyek.obyek_nama as obyek_nama, SUM(rka_sub.total) as totalRKA FROM rka LEFT JOIN obyek ON rka.obyek=obyek.kode LEFT JOIN rka_sub ON rka.kode=rka_sub.kode WHERE rka.tipe_kode= '1' AND rka.jenis='".$jenis_belanja[$i]."' AND rka.tahun='".$laporan_tahun."' AND rka.anggaran_kode='".$laporan_anggaran."' GROUP BY rka.kode ORDER BY rka.kode ASC");
		$data_id			= $query_id->result();
		$jumlah_id			= $query_id->num_rows();
		if ($jumlah_id > 0){
			foreach($data_id as $row_id) {
			?>
				<tr style="font-weight:bold;font-style:italic; background:#DCDCDC;">
				<td align="center">5.2.<?php echo $i.".".$row_id->obyek_no;?></td>
				  <td colspan="3"><?php echo $row_id->obyek_nama; ?></td>
				  <td colspan="4" style="text-align:right;"><!-- 4 --></td>
				</tr>			
				<?php
				$query_rka = $this->db->query("SELECT rincian.nomor as rincian_no, rincian.rincian_nama as rincian_nama, SUM(rka_sub.total) as totalRKA FROM rka LEFT JOIN rincian ON rka.rincian=rincian.kode LEFT JOIN rka_sub ON rka.kode=rka_sub.kode WHERE rka.tipe_kode= '1' AND rka.tahun='".$laporan_tahun."' AND rka.kode='".$row_id->id_rka."' GROUP BY rka.kode ORDER BY rka.kode ASC");
				$data_rka	= $query_rka->result();
				$jumlah_rka	= $query_rka->num_rows();
				if ($jumlah_rka > 0){
					foreach($data_rka as $row_rka) {	
					$query_jumlah 	= $this->db->query("SELECT rka_sub.rka_rincian, rka_sub.total, SUM(rka_sub.total) as totalRKA FROM rka_sub WHERE rka_sub.tipe_kode= '1' AND rka_sub.anggaran_kode='".$laporan_anggaran."' AND rka_sub.rka='".$row_id->id_rka."' ");
					$data_hasil 	= $query_jumlah->result();
					?>
					<tr>
						<td align="left">5.2.<?php echo $i.".".$row_id->obyek_no;?>.<?php echo $row_rka->rincian_no; ?></td>
						<td colspan="3"><?php echo $row_rka->rincian_nama; ?></td>
						<td colspan="4" style="text-align:right;"><?php if($data_hasil): foreach($data_hasil as $task):  echo rupiah1 ($task->totalRKA);  endforeach;  endif; ?></td>
					</tr>
				<?php
				$query_rincian = $this->db->query("SELECT rka_rincian.kode as id_rincian, rka_rincian.no as rincian_no, rka_rincian.uraian as rincian_nama FROM rka_rincian LEFT JOIN rka ON rka.kode=rka_rincian.kode WHERE rka_rincian.tipe_kode= '1' AND rka_rincian.rka='".$row_id->id_rka."' GROUP BY rka_rincian.kode ORDER BY rka_rincian.kode ASC");
				$data_rincian	= $query_rincian->result();
				$jumlah_rincian	= $query_rincian->num_rows();
				if ($jumlah_rincian > 0){
					foreach($data_rincian as $row_rincian) {						
					$query_jumlah1 	= $this->db->query("SELECT rka_sub.rka_rincian, rka_sub.total, SUM(rka_sub.total) as totalRKA FROM rka_sub WHERE rka_sub.tipe_kode= '1' AND rka_sub.anggaran_kode='".$laporan_anggaran."' AND rka_sub.rka_rincian='".$row_rincian->id_rincian."' ");
					$data_hasil1 	= $query_jumlah1->result();					
					?>
					<tr>
						<td style="text-align:center; padding: 0px; height: 20px;"></td>
						<td colspan="3">&nbsp;&nbsp;<?php echo $row_rincian->rincian_nama; ?></td>
						<td colspan="4" style="text-align:right;"><?php if($data_hasil1): foreach($data_hasil1 as $task1):  echo rupiah1 ($task1->totalRKA);  endforeach;  endif; ?></td>
					</tr>
					<?php
						$query_sub = $this->db->query("SELECT rka_sub.kode as id_sub, rka_sub.rka, rka_sub.total, rka_sub.harga, rka_sub.satuan, rka_sub.volume, rka_sub.no as rincian_no, rka_sub.uraian, SUM(total) as totalRKA FROM rka_sub LEFT JOIN rka ON rka.kode=rka_sub.kode WHERE rka_sub.tipe_kode= '1' AND rka_sub.rka='".$row_id->id_rka."' AND rka_sub.rka_rincian='".$row_rincian->id_rincian."' GROUP BY rka_sub.kode ORDER BY rka_sub.kode ASC");	
						$data_sub	= $query_sub->result();
						$jumlah_sub	= $query_sub->num_rows();
						if ($jumlah_sub > 0){
						foreach($data_sub as $row_sub) {
						?>
							<tr>
								<td style="text-align:center; padding: 0px; height: 20px;"></td>
								<td colspan="3">&nbsp;&nbsp; - <?php echo $row_sub->uraian; ?></td>
								<td style="text-align:center;"><?php echo $row_sub->volume; ?></td>
								<td style="text-align:center;"><?php echo $row_sub->satuan; ?></td>
								<td style="text-align:right;"><?php echo rupiah1 ($row_sub->harga); ?></td>
								<td colspan="1" style="text-align:right;"><?php echo rupiah1 ($row_sub->total); ?></td>
							</tr>			
							<?php } } } } } } } } }	?>
		<tr>
			<td style="text-align:left; font-size: 9px;" colspan="4">Keterangan :<br> - Tanggal Pembahasan<br> - Catatan Hasil Pembahasan<br><br><br><br><br><br><br><br></td>
			<td style="text-align:center;" colspan="4"><?php echo $laporan_kecamatan; ?>, <?php echo dateIndo($laporan_tanggal); ?>
		<?php
		$query_kp = $this->db->query("SELECT tim_anggaran.nama, tim_anggaran.nip, skpd.skpd_nama as id_skpd	FROM tim_anggaran LEFT JOIN rka ON rka.kode=tim_anggaran.kode LEFT JOIN skpd ON skpd.skpd_kode=tim_anggaran.skpd WHERE tim_anggaran.dokumen= 'SPM' AND tim_anggaran.skpd='".$laporan_skpd."' ORDER BY tim_anggaran.kode ASC");	
		$data_kp			= $query_kp->result();
		$jumlah_kp			= $query_kp->num_rows();
		if ($jumlah_kp > 0){
			foreach($data_kp as $row_kp) {
		?>
			<br><b>Kepala <?php echo $row_kp->id_skpd; ?>
			<br><br><br><br><br><br><?php echo $row_kp->nama; ?></b>
			<br>-----------------------------------------------
			<br>NIP. <?php echo $row_kp->nip; ?>
			</td>
        </tr>
		<?php } } ?> 
		<tr>
			<td style="text-align:center; font-weight: bold;" colspan="8">TIM ANGGARAN PEMERINTAH DAERAH</td>
        </tr>
		<tr>
			<td style="text-align:center; font-weight:bold;" colspan="1">No.</td>
			<td style="text-align:center; font-weight:bold;" colspan="2">NAMA</td>
			<td style="text-align:center; font-weight:bold;" colspan="2">NIP</td>
			<td style="text-align:center; font-weight:bold;" colspan="2">JABATAN</td>
			<td style="text-align:center; font-weight:bold;" colspan="1">TANDA TANGAN</td>
        </tr>
		<?php
		$query_tim = $this->db->query("SELECT tim_anggaran.no, tim_anggaran.nama, tim_anggaran.nip, tim_anggaran.jabatan FROM tim_anggaran WHERE tim_anggaran.kode_tim= '1' ORDER BY tim_anggaran.kode ASC");
		$data_tim			= $query_tim->result();
		$jumlah_tim			= $query_tim->num_rows();
		if ($jumlah_tim > 0){
			foreach($data_tim as $row_tim) {
		?>
		<tr>
			<td style="text-align:center; font-size:9px;" colspan="1"><?php echo $row_tim->no; ?></td>
			<td style="text-align:left; font-size:9px;" colspan="2"><?php echo $row_tim->nama; ?></td>
			<td style="text-align:center; font-size:9px;" colspan="2"><?php echo $row_tim->nip; ?></td>
			<td style="text-align:left; font-size:8px;" colspan="2"><?php echo $row_tim->jabatan; ?></td>
			<td style="text-align:left; font-size:8px;" colspan="1"></td>
        </tr>
		<?php } } ?> 
		<tr>
			<td style="text-align:left; font-size:9px;" colspan="8">- Rencana Kerja Anggaran Satuan Kerja Perangkat Daerah (RKA-SKPD)<br>&nbsp;&nbsp;Sepenuhnya Menjadi Tanggungjawab Pengguna Anggaran.<br><br><br><br><br><br><br></td>
        </tr>
        </table>
    </td>
  </tr>
</table>
</body>
</html>