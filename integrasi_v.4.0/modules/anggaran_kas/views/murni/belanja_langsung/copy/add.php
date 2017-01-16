<!-- Main Content -->
<?php $query_hasil = $this->db->query("SELECT SUM(rka_sub.total) as totalRKA FROM rka_sub WHERE rka_sub.tipe_kode= '1' AND rka_sub.rka='".$id_kode."' "); $data_hasil = $query_hasil->result(); foreach($data_hasil as $task){ ?>
<section class="content">
		<h2>Anggaran Kas Murni<small> anggaran belanja langsung</small></h2>  
			<div class="body">
				<ol class="breadcrumb breadcrumb-col-cyan">
					<li><a href="<?php echo site_url('dashboard');?>"><i class="material-icons">home</i> Home</a></li>
					<li><a href="<?php echo site_url('anggaran-kas/murni');?>"> Anggaran Kas</a></li>
					<li class="active"> Rencana</li>
				</ol>
			</div>
            <!-- Multiple Items To Be Open -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
							<p align="center"><b><?php echo strtoupper($skpd);?></b></p>					
							<p class="control-label col-md-10">Program &nbsp;:&nbsp; <?php echo $program;?></p><p align="right"><b>.</b></p>
							<p class="control-label col-md-10">Kegiatan &nbsp;:&nbsp;<?php echo $kegiatan;?></p><p align="right"><b>Jumlah</b></p>
                            <p class="control-label col-md-10">Rekening &nbsp;:&nbsp;<?php echo $akun;?>.<?php echo $kelompok;?>.<?php echo $jenis;?>.<?php echo $obyek;?>.<?php echo $rincian_;?> <?php echo $rincian;?></p><p align="right"><b><?php echo rupiah2($task->totalRKA);?></b></p>						
							<ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <button type="button" class="btn bg-black waves-effect waves-light">ACTIONS</button>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
										<li><a title="Print" href="<?php echo site_url('anggaran-kas/murni/viewa/'.$id_anggaran);?>"><i class="material-icons">print</i> Print</a></li>
										<li><a title="Kembali" href="<?php echo base_url(); ?>anggaran-kas/murni/belanja/<?php echo $id_anggaran;?>"><i class="material-icons">reply</i> Kembali</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
						<div class="row clearfix">
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<!-- Nav tabs -->
							<ul class="nav nav-tabs tab-nav-right" role="tablist">
								<li><p class="col-cyan"><a href="<?php echo base_url(); ?>anggaran-kas/murni/belanja/<?php echo $id_anggaran;?>"><i class="material-icons">keyboard_arrow_left</i>Belanja</a></p></li>
								<li role="presentation" class="active"><a href="#home_animation_2" data-toggle="tab">Rencana</a></li>
							</ul>
							<!-- Tab panes -->									
							<div class="body">
							<div class="row clearfix">
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
								<div role="tabpanel" class="tab-pane fade in active" id="step1" aria-labelledby="home-tab">
								<div class="portlet-body">
									<table class="table table-striped table-bordered table-hover" width="50%" cellspacing="5" cellpadding="5"><ul><tr>
										<td><input type="text" class="form-control" placeholder="Total Anggaran" readonly="readonly"></td>
										<td><input type="text" class="form-control" placeholder="<?php echo rupiah($task->totalRKA);?>" readonly="readonly"></td>
									</tr></ul></table><br>
								<div class="body">
									<div class="row clearfix">
									<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"> 
									<form action="<?php echo site_url('anggaran-kas/murni/rencana/'.$id_kode);?>" name="form" method="POST">
									<input type="input" name="kode_anggaran" value="<?php echo $id_anggaran;?>">
									<input type="input" name="kode_skpd" value="<?php echo $id_skpd;?>">
									<input type="input" name="kode_program" value="<?php echo $id_program;?>">
									<input type="input" name="kode_total" value="<?php echo $task->totalRKA;?>">
									<input type="input" name="kode" value="<?php echo $id_kode; ?>">
										<div class="row clearfix">
										<div id="l_Anggaran" class="col-md-6">
											<div class="form-group form-float">
												<div class="form-line">
												<input type="text" class="form-control" id="total_sum" style="text-align:right;font-weight:bold;" placeholder="0" readonly="readonly">
												<input type="hidden" class="form-control" id="jumlah" style="text-align:right;font-weight:bold;" placeholder="0" readonly="readonly">
												<label class="form-label" for="bbb_kode">Anggaran</label>
												</div>
											</div>
										</div>
										</div>									

											<input type="hidden" id="stok" value="<?php echo ($task->totalRKA);?>">
											<input type="hidden" id="angka1" value="<?php echo ($task->totalRKA);?>">													
											<input type="hidden" id="angka2" value="12">
											<?php } ?>

										<div class="form-group">
										<div class="col-md-offset-11">
											<a id="displayText" href="javascript:toggle();" onFocus="dShow()" onclick="hasil()" class="btn btn-primary waves-effect">Bagi Rata</a>										
										</div>
										</div>														

										<div class="row clearfix">
											<div class="col-md-4">
											<div class="form-group form-float">
												<div class="form-line">
													<input type="text" class="form-control" name="jan" id="jan" onkeyup="totalSum()" placeholder="0" style="text-align:right;">
													<label class="form-label" for="bbb_kode">Januari</label>
												</div>
											</div>
											</div>

											<div class="col-md-4">
											<div class="form-group form-float">
												<div class="form-line">
													<input type="text" class="form-control" name="mei" id="mei" onkeyup="totalSum()" placeholder="0" style="text-align:right;">
													<label class="form-label" for="bbb_kode">Mei</label>
												</div>
											</div>
											</div>

											<div class="col-md-4">
											<div class="form-group form-float">
												<div class="form-line">
													<input type="text" class="form-control" name="sep" id="sep" onkeyup="totalSum()" placeholder="0" style="text-align:right;">
													<label class="form-label" for="bbb_kode">September</label>
												</div>
											</div>
											</div>
										</div>

										<div class="row clearfix">
											<div class="col-md-4">
											<div class="form-group form-float">
												<div class="form-line">
													<input type="text" class="form-control" name="feb" id="feb" onkeyup="totalSum()" placeholder="0" style="text-align:right;">
													<label class="form-label" for="bbb_kode">Februari</label>
												</div>
											</div>
											</div>

											<div class="col-md-4">
											<div class="form-group form-float">
												<div class="form-line">
													<input type="text" class="form-control" name="jun" id="jun" onkeyup="totalSum()" placeholder="0" style="text-align:right;">
													<label class="form-label" for="bbb_kode">Juni</label>
												</div>
											</div>
											</div>

											<div class="col-md-4">
											<div class="form-group form-float">
												<div class="form-line">
													<input type="text" class="form-control" name="okt" id="okt" onkeyup="totalSum()" placeholder="0" style="text-align:right;">
													<label class="form-label" for="bbb_kode">Oktober</label>
												</div>
											</div>
											</div>
										</div>

										<div class="row clearfix">
											<div class="col-md-4">
											<div class="form-group form-float">
												<div class="form-line">
													<input type="text" class="form-control" name="mar" id="mar" onkeyup="totalSum()" placeholder="0" style="text-align:right;">
													<label class="form-label" for="bbb_kode">Maret</label>
												</div>
											</div>
											</div>

											<div class="col-md-4">
											<div class="form-group form-float">
												<div class="form-line">
													<input type="text" class="form-control" name="jul" id="jul" onkeyup="totalSum()" placeholder="0" style="text-align:right;">
													<label class="form-label" for="bbb_kode">Juli</label>
												</div>
											</div>
											</div>

											<div class="col-md-4">
											<div class="form-group form-float">
												<div class="form-line">
													<input type="text" class="form-control" name="nov" id="nov" onkeyup="totalSum()" placeholder="0" style="text-align:right;">
													<label class="form-label" for="bbb_kode">November</label>
												</div>
											</div>
											</div>
										</div>

										<div class="row clearfix">
											<div class="col-md-4">
											<div class="form-group form-float">
												<div class="form-line">
													<input type="text" class="form-control" name="apr" id="apr" onkeyup="totalSum()" placeholder="0" style="text-align:right;">
													<label class="form-label" for="bbb_kode">April</label>
												</div>
											</div>
											</div>
											
											<div class="col-md-4">
											<div class="form-group form-float">
												<div class="form-line">
													<input type="text" class="form-control" name="ags" id="ags" onkeyup="totalSum()" placeholder="0" style="text-align:right;">
													<label class="form-label" for="bbb_kode">Agustus</label>
												</div>
											</div>
											</div>
																
											<div class="col-md-4">
											<div class="form-group form-float">
												<div class="form-line">
													<input type="text" class="form-control" name="des" id="des" onkeyup="totalSum()" placeholder="0" style="text-align:right;">
													<label class="form-label" for="bbb_kode">Desember</label>
												</div>
											</div>
											</div>
										</div>

										<div class="row clearfix">
										<div id="toggleText" class="col-md-offset-9" style="display: none">
											<button type="submit" class="btn btn-primary waves-effect">Simpan</button>
											<a class="btn btn-default" href="<?php echo base_url(); ?>anggaran-kas/murni/belanja/<?php echo $id_anggaran;?>">Batal</a>
										</div>										
										</div>
										
										<div class="row clearfix">
										<div class="col-md-offset-9">
											<button type="submit" class="btn btn-primary waves-effect" id="tambah">Simpan</button>
											<a class="btn btn-default" href="<?php echo base_url(); ?>anggaran-kas/murni/belanja/<?php echo $id_anggaran;?>" id="tambah1">Batal</a>
										</div>
										</div>
				
									</form>
									</div>
									</div>
								</div>
								</div>
								</div>

							</div>
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
<script src="<?php echo base_url('public/templates/integrasi_v.4.0/js/rencana/jquery.js');?>"></script>
<script>
	var jumlah;
	var stok;
		$(function(){
	//jika tombol tambah di klik
		$("#tambah").click(function(){
		stok=$("#stok").val();
		jumlah=$("#jumlah").val();
		if(jumlah > stok){
			alert("Anggaran Kelebihan");
			$("#jumlah").focus();
		return false; }
		if(jumlah < stok){
			alert("Anggaran Kurang");
			$("#jumlah").focus();
		return false; }
		});
	return true });
</script>
<script>
function totalSum(){
		var jan		= document.getElementById("jan").value || 0;
		var feb		= document.getElementById("feb").value || 0;
		var mar		= document.getElementById("mar").value || 0;
		var apr		= document.getElementById("apr").value || 0;
		var mei		= document.getElementById("mei").value || 0;
		var jun		= document.getElementById("jun").value || 0;
		var jul		= document.getElementById("jul").value || 0;
		var ags		= document.getElementById("ags").value || 0;
		var sep		= document.getElementById("sep").value || 0;
		var okt		= document.getElementById("okt").value || 0;
		var nov		= document.getElementById("nov").value || 0;
		var des		= document.getElementById("des").value || 0;
		var result	= parseInt(jan) + parseInt(feb) + parseInt(mar) + parseInt(apr) + parseInt(mei) + parseInt(jun) + parseInt(jul) + parseInt(ags) + parseInt(sep) + parseInt(okt) + parseInt(nov) + parseInt(des);
		document.getElementById("total_sum").value = tandaPemisah(result);
		document.getElementById("jumlah").value = result;
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
<script language="javascript">
function cek(){
if(form.angka1.value == "" || form.angka2.value == ""){
alert("data kosong"); //jika angka kosong maka pesan akan tampil
exit;
}
}
function hasil() {
cek();
a=eval(form.angka1.value);
b=eval(form.angka2.value);
c=a/b
form.jan.value = Math.round (c);
form.feb.value = Math.round (c);
form.mar.value = Math.round (c);
form.apr.value = Math.round (c);
form.mei.value = Math.round (c);
form.jun.value = Math.round (c);
form.jul.value = Math.round (c);
form.ags.value = Math.round (c);
form.sep.value = Math.round (c);
form.okt.value = Math.round (c);
form.nov.value = Math.round (c);
form.des.value = Math.round (c);
}
</script>
<script type="text/javascript"> 
function dShow()
{document.getElementById("tambah").style.visibility="hidden";
document.getElementById("tambah1").style.visibility="hidden";
document.getElementById("l_Anggaran").style.visibility="hidden";}
</script>
<script language="javascript">
function toggle() { 
var ele = document.getElementById("toggleText"); 
var text = document.getElementById("displayText"); 
if (ele.style.display == "block") 
	{ text.innerHTML = "Bagi Rata"; 
	} else { ele.style.display = "block"; 
		text.innerHTML = "Bagi Rata";
	} }
</script>