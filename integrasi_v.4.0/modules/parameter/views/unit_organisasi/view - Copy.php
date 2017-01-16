<!-- Main Content -->
   <section class="content">
		<h2>Parameter<small> unit organisasi</small></h2>  
			<div class="body">
				<ol class="breadcrumb breadcrumb-col-cyan">
					<li><a href="<?php echo site_url('dashboard');?>"><i class="material-icons">home</i> Home</a></li>
					<li><a href="<?php echo site_url('parameter');?>"> Parameter</a></li>
					<li><a href="<?php echo site_url('parameter/unit-organisasi');?>"> Unit Organisasi</a></li>
					<li class="active"> Urusan</li>
				</ol>
			</div>
            <!-- Multiple Items To Be Open -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header bg-light-green">
						<h2>Unit Organisasi<small>Data Urusan</small></h2>
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
                                        <li role="presentation" class="active"><a href="javascript:void(0);" data-toggle="tab">Urusan</a></li>
                                        <li><a href="javascript:void(0);">Bidang</a></li>
                                        <li><a href="javascript:void(0);">Unit</a></li>
                                        <li><a href="javascript:void(0);">Unit Sub</a></li>
                                    </ul>
                                    <!-- Tab panes -->
									
									
									
									
								<br><div class="row clearfix">
										<div class="col-md-3">
											<?php combobox('db', $tahun, 'tahun', 'tahun', 'tahun', '', '', 'Pilih Tahun Anggaran', 'class="form-control show-tick" data-live-search="true" tabindex="1" required="required"'); ?>
										</div>

										<div class="col-md-3">
											<button type="button" class="btn btn-primary atur" onclick="myFunction()">Show</button>
										</div>
									</div>
									



<script>
function myFunction() {
    var x = document.getElementById("tahun").value;
    document.getElementById("demo").innerHTML = x;
}
</script>
									
									
									
									
									
									
									
									
									
									
									
									
                                    <div class="tab-content">
                                        <div role="tabpanel" class="tab-pane animated flipInX active" id="demo">
                                            <b><?php echo validation_errors(); ?><?php if ($this->session->flashdata('success')) { echo $this->session->flashdata('success');} ?></b>
                                            <p><table class="table table-bordered table-striped table-hover js-basic-example dataTable">
											<thead>
											<tr>
												<th style="text-align:center; width:60px">Urusan</th>
												<th style="text-align:center;">Uraian Nama Urusan</th>
											</tr>
											</thead>
											<tbody><?php if(isset($urusan)):?><?php foreach($urusan as $list):?>
												<tr>
													<td style="text-align:center;"><?php echo $list->no;?></td>													
													<td><a href="<?php echo base_url('parameter/unit-organisasi/bidang/'.$list->kode);?>"><?php echo $list->nm_urusan;?></a></td>
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