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
						<h2>Unit Organisasi<small>Data Bidang</small></h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="<?php echo site_url('parameter');?>"><i class="material-icons">reply</i> Kembali</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
						<div class="body" style="<?php echo (isset($formCari)?'display:none;':'')?>">
							<div class="row clearfix">
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
									<!-- Nav tabs -->
									<ul class="nav nav-tabs tab-nav-right" role="tablist">
										<li class="active"><a href="<?php echo site_url('parameter/unit-organisasi');?>">Urusan</a></li>
										<li><a href="javascript:void(0);">Bidang</a></li>
										<li><a href="javascript:void(0);">Unit</a></li>
										<li><a href="javascript:void(0);">Sub Unit</a></li>
									</ul>
									<!-- Tab panes -->
									<div class="tab-content">
										<div class="body"><center><button type="button" class="btn bg-brown waves-effect" data-toggle="modal" data-target="#tahunAnggaran">Tahun Anggaran</button></center></div>
									
									
									
		<form method="post">            
            <!--provinsi-->
            <select id="provinsi" name="provinsi" class="form-control show-tick" data-live-search="true">
                <option value="">Please Select</option>
                <?php
                $query = mysql_query("SELECT * FROM akun WHERE akun_sort='1' ORDER BY akun_nama");
                while ($row = mysql_fetch_array($query)) {
                ?>
                    <option value="<?php echo $row['kode']; ?>">
                        <?php echo $row['akun_nama']; ?>
                    </option>
                <?php
                }
                ?>
            </select>
            
            <!--kota-->
            <select id="kota" name="kota" class="form-control show-tick" data-live-search="true">
                <option value="">Please Select</option>
                <?php
                $query = mysql_query("SELECT * FROM kelompok INNER JOIN akun ON kelompok.kode = akun.kode ORDER BY kelompok_nama");
                while ($row = mysql_fetch_array($query)) {
                ?>
                    <option id="kota" class="<?php echo $row['kode']; ?>" value="<?php echo $row['kode']; ?>">
                        <?php echo $row['kelompok_nama']; ?>
                    </option>
                <?php
                }
                ?>
            </select>

            <!--kecamatan-->
            <select id="kecamatan" name="kecamatan" class="form-control show-tick" data-live-search="true">
                <option value="">Please Select</option>
                <?php
                $query = mysql_query("SELECT * FROM jenis INNER JOIN kelompok ON jenis.kode = kelompok.kode ORDER BY jenis_nama");
                while ($row = mysql_fetch_array($query)) {
                ?>
                    <option id="kecamatan" class="<?php echo $row['kode']; ?>" value="<?php echo $row['kode']; ?>">
                        <?php echo $row['jenis_nama']; ?>
                    </option>
                <?php
                }
                ?>
            </select>
        </form>
									
									
									
									
									
									
									
									
									
									
									
									
									</div>
								</div>
							</div>
						</div>
						<?php if ($tahun_) { ?>
                        <div class="body">
                            <div class="row clearfix">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <!-- Nav tabs -->
                                     <ul class="nav nav-tabs tab-nav-right" role="tablist">
                                        <li class="active"><a href="<?php echo site_url('parameter/unit-organisasi');?>">Urusan</a></li>
                                        <li><a href="javascript:void(0);">Bidang</a></li>
                                        <li><a href="javascript:void(0);">Unit</a></li>
                                        <li><a href="javascript:void(0);">Sub Unit</a></li>
                                    </ul>
                                    <!-- Tab panes -->
                                    <div class="tab-content">
                                        <div role="tabpanel" class="tab-pane animated fadeInRight active" id="home_animation_2">
                                        <b><?php echo validation_errors(); ?><?php if ($this->session->flashdata('success')) { echo $this->session->flashdata('success');} ?></b>
										<script>
											var ajax_source_url = '<?php echo site_url($this->uri->segment(1) . '/' . $this->uri->segment(2) . '/datatable/' . $this->uri->segment(4) . '/' . $this->uri->segment(5) . '/' . $this->uri->segment(6) . '/' . $this->uri->segment(7) . '/' . $this->uri->segment(8) . '/' . $this->uri->segment(9)); ?>';
											var ajax_source_field = [
											{ "data": "no" },
											{ "data": "nm_urusan" },
											{ "data": "Actions" }
											];
										</script>
										<div class="portlet-body">
											<table class="table table-striped table-bordered table-hover" id="tableUtama">
											<thead>
											<tr>
												<th style="text-align:center; width:60px">Urusan</th>
												<th style="text-align:center;">Uraian Nama Urusan</th>
												<th style="width:80px; text-align:center;">Actions</th>
											</tr>
											</thead>
											<tbody></tbody>
											</table>
										</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
						<?php } ?>
                    </div>
                </div>
            </div>
		<!-- #END# Tabs With Custom Animations -->
    </section>
<!-- END Main Content -->	
	<a href="#tahunAnggaran" data-toggle="modal"></a>
	<div id="tahunAnggaran" class="modal fade" role="dialog" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
					<h4 class="modal-title">Pilih Tahun Anggaran</h4>
				</div>
				<form action="<?php echo site_url('parameter/unit-organisasi/cari');?>" class="form-horizontal" method="post">
				<div class="modal-body">
				<div class="col-md-3"></div>
					<div class="col-md-6">
						<?php combobox('db', $tahun, 'tahun', 'tahun', 'tahun', $tahun_, '', 'Tahun Anggaran', 'class="form-control show-tick" data-live-search="true" tabindex="1" required="required"'); ?>
					</div>
				<div class="col-md-3"></div>				
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary waves-effect">OK</button>
				</div>
				</form>
			</div>
		</div>
	</div>