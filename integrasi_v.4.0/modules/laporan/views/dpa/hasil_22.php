<?php
$strhtml .= "<table style='font-family: serif; border:1px solid #000;'>
<tr>
   <td style='text-align:center; font-size:9pt; font-weight:bold; border:1px solid #000; width:150px' rowspan='2'><img src='public/dist/img/logo.jpg' alt='logo' width='70' height='70' border='0'/></td>
   <td style='text-align:center; font-size:9pt; font-weight:bold; border:1px solid #000; width:150px'colspan='3'>RENCANA KERJA DAN ANGGARAN<br>SATUAN KERJA PERANGKAT DAERAH</td>
   <td style='text-align:center; font-size:9pt; font-weight:bold; border:1px solid #000; width:150px' rowspan='2'>Formulir<br>DPA SKPD<br>2.2</td>
</tr>
<tr>
   <td style='text-align:center; font-size:7pt; font-weight:bold; border:1px solid #000;'colspan='3'>PEMERINTAH KABUPATEN BEKASI<br>TAHUN ANGGARAN : $laporan_tahun</td>
</tr>
</table>";

		$query_jumlah = mysql_query("SELECT skpd.skpd_nomor as no_skpd, skpd.skpd_nama as id_skpd, skpd.urusan as id_urusan, skpd.skpd_alamat as alamat_skpd, skpd.skpd_status as status_skpd, urusan.urusan as nama_urusan, urusan.jenis as jenis_urusan
		FROM anggaran_kas
		INNER JOIN rka ON anggaran_kas.rka=rka.kode 
		INNER JOIN skpd ON anggaran_kas.skpd=skpd.skpd_kode 
		INNER JOIN urusan ON rka.urusan=urusan.kode 
		WHERE rka.tahun='".$laporan_tahun."' 
		AND anggaran_kas.tipe_kode='".$laporan_belanja."' 
		AND anggaran_kas.skpd='".$laporan_skpd."' 
		ORDER BY anggaran_kas.kode ASC"); 
		
			$data = mysql_fetch_array($query_jumlah); $id_urusan = $data[id_urusan]; $nama_urusan = $data[nama_urusan]; $jenis_urusan = $data[jenis_urusan]; $jenis_urusan1 = $data[jenis_urusan]; $id_skpd = $data[id_skpd]; $no_skpd = $data[no_skpd]; $lokasi = $data[alamat_skpd]; $status = $data[status_skpd];
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
					<th style='text-align:left; font-size:12pt; width:100px'>Sub Unit Organisasi</th>
					<th style='text-align:left; font-size:12pt; font-weight:0; width:200px'>: 1.$id_urusan . 1.$id_urusan.$no_skpd</th>
					<th style='text-align:left; font-size:12pt; font-weight:0; width:800px'>$id_skpd</th>
				</tr>
				</table>";

			$strhtml .= "<table style='font-family: serif; border:1px solid #000;'>
				<tr>
					<th style='text-align:center; font-size:8pt; width:150px'>REKAPITULASI BELANJA LANGSUNG MENURUT PROGRAM DAN KEGIATAN SATUAN KERJA PERANGKAT DAERAH</th>
				</tr> 
				</table>";
			
			$strhtml .= "<table style='font-family: serif; font-weight:bold; border:1px solid #000;'>
				<tr>
				   <td style='text-align:center; font-size:10pt; border:1px solid #000; width:150px' rowspan='2'>KODE<br>PROGRAM &<br>KEGIATAN</td>
				   <td style='text-align:center; font-size:10pt; border:1px solid #000; width:330px' rowspan='2'>URAIAN</td>
				   <td style='text-align:center; font-size:9pt; border:1px solid #000; width:100px' rowspan='2'>LOKASI<br>KEGIATAN</td>
				   <td style='text-align:center; font-size:9pt; border:1px solid #000; width:100px' rowspan='2'>TARGET<br>KINERJA</td>
				   <td style='text-align:center; font-size:9pt; border:1px solid #000; width:80px' rowspan='2'>SUMBER<br>DANA</td>
				   <td style='text-align:center; border:1px solid #000;'colspan='4'>TRIWULAN</td>
				   <td style='text-align:center; border:1px solid #000; width:150px' rowspan='2'>JUMLAH<br>(Rp)</td>
				</tr>
				<tr>
					<td style='text-align:center; border:1px solid #000; width:150px'>I</td>
					<td style='text-align:center; border:1px solid #000; width:150px'>II</td>
				   <td style='text-align:center; border:1px solid #000; width:150px'>III</td>
				   <td style='text-align:center; border:1px solid #000; width:150px'>IV</td>
				</tr>
			   </table>";

			$strhtml .= "<table style='font-family: font-size:10pt; serif; border:1px solid #000;'>
				<tr>
					<th style='text-align:center; border:1px solid #000; width:150px'>1</th>
					<th style='text-align:center; border:1px solid #000; width:330px'>2</th>
					<th style='text-align:center; border:1px solid #000; width:100px'>3</th>
					<th style='text-align:center; border:1px solid #000; width:100px'>4</th>
					<th style='text-align:center; border:1px solid #000; width:80px'>5</th>
					<th style='text-align:center; border:1px solid #000; width:150px'>6</th>
					<th style='text-align:center; border:1px solid #000; width:150px'>7</th>
					<th style='text-align:center; border:1px solid #000; width:150px'>8</th>
					<th style='text-align:center; border:1px solid #000; width:150px'>9</th>
					<th style='text-align:center; border:1px solid #000; width:150px'>10 =6+7+8+9</th>
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
		if ($this->Anggaran_kas_model->count_bl($where_jenis) > 0){
		
			foreach ($this->Anggaran_kas_model->grid_all('1', 'urusan.kode as urusan_kode, urusan.nomor as urusan_nomor, urusan.urusan as urusan_nama', 'urusan.nomor', 'ASC', '', '', $where_jenis, '', 'anggaran_bl.urusan_kode') as $row){
				$where_urusan['anggaran.tahapan_kode'] 	= $tahapan_kode;
				$where_urusan['rka.tahun'] 				= $laporan_tahun;
				if ($laporan_skpd != 'semua'){ $where_urusan['skpd.skpd_kode'] 	= $laporan_skpd; }
				$where_urusan ['rka.tipe_kode']			= $laporan_belanja;
				$where_urusan['urusan.kode'] 			= $row->urusan_kode;
				
				foreach ($this->Anggaran_kas_model->grid_all('1', 'skpd.skpd_kode, skpd.skpd_nomor, skpd.skpd_nama as skpd_nama, rka_rincian.kode as kode_rincian, SUM(rka_sub.total) as totalRKA', 'skpd.skpd_kode', 'ASC', '', '', $where_urusan, '', 'skpd.skpd_kode') as $subrow){
				$skpd	= strtoupper($subrow->skpd_nama);
				$total	= rupiah2($subrow->totalRKA);

				$strhtml .= "<table style='font-family: font-size:11pt; serif; border:1px solid #000;'>
				<tr>
					<th style='text-align:left; border:1px solid #000; width:150px'>$i.$row->urusan_nomor.$subrow->skpd_nomor</th>
					<th style='text-align:left; border:1px solid #000; width:330px'>$skpd</th>
					<th style='text-align:right; border:1px solid #000; width:1030px'>$total</th>
				</tr>
				</table>";
	
					if ($this->Skpd_model->count_all(array('skpd_kode'=>$subrow->skpd_kode))){
						
						$where_skpd_rutin['anggaran.tahapan_kode'] 	= $tahapan_kode;
						$where_skpd_rutin['rka.tahun'] 				= $laporan_tahun;
						$where_skpd_rutin['skpd.skpd_kode'] 		= $subrow->skpd_kode;
						
						//Looping Program berdasarkan SKPD -> Urusan Rutin
						foreach ($this->Anggaran_kas_model->grid_all('1', 'SUM(rka_sub.total) as totalRKA, program.kode as program_kode, program.nomor as program_nomor, program.program as program_nama', 'program.nomor', 'ASC', '', '', $where_skpd_rutin, '', 'program.kode') as $subsubrow){
							
							$where_program_rutin['anggaran.tahapan_kode'] 	= $tahapan_kode;
							$where_program_rutin['anggaran.tahun'] 			= $laporan_tahun;
							$where_program_rutin['skpd.skpd_kode'] 			= $subrow->skpd_kode;
							$where_program_rutin['program.kode'] 			= $subsubrow->program_kode;

							//Cek Jumlah data pada Program
							if ($this->Anggaran_kas_model->count_bl($where_program_rutin) > 0){
								
								//Penjumlahan total Biaya
								$subtotal 	= rupiah2($subsubrow->totalRKA);
								
								$strhtml .= "<table style='font-family: font-size:11pt; serif; border:1px solid #000;'>
									<tr>
										<th style='text-align:left; border:1px solid #000; width:150px'>$i.$row->urusan_nomor.$subrow->skpd_nomor.$subsubrow->program_nomor</th>
										<th style='text-align:left; border:1px solid #000; width:330px'>$subsubrow->program_nama</th>
										<th style='text-align:right; border:1px solid #000; width:1030px'>$subtotal</th>
									</tr>
									</table>";
					} 
					
						foreach ($this->Anggaran_kas_model->grid_all('1', 'anggaran.kode as id_kode, anggaran.kegiatan, anggaran.alamat, anggaran_bl.kh_target as kht_anggaran, anggaran_bl.kh_satuan as khs_anggaran, tipe.no as no_tipe, tipe.tipe_nama as nama_tipe', 'anggaran.kegiatan', 'ASC', '', '', $where_program_rutin, '', 'anggaran_kas.anggaran_kode') as $kegiatanrow){
							if ($kegiatan_nomor < 10) {
								$kegiatan_nomor = "0".$kegiatan_nomor;
							} else {
								$kegiatan_nomor = $kegiatan_nomor;
							}
						
		$tampil = mysql_query("SELECT SUM(anggaran_kas.anggaran) as hasil_anggaran, SUM(anggaran_kas.jan+anggaran_kas.feb+anggaran_kas.mar) as triwulan_1, SUM(anggaran_kas.apr+anggaran_kas.mei+anggaran_kas.jun) as triwulan_2, SUM(anggaran_kas.jul+anggaran_kas.ags+anggaran_kas.sep) as triwulan_3, SUM(anggaran_kas.okt+anggaran_kas.nov+anggaran_kas.des) as triwulan_4 FROM anggaran_kas INNER JOIN rka ON anggaran_kas.rka=rka.kode INNER JOIN skpd ON anggaran_kas.skpd=skpd.skpd_kode	WHERE rka.tahun='".$laporan_tahun."' AND anggaran_kas.tipe_kode='".$laporan_belanja."' AND anggaran_kas.skpd='".$laporan_skpd."' AND anggaran_kas.anggaran_kode='".$kegiatanrow->id_kode."' ORDER BY anggaran_kas.kode ASC");
		while($row_total=mysql_fetch_array($tampil)){
			$total1 	= rupiah2($row_total[triwulan_1]);
			$total2 	= rupiah2($row_total[triwulan_2]);
			$total3 	= rupiah2($row_total[triwulan_3]);
			$total4 	= rupiah2($row_total[triwulan_4]);
			$jumlah 	= rupiah2($row_total[triwulan_1]+$row_total[triwulan_2]+$row_total[triwulan_3]+$row_total[triwulan_4]);
				$strhtml .= "<table style='font-family: font-size:9pt; serif; border:1px solid #000;'>
					<tr>
						<th style='text-align:left; font-weight:0; border:1px solid #000; width:150px'>$i.$row->urusan_nomor.$subrow->skpd_nomor.$subsubrow->program_nomor</th>
						<th style='text-align:left; font-weight:0; border:1px solid #000; width:330px'>$kegiatanrow->kegiatan</th>
						<th style='text-align:center; font-weight:0; border:1px solid #000; width:100px'>$kegiatanrow->alamat</th>
						<th style='text-align:center; font-weight:0; border:1px solid #000; width:100px'>$kegiatanrow->kht_anggaran $kegiatanrow->khs_anggaran</th>
						<th style='text-align:center; font-weight:0; border:1px solid #000; width:80px'>$kegiatanrow->no_tipe</th>
						<th style='text-align:right; font-weight:0; border:1px solid #000; width:150px'>$total1</th>
						<th style='text-align:right; font-weight:0; border:1px solid #000; width:150px'>$total2</th>
						<th style='text-align:right; font-weight:0; border:1px solid #000; width:150px'>$total3</th>
						<th style='text-align:right; font-weight:0; border:1px solid #000; width:150px'>$total4</th>
						<th style='text-align:right; font-weight:0; border:1px solid #000; width:150px'>$jumlah</th>
					</tr>
					</table>";
		}
							$kegiatan_nomor++;	
						} } }
						
			$tampil_sub = mysql_query("SELECT SUM(anggaran_kas.anggaran) as hasil_anggaran, SUM(anggaran_kas.jan+anggaran_kas.feb+anggaran_kas.mar) as triwulan_1, SUM(anggaran_kas.apr+anggaran_kas.mei+anggaran_kas.jun) as triwulan_2, SUM(anggaran_kas.jul+anggaran_kas.ags+anggaran_kas.sep) as triwulan_3, SUM(anggaran_kas.okt+anggaran_kas.nov+anggaran_kas.des) as triwulan_4 FROM anggaran_kas INNER JOIN rka ON anggaran_kas.rka=rka.kode INNER JOIN skpd ON anggaran_kas.skpd=skpd.skpd_kode WHERE rka.tahun='".$laporan_tahun."' AND anggaran_kas.tipe_kode='".$laporan_belanja."' AND anggaran_kas.skpd='".$laporan_skpd."' ORDER BY anggaran_kas.kode ASC"); 
			while($row_sub=mysql_fetch_array($tampil_sub)){
				$total1 	= rupiah2($row_sub[triwulan_1]);
				$total2 	= rupiah2($row_sub[triwulan_2]);
				$total3 	= rupiah2($row_sub[triwulan_3]);
				$total4 	= rupiah2($row_sub[triwulan_4]);
				$jumlah 	= rupiah2($row_sub[triwulan_1]+$row_sub[triwulan_2]+$row_sub[triwulan_3]+$row_sub[triwulan_4]);								
					$strhtml .= "<table style='font-family: font-size:11pt; serif; border:1px solid #000;'>
						<tr>
							<th style='text-align:center; border:1px solid #000; width:760px'>TOTAL</th>
							<th style='text-align:right; border:1px solid #000; width:150px'>$total1</th>
							<th style='text-align:right; border:1px solid #000; width:150px'>$total2</th>
							<th style='text-align:right; border:1px solid #000; width:150px'>$total3</th>
							<th style='text-align:right; border:1px solid #000; width:150px'>$total4</th>
							<th style='text-align:right; border:1px solid #000; width:150px'>$jumlah</th>
						</tr>
						</table>";
			}
		} } } 
	}
} else {
	$strhtml .= "<table style='font-family: serif; border:1px solid #000;'>
		<tr>
		   <td style='text-align:center; font-size:12pt; font-weight:bold; border:1px solid #000;'colspan='3'>PEMERINTAH KABUPATEN BEKASI<br>TAHUN ANGGARAN : $laporan_tahun</td>
		</tr>
	   </table>";
}// END
			$strhtml2 .= "<table style='font-family: serif; border:1px solid #000;'>
				<tr>
					<th style='text-align:left; font-size:12pt; width:200px'>Urusan Pemerintahan</th>
					<th style='text-align:left; font-size:12pt; font-weight:0; width:200px'>: 1.$id_urusan</th>
					<th style='text-align:left; font-size:12pt; font-weight:0; width:800px'>$jenis_urusan1 $nama_urusan</th>
				</tr> 
				<tr>
					<th style='text-align:left; font-size:12pt; width:100px'>Organisasi</th>
					<th style='text-align:left; font-size:12pt; font-weight:0; width:200px'>: 1.$id_urusan . 1.$id_urusan.$no_skpd</th>
					<th style='text-align:left; font-size:12pt; font-weight:0; width:800px'>$id_skpd</th>
				</tr>
				<tr>
					<th style='text-align:left; font-size:12pt; width:100px'>Sub Unit Organisasi</th>
					<th style='text-align:left; font-size:12pt; font-weight:0; width:200px'>: 1.$id_urusan . 1.$id_urusan.$no_skpd</th>
					<th style='text-align:left; font-size:12pt; font-weight:0; width:800px'>$id_skpd</th>
				</tr>
				</table>";

			$tanggal = dateIndo($laporan_tanggal);
			$strhtml2 .= "<table style='font-family: serif; border:1px solid #000;'>
				<tr>
					<th style='text-align:left; font-size:6pt; font-weight:0; width:200px height:40px;'></th>
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
				
			$query_tim = $this->db->query("SELECT * FROM tim_anggaran WHERE tim_anggaran.kode_tim= '1' GROUP BY tim_anggaran.kode ORDER BY tim_anggaran.kode ASC");
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
						<th style='text-align:left; font-size:6pt; font-weight:0; width:200px height:40px;'>- Pengesahan ini hanya berlaku sebagai dasar penyedia dana<br>- Penetapan dan perhitungan biaya serta penggunaan dana <br>&nbsp; yang tertuang dalam DPA SKPD merupakan tanggung jawab penggunaan<br>&nbsp; anggaran/kuasa pengguna anggaran</th>
						<th style='text-align:left; width:200px'></th>
					</tr> 
					<tr>
						<th style='text-align:left; width:200px'></th>
						<th style='text-align:center; font-size:8pt; font-weight:0; width:200px'>Mengesahkan,</th>
					</tr> 
					<tr>
						<th style='text-align:left; width:200px'></th>
						<th style='text-align:center; font-size:9pt; width:200px'>KEPALA BADAN PENGELOLAAN KEUANGAN DAN<br>ASET DAERAH<br>SELAKU<br>PEJABAT PENGELOLA KEUANGAN DAERAH</th>
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
						<th style='text-align:center; font-size:9pt; width:200px'>Drs. H. JUHANDI, M.Si<hr size='90' width='50%'/>NIP. 19631206 199203 1 007</td>
					</tr> 		
					<tr>
						<th style='text-align:left; height:148px'></th>
						<th style='text-align:center; font-size:9pt; height:148px'></th>
					</tr></table>";
	
$mpdf=new mPDF( '',                          // mode (default '')
                'A4', 0, '',               // format ('A4', '' or...), font size(default 0), font family
                5, 5, 5, 20, 5, 5,  //(margins) left, right, top, bottom, HEADER, FOOTER
                'L');
				
$mpdf->SetFooter('
<div class="satu"></div>
<table style="font-family: serif; font-size:5pt; border:1px solid #000;"><tr>
<th style="text-align:left; font-weight:0; border:1px solid #000; valign="top" width:50px">Formulir DPA SKPD 2.2 - '.$skpd.' <br>Tim Verivikasi</th>
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