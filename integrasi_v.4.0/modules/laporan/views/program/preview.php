<!-- BEGIN CONTENT -->
	<div class="page-content-wrapper">
		<div class="page-content">
			<!-- BEGIN PAGE HEADER-->
			<h3 class="page-title">
			Rekap Program SKPD <small>cetak laporan</small>
			</h3>
			<div class="page-bar">
				<ul class="page-breadcrumb">
					<li>
						<i class="fa fa-home"></i>
						<a href="<?php echo site_url('dashboard');?>">Home</a>
						<i class="fa fa-angle-right"></i>
					</li>
                    <li>
						<a href="<?php echo site_url('laporan');?>">Laporan</a>
						<i class="fa fa-angle-right"></i>
					</li>
					 <li>
						<a href="<?php echo site_url('laporan/program');?>">Program SKPD</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="#">Cetak</a>
					</li>
				</ul>
			</div>
            <!-- END PAGE HEADER-->
			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN SAMPLE TABLE PORTLET-->
					<div class="portlet box green">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-pencil"></i>Cetak Laporan Rekap Program SKPD
							</div>
						</div>
						<div class="portlet-body form">
							<!-- BEGIN FORM-->
							<div class="form-body">
								<div class="row">
									<div class="col-md-12">
										<div style="display:block;">
											<iframe frameborder="0" width="100%" height="500" name="form_laporan" src="<?php echo site_url('laporan/program/hasil');?>"></iframe>
										</div>
									</div>
								</div>
							</div>
							
							<div class="form-actions">
								<div class="row">
									<div class="col-md-12">
										<div class="row">
											<div class="col-md-offset-3 col-md-9">
												<button type="submit" class="btn blue" onclick="javascript:parent.form_laporan.print()"><i class="fa fa-print"></i> Print</button>
												<a href="<?php echo site_url('laporan/program/hasil/excel');?>" class="btn green"><i class="fa fa-file-excel-o"></i> Download Excel</a>
												<a href="#" class="btn red"><i class="fa fa-file-pdf-o"></i> Download PDF</a>
												<a href="#" onClick="history.go(-1); return false;" class="btn default"><i class="fa fa-reply"></i> Kembali</a>
											</div>
										</div>
									</div>
									<div class="col-md-6">
									</div>
								</div>
							</div>
							<!-- END FORM-->
						</div>
					</div>
					<!-- END SAMPLE TABLE PORTLET-->
				</div>
			</div>
		</div>
		
	</div>