<div class="container"><a href="javascript:void(0)" class="btn btn-default" id="tambahdata_id">Tambah Data</a></div>
<div class="container" id="tampiljquery"></div>
<script src="<?=base_url('public/asset/js/jquery-3.1.0.min.js');?>"></script>
<script src="<?=base_url('asset/js/bootstrap.min.js');?>"></script>
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
  var id_fm = $('#idform').val();
  var nama_fm = $('#nama').val();
  var tlpn_fm = $('#tlpn').val();
  var alamat_fm = $('#alamat').val();
  var jk_fm = $('#jk').val();
  if (nama_fm == '' || tlpn_fm == '' || alamat_fm == '' || jk_fm == ''|| id_fm=='') {
    alert('Form Tidak Boleh Kosong!!');
  }else {
    $.ajax({
      url: '<?=site_url("parameter/mycontroller/editdata/");?>',
      type: 'POST',
      dataType: 'json',
      data: {id:id_fm,nama:nama_fm,tlpn:tlpn_fm,alamat:alamat_fm,jk:jk_fm},
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

$('#tampildata_id table tr td').on('click', '.hapus_data', function() {
  if (confirm('Yakin Akan Menghapus Data?')==true) {
    var id_edit = $(this).attr('id');
    $.ajax({
      url: '<?=site_url("parameter/mycontroller/hapusdata/");?>',
      type: 'POST',
      dataType: 'json',
      data: {id: id_edit},
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
  </body>
</html>
