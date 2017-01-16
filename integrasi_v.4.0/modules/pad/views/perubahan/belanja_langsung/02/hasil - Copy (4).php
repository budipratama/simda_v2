<?php
$pdf = new FPDF("L","cm","A4");
$pdf->SetMargins(1,1,1);
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','B',10);
$pdf->Cell(5,0.7,"Di cetak pada : ".date("d M Y"),0,0,'C');
$pdf->Ln();

$pdf->SetFont('Arial','B',10);
$pdf->Cell(2.3, 0.8, '1', 1, 0, 'C');
$pdf->Cell(13.7, 0.8, '2', 1, 0, 'C');
$pdf->Cell(2, 0.8, '3', 1, 0, 'C');
$pdf->Cell(4, 0.8, '4', 1, 0, 'C');
$pdf->Cell(3, 0.8, '5', 1, 0, 'C');
$pdf->Cell(3, 0.8, '6', 1, 1, 'C');

$query_jumlah = mysql_query("SELECT SUM(total) 
	FROM rka_sub 
	WHERE rka_sub.tipe_kode= '1' 
	AND rka_sub.anggaran_kode='".$laporan_anggaran."' 
	ORDER BY rka_sub.kode ASC"); 
	$data = mysql_fetch_array($query_jumlah); $jumlah = $data[0];

	$pdf->SetFont('Arial','B',7);
	$pdf->Cell(2.3, 0.8, "5", 1, 0, 'L');
	$pdf->Cell(13.7, 0.8, "BELANJA", 1, 0, 'L');
	$pdf->Cell(12, 0.8, rupiah1($jumlah), 1, 0, 'R');
	$pdf->Ln();
	
	$pdf->SetFont('Arial','B',7);
	$pdf->Cell(2.3, 0.8, "5 . 2", 1, 0, 'L');
	$pdf->Cell(13.7, 0.8, "BELANJA LANGSUNG", 1, 0, 'L');
	$pdf->Cell(12, 0.8, rupiah1($jumlah), 1, 0, 'R');
	$pdf->Ln();	
	
	for ($i=1; $i < 4; $i++){
	$jenis_belanja 	= array('1'=>'63 Belanja Pegawai', '2'=>'64 Belanja Barang dan Jasa', '3'=>'65 Belanja Modal');
	$query_belanja = mysql_query("SELECT SUM(rka_sub.total) as totalRKA 
	FROM rka_sub 
	INNER JOIN rka ON rka_sub.rka=rka.kode
	WHERE rka_sub.tipe_kode= '1' 
	AND rka.jenis='".$jenis_belanja[$i]."' 
	AND rka.tahun='".$laporan_tahun."' 
	AND rka_sub.anggaran_kode='".$laporan_anggaran."' 
	");
	while($row_belanja=mysql_fetch_array($query_belanja)){
	$pdf->Cell(2.3, 0.8, "5 . 2 . $i", 1, 0, 'L');
	$pdf->Cell(13.7, 0.8, $jenis_belanja[$i], 1, 0, 'L');
	$pdf->Cell(12, 0.8, rupiah1($row_belanja['totalRKA']), 1, 0, 'R');
	$pdf->Ln();

		$pdf->SetFont('Arial','',7);	
		$query_id = mysql_query("SELECT rka.kode as id_rka, obyek.nomor as no_obyek, obyek.obyek_nama as nama_obyek
		FROM rka 
		INNER JOIN obyek ON rka.obyek=obyek.kode
		WHERE rka.tipe_kode= '1' 
		AND rka.jenis='".$jenis_belanja[$i]."'
		AND rka.tahun='".$laporan_tahun."' 
		AND rka.anggaran_kode='".$laporan_anggaran."' 
		AND rka.kode GROUP BY rka.kode ORDER BY rka.kode ASC");		
		while($row_id=mysql_fetch_array($query_id)){
		$id = $row_id['no_obyek'];
		$pdf->Cell(2.3, 0.8, "5 . 2 . $i . $id", 1, 0, 'L');
		$pdf->Cell(13.7, 0.8, $row_id['nama_obyek'],1, 0, 'L');
		$pdf->Cell(12, 0.8, "", 1, 1,'R');
		
			$pdf->SetFont('Arial','I',7);
			$query_jumlah = mysql_query("SELECT SUM(rka_sub.total) as totalRKA 
			FROM rka_sub 
			WHERE rka_sub.tipe_kode= '1' 
			AND rka_sub.anggaran_kode='".$laporan_anggaran."' 
			AND rka_sub.rka='".$row_id['id_rka']."' ");
			$query_rka = mysql_query("SELECT rincian.nomor as no_rincian, rincian.rincian_nama as nama_rincian
			FROM rka 
			INNER JOIN rincian ON rka.rincian=rincian.kode
			WHERE rka.tipe_kode= '1' 
			AND rka.jenis='".$jenis_belanja[$i]."' 
			AND rka.tahun='".$laporan_tahun."' 
			AND rka.anggaran_kode='".$laporan_anggaran."' 
			AND rka.kode='".$row_id['id_rka']."'
			AND rka.kode GROUP BY rka.kode ORDER BY rka.kode ASC");	
			while($row_jumlah=mysql_fetch_array($query_jumlah)){			
			while($row_rka=mysql_fetch_array($query_rka)){
			$rka = $row_rka['no_rincian'];
			$pdf->Cell(2.3, 0.8, "5 . 2 . $i . $id . $rka", 1, 0, 'L');
			$pdf->Cell(13.7, 0.8, $row_rka['nama_rincian'],1, 0, 'L');
			$pdf->Cell(12, 0.8, rupiah1($row_jumlah['totalRKA']), 1, 1,'R');
			}		
				$pdf->SetFont('Arial','',7);
				$query_rincian = mysql_query("SELECT rka_rincian.kode as id_rincian, rka_rincian.uraian
				FROM rka_rincian 
				INNER JOIN rka ON rka_rincian.rka=rka.kode
				WHERE rka_rincian.tipe_kode= '1'
				AND rka_rincian.anggaran_kode='".$laporan_anggaran."' 
				AND rka_rincian.kode='".$row_id['id_rka']."'
				AND rka_rincian.kode GROUP BY rka_rincian.kode ORDER BY rka_rincian.kode ASC");			
				while($row_rincian=mysql_fetch_array($query_rincian)){
				$rincian = $row_rincian['uraian'];
				$pdf->Cell(2.3, 0.8, "", 1, 0, 'L');
				$pdf->Cell(13.7, 0.8, "   $rincian",1, 0, 'L');
				$pdf->Cell(12, 0.8, rupiah1($row_jumlah['totalRKA']), 1, 1,'R');
				
					$pdf->SetFont('Arial','',7);
					$query_sub = mysql_query("SELECT rka_sub.uraian, rka_sub.volume, rka_sub.harga, rka_sub.satuan, rka_sub.total
					FROM rka_sub 
					INNER JOIN rka_rincian ON rka_sub.rka_rincian=rka_rincian.kode
					WHERE rka_sub.tipe_kode= '1'
					AND rka_sub.anggaran_kode='".$laporan_anggaran."' 
					AND rka_rincian.kode='".$row_id['id_rka']."'
					AND rka_sub.rka_rincian='".$row_rincian['id_rincian']."'
					AND rka_sub.kode GROUP BY rka_sub.kode ORDER BY rka_sub.kode ASC");	
					while($row_sub=mysql_fetch_array($query_sub)){
					$sub = $row_sub['uraian']; 
					$pdf->Cell(2.3, 0.8, "", 1, 0, 'L');
					$pdf->Cell(13.7, 0.8, "   - $sub",1, 0, 'L');
					$pdf->Cell(2, 0.8, $row_sub['volume'],1, 0, 'C');
					$pdf->Cell(4, 0.8, $row_sub['satuan'],1, 0, 'C');
					$pdf->Cell(3, 0.8, rupiah1($row_sub['harga']),1, 0, 'R');
					$pdf->Cell(3, 0.8, rupiah1($row_sub['total']), 1, 1,'R');			
		} } } }
	} }

$pdf->Output();
?>