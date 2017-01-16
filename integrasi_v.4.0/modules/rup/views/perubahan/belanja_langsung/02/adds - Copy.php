<!-- Main Content -->
   <section class="content">
		<h2>RKA Murni<small> entri data &amp; informasi detail</small></h2>  
			<div class="body">
				<ol class="breadcrumb breadcrumb-col-cyan">
					<li><a href="<?php echo site_url('dashboard');?>"><i class="material-icons">home</i> Home</a></li>
					<li><a href="<?php echo site_url('rka/murni');?>"> RKA</a></li>
					<li class="active"> Add Sub Rincian Belanja</li>
				</ol>
			</div>
            <!-- Multiple Items To Be Open -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
							<p align="center"><b><?php echo strtoupper($skpd_);?></b></p>
							<p class="control-label col-md-10">Program &nbsp;:&nbsp; <?php echo $program_?></p>
							<p class="control-label col-md-10">Kegiatan &nbsp;:&nbsp; <?php echo $kegiatan; ?></p>
							<p class="control-label col-md-10">Rekening :&nbsp; <?php echo $rka->id_akun;?>.<?php echo $rka->id_kelompok;?>.<?php echo $rka->id_jenis;?>.<?php echo $rka->id_obyek;?>.<?php echo $rka->id_rincian;?> <?php echo $rka->nama_rincian;?></p>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <button type="button" class="btn bg-black waves-effect waves-light">ACTIONS</button>
                                    </a>
                                    <ul class="dropdown-menu pull-right">                                     
                                        <li><a title="Kembali" href="<?php echo base_url(); ?>rka/murni/rincian/<?php echo $bl->task_id;?>"><i class="material-icons">reply</i> Kembali</a></li>
                                    </ul>
                                </li>
                            </ul>
							<div class="panel-body"></div>
                        </div>
                        <div class="body">
                            <div class="row clearfix">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <!-- Nav tabs -->
                                    <ul class="nav nav-tabs tab-nav-right" role="tablist">
                                        <li><a href="javascript:void(0);">Belanja</a></li>
                                        <li><a href="javascript:void(0);">Rincian Belanja</a></li>
                                        <li role="presentation" class="active"><a href="#home_animation_2" data-toggle="tab">Sub Rincian Belanja</a></li>
                                    </ul>
                                    <!-- Tab panes -->									
									<div class="body">
										<div class="row clearfix">
										<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
										
										
										<form action="<?php echo site_url('rka/murni/adds');?>" class="form-horizontal" method="post" name="autoSumForm" onSubmit="return validasi()"><br>
					<input type="hidden" value="<?php printf( "%01d", $bls->no++ ); ?>" />
					<input type="hidden" name="id_kode" id="id_kode" value="<?php echo $rincian->rka; ?>" />
					<input type="hidden" name="kode" id="kode" value="<?php echo $rincian->kode; ?>" />
					<input type="hidden" name="rincian_kode" id="id_kode" value="<?php echo $rincian->anggaran_kode; ?>" />
						<div role="tabpanel" class="tab-pane fade in active" id="step1" aria-labelledby="home-tab">
							<div class="portlet-body">
							<table class="table table-striped table-bordered table-hover" width="50%" cellspacing="5" cellpadding="5">
								<tr>
								<th style="text-align:center; width:100px">No</th>
								<th style="text-align:center;">Uraian</th>
								</tr>
									<ul>
										<tr>
										<td><input type="text" class="form-control" name="no_kode" value="<?php printf( "%01d", $bls->no ); ?>" placeholder="Kode ..." readonly="readonly"></td>
										<td><input type="text" class="form-control" name="aaa_kode" placeholder="Enter text here ..." required="required"></td>
										</tr>
									</ul>
							</table>
						<br><div class="form-group">
						<div class="col-md-5">
						<div class="form-group" id="">
							<label class="control-label col-md-4" for="bbb_kode">Harga Satuan Rp. </label>
							<div class="col-md-5">
							<input type="text" class="form-control" name="bbb_kode" maxlength="16" id="satuan" style="text-align:right;" onkeypress="return isNumber(event)" onkeyup="totalSum()" placeholder="0" required="required">
							</div>
						</div>
						</div>
					</div>				
					
					<div class="form-group">
						<div class="col-md-5">
						<div class="form-group">
							<label class="control-label col-md-7" for="ccc_kode">Volume 1 :</label>
							<div class="col-md-5">
							<input type="text" class="form-control" name="firstBox" onFocus="startCalc();" onBlur="stopCalc();" maxlength="16" id="volume1" style="text-align:right;" onkeypress="return isNumber(event)" onkeyup="totalSum()" placeholder="0" required="required">
							</div>
						</div>
						</div>						
						<div class="col-md-7">
						<div class="form-group">
							<label class="control-label col-md-2" for="ddd_kode">Satuan 1 :</label>
							<div class="col-md-4">
							<input type="input" class="form-control" maxlength="40" id="userInput1" onkeyup="showMsg()" placeholder="-">
							</div>
						</div>
						</div>
					</div>
					
					<div class="form-group">
						<div class="col-md-5">
						<div class="form-group">
							<label class="control-label col-md-7" for="eee_kode">Volume 2 :</label>
							<div class="col-md-5">
							<input type="text" class="form-control" name="secondBox" onFocus="startCalc();" onBlur="stopCalc();" maxlength="16" id="volume2" style="text-align:right;" onkeypress="return isNumber(event)" onkeyup="totalSum()" placeholder="0">
							</div>
						</div>
						</div>						
						<div class="col-md-7">
						<div class="form-group">
							<label class="control-label col-md-2" for="fff_kode">Satuan 2 :</label>
							<div class="col-md-4">
							<input type="input" class="form-control" maxlength="40" id="userInput2" onkeyup="showMsg()" placeholder="-">
							</div>
						</div>
						</div>
					</div>
					
					<div class="form-group">
						<div class="col-md-5">
						<div class="form-group">
							<label class="control-label col-md-7" for="ggg_kode">Volume 3 :</label>
							<div class="col-md-5">
							<input type="text" class="form-control" name="lastBox" onFocus="startCalc();" onBlur="stopCalc();" maxlength="16" id="volume3" style="text-align:right;" onkeypress="return isNumber(event)" onkeyup="totalSum()" placeholder="0">
							</div>
						</div>
						</div>						
						<div class="col-md-7">
						<div class="form-group">
							<label class="control-label col-md-2" for="hhh_kode">Satuan 3 :</label>
							<div class="col-md-4">
							<input type="input" class="form-control" maxlength="40" id="userInput3" onkeyup="showMsg()" placeholder="-">
							</div>
						</div>
						</div>
					</div>
					
					<div class="form-group">
						<div class="col-md-5">
						<div class="form-group" id="">
							<label class="control-label col-md-4" for="thirdBox"><strong>Satuan :</strong></label>
							<div class="col-md-8">
							<input type="hidden" id="sumberlain" onkeyup="totalAsumsi()">
							<input type="text" class="form-control" name="thirdBox" id="thirdBox" style="text-align:right;font-weight:bold;" placeholder="0" readonly="readonly">
							</div>
						</div>
						</div>
					</div>
					
					<div class="form-group">
						<div class="col-md-5">
						<div class="form-group" id="">
							<label class="control-label col-md-4" for="userMsg"><strong>Volume :</strong></label>
							<div class="col-md-8">
							<input type="text" class="form-control" name="userMsg" id="userMsg" style="text-align:left;font-weight:bold;" placeholder="-" readonly="readonly">
							</div>
						</div>
						</div>
					</div>
					
					<div class="form-group">
						<div class="col-md-5">
						<div class="form-group" id="">
							<label class="control-label col-md-4" for="total_sum"><strong>Total :</strong></label>
							<div class="col-md-8">
							<input type="text" class="form-control" name="total_sum" id="total_sum" style="text-align:right;font-weight:bold;" placeholder="0" readonly="readonly">
							<input type="text" class="form-control" id="total_sum1" style="text-align:right;font-weight:bold;" placeholder="0" readonly="readonly">
							</div>
						</div>
						</div>
					</div>
							<div class="form-group">
								<div class="col-md-offset-9">
									<button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Simpan</button>
									<a href="<?php echo base_url(); ?>rka/murni/sub/<?php echo $rincian->kode; ?>" class="btn btn-default"><i class="fa fa-times"></i> Batal</a>
								</div>
							</div>
							</div>
						</div>
					</form>
										
										
										
										</div>
										</div>
									</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Tabs With Custom Animations -->
        </div>
    </section>
<!-- END CONTENT -->
<script>
function totalSum(){
		var satuan 			= document.getElementById("satuan").value || 1;
		var volume1 		= document.getElementById("volume1").value || 1;
		var volume2 		= document.getElementById("volume2").value || 1;
		var volume3 		= document.getElementById("volume3").value || 1;
		var result 			= parseInt(satuan) * parseInt(volume1) * parseInt(volume2) * parseInt(volume3);
		document.getElementById("total_sum1").value = tandaPemisah(result);
		document.getElementById("total_sum").value = result;
	}
	
function tandaPemisah(b){
		var _minus = false;
		if (b<0) _minus = true;
		b = b.toString();
		b=b.replace(".","");
		b=b.replace("-","");
		c = "";
		panjang = b.length;
		j = 0;
		for (i = panjang; i > 0; i--){
			 j = j + 1;
			 if (((j % 3) == 1) && (j != 1)){
			   c = b.substr(i-1,1) + "." + c;
			 } else {
			   c = b.substr(i-1,1) + c;
			 }
		}
		if (_minus) c = "-" + c ;
		return c;
	}
</script>

<script type="text/javascript">
function startCalc(){
  interval = setInterval("calc()",1);
}
function calc(){
  one = document.autoSumForm.firstBox.value;
  two = document.autoSumForm.secondBox.value;
  tree = document.autoSumForm.lastBox.value;
  document.autoSumForm.thirdBox.value = (one * 1) + (two * 1) + (tree * 1);
}
function stopCalc(){
  clearInterval(interval);
}
</script>

<script type="text/javascript">
function showMsg(){
	var userInput1 = document.getElementById('userInput1').value;
	var userInput2 = document.getElementById('userInput2').value;
	var userInput3 = document.getElementById('userInput3').value;
		document.getElementById('userMsg').value = userInput1 + userInput2 + userInput3;
}
</script>
<script>
    function validasi(){
        var satuan = autoSumForm.thirdBox.value;
        var volume = autoSumForm.userMsg.value;
        var total = autoSumForm.total_sum.value;
        var pesan = '';
        if (satuan == '') { pesan += '- Satuan \n'; }
        if (volume == '') { pesan += '- Volume \n'; }
        if (total == '') { pesan += '- Total \n'; }
        if (pesan != '') { alert('Data Tidak Boleh Kosong : \n'+pesan); return false; }
    return true }
</script>