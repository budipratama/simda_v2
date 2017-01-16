<!-- Main Content -->
   <section class="content">
		<h2>Parameter<small> unit organisasi</small></h2>  
			<div class="body">
				<ol class="breadcrumb breadcrumb-col-cyan">
					<li><a href="<?php echo site_url('dashboard');?>"><i class="material-icons">home</i> Home</a></li>
					<li><a href="<?php echo site_url('parameter');?>"> Parameter</a></li>
					<li><a href="<?php echo site_url('parameter/unit-organisasi');?>"> Unit Organisasi</a></li>
					<li class="active"> Bidang</li>
				</ol>
			</div>
            <!-- Multiple Items To Be Open -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header bg-light-green">
						<h2>Unit Organisasi<small>Data Bidang</small></h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="<?php echo site_url('parameter/unit-organisasi');?>"><i class="material-icons">reply</i> Kembali</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <div class="row clearfix">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <!-- Nav tabs -->
                                     <ul class="nav nav-tabs tab-nav-right" role="tablist">
                                        <li><p class="col-cyan"><a href="<?php echo site_url('parameter/unit-organisasi');?>"><i class="material-icons">keyboard_arrow_left</i>Urusan</a></p></li>
                                        <li role="presentation" class="active"><a href="javascript:void(0);" data-toggle="tab">Bidang</a></li>
                                        <li><a href="javascript:void(0);">Unit</a></li>
                                        <li><a href="javascript:void(0);">Sub Unit</a></li>
                                    </ul>
                                    <!-- Tab panes -->
                                    <div class="tab-content">
                                        <div role="tabpanel" class="tab-pane animated fadeInRight active" id="home_animation_2">
                                            <b><?php echo validation_errors(); ?><?php if ($this->session->flashdata('success')) { echo $this->session->flashdata('success');} ?></b>
                                            <p><table class="table table-bordered table-striped table-hover js-basic-example dataTable">
											<thead><tr>
											<th style="text-align:center; width:60px">Urusan</th>
											<th style="text-align:center; width:60px">Bidang</th>
											<th style="text-align:center;">Uraian Nama Bidang</th>
											<th style="text-align:center; width:60px">Fungsi</th>
											</tr></thead>
												<tbody><?php if($bidang):?><?php foreach($bidang as $task): ?>
													<tr>
													<td style="text-align:center;"><?php echo $tipe->no;?></td>
													<td style="text-align:center;"><?php echo $task->no_urusan;?></a></td>									
													<td><a href="<?php echo site_url('parameter/unit-organisasi/unit/'.$task->task_id);?>"><?php echo $task->urusan;?></a></td>
													<td style="text-align:center;"><?php echo $task->no_fungsi;?></a></td>
													</tr>
												  <?php endforeach; ?><?php else : ?><td>-</td><td>-</td><td style="text-align:center; width:500px">Tidak ada data pada tabel ini</td><td>-</td><?php endif; ?>
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