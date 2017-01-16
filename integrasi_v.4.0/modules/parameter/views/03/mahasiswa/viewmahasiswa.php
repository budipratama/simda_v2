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
                                        <li><a title="Kembali" href="<?php echo base_url('parameter'); ?>"><i class="material-icons">reply</i> Kembali</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <div class="row clearfix">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">								
		


        <link rel="stylesheet" href="<?php echo base_url(); ?>public/01/css/bootstrap.min.css"/>
        <link rel="stylesheet" href="<?php echo base_url(); ?>public/01/select2.min.css"/>
		
    <link href="<?php echo base_url()?>public/01/css/style.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="<?php echo base_url()?>public/01/js/jquery.js"></script>
    <script>
        $().ready(function(){                        
            $("#tombolTambah").click(function(){
                $.ajax({
                    url : "<?php echo base_url() ?>parameter/conmahasiswa/tambah",
                    beforeSend: function(){
                                        $("#data").html("Loading...");
                                    },
                    success:    function(html){
                                    $("#data").html(html);
                                    $("#btnSimpan").show();
                                    $("#tombolTambah").hide();
									
									$("#jurusan").select2({
									placeholder: "Please Select" });

									$("#angkatan").select2({
									placeholder: "Please Select" });									
                                }                
                });            
            });        
            
            $("#btnSimpan").click(function(){                
                var nim = $("#nim").val();
                var nama = $("#nama").val();
                var jurusan = $("#jurusan").val();
                var angkatan = $("#angkatan").val();
                var ipk = $("#ipk").val();
                
                $.ajax({
                    url : "<?php echo base_url() ?>parameter/conmahasiswa/tambah",
                    type: "post",
                    beforeSend: function(){
                                        $("#data").html("Loading...");
                                    },
                    data    : "nim="+nim+"&nama="+nama+"&jurusan="+jurusan+"&angkatan="+angkatan+"&ipk="+ipk,
                    success:    function(html){
                                $("#tombolTambah").show();                                 
                                 $("#btnSimpan").hide();                                 
                                    $("#data").load("<?php echo base_url() ?>parameter/conmahasiswa/ #data");
                                    $("#notifikasi").html('Data berhasil disimpan');                                    
                                    $("#notifikasi").fadeIn(2500);
                                    $("#notifikasi").fadeOut(2500);                                
                                }                
                });            
            });
            
                $("#tombolUpdate").click(function(){                    
                    var nim = $("#nim").val();
                    var nama = $("#nama").val();
                    var jurusan = $("#jurusan").val();
                    var angkatan = $("#angkatan").val();
                    var ipk = $("#ipk").val();                    
                    $.ajax({
                        url : "<?php echo base_url() ?>parameter/conmahasiswa/update",
                        type: "post",
                        beforeSend: function(){
                                            $("#data").html("Loading...");
                                        },
                        data    : "nim="+nim+"&nama="+nama+"&jurusan="+jurusan+"&angkatan="+angkatan+"&ipk="+ipk,
                        success:    function(html){
                                    $("#tombolTambah").show();                                 
                                     $("#tombolUpdate").hide();                                 
                                        $("#data").load("<?php echo base_url() ?>parameter/conmahasiswa/ #data");
                                        $("#notifikasi").html('Data berhasil diedit');                                    
                                        $("#notifikasi").fadeIn(2500);
                                        $("#notifikasi").fadeOut(2500);                
                                    }                
                    });            
                });                                        
        });
        
        function edit(nim){
            $().ready(function(){                                        
                $.ajax({
                    url : "<?php echo base_url() ?>parameter/conmahasiswa/edit/"+nim,        
                    beforeSend: function(){
                                        $("#data").html("Loading...");
                                    },                
                    success:    function(html){
                                $("#tombolUpdate").show();                                 
                                 $("#tombolTambah").hide();                                 
                                    $("#data").html(html); 

				$("#jurusan").select2({
                    placeholder: "Please Select"
                });

									
                                }                
                });                    
            });        
        }
        
        function hapus(nim){
            if(confirm('Yakin Menghapus?')){
            $().ready(function(){                                        
                $.ajax({                    
                    url : "<?php echo base_url() ?>parameter/conmahasiswa/delete/"+nim,        
                    beforeSend: function(){
                                        $("#data").html("Loading...");
                                    },                                                
                    success:    function(html){
                                $("#tombolUpdate").hide();                                 
                                 $("#tombolTambah").show();                                 
                                    $("#data").load('<?php echo base_url() ?>parameter/conmahasiswa/ #data');
										$("#notifikasi").html('Data berhasil dihapus');                                    
                                        $("#notifikasi").fadeIn(2500);
                                        $("#notifikasi").fadeOut(2500);  
                                }                
                });                    
            });    
        }        
        }
            
    </script>
	
        <script src="<?php echo base_url(); ?>public/01/select2.min.js"></script>
        <script>
            $(document).ready(function () {
                $("#kota2").select2({
                    placeholder: "Please Select"
                });
            });

        </script>
	
	
	
	
	
	
	
<head>
<body>
    <div id="notifikasi" style="display:none"></div>
    <div id="wraper">
    
        <div id="header">
            <h2>CRUD Dengang CodeIgniter + Ajax + JQuery</h2>
        </div>
		
        <div id="content">
            <div id="paneltombol">
                <input type="button" class="tombol" id="btnSimpan" value="Simpan" style="display:none">
                <input type="button" class="tombol" id="tombolTambah" name="tombolTambah" value="Tambah Data">
                <input type="button" class="tombol" id="tombolUpdate" name="tombolUpdate" value="Update" style="display:none">
            </div>			
			
            <div id="data">                
                <table border="0" width="100%" cellspacing="0" >
                <tr>
                    <th>Nim</th>
                    <th>Nama</th>
                    <th>Jurusan</th> 
                    <th>Angkatan</th>
                    <th>IPK</th>
                    <th colspan="2">Aksi</th>
                </tr>
                <?php foreach($mahasiswa as $baris):?>
                <tr>
                    <td><?php echo $baris->nim ?></td>
                    <td><?php echo $baris->nama ?></td>
                    <td><?php echo $baris->jurusan ?></td>
                    <td><?php echo $baris->angkatan ?></td>
                    <td><?php echo $baris->ipk ?></td>
                    <td width="30"><a class="btn btn-small" href="javascript:void(0);" onclick="edit('<?php echo $baris->nim ?>')"><i class="icon-pencil"></i> Edit</a></td>
                    <td width="30"><a class="btn btn-small" href="javascript:void(0);" onclick="hapus('<?php echo $baris->nim ?>')"><i class="icon-pencil"></i> Hapus</a></td>
                </tr>
                <?php endforeach ?>
                </table>
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