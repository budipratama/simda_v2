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
		$this->MultiCell($w2, 5, "                                               RENCANA KERJA DAN ANGGARAN                                               SATUAN KERJA PERANGKAT DAERAH", 0, "C");
		$this->SetXY($x1+$w1, $this->GetY());
		$this->MultiCell($w2, 5, "                                               PEMERINTAH KABUPATEN BEKASI                                                  Tahun Anggaran : $laporan_tahun", 0, "C");

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
		$this->Cell($w1,$hCell,"",0,"C");
		
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
	}
		$h = 5;
		$left = 40;
		$pdf->SetFillColor(200,200,200);
		$left = $pdf->GetX();
		$pdf->Cell(20,$h,'KD Reg',1,0,'C',true);
		$pdf->SetX($left += 20); $pdf->Cell(88, $h, 'URAIAN', 1, 0, 'C',true);
		$pdf->SetX($left += 88); $pdf->Cell(26, $h, 'TAHUN INI', 1, 0, 'C',true);
		$pdf->SetX($left += 26); $pdf->Cell(26, $h, 'TRIWULAN I', 1, 0, 'C',true);
		$pdf->SetX($left += 26); $pdf->Cell(26, $h, 'TRIWULAN II', 1, 0, 'C',true);	
	
if ($jumlah_data > 0){
	$jenis_urusan = array('1'=>'wajib', '2'=>'pilihan');
	
	
	for ($i=1; $i <= 2; $i++){
		
		$where_jenis['anggaran.tahapan_kode'] = $tahapan_kode;
		$where_jenis['anggaran.tahun'] 	= $laporan_tahun;
		if ($laporan_kecamatan != 'semua'){ $where_jenis['anggaran.kecamatan_kode']	= $laporan_kecamatan; }
		if ($laporan_deskel != 'semua'){ $where_jenis['anggaran.deskel_kode']	= $laporan_deskel; }
		if ($laporan_skpd != 'semua'){ $where_jenis['skpd.skpd_kode'] 	= $laporan_skpd; }
		$where_jenis['urusan.jenis'] 	= $jenis_urusan[$i];
		
		//Cek Jumlah data pada Jenis Urusan
		if ($this->Anggaran_model->count_bl($where_jenis) > 0){
			
		$pdf->Ln();
		$h = 5;
		$left = 40;
		$pdf->SetFillColor(255,255,255);
		$left = $pdf->GetX();
		$pdf->Cell(20,$h,'$i',1,0,'C',true);
		$pdf->SetX($left += 20); $pdf->Cell(88, $h, '$jenis_urusan[$i]', 1, 0, 'C',true);
		$pdf->SetX($left += 88); $pdf->Cell(26, $h, 'TAHUN INI', 1, 0, 'C',true);
		$pdf->SetX($left += 26); $pdf->Cell(26, $h, 'TRIWULAN I', 1, 0, 'C',true);
		$pdf->SetX($left += 26); $pdf->Cell(26, $h, 'TRIWULAN II', 1, 0, 'C',true);	
		
	}
	}
}

$pdf->Output();