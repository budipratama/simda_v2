<!-- Main Content -->
   <section class="content">
		<h2>Parameter<small> rekening</small></h2>  
			<div class="body">
				<ol class="breadcrumb breadcrumb-col-cyan">
					<li><a href="<?php echo site_url('dashboard');?>"><i class="material-icons">home</i> Home</a></li>
					<li><a href="<?php echo site_url('parameter');?>"> Parameter</a></li>
					<li><a href="<?php echo site_url('parameter/rekening');?>"> Rekening</a></li>
					<li class="active"> Rincian</li>
				</ol>
			</div>
            <!-- Multiple Items To Be Open -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header bg-purple">
						<h2>Rekening<small>Data Rincian</small></h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">                                        
                                        <li><a title="Tambah" href="javascript:void(0);" onclick="add_rincian()"><i class="material-icons">add_circle</i> Rincain</a></li>
                                        <li><a title="Kembali" href="<?php echo site_url('parameter/rekening/obyek/'.$obyek->jenis);?>"><i class="material-icons">reply</i> Kembali</a></li>
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
										<li><p class="col-cyan"><a href="<?php echo site_url('parameter/rekening/kelompok/'.$obyek->akun);?>"><i class="material-icons">keyboard_arrow_left</i>Kelompok</a><p></li>
										<li><p class="col-cyan"><a href="<?php echo site_url('parameter/rekening/jenis/'.$obyek->kelompok);?>"><i class="material-icons">keyboard_arrow_left</i>Jenis</a><p></li>
										<li><p class="col-cyan"><a href="<?php echo site_url('parameter/rekening/obyek/'.$obyek->jenis);?>"><i class="material-icons">keyboard_arrow_left</i>Obyek</a><p></li>
                                        <li role="presentation" class="active"><a href="#home_animation_2" data-toggle="tab">Rincian</a></li>
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
												<th style="text-align:left; width:55px">Rincian</th>
												<th style="text-align:center;">Uraian Rincian Obyek</th>
												<th style="text-align:center; width:100px">Peraturan</th>
												<th style="text-align:center; width:80px"><button type="button" onclick="add_rincian()" class="btn bg-default btn-block btn-xs waves-effect"><i class="material-icons">add_circle</i></button></th>
											</tr></thead>
											<tbody><?php if($rincian) : ?><?php foreach($rincian as $task) : ?>
												<tr>
													<td style="text-align:center;"><?php echo $task->akun;?></td>
													<td style="text-align:center;"><?php echo $task->kelompok;?></a></td>
													<td style="text-align:center;"><?php echo $task->jenis;?></a></td>
													<td style="text-align:center;"><?php echo $obyek->no;?></a></td>
													<td style="text-align:center;"><?php echo $task->no;?></a></td>
													<td><?php echo $task->rincian;?></td>
													<td><?php echo $task->peraturan;?></td>
													<td style="text-align:center;">										
													<a class="btn bg-yellow btn-circle waves-effect waves-circle waves-float" title="Ubah" href="javascript:void(0);" onclick="edit_rincian(<?php echo $task->list_id;?>)"><i class="material-icons">create</i></a>
													<a class="btn bg-red btn-circle waves-effect waves-circle waves-float" title="Hapus" onclick="return confirm('Are you sure?')" href="<?php echo site_url('parameter/rekening/deleter/'.$task->list_id);?>"><i class="material-icons">delete</i></a>
													</td>
												</tr>
											<?php endforeach; ?></ul>
											<?php else : ?><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td style="text-align:center; width:500px">Tidak ada data pada tabel ini</td><td>-</td><td>-</td><?php endif; ?>
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
					 Data Kode Rekening Rincian <font color="red"><strong>"Permanen!"</strong></font>
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
					 Data Rekening Rincian <font color="red"><strong>"Permanen!"</strong></font>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn blue" data-dismiss="modal">OK</button>
				</div>
			</div>
		</div>
	</div>
	
	<div class="modal fade" id="addRincian" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<center><h3 class="modal-title">Rekening Rincian</h3></center>
			  </div>
			<div class="modal-body form">
				<form action="<?php echo site_url('parameter/rekening/addr');?>" id="form" class="form-horizontal" method="post" >
				<input type="hidden" value="<?php printf("%01d", $rincian_->no++); ?>" />
				<input type="hidden" name="aaa_kode" value="<?php echo $obyek->akun;?>">
				<input type="hidden" name="bbb_kode" value="<?php echo $obyek->kelompok;?>">
				<input type="hidden" name="ccc_kode" value="<?php echo $obyek->jenis;?>">
				<input type="hidden" name="ddd_kode" value="<?php echo $obyek->obyek;?>">
				<div class="form-body">
					<div class="body">
						<div class="row clearfix">
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
								<div class="col-md-2">
									<div class="form-group form-float">
									<div class="form-line">
										<input type="text" class="form-control" name="eee_kode" id="eee_kode" value="<?php printf( "%01d", $rincian_->no ); ?>" readonly>
									</div>
									</div>
								</div>
								<div class="col-md-10">
									<div class="form-group form-float">
									<div class="form-line">
										<input type="text" class="form-control" name="rrr_kode" id="rrr_kode" required>
										<label class="form-label">Uraian Rekening Rincian</label>
									</div>
									</div>
								</div><br><br><br>
								<div class="body">
									<div class="row clearfix">
										<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
										<div class="col-md-12">
											<div class="form-group form-float">
												<div class="form-line">
													<input type="text" class="form-control" name="ppp_kode" id="ppp_kode" value="-" required>
													<label class="form-label">Peraturan</label>
												</div>
												</div>
											</div>
										</div>
									</div><br>
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
	
	<div class="modal fade" id="editRincian" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<center><h3 class="modal-title">Rekening Rincian</h3></center>
			  </div>
			<div class="modal-body form">
				<form action="<?php echo site_url('parameter/rekening/editr');?>" id="form1" class="form-horizontal" method="post" >
				<input type="hidden" name="kode"> <input type="hidden" name="status"> <input type="hidden" name="obyek">
				<div class="form-body">
					<div class="body">
						<div class="row clearfix">
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
								<div class="col-md-2">
									<div class="form-group form-float">
									<div class="form-line">
										<input type="text" class="form-control" name="ddd_kode" id="ddd_kode" readonly>
									</div>
									</div>
								</div>
								<div class="col-md-10">
									<div class="form-group form-float">
									<div class="form-line">
										<input type="text" class="form-control" name="eee_kode" id="eee_kode" required>
										<label class="form-label">Uraian Rekening Rincian</label>
									</div>
									</div>
								</div><br><br><br>
								<div class="body">
									<div class="row clearfix">
										<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
										<div class="col-md-12">
											<div class="form-group form-float">
												<div class="form-line">
													<input type="text" class="form-control" name="ppp_kode" id="ppp_kode" value="-" required>
													<label class="form-label">Peraturan</label>
												</div>
												</div>
											</div>
										</div>
									</div><br>
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

    function add_rincian() {
		save_method = 'add';
		$('#form')[0].reset(); // reset form on modals
		$('#addRincian').modal('show'); // show bootstrap modal
		$('.modal-title').text('Tambah Rekening Rincian'); // Set title to Bootstrap modal title
    }

    function edit_rincian(id) {
		save_method = 'update';
		$('#form1')[0].reset(); // reset form on modals
		
		//Ajax Load data from ajax
		$.ajax({
			url : "<?php echo site_url('parameter/rekening/ajax_rincian/')?>/" + id,
			type: "GET",
			dataType: "JSON",
			success: function(data)
			{
				$('[name="kode"]').val(data.kode);
				$('[name="ddd_kode"]').val(data.kd_rek_5);
				$('[name="eee_kode"]').val(data.nm_rek_5);
				$('[name="ppp_kode"]').val(data.peraturan);
				$('[name="obyek"]').val(data.kd_rek_4);
				$('[name="status"]').val(data.status);
				$('#editRincian').modal('show'); // show bootstrap modal when complete loaded
				$('.modal-title').text('Edit Rekening Rincian'); // Set title to Bootstrap modal title				
			},
				error: function (jqXHR, textStatus, errorThrown)
			{ alert('Error get data from ajax'); }
		});
    }
  </script>	