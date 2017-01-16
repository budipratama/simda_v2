<?php foreach($mahasiswa as $baris): ?>
<form id='formmahasiswa'>
<div>
    <label>Nim</label>
    <input type="text" name="nim" id="nim" size="30" value="<?php echo $baris->nim ?>">
</div>
<div>
    <label>Nama</label>
    <input type="text" name="nama" id="nama" size="30" value="<?php echo $baris->nama ?>">
</div>

		<div style="width: 300px; padding: 15px">            
            <div class="form-group">
                <label>Jurusan</label>
				
				<input type="text" size="30" value="<?php echo $baris->jurusan ?>">
				
                <select id="jurusan" name="jurusan[]" class="form-control">
                    <option value=""></option>
                    <option value="komputer">Komputer</option>
                    <option value="ekonomi">Ekonomi</option>
                </select>
					
            </div>
        </div>

<div>
    <label>Angkatan</label>
    <input type="text" name="angkatan" id="angkatan" size="30" value="<?php echo $baris->angkatan ?>">
</div>
<div>
    <label>IPK</label>
    <input type="text" name="ipk" id="ipk" size="30" value="<?php echo $baris->ipk ?>">
</div>
</form>
<?php endforeach ?>