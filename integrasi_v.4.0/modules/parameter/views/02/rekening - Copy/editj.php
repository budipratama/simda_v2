<!-- Main Content -->
   <section class="content">
		<h2>Parameter<small> rekening</small></h2>  
			<div class="body">
				<ol class="breadcrumb breadcrumb-col-cyan">
					<li><a href="<?php echo site_url('dashboard');?>"><i class="material-icons">home</i> Home</a></li>
					<li><a href="<?php echo site_url('parameter');?>"> Parameter</a></li>
					<li><a href="<?php echo site_url('parameter/rekening');?>"> Rekening</a></li>
					<li class="active"> Edit Data Jenis</li>
				</ol>
			</div>
            <!-- Multiple Items To Be Open -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header bg-purple">
						<h2>Rekening<small>Data Jenis</small></h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="<?php echo site_url('parameter/rekening/jenis/'.$this_task->kelompok);?>"><i class="material-icons">reply</i> Kembali</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <div class="row clearfix">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <!-- Nav tabs -->
                                     <ul class="nav nav-tabs tab-nav-right" role="tablist">
                                       <li><a href="javascript:void(0);">Akun</a></li>
                                        <li><a href="javascript:void(0);">Kelompok</a></li>
                                        <li role="presentation" class="active"><a href="#home_animation_2" data-toggle="tab">Jenis</a></li>
										<li><a href="javascript:void(0);">Obyek</a></li>
										<li><a href="javascript:void(0);">Rincian</a></li>
                                    </ul>
                                    <!-- Tab panes -->
                                    <div class="tab-content">
									<form action="<?php echo site_url('parameter/rekening/ubahj/'.$this_task->kode);?>" class="form-horizontal" method="post" name="form" onSubmit="return validasi()">
									<input type="hidden" name="kode" value="<?php echo $this_task->kode;?>"/>
										<div role="tabpanel" class="tab-pane fade in active" id="step1" aria-labelledby="home-tab">
											<div class="portlet-body">
											<table class="table table-striped table-bordered table-hover" width="50%" cellspacing="5" cellpadding="5">
												<tr>
													<th style="text-align:center; width:100px">Jenis</th>
													<th style="text-align:center;">Uraian Rekening Jenis</th>
													<th style="text-align:center; width:150px">Saldo Normal</th>
												</tr>
													<ul>
														<tr>
														<td style="text-align:center;"><input type="text" class="form-control" name="ccc_kode" value="<?php echo $this_task->no; ?>" readonly="readonly"></td>
														<td><input type="text" class="form-control" name="ddd_kode" value="<?php echo $this_task->jenis_nama; ?>" required="required"></td>
														<td style="text-align:center;"><?php combobox('db', $saldo, 'eee_kode', 'tipe_kode', 'tipe_nama', $saldo_, '', 'Pilih Saldo ...', 'class="select2_category form-control" tabindex="1"'); ?></td>
														</tr>
													</ul>
											</table>
											<div class="form-group">
												<div class="col-md-offset-9">
													<button type="submit" class="btn btn-primary">Simpan</button>
													<a href="<?php echo site_url('parameter/rekening/jenis/'.$this_task->kelompok);?>" class="btn btn-default">Batal</a>
												</div>
											</div>
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
            <!-- #END# Tabs With Custom Animations -->
        </div>
    </section>
<script>
    function validasi(){
        var saldo = form.eee_kode.value;
        var pesan = '';         
        if (saldo == '') { pesan += 'Saldo Normal, belum dipilih ... \n'; }         
        if (pesan != '') { alert(' \n'+pesan); return false; }
    return true }
</script>