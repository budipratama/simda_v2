<?php
class PDF extends FPDF {
	//Page header
	function Header(){}
 
	function Content_h($rka, $rincian) {
		$this->Image(base_url().'public/dist/img/logo.jpg', 16, 12,'15','15','jpeg');
		$this->setFont('Arial','',7);
		$this->setFillColor(255,255,255);
		$w1 = 26;
		$w2 = 140;
		$w3 = 29;
		$y1 = $this->GetY();
		$x1 = $this->GetX();

		$this->SetXY($x1+$w1, $this->GetY());
		$this->MultiCell($w2, 5, "                                                                     RENCANA KERJA DAN ANGGARAN                                                                      SATUAN KERJA PERANGKAT DAERAH", 1, "C");
		$this->SetXY($x1+$w1, $this->GetY());
		$this->MultiCell($w2, 5, "                                                                     PEMERINTAH KABUPATEN BEKASI                                                                     Tahun Anggaran : $rka->id_tahun", 1, "C");

		$y2 = $this->GetY();
		$hCell = $y2 - $y1;
		$this->SetXY($x1, $y1);
		$this->Cell($w1,$hCell,"",1,"C");

		$this->SetXY($x1+$w1+$w2, $y1);
		$this->MultiCell($w3, 10," Formulir RKA SKPD 2.2.1",1,"C");

		$this->cell(30,6,'Urusan Pemerintahan :',1,0,'L',1);
		$this->cell(40,6,"1.$rka->id_urusan",1,0,'L',1);
		$this->MultiCell(125,6,"??",1,1,'L',1);
		$this->cell(30,6,'Organisasi                   :',1,0,'L',1);
		$this->cell(40,6,"1.$rka->id_urusan . 1.$rka->id_urusan.",1,0,'L',1);
		$this->MultiCell(125,6,$rka->id_skpd,1,1,'L',1);
		$this->cell(30,6,'Program                      :',1,0,'L',1);
		$this->cell(40,6,"1.$rka->id_urusan . 1.$rka->id_urusan.",1,0,'L',1);
		$this->MultiCell(125,6,$rka->id_program,1,1,'L',1);
		$this->cell(30,6,'Kegiatan                      :',1,0,'L',1);
		$this->cell(40,6,"1.$rka->id_urusan . 1.$rka->id_urusan.",1,0,'L',1);
		$this->MultiCell(125,6,$rka->id_kegiatan,1,1,'L',1);
		
		$this->cell(195,6,"Lokasi Kegiatan       : $rka->id_alamat",1,1,'L',1);
		
		$w1 = 30;
		$w2 = 165;
		$y1 = $this->GetY();
		$x1 = $this->GetX();

		$this->SetXY($x1+$w1, $this->GetY());
		$this->MultiCell($w2, 5, "Rp", 1, "L");
		$this->SetXY($x1+$w1, $this->GetY());
		$this->MultiCell($w2, 5, "Rp", 1, "L");
		$this->SetXY($x1+$w1, $this->GetY());
		$this->MultiCell($w2, 5, "Rp", 1, "L");
		
		$y2 = $this->GetY();
		$hCell = $y2 - $y1;
		$this->SetXY($x1, $y1);
		$this->MultiCell($w1,5,"Jumlah Tahun n - 1  : ",1,"L");
		$this->MultiCell($w1,5,"Jumlah Tahun n       : ",1,"L");
		$this->MultiCell($w1,5,"Jumlah Tahun n + 1 : ",1,"L");

		$this->cell(195,6,'INDIKATOR & TOLOK UKUR KINERJA BELANJA LANGSUNG',1,1,'C',1);

		$this->cell(30,6,'INDIKATOR',1,0,'C',1);
		$this->cell(125,6,'TOLOK UKUR KERJA',1,0,'C',1);
		$this->cell(40,6,'TARGET KINERJA',1,1,'C',1);
		
		$this->cell(30,6,'CAPAIAN PROGRAM',1,0,'L',1);
		$this->cell(125,6,'Meningkatkan Prasarana dan Sarana Komunikasi dan Informatika',1,0,'L',1);
		$this->cell(40,6,'100 %',1,1,'L',1);
		
		$this->cell(30,6,'MASUKAN',1,0,'L',1);
		$this->cell(125,6,'Jumlah Dana',1,0,'L',1);
		$this->cell(40,6,"Rp",1,1,'L',1);
		
		$this->cell(30,6,'KELUARAN',1,0,'L',1);
		$this->cell(125,6,'???',1,0,'L',1);
		$this->cell(40,6,'??',1,1,'L',1);
		
		$this->cell(30,6,'HASIL',1,0,'L',1);
		$this->cell(125,6,'???',1,0,'L',1);
		$this->cell(40,6,'??',1,1,'L',1);
		
		$this->cell(195,6,'Kelompok Sasaran Kegiatan   : ??',1,1,'L',1);
	}
	
	function Content() {
		$this->setFont('Arial','B',7);
		$this->setFillColor(255,255,255);
		$this->MultiCell(195,4,'                                                                  RINCIAN ANGGARAN BELANJA LANGSUNG MENURUT PROGRAM DAN PER KEGIATAN                                                                                                                                                                                SATUAN KERJA PRANGKAT DAERAH',1,1,'C',1);	
 		
		$w1 = 26;
		$w2 = 50;
		$w3 = 22;
		$y1 = $this->GetY();
		$x1 = $this->GetX();

		$this->Line(105,$this->GetY(),177,$this->GetY());
		$this->cell(167,5,"RINCIAN PERHITUNGAN                              ",0,1,'R',1);		
		$this->SetXY($x1+$w1, $this->GetY());
		$this->cell(69,5,'',0,0,'C',0);
		$this->Cell(18, 5, "     Volume", 1, "R");
		$this->Cell(38, 5, "                    Satuan", 1, "R");
		$this->Cell(22, 5, "          Harga", 1, "R");
		
		$y2 = $this->GetY();
		$hCell = $y2 - $y1;
		$this->SetXY($x1, $y1);
		$this->Cell(20, 10,"KD REKENING",1,"C");
		$this->Cell(75, 10,"                                               URAIAN",1,"C");

		$this->SetXY($x1+$w1+$w2, $y1);
		$this->cell(97,5,'',0,0,'C',0);
		$this->MultiCell($w3, 5,"       JUMLAH         (Rp)",1,"C");		

		$w1 = 20;
		$w2 = 75;
		$y1 = $this->GetY();
		$x1 = $this->GetX();
		$this->SetXY($x1+$w1, $this->GetY());
		$this->MultiCell($w2, 5, "2", 1, "C");

		$y2 = $this->GetY();
		$hCell = $y2 - $y1;
		$this->SetXY($x1, $y1);
		$this->MultiCell($w1,$hCell,"1",1,"C");

		$this->SetXY($x1+$w1+$w2, $y1);
		$this->MultiCell(18, $hCell,"3",1,"C");
		$this->SetXY($x1+$w1+$w2, $y1);
		$this->cell(18,6,'',0,0,'C',0); 
		$this->MultiCell(38, $hCell,"4",1,"C");
		$this->SetXY($x1+$w1+$w2, $y1);
		$this->cell(56,6,'',0,0,'C',0); 
		$this->MultiCell(22, $hCell,"5",1,"C");
		$this->SetXY($x1+$w1+$w2, $y1);
		$this->cell(78,6,'',0,0,'C',0); 
		$this->MultiCell(22, $hCell,"6",1,"C");
	}
	
	function Content_f1($rka,$get_rka,$rincian,$sub) {
		$this->Ln(5);
		$this->setFont('Arial','B',7);
		$this->setFillColor(255,255,255);		
		$angka = $key->harga; $desimal ="2"; $koma =","; $titik =".";
		$angka1 = $key->total; $desimal1 ="2"; $koma1 =","; $titik1 =".";
			$this->setFillColor(255,255,255);
			$w1 = 20;
			$w2 = 75;
			$y1 = $this->GetY();
			$x1 = $this->GetX();
			$this->SetXY($x1+$w1, $this->GetY());
			$this->setFont('Arial','B',6);
			$this->MultiCell($w2, 5, "$get_rka->nama_akun", 0, "L");

			$y2 = $this->GetY();
			$hCell = $y2 - $y1;
			$this->SetXY($x1, $y1);
			$this->setFont('Arial','',5);
			$this->MultiCell($w1,$hCell,"$get_rka->id_akun",1,"L");

			$this->SetXY($x1+$w1+$w2, $y1);
			$this->MultiCell(18, $hCell,"$key->volume",1,"C");
			$this->SetXY($x1+$w1+$w2, $y1);
			$this->cell(18,6,'',0,0,'C',0); 
			$this->MultiCell(38, $hCell,"$key->satuan",1,"C");
			$this->SetXY($x1+$w1+$w2, $y1);
			$this->cell(56,6,'',0,0,'C',0); 
			$this->MultiCell(22, $hCell,"".number_format($angka, $desimal, $koma, $titik),1,"R");
			$this->SetXY($x1+$w1+$w2, $y1);
			$this->cell(78,6,'',0,0,'C',0); 
			$this->MultiCell(22, $hCell,"".number_format($angka1, $desimal, $koma, $titik),1,"R");

			
		$this->Ln(5);
		$this->setFont('Arial','B',7);
		$this->setFillColor(255,255,255);		
		$angka = $key->harga; $desimal ="2"; $koma =","; $titik =".";
		$angka1 = $key->total; $desimal1 ="2"; $koma1 =","; $titik1 =".";
			$this->setFillColor(255,255,255);
			$w1 = 20;
			$w2 = 75;
			$ya = 46;
			$rw = 6;
			$y1 = $this->GetY();
			$x1 = $this->GetX();
			$this->SetXY($x1+$w1, $this->GetY());
			$this->setFont('Arial','B',6);
			$this->MultiCell($w2, 5, "$get_rka->nama_kelompok", 0, "L");

			$y2 = $this->GetY();
			$hCell = $y2 - $y1;
			$this->SetXY($x1, $y1);
			$this->setFont('Arial','',5);
			$this->MultiCell($w1,$hCell,"$get_rka->id_akun . $get_rka->id_kelompok",1,"L");

			$this->SetXY($x1+$w1+$w2, $y1);
			$this->MultiCell(18, $hCell,"$key->volume",1,"C");
			$this->SetXY($x1+$w1+$w2, $y1);
			$this->cell(18,6,'',0,0,'C',0); 
			$this->MultiCell(38, $hCell,"$key->satuan",1,"C");
			$this->SetXY($x1+$w1+$w2, $y1);
			$this->cell(56,6,'',0,0,'C',0); 
			$this->MultiCell(22, $hCell,"".number_format($angka, $desimal, $koma, $titik),1,"R");
			$this->SetXY($x1+$w1+$w2, $y1);
			$this->cell(78,6,'',0,0,'C',0); 
			$this->MultiCell(22, $hCell,"".number_format($angka1, $desimal, $koma, $titik),1,"R");
			
		$this->Ln(5);
		$this->setFont('Arial','B',7);
		$this->setFillColor(255,255,255);		
		foreach ($rka as $key) {
		$angka = $key->harga; $desimal ="2"; $koma =","; $titik =".";
		$angka1 = $key->total; $desimal1 ="2"; $koma1 =","; $titik1 =".";
			$this->setFillColor(255,255,255);
			$w1 = 20;
			$w2 = 75;
			$ya = 46;
			$rw = 6;
			$y1 = $this->GetY();
			$x1 = $this->GetX();
			$this->SetXY($x1+$w1, $this->GetY());
			$this->setFont('Arial','',6);
			$this->MultiCell($w2, 5, "$key->nama_jenis", 0, "L");

			$y2 = $this->GetY();
			$hCell = $y2 - $y1;
			$this->SetXY($x1, $y1);
			$this->setFont('Arial','',5);
			$this->MultiCell($w1,$hCell,"$key->id_akun . $key->id_kelompok . $key->id_jenis",1,"L");

			$this->SetXY($x1+$w1+$w2, $y1);
			$this->MultiCell(18, $hCell,"$key->volume",1,"C");
			$this->SetXY($x1+$w1+$w2, $y1);
			$this->cell(18,6,'',0,0,'C',0); 
			$this->MultiCell(38, $hCell,"$key->satuan",1,"C");
			$this->SetXY($x1+$w1+$w2, $y1);
			$this->cell(56,6,'',0,0,'C',0); 
			$this->MultiCell(22, $hCell,"".number_format($angka, $desimal, $koma, $titik),1,"R");
			$this->SetXY($x1+$w1+$w2, $y1);
			$this->cell(78,6,'',0,0,'C',0); 
			$this->MultiCell(22, $hCell,"".number_format($angka1, $desimal, $koma, $titik),1,"R");
			$ya = $ya + $rw; }
		
		$this->Ln(5);
		$this->setFont('Arial','B',7);
		$this->setFillColor(255,255,255);		
		foreach ($rka as $key) {
		$angka = $key->harga; $desimal ="2"; $koma =","; $titik =".";
		$angka1 = $key->total; $desimal1 ="2"; $koma1 =","; $titik1 =".";
			$this->setFillColor(255,255,255);
			$w1 = 20;
			$w2 = 75;
			$ya = 46;
			$rw = 6;
			$y1 = $this->GetY();
			$x1 = $this->GetX();
			$this->SetXY($x1+$w1, $this->GetY());
			$this->setFont('Arial','',6);
			$this->MultiCell($w2, 5, "$key->nama_obyek", 0, "L");

			$y2 = $this->GetY();
			$hCell = $y2 - $y1;
			$this->SetXY($x1, $y1);
			$this->setFont('Arial','',5);
			$this->MultiCell($w1,$hCell,"$key->id_akun . $key->id_kelompok . $key->id_jenis . $key->id_obyek",1,"L");

			$this->SetXY($x1+$w1+$w2, $y1);
			$this->MultiCell(18, $hCell,"$key->volume",1,"C");
			$this->SetXY($x1+$w1+$w2, $y1);
			$this->cell(18,6,'',0,0,'C',0); 
			$this->MultiCell(38, $hCell,"$key->satuan",1,"C");
			$this->SetXY($x1+$w1+$w2, $y1);
			$this->cell(56,6,'',0,0,'C',0); 
			$this->MultiCell(22, $hCell,"".number_format($angka, $desimal, $koma, $titik),1,"R");
			$this->SetXY($x1+$w1+$w2, $y1);
			$this->cell(78,6,'',0,0,'C',0); 
			$this->MultiCell(22, $hCell,"".number_format($angka1, $desimal, $koma, $titik),1,"R");
			$ya = $ya + $rw; }
		
		$this->Ln(5);
		$this->setFont('Arial','B',7);
		$this->setFillColor(255,255,255);		
		foreach ($rka as $key) {
		$angka = $key->harga; $desimal ="2"; $koma =","; $titik =".";
		$angka1 = $key->total; $desimal1 ="2"; $koma1 =","; $titik1 =".";
			$this->setFillColor(255,255,255);
			$w1 = 20;
			$w2 = 75;
			$ya = 46;
			$rw = 6;
			$y1 = $this->GetY();
			$x1 = $this->GetX();
			$this->SetXY($x1+$w1, $this->GetY());
			$this->setFont('Arial','',6);
			$this->MultiCell($w2, 5, "$key->nama_rincian", 0, "L");

			$y2 = $this->GetY();
			$hCell = $y2 - $y1;
			$this->SetXY($x1, $y1);
			$this->setFont('Arial','',5);
			$this->MultiCell($w1,$hCell,"$key->id_akun . $key->id_kelompok . $key->id_jenis . $key->id_obyek . $key->id_rincian",1,"L");

			$this->SetXY($x1+$w1+$w2, $y1);
			$this->MultiCell(18, $hCell,"$key->volume",1,"C");
			$this->SetXY($x1+$w1+$w2, $y1);
			$this->cell(18,6,'',0,0,'C',0); 
			$this->MultiCell(38, $hCell,"$key->satuan",1,"C");
			$this->SetXY($x1+$w1+$w2, $y1);
			$this->cell(56,6,'',0,0,'C',0); 
			$this->MultiCell(22, $hCell,"".number_format($angka, $desimal, $koma, $titik),1,"R");
			$this->SetXY($x1+$w1+$w2, $y1);
			$this->cell(78,6,'',0,0,'C',0); 
			$this->MultiCell(22, $hCell,"".number_format($angka1, $desimal, $koma, $titik),1,"R");
			$ya = $ya + $rw; }
			
		$this->Ln(5);
		$this->setFont('Arial','B',7);
		$this->setFillColor(255,255,255);
		foreach ($rincian as $key) {
		$angka = $key->harga; $desimal ="2"; $koma =","; $titik =".";
		$angka1 = $key->total; $desimal1 ="2"; $koma1 =","; $titik1 =".";
			$this->setFillColor(255,255,255);
			$w1 = 20;
			$w2 = 75;
			$ya = 46;
			$rw = 6;
			$y1 = $this->GetY();
			$x1 = $this->GetX();
			$this->SetXY($x1+$w1, $this->GetY());
			$this->setFont('Arial','',6);
			$this->MultiCell($w2, 5, "$key->uraian", 0, "L");

			$y2 = $this->GetY();
			$hCell = $y2 - $y1;
			$this->SetXY($x1, $y1);
			$this->setFont('Arial','',5);
			$this->MultiCell($w1,$hCell,"123",1,"L");

			$this->SetXY($x1+$w1+$w2, $y1);
			$this->MultiCell(18, $hCell,"$key->volume",1,"C");
			$this->SetXY($x1+$w1+$w2, $y1);
			$this->cell(18,6,'',0,0,'C',0); 
			$this->MultiCell(38, $hCell,"$key->satuan",1,"C");
			$this->SetXY($x1+$w1+$w2, $y1);
			$this->cell(56,6,'',0,0,'C',0); 
			$this->MultiCell(22, $hCell,"".number_format($angka, $desimal, $koma, $titik),1,"R");
			$this->SetXY($x1+$w1+$w2, $y1);
			$this->cell(78,6,'',0,0,'C',0); 
			$this->MultiCell(22, $hCell,"".number_format($angka1, $desimal, $koma, $titik),1,"R");
			$ya = $ya + $rw; }
		
		$this->Ln(5);
		$this->setFont('Arial','B',7);
		$this->setFillColor(255,255,255);		
		foreach ($sub as $key) {
		$angka = $key->harga; $desimal ="2"; $koma =","; $titik =".";
		$angka1 = $key->total; $desimal1 ="2"; $koma1 =","; $titik1 =".";
			$this->setFillColor(255,255,255);
			$w1 = 20;
			$w2 = 75;
			$ya = 46;
			$rw = 6;
			$y1 = $this->GetY();
			$x1 = $this->GetX();
			$this->SetXY($x1+$w1, $this->GetY());
			$this->setFont('Arial','',6);
			$this->MultiCell($w2, 5, "   - $key->uraian", 0, "L");

			$y2 = $this->GetY();
			$hCell = $y2 - $y1;
			$this->SetXY($x1, $y1);
			$this->setFont('Arial','',5);
			$this->MultiCell($w1,$hCell,"123",1,"L");

			$this->SetXY($x1+$w1+$w2, $y1);
			$this->MultiCell(18, $hCell,"$key->volume",1,"C");
			$this->SetXY($x1+$w1+$w2, $y1);
			$this->cell(18,6,'',0,0,'C',0); 
			$this->MultiCell(38, $hCell,"$key->satuan",1,"C");
			$this->SetXY($x1+$w1+$w2, $y1);
			$this->cell(56,6,'',0,0,'C',0); 
			$this->MultiCell(22, $hCell,"".number_format($angka, $desimal, $koma, $titik),1,"R");
			$this->SetXY($x1+$w1+$w2, $y1);
			$this->cell(78,6,'',0,0,'C',0); 
			$this->MultiCell(22, $hCell,"".number_format($angka1, $desimal, $koma, $titik),1,"R");
			$ya = $ya + $rw; }
	
	}
	
	function Footer() {
		$this->SetY(-20);
		$this->SetFont('Arial','I',5);		
		$this->Cell(33,14,iconv("UTF-8","TIS-620","Tim Verifikasi"),1,0,'C');
		$this->Cell(18,14,iconv("UTF-8","TIS-620","BAPPEDA"),1,0,'C');
		$this->Cell(18,14,iconv("UTF-8","TIS-620","Pembangunan"),1,0,'C');
		$this->Cell(18,14,iconv("UTF-8","TIS-620","BPKAD"),1,0,'C');
		$this->Cell(18,14,iconv("UTF-8","TIS-620","Perlengkapan"),1,0,'C');
		$this->Cell(18,14,iconv("UTF-8","TIS-620","Organisasi"),1,0,'C');
		$this->Cell(18,14,iconv("UTF-8","TIS-620","Koordinator"),1,0,'C');
		$this->Cell(18,14,iconv("UTF-8","TIS-620","BAPPEDA"),1,0,'C');
		$this->Cell(18,14,iconv("UTF-8","TIS-620","BPKAD"),1,0,'C');
		$this->Cell(18,14,iconv("UTF-8","TIS-620",'Halaman '.$this->PageNo().' dari {nb}'),1,0,'C');
	}
}

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->Content_h($rka, $rincian);
$pdf->Content();
$pdf->Content_f1($rka,$get_rka,$rincian,$sub);
$pdf->Output();