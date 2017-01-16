<!-- Main Content -->
<div class="container-fluid">
<div class="side-body padding-top">
	<h3 class="page-title">Parameter <small> Mapping Rekening SAP</small></h3>		
		<div class="row">
			<div class="col-xs-12">
				<div class="bs-example">
				<ol class="breadcrumb">
					<li class="active"><i class="fa fa-home"></i> <a href="<?php echo site_url('dashboard');?>">Home</a></li>
					<li class="active"><a href="<?php echo site_url('parameter');?>"> Parameter</a></li>
					<li class="active"><a href="<?php echo site_url('parameter/rekening-sap/add');?>"> Mapping Rekening SAP</a></li>
				</ol>
				</div>
			</div>
		</div>	
			<!-- END PAGE HEADER-->
			<div class="clearfix"></div>
			<?php echo validation_errors(); ?>
			<?php if ($this->session->flashdata('success')) { echo $this->session->flashdata('success');} ?>
			<div class="row">
			<div class="col-md-12">
            <div class="panel panel-primary">
				<div class="panel-heading"><i class="fa fa-bars"></i> DATA Rekening Korolari</div>	
				<div class="panel-body">				
				<!-- BEGIN FORM -->
                                <div class="panel-body"><br>
                                    <form action="<?php echo site_url('parameter/rekening-sap/add');?>" class="form-horizontal" method="post" name="form" onSubmit="return validasi()">
                                        <div class="form-group">
											<div class="col-md-10">
											<div class="form-group">
											<label class="control-label col-md-3">Rekening Permendagri 13 :</label>
											<div class="col-md-1"><input type="text" class="form-control" name="dagri1_kode" id="dagri1" readonly="readonly"></div>
											<div class="col-md-1"><input type="text" class="form-control" name="dagri2_kode" id="dagri2" readonly="readonly"></div>
											<div class="col-md-1"><input type="text" class="form-control" name="dagri3_kode" id="dagri3" readonly="readonly"></div>
											<div class="col-md-1"><input type="text" class="form-control" name="dagri4_kode" id="dagri4" readonly="readonly"></div>
											<div class="col-md-1"><input class="btn btn-info" type="button" name="button" id="button" value="View" onclick="window.open('<?php echo site_url('parameter/rekening-sap/dagri');?>', 'winpopup', 'toolbar=no,statusbar=no,menubar=no,resizable=yes,scrollbars=yes,width=500,height=520');" /></div>
											</div>
											</div>
											<div class="col-md-10">
											<div class="form-group">
											<label class="control-label col-md-3" for="ppp_kode"></label>										
											<div class="col-md-5"><input type="hidden" class="form-control" id="dagri5" readonly="readonly"></div>
											</div>
											</div>
										</div>
										<div class="form-group">
											<div class="col-md-10">
											<div class="form-group">
											<label class="control-label col-md-3">Rekening SAP :</label>
											<div class="col-md-1"><input type="text" class="form-control" name="sap1_kode" id="sap1" readonly="readonly"></div>
											<div class="col-md-1"><input type="text" class="form-control" name="sap2_kode" id="sap2" readonly="readonly"></div>
											<div class="col-md-1"><input type="text" class="form-control" name="sap3_kode" id="sap3" readonly="readonly"></div>
											<div class="col-md-1"><input type="text" class="form-control" name="sap4_kode" id="sap4" readonly="readonly"></div>
											<!-- <div class="col-md-1"><input class="btn btn-info" type="button" name="button" id="button" value="View" onclick="window.open('<?php echo site_url('parameter/rekening-sap/sap');?>', 'winpopup', 'toolbar=no,statusbar=no,menubar=no,resizable=yes,scrollbars=yes,width=500,height=520');" /></div> -->
											</div>
											</div>
											<div class="col-md-10">
											<div class="form-group">
											<label class="control-label col-md-3" for="ppp_kode"></label>										
											<div class="col-md-5"><input type="hidden" class="form-control" id="sap5" readonly="readonly"></div>
											</div>
											</div>
										</div>
										<div class="form-group">
										<div class="col-md-offset-9">
											<button class="btn btn-success" type="submit"><i class="fa fa-check"></i> Simpan</button>											
										<a href="<?php echo site_url('parameter/rekening-sap');?>" class="btn default"><i class="fa fa-reply"></i> Kembali</a>
										</div>
										</div>
									</form>
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
    function validasi(){
        var rek = form.dagri4.value;
        var debet = form.sap4.value;
        var pesan = '';
        if (rek == '') { pesan += '- Rekening Permendagri 13 \n'; }
        if (debet == '') { pesan += '- Rekening SAP \n'; }
        if (pesan != '') { alert('Data Tidak Boleh Kosong : \n'+pesan); return false; }
    return true }
</script>