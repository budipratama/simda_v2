<!-- Main Content -->
   <section class="content">
		<h2>Parameter<small> unit organisasi</small></h2>  
			<div class="body">
				<ol class="breadcrumb breadcrumb-col-cyan">
					<li><a href="<?php echo site_url('dashboard');?>"><i class="material-icons">home</i> Home</a></li>
					<li><a href="<?php echo site_url('parameter');?>"> Parameter</a></li>
					<li><a href="<?php echo site_url('parameter/unit-organisasi');?>"> Unit Organisasi</a></li>
					<li class="active"> Edit Data Sub Unit</li>
				</ol>
			</div>
            <!-- Multiple Items To Be Open -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header bg-light-green">
						<h2>Unit Organisasi<small>Data Sub Unit</small></h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="<?php echo site_url('parameter/unit-organisasi/sub/'.$sub->kd_skpd);?>"><i class="material-icons">reply</i> Kembali</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <div class="row clearfix">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <!-- Nav tabs -->
                                     <ul class="nav nav-tabs tab-nav-right" role="tablist">
                                       <li><a href="javascript:void(0);">Unit</a></li>
                                        <li><a href="javascript:void(0);">Bidang</a></li>
                                        <li><a href="javascript:void(0);">Unit</a></li>
                                        <li role="presentation" class="active"><a href="javascript:void(0);" data-toggle="tab">Sub Unit</a></li>
                                    </ul>
                                    <!-- Tab panes -->
                                    <div class="tab-content">
									<form action="<?php echo site_url('parameter/unit-organisasi/ubahs/'.$sub->kode);?>" class="form-horizontal" method="post" >
									<input type="hidden" name="kode" value="<?php echo $sub->kode; ?>"/>
									<input type="hidden" name="ccc_kode" value="<?php echo $sub->kd_skpd;?>" />
										<div role="tabpanel" class="tab-pane fade in active" id="step1" aria-labelledby="home-tab">
											<div class="portlet-body">
											<table class="table table-striped table-bordered table-hover" width="50%" cellspacing="5" cellpadding="5">
												<tr>
												<th style="text-align:center; width:100px">Sub</th>
												<th style="text-align:center;">Uraian Nama Sub Unit</th>
												</tr>
													<ul>
														<tr>
														<td style="text-align:center;"><input type="text" class="form-control" name="ddd_kode" value="<?php echo $sub->no;?>" readonly="readonly"></td>
														<td><input type="text" class="form-control" name="sss_kode" value="<?php echo $sub->nm_sub;?>" required="required"></td>
														</tr>
													</ul>
											</table>
											<div class="form-group">
												<div class="col-md-offset-9">
													<button type="submit" class="btn btn-primary">Simpan</button>
													<a href="<?php echo site_url('parameter/unit-organisasi/sub/'.$sub->kd_skpd);?>" class="btn btn-default">Batal</a>
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