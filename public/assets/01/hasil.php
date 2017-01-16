<?php 
$host="localhost";
$user="root";
$pass="";
$database="integrasi_db";
$koneksi=new mysqli($host,$user,$pass,$database);

		$modal_id = $_POST['id']; 
		$modal=mysqli_query($koneksi,"SELECT * FROM ms_rek_1 WHERE kode='$modal_id'");
		while($r=mysqli_fetch_array($modal)){ }

$query_jumlah = mysqli_query($koneksi,"SELECT * FROM ms_rek_1 WHERE kode='$modal_id'");
$data = mysqli_fetch_array($query_jumlah); 

echo $_POST['id'];
echo $data['nm_rek_1'];  
?>
