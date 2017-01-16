<?php
		//$s = $mysqli->query("SELECT * FROM industri");
		//$strhtml = "<h3>DATA INDUSTRI KABUPATEN BEKASI</h3>";
		$strhtml .= "<table style='font-family: serif; font-size:10pt;'>
			<tr>
				<th style='text-align:center; width:50px'><img src='public/dist/img/logo.jpg' alt='logo' width='50' height='50' border='0'/></th>
				<th style='text-align:center; width:300px'>PEMERINTAH KABUPATEN BEKASI<br>ANGGARAN KAS<br>TAHUN ANGGARAN $laporan_tahun</th>				
				<th style='text-align:center; width:100px'></th>				
			</tr>";	
		$strhtml .= "</table>";
			
		$strhtml .= "<table style='font-family: serif; font-size:9pt;'>
			<tr>
				<th style='text-align:left; width:200px'>Urusan Pemerintahan</th>
				<th style='text-align:left; width:200px'>: Uraian</th>
				<th style='text-align:left; width:800px'>Anggaran</th>
			</tr> 
			<tr>
				<th style='text-align:left; width:100px'>Bidang Pemerintahan</th>
				<th style='text-align:left; width:200px'>: Uraian</th>
				<th style='text-align:left; width:800px'>Anggaran</th>
			</tr> 
			<tr>
				<th style='text-align:left; width:100px'>Unit Organisasi</th>
				<th style='text-align:left; width:200px'>: Uraian</th>
				<th style='text-align:left; width:800px'>Anggaran</th>
			</tr> 
			<tr>
				<th style='text-align:left; width:100px'>Sub Unit Organisasi</th>
				<th style='text-align:left; width:200px'>: Uraian</th>
				<th style='text-align:left; width:800px'>Anggaran</th>
			</tr> 
			</table>";

		$strhtml .= "<table style='font-family: serif; font-size:10pt; border:1px solid #000;'>
			<tr>
				<th style='text-align:center; border:1px solid #000; width:100px'>Kode Anggaran</th>
				<th style='text-align:center; border:1px solid #000; width:400px'>Uraian</th>
				<th style='text-align:center; border:1px solid #000; width:150px'>Anggaran</th>
				<th style='text-align:center; border:1px solid #000; width:150px'>Triwulan I</th>
				<th style='text-align:center; border:1px solid #000; width:150px'>Triwulan II</th>
				<th style='text-align:center; border:1px solid #000; width:150px'>Triwulan III</th>
				<th style='text-align:center; border:1px solid #000; width:150px'>Triwulan IV</th>
			</tr> </table>";
		
	if ($jumlah_data > 0){
	
	$jenis_urusan = array('1'=>'wajib', '2'=>'pilihan');
	$tahapan_kode = '16';

	for ($i=1; $i <= 2; $i++){
	$where_jenis['anggaran.tahapan_kode'] = $tahapan_kode;
	$where_jenis['anggaran.tahun'] 	= $laporan_tahun;
	if ($laporan_kecamatan != 'semua'){ $where_jenis['anggaran.kecamatan_kode']	= $laporan_kecamatan; }
	if ($laporan_deskel != 'semua'){ $where_jenis['anggaran.deskel_kode']	= $laporan_deskel; }
	if ($laporan_skpd != 'semua'){ $where_jenis['skpd.skpd_kode'] 	= $laporan_skpd; }
	$where_jenis['urusan.jenis'] 	= $jenis_urusan[$i];
	
		if ($this->Anggaran_model->count_bl($where_jenis) > 0) {
			
			foreach ($this->Anggaran_model->grid_all('1', 'urusan.kode as urusan_kode, urusan.nomor as urusan_nomor, urusan.urusan as urusan_nama', 'urusan.nomor', 'ASC', '', '', $where_jenis, '', 'anggaran_bl.urusan_kode') as $row){
			$where_urusan['anggaran.tahapan_kode'] 	= $tahapan_kode;
			$where_urusan['anggaran.tahun'] 	= $laporan_tahun;
			if ($laporan_kecamatan != 'semua'){ $where_urusan['anggaran.kecamatan_kode']= $laporan_kecamatan; }
			if ($laporan_deskel != 'semua'){ $where_urusan['anggaran.deskel_kode']	= $laporan_deskel; }
			if ($laporan_skpd != 'semua'){ $where_urusan['skpd.skpd_kode'] 	= $laporan_skpd; }
			$where_urusan['urusan.kode'] 		= $row->urusan_kode;
				
			if ($this->Anggaran_model->count_bl($where_urusan) > 0){
				foreach ($this->Anggaran_model->grid_all('1', 'skpd.skpd_kode, skpd.skpd_nomor, skpd.skpd_nama as skpd_nama', 'skpd.skpd_kode', 'ASC', '', '', $where_urusan, '', 'skpd.skpd_kode') as $subrow){
				
				$query_total	= $this->db->query("SELECT SUM(anggaran_kas.anggaran) as hasil_anggaran,
					SUM(anggaran_kas.jan+anggaran_kas.feb+anggaran_kas.mar) as triwulan_1,
					SUM(anggaran_kas.apr+anggaran_kas.mei+anggaran_kas.jun) as triwulan_2,
					SUM(anggaran_kas.jul+anggaran_kas.ags+anggaran_kas.sep) as triwulan_3,
					SUM(anggaran_kas.okt+anggaran_kas.nov+anggaran_kas.des) as triwulan_4
					FROM anggaran_kas 
					WHERE anggaran_kas.tipe_kode= '1'
					AND anggaran_kas.skpd='".$subrow->skpd_kode."'
					");
					$data_total 	= $query_total->result();
					if($data_total){ foreach($data_total as $row_total){

					$hasil_anggaran = rupiah2($row_total->hasil_anggaran);
					$triwulan_1 = rupiah2($row_total->triwulan_1);
					$triwulan_2 = rupiah2($row_total->triwulan_2);
					$triwulan_3 = rupiah2($row_total->triwulan_3);
					$triwulan_4 = rupiah2($row_total->triwulan_4);
					
					$strhtml .= "<table style='font-family: serif; font-size:10pt; border:1px solid #000;'>
					<tr>
						<th style='text-align:left; border:1px solid #000; width:100px'>5.2</th>
						<th style='text-align:left; border:1px solid #000; width:400px'>BELANJA LANGSUNG</th>
						<th style='text-align:right; border:1px solid #000; width:150px'>$hasil_anggaran</th>
						<th style='text-align:right; border:1px solid #000; width:150px'>$triwulan_1</th>
						<th style='text-align:right; border:1px solid #000; width:150px'>$triwulan_2</th>
						<th style='text-align:right; border:1px solid #000; width:150px'>$triwulan_3</th>
						<th style='text-align:right; border:1px solid #000; width:150px'>$triwulan_4</th>
					</tr> </table>";
					
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
								
							$strhtml .= "<table style='font-family: serif; font-size:10pt; border:1px solid #000;'>
							<tr>
								<th style='text-align:left; border:1px solid #000; width:100px'>5.2.$subsubrow->program_nomor</th>
								<th style='text-align:left; border:1px solid #000; width:400px'>$subsubrow->program_nama</th>";

							$query_hasil 	= $this->db->query("SELECT SUM(anggaran_kas.anggaran) as hasil_anggaran,
							SUM(anggaran_kas.jan+anggaran_kas.feb+anggaran_kas.mar) as triwulan_1,
							SUM(anggaran_kas.apr+anggaran_kas.mei+anggaran_kas.jun) as triwulan_2,
							SUM(anggaran_kas.jul+anggaran_kas.ags+anggaran_kas.sep) as triwulan_3,
							SUM(anggaran_kas.okt+anggaran_kas.nov+anggaran_kas.des) as triwulan_4
							FROM anggaran_kas 
							WHERE anggaran_kas.tipe_kode= '1'
							AND anggaran_kas.program='".$subsubrow->program_kode."'
							AND anggaran_kas.skpd='".$subrow->skpd_kode."'
							");
							$data_hasil 	= $query_hasil->result();
							if($data_hasil){ foreach($data_hasil as $row_hasil){
								
							$hasil_anggaran = rupiah2($row_hasil->hasil_anggaran);
							$triwulan_1 = rupiah2($row_hasil->triwulan_1);
							$triwulan_2 = rupiah2($row_hasil->triwulan_2);
							$triwulan_3 = rupiah2($row_hasil->triwulan_3);
							$triwulan_4 = rupiah2($row_hasil->triwulan_4);
							
							$strhtml .= "<th style='text-align:right; border:1px solid #000; width:150px'>$hasil_anggaran</th>
								<th style='text-align:right; border:1px solid #000; width:150px'>$triwulan_1</th>
								<th style='text-align:right; border:1px solid #000; width:150px'>$triwulan_2</th>
								<th style='text-align:right; border:1px solid #000; width:150px'>$triwulan_3</th>
								<th style='text-align:right; border:1px solid #000; width:150px'>$triwulan_4</th>
							</tr> </table>";
							}}
							
							foreach ($this->Anggaran_model->grid_all('1', 'anggaran.kode as id_anggaran, anggaran.kegiatan, anggaran.alamat, anggaran_bl.hp_ukur, anggaran_bl.hp_target, anggaran_bl.hp_satuan, anggaran_bl.kh_ukur, anggaran_bl.kh_target, anggaran_bl.kh_satuan, anggaran_bl.hk_ukur, anggaran_bl.hk_target, anggaran_bl.hk_satuan, anggaran_bl.apbd_kab, anggaran_bl.apbd_prov, anggaran_bl.apbn, anggaran_bl.sumberlain, anggaran_bl.perkiraan_maju, sifat.sifat_nama, deskel.skpd_nama as deskel_nama, kecamatan.skpd_nama as kecamatan_nama, sumber.sumber_nama, (anggaran_bl.apbd_kab+anggaran_bl.apbd_prov+anggaran_bl.apbn+anggaran_bl.sumberlain) as rencana_total, skpd.skpd_nama as skpd_nama, urusan.urusan as urusan_nama, sasaran.sasaran as sasaran_nama, prioritas.prioritas as prioritas_nama, program.program as program_nama, indikator.indikator as indikator_nama', 'anggaran.kegiatan', 'ASC', '', '', $where_program, '', 'anggaran.kode') as $kegiatanrow){
								if ($kegiatan_nomor < 10) {
									$kegiatan_nomor = "0".$kegiatan_nomor;
								} else {
									$kegiatan_nomor = $kegiatan_nomor;
								}
								
								$strhtml .= "<table style='font-family: serif; font-size:10pt; border:1px solid #000;'>
								<tr>
									<th style='text-align:left; border:1px solid #000; width:100px'>5.2.$subsubrow->program_nomor.$kegiatan_nomor</th>
									<th style='text-align:left; border:1px solid #000; width:400px'>$kegiatanrow->kegiatan</th>";
									
								$query_anggaran 	= $this->db->query("SELECT SUM(anggaran_kas.anggaran) as hasil_anggaran,
								SUM(anggaran_kas.jan+anggaran_kas.feb+anggaran_kas.mar) as triwulan_1,
								SUM(anggaran_kas.apr+anggaran_kas.mei+anggaran_kas.jun) as triwulan_2,
								SUM(anggaran_kas.jul+anggaran_kas.ags+anggaran_kas.sep) as triwulan_3,
								SUM(anggaran_kas.okt+anggaran_kas.nov+anggaran_kas.des) as triwulan_4
								FROM anggaran_kas 
								WHERE anggaran_kas.tipe_kode= '1'
								AND anggaran_kas.anggaran_kode='".$kegiatanrow->id_anggaran."'
								AND anggaran_kas.program='".$subsubrow->program_kode."'
								AND anggaran_kas.skpd='".$subrow->skpd_kode."'
								");
								$data_anggaran 	= $query_anggaran->result();
								if($data_anggaran){ foreach($data_anggaran as $row_anggaran){
									
								$hasil_anggaran = rupiah2($row_anggaran->hasil_anggaran);
								$triwulan_1 = rupiah2($row_anggaran->triwulan_1);
								$triwulan_2 = rupiah2($row_anggaran->triwulan_2);
								$triwulan_3 = rupiah2($row_anggaran->triwulan_3);
								$triwulan_4 = rupiah2($row_anggaran->triwulan_4);
									
								$strhtml .= "	
									<th style='text-align:right; border:1px solid #000; width:150px'>$hasil_anggaran</th>
									<th style='text-align:right; border:1px solid #000; width:150px'>$triwulan_1</th>
									<th style='text-align:right; border:1px solid #000; width:150px'>$triwulan_2</th>
									<th style='text-align:right; border:1px solid #000; width:150px'>$triwulan_3</th>
									<th style='text-align:right; border:1px solid #000; width:150px'>$triwulan_4</th>
								</tr> </table>";
						
						} } }
					} } } }
					
					$query_total	= $this->db->query("SELECT SUM(anggaran_kas.anggaran) as hasil_anggaran,
					SUM(anggaran_kas.jan+anggaran_kas.feb+anggaran_kas.mar) as triwulan_1,
					SUM(anggaran_kas.apr+anggaran_kas.mei+anggaran_kas.jun) as triwulan_2,
					SUM(anggaran_kas.jul+anggaran_kas.ags+anggaran_kas.sep) as triwulan_3,
					SUM(anggaran_kas.okt+anggaran_kas.nov+anggaran_kas.des) as triwulan_4
					FROM anggaran_kas 
					WHERE anggaran_kas.tipe_kode= '1'
					AND anggaran_kas.skpd='".$subrow->skpd_kode."'
					");
					$data_total 	= $query_total->result();
					if($data_total){ foreach($data_total as $row_total){
					
					$hasil_anggaran = rupiah2($row_total->hasil_anggaran);
					$triwulan_1 = rupiah2($row_total->triwulan_1);
					$triwulan_2 = rupiah2($row_total->triwulan_2);
					$triwulan_3 = rupiah2($row_total->triwulan_3);
					$triwulan_4 = rupiah2($row_total->triwulan_4);
					
					$strhtml .= "<table style='font-family: serif; font-size:10pt; border:1px solid #000;'>
					<tr>
						<th style='text-align:left; border:1px solid #000; width:100px'></th>
						<th style='text-align:left; border:1px solid #000; width:400px'>Jumlah Alokasi Belanja Langsung</th>
						<th style='text-align:right; border:1px solid #000; width:150px'>$hasil_anggaran</th>
						<th style='text-align:right; border:1px solid #000; width:150px'>$triwulan_1</th>
						<th style='text-align:right; border:1px solid #000; width:150px'>$triwulan_2</th>
						<th style='text-align:right; border:1px solid #000; width:150px'>$triwulan_3</th>
						<th style='text-align:right; border:1px solid #000; width:150px'>$triwulan_4</th>
					</tr> </table>";

					}}
	} } } } } }
		
		
$mpdf=new mPDF( '',                          // mode (default '')
                'A4', 0, '',               // format ('A4', '' or...), font size(default 0), font family
                5, 5, 5, 5, 9, 3,  //(margins) left, right, top, bottom, HEADER, FOOTER
                'L');
$mpdf->SetDisplayMode('fullpage');
$mpdf->list_indent_first_level = 0;
$mpdf->WriteHTML($strhtml,2);

$mpdf->SetFooter('
<div class="satu"></div>
<table style="font-family: serif; font-size:5pt; border:1px solid #000;"><tr>
<th style="text-align:left; width:400px">ANGGARAN KAS - '.$skpd_nama.'</th>
<th style="text-align:right; width:50px">Tanggal {DATE j-m-Y}, Halaman {PAGENO} dari {nbpg}</th>
</tr></table>
<table style="font-family: serif; font-size:5pt;"><tr>
<th style="text-align:left; width:50px">PrinTed By IntegRasi</th>
</tr></table>
');

$mpdf->AddPage('');
	$strhtml2 .= "<table style='font-family: serif; font-size:9pt; border:1px solid #000;'>
			<tr>
				<th style='text-align:left; width:200px'></th>
				<th style='text-align:left; width:200px'></th>
				<th style='text-align:left; width:800px'></th>
			</tr> 
			<tr>
				<th style='text-align:left; width:200px'></th>
				<th style='text-align:left; width:200px'></th>
				<th style='text-align:left; width:800px'></th>
			</tr> 
			<tr>
				<th style='text-align:left; width:200px border:1px solid #000;'>Urusan Pemerintahan</th>
				<th style='text-align:left; width:200px'>: Uraian</th>
				<th style='text-align:left; width:800px'>Anggaran</th>
			</tr> 
			<tr>
				<th style='text-align:left; width:200px'>Bidang Pemerintahan</th>
				<th style='text-align:left; width:200px'>: Uraian</th>
				<th style='text-align:left; width:800px'>Anggaran</th>
			</tr> 
			<tr>
				<th style='text-align:left; width:200px'>Unit Organisasi</th>
				<th style='text-align:left; width:200px'>: Uraian</th>
				<th style='text-align:left; width:800px'>Anggaran</th>
			</tr>
			<tr>
				<th style='text-align:left; width:200px'>Sub Unit Organisasi</th>
				<th style='text-align:left; width:200px'>: Uraian</th>
				<th style='text-align:left; width:800px'>Anggaran</th>
			</tr>
			<tr>
				<th style='text-align:left; width:200px'></th>
				<th style='text-align:left; width:200px'></th>
				<th style='text-align:left; width:800px'></th>
			</tr>
			<tr>
				<th style='text-align:left; width:100px'></th>
				<th style='text-align:left; width:200px'></th>
				<th style='text-align:left; width:800px'></th>
			</tr>
			</table>";

	$tanggal = dateIndo($laporan_tanggal);
	$strhtml2 .= "<table style='font-family: serif; font-size:9pt; border:1px solid #000;'>
			<tr>
				<th style='text-align:left; width:200px height:40px;'></th>
				<th style='text-align:left; width:200px'></th>
			</tr> 
			<tr>
				<th style='text-align:left; width:200px'></th>
				<th style='text-align:center; width:200px'>Cikarang Pusat, $tanggal <br> $laporan_pangkat</th>
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
				<th style='text-align:center; width:200px'>$laporan_pimpinan<hr size='90' width='50%'/> NIP. $laporan_nip</th>
			</tr>
			<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";
	$strhtml2 .= "</table>";

$mpdf->WriteHTML($strhtml2,2);

$mpdf->Output('laporan.pdf','I');
?>