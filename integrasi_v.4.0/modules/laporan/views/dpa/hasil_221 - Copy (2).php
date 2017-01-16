<?php
$strhtml0 .= "<br><br><table style='font-family: serif;'>
	<tr>
	   <td style='text-align:center;' colspan='3'><img src='public/dist/img/logo.jpg' alt='logo' width='100' height='100' border='0'/></td>
	</tr>
	<tr>
	   <td style='text-align:center; font-size:8pt; font-weight:bold;' colspan='3'>PEMERINTAH KABUPATEN BEKASI</td>
	</tr>
	<tr>
	   <td style='text-align:center; font-size:12pt; font-weight:bold;' colspan='3'>DOKUMEN PELAKSANAAN ANGGARAN<br>SATUAN KERJA PERANGKAT DAERAH<br>( DPA SKPD )</td>
	</tr>
	<tr>
	   <td style='text-align:center; font-size:8pt; font-weight:bold;' colspan='3'>TAHUN ANGGARAN : $laporan_tahun</td>
	</tr>		
	<tr>
	   <td style='text-align:center; font-size:12pt; font-weight:bold;' colspan='3'>BELANJA LANGSUNG</td>
	</tr>
	</table>";
	
	$query_jumlah = mysql_query("SELECT skpd.skpd_nomor as no_skpd, skpd.skpd_nama as id_skpd, skpd.urusan as id_urusan, skpd.skpd_alamat as alamat_skpd, skpd.skpd_status as status_skpd,
	urusan.urusan as nama_urusan, urusan.jenis as jenis_urusan,
	SUM(rka_sub.total) as total,
	tipe.no as no_tipe, tipe.tipe_nama as nama_tipe 
	FROM rka_sub 
	INNER JOIN rka ON rka_sub.rka=rka.kode 
	INNER JOIN skpd ON rka.skpd=skpd.skpd_kode
	INNER JOIN urusan ON rka.urusan=urusan.kode
	INNER JOIN tipe ON rka.sumber=tipe.tipe_kode
	WHERE rka.tahun='".$laporan_tahun."'
	AND rka.tipe_kode='".$laporan_belanja."
	' AND rka.skpd='".$laporan_skpd."'
	ORDER BY rka_sub.kode ASC"); 
	$data = mysql_fetch_array($query_jumlah); $id_urusan = $data[id_urusan]; $nama_urusan = $data[nama_urusan]; $jenis_urusan = $data[jenis_urusan]; $id_skpd = $data[id_skpd]; $no_skpd = $data[no_skpd]; $lokasi = $data[alamat_skpd]; $status = $data[status_skpd]; $jumlah = $data[total]; $no_tipe = $data[no_tipe]; $nama_tipe = $data[nama_tipe];
	$rupiah = rupiah1($jumlah);
	$terbilang = Terbilang($jumlah);
	$skpd = strtoupper($id_skpd);

	$strhtml0 .= "<table style='font-family: serif; font-size:18pt; font-weight:bold;'>
		<tr>
			<td style='text-align:center; width:500px'>&nbsp;</td>
			<td style='text-align:center; width:250px'>NO DPA SKPD :</td>
			<td style='text-align:center; border:1px solid #000; width:150px'>1.$id_urusan</td>
			<td style='text-align:center; border:1px solid #000; width:150px'>0.00</td>
			<td style='text-align:center; border:1px solid #000; width:150px'>0.00</td>
			<td style='text-align:center; border:1px solid #000; width:150px'>0.00</td>
			<td style='text-align:center; border:1px solid #000; width:150px'>0.00</td>
			<td style='text-align:center; border:1px solid #000; width:150px'>0.00</td>
			<td style='text-align:center; width:500px'>&nbsp;</td>
		</tr>
		</table><br><br><br><br>";
			
	$strhtml0 .= "<br><br><table style='font-family: serif;'>
		<tr>
			<th style='text-align:left; width:50px'>&nbsp;</th>
			<th style='text-align:left; font-size:15pt; width:300px'>URUSAN PEMERINTAHAN</th>
			<th style='text-align:left; font-size:15pt; font-weight:0; width:300px'>: 1.$id_urusan . 1.$id_urusan</th>
			<th style='text-align:left; font-size:15pt; font-weight:0; width:700px'>$jenis_urusan $nama_urusan</th>
			<th style='text-align:left; width:50px'>&nbsp;</th>
		</tr> 
		<tr>
			<th style='text-align:left; width:50px'>&nbsp;</th>
			<th style='text-align:left; font-size:15pt; width:300px'>ORGANISASI</th>
			<th style='text-align:left; font-size:15pt; font-weight:0; width:300px'>: 1.$id_urusan . 1.$id_urusan.$no_skpd</th>
			<th style='text-align:left; font-size:15pt; font-weight:0; width:700px'>$id_skpd</th>
			<th style='text-align:left; width:50px'>&nbsp;</th>
		</tr> 
		<tr>
			<th style='text-align:left; width:50px'>&nbsp;</th>
			<th style='text-align:left; font-size:15pt; width:300px'>SUB UNIT ORGANISASI</th>
			<th style='text-align:left; font-size:15pt; font-weight:0; width:300px'>: 1.$id_urusan . 1.$id_urusan.$no_skpd . $no_skpd</th>
			<th style='text-align:left; font-size:15pt; font-weight:0; width:700px'>$id_skpd</th>
			<th style='text-align:left; width:50px'>&nbsp;</th>
		</tr></table>";

	if ($laporan_program == semua && $laporan_kegiatan == semua){		
		$strhtml0 .= "<br>";
		} else if ($laporan_kegiatan == semua){

		$strhtml0 .= "<table style='font-family: serif; font-size:18pt; font-weight:bold;'>
			<tr>
				<th style='text-align:left; width:50px'>&nbsp;</th>
				<th style='text-align:left; font-size:15pt; width:300px'>PROGRAM</th>
				<th style='text-align:left; font-size:15pt; font-weight:0; width:300px'>: 1.$id_urusan . 1.$id_urusan.$no_skpd . $no_program</th>
				<th style='text-align:left; font-size:15pt; font-weight:0; width:700px'>$id_program</th>
				<th style='text-align:left; width:50px'>&nbsp;</th>
			</tr> 
			<tr>
				<th style='text-align:left; width:50px'>&nbsp;</th>
				<th style='text-align:left; font-size:15pt; width:300px'>KEGIATAN</th>
				<th style='text-align:left; font-size:15pt; font-weight:0; width:300px'>: 1.$id_urusan . 1.$id_urusan.$no_skpd . $no_program . 01</th>
				<th style='text-align:left; font-size:15pt; font-weight:0; width:700px'>$id_anggaran</th>
				<th style='text-align:left; width:50px'>&nbsp;</th>
			</tr>
			</table><br>";
			
		} else {
			


		}
		
			$rupiah = rupiah1($jumlah);
			$terbilang = Terbilang($jumlah);		
			$strhtml0 .= "<table style='font-family: serif;'>
			<tr>
				<th style='text-align:left; width:50px'>&nbsp;</th>
				<th style='text-align:left; font-size:15pt; width:300px'>LOKASI KEGIATAN</th>
				<th style='text-align:left; font-size:15pt; font-weight:0; width:1000px'>: $lokasi</th>
				<th style='text-align:left; width:50px'>&nbsp;</th>
			</tr> 
			<tr>
				<th style='text-align:left; width:50px'>&nbsp;</th>
				<th style='text-align:left; font-size:15pt; width:300px'>SUMBER DANA</th>
				<th style='text-align:left; font-size:15pt; font-weight:0; width:1000px'>: $no_tipe &nbsp; &nbsp; &nbsp; $nama_tipe</th>
				<th style='text-align:left; width:50px'>&nbsp;</th>
			</tr> 
			<tr>
				<th style='text-align:left; width:50px'>&nbsp;</th>
				<th style='text-align:left; font-size:15pt; width:300px'>JUMLAH ANGGARAN</th>
				<th style='text-align:left; font-size:15pt; font-weight:0; width:1000px'>: Rp. $rupiah &nbsp; &nbsp; &nbsp; ($terbilang rupiah )</th>
				<th style='text-align:left; width:50px'>&nbsp;</th>
			</tr>
			</table><br>";
			
			$jabatan = strtoupper($laporan_pangkat);
			$skpd = strtoupper($id_skpd);
			$strhtml0 .= "<table style='font-family: serif;'>
			<tr>
				<th style='text-align:left; width:50px'>&nbsp;</th>
				<th style='text-align:left; font-size:12pt; width:300px'>PENGGUNA ANGGARAN/<br>KUASA PENGGUNA ANGGARAN</th>
				<th style='text-align:left; width:1000px'>&nbsp;</th>
				<th style='text-align:left; width:50px'>&nbsp;</th>
			</tr> 
			<tr>
				<th style='text-align:left; width:50px'>&nbsp;</th>
				<th style='text-align:left; font-size:15pt; width:300px'>&nbsp; &nbsp; &nbsp; NAMA</th>
				<th style='text-align:left; font-size:15pt; font-weight:0; width:1000px'>: $laporan_pimpinan</th>
				<th style='text-align:left; width:50px'>&nbsp;</th>
			</tr> 
			<tr>
				<th style='text-align:left; width:50px'>&nbsp;</th>
				<th style='text-align:left; font-size:15pt; width:300px'>&nbsp; &nbsp; &nbsp; NIP</th>
				<th style='text-align:left; font-size:15pt; font-weight:0; width:1000px'>: $laporan_nip</th>				
				<th style='text-align:left; width:50px'>&nbsp;</th>
			</tr>
			<tr>
				<th style='text-align:left; width:50px'>&nbsp;</th>
				<th style='text-align:left; font-size:15pt; width:300px'>&nbsp; &nbsp; &nbsp; JABATAN</th>
				<th style='text-align:left; font-size:15pt; font-weight:0; width:1000px'>: $jabatan $skpd</th>				
				<th style='text-align:left; width:50px'>&nbsp;</th>
			</tr>
			</table>";	
		
			$strhtml .= "<table style='font-family: serif; border:1px solid #000;'>
				<tr>
				   <td style='text-align:center; width:150px' rowspan='2'><img src='public/dist/img/logo.jpg' alt='logo' width='70' height='70' border='0'/></td>
				   <td style='text-align:center; font-size:15pt; font-weight:bold; width:500px' rowspan='2'>DOKUMEN PELAKSANAAN ANGGARAN<br>SATUAN KERJA PERANGKAT DAERAH</td>
				   <td style='text-align:center; font-size:15pt; font-weight:bold; border:1px solid #000;'colspan='6'>NOMOR DPA SKPD</td>
				   <td style='text-align:center; font-size:15pt; font-weight:bold; border:1px solid #000; width:150px' rowspan='2'>Formulir<br>DPA SKPD<br>2.2.1</td>
				</tr>
				<tr>
				   <td style='text-align:center; font-size:10pt; font-weight:0; border:1px solid #000; width:50px'>1.$id_urusan</td>
				   <td style='text-align:center; font-size:10pt; font-weight:0; border:1px solid #000; width:50px'>0.00</td>
				   <td style='text-align:center; font-size:10pt; font-weight:0; border:1px solid #000; width:50px'>0.00</td>
				   <td style='text-align:center; font-size:10pt; font-weight:0; border:1px solid #000; width:50px'>0.00</td>
				   <td style='text-align:center; font-size:10pt; font-weight:0; border:1px solid #000; width:50px'>0.00</td>
				   <td style='text-align:center; font-size:10pt; font-weight:0; border:1px solid #000; width:50px'>0.00</td>
				</tr>
			   </table>";
			   
			$strhtml .= "<table style='font-family: serif; border:1px solid #000;'>
				<tr>
					<th style='text-align:center; font-size:9pt; width:150px'>PEMERINTAH KABUPATEN BEKASI<br>Tahun Anggaran : $laporan_tahun</th>
				</tr> 
				</table>";
		
			$strhtml .= "<table style='font-family: serif; border:1px solid #000;'>
				<tr>
					<th style='text-align:left; font-size:12pt; width:200px'>Urusan Pemerintahan</th>
					<th style='text-align:left; font-size:12pt; font-weight:0; width:200px'>: 1.$id_urusan . 1.$id_urusan</th>
					<th style='text-align:left; font-size:12pt; font-weight:0; width:800px'>$jenis_urusan $nama_urusan</th>
				</tr> 
				<tr>
					<th style='text-align:left; font-size:12pt; width:100px'>Organisasi</th>
					<th style='text-align:left; font-size:12pt; font-weight:0; width:200px'>: 1.$id_urusan . 1.$id_urusan.$no_skpd</th>
					<th style='text-align:left; font-size:12pt; font-weight:0; width:800px'>$id_skpd</th>
				</tr> 
				<tr>
					<th style='text-align:left; font-size:12pt; width:100px'>Sub Unit Organisasi</th>
					<th style='text-align:left; font-size:12pt; font-weight:0; width:200px'>: 1.$id_urusan . 1.$id_urusan.$no_skpd . $no_skpd</th>
					<th style='text-align:left; font-size:12pt; font-weight:0; width:800px'>$id_skpd</th>
				</tr> 
				</table>";
			
		if ($laporan_program == semua && $laporan_kegiatan == semua){		

		} else if ($laporan_kegiatan == semua){

		} else {
			
		}
		
		$strhtml .= "<table style='font-family: serif; border:1px solid #000;'>
			<tr>
				<th style='text-align:left; font-size:9pt; width:200px'>Sumber Dana</th>
				<th style='text-align:left; font-size:9pt; font-weight:0; width:660px'>: $no_tipe &nbsp; &nbsp; &nbsp; $nama_tipe</th>
			</tr> 
			</table>";

		$strhtml .= "<table style='font-family: serif; border:1px solid #000;'>
			<tr>
				<th style='text-align:center; font-size:9pt; width:150px'>RINCIAN DOKUMEN PELAKSANAAN ANGGARAN BELANJA LANGSUNG<br>PROGRAM DAN PER KEGIATAN SATUAN KERJA PERANGKAT DAERAH</th>
			</tr> 
			</table>";
		
		$strhtml .= "<table style='font-family: serif; font-size:12pt; font-weight:bold; border:1px solid #000;'>
			<tr>
			   <td style='text-align:center; border:1px solid #000; width:150px' rowspan='2'>KODE REKENING</td>
			   <td style='text-align:center; border:1px solid #000; width:500px' rowspan='2'>URAIAN</td>
			   <td style='text-align:center; border:1px solid #000;'colspan='3'>RINCIAN PERHITUNGAN </td>
			   <td style='text-align:center; border:1px solid #000; width:150px' rowspan='2'>JUMLAH<br>(Rp)</td>
			</tr>
			<tr>
				<td style='text-align:center; border:1px solid #000; width:150px'>Volume</td>
				<td style='text-align:center; border:1px solid #000; width:150px'>Satuan</td>
			   <td style='text-align:center; border:1px solid #000; width:150px'>Harga Satuan</td>
			</tr>
		   </table>";

		$strhtml .= "<table style='font-family: serif; font-size:11pt; border:1px solid #000;'>
			<tr>
				<th style='text-align:center; border:1px solid #000; width:150px'>1</th>
				<th style='text-align:center; border:1px solid #000; width:500px'>2</th>
				<th style='text-align:center; border:1px solid #000; width:150px'>3</th>
				<th style='text-align:center; border:1px solid #000; width:150px'>4</th>
				<th style='text-align:center; border:1px solid #000; width:150px'>5</th>
				<th style='text-align:center; border:1px solid #000; width:150px'>6 = 3 x 5</th>
			</tr>
			</table>";

		$strhtml .= "<table style='font-family: serif; border:1px solid #000;'>
			<tr>
				<th style='text-align:left; font-size:12pt; border:1px solid #000; width:150px'>5</th>
				<th style='text-align:left; font-size:12pt; border:1px solid #000; width:500px'>BELANJA</th>
				<th style='text-align:right; font-size:12pt; border:1px solid #000; width:600px'>$rupiah</th>
			</tr>
			<tr>
				<th style='text-align:left; font-size:12pt; border:1px solid #000; width:150px'>5.2</th>
				<th style='text-align:left; font-size:12pt; border:1px solid #000; width:500px'>BELANJA LANGSUNG</th>
				<th style='text-align:right; font-size:12pt; border:1px solid #000; width:600px'>$rupiah</th>
				</tr>
			</table>";
			
	if ($jumlah_data > 0){
	
	$tahapan_kode = '16';
	$jenis_belanja 	= array('1'=>'63', '2'=>'64', '3'=>'65');	
	$jenis 			= array('1'=>'Belanja Pegawai', '2'=>'Belanja Barang dan Jasa', '3'=>'Belanja Modal');

	for ($i=1; $i < 4; $i++){
	
		$where_jenis['anggaran.tahapan_kode'] = $tahapan_kode;
		$where_jenis['rka.tahun'] 		= $laporan_tahun;
		if ($laporan_skpd != 'semua'){ $where_jenis['skpd.skpd_kode'] 		= $laporan_skpd; }
		if ($laporan_program != 'semua'){ $where_jenis['program.kode'] 		= $laporan_program; }
		if ($laporan_kegiatan != 'semua'){ $where_jenis['anggaran.kode'] 	= $laporan_kegiatan; }
		$where_jenis['rka.jenis'] 		= $jenis_belanja[$i];
		$where_jenis ['rka.tipe_kode']	= $laporan_belanja;
	
		if ($this->Rka_model->count_bl($where_jenis) > 0){
			
			if ($laporan_program == semua && $laporan_kegiatan == semua){
				$query_belanja = $this->db->query("SELECT rka.kode as id_rka, SUM(rka_sub.total) as totalRKA FROM rka_sub LEFT JOIN rka ON rka_sub.rka=rka.kode WHERE rka.jenis='".$jenis_belanja[$i]."' AND rka.tipe_kode='".$laporan_belanja."' AND rka.tahun='".$laporan_tahun."' AND rka.skpd='".$laporan_skpd."'");
				$data_belanja	= $query_belanja->result();
				foreach($data_belanja as $row_belanja) {
					$totalRKA1 	= rupiah1($row_belanja->totalRKA);
					$strhtml .= "<table style='font-family: serif; border:1px solid #000;'>
							<tr>
								<th style='text-align:left; font-size:12pt; font-weight:bold; border:1px solid #000; width:150px'>5.2.$i</th>
								<th style='text-align:left; font-size:12pt; font-weight:bold; border:1px solid #000; width:500px'>$jenis[$i]</th>
								<th style='text-align:right; font-size:12pt; font-weight:bold; border:1px solid #000; width:600px'>$totalRKA1</th>
							</tr>
						</table>";
				}

			} else if ($laporan_kegiatan == semua){ 
				$query_belanja	= mysql_query("SELECT rka.kode as id_rka, SUM(rka_sub.total) as totalRKA FROM rka_sub INNER JOIN rka ON rka_sub.rka=rka.kode WHERE rka.jenis='".$jenis_belanja[$i]."' AND rka.tipe_kode='".$laporan_belanja."' AND rka.tahun='".$laporan_tahun."' AND rka.skpd='".$laporan_skpd."' AND rka.program='".$laporan_program."'");
				while($row_belanja=mysql_fetch_array($query_belanja)){
				$totalRKA 	= rupiah1($row_belanja['totalRKA']);
					$strhtml .= "<table style='font-family: serif; border:1px solid #000;'>
						<tr>
							<th style='text-align:left; font-size:12pt; font-weight:bold; border:1px solid #000; width:150px'>5.2.$i</th>
							<th style='text-align:left; font-size:12pt; font-weight:bold; border:1px solid #000; width:500px'>$jenis[$i]</th>
							<th style='text-align:right; font-size:12pt; font-weight:bold; border:1px solid #000; width:600px'>$totalRKA</th>
						</tr>
						</table>";
				}
			} else { 
				$query_belanja	= mysql_query("SELECT rka.kode as id_rka, SUM(rka_sub.total) as totalRKA FROM rka_sub INNER JOIN rka ON rka_sub.rka=rka.kode WHERE rka.jenis='".$jenis_belanja[$i]."' AND rka.tipe_kode='".$laporan_belanja."' AND rka.tahun='".$laporan_tahun."' AND rka.skpd='".$laporan_skpd."' AND rka_sub.anggaran_kode='".$laporan_kegiatan."' AND rka.program='".$laporan_program."'");
				while($row_belanja=mysql_fetch_array($query_belanja)){
				$totalRKA 	= rupiah1($row_belanja['totalRKA']);
					$strhtml .= "<table style='font-family: serif; border:1px solid #000;'>
						<tr>
							<th style='text-align:left; font-size:12pt; font-weight:bold; border:1px solid #000; width:150px'>5.2.$i</th>
							<th style='text-align:left; font-size:12pt; font-weight:bold; border:1px solid #000; width:500px'>$jenis[$i]</th>
							<th style='text-align:right; font-size:12pt; font-weight:bold; border:1px solid #000; width:600px'>$totalRKA</th>
						</tr>
						</table>";
				}
			}			
			
			foreach ($this->Rka_model->grid_all('1', 'obyek.kode as kode_obyek, obyek.nomor as nomor_obyek, obyek.obyek_nama as nama_obyek, SUM(rka_sub.total) as totalRKA', 'obyek.no', 'ASC', '', '', $where_jenis, '', 'rka.obyek') as $row){
				$where_urusan['anggaran.tahapan_kode'] 	= $tahapan_kode;
				$where_urusan['rka.tahun'] 	= $laporan_tahun;
				if ($laporan_skpd != 'semua'){ $where_urusan['skpd.skpd_kode'] 		= $laporan_skpd; }
				if ($laporan_program != 'semua'){ $where_urusan['program.kode'] 	= $laporan_program; }
				if ($laporan_kegiatan != 'semua'){ $where_urusan['anggaran.kode'] 	= $laporan_kegiatan; }
				$where_urusan['obyek.kode'] 		= $row->kode_obyek;
				$where_urusan ['rka.tipe_kode']		= $laporan_belanja;
				
				if ($this->Rka_model->count_bl($where_urusan) > 0){
				$totalO 	= rupiah1($row->totalRKA);
				$strhtml .= "<table style='font-family: serif; border:1px solid #000;'>
					<tr>
						<th style='text-align:left; font-size:12pt; font-weight:0; border:1px solid #000; width:150px'>5.2.$i.$row->nomor_obyek</th>
						<th style='text-align:left; font-size:12pt; font-weight:0; border:1px solid #000; width:500px'>$row->nama_obyek</th>
						<th style='text-align:right; font-size:12pt; font-weight:0; border:1px solid #000; width:600px'>$totalO</th>
					</tr>
					</table>";
				}
	
					foreach ($this->Rka_model->grid_all('1', 'rincian.kode as kode_rincian, rincian.nomor as nomor_rincian, rincian.rincian_nama as nama_rincian, SUM(rka_sub.total) as totalRKA', 'rincian.kode', 'ASC', '', '', $where_urusan, '', 'rincian.kode') as $subrow){
					$totalS 	= rupiah1($subrow->totalRKA);
					$strhtml .= "<table style='font-family: serif; border:1px solid #000;'>
						<tr>
							<th style='text-align:left; font-size:12pt; font-style:italic; font-weight:0; border:1px solid #000; width:150px'>5.2.$i.$row->nomor_obyek.$subrow->nomor_rincian</th>
							<th style='text-align:left; font-size:12pt; font-style:italic; font-weight:0; border:1px solid #000; width:500px'>$subrow->nama_rincian</th>
							<th style='text-align:center; font-size:12pt; font-weight:0; border:1px solid #000; width:150px'></th>
							<th style='text-align:center; font-size:12pt; font-weight:0; border:1px solid #000; width:150px'></th>
							<th style='text-align:right; font-size:12pt; font-weight:0; border:1px solid #000; width:150px'></th>
							<th style='text-align:right; font-size:12pt; font-style:italic; font-weight:0; border:1px solid #000; width:150px'>$totalS</th>	
						</tr>
						</table>";
						
						$where_rincian['anggaran.tahapan_kode'] 	= $tahapan_kode;
						$where_rincian['rka.tahun'] 	= $laporan_tahun;
						if ($laporan_skpd != 'semua'){ $where_rincian['skpd.skpd_kode'] 		= $laporan_skpd; }
						if ($laporan_program != 'semua'){ $where_rincian['program.kode'] 	= $laporan_program; }
						if ($laporan_kegiatan != 'semua'){ $where_rincian['anggaran.kode'] 	= $laporan_kegiatan; }
						$where_rincian['rincian.kode'] 		= $subrow->kode_rincian;
						$where_rincian ['rka.tipe_kode']	= $laporan_belanja;

						foreach ($this->Rka_model->grid_all('1', 'rka_rincian.kode as kode_rincian, rka_rincian.no as nomor_rincian, rka_rincian.uraian as nama_rincian, SUM(rka_sub.total) as totalRKA', 'rka_rincian.kode', 'ASC', '', '', $where_rincian, '', 'rka_rincian.kode') as $rincianrow){
						$totalR 	= rupiah1($rincianrow->totalRKA);
						$strhtml .= "<table style='font-family: serif; border:1px solid #000;'>
							<tr>
								<th style='text-align:center; font-size:12pt; font-weight:0; border:1px solid #000; width:150px'></th>
								<th style='text-align:left; font-size:12pt; font-weight:0; border:1px solid #000; width:500px'>$rincianrow->nama_rincian</th>
								<th style='text-align:center; font-size:12pt; font-weight:0; border:1px solid #000; width:150px'></th>
								<th style='text-align:center; font-size:12pt; font-weight:0; border:1px solid #000; width:150px'></th>
								<th style='text-align:right; font-size:12pt; font-weight:0; border:1px solid #000; width:150px'></th>
								<th style='text-align:right; font-size:12pt; font-weight:0; border:1px solid #000; width:150px'>$totalR</th>
							</tr>
							</table>";	
							
							$where_sub['anggaran.tahapan_kode'] 	= $tahapan_kode;
							$where_sub['rka.tahun'] 		= $laporan_tahun;
							if ($laporan_skpd != 'semua'){ $where_sub['skpd.skpd_kode']		= $laporan_skpd; }
							if ($laporan_program != 'semua'){ $where_sub['program.kode'] 	= $laporan_program; }
							if ($laporan_kegiatan != 'semua'){ $where_sub['anggaran.kode'] 	= $laporan_kegiatan; }
							$where_sub['rka_rincian.kode']	= $rincianrow->kode_rincian;
							$where_sub ['rka.tipe_kode']	= $laporan_belanja;							

							foreach ($this->Rka_model->grid_all('1', 'rka_sub.kode as kode_sub, rka_sub.no as no_sub, rka_sub.uraian as nama_sub, rka_sub.volume, rka_sub.satuan, rka_sub.harga, rka_sub.total', 'rka_sub.kode', 'ASC', '', '', $where_sub, '', 'rka_sub.kode') as $rsubrow){
							$harga = rupiah1 ($rsubrow->harga);
							$total = rupiah1 ($rsubrow->total);
							$strhtml .= "<table style='font-family: serif; border:1px solid #000;'>
								<tr>
									<th style='text-align:center; font-size:12pt; font-weight:0; border:1px solid #000; width:150px'></th>
									<th style='text-align:left; font-size:12pt; font-weight:0; border:1px solid #000; width:500px'> - $rsubrow->nama_sub</th>
									<th style='text-align:center; font-size:12pt; font-weight:0; border:1px solid #000; width:150px'>$rsubrow->volume</th>
									<th style='text-align:center; font-size:12pt; font-weight:0; border:1px solid #000; width:150px'>$rsubrow->satuan</th>
									<th style='text-align:right; font-size:12pt; font-weight:0; border:1px solid #000; width:150px'>$harga</th>
									<th style='text-align:right; font-size:12pt; font-weight:0; border:1px solid #000; width:150px'>$total</th>
								</tr>
								</table>";
		} } } } }
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
				<th style='text-align:left; font-size:12pt; font-weight:0; width:200px'>: 1.$id_urusan . 1.$id_urusan</th>
				<th style='text-align:left; font-size:12pt; font-weight:0; width:800px'>$jenis_urusan $nama_urusan</th>
			</tr> 
			<tr>
				<th style='text-align:left; font-size:12pt; width:100px'>Organisasi</th>
				<th style='text-align:left; font-size:12pt; font-weight:0; width:200px'>: 1.$id_urusan . 1.$id_urusan.$no_skpd</th>
				<th style='text-align:left; font-size:12pt; font-weight:0; width:800px'>$id_skpd</th>
			</tr> 
			<tr>
				<th style='text-align:left; font-size:12pt; width:100px'>Sub Unit Organisasi</th>
				<th style='text-align:left; font-size:12pt; font-weight:0; width:200px'>: 1.$id_urusan . 1.$id_urusan.$no_skpd . $no_skpd</th>
				<th style='text-align:left; font-size:12pt; font-weight:0; width:800px'>$id_skpd</th>
			</tr> 
			</table>";
		$tanggal = dateIndo($laporan_tanggal);			
		if ($laporan_program == semua && $laporan_kegiatan == semua){
			
			$query_tri	= mysql_query("SELECT 
					SUM(anggaran_kas.anggaran) as hasil_anggaran,
					SUM(anggaran_kas.jan+anggaran_kas.feb+anggaran_kas.mar) as triwulan_1,
					SUM(anggaran_kas.apr+anggaran_kas.mei+anggaran_kas.jun) as triwulan_2,
					SUM(anggaran_kas.jul+anggaran_kas.ags+anggaran_kas.sep) as triwulan_3,
					SUM(anggaran_kas.okt+anggaran_kas.nov+anggaran_kas.des) as triwulan_4 
			FROM anggaran_kas 
			INNER JOIN rka ON anggaran_kas.rka=rka.kode 
			WHERE rka.tipe_kode='".$laporan_belanja."' 
			AND rka.tahun='".$laporan_tahun."' 
			AND rka.skpd='".$laporan_skpd."'
			");
				while($row_tri=mysql_fetch_array($query_tri)){				
					$hasil_anggaran = rupiah1($row_tri->hasil_anggaran);
					$triwulan_1 = rupiah1($row_tri['triwulan_1']);
					$triwulan_2 = rupiah1($row_tri['triwulan_2']);
					$triwulan_3 = rupiah1($row_tri['triwulan_3']);
					$triwulan_4 = rupiah1($row_tri['triwulan_4']);
					$total_triwulan = rupiah1($row_tri['triwulan_1'] + $row_tri['triwulan_2'] + $row_tri['triwulan_3'] + $row_tri['triwulan_4']);
					$strhtml2 .= "<table style='font-family: serif; border:1px solid #000;'>
						<tr>
						   <td style='text-align:center; font-size:8pt; font-weight:bold; width:250px' colspan='2'>RENCANA PENARIKAN DANA PER TRIWULAN<hr size='90' width='100%'/></td>
						   <td style='text-align:center; font-size:8pt; font-weight:bold; width:250px'>Cikarang Pusat, $tanggal <br> $jabatan $skpd</td>
						</tr>
						<tr>
						   <td style='text-align:left; font-size:8pt; font-weight:bold; width:150px'>Triwulan I</td>
						   <td style='text-align:right; font-size:8pt; font-weight:0; width:150px'>Rp $triwulan_1</td>
						   <td style='text-align:center; font-size:8pt; font-weight:bold; width:500px'></td>
						</tr>
						<tr>
						   <td style='text-align:left; font-size:8pt; font-weight:bold; width:150px'>Triwulan II</td>
						   <td style='text-align:right; font-size:8pt; font-weight:0; width:150px'>Rp $triwulan_2</td>
						   <td style='text-align:center; font-size:8pt; font-weight:bold; width:500px'></td>
						</tr>
						<tr>
						   <td style='text-align:left; font-size:8pt; font-weight:bold; width:150px'>Triwulan III</td>
						   <td style='text-align:right; font-size:8pt; font-weight:0; width:150px'>Rp $triwulan_3</td>
						   <td style='text-align:center; font-size:8pt; font-weight:bold; width:500px'></td>
						</tr>
						<tr>
						   <td style='text-align:left; font-size:8pt; font-weight:bold; width:150px'>Triwulan IIV</td>
						   <td style='text-align:right; font-size:8pt; font-weight:0; width:150px'>Rp $triwulan_4</td>
						   <td style='text-align:center; font-size:8pt; font-weight:bold; width:500px'></td>
						</tr>
						<tr>
						   <td style='text-align:left; font-size:8pt; font-weight:bold; width:150px'>Jumlah</td>
						   <td style='text-align:right; font-size:8pt; font-weight:0; width:150px'><hr size='90' width='100%'/>Rp $total_triwulan</td>
						   <td style='text-align:center; font-size:8pt; font-weight:bold; width:500px'>$laporan_pimpinan<hr size='90' width='50%'/>NIP. $laporan_nip</td>
						</tr>
					</table>";
				}
				
			} else if ($laporan_kegiatan == semua){

			} else {
			
			}

	// batas	

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
					
			$query_tim = $this->db->query("SELECT *
			FROM tim_anggaran
			WHERE tim_anggaran.kode_tim= '1'
			GROUP BY tim_anggaran.kode ORDER BY tim_anggaran.kode ASC");
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
						<th style='text-align:left; font-size:6pt; font-weight:0; width:200px height:40px;'>- Penetapan dan perhitungan biaya serta penggunaan dana yang tertuang dalam DPA SKPD<br>&nbsp; merupakan tanggung jawab pengguna anggaran/kuasa pengguna anggaran</th>
						<th style='text-align:left; width:200px'></th>
					</tr></table>";
	
$mpdf=new mPDF( '',                          // mode (default '')
                'A4', 0, '',               // format ('A4', '' or...), font size(default 0), font family
                5, 5, 5, 20, 5, 5,  //(margins) left, right, top, bottom, HEADER, FOOTER
                'L');
$mpdf->WriteHTML($strhtml0);
$mpdf->AddPage('');

$mpdf->SetFooter('
<div class="satu"></div>
<table style="font-family: serif; font-size:5pt; border:1px solid #000;"><tr>
<th style="text-align:left; font-weight:0; border:1px solid #000; valign="top" width:50px">Formulir DPA SKPD 2.2.1 - '.$skpd.' <br>Tim Verivikasi</th>
<th style="text-align:left; font-weight:0; border:1px solid #000; width:50px">BAPPEDA</th>
<th style="text-align:left; font-weight:0; border:1px solid #000; width:50px">Pembangunan</th>
<th style="text-align:left; font-weight:0; border:1px solid #000; width:50px">BPKAD</th>
<th style="text-align:left; font-weight:0; border:1px solid #000; width:50px">Perlengkapan</th>
<th style="text-align:left; font-weight:0; border:1px solid #000; width:50px">Organisasi</th>
<th style="text-align:left; font-weight:0; border:1px solid #000; width:50px">Koordinator</th>
<th style="text-align:left; font-weight:0; border:1px solid #000; width:50px">BAPPEDA</th>
<th style="text-align:left; font-weight:0; border:1px solid #000; width:50px">BPKAD</th>
<th style="text-align:left; font-weight:0; border:1px solid #000; width:60px">Halaman {PAGENO} <br> dari {nbpg}</th>
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