<!-- Main Content -->
	<section class="content">
		<h2>Parameter<small> korolari</small></h2>  
			<div class="body">
				<ol class="breadcrumb breadcrumb-col-cyan">
					<li><a href="<?php echo site_url('dashboard');?>"><i class="material-icons">home</i> Home</a></li>
					<li><a href="<?php echo site_url('parameter');?>"> Parameter</a></li>
					<li><a href="<?php echo site_url('parameter/korolari');?>"> Korolari</a></li>
				</ol>
			</div>
		<!-- Multiple Items To Be Open -->
		<div class="row clearfix">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="card">
					<div class="header bg-purple">
					<h2>Rekening Korolari<small>Data Korolari</small></h2>
						<ul class="header-dropdown m-r--5">
							<li class="dropdown">
								<a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
									<i class="material-icons">more_vert</i>
								</a>
								<ul class="dropdown-menu pull-right">
									<li><a title="Kembali" href="<?php echo base_url('parameter');?>"><i class="material-icons">reply</i> Kembali</a></li>
								</ul>
							</li>
						</ul>
					</div>
					<div class="body">
                        <div class="row clearfix">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<!-- Nav tabs -->						
							<ul class="nav nav-tabs tab-nav-right" role="tablist">
								<li role="presentation" class="active"><a href="#home_animation_1" data-toggle="tab">Tambah</a></li>
								<li role="presentation"><a href="#profile_animation_1" data-toggle="tab">View</a></li>
							</ul>							
							<!-- Tab panes -->
							<div class="tab-content">
							<div role="tabpanel" class="tab-pane animated flipInX active" id="home_animation_1">
								<b><?php echo validation_errors(); ?><?php if ($this->session->flashdata('success')) { echo $this->session->flashdata('success');} ?></b>
								<p><form action="<?php echo base_url('parameter/korolari/add');?>" class="form-horizontal" method="POST">
									<div class="body">
									<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
										<div class="col-md-5">
											<p>Korolari Atas Rekening : <b id='rek6'></b></p>
										</div>												
										<div class="col-md-1">
											<div class="form-group form-float">
											<div class="form-line">
												<input type="text" class="form-control" name="rek1_kode" id="rek1" style="text-align:center;" readonly>
											</div>
											</div>
										</div>
										<div class="col-md-1">
											<div class="form-group form-float">
											<div class="form-line">
												<input type="text" class="form-control" name="rek2_kode" id="rek2" style="text-align:center;" readonly>
											</div>
											</div>
										</div>
										<div class="col-md-1">
											<div class="form-group form-float">
											<div class="form-line">
												<input type="text" class="form-control" name="rek3_kode" id="rek3" style="text-align:center;" readonly>
											</div>
											</div>
										</div>
										<div class="col-md-1">
											<div class="form-group form-float">
											<div class="form-line">
												<input type="text" class="form-control" name="rek4_kode" id="rek4" style="text-align:center;" readonly>
											</div>
											</div>
										</div>
										<div class="col-md-1">
											<div class="form-group form-float">
											<div class="form-line">
												<input type="text" class="form-control" name="rek5_kode" id="rek5" style="text-align:center;" readonly>
											</div>
											</div>
										</div>
										<div class="col-md-1">
											<button type="button" onclick="add_rek1()" class="btn bg-green btn-circle waves-effect waves-circle waves-float"><i class="material-icons">location_searching</i></button>
										</div>
									</div>
									</div>
									<div class="body">
									<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
										<div class="col-md-5">
											<p>Rekening Debet : <b id='drek6'></b></p>
										</div>												
										<div class="col-md-1">
											<div class="form-group form-float">
											<div class="form-line">
												<input type="text" class="form-control" name="drek1_kode" id="drek1" style="text-align:center;" readonly>
											</div>
											</div>
										</div>
										<div class="col-md-1">
											<div class="form-group form-float">
											<div class="form-line">
												<input type="text" class="form-control" name="drek2_kode" id="drek2" style="text-align:center;" readonly>
											</div>
											</div>
										</div>
										<div class="col-md-1">
											<div class="form-group form-float">
											<div class="form-line">
												<input type="text" class="form-control" name="drek3_kode" id="drek3" style="text-align:center;" readonly>
											</div>
											</div>
										</div>
										<div class="col-md-1">
											<div class="form-group form-float">
											<div class="form-line">
												<input type="text" class="form-control" name="drek4_kode" id="drek4" style="text-align:center;" readonly>
											</div>
											</div>
										</div>
										<div class="col-md-1">
											<div class="form-group form-float">
											<div class="form-line">
												<input type="text" class="form-control" name="drek5_kode" id="drek5" style="text-align:center;" readonly>
											</div>
											</div>
										</div>
										<div class="col-md-1">
											<button type="button" onclick="add_rek2()" class="btn bg-green btn-circle waves-effect waves-circle waves-float"><i class="material-icons">location_searching</i></button>
										</div>
									</div>
									</div>
									<div class="body">
									<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
										<div class="col-md-5">
											<p>Rekening Kredit : <b id='krek6'></b></p>
										</div>												
										<div class="col-md-1">
											<div class="form-group form-float">
											<div class="form-line">
												<input type="text" class="form-control" name="krek1_kode" id="krek1" style="text-align:center;" readonly>
											</div>
											</div>
										</div>
										<div class="col-md-1">
											<div class="form-group form-float">
											<div class="form-line">
												<input type="text" class="form-control" name="krek2_kode" id="krek2" style="text-align:center;" readonly>
											</div>
											</div>
										</div>
										<div class="col-md-1">
											<div class="form-group form-float">
											<div class="form-line">
												<input type="text" class="form-control" name="krek3_kode" id="krek3" style="text-align:center;" readonly>
											</div>
											</div>
										</div>
										<div class="col-md-1">
											<div class="form-group form-float">
											<div class="form-line">
												<input type="text" class="form-control" name="krek4_kode" id="krek4" style="text-align:center;" readonly>
											</div>
											</div>
										</div>
										<div class="col-md-1">
											<div class="form-group form-float">
											<div class="form-line">
												<input type="text" class="form-control" name="krek5_kode" id="krek5" style="text-align:center;" readonly>
											</div>
											</div>
										</div>
										<div class="col-md-1">
											<button type="button" onclick="add_rek3()" class="btn bg-green btn-circle waves-effect waves-circle waves-float"><i class="material-icons">location_searching</i></button>
										</div>
									</div>
									</div>
									<div class="col-md-1">
										<button type="submit" class="btn bg-green">Simpan</button>
									</div>											
								</form></p>
							</div>							
							<div role="tabpanel" class="tab-pane animated flipInX" id="profile_animation_1">
								<b><?php echo validation_errors(); ?><?php if ($this->session->flashdata('success')) { echo $this->session->flashdata('success');} ?></b>
								<p><table class="table table-bordered table-striped table-hover js-basic-example dataTable">
									<thead>
									<tr>
										<th style="text-align:center; width:30px">Kd Rek</th>
										<th style="text-align:center;">Uraian Rekening</th>
										<th style="text-align:center; width:30px">Kd Debet</th>
										<th style="text-align:center;">Uraian Rek. Debet</th>
										<th style="text-align:center; width:30px">Kd Kredit</th>
										<th style="text-align:center;">Uraian Rek. Kredit</th>
									</tr>
									</thead>
									<tbody><?php if(isset($korolari)):?><?php foreach($korolari as $list):?>
									<tr>
										<td><?php echo $list->rek1,'.',$list->rek2,'.',$list->rek3,'.',$list->rek4,'.',$list->rek5;?></td>
										<td><?php echo $list->rek6;?></td>
										<td><?php echo $list->deb1,'.',$list->deb2,'.',$list->deb3,'.',$list->deb4,'.',$list->deb5;?></td>
										<td><?php echo $list->deb6;?></td>
										<td><?php echo $list->kre1,'.',$list->kre2,'.',$list->kre3,'.',$list->kre4,'.',$list->kre5;?></td>
										<td><?php echo $list->kre6;?></td>
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
		
	<div class="modal fade" id="addRek1" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<center><h3 class="modal-title">Rekening Korolari</h3></center>
			  </div>
			<div class="modal-body form">
				<form action="javascript:void(0);" id="form1" class="form-horizontal" method="POST">
				<div class="form-body">
					<div class="body">					
						<div class="row clearfix">
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
								<div class="col-md-6">
									<p><b>Akun <span class="required">*</span> :</b></p>
									<div class="form-group">
									<?php combobox('db', $rek, 'rek1_kode', 'kode', 'nm_rek_1', $akun_, 'show_form_akun_by_kelompok1();', 'Pilih Akun', 'class="form-control" required');?>
									</div>
								</div><br><br><br><br>
								<div class="col-md-6">
									<p><b>Kelompok <span class="required">*</span> :</b></p>
									<div class="form-group" id="tampil_combobox_akun_by_kelompok1"></div>
								</div>
								<div class="col-md-6">
									<p><b>Jenis <span class="required">*</span> :</b></p>
									<div class="form-group" id="tampil_combobox_kelompok_by_jenis1"></div>
								</div><br><br><br><br>
								<div class="col-md-6">
									<p><b>Obyek <span class="required">*</span> :</b></p>
									<div class="form-group" id="tampil_combobox_jenis_by_obyek1"></div>
								</div>
								<div class="col-md-6">
									<p><b>Rincian <span class="required">*</span> :</b></p>
								<div class="form-group" id="tampil_combobox_obyek_by_rincian1"></div>
								</div><br><br><br><br>
							</div>
						</div>	
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" onclick="changeText1()" class="btn btn-primary" data-dismiss="modal"/>Save</button>
				</div>
				</form>
			</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
	
	<div class="modal fade" id="addRek2" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<center><h3 class="modal-title">Rekening Korolari</h3></center>
			  </div>
			<div class="modal-body form">
				<form action="javascript:void(0);" id="form2" class="form-horizontal" method="POST">
				<div class="form-body">
					<div class="body">					
						<div class="row clearfix">
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
								<div class="col-md-6">
									<p><b>Akun <span class="required">*</span> :</b></p>
									<div class="form-group">
									<?php combobox('db', $drek, 'drek1_kode', 'kode', 'nm_rek_1', $akun_, 'show_form_akun_by_kelompok2();', 'Pilih Akun', 'class="form-control" required');?>
									</div>
								</div><br><br><br><br>
								<div class="col-md-6">
									<p><b>Kelompok <span class="required">*</span> :</b></p>
									<div class="form-group" id="tampil_combobox_akun_by_kelompok2"></div>
								</div>
								<div class="col-md-6">
									<p><b>Jenis <span class="required">*</span> :</b></p>
									<div class="form-group" id="tampil_combobox_kelompok_by_jenis2"></div>
								</div><br><br><br><br>
								<div class="col-md-6">
									<p><b>Obyek <span class="required">*</span> :</b></p>
									<div class="form-group" id="tampil_combobox_jenis_by_obyek2"></div>
								</div>
								<div class="col-md-6">
									<p><b>Rincian <span class="required">*</span> :</b></p>
								<div class="form-group" id="tampil_combobox_obyek_by_rincian2"></div>
								</div><br><br><br><br>
							</div>
						</div>	
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" onclick="changeText2()" class="btn btn-primary" data-dismiss="modal"/>Save</button>
				</div>
				</form>
			</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
	
	<div class="modal fade" id="addRek3" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<center><h3 class="modal-title">Rekening Korolari</h3></center>
			  </div>
			<div class="modal-body form">
				<form action="javascript:void(0);" id="form3" class="form-horizontal" method="POST">
				<div class="form-body">
					<div class="body">					
						<div class="row clearfix">
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
								<div class="col-md-6">
									<p><b>Akun <span class="required">*</span> :</b></p>
									<div class="form-group">
									<?php combobox('db', $krek, 'krek1_kode', 'kode', 'nm_rek_1', $akun_, 'show_form_akun_by_kelompok3();', 'Pilih Akun', 'class="form-control" required');?>
									</div>
								</div><br><br><br><br>
								<div class="col-md-6">
									<p><b>Kelompok <span class="required">*</span> :</b></p>
									<div class="form-group" id="tampil_combobox_akun_by_kelompok3"></div>
								</div>
								<div class="col-md-6">
									<p><b>Jenis <span class="required">*</span> :</b></p>
									<div class="form-group" id="tampil_combobox_kelompok_by_jenis3"></div>
								</div><br><br><br><br>
								<div class="col-md-6">
									<p><b>Obyek <span class="required">*</span> :</b></p>
									<div class="form-group" id="tampil_combobox_jenis_by_obyek3"></div>
								</div>
								<div class="col-md-6">
									<p><b>Rincian <span class="required">*</span> :</b></p>
								<div class="form-group" id="tampil_combobox_obyek_by_rincian3"></div>
								</div><br><br><br><br>
							</div>
						</div>	
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" onclick="changeText3()" class="btn btn-primary" data-dismiss="modal"/>Save</button>
				</div>
				</form>
			</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
	
    </section>
<!-- END CONTENT -->
	<script type="text/javascript">
	function changeText1(){
		var userInput1 = document.getElementById('rek1_kode').value;
		var userInput2 = document.getElementById('rek2_kode').value;
		var userInput3 = document.getElementById('rek3_kode').value;
		var userInput4 = document.getElementById('rek4_kode').value;
		var userInput5 = document.getElementById('rek5_kode').value;
		document.getElementById('rek1').value = userInput1;
		document.getElementById('rek2').value = userInput2;
		document.getElementById('rek3').value = userInput3;
		document.getElementById('rek4').value = userInput4;
		document.getElementById('rek5').value = userInput5;
		document.getElementById('rek6').innerHTML = userInput5;
	}
	
	function changeText2(){
		var userInput1 = document.getElementById('drek1_kode').value;
		var userInput2 = document.getElementById('drek2_kode').value;
		var userInput3 = document.getElementById('drek3_kode').value;
		var userInput4 = document.getElementById('drek4_kode').value;
		var userInput5 = document.getElementById('drek5_kode').value;
		document.getElementById('drek1').value = userInput1;
		document.getElementById('drek2').value = userInput2;
		document.getElementById('drek3').value = userInput3;
		document.getElementById('drek4').value = userInput4;
		document.getElementById('drek5').value = userInput5;
		document.getElementById('drek6').innerHTML = userInput5;
	}
	
	function changeText3(){
		var userInput1 = document.getElementById('krek1_kode').value;
		var userInput2 = document.getElementById('krek2_kode').value;
		var userInput3 = document.getElementById('krek3_kode').value;
		var userInput4 = document.getElementById('krek4_kode').value;
		var userInput5 = document.getElementById('krek5_kode').value;
		document.getElementById('krek1').value = userInput1;
		document.getElementById('krek2').value = userInput2;
		document.getElementById('krek3').value = userInput3;
		document.getElementById('krek4').value = userInput4;
		document.getElementById('krek5').value = userInput5;
		document.getElementById('krek6').innerHTML = userInput5;
	}
	</script>

	<script>
	function show_form_akun_by_kelompok1(){
		var rek1_kode = $('select[name=rek1_kode]').val();
		load('parameter/korolari/tampil_combobox_akun_by_kelompok1/'+rek1_kode, '#tampil_combobox_akun_by_kelompok1');
		load('parameter/korolari/tampil_combobox_kelompok_by_jenis1/', '#tampil_combobox_kelompok_by_jenis1');
		load('parameter/korolari/tampil_combobox_jenis_by_obyek1/', '#tampil_combobox_jenis_by_obyek1');
		load('parameter/korolari/tampil_combobox_obyek_by_rincian1/', '#tampil_combobox_obyek_by_rincian1');
	}
	
	function show_form_kelompok_by_jenis1(){
		var rek2_kode = $('select[name=rek2_kode]').val();
		load('parameter/korolari/tampil_combobox_kelompok_by_jenis1/'+rek2_kode, '#tampil_combobox_kelompok_by_jenis1');
		load('parameter/korolari/tampil_combobox_jenis_by_obyek1/', '#tampil_combobox_jenis_by_obyek1');
		load('parameter/korolari/tampil_combobox_obyek_by_rincian1/', '#tampil_combobox_obyek_by_rincian1');
	}
	
	function show_form_jenis_by_obyek1(){
		var rek3_kode = $('select[name=rek3_kode]').val();
		load('parameter/korolari/tampil_combobox_jenis_by_obyek1/'+rek3_kode, '#tampil_combobox_jenis_by_obyek1');
		load('parameter/korolari/tampil_combobox_obyek_by_rincian1/', '#tampil_combobox_obyek_by_rincian1');
	}
	
	function show_form_obyek_by_rincian1(){
		var rek4_kode = $('select[name=rek4_kode]').val();
		load('parameter/korolari/tampil_combobox_obyek_by_rincian1/'+rek4_kode, '#tampil_combobox_obyek_by_rincian1');
	}
	
	function show_form_akun_by_kelompok2(){
		var drek1_kode = $('select[name=drek1_kode]').val();
		load('parameter/korolari/tampil_combobox_akun_by_kelompok2/'+drek1_kode, '#tampil_combobox_akun_by_kelompok2');
		load('parameter/korolari/tampil_combobox_kelompok_by_jenis2/', '#tampil_combobox_kelompok_by_jenis2');
		load('parameter/korolari/tampil_combobox_jenis_by_obyek2/', '#tampil_combobox_jenis_by_obyek2');
		load('parameter/korolari/tampil_combobox_obyek_by_rincian2/', '#tampil_combobox_obyek_by_rincian2');
	}
	
	function show_form_kelompok_by_jenis2(){
		var drek2_kode = $('select[name=drek2_kode]').val();
		load('parameter/korolari/tampil_combobox_kelompok_by_jenis2/'+drek2_kode, '#tampil_combobox_kelompok_by_jenis2');
		load('parameter/korolari/tampil_combobox_jenis_by_obyek2/', '#tampil_combobox_jenis_by_obyek2');
		load('parameter/korolari/tampil_combobox_obyek_by_rincian2/', '#tampil_combobox_obyek_by_rincian2');
	}
	
	function show_form_jenis_by_obyek2(){
		var drek3_kode = $('select[name=drek3_kode]').val();
		load('parameter/korolari/tampil_combobox_jenis_by_obyek2/'+drek3_kode, '#tampil_combobox_jenis_by_obyek2');
		load('parameter/korolari/tampil_combobox_obyek_by_rincian2/', '#tampil_combobox_obyek_by_rincian2');
	}
	
	function show_form_obyek_by_rincian2(){
		var drek4_kode = $('select[name=drek4_kode]').val();
		load('parameter/korolari/tampil_combobox_obyek_by_rincian2/'+drek4_kode, '#tampil_combobox_obyek_by_rincian2');
	}
	
	function show_form_akun_by_kelompok3(){
		var krek1_kode = $('select[name=krek1_kode]').val();
		load('parameter/korolari/tampil_combobox_akun_by_kelompok3/'+krek1_kode, '#tampil_combobox_akun_by_kelompok3');
		load('parameter/korolari/tampil_combobox_kelompok_by_jenis3/', '#tampil_combobox_kelompok_by_jenis3');
		load('parameter/korolari/tampil_combobox_jenis_by_obyek3/', '#tampil_combobox_jenis_by_obyek3');
		load('parameter/korolari/tampil_combobox_obyek_by_rincian3/', '#tampil_combobox_obyek_by_rincian3');
	}
	
	function show_form_kelompok_by_jenis3(){
		var krek2_kode = $('select[name=krek2_kode]').val();
		load('parameter/korolari/tampil_combobox_kelompok_by_jenis3/'+krek2_kode, '#tampil_combobox_kelompok_by_jenis3');
		load('parameter/korolari/tampil_combobox_jenis_by_obyek3/', '#tampil_combobox_jenis_by_obyek3');
		load('parameter/korolari/tampil_combobox_obyek_by_rincian3/', '#tampil_combobox_obyek_by_rincian3');
	}
	
	function show_form_jenis_by_obyek3(){
		var krek3_kode = $('select[name=krek3_kode]').val();
		load('parameter/korolari/tampil_combobox_jenis_by_obyek3/'+krek3_kode, '#tampil_combobox_jenis_by_obyek3');
		load('parameter/korolari/tampil_combobox_obyek_by_rincian3/', '#tampil_combobox_obyek_by_rincian3');
	}
	
	function show_form_obyek_by_rincian3(){
		var krek4_kode = $('select[name=krek4_kode]').val();
		load('parameter/korolari/tampil_combobox_obyek_by_rincian3/'+krek4_kode, '#tampil_combobox_obyek_by_rincian3');
	}
	</script>

	<script type="text/javascript">
    var save_method; //for save method string

    function add_rek1() {
		save_method = 'add';
		$('#form1')[0].reset(); // reset form on modals
		$('#addRek1').modal('show'); // show bootstrap modal
		$('.modal-title').text('Tambah Korolari Atas Rekening'); // Set title to Bootstrap modal title
    }
	
	function add_rek2() {
		save_method = 'add';
		$('#form2')[0].reset(); // reset form on modals
		$('#addRek2').modal('show'); // show bootstrap modal
		$('.modal-title').text('Tambah Rekening Debet'); // Set title to Bootstrap modal title
    }
	
	function add_rek3() {
		save_method = 'add';
		$('#form3')[0].reset(); // reset form on modals
		$('#addRek3').modal('show'); // show bootstrap modal
		$('.modal-title').text('Tambah Rekening Kredit'); // Set title to Bootstrap modal title
    }
	</script>