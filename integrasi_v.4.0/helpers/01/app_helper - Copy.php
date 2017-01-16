<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('combobox'))
{
	function combobox($jenis='', $query, $name, $value, $name_value, $pilihan, $js='', $label='', $script=''){
		echo '<select name="'.$name.'" id="'.$name.'" data-placeholder="'.$label.'" onchange="'.$js.'" '.$script.'>';
		if ($label != "none"){
			echo "<option value=''>".$label."</option>";
		}
		
		if (empty($jenis) || $jenis == "db"){			
			foreach ($query as $row){
				if ($pilihan == $row->$value){
					echo "<option value='".$row->$value."' selected>".$row->$name_value."</option>";
				} else {
					echo "<option value='".$row->$value."'>".$row->$name_value."</option>";
				}
			}
		} elseif ($jenis == "1d"){
			foreach ($query as $row){
				if ($pilihan == $row){
					echo "<option value='".$row."' selected>".$row."</option>";
				} else {
					echo "<option value='".$row."'>".$row."</option>";
				}
			}
		} elseif ($jenis == "2d"){
			foreach ($query as $row_key => $row_value){
				if ($pilihan == $row_key){
					echo "<option value='".$row_key."' selected>".$row_value."</option>";
				} else {
					echo "<option value='".$row_key."'>".$row_value."</option>";
				}
			}
		}
		echo "</select>";
	}
}


if ( ! function_exists('radiolist'))
{
	function radiolist($query, $name, $value, $name_value, $pilihan='', $js='', $label='', $script=''){
		foreach ($query as $row){
			if ($pilihan == $row->$value){
				echo "<label class='radio-inline'>";
				echo "<input type='radio' name='".$name."' id='".$row->$value."' value='".$row->$value."' ".$script." checked> ".$row->$name_value." </label>";
			} else {
				echo "<label class='radio-inline'>";
				echo "<input type='radio' name='".$name."' id='".$row->$value."' value='".$row->$value."' ".$script."> ".$row->$name_value." </label>";
			}
		}
	}
}

if ( ! function_exists('upload_image_thumb'))
{
	function upload_image_thumb($file, $direktori, $filesize="", $nama_baru="", $allowed="")
	{
		$lokasi_file    	= $_FILES[$file]['tmp_name'];
		$tipe_file      	= $_FILES[$file]['type'];
		$nama_file      	= seo($_FILES[$file]['name']);
		$timestamp 			= explode(" ",microtime());
		$currenttimemilis 	= round(($timestamp[0]*1000000) + ($timestamp[1]*1000));
		$str_shuffle		= str_shuffle($currenttimemilis);

		if($tipe_file == "image/jpeg") {
			$ekstensi	= 'jpg';
		} elseif($tipe_file == "image/png") {
			$ekstensi	= 'png';
		} elseif($tipe_file == "image/gif") {
			$ekstensi	= 'gif';
		} else {
			$ekstensi	= 'jpg';
		}
		
		if ($nama_baru){
			$ori_src		= $direktori . $currenttimemilis .'_'. $nama_baru .'.'. $ekstensi;
		} else {
			$ori_src		= $direktori . $currenttimemilis . '' . $str_shuffle . '.' . end(explode(".", basename($nama_file)));
		} 
		
		if (!empty($lokasi_file)){
			if(move_uploaded_file($lokasi_file, $ori_src)){
				chmod("$ori_src", 0777);
			}
			if ($filesize != "") {
				if ($nama_baru) {
					$thumb_src = $direktori . $currenttimemilis .'_'. $nama_baru .'.'. $ekstensi;
				} else {
					$thumb_src = $direktori . $currenttimemilis . '' . $str_shuffle . '.' . end(explode(".", basename($nama_file)));
				}						
				
				ini_set('memory_limit', '-1');
				if($tipe_file == "image/jpeg") {
					$im = imagecreatefromjpeg($ori_src);
				} elseif($tipe_file == "image/png") {
					$im = imagecreatefrompng($ori_src);
				} elseif($tipe_file == "image/gif") {
					$im = imagecreatefromgif($ori_src);
				} else {
					$im = false;
				}

				$width	= imageSX($im);
				$height	= imageSY($im);
				
				$size		= explode("x", $filesize);
				$max_width	= $size[0];
				$max_height	= $size[1];
				
				if ($width > $max_width || $height > $max_height){
					$ratio1	= $width/$max_width;
					$ratio2	= $height/$max_height;
					if($ratio1 > $ratio2) {
						$n_width	= $max_width;
						$n_height	= $height/$ratio1;
					} else {
						$n_height	= $max_height;
						$n_width	= $width/$ratio2;
					}
						
		
					if($im === false) {
						echo '<p>Gagal membuat thumnail</p>';
						exit;
					} elseif($tipe_file == "image/png"){
						$newimage = imagecreatetruecolor($n_width,$n_height);                 
						$bg = imagecolorallocate($newimage, 255, 255, 255);
						imagefill($newimage, 0, 0, $bg);
						
						imagecopyresampled($newimage, $im, 0, 0, 0, 0, $n_width, $n_height, $width, $height);										
						imagejpeg($newimage, $thumb_src);
						chmod("$thumb_src", 0777);
					} else {				
						$newimage = imagecreatetruecolor($n_width,$n_height);                 
						imagecopyresampled($newimage, $im, 0, 0, 0, 0, $n_width, $n_height, $width, $height);
						imagejpeg($newimage, $thumb_src);
						chmod("$thumb_src", 0777);
					}
				}
			}
				
			if ($nama_baru){
				return $currenttimemilis .'_'. $nama_baru .'.'. $ekstensi;
			} else {
				return $currenttimemilis . '' . $str_shuffle . '.' . end(explode(".", basename($nama_file)));;
			}
		} else {			
			return '';
		}
	}
}

if ( ! function_exists('upload_file'))
{
	function upload_file($file, $direktori)
	{
		$lokasi_file    	= $_FILES[$file]['tmp_name'];
		$tipe_file      	= $_FILES[$file]['type'];
		$timestamp 			= explode(" ",microtime());
		$currenttimemilis 	= round(($timestamp[0]*1000000) + ($timestamp[1]*1000));
		$str_shuffle		= str_shuffle($currenttimemilis);
		$nama_file     		= $currenttimemilis . $str_shuffle . '_' . seo($_FILES[$file]['name']);
		
		if (!empty($lokasi_file)){
			move_uploaded_file($lokasi_file, $direktori . $nama_file);
			return $nama_file;
		} else {
			return "";
		}
	
	}
}

if ( ! function_exists('seo'))
{
	function seo($s) {
		$c = array (' ');
		$d = array ('--','/','\\',',','#',':',';','\'','"','[',']','{','}',')','(','|','`','~','!','@','%','$','^','&','*','=','?','+');
	
		$s = str_replace($d, '', $s);
		
		$s = strtolower(str_replace($c, '-', $s));
		return $s;
	}
}

if ( ! function_exists('file_get_content'))
{
	function file_get_content($src){
		return base64_encode(file_get_contents($src));
	}
}

if ( ! function_exists('file_put_content'))
{
	function file_put_content($dst, $src){
		return file_put_contents($dst, base64_decode($src));
	}
}

if ( ! function_exists('get_server_status'))
{
	function get_server_status($site="", $port="80")
	{
		$fp = @fsockopen($site, $port, $errno, $errstr, 2);
		if (!$fp) {
			return false;
		} else {
			return true;
		}
	}
}

if ( ! function_exists('parseurl'))
{
	function parseurl($url="", $param="host")
	{
		if ($url){
			$parse = parse_url($url);
			return $parse[$param];
		} else {
			return "";
		}
	}
}

if ( ! function_exists('rupiah'))
{
	function rupiah($nilai){
		$rupiah = number_format(ceil($nilai), 0, ',', '.');
		return "Rp".$rupiah;
	}	
}

if ( ! function_exists('rupiah2'))
{
	function rupiah2($nilai){
		$rupiah = number_format(ceil($nilai), 0, ',', '.');
		return $rupiah;
	}
}

if ( ! function_exists('rupiah3'))
{
	function rupiah3($nilai){
		return $nilai;
	}
}

if ( ! function_exists('get_buttons'))
{
	function get_buttons($id)
	{
		$ci= & get_instance();
		$ci->load->helper('url');
		$html  = '<center><a href="'. site_url($ci->uri->segment(1) . '/' . $ci->uri->segment(2) . '/detail/'.$id) .'" class="btn btn-sm btn-info" title="Detail"><i class="fa fa-file-text"></i></a>';
		$html .= '<a href="'. site_url($ci->uri->segment(1) . '/' . $ci->uri->segment(2) . '/edit/'.$id) .'" class="btn btn-sm btn-warning" title="Ubah"><i class="fa fa-pencil"></i></a>';
		$html .= '<a href="'. site_url($ci->uri->segment(1) . '/' . $ci->uri->segment(2) . '/delete/'.$id) .'" class="btn btn-sm btn-danger" data-placement="left" onclick="return confirm(\'Apakah anda yakin? \nAkan menghapus data rencana kerja ini.\');"><i class="fa fa-trash-o"></i></a>';
		
		return $html;
	}
}

if ( ! function_exists('jam_sekarang'))
{
	function jam_sekarang()
	{
		date_default_timezone_set('Asia/Jakarta');
		return date("H:i:s");
	}
}

if ( ! function_exists('waktuSekarang'))
{
	function waktuSekarang()
	{
		date_default_timezone_set('Asia/Jakarta');
		return date("Y-m-d H:i:s");
	}
}

if ( ! function_exists('hari_ini'))
{
	function hari_ini()
	{
		date_default_timezone_set('Asia/Jakarta');
		$seminggu = array("Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu");
		$hari = date("w");
		$hari_ini = $seminggu[$hari];
		return $hari_ini;
	}
}

if ( ! function_exists('dateIndo'))
{
	function dateIndo($tgl='')
	{
		$waktu 	= substr ($tgl,11,5);
		$tanggal = substr ($tgl,8,2);
		$bulan = getBulan(substr($tgl,5,2));
		$tahun = substr ($tgl,0,4);
		return $tanggal . ' ' . $bulan . ' ' . $tahun . ' ' . $waktu;
	}
}

if ( ! function_exists('getBulan'))
{
	function getBulan($bulan='')
	{
		switch ($bulan){
			case 1:
				return "Januari";
				break;
			case 2:
				return "Februari";
				break;
			case 3:
				return "Maret";
				break;
			case 4:
				return "April";
				break;
			case 5:
				return "Mei";
				break;
			case 6:
				return "Juni";
				break;
			case 7:
				return "Juli";
				break;
			case 8:
				return "Agustus";
				break;
			case 9:
				return "Septembet";
				break;
			case 10:
				return "Oktober";
				break;
			case 11:
				return "November";
				break;
			case 12:
				return "Desember";
				break;
		}
	}
}

if ( ! function_exists('dateIndo2'))
{
	function dateIndo2($tgl='')
	{
		$waktu 	= substr ($tgl,11,5);
		$tanggal = substr ($tgl,8,2);
		$bulan = substr($tgl,5,2);
		$tahun = substr ($tgl,0,4);
		return $tanggal . '/' . $bulan . '/' . $tahun . ' ' . $waktu;
	}
}

if ( ! function_exists('dateIndo3'))
{
	function dateIndo3($tgl='')
	{
		$tanggal = substr($tgl,0,2);
		$bulan = substr($tgl,3,2);
		$tahun = substr ($tgl,6,4);
		return $tahun . '-' . $bulan . '-' . $tanggal;
	}
}

if ( ! function_exists('dateIndo4'))
{
	function dateIndo4($tgl='')
	{
		$tanggal = substr($tgl,8,2);
		$bulan = substr($tgl,5,2);
		$tahun = substr ($tgl,0,4);
		return $tanggal . '-' . $bulan . '-' . $tahun;
	}
}

if ( ! function_exists('getHeader'))
{
	function getHeader($param='value')
	{
		$CI =& get_instance();
		$header_key = $CI->config->item('api_name');
			
		$header = apache_request_headers();
		$header_value = "";
		foreach ($header as $key => $value){
			if ($key == $header_key){
				$header_value = $value;
			}
		}
		
		if ($param == 'value'){
			return $header_value;
		} else {
			return $header_key;
		}
	}
}

if ( ! function_exists('nomorKegiatan'))
{
	function nomorKegiatan($skpd='', $tahun='', $tahapan='', $tipe='', $inc='0')
	{
		$skpd_ 		= str_pad($skpd, 4, "0", STR_PAD_LEFT);
		$tahun_ 	= str_pad($tahun, 4, "0", STR_PAD_LEFT);
		$tahapan_ 	= str_pad($tahapan, 2, "0", STR_PAD_LEFT);
		$tipe_ 		= str_pad($tipe, 1, "0", STR_PAD_LEFT);
		$inc_ 		= str_pad($inc, 5, "0", STR_PAD_LEFT);
		return $skpd_ . $tahun_ . $tahapan_ . $tipe_ . $inc_;
	}
}