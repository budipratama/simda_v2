<!-- Main Content -->
   <section class="content">
		<h2>Parameter<small> rekening sub rincian belanja modal</small></h2>  
			<div class="body">
				<ol class="breadcrumb breadcrumb-col-cyan">
					<li><a href="<?php echo site_url('dashboard');?>"><i class="material-icons">home</i> Home</a></li>
					<li><a href="<?php echo site_url('parameter');?>"> Parameter</a></li>
					<li><a href="<?php echo site_url('parameter/rekening-sub');?>"> Rekening Sub Rincian Belanja Modal</a></li>
					<li class="active"> Sub Rincian</li>
				</ol>
			</div>
            <!-- Multiple Items To Be Open -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header bg-purple">
						<h2>Rekening Sub Rincian Belanja Modal<small>Data Sub Rincian</small></h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
										<li><a href="javascript:void(0);" onclick="add_sub()"><i class="material-icons">add_circle</i> Sub Rincian</a></li>
                                        <li><a title="Kembali" href="<?php echo site_url('parameter/rekening-sub/rincian/'.$rincian->obyek);?>"><i class="material-icons">reply</i> Kembali</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <div class="row clearfix">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <!-- Nav tabs -->
                                    <ul class="nav nav-tabs tab-nav-right" role="tablist">
										<li><p class="col-cyan"><a href="<?php echo site_url('parameter/rekening-sub');?>"><i class="material-icons">keyboard_arrow_left</i>Obyek</a><p></li>
										<li><p class="col-cyan"><a href="<?php echo site_url('parameter/rekening-sub/rincian/'.$rincian->obyek);?>"><i class="material-icons">keyboard_arrow_left</i>Rincian</a><p></li>
                                        <li role="presentation" class="active"><a href="#home_animation_1" data-toggle="tab">Sub Rincian</a></li>
                                    </ul>
                                    <!-- Tab panes -->
                                    <div class="tab-content">
                                        <div role="tabpanel" class="tab-pane animated flipInX active" id="home_animation_1">
                                            <b><?php echo validation_errors(); ?><?php if ($this->session->flashdata('success')) { echo $this->session->flashdata('success');} ?></b>
                                            <p><table class="table table-bordered table-striped table-hover js-basic-example dataTable">
											<thead>
											<tr>
												<th style="text-align:center; width:80px">Obyek</th>
												<th style="text-align:center; width:80px">Rincian</th>
												<th style="text-align:center; width:80px">Sub Rinc.</th>
												<th style="text-align:center;">Uraian Sub Rincian Belanja Modal</th>
												<th style="text-align:center; width:80px"><button type="button" onclick="add_sub()" class="btn bg-default btn-block btn-xs waves-effect"><i class="material-icons">add_circle</i></button></th>
											</tr>
											</thead>
											<tbody><?php if(isset($sub)):?><?php foreach($sub as $list):?>
												<tr>												
													<td style="text-align:center;"><?php echo $list->obyek;?></td>													
													<td style="text-align:center;"><?php echo $list->rincian;?></td>													
													<td style="text-align:center;"><?php echo $list->no;?></td>													
													<td><?php echo $list->sub;?></td>
													<td style="text-align:center;">										
													<a class="btn bg-yellow btn-circle waves-effect waves-circle waves-float" title="Ubah" href="javascript:void(0);" onclick="edit_sub(<?php echo $list->list_id;?>)"><i class="material-icons">create</i></a>
													<a class="btn bg-red btn-circle waves-effect waves-circle waves-float" title="Hapus" onclick="return confirm('Are you sure?')" href="<?php echo site_url('parameter/rekening-sub/delete/'.$list->list_id);?>"><i class="material-icons">delete</i></a>
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
            </div>
            <!-- #END# Tabs With Custom Animations -->
        </div>
    </section>
<!-- END CONTENT -->	
	<div class="modal fade" id="addSub" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<center><h3 class="modal-title">Rekening Sub Rincian</h3></center>
			  </div>
			<div class="modal-body form">
				<form action="<?php echo site_url('parameter/rekening-sub/add');?>" id="form" class="form-horizontal" method="post" >
				<input type="hidden" value="<?php printf("%01d", $sub_->no++); ?>" />
				<input type="hidden" name="aaa_kode" value="<?php echo $rincian->akun;?>">
				<input type="hidden" name="bbb_kode" value="<?php echo $rincian->kelompok;?>">
				<input type="hidden" name="ccc_kode" value="<?php echo $rincian->jenis;?>">
				<input type="hidden" name="ddd_kode" value="<?php echo $rincian->obyek;?>">
				<input type="hidden" name="eee_kode" value="<?php echo $rincian->rincian;?>">
				<div class="form-body">
					<div class="body">
						<div class="row clearfix">
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
								<div class="col-md-2">
									<div class="form-group form-float">
									<div class="form-line">
										<input type="text" class="form-control" name="fff_kode" id="fff_kode" value="<?php printf( "%01d", $sub_->no ); ?>" readonly>
									</div>
									</div>
								</div>
								<div class="col-md-10">
									<div class="form-group form-float">
									<div class="form-line">
										<input type="text" class="form-control" name="sss_kode" id="sss_kode" required>
										<label class="form-label">Uraian Sub Rincian</label>
									</div>
									</div>
								</div><br><br><br>
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
	
	<div class="modal fade" id="editSub" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<center><h3 class="modal-title">Rekening Rincian</h3></center>
			  </div>
			<div class="modal-body form">
				<form action="<?php echo site_url('parameter/rekening-sub/edit');?>" id="form1" class="form-horizontal" method="post" >
				<input type="hidden" name="kode"> <input type="hidden" name="status"> <input type="hidden" name="rincian">
				<div class="form-body">
					<div class="body">
						<div class="row clearfix">
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
								<div class="col-md-2">
									<div class="form-group form-float">
									<div class="form-line">
										<input type="text" class="form-control" name="fff_kode" id="fff_kode" readonly>
									</div>
									</div>
								</div>
								<div class="col-md-10">
									<div class="form-group form-float">
									<div class="form-line">
										<input type="text" class="form-control" name="sss_kode" id="sss_kode" required>
										<label class="form-label">Uraian Sub Rincian</label>
									</div>
									</div>
								</div><br><br><br>
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

    function add_sub() {
		save_method = 'add';
		$('#form')[0].reset(); // reset form on modals
		$('#addSub').modal('show'); // show bootstrap modal
		$('.modal-title').text('Tambah Rekening Sub Rincian Belanja Modal'); // Set title to Bootstrap modal title
    }

    function edit_sub(id) {
		save_method = 'update';
		$('#form1')[0].reset(); // reset form on modals
		
		//Ajax Load data from ajax
		$.ajax({
			url : "<?php echo site_url('parameter/rekening_sub/ajax_sub/')?>/" + id,
			type: "GET",
			dataType: "JSON",
			success: function(data)
			{
				$('[name="kode"]').val(data.kode);
				$('[name="fff_kode"]').val(data.kd_sub_modal);
				$('[name="sss_kode"]').val(data.nm_sub_modal);
				$('[name="rincian"]').val(data.kd_rek_5);
				$('[name="status"]').val(data.status);
				$('#editSub').modal('show'); // show bootstrap modal when complete loaded
				$('.modal-title').text('Edit Rekening Sub Rincian Belanja Modal'); // Set title to Bootstrap modal title				
			},
				error: function (jqXHR, textStatus, errorThrown)
			{ alert('Error get data from ajax'); }
		});
    }
  </script>	