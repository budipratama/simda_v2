<!-- Main Content -->
	<section class="content">
		<h2>Parameter<small> rekening akrual</small></h2>  
			<div class="body">
				<ol class="breadcrumb breadcrumb-col-cyan">
					<li><a href="<?php echo site_url('dashboard');?>"><i class="material-icons">home</i> Home</a></li>
					<li><a href="<?php echo site_url('parameter');?>"> Parameter</a></li>
					<li><a href="<?php echo site_url('parameter/akrual');?>"> Rekening Akrual</a></li>
					<li class="active"> Jenis</li>
				</ol>
			</div>
            <!-- Multiple Items To Be Open -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header bg-purple">
						<h2>Rekening Akrual<small>Data Jenis</small></h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
										<li><a href="javascript:void(0);" onclick="add_jenis()"><i class="material-icons">add_circle</i> Jenis</a></li>
                                        <li><a title="Kembali" href="<?php echo site_url('parameter/akrual/kelompok/'.$kelompok->akun);?>"><i class="material-icons">reply</i> Kembali</a></li>
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
										<li><p class="col-cyan"><a href="<?php echo site_url('parameter/akrual/kelompok/'.$kelompok->akun);?>"><i class="material-icons">keyboard_arrow_left</i>Kelompok</a><p></li>
                                        <li role="presentation" class="active"><a href="#home_animation_2" data-toggle="tab">Jenis</a></li>
                                        <li><a href="javascript:void(0);">Obyek</a></li>
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
												<th style="text-align:center;">Uraian Rekening Akrual Jenis</th>
												<th style="text-align:center; width:100px">Saldo Normal</th>
												<th style="text-align:center; width:80px"><button type="button" onclick="add_jenis()" class="btn bg-default btn-block btn-xs waves-effect"><i class="material-icons">add_circle</i></button></th>
											</tr></thead>
											<tbody><?php if($jenis):?><?php foreach($jenis as $task):?>
												<tr>
												<td style="text-align:center;"><?php echo $task->kd_akrual_1;?></td>
												<td style="text-align:center;"><?php echo $kelompok->no;?></a></td>
												<td style="text-align:center;"><?php echo $task->no;?></a></td>
												<td><a href="<?php echo site_url('parameter/akrual/obyek/'.$task->list_id);?>"><?php echo $task->jenis;?></a></td>
												<td style="text-align:center;"><?php echo strtoupper($task->saldo_normal);?></a></td>
												<td style="text-align:center;">										
												<a class="btn bg-yellow btn-circle waves-effect waves-circle waves-float" title="Ubah" href="javascript:void(0);" onclick="edit_jenis(<?php echo $task->list_id;?>)"><i class="material-icons">create</i></a>
												<a class="btn bg-red btn-circle waves-effect waves-circle waves-float" title="Hapus" href="<?php echo site_url('parameter/akrual/delete/'.$task->list_id);?>" onclick="return confirm('Are you sure?')"><i class="material-icons">delete</i></a>
												</td>
												</tr>
												<?php endforeach; ?></ul>
												<?php else : ?><td>-</td><td>-</td><td>-</td><td style="text-align:center; width:500px">Tidak ada data pada tabel ini</td><td>-</td><td>-</td><?php endif; ?>
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
					 Data Kode Rekening Akrual Jenis <font color="red"><strong>"Permanen!"</strong></font>
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
					 Data Kode Rekening Akrual Jenis <font color="red"><strong>"Permanen!"</strong></font>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn blue" data-dismiss="modal">OK</button>
				</div>
			</div>
		</div>
	</div>
	
	<div class="modal fade" id="addJenis" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<center><h3 class="modal-title">Rekening Akrual Jenis</h3></center>
			  </div>
			<div class="modal-body form">
				<form action="<?php echo site_url('parameter/akrual/addj');?>" id="form" class="form-horizontal" method="POST">
				<input type="hidden" value="<?php printf( "%01d", $jenis_->no++ );?>"/>
				<input type="hidden" name="aaa_kode" value="<?php echo $kelompok->akun;?>">
				<input type="hidden" name="bbb_kode" value="<?php echo $kelompok->kelompok;?>">
				<div class="form-body">
					<div class="body">
						<div class="row clearfix">
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
								<div class="body">
								<div class="row clearfix">
									<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
										<div class="col-md-5">
											<p><b>Saldo Normal <span class="required">*</span> :</b></p>
											<?php combobox('db', $saldo, 'eee_kode', 'saldo_normal', 'saldo_normal', $saldo_, '', 'Pilih Saldo', 'class="form-control" required');?>											
										</div><br><br><br><br>
									</div>
								</div>
								</div>
								<div class="col-md-2">
									<div class="form-group form-float">
									<div class="form-line">
										<input type="text" class="form-control" name="ccc_kode" id="ccc_kode" value="<?php printf( "%01d", $jenis_->no ); ?>" readonly>
									</div>
									</div>
								</div>
								<div class="col-md-10">
									<div class="form-group form-float">
									<div class="form-line">
										<input type="text" class="form-control" name="ddd_kode" id="ddd_kode" required>
										<label class="form-label">Uraian Rekening Akrual Jenis</label>
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
  
	<div class="modal fade" id="editJenis" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<center><h3 class="modal-title">Rekening Akrual Jenis</h3></center>
			  </div>
			<div class="modal-body form">
				<form action="<?php echo site_url('parameter/akrual/editj');?>" id="form1" class="form-horizontal" method="post">
				<input type="hidden" name="kode"> <input type="hidden" name="kelompok"> <input type="hidden" name="status">
				<div class="form-body">
					<div class="body">
						<div class="row clearfix">
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
								<div class="body">
								<div class="row clearfix">
									<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
										<div class="col-md-5">
											<p><b>Saldo Normal <span class="required">*</span> :</b></p>											
											<?php combobox('db', $saldo, 'eee_kode1', 'saldo_normal', 'saldo_normal', $saldo_, '', 'Pilih Saldo', 'class="form-control" required');?>
										</div><br><br><br><br>
									</div>
								</div>
								</div>
								<div class="col-md-2">
									<div class="form-group form-float">
									<div class="form-line">
										<input type="text" class="form-control" name="ccc_kode" id="ccc_kode" value="<?php printf( "%01d", $jenis_->no ); ?>" readonly>
									</div>
									</div>
								</div>
								<div class="col-md-10">
									<div class="form-group form-float">
									<div class="form-line">
										<input type="text" class="form-control" name="ddd_kode" id="ddd_kode" required>
										<label class="form-label">Uraian Rekening Akrual Jenis</label>
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
  <!-- End Bootstrap modal -->
  
	<script type="text/javascript">
    var save_method; //for save method string

    function add_jenis() {
		save_method = 'add';
		$('#form')[0].reset(); // reset form on modals
		$('#addJenis').modal('show'); // show bootstrap modal
		$('.modal-title').text('Tambah Rekening Akrual Jenis'); // Set title to Bootstrap modal title
		$("#eee_kode").select2({ placeholder: "Pilih ..." });   
    }

    function edit_jenis(id) {
		save_method = 'update';
		$('#form1')[0].reset(); // reset form on modals
		
		//Ajax Load data from ajax
		$.ajax({
			url : "<?php echo site_url('parameter/akrual/ajax_jenis/')?>/" + id,
			type: "GET",
			dataType: "JSON",
			success: function(data)
			{
				$('[name="kode"]').val(data.kode);
				$('[name="ccc_kode"]').val(data.kd_akrual_3);
				$('[name="ddd_kode"]').val(data.nm_akrual_3);
				$('[name="eee_kode1"]').val(data.saldo_normal);
				$('[name="kelompok"]').val(data.kd_akrual_2);
				$('[name="status"]').val(data.status);
				$('#editJenis').modal('show'); // show bootstrap modal when complete loaded
				$('.modal-title').text('Edit Rekening Akrual Jenis'); // Set title to Bootstrap modal title				
				$("#eee_kode1").select2({ placeholder: "Pilih ..." });
			},
				error: function (jqXHR, textStatus, errorThrown)
			{ alert('Error get data from ajax'); }
		});
    }
  </script>