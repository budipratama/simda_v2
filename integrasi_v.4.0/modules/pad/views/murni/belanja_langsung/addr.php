<!-- Main Content -->
<?php $query_jumlah = mysql_query("SELECT SUM(total) as total FROM rka_padrinc WHERE rka_padrinc.tipe_kode= '1' AND rka_padrinc.rka_pad='".$rincian->task_id."' ORDER BY rka_padrinc.kode ASC"); 
$data = mysql_fetch_array($query_jumlah); $jumlah = $data[total]; ?>
   <section class="content">
		<h2>Pendapatan Asli Daerah Murni<small> entri data &amp; informasi detail</small></h2>  
			<div class="body">
				<ol class="breadcrumb breadcrumb-col-cyan">
					<li><a href="<?php echo site_url('dashboard');?>"><i class="material-icons">home</i> Home</a></li>
					<li><a href="<?php echo site_url('pad/murni');?>"> PAD</a></li>
					<li class="active"> Murni</li>
				</ol>
			</div>	
            <!-- Multiple Items To Be Open -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
							<p align="center"><b><?php echo strtoupper($pad->nama_skpd);?></b></p>
							<p class="control-label col-md-10">Program &nbsp;:&nbsp; Non Program</p><p align="right"><b>.</b></p>
							<p class="control-label col-md-10">Kegiatan &nbsp;:&nbsp; Non Kegiatan</p><p align="right"><b>Jumlah</b></p>
                            <p class="control-label col-md-10">Rekening :&nbsp; <?php echo $pad->id_akun;?>.<?php echo $pad->id_kelompok;?>.<?php echo $pad->id_jenis;?>.<?php echo $pad->id_obyek;?>.<?php echo $pad->id_rincian;?> <?php echo $pad->nama_rincian;?></p><p align="right"><b><?php echo rupiah($jumlah);?></b></p>
							<ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <button type="button" class="btn bg-black waves-effect waves-light">ACTIONS</button>
                                    </a>
                                    <ul class="dropdown-menu pull-right">                                     
                                        <li><a title="Kembali" href=""><i class="material-icons">reply</i> Kembali</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <div class="row clearfix">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <!-- Nav tabs -->
                                    <ul class="nav nav-tabs tab-nav-right" role="tablist">
                                        <li><a href="javascript:void(0);">PAD</a></li>
                                        <li role="presentation" class="active"><a href="#home_animation_2" data-toggle="tab">Rincian PAD</a></li>
                                    </ul>
                                    <!-- Tab panes -->
									<div class="body">
										<div class="row clearfix">
										<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
										<?php echo validation_errors(); ?><?php if ($this->session->flashdata('success')) { echo $this->session->flashdata('success');} ?>
											<form action="<?php echo site_url('pad/murni/addr');?>" id="form_validation" class="form-horizontal" method="post" name="autoSumForm" onSubmit="return validasi()"><br>
											<input type="hidden" value="<?php printf( "%01d", $blr->no++ );?>"/>
											<input type="hidden" name="id_kode" id="id_kode" value="<?php echo $pad->task_id;?>"/>
												<div role="tabpanel" class="tab-pane fade in active" id="step1" aria-labelledby="home-tab">
													<div class="portlet-body">
													<table class="table table-striped table-bordered table-hover" width="50%" cellspacing="5" cellpadding="5">
														<tr>
														<th style="text-align:center; width:100px">No</th>
														<th style="text-align:center;">Uraian</th>
														</tr>
															<ul>
																<tr>
																<td><input type="text" class="form-control" name="no_kode" value="<?php printf( "%01d", $blr->no ); ?>" placeholder="Kode ..." readonly="readonly"></td>
																<td><input type="text" class="form-control" name="aaa_kode" placeholder="Enter text here ..." required="required"></td>
																</tr>
															</ul>
													</table>
													<div class="body">
													<div class="row clearfix">
														<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
															<div class="row clearfix">
																<div class="col-md-6">
																<div class="form-group form-float">
																	<div class="form-line">
																		<input type="text" class="form-control" name="bbb_kode" id="satuan" maxlength="16" style="text-align:right;" onkeypress="return isNumber(event)" onkeyup="totalSum()" placeholder="0" required="required">
																		<label class="form-label" for="bbb_kode">Harga Satuan Rp.</label>
																	</div>
																</div>
																</div>
															</div>
															<div class="row clearfix"><div class="col-md-6"></div></div>
															<div class="row clearfix">
																<div class="col-md-6">
																<div class="form-group form-float">
																	<div class="form-line">
																		<input type="text" class="form-control" name="firstBox" onFocus="startCalc();" onBlur="stopCalc();" maxlength="16" id="volume1" style="text-align:right;" onkeypress="return isNumber(event)" onkeyup="totalSum()" placeholder="0" required="required">
																		<label class="form-label" for="volume1">Volume 1 :</label>
																	</div>
																</div>
																</div>
																<div class="col-md-6">
																<div class="form-group form-float">
																	<div class="form-line">
																		<input type="input" class="form-control" maxlength="40" id="userInput1" style="text-align:right;" onkeyup="showMsg()" placeholder="-" required="required">
																		<label class="form-label" for="ddd_kode">Satuan 1 :</label>
																	</div>
																</div>
																</div>
															</div>
															<div class="row clearfix">
																<div class="col-md-6">
																<div class="form-group form-float">
																	<div class="form-line">
																		<input type="text" class="form-control" name="secondBox" onFocus="startCalc();" onBlur="stopCalc();" maxlength="16" id="volume2" style="text-align:right;" onkeypress="return isNumber(event)" onkeyup="totalSum()" placeholder="0">
																		<label class="form-label" for="volume2">Volume 2 :</label>
																	</div>
																</div>
																</div>																
																<div class="col-md-6">						
																<div class="form-group form-float">
																	<div class="form-line">
																		<input type="input" class="form-control" maxlength="40" id="userInput2" style="text-align:right;" onkeyup="showMsg()" placeholder="-">
																		<label class="form-label" for="fff_kode">Satuan 2 :</label>
																	</div>
																</div>
																</div>														
															</div>															
															<div class="row clearfix">
																<div class="col-md-6">						
																<div class="form-group form-float">
																	<div class="form-line">
																		<input type="text" class="form-control" name="lastBox" onFocus="startCalc();" onBlur="stopCalc();" maxlength="16" id="volume3" style="text-align:right;" onkeypress="return isNumber(event)" onkeyup="totalSum()" placeholder="0">
																		<label class="form-label" for="ggg_kode">Volume 3 :</label>
																	</div>
																</div>
																</div>																
																<div class="col-md-6">						
																<div class="form-group form-float">
																	<div class="form-line">
																		<input type="input" class="form-control" maxlength="40" id="userInput3" style="text-align:right;" onkeyup="showMsg()" placeholder="-">
																		<label class="form-label" for="hhh_kode">Satuan 3 :</label>
																	</div>
																</div>
																</div>														
															</div>															
															<div class="row clearfix"><div class="col-md-6"></div></div>															
															<div class="row clearfix">
																<div class="col-md-6">						
																<div class="form-group form-float">
																	<div class="form-line">
																		<input type="hidden" id="sumberlain" onkeyup="totalAsumsi()">
																		<input type="text" class="form-control" name="thirdBox" id="thirdBox" style="text-align:right;font-weight:bold;" placeholder="0" readonly="readonly">
																		<label class="form-label" for="bbb_kode">Satuan :</label>
																	</div>
																</div>
																</div>														
															</div>
															<div class="row clearfix">
																<div class="col-md-6">						
																<div class="form-group form-float">
																	<div class="form-line">
																		<input type="text" class="form-control" name="userMsg" id="userMsg" style="text-align:right;font-weight:bold;" placeholder="-" readonly="readonly">
																		<label class="form-label" for="bbb_kode">Volume :</label>
																	</div>
																</div>
																</div>														
															</div>															
															<div class="row clearfix">
																<div class="col-md-6">						
																<div class="form-group form-float">
																	<div class="form-line">
																		<input type="text" class="form-control" id="total_sum1" style="text-align:right;font-weight:bold;" placeholder="0" readonly="readonly">
																		<input type="hidden" class="form-control" name="total_sum" id="total_sum" style="text-align:right;font-weight:bold;" placeholder="0" readonly="readonly">
																		<label class="form-label" for="bbb_kode">Total :</label>
																	</div>
																</div>
																</div>														
															</div>
															<div class="form-group">
																<div class="col-md-offset-9">
																	<button class="btn btn-primary waves-effect" id="tambah" type="submit">Simpan</button>
																	<a href="javascript:void(0);" class="btn btn-default">Batal</a>
																</div>
															</div>
														</div>
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
<script src="<?php echo base_url('public/templates/integrasi_v.4.0/js/rencana/jquery.js');?>"></script>
<script>
	var jumlah;
	var stok;
		$(function(){
	//jika tombol tambah di klik
		$("#tambah").click(function(){
		stok=$("#stok").val();
		jumlah=$("#total_sum").val();
		if(jumlah > stok){
			alert("Anggaran Lebih");
			$("#total_sum").focus();
		return false; }
		});
	return true });
</script>
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
        var uraian = autoSumForm.aaa_kode.value;
        var satuan = autoSumForm.thirdBox.value;
        var volume = autoSumForm.userMsg.value;
        var total = autoSumForm.total_sum.value;
        var pesan = '';
        if (uraian == '') { pesan += '- Uraian \n'; }
        if (satuan == '') { pesan += '- Satuan \n'; }
        if (volume == '') { pesan += '- Volume \n'; }
        if (total == '') { pesan += '- Total \n'; }
        if (pesan != '') { alert('Data Tidak Boleh Kosong : \n'+pesan); return false; }
    return true }
</script>