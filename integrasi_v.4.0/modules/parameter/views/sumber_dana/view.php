<!-- Main Content -->
   <section class="content">
		<h2>Parameter<small> sumber dana</small></h2>  
			<div class="body">
				<ol class="breadcrumb breadcrumb-col-cyan">
					<li><a href="<?php echo site_url('dashboard');?>"><i class="material-icons">home</i> Home</a></li>
					<li><a href="<?php echo site_url('parameter');?>"> Parameter</a></li>
					<li><a href="<?php echo site_url('parameter/sumber-dana');?>"> Sumber Dana</a></li>
				</ol>
			</div>
            <!-- Multiple Items To Be Open -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header bg-purple">
						<h2>Rekening<small>Data Sumber Dana</small></h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">                                        
                                        <li><a title="Kembali" href="<?php echo base_url('parameter'); ?>"><i class="material-icons">reply</i> Kembali</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <div class="row clearfix">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">                                    
                                    <!-- Tab panes -->
                                    <div class="tab-content">
                                        <div role="tabpanel" class="tab-pane animated flipInX active" id="home_animation_1">
                                            <b><?php echo validation_errors(); ?><?php if ($this->session->flashdata('success')) { echo $this->session->flashdata('success');} ?></b>
                                            <p><table class="table table-bordered table-striped table-hover js-basic-example dataTable">
											<thead>
											<tr>
												<th style="text-align:center; width:70px">Sumber</th>
												<th style="text-align:center;">Uraian Nama Sumber</th>
												<th style="text-align:center; width:80px"><button type="button" onclick="add_sumber()" class="btn bg-default btn-block btn-xs waves-effect"><i class="material-icons">add_circle</i></button></th>
											</tr>
											</thead>
											<tbody><?php if(isset($sumber)):?><?php foreach($sumber as $list):?>
												<tr>
													<td style="text-align:center;"><?php echo $list->sumber;?></td>
													<td><?php echo $list->nama;?></td>
													<td></td>
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
<div class="modal fade" id="addSumber" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<center><h3 class="modal-title">Rekening Jenis</h3></center>
			  </div>
			<div class="modal-body form">
				<form action="<?php echo site_url('parameter/sumber-dana/add');?>" id="form" class="form-horizontal" method="POST">
				<input type="hidden" value="<?php printf( "%01d", $jenis_->no++ );?>"/>
				<div class="form-body">
					<div class="body">
						<div class="row clearfix">
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
								<div class="body">
								<div class="row clearfix">
									<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
										<div class="col-md-2">
											<p><b>Kode <span class="required">*</span> :</b></p>
											<div>
											<input type="input" class="form-control" name="kkk_kode" required>
											</div>
										</div><br><br><br><br>
										
										<div class="col-md-12">
											<p><b>Nama <span class="required">*</span> :</b></p>
											<div>
											<input type="input" class="form-control" name="aaa_kode" required>
											</div>
										</div><br><br><br><br>										
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

    function add_sumber() {
		save_method = 'add';
		$('#form')[0].reset(); // reset form on modals
		$('#addSumber').modal('show'); // show bootstrap modal
		$('.modal-title').text('Tambah Sumber Dana'); // Set title to Bootstrap modal title
    }

    function edit_jenis(id) {
		save_method = 'update';
		$('#form1')[0].reset(); // reset form on modals
		
		//Ajax Load data from ajax
		$.ajax({
			url : "<?php echo site_url('parameter/sumber_dana/ajax_sumber/')?>/" + id,
			type: "GET",
			dataType: "JSON",
			success: function(data)
			{
				$('[name="kode"]').val(data.kode);
				$('[name="ccc_kode"]').val(data.kd_rek_3);
				$('[name="ddd_kode"]').val(data.nm_rek_3);
				$('[name="eee_kode1"]').val(data.saldo_normal);
				$('[name="kelompok"]').val(data.kd_rek_2);
				$('[name="status"]').val(data.status);
				$('#editJenis').modal('show'); // show bootstrap modal when complete loaded
				$('.modal-title').text('Edit Sumber Dana'); // Set title to Bootstrap modal title				
			},
				error: function (jqXHR, textStatus, errorThrown)
			{ alert('Error get data from ajax'); }
		});
    }
  </script>