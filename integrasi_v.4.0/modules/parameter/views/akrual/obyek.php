<!-- Main Content -->
   <section class="content">
		<h2>Parameter<small> rekening akrual</small></h2>  
			<div class="body">
				<ol class="breadcrumb breadcrumb-col-cyan">
					<li><a href="<?php echo site_url('dashboard');?>"><i class="material-icons">home</i> Home</a></li>
					<li><a href="<?php echo site_url('parameter');?>"> Parameter</a></li>
					<li><a href="<?php echo site_url('parameter/akrual');?>"> Rekening Akrual</a></li>
					<li class="active"> Obyek</li>
				</ol>
			</div>
            <!-- Multiple Items To Be Open -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header bg-purple">
						<h2>Rekening Akrual<small>Data Obyek</small></h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">                                        
                                        <li><a href="javascript:void(0);" onclick="add_obyek()"><i class="material-icons">add_circle</i> Obyek</a></li>
                                        <li><a title="Kembali" href="<?php echo site_url('parameter/akrual/jenis/'.$jenis->kelompok);?>"><i class="material-icons">reply</i> Kembali</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
					<div class="body">						
						<div class="row clearfix">
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
								<!-- Nav tabs -->
								<ul class="nav nav-tabs tab-nav-right" role="tablist">
									<li><p class="col-cyan"><a href="<?php echo site_url('parameter/akrual');?>"><i class="material-icons">keyboard_arrow_left</i>Akun</a><p></li>
									<li><p class="col-cyan"><a href="<?php echo site_url('parameter/akrual/kelompok/'.$jenis->akun);?>"><i class="material-icons">keyboard_arrow_left</i>Kelompok</a><p></li>
									<li><p class="col-cyan"><a href="<?php echo site_url('parameter/akrual/jenis/'.$jenis->kelompok);?>"><i class="material-icons">keyboard_arrow_left</i>Jenis</a><p></li>
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
											<th style="text-align:center;">Uraian Rekening Akrual Obyek</th>
											<th style="text-align:center; width:80px"><button type="button" onclick="add_obyek()" class="btn bg-default btn-block btn-xs waves-effect"><i class="material-icons">add_circle</i></button></th></th>
										</tr></thead>
										<tbody><?php if($obyek):?><?php foreach($obyek as $task):?>
											<tr>
												<td style="text-align:center;"><?php echo $task->akun;?></td>
												<td style="text-align:center;"><?php echo $task->kelompok;?></a></td>
												<td style="text-align:center;"><?php echo $jenis->no;?></a></td>
												<td style="text-align:center;"><?php echo $task->no;?></a></td>												
												<td><a href="<?php echo site_url('parameter/akrual/rincian/'.$task->list_id);?>"><?php echo $task->obyek;?></a></td>
												<td style="text-align:center;">										
												<a class="btn bg-yellow btn-circle waves-effect waves-circle waves-float" title="Ubah" href="javascript:void(0);" onclick="edit_obyek(<?php echo $task->list_id;?>)"><i class="material-icons">create</i></a>
												<a class="btn bg-red btn-circle waves-effect waves-circle waves-float" title="Hapus" onclick="return confirm('Are you sure?')" href="<?php echo site_url('parameter/akrual/deleteo/'.$task->list_id);?>"><i class="material-icons">delete</i></a>
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
	
	<div class="modal fade" id="addObyek" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<center><h3 class="modal-title">Rekening Akrual Obyek</h3></center>
			  </div>
			<div class="modal-body form">
				<form action="<?php echo site_url('parameter/akrual/addo');?>" id="form" class="form-horizontal" method="post">
				<input type="hidden" value="<?php printf( "%01d", $obyek_->no++ );?>">
				<input type="hidden" name="aaa_kode" value="<?php echo $jenis->akun;?>">
				<input type="hidden" name="bbb_kode" value="<?php echo $jenis->kelompok;?>">
				<input type="hidden" name="ccc_kode" value="<?php echo $jenis->jenis;?>">
				<div class="form-body">
					<div class="body">
						<div class="row clearfix">
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
								<div class="col-md-2">
									<div class="form-group form-float">
									<div class="form-line">
										<input type="text" class="form-control" name="ddd_kode" id="ddd_kode" value="<?php printf( "%01d", $obyek_->no ); ?>" readonly>
									</div>
									</div>
								</div>
								<div class="col-md-10">
									<div class="form-group form-float">
									<div class="form-line">
										<input type="text" class="form-control" name="eee_kode" id="eee_kode" required>
										<label class="form-label">Uraian Rekening Akrual Obyek</label>
									</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
				<div class="modal-footer">
				<button type="submit" class="btn btn-primary">Save</button>
					<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
				</div>
				</form>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
	
	<div class="modal fade" id="editObyek" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<center><h3 class="modal-title">Rekening Akrual Obyek</h3></center>
			  </div>
			<div class="modal-body form">
				<form action="<?php echo site_url('parameter/akrual/edito');?>" id="form1" class="form-horizontal" method="post">
				<input type="hidden" name="kode"> <input type="hidden" name="jenis"> <input type="hidden" name="status">
				<div class="form-body">
					<div class="body">
						<div class="row clearfix">
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
								<div class="col-md-2">
									<div class="form-group form-float">
									<div class="form-line">
										<input type="text" class="form-control" name="ddd_kode" id="ddd_kode" value="<?php printf( "%01d", $obyek_->no ); ?>" readonly>
									</div>
									</div>
								</div>
								<div class="col-md-10">
									<div class="form-group form-float">
									<div class="form-line">
										<input type="text" class="form-control" name="eee_kode" id="eee_kode" required>
										<label class="form-label">Uraian Rekening Akrual Obyek</label>
									</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
				<div class="modal-footer">
				<button type="submit" class="btn btn-primary">Save</button>
					<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
				</div>
				</form>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

	<script type="text/javascript">
    var save_method; //for save method string

    function add_obyek() {
		save_method = 'add';
		$('#form')[0].reset(); // reset form on modals
		$('#addObyek').modal('show'); // show bootstrap modal
		$('.modal-title').text('Tambah Rekening Akrual Obyek'); // Set title to Bootstrap modal title
    }

    function edit_obyek(id) {
		save_method = 'update';
		$('#form1')[0].reset(); // reset form on modals
		
		//Ajax Load data from ajax
		$.ajax({
			url : "<?php echo site_url('parameter/akrual/ajax_obyek/')?>/" + id,
			type: "GET",
			dataType: "JSON",
			success: function(data)
			{
				$('[name="kode"]').val(data.kode);
				$('[name="ddd_kode"]').val(data.kd_akrual_4);
				$('[name="eee_kode"]').val(data.nm_akrual_4);
				$('[name="jenis"]').val(data.kd_akrual_3);
				$('[name="status"]').val(data.status);
				$('#editObyek').modal('show'); // show bootstrap modal when complete loaded
				$('.modal-title').text('Edit Rekening Akrual Obyek'); // Set title to Bootstrap modal title				
			},
				error: function (jqXHR, textStatus, errorThrown)
			{ alert('Error get data from ajax'); }
		});
    }
  </script>	