<!-- Main Content -->
<?php $query_data = mysql_query("SELECT skpd.skpd_nama as id_skpd, program.program as id_program, anggaran.kegiatan as id_kegiatan FROM rka INNER JOIN skpd ON rka.skpd=skpd.skpd_kode	INNER JOIN program ON rka.program=program.kode INNER JOIN anggaran ON rka.anggaran_kode=anggaran.kode WHERE rka.tipe_kode= '1' AND rka.anggaran_kode='".$rincian->anggaran_kode."' ORDER BY rka.kode ASC"); $data = mysql_fetch_array($query_data); $skpd = $data[id_skpd]; $program = $data[id_program]; $kegiatan = $data[id_kegiatan]; $query_jumlah = mysql_query("SELECT SUM(total) FROM rka_sub WHERE rka_sub.tipe_kode= '1' AND rka_sub.anggaran_kode='".$rincian->anggaran_kode."' ORDER BY rka_sub.kode ASC"); $data = mysql_fetch_array($query_jumlah); $jumlah = $data[0]; ?>
	<section class="content">
		<h2>RKA Murni<small> anggaran belanja langsung</small></h2>  
		<div class="body">
			<ol class="breadcrumb breadcrumb-col-cyan">
				<li><a href="<?php echo site_url('dashboard');?>"><i class="material-icons">home</i> Home</a></li>
				<li><a href="<?php echo site_url('rka/murni');?>"> RKA</a></li>
				<li class="active"> Sub Rincian Belanja</li>
			</ol>
		</div>
           <!-- Multiple Items To Be Open -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">					
						<p align="center"><b><?php echo strtoupper($skpd_nama);?></b></p>
						<p class="control-label col-md-10">Program &nbsp;:&nbsp; <?php echo $rincian->program;?></p><p align="right"><b>.</b></p>
						<p class="control-label col-md-10">Kegiatan &nbsp;:&nbsp; <?php echo $rincian->kegiatan;?></p><p align="right"><b>Jumlah</b></p>
						<p class="control-label col-md-10">Rekening :&nbsp; <?php echo $rincian->id_akun;?>.<?php echo $rincian->id_kelompok;?>.<?php echo $rincian->id_jenis;?>.<?php echo $rincian->id_obyek;?>.<?php echo $rincian->id_rincian;?> <?php echo $rincian->nama_rincian;?></p>
                        <p class="control-label col-md-10">Rincian &nbsp;&nbsp;&nbsp;:&nbsp;<?php echo $rincian->no; ?> . <?php echo $rincian->uraian; ?></p><p align="right"><b><?php echo rupiah($jumlah);?></b></p>
						<br><ul class="header-dropdown m-r--5">
                            <li class="dropdown">
                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                    <button type="button" class="btn bg-black waves-effect waves-light">ACTIONS</button>
                                </a>
                                <ul class="dropdown-menu pull-right">
                                <!--<li><a title="Tambah" href="<?php echo site_url('rka/murni/adds/'.$rincian->kode);?>"><i class="material-icons">add_circle_outline</i> Sub Rincian</a></li>-->
									<li><a title="Print RKA" href="<?php echo site_url('rka/murni/rka/'.$rincian->anggaran_kode);?>"><i class="material-icons">print</i> Print RKA</a></li>
                                    <li><a title="Kembali" href="<?php echo base_url(); ?>rka/murni/rincian/<?php echo $rincian->task_id; ?>"><i class="material-icons">reply</i> Kembali</a></li>
                                </ul>
                            </li>
                            </ul>
					</div>
                    <div class="body">						
                        <div class="row clearfix">
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <!-- Nav tabs -->
                                    <ul class="nav nav-tabs tab-nav-right" role="tablist">
                                        <li><p class="col-cyan"><a href="<?php echo base_url('rka/murni/belanja/'.$rincian->kd_anggaran);?>"><i class="material-icons">keyboard_arrow_left</i>Belanja</a></p></li>									
                                        <li><p class="col-cyan"><a href="<?php echo base_url('rka/murni/rincian/'.$rincian->task_id);?>"><i class="material-icons">keyboard_arrow_left</i>Rincian Belanja</a></p></li>
                                        <li role="presentation" class="active"><a href="#home_animation_2" data-toggle="tab">Sub Rincian Belanja</a></li>
                                    </ul>
                                    <!-- Tab panes -->
                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane animated fadeInRight active" id="home_animation_2">
                                        <b><?php echo validation_errors(); ?><?php if ($this->session->flashdata('success')) { echo $this->session->flashdata('success');} ?></b>
                                        <p><table class="table table-bordered table-striped table-hover js-basic-example dataTable">
										<thead><tr>
											<th style="text-align:center; width:60px">No</th>
											<th style="text-align:center;">Uraian</th>
											<th style="text-align:center; width:80px"><button type="button" onclick="add_sub()" class="btn bg-default btn-block btn-xs waves-effect"><i class="material-icons">add_circle</i></button></th>
										</tr></thead>
										<tbody><?php if($sub) : ?><?php foreach($sub as $task) : ?>
										<tr>
											<td style="text-align:center;"><?php echo $task->no;?></td>
											<td><?php echo $task->keterangan;?></td>
											<td style="text-align:center;">										
											<!--<a class="btn btn-sm btn-warning" title="Ubah" href="<?php echo base_url('rka/murni/edits/'.$task->kode);?>"><i class="fa fa-pencil"></i></a>-->
												<a class="btn btn-sm btn-danger" title="Hapus" onclick="return confirm('Are you sure?')" href="<?php echo base_url('rka/murni/deletes/'.$task->kode,'/'.$this->uri->segment(1));?>"><i class="fa fa-trash-o"></i></a>
											</td>
										</tr>
										<?php endforeach; ?><?php endif; ?>
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
	
	<div class="modal fade" id="addSub" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<center><h3 class="modal-title">Rekening Jenis</h3></center>
			  </div>
			<div class="modal-body form">
				<form action="<?php echo site_url('rka/murni/adds');?>" id="form" class="form-horizontal" method="POST" name="autoSumForm" onSubmit="return validasi()">
				<input type="hidden" value="<?php printf( "%01d", $bls->no++ );?>"/>
				<input type="hidden" name="id_kode" id="id_kode" value="<?php echo $rincian->task_id;?>"/>
				<input type="hidden" name="kode" id="kode" value="<?php echo $rincian->id_kode;?>"/>
				<input type="hidden" name="rincian_kode" id="id_kode" value="<?php echo $rincian->kd_anggaran;?>"/>
				<input type="hidden" value="<?php echo $kab+$prov+$apbn+$sumberlain-$jumlah;?>">
				<div class="form-body">
					<div class="body">
						<div class="row clearfix">
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
								<div class="col-md-2">
									<div class="form-group form-float">
									<div class="form-line">
										<input type="text" class="form-control" name="no_kode" id="no_kode" style="text-align:center;" value="<?php printf( "%01d", $bls->no ); ?>" readonly>
									</div>
									</div>
								</div>
								<div class="col-md-10">
									<div class="form-group form-float">
									<div class="form-line">
										<input type="text" class="form-control" name="aaa_kode" id="aaa_kode" required>
										<label class="form-label">Uraian Sub Rinc Belanja</label>
									</div>
									</div>
								</div><br><br><br>
							<!--<div class="col-md-6">
									<div class="form-group form-float">
									<div class="form-line">
										<input type="text" class="form-control" value="<?php echo rupiah($kab+$prov+$apbn+$sumberlain);?>" style="text-align:right;" readonly="readonly">
										<label class="form-label">Anggaran</label>
									</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group form-float">
									<div class="form-line">
										<input type="hidden" class="form-control" id="stok#" name="sisa" value="<?php echo $kab+$prov+$apbn+$sumberlain-$jumlah;?>" style="text-align:right;" readonly="readonly">
										<input type="text" class="form-control" value="<?php echo rupiah($kab+$prov+$apbn+$sumberlain-$jumlah);?>" style="text-align:right;" readonly="readonly">																	
										<label class="form-label">Sisa Anggaran</label>
									</div>
									</div>
								</div><br><br><br>-->
								<div class="col-md-6">
									<div class="form-group form-float">
									<div class="form-line">
										<input type="text" class="form-control" name="bbb_kode" id="satuan" maxlength="16" style="text-align:right;" onkeypress="return isNumber(event)" onkeyup="totalSum()" placeholder="0" required="required">
										<label class="form-label" for="bbb_kode">Harga Satuan Rp.</label>
									</div>
									</div>
								</div><br><br>
								<div class="col-md-6">
									<div class="form-group form-float">
									<div class="form-line">
										<input type="text" class="form-control" name="firstBox" onFocus="startCalc();" onBlur="stopCalc();" maxlength="16" id="volume1" style="text-align:right;" onkeypress="return isNumber(event)" onkeyup="totalSum()" placeholder="0" required="required">
										<label class="form-label" for="volume1">Volume 1 :</label>
									</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group form-float">
									<div class="form-line">
										<input type="input" class="form-control" maxlength="40" id="userInput1" style="text-align:right;" onkeyup="showMsg()" placeholder="-" required="required">
										<label class="form-label" for="ddd_kode">Satuan 1 :</label>
									</div>
									</div>
								</div><br><br>
								<div class="col-md-6">
									<div class="form-group form-float">
									<div class="form-line">
										<input type="text" class="form-control" name="secondBox" onFocus="startCalc();" onBlur="stopCalc();" maxlength="16" id="volume2" style="text-align:right;" onkeypress="return isNumber(event)" onkeyup="totalSum()" placeholder="0">
										<label class="form-label" for="volume2">Volume 2 :</label>
									</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group form-float">
									<div class="form-line">
										<input type="input" class="form-control" maxlength="40" id="userInput2" style="text-align:right;" onkeyup="showMsg()" placeholder="-">
										<label class="form-label" for="fff_kode">Satuan 2 :</label>
									</div>
									</div>
								</div><br><br>
								<div class="col-md-6">
									<div class="form-group form-float">
									<div class="form-line">
										<input type="text" class="form-control" name="lastBox" onFocus="startCalc();" onBlur="stopCalc();" maxlength="16" id="volume3" style="text-align:right;" onkeypress="return isNumber(event)" onkeyup="totalSum()" placeholder="0">
										<label class="form-label" for="ggg_kode">Volume 3 :</label>
									</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group form-float">
									<div class="form-line">
										<input type="input" class="form-control" maxlength="40" id="userInput3" style="text-align:right;" onkeyup="showMsg()" placeholder="-">
										<label class="form-label" for="hhh_kode">Satuan 3 :</label>
									</div>
									</div>
								</div><br><br><br>
								<div class="col-md-6">
									<div class="form-group form-float">
									<div class="form-line">
										<input type="hidden" id="sumberlain" onkeyup="totalAsumsi()">
										<input type="text" class="form-control" name="thirdBox" id="thirdBox" style="text-align:right;font-weight:bold;" placeholder="0" readonly="readonly">
										<label class="form-label" for="bbb_kode">Satuan :</label>
									</div>
									</div>
								</div><br><br>
								<div class="col-md-6">
									<div class="form-group form-float">
									<div class="form-line">
										<input type="text" class="form-control" name="userMsg" id="userMsg" style="text-align:right;font-weight:bold;" placeholder="-" readonly="readonly">
										<label class="form-label" for="bbb_kode">Volume :</label>
									</div>
									</div>
								</div><br><br>
								<div class="col-md-6">
									<div class="form-group form-float">
									<div class="form-line">
										<input type="text" class="form-control" id="total_sum1" style="text-align:right;font-weight:bold;" placeholder="0" readonly="readonly">
										<input type="hidden" class="form-control" name="total_sum" id="total_sum" style="text-align:right;font-weight:bold;" placeholder="0" readonly="readonly">
										<label class="form-label" for="bbb_kode">Total :</label>
									</div>
									</div>
								</div><br><br>
							</div>
						</div>
					</div>
				</div>
			</div>
				<div class="modal-footer">
				<button type="submit" id="tambah" class="btn btn-primary">Save</button>
					<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
				</div>
				</form>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
	<!-- End Bootstrap modal -->

<script type="text/javascript">
    var save_method; //for save method string

    function add_sub() {
		save_method = 'add';
		$('#form')[0].reset(); // reset form on modals
		$('#addSub').modal('show'); // show bootstrap modal
		$('.modal-title').text('Tambah RKA Sub Rincian Belanja'); // Set title to Bootstrap modal title  
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

<script src="<?php echo base_url('public/templates/integrasi_v.4.0/js/rencana/jquery.js');?>"></script>
<script>
//	var jumlah;
//	var stok;
//		$(function(){
//	//jika tombol tambah di klik
//		$("#tambah").click(function(){
//		stok=$("#stok").val();
//		jumlah=$("#total_sum").val();
//		if(jumlah > stok){
//			alert("Anggaran Lebih");
//			$("#total_sum").focus();
//		return false; }
//		});
//	return true });
</script>
<script>
function totalSum(){
		var satuan 			= document.getElementById("satuan").value || 1;
		var volume1 		= document.getElementById("volume1").value || 1;
		var volume2 		= document.getElementById("volume2").value || 1;
		var volume3 		= document.getElementById("volume3").value || 1;
		var result 			= parseInt(satuan) * parseInt(volume1) * parseInt(volume2) * parseInt(volume3);
		document.getElementById("total_sum1").value = tandaPemisah(result);
		document.getElementById("total_sum").value = result;
	}
	
function tandaPemisah(b){
		var _minus = false;
		if (b<0) _minus = true;
		b = b.toString();
		b=b.replace(".","");
		b=b.replace("-","");
		c = "";
		panjang = b.length;
		j = 0;
		for (i = panjang; i > 0; i--){
			 j = j + 1;
			 if (((j % 3) == 1) && (j != 1)){
			   c = b.substr(i-1,1) + "." + c;
			 } else {
			   c = b.substr(i-1,1) + c;
			 }
		}
		if (_minus) c = "-" + c ;
		return c;
	}
</script>

<script type="text/javascript">
function startCalc(){
  interval = setInterval("calc()",1);
}
function calc(){
  one = document.autoSumForm.firstBox.value;
  two = document.autoSumForm.secondBox.value;
  tree = document.autoSumForm.lastBox.value;
  document.autoSumForm.thirdBox.value = (one * 1) + (two * 1) + (tree * 1);
}
function stopCalc(){
  clearInterval(interval);
}
</script>

<script type="text/javascript">
function showMsg(){
	var userInput1 = document.getElementById('userInput1').value;
	var userInput2 = document.getElementById('userInput2').value;
	var userInput3 = document.getElementById('userInput3').value;
		document.getElementById('userMsg').value = userInput1 + userInput2 + userInput3;
}
</script>
<script>
    function validasi(){
        var uraian = autoSumForm.aaa_kode.value;
        var satuan = autoSumForm.thirdBox.value;
        var volume = autoSumForm.userMsg.value;
        var total = autoSumForm.total_sum.value;
        var pesan = '';
        if (uraian == '') { pesan += '- Uraian \n'; }
        if (satuan == '') { pesan += '- Satuan \n'; }
        if (volume == '') { pesan += '- Volume \n'; }
        if (total == '') { pesan += '- Total \n'; }
        if (pesan != '') { alert('Data Tidak Boleh Kosong : \n'+pesan); return false; }
    return true }
</script>