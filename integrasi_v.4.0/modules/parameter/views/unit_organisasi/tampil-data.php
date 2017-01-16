<table class="table table-condensed table-bordered table-hover">
<tr>
  <th>NIS</th>
  <th>Tahun</th>
  <th>Action</th>
</tr>

<?php
  $nilai = $_POST['nilai'];
	$query= "select nm_urusan, tahun from ms_urusan where tahun=$nilai";
    $konversi = mysql_query($query);
echo "<div id='deskripsi'>Data untuk nilai $nilai</div>";
while($hasil = mysql_fetch_array($konversi))
{
    $nis = $hasil['nm_urusan'];
    $tahun = $hasil['tahun'];    
?>
<tr>
     <td><?php echo $nis; ?></td>
     <td><?php echo $tahun; ?></td>
     <td>
     	<a href="#kotakdialog" data-toggle="modal" class="ubah" id="<?php echo $nis;?>"><i class="icon-pencil"></i></a>
     	<a href="#" class="hapus" id="<?php echo $nis; ?>"><i class="icon-trash"></i></a>
     </td>
    </tr>

<?php } ?>
</table>