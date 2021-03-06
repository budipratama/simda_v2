<!-- Main Content -->
<div class="container-fluid">
	<div class="side-body padding-top">
	<h3 class="page-title">Detail RKA SKPD <small> Belanja Langsung</small></h3>				
		<div class="row">
			<div class="col-xs-12">
				<div class="bs-example">
					<ol class="breadcrumb">
						<li class="active"><i class="fa fa-home"></i> <a href="<?php echo site_url('dashboard');?>">Home</a></li>
						<li class="active"><a href="<?php echo site_url('rka/perubahan');?>"> RKA</a></li>
						<li class="active"> Belanja Langsung</li>
						<li class="active"> Sub Rincian Belanja</li>
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
					<p align="center">
						<p class="control-label col-md-10">Kegiatan &nbsp;:&nbsp; <?php echo $sub_->id_kegiatan; ?></p><p align="right">Jumlah<!--<?php if($jum): ?><?php foreach($jum as $task): ?>Rp. <?php echo rupiah1 ($task->total); ?><?php endforeach; ?><?php endif; ?>--></p>
						<p class="control-label col-md-10">Rincian &nbsp;&nbsp;&nbsp;:&nbsp; 
						<?php echo $rincian->no; ?>. 
						<?php echo $rincian->uraian; ?></p><p align="right"><?php if($sum): ?><?php foreach($sum as $task): ?>Rp. <?php echo rupiah1 ($task->total); ?><?php endforeach; ?><?php endif; ?></p>
					</div>
				</div>									
				</div>
			<div class="row">
			<div class="col-md-12">
            <div class="panel panel-primary">
				<div class="panel-heading">
				<form action="<?php echo site_url('rka/perubahan/preview/'.$rka);?>" class="horizontal-form" method="post">
					<p class="control-label col-md-9"><i class="fa fa-bars"></i> Data Kode Rekening</p><p align="right">
					<a href="<?php echo base_url(); ?>rka/perubahan/rincian/<?php echo $rincian->task_id; ?>" class="btn btn-default"><i class="fa fa-reply"></i> Kembali</a>
					<a class="btn btn-success" title="Tambah" href="<?php echo site_url('rka/perubahan/adds/'.$rincian->kode);?>"><i class="fa fa-plus"> Sub</i></a>
					<!--<a class="btn btn-info" title="Print" href="<?php echo site_url('rka/perubahan/view/'.$kode);?>"><i class="fa fa-print"> Print</i></a></p>-->
					<input type="hidden" name="tahun" value="<?php echo $tahun; ?>" />
					<input type="hidden" name="anggaran_kode" value="<?php echo $rka; ?>" />
					<input type="hidden" name="skpd" value="<?php echo $skpd_; ?>" />						
					<input type="hidden" name="kode" value="<?php echo $kode; ?>" />
					<button type="submit" name="cetak" class="btn btn-info" title="View"><i class="fa fa-print"></i> Print</button>
				</form>
				</div>
				<div class="panel-body">
				<!-- BEGIN FORM -->
				<div class="step">
					<ul class="nav nav-tabs nav-justified" role="tablist">
						<li role="step" ><a href="<?php echo base_url(); ?>rka/perubahan/belanja/<?php echo $sub_->anggaran_kode;?>"><div class="step-title"><div class="title">Belanja</div></div></a></li>
						<li role="step" ><a href="<?php echo base_url(); ?>rka/perubahan/rincian/<?php echo $rincian->task_id; ?>"><div class="step-title"><div class="title">Rincian Belanja</div></div></a></li>
						<li role="step" class="active">
							<a href="#step1" id="step1-tab" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true">
								<div class="step-title"><div class="title">Sub Rincian Belanja</div></div>
							</a>
						</li>						
						<li role="step" ><a><div class="step-title"><div class="title">History</div></div></a></li>
					</ul>
					<div class="tab-content">
						<div role="tabpanel" class="tab-pane fade in active" id="step1" aria-labelledby="home-tab">
							<div class="portlet-body">
							<table id="example1" class="table table-striped table-bordered table-hover">
								<thead><tr>
									<th style="text-align:center; width:60px">No</th>
									<th style="text-align:center;">Uraian</th>
									<th style="text-align:center; width:60px">Actions</th>
								</tr></thead>
								<tbody><?php if($sub) : ?><?php foreach($sub as $task) : ?>
								<tr>
									<td style="text-align:center;"><?php echo $task->no; ?></td>
									<td><?php echo $task->uraian; ?></td>
									<td style="text-align:center;">										
										<a class="btn btn-sm btn-warning" title="Ubah" href="<?php echo base_url(); ?>rka/perubahan/edits/<?php echo $task->kode; ?>" value="<?php echo $task->kode; ?>"><i class="fa fa-pencil"></i></a>
										<a class="btn btn-sm btn-danger" title="Hapus" onclick="return confirm('Are you sure?')" value="<?php echo $task->kode; ?>" href="<?php echo base_url(); ?>rka/perubahan/deletes/<?php echo $task->kode; ?>/<?php echo $this->uri->segment(1); ?>" ><i class="fa fa-trash-o"></i></a>
									</td>
								</tr>
								<?php endforeach; ?><?php endif; ?>
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
<a href="#warningEdit" data-toggle="modal"></a>
	<div id="warningEdit" class="modal fade" role="dialog" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
					<h4 class="modal-title"><strong>Warning!</strong></h4>
				</div>
				<div class="modal-body">
					 Data Rekening <font color="red"><strong>"Permanen!"</strong></font>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn blue" data-dismiss="modal">OK</button>
				</div>
			</div>
		</div>
	</div>
	
<a href="#warningHapus" data-toggle="modal"></a>
	<div id="warningHapus" class="modal fade" role="dialog" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
					<h4 class="modal-title"><strong>Warning!</strong></h4>
				</div>
				<div class="modal-body">
					 Data Rekening <font color="red"><strong>"Permanen!"</strong></font>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn blue" data-dismiss="modal">OK</button>
				</div>
			</div>
		</div>
	</div>
<script>
	function show_form_deskel_by_kecamatan(){
		var kecamatan_kode = $('select[name=kecamatan_kode]').val();
		load('rka/perubahan/tampil_combobox_deskel_by_kecamatan2/'+kecamatan_kode, '#tampil_combobox_deskel_by_kecamatan');
	}
</script>