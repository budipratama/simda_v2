<!-- Main Content -->
<div class="container-fluid">
	<div class="side-body padding-top">
		<!-- END PAGE HEADER-->
		<div class="col-md-5">
            <div class="panel panel-primary">
				<div class="panel-body">				
				<!-- BEGIN FORM -->
				<form class="form-horizontal" method="post">
					<div class="form-group">
						<div class="col-md-5">
						<div class="form-group">
							<label class="control-label col-md-2" for="aaa_kode">Akun<span class="required">*</span> :</label>
							<div class="col-md-2">						
							<?php combobox('db', $rek, 'hidden1', 'kode', 'akun_nama', '', 'show_form_debet_by_kelompok();', 'Pilih Akun', 'class="select2_category form-control" tabindex="1" required="required"'); ?>
							</div>
						</div>
						</div>
						<div class="col-md-5">
						<div class="form-group" id="tampil_combobox_debet_by_kelompok">
							<label class="control-label col-md-2" for="bbb_kode">Kelompok:</label>
							<div class="col-md-10">
							<select class="select2_category form-control" name="bbb_kode" id="bbb_kode" data-placeholder="Pilih Sasaran" required="required"></select>
							</div>
						</div>
						</div>
						<div class="col-md-7">
						<div class="form-group" id="tampil_combobox_debet_by_jenis">
							<label class="control-label col-md-2" for="ccc_kode">Jenis:</label>
							<div class="col-md-8">
							<select class="select2_category form-control" name="ccc_kode" id="ccc_kode" data-placeholder="Pilih Sasaran" required="required"></select>
							</div>
						</div>						
						</div>
						<div class="col-md-5">
						<div class="form-group" id="tampil_combobox_jenis_by_obyek">
							<label class="control-label col-md-2" for="ddd_kode">Obyek:</label>
							<div class="col-md-10">
							<select class="select2_category form-control" name="ddd_kode" id="ddd_kode" data-placeholder="Pilih Sasaran" required="required"></select>
							</div>
						</div>
						</div>
						<div class="col-md-7">
						<div class="form-group" id="tampil_combobox_obyek_by_rincian">
							<label class="control-label col-md-2" for="eee_kode">Rincian:</label>
							<div class="col-md-8">
							<select class="select2_category form-control" name="eee_kode" id="eee_kode" data-placeholder="Pilih Sasaran" required="required"></select>
							</div>
						</div>
						</div>
						<div class="col-md-2">
						<div class="portlet" align="right">
							<input class="btn btn-success" type="submit" name="button3" id="button3" value="Pilih" onclick="cekdata(); window.opener.document.getElementById('debet1').value = kembali1; window.opener.document.getElementById('debet2').value = kembali2; window.opener.document.getElementById('debet3').value = kembali3; window.opener.document.getElementById('debet4').value = kembali4; window.opener.document.getElementById('debet5').value = kembali5; window.opener.document.getElementById('debet6').value = kembali6; window.close(); " />
							<a href="#" onclick="window.close();" class="btn btn-default"><i class="fa fa-times"></i> Batal</a>
						</div>
						</div>
					</div>		
				</div>
				</form>
				<!-- END FORM-->
			</div>
		</div>
	</div>
</div>
<!-- END CONTENT -->	
<script language="javascript">
	var kembali1 = '';
	var kembali2 = '';
	var kembali3 = '';
	var kembali4 = '';
	var kembali5 = '';
	var kembali6 = '';
	var i;
	function cekdata()
	{
		kembali1='';
		kembali2='';
		kembali3='';
		kembali4='';
		kembali5='';
		kembali6='';
		for (i=1;i<=1;i++) //jika ingin dinamis, jumlahnya diganti <?php // echo $jmldata; ?> 
		{
			if (document.getElementById('cek'+i).checked==true)
			{
				if (kembali1=='')
				{
					kembali1=document.getElementById('hidden1').value;
					kembali2=document.getElementById('hidden2').value;
					kembali3=document.getElementById('hidden3').value;
					kembali4=document.getElementById('hidden4').value;
					kembali5=document.getElementById('hidden5').value;
					kembali6='Nama'+i;
				}
				else
				{
					kembali1=kembali1+'.'+document.getElementById('hidden1').value;
					kembali2=kembali2+'.'+document.getElementById('hidden2').value;
					kembali3=kembali3+'.'+document.getElementById('hidden3').value;
					kembali4=kembali4+'.'+document.getElementById('hidden4').value;
					kembali5=kembali5+'.'+document.getElementById('hidden5').value;
					kembali6=kembali6+', Nama'+i;
				}
			}
		}
	}
	
	function show_form_debet_by_kelompok(){
		var hidden1 = $('select[name=hidden1]').val();
		load('parameter/korolari/tampil_combobox_debet_by_kelompok/'+hidden1, '#tampil_combobox_debet_by_kelompok');
		load('parameter/korolari/tampil_combobox_debet_by_jenis/', '#tampil_combobox_debet_by_jenis');
		load('parameter/korolari/tampil_combobox_jenis_by_obyek/', '#tampil_combobox_jenis_by_obyek');
		load('parameter/korolari/tampil_combobox_obyek_by_rincian/', '#tampil_combobox_obyek_by_rincian');
	}
	
	function show_form_debet_by_jenis(){
		var hidden2 = $('select[name=hidden2]').val();
		load('parameter/korolari/tampil_combobox_debet_by_jenis/'+hidden2, '#tampil_combobox_debet_by_jenis');
		load('parameter/korolari/tampil_combobox_jenis_by_obyek/', '#tampil_combobox_jenis_by_obyek');
		load('parameter/korolari/tampil_combobox_obyek_by_rincian/', '#tampil_combobox_obyek_by_rincian');
	}
	
	function show_form_jenis_by_obyek(){
		var hidden3 = $('select[name=hidden3]').val();
		load('parameter/korolari/tampil_combobox_jenis_by_obyek/'+hidden3, '#tampil_combobox_jenis_by_obyek');
		load('parameter/korolari/tampil_combobox_obyek_by_rincian/', '#tampil_combobox_obyek_by_rincian');
	}
	
	function show_form_obyek_by_rincian(){
		var hidden4 = $('select[name=hidden4]').val();
		load('parameter/korolari/tampil_combobox_obyek_by_rincian/'+hidden4, '#tampil_combobox_obyek_by_rincian');
	}
</script>