<!-- Main Content -->
	<section class="content">
		<h2>RKA Murni<small> anggaran belanja langsung</small></h2>  
			<div class="body">
				<ol class="breadcrumb breadcrumb-col-cyan">
					<li><a href="<?php echo site_url('dashboard');?>"><i class="material-icons">home</i> Home</a></li>
					<li><a href="<?php echo site_url('rka/murni');?>"> RKA</a></li>
					<li class="active"> Belanja</li>
				</ol>
			</div>
            <!-- Multiple Items To Be Open -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="body">
							<div class="portlet-body form">
								<div class="form-body">
									<div class="row">
										<div class="col-md-12">
											<div style="display:block;"><iframe frameborder="0" width="100%" height="600" name="form_laporan" src="<?php echo site_url('rka/murni/hasil');?>"></iframe></div>
										</div>
									</div>
								</div>
								<div class="form-actions">
									<center>
										<!--<a href="<?php echo site_url('rka/murni/hasil/pdf');?>" class="btn btn-danger"><i class="material-icons">picture_as_pdf</i> Download PDF</a>
										<a href="#" onClick="history.go(-1); return false;" class="btn default"><i class="material-icons">reply</i> Kembali</a>-->
										<a href="<?php echo site_url('rka/murni/belanja/'.$rka);?>" class="btn default"> Kembali</a>
									</center>	
								</div>
							</div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Tabs With Custom Animations -->
        </div>
    </section>