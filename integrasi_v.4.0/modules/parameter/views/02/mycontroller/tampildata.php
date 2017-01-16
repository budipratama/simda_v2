<!-- Main Content -->
   <section class="content">
		<h2>Parameter<small> rekening</small></h2>  
			<div class="body">
				<ol class="breadcrumb breadcrumb-col-cyan">
					<li><a href="<?php echo site_url('dashboard');?>"><i class="material-icons">home</i> Home</a></li>
					<li><a href="<?php echo site_url('parameter');?>"> Parameter</a></li>
					<li><a href="<?php echo site_url('parameter/rekening');?>"> Rekening</a></li>
					<li class="active"> Akun</li>
				</ol>
			</div>
            <!-- Multiple Items To Be Open -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header bg-purple">
						<h2>Rekening<small>Data Akun</small></h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">   
										<li><a href="#" data-toggle="modal" data-target="#addJenis"><i class="material-icons">add_circle</i> Jenis</a></li>									
                                        <li><a title="Kembali" href="<?php echo base_url('parameter'); ?>"><i class="material-icons">reply</i> Kembali</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <div class="row clearfix">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <!-- Nav tabs -->
                                    <ul class="nav nav-tabs tab-nav-right" role="tablist">
                                        <li role="presentation" class="active"><a href="#home_animation_1" data-toggle="tab">Akun</a></li>
                                        <li><a href="javascript:void(0);">Kelompok</a></li>
                                        <li><a href="javascript:void(0);">Jenis</a></li>
                                        <li><a href="javascript:void(0);">Obyek</a></li>
                                        <li><a href="javascript:void(0);">Rincian</a></li>
                                    </ul>
                                    <!-- Tab panes -->
									
									<?php combobox('db', $tahun, 'tahun', 'tahun', 'tahun', $tahun_1, '', 'Pilih Tahun Anggaran', 'class="form-control show-tick" data-live-search="true" tabindex="1"');?>
									
                                    <div class="tab-content" id="tampildata_id">
                                        <div role="tabpanel" class="tab-pane animated flipInX active">
                                            <b><div class="body">
												<div class="collapse" id="collapseExample">
													<div class="well"><div class="row clearfix" id="tampiljquery"></div></div>
												</div>
											</div></b>
                                            <p><table class="table table-bordered table-striped table-hover js-basic-example dataTable">
											<thead>
											<tr>
												<th style="text-align:center; width:50px">Akun</th>
												<th style="text-align:center;">Uraian Rekening Akun</th>
												<th style="text-align:center;">No Tlpn</th>
												<th style="text-align:center;"><a href="#collapseExample" class="btn btn-default" id="tambahdata_id" role="button" data-toggle="collapse" aria-expanded="false" aria-controls="collapseExample">Tambah Data</a>
											</th>
											</tr>
											</thead>
											<tbody><?php $no = 1; foreach (array_reverse($jenis) as $tampil) { ?>
												<tr>
													<td><?=$no++;?></td>													
													<td><?=$tampil->nm_rek_3;?></td>
													<td><?=$tampil->saldo_normal;?></td>
													<td>
														<a href="javascript:void(0)" class="btn btn-primary edit_data" id="<?=$tampil->kode;?>">Edit</a>
														<a href="javascript:void(0)" class="btn btn-danger hapus_data" id="<?=$tampil->kode;?>">Hapus</a>
													</td>													
												</tr>
												<?php } ?>
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
<script src="<?=base_url('public/asset/js/jquery-3.1.0.min.js');?>"></script>
<script>
$('#tambahdata_id').click(function() {
  var url = '<?=site_url("parameter/mycontroller/urltambah/")?>';
  $('#tampiljquery').load(url);
});

$('#tampiljquery').on('click', '#tambahdata_btn', function() {
  var nama_fm = $('#nama').val();
  var tlpn_fm = $('#tlpn').val();
  var alamat_fm = $('#alamat').val();
  var jk_fm = $('#jk').val();
  if (nama_fm == '' || tlpn_fm == '' || alamat_fm == '' || jk_fm == '') {
    alert('Form Tidak Boleh Kosong!!');
  }else {
    $.ajax({
      url: '<?=site_url("parameter/mycontroller/tambahdata/");?>',
      type: 'POST',
      dataType : 'json',
      data: {nama:nama_fm,tlpn:tlpn_fm,alamat:alamat_fm,jk:jk_fm},
      success: function(pesan){
        if (pesan) {
          var url = '<?=site_url("parameter/mycontroller/index/")?>';
          $('body').load(url);
          $('#formtambah form').trigger('reset');
        }
      },
      error: function (data, textStatus, jqXHR) {
        notify(textStatus);
      }

    });
  }
});

$('#tampildata_id table tr td').on('click', '.edit_data', function() {
  var id_edit = $(this).attr('id');
  $.ajax({
    url: '<?=site_url("parameter/mycontroller/editdataview/");?>',
    type: 'POST',
    data: 'id='+id_edit,
    success: function(pesan){
      $('#tampiljquery').html(pesan);
    },
    error: function(data, errorThrown){
            alert('request failed :'+errorThrown);
    }
  });
});

$('#tampiljquery').on('click', '#editdata_btn', function() {
  var id_fm 		= $('#idform').val();
  var nama_fm 		= $('#nama').val();
  var tlpn_fm 		= $('#tlpn').val();
  var alamat_fm 	= $('#alamat').val();
  var jk_fm = $('#jk').val();
  if (nama_fm == '' || tlpn_fm == '' || alamat_fm == '' || jk_fm == ''|| id_fm =='') {
    alert('Form Tidak Boleh Kosong!!');
  }else {
    $.ajax({
      url: '<?=site_url("parameter/mycontroller/editdata/");?>',
      type: 'POST',
      dataType: 'json',
      data:	{ 	id		:	id_fm,
				nama	:	nama_fm,
				tlpn	:	tlpn_fm,
				alamat	:	alamat_fm,
				jk		:	jk_fm
			},
      success: function(pesan){
        if (pesan) {
          var url = '<?=site_url("parameter/mycontroller/index/")?>';
          $('body').load(url);  
        }
      },
      error: function(data, errorThrown){
              alert('request failed :'+errorThrown);
      }
    });
  }
});
</script>