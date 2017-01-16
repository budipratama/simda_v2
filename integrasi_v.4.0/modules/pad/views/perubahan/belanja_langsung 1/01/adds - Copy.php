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
<!--
<input type="text" id="type1" onkeyup="kalkulatorTambah(this.value,getElementById('type2').value);" />x
<input type="text" id="type2" onkeyup="kalkulatorTambah(getElementById('type1').value,this.value);" />=
<span id="result"></span>
<script>
function kalkulatorTambah(type1,type2) {
var hasil = eval(type1) * eval(type2);
document.getElementById('result').innerHTML = hasil;
}
</script> 

<script>
function kalkulatorTambah(type1,type2) {
var hasil = eval(type1) + eval(type2);
document.getElementById('result').innerHTML = hasil;
}
</script>
						
<br>
<input type="text" id="txt1" onkeyup="sum();" />x
<input type="text" id="txt2" onkeyup="sum();" />=
<input type="text" id="type1" onkeyup="kalkulatorTambah(this.value,getElementById('type2').value);" />+
<input type="text" id="type2" onkeyup="kalkulatorTambah(getElementById('type1').value,this.value);" />=
<span id="result"></span>
<script>
function sum() {
      var txtFirstNumberValue = document.getElementById('txt1').value;
      var txtSecondNumberValue = document.getElementById('txt2').value;
      var result = parseInt(txtFirstNumberValue) * parseInt(txtSecondNumberValue);
      if (!isNaN(result)) { document.getElementById('type1').value = result; }
}
</script> -->




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
						<li role="step" class="active"><a><div class="step-title"><div class="title">Rincian Belanja</div></div></a></li>
						<li role="step" ><a><div class="step-title"><div class="title">Sub Rincian Belanja</div></div></a></li>
						<li role="step" ><a><div class="step-title"><div class="title">History</div></div></a></li>
					</ul>
					<div class="tab-content">
					<form action="<?php echo site_url('rka/murni/addr');?>" class="form-horizontal" method="post"><br>
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
							<input type="text" class="form-control" id="txt1" onkeyup="sum();" maxlength="19" onkeypress="return isNumberKey(event)" name="aaa_kode" value="0" required="required">
							</div>
						</div>
						</div>
					</div>				
					
					<div class="form-group">
						<div class="col-md-5">
						<div class="form-group">
							<label class="control-label col-md-7" for="aaa_kode">Volume 1 :</label>
							<div class="col-md-5">
							<input type="text" class="form-control" id="txt2" onkeyup="sum();" maxlength="19" onkeypress="return isNumberKey(event)" name="aaa_kode" value="0" required="required">
							</div>
						</div>
						</div>						
						<div class="col-md-7">
						<div class="form-group">
							<label class="control-label col-md-2" for="bbb_kode">Satuan 1 :</label>
							<div class="col-md-4">
							<input type="text" class="form-control" name="aaa_kode" value="-" required="required">
							</div>
						</div>
						</div>
					</div>
					
					<div class="form-group">
						<div class="col-md-5">
						<div class="form-group">
							<label class="control-label col-md-7" for="aaa_kode">Volume 2 :</label>
							<div class="col-md-5">
							<input type="text" class="form-control" id="txt3" onkeyup="sum();" name="aaa_kode" maxlength="19" onkeypress="return isNumberKey(event)" value="" required="required">
							</div>
						</div>
						</div>						
						<div class="col-md-7">
						<div class="form-group">
							<label class="control-label col-md-2" for="bbb_kode">Satuan 2 :</label>
							<div class="col-md-4">
							<input type="text" class="form-control" name="aaa_kode" value="-" required="required">
							</div>
						</div>
						</div>
					</div>
					
					<div class="form-group">
						<div class="col-md-5">
						<div class="form-group">
							<label class="control-label col-md-7" for="aaa_kode">Volume 3 :</label>
							<div class="col-md-5">
							<input type="text" class="form-control" id="txt4" onkeyup="sum();" name="aaa_kode" maxlength="19" onkeypress="return isNumberKey(event)" value="" required="required">
							</div>
						</div>
						</div>						
						<div class="col-md-7">
						<div class="form-group">
							<label class="control-label col-md-2" for="bbb_kode">Satuan 3 :</label>
							<div class="col-md-4">
							<input type="text" class="form-control" name="aaa_kode" value="-" required="required">
							</div>
						</div>
						</div>
					</div>
					
					<div class="form-group">
						<div class="col-md-5">
						<div class="form-group" id="">
							<label class="control-label col-md-4" for="aaa_kode">Total </label>
							<div class="col-md-8">
							<input type="text" class="form-control" id="result" readonly="readonly"/>
							</div>
						</div>
						</div>
					</div>	
						



<script>
function sum() {
      var txtFirstNumberValue = document.getElementById('txt1').value;
      var txtSecondNumberValue = document.getElementById('txt2').value;
      var txtFirst = document.getElementById('txt3').value;
      var txtSecond = document.getElementById('txt4').value;
      var result = parseInt(txtFirstNumberValue) * parseInt(txtSecondNumberValue) * parseInt(txtFirst) * parseInt(txtSecond);
      if (!isNaN(result)) { document.getElementById('result').value = result; }
}
</script>
							
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
	function isNumberKey(evt) {
	  var charCode = (evt.which) ? evt.which : event.keyCode
	  if (charCode > 31 && (charCode < 48 || charCode > 57))
		return false; return true; }
</script>