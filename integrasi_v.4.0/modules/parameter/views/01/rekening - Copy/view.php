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
					<li class="active"><a href="<?php echo site_url('parameter/rekening');?>"> Rekening</a></li>
					<li class="active"><a href="<?php echo site_url('parameter/rekening');?>"> Jenis</a></li>
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
				<div class="panel-heading"><i class="fa fa-bars"></i> Rekening</div>
				<div class="panel-body">
				<div class="portlet-body" style="display: block;">
					<a href="<?php echo site_url('parameter/rekening/addj');?>" class="icon-btn"><i class="fa fa-plus"></i><div>Jenis</div></a>
					</div>							
				</div>
				<div class="panel-body">				
				<!-- BEGIN FORM -->	
				<div class="step">
					<ul class="nav nav-tabs nav-justified" role="tablist">
						<li role="step" class="active step-success">
							<a href="#step1" id="step1-tab" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true">
								<div class="icon glyphicon glyphicon-ok-sign" style="font-size:40px;color:white"></div>
									<div class="step-title">
									<div class="title">Jenis</div>
									<div class="description">Rekening</div>
								</div>
							</a>
						</li>
						<li role="step" >
							<a href="<?php echo site_url('parameter/rekening/obyek');?>">
								<div class="icon glyphicon glyphicon-circle-arrow-right" style="font-size:30px;color:black"></div>
									<div class="step-title">
									<div class="title">Obyek</div>
									<div class="description">Rekening</div>
								</div>
							</a>
						</li>
						<li role="step">
							<a href="<?php echo site_url('parameter/rekening/rincian');?>" >
								<div class="icon glyphicon glyphicon-circle-arrow-right" style="font-size:30px;color:black"></div>
									<div class="step-title">
									<div class="title">Rincian Obyek</div>
									<div class="description">Rekening</div>
								</div>
							</a>
						</li>
					</ul>
					<div class="tab-content">
						<div role="tabpanel" class="tab-pane fade in active" id="step1" aria-labelledby="home-tab">
							<div class="portlet-body">											
								<table class="table table-striped table-bordered table-hover" id="tableUtama">
								<thead><tr>
									<th style="width:25px">No</th>
									<th style="width:25px">Akun</th>
									<th style="width:25px">Kelompok</th>
									<th style="width:25px">Jenis</th>
									<th style="text-align:center; width:900px">Uraian Rekening Jenis</th>
									<th style="text-align:center; width:25px">Actions</th>
								</tr></thead>
								<tbody></tbody>
								</table>
							</div>
						</div>
					<div role="tabpanel" class="tab-pane fade" id="step2" aria-labelledby="profile-tab">
						<p>??</p> 
					</div>
					<div role="tabpanel" class="tab-pane fade" id="step3" aria-labelledby="dropdown1-tab">
						<p>??</p>
					</div>
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
	var ajax_source_url = '<?php echo site_url($this->uri->segment(1) . '/' . $this->uri->segment(2) . '/jenisv'); ?>';
	var ajax_source_field =	  [ { "data": "nomor" }, { "data": "akun" }, { "data": "kelompok" }, { "data": "no" }, { "data": "jenis_nama" }, { "data": "Actions" } ];
	
	function show_form_akun_by_kelompok(){
		var aaa_kode = $('select[name=aaa_kode]').val();
		load('parameter/rekening/tampil_combobox_akun_by_kelompok/'+aaa_kode, '#tampil_combobox_akun_by_kelompok');
	}
	
	function show_form_kelompok_by_jenis(){
		var bbb_kode = $('select[name=bbb_kode]').val();
		load('parameter/rekening/tampil_combobox_kelompok_by_jenis/'+bbb_kode, '#tampil_combobox_kelompok_by_jenis');
	}
	
	function show_form_jenis_by_obyek(){
		var ccc_kode = $('select[name=ccc_kode]').val();
		load('parameter/rekening/tampil_combobox_jenis_by_obyek/'+ccc_kode, '#tampil_combobox_jenis_by_obyek');
	}
	
	function show_form_obyek_by_rincian(){
		var ddd_kode = $('select[name=ddd_kode]').val();
		load('parameter/rekening/tampil_combobox_obyek_by_rincian/'+ddd_kode, '#tampil_combobox_obyek_by_rincian');
	}
	</script>