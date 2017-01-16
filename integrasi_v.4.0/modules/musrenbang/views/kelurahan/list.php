<!-- BEGIN CONTENT -->
	<div class="page-content-wrapper">
		<div class="page-content">
			<!-- BEGIN PAGE HEADER-->
			<h3 class="page-title">
			Form Musrenbang Kelurahan <small> di Kabupaten Bekasi</small>
			</h3>
			<div class="page-bar">
				<ul class="page-breadcrumb">
					<li>
						<i class="fa fa-home"></i>
						<a href="<?php echo site_url();?>">Home</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="#">Form Musrenbang Kelurahan</a>
					</li>
				</ul>
			</div>
           
            <!-- END PAGE HEADER-->
			<!-- BEGIN DASHBOARD STATS -->
			<div class="row">
				<div class="col-md-12 col-sm-12">
					<div class="note note-success">
					<p style="text-align:justify;">Form Musrenbang Kelurahan ini disediakan sebagai media agar anggota DPRD bisa mengusulkan kegiatan di tiap-tiap skpd yang memiliki bidang urusan terkait. Dengan menggunakan fasilitas ini maka diharapkan dapat menciptakan kegiatan-kegiatan yang bermanfaat dan membangun.</p>
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
							<!-- BEGIN FORM-->
							<form action="<?php echo site_url('musrenbang/kelurahan/list-skpd/'.$tipe);?>" class="form-horizontal" method="post">
								<div class="form-body">
									<div class="row">
										<div class="col-md-3 pull-right">
											<div class="form-group">
												<div class="col-md-12">
													<input type="text" class="form-control" name="cari_" id="cari_" value="" onkeyup="loadSkpd();" placeholder="Cari...">
												</div>
											</div>
										</div>
									</div>
								</div>
							</form>
							<!-- END FORM-->
							
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
							$skpd_pelaksana = $this->db->query("SELECT skpd_kode, skpd_nama, skpd_kewenangan, (SELECT COUNT(anggaran.pelaksana_kode) AS skpd_jumlah_kegiatan FROM anggaran WHERE anggaran.pelaksana_kode=skpd.skpd_kode) as skpd_jumlah_kegiatan FROM skpd WHERE skpd_status='SKPD' AND skpd_kewenangan != '' ORDER BY skpd_jumlah_kegiatan DESC, skpd_nama ASC")->result();
							foreach ($skpd_pelaksana as $atribut) {
							?>
							<tr>
								<td style="cursor: pointer" onclick="link('<?php echo site_url('musrenbang/kelurahan/'.$tipe.'/'.$atribut->skpd_kode);?>');"><?php echo $id;?></td>
								<td style="cursor: pointer" onclick="link('<?php echo site_url('musrenbang/kelurahan/'.$tipe.'/'.$atribut->skpd_kode);?>');"><?php echo $atribut->skpd_nama?></td>
								<td style="cursor: pointer" onclick="link('<?php echo site_url('musrenbang/kelurahan/'.$tipe.'/'.$atribut->skpd_kode);?>');"><?php echo $atribut->skpd_kewenangan?></td>
								<td style="text-align:center;cursor: pointer" onclick="link('<?php echo site_url('musrenbang/kelurahan/'.$tipe.'/'.$atribut->skpd_kode);?>');"><span class="label label-sm label-warning">Isi Kegiatan</span></td>
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
					<h4 class="modal-title"><strong>Success!</strong> Tambah Musrenbang Kelurahan</h4>
				</div>
				<div class="modal-body">
					Data Musrenbang Kelurahan telah berhasil ditambahkan!
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
	
	function loadSkpd(){
		var tipe = '<?php echo $this->uri->segment(4); ?>';
		var cari_ = $('#cari_').val();
		load('musrenbang/kelurahan/loadSkpd/'+tipe+'/'+cari_, '#tableCustom');
	}
	</script>