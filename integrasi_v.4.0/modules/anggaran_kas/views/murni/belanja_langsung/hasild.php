<?php
$query_jumlah = mysql_query("SELECT SUM(total) 
	FROM rka_sub 
	WHERE rka_sub.tipe_kode= '1' 
	AND rka_sub.anggaran_kode='".$laporan_anggaran."' 
	ORDER BY rka_sub.kode ASC"); 
	$data = mysql_fetch_array($query_jumlah); $jumlah = $data[0];
	
	$query_get = $this->db->query("SELECT program.program as id_program, program.nomor as no_program, skpd.skpd_nama as id_skpd, 
	skpd.urusan as id_urusan, urusan.urusan as nama_urusan, urusan.jenis as jenis_urusan, skpd.skpd_nomor as no_skpd,
	skpd.skpd_alamat as alamat_skpd, skpd.skpd_status as status_skpd, anggaran.kegiatan as id_anggaran, anggaran.nomor as no_anggaran,
	anggaran_bl.hp_ukur as hpu_anggaran, anggaran_bl.hp_target as hpt_anggaran, anggaran_bl.hp_satuan as hps_anggaran,
	anggaran_bl.kh_ukur as khu_anggaran, anggaran_bl.kh_target as kht_anggaran, anggaran_bl.kh_satuan as khs_anggaran,
	anggaran_bl.hk_ukur as hku_anggaran, anggaran_bl.hk_target as hkt_anggaran, anggaran_bl.hk_satuan as hks_anggaran,
	tim_anggaran.nama as nama_tim, tim_anggaran.nip as nip_tim, tim_anggaran.jabatan as jabatan_tim, tipe.no as no_tipe, tipe.tipe_nama as nama_tipe
	FROM rka 
	LEFT JOIN program ON rka.program=program.kode
	LEFT JOIN skpd ON rka.skpd=skpd.skpd_kode
	LEFT JOIN urusan ON rka.urusan=urusan.kode
	LEFT JOIN anggaran ON rka.anggaran_kode=anggaran.kode
	LEFT JOIN anggaran_bl ON rka.anggaran_kode=anggaran_bl.kode
	LEFT JOIN tipe ON rka.sumber=tipe.tipe_kode
	LEFT JOIN tim_anggaran ON rka.skpd=tim_anggaran.skpd
	WHERE rka.tipe_kode= '1'
	AND rka.kode='".$laporan_kode."'
	AND rka.skpd='".$laporan_skpd."'
	AND rka.tahun='".$laporan_tahun."'
	AND rka.anggaran_kode='".$laporan_anggaran."' 
	GROUP BY rka.kode ORDER BY rka.kode ASC");
	$data_get			= $query_get->result();
	foreach($data_get as $row_get) {
	$strhtml0 .= "<br><br><table style='font-family: serif;'>
		<tr>
		   <td style='text-align:center;' colspan='3'><img src='public/dist/img/logo.jpg' alt='logo' width='100' height='100' border='0'/></td>
		</tr>
		<tr>
		   <td style='text-align:center; font-size:8pt; font-weight:bold;' colspan='3'>PEMERINTAH KABUPATEN BEKASI</td>
		</tr>
		<tr>
		   <td style='text-align:center; font-size:12pt; font-weight:bold;' colspan='3'>DOKUMEN PELAKSANAAN ANGGARAN<br>SATUAN KERJA PERANGKAT DAERAH<br>( DPA SKPD )</td>
		</tr>
		<tr>
		   <td style='text-align:center; font-size:8pt; font-weight:bold;' colspan='3'>TAHUN ANGGARAN : $laporan_tahun</td>
		</tr>		
		<tr>
		   <td style='text-align:center; font-size:12pt; font-weight:bold;' colspan='3'>BELANJA LANGSUNG</td>
		</tr>
	   </table>";
	   
	$strhtml0 .= "<table style='font-family: serif; font-size:18pt; font-weight:bold;'>
		<tr>
		   <td style='text-align:center; width:500px'>&nbsp;</td>
		   <td style='text-align:center; width:250px'>NO DPA SKPD :</td>
		   <td style='text-align:center; border:1px solid #000; width:150px'>1.$row_get->id_urusan</td>
		   <td style='text-align:center; border:1px solid #000; width:150px'>0.00</td>
		   <td style='text-align:center; border:1px solid #000; width:150px'>0.00</td>
		   <td style='text-align:center; border:1px solid #000; width:150px'>0.00</td>
		   <td style='text-align:center; border:1px solid #000; width:150px'>0.00</td>
		   <td style='text-align:center; border:1px solid #000; width:150px'>0.00</td>
		   <td style='text-align:center; width:500px'>&nbsp;</td>
		</tr>
	   </table><br><br><br><br>";
	   
	$strhtml0 .= "<br><br><table style='font-family: serif;'>
			<tr>
				<th style='text-align:left; width:50px'>&nbsp;</th>
				<th style='text-align:left; font-size:15pt; width:300px'>URUSAN PEMERINTAHAN</th>
				<th style='text-align:left; font-size:15pt; font-weight:0; width:300px'>: 1.$row_get->id_urusan . 1.$row_get->id_urusan</th>
				<th style='text-align:left; font-size:15pt; font-weight:0; width:700px'>$row_get->jenis_urusan $row_get->nama_urusan</th>
				<th style='text-align:left; width:50px'>&nbsp;</th>
			</tr> 
			<tr>
				<th style='text-align:left; width:50px'>&nbsp;</th>
				<th style='text-align:left; font-size:15pt; width:300px'>ORGANISASI</th>
				<th style='text-align:left; font-size:15pt; font-weight:0; width:300px'>: 1.$row_get->id_urusan . 1.$row_get->id_urusan.$row_get->no_skpd</th>
				<th style='text-align:left; font-size:15pt; font-weight:0; width:700px'>$row_get->id_skpd</th>
				<th style='text-align:left; width:50px'>&nbsp;</th>
			</tr> 
			<tr>
				<th style='text-align:left; width:50px'>&nbsp;</th>
				<th style='text-align:left; font-size:15pt; width:300px'>SUB UNIT ORGANISASI</th>
				<th style='text-align:left; font-size:15pt; font-weight:0; width:300px'>: 1.$row_get->id_urusan . 1.$row_get->id_urusan.$row_get->no_skpd . $row_get->no_skpd</th>
				<th style='text-align:left; font-size:15pt; font-weight:0; width:700px'>$row_get->id_skpd</th>
				<th style='text-align:left; width:50px'>&nbsp;</th>
			</tr> 
			<tr>
				<th style='text-align:left; width:50px'>&nbsp;</th>
				<th style='text-align:left; font-size:15pt; width:300px'>PROGRAM</th>
				<th style='text-align:left; font-size:15pt; font-weight:0; width:300px'>: 1.$row_get->id_urusan . 1.$row_get->id_urusan.$row_get->no_skpd . $row_get->no_program</th>
				<th style='text-align:left; font-size:15pt; font-weight:0; width:700px'>$row_get->id_program</th>
				<th style='text-align:left; width:50px'>&nbsp;</th>
			</tr> 
			<tr>
				<th style='text-align:left; width:50px'>&nbsp;</th>
				<th style='text-align:left; font-size:15pt; width:300px'>KEGIATAN</th>
				<th style='text-align:left; font-size:15pt; font-weight:0; width:300px'>: 1.$row_get->id_urusan . 1.$row_get->id_urusan.$row_get->no_skpd . $row_get->no_program . 01</th>
				<th style='text-align:left; font-size:15pt; font-weight:0; width:700px'>$row_get->id_anggaran</th>
				<th style='text-align:left; width:50px'>&nbsp;</th>
			</tr>
			</table><br>";
				
	$rupiah = rupiah1($jumlah);
	$terbilang = Terbilang($jumlah);		
	$strhtml0 .= "<table style='font-family: serif;'>
			<tr>
				<th style='text-align:left; width:50px'>&nbsp;</th>
				<th style='text-align:left; font-size:15pt; width:300px'>LOKASI KEGIATAN</th>
				<th style='text-align:left; font-size:15pt; font-weight:0; width:1000px'>: $row_get->alamat_skpd</th>
				<th style='text-align:left; width:50px'>&nbsp;</th>
			</tr> 
			<tr>
				<th style='text-align:left; width:50px'>&nbsp;</th>
				<th style='text-align:left; font-size:15pt; width:300px'>SUMBER DANA</th>
				<th style='text-align:left; font-size:15pt; font-weight:0; width:1000px'>: $row_get->no_tipe &nbsp; &nbsp; &nbsp; $row_get->nama_tipe</th>
				<th style='text-align:left; width:50px'>&nbsp;</th>
			</tr> 
			<tr>
				<th style='text-align:left; width:50px'>&nbsp;</th>
				<th style='text-align:left; font-size:15pt; width:300px'>JUMLAH ANGGARAN</th>
				<th style='text-align:left; font-size:15pt; font-weight:0; width:1000px'>: Rp. $rupiah &nbsp; &nbsp; &nbsp; ($terbilang rupiah )</th>				
				<th style='text-align:left; width:50px'>&nbsp;</th>
			</tr>
			</table><br>";
	$jabatan = strtoupper($laporan_pangkat);
	$skpd = strtoupper($row_get->id_skpd);
	$strhtml0 .= "<table style='font-family: serif;'>
			<tr>
				<th style='text-align:left; width:50px'>&nbsp;</th>
				<th style='text-align:left; font-size:12pt; width:300px'>PENGGUNA ANGGARAN/<br>KUASA PENGGUNA ANGGARAN</th>
				<th style='text-align:left; width:1000px'>&nbsp;</th>
				<th style='text-align:left; width:50px'>&nbsp;</th>
			</tr> 
			<tr>
				<th style='text-align:left; width:50px'>&nbsp;</th>
				<th style='text-align:left; font-size:15pt; width:300px'>&nbsp; &nbsp; &nbsp; NAMA</th>
				<th style='text-align:left; font-size:15pt; font-weight:0; width:1000px'>: $laporan_pimpinan</th>
				<th style='text-align:left; width:50px'>&nbsp;</th>
			</tr> 
			<tr>
				<th style='text-align:left; width:50px'>&nbsp;</th>
				<th style='text-align:left; font-size:15pt; width:300px'>&nbsp; &nbsp; &nbsp; NIP</th>
				<th style='text-align:left; font-size:15pt; font-weight:0; width:1000px'>: $laporan_nip</th>				
				<th style='text-align:left; width:50px'>&nbsp;</th>
			</tr>
			<tr>
				<th style='text-align:left; width:50px'>&nbsp;</th>
				<th style='text-align:left; font-size:15pt; width:300px'>&nbsp; &nbsp; &nbsp; JABATAN</th>
				<th style='text-align:left; font-size:15pt; font-weight:0; width:1000px'>: $jabatan $skpd</th>				
				<th style='text-align:left; width:50px'>&nbsp;</th>
			</tr>
			</table>";
	
	$strhtml .= "<table style='font-family: serif; border:1px solid #000;'>
			<tr>
			   <td style='text-align:center; width:150px' rowspan='2'><img src='public/dist/img/logo.jpg' alt='logo' width='70' height='70' border='0'/></td>
			   <td style='text-align:center; font-size:15pt; font-weight:bold; width:500px' rowspan='2'>DOKUMEN PELAKSANAAN ANGGARAN<br>SATUAN KERJA PERANGKAT DAERAH</td>
			   <td style='text-align:center; font-size:15pt; font-weight:bold; border:1px solid #000;'colspan='6'>NOMOR DPA SKPD</td>
			   <td style='text-align:center; font-size:15pt; font-weight:bold; border:1px solid #000; width:150px' rowspan='2'>Formulir<br>DPA SKPD<br>2.2.1</td>
			</tr>
			<tr>
			   <td style='text-align:center; font-size:10pt; font-weight:0; border:1px solid #000; width:50px'>1.$row_get->id_urusan</td>
			   <td style='text-align:center; font-size:10pt; font-weight:0; border:1px solid #000; width:50px'>0.00</td>
			   <td style='text-align:center; font-size:10pt; font-weight:0; border:1px solid #000; width:50px'>0.00</td>
			   <td style='text-align:center; font-size:10pt; font-weight:0; border:1px solid #000; width:50px'>0.00</td>
			   <td style='text-align:center; font-size:10pt; font-weight:0; border:1px solid #000; width:50px'>0.00</td>
			   <td style='text-align:center; font-size:10pt; font-weight:0; border:1px solid #000; width:50px'>0.00</td>
			</tr>
		   </table>";
		   
		$strhtml .= "<table style='font-family: serif; border:1px solid #000;'>
			<tr>
				<th style='text-align:center; font-size:9pt; width:150px'>PEMERINTAH KABUPATEN BEKASI<br>Tahun Anggaran : $laporan_tahun</th>
			</tr> 
			</table>";
	
		$strhtml .= "<table style='font-family: serif; border:1px solid #000;'>
			<tr>
				<th style='text-align:left; font-size:12pt; width:200px'>Urusan Pemerintahan</th>
				<th style='text-align:left; font-size:12pt; font-weight:0; width:200px'>: 1.$row_get->id_urusan . 1.$row_get->id_urusan</th>
				<th style='text-align:left; font-size:12pt; font-weight:0; width:800px'>$row_get->jenis_urusan $row_get->nama_urusan</th>
			</tr> 
			<tr>
				<th style='text-align:left; font-size:12pt; width:100px'>Organisasi</th>
				<th style='text-align:left; font-size:12pt; font-weight:0; width:200px'>: 1.$row_get->id_urusan . 1.$row_get->id_urusan.$row_get->no_skpd</th>
				<th style='text-align:left; font-size:12pt; font-weight:0; width:800px'>$row_get->id_skpd</th>
			</tr> 
			<tr>
				<th style='text-align:left; font-size:12pt; width:100px'>Sub Unit Organisasi</th>
				<th style='text-align:left; font-size:12pt; font-weight:0; width:200px'>: 1.$row_get->id_urusan . 1.$row_get->id_urusan.$row_get->no_skpd . $row_get->no_skpd</th>
				<th style='text-align:left; font-size:12pt; font-weight:0; width:800px'>$row_get->id_skpd</th>
			</tr> 
			<tr>
				<th style='text-align:left; font-size:12pt; width:100px'>Program</th>
				<th style='text-align:left; font-size:12pt; font-weight:0; width:200px'>: 1.$row_get->id_urusan . 1.$row_get->id_urusan.$row_get->no_skpd . $row_get->no_program</th>
				<th style='text-align:left; font-size:12pt; font-weight:0; width:800px'>$row_get->id_program</th>
			</tr> 
			<tr>
				<th style='text-align:left; font-size:12pt; width:100px'>Kegiatan</th>
				<th style='text-align:left; font-size:12pt; font-weight:0; width:200px'>: 1.$row_get->id_urusan . 1.$row_get->id_urusan.$row_get->no_skpd . $row_get->no_program . 01</th>
				<th style='text-align:left; font-size:12pt; font-weight:0; width:800px'>$row_get->id_anggaran</th>
			</tr> 
			</table>";
			
		$strhtml .= "<table style='font-family: serif; border:1px solid #000;'>
			<tr>
				<th style='text-align:left; font-size:9pt; width:200px'>Lokasi Kegiatan</th>
				<th style='text-align:left; font-size:9pt; font-weight:0; width:660px'>: $row_get->alamat_skpd</th>
			</tr> 
			</table>";
			
		$strhtml .= "<table style='font-family: serif; border:1px solid #000;'>
			<tr>
				<th style='text-align:left; font-size:9pt; width:200px'>Sumber Dana</th>
				<th style='text-align:left; font-size:9pt; font-weight:0; width:660px'>: $row_get->no_tipe &nbsp; &nbsp; &nbsp; $row_get->nama_tipe</th>
			</tr> 
			</table>";
			
		$strhtml .= "<table style='font-family: serif; border:1px solid #000;'>
			<tr>
				<th style='text-align:center; font-size:9pt; width:150px'>INDIKATOR & TOLOK UKUR KINERJA BELANJA LANGSUNG</th>
			</tr> 
			</table>";
			
		$strhtml .= "<table style='font-family: serif; border:1px solid #000;'>
			<tr>
				<th style='text-align:center; border:1px solid #000; width:200px'>INDIKATOR</th>
				<th style='text-align:center; border:1px solid #000; width:700px'>TOLOK UKUR KERJA</th>
				<th style='text-align:center; border:1px solid #000; width:300px'>TARGET KINERJA</th>
			</tr> 
			</table>";
			
		$strhtml .= "<table style='font-family: serif; border:1px solid #000;'>
			<tr>
				<th style='text-align:left; font-size:12pt; border:1px solid #000; width:200px'>CAPAIAN PROGRAM</th>
				<th style='text-align:left; font-size:12pt; font-weight:0; border:1px solid #000; width:700px'>$row_get->hpu_anggaran</th>
				<th style='text-align:left; font-size:12pt; font-weight:0; border:1px solid #000; width:300px'>$row_get->hpt_anggaran $row_get->hps_anggaran</th>
			</tr> 
			</table>";
			
		$strhtml .= "<table style='font-family: serif; border:1px solid #000;'>
			<tr>
				<th style='text-align:left; font-size:12pt; border:1px solid #000; width:200px'>MASUKAN</th>
				<th style='text-align:left; font-size:12pt; font-weight:0; border:1px solid #000; width:700px'>Jumlah Dana</th>
				<th style='text-align:left; font-size:12pt; font-weight:0; border:1px solid #000; width:300px'>Rp. $rupiah</th>
			</tr> 
			</table>";
		
		$strhtml .= "<table style='font-family: serif; border:1px solid #000;'>
			<tr>
				<th style='text-align:left; font-size:12pt; border:1px solid #000; width:200px'>KELUARAN</th>
				<th style='text-align:left; font-size:12pt; font-weight:0; border:1px solid #000; width:700px'>$row_get->khu_anggaran</th>
				<th style='text-align:left; font-size:12pt; font-weight:0; border:1px solid #000; width:300px'>$row_get->kht_anggaran $row_get->khs_anggaran</th>
			</tr> 
			</table>";
			
		$strhtml .= "<table style='font-family: serif; border:1px solid #000;'>
			<tr>
				<th style='text-align:left; font-size:12pt; border:1px solid #000; width:200px'>HASIL</th>
				<th style='text-align:left; font-size:12pt; font-weight:0; border:1px solid #000; width:700px'>$row_get->hku_anggaran</th>
				<th style='text-align:left; font-size:12pt; font-weight:0; border:1px solid #000; width:300px'>$row_get->hkt_anggaran $row_get->hks_anggaran</th>
			</tr> 
			</table>";
			
		$strhtml .= "<table style='font-family: serif; border:1px solid #000;'>
			<tr>
				<th style='text-align:left; font-size:9pt; width:200px'>Kelompok Sasaran Kegiatan</th>
				<th style='text-align:left; font-size:9pt; font-weight:0; width:660px'>: $row_get->status_skpd</th>
			</tr> 
			</table>";
			
		$strhtml .= "<table style='font-family: serif; border:1px solid #000;'>
			<tr>
				<th style='text-align:center; font-size:9pt; width:150px'>RINCIAN DOKUMEN PELAKSANAAN ANGGARAN BELANJA LANGSUNG<br>PROGRAM DAN PER KEGIATAN SATUAN KERJA PERANGKAT DAERAH</th>
			</tr> 
			</table>";
	}
		$strhtml .= "<table style='font-family: serif; font-size:11pt; font-weight:bold; border:1px solid #000;'>
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
				<th style='text-align:center; border:1px solid #000; width:150px'>6 = 3 x 5</th>
			</tr>
			</table>";
			
		$strhtml .= "<table style='font-family: serif; border:1px solid #000;'>
			<tr>
				<th style='text-align:left; font-size:12pt; font-weight:0; border:1px solid #000; width:150px'>5</th>
				<th style='text-align:left; font-size:12pt; border:1px solid #000; width:500px'>BELANJA</th>
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
	$query_belanja	= mysql_query("SELECT SUM(rka_sub.total) as totalRKA 
	FROM rka_sub 
	INNER JOIN rka ON rka_sub.rka=rka.kode
	WHERE rka_sub.tipe_kode= '1' 
	AND rka.jenis='".$jenis_belanja[$i]."' 
	AND rka.tahun='".$laporan_tahun."' 
	AND rka_sub.anggaran_kode='".$laporan_anggaran."' 
	");
	while($row_belanja=mysql_fetch_array($query_belanja)){
		$totalRKA = rupiah1($row_belanja['totalRKA']);
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
		WHERE rka.tipe_kode= '1' 
		AND rka.jenis='".$jenis_belanja[$i]."' 
		AND rka.tahun='".$laporan_tahun."' 
		AND rka.anggaran_kode='".$laporan_anggaran."' 
		GROUP BY rka.kode ORDER BY rka.kode ASC");
		$data_id			= $query_id->result();
		foreach($data_id as $row_id) {
			$strhtml .= "<table style='font-family: serif; border:1px solid #000;'>
			<tr>
				<th style='text-align:left; font-size:12pt; font-style:italic; font-weight:0; border:1px solid #000; width:150px'>5.2.$i.$row_id->no_obyek</th>
				<th style='text-align:left; font-size:12pt; font-style:italic; font-weight:0; border:1px solid #000; width:500px'>$row_id->nama_obyek</th>";
				
			$query_total 	= $this->db->query("SELECT SUM(rka_sub.total) as totalRKA 
			FROM rka_sub 
			WHERE rka_sub.tipe_kode= '1'
			AND rka_sub.anggaran_kode='".$laporan_anggaran."' 
			AND rka_sub.rka='".$row_id->id_rka."'
			");			
			$data_total 	= $query_total->result();
	
			if($data_total){ foreach($data_total as $task){
			$totalRKA_task = rupiah1 ($task->totalRKA);
			$strhtml .= "<th style='text-align:right; font-size:12pt; font-style:italic; font-weight:0; border:1px solid #000; width:600px'>$totalRKA_task</th>
			</tr>
			</table>";
			} }
			
			$query_rka = $this->db->query("SELECT rincian.nomor as no_rincian, rincian.rincian_nama as nama_rincian
			FROM rka 
			LEFT JOIN rincian ON rka.rincian=rincian.kode 
			LEFT JOIN rka_sub ON rka.kode=rka_sub.kode 
			WHERE rka.tipe_kode= '1' 
			AND rka.tahun='".$laporan_tahun."' 
			AND rka.anggaran_kode='".$laporan_anggaran."'
			AND rka.kode='".$row_id->id_rka."' 
			GROUP BY rka.kode ORDER BY rka.kode ASC");
			$data_rka	= $query_rka->result();
			foreach($data_rka as $row_rka) {
			$strhtml .= "<table style='font-family: serif; border:1px solid #000;'>
			<tr>
				<th style='text-align:left; font-size:12pt; font-weight:0; border:1px solid #000; width:150px'>5.2.$i.$row_id->no_obyek.$row_rka->no_rincian</th>
				<th style='text-align:left; font-size:12pt; font-weight:0; border:1px solid #000; width:500px'>$row_rka->nama_rincian</th>";
				
			$query_jumlah 	= $this->db->query("SELECT SUM(rka_sub.total) as totalRKA 
			FROM rka_sub 
			WHERE rka_sub.tipe_kode= '1'
			AND rka_sub.anggaran_kode='".$laporan_anggaran."' 
			AND rka_sub.rka='".$row_id->id_rka."' ");			
			$data_jumlah 	= $query_jumlah->result();
			if($data_jumlah){ foreach($data_jumlah as $task){
			$totalRKA_task = rupiah1 ($task->totalRKA);
			$strhtml .= "<th style='text-align:right; font-size:12pt; font-weight:0; border:1px solid #000; width:600px'>$totalRKA_task</th>
			</tr>
			</table>";
			} }
			
				$query_rincian = $this->db->query("SELECT rka_rincian.kode as id_rincian, rka_rincian.no as no_rincian, rka_rincian.uraian as nama_rincian 
				FROM rka_rincian 
				LEFT JOIN rka ON rka.kode=rka_rincian.kode 
				WHERE rka_rincian.tipe_kode= '1' 
				AND rka_rincian.anggaran_kode='".$laporan_anggaran."' 
				AND rka_rincian.rka='".$row_id->id_rka."' 
				GROUP BY rka_rincian.kode ORDER BY rka_rincian.kode ASC");
				$data_rincian	= $query_rincian->result();				
				foreach($data_rincian as $row_rincian) {
				$strhtml .= "<table style='font-family: serif; border:1px solid #000;'>
				<tr>
					<th style='text-align:left; font-size:12pt; font-weight:0; border:1px solid #000; width:150px'></th>
					<th style='text-align:left; font-size:12pt; font-weight:0; border:1px solid #000; width:500px'>$row_rincian->nama_rincian</th>";
					
				$query_hasil 	= $this->db->query("SELECT SUM(rka_sub.total) as totalRKA 
				FROM rka_sub 
				WHERE rka_sub.tipe_kode= '1'
				AND rka_sub.anggaran_kode='".$laporan_anggaran."' 
				AND rka_sub.rka='".$row_id->id_rka."'
				AND rka_sub.rka_rincian='".$row_rincian->id_rincian."'
				");			
				$data_hasil 	= $query_hasil->result();
				
				if($data_hasil){ foreach($data_hasil as $task){
				$totalRKA_task = rupiah1 ($task->totalRKA);
				$strhtml .= "<th style='text-align:right; font-size:12pt; font-weight:0; border:1px solid #000; width:600px'>$totalRKA_task</th>
				</tr>
				</table>";	
				} }
				
					$query_sub = $this->db->query("SELECT rka_sub.kode as id_sub, rka_sub.total, rka_sub.harga, rka_sub.satuan, rka_sub.volume, rka_sub.uraian 
					FROM rka_sub 
					LEFT JOIN rka ON rka.kode=rka_sub.kode 
					WHERE rka_sub.tipe_kode= '1'
					AND rka_sub.rka='".$row_id->id_rka."' 
					AND rka_sub.rka_rincian='".$row_rincian->id_rincian."' 
					GROUP BY rka_sub.kode ORDER BY rka_sub.kode ASC");	
					$data_sub	= $query_sub->result();
					foreach($data_sub as $row_sub) {						
					$harga = rupiah1 ($row_sub->harga);
					$total = rupiah1 ($row_sub->total);
					$strhtml .= "<table style='font-family: serif; border:1px solid #000;'>
					<tr>
						<th style='text-align:center; font-size:12pt; font-weight:0; border:1px solid #000; width:150px'></th>
						<th style='text-align:left; font-size:12pt; font-weight:0; border:1px solid #000; width:500px'>  - $row_sub->uraian</th>
						<th style='text-align:center; font-size:12pt; font-weight:0; border:1px solid #000; width:150px'>$row_sub->volume</th>
						<th style='text-align:center; font-size:12pt; font-weight:0; border:1px solid #000; width:150px'>$row_sub->satuan</th>
						<th style='text-align:right; font-size:12pt; font-weight:0; border:1px solid #000; width:150px'>$harga</th>
						<th style='text-align:right; font-size:12pt; font-weight:0; border:1px solid #000; width:150px'>$total</th>
					</tr>
					</table>";

		} } } }
	} }
	
	$query_get = $this->db->query("SELECT program.program as id_program, program.nomor as no_program, skpd.skpd_kode, skpd.skpd_nama as id_skpd,
	skpd.urusan as id_urusan, urusan.urusan as nama_urusan, urusan.jenis as jenis_urusan, skpd.skpd_nomor as no_skpd,
	skpd.skpd_alamat as alamat_skpd, skpd.skpd_status as status_skpd, anggaran.kegiatan as id_anggaran, anggaran.nomor as no_anggaran,
	anggaran_bl.hp_ukur as hpu_anggaran, anggaran_bl.hp_target as hpt_anggaran, anggaran_bl.hp_satuan as hps_anggaran,
	anggaran_bl.kh_ukur as khu_anggaran, anggaran_bl.kh_target as kht_anggaran, anggaran_bl.kh_satuan as khs_anggaran,
	anggaran_bl.hk_ukur as hku_anggaran, anggaran_bl.hk_target as hkt_anggaran, anggaran_bl.hk_satuan as hks_anggaran,
	tim_anggaran.nama as nama_tim, tim_anggaran.nip as nip_tim, tim_anggaran.jabatan as jabatan_tim
	FROM rka 
	LEFT JOIN program ON rka.program=program.kode
	LEFT JOIN skpd ON rka.skpd=skpd.skpd_kode
	LEFT JOIN urusan ON rka.urusan=urusan.kode
	LEFT JOIN anggaran ON rka.anggaran_kode=anggaran.kode
	LEFT JOIN anggaran_bl ON rka.anggaran_kode=anggaran_bl.kode
	LEFT JOIN tim_anggaran ON rka.skpd=tim_anggaran.skpd
	WHERE rka.tipe_kode= '1'
	AND rka.kode='".$laporan_kode."'
	AND rka.skpd='".$laporan_skpd."'
	AND rka.tahun='".$laporan_tahun."'
	AND rka.anggaran_kode='".$laporan_anggaran."' 
	GROUP BY rka.kode ORDER BY rka.kode ASC");
	$data_get			= $query_get->result();
	foreach($data_get as $row_get) {
	
		$strhtml2 .= "<table style='font-family: serif; border:1px solid #000;'>
			<tr>
				<th style='text-align:left; font-size:12pt; width:200px'>Urusan Pemerintahan</th>
				<th style='text-align:left; font-size:12pt; font-weight:0; width:200px'>: 1.$row_get->id_urusan . 1.$row_get->id_urusan</th>
				<th style='text-align:left; font-size:12pt; font-weight:0; width:800px'>$row_get->jenis_urusan $row_get->nama_urusan</th>
			</tr> 
			<tr>
				<th style='text-align:left; font-size:12pt; width:100px'>Organisasi</th>
				<th style='text-align:left; font-size:12pt; font-weight:0; width:200px'>: 1.$row_get->id_urusan . 1.$row_get->id_urusan.$row_get->no_skpd</th>
				<th style='text-align:left; font-size:12pt; font-weight:0; width:800px'>$row_get->id_skpd</th>
			</tr> 
			<tr>
				<th style='text-align:left; font-size:12pt; width:100px'>Sub Unit Organisasi</th>
				<th style='text-align:left; font-size:12pt; font-weight:0; width:200px'>: 1.$row_get->id_urusan . 1.$row_get->id_urusan.$row_get->no_skpd . $row_get->no_skpd</th>
				<th style='text-align:left; font-size:12pt; font-weight:0; width:800px'>$row_get->id_skpd</th>
			</tr> 
			<tr>
				<th style='text-align:left; font-size:12pt; width:100px'>Program</th>
				<th style='text-align:left; font-size:12pt; font-weight:0; width:200px'>: 1.$row_get->id_urusan . 1.$row_get->id_urusan.$row_get->no_skpd . $row_get->no_program</th>
				<th style='text-align:left; font-size:12pt; font-weight:0; width:800px'>$row_get->id_program</th>
			</tr> 
			<tr>
				<th style='text-align:left; font-size:12pt; width:100px'>Kegiatan</th>
				<th style='text-align:left; font-size:12pt; font-weight:0; width:200px'>: 1.$row_get->id_urusan . 1.$row_get->id_urusan.$row_get->no_skpd . $row_get->no_program . 01</th>
				<th style='text-align:left; font-size:12pt; font-weight:0; width:800px'>$row_get->id_anggaran</th>
			</tr> 
			</table>";

			$query_tri	= $this->db->query("SELECT SUM(anggaran_kas.anggaran) as hasil_anggaran,
					SUM(anggaran_kas.jan+anggaran_kas.feb+anggaran_kas.mar) as triwulan_1,
					SUM(anggaran_kas.apr+anggaran_kas.mei+anggaran_kas.jun) as triwulan_2,
					SUM(anggaran_kas.jul+anggaran_kas.ags+anggaran_kas.sep) as triwulan_3,
					SUM(anggaran_kas.okt+anggaran_kas.nov+anggaran_kas.des) as triwulan_4
					FROM anggaran_kas 
					WHERE anggaran_kas.tipe_kode= '1'
					AND anggaran_kas.skpd='".$row_get->skpd_kode."'
					");
					$data_tri 	= $query_tri->result();
					if($data_tri){ foreach($data_tri as $row_tri){

					$hasil_anggaran = rupiah1($row_tri->hasil_anggaran);
					$triwulan_1 = rupiah1($row_tri->triwulan_1);
					$triwulan_2 = rupiah1($row_tri->triwulan_2);
					$triwulan_3 = rupiah1($row_tri->triwulan_3);
					$triwulan_4 = rupiah1($row_tri->triwulan_4);
					$total_triwulan = rupiah1($row_tri->triwulan_1 + $row_tri->triwulan_2 + $row_tri->triwulan_3 + $row_tri->triwulan_4);
					
	$tanggal = dateIndo($laporan_tanggal);
	$strhtml2 .= "<table style='font-family: serif; border:1px solid #000;'>
			<tr>
			   <td style='text-align:center; font-size:8pt; font-weight:bold; width:250px' colspan='2'>RENCANA PENARIKAN DANA PER TRIWULAN<hr size='90' width='100%'/></td>
			   <td style='text-align:center; font-size:8pt; font-weight:bold; width:250px'>Cikarang Pusat, $tanggal <br> $jabatan $skpd</td>
			</tr>
			<tr>
			   <td style='text-align:left; font-size:8pt; font-weight:bold; width:150px'>Triwulan I</td>
			   <td style='text-align:right; font-size:8pt; font-weight:0; width:150px'>Rp $triwulan_1</td>
			   <td style='text-align:center; font-size:8pt; font-weight:bold; width:500px'></td>
			</tr>
			<tr>
			   <td style='text-align:left; font-size:8pt; font-weight:bold; width:150px'>Triwulan II</td>
			   <td style='text-align:right; font-size:8pt; font-weight:0; width:150px'>Rp $triwulan_2</td>
			   <td style='text-align:center; font-size:8pt; font-weight:bold; width:500px'></td>
			</tr>
			<tr>
			   <td style='text-align:left; font-size:8pt; font-weight:bold; width:150px'>Triwulan III</td>
			   <td style='text-align:right; font-size:8pt; font-weight:0; width:150px'>Rp $triwulan_3</td>
			   <td style='text-align:center; font-size:8pt; font-weight:bold; width:500px'></td>
			</tr>
			<tr>
			   <td style='text-align:left; font-size:8pt; font-weight:bold; width:150px'>Triwulan IIV</td>
			   <td style='text-align:right; font-size:8pt; font-weight:0; width:150px'>Rp $triwulan_4</td>
			   <td style='text-align:center; font-size:8pt; font-weight:bold; width:500px'></td>
			</tr>
			<tr>
			   <td style='text-align:left; font-size:8pt; font-weight:bold; width:150px'>Jumlah</td>
			   <td style='text-align:right; font-size:8pt; font-weight:0; width:150px'><hr size='90' width='100%'/>Rp $total_triwulan</td>
			   <td style='text-align:center; font-size:8pt; font-weight:bold; width:500px'>$laporan_pimpinan<hr size='90' width='50%'/>NIP. $laporan_nip</td>
			</tr>
		   </table>";
			} } }
	$strhtml2 .= "<table style='font-family: serif; border:1px solid #000;'>
			<tr>
				<th style='text-align:center; font-size:9pt; width:150px'>TIM ANGGARAN PEMERINTAH DAERAH</th>
			</tr> 
			</table>";
	
	$strhtml2 .= "<table style='font-family: serif; border:1px solid #000;'>
			<tr>
				<th style='text-align:center; font-size:10pt; border:1px solid #000; width:50px'>No</th>
				<th style='text-align:center; font-size:10pt; border:1px solid #000; width:250px'>NAMA</th>
				<th style='text-align:center; font-size:10pt; border:1px solid #000; width:200px'>NIP</th>
				<th style='text-align:center; font-size:10pt; border:1px solid #000; width:450p'>JABATAN</th>
				<th style='text-align:center; font-size:10pt; border:1px solid #000; width:100px'>TANDA TANGAN</th>
			</tr>
			</table>";
			
	$query_tim = $this->db->query("SELECT *
	FROM tim_anggaran
	WHERE tim_anggaran.kode_tim= '1'
	GROUP BY tim_anggaran.kode ORDER BY tim_anggaran.kode ASC");
	$data_row			= $query_tim->result();
	foreach($data_row as $row_get) {
			
	$strhtml2 .= "<table style='font-family: serif; border:1px solid #000;'>
			<tr>
				<th style='text-align:center; font-size:9pt; font-weight:0; border:1px solid #000; width:50px'>$row_get->no</th>
				<th style='text-align:left; font-size:9pt; font-weight:0; border:1px solid #000; width:250px'>$row_get->nama</th>
				<th style='text-align:center; font-size:9pt; font-weight:0; border:1px solid #000; width:200px'>$row_get->nip</th>
				<th style='text-align:left; font-size:9pt; font-weight:0; border:1px solid #000; width:450p'>$row_get->jabatan</th>
				<th style='text-align:center; border:1px solid #000; width:100px'></th>
			</tr>
			</table>";
	}		
	$strhtml2 .= "<table style='font-family: serif; border:1px solid #000;'>
			<tr>
				<th style='text-align:left; font-size:6pt; font-weight:0; width:200px height:40px;'>- Penetapan dan perhitungan biaya serta penggunaan dana yang tertuang dalam DPA SKPD<br>&nbsp; merupakan tanggung jawab pengguna anggaran/kuasa pengguna anggaran</th>
				<th style='text-align:left; width:200px'></th>
			</tr></table>";
	
$mpdf=new mPDF( '',                          // mode (default '')
                'A4', 0, '',               // format ('A4', '' or...), font size(default 0), font family
                5, 5, 5, 20, 5, 5,  //(margins) left, right, top, bottom, HEADER, FOOTER
                'L');
$mpdf->WriteHTML($strhtml0);
$mpdf->AddPage('');

$mpdf->SetFooter('
<div class="satu"></div>
<table style="font-family: serif; font-size:5pt; border:1px solid #000;"><tr>
<th style="text-align:left; font-weight:0; border:1px solid #000; valign="top" width:50px">Formulir DPA SKPD 2.2.1 - '.$skpd.' <br>Tim Verivikasi</th>
<th style="text-align:left; font-weight:0; border:1px solid #000; width:50px">BAPPEDA</th>
<th style="text-align:left; font-weight:0; border:1px solid #000; width:50px">Pembangunan</th>
<th style="text-align:left; font-weight:0; border:1px solid #000; width:50px">BPKAD</th>
<th style="text-align:left; font-weight:0; border:1px solid #000; width:50px">Perlengkapan</th>
<th style="text-align:left; font-weight:0; border:1px solid #000; width:50px">Organisasi</th>
<th style="text-align:left; font-weight:0; border:1px solid #000; width:50px">Koordinator</th>
<th style="text-align:left; font-weight:0; border:1px solid #000; width:50px">BAPPEDA</th>
<th style="text-align:left; font-weight:0; border:1px solid #000; width:50px">BPKAD</th>
<th style="text-align:left; font-weight:0; border:1px solid #000; width:60px">Halaman {PAGENO} <br> dari {nbpg}</th>
</tr></table>
<table style="font-family: serif; font-size:5pt;"><tr>
<th style="text-align:left; font-weight:0; width:50px">PrinTed By IntegRasi</th>
</tr></table>
');

$mpdf->WriteHTML($strhtml);
$mpdf->AddPage('');
$mpdf->WriteHTML($strhtml2);
$mpdf->Output('');
?>