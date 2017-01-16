<?php
if ($excel == TRUE){
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment;Filename=Laporan_Rekap_Program_".date("d_m_Y_H_i_s").".xls");
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=Windows-1252">
<title>LAPORAN REKAP PROGRAM SKPD</title>
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
<table width="1400" border="0" cellspacing="0" cellpadding="4" align="center" class="wrapper">
  <tr>
    <td colspan="3" style="text-align:center; font-weight: bold; font-size: 15px; padding: 0px;">REKAPITULASI HASIL <?php echo strtoupper($laporan_tahapan); ?></td>
  </tr>   
  <tr>
    <td colspan="3" style="text-align:center; font-weight: bold; font-size: 15px; padding: 0px;">BERDASARKAN INDIKATOR TAHUN <?php echo $laporan_tahun; ?></td>
  </tr>
  <tr>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3">
    	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="data_table">
			<tr>
				<th style="width:40px">NO</th>
				<th style="width:300px">SASARAN</th>
				<th>INDIKATOR SASARAN</th>
				<th style="width:140px">ANGGARAN(Rp)</th>
				<th>SKPD</th>
			</tr>
			<?php
			$i=1;
			$total_anggaran = 0;
			$anggaran = '';
			$tahun_ = 'tahun'.$laporan_tahun;
			
			$query_sasaran			= $this->db->query("SELECT * FROM sasaran");
			$data_sasaran			= $query_sasaran->result();
			$jumlah_sasaran			= $query_sasaran->num_rows();
			if ($jumlah_sasaran > 0){
				foreach($data_sasaran as $row) {
					?>
					<tr style="font-weight:bold;">              
						<td style="text-align:center; padding: 0px;"><?php echo $i; ?></td>
						<td style="font-weight:bold;"><?php echo $row->sasaran; ?></td>
						<td></td>
						<td style="text-align:right;"></td>
						<td></td>
					</tr>
					<?php
					$query_indikator		= $this->db->query("SELECT indikator.kode as indikator_kode, indikator.indikator as indikator_nama, ".$tahun_." as anggaran FROM indikator WHERE sasaran='".$row->kode."' AND ".$tahun_." != '0'");
					$data_indikator			= $query_indikator->result();
					$jumlah_indikator		= $query_indikator->num_rows();
					if ($jumlah_indikator > 0){
						foreach($data_indikator as $row_indikator) {
							if ($this->db->query("SELECT anggaran.kode FROM anggaran LEFT JOIN anggaran_bl ON anggaran.kode=anggaran_bl.anggaran_kode WHERE anggaran.tahapan_kode='".$laporan_tahapan_kode."' AND anggaran.tahun='".$laporan_tahun."' AND anggaran_bl.indikator_kode='".$row_indikator->indikator_kode."'")->num_rows() == 0){
								$total_anggaran = $total_anggaran + $row_indikator->anggaran;
								?> 
								<tr>              
									<td>&nbsp;</td>
									<td>&nbsp;</td>
									<td><?php echo $row_indikator->indikator_nama; ?></td>
									<td style="text-align:right;"><?php echo rupiah($row_indikator->anggaran);?></td>
									<td>
									<?php 
									$jumlah_skpd = 1;
									foreach($this->db->query("SELECT skpd.skpd_nama FROM skpd_indikator LEFT JOIN skpd ON skpd_indikator.skpd=skpd.skpd_kode WHERE skpd_indikator.indikator='".$row_indikator->indikator_kode."'")->result() as $skpd){
										$koma = ($jumlah_skpd % 2 == 0)?', ':'';
										echo $skpd->skpd_nama.$koma;
										
										$jumlah_skpd++;
									}
									?>
									</td>
								</tr>
								<?php
							}
						}
					}
				$i++;
				}
			}
			?>
			<tr style="background-color:#FF0; height:25px; font-weight:bold;">
				<td colspan='3'>&nbsp;</td>
				<td style="text-align:right;"><?php echo rupiah($total_anggaran); ?></td>
				<td style="text-align:right;"></td>		
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