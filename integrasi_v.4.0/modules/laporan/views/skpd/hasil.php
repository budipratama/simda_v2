<?php
if ($excel == TRUE){
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment;Filename=Laporan_Rekap_SKPD_".date("d_m_Y_H_i_s").".xls");
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=Windows-1252">
<title>LAPORAN REKAP SKPD</title>
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
    <td colspan="3" style="text-align:center; font-weight: bold; font-size: 15px; padding: 0px;">BERDASARKAN SKPD TAHUN <?php echo $laporan_tahun; ?></td>
  </tr>
  <tr>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3">
    	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="data_table">
          <tr>
            <th style="width:40px">NO</th>
            <th>SKPD</th>
            <th style="width:200px">ANGGARAN (Rp)</th>
          </tr>
          <?php
          $i = 1;
		  $total_anggaran = 0;
		  $query							= $this->db->query("SELECT skpd.skpd_nama, SUM(anggaran_bl.apbd_kab) as jumlah_apbdKab FROM skpd LEFT JOIN anggaran ON skpd.skpd_kode=anggaran.skpd_kode LEFT JOIN anggaran_bl ON anggaran.kode=anggaran_bl.anggaran_kode WHERE skpd_status IN ('SKPD', 'Kecamatan') AND anggaran.tahapan_kode='".$laporan_tahapan_kode."' AND anggaran.tahun='".$laporan_tahun."' AND skpd.skpd_nama NOT LIKE '%Bagian%' GROUP BY skpd.skpd_kode ORDER BY skpd.skpd_kode ASC");
		  $data_skpd						= $query->result();
		  $jumlah_skpd						= $query->num_rows();
		  if ($jumlah_skpd > 0){
		  foreach($data_skpd as $row) {
			?>
			  <tr>
				<td style="text-align:center; padding: 0px; height: 20px;"><?php echo $i; ?></td>
				<td><?php echo $row->skpd_nama; ?></td>
				<td style="text-align:right;"><?php echo rupiah($row->jumlah_apbdKab); ?></td>
			  </tr>
			  <?php 
			  $total_anggaran = $total_anggaran + $row->jumlah_apbdKab;
			  $i++;
			}
		  }
			?>
          <tr style="background-color:#0FF; height:20px; font-weight:bold;">
            <td>&nbsp;</td>
            <td style="text-align:center;">Jumlah A </td>
            <td style="text-align:right;"><?php echo rupiah($total_anggaran); ?></td>
          </tr>
          <tr>
            <td colspan="3" style="font-size: 14px; font-weight: bold; background:#036; color: #FFF; text-align:center; height: 25px;">Sekretariat Daerah</td>
          </tr>         
          <?php
          $i = 1;
		  $total_anggaran_setda = 0;
		  $query_setda			= $this->db->query("SELECT skpd.skpd_nama, SUM(anggaran_bl.apbd_kab) as jumlah_apbdKab FROM skpd LEFT JOIN anggaran ON skpd.skpd_kode=anggaran.skpd_kode LEFT JOIN anggaran_bl ON anggaran.kode=anggaran_bl.anggaran_kode WHERE skpd_status IN ('SKPD', 'Kecamatan') AND anggaran.tahapan_kode='".$laporan_tahapan_kode."' AND anggaran.tahun='".$laporan_tahun."' AND skpd.skpd_nama LIKE '%Bagian%' GROUP BY skpd.skpd_kode ORDER BY skpd.skpd_kode ASC");
		  $data_setda			= $query_setda->result();
		  $jumlah_setda			= $query_setda->num_rows();
		  if ($jumlah_setda > 0){
		  foreach($data_setda as $row_setda)
		    {
			?>
			  <tr>
				<td style="text-align:center; padding: 0px; height: 20px;"><?php echo $i; ?></td>
				<td><?php echo $row_setda->skpd_nama; ?></td>
				<td style="text-align:right;"><?php echo rupiah($row_setda->jumlah_apbdKab); ?></td>
			  </tr>
			  <?php 
			  $total_anggaran_setda = $total_anggaran_setda + $row_setda->jumlah_apbdKab;
			  $i++;
			}
		  }
			?>          
          <tr style="background-color:#0FF; height:20px; font-weight:bold;">
            <td>&nbsp;</td>
            <td style="text-align:center;">Jumlah B </td>
            <td style="text-align:right;"><?php echo rupiah($total_anggaran_setda); ?></td>
          </tr>          
          <tr style="background-color:#FF0; height:25px; font-weight:bold;">
            <td>&nbsp;</td>
            <td style="text-align:center;">Jumlah Total (A + B) </td>
            <td style="text-align:right;"><?php echo rupiah($total_anggaran+$total_anggaran_setda); ?></td>
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