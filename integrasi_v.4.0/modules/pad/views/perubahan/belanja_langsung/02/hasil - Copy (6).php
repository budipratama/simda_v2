<?php
class PDF extends FPDF {
	//Page header
	function Header(){}
 
	function Content($laporan_tahun) {
		$this->Image(base_url().'public/dist/img/logo.jpg', 16, 12,'15','15','jpeg');
		$this->setFont('Arial','B',9);
		$this->setFillColor(255,255,255);
		$w1 = 26;
		$w2 = 140;
		$w3 = 29;
		$y1 = $this->GetY();
		$x1 = $this->GetX();

		$this->SetXY($x1+$w1, $this->GetY());
		$this->MultiCell($w2, 5, "                                               RENCANA KERJA DAN ANGGARAN                                               SATUAN KERJA PERANGKAT DAERAH", 1, "C");
		$this->SetXY($x1+$w1, $this->GetY());
		$this->MultiCell($w2, 5, "                                               PEMERINTAH KABUPATEN BEKASI                                                  Tahun Anggaran : $laporan_tahun", 1, "C");

		$y2 = $this->GetY();
		$hCell = $y2 - $y1;
		$this->SetXY($x1, $y1);
		$this->Cell($w1,$hCell,"",1,"C");

		$this->SetXY($x1+$w1+$w2, $y1);
		$this->MultiCell($w3, 10," Formulir RKA SKPD 2.2.1",1,"C");
	}
		
	function Footer() {
		$this->SetY(10);		
		$w1 = 195;
		$w2 = 85;
		$y1 = $this->GetY();
		$x1 = $this->GetX();
		
		$this->SetXY($x1+$w1, $this->GetY());
		$this->MultiCell($w2, 5, "
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		", 0, "C");
		
		$this->setFont('Arial','',7);
		$y2 = $this->GetY();
		$hCell = $y2 - $y1;
		$this->SetXY($x1, $y1);
		$this->Cell($w1,$hCell,"",1,"C");
		
		$this->Ln(5);
		$y2 = $this->GetY();
		$hCell = $y2 - $y1;
		$this->SetXY($x1, $y1);
		$this->Cell($w1,$hCell,"",0,"C");
		
		$this->Ln(15);
		$y2 = $this->GetY();
		$hCell = $y2 - $y1;
		$this->SetXY($x1, $y1);
		$this->Cell($w1,$hCell,"",0,"C");
		
		$this->Ln(25);
		$y2 = $this->GetY();
		$hCell = $y2 - $y1;
		$this->SetXY($x1, $y1);
		$this->Cell($w1,$hCell,"",0,"C");
	
		$this->SetY(275);
		$this->SetFont('Arial','I',6);
		$this->Cell(80,3,iconv("UTF-8","TIS-620","Formulir RKA SKPD 2.2.1"),0,0,'L');
		$this->Cell(12,3,iconv("UTF-8","TIS-620","BAPPEDA"),0,0,'C');
		$this->Cell(15,3,iconv("UTF-8","TIS-620","Pembangunan"),0,0,'C');
		$this->Cell(12,3,iconv("UTF-8","TIS-620","BPKAD"),0,0,'C');
		$this->Cell(15,3,iconv("UTF-8","TIS-620","Perlengkapan"),0,0,'C');
		$this->Cell(12,3,iconv("UTF-8","TIS-620","Organisasi"),0,0,'C');
		$this->Cell(25,3,iconv("UTF-8","TIS-620",""),0,0,'C');
		$this->Cell(12,3,iconv("UTF-8","TIS-620","BAPPEDA"),0,0,'C');
		$this->Cell(12,3,iconv("UTF-8","TIS-620","BPKAD"),0,0,'C');
		
		$this->SetY(275);
		$this->SetFont('Arial','I',6);
		$this->Cell(80,14,iconv("UTF-8","TIS-620","Tim Verifikasi"),1,0,'R');
		$this->Cell(12,14,iconv("UTF-8","TIS-620",""),1,0,'C');
		$this->Cell(15,14,iconv("UTF-8","TIS-620",""),1,0,'C');
		$this->Cell(12,14,iconv("UTF-8","TIS-620",""),1,0,'C');
		$this->Cell(15,14,iconv("UTF-8","TIS-620",""),1,0,'C');
		$this->Cell(12,14,iconv("UTF-8","TIS-620",""),1,0,'C');
		$this->Cell(25,14,iconv("UTF-8","TIS-620","Koordinator"),1,0,'C');
		$this->Cell(12,14,iconv("UTF-8","TIS-620",""),1,0,'C');
		$this->Cell(12,14,iconv("UTF-8","TIS-620",""),1,0,'C');
		
		$this->SetY(-8);
		$this->SetFont('Arial','I',5);
		$this->Cell(175,3,iconv("UTF-8","TIS-620","PrinTed By INTEGRASI"),0,0,'L');
		$this->Cell(20,3,iconv("UTF-8","TIS-620",'Halaman '.$this->PageNo().' dari {nb}'),0,0,'R');
	}
}

$pdf = new PDF();
$pdf->SetTitle('INTEGRASI | Kab Bekasi');
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->Content($laporan_tahun);
	
	$pdf->setFont('Arial','',9);
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
		$pdf->setFont('Arial','B',7);
		$pdf->cell(30,6,'Urusan Pemerintahan',1,0,'L',1);
		$pdf->setFont('Arial','',7);
		$pdf->cell(40,6,"1.$row_get->id_urusan",1,0,'L',1);
		$pdf->MultiCell(125,6,"$row_get->jenis_urusan $row_get->nama_urusan",1,1,'L',1);
		$pdf->setFont('Arial','B',8);
		$pdf->cell(30,6,'Organisasi',1,0,'L',1);
		$pdf->setFont('Arial','',7);
		$pdf->cell(40,6,"1.$row_get->id_urusan . 1.$row_get->id_urusan.$row_get->no_skpd",1,0,'L',1);
		$pdf->MultiCell(125,6,"$row_get->id_skpd",1,1,'L',1);
		$pdf->setFont('Arial','B',8);
		$pdf->cell(30,6,'Program',1,0,'L',1);
		$pdf->setFont('Arial','',7);
		$pdf->cell(40,6,"1.$row_get->id_urusan . 1.$row_get->id_urusan.$row_get->no_skpd . $row_get->no_program",1,0,'L',1);
		$pdf->MultiCell(125,6,"$row_get->id_program",1,1,'L',1);
		$pdf->setFont('Arial','B',8);
		$pdf->cell(30,6,'Kegiatan',1,0,'L',1);
		$pdf->setFont('Arial','',7);
		$pdf->cell(40,6,"1.$row_get->id_urusan . 1.$row_get->id_urusan.$row_get->no_skpd . $row_get->no_program . 01",1,0,'L',1);
		$pdf->MultiCell(125,6,"$row_get->id_anggaran",1,1,'L',1);
		$pdf->setFont('Arial','B',8);
		$pdf->cell(195,6,"Lokasi Kegiatan       : $row_get->alamat_skpd",1,1,'L',1);

		$w1 = 30;
		$w2 = 165;
		$y1 = $pdf->GetY();
		$x1 = $pdf->GetX();
		$pdf->setFont('Arial','',7);
		$rupiah = rupiah1($jumlah);
		$terbilang = Terbilang($jumlah);
		$pdf->SetXY($x1+$w1, $pdf->GetY());
		$pdf->MultiCell($w2, 5,"Rp      0,00", 1, "L");
		$pdf->SetXY($x1+$w1, $pdf->GetY());
		$pdf->MultiCell($w2, 5,"Rp      $rupiah       ($terbilang rupiah )", 1, "L");
		$pdf->SetXY($x1+$w1, $pdf->GetY());
		$pdf->MultiCell($w2, 5,"Rp      0,00", 1, "L");

		$y2 = $pdf->GetY();
		$hCell = $y2 - $y1;
		$pdf->SetXY($x1, $y1);
		$pdf->setFont('Arial','B',8);
		$pdf->MultiCell($w1,5,"Jumlah Tahun n - 1",1,"L");
		$pdf->MultiCell($w1,5,"Jumlah Tahun n",1,"L");
		$pdf->MultiCell($w1,5,"Jumlah Tahun n + 1",1,"L");
		
		$pdf->setFont('Arial','B',9);
		$pdf->cell(195,6,'INDIKATOR & TOLOK UKUR KINERJA BELANJA LANGSUNG',1,1,'C',1);
		
		$pdf->setFont('Arial','B',8);
		$pdf->cell(30,6,'INDIKATOR',1,0,'C',1);
		$pdf->cell(125,6,'TOLOK UKUR KERJA',1,0,'C',1);
		$pdf->cell(40,6,'TARGET KINERJA',1,1,'C',1);
		
		$pdf->setFont('Arial','B',7);
		$pdf->cell(30,6,'CAPAIAN PROGRAM',1,0,'L',1);
		$pdf->setFont('Arial','',7);
		$pdf->cell(125,6,"$row_get->hpu_anggaran",1,0,'L',1);
		$pdf->cell(40,6,"$row_get->hpt_anggaran $row_get->hps_anggaran",1,1,'L',1);
		
		$pdf->setFont('Arial','B',8);
		$pdf->cell(30,6,'MASUKAN',1,0,'L',1);
		$pdf->setFont('Arial','',7);
		$pdf->cell(125,6,'Jumlah Dana',1,0,'L',1);
		$pdf->cell(40,6,"Rp. $rupiah",1,1,'L',1);
		
		$pdf->setFont('Arial','B',8);
		$pdf->cell(30,6,'KELUARAN',1,0,'L',1);
		$pdf->setFont('Arial','',7);
		$pdf->cell(125,6,"$row_get->khu_anggaran",1,0,'L',1);
		$pdf->cell(40,6,"$row_get->kht_anggaran $row_get->khs_anggaran",1,1,'L',1);
		
		$pdf->setFont('Arial','B',8);
		$pdf->cell(30,6,'HASIL',1,0,'L',1);
		$pdf->setFont('Arial','',7);
		$pdf->cell(125,6,"$row_get->hku_anggaran",1,0,'L',1);
		$pdf->cell(40,6,"$row_get->hkt_anggaran $row_get->hks_anggaran",1,1,'L',1);
		$pdf->setFont('Arial','B',8);
		$pdf->cell(195,6,"Kelompok Sasaran Kegiatan   : $row_get->status_skpd",1,1,'L',1);
	}
		$pdf->setFont('Arial','B',9);
		$pdf->setFillColor(255,255,255);
		$pdf->MultiCell(195,4,'                                 RINCIAN ANGGARAN BELANJA LANGSUNG MENURUT PROGRAM DAN PER KEGIATAN                                                                                                             SATUAN KERJA PRANGKAT DAERAH',1,1,'C',1);	
 		
		$w1 = 26;
		$w2 = 50;
		$w3 = 26;
		$y1 = $pdf->GetY();
		$x1 = $pdf->GetX();

		$pdf->setFont('Arial','B',8);
		$pdf->Line(105,$pdf->GetY(),177,$pdf->GetY());
		$pdf->cell(176,5,"RINCIAN PERHITUNGAN                        ",0,1,'R',1);		
		$pdf->SetXY($x1+$w1, $pdf->GetY());
		$pdf->cell(82,5,'',0,0,'C',0);
		$pdf->Cell(13, 5, " Volume", 1, "R");
		$pdf->Cell(22, 5, "      Satuan", 1, "R");
		$pdf->Cell(26, 5, "          Harga", 1, "R");
		
		$y2 = $pdf->GetY();
		$hCell = $y2 - $y1;
		$pdf->SetXY($x1, $y1);
		$pdf->setFont('Arial','B',7);
		$pdf->Cell(20, 10,"KD REKENING",1,"C");
		$pdf->setFont('Arial','B',8);
		$pdf->Cell(88, 10,"                                                        URAIAN",1,"C");

		$pdf->SetXY($x1+$w1+$w2, $y1);
		$pdf->cell(93,5,'',0,0,'C',0);
		$pdf->MultiCell($w3, 5,"       JUMLAH         (Rp)",1,"C");
		
		$h = 5;
		$left = 40;
		$pdf->SetFillColor(200,200,200);
		$left = $pdf->GetX();
		$pdf->Cell(20,$h,'1',1,0,'C',true);
		$pdf->SetX($left += 20); $pdf->Cell(88, $h, '2', 1, 0, 'C',true);
		$pdf->SetX($left += 88); $pdf->Cell(13, $h, '3', 1, 0, 'C',true);
		$pdf->SetX($left += 13); $pdf->Cell(22, $h, '4', 1, 0, 'C',true);
		$pdf->SetX($left += 22); $pdf->Cell(26, $h, '5', 1, 0, 'C',true);
		$pdf->SetX($left += 26); $pdf->Cell(26, $h, '6', 1, 1, 'C',true);	
	
	$h = 5;
	$left = 40;
	$pdf->SetFont('Arial','B',7);
	$pdf->SetFillColor(255,255,255);
	$left = $pdf->GetX();
	$pdf->Cell(20,$h,'5',1,0,'L',true);
	$pdf->SetX($left += 20); $pdf->Cell(88, $h, 'BELANJA', 1, 0, 'L',true);
	$pdf->SetX($left += 88); $pdf->Cell(87, $h, rupiah1($jumlah), 1, 1, 'R',true);
	
	$h = 5;
	$left = 40;
	$pdf->SetFont('Arial','B',7);
	$pdf->SetFillColor(255,255,255);
	$left = $pdf->GetX();
	$pdf->Cell(20,$h,'5.2',1,0,'L',true);
	$pdf->SetX($left += 20); $pdf->Cell(88, $h, 'BELANJA LANGSUNG', 1, 0, 'L',true);
	$pdf->SetX($left += 88); $pdf->Cell(87, $h, rupiah1($jumlah), 1, 1, 'R',true);

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
	$h = 5;
	$left = 40;
	$pdf->SetFont('Arial','B',7);
	$pdf->SetFillColor(255,255,255);
	$left = $pdf->GetX();
	$pdf->Cell(20,$h,"5.2.$i",1,0,'L',true);
	$pdf->SetX($left += 20); $pdf->Cell(88, $h, $jenis[$i], 1, 0, 'L',true);
	$pdf->SetX($left += 88); $pdf->Cell(87, $h, rupiah1($row_belanja['totalRKA']), 1, 1, 'R',true);
	
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
		$h = 5;
		$left = 40;
		$pdf->SetFont('Arial','I',6);
		$pdf->SetFillColor(255,255,255);
		$left = $pdf->GetX();
		$pdf->Cell(20,$h,"5 . 2 . $i . $row_id->no_obyek",1,0,'L',true);
		$pdf->SetX($left += 20); $pdf->Cell(88, $h, "$row_id->nama_obyek", 1, 0, 'L',true);
		
		$query_total 	= $this->db->query("SELECT SUM(rka_sub.total) as totalRKA 
		FROM rka_sub 
		WHERE rka_sub.tipe_kode= '1'
		AND rka_sub.anggaran_kode='".$laporan_anggaran."' 
		AND rka_sub.rka='".$row_id->id_rka."'
		");			
		$data_total 	= $query_total->result();
		if($data_total){ foreach($data_total as $task){ $pdf->SetX($left += 88); $pdf->Cell(87, $h, rupiah1 ($task->totalRKA), 1, 1, 'R',true); } }
		
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
			$h = 5;
			$left = 40;
			$pdf->SetFont('Arial','',6);
			$pdf->SetFillColor(255,255,255);
			$left = $pdf->GetX();
			$pdf->Cell(20,$h,"5 . 2 . $i . $row_id->no_obyek . $row_rka->no_rincian",1,0,'L',true);
			$pdf->SetX($left += 20); $pdf->Cell(88, $h, "$row_rka->nama_rincian", 1, 0, 'L',true);
			
			$query_jumlah 	= $this->db->query("SELECT SUM(rka_sub.total) as totalRKA 
			FROM rka_sub 
			WHERE rka_sub.tipe_kode= '1'
			AND rka_sub.anggaran_kode='".$laporan_anggaran."' 
			AND rka_sub.rka='".$row_id->id_rka."' ");			
			$data_jumlah 	= $query_jumlah->result();
			if($data_jumlah){ foreach($data_jumlah as $task){ $pdf->SetX($left += 88); $pdf->Cell(87, $h, rupiah1 ($task->totalRKA), 1, 1, 'R',true); } }
				
				$query_rincian = $this->db->query("SELECT rka_rincian.kode as id_rincian, rka_rincian.no as no_rincian, rka_rincian.uraian as nama_rincian 
				FROM rka_rincian 
				LEFT JOIN rka ON rka.kode=rka_rincian.kode 
				WHERE rka_rincian.tipe_kode= '1' 
				AND rka_rincian.anggaran_kode='".$laporan_anggaran."' 
				AND rka_rincian.rka='".$row_id->id_rka."' 
				GROUP BY rka_rincian.kode ORDER BY rka_rincian.kode ASC");
				$data_rincian	= $query_rincian->result();				
				foreach($data_rincian as $row_rincian) {
				$h = 5;
				$left = 40;
				$pdf->SetFont('Arial','',6);
				$pdf->SetFillColor(255,255,255);
				$left = $pdf->GetX();
				$pdf->Cell(20,$h,"",1,0,'L',true);
				$pdf->SetX($left += 20); $pdf->Cell(88, $h, "  $row_rincian->nama_rincian", 1, 0, 'L',true);
				
				$query_hasil 	= $this->db->query("SELECT SUM(rka_sub.total) as totalRKA 
				FROM rka_sub 
				WHERE rka_sub.tipe_kode= '1'
				AND rka_sub.anggaran_kode='".$laporan_anggaran."' 
				AND rka_sub.rka='".$row_id->id_rka."'
				AND rka_sub.rka_rincian='".$row_rincian->id_rincian."'
				");			
				$data_hasil 	= $query_hasil->result();
				if($data_hasil){ foreach($data_hasil as $task){ $pdf->SetX($left += 88); $pdf->Cell(87, $h, rupiah1 ($task->totalRKA), 1, 1, 'R',true); } }
				
					$query_sub = $this->db->query("SELECT rka_sub.kode as id_sub, rka_sub.total, rka_sub.harga, rka_sub.satuan, rka_sub.volume, rka_sub.uraian 
					FROM rka_sub 
					LEFT JOIN rka ON rka.kode=rka_sub.kode 
					WHERE rka_sub.tipe_kode= '1'
					AND rka_sub.rka='".$row_id->id_rka."' 
					AND rka_sub.rka_rincian='".$row_rincian->id_rincian."' 
					GROUP BY rka_sub.kode ORDER BY rka_sub.kode ASC");	
					$data_sub	= $query_sub->result();
					foreach($data_sub as $row_sub) {
					$h = 5;
					$left = 40;
					$pdf->SetFillColor(255,255,255);
					$left = $pdf->GetX();
					$pdf->Cell(20,$h, "",1,0,'C',true);
					$pdf->SetX($left += 20); $pdf->Cell(88, $h, "  - $row_sub->uraian", 1, 0, 'L',true);
					$pdf->SetX($left += 88); $pdf->Cell(13, $h, "$row_sub->volume", 1, 0, 'C',true);
					$pdf->SetX($left += 13); $pdf->Cell(22, $h, "$row_sub->satuan", 1, 0, 'C',true);
					$pdf->SetX($left += 22); $pdf->Cell(26, $h, rupiah1 ($row_sub->harga), 1, 0, 'R',true);
					$pdf->SetX($left += 26); $pdf->Cell(26, $h, rupiah1 ($row_sub->total), 1, 1, 'R',true);
		} } } }
	} }	

		
	$pdf->AliasNbPages();
	$pdf->AddPage();
	$pdf->setFont('Arial','',9);
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
		$pdf->setFont('Arial','B',7);
		$pdf->cell(30,6,'Urusan Pemerintahan',1,0,'L',1);
		$pdf->setFont('Arial','',7);
		$pdf->cell(35,6,"1.$row_get->id_urusan",1,0,'L',1);
		$pdf->MultiCell(130,6,"$row_get->jenis_urusan $row_get->nama_urusan",1,1,'L',1);
		$pdf->setFont('Arial','B',8);
		$pdf->cell(30,6,'Organisasi',1,0,'L',1);
		$pdf->setFont('Arial','',7);
		$pdf->cell(35,6,"1.$row_get->id_urusan . 1.$row_get->id_urusan.$row_get->no_skpd",1,0,'L',1);
		$pdf->MultiCell(130,6,"$row_get->id_skpd",1,1,'L',1);
		$pdf->setFont('Arial','B',8);
		$pdf->cell(30,6,'Program',1,0,'L',1);
		$pdf->setFont('Arial','',7);
		$pdf->cell(35,6,"1.$row_get->id_urusan . 1.$row_get->id_urusan.$row_get->no_skpd . $row_get->no_program",1,0,'L',1);
		$pdf->MultiCell(130,6,"$row_get->id_program",1,1,'L',1);
		$pdf->setFont('Arial','B',8);
		$pdf->cell(30,6,'Kegiatan',1,0,'L',1);
		$pdf->setFont('Arial','',7);
		$pdf->cell(35,6,"1.$row_get->id_urusan . 1.$row_get->id_urusan.$row_get->no_skpd . $row_get->no_program . 01",1,0,'L',1);
		$pdf->MultiCell(130,6,"$row_get->id_anggaran",1,1,'L',1);
	}

					$bulan = array ("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
					$waktu[1]=date("d",time());
					$waktu[2]=date("m",time());
					$waktu[3]=date("Y",time());
					$tanggalini="$waktu[1] ".$bulan[$waktu[2]-1]." $waktu[3]";
					$pdf->setFont('Arial','',9);	
					$skpd = strtoupper($row_get->id_skpd);		
					$w1 = 110;
					$w2 = 85;
					$y1 = $pdf->GetY();
					$x1 = $pdf->GetX();
		
					$pdf->SetXY($x1+$w1, $pdf->GetY());
					$pdf->MultiCell($w2, 5, "
				
		
					CIKARANG PUSAT, $tanggalini
					$skpd
		
		
		
		
		
		
					$row_get->nama_tim
					_____________________________________
					NIP. $row_get->nip_tim
		
					", 1, "C");
		
					$pdf->setFont('Arial','',7);
					$y2 = $pdf->GetY();
					$hCell = $y2 - $y1;
					$pdf->SetXY($x1, $y1);
					$pdf->Cell($w1,$hCell,"",1,"C");
		
					$pdf->Ln(5);
					$y2 = $pdf->GetY();
					$hCell = $y2 - $y1;
					$pdf->SetXY($x1, $y1);
					$pdf->Cell($w1,$hCell,"Keterangan :",0,"C");
		
					$pdf->Ln(15);
					$y2 = $pdf->GetY();
					$hCell = $y2 - $y1;
					$pdf->SetXY($x1, $y1);
					$pdf->Cell($w1,$hCell,"- Tanggal Pembahasan :",0,"C");
		
					$pdf->Ln(25);
					$y2 = $pdf->GetY();
					$hCell = $y2 - $y1;
					$pdf->SetXY($x1, $y1);
					$pdf->Cell($w1,$hCell,"- Catatan Hasil Pembahasan :",0,"C");
					
							$pdf->Ln(80);
							$h = 8;
							$left = 40;
							$pdf->SetFillColor(255,255,255);
							$pdf->setFont('Arial','B',9);
							$left = $pdf->GetX();
							$pdf->Cell(195,$h, "TIM ANGGARAN PEMERINTAH DAERAH",1,0,'C',true);
							$pdf->Ln();
							
							$h = 8;
							$left = 40;
							$left = $pdf->GetX();
							$pdf->setFont('Arial','B',8);
							$pdf->Cell(5,$h, "No",1,0,'C',true);
							$pdf->SetX($left += 5); $pdf->Cell(45, $h, "NAMA", 1, 0, 'L',true);
							$pdf->SetX($left += 45); $pdf->Cell(30, $h, "NIP", 1, 0, 'C',true);
							$pdf->SetX($left += 30); $pdf->Cell(86, $h, "JABATAN", 1, 0, 'C',true);
							$pdf->SetX($left += 86); $pdf->Cell(29, $h, "TANDA TANGAN", 1, 0, 'C',true);
							$pdf->Ln();
							
							$query_tim = mysql_query("SELECT *
							FROM tim_anggaran
							WHERE tim_anggaran.kode_tim= '1'
							GROUP BY tim_anggaran.kode ORDER BY tim_anggaran.kode ASC");		
							while($row_tim=mysql_fetch_array($query_tim)){
							$h = 5;
							$left = 40;
							$pdf->setFont('Arial','',6);
							$left = $pdf->GetX();
							$pdf->Cell(5,$h, $row_tim['kode'],1,0,'C',true);
							$pdf->SetX($left += 5); $pdf->Cell(45, $h, $row_tim['nama'], 1, 0, 'L',true);
							$pdf->SetX($left += 45); $pdf->Cell(30, $h, $row_tim['nip'], 1, 0, 'C',true);
							$pdf->SetX($left += 30); $pdf->Cell(86, $h, $row_tim['jabatan'], 1, 0, 'L',true);
							$pdf->SetX($left += 86); $pdf->Cell(29, $h, "", 1, 0, ':',true);
							$pdf->Ln();
							}
			
							$pdf->setFont('Arial','',7);
							$pdf->Cell(5,5,"- Rencana Kerja Anggaran Satuan Kerja Perangkat Daerah (RKA-SKPD)",0,"C");
							$pdf->Ln();
							$pdf->Cell(5,5,"  Sepenuhnya Menjadi Tanggungjawab Pengguna Anggaran.",0,"C");
$pdf->Output();