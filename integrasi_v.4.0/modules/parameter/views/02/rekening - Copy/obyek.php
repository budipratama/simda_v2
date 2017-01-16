<!-- Main Content -->
   <section class="content">
		<h2>Parameter<small> rekening</small></h2>  
			<div class="body">
				<ol class="breadcrumb breadcrumb-col-cyan">
					<li><a href="<?php echo site_url('dashboard');?>"><i class="material-icons">home</i> Home</a></li>
					<li><a href="<?php echo site_url('parameter');?>"> Parameter</a></li>
					<li><a href="<?php echo site_url('parameter/rekening');?>"> Rekening</a></li>
					<li class="active"> Obyek</li>
				</ol>
			</div>
            <!-- Multiple Items To Be Open -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header bg-purple">
						<h2>Rekening<small>Data Obyek</small></h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">                                        
                                        <li><a title="Tambah" href="<?php echo site_url('parameter/rekening/addo/'.$jenis->kode);?>"><i class="material-icons">add_circle</i> Tambah Obyek</a></li>
                                        <li><a title="Kembali" href="<?php echo site_url('parameter/rekening/jenis/'.$jenis->kelompok);?>"><i class="material-icons">reply</i> Kembali</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">						
                            <div class="row clearfix">
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <!-- Nav tabs -->
                                    <ul class="nav nav-tabs tab-nav-right" role="tablist">
										<li><p class="col-cyan"><a href="<?php echo site_url('parameter/rekening');?>"><i class="material-icons">keyboard_arrow_left</i>Akun</a><p></li>
										<li><p class="col-cyan"><a href="<?php echo site_url('parameter/rekening/kelompok/'.$jenis->akun);?>"><i class="material-icons">keyboard_arrow_left</i>Kelompok</a><p></li>
										<li><p class="col-cyan"><a href="<?php echo site_url('parameter/rekening/jenis/'.$jenis->kelompok);?>"><i class="material-icons">keyboard_arrow_left</i>Jenis</a><p></li>
                                        <li role="presentation" class="active"><a href="#home_animation_2" data-toggle="tab">Obyek</a></li>
                                        <li><a href="javascript:void(0);">Rincian</a></li>
                                    </ul>
                                    <!-- Tab panes -->
                                    <div class="tab-content">
                                        <div role="tabpanel" class="tab-pane animated fadeInRight active" id="home_animation_2">
                                            <b><?php echo validation_errors(); ?><?php if ($this->session->flashdata('success')) { echo $this->session->flashdata('success');} ?></b>
                                            <p><table class="table table-bordered table-striped table-hover js-basic-example dataTable">
											<thead><tr>
												<th style="text-align:left; width:40px">Akun</th>
												<th style="text-align:left; width:70px">Kelompok</th>
												<th style="text-align:left; width:40px">Jenis</th>
												<th style="text-align:left; width:45px">Obyek</th>
												<th style="text-align:center;">Uraian Rekening Obyek</th>
												<th style="text-align:center; width:55px">Action</th>
											</tr></thead>
											<tbody><?php if($obyek):?><?php foreach($obyek as $task):?>
												<tr>
												<td style="text-align:center;"><?php echo $task->akun;?></td>
												<td style="text-align:center;"><?php echo $task->kelompok;?></a></td>
												<td style="text-align:center;"><?php echo $jenis->no;?></a></td>
												<td style="text-align:center;"><?php echo $task->no;?></a></td>												
												<td><a href="<?php echo site_url('parameter/rekening/rincian/'.$task->list_id);?>"><?php echo $task->obyek;?></a></td>
												<td style="text-align:center;">										
												<a class="btn btn-sm btn-warning" title="Ubah" href="<?php echo site_url('parameter/rekening/edito/'.$task->list_id);?>"><i class="fa fa-pencil"></i></a>
												<a class="btn btn-sm btn-danger" title="Hapus" onclick="return confirm('Are you sure?')" href="<?php echo site_url('parameter/rekening/deleteo/'.$task->list_id);?>/<?php echo $this->uri->segment(1); ?>" ><i class="fa fa-trash-o"></i></a>
												</td>
												</tr>
											<?php endforeach; ?></ul>
											<?php else : ?><td>-</td><td>-</td><td>-</td><td>-</td><td style="text-align:center; width:500px">Tidak ada data pada tabel ini</td><td>-</td><?php endif; ?>
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
					 Data Kode Rekening Obyek <font color="red"><strong>"Permanen!"</strong></font>
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
					 Data Rekening Obyek <font color="red"><strong>"Permanen!"</strong></font>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn blue" data-dismiss="modal">OK</button>
				</div>
			</div>
		</div>
	</div>