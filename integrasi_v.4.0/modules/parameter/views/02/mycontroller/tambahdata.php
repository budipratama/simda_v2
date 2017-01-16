<div class="col-md-8" id="formtambah">
<form class="form-horizontal" method="post">
<fieldset>

<!-- Form Name -->
<legend>Tambah Data</legend>

<?php combobox('db', $tahun, 'tahun', 'tahun', 'tahun', $tahun_1, '', 'Pilih Tahun Anggaran', 'class="form-control show-tick" data-live-search="true" tabindex="1"');?>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="nama">Nama</label>
  <div class="col-md-8">
  <input id="nama" name="nama" placeholder="" class="form-control input-md" required="" type="text">

  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="tlpn">No Tlpn</label>
  <div class="col-md-8">
  <input id="tlpn" name="tlpn" placeholder="" class="form-control input-md" required="" type="text">

  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="alamat">Alamat</label>
  <div class="col-md-8">
  <input id="alamat" name="alamat" placeholder="" class="form-control input-md" required="" type="text">

  </div>
</div>

<!-- Select Basic -->
<div class="form-group">
  <label class="col-md-4 control-label" for="jk">Jenis Kelamin</label>
  <div class="col-md-8">
    <select id="jk" name="jk" class="form-control">
      <option value="laki-laki">Laki Laki</option>
      <option value="perempuan">Perempuan</option>
    </select>
  </div>
</div>
<div class="form-group">
      <div class="col-lg-10 col-lg-offset-2">
        <button type="reset" class="btn btn-default">Cancel</button>
        <button type="button" class="btn btn-primary" name="tambahdata_btn" id="tambahdata_btn">Submit</button>

      </div>
    </div>
</fieldset>
</form>
</div>
