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
						<p align="center"><b><?php echo strtoupper($skpd_nama);?></b></p>
						<p class="control-label col-md-10">Program &nbsp;:&nbsp; <?php echo $rka->id_program;?></p>
						<p class="control-label col-md-10">Kegiatan &nbsp;:&nbsp; <?php echo $rka->id_kegiatan;?></p>
						<p class="control-label col-md-10">Rekening :&nbsp; <?php echo $rka->id_akun;?>.<?php echo $rka->id_kelompok;?>.<?php echo $rka->id_jenis;?>.<?php echo $rka->id_obyek;?>.<?php echo $rka->id_rincian;?> <?php echo $rka->nama_rincian;?></p>
                        <ul class="header-dropdown m-r--5">
                            <li class="dropdown">
                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                    <button type="button" class="btn bg-black waves-effect waves-light">ACTIONS</button>
                                </a>
                                <ul class="dropdown-menu pull-right">
                                <!--<li><a title="Tambah" href="<?php echo site_url('rka/murni/addr/'.$rka->task_id);?>"><i class="material-icons">add_circle_outline</i> Rincian Belanja</a></li>-->
                                    <li><a title="Kembali" href="<?php echo base_url('rka/murni/belanja/'.$rka->kd_anggaran);?>"><i class="material-icons">reply</i> Kembali</a></li>
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
                                    <li><p class="col-cyan"><a href="<?php echo base_url('rka/murni/belanja/'.$rka->kd_anggaran);?>"><i class="material-icons">keyboard_arrow_left</i>Belanja</a></p></li>									
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
										<th style="text-align:center; width:80px"><button type="button" onclick="add_rinc()" class="btn bg-default btn-block btn-xs waves-effect"><i class="material-icons">add_circle</i></button></th>
									</tr>
									</thead>
									<tbody><?php if($rincian) : ?><?php foreach($rincian as $task) : ?>
										<tr>
											<td style="text-align:center;"><?php echo $task->no_rinc;?></td>
											<td><a href="<?php echo base_url('rka/murni/sub/'.$task->kode);?>"><?php echo $task->uraian;?></a></td>
											<td style="text-align:center;">										
											<!--<a class="btn btn-sm btn-warning" title="Ubah" href="<?php echo base_url('rka/murni/editr/'.$task->kode);?>"><i class="fa fa-pencil"></i></a>-->													
												<a class="btn btn-sm btn-danger" title="Hapus" onclick="return confirm('Are you sure?')" href="<?php echo base_url('rka/murni/deleter/'.$task->kode,'/'.$this->uri->segment(1));?>"><i class="fa fa-trash-o"></i></a>
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
	
	<div class="modal fade" id="addRinc" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<center><h3 class="modal-title">Rekening Jenis</h3></center>
			  </div>
			<div class="modal-body form">
				<form action="<?php echo site_url('rka/murni/addr');?>" id="form" class="form-horizontal" method="POST">
				<input type="hidden" value="<?php printf( "%01d", $blr->no++ ); ?>" />
				<input type="hidden" name="id_kode" id="id_kode" value="<?php echo $rka->task_id;?>"/>
				<input type="hidden" name="ggg_kode" id="ggg_kode" value="<?php echo $rka->kd_anggaran;?>"/>
				<input type="hidden" name="sss_kode" id="sss_kode" value="<?php echo $skpd_kode;?>"/>
				<div class="form-body">
					<div class="body">
						<div class="row clearfix">
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
								<div class="col-md-2">
									<div class="form-group form-float">
									<div class="form-line">
										<input type="text" class="form-control" name="no_kode" id="no_kode" style="text-align:center;" value="<?php printf( "%01d", $blr->no ); ?>" readonly>
									</div>
									</div>
								</div>
								<div class="col-md-10">
									<div class="form-group form-float">
									<div class="form-line">
										<input type="text" class="form-control" name="aaa_kode" id="aaa_kode" required>
										<label class="form-label">Uraian Rinc Belanja</label>
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

    function add_rinc() {
		save_method = 'add';
		$('#form')[0].reset(); // reset form on modals
		$('#addRinc').modal('show'); // show bootstrap modal
		$('.modal-title').text('Tambah RKA Rincian Belanja'); // Set title to Bootstrap modal title  
    }

    function edit_jenis(id) {
		save_method = 'update';
		$('#form1')[0].reset(); // reset form on modals
		
		//Ajax Load data from ajax
		$.ajax({
			url : "<?php echo site_url('parameter/rekening/ajax_jenis/')?>/" + id,
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
				$('.modal-title').text('Edit Rekening Jenis'); // Set title to Bootstrap modal title				
				$("#eee_kode1").select2({ placeholder: "Pilih ..." });
			},
				error: function (jqXHR, textStatus, errorThrown)
			{ alert('Error get data from ajax'); }
		});
    }
	</script>