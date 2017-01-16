<!-- Main Content -->
            <div class="container-fluid">
                <div class="side-body padding-top">
				<h3 class="page-title">Form Usulan Masyarakat <small>di Kabupaten Bekasi</small></h3>
				
					<div class="row">
                        <div class="col-xs-12">
							<div class="bs-example">
								<ol class="breadcrumb">
									<li class="active"><i class="fa fa-home"></i> <a href="<?php echo site_url();?>"> Home</a></li>
									<li class="active"><a href="<?php echo site_url("usulan/masyarakat/form");?>">Form Usulan Masyarakat</a></li>
								</ol>
							</div><br>
							<div class="alert alert-info" role="alert">
								Form Usulan Masyarakat ini disediakan sebagai media agar Masyarakat bisa mengusulkan kegiatan di tiap-tiap skpd yang memiliki bidang urusan terkait. Dengan menggunakan fasilitas ini maka diharapkan dapat menciptakan kegiatan-kegiatan yang bermanfaat dan membangun.
							</div>
                        </div>
                    </div>
									
                    <div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<div class="box-name">
					<i class="fa fa-table"></i>
					<span><b>Daftar SKPD Pelaksana</b></span>
				</div>
			</div>
			<div class="box-content no-padding">
				<table class="table table-striped table-bordered table-hover table-heading no-border-bottom">
					<thead>
						<tr>
							<th style="width:20px">No</th>
							<th style="width:280px">Nama SKPD</th>
							<th style="text-align:center;">Jenis Kegiatan (Kewenangan)</th>
							<th style="width:100px; text-align:center;">Isi Kegiatan</th>
						</tr>
					</thead>
					<tbody>
							<?php
							$id = 1;
							$skpd_pelaksana = $this->Skpd_model->grid_all('skpd_kode, skpd_nama, skpd_kewenangan', 'skpd_nama', 'ASC', '', '', array('skpd_status'=>'SKPD', 'skpd_kewenangan !='=>''));
							foreach ($skpd_pelaksana as $atribut) {
							?>
							<tr>
								<td style="cursor: pointer" onclick="link('<?php echo site_url('usulan/masyarakat/pengisian/'.$atribut->skpd_kode);?>');"><?php echo $id;?></td>
								<td style="cursor: pointer" onclick="link('<?php echo site_url('usulan/masyarakat/pengisian/'.$atribut->skpd_kode);?>');"><?php echo $atribut->skpd_nama?></td>
								<td style="cursor: pointer" onclick="link('<?php echo site_url('usulan/masyarakat/pengisian/'.$atribut->skpd_kode);?>');"><?php echo $atribut->skpd_kewenangan?></td>
								<td style="text-align:center;cursor: pointer" onclick="link('<?php echo site_url('usulan/masyarakat/pengisian/'.$atribut->skpd_kode);?>');"><span class="btn btn-info"><i class="fa fa-pencil"></i></span></td>
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
<script type="text/javascript">
$(document).ready(function() {
	// Drag-n-Drop feature
	WinMove();
});
</script>
                </div>
            </div>
        </div>
	<!-- END CONTENT -->
	<script language="javascript" type="text/javascript">
	function link(anchor){
		document.location.href = anchor;
		return false;
	}
	</script>
	
<a href="#successInsert" data-toggle="modal"></a>
	<div id="successInsert" class="modal fade" role="dialog" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
					<h4 class="modal-title"><strong>Success!</strong> Tambah Usulan Masyarakat</h4>
				</div>
				<div class="modal-body">
					Cek Data di Menu<font color="green"><strong> "Hasil Usulan Masyarakat"</strong></font>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn green" data-dismiss="modal">OK</button>
				</div>
			</div>
		</div>
</div>