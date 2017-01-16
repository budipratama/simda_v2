<!-- Main Content -->
	<section class="content">
		<h2>Parameter<small> rekening</small></h2>  
			<div class="body">
				<ol class="breadcrumb breadcrumb-col-cyan">
					<li><a href="<?php echo site_url('dashboard');?>"><i class="material-icons">home</i> Home</a></li>
					<li><a href="<?php echo site_url('parameter');?>"> Parameter</a></li>
					<li><a href="<?php echo site_url('parameter/rekening');?>"> Rekening</a></li>
					<li class="active"> Edit Jenis</li>
				</ol>
			</div>
		<!-- Multiple Items To Be Open -->
			<div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header bg-purple">
						<h2>Rekening<small>Data Jenis</small></h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a title="Kembali" href="<?php echo site_url('parameter/rekening/jenis/'.$kelompok);?>"><i class="material-icons">reply</i> Kembali</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">	
						<div class="modal-body form">						
							<form id="form_validation" action="<?php echo site_url('parameter/rekening/ubahj');?>" class="form-horizontal" method="post">
							<input type="hidden" name="kode" value="<?php echo $kode;?>">
							<input type="hidden" name="kelompok" value="<?php echo $kelompok;?>">
								<div class="row clearfix">									
									<div class="col-md-4">
									<p><b>Saldo Normal :</b></p>
									<?php combobox('db', $saldo, 'eee_kode', 'saldo_normal', 'saldo_normal', $saldo_, '', 'Pilih Tahun Anggaran', 'class="form-control show-tick" data-live-search="true" tabindex="1" required');?>
									</div>
								</div>
								<div class="row clearfix">
									<div class="col-md-2">
									<p><b>Nomor :</b></p>
										<div class="input-group">
											<div class="form-line">
												<input type="text" class="form-control" value="<?php echo $no;?>" readonly>
											</div>
										</div>
									</div>										
									<div class="col-md-6">
									<p><b>Uraian Rekening Jenis :</b></p>
										<div class="input-group">
											<div class="form-line">
												<input type="text" class="form-control" placeholder="Input Text Here ..." name="ddd_kode" id="ddd_kode" value="<?php echo $nama;?>" required>
											</div>
										</div>
									</div>
								</div>
							<div align="right">
								<button type="submit" class="btn btn-primary">Simpan</button>								
								<a title="Kembali" href="<?php echo site_url('parameter/rekening/jenis/'.$kelompok);?>" class="btn btn-danger">Batal</a>
							</div>
							</form>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
		<!-- #END# Tabs With Custom Animations -->
    </section>
<!-- END CONTENT -->