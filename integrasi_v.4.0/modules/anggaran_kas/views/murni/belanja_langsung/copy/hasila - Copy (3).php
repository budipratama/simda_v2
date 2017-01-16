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
		$this->MultiCell($w2, 5, "                                               PEMERINTAH KABUPATEN BEKASI                                                ANGGARAN KAS", 0, "C");
		$this->SetXY($x1+$w1, $this->GetY());
		$this->MultiCell($w2, 10, "Tahun Anggaran : $laporan_tahun", 0, "C");
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
	foreach($data_get as $row_get) { }
		$pdf->setFont('Arial','B',7);
		$pdf->cell(30,6,'Urusan Pemerintahan',0,0,'L',1);
		$pdf->setFont('Arial','',7);
		$pdf->cell(40,6,"1.$row_get->id_urusan",0,0,'L',1);
		$pdf->MultiCell(125,6,"$row_get->jenis_urusan $row_get->nama_urusan",0,1,'L',1);
		$pdf->setFont('Arial','B',7);
		$pdf->cell(30,6,'Bidang Pemerintahan',0,0,'L',1);
		$pdf->setFont('Arial','',7);
		$pdf->cell(40,6,"1.$row_get->id_urusan . 1.$row_get->id_urusan.$row_get->no_skpd",0,0,'L',1);
		$pdf->MultiCell(125,6,"$row_get->id_skpd",0,1,'L',1);
		$pdf->setFont('Arial','B',7);
		$pdf->cell(30,6,'Unit Organisasi',0,0,'L',1);
		$pdf->setFont('Arial','',7);
		$pdf->cell(40,6,"1.$row_get->id_urusan . 1.$row_get->id_urusan.$row_get->no_skpd . $row_get->no_program",0,0,'L',1);
		$pdf->MultiCell(125,6,"$row_get->id_program",0,1,'L',1);
		$pdf->setFont('Arial','B',7);
		$pdf->cell(30,6,'Sub Unit Organisasi',0,0,'L',1);
		$pdf->setFont('Arial','',7);
		$pdf->cell(40,6,"1.$row_get->id_urusan . 1.$row_get->id_urusan.$row_get->no_skpd . $row_get->no_program",0,0,'L',1);
		$pdf->MultiCell(125,6,"2.$row_get->id_program",0,1,'L',1);
			
		$h = 5;
		$left = 40;
		$pdf->SetFillColor(200,200,200);
		$pdf->setFont('Arial','B',6);
		$left = $pdf->GetX();
		$pdf->Cell(20,$h,'KD. REKENING',1,0,'C',true);
		$pdf->SetX($left += 20); $pdf->Cell(85, $h, 'URUSAN', 1, 0, 'C',true);
		$pdf->SetX($left += 85); $pdf->Cell(18, $h, 'ANGGARAN', 1, 0, 'C',true);
		$pdf->SetX($left += 18); $pdf->Cell(18, $h, 'TRIWULAN I', 1, 0, 'C',true);
		$pdf->SetX($left += 18); $pdf->Cell(18, $h, 'TRIWULAN II', 1, 0, 'C',true);
		$pdf->SetX($left += 18); $pdf->Cell(18, $h, 'TRIWULAN III', 1, 0, 'C',true);	
		$pdf->SetX($left += 18); $pdf->Cell(18, $h, 'TRIWULAN IV', 1, 1, 'C',true);	
	
$total_anggaran	= 0;
$total_1 		= 0;
$total_2 		= 0;
$total_3 		= 0;
$total_4 		= 0;
if ($jumlah_data > 0){
	
	$jenis_urusan = array('1'=>'wajib', '2'=>'pilihan');
	$tahapan_kode = '11';
	//Looping jenis urusan
	for ($i=1; $i <= 2; $i++){

		$where_jenis['anggaran.tahapan_kode'] = $tahapan_kode;
		$where_jenis['anggaran.tahun'] 	= $laporan_tahun;
		if ($laporan_kecamatan != 'semua'){ $where_jenis['anggaran.kecamatan_kode']	= $laporan_kecamatan; }
		if ($laporan_deskel != 'semua'){ $where_jenis['anggaran.deskel_kode']	= $laporan_deskel; }
		if ($laporan_skpd != 'semua'){ $where_jenis['skpd.skpd_kode'] 	= $laporan_skpd; }
		$where_jenis['urusan.jenis'] 	= $jenis_urusan[$i];
		
		//Cek Jumlah data pada Jenis Urusan
		if ($this->Anggaran_model->count_bl($where_jenis) > 0){
			
		$h = 5;
		$left = 40;
		$pdf->SetFillColor(255,255,255);
		$pdf->setFont('Arial','B',6);
		$left = $pdf->GetX();
		$pdf->Cell(20,$h,$i,1,0,'C',true);
		$pdf->SetX($left += 20); $pdf->Cell(175, $h, "urusan $jenis_urusan[$i]", 1, 0, 'L',true);

		//Looping Urusan Berdasarkan Jenis
			foreach ($this->Anggaran_model->grid_all('1', 'urusan.kode as urusan_kode, urusan.nomor as urusan_nomor, urusan.urusan as urusan_nama', 'urusan.nomor', 'ASC', '', '', $where_jenis, '', 'anggaran_bl.urusan_kode') as $row){
				$where_urusan['anggaran.tahapan_kode'] 	= $tahapan_kode;
				$where_urusan['anggaran.tahun'] 	= $laporan_tahun;
				if ($laporan_kecamatan != 'semua'){ $where_urusan['anggaran.kecamatan_kode']= $laporan_kecamatan; }
				if ($laporan_deskel != 'semua'){ $where_urusan['anggaran.deskel_kode']	= $laporan_deskel; }
				if ($laporan_skpd != 'semua'){ $where_urusan['skpd.skpd_kode'] 	= $laporan_skpd; }
				$where_urusan['urusan.kode'] 		= $row->urusan_kode;
				
				//Cek Jumlah data pada Urusan
				if ($this->Anggaran_model->count_bl($where_urusan) > 0){
				$pdf->Ln();	
				$h = 5;
				$left = 40;
				$pdf->SetFillColor(255,255,255);
				$pdf->setFont('Arial','B',6);
				$left = $pdf->GetX();
				$pdf->Cell(20,$h,$i,1,0,'C',true);
				$pdf->SetX($left += 20); $pdf->Cell(175, $h, "$row->urusan_nama", 1, 0, 'L',true);	
				
					foreach ($this->Anggaran_model->grid_all('1', 'skpd.skpd_kode, skpd.skpd_nomor, skpd.skpd_nama as skpd_nama', 'skpd.skpd_kode', 'ASC', '', '', $where_urusan, '', 'skpd.skpd_kode') as $subrow){
					$pdf->Ln();	
					$h = 5;
					$left = 40;
					$pdf->SetFillColor(255,255,255);
					$pdf->setFont('Arial','B',6);
					$left = $pdf->GetX();
					$pdf->Cell(20,$h,$i,1,0,'C',true);
					$pdf->SetX($left += 20); $pdf->Cell(175, $h, "$subrow->skpd_nama", 1, 0, 'L',true);
					
					$pdf->Ln();
					$h = 5;
					$left = 40;
					$pdf->SetFillColor(255,255,255);
					$pdf->setFont('Arial','B',6);
					$left = $pdf->GetX();
					$pdf->Cell(20,$h,"",1,0,'L',true);
					$pdf->SetX($left += 20); $pdf->Cell(175, $h, "Alokasi Belanja Langsung", 1, 0, 'L',true);
					
					$pdf->Ln();
					$h = 5;
					$left = 40;
					$pdf->SetFillColor(255,255,255);
					$pdf->setFont('Arial','B',6);
					$left = $pdf->GetX();
					$pdf->Cell(20,$h,"5.2",1,0,'L',true);
					$pdf->SetX($left += 20); $pdf->Cell(85, $h, "BELANJA LANGSUNG", 1, 0, 'L',true);
					
					$query_total	= $this->db->query("SELECT SUM(anggaran_kas.anggaran) as hasil_anggaran,
					SUM(anggaran_kas.jan+anggaran_kas.feb+anggaran_kas.mar) as triwulan_1,
					SUM(anggaran_kas.apr+anggaran_kas.mei+anggaran_kas.jun) as triwulan_2,
					SUM(anggaran_kas.jul+anggaran_kas.ags+anggaran_kas.sep) as triwulan_3,
					SUM(anggaran_kas.okt+anggaran_kas.nov+anggaran_kas.des) as triwulan_4
					FROM anggaran_kas 
					WHERE anggaran_kas.tipe_kode= '1'
					AND anggaran_kas.skpd='".$subrow->skpd_kode."'
					");
					$data_hasil 	= $query_total->result();
					if($data_hasil){ foreach($data_hasil as $task){
					$pdf->SetX($left += 85); $pdf->Cell(18, $h, rupiah2($task->hasil_anggaran), 1, 0, 'R',true);
					$pdf->SetX($left += 18); $pdf->Cell(18, $h, rupiah2($task->triwulan_1), 1, 0, 'R',true);
					$pdf->SetX($left += 18); $pdf->Cell(18, $h, rupiah2($task->triwulan_2), 1, 0, 'R',true);
					$pdf->SetX($left += 18); $pdf->Cell(18, $h, rupiah2($task->triwulan_3), 1, 0, 'R',true);
					$pdf->SetX($left += 18); $pdf->Cell(18, $h, rupiah2($task->triwulan_4), 1, 0, 'R',true); }}

					$where_skpd['anggaran.tahapan_kode']	= $tahapan_kode;
					$where_skpd['anggaran.tahun'] 			= $laporan_tahun;
					if ($laporan_kecamatan != 'semua'){ $where_skpd['anggaran.kecamatan_kode']	= $laporan_kecamatan; }
					if ($laporan_deskel != 'semua'){ $where_skpd['anggaran.deskel_kode']		= $laporan_deskel; }
					$where_skpd['urusan.kode']				= $row->urusan_kode;
					$where_skpd['anggaran.skpd_kode'] 		= $subrow->skpd_kode;
					
					foreach ($this->Anggaran_model->grid_all('1', 'SUM(anggaran_bl.apbd_kab) as subjumlah_apbdkab, SUM(anggaran_bl.apbd_prov) as subjumlah_apbdprov, SUM(anggaran_bl.apbn) as subjumlah_apbn, SUM(anggaran_bl.sumberlain) as subjumlah_lainnya, SUM(anggaran_bl.apbd_kab+anggaran_bl.apbd_prov+anggaran_bl.apbn+anggaran_bl.sumberlain) as subjumlah_total, SUM(anggaran_bl.perkiraan_maju) as subjumlah_maju, program.kode as program_kode, program.nomor as program_nomor, program.program as program_nama', 'program.nomor', 'ASC', '', '', $where_skpd, '', 'anggaran_bl.program_kode') as $subsubrow){
						
						$where_program['anggaran.tahapan_kode']	= $tahapan_kode;
						$where_program['anggaran.tahun'] 		= $laporan_tahun;
						if ($laporan_kecamatan != 'semua'){ $where_program['anggaran.kecamatan_kode']= $laporan_kecamatan; }
						if ($laporan_deskel != 'semua'){ $where_program['anggaran.deskel_kode']	= $laporan_deskel; }
						$where_program['urusan.kode'] 			= $row->urusan_kode;
						$where_program['anggaran.skpd_kode'] 	= $subrow->skpd_kode;
						$where_program['program.kode'] 			= $subsubrow->program_kode;
						$kegiatan_nomor							= 1;
						
						if ($this->Anggaran_model->count_bl($where_program) > 0){
							$pdf->Ln();	
							$h = 5;
							$left = 40;
							$pdf->SetFillColor(255,255,255);
							$pdf->setFont('Arial','B',6);
							$left = $pdf->GetX();
							$pdf->Cell(20,$h,"5.2.$subsubrow->program_nomor",1,0,'L',true);
							$pdf->SetX($left += 20); $pdf->Cell(85, $h, "$subsubrow->program_nama", 1, 0, 'L',true);
								
								$query_hasil 	= $this->db->query("SELECT SUM(anggaran_kas.anggaran) as hasil_anggaran,
								SUM(anggaran_kas.jan+anggaran_kas.feb+anggaran_kas.mar) as triwulan_1,
								SUM(anggaran_kas.apr+anggaran_kas.mei+anggaran_kas.jun) as triwulan_2,
								SUM(anggaran_kas.jul+anggaran_kas.ags+anggaran_kas.sep) as triwulan_3,
								SUM(anggaran_kas.okt+anggaran_kas.nov+anggaran_kas.des) as triwulan_4
								FROM anggaran_kas 
								WHERE anggaran_kas.tipe_kode= '1'
								AND anggaran_kas.program='".$subsubrow->program_kode."'
								");
								$data_hasil 	= $query_hasil->result();
								if($data_hasil){ foreach($data_hasil as $task){ 
								$pdf->SetX($left += 85); $pdf->Cell(18, $h, rupiah2($task->hasil_anggaran), 1, 0, 'R',true);								
								$pdf->SetX($left += 18); $pdf->Cell(18, $h, rupiah2($task->triwulan_1), 1, 0, 'R',true);
								$pdf->SetX($left += 18); $pdf->Cell(18, $h, rupiah2($task->triwulan_2), 1, 0, 'R',true);
								$pdf->SetX($left += 18); $pdf->Cell(18, $h, rupiah2($task->triwulan_3), 1, 0, 'R',true);
								$pdf->SetX($left += 18); $pdf->Cell(18, $h, rupiah2($task->triwulan_4), 1, 0, 'R',true);	 } }

							foreach ($this->Anggaran_model->grid_all('1', 'anggaran.kode as id_anggaran, anggaran.kegiatan, anggaran.alamat, anggaran_bl.hp_ukur, anggaran_bl.hp_target, anggaran_bl.hp_satuan, anggaran_bl.kh_ukur, anggaran_bl.kh_target, anggaran_bl.kh_satuan, anggaran_bl.hk_ukur, anggaran_bl.hk_target, anggaran_bl.hk_satuan, anggaran_bl.apbd_kab, anggaran_bl.apbd_prov, anggaran_bl.apbn, anggaran_bl.sumberlain, anggaran_bl.perkiraan_maju, sifat.sifat_nama, deskel.skpd_nama as deskel_nama, kecamatan.skpd_nama as kecamatan_nama, sumber.sumber_nama, (anggaran_bl.apbd_kab+anggaran_bl.apbd_prov+anggaran_bl.apbn+anggaran_bl.sumberlain) as rencana_total, skpd.skpd_nama as skpd_nama, urusan.urusan as urusan_nama, sasaran.sasaran as sasaran_nama, prioritas.prioritas as prioritas_nama, program.program as program_nama, indikator.indikator as indikator_nama', 'anggaran.kegiatan', 'ASC', '', '', $where_program, '', 'anggaran.kode') as $kegiatanrow){
								if ($kegiatan_nomor < 10) {
									$kegiatan_nomor = "0".$kegiatan_nomor;
								} else {
									$kegiatan_nomor = $kegiatan_nomor;
								}							
							
								$where_anggaran['anggaran_kas.anggaran_kode']	= $kegiatanrow->id_anggaran;
								$where_anggaran['anggaran_kas.program']			= $subsubrow->program_kode;
							
								$pdf->Ln();	
								$h = 5;
								$left = 40;
								$pdf->SetFillColor(255,255,255);
								$pdf->setFont('Arial','',6);
								$left = $pdf->GetX();
								$pdf->Cell(20,$h, "5.2.$subsubrow->program_nomor.$kegiatan_nomor" ,1,0,'L',true);
								$pdf->SetX($left += 20); $pdf->Cell(85, $h, "$kegiatanrow->kegiatan", 1, 0, 'L',true);
								
								foreach ($this->Rka_model->grid_ak('1', 'SUM(anggaran_kas.anggaran) as hasil_anggaran,
								SUM(anggaran_kas.jan+anggaran_kas.feb+anggaran_kas.mar) as triwulan_1,
								SUM(anggaran_kas.apr+anggaran_kas.mei+anggaran_kas.jun) as triwulan_2,
								SUM(anggaran_kas.jul+anggaran_kas.ags+anggaran_kas.sep) as triwulan_3,
								SUM(anggaran_kas.okt+anggaran_kas.nov+anggaran_kas.des) as triwulan_4
								', 
								'anggaran_kas.anggaran', 'ASC', '', '', $where_anggaran, '', 'anggaran_kas.kode') as $angaranrow){

									$pdf->SetX($left += 85); $pdf->Cell(18, $h, rupiah2($angaranrow->hasil_anggaran), 1, 0, 'R',true);
									$pdf->SetX($left += 18); $pdf->Cell(18, $h, rupiah2($angaranrow->triwulan_1), 1, 0, 'R',true);
									$pdf->SetX($left += 18); $pdf->Cell(18, $h, rupiah2($angaranrow->triwulan_2), 1, 0, 'R',true);
									$pdf->SetX($left += 18); $pdf->Cell(18, $h, rupiah2($angaranrow->triwulan_3), 1, 0, 'R',true);
									$pdf->SetX($left += 18); $pdf->Cell(18, $h, rupiah2($angaranrow->triwulan_4), 1, 0, 'R',true);
									
									$total_anggaran	= $total_anggaran + $angaranrow->hasil_anggaran;
									$total_1		= $total_1 + $angaranrow->triwulan_1;
									$total_2		= $total_2 + $angaranrow->triwulan_2;
									$total_3		= $total_3 + $angaranrow->triwulan_3;
									$total_4		= $total_4 + $angaranrow->triwulan_4;
									$kegiatan_nomor++;
			} } } }
		} } } }
	} }	
			$pdf->Ln();	
			$h = 5;
			$left = 40;
			$pdf->SetFillColor(255,255,255);
			$pdf->setFont('Arial','B',6);
			$left = $pdf->GetX();
			$pdf->Cell(20,$h, "" ,1,0,'L',true);
			$pdf->SetX($left += 20); $pdf->Cell(85, $h, "Jumlah Alokasi Belanja Langsung", 1, 0, 'L',true);
			$pdf->SetX($left += 85); $pdf->Cell(18, $h, rupiah2($total_anggaran), 1, 0, 'R',true);
			$pdf->SetX($left += 18); $pdf->Cell(18, $h, rupiah2($total_1), 1, 0, 'R',true);
			$pdf->SetX($left += 18); $pdf->Cell(18, $h, rupiah2($total_2), 1, 0, 'R',true);
			$pdf->SetX($left += 18); $pdf->Cell(18, $h, rupiah2($total_3), 1, 0, 'R',true);
			$pdf->SetX($left += 18); $pdf->Cell(18, $h, rupiah2($total_4), 1, 0, 'R',true);
								
								
								
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