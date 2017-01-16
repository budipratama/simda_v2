<?php
$strhtml .= "<table style='font-family: serif; border:1px solid #000;'>
<tr>
   <td style='text-align:center; font-size:9pt; font-weight:bold; border:1px solid #000; width:150px' rowspan='2'><img src='public/dist/img/logo.jpg' alt='logo' width='70' height='70' border='0'/></td>
   <td style='text-align:center; font-size:9pt; font-weight:bold; border:1px solid #000; width:150px'colspan='3'>RENCANA KERJA DAN ANGGARAN<br>SATUAN KERJA PERANGKAT DAERAH</td>
   <td style='text-align:center; font-size:9pt; font-weight:bold; border:1px solid #000; width:150px' rowspan='2'>Formulir<br>RKA SKPD<br>2.2</td>
</tr>
<tr>
   <td style='text-align:center; font-size:7pt; font-weight:bold; border:1px solid #000;'colspan='3'>PEMERINTAH KABUPATEN BEKASI<br>TAHUN ANGGARAN : $laporan_tahun</td>
</tr>
</table>";

		$query_jumlah = mysql_query("SELECT skpd.skpd_nomor as no_skpd, skpd.skpd_nama as id_skpd, skpd.urusan as id_urusan, skpd.skpd_alamat as alamat_skpd, skpd.skpd_status as status_skpd, urusan.urusan as nama_urusan, urusan.jenis as jenis_urusan, SUM(rka_sub.total) as total FROM rka_sub INNER JOIN rka ON rka_sub.rka=rka.kode INNER JOIN skpd ON rka.skpd=skpd.skpd_kode INNER JOIN urusan ON rka.urusan=urusan.kode WHERE rka.tahun='".$laporan_tahun."' AND rka.tipe_kode='".$laporan_belanja."' AND rka.skpd='".$laporan_skpd."' ORDER BY rka_sub.kode ASC"); 
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
					<th style='text-align:center; font-size:10pt; border:1px solid #000; width:150px'>KODE</th>
					<th style='text-align:center; font-size:10pt; border:1px solid #000; width:400px'>URAIAN</th>
					<th style='text-align:center; font-size:10pt; border:1px solid #000; width:100px'>LOKASI KEGIATAN</th>
					<th style='text-align:center; font-size:6pt; border:1px solid #000; width:100px'>TARGET KINERJA<br>(KUANTATITATIF)</th>
					<th style='text-align:center; font-size:10pt; border:1px solid #000; width:100px'>Belanja Pegawai</th>
					<th style='text-align:center; font-size:8pt; border:1px solid #000; width:100px'>Belanja<br>Barang & Jasa</th>
					<th style='text-align:center; font-size:10pt; border:1px solid #000; width:100px'>Belanja Modal</th>
					<th style='text-align:center; font-size:10pt; border:1px solid #000; width:100px'>Jumlah</th>
					<th style='text-align:center; font-size:10pt; border:1px solid #000; width:100px'>Tahun<br>n + 1</th>
				</tr>
				</table>";

if ($jumlah_data > 0){
	
	$tahapan_kode = '16';
	$jenis_urusan = array('1'=>'wajib', '2'=>'pilihan');
	$jenis_belanja 	= array('1'=>'63', '2'=>'64', '3'=>'65');

	for ($i=1; $i < 4; $i++){
		
		$where_jenis['anggaran.tahapan_kode'] 	= $tahapan_kode;
		$where_jenis['rka.tahun'] 				= $laporan_tahun;
		if ($laporan_skpd != 'semua'){ $where_jenis['skpd.skpd_kode'] = $laporan_skpd; }
		$where_jenis ['rka.tipe_kode']			= $laporan_belanja;
		$where_jenis['urusan.jenis'] 			= $jenis_urusan[$i];

		//Cek Jumlah data pada Jenis Urusan
		if ($this->Rka_model->count_bl($where_jenis) > 0){
		
			foreach ($this->Rka_model->grid_all('1', 'urusan.kode as urusan_kode, urusan.nomor as urusan_nomor, urusan.urusan as urusan_nama', 'urusan.nomor', 'ASC', '', '', $where_jenis, '', 'anggaran_bl.urusan_kode') as $row){
				$where_urusan['anggaran.tahapan_kode'] 	= $tahapan_kode;
				$where_urusan['rka.tahun'] 				= $laporan_tahun;
				if ($laporan_skpd != 'semua'){ $where_urusan['skpd.skpd_kode'] 	= $laporan_skpd; }
				$where_urusan ['rka.tipe_kode']			= $laporan_belanja;
				$where_urusan['urusan.kode'] 			= $row->urusan_kode;
				
				foreach ($this->Rka_model->grid_all('1', 'skpd.skpd_kode, skpd.skpd_nomor, skpd.skpd_nama as skpd_nama, rka_rincian.kode as kode_rincian', 'skpd.skpd_kode', 'ASC', '', '', $where_urusan, '', 'skpd.skpd_kode') as $subrow){
				$skpd = strtoupper($subrow->skpd_nama);
				$strhtml .= "<table style='font-family: serif; border:1px solid #000;'>
					<tr>
						<th style='text-align:left; font-size:10pt; border:1px solid #000; width:150px'>$i.$row->urusan_nomor.$subrow->skpd_nomor</th>
						<th style='text-align:left; font-size:10pt; border:1px solid #000; width:400px'>$skpd</th>
						<th style='text-align:right; font-size:10pt; border:1px solid #000; width:700px'></th>
					</tr>
					</table>";
					
					
					
					
					
					
					
					
					
					
					
		
					if ($this->Skpd_model->count_all(array('skpd_kode'=>$subrow->skpd_kode))){
						
						$where_skpd_rutin['anggaran.tahapan_kode'] 	= $tahapan_kode;
						$where_skpd_rutin['rka.tahun'] 				= $laporan_tahun;
					//	$where_skpd_rutin['urusan.kode'] 			= 1;
						$where_skpd_rutin['skpd.skpd_kode'] 		= $subrow->skpd_kode;
						
						
						//Looping Program berdasarkan SKPD -> Urusan Rutin
						foreach ($this->Rka_model->grid_all('1', 'SUM(anggaran_bl.apbd_kab) as subjumlah_apbdkab, SUM(anggaran_bl.apbd_prov) as subjumlah_apbdprov, SUM(anggaran_bl.apbn) as subjumlah_apbn, SUM(anggaran_bl.sumberlain) as subjumlah_lainnya, SUM(anggaran_bl.apbd_kab+anggaran_bl.apbd_prov+anggaran_bl.apbn+anggaran_bl.sumberlain) as subjumlah_total, SUM(anggaran_bl.perkiraan_maju) as subjumlah_maju, program.kode as program_kode, program.nomor as program_nomor, program.program as program_nama', 'program.nomor', 'ASC', '', '', $where_skpd_rutin, '', 'program.kode') as $subsubrow){
							
							$where_program_rutin['anggaran.tahapan_kode'] 	= $tahapan_kode;
							$where_program_rutin['anggaran.tahun'] 			= $laporan_tahun;
							$where_program_rutin['skpd.skpd_kode'] 			= $subrow->skpd_kode;
							$where_program_rutin['program.kode'] 			= $subsubrow->program_kode;
					//		$where_program_rutin['rka_rincian.kode']	= $rincianrow->kode_rincian;
							
							//Cek Jumlah data pada Program
							if ($this->Rka_model->count_bl($where_program_rutin) > 0){
								
								//Penjumlahan total Biaya
								$total_apbd		= $total_apbd + $subsubrow->subjumlah_apbdkab;
								$total_apbdp	= $total_apbdp + $subsubrow->subjumlah_apbdprov;
								$total_apbn 	= $total_apbn + $subsubrow->subjumlah_apbn;
								$total_lain 	= $total_lain + $subsubrow->subjumlah_lainnya;
								$grand_total 	= $grand_total + $subsubrow->subjumlah_total;
								$total_maju 	= $total_maju + $subsubrow->subjumlah_maju;
								
								$total = rupiah1($total_apbd);
		
								$strhtml .= "<table style='font-family: serif; border:1px solid #000;'>
									<tr>
										<th style='text-align:left; font-size:10pt; border:1px solid #000; width:150px'>$i.$row->urusan_nomor.$subrow->skpd_nomor.$subsubrow->program_nomor</th>
										<th style='text-align:left; font-size:10pt; border:1px solid #000; width:400px'>$subsubrow->program_nama</th>
										<th style='text-align:right; font-size:10pt; border:1px solid #000; width:700px'>$total</th>
									</tr>
									</table>";
		
		
		
		
					} 
					
						foreach ($this->Rka_model->grid_all('1', 'anggaran.kegiatan, anggaran.alamat, anggaran_bl.kh_target as kht_anggaran, anggaran_bl.kh_satuan as khs_anggaran, (rka_sub.total) as total_pegawai', 'anggaran.kegiatan', 'ASC', '', '', $where_program_rutin, '', 'rka.anggaran_kode') as $kegiatanrow){
							if ($kegiatan_nomor < 10) {
								$kegiatan_nomor = "0".$kegiatan_nomor;
							} else {
								$kegiatan_nomor = $kegiatan_nomor;
							}
							
							
							

							
							
								$strhtml .= "<table style='font-family: serif; border:1px solid #000;'>
									<tr>
										<th style='text-align:left; font-size:10pt; font-weight:0; border:1px solid #000; width:150px'>$i.$row->urusan_nomor.$subrow->skpd_nomor.$subsubrow->program_nomor.$kegiatan_nomor</th>
										<th style='text-align:left; font-size:10pt; font-weight:0; border:1px solid #000; width:400px'>$kegiatanrow->kegiatan</th>
										<th style='text-align:center; font-size:10pt; font-weight:0; border:1px solid #000; width:100px'>$kegiatanrow->alamat</th>
										<th style='text-align:center; font-size:10pt; font-weight:0; border:1px solid #000; width:100px'>$kegiatanrow->kht_anggaran $kegiatanrow->khs_anggaran</th>
										<th style='text-align:right; font-size:10pt; font-weight:0; border:1px solid #000; width:100px'>$kegiatanrow->total_pegawai</th>
										<th style='text-align:right; font-size:10pt; font-weight:0; border:1px solid #000; width:100px'>$kegiatanrow->alamat</th>
										<th style='text-align:right; font-size:10pt; font-weight:0; border:1px solid #000; width:100px'>$kegiatanrow->alamat</th>
										<th style='text-align:right; font-size:10pt; font-weight:0; border:1px solid #000; width:100px'>$kegiatanrow->alamat</th>
										<th style='text-align:right; font-size:10pt; font-weight:0; border:1px solid #000; width:100px'>$kegiatanrow->alamat</th>
									</tr>
									</table>";

							



									
									
									
									
									
									
									
									
									
									
									
								$kegiatan_nomor++;
						} } }
					
					
					
					
					
					
									
					
					
		
		} } } 
	}

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