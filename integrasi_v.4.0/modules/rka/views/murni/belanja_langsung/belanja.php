<!-- Main Content -->
   <section class="content">
		<h2>RKA Murni<small> anggaran belanja langsung</small></h2>  
			<div class="body">
				<ol class="breadcrumb breadcrumb-col-cyan">
					<li><a href="<?php echo site_url('dashboard');?>"><i class="material-icons">home</i> Home</a></li>
					<li><a href="<?php echo site_url('rka/murni');?>"> RKA</a></li>
					<li class="active"> Belanja</li>
				</ol>
			</div>
            <!-- Multiple Items To Be Open -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
							<p align="center"><b><?php echo strtoupper($skpd_nama);?></b></p>
							<p class="control-label col-md-10">Program &nbsp;:&nbsp; <?php echo $program ?></p>
							<p class="control-label col-md-10">Kegiatan &nbsp;:&nbsp; <?php echo $kegiatan; ?></p>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <button type="button" class="btn bg-black waves-effect waves-light">ACTIONS</button>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                    <!--<li><a title="Tambah" href="<?php echo site_url('rka/murni/belanja-langsung/'.$kode);?>"><i class="material-icons">add_circle_outline</i> Belanja</a></li>-->
										<li><a title="Print RKA" href="<?php echo site_url('rka/murni/rka/'.$kode);?>"><i class="material-icons">print</i> Print RKA</a></li>
                                        <li><a title="Kembali" href="<?php echo base_url('rka'); ?>"><i class="material-icons">reply</i> Kembali</a></li>
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
                                        <li role="presentation" class="active"><a href="#home_animation_1" data-toggle="tab">Belanja</a></li>
                                        <li><a href="javascript:void(0);">Rincian Belanja</a></li>
                                        <li><a href="javascript:void(0);">Sub Rincian Belanja</a></li>
                                    </ul>
                                    <!-- Tab panes -->
                                    <div class="tab-content">
                                        <div role="tabpanel" class="tab-pane animated flipInX active" id="home_animation_1">
                                            <b><?php echo validation_errors(); ?><?php if ($this->session->flashdata('success')) { echo $this->session->flashdata('success');} ?></b>
                                            <p><table class="table table-bordered table-striped table-hover js-basic-example dataTable">
											<thead>
											<tr>
												<th style="text-align:center; width:110px">Kode Rekening</th>
												<th style="text-align:center;">Uraian</th>
												<th style="text-align:center; width:60px">Sumber</th>
												<th style="text-align:center; width:80px"><button type="button" onclick="add_belanja()" class="btn bg-default btn-block btn-xs waves-effect"><i class="material-icons">add_circle</i></button></th>
											</tr>
											</thead>
											<tbody><?php if($anggaran_bl) : ?><?php foreach($anggaran_bl as $task) : ?>
												<tr>
													<td style="text-align:center;"><?php echo $task->id_akun, ' . ', $task->id_kelompok, ' . ', $task->id_jenis, ' . ', $task->id_obyek, ' . ', $task->id_rincian ;?></td>
													<td><a href="<?php echo base_url('rka/murni/rincian/'.$task->task_id);?>"><?php echo $task->nama_rincian;?></a></td>
													<td style="text-align:center;"><?php echo $task->id_tipe;?></td>
													<td style="text-align:center;">										
													<!--<a class="btn btn-sm btn-warning" title="Ubah" href="<?php echo base_url('rka/murni/edit/'.$task->task_id);?>"><i class="fa fa-pencil"></i></a>-->
														<a class="btn btn-sm btn-danger" title="Hapus" onclick="return confirm('Are you sure?')" href="<?php echo base_url('rka/murni/deleteb/'.$task->task_id,'/'.$this->uri->segment(1));?>"><i class="fa fa-trash-o"></i></a>
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
	
	<div class="modal fade" id="addBelanja" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<center><h3 class="modal-title">RKA Belanja</h3></center>
			  </div>
			<div class="modal-body form"><br>
				<form action="<?php echo site_url('rka/murni/belanja-langsung');?>" id="form" class="form-horizontal" method="POST">
				<input type="hidden" value="<?php printf( "%01d", $bl->no++ ); ?>" />
				<input type="hidden" name="no_kode" id="no_kode" value="<?php printf( "%01d", $bl->no ); ?>" />
				<input type="hidden" name="id_kode" id="id_kode" value="<?php echo $kode;?>" />
				<input type="hidden" name="program_kode" id="program_kode" value="<?php echo $program_;?>" />
				<input type="hidden" name="thn_kode" id="thn_kode" value="<?php echo $tahun;?>" />
				<input type="hidden" name="skpd_kode" id="skpd_kode" value="<?php echo $skpd_kode;?>" />				
				<input type="hidden" name="urusan_kode" id="urusan_kode" value="<?php echo $urusan_;?>" />
				<div class="form-body">
					<div class="body">
						<div class="row clearfix">
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
								<div class="body">
								<div class="row clearfix">
									<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
										<div class="col-md-6">
											<p><b>Akun <span class="required">*</span> :</b></p>
											<div class="form-group form-float">
												<div class="form-line">										
												<?php combobox('db', $akun, 'aaa_kode', 'kode', 'nm_rek_1', '', 'show_form_akun_by_kelompok();', 'Pilih Akun', 'class="form-control show-tick" data-live-search="true" tabindex="1" required="required"'); ?>
												</div>								
											</div>								
										</div>								
										<div class="col-md-6">
											<p><b>Kelompok <span class="required">*</span> :</b></p>
											<div class="form-group form-float">
												<div class="form-line" id="tampil_combobox_akun_by_kelompok">	
													<select name="bbb_kode" id="bbb_kode" class="form-control show-tick" data-live-search="true" tabindex="1" required="required"></select>
												</div>
											</div>
										</div>
									</div>
								</div>
								</div><br>								
								<div class="body">
								<div class="row clearfix">
									<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">								
										<div class="col-md-6">
											<p><b>Jenis <span class="required">*</span> :</b></p>
											<div class="form-group form-float">
												<div class="form-line" id="tampil_combobox_kelompok_by_jenis">
													<select name="ccc_kode" id="ccc_kode" class="form-control show-tick" data-live-search="true" tabindex="1" required="required"></select>
												</div>
											</div>
										</div>			
										<div class="col-md-6">
											<p><b>Obyek <span class="required">*</span> :</b></p>
											<div class="form-group form-float">
												<div class="form-line" id="tampil_combobox_jenis_by_obyek">
													<select name="ddd_kode" id="ddd_kode" class="form-control show-tick" data-live-search="true" tabindex="1" required="required"></select>
												</div>
											</div>
										</div>								
									</div>
								</div>
								</div><br>								
								<div class="body">
								<div class="row clearfix">
									<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">								
										<div class="col-md-6">
											<p><b>Rincian <span class="required">*</span> :</b></p>
											<div class="form-group form-float">
												<div class="form-line" id="tampil_combobox_obyek_by_rincian">
													<select name="eee_kode" id="eee_kode" class="form-control show-tick" data-live-search="true" tabindex="1" required="required"></select>
												</div>
											</div>
										</div>			
										<div class="col-md-6">
											<p><b>Sumber Dana <span class="required">*</span> :</b></p>
											<div class="form-group form-float">
												<div class="form-line">
													<?php combobox('db', $sumber, 'sss_kode', 'kode', 'nm_sumber', '', '', 'Pilih Sumber ...', 'class="form-control show-tick" data-live-search="true" tabindex="1" required="required"'); ?>
												</div>
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

    function add_belanja() {
		save_method = 'add';
		$('#form')[0].reset(); // reset form on modals
		$('#addBelanja').modal('show'); // show bootstrap modal
		$('.modal-title').text('Tambah RKA Belanja'); // Set title to Bootstrap modal title  
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
	
	<script>
	function show_form_akun_by_kelompok(){
		var aaa_kode = $('select[name=aaa_kode]').val();
		load('rka/murni/tampil_combobox_akun_by_kelompok/'+aaa_kode, '#tampil_combobox_akun_by_kelompok');
		load('rka/murni/tampil_combobox_kelompok_by_jenis/', '#tampil_combobox_kelompok_by_jenis');
		load('rka/murni/tampil_combobox_jenis_by_obyek/', '#tampil_combobox_jenis_by_obyek');
		load('rka/murni/tampil_combobox_obyek_by_rincian/', '#tampil_combobox_obyek_by_rincian');
	}
	
	function show_form_kelompok_by_jenis(){
		var bbb_kode = $('select[name=bbb_kode]').val();
		load('rka/murni/tampil_combobox_kelompok_by_jenis/'+bbb_kode, '#tampil_combobox_kelompok_by_jenis');
		load('rka/murni/tampil_combobox_jenis_by_obyek/', '#tampil_combobox_jenis_by_obyek');
		load('rka/murni/tampil_combobox_obyek_by_rincian/', '#tampil_combobox_obyek_by_rincian');
	}
	
	function show_form_jenis_by_obyek(){
		var ccc_kode = $('select[name=ccc_kode]').val();
		load('rka/murni/tampil_combobox_jenis_by_obyek/'+ccc_kode, '#tampil_combobox_jenis_by_obyek');
		load('rka/murni/tampil_combobox_obyek_by_rincian/', '#tampil_combobox_obyek_by_rincian');
	}
	
	function show_form_obyek_by_rincian(){
		var ddd_kode = $('select[name=ddd_kode]').val();
		load('rka/murni/tampil_combobox_obyek_by_rincian/'+ddd_kode, '#tampil_combobox_obyek_by_rincian');
	}
	</script>