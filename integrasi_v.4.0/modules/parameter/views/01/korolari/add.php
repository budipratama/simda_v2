<!-- Main Content -->
<div class="container-fluid">
<div class="side-body padding-top">
	<h3 class="page-title">Parameter <small> Rekening Korolari</small></h3>		
		<div class="row">
			<div class="col-xs-12">
				<div class="bs-example">
				<ol class="breadcrumb">
					<li class="active"><i class="fa fa-home"></i> <a href="<?php echo site_url('dashboard');?>">Home</a></li>
					<li class="active"><a href="<?php echo site_url('parameter');?>"> Parameter</a></li>
					<li class="active"><a href="<?php echo site_url('parameter/korolari');?>"> Rekening Korolari</a></li>
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
                                    <form action="<?php echo site_url('parameter/korolari/add');?>" class="form-horizontal" method="post" name="form" onSubmit="return validasi()">
                                        <div class="form-group">
											<div class="col-md-10">
											<div class="form-group">
											<label class="control-label col-md-3">Korolari Atas Rekening :</label>
											<div class="col-md-1"><input type="text" class="form-control" name="rek1_kode" id="rek1" readonly="readonly"></div>
											<div class="col-md-1"><input type="text" class="form-control" name="rek2_kode" id="rek2" readonly="readonly"></div>
											<div class="col-md-1"><input type="text" class="form-control" name="rek3_kode" id="rek3" readonly="readonly"></div>
											<div class="col-md-1"><input type="text" class="form-control" name="rek4_kode" id="rek4" readonly="readonly"></div>
											<div class="col-md-1"><input type="text" class="form-control" name="rek5_kode" id="rek5" readonly="readonly"></div>
											<div class="col-md-1"><input class="btn btn-info" type="button" name="button" id="button" value="View" onclick="window.open('<?php echo site_url('parameter/korolari/rek');?>', 'winpopup', 'toolbar=no,statusbar=no,menubar=no,resizable=yes,scrollbars=yes,width=500,height=520');" /></div>
											</div>
											</div>
											<div class="col-md-10">
											<div class="form-group">
											<label class="control-label col-md-3" for="ppp_kode"></label>										
											<div class="col-md-5"><input type="hidden" class="form-control" id="rek6" readonly="readonly"></div>
											</div>
											</div>
										</div>
										<div class="form-group">
											<div class="col-md-10">
											<div class="form-group">
											<label class="control-label col-md-3">Rekening Debet :</label>
											<div class="col-md-1"><input type="text" class="form-control" name="debet1_kode" id="debet1" readonly="readonly"></div>
											<div class="col-md-1"><input type="text" class="form-control" name="debet2_kode" id="debet2" readonly="readonly"></div>
											<div class="col-md-1"><input type="text" class="form-control" name="debet3_kode" id="debet3" readonly="readonly"></div>
											<div class="col-md-1"><input type="text" class="form-control" name="debet4_kode" id="debet4" readonly="readonly"></div>
											<div class="col-md-1"><input type="text" class="form-control" name="debet5_kode" id="debet5" readonly="readonly"></div>
											<div class="col-md-1"><input class="btn btn-info" type="button" name="button" id="button" value="View" onclick="window.open('<?php echo site_url('parameter/korolari/debet');?>', 'winpopup', 'toolbar=no,statusbar=no,menubar=no,resizable=yes,scrollbars=yes,width=500,height=520');" /></div>
											</div>
											</div>
											<div class="col-md-10">
											<div class="form-group">
											<label class="control-label col-md-3" for="ppp_kode"></label>										
											<div class="col-md-5"><input type="hidden" class="form-control" id="debet6" readonly="readonly"></div>
											</div>
											</div>
										</div>
										<div class="form-group">
											<div class="col-md-10">
											<div class="form-group">
											<label class="control-label col-md-3">Rekening Kredit :</label>
											<div class="col-md-1"><input type="text" class="form-control" name="kredit1_kode" id="kredit1" readonly="readonly"></div>
											<div class="col-md-1"><input type="text" class="form-control" name="kredit2_kode" id="kredit2" readonly="readonly"></div>
											<div class="col-md-1"><input type="text" class="form-control" name="kredit3_kode" id="kredit3" readonly="readonly"></div>
											<div class="col-md-1"><input type="text" class="form-control" name="kredit4_kode" id="kredit4" readonly="readonly"></div>
											<div class="col-md-1"><input type="text" class="form-control" name="kredit5_kode" id="kredit5" readonly="readonly"></div>
											<div class="col-md-1"><input class="btn btn-info" type="button" name="button" id="button" value="View" onclick="window.open('<?php echo site_url('parameter/korolari/kredit');?>', 'winpopup', 'toolbar=no,statusbar=no,menubar=no,resizable=yes,scrollbars=yes,width=500,height=520');" /></div>
											</div>
											</div>
											<div class="col-md-10">
											<div class="form-group">
											<label class="control-label col-md-3" for="ppp_kode"></label>										
											<div class="col-md-5"><input type="hidden" class="form-control" id="kredit6" readonly="readonly"></div>
											</div>
											</div>
										</div>
										<div class="form-group">
										<div class="col-md-offset-9">
											<button class="btn btn-success" type="submit"><i class="fa fa-check"></i> Simpan</button>											
										<a href="<?php echo site_url('parameter/korolari');?>" class="btn default"><i class="fa fa-reply"></i> Kembali</a>
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
        var rek = form.rek5.value;
        var debet = form.debet5.value;
        var kredit = form.kredit5.value;
        var pesan = '';
        if (rek == '') { pesan += '- Korolari Atas Rekening \n'; }
        if (debet == '') { pesan += '- Rekening Debet \n'; }
        if (kredit == '') { pesan += '- Rekening Kredit \n'; }
        if (pesan != '') { alert('Data Tidak Boleh Kosong : \n'+pesan); return false; }
    return true }
</script>