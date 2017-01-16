<div class="col-md-8" id="formedit">
    <form class="form-horizontal" method="post">
    <fieldset>

    <!-- Form Name -->
    <legend>Edit Data</legend>

    <!-- Text input-->
    <div class="form-group">
      <label class="col-md-4 control-label" for="nama">Nama</label>
      <div class="col-md-8">
      <input id="nama" name="nama" placeholder="" class="form-control input-md" type="text" value="<?php echo $jenis[0]->nm_rek_3;?>">
      <input id="idform" type="input" value="<?php echo $jenis[0]->kode;?>">	  
	  <?php $saldo_ = $jenis[0]->saldo_normal;?>
      </div>
    </div>

    <!-- Select Basic -->
    <div class="form-group">
      <label class="col-md-4 control-label" for="jk">Jenis Kelamin</label>
      <div class="col-md-8">	  
		<?php combobox('db', $saldo, 'eee_kode', 'saldo_normal', 'saldo_normal', $saldo_, '', 'Pilih Tahun Anggaran', 'class="form-control show-tick" data-live-search="true" tabindex="1" required');?>
      </div>
    </div>
    <div class="form-group">
          <div class="col-lg-10 col-lg-offset-2">            
            <button type="button" class="btn btn-primary" name="editdata_btn" id="editdata_btn">Submit</button>
			<button type="reset" class="btn btn-default">Cancel</button>
          </div>
        </div>
    </fieldset>
    </form>
</div>
