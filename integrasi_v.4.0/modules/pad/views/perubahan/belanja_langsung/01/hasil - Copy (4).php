<?php
if ($excel == TRUE){
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment;Filename=Laporan_RKA".date("d_m_Y_H_i_s").".xls");
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
<table width="746" border="0" cellspacing="0" cellpadding="4" align="center" class="wrapper">
  <tr>
    <td colspan="3" style="text-align:center; font-weight: bold; font-size: 15px; padding: 0px;"></td>
  </tr>   
  <tr>
    <td colspan="3" style="text-align:center; font-weight: bold; font-size: 15px; padding: 0px;">Tahun <?php echo $laporan_tahun; ?></td>
  </tr>
  <tr>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="data_table">	
	<tr style="font-weight:bold;">
		<td style="text-align:center;" colspan="9">RINCIAN ANGGARAN BELANJA LANGSUNG MENURUT PROGRAM DAN PER KEGIATAN<br>SATUAN KERJA PERANGKAT DAERAH</td>
    </tr>
	<tr style="font-weight:bold;">
	<td style="text-align:center;" rowspan="2" width="55">KODE<br>REKENING</td>
	<td style="text-align:center;" colspan="3" rowspan="2" width="55">URAIAN</td>    
	<td style="text-align:center;" colspan="3" width="55">Rincian Perhitungan</td>
	<td style="text-align:center;" colspan="3" rowspan="2" width="55">JUMLAH<br>(Rp)</td>		
		
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
			<td style="text-align:center; padding: 0px; height: 20px;" >6</td>
		</tr>
		<tr style="font-weight:bold; background:#B0C4DE;">
			<td style="text-align:left;">5</td>
			<td style="text-align:left;" colspan="3">BELANJA</td>
			<td colspan="5" style="text-align:right;">
			<?php	$query_jumlah   = mysql_query("SELECT SUM(total) FROM rka_sub WHERE rka_sub.tipe_kode= '1' AND rka_sub.anggaran_kode='".$laporan_anggaran."' ORDER BY rka_sub.kode ASC"); $data = mysql_fetch_array($query_jumlah); $jumlah = $data[0];?>			
			<?php echo rupiah1 ($jumlah); ?></td>
		</tr>
		<tr style="font-weight:bold; background:#B0C4DE ;">
			<td style="text-align:left;">5.2</td>
			<td style="text-align:left;" colspan="3">BELANJA LANGSUNG</td>
			<td colspan="5" style="text-align:right;"><?php echo rupiah1 ($jumlah); ?>
		</tr>
		
	<?php
	$jenis_belanja 	= array('1'=>'63 Belanja Pegawai', '2'=>'64 Belanja Barang dan Jasa', '3'=>'65 Belanja Modal');
	for ($i=1; $i < 4; $i++){	
		$query_jenis 	= $this->db->query("SELECT rka_sub.total, SUM(rka_sub.total) as totalRKA FROM rka_sub LEFT JOIN rka ON rka.kode=rka_sub.rka WHERE rka_sub.tipe_kode= '1' AND rka.jenis='".$jenis_belanja[$i]."' ");
		$data_jenis 	= $query_jenis->result();
		?>
		<tr style="font-weight:bold; background:#DCDCDC ;">
			<td align="center">5.2.<?php echo $i;?></td>
			<td colspan="3"><?php echo ($jenis_belanja[$i]);?></td>
			<td colspan="5" style="text-align:right;">
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
				  <td colspan="5" style="text-align:right;"><!-- 4 --></td>
				</tr>			
				<?php
				$query_rka = $this->db->query("SELECT rincian.nomor as rincian_no, rincian.rincian_nama as rincian_nama, SUM(rka_sub.total) as totalRKA FROM rka LEFT JOIN rincian ON rka.rincian=rincian.kode LEFT JOIN rka_sub ON rka.kode=rka_sub.kode WHERE rka.tipe_kode= '1' AND rka.tahun='".$laporan_tahun."' AND rka.kode='".$row_id->id_rka."' GROUP BY rka.kode ORDER BY rka.kode ASC");
				$data_rka	= $query_rka->result();
				$jumlah_rka	= $query_rka->num_rows();
				if ($jumlah_rka > 0){
					foreach($data_rka as $row_rka) {	
					$query_jumlah 	= $this->db->query("SELECT rka_sub.total, SUM(rka_sub.total) as totalRKA FROM rka_sub WHERE rka_sub.tipe_kode= '1' AND rka_sub.anggaran_kode='".$laporan_anggaran."' AND rka_sub.rka='".$row_id->id_rka."' ");
					$data_hasil 	= $query_jumlah->result();
					?>
					<tr>
						<td align="left">5.2.<?php echo $i.".".$row_id->obyek_no;?>.<?php echo $row_rka->rincian_no; ?></td>
						<td colspan="3"><?php echo $row_rka->rincian_nama; ?></td>
						<td colspan="5" style="text-align:right;"><?php if($data_hasil): foreach($data_hasil as $task):  echo rupiah1 ($task->totalRKA);  endforeach;  endif; ?></td>
					</tr>
				<?php
				$query_rincian = $this->db->query("SELECT rka_rincian.kode as id_rincian, rka_rincian.no as rincian_no, rka_rincian.uraian as rincian_nama FROM rka_rincian LEFT JOIN rka ON rka.kode=rka_rincian.kode WHERE rka.tipe_kode= '1' AND rka_rincian.rka='".$row_id->id_rka."' GROUP BY rka_rincian.kode ORDER BY rka_rincian.kode ASC");
				$data_rincian	= $query_rincian->result();
				$jumlah_rincian	= $query_rincian->num_rows();
				if ($jumlah_rincian > 0){
					foreach($data_rincian as $row_rincian) {
					?>
					<tr>
						<td style="text-align:center; padding: 0px; height: 20px;"></td>
						<td colspan="3">&nbsp;&nbsp;<?php echo $row_rincian->rincian_nama; ?></td>
						<td colspan="5" style="text-align:right;"><?php if($data_hasil): foreach($data_hasil as $task):  echo rupiah1 ($task->totalRKA);  endforeach;  endif; ?></td>
					</tr>
					<?php
						$query_sub = $this->db->query("SELECT rka_sub.kode as id_sub, rka_sub.rka, rka_sub.total, rka_sub.harga, rka_sub.satuan, rka_sub.volume, rka_sub.no as rincian_no, rka_sub.uraian, SUM(total) as totalRKA FROM rka_sub LEFT JOIN rka ON rka.kode=rka_sub.kode WHERE rka_sub.tipe_kode= '1' AND rka_sub.rka='".$row_id->id_rka."' GROUP BY rka_sub.kode ORDER BY rka_sub.kode ASC");	
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
								<td style="text-align:right;"><?php echo rupiah1 ($row_sub->total); ?></td>
							</tr>			
							<?php } } } } } } } } }	?>      
		<tr style="background-color:#B0C4DE; height:25px; font-weight:bold;">
			<td>&nbsp;</td>
			<td style="text-align:center;" colspan="3">Jumlah Total </td>
			<td style="text-align:right;" colspan="5"><?php echo rupiah1 ($jumlah); ?></td>
        </tr>          
        </table>
    </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</body>
</html>