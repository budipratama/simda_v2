<?php
if ($excel == TRUE){
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment;Filename=Laporan_Rekap_Urusan_".date("d_m_Y_H_i_s").".xls");
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=Windows-1252">
<title>LAPORAN REKAP URUSAN SKPD</title>
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
          <tr>
            <th style="width:40px">KODE</th>
            <th>SKPD</th>
            <th style="width:200px">ANGGARAN (Rp)</th>
          </tr>
	<?php
	$jenis_urusan 	= array('1'=>'wajib', '2'=>'pilihan');
	$totalAnggaran 	= 0;
	//Looping jenis urusan
	for ($i=1; $i < 3; $i++){
		?>
		<tr style="font-weight:bold; background:#9F0;">
			<td align="center"><?php echo $i;?></td>
			<td colspan="2">URUSAN <?php echo strtoupper($jenis_urusan[$i]);?></td>
		</tr>
		<?php
		$query_urusan1 = $this->db->query("SELECT urusan.kode as urusan_kode,
		urusan.nomor as urusan_nomor, 
		urusan.urusan as urusan_nama, 
		SUM(anggaran_bl.apbd_kab) as jumlah_apbdKab 
		FROM urusan 
		LEFT JOIN anggaran_bl ON urusan.kode=anggaran_bl.urusan_kode 
		LEFT JOIN anggaran ON anggaran_bl.anggaran_kode=anggaran.kode 
		WHERE anggaran.tahapan_kode='".$laporan_tahapan_kode."' 
		AND anggaran.tahun='".$laporan_tahun."' 
		AND urusan.jenis='".$jenis_urusan[$i]."' 
		GROUP BY urusan.kode ORDER BY urusan.nomor ASC");
		
		// urusan 		= rka
		// anggaran		= rka_rincian
		// anggaran_bl	= rka_sub
		
		$query_urusan = $this->db->query("SELECT rka.kode as urusan_kode,
		rka.no as urusan_nomor,
		rka.urusan as urusan_nama, 
		SUM(rka_sub.total) as jumlah_apbdKab
		FROM rka 
		LEFT JOIN rka_sub ON rka.kode=rka_sub.kode 
		LEFT JOIN rka_rincian ON rka_sub.rka=rka_rincian.kode 
		WHERE rka_rincian.anggaran_kode='".$laporan_tahapan_kode."'
		AND rka_rincian.tahun='".$laporan_tahun."' 
		AND rka.urusan='".$jenis_urusan[$i]."' 		
		GROUP BY rka.kode ORDER BY rka.no ASC");
		
		$data_urusan			= $query_urusan->result();
		$jumlah_urusan			= $query_urusan->num_rows();
		if ($jumlah_urusan > 0){
			foreach($data_urusan as $row) {
			?>
			<tr style="font-weight:bold;font-style:italic;">
				<td align="center"><?php echo $i.".".$row->urusan_nomor;?></td>
				  <td colspan="2"><?php echo $row->urusan_nama; ?></td>
			</tr>
			
			
			<?php
				//Urusan SKPD
				$query_skpd1 = $this->db->query("SELECT skpd.skpd_kode, 
				skpd.skpd_nomor, 
				skpd.skpd_nama, 
				SUM(anggaran_bl.apbd_kab) as jumlah_apbdKab 
				FROM skpd LEFT JOIN anggaran ON skpd.skpd_kode=anggaran.skpd_kode 
				LEFT JOIN anggaran_bl ON anggaran.kode=anggaran_bl.anggaran_kode 
				LEFT JOIN urusan ON anggaran_bl.urusan_kode=urusan.kode 
				WHERE skpd_status IN ('SKPD', 'Kecamatan') 
				AND anggaran.tahapan_kode='".$laporan_tahapan_kode."' 
				AND anggaran.tahun='".$laporan_tahun."' 
				AND urusan.kode='".$row->urusan_kode."' 
				GROUP BY skpd.skpd_kode ORDER BY skpd.skpd_kode ASC");
				
				// skpd 		= rka
				// anggaran		= rka_rincian
				// anggaran_bl	= rka_sub
				
				$query_skpd = $this->db->query("SELECT rka.kode, 
				rka.no, 
				rka.urusan, 
				SUM(rka_sub.total) as jumlah_apbdKab 
				FROM rka 
				LEFT JOIN rka_sub ON rka.kode=rka_sub.kode 
				LEFT JOIN rka_rincian ON rka_sub.rka=rka_rincian.kode 
				WHERE rka_rincian.anggaran_kode='".$laporan_tahapan_kode."'
				AND rka_rincian.tahun='".$laporan_tahun."'		
				AND rka.kode='".$row->urusan_kode."'					
				GROUP BY rka.kode ORDER BY rka.kode ASC");
				
				
				$data_skpd						= $query_skpd->result();
				$jumlah_skpd					= $query_skpd->num_rows();
				if ($jumlah_skpd > 0){
					foreach($data_skpd as $row_skpd) {
						//Cek Urusan Rutin
						$where_rutin['anggaran.skpd_kode']	 = $row_skpd->skpd_kode;
						$where_rutin['anggaran_bl.urusan_kode'] = $row->urusan_kode;
						
						if ($this->Anggaran_model->count_bl($where_rutin) == 1){
							$rutin = $this->Anggaran_model->get('1', 'SUM(anggaran_bl.apbd_kab) as jumlah_apbdRutin', $where_rutin);
							$anggaranRutin = $rutin->jumlah_apbdRutin;
						} else {
							$anggaranRutin = 0;
						}
						
						$anggaranSKPD = $row_skpd->jumlah_apbdKab + $anggaranRutin;
						
						$totalAnggaran = $totalAnggaran + $anggaranSKPD;
					?>
					<tr>
						<td style="text-align:center; padding: 0px; height: 20px;"><?php echo $i.".".$row->urusan_nomor.".".$row_skpd->skpd_nomor;?></td>
						<td><?php echo $row_skpd->skpd_nama; ?></td>
						<td style="text-align:right;"><?php echo rupiah($anggaranSKPD); ?></td>
					</tr>
			
			
					<?php
					} // End loop SKPD
				} //End If SKPD  
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