<?php		
if ($laporan_program == semua && $laporan_kegiatan == semua) {

		$strhtml .= "<table style='font-family: serif; border:1px solid #000;'>
			<tr>
				<th style='text-align:left; font-size:12pt; font-weight:0; border:1px solid #000; width:150px'>5</th>
				<th style='text-align:right; font-size:12pt; border:1px solid #000; width:600px'>skpd=$laporan_skpd -> program=$laporan_program -> kegiatan=$laporan_kegiatan -> tahapan=$laporan_tahapan -> belanja=$laporan_belanja -> tahun=$laporan_tahun -> tanggal=$laporan_tanggal -> nama=$laporan_pimpinan -> pangkat=$laporan_pangkat -> nip=$laporan_nip</th>
				<th style='text-align:right; font-size:12pt; border:1px solid #000; width:600px'>$rupiah</th>
			</tr>
			<tr>
				<th style='text-align:left; font-size:12pt; font-weight:0; border:1px solid #000; width:150px'>5.2</th>
				<th style='text-align:left; font-size:12pt; border:1px solid #000; width:500px'>BELANJA LANGSUNG</th>
				<th style='text-align:right; font-size:12pt; border:1px solid #000; width:600px'>AAA</th>
			</tr>
			</table>";
	
} else if ($laporan_kegiatan == semua) { 

		$strhtml .= "<table style='font-family: serif; border:1px solid #000;'>
			<tr>
				<th style='text-align:left; font-size:12pt; font-weight:0; border:1px solid #000; width:150px'>5</th>
				<th style='text-align:right; font-size:12pt; border:1px solid #000; width:600px'>skpd=$laporan_skpd -> program=$laporan_program -> kegiatan=$laporan_kegiatan -> tahapan=$laporan_tahapan -> belanja=$laporan_belanja -> tahun=$laporan_tahun -> tanggal=$laporan_tanggal -> nama=$laporan_pimpinan -> pangkat=$laporan_pangkat -> nip=$laporan_nip</th>
				<th style='text-align:right; font-size:12pt; border:1px solid #000; width:600px'>$rupiah</th>
			</tr>
			<tr>
				<th style='text-align:left; font-size:12pt; font-weight:0; border:1px solid #000; width:150px'>5.2</th>
				<th style='text-align:left; font-size:12pt; border:1px solid #000; width:500px'>BELANJA LANGSUNG</th>
				<th style='text-align:right; font-size:12pt; border:1px solid #000; width:600px'>BBB</th>
			</tr>
			</table>";

} else {
	
		$rupiah = rupiah1($jumlah);
		$strhtml .= "<table style='font-family: serif; font-size:12pt; font-weight:bold; border:1px solid #000;'>
			<tr>
			   <td style='text-align:center; border:1px solid #000; width:150px' rowspan='2'>KODE REKENING</td>
			   <td style='text-align:center; border:1px solid #000; width:500px' rowspan='2'>URAIAN</td>
			   <td style='text-align:center; border:1px solid #000;'colspan='3'>RINCIAN PERHITUNGAN </td>
			   <td style='text-align:center; border:1px solid #000; width:150px' rowspan='2'>JUMLAH<br>(Rp)</td>
			</tr>
			<tr>
			   <td style='text-align:center; border:1px solid #000; width:150px'>Volume</td>
			   <td style='text-align:center; border:1px solid #000; width:150px'>Satuan</td>
			   <td style='text-align:center; border:1px solid #000; width:150px'>Harga</td>
			</tr>
		   </table>";
			
		$strhtml .= "<table style='font-family: serif; font-size:11pt; border:1px solid #000;'>
			<tr>
				<th style='text-align:center; border:1px solid #000; width:150px'>1</th>
				<th style='text-align:center; border:1px solid #000; width:500px'>2</th>
				<th style='text-align:center; border:1px solid #000; width:150px'>3</th>
				<th style='text-align:center; border:1px solid #000; width:150px'>4</th>
				<th style='text-align:center; border:1px solid #000; width:150px'>5</th>
				<th style='text-align:center; border:1px solid #000; width:150px'>6</th>
			</tr>
			</table>";
			
		$strhtml .= "<table style='font-family: serif; border:1px solid #000;'>
			<tr>
				<th style='text-align:left; font-size:12pt; font-weight:0; border:1px solid #000; width:150px'>5</th>
				<th style='text-align:left; font-size:12pt; border:1px solid #000; width:500px'>BELANJA <br> skpd=$laporan_skpd <br> program=$laporan_program <br> kegiatan=$laporan_kegiatan <br> tahapan=$laporan_tahapan <br> belanja=$laporan_belanja <br> tahun=$laporan_tahun <br> tanggal=$laporan_tanggal <br> nama=$laporan_pimpinan <br> pangkat=$laporan_pangkat <br> nip=$laporan_nip</th>
				<th style='text-align:right; font-size:12pt; border:1px solid #000; width:600px'>$rupiah</th>
			</tr>
			<tr>
				<th style='text-align:left; font-size:12pt; font-weight:0; border:1px solid #000; width:150px'>5.2</th>
				<th style='text-align:left; font-size:12pt; border:1px solid #000; width:500px'>BELANJA LANGSUNG</th>
				<th style='text-align:right; font-size:12pt; border:1px solid #000; width:600px'>$rupiah</th>
			</tr>
			</table>";
			
	for ($i=1; $i < 4; $i++){
	$jenis_belanja 	= array('1'=>'63', '2'=>'64', '3'=>'65');	
	$jenis 			= array('1'=>'Belanja Pegawai', '2'=>'Belanja Barang dan Jasa', '3'=>'Belanja Modal');
	
	$query_belanja = $this->db->query("SELECT rka.kode as id_rka, rka.obyek as id_obyek, SUM(rka_sub.total) as totalRKA
	FROM rka_sub 
	LEFT JOIN rka ON rka_sub.rka=rka.kode
	WHERE rka.jenis='".$jenis_belanja[$i]."' 
	AND rka.program='".$laporan_program."'
	AND rka.anggaran_kode='".$laporan_kegiatan."'
	");
	$data_belanja			= $query_belanja->result();
		foreach($data_belanja as $row_belanja) {
		$totalRKA 	= rupiah1($row_belanja->totalRKA);
		$getRka		= $row_belanja->id_obyek;
		$strhtml .= "<table style='font-family: serif; border:1px solid #000;'>
			<tr>
				<th style='text-align:left; font-size:12pt; font-weight:0; border:1px solid #000; width:150px'>5.2.$i</th>
				<th style='text-align:left; font-size:12pt; border:1px solid #000; width:500px'>$jenis[$i]</th>
				<th style='text-align:right; font-size:12pt; border:1px solid #000; width:600px'>$totalRKA</th>
			</tr>
			</table>";

		$query_id = $this->db->query("SELECT rka.kode as id_rka, obyek.nomor as no_obyek, obyek.obyek_nama as nama_obyek
		FROM rka 
		LEFT JOIN obyek ON rka.obyek=obyek.kode 
		LEFT JOIN rka_sub ON rka.kode=rka_sub.kode 
		WHERE rka.jenis='".$jenis_belanja[$i]."' 
		AND rka.tipe_kode= '".$laporan_belanja."'
		AND rka.tahun='".$laporan_tahun."'
		AND rka.skpd='".$laporan_skpd."'
		AND rka.program='".$laporan_program."'
		AND rka.anggaran_kode='".$laporan_kegiatan."'
		GROUP BY rka.obyek ORDER BY rka.kode ASC");
		$data_id			= $query_id->result();
		foreach($data_id as $row_id) {
			$strhtml .= "<table style='font-family: serif; border:1px solid #000;'>
			<tr>
				<th style='text-align:left; font-size:12pt; font-style:italic; font-weight:0; border:1px solid #000; width:150px'>5.2.$i.$row_id->no_obyek</th>
				<th style='text-align:left; font-size:12pt; font-style:italic; font-weight:0; border:1px solid #000; width:500px'>$row_id->nama_obyek</th>";

			$query_total 	= $this->db->query("SELECT SUM(rka_sub.total) as totalRKA 
			FROM rka_sub
			LEFT JOIN rka ON rka_sub.rka=rka.kode
			WHERE rka_sub.tipe_kode= '".$laporan_belanja."'
			AND rka_sub.anggaran_kode='".$laporan_kegiatan."'
			AND rka_sub.rka='".$row_id->id_rka."'
			GROUP BY rka_sub.rka ORDER BY rka.kode ASC
			");
			$data_total 	= $query_total->result();
	
			foreach($data_total as $task){
			$totalRKA_task = rupiah1 ($task->totalRKA);
			$strhtml .= "<th style='text-align:right; font-size:12pt; font-style:italic; font-weight:0; border:1px solid #000; width:600px'>$totalRKA_task</th>
			</tr>
			</table>";
			}
			
			
			
			
			
			
			
			
			
			
			
			
			
	
			
			
			
			
			
			
			
			
			
			
			

		} 
	} }
	
} // END
	
$mpdf=new mPDF( '',                          // mode (default '')
                'A4', 0, '',               // format ('A4', '' or...), font size(default 0), font family
                5, 5, 5, 20, 5, 5,  //(margins) left, right, top, bottom, HEADER, FOOTER
                'L');
				
$mpdf->SetFooter('
<div class="satu"></div>
<table style="font-family: serif; font-size:5pt; border:1px solid #000;"><tr>
<th style="text-align:left; font-weight:0; border:1px solid #000; valign="top" width:50px">Formulir RKA SKPD 2.2.1 - '.$skpd.' <br>Tim Verivikasi</th>
<th style="text-align:left; font-weight:0; border:1px solid #000; width:50px">BAPPEDA</th>
<th style="text-align:left; font-weight:0; border:1px solid #000; width:50px">Pembangunan</th>
<th style="text-align:left; font-weight:0; border:1px solid #000; width:50px">BPKAD</th>
<th style="text-align:left; font-weight:0; border:1px solid #000; width:50px">Perlengkapan</th>
<th style="text-align:left; font-weight:0; border:1px solid #000; width:50px">Organisasi</th>
<th style="text-align:left; font-weight:0; border:1px solid #000; width:50px">Koordinator</th>
<th style="text-align:left; font-weight:0; border:1px solid #000; width:50px">BAPPEDA</th>
<th style="text-align:left; font-weight:0; border:1px solid #000; width:50px">BPKAD</th>
<th style="text-align:left; font-weight:0; border:1px solid #000; width:50px">Hal {PAGENO} <br> dari {nbpg}</th>
</tr></table>
<table style="font-family: serif; font-size:5pt;"><tr>
<th style="text-align:left; font-weight:0; width:50px">PrinTed By IntegRasi</th>
</tr></table>
');

$mpdf->WriteHTML($strhtml);
$mpdf->Output('');
?>