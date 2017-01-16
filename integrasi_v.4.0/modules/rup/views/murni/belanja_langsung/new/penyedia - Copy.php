<!-- Main Content -->   
   <section class="content">
		<h2>SIRUP Murni<small> entri data &amp; informasi detail</small></h2>  
			<div class="body">
				<ol class="breadcrumb breadcrumb-col-cyan">
					<li><a href="<?php echo site_url('dashboard');?>"><i class="material-icons">home</i> Home</a></li>
					<li><a href="<?php echo site_url('rup/murni');?>"> SIRUP</a></li>
					<li class="active"> Penyedia</li>
				</ol>
			</div>
            <!-- Multiple Items To Be Open -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
							<p align="center"><b><?php echo strtoupper($skpd);?></b></p>
							<p class="control-label col-md-10">Program &nbsp;:&nbsp; <?php echo $program ?></p>
							<p class="control-label col-md-10">Kegiatan &nbsp;:&nbsp; <?php echo $kegiatan; ?></p>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <button type="button" class="btn bg-black waves-effect waves-light">ACTIONS</button>
                                    </a>
                                    <ul class="dropdown-menu pull-right">                                       
                                        <li><a title="Tambah" href="<?php echo site_url('rup/murni/belanja-langsung/'.$kode);?>"><i class="material-icons">add_circle_outline</i> RUP Penyedia</a></li>
                                        <li><a title="Tambah" href="<?php echo site_url('rup/murni/belanja-langsung/'.$kode);?>"><i class="material-icons">add_circle_outline</i> RUP Swakelola</a></li>
										<li><a title="Print RKA" href="<?php echo site_url('rka/murni/rka/'.$kode);?>"><i class="material-icons">print</i> Print RUP</a></li>
                                        <li><a title="Kembali" href="<?php echo base_url('rup/murni');?>"><i class="material-icons">reply</i> Kembali</a></li>
                                    </ul>
                                </li>
                            </ul>
							<div class="panel-body"></div>
                        </div>
                        <div class="body">
                            <div class="row clearfix">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <!-- Nav tabs -->
                                    <ul class="nav nav-tabs tab-nav-right" role="tablist">
                                        <li role="presentation" class="active"><a href="#home_animation_1" data-toggle="tab">Penyedia</a></li>
                                        <li><a href="javascript:void(0);">Swakelola</a></li>
                                    </ul>
                                    <!-- Tab panes -->
                                    <div class="tab-content">
                                        <div role="tabpanel" class="tab-pane animated flipInX active" id="home_animation_1">
                                            <b><?php echo validation_errors(); ?><?php if ($this->session->flashdata('success')) { echo $this->session->flashdata('success');} ?></b>
                                            <p><table class="table table-bordered table-striped table-hover js-basic-example dataTable" style="font-size:8pt;">
											<thead>
											<tr>
												<th style="text-align:center; width:30px">No</th>
												<th style="text-align:center;">Nama Paket</th>
												<th style="text-align:center; width:100px">Pagu (Rp.)</th>
												<th style="text-align:center; width:150px">Metode Pemilihan Penyedia</th>
												<th style="text-align:center; width:100px">Sumber Dana</th>
												<th style="text-align:center; width:25px">U</th>
												<th style="text-align:center; width:45px">Aktif</th>
												<th style="text-align:center; width:60px">Actions</th>
											</tr>
											</thead>
											<tbody><?php if($complete):?><?php foreach($complete as $task):?>
												<tr><?php $i++;?>
													<td style="text-align:center;"><?php echo $i;?></td>
													<td style="text-align:left;"><?php echo $task->nama_kegiatan;?></td>
													<td style="text-align:right;"><?php echo rupiah2($task->pagu);?></td>
													<td style="text-align:center;"><?php echo $task->metode;?></td>
													<td style="text-align:center;"><?php echo $task->sumber;?></td>
													<td style="text-align:center;"><input type="checkbox" id="basic_checkbox_1" class="filled-in" <?php echo ($task->aktif == 1)?'checked disabled':'';?><?php echo ($task->aktif == 2)?'disabled':'';?>><label for="basic_checkbox_1"></label></td>
													<td style="text-align:center;"><input type="checkbox" id="basic_checkbox_2" class="filled-in" <?php echo ($task->aktif == 1)?'checked disabled':'';?><?php echo ($task->aktif == 2)?'disabled':'';?>><label for="basic_checkbox_2"></label></td>													
													<td style="text-align:center;">										
														<a class="btn btn-sm btn-warning" title="View" href="javascript:void(0);"><i class="fa fa-pencil"></i></a>
													</td>
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