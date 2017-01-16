<!-- BEGIN CONTENT -->
	<div class="page-content-wrapper">
		<div class="page-content">
			<!-- BEGIN PAGE HEADER-->
			<h3 class="page-title">
			Form Pokok Pikiran DPRD <small> di Kabupaten Bekasi</small>
			</h3>
			<div class="page-bar">
				<ul class="page-breadcrumb">
					<li>
						<i class="fa fa-home"></i>
						<a href="<?php echo site_url();?>">Home</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="#">Form Pokok Pikiran DPRD</a>
					</li>
				</ul>
			</div>
           
            <!-- END PAGE HEADER-->
			<!-- BEGIN DASHBOARD STATS -->
			<div class="row">
				<div class="col-md-12 col-sm-12">
					<div class="note note-success">
					<p style="text-align:justify;">Form Pokok Pikiran DPRD ini disediakan sebagai media agar anggota DPRD bisa mengusulkan kegiatan di tiap-tiap skpd yang memiliki bidang urusan terkait. Dengan menggunakan fasilitas ini maka diharapkan dapat menciptakan kegiatan-kegiatan yang bermanfaat dan membangun.</p>
					</div>
				</div>
			</div>
			
			<div class="row">
				<div class="col-md-12">
					<div class="portlet box green">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-bars"></i>Daftar SKPD Pelaksana
							</div>
						</div>
						<div class="portlet-body">
							<table class="table table-striped table-bordered table-hover" id="tableCustom">
							<thead>
							<tr>
								<th style="width:20px">No</th>
								<th style="width:280px">Nama SKPD</th>
								<th style="text-align:center;">Jenis Kegiatan (Kewenangan)</th>
								<th style="width:100px; text-align:center;">Aksi</th>
							</tr>
							</thead>
							<tbody>
							<?php
							$id = 1;
							$skpd_pelaksana = $this->Skpd_model->grid_all('skpd_kode, skpd_nama, skpd_kewenangan', 'skpd_nama', 'ASC', '', '', array('skpd_status'=>'SKPD', 'skpd_kewenangan !='=>''));
							foreach ($skpd_pelaksana as $atribut) {
							?>
							<tr>
								<td style="cursor: pointer" onclick="link('<?php echo site_url('usulan/dprd/pengisian/'.$atribut->skpd_kode);?>');"><?php echo $id;?></td>
								<td style="cursor: pointer" onclick="link('<?php echo site_url('usulan/dprd/pengisian/'.$atribut->skpd_kode);?>');"><?php echo $atribut->skpd_nama?></td>
								<td style="cursor: pointer" onclick="link('<?php echo site_url('usulan/dprd/pengisian/'.$atribut->skpd_kode);?>');"><?php echo $atribut->skpd_kewenangan?></td>
								<td style="text-align:center;cursor: pointer" onclick="link('<?php echo site_url('usulan/dprd/pengisian/'.$atribut->skpd_kode);?>');"><span class="label label-sm label-warning">Isi Kegiatan</span></td>
							</tr>
							<?php 
							$id++;
							} 
							?>
							</tbody>
							</table>
						</div>
					</div>
				</div>
								
			</div>	
			<!-- END DASHBOARD STATS -->
			<div class="clearfix">
			</div>
		</div>
	</div>
	<!-- END CONTENT -->
	
	<a href="#successInsert" data-toggle="modal"></a>
	<div id="successInsert" class="modal fade" role="dialog" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
					<h4 class="modal-title"><strong>Success!</strong> Tambah Pokok-pokok Pikiran DPRD</h4>
				</div>
				<div class="modal-body">
					 Data pokok-pokok pikiran DPRD telah berhasil ditambahkan!
				</div>
				<div class="modal-footer">
					<button type="button" class="btn green" data-dismiss="modal">OK</button>
				</div>
			</div>
		</div>
	</div>
	
	<script language="javascript" type="text/javascript">
	function link(anchor){
		document.location.href = anchor;
		return false;
	}
	</script>