<?php
if ($excel == TRUE){
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment;Filename=Laporan_Pokpir_DPRD_".date("d_m_Y_H_i_s").".xls");
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=Windows-1252">
<title>LAPORAN POKPIR DPRD</title>
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
<table width="1252" border="0" cellspacing="0" cellpadding="4" align="center" class="wrapper">
  <tr>
    <td colspan="3" style="text-align:center; font-weight: bold; font-size: 15px; padding: 0px;">LAPORAN POKOK-POKOK PIKIRAN DPRD</td>
  </tr>   
  <tr>
    <td colspan="3" style="text-align:center; font-weight: bold; font-size: 15px; padding: 0px;">TAHUN ANGGARAN <?php echo $laporan_tahun; ?></td>
  </tr>
  <tr>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3">
    	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="data_table">
          <tr>
            <th style="width:40px">NO</th>
            <th>KEGIATAN</th>
            <th style="width:200px">LOKASI</th>
            <th style="width:200px">VOLUME</th>
            <th style="width:200px">SKPD PELAKSANA</th>
            <th style="width:200px">ANGGOTA DPRD</th>
          </tr>
          <?php
          $i = 1;
		  $query							= $this->db->query("SELECT anggaran.kegiatan, anggaran_btl.volume, anggaran.alamat, skpd.skpd_nama, admin.admin_nama FROM anggaran LEFT JOIN anggaran_btl ON anggaran.kode=anggaran_btl.anggaran_kode LEFT JOIN admin ON anggaran.admin_user=admin.admin_user LEFT JOIN skpd ON anggaran.skpd_kode=skpd.skpd_kode WHERE anggaran.tahun='".$laporan_tahun."' AND anggaran.tahapan_kode='13' ORDER BY anggaran.kegiatan ASC");
		  $data_reses						= $query->result();
		  $jumlah_reses						= $query->num_rows();
		  if ($jumlah_reses > 0){
		  foreach($data_reses as $row) {
			?>
			  <tr>
				<td style="text-align:center; padding: 0px; height: 20px;"><?php echo $i; ?></td>
				<td><?php echo $row->kegiatan; ?></td>
				<td><?php echo $row->alamat; ?></td>
				<td><?php echo $row->volume; ?></td>
				<td><?php echo $row->skpd_nama; ?></td>
				<td><?php echo $row->admin_nama; ?></td>
			  </tr>
			  <?php
			  $i++;
			}
		  }
			?>        
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