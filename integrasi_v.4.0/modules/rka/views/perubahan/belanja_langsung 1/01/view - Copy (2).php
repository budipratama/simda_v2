<?php
class PDF extends FPDF {
	//Page header
	function Header() {
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
		$this->MultiCell($w2, 5, "                                                                     PEMERINTAH KABUPATEN BEKASI                                                                     Tahun Anggaran : 2016", 1, "C");

		$y2 = $this->GetY();
		$hCell = $y2 - $y1;
		$this->SetXY($x1, $y1);
		$this->Cell($w1,$hCell,"",1,"C");

		$this->SetXY($x1+$w1+$w2, $y1);
		$this->MultiCell($w3, 10," Formulir RKA SKPD 2.2.1",1,"C");

		$this->cell(30,6,'Urusan Pemerintahan  :',1,0,'L',1);
		$this->cell(40,6,'1.25',1,0,'L',1);
		$this->MultiCell(125,6,'Instalasi dan Pemeliharaan Sarana dan Prasarana data entry out site',1,1,'L',1);
		$this->cell(30,6,'Urusan Pemerintahan  :',1,0,'L',1);
		$this->cell(40,6,'1.25',1,0,'L',1);
		$this->MultiCell(125,6,'Instalasi dan Pemeliharaan Sarana dan Prasarana data entry out site',1,1,'L',1);
		$this->cell(30,6,'Urusan Pemerintahan  :',1,0,'L',1);
		$this->cell(40,6,'1.25',1,0,'L',1);
		$this->MultiCell(125,6,'Instalasi dan Pemeliharaan Sarana dan Prasarana data entry out site',1,1,'L',1);
		$this->cell(30,6,'Urusan Pemerintahan  :',1,0,'L',1);
		$this->cell(40,6,'1.25',1,0,'L',1);
		$this->MultiCell(125,6,'Instalasi dan Pemeliharaan Sarana dan Prasarana data entry out site',1,1,'L',1);
		
		$this->cell(195,6,'Lokasi Kegiatan       :',1,1,'L',1);
		
		$w1 = 30;
		$w2 = 165;
		$y1 = $this->GetY();
		$x1 = $this->GetX();

		$this->SetXY($x1+$w1, $this->GetY());
		$this->MultiCell($w2, 5, "1.25 . 1.25.01 . 15 . 01 ", 1, "L");
		$this->SetXY($x1+$w1, $this->GetY());
		$this->MultiCell($w2, 5, "1.25 . 1.25.01 . 15 . 01 ", 1, "L");
		$this->SetXY($x1+$w1, $this->GetY());
		$this->MultiCell($w2, 5, "1.25 . 1.25.01 . 15 . 01 ", 1, "L");
		
		$y2 = $this->GetY();
		$hCell = $y2 - $y1;
		$this->SetXY($x1, $y1);
		$this->MultiCell($w1,5,"Jumlah Tahun n - 1  : ",1,"L");
		$this->MultiCell($w1,5,"Jumlah Tahun n - 1  : ",1,"L");
		$this->MultiCell($w1,5,"Jumlah Tahun n - 1  : ",1,"L");

		$this->cell(195,6,'INDIKATOR & TOLOK UKUR KINERJA BELANJA LANGSUNG',1,1,'C',1);

		$this->cell(30,6,'INDIKATOR',1,0,'C',1);
		$this->cell(125,6,'TOLOK UKUR KERJA',1,0,'C',1);
		$this->cell(40,6,'TARGET KINERJA',1,1,'C',1);
		
		$this->cell(30,6,'CAPAIAN PROGRAM',1,0,'L',1);
		$this->cell(125,6,'Meningkatkan Prasarana dan Sarana Komunikasi dan Informatika',1,0,'L',1);
		$this->cell(40,6,'100 %',1,1,'L',1);

		$this->MultiCell(195,4,'                                                                  RINCIAN ANGGARAN BELANJA LANGSUNG MENURUT PROGRAM DAN PER KEGIATAN                                                                                                                                                                                SATUAN KERJA PRANGKAT KERJA',1,1,'C',1);	
 		
		$this->Cell(25,14,iconv("UTF-8","TIS-620","KODE REKENING"),1,0,'C');
		$this->Cell(70,14,iconv("UTF-8","TIS-620","URAIAN"),1,0,'C');
		$this->Cell(70,7,iconv("UTF-8","TIS-620","RINCIAN PERHITUNGAN"),1,0,'C');
		$this->Cell(30,14,iconv("UTF-8","TIS-620","JUMLAH (Rp)"),1,0,'C');

		$this->SetXY(105,108);
		$this->Cell(23,7,iconv("UTF-8","TIS-620","Volume"),1,0,'C');
		$this->Cell(24,7,iconv("UTF-8","TIS-620","Satuan"),1,0,'C');
		$this->Cell(23,7,iconv("UTF-8","TIS-620","Harga Satuan"),1,0,'C');	
		
		$this->Ln();
		$this->setFont('Arial','',7);
		$this->setFillColor(230,230,200);
		$this->cell(10,6,'No.',1,0,'C',1);
		$this->cell(105,6,'Nama Lengkap',1,0,'C',1);
		$this->cell(30,6,'No. HP',1,0,'C',1);
		$this->cell(50,6,'Jenis Kelamin',1,1,'C',1);                
	}
 
	function Content($data) {		
		$this->Ln();
		$this->Cell(25,14,iconv("UTF-8","TIS-620","KODE REKENING"),1,0,'C');
		$this->Cell(70,14,iconv("UTF-8","TIS-620","URAIAN"),1,0,'C');
		$this->Cell(70,7,iconv("UTF-8","TIS-620","RINCIAN PERHITUNGAN"),1,0,'C');
		$this->Cell(30,14,iconv("UTF-8","TIS-620","JUMLAH (Rp)"),1,0,'C');
		
		$this->SetXY(105,200);
		$this->Cell(23,7,iconv("UTF-8","TIS-620","Volume"),1,0,'C');
		$this->Cell(24,7,iconv("UTF-8","TIS-620","Satuan"),1,0,'C');
		$this->Cell(23,7,iconv("UTF-8","TIS-620","Harga Satuan"),1,0,'C');
		
            $ya = 46;
            $rw = 6;
            $no = 1;
                foreach ($data as $key) {
                        $this->setFont('Arial','',10);
                        $this->setFillColor(255,255,255);	
                        $this->cell(10,10,$no,1,0,'L',1);
                        $this->cell(105,10,$key->skpd_nama,1,0,'L',1);
                        $this->cell(30,10,$key->nohp,1,0,'L',1);
                        $this->cell(50,10,$key->kelamin,1,1,'L',1);
                        $ya = $ya + $rw;
                        $no++;
                }
	}
	
	function Footer() {
		//$this->SetY(-24);
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
$pdf->Content($data);
$pdf->Output();