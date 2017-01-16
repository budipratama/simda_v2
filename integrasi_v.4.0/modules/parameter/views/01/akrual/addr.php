<!-- Main Content -->
   <section class="content">
		<h2>Parameter<small> rekening akrual</small></h2>  
			<div class="body">
				<ol class="breadcrumb breadcrumb-col-cyan">
					<li><a href="<?php echo site_url('dashboard');?>"><i class="material-icons">home</i> Home</a></li>
					<li><a href="<?php echo site_url('parameter');?>"> Parameter</a></li>
					<li><a href="<?php echo site_url('parameter/akrual');?>"> Rekening Akrual</a></li>
					<li class="active"> Tambah Data Rincian</li>
				</ol>
			</div>
            <!-- Multiple Items To Be Open -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header bg-purple">
						<h2>Rekening Akrual<small>Data Rincian</small></h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="<?php echo site_url('parameter/akrual/rincian/'.$obyek->kode);?>"><i class="material-icons">reply</i> Kembali</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <div class="row clearfix">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <!-- Nav tabs -->
                                     <ul class="nav nav-tabs tab-nav-right" role="tablist">
                                       <li><a href="javascript:void(0);">Akun</a></li>
                                        <li><a href="javascript:void(0);">Kelompok</a></li>
                                        <li><a href="javascript:void(0);">Jenis</a></li>
                                        <li><a href="javascript:void(0);">Obyek</a></li>
                                        <li role="presentation" class="active"><a href="#home_animation_2" data-toggle="tab">Rincian</a></li>
                                    </ul>
                                    <!-- Tab panes -->
                                    <div class="tab-content">
									<form action="<?php echo site_url('parameter/akrual/addr/'.$kode->id);?>" class="form-horizontal" method="post" >
									<input type="hidden" value="<?php printf( "%01d", $rincian->no++); ?>" />
									<input type="hidden" class="form-control" name="aaa_kode" value="<?php echo $obyek->akun;?>">
										<input type="hidden" class="form-control" name="bbb_kode" value="<?php echo $obyek->kelompok;?>">
										<input type="hidden" class="form-control" name="ccc_kode" value="<?php echo $obyek->jenis;?>">
										<input type="hidden" class="form-control" name="ddd_kode" value="<?php echo $obyek->kode;?>">
										<input type="hidden" class="form-control" name="fff_kode" value="<?php printf( "%02d", $rincian->no ); ?>">
										<div role="tabpanel" class="tab-pane fade in active" id="step1" aria-labelledby="home-tab">
											<div class="portlet-body">
											<table class="table table-striped table-bordered table-hover" width="50%" cellspacing="5" cellpadding="5">
												<tr>
													<th style="text-align:center; width:100px">Rincian</th>
													<th style="text-align:center;">Uraian Rekening Rincian</th>
													<th style="text-align:center; width:200px">Peraturan</th>
												</tr>
													<ul>
														<tr>														
														<td><input type="text" class="form-control" name="eee_kode" value="<?php printf( "%01d", $rincian->no ); ?>" placeholder="Kode ..." readonly="readonly"></td>
														<td><input type="text" class="form-control" name="rrr_kode" placeholder="Input Rincian ..." required="required"></td>
														<td><input type="text" class="form-control" name="ppp_kode" value="-" placeholder="Input Peraturan ..." required="required"></td>
														</tr>
													</ul>
											</table>
											<div class="form-group">
												<div class="col-md-offset-9">
													<button type="submit" class="btn btn-primary">Simpan</button>
													<a href="<?php echo site_url('parameter/akrual/rincian/'.$obyek->kode);?>" class="btn btn-default">Batal</a>
												</div>
											</div>
											</div>
										</div>
									</form>									
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Tabs With Custom Animations -->
        </div>
    </section>