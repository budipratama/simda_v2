<!-- Main Content -->
<div class="container-fluid">
	<div class="side-body padding-top">
		<h3 class="page-title">Parameter <small></small></h3>
		<div class="row">
            <div class="col-xs-12">
				<div class="bs-example">
					<ol class="breadcrumb">
						<li class="active"><i class="fa fa-home"></i> <a href="<?php echo site_url('dashboard');?>">Home</a></li>
						<li class="active"><a href="<?php echo site_url('parameter');?>"> Parameter</a></li>
						<li class="active"><a href="<?php echo site_url('parameter/rekening');?>"> Rekening</a></li>
						<li class="active"><a href="<?php echo site_url('parameter/rekening/add');?>"> Tambah Data</a></li>
					</ol>
				</div>
            </div>
        </div>
<!-- END PAGE HEADER-->
			<!-- BEGIN FORM -->
            <div class="panel panel-success">
				<div class="panel-heading"><i class="fa fa-gears"></i> Parameter Sistem Informasi Integrasi</div>
				<div class="panel-body">
				<div class="portlet-body" style="display: block;">
                        	<h4>Rekening</h4>						
                        	<a href="<?php echo site_url('parameter/rekening/jenis');?>" class="icon-btn">
                                <i class="fa fa-paper-plane"></i><div>Jenis</div>
							</a>								
                            <a href="<?php echo site_url('parameter/rekening/obyek');?>" class="icon-btn">
                                <i class="fa fa-life-ring"></i><div>Obyek</div>
							</a>                            
                            <a href="<?php echo site_url('parameter/rekening/rincian');?>" class="icon-btn">
                                <i class="fa fa-puzzle-piece"></i><div>Rincian</div>
							</a>                            
                            <a href="<?php echo site_url('parameter/rekening/detail');?>" class="icon-btn">
                                <i class="fa fa-search"></i><div>Rekening</div>
							</a>  
						<div class="form-group">
						<div class="col-md-offset-8 col-md-8">
							<a href="<?php echo site_url('parameter/rekening');?>" class="btn default"><i class="fa fa-reply"></i> Kembali</a>
						</div>
						</div>
					</div>							
				</div>				
				<!-- END FORM-->
				</div>
			</div>
			<!-- END SAMPLE TABLE PORTLET-->
	</div>
</div>