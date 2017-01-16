<?php
	$strhtml0 .= "<br><br><table style='font-family: serif; font-size:12pt; font-weight:bold;'>
		<tr>
		   <td style='text-align:center;' colspan='3'><img src='public/dist/img/logo.jpg' alt='logo' width='100' height='100' border='0'/></td>
		</tr>
		<tr>
		   <td style='text-align:center;' colspan='3'>PEMERINTAH KABUPATEN BEKASI</td>
		</tr>
		<tr>
		   <td style='text-align:center;' colspan='3'>DOKUMEN PELAKSANAAN ANGGARAN<br>SATUAN KERJA PERANGKAT DAERAH<br>( DPA SKPD )</td>
		</tr>
		<tr>
		   <td style='text-align:center;' colspan='3'>TAHUN ANGGARAN : $laporan_kode</td>
		</tr>		
		<tr>
		   <td style='text-align:center;' colspan='3'>BELANJA LANGSUNG</td>
		</tr>
	   </table>";
	   
	$strhtml0 .= "<table style='font-family: serif; font-size:18pt; font-weight:bold;'>
		<tr>
		   <td style='text-align:center; width:500px'>&nbsp;</td>
		   <td style='text-align:center; width:250px'>NO DPA SKPD :</td>
		   <td style='text-align:center; border:1px solid #000; width:150px'>12345</td>
		   <td style='text-align:center; border:1px solid #000; width:150px'>12345</td>
		   <td style='text-align:center; border:1px solid #000; width:150px'>12345</td>
		   <td style='text-align:center; border:1px solid #000; width:150px'>12345</td>
		   <td style='text-align:center; border:1px solid #000; width:150px'>12345</td>
		   <td style='text-align:center; border:1px solid #000; width:150px'>12345</td>
		   <td style='text-align:center; width:500px'>&nbsp;</td>
		</tr>
	   </table><br><br><br><br>";
	   
	$strhtml0 .= "<table style='font-family: serif; font-size:12pt;'>
			<tr>
				<th style='text-align:left; width:50px'>&nbsp;</th>
				<th style='text-align:left; width:300px'>URUSAN PEMERINTAHAN</th>
				<th style='text-align:left; width:200px'>: 1.$row_get->id_urusan</th>
				<th style='text-align:left; width:800px'>aa $row_get->jenis_urusan $row_get->nama_urusan</th>
			</tr> 
			<tr>
				<th style='text-align:left; width:50px'>&nbsp;</th>
				<th style='text-align:left; width:300px'>ORGANISASI</th>
				<th style='text-align:left; width:200px'>: 1.$row_get->id_urusan . 1.$row_get->id_urusan.$row_get->no_skpd</th>
				<th style='text-align:left; width:800px'>bb $row_get->id_skpd</th>
			</tr> 
			<tr>
				<th style='text-align:left; width:50px'>&nbsp;</th>
				<th style='text-align:left; width:300px'>SUB UNIT ORGANISASI</th>
				<th style='text-align:left; width:200px'>: 1.$row_get->id_urusan . 1.$row_get->id_urusan.$row_get->no_skpd</th>
				<th style='text-align:left; width:800px'>cc $row_get->id_skpd</th>
			</tr> 
			<tr>
				<th style='text-align:left; width:50px'>&nbsp;</th>
				<th style='text-align:left; width:300px'>PROGRAM</th>
				<th style='text-align:left; width:200px'>: 1.$row_get->id_urusan . 1.$row_get->id_urusan.$row_get->no_skpd . $row_get->no_program</th>
				<th style='text-align:left; width:800px'>dd $row_get->id_program</th>
			</tr> 
			<tr>
				<th style='text-align:left; width:50px'>&nbsp;</th>
				<th style='text-align:left; width:300px'>KEGIATAN</th>
				<th style='text-align:left; width:200px'>: 1.$row_get->id_urusan . 1.$row_get->id_urusan.$row_get->no_skpd . $row_get->no_program . 01</th>
				<th style='text-align:left; width:800px'>ee $row_get->id_anggaran</th>
			</tr>
			</table>";
	
	$strhtml .= "<table style='font-family: serif; font-size:8pt; font-weight:bold; border:1px solid #000;'>
		<tr>
		   <td style='text-align:center; border:1px solid #000; width:150px' rowspan='2'><img src='public/dist/img/logo.jpg' alt='logo' width='70' height='70' border='0'/></td>
		   <td style='text-align:center; border:1px solid #000; width:150px'colspan='3'>RENCANA KERJA DAN ANGGARAN<br>SATUAN KERJA PERANGKAT DAERAH</td>
		   <td style='text-align:center; border:1px solid #000; width:150px' rowspan='2'>Formulir<br>RKA SKPD<br>2.2.1</td>
		</tr>
		<tr>
		   <td style='text-align:center; border:1px solid #000;'colspan='3'>PEMERINTAH KABUPATEN BEKASI<br>TAHUN ANGGARAN : $laporan_tahun</td>
		</tr>
	   </table>";
		
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
	foreach($data_get as $row_get) {		
		$strhtml .= "<table style='font-family: serif; font-size:10pt; border:1px solid #000;'>
			<tr>
				<th style='text-align:left; width:200px'>Urusan Pemerintahan</th>
				<th style='text-align:left; width:200px'>: 1.$row_get->id_urusan</th>
				<th style='text-align:left; width:800px'>$row_get->jenis_urusan $row_get->nama_urusan</th>
			</tr> 
			<tr>
				<th style='text-align:left; width:100px'>Organisasi</th>
				<th style='text-align:left; width:200px'>: 1.$row_get->id_urusan . 1.$row_get->id_urusan.$row_get->no_skpd</th>
				<th style='text-align:left; width:800px'>$row_get->id_skpd</th>
			</tr> 
			<tr>
				<th style='text-align:left; width:100px'>Program</th>
				<th style='text-align:left; width:200px'>: 1.$row_get->id_urusan . 1.$row_get->id_urusan.$row_get->no_skpd . $row_get->no_program</th>
				<th style='text-align:left; width:800px'>$row_get->id_program</th>
			</tr> 
			<tr>
				<th style='text-align:left; width:100px'>Kegiatan</th>
				<th style='text-align:left; width:200px'>: 1.$row_get->id_urusan . 1.$row_get->id_urusan.$row_get->no_skpd . $row_get->no_program . 01</th>
				<th style='text-align:left; width:800px'>$row_get->id_anggaran</th>
			</tr> 
			</table>";
			
		$strhtml .= "<table style='font-family: serif; font-size:7pt; border:1px solid #000;'>
			<tr>
				<th style='text-align:left; width:160px'>Lokasi Kegiatan</th>
				<th style='text-align:left; width:700px'>: $row_get->alamat_skpd</th>
			</tr> 
			</table>";
			
		$rupiah = rupiah1($jumlah);
		$terbilang = Terbilang($jumlah);	
		$strhtml .= "<table style='font-family: serif; font-size:10pt; border:1px solid #000;'>
			<tr>
				<th style='text-align:left; width:200px'>Jumlah Tahun n - 1</th>
				<th style='text-align:left; width:200px'>: Rp 0,00</th>
				<th style='text-align:left; width:800px'></th>
			</tr> 
			<tr>
				<th style='text-align:left; width:100px'>Jumlah Tahun n 1</th>
				<th style='text-align:left; width:200px'>: Rp $rupiah</th>
				<th style='text-align:left; width:800px'>($terbilang rupiah )</th>
			</tr> 
			<tr>
				<th style='text-align:left; width:100px'>Jumlah Tahun n + 1</th>
				<th style='text-align:left; width:200px'>: Rp 0,00</th>
				<th style='text-align:left; width:800px'></th>
			</tr> 
			</table>";
			
		$strhtml .= "<table style='font-family: serif; font-size:7pt; border:1px solid #000;'>
			<tr>
				<th style='text-align:center; width:150px'>INDIKATOR & TOLOK UKUR KINERJA BELANJA LANGSUNG</th>
			</tr> 
			</table>";
			
		$strhtml .= "<table style='font-family: serif; font-size:10pt; border:1px solid #000;'>
			<tr>
				<th style='text-align:center; border:1px solid #000; width:200px'>INDIKATOR</th>
				<th style='text-align:center; border:1px solid #000; width:700px'>TOLOK UKUR KERJA</th>
				<th style='text-align:center; border:1px solid #000; width:300px'>TARGET KINERJA</th>
			</tr> 
			</table>";
			
		$strhtml .= "<table style='font-family: serif; font-size:10pt; border:1px solid #000;'>
			<tr>
				<th style='text-align:left; border:1px solid #000; width:200px'>CAPAIAN PROGRAM</th>
				<th style='text-align:left; border:1px solid #000; width:700px'>$row_get->hpu_anggaran</th>
				<th style='text-align:left; border:1px solid #000; width:300px'>$row_get->hpt_anggaran $row_get->hps_anggaran</th>
			</tr> 
			</table>";
			
		$strhtml .= "<table style='font-family: serif; font-size:10pt; border:1px solid #000;'>
			<tr>
				<th style='text-align:left; border:1px solid #000; width:200px'>MASUKAN</th>
				<th style='text-align:left; border:1px solid #000; width:700px'>Jumlah Dana</th>
				<th style='text-align:left; border:1px solid #000; width:300px'>Rp. $rupiah</th>
			</tr> 
			</table>";
		
		$strhtml .= "<table style='font-family: serif; font-size:10pt; border:1px solid #000;'>
			<tr>
				<th style='text-align:left; border:1px solid #000; width:200px'>KELUARAN</th>
				<th style='text-align:left; border:1px solid #000; width:700px'>$row_get->khu_anggaran</th>
				<th style='text-align:left; border:1px solid #000; width:300px'>$row_get->kht_anggaran $row_get->khs_anggaran</th>
			</tr> 
			</table>";
			
		$strhtml .= "<table style='font-family: serif; font-size:10pt; border:1px solid #000;'>
			<tr>
				<th style='text-align:left; border:1px solid #000; width:200px'>HASIL</th>
				<th style='text-align:left; border:1px solid #000; width:700px'>$row_get->hku_anggaran</th>
				<th style='text-align:left; border:1px solid #000; width:300px'>$row_get->hkt_anggaran $row_get->hks_anggaran</th>
			</tr> 
			</table>";
			
		$strhtml .= "<table style='font-family: serif; font-size:7pt; border:1px solid #000;'>
			<tr>
				<th style='text-align:left; width:160px'>Kelompok Sasaran Kegiatan</th>
				<th style='text-align:left; width:700px'>: $row_get->status_skpd</th>
			</tr> 
			</table>";
			
		$strhtml .= "<table style='font-family: serif; font-size:7pt; border:1px solid #000;'>
			<tr>
				<th style='text-align:center; width:150px'>RINCIAN ANGGARAN BELANJA LANGSUNG MENURUT PROGRAM DAN PER KEGIATAN<br>SATUAN KERJA PRANGKAT DAERAH</th>
			</tr> 
			</table>";
	}
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
			
		$strhtml .= "<table style='font-family: serif; font-size:11pt; border:1px solid #000;'>		
			<tr>
				<th style='text-align:left; border:1px solid #000; width:150px'>5</th>
				<th style='text-align:left; border:1px solid #000; width:500px'>BELANJA</th>
				<th style='text-align:right; border:1px solid #000; width:600px'>$rupiah</th>
			</tr>
			<tr>
				<th style='text-align:left; border:1px solid #000; width:150px'>5.2</th>
				<th style='text-align:left; border:1px solid #000; width:500px'>BELANJA LANGSUNG</th>
				<th style='text-align:right; border:1px solid #000; width:600px'>$rupiah</th>
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
		$strhtml .= "<table style='font-family: serif; font-size:11pt; border:1px solid #000;'>
			<tr>
				<th style='text-align:left; border:1px solid #000; width:150px'>5.2.$i</th>
				<th style='text-align:left; border:1px solid #000; width:500px'>$jenis[$i]</th>
				<th style='text-align:right; border:1px solid #000; width:600px'>$totalRKA</th>
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
			$strhtml .= "<table style='font-family: serif; font-size:11pt; border:1px solid #000;'>
			<tr>
				<th style='text-align:left; border:1px solid #000; width:150px'>5.2.$i.$row_id->no_obyek</th>
				<th style='text-align:left; border:1px solid #000; width:500px'>$row_id->nama_obyek</th>";
				
			$query_total 	= $this->db->query("SELECT SUM(rka_sub.total) as totalRKA 
			FROM rka_sub 
			WHERE rka_sub.tipe_kode= '1'
			AND rka_sub.anggaran_kode='".$laporan_anggaran."' 
			AND rka_sub.rka='".$row_id->id_rka."'
			");			
			$data_total 	= $query_total->result();
	
			if($data_total){ foreach($data_total as $task){
			$totalRKA_task = rupiah1 ($task->totalRKA);
			$strhtml .= "<th style='text-align:right; border:1px solid #000; width:600px'>$totalRKA_task</th>
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
			$strhtml .= "<table style='font-family: serif; font-size:11pt; border:1px solid #000;'>
			<tr>
				<th style='text-align:left; border:1px solid #000; width:150px'>5.2.$i.$row_id->no_obyek.$row_rka->no_rincian</th>
				<th style='text-align:left; border:1px solid #000; width:500px'>$row_rka->nama_rincian</th>";
				
			$query_jumlah 	= $this->db->query("SELECT SUM(rka_sub.total) as totalRKA 
			FROM rka_sub 
			WHERE rka_sub.tipe_kode= '1'
			AND rka_sub.anggaran_kode='".$laporan_anggaran."' 
			AND rka_sub.rka='".$row_id->id_rka."' ");			
			$data_jumlah 	= $query_jumlah->result();
			if($data_jumlah){ foreach($data_jumlah as $task){
			$totalRKA_task = rupiah1 ($task->totalRKA);
			$strhtml .= "<th style='text-align:right; border:1px solid #000; width:600px'>$totalRKA_task</th>
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
				$strhtml .= "<table style='font-family: serif; font-size:11pt; border:1px solid #000;'>
				<tr>
					<th style='text-align:left; border:1px solid #000; width:150px'></th>
					<th style='text-align:left; border:1px solid #000; width:500px'>$row_rincian->nama_rincian</th>";
					
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
				$strhtml .= "<th style='text-align:right; border:1px solid #000; width:600px'>$totalRKA_task</th>
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
					$strhtml .= "<table style='font-family: serif; font-size:11pt; border:1px solid #000;'>
					<tr>
						<th style='text-align:center; border:1px solid #000; width:150px'></th>
						<th style='text-align:left; border:1px solid #000; width:500px'>  - $row_sub->uraian</th>
						<th style='text-align:center; border:1px solid #000; width:150px'>$row_sub->volume</th>
						<th style='text-align:center; border:1px solid #000; width:150px'>$row_sub->satuan</th>
						<th style='text-align:right; border:1px solid #000; width:150px'>$harga</th>
						<th style='text-align:right; border:1px solid #000; width:150px'>$total</th>
					</tr>
					</table>";

		} } } }
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
		$strhtml2 .= "<table style='font-family: serif; font-size:10pt; border:1px solid #000;'>
			<tr>
				<th style='text-align:left; width:200px'>Urusan Pemerintahan</th>
				<th style='text-align:left; width:200px'>: 1.$row_get->id_urusan</th>
				<th style='text-align:left; width:800px'>$row_get->jenis_urusan $row_get->nama_urusan</th>
			</tr> 
			<tr>
				<th style='text-align:left; width:100px'>Organisasi</th>
				<th style='text-align:left; width:200px'>: 1.$row_get->id_urusan . 1.$row_get->id_urusan.$row_get->no_skpd</th>
				<th style='text-align:left; width:800px'>$row_get->id_skpd</th>
			</tr> 
			<tr>
				<th style='text-align:left; width:100px'>Program</th>
				<th style='text-align:left; width:200px'>: 1.$row_get->id_urusan . 1.$row_get->id_urusan.$row_get->no_skpd . $row_get->no_program</th>
				<th style='text-align:left; width:800px'>$row_get->id_program</th>
			</tr> 
			<tr>
				<th style='text-align:left; width:100px'>Kegiatan</th>
				<th style='text-align:left; width:200px'>: 1.$row_get->id_urusan . 1.$row_get->id_urusan.$row_get->no_skpd . $row_get->no_program . 01</th>
				<th style='text-align:left; width:800px'>$row_get->id_anggaran</th>
			</tr> 
			</table>";

	$tanggal = dateIndo($laporan_tanggal);
	$strhtml2 .= "<table style='font-family: serif; font-size:9pt; border:1px solid #000;'>
			<tr>
				<th style='font-size:6pt; text-align:left; width:200px height:40px;'>Keterangan :<br>- Tanggal Pembahasan :<br>- Catatan Hasil Pembahasan :</th>
				<th style='text-align:left; width:200px'></th>
			</tr> 
			<tr>
				<th style='text-align:left; width:200px'></th>
				<th style='text-align:center; width:200px'>Cikarang Pusat, $tanggal <br> $row_get->id_skpd</th>
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
				<th style='text-align:center; width:200px'></th>
			</tr> 		
			<tr>
				<th style='text-align:left; width:200px'></th>
				<th style='text-align:center; width:200px'>$row_get->nama_tim<hr size='90' width='50%'/>NIP. $row_get->nip_tim $laporan_nip</th>
			</tr></table>";
			
	$strhtml2 .= "<table style='font-family: serif; font-size:7pt; border:1px solid #000;'>
			<tr>
				<th style='text-align:center; width:150px'>TIM ANGGARAN PEMERINTAH DAERAH</th>
			</tr> 
			</table>";
	
	$strhtml2 .= "<table style='font-family: serif; font-size:10pt; border:1px solid #000;'>
			<tr>
				<th style='text-align:center; border:1px solid #000; width:50px'>No</th>
				<th style='text-align:center; border:1px solid #000; width:250px'>NAMA</th>
				<th style='text-align:center; border:1px solid #000; width:200px'>NIP</th>
				<th style='text-align:center; border:1px solid #000; width:450p'>JABATAN</th>
				<th style='text-align:center; border:1px solid #000; width:100px'>TANDA TANGAN</th>
			</tr>
			</table>";
			
	$query_tim = $this->db->query("SELECT *
	FROM tim_anggaran
	WHERE tim_anggaran.kode_tim= '1'
	GROUP BY tim_anggaran.kode ORDER BY tim_anggaran.kode ASC");
	$data_row			= $query_tim->result();
	foreach($data_row as $row_get) {
			
	$strhtml2 .= "<table style='font-family: serif; font-size:8pt; border:1px solid #000;'>
			<tr>
				<th style='text-align:center; border:1px solid #000; width:50px'>1</th>
				<th style='text-align:left; border:1px solid #000; width:250px'>$row_get->nama</th>
				<th style='text-align:center; border:1px solid #000; width:200px'>$row_get->nip</th>
				<th style='text-align:left; border:1px solid #000; width:450p'>$row_get->jabatan</th>
				<th style='text-align:center; border:1px solid #000; width:100px'></th>
			</tr>
			</table>";
	}		
	$strhtml2 .= "<table style='font-family: serif; font-size:9pt; border:1px solid #000;'>
			<tr>
				<th style='font-size:6pt; text-align:left; width:200px height:40px;'>- Rencana Kerja Anggaran Satuan Kerja Perangkat Daerah (RKA-SKPD)<br> Sepenuhnya Menjadi Tanggungjawab Pengguna Anggaran.</th>
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
<th style="text-align:left; border:1px solid #000; valign="top" width:50px">Formulir RKA SKPD 2.2.1<br>Tim Verivikasi</th>
<th style="text-align:left; border:1px solid #000; width:50px">BAPPEDA</th>
<th style="text-align:left; border:1px solid #000; width:50px">Pembangunan</th>
<th style="text-align:left; border:1px solid #000; width:50px">BPKAD</th>
<th style="text-align:left; border:1px solid #000; width:50px">Perlengkapan</th>
<th style="text-align:left; border:1px solid #000; width:50px">Organisasi</th>
<th style="text-align:left; border:1px solid #000; width:50px">Koordinator</th>
<th style="text-align:left; border:1px solid #000; width:50px">BAPPEDA</th>
<th style="text-align:left; border:1px solid #000; width:50px">BPKAD</th>
<th style="text-align:right; border:1px solid #000; width:50px">Hal {PAGENO} <br> dari {nbpg}</th>
</tr></table>
<table style="font-family: serif; font-size:5pt;"><tr>
<th style="text-align:left; width:50px">PrinTed By IntegRasi</th>
</tr></table>
');
//<th style="text-align:left; border:1px solid #000; width:50px">Formulir RKA SKPD 2.2.1 - '.$skpd_nama.'<br>Tim Verivikasi</th>
//<th style="text-align:right; width:50px">Tanggal {DATE j-m-Y}, Halaman {PAGENO} dari {nbpg}</th>


$mpdf->WriteHTML($strhtml);
$mpdf->AddPage('');
$mpdf->WriteHTML($strhtml2);
$mpdf->Output('');
?>