<!-- Main Content -->   
   <section class="content">
		<h2>SIRUP Murni<small> entri data &amp; informasi detail</small></h2>  
			<div class="body">
				<ol class="breadcrumb breadcrumb-col-cyan">
					<li><a href="<?php echo site_url('dashboard');?>"><i class="material-icons">home</i> Home</a></li>
					<li><a href="<?php echo site_url('rup/murni');?>"> SIRUP</a></li>
					<li class="active"> Swakelola</li>
				</ol>
			</div>
            <!-- Multiple Items To Be Open -->
			<?php if ($this->session->flashdata('success')) { echo $this->session->flashdata('success');} ?>
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
						<div class="header"><h2><?php echo strtoupper($kegiatan);?></h2></div>
                        <div class="body">
                            <div class="row clearfix">
							<div class="body">
							<form action="" id="form_validation" enctype="multipart/form-data" method="post">
							<input type="hidden" class="form-control" name="id_paket" id="id_paket" value="1">
								<div class="row clearfix">
									<div class="col-md-2">
										<p><b>Tahun :</b></p>
										<div class="form-group form-float">
											<div class="form-line">
											<?php echo $tahun;?>
											</div>								
										</div>								
									</div>
									<div class="col-md-2">
										<p><b>ID PAKET :</b></p>
										<div class="form-group form-float">
											<div class="form-line">
											<?php echo $kode;?>
											</div>								
										</div>								
									</div>
								</div>
								<div class="row clearfix">
									<div class="col-md-12">
										<p><b>Nama Kegiatan :</b></p>
										<div class="form-group form-float">
											<div class="form-line">										
											<?php echo $kegiatan;?>
											</div>
										</div>								
									</div>
								</div>
								<div class="row clearfix">
									<div class="col-md-12">
										<p><b>Volume :</b></p>
										<div class="form-group form-float">
											<div class="form-line">										
											<?php echo $volume;?>
											</div>
										</div>								
									</div>
								</div>
								<div class="row clearfix">
									<div class="col-md-12">
										<p><b>Lokasi :</b></p>
										<div class="form-group form-float">
											<div class="form-line">										
											<?php echo $alamat;?>
											</div>
										</div>								
									</div>
								</div>
								<hr><h4 class="form-section"><b>DANA</b></h4>
								<div class="row clearfix">
									<div class="col-md-4">
										<p><b>Sumber Dana :</b></p>
										<div class="form-group form-float">
											<div class="form-line">										
											<?php echo $id_get2->sumber;?>
											</div>								
										</div>								
									</div>
									<div class="col-md-4">
										<p><b>Pagu :</b></p>
										<div class="form-group form-float">
										<div class="form-line">
											<?php echo rupiah($id_kab+id_prov+id_apbn+id_sumber);?>
										</div>
										</div>
									</div>
									<div class="col-md-4">
										<p><b>MAK :</b></p>
										<div class="form-group form-float">
										<div class="form-line">
											<?php echo $mak;?>
										</div>
										</div>								
									</div>
								</div>
								<hr><h4 class="form-section"><b>PELAKSANAAN PEKERJAAN</b></h4>
								<div class="row clearfix">									
									<div class="col-md-3">
										<p><b>Tanggal Awal Pekerjaan :</b></p>
										<div class="form-group form-float">
											<div class="form-line">	
											<?php echo dateIndo($pk_awal);?>
											</div>
										</div>
									</div>
									<div class="col-md-3">
										<p><b>Tanggal Akhir Pekerjaan :</b></p>
										<div class="form-group form-float">
											<div class="form-line">	
											<?php echo dateIndo($pk_akhir);?>
											</div>
										</div>
									</div>
									<div class="col-md-6">
									<p><b>Deskripsi :</b></p>
										<div class="form-group form-float">
											<div class="form-line">	
											<?php echo $catatan;?>
											</div>
										</div>
									</div>
								</div>
								<a href="#" onClick="history.go(-1); return false;" class="btn btn-default">Kembali</a>
                            </form>
							</div>
							</div>
						</div>
					</div>
				</div>
			</div>
	</section>
<!-- #END# Multiple Items To Be Open -->	
  <!-- END CONTENT -->