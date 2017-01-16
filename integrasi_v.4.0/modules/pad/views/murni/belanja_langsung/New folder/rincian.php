<!-- Main Content -->
   <section class="content">
		<h2>RKA Murni<small> anggaran belanja langsung</small></h2>  
			<div class="body">
				<ol class="breadcrumb breadcrumb-col-cyan">
					<li><a href="<?php echo site_url('dashboard');?>"><i class="material-icons">home</i> Home</a></li>
					<li><a href="<?php echo site_url('rka/murni');?>"> RKA</a></li>
					<li class="active"> Rincian Belanja</li>
				</ol>
			</div>
            <!-- Multiple Items To Be Open -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
							<p align="center"><b><?php echo strtoupper($rka->id_skpd);?></b></p>
							<p class="control-label col-md-10">Program &nbsp;:&nbsp; <?php echo $rka->id_program;?></p>
							<p class="control-label col-md-10">Kegiatan &nbsp;:&nbsp; <?php echo $rka->id_kegiatan;?></p>
							<p class="control-label col-md-10">Rekening :&nbsp; <?php echo $rka->id_akun;?>.<?php echo $rka->id_kelompok;?>.<?php echo $rka->id_jenis;?>.<?php echo $rka->id_obyek;?>.<?php echo $rka->id_rincian;?> <?php echo $rka->nama_rincian;?></p>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <button type="button" class="btn bg-black waves-effect waves-light">ACTIONS</button>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a title="Tambah" href="<?php echo site_url('rka/murni/addr/'.$rka->task_id);?>"><i class="material-icons">add_circle_outline</i> Rincian Belanja</a></li>
                                        <li><a title="Kembali" href="<?php echo base_url(); ?>rka/murni/belanja/<?php echo $rka->anggaran_kode;?>"><i class="material-icons">reply</i> Kembali</a></li>
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
                                        <li><p class="col-cyan"><a href="<?php echo base_url(); ?>rka/murni/belanja/<?php echo $rka->anggaran_kode;?>"><i class="material-icons">keyboard_arrow_left</i>Belanja</a></p></li>									
                                        <li role="presentation" class="active"><a href="#home_animation_2" data-toggle="tab">Rincian Belanja</a></li>
                                        <li><a href="javascript:void(0);">Sub Rincian Belanja</a></li>
                                    </ul>
                                    <!-- Tab panes -->
                                    <div class="tab-content">
                                        <div role="tabpanel" class="tab-pane animated fadeInRight active" id="home_animation_2">
                                            <b><?php echo validation_errors(); ?><?php if ($this->session->flashdata('success')) { echo $this->session->flashdata('success');} ?></b>
                                            <p><table class="table table-bordered table-striped table-hover js-basic-example dataTable">
											<thead>
											<tr>
												<th style="text-align:center; width:60px">No</th>
												<th style="text-align:center;">Uraian</th>
												<th style="text-align:center; width:60px">Actions</th>
											</tr>
											</thead>
											<tbody><?php if($rincian) : ?><?php foreach($rincian as $task) : ?>
												<tr>
													<td style="text-align:center;"><?php echo $task->no; ?></td>
													<td><a href="<?php echo base_url(); ?>rka/murni/sub/<?php echo $task->kode; ?>"><?php echo $task->uraian; ?></a></td>
													<td style="text-align:center;">										
														<a class="btn btn-sm btn-warning" title="Ubah" href="<?php echo base_url(); ?>rka/murni/editr/<?php echo $task->kode; ?>" value="<?php echo $task->kode; ?>"><i class="fa fa-pencil"></i></a>														
														<a class="btn btn-sm btn-danger" title="Hapus" onclick="return confirm('Are you sure?')" value="<?php echo $task->kode; ?>" href="<?php echo base_url(); ?>rka/murni/deleter/<?php echo $task->kode; ?>/<?php echo $this->uri->segment(1); ?>" ><i class="fa fa-trash-o"></i></a>
													</td>
												</tr>
												<?php endforeach; ?><?php endif; ?>
											</tbody>
											</table></p>
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