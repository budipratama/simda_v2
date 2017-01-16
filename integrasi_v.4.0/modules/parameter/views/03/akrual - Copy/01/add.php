<!-- Main Content -->
<div class="container-fluid">
<div class="side-body padding-top">
	<h3 class="page-title">Parameter <small> rekening</small></h3>		
		<div class="row">
			<div class="col-xs-12">
				<div class="bs-example">
				<ol class="breadcrumb">
					<li class="active"><i class="fa fa-home"></i> <a href="<?php echo site_url('dashboard');?>">Home</a></li>
					<li class="active"><a href="<?php echo site_url('parameter');?>"> Parameter</a></li>
					<li class="active"><a href="<?php echo site_url('parameter/rekening/jenis');?>"> Rekening</a></li>
					<li class="active"><a href="<?php echo site_url('parameter/rekening/jenis');?>"> Jenis</a></li>
					<li class="active"><a href="<?php echo site_url('parameter/rekening/addj');?>"> Tambah</a></li>
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
            <div class="panel panel-info">
				<div class="panel-heading"><i class="fa fa-bars"></i> Jenis</div>	
				<div class="panel-body">				
				<!-- BEGIN FORM -->
				<form action="<?php echo site_url('parameter/rekening_akrual/insert');?>" class="form-horizontal" method="post"><br><div class="form-group">
						<div class="col-md-5">
						<div class="form-group" id="">
							<label class="control-label col-md-2" for="aaa_kode">Akun<span class="required">*</span> :</label>
							<div class="col-md-10">
							<?php combobox('db', $akun, 'aaa_kode', 'kode', 'akun_nama', '', 'show_form_akun_by_jenis();', 'Pilih Akun', 'class="select2_category form-control" tabindex="1" required="required"'); ?>
							</div>
						</div>
						</div>						
						<div class="col-md-7">
						<div class="form-group" id="tampil_combobox_akun_by_jenis">
							<label class="control-label col-md-3" for="bbb_kode">Kelompok :</label>
							<div class="col-md-8">
							<select class="select2_category form-control" name="bbb_kode" id="bbb_kode" data-placeholder="Pilih Sasaran" required="required"></select>
							</div>
						</div>
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-10">
						<div class="form-group" id="tampil_combobox_jenis_by_kode"></div>
						</div>
					</div>					
					<div class="form-group">
						<div class="col-md-10">
						<div class="form-group" id="tampil_combobox_jenis_by_kode">
							<label class="control-label col-md-3" for="ccc_kode">Nomor <span class="required">*</span> :</label>
							<div class="col-md-1">
							<input type="text" class="form-control" name="ccc_kode" id="ccc_kode" placeholder="1" onkeypress="return Angka(event, false)" required="required">
							</div>
							<label class="control-label col-md-1" for="jenis">Jenis <span class="required">*</span> :</label>
							<div class="col-md-7">
							<input type="text" class="form-control" name="jenis" id="jenis" placeholder="Input Jenis ..." required="required">
							</div>
						</div>
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-10">
						<div class="form-group">
							<label class="control-label col-md-3" for="fff_kode">Saldo Normal <span class="required">*</span> :</label>
							<div class="col-md-2">
							<?php combobox('db', $saldo, 'sss_kode', 'tipe_kode', 'tipe_nama', '', '', 'Pilih Saldo ...', 'class="select2_category form-control" tabindex="1" required="required"'); ?>
							</div>
						</div>
						</div>
					</div>					
					<div class="form-group">
						<div class="col-md-offset-9">
							<button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Simpan</button>
							<a href="<?php echo site_url('parameter/rekening_akrual');?>" class="btn default"><i class="fa fa-reply"></i> Kembali</a>
						</div>
					</div>
				</div>		
<?php printf( "%02d", 1 ); ?>				
<?php printf( "%02d", 10 ); ?>				
				</form>
				<!-- END FORM-->
				</div>
			</div>
			</div>
			</div>

			<!-- END SAMPLE TABLE PORTLET-->
</div>
<!-- END CONTENT -->	
	<script>	
	function show_form_akun_by_jenis(){
		var aaa_kode = $('select[name=aaa_kode]').val();
		load('parameter/rekening-akrual/tampil_combobox_akun_by_jenis/'+aaa_kode, '#tampil_combobox_akun_by_jenis');
	}
	function show_form_jenis_by_kode(){
		var bbb_kode = $('select[name=bbb_kode]').val();
		load('parameter/rekening-akrual/tampil_combobox_jenis_by_kode/'+bbb_kode, '#tampil_combobox_jenis_by_kode');
	}
	</script>
	
	<script language="javascript">
    function Angka(e, decimal) {
    var key;
    var keychar;
     if (window.event) {
         key = window.event.keyCode;
     } else
     if (e) {
         key = e.which;
     } else return true;
   
    keychar = String.fromCharCode(key);
    if ((key==null) || (key==0) || (key==8) ||  (key==9) || (key==13) || (key==27) ) {
        return true;
    } else
    if ((("0123456789").indexOf(keychar) > -1)) {
        return true;
    } else
    if (decimal && (keychar == ".")) {
        return true;
    } else return false;
    }
</script>