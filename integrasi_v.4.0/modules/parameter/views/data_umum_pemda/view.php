<!-- Main Content -->
   <section class="content">
		<h2>Parameter<small> data umum pemda</small></h2>  
			<div class="body">
				<ol class="breadcrumb breadcrumb-col-cyan">
					<li><a href="<?php echo site_url('dashboard');?>"><i class="material-icons">home</i> Home</a></li>
					<li><a href="<?php echo site_url('parameter');?>"> Parameter</a></li>
					<li class="active"> Data Umum Pemda</li>
				</ol>
			</div>
            <!-- Multiple Items To Be Open -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header bg-light-green">
                            <h2>
                                Parameter <small>Data Umum Pemda</small>
                            </h2>
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
						<?php if ($this->session->flashdata('success')) { echo $this->session->flashdata('success');} ?>
						<script>
							var ajax_source_url = '<?php echo site_url($this->uri->segment(1) . '/' . $this->uri->segment(2) . '/datatable'); ?>';
							var ajax_source_field =	  [ { "data": "nomor" },
														{ "data": "pemda" },
														{ "data": "ibukota" },
														{ "data": "alamat" },
														{ "data": "Actions" } ];
						</script>
						<div class="body">
							<table class="table table-striped table-bordered table-hover" id="tableUtama">
							<thead>
							<tr>
								<th style="width:25px">No</th>
                                <th style="text-align:center; width:180px">Nama Pemda</th>
								<th style="text-align:center; width:110px">IbuKota Pemda</th>
								<th style="text-align:center;">Alamat Pemda</th>
								<th style="width:50px"><center>Actions</th>
							</tr>
							</thead>
							<tbody></tbody>
							</table>							
                        </div>						
                    </div>
                </div>
            </div>
            <!-- #END# Tabs With Custom Animations -->
        </div>
    </section>