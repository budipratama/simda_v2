<?php
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
			   <td style='text-align:center; border:1px solid #000; width:150px'>Harga</td>
			</tr>
		   </table>";
			
		$strhtml .= "<table style='font-family: serif; font-size:11pt; border:1px solid #000;'>
			<tr>
				<th style='text-align:center; border:1px solid #000; width:150px'>1</th>
				<th style='text-align:center; border:1px solid #000; width:500px'>2</th>
				<th style='text-align:center; border:1px solid #000; width:150px'>3</th>
				<th style='text-align:center; border:1px solid #000; width:150px'>4</th>
				<th style='text-align:center; border:1px solid #000; width:150px'>5</th>
				<th style='text-align:center; border:1px solid #000; width:150px'>6</th>
			</tr>
			</table>";
			
		$strhtml .= "<table style='font-family: serif; border:1px solid #000;'>
			<tr>
				<th style='text-align:left; font-size:12pt; font-weight:0; border:1px solid #000; width:150px'>5</th>
				<th style='text-align:left; font-size:12pt; border:1px solid #000; width:500px'>BELANJA</th>
				<th style='text-align:right; font-size:12pt; border:1px solid #000; width:600px'>$rupiah</th>
			</tr>
			<tr>
				<th style='text-align:left; font-size:12pt; font-weight:0; border:1px solid #000; width:150px'>5.2</th>
				<th style='text-align:left; font-size:12pt; border:1px solid #000; width:500px'>BELANJA LANGSUNG</th>
				<th style='text-align:right; font-size:12pt; border:1px solid #000; width:600px'>$rupiah</th>
			</tr>
			</table>";
			
$mpdf->WriteHTML($strhtml);
$mpdf->AddPage('');
$mpdf->WriteHTML($strhtml2);
$mpdf->Output('');
?>