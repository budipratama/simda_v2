<!-- Main Content -->
<?php $query_data = mysql_query("SELECT skpd.skpd_nama as id_skpd, program.program as id_program, anggaran.kegiatan as id_kegiatan FROM rka INNER JOIN skpd ON rka.skpd=skpd.skpd_kode	INNER JOIN program ON rka.program=program.kode INNER JOIN anggaran ON rka.anggaran_kode=anggaran.kode WHERE rka.tipe_kode= '1' AND rka.anggaran_kode='".$rincian->anggaran_kode."' ORDER BY rka.kode ASC"); $data = mysql_fetch_array($query_data); $skpd = $data[id_skpd]; $program = $data[id_program]; $kegiatan = $data[id_kegiatan]; $query_jumlah = mysql_query("SELECT SUM(total) FROM rka_sub WHERE rka_sub.tipe_kode= '1' AND rka_sub.anggaran_kode='".$rincian->anggaran_kode."' ORDER BY rka_sub.kode ASC"); $data = mysql_fetch_array($query_jumlah); $jumlah = $data[0]; ?>
   <section class="content">
		<h2>RKA Perubahan<small> anggaran belanja langsung</small></h2>  
			<div class="body">
				<ol class="breadcrumb breadcrumb-col-cyan">
					<li><a href="<?php echo site_url('dashboard');?>"><i class="material-icons">home</i> Home</a></li>
					<li><a href="<?php echo site_url('rka/perubahan');?>"> RKA</a></li>
					<li class="active"> Sub Rincian Belanja</li>
				</ol>
			</div>
            <!-- Multiple Items To Be Open -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">					
							<p align="center"><b><?php echo strtoupper($skpd);?></b></p>
							<p class="control-label col-md-10">Program &nbsp;:&nbsp; <?php echo $program;?></p><p align="right"><b>.</b></p>
							<p class="control-label col-md-10">Kegiatan &nbsp;:&nbsp; <?php echo $kegiatan;?></p><p align="right"><b>Jumlah</b></p>
                            <p class="control-label col-md-10">Rincian &nbsp;&nbsp;&nbsp;:&nbsp;<?php echo $rincian->no; ?> . <?php echo $rincian->uraian; ?></p><p align="right"><b><?php echo rupiah($jumlah);?></b></p>
							<ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <button type="button" class="btn bg-black waves-effect waves-light">ACTIONS</button>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a title="Tambah" href="<?php echo site_url('rka/perubahan/adds/'.$rincian->kode);?>"><i class="material-icons">add_circle_outline</i> Sub Rincian</a></li>
                                        <li><a title="Tambah" href="<?php echo site_url('rka/perubahan/view/'.$kode);?>"><i class="material-icons">print</i> Print</a></li>
                                        <li><a title="Kembali" href="<?php echo base_url(); ?>rka/perubahan/rincian/<?php echo $rincian->task_id; ?>"><i class="material-icons">reply</i> Kembali</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">						
                            <div class="row clearfix">
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <!-- Nav tabs -->
                                    <ul class="nav nav-tabs tab-nav-right" role="tablist">
                                        <li><p class="col-cyan"><a href="<?php echo base_url(); ?>rka/perubahan/belanja/<?php echo $rincian->anggaran_kode;?>"><i class="material-icons">keyboard_arrow_left</i>Belanja</a></p></li>									
                                        <li><p class="col-cyan"><a href="<?php echo base_url(); ?>rka/perubahan/rincian/<?php echo $rincian->task_id; ?>"><i class="material-icons">keyboard_arrow_left</i>Rincian Belanja</a></p></li>
                                        <li role="presentation" class="active"><a href="#home_animation_2" data-toggle="tab">Sub Rincian Belanja</a></li>
                                    </ul>
                                    <!-- Tab panes -->
                                    <div class="tab-content">
                                        <div role="tabpanel" class="tab-pane animated fadeInRight active" id="home_animation_2">
                                            <b><?php echo validation_errors(); ?><?php if ($this->session->flashdata('success')) { echo $this->session->flashdata('success');} ?></b>
                                            <p><table class="table table-bordered table-striped table-hover js-basic-example dataTable">
											<thead><tr>
												<th style="text-align:center; width:60px">No</th>
												<th style="text-align:center;">Uraian</th>
												<th style="text-align:center; width:60px">Actions</th>
											</tr></thead>
											<tbody><?php if($sub) : ?><?php foreach($sub as $task) : ?>
											<tr>
												<td style="text-align:center;"><?php echo $task->no; ?></td>
												<td><?php echo $task->uraian; ?></td>
												<td style="text-align:center;">										
													<a class="btn btn-sm btn-warning" title="Ubah" href="<?php echo base_url(); ?>rka/perubahan/edits/<?php echo $task->kode; ?>" value="<?php echo $task->kode; ?>"><i class="fa fa-pencil"></i></a>
													<a class="btn btn-sm btn-danger" title="Hapus" onclick="return confirm('Are you sure?')" value="<?php echo $task->kode; ?>" href="<?php echo base_url(); ?>rka/perubahan/deletes/<?php echo $task->kode; ?>/<?php echo $this->uri->segment(1); ?>" ><i class="fa fa-trash-o"></i></a>
												</td>
											</tr>
											<?php endforeach; ?><?php endif; ?>
											</table></p>
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