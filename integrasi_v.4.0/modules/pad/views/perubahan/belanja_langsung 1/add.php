<!-- Main Content -->
<div class="container-fluid">
	<div class="side-body padding-top">
	<h3 class="page-title">Detail RKA SKPD <small> Belanja Langsung</small></h3>				
		<div class="row">
			<div class="col-xs-12">
				<div class="bs-example">
					<ol class="breadcrumb">
						<li class="active"><i class="fa fa-home"></i> <a href="<?php echo site_url('dashboard');?>">Home</a></li>
						<li class="active"><a href="<?php echo site_url('rka/perubahan');?>">RKA</a></li>
						<li class="active">Belanja Langsung</li>
						<li class="active">add Belanja</li>
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
				<div class="panel-heading"><i class="fa fa-bars"></i> Data Kode Rekening</div>	
				<div class="panel-body">
				<!-- BEGIN FORM -->
				<form action="<?php echo site_url('rka/perubahan/belanja_langsung');?>" class="form-horizontal" method="post"><br>
				<input type="hidden" value="<?php printf( "%01d", $bl->no++ ); ?>" />
				<input type="hidden" name="no_kode" id="no_kode" value="<?php printf( "%01d", $bl->no ); ?>" />
				<input type="hidden" name="id_kode" id="id_kode" value="<?php echo $kode;?>" />
				<input type="hidden" name="program_kode" id="program_kode" value="<?php echo $program;?>" />
				<input type="hidden" name="thn_kode" id="thn_kode" value="<?php echo $tahun;?>" />
				<input type="hidden" name="skpd_kode" id="skpd_kode" value="<?php echo $skpd;?>" />				
				<input type="hidden" name="urusan_kode" id="urusan_kode" value="<?php echo $urusan;?>" />
					<div class="form-group">
						<div class="col-md-5">
						<div class="form-group" id="">
							<label class="control-label col-md-2" for="aaa_kode">Akun<span class="required">*</span> :</label>
							<div class="col-md-10">
							<?php combobox('db', $akun, 'aaa_kode', 'kode', 'akun_nama', '', 'show_form_akun_by_kelompok();', 'Pilih Akun', 'class="select2_category form-control" tabindex="1" required="required"'); ?>
							</div>
						</div>
						</div>						
						<div class="col-md-7">
						<div class="form-group" id="tampil_combobox_akun_by_kelompok">
							<label class="control-label col-md-3" for="bbb_kode">Kelompok :</label>
							<div class="col-md-7">
							<select class="select2_category form-control" name="bbb_kode" id="bbb_kode" data-placeholder="Pilih Sasaran" required="required"></select>
							</div>
						</div>
						</div>
					</div>
					<!--/row-->
					<div class="form-group">
						<div class="col-md-10">
						<div class="form-group" id="tampil_combobox_kelompok_by_jenis">
							<label class="control-label col-md-3" for="ccc_kode">Jenis :</label>
							<div class="col-md-7">
							<select class="select2_category form-control" name="ccc_kode" id="ccc_kode" data-placeholder="Pilih Sasaran" required="required"></select>
							</div>
						</div>
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-10">
						<div class="form-group" id="tampil_combobox_jenis_by_obyek">
							<label class="control-label col-md-3" for="ddd_kode">Obyek :</label>
							<div class="col-md-7">
							<select class="select2_category form-control" name="ddd_kode" id="ddd_kode" data-placeholder="Pilih Sasaran" required="required"></select>
							</div>
						</div>
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-10">
						<div class="form-group" id="tampil_combobox_obyek_by_rincian">
							<label class="control-label col-md-3" for="eee_kode">Rincian :</label>
							<div class="col-md-7">
							<select class="select2_category form-control" name="eee_kode" id="eee_kode" data-placeholder="Pilih Sasaran" required="required"></select>
							</div>
						</div>
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-10">
						<div class="form-group">
							<label class="control-label col-md-3" for="sss_kode">Sumber Dana :</label>
							<div class="col-md-5">
							<?php combobox('db', $sumber, 'sss_kode', 'tipe_kode', 'tipe_nama', '', '', 'Pilih Sumber ...', 'class="select2_category form-control" tabindex="1" required="required"'); ?>
							</div>
						</div>
						</div>
					</div>					
					<div class="form-group">
						<div class="col-md-offset-9">
							<button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Simpan</button>
							<a href="<?php echo base_url(); ?>rka/perubahan/belanja/<?php echo $kode;?>" class="btn btn-default"><i class="fa fa-times"></i> Batal</a>
						</div>
					</div>
				</div>
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
	function show_form_akun_by_kelompok(){
		var aaa_kode = $('select[name=aaa_kode]').val();
		load('rka/perubahan/tampil_combobox_akun_by_kelompok/'+aaa_kode, '#tampil_combobox_akun_by_kelompok');
		load('rka/perubahan/tampil_combobox_kelompok_by_jenis/', '#tampil_combobox_kelompok_by_jenis');
		load('rka/perubahan/tampil_combobox_jenis_by_obyek/', '#tampil_combobox_jenis_by_obyek');
		load('rka/perubahan/tampil_combobox_obyek_by_rincian/', '#tampil_combobox_obyek_by_rincian');
	}
	
	function show_form_kelompok_by_jenis(){
		var bbb_kode = $('select[name=bbb_kode]').val();
		load('rka/perubahan/tampil_combobox_kelompok_by_jenis/'+bbb_kode, '#tampil_combobox_kelompok_by_jenis');
		load('rka/perubahan/tampil_combobox_jenis_by_obyek/', '#tampil_combobox_jenis_by_obyek');
		load('rka/perubahan/tampil_combobox_obyek_by_rincian/', '#tampil_combobox_obyek_by_rincian');
	}
	
	function show_form_jenis_by_obyek(){
		var ccc_kode = $('select[name=ccc_kode]').val();
		load('rka/perubahan/tampil_combobox_jenis_by_obyek/'+ccc_kode, '#tampil_combobox_jenis_by_obyek');
		load('rka/perubahan/tampil_combobox_obyek_by_rincian/', '#tampil_combobox_obyek_by_rincian');
	}
	
	function show_form_obyek_by_rincian(){
		var ddd_kode = $('select[name=ddd_kode]').val();
		load('rka/perubahan/tampil_combobox_obyek_by_rincian/'+ddd_kode, '#tampil_combobox_obyek_by_rincian');
	}
	</script>