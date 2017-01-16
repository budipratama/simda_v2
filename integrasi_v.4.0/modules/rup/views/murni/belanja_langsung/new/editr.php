<!-- Main Content -->
<?php $query_data = mysql_query("SELECT skpd.skpd_nama as id_skpd, program.program as id_program, anggaran.kegiatan as id_kegiatan FROM rka	INNER JOIN skpd ON rka.skpd=skpd.skpd_kode INNER JOIN program ON rka.program=program.kode INNER JOIN anggaran ON rka.anggaran_kode=anggaran.kode WHERE rka.tipe_kode= '1' AND rka.anggaran_kode='".$rincian->id_anggaran."' ORDER BY rka.kode ASC"); $data = mysql_fetch_array($query_data); $skpd = $data[id_skpd]; $program = $data[id_program]; $kegiatan = $data[id_kegiatan]; ?>
   <section class="content">
		<h2>RKA Murni<small> anggaran belanja langsung</small></h2>  
			<div class="body">
				<ol class="breadcrumb breadcrumb-col-cyan">
					<li><a href="<?php echo site_url('dashboard');?>"><i class="material-icons">home</i> Home</a></li>
					<li><a href="<?php echo site_url('rka/murni');?>"> RKA</a></li>
					<li class="active"> Edit Rincian Belanja</li>
				</ol>
			</div>
            <!-- Multiple Items To Be Open -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
							<p align="center"><b><?php echo strtoupper($skpd);?></b></p>
							<p class="control-label col-md-10">Program &nbsp;:&nbsp; <?php echo $program;?>
							<p class="control-label col-md-10">Kegiatan &nbsp;:&nbsp; <?php echo $rincian->id_kegiatan; ?></p>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <button type="button" class="btn bg-black waves-effect waves-light">ACTIONS</button>
                                    </a>
                                    <ul class="dropdown-menu pull-right">                                     
                                        <li><a title="Kembali" href="<?php echo base_url(); ?>rka/murni/rincian/<?php echo $rincian->id_rka;?>"><i class="material-icons">reply</i> Kembali</a></li>
                                    </ul>
                                </li>
                            </ul>
							<div class="panel-body"></div>
                        </div>
                        <div class="body">
                            <div class="row clearfix">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <!-- Nav tabs -->
                                    <ul class="nav nav-tabs tab-nav-right" role="tablist">
                                        <li><a href="javascript:void(0);">Belanja</a></li>										
                                        <li role="presentation" class="active"><a href="#home_animation_2" data-toggle="tab">Rincian Belanja</a></li>
                                        <li><a href="javascript:void(0);">Sub Rincian Belanja</a></li>
                                    </ul>
                                    <!-- Tab panes -->									
									<div class="body">
										<div class="row clearfix">
										<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
										<form action="<?php echo site_url('rka/murni/editr/'.$kode);?>" class="form-horizontal" method="post"><br>
										<?php echo validation_errors(); ?><?php if ($this->session->flashdata('success')) { echo $this->session->flashdata('success');} ?>
										<input type="hidden" name="kode" value="<?php echo $rincian->id_kode; ?>"/>
										<input type="hidden" name="rka" value="<?php echo $rincian->id_rka; ?>"/>
										<input type="hidden" value="<?php echo $rincian->id_anggaran; ?>"/>										
											<div role="tabpanel" class="tab-pane fade in active" id="step1" aria-labelledby="home-tab">
												<div class="portlet-body">
												<table class="table table-striped table-bordered table-hover" width="50%" cellspacing="5" cellpadding="5">
													<tr>
													<th style="text-align:center; width:100px">No</th>
													<th style="text-align:center;">Uraian</th>
													</tr>
														<ul>
															<tr>
															<td><input type="text" class="form-control" name="no_kode" value="<?php echo $rincian->id_no; ?>" readonly="readonly"></td>
															<td><input type="text" class="form-control" name="aaa_kode" value="<?php echo $rincian->id_uraian; ?>" placeholder="Enter text here ..." required="required"></td>
															</tr>
														</ul>
												</table>
												<div class="form-group">
													<div class="col-md-offset-9">
														<button class="btn btn-primary waves-effect" type="submit">Simpan</button>
														<a href="<?php echo base_url(); ?>rka/murni/rincian/<?php echo $rincian->id_rka;?>" class="btn btn-default">Batal</a>
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
                </div>
            </div>
            <!-- #END# Tabs With Custom Animations -->
        </div>
    </section>
<!-- END CONTENT -->