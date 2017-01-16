<?php		
	$strhtml .= "<table style='font-family: serif;'>
		<tr>
		   <td style='text-align:center; width:150px' rowspan='2'><br><img src='public/dist/img/logo.jpg' alt='logo' width='70' height='70' border='0'/></td>
		   <td style='text-align:center; font-size:12pt; font-weight:bold; width:150px' colspan='3'>PEMERINTAH KABUPATEN BEKASI<br>ANGGARAN KAS</td>
		   <td style='text-align:center; width:150px' rowspan='2'></td>
		</tr>
		<tr>
		   <td style='text-align:center; font-size:8pt; font-weight:0;'colspan='3'>TAHUN ANGGARAN : $laporan_tahun</td>
		</tr>
	   </table>";
		
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
	sub.sub_nama as nama_sub, sub.nomor as id_sub, tim_anggaran.nama as nama_tim, tim_anggaran.nip as nip_tim
	FROM rka 
	LEFT JOIN program ON rka.program=program.kode
	LEFT JOIN skpd ON rka.skpd=skpd.skpd_kode
	LEFT JOIN urusan ON rka.urusan=urusan.kode	
	LEFT JOIN sub ON rka.skpd=sub.skpd	
	LEFT JOIN anggaran ON rka.anggaran_kode=anggaran.kode
	LEFT JOIN anggaran_bl ON rka.anggaran_kode=anggaran_bl.kode
	LEFT JOIN tim_anggaran ON rka.skpd=tim_anggaran.skpd
	WHERE rka.tipe_kode='".$laporan_tipe."'
	AND rka.kode='".$laporan_rka."'
	AND rka.skpd='".$laporan_skpd."'
	AND rka.tahun='".$laporan_tahun."'
	AND rka.anggaran_kode='".$laporan_anggaran."' 
	GROUP BY rka.kode ORDER BY rka.kode ASC");
	$data_get			= $query_get->result();
	foreach($data_get as $row_get) {
		$strhtml .= "<table style='font-family: serif;'>
			<tr>
				<th style='text-align:left; font-size:12pt; font-weight:bold; width:200px'>Urusan Pemerintahan</th>
				<th style='text-align:left; font-size:12pt; font-weight:0; width:200px'>: 1</th>
				<th style='text-align:left; font-size:12pt; font-weight:0; width:800px'>Urusan $row_get->jenis_urusan</th>
			</tr> 
			<tr>
				<th style='text-align:left; font-size:12pt; font-weight:bold; width:100px'>Bidang Pemerintahan</th>
				<th style='text-align:left; font-size:12pt; font-weight:0; width:200px'>: 1 . $row_get->id_urusan</th>
				<th style='text-align:left; font-size:12pt; font-weight:0; width:800px'>$row_get->nama_urusan</th>
			</tr> 
			<tr>
				<th style='text-align:left; font-size:12pt; font-weight:bold; width:100px'>Unit Organisasi</th>
				<th style='text-align:left; font-size:12pt; font-weight:0; width:200px'>: 1 . $row_get->id_urusan . $row_get->no_skpd</th>
				<th style='text-align:left; font-size:12pt; font-weight:0; width:800px'>$row_get->id_skpd</th>
			</tr> 
			<tr>
				<th style='text-align:left; font-size:12pt; font-weight:bold; width:100px'>Sub Unit Organisasi</th>
				<th style='text-align:left; font-size:12pt; font-weight:0; width:200px'>: 1 . $row_get->id_urusan . $row_get->no_skpd . $row_get->id_sub</th>
				<th style='text-align:left; font-size:12pt; font-weight:0; width:800px'>$row_get->nama_sub</th>
			</tr> 
			</table>";
	}
		$strhtml .= "<table style='font-family: serif;'>
			<tr>
				<th style='text-align:center; font-size:12pt; font-weight:bold; border:1px solid #000; width:150px'>KODE REKENING</th>
				<th style='text-align:center; font-size:12pt; font-weight:bold; border:1px solid #000; width:500px'>URAIAN</th>
				<th style='text-align:center; font-size:12pt; font-weight:bold; border:1px solid #000; width:150px'>ANGGARAN TAHUN INI</th>
				<th style='text-align:center; font-size:12pt; font-weight:bold; border:1px solid #000; width:150px'>TRIWULAN I</th>
				<th style='text-align:center; font-size:12pt; font-weight:bold; border:1px solid #000; width:150px'>TRIWULAN II</th>
				<th style='text-align:center; font-size:12pt; font-weight:bold; border:1px solid #000; width:150px'>TRIWULAN III</th>
				<th style='text-align:center; font-size:12pt; font-weight:bold; border:1px solid #000; width:150px'>TRIWULAN IV</th>
			</tr>
			</table>";
			
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
					
					$strhtml .= "<table style='font-family: serif;'>
					<tr>
						<th style='text-align:left; font-size:12pt; font-weight:bold; border:1px solid #000; width:150px'>5.2</th>
						<th style='text-align:left; font-size:12pt; font-weight:bold; border:1px solid #000; width:500px'>BELANJA LANGSUNG</th>
						<th style='text-align:right; font-size:12pt; font-weight:bold; border:1px solid #000; width:150px'>$hasil_anggaran</th>
						<th style='text-align:right; font-size:12pt; font-weight:bold; border:1px solid #000; width:150px'>$triwulan_1</th>
						<th style='text-align:right; font-size:12pt; font-weight:bold; border:1px solid #000; width:150px'>$triwulan_2</th>
						<th style='text-align:right; font-size:12pt; font-weight:bold; border:1px solid #000; width:150px'>$triwulan_3</th>
						<th style='text-align:right; font-size:12pt; font-weight:bold; border:1px solid #000; width:150px'>$triwulan_4</th>
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
								
						$strhtml .= "<table style='font-family: serif;'>
							<tr>
								<th style='text-align:left; font-size:12pt; font-style:italic; font-weight:0; border:1px solid #000; width:150px'>5.2.$subsubrow->program_nomor</th>
								<th style='text-align:left; font-size:12pt; font-style:italic; font-weight:0; border:1px solid #000; width:500px'>$subsubrow->program_nama</th>";

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
							
							$strhtml .= "<th style='text-align:right; font-size:12pt; font-style:italic; font-weight:0; border:1px solid #000; width:150px'>$hasil_anggaran</th>
								<th style='text-align:right; font-size:12pt; font-style:italic; font-weight:0; border:1px solid #000; width:150px'>$triwulan_1</th>
								<th style='text-align:right; font-size:12pt; font-style:italic; font-weight:0; border:1px solid #000; width:150px'>$triwulan_2</th>
								<th style='text-align:right; font-size:12pt; font-style:italic; font-weight:0; border:1px solid #000; width:150px'>$triwulan_3</th>
								<th style='text-align:right; font-size:12pt; font-style:italic; font-weight:0; border:1px solid #000; width:150px'>$triwulan_4</th>
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
									<th style='text-align:left; font-size:12pt; font-weight:0; border:1px solid #000; width:150px'>5.2.$subsubrow->program_nomor.$kegiatan_nomor</th>
									<th style='text-align:left; font-size:12pt; font-weight:0; border:1px solid #000; width:500px'>$kegiatanrow->kegiatan</th>";
									
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
									<th style='text-align:right; font-size:12pt; font-weight:0; border:1px solid #000; width:150px'>$hasil_anggaran</th>
									<th style='text-align:right; font-size:12pt; font-weight:0; border:1px solid #000; width:150px'>$triwulan_1</th>
									<th style='text-align:right; font-size:12pt; font-weight:0; border:1px solid #000; width:150px'>$triwulan_2</th>
									<th style='text-align:right; font-size:12pt; font-weight:0; border:1px solid #000; width:150px'>$triwulan_3</th>
									<th style='text-align:right; font-size:12pt; font-weight:0; border:1px solid #000; width:150px'>$triwulan_4</th>
								</tr> </table>";
							$kegiatan_nomor++;
						} } }
					} }	} }	

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
						<th style='text-align:left; border:1px solid #000; width:150px'></th>
						<th style='text-align:left; border:1px solid #000; width:500px'>Jumlah Alokasi Belanja Langsung</th>
						<th style='text-align:right; border:1px solid #000; width:150px'>$hasil_anggaran</th>
						<th style='text-align:right; border:1px solid #000; width:150px'>$triwulan_1</th>
						<th style='text-align:right; border:1px solid #000; width:150px'>$triwulan_2</th>
						<th style='text-align:right; border:1px solid #000; width:150px'>$triwulan_3</th>
						<th style='text-align:right; border:1px solid #000; width:150px'>$triwulan_4</th>
					</tr> </table>";

					}}
} } } } } }

		$strhtml2 .= "<table style='font-family: serif; font-size:10pt; border:1px solid #000;'>
			<tr>
				<th style='text-align:left; width:200px'>Urusan Pemerintahan</th>
				<th style='text-align:left; width:200px'>: 1</th>
				<th style='text-align:left; width:800px'>Urusan $row_get->jenis_urusan</th>
			</tr> 
			<tr>
				<th style='text-align:left; width:100px'>Bidang Pemerintahan</th>
				<th style='text-align:left; width:200px'>: 1 . $row_get->id_urusan</th>
				<th style='text-align:left; width:800px'>$row_get->nama_urusan</th>
			</tr> 
			<tr>
				<th style='text-align:left; width:100px'>Unit Organisasi</th>
				<th style='text-align:left; width:200px'>: 1 . $row_get->id_urusan . $row_get->no_skpd</th>
				<th style='text-align:left; width:800px'>$row_get->id_skpd</th>
			</tr> 
			<tr>
				<th style='text-align:left; width:100px'>Sub Unit Organisasi</th>
				<th style='text-align:left; width:200px'>: 1 . $row_get->id_urusan . $row_get->no_skpd . $row_get->id_sub</th>
				<th style='text-align:left; width:800px'>$row_get->nama_sub</th>
			</tr> 
			</table>";
			
	$tanggal = dateIndo($laporan_tanggal);
	$strhtml2 .= "<table style='font-family: serif; font-size:9pt;'>
			<tr>
				<th style='font-size:6pt; text-align:left; width:200px height:40px;'>&nbsp;</th>
				<th style='text-align:left; width:200px'></th>
			</tr> 
			<tr>
				<th style='text-align:left; width:200px'>&nbsp;</th>
				<th style='text-align:center; width:200px'></th>
			</tr> 
			<tr>
				<th style='text-align:left; width:200px'></th>
				<th style='text-align:center; width:200px'>Cikarang Pusat, $tanggal <br> $laporan_pangkat $skpd_nama</th>
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
				<th style='text-align:center; width:200px'>$laporan_pimpinan<hr size='90' width='50%'/>NIP. $laporan_nip</th>
			</tr>
			<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
			<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
			</table>";	
			
$mpdf=new mPDF( '',                          // mode (default '')
                'A4', 0, '',               // format ('A4', '' or...), font size(default 0), font family
                5, 5, 7, 20, 5, 5,  //(margins) left, right, top, bottom, HEADER, FOOTER
                'L');

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

$mpdf->WriteHTML($strhtml);
$mpdf->AddPage('');

$mpdf->WriteHTML($strhtml2);
$mpdf->Output('');
?>