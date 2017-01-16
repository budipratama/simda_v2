<!-- Main Content -->
<div class="container-fluid">
<div class="side-body padding-top">
	<h3 class="page-title">Parameter <small> Rekening</small></h3>		
		<div class="row">
			<div class="col-xs-12">
				<div class="bs-example">
				<ol class="breadcrumb">
					<li class="active"><i class="fa fa-home"></i> <a href="<?php echo site_url('dashboard');?>">Home</a></li>
					<li class="active"><a href="<?php echo site_url('parameter');?>"> Parameter</a></li>
					<li class="active"><a href="<?php echo site_url('parameter/rekening');?>"> Rekening</a></li>
					<li class="active"> Jenis</li>
				</ol>
				</div>
			</div>
		</div>	
			<!-- END PAGE HEADER-->
			<div class="clearfix"></div>
			<?php echo validation_errors(); ?>
			<?php if ($this->session->flashdata('success')) { echo $this->session->flashdata('success');} ?>			
			<div class="card-body">
				<div class="panel panel-default">
					<div class="panel-body">						

					</div>
				</div>									
			</div>			
			<div class="row">
			<div class="col-md-12">
            <div class="panel panel-primary">
				<div class="panel-heading"><i class="fa fa-bars"></i> Data Jenis</div>
				<div class="panel-body">				
				<!-- BEGIN FORM -->	
				<div class="step">
					<ul class="nav nav-tabs nav-justified" role="tablist">
						<li role="step" ><a><div class="step-title"><div class="title">Belanja</div></div></a></li>
						<li role="step" ><a><div class="step-title"><div class="title">Rincian Belanja</div></div></a></li>
						<li role="step" class="active"><a><div class="step-title"><div class="title">Sub Rincian Belanja</div></div></a></li>
						<li role="step" ><a><div class="step-title"><div class="title">History</div></div></a></li>
					</ul>
					<div class="tab-content">
					<form action="<?php echo site_url('rka/murni/addr');?>" class="form-horizontal" method="post" name="autoSumForm"><br>
					<input type="hidden" value="<?php printf( "%01d", $sub->no++ ); ?>" />
					<input type="hidden" name="id_kode" id="id_kode" value="<?php echo $kode;?>" />
						<div role="tabpanel" class="tab-pane fade in active" id="step1" aria-labelledby="home-tab">
							<div class="portlet-body">
							<table class="table table-striped table-bordered table-hover" width="50%" cellspacing="5" cellpadding="5">
								<tr>
								<th style="text-align:center; width:100px">No</th>
								<th style="text-align:center;">Uraian</th>
								</tr>
									<ul>
										<tr>
										<td><input type="text" class="form-control" name="no_kode" value="<?php printf( "%01d", $sub->no ); ?>" placeholder="Kode ..." readonly="readonly"></td>
										<td><input type="text" class="form-control" name="aaa_kode" placeholder="Input Rincian Belanja ..." required="required"></td>
										</tr>
									</ul>
							</table>
							
						<br><div class="form-group">
						<div class="col-md-5">
						<div class="form-group" id="">
							<label class="control-label col-md-4" for="aaa_kode">Harga Satuan Rp. </label>
							<div class="col-md-5">
							<input type="text" class="form-control" name="satuan" maxlength="16" id="satuan" style="text-align:right;" onkeypress="return isNumber(event)" onkeyup="totalSum()" placeholder="0" required="required">
							</div>
						</div>
						</div>
					</div>				
					
					<div class="form-group">
						<div class="col-md-5">
						<div class="form-group">
							<label class="control-label col-md-7" for="aaa_kode">Volume 1 :</label>
							<div class="col-md-5">
							<input type="text" class="form-control" name="firstBox" onFocus="startCalc();" onBlur="stopCalc();" maxlength="16" id="volume1" style="text-align:right;" onkeypress="return isNumber(event)" onkeyup="totalSum()" placeholder="0" required="required">
							</div>
						</div>
						</div>						
						<div class="col-md-7">
						<div class="form-group">
							<label class="control-label col-md-2" for="bbb_kode">Satuan 1 :</label>
							<div class="col-md-4">
							<input type="text" class="form-control" name="apbd_kab" id="apbd_kab" style="text-align:right;" onkeypress="return isNumber(event)" onkeyup="totalAsumsi()" placeholder="0" required="required">
							</div>
						</div>
						</div>
					</div>
					
					<div class="form-group">
						<div class="col-md-5">
						<div class="form-group">
							<label class="control-label col-md-7" for="aaa_kode">Volume 2 :</label>
							<div class="col-md-5">
							<input type="text" class="form-control" name="secondBox" onFocus="startCalc();" onBlur="stopCalc();" maxlength="16" id="volume2" style="text-align:right;" onkeypress="return isNumber(event)" onkeyup="totalSum()" placeholder="0">
							</div>
						</div>
						</div>						
						<div class="col-md-7">
						<div class="form-group">
							<label class="control-label col-md-2" for="bbb_kode">Satuan 2 :</label>
							<div class="col-md-4">
							<input type="text" class="form-control" name="apbd_prov" id="apbd_prov" style="text-align:right;" onkeypress="return isNumber(event)" onkeyup="totalAsumsi()" placeholder="0">
							</div>
						</div>
						</div>
					</div>
					
					<div class="form-group">
						<div class="col-md-5">
						<div class="form-group">
							<label class="control-label col-md-7" for="aaa_kode">Volume 3 :</label>
							<div class="col-md-5">
							<input type="text" class="form-control" name="lastBox" onFocus="startCalc();" onBlur="stopCalc();" maxlength="16" id="volume3" style="text-align:right;" onkeypress="return isNumber(event)" onkeyup="totalSum()" placeholder="0">
							</div>
						</div>
						</div>						
						<div class="col-md-7">
						<div class="form-group">
							<label class="control-label col-md-2" for="bbb_kode">Satuan 3 :</label>
							<div class="col-md-4">
							<input type="text" class="form-control" name="apbn" style="text-align:right;" onkeypress="return isNumber(event)" onkeyup="totalAsumsi()" id="apbn" placeholder="0">
							</div>
						</div>
						</div>
					</div>
					
					<div class="form-group">
						<div class="col-md-5">
						<div class="form-group" id="">
							<label class="control-label col-md-4" for="aaa_kode"><strong>Satuan :</strong></label>
							<div class="col-md-8">
							<input type="hidden" id="sumberlain" onkeyup="totalAsumsi()">
							<input type="text" class="form-control" name="thirdBox" id="total_asumsi" style="text-align:right;font-weight:bold;" placeholder="0" readonly="readonly">
							</div>
						</div>
						</div>
					</div>
					
					<div class="form-group">
						<div class="col-md-5">
						<div class="form-group" id="">
							<label class="control-label col-md-4" for="aaa_kode"><strong>Total :</strong></label>
							<div class="col-md-8">
							<input type="text" class="form-control" name="total_sum" id="total_sum" style="text-align:right;font-weight:bold;" placeholder="0" readonly="readonly">
							</div>
						</div>
						</div>
					</div>
							<div class="form-group">
								<div class="col-md-offset-9">
									<button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Simpan</button>
									<a href="#" onClick="history.go(-1); return false;" class="btn btn-default"><i class="fa fa-times"></i> Batal</a>
								</div>
							</div>
							</div>
						</div>
					<div role="tabpanel" class="tab-pane fade" id="step2" aria-labelledby="profile-tab">
						<p>??</p> 
					</div>
					<div role="tabpanel" class="tab-pane fade" id="step3" aria-labelledby="dropdown1-tab">
						<p>??</p>
					</div>
					</form>
					</div>
				</div>
				<!-- END FORM-->
				</div>
			</div>
			</div>
			</div>
			<!-- END SAMPLE TABLE PORTLET-->
</div>
<!-- END CONTENT -->
<script>
function totalSum(){
		var satuan 			= document.getElementById("satuan").value || 1;
		var volume1 		= document.getElementById("volume1").value || 1;
		var volume2 		= document.getElementById("volume2").value || 1;
		var volume3 		= document.getElementById("volume3").value || 1;
		var result 			= parseInt(satuan) * parseInt(volume1) * parseInt(volume2) * parseInt(volume3);
		document.getElementById("total_sum").value = tandaPemisah(result);
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