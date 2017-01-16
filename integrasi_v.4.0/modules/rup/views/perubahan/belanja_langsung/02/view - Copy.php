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
    <td colspan="3" style="text-align:center; font-weight: bold; font-size: 15px; padding: 0px;">REKAPITULASI HASIL <?php echo strtoupper($laporan_tahapan); ?></td>
  </tr>   
  <tr>
    <td colspan="3" style="text-align:center; font-weight: bold; font-size: 15px; padding: 0px;">BERDASARKAN URUSAN TAHUN <?php echo $laporan_tahun; ?></td>
  </tr>
  <tr>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3">
    	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="data_table">	
	<tr style="border-bottom:#999 solid 2px;">
		<th colspan="9">RINCIAN ANGGARAN BELANJA LANGSUNG MENURUT PROGRAM DAN PER KEGIATAN<br>SATUAN KERJA PERANGKAT DAERAH</th>
    </tr>
    <tr style="border-bottom:#999 solid 2px;">
	<th rowspan="2" width="75">KODE<br>REKENING</th>
	<th rowspan="2" colspan="3" >URAIAN</th>
		<th colspan="3">Rincian Perhitungan</th>
		<th style="text-align:center;" width="60" rowspan="2"> JUMLAH<br>(Rp) </th>


    </tr>
    <tr style="border-bottom:#999 solid 2px;">
		<th style="text-align:center;" width="55">VOLUME</th>
		<th style="text-align:center;">SATUAN</th>
		<th style="text-align:center;" width="60">HARGA<br>SATUAN</th>


    </tr>
		<tr style="font-weight:bold; background:#9F0;">
			<td style="text-align:center; padding: 0px; height: 20px;">1</td>
			<td style="text-align:center; padding: 0px; height: 20px;" colspan="3">2</td>
			<td style="text-align:center; padding: 0px; height: 20px;" colspan="1">3</td>
			<td style="text-align:center; padding: 0px; height: 20px;" colspan="1">4</td>
			<td style="text-align:center; padding: 0px; height: 20px;" colspan="1">5</td>
			<td style="text-align:center; padding: 0px; height: 20px;" colspan="1">6</td>
		</tr>
		<tr style="font-weight:bold; background:#9F0;">
			<td style="text-align:left;">5.2</td>
			<td style="text-align:left;" colspan="3">BELANJA LANGSUNG</td>
			<td colspan="5" style="text-align:right;"><?php echo rupiah(); ?></td>
		</tr>
		
	<?php
	$jenis_urusan 	= array('1'=>'Belanja Pegawai', '2'=>'Belanja Barang dan Jasa', '3'=>'Belanja Modal');
	$totalAnggaran 	= 0;
	$total_apbd 	= 0;
	$ii = 0;
	//Looping jenis urusan
	
	for ($i=1; $i < 4; $i++){
		?>
		<tr style="font-weight:bold;">
			<td align="center">5.2.<?php echo $i;?></td>
			<td colspan="3"><?php echo strtoupper($jenis_urusan[$i]);?></td>
			<td colspan="5" style="text-align:right;"><?php echo rupiah(); ?></td>
		</tr>
		<?php		
		$query_rka = $this->db->query("SELECT rka.kode as id_rka,
		rka.no, rincian.no as rincian_no,
		rincian.rincian_nama as rincian_nama,
		SUM(rka_sub.total) as total_sub
		FROM rka 
		LEFT JOIN rincian ON rka.rincian=rincian.kode
		LEFT JOIN rka_sub ON rka.kode=rka_sub.kode
		WHERE rka.tipe_kode= '1' 
		AND rka.jenis_bl='".$jenis_urusan[$i]."'
		AND rka.tahun='".$laporan_tahun."'
		GROUP BY rka.kode ORDER BY rka.kode ASC");
		
		$data_rka			= $query_rka->result();
		$jumlah_rka			= $query_rka->num_rows();
		if ($jumlah_rka > 0){
			foreach($data_rka as $row_rka) {
			?>
			<tr style="font-weight:bold;font-style:italic;">
				<td align="center">5.2.<?php echo $i.".".$row_rka->rincian_no;?></td>
				  <td colspan="3"><?php echo $row_rka->rincian_nama; ?></td>
				  <td colspan="5" style="text-align:right;"></td>
			</tr>
			
			<?php
				$query_rincian = $this->db->query("SELECT rka_rincian.kode as id_rincian,
				rka_rincian.no as rincian_no,
				rka_rincian.uraian as rincian_nama
				FROM rka_rincian
				LEFT JOIN rka ON rka.kode=rka_rincian.kode
				WHERE rka.tipe_kode= '1'
				AND rka.tahun='".$laporan_tahun."'
				AND rka_rincian.rka='".$row_rka->id_rka."'
				GROUP BY rka_rincian.kode ORDER BY rka_rincian.kode ASC");		

				$data_rincian	= $query_rincian->result();
				$jumlah_rincian	= $query_rincian->num_rows();
				if ($jumlah_rincian > 0){
					foreach($data_rincian as $row_rincian) {
			?>
					<tr>
						<td style="text-align:center; padding: 0px; height: 20px;"></td>
						<td colspan="3">&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row_rincian->rincian_nama; ?></td>
						<td colspan="5" style="text-align:right;"><?php echo rupiah1 ($anggaranRutin); ?></td>
					</tr>
			
					<?php				
						$query_sub = $this->db->query("SELECT rka_sub.kode as id_sub,
						rka_sub.total, rka_sub.harga, rka_sub.satuan,
						rka_sub.volume, rka_sub.no as rincian_no,
						rka_sub.uraian as rincian_nama
						FROM rka_sub						
						LEFT JOIN rka ON rka.kode=rka_sub.kode
						WHERE rka_sub.tipe_kode= '1'
						AND rka_sub.tahun='".$laporan_tahun."'
						AND rka_sub.rka_rincian='".$row_rincian->id_rincian."'						
						GROUP BY rka_sub.kode ORDER BY rka_sub.kode ASC");		

						$data_sub	= $query_sub->result();
						$jumlah_sub	= $query_sub->num_rows();
						
						if ($jumlah_sub > 0){
						foreach($data_sub as $row_sub) {
							$where_rutin['rka_sub.kode'] = $row_rincian->id_rincian;						
							if ($this->Rka_model->count_bl($where_rutin) == 1){
								$rutin = $this->Rka_model->get('1', 'SUM(rka_sub.total) as jumlah_apbdRutin', $where_rutin);
								$anggaranRutin = $rutin->jumlah_apbdRutin;
							} else {
								$anggaranRutin = 0;
							}
						
						$anggaranSKPD = $row_sub->total + $anggaranRutin;
						
						$totalAnggaran = $totalAnggaran + $anggaranSKPD;
					?>
							<tr>
								<td style="text-align:center; padding: 0px; height: 20px;"></td>
								<td colspan="3">&nbsp;&nbsp;&nbsp;&nbsp; - <?php echo $row_sub->rincian_nama; ?></td>
								<td style="text-align:center;"><?php echo $row_sub->volume; ?></td>
								<td style="text-align:center;"><?php echo $row_sub->satuan; ?></td>
								<td style="text-align:right;"><?php echo rupiah1 ($row_sub->harga); ?></td>
								<td style="text-align:right;"><?php echo rupiah1 ($row_sub->total); ?></td>
							</tr>			
			
								<?php
							}
						}
					}
				}	
			} //End Loop Urusan 
		} //End If Urusan 
	}
	?>
      
		<tr style="background-color:#FF0; height:25px; font-weight:bold;">
			<td>&nbsp;</td>
			<td style="text-align:center;">Jumlah Total </td>
			<td style="text-align:right;"><?php echo rupiah($totalAnggaran); ?></td>
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