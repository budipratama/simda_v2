<!-- Main Content -->
<div class="container-fluid">
	<div class="side-body padding-top">
	<h3 class="page-title">Detail RKA SKPD <small> Belanja Langsung</small></h3>				
		<div class="row">
			<div class="col-xs-12">
				<div class="bs-example">
					<ol class="breadcrumb">
						<li class="active"><i class="fa fa-home"></i> <a href="<?php echo site_url('dashboard');?>">Home</a></li>
						<li class="active"><a href="<?php echo site_url('rka/murni');?>">RKA</a></li>
						<li class="active">Belanja Langsung</li>
						<li class="active">View</li>
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
				<div class="panel-heading"><i class="fa fa-bars"></i> Laporan Kode Rekening</div>
				<div class="panel-body">
				<!-- BEGIN FORM -->
				<form action="<?php echo site_url('rka/murni/preview/'.$rka);?>" class="horizontal-form" method="post">
					<div class="form-body">
					<div class="row">
					<input type="hidden" name="tahun" value="<?php echo $tahun; ?>" />
					<input type="hidden" name="anggaran_kode" value="<?php echo $rka; ?>" />
					<input type="hidden" name="skpd" value="<?php echo $skpd; ?>" />						
					<input type="hidden" name="kode" value="<?php echo $kode; ?>" />						
						<div class="col-md-3">
							<div class="form-group">
							<label class="control-label" for="tanggal">Tanggal Laporan <span class="required">*</span> :</label>
								<div class="input-group input-medium date date-picker" data-date-format="yyyy-mm-dd">
								<input type="text" class="form-control" name="tanggal" id="tanggal" value="<?php echo date("Y-m-d");?>" readonly>
								<span class="input-group-btn"><button class="btn default" type="button"><i class="fa fa-calendar"></i></button></span>
								</div>
							</div>
						</div>
					</div>
					</div>
					<table class="table table-striped table-bordered table-hover">
					<thead><tr>
						<th style="text-align:center;">Nama</th>
						<th style="text-align:center;">Nip</th>
						<th style="text-align:center;">Jabatan</th>
						<th style="text-align:center; width:60px">Action</th>
					</tr></thead>
						<?php $query_tim = mysql_query("SELECT * FROM tim_anggaran WHERE tim_anggaran.kode_tim= '4' AND tim_anggaran.skpd = '".$skpd."' GROUP BY tim_anggaran.kode ORDER BY tim_anggaran.kode ASC"); while($row_tim=mysql_fetch_array($query_tim)){ ?>
						<tbody>
							<tr>
							<td><?php echo $row_tim['nama']; ?></a></td>
							<td style="text-align:center;"><?php echo $row_tim['nip']; ?></td>
							<td><?php echo $row_tim['jabatan']; ?></a></td>
							<td style="text-align:center;">										
							<a class="btn btn-sm btn-warning" title="Ubah" href="<?php echo base_url(); ?>rka/murni/tim/<?php echo $row_tim['kode']; ?>"><i class="fa fa-pencil"></i></a>
							</td>
							</tr>
						<?php } ?>
						</tbody>
					</table>
					</div>				
					<div class="form-actions">
					<div class="col-md-offset-9">
						<a href="<?php echo base_url(); ?>rka/murni/sub/<?php echo $kode; ?>" class="btn btn-default"><i class="fa fa-reply"></i> Kembali</a>
						<button type="submit" name="cetak" class="btn btn-success" title="View"><i class="fa fa-check"></i> Lihat Rekap</button>
					</div><br>	
					</div>	
				</form>
				<!-- END FORM-->			
			</div>
			</div>
			</div>
			<!-- END SAMPLE TABLE PORTLET-->
</div>
<!-- END CONTENT -->
<script>
	function show_form_deskel_by_kecamatan(){
		var kecamatan_kode = $('select[name=kecamatan_kode]').val();
		load('rka/murni/tampil_combobox_deskel_by_kecamatan2/'+kecamatan_kode, '#tampil_combobox_deskel_by_kecamatan');
	}
</script>