<!-- BEGIN CONTENT -->
	<div class="page-content-wrapper">
		<div class="page-content">
			<!-- BEGIN PAGE HEADER-->
	<div class="row">
	<div id="breadcrumb" <div class="page-bar">>
		<a href="#" class="show-sidebar">
			<i class="fa fa-bars"></i>
		</a>
		<ol class="breadcrumb pull-left">
			<li><a href="<?php echo site_url();?>">Home</a></li>
			<li><a href="<?php echo site_url('usulan/masyarakat/form');?>">From Usulan Masyarakat</a></li>
			<li><a href="#">Pengisian</a></li>
		</ol>
	</div>
	</div>
			<h3 class="page-title">
			Pengisian <small>Usulan Masyarakat</small>
			</h3>
            <!-- END PAGE HEADER-->
			<!-- BEGIN DASHBOARD STATS -->
				<div class="col-xs-12">
					<h6 class="page-header">NOTE: Silahkan isi Form Usulan Masyarakat ini dengan data-data yang valid!</h6>
				</div>
			<?php echo validation_errors(); ?>
			
	<!-- BEGIN FORM -->
	<div class="row">
	<div class="col-xs-12 col-sm-12">
		<div class="box">
			<div class="box-header">
				<div class="box-name">
					<i class="fa fa-pencil-square-o"></i>
					<span>Tambah Usulan Masyarakat</span>
				</div>
				<div class="no-move"></div>
			</div>
			<div class="box-content">
				<h4 class="page-header">Biodata Pengirim</h4>
				
			</div>
		</div>
	</div>
	</div>
</div>
			<div class="row">
				<div class="col-md-12">
					<div id="mapmodals" class="modal fade" role="dialog" aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
									<h4 class="modal-title">Google Maps</h4>
								</div>
								<div class="modal-body">
									 <div id="map-container" style="width:100%;height:420px"></div>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
									<button type="button" class="btn btn-primary" id="simpan_lokasi" data-dismiss="modal"><i class="fa fa-check"></i> Simpan Lokasi</button>
								</div>
							</div>
						</div>
					</div>
					<!-- END SAMPLE TABLE PORTLET-->
				</div>
			</div>
	</div>
	<!-- END CONTENT -->
    <script>
	function show_form_deskel_by_kecamatan(){
		var kecamatan_kode = $('select[name=kecamatan_kode]').val();
		load('usulan/masyarakat/tampil_combobox_deskel_by_kecamatan/'+kecamatan_kode, '#tampil_combobox_deskel_by_kecamatan');
	}
	
	</script>