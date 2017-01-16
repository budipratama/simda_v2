<!-- Main Content -->
   <section class="content">
		<h2>Parameter<small> unit organisasi</small></h2>  
			<div class="body">
				<ol class="breadcrumb breadcrumb-col-cyan">
					<li><a href="<?php echo site_url('dashboard');?>"><i class="material-icons">home</i> Home</a></li>
					<li><a href="<?php echo site_url('parameter');?>"> Parameter</a></li>
					<li><a href="<?php echo site_url('parameter/unit-organisasi');?>"> Unit Organisasi</a></li>
					<li class="active"> Sub Unit</li>
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
                                        <button type="button" class="btn bg-black waves-effect waves-light">ACTIONS</button>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="<?php echo site_url('parameter/unit-organisasi/add/'.$unit->id_skpd);?>"><i class="material-icons">add_circle</i> Add</a></li>
                                        <li><a href="<?php echo site_url('parameter/unit-organisasi/unit/'.$unit->urusan);?>"><i class="material-icons">reply</i> Kembali</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <div class="row clearfix">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <!-- Nav tabs -->
									<ul class="nav nav-tabs tab-nav-right" role="tablist">
                                        <li><p class="col-cyan"><a href="<?php echo site_url('parameter/unit-organisasi');?>"><i class="material-icons">keyboard_arrow_left</i>Urusan</a></p></li>
                                        <li><p class="col-cyan"><a href="<?php echo site_url('parameter/unit-organisasi/bidang/'.$unit->id_urusan);?>"><i class="material-icons">keyboard_arrow_left</i>Bidang</a></p></li>
                                        <li><p class="col-cyan"><a href="<?php echo site_url('parameter/unit-organisasi/unit/'.$unit->urusan);?>"><i class="material-icons">keyboard_arrow_left</i>Unit</a></p></li>
                                        <li role="presentation" class="active"><a href="javascript:void(0);" data-toggle="tab">Sub Unit</a></li>
                                    </ul>
                                    <!-- Tab panes -->
                                    <div class="tab-content">
                                        <div role="tabpanel" class="tab-pane animated fadeInRight active" id="home_animation_2">
                                            <b><!--<?php echo validation_errors(); ?><?php if ($this->session->flashdata('success')) { echo $this->session->flashdata('success');} ?>--></b>
                                            <p><table class="table table-bordered table-striped table-hover js-basic-example dataTable">
											<thead><tr>
											<th style="text-align:center; width:60px">Urusan</th>
											<th style="text-align:center; width:60px">Bidang</th>
											<th style="text-align:center; width:60px">Unit</th>
											<th style="text-align:center; width:60px">Sub</th>
											<th style="text-align:center;">Uraian Nama Sub Unit</th>
											<th style="text-align:center; width:80px">Action</th>
											</tr></thead>
												<tbody><?php if($sub):?><?php foreach($sub as $task):?>
													<tr>
													<td style="text-align:center;"><?php echo $task->no_urusan;?></td>
													<td style="text-align:center;"><?php echo $task->urusan_id;?></a></td>
													<td style="text-align:center;"><?php echo $unit->no_skpd;?></a></td>
													<td style="text-align:center;"><?php echo $task->no;?></a></td>
													<td style="text-align:left;"><?php echo $task->nm_sub;?></a></td>
													<td style="text-align:center;">
														<a class="btn btn-warning btn-circle waves-effect waves-circle waves-float" title="Ubah" href="<?php echo site_url('parameter/unit-organisasi/edits/'.$task->task_id);?>"><i class="material-icons">border_color</i></a>
														<a class="btn btn-danger btn-circle waves-effect waves-circle waves-float" title="Hapus" onclick="return confirm('Are you sure?')" href="<?php echo site_url('parameter/unit-organisasi/deletes/'.$task->task_id);?>/<?php echo $this->uri->segment(1);?>"><i class="material-icons">delete_forever</i></a>
													</td>
													</tr>
													<?php endforeach; ?><?php else : ?><td>-</td><td>-</td><td style="text-align:center; width:500px">Tidak ada data pada tabel ini</td><td>-</td><td>-</td><td>-</td><?php endif; ?>
												</tbody>
											</table></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Tabs With Custom Animations material-icons create -->
        </div>
    </section>
	
	<a href="#successDelete" data-toggle="modal"></a>
	<div id="successDelete" class="modal fade" role="dialog" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
					<h4 class="modal-title"><strong>Warning!</strong> Hapus Sub Unit Organisasi</h4>
				</div>
				<div class="modal-body">
					 Data <font color="green"><strong>"Sub Unit"</strong></font> telah berhasil dihapus !</font>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn green" data-dismiss="modal">OK</button>
				</div>
			</div>
		</div>
	</div>