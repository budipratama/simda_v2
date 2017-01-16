<!-- Main Content -->
   <section class="content">
		<h2>Parameter<small> rekening</small></h2>  
			<div class="body">
				<ol class="breadcrumb breadcrumb-col-cyan">
					<li><a href="<?php echo site_url('dashboard');?>"><i class="material-icons">home</i> Home</a></li>
					<li><a href="<?php echo site_url('parameter');?>"> Parameter</a></li>
					<li><a href="<?php echo site_url('parameter/rekening');?>"> Rekening</a></li>
					<li class="active"> Jenis</li>
				</ol>
			</div>
            <!-- Multiple Items To Be Open -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header bg-purple">
						<h2>Rekening<small>Data Jenis</small></h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
										<li><a title="Tambah" href="javascript:void(0);" onclick="add_jenis()"><i class="material-icons">add_circle</i> Tambah Jenis</a></li>
                                        <li><a title="Kembali" href="<?php echo site_url('parameter/rekening/kelompok/'.$kelompok->akun);?>"><i class="material-icons">reply</i> Kembali</a></li>
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
										<li><p class="col-cyan"><a href="<?php echo site_url('parameter/rekening/kelompok/'.$kelompok->akun);?>"><i class="material-icons">keyboard_arrow_left</i>Kelompok</a><p></li>
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
												<th style="text-align:center;">Uraian Rekening Jenis</th>
												<th style="text-align:center; width:100px">Saldo Normal</th>
												<th style="text-align:center; width:55px">Action</th>
											</tr></thead>
											<tbody><?php if($jenis):?><?php foreach($jenis as $task):?>
												<tr>
												<td style="text-align:center;"><?php echo $task->kd_rek_1;?></td>
												<td style="text-align:center;"><?php echo $kelompok->no;?></a></td>
												<td style="text-align:center;"><?php echo $task->no;?></a></td>
												<td><a href="<?php echo site_url('parameter/rekening/obyek/'.$task->list_id);?>"><?php echo $task->jenis;?></a></td>
												<td style="text-align:center;"><?php echo $task->saldo_normal;?></a></td>
												<td style="text-align:center;">										
												<a class="btn btn-sm btn-warning" title="Ubah" href="javascript:void(0);" onclick="edit_book(<?php echo $task->list_id;?>)"><i class="fa fa-pencil"></i></a>
												<a class="btn btn-sm btn-danger" title="Hapus" href="<?php echo site_url('parameter/rekening/delete/'.$task->list_id);?>" onclick="return confirm('Are you sure?')"><i class="fa fa-trash-o"></i></a>
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
					 Data Kode Rekening Jenis <font color="red"><strong>"Permanen!"</strong></font>
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
					 Data Rekening <font color="red"><strong>"Permanen!"</strong></font>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn blue" data-dismiss="modal">OK</button>
				</div>
			</div>
		</div>
	</div>
	
	<!-- Bootstrap modal -->
	<div class="modal fade" id="modal_form" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h3 class="modal-title">Book Form</h3>
				</div>
				<div class="modal-body form">			
					<form id="form" action="#" class="form-horizontal" method="post">
					<input type="hidden" name="kode"/>
					<input type="hidden" value="<?php printf( "%01d", $jenis_->no++ );?>"/>
					<input type="hidden" name="aaa_kode" value="<?php echo $kelompok->akun;?>">
					<input type="hidden" name="bbb_kode" value="<?php echo $kelompok->kelompok;?>">
					<div class="modal-body">
						<div class="form-body">
							<div class="body">
								<div class="row clearfix">
									<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
									<div class="body">
										<div class="row clearfix">
											<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
												<div class="col-md-5">
													<p><b>Saldo Normal <span class="required">*</span> :</b></p>
													<select type="text" name="eee_kode" id="eee_kode" class="form-control show-tick" data-live-search="true" tabindex="1" required="required">
														<option value="debet">Debet</option>
														<option value="kredit">Kredit</option>
													</select>
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
											<label class="form-label">Uraian Rekening Jenis</label>
										</div>
										</div>
									</div>
									</div>
								</div>
							</div><br>
						</div>
					</div>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
					<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
  <!-- End Bootstrap modal -->	
	<script type="text/javascript">
	var save_method; //for save method string

    function add_jenis() {
      save_method = 'add';
		$('#form')[0].reset(); // reset form on modals
		$('#modal_form').modal('show'); // show bootstrap modal
		$('.modal-title').text('Add Person'); // Set Title to Bootstrap modal title
    }
	
    function edit_book(id) {
      save_method = 'update';
      $('#form')[0].reset(); // reset form on modals

      //Ajax Load data from ajax
      $.ajax({
        url : "<?php echo site_url('parameter/rekening/get_jenis/')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data) {
            $('[name="kode"]').val(data.kode);
            $('[name="ccc_kode"]').val(data.no);
            $('[name="ddd_kode"]').val(data.nm_rek_3);
            $('[name="eee_kode"]').val(data.saldo_normal);

            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Book'); // Set title to Bootstrap modal title
        }, error: function (jqXHR, textStatus, errorThrown)
        { alert('Error get data from ajax'); }
		});
    }
	
	function save() {
		var url;
		if(save_method == 'add') {
			url = "<?php echo site_url('parameter/rekening/addj')?>";
		} else {
			url = "<?php echo site_url('parameter/rekening/editj')?>";
		}

		// ajax adding data to database
		$.ajax({
		url : url, type: "POST", data: $('#form').serialize(), dataType: "JSON", success: function(data) {
			//if success close modal and reload ajax table
			$('#modal_form').modal('hide');
			location.reload();// for reload a page
		}, error: function (jqXHR, textStatus, errorThrown)
		{ alert('Error adding / update data'); }
        });
    }
	</script>