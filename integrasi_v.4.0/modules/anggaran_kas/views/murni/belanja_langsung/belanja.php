<!-- Main Content -->
   <section class="content">
		<h2>Anggaran Kas Murni<small> anggaran belanja langsung</small></h2>  
			<div class="body">
				<ol class="breadcrumb breadcrumb-col-cyan">
					<li><a href="<?php echo site_url('dashboard');?>"><i class="material-icons">home</i> Home</a></li>
					<li><a href="<?php echo site_url('anggaran-kas/murni');?>"> Anggaran Kas</a></li>
					<li class="active"> Belanja</li>
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
										<li><a title="Print RKA" href="<?php echo site_url('anggaran-kas/murni/rka/'.$kode);?>"><i class="material-icons">print</i> Print RKA</a></li>
										<li><a title="Print Anggaran Kas" href="<?php echo site_url('anggaran-kas/murni/anggaran-kas/'.$kode);?>"><i class="material-icons">print</i> Print Anggaran</a></li>
										<li><a title="Print DPA" href="<?php echo site_url('anggaran-kas/murni/dpa/'.$kode);?>"><i class="material-icons">print</i> Print DPA</a></li>
										<li><a title="Kembali" href="<?php echo base_url('anggaran-kas/murni'); ?>"><i class="material-icons">reply</i> Kembali</a></li>
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
                                        <li role="presentation" class="active"><a href="#home_animation_1" data-toggle="tab">Belanja</a></li>
										<li><a href="javascript:void(0);">Rencana</a></li>
                                    </ul>
                                    <!-- Tab panes -->
                                    <div class="tab-content">
                                        <div role="tabpanel" class="tab-pane animated flipInX active" id="home_animation_1">
                                            <b><?php echo validation_errors(); ?><?php if ($this->session->flashdata('success')) { echo $this->session->flashdata('success');} ?></b>
                                            <p><table class="table table-bordered table-striped table-hover js-basic-example dataTable">
											<thead>
											<tr>
												<th style="text-align:center; width:110px">Kode Rekening</th>
												<th style="text-align:center;">Uraian</th>
												<th style="text-align:center; width:70px">Sumber</th>
											</tr>
											</thead>
											<tbody><?php if($anggaran_bl) : ?><?php foreach($anggaran_bl as $task) : ?>
												<tr>
													<td style="text-align:left;"><?php echo $task->id_akun; ?> . <?php echo $task->id_kelompok; ?> . <?php echo $task->id_jenis; ?> . <?php echo $task->id_obyek; ?> . <?php echo $task->id_rincian; ?></td>
													<td><a href="<?php echo base_url(); ?>anggaran-kas/murni/rencana/<?php echo $task->task_id; ?>"><?php echo $task->nama_rincian; ?></a></td>
													<td style="text-align:center;"><?php echo $task->id_tipe; ?></td>
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