<?php
$query_jumlah = mysql_query("SELECT SUM(total) 
	FROM rka_sub 
	WHERE rka_sub.anggaran_kode='".$laporan_kegiatan."' 
	ORDER BY rka_sub.kode ASC"); 
	$data = mysql_fetch_array($query_jumlah); $jumlah = $data[0];
	
	$query_get = $this->db->query("SELECT program.program as id_program, program.nomor as no_program, skpd.skpd_nama as id_skpd, 
	skpd.urusan as id_urusan, urusan.urusan as nama_urusan, urusan.jenis as jenis_urusan, skpd.skpd_nomor as no_skpd,
	skpd.skpd_alamat as alamat_skpd, skpd.skpd_status as status_skpd, anggaran.kegiatan as id_anggaran, anggaran.nomor as no_anggaran,
	anggaran_bl.hp_ukur as hpu_anggaran, anggaran_bl.hp_target as hpt_anggaran, anggaran_bl.hp_satuan as hps_anggaran,
	anggaran_bl.kh_ukur as khu_anggaran, anggaran_bl.kh_target as kht_anggaran, anggaran_bl.kh_satuan as khs_anggaran,
	anggaran_bl.hk_ukur as hku_anggaran, anggaran_bl.hk_target as hkt_anggaran, anggaran_bl.hk_satuan as hks_anggaran,
	tim_anggaran.nama as nama_tim, tim_anggaran.nip as nip_tim, tipe.no as no_tipe, tipe.tipe_nama as nama_tipe
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

	$strhtml .= "<table style='font-family: serif; border:1px solid #000;'>
		<tr>
		   <td style='text-align:center; font-size:12pt; font-weight:bold; border:1px solid #000; width:150px' rowspan='2'><img src='public/dist/img/logo.jpg' alt='logo' width='70' height='70' border='0'/></td>
		   <td style='text-align:center; font-size:12pt; font-weight:bold; border:1px solid #000; width:150px'colspan='3'>RENCANA KERJA DAN ANGGARAN<br>SATUAN KERJA PERANGKAT DAERAH</td>
		   <td style='text-align:center; font-size:10pt; font-weight:bold; border:1px solid #000; width:150px' rowspan='2'>Formulir<br>RKA SKPD<br>2.2.1</td>
		</tr>
		<tr>
		   <td style='text-align:center; font-size:12pt; font-weight:bold; border:1px solid #000;'colspan='3'>PEMERINTAH KABUPATEN BEKASI<br>TAHUN ANGGARAN : $laporan_tahun</td>
		</tr>
	   </table>";
	$jabatan = strtoupper($laporan_pangkat);
	$skpd = strtoupper($row_get->id_skpd);   	
		$strhtml .= "<table style='font-family: serif; border:1px solid #000;'>
			<tr>
				<th style='text-align:left; font-size:12pt; width:200px'>Urusan Pemerintahan</th>
				<th style='text-align:left; font-size:12pt; font-weight:0; width:200px'>: 1.$row_get->id_urusan</th>
				<th style='text-align:left; font-size:12pt; font-weight:0; width:800px'>$row_get->jenis_urusan $row_get->nama_urusan</th>
			</tr> 
			<tr>
				<th style='text-align:left; font-size:12pt; width:100px'>Organisasi</th>
				<th style='text-align:left; font-size:12pt; font-weight:0; width:200px'>: 1.$row_get->id_urusan . 1.$row_get->id_urusan.$row_get->no_skpd</th>
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
	
	//	$rupiah = rupiah1($jumlah);
		$terbilang = Terbilang($jumlah);
		$strhtml .= "<table style='font-family: serif; border:1px solid #000;'>
			<tr>
				<th style='text-align:left; font-size:12pt; width:200px'>Jumlah Tahun n - 1</th>
				<th style='text-align:left; font-size:12pt; font-weight:0; width:200px'>: Rp 0,00</th>
				<th style='text-align:left; width:800px'></th>
			</tr> 
			<tr>
				<th style='text-align:left; font-size:12pt; width:100px'>Jumlah Tahun n 1</th>
				<th style='text-align:left; font-size:12pt; font-weight:0; width:200px'>: Rp $rupiah</th>
				<th style='text-align:left; font-size:12pt; font-weight:0; width:800px'>($terbilang rupiah )</th>
			</tr> 
			<tr>
				<th style='text-align:left; font-size:12pt; width:100px'>Jumlah Tahun n + 1</th>
				<th style='text-align:left; font-size:12pt; font-weight:0; width:200px'>: Rp 0,00</th>
				<th style='text-align:left; width:800px'></th>
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
				<th style='text-align:center; font-size:9pt; width:150px'>RINCIAN ANGGARAN BELANJA LANGSUNG MENURUT PROGRAM DAN PER KEGIATAN<br>SATUAN KERJA PRANGKAT DAERAH</th>
			</tr> 
			</table>";
	}
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
	
	
		if ($laporan_program == semua){
		$query_program 			= $this->db->query("SELECT program as id_program FROM rka WHERE rka.tipe_kode= '".$laporan_belanja."' AND rka.tahun='".$laporan_tahun."' AND rka.skpd='".$laporan_skpd."'");		
		$data_program			= $query_program->result();
		foreach($data_program as $row_program) { $where_program = $row_program->id_program; }
		} else {
			$where_program = $laporan_program;
		}
		
		if ($laporan_kegiatan == semua){
		$query_anggaran 		= $this->db->query("SELECT anggaran_kode as id_anggaran FROM rka WHERE rka.tipe_kode= '".$laporan_belanja."' AND rka.tahun='".$laporan_tahun."' AND rka.skpd='".$laporan_skpd."'");		
		$data_anggaran			= $query_anggaran->result();
		foreach($data_anggaran as $row_anggaran) { $where_anggaran = $row_anggaran->laporan_kegiatan; }
		} else {
			$where_anggaran = $laporan_kegiatan;
		}
	
	$query_belanja = $this->db->query("SELECT rka.kode as id_rka, rka.obyek as id_obyek, SUM(rka_sub.total) as totalRKA
	FROM rka_sub 
	LEFT JOIN rka ON rka_sub.rka=rka.kode
	WHERE rka.jenis='".$jenis_belanja[$i]."' 
	AND rka.program='".$where_program."'
	AND rka.anggaran_kode='".$where_anggaran."'
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
		AND rka.program='".$where_program."'
		AND rka.anggaran_kode='".$where_anggaran."'
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
			AND rka_sub.anggaran_kode='".$where_anggaran."'
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
	
	$query_get = $this->db->query("SELECT program.program as id_program, program.nomor as no_program, skpd.skpd_nama as id_skpd, 
	skpd.urusan as id_urusan, urusan.urusan as nama_urusan, urusan.jenis as jenis_urusan, skpd.skpd_nomor as no_skpd,
	skpd.skpd_alamat as alamat_skpd, skpd.skpd_status as status_skpd, anggaran.kegiatan as id_anggaran, anggaran.nomor as no_anggaran,
	anggaran_bl.hp_ukur as hpu_anggaran, anggaran_bl.hp_target as hpt_anggaran, anggaran_bl.hp_satuan as hps_anggaran,
	anggaran_bl.kh_ukur as khu_anggaran, anggaran_bl.kh_target as kht_anggaran, anggaran_bl.kh_satuan as khs_anggaran,
	anggaran_bl.hk_ukur as hku_anggaran, anggaran_bl.hk_target as hkt_anggaran, anggaran_bl.hk_satuan as hks_anggaran,
	tim_anggaran.nama as nama_tim, tim_anggaran.nip as nip_tim
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
	foreach($data_get as $row_get) {		 }
		$strhtml2 .= "<table style='font-family: serif; border:1px solid #000;'>
			<tr>
				<th style='text-align:left; font-size:12pt; width:200px'>Urusan Pemerintahan</th>
				<th style='text-align:left; font-size:12pt; font-weight:0; width:200px'>: 1.$row_get->id_urusan</th>
				<th style='text-align:left; font-size:12pt; font-weight:0; width:800px'>$row_get->jenis_urusan $row_get->nama_urusan</th>
			</tr> 
			<tr>
				<th style='text-align:left; font-size:12pt; width:100px'>Organisasi</th>
				<th style='text-align:left; font-size:12pt; font-weight:0; width:200px'>: 1.$row_get->id_urusan . 1.$row_get->id_urusan.$row_get->no_skpd</th>
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

	$tanggal = dateIndo($laporan_tanggal);
	$strhtml2 .= "<table style='font-family: serif; border:1px solid #000;'>
			<tr>
				<th style='text-align:left; font-size:6pt; font-weight:0; width:200px height:40px;'>Keterangan :<br>- Tanggal Pembahasan :<br>- Catatan Hasil Pembahasan :</th>
				<th style='text-align:left; width:200px'></th>
			</tr> 
			<tr>
				<th style='text-align:left; width:200px'></th>
				<th style='text-align:center; font-size:9pt; width:200px'>Cikarang Pusat, $tanggal <br> $jabatan $skpd</th>
			</tr> 
			<tr>
				<th style='text-align:left; width:200px'></th>
				<th style='text-align:center; width:200px'></th>
			</tr> 
			<tr>
				<th style='text-align:left; width:200px'></th>
				<th style='text-align:center; width:200px'></th>
			</tr> 	
			<tr>
				<th style='text-align:left; width:200px'></th>
				<th style='text-align:center; width:200px'></th>
			</tr> 	
			<tr>
				<th style='text-align:left; width:200px'></th>
				<th style='text-align:center; width:200px'></th>
			</tr> 	
			<tr>
				<th style='text-align:left; width:200px'></th>
				<th style='text-align:center; width:200px'></th>
			</tr> 	
			<tr>
				<th style='text-align:left; width:200px'></th>
				<th style='text-align:center; font-size:9pt; width:200px'>$laporan_pimpinan<hr size='90' width='50%'/>NIP. $laporan_nip</td>
			</tr> 		
			<tr>
				<th style='text-align:left; width:200px'></th>
				<th style='text-align:center; font-size:9pt; width:200px'></th>
			</tr></table>";
			
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
				<th style='text-align:left; font-size:6pt; font-weight:0; width:200px height:40px;'>- Rencana Kerja Anggaran Satuan Kerja Perangkat Daerah (RKA-SKPD)<br> Sepenuhnya Menjadi Tanggungjawab Pengguna Anggaran.</th>
				<th style='text-align:left; width:200px'></th>
			</tr></table>";
	
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
$mpdf->AddPage('');
$mpdf->WriteHTML($strhtml2);
$mpdf->Output('');
?>