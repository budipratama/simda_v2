<?php
$strhtml .= "<table style='font-family: serif; border:1px solid #000;'>
<tr>
   <td style='text-align:center; font-size:9pt; font-weight:bold; border:1px solid #000; width:150px' rowspan='2'><img src='public/dist/img/logo.jpg' alt='logo' width='70' height='70' border='0'/></td>
   <td style='text-align:center; font-size:9pt; font-weight:bold; border:1px solid #000; width:150px'colspan='3'>RENCANA KERJA DAN ANGGARAN<br>SATUAN KERJA PERANGKAT DAERAH</td>
   <td style='text-align:center; font-size:9pt; font-weight:bold; border:1px solid #000; width:150px' rowspan='2'>Formulir<br>RKA SKPD<br>2.2.1</td>
</tr>
<tr>
   <td style='text-align:center; font-size:7pt; font-weight:bold; border:1px solid #000;'colspan='3'>PEMERINTAH KABUPATEN BEKASI<br>TAHUN ANGGARAN : $laporan_tahun</td>
</tr>
</table>";	   
	   
	   	if ($laporan_program == semua && $laporan_kegiatan == semua){
			$query_jumlah = mysql_query("SELECT skpd.skpd_nomor as no_skpd, skpd.skpd_nama as id_skpd, skpd.urusan as id_urusan, skpd.skpd_alamat as alamat_skpd, skpd.skpd_status as status_skpd, urusan.urusan as nama_urusan, urusan.jenis as jenis_urusan, SUM(rka_sub.total) as total
			FROM rka_sub 
			INNER JOIN rka ON rka_sub.rka=rka.kode
			INNER JOIN skpd ON rka.skpd=skpd.skpd_kode
			INNER JOIN urusan ON rka.urusan=urusan.kode
			WHERE rka.tahun='".$laporan_tahun."'
			AND rka.skpd='".$laporan_skpd."' 
			ORDER BY rka_sub.kode ASC"); 
			$data = mysql_fetch_array($query_jumlah); $id_urusan = $data[id_urusan]; $nama_urusan = $data[nama_urusan]; $jenis_urusan = $data[jenis_urusan]; $id_skpd = $data[id_skpd]; $no_skpd = $data[no_skpd]; $lokasi = $data[alamat_skpd]; $status = $data[status_skpd]; $jumlah = $data[total];
			
			$rupiah = rupiah1($jumlah);
			$terbilang = Terbilang($jumlah);
			$skpd = strtoupper($id_skpd);
			
			$strhtml .= "<table style='font-family: serif; border:1px solid #000;'>
				<tr>
					<th style='text-align:left; font-size:12pt; width:200px'>Urusan Pemerintahan</th>
					<th style='text-align:left; font-size:12pt; font-weight:0; width:200px'>: 1.$id_urusan</th>
					<th style='text-align:left; font-size:12pt; font-weight:0; width:800px'>$jenis_urusan $nama_urusan</th>
				</tr> 
				<tr>
					<th style='text-align:left; font-size:12pt; width:100px'>Organisasi</th>
					<th style='text-align:left; font-size:12pt; font-weight:0; width:200px'>: 1.$id_urusan . 1.$id_urusan.$no_skpd</th>
					<th style='text-align:left; font-size:12pt; font-weight:0; width:800px'>$id_skpd</th>
				</tr>
				</table>";
				
			$strhtml .= "<table style='font-family: serif; border:1px solid #000;'>
				<tr>
					<th style='text-align:left; font-size:9pt; width:200px'>Lokasi Kegiatan</th>
					<th style='text-align:left; font-size:9pt; font-weight:0; width:660px'>: $lokasi</th>
				</tr> 
				</table>";
				
			$strhtml .= "<table style='font-family: serif; border:1px solid #000;'>
				<tr>
					<th style='text-align:left; font-size:12pt; width:200px'>Jumlah Tahun n - 1</th>
					<th style='text-align:left; font-size:12pt; font-weight:0; width:200px'>: Rp 0,00</th>
					<th style='text-align:left; width:800px'>(SEMUA Program & Kegiatan)</th>
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
		} else if ($laporan_kegiatan == semua){
			$query_jumlah = mysql_query("SELECT skpd.skpd_nomor as no_skpd, skpd.skpd_nama as id_skpd, skpd.urusan as id_urusan, skpd.skpd_alamat as alamat_skpd, skpd.skpd_status as status_skpd, urusan.urusan as nama_urusan, urusan.jenis as jenis_urusan, program.program as id_program, program.nomor as no_program, SUM(rka_sub.total) as total,
			anggaran_bl.hp_ukur as hpu_anggaran, anggaran_bl.hp_target as hpt_anggaran, anggaran_bl.hp_satuan as hps_anggaran
			FROM rka_sub 
			INNER JOIN rka ON rka_sub.rka=rka.kode
			INNER JOIN skpd ON rka.skpd=skpd.skpd_kode
			INNER JOIN urusan ON rka.urusan=urusan.kode
			INNER JOIN program ON rka.program=program.kode
			INNER JOIN anggaran ON rka.anggaran_kode=anggaran.kode
			INNER JOIN anggaran_bl ON rka.anggaran_kode=anggaran_bl.kode
			WHERE rka.tahun='".$laporan_tahun."'
			AND rka.skpd='".$laporan_skpd."' 
			AND rka.program='".$laporan_program."' 
			ORDER BY rka_sub.kode ASC"); 
			$data = mysql_fetch_array($query_jumlah); $id_urusan = $data[id_urusan]; $nama_urusan = $data[nama_urusan]; $jenis_urusan = $data[jenis_urusan]; $id_skpd = $data[id_skpd]; $no_skpd = $data[no_skpd]; $lokasi = $data[alamat_skpd]; $status = $data[status_skpd]; $id_program = $data[id_program]; $no_program = $data[no_program]; $jumlah = $data[total];
			$hpu_anggaran = $data[hpu_anggaran]; $hpt_anggaran = $data[hpt_anggaran]; $hps_anggaran = $data[hps_anggaran];
			$rupiah = rupiah1($jumlah);
			$terbilang = Terbilang($jumlah);
			$skpd = strtoupper($id_skpd);
			
			$strhtml .= "<table style='font-family: serif; border:1px solid #000;'>
				<tr>
					<th style='text-align:left; font-size:12pt; width:200px'>Urusan Pemerintahan</th>
					<th style='text-align:left; font-size:12pt; font-weight:0; width:200px'>: 1.$id_urusan</th>
					<th style='text-align:left; font-size:12pt; font-weight:0; width:800px'>$jenis_urusan $nama_urusan</th>
				</tr> 
				<tr>
					<th style='text-align:left; font-size:12pt; width:100px'>Organisasi</th>
					<th style='text-align:left; font-size:12pt; font-weight:0; width:200px'>: 1.$id_urusan . 1.$id_urusan.$no_skpd</th>
					<th style='text-align:left; font-size:12pt; font-weight:0; width:800px'>$id_skpd</th>
				</tr>
				<tr>
					<th style='text-align:left; font-size:12pt; width:100px'>Program</th>
					<th style='text-align:left; font-size:12pt; font-weight:0; width:200px'>: 1.$id_urusan . 1.$id_urusan.$no_skpd . $no_program</th>
					<th style='text-align:left; font-size:12pt; font-weight:0; width:800px'>$id_program</th>
				</tr> 
				</table>";
				
			$strhtml .= "<table style='font-family: serif; border:1px solid #000;'>
				<tr>
					<th style='text-align:left; font-size:9pt; width:200px'>Lokasi Kegiatan</th>
					<th style='text-align:left; font-size:9pt; font-weight:0; width:660px'>: $lokasi</th>
				</tr> 
				</table>";
				
			$strhtml .= "<table style='font-family: serif; border:1px solid #000;'>
				<tr>
					<th style='text-align:left; font-size:12pt; width:200px'>Jumlah Tahun n - 1</th>
					<th style='text-align:left; font-size:12pt; font-weight:0; width:200px'>: Rp 0,00</th>
					<th style='text-align:left; width:800px'>(SEMUA Kegiatan)</th>
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
					<th style='text-align:left; font-size:12pt; font-weight:0; border:1px solid #000; width:700px'>$hpu_anggaran</th>
					<th style='text-align:left; font-size:12pt; font-weight:0; border:1px solid #000; width:300px'>$hpt_anggaran $hps_anggaran</th>
				</tr> 
				</table>";
				
			$strhtml .= "<table style='font-family: serif; border:1px solid #000;'>
				<tr>
					<th style='text-align:left; font-size:12pt; border:1px solid #000; width:200px'>MASUKAN</th>
					<th style='text-align:left; font-size:12pt; font-weight:0; border:1px solid #000; width:700px'>Jumlah Dana</th>
					<th style='text-align:left; font-size:12pt; font-weight:0; border:1px solid #000; width:300px'>Rp. $rupiah</th>
				</tr> 
				</table>";	

		} else {
			$query_jumlah = mysql_query("SELECT skpd.skpd_nomor as no_skpd, skpd.skpd_nama as id_skpd, skpd.urusan as id_urusan, skpd.skpd_alamat as alamat_skpd, skpd.skpd_status as status_skpd, urusan.urusan as nama_urusan, urusan.jenis as jenis_urusan, program.program as id_program, program.nomor as no_program, anggaran.kegiatan as id_kegiatan, anggaran.nomor as no_anggaran, SUM(rka_sub.total) as total,
			anggaran_bl.hp_ukur as hpu_anggaran, anggaran_bl.hp_target as hpt_anggaran, anggaran_bl.hp_satuan as hps_anggaran,
			anggaran_bl.kh_ukur as khu_anggaran, anggaran_bl.kh_target as kht_anggaran, anggaran_bl.kh_satuan as khs_anggaran,
			anggaran_bl.hk_ukur as hku_anggaran, anggaran_bl.hk_target as hkt_anggaran, anggaran_bl.hk_satuan as hks_anggaran
			FROM rka_sub 
			INNER JOIN rka ON rka_sub.rka=rka.kode
			INNER JOIN skpd ON rka.skpd=skpd.skpd_kode
			INNER JOIN urusan ON rka.urusan=urusan.kode
			INNER JOIN program ON rka.program=program.kode
			INNER JOIN anggaran ON rka.anggaran_kode=anggaran.kode
			INNER JOIN anggaran_bl ON rka.anggaran_kode=anggaran_bl.kode
			WHERE rka.tahun='".$laporan_tahun."'
			AND rka.skpd='".$laporan_skpd."' 
			AND rka.program='".$laporan_program."' 
			AND rka.anggaran_kode='".$laporan_kegiatan."' 
			ORDER BY rka_sub.kode ASC"); 
			$data = mysql_fetch_array($query_jumlah); $id_urusan = $data[id_urusan]; $nama_urusan = $data[nama_urusan]; $jenis_urusan = $data[jenis_urusan]; $id_skpd = $data[id_skpd]; $no_skpd = $data[no_skpd]; $lokasi = $data[alamat_skpd]; $status = $data[status_skpd]; $id_program = $data[id_program]; $no_program = $data[no_program]; $id_kegiatan = $data[id_kegiatan]; $no_anggaran = $data[no_anggaran]; $jumlah = $data[total];
			$hpu_anggaran = $data[hpu_anggaran]; $hpt_anggaran = $data[hpt_anggaran]; $hps_anggaran = $data[hps_anggaran];
			$khu_anggaran = $data[khu_anggaran]; $kht_anggaran = $data[kht_anggaran]; $khs_anggaran = $data[khs_anggaran];
			$hku_anggaran = $data[hku_anggaran]; $hkt_anggaran = $data[hkt_anggaran]; $hks_anggaran = $data[hks_anggaran];
			$rupiah = rupiah1($jumlah);
			$terbilang = Terbilang($jumlah);
			$skpd = strtoupper($id_skpd);
			
			$strhtml .= "<table style='font-family: serif; border:1px solid #000;'>
				<tr>
					<th style='text-align:left; font-size:12pt; width:200px'>Urusan Pemerintahan</th>
					<th style='text-align:left; font-size:12pt; font-weight:0; width:200px'>: 1.$id_urusan</th>
					<th style='text-align:left; font-size:12pt; font-weight:0; width:800px'>$jenis_urusan $nama_urusan</th>
				</tr> 
				<tr>
					<th style='text-align:left; font-size:12pt; width:100px'>Organisasi</th>
					<th style='text-align:left; font-size:12pt; font-weight:0; width:200px'>: 1.$id_urusan . 1.$id_urusan.$no_skpd</th>
					<th style='text-align:left; font-size:12pt; font-weight:0; width:800px'>$id_skpd</th>
				</tr>
				<tr>
					<th style='text-align:left; font-size:12pt; width:100px'>Program</th>
					<th style='text-align:left; font-size:12pt; font-weight:0; width:200px'>: 1.$id_urusan . 1.$id_urusan.$no_skpd . $no_program</th>
					<th style='text-align:left; font-size:12pt; font-weight:0; width:800px'>$id_program</th>
				</tr> 
				<tr>
					<th style='text-align:left; font-size:12pt; width:100px'>Kegiatan</th>
					<th style='text-align:left; font-size:12pt; font-weight:0; width:200px'>: 1.$id_urusan . 1.$id_urusan.$no_skpd . $no_program . 01</th>
					<th style='text-align:left; font-size:12pt; font-weight:0; width:800px'>$id_kegiatan</th>
				</tr> 
				</table>";
				
			$strhtml .= "<table style='font-family: serif; border:1px solid #000;'>
				<tr>
					<th style='text-align:left; font-size:9pt; width:200px'>Lokasi Kegiatan</th>
					<th style='text-align:left; font-size:9pt; font-weight:0; width:660px'>: $lokasi</th>
				</tr> 
				</table>";
				
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
					<th style='text-align:left; font-size:12pt; font-weight:0; border:1px solid #000; width:700px'>$hpu_anggaran</th>
					<th style='text-align:left; font-size:12pt; font-weight:0; border:1px solid #000; width:300px'>$hpt_anggaran $hps_anggaran</th>
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
					<th style='text-align:left; font-size:12pt; font-weight:0; border:1px solid #000; width:700px'>$khu_anggaran</th>
					<th style='text-align:left; font-size:12pt; font-weight:0; border:1px solid #000; width:300px'>$kht_anggaran $khs_anggaran</th>
				</tr> 
				</table>";	
				
			$strhtml .= "<table style='font-family: serif; border:1px solid #000;'>
				<tr>
					<th style='text-align:left; font-size:12pt; border:1px solid #000; width:200px'>HASIL</th>
					<th style='text-align:left; font-size:12pt; font-weight:0; border:1px solid #000; width:700px'>$hku_anggaran</th>
					<th style='text-align:left; font-size:12pt; font-weight:0; border:1px solid #000; width:300px'>$hkt_anggaran $hks_anggaran</th>
				</tr> 
				</table>";	
			
		}
			
			if ($laporan_program == semua && $laporan_kegiatan == semua){
			} else 	if ($laporan_kegiatan == semua){		
			$where_data['rka.tahun'] 	= $laporan_tahun;
			if ($laporan_skpd != 'semua'){ $where_data['skpd.skpd_kode'] 		= $laporan_skpd; }
			if ($laporan_program != 'semua'){ $where_data['program.kode'] 		= $laporan_program; }
			if ($laporan_kegiatan != 'semua'){ $where_data['anggaran.kode'] 	= $laporan_kegiatan; }
				$strhtml .= "<table style='font-family: serif; border:1px solid #000;'><tr><th style='text-align:left; font-size:7pt; border:1px solid #000; height:5px'>KELUARAN</th></tr></table>";
				foreach ($this->Rka_model->grid_all('1', 'anggaran_bl.kode as kode_bl, anggaran_bl.kh_ukur as khu_anggaran, anggaran_bl.kh_target as kht_anggaran, anggaran_bl.kh_satuan as khs_anggaran, anggaran_bl.hk_ukur as hku_anggaran, anggaran_bl.hk_target as hkt_anggaran, anggaran_bl.hk_satuan as hks_anggaran', 'anggaran_bl.kode', 'ASC', '', '', $where_data, '', 'rka.anggaran_kode') as $datarow){
					$strhtml .= "<table style='font-family: serif; border:1px solid #000;'>
						<tr>
							<th style='text-align:left; font-size:12pt; border:1px solid #000; width:200px'></th>
							<th style='text-align:left; font-size:12pt; font-weight:0; border:1px solid #000; width:700px'>$datarow->khu_anggaran</th>
							<th style='text-align:left; font-size:12pt; font-weight:0; border:1px solid #000; width:300px'>$datarow->kht_anggaran $datarow->khs_anggaran</th>
						</tr> 
						</table>";
				}
				$strhtml .= "<table style='font-family: serif; border:1px solid #000;'><tr><th style='text-align:left; font-size:7pt; border:1px solid #000; height:5px'>HASIL</th></tr></table>";
				foreach ($this->Rka_model->grid_all('1', 'anggaran_bl.kode as kode_bl, anggaran_bl.kh_ukur as khu_anggaran, anggaran_bl.kh_target as kht_anggaran, anggaran_bl.kh_satuan as khs_anggaran, anggaran_bl.hk_ukur as hku_anggaran, anggaran_bl.hk_target as hkt_anggaran, anggaran_bl.hk_satuan as hks_anggaran', 'anggaran_bl.kode', 'ASC', '', '', $where_data, '', 'rka.anggaran_kode') as $datarow){	
					$strhtml .= "<table style='font-family: serif; border:1px solid #000;'>
						<tr>
							<th style='text-align:left; font-size:12pt; border:1px solid #000; width:200px'></th>
							<th style='text-align:left; font-size:12pt; font-weight:0; border:1px solid #000; width:700px'>$datarow->hku_anggaran</th>
							<th style='text-align:left; font-size:12pt; font-weight:0; border:1px solid #000; width:300px'>$datarow->hkt_anggaran $datarow->hks_anggaran</th>
						</tr> 
						</table>";
				}
			} else {}

		$strhtml .= "<table style='font-family: serif; border:1px solid #000;'>
				<tr>
					<th style='text-align:left; font-size:9pt; width:200px'>Kelompok Sasaran Kegiatan</th>
					<th style='text-align:left; font-size:9pt; font-weight:0; width:660px'>: $status</th>
				</tr> 
				</table>";
				
		$strhtml .= "<table style='font-family: serif; border:1px solid #000;'>
			<tr>
				<th style='text-align:center; font-size:9pt; width:150px'>RINCIAN ANGGARAN BELANJA LANGSUNG MENURUT PROGRAM DAN PER KEGIATAN<br>SATUAN KERJA PRANGKAT DAERAH</th>
			</tr> 
			</table>";

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
				<th style='text-align:left; font-size:12pt; border:1px solid #000; width:150px'>5</th>
				<th style='text-align:left; font-size:12pt; border:1px solid #000; width:500px'>BELANJA</th>
				<th style='text-align:right; font-size:12pt; border:1px solid #000; width:600px'>$rupiah</th>
			</tr>
			<tr>
				<th style='text-align:left; font-size:12pt; border:1px solid #000; width:150px'>5.2</th>
				<th style='text-align:left; font-size:12pt; border:1px solid #000; width:500px'>BELANJA LANGSUNG</th>
				<th style='text-align:right; font-size:12pt; border:1px solid #000; width:600px'>$rupiah</th>
			</tr>
			</table>";
if ($jumlah_data > 0){
	
	$tahapan_kode = '16';
	$jenis_belanja 	= array('1'=>'63', '2'=>'64', '3'=>'65');	
	$jenis 			= array('1'=>'Belanja Pegawai', '2'=>'Belanja Barang dan Jasa', '3'=>'Belanja Modal');

	for ($i=1; $i < 4; $i++){
	
		$where_jenis['anggaran.tahapan_kode'] = $tahapan_kode;
		$where_jenis['rka.tahun'] 	= $laporan_tahun;
		if ($laporan_skpd != 'semua'){ $where_jenis['skpd.skpd_kode'] 		= $laporan_skpd; }
		if ($laporan_program != 'semua'){ $where_jenis['program.kode'] 		= $laporan_program; }
		if ($laporan_kegiatan != 'semua'){ $where_jenis['anggaran.kode'] 	= $laporan_kegiatan; }
		$where_jenis['rka.jenis'] 	= $jenis_belanja[$i];
	
		if ($this->Rka_model->count_bl($where_jenis) > 0){
			
			if ($laporan_program == semua && $laporan_kegiatan == semua){
				$query_belanja	= mysql_query("SELECT rka.kode as id_rka, SUM(rka_sub.total) as totalRKA 
				FROM rka_sub 
				INNER JOIN rka ON rka_sub.rka=rka.kode
				WHERE rka.jenis='".$jenis_belanja[$i]."'
				AND rka.tahun='".$laporan_tahun."'
				AND rka.skpd='".$laporan_skpd."'
				");
				while($row_belanja=mysql_fetch_array($query_belanja)){
				$totalRKA 	= rupiah1($row_belanja['totalRKA']);
					$strhtml .= "<table style='font-family: serif; border:1px solid #000;'>
						<tr>
							<th style='text-align:left; font-size:12pt; font-weight:bold; border:1px solid #000; width:150px'>5.2.$i</th>
							<th style='text-align:left; font-size:12pt; font-weight:bold; border:1px solid #000; width:500px'>$jenis[$i]</th>
							<th style='text-align:right; font-size:12pt; font-weight:bold; border:1px solid #000; width:600px'>$totalRKA</th>
						</tr>
						</table>";
				}
			} else if ($laporan_kegiatan == semua){ 
				$query_belanja	= mysql_query("SELECT rka.kode as id_rka, SUM(rka_sub.total) as totalRKA 
				FROM rka_sub 
				INNER JOIN rka ON rka_sub.rka=rka.kode
				WHERE rka.jenis='".$jenis_belanja[$i]."'
				AND rka.tahun='".$laporan_tahun."'
				AND rka.skpd='".$laporan_skpd."' 
				AND rka.program='".$laporan_program."' 
				");
				while($row_belanja=mysql_fetch_array($query_belanja)){
				$totalRKA 	= rupiah1($row_belanja['totalRKA']);
					$strhtml .= "<table style='font-family: serif; border:1px solid #000;'>
						<tr>
							<th style='text-align:left; font-size:12pt; font-weight:bold; border:1px solid #000; width:150px'>5.2.$i</th>
							<th style='text-align:left; font-size:12pt; font-weight:bold; border:1px solid #000; width:500px'>$jenis[$i]</th>
							<th style='text-align:right; font-size:12pt; font-weight:bold; border:1px solid #000; width:600px'>$totalRKA</th>
						</tr>
						</table>";
				}
			} else { 
				$query_belanja	= mysql_query("SELECT rka.kode as id_rka, SUM(rka_sub.total) as totalRKA 
				FROM rka_sub 
				INNER JOIN rka ON rka_sub.rka=rka.kode
				WHERE rka.jenis='".$jenis_belanja[$i]."'
				AND rka.tahun='".$laporan_tahun."'
				AND rka.skpd='".$laporan_skpd."'
				AND rka_sub.anggaran_kode='".$laporan_kegiatan."' 
				AND rka.program='".$laporan_program."' 
				");
				while($row_belanja=mysql_fetch_array($query_belanja)){
				$totalRKA 	= rupiah1($row_belanja['totalRKA']);
					$strhtml .= "<table style='font-family: serif; border:1px solid #000;'>
						<tr>
							<th style='text-align:left; font-size:12pt; font-weight:bold; border:1px solid #000; width:150px'>5.2.$i</th>
							<th style='text-align:left; font-size:12pt; font-weight:bold; border:1px solid #000; width:500px'>$jenis[$i]</th>
							<th style='text-align:right; font-size:12pt; font-weight:bold; border:1px solid #000; width:600px'>$totalRKA</th>
						</tr>
						</table>";
				}
			}
			
			
			foreach ($this->Rka_model->grid_all('1', 'obyek.kode as kode_obyek, obyek.nomor as nomor_obyek, obyek.obyek_nama as nama_obyek, SUM(rka_sub.total) as totalRKA', 'obyek.no', 'ASC', '', '', $where_jenis, '', 'rka.obyek') as $row){
				$where_urusan['anggaran.tahapan_kode'] 	= $tahapan_kode;
				$where_urusan['rka.tahun'] 	= $laporan_tahun;
				if ($laporan_skpd != 'semua'){ $where_urusan['skpd.skpd_kode'] 		= $laporan_skpd; }
				if ($laporan_program != 'semua'){ $where_urusan['program.kode'] 	= $laporan_program; }
				if ($laporan_kegiatan != 'semua'){ $where_urusan['anggaran.kode'] 	= $laporan_kegiatan; }
				$where_urusan['obyek.kode'] 		= $row->kode_obyek;
				
				if ($this->Rka_model->count_bl($where_urusan) > 0){
				$totalO 	= rupiah1($row->totalRKA);
				$strhtml .= "<table style='font-family: serif; border:1px solid #000;'>
					<tr>
						<th style='text-align:left; font-size:12pt; font-weight:0; border:1px solid #000; width:150px'>5.2.$i.$row->nomor_obyek</th>
						<th style='text-align:left; font-size:12pt; font-weight:0; border:1px solid #000; width:500px'>$row->nama_obyek</th>
						<th style='text-align:right; font-size:12pt; font-weight:0; border:1px solid #000; width:600px'>$totalO</th>
					</tr>
					</table>";
				}
	
					foreach ($this->Rka_model->grid_all('1', 'rincian.kode as kode_rincian, rincian.nomor as nomor_rincian, rincian.rincian_nama as nama_rincian, SUM(rka_sub.total) as totalRKA', 'rincian.kode', 'ASC', '', '', $where_urusan, '', 'rincian.kode') as $subrow){
					$totalS 	= rupiah1($subrow->totalRKA);
					$strhtml .= "<table style='font-family: serif; border:1px solid #000;'>
						<tr>
							<th style='text-align:left; font-size:12pt; font-style:italic; font-weight:0; border:1px solid #000; width:150px'>5.2.$i.$row->nomor_obyek.$subrow->nomor_rincian</th>
							<th style='text-align:left; font-size:12pt; font-style:italic; font-weight:0; border:1px solid #000; width:500px'>$subrow->nama_rincian</th>
							<th style='text-align:center; font-size:12pt; font-weight:0; border:1px solid #000; width:150px'></th>
							<th style='text-align:center; font-size:12pt; font-weight:0; border:1px solid #000; width:150px'></th>
							<th style='text-align:right; font-size:12pt; font-weight:0; border:1px solid #000; width:150px'></th>
							<th style='text-align:right; font-size:12pt; font-style:italic; font-weight:0; border:1px solid #000; width:150px'>$totalS</th>	
						</tr>
						</table>";
						
						$where_rincian['anggaran.tahapan_kode'] 	= $tahapan_kode;
						$where_rincian['rka.tahun'] 	= $laporan_tahun;
						if ($laporan_skpd != 'semua'){ $where_rincian['skpd.skpd_kode'] 		= $laporan_skpd; }
						if ($laporan_program != 'semua'){ $where_rincian['program.kode'] 	= $laporan_program; }
						if ($laporan_kegiatan != 'semua'){ $where_rincian['anggaran.kode'] 	= $laporan_kegiatan; }
						$where_rincian['rincian.kode'] 		= $subrow->kode_rincian;				

						foreach ($this->Rka_model->grid_all('1', 'rka_rincian.kode as kode_rincian, rka_rincian.no as nomor_rincian, rka_rincian.uraian as nama_rincian, SUM(rka_sub.total) as totalRKA', 'rka_rincian.kode', 'ASC', '', '', $where_rincian, '', 'rka_rincian.kode') as $rincianrow){
						$totalR 	= rupiah1($rincianrow->totalRKA);
						$strhtml .= "<table style='font-family: serif; border:1px solid #000;'>
							<tr>
								<th style='text-align:center; font-size:12pt; font-weight:0; border:1px solid #000; width:150px'></th>
								<th style='text-align:left; font-size:12pt; font-weight:0; border:1px solid #000; width:500px'>$rincianrow->nama_rincian</th>
								<th style='text-align:center; font-size:12pt; font-weight:0; border:1px solid #000; width:150px'></th>
								<th style='text-align:center; font-size:12pt; font-weight:0; border:1px solid #000; width:150px'></th>
								<th style='text-align:right; font-size:12pt; font-weight:0; border:1px solid #000; width:150px'></th>
								<th style='text-align:right; font-size:12pt; font-weight:0; border:1px solid #000; width:150px'>$totalR</th>
							</tr>
							</table>";	
							
							$where_sub['anggaran.tahapan_kode'] 	= $tahapan_kode;
							$where_sub['rka.tahun'] 	= $laporan_tahun;
							if ($laporan_skpd != 'semua'){ $where_sub['skpd.skpd_kode']		= $laporan_skpd; }
							if ($laporan_program != 'semua'){ $where_sub['program.kode'] 	= $laporan_program; }
							if ($laporan_kegiatan != 'semua'){ $where_sub['anggaran.kode'] 	= $laporan_kegiatan; }
							$where_sub['rka_rincian.kode']	= $rincianrow->kode_rincian;				

							foreach ($this->Rka_model->grid_all('1', 'rka_sub.kode as kode_sub, rka_sub.no as no_sub, rka_sub.uraian as nama_sub, rka_sub.volume, rka_sub.satuan, rka_sub.harga, rka_sub.total', 'rka_sub.kode', 'ASC', '', '', $where_sub, '', 'rka_sub.kode') as $rsubrow){
							$harga = rupiah1 ($rsubrow->harga);
							$total = rupiah1 ($rsubrow->total);
							$strhtml .= "<table style='font-family: serif; border:1px solid #000;'>
								<tr>
									<th style='text-align:center; font-size:12pt; font-weight:0; border:1px solid #000; width:150px'></th>
									<th style='text-align:left; font-size:12pt; font-weight:0; border:1px solid #000; width:500px'> - $rsubrow->nama_sub</th>
									<th style='text-align:center; font-size:12pt; font-weight:0; border:1px solid #000; width:150px'>$rsubrow->volume</th>
									<th style='text-align:center; font-size:12pt; font-weight:0; border:1px solid #000; width:150px'>$rsubrow->satuan</th>
									<th style='text-align:right; font-size:12pt; font-weight:0; border:1px solid #000; width:150px'>$harga</th>
									<th style='text-align:right; font-size:12pt; font-weight:0; border:1px solid #000; width:150px'>$total</th>
								</tr>
								</table>";
		} } } } }
	}

	$jabatan = strtoupper($laporan_pangkat);
	if ($laporan_program == semua && $laporan_kegiatan == semua){
			$query_jumlah = mysql_query("SELECT skpd.skpd_nomor as no_skpd, skpd.skpd_nama as id_skpd, skpd.urusan as id_urusan, skpd.skpd_alamat as alamat_skpd, skpd.skpd_status as status_skpd, urusan.urusan as nama_urusan, urusan.jenis as jenis_urusan, SUM(rka_sub.total) as total
			FROM rka_sub 
			INNER JOIN rka ON rka_sub.rka=rka.kode
			INNER JOIN skpd ON rka.skpd=skpd.skpd_kode
			INNER JOIN urusan ON rka.urusan=urusan.kode
			WHERE rka.tahun='".$laporan_tahun."'
			AND rka.skpd='".$laporan_skpd."' 
			ORDER BY rka_sub.kode ASC"); 
			$data = mysql_fetch_array($query_jumlah); $id_urusan = $data[id_urusan]; $nama_urusan = $data[nama_urusan]; $jenis_urusan = $data[jenis_urusan]; $id_skpd = $data[id_skpd]; $no_skpd = $data[no_skpd];
			$strhtml2 .= "<table style='font-family: serif; border:1px solid #000;'>
				<tr>
					<th style='text-align:left; font-size:12pt; width:200px'>Urusan Pemerintahan</th>
					<th style='text-align:left; font-size:12pt; font-weight:0; width:200px'>: 1.$id_urusan</th>
					<th style='text-align:left; font-size:12pt; font-weight:0; width:800px'>$jenis_urusan $nama_urusan</th>
				</tr> 
				<tr>
					<th style='text-align:left; font-size:12pt; width:100px'>Organisasi</th>
					<th style='text-align:left; font-size:12pt; font-weight:0; width:200px'>: 1.$id_urusan . 1.$id_urusan.$no_skpd</th>
					<th style='text-align:left; font-size:12pt; font-weight:0; width:800px'>$id_skpd</th>
				</tr>
				</table>";
		} else if ($laporan_kegiatan == semua){
			$query_jumlah = mysql_query("SELECT skpd.skpd_nomor as no_skpd, skpd.skpd_nama as id_skpd, skpd.urusan as id_urusan, skpd.skpd_alamat as alamat_skpd, skpd.skpd_status as status_skpd, urusan.urusan as nama_urusan, urusan.jenis as jenis_urusan, program.program as id_program, program.nomor as no_program, SUM(rka_sub.total) as total
			FROM rka_sub 
			INNER JOIN rka ON rka_sub.rka=rka.kode
			INNER JOIN skpd ON rka.skpd=skpd.skpd_kode
			INNER JOIN urusan ON rka.urusan=urusan.kode
			INNER JOIN program ON rka.program=program.kode
			WHERE rka.tahun='".$laporan_tahun."'
			AND rka.skpd='".$laporan_skpd."' 
			AND rka.program='".$laporan_program."' 
			ORDER BY rka_sub.kode ASC"); 
			$data = mysql_fetch_array($query_jumlah); $id_urusan = $data[id_urusan]; $nama_urusan = $data[nama_urusan]; $jenis_urusan = $data[jenis_urusan]; $id_skpd = $data[id_skpd]; $no_skpd = $data[no_skpd]; $lokasi = $data[alamat_skpd]; $status = $data[status_skpd]; $id_program = $data[id_program]; $no_program = $data[no_program];	
			$strhtml2 .= "<table style='font-family: serif; border:1px solid #000;'>
				<tr>
					<th style='text-align:left; font-size:12pt; width:200px'>Urusan Pemerintahan</th>
					<th style='text-align:left; font-size:12pt; font-weight:0; width:200px'>: 1.$id_urusan</th>
					<th style='text-align:left; font-size:12pt; font-weight:0; width:800px'>$jenis_urusan $nama_urusan</th>
				</tr> 
				<tr>
					<th style='text-align:left; font-size:12pt; width:100px'>Organisasi</th>
					<th style='text-align:left; font-size:12pt; font-weight:0; width:200px'>: 1.$id_urusan . 1.$id_urusan.$no_skpd</th>
					<th style='text-align:left; font-size:12pt; font-weight:0; width:800px'>$id_skpd</th>
				</tr>
				<tr>
					<th style='text-align:left; font-size:12pt; width:100px'>Program</th>
					<th style='text-align:left; font-size:12pt; font-weight:0; width:200px'>: 1.$id_urusan . 1.$id_urusan.$no_skpd . $no_program</th>
					<th style='text-align:left; font-size:12pt; font-weight:0; width:800px'>$id_program</th>
				</tr> 
				</table>";
		} else {
			$query_jumlah = mysql_query("SELECT skpd.skpd_nomor as no_skpd, skpd.skpd_nama as id_skpd, skpd.urusan as id_urusan, skpd.skpd_alamat as alamat_skpd, skpd.skpd_status as status_skpd, urusan.urusan as nama_urusan, urusan.jenis as jenis_urusan, program.program as id_program, program.nomor as no_program, anggaran.kegiatan as id_kegiatan, anggaran.nomor as no_anggaran
			FROM rka_sub 
			INNER JOIN rka ON rka_sub.rka=rka.kode
			INNER JOIN skpd ON rka.skpd=skpd.skpd_kode
			INNER JOIN urusan ON rka.urusan=urusan.kode
			INNER JOIN program ON rka.program=program.kode
			INNER JOIN anggaran ON rka.anggaran_kode=anggaran.kode
			WHERE rka.tahun='".$laporan_tahun."'
			AND rka.skpd='".$laporan_skpd."' 
			AND rka.program='".$laporan_program."' 
			AND rka.anggaran_kode='".$laporan_kegiatan."' 
			ORDER BY rka_sub.kode ASC"); 
			$data = mysql_fetch_array($query_jumlah); $id_urusan = $data[id_urusan]; $nama_urusan = $data[nama_urusan]; $jenis_urusan = $data[jenis_urusan]; $id_skpd = $data[id_skpd]; $no_skpd = $data[no_skpd]; $lokasi = $data[alamat_skpd]; $status = $data[status_skpd]; $id_program = $data[id_program]; $no_program = $data[no_program]; $id_kegiatan = $data[id_kegiatan]; $no_anggaran = $data[no_anggaran];
			$strhtml2 .= "<table style='font-family: serif; border:1px solid #000;'>
				<tr>
					<th style='text-align:left; font-size:12pt; width:200px'>Urusan Pemerintahan</th>
					<th style='text-align:left; font-size:12pt; font-weight:0; width:200px'>: 1.$id_urusan</th>
					<th style='text-align:left; font-size:12pt; font-weight:0; width:800px'>$jenis_urusan $nama_urusan</th>
				</tr> 
				<tr>
					<th style='text-align:left; font-size:12pt; width:100px'>Organisasi</th>
					<th style='text-align:left; font-size:12pt; font-weight:0; width:200px'>: 1.$id_urusan . 1.$id_urusan.$no_skpd</th>
					<th style='text-align:left; font-size:12pt; font-weight:0; width:800px'>$id_skpd</th>
				</tr>
				<tr>
					<th style='text-align:left; font-size:12pt; width:100px'>Program</th>
					<th style='text-align:left; font-size:12pt; font-weight:0; width:200px'>: 1.$id_urusan . 1.$id_urusan.$no_skpd . $no_program</th>
					<th style='text-align:left; font-size:12pt; font-weight:0; width:800px'>$id_program</th>
				</tr> 
				<tr>
					<th style='text-align:left; font-size:12pt; width:100px'>Kegiatan</th>
					<th style='text-align:left; font-size:12pt; font-weight:0; width:200px'>: 1.$id_urusan . 1.$id_urusan.$no_skpd . $no_program . 01</th>
					<th style='text-align:left; font-size:12pt; font-weight:0; width:800px'>$id_kegiatan</th>
				</tr> 
				</table>";			
		}

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
} else {
	$strhtml .= "<table style='font-family: serif; border:1px solid #000;'>
		<tr>
		   <td style='text-align:center; font-size:12pt; font-weight:bold; border:1px solid #000;'colspan='3'>PEMERINTAH KABUPATEN BEKASI<br>TAHUN ANGGARAN : $laporan_tahun</td>
		</tr>
	   </table>";
}// END
	
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