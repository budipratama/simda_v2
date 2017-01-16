<?php
if ($excel == TRUE){
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment;Filename=Laporan_Rekap_Program_".date("d_m_Y_H_i_s").".xls");
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=Windows-1252">
<title>LAPORAN REKAP INDIKATOR BELUM TERPAKAI</title>
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
    <td colspan="3" style="text-align:center; font-weight: bold; font-size: 15px; padding: 0px;">INDIKATOR YANG BELUM TERPAKAI TAHUN <?php echo $laporan_tahun; ?></td>
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
          <th style="width:140px">ANGGARAN TERPAKAI(Rp)</th>
          <th style="width:140px">SISA ANGGARAN (Rp)</th>
          <th style="width:200px">SKPD YANG MENGGUNAKAN ANGGARAN</th>
          <th style="width:150px">ANGGARAN YANG DIGUNAKAN SKPD (Rp)</th>
        </tr>
		<?php
		$total_anggaran = 0;
		$total_anggaran_terpakai = 0;
		$total_sisa_anggaran = 0;
		$total_anggaran_skpd = 0;
		$i = 1;
		
		$query_sasaran			= $this->db->query("SELECT sasaran.kode as sasaran_kode, sasaran.sasaran as sasaran_nama, SUM(anggaran_bl.apbd_kab) as jumlah_apbdKab FROM sasaran LEFT JOIN anggaran_bl ON sasaran.kode=anggaran_bl.sasaran_kode LEFT JOIN anggaran ON anggaran_bl.anggaran_kode=anggaran.kode WHERE anggaran.tahapan_kode='".$laporan_tahapan_kode."' AND anggaran.tahun='".$laporan_tahun."' GROUP BY sasaran.kode ORDER BY sasaran.kode ASC");
		$data_sasaran			= $query_sasaran->result();
		$jumlah_sasaran			= $query_sasaran->num_rows();
		if ($jumlah_sasaran > 0){
			foreach($data_sasaran as $row) {
				$tahun_ = 'tahun'.$laporan_tahun;
				$query_indikator		= $this->db->query("SELECT indikator.kode as indikator_kode, indikator.indikator as indikator_nama, SUM(anggaran_bl.apbd_kab) as jumlah_apbdKab, indikator.$tahun_ as $tahun_ FROM indikator LEFT JOIN anggaran_bl ON indikator.kode=anggaran_bl.indikator_kode LEFT JOIN anggaran ON anggaran_bl.anggaran_kode=anggaran.kode WHERE anggaran.tahapan_kode='".$laporan_tahapan_kode."' AND anggaran.tahun='".$laporan_tahun."' AND anggaran_bl.sasaran_kode='".$row->sasaran_kode."' GROUP BY indikator.kode ORDER BY indikator.kode ASC");
				$data_indikator			= $query_indikator->result();
				$jumlah_indikator		= $query_indikator->num_rows();
				if($jumlah_indikator > 0){
					if ($row->sasaran_kode == 1){
						$where_program_rutin['kode']	= 1;
						$digunakan						= $this->db->query("SELECT SUM(anggaran_bl.apbd_kab) as telah_digunakan FROM anggaran LEFT JOIN anggaran_bl ON anggaran.kode=anggaran_bl.anggaran_kode WHERE anggaran.tahapan_kode='".$laporan_tahapan_kode."' AND anggaran.tahun='".$laporan_tahun."' AND (anggaran_bl.indikator_kode > 0 AND anggaran_bl.indikator_kode < 9)")->row();
						$anggaran_tahunan				= $this->Anggaran_rutin_model->get('*', $where_program_rutin);
						$tahun_anggaran					= 'anggaran'.$laporan_tahun;
						$sisa_anggaran					= $anggaran_tahunan->$tahun_anggaran - $digunakan->telah_digunakan; 
					}
					
					if ($row->sasaran_kode == 1) { 
						$total_anggaran = $total_anggaran + $anggaran_tahunan->$tahun_anggaran; 
						$total_anggaran_terpakai = $total_anggaran_terpakai + $digunakan->telah_digunakan;
						$total_sisa_anggaran = $total_sisa_anggaran + $sisa_anggaran;
					}
					
					?>
					<tr style="font-weight:bold;">
						<td style="text-align:center;"><?php echo $i; ?></td>
						<td><?php echo $row->sasaran_nama; ?></td>
						<td></td>
						<td style="text-align:right;"><?php if ($row->sasaran_kode == 1) { echo rupiah($anggaran_tahunan->$tahun_anggaran); }?></td>
						<td style="text-align:right;"><?php if ($row->sasaran_kode == 1) { echo rupiah($digunakan->telah_digunakan); }?></td>
						<td style="text-align:right;"><?php if ($row->sasaran_kode == 1) { echo rupiah($sisa_anggaran); }?></td>
						<td></td>		
						<td></td>
					</tr>
					<?php
					foreach($data_indikator as $row_indikator) {
						if ($row->sasaran_kode != 1) { 
							$total_anggaran = $total_anggaran + $row_indikator->$tahun_; 
							$total_anggaran_terpakai = $total_anggaran_terpakai + $row_indikator->jumlah_apbdKab;
							$total_sisa_anggaran = $total_sisa_anggaran + ($row_indikator->$tahun_ - $row_indikator->jumlah_apbdKab);
						}
						?>
						<tr>
							<td></td>
							<td></td>
							<td><?php echo $row_indikator->indikator_nama; ?></td>
							<td style="text-align:right;"><?php if ($row->sasaran_kode != 1) { echo rupiah($row_indikator->$tahun_); }?></td>
							<td style="text-align:right;"><?php echo rupiah($row_indikator->jumlah_apbdKab);?></td>
							<td style="text-align:right;"><?php if ($row->sasaran_kode != 1) { echo rupiah($row_indikator->$tahun_ - $row_indikator->jumlah_apbdKab); }?></td>
							<td></td>
							<td></td>
						</tr>
						<?php 
						$query_skpd		= $this->db->query("SELECT skpd.skpd_kode, skpd.skpd_nomor, skpd.skpd_nama, SUM(anggaran_bl.apbd_kab) as jumlah_apbdKab FROM skpd LEFT JOIN anggaran ON skpd.skpd_kode=anggaran.skpd_kode LEFT JOIN anggaran_bl ON anggaran.kode=anggaran_bl.anggaran_kode LEFT JOIN indikator ON anggaran_bl.indikator_kode=indikator.kode WHERE skpd_status IN ('SKPD', 'Kecamatan') AND anggaran.tahapan_kode='".$laporan_tahapan_kode."' AND anggaran.tahun='".$laporan_tahun."' AND indikator.kode='".$row_indikator->indikator_kode."' GROUP BY skpd.skpd_kode ORDER BY skpd.skpd_kode ASC");
						$data_skpd		= $query_skpd->result();
						$jumlah_skpd	= $query_skpd->num_rows();
						if ($jumlah_skpd > 0){
							foreach($data_skpd as $row_skpd) {
								$total_anggaran_skpd = $total_anggaran_skpd + $row_skpd->jumlah_apbdKab;
								?>
									<tr>              
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td><?php echo $row_skpd->skpd_nama;?></td>
										<td style="text-align:right;"><?php echo rupiah($row_skpd->jumlah_apbdKab);?></td>
									</tr>
								<?php
							}
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
				<td style="text-align:right;"><?php echo rupiah($total_anggaran_terpakai); ?></td>
				<td style="text-align:right;"><?php echo rupiah($total_sisa_anggaran); ?></td>
				<td style="text-align:right;"></td>		
				<td style="text-align:right;"><?php echo rupiah($total_anggaran_skpd); ?></td>
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