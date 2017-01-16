    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
				<h1 class="page-title">Hasil Pra Rencana Kerja <small>entri data &amp; informasi detail</small></h1>
            </div>
			<div class="body">
				<ol class="breadcrumb breadcrumb-bg-cyan">
					<li><a href="javascript:void(0);"><i class="material-icons">home</i> Home</a></li>
					<li><a href="javascript:void(0);"><i class="material-icons">library_books</i> Library</a></li>
					<li><a href="javascript:void(0);"><i class="material-icons">archive</i> Data</a></li>
					<li><a href="javascript:void(0);"><i class="material-icons">attachment</i> File</a></li>
					<li class="active"><i class="material-icons">extension</i> Extensions</li>
				</ol>
			</div>			
            <!-- Multiple Items To Be Open -->
			<?php if ($this->session->flashdata('success')) { echo $this->session->flashdata('success');} ?>
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>Pencarian Hasil Pra Rencana Kerja</h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
										<button type="button" class="btn bg-black waves-effect waves-light">Actions</button>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="javascript:void(0);">Action</a></li>
                                        <li><a href="javascript:void(0);">Another action</a></li>
                                        <li><a href="javascript:void(0);">Something else here</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
						
						<div class="body">
                            <div class="row clearfix jsdemo-notification-button">
                                <div class="col-xs-12 col-sm-6 col-md-3 col-lg-2">
                                    <button type="button" class="btn bg-pink btn-block waves-effect" data-placement-from="top" data-placement-align="left" data-animate-enter="animated fadeIn"
                                            data-animate-exit="animated fadeOut" data-color-name="bg-black">
                                        FADE IN/OUT
                                    </button>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-3 col-lg-2">
                                    <button type="button" class="btn bg-pink btn-block waves-effect" data-placement-from="top" data-placement-align="left" data-animate-enter="animated fadeInLeft"
                                            data-animate-exit="animated fadeOutLeft" data-color-name="bg-black">
                                        FADE IN/OUT LEFT
                                    </button>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-3 col-lg-2">
                                    <button type="button" class="btn bg-pink btn-block waves-effect" data-placement-from="top" data-placement-align="right" data-animate-enter="animated fadeInRight"
                                            data-animate-exit="animated fadeOutRight" data-color-name="bg-black">
                                        FADE IN/OUT RIGHT
                                    </button>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-3 col-lg-2">
                                    <button type="button" class="btn bg-pink btn-block waves-effect" data-placement-from="top" data-placement-align="left" data-animate-enter="animated fadeInUp"
                                            data-animate-exit="animated fadeOutUp" data-color-name="bg-black">
                                        FADE IN/OUT UP
                                    </button>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-3 col-lg-2">
                                    <button type="button" class="btn bg-pink btn-block waves-effect" data-placement-from="top" data-placement-align="left" data-animate-enter="animated fadeInDown"
                                            data-animate-exit="animated fadeOutDown" data-color-name="bg-black">
                                        FADE IN/OUT DOWN
                                    </button>
                                </div>
                            </div>

                            <div class="row clearfix jsdemo-notification-button">
                                <div class="col-xs-12 col-sm-6 col-md-3 col-lg-2">
                                    <button type="button" class="btn bg-cyan btn-block waves-effect" data-placement-from="top" data-placement-align="left" data-animate-enter="animated bounceIn"
                                            data-animate-exit="animated bounceOut" data-color-name="bg-black">
                                        BOUNCE IN/OUT
                                    </button>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-3 col-lg-2">
                                    <button type="button" class="btn bg-cyan btn-block waves-effect" data-placement-from="top" data-placement-align="left" data-animate-enter="animated bounceInLeft"
                                            data-animate-exit="animated bounceOutLeft" data-color-name="bg-black">
                                        BOUNCE IN/OUT LEFT
                                    </button>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-3 col-lg-2">
                                    <button type="button" class="btn bg-cyan btn-block waves-effect" data-placement-from="top" data-placement-align="right" data-animate-enter="animated bounceInRight"
                                            data-animate-exit="animated bounceOutRight" data-color-name="bg-black">
                                        BOUNCE IN/OUT RIGHT
                                    </button>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-3 col-lg-2">
                                    <button type="button" class="btn bg-cyan btn-block waves-effect" data-placement-from="top" data-placement-align="left" data-animate-enter="animated bounceInUp"
                                            data-animate-exit="animated bounceOutUp" data-color-name="bg-black">
                                        BOUNCE IN/OUT UP
                                    </button>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-3 col-lg-2">
                                    <button type="button" class="btn bg-cyan btn-block waves-effect" data-placement-from="top" data-placement-align="left" data-animate-enter="animated bounceInDown"
                                            data-animate-exit="animated bounceOutDown" data-color-name="bg-black">
                                        BOUNCE IN/OUT DOWN
                                    </button>
                                </div>
                            </div>

                            <div class="row clearfix jsdemo-notification-button">
                                <div class="col-xs-12 col-sm-6 col-md-3 col-lg-2">
                                    <button type="button" class="btn bg-teal btn-block waves-effect" data-placement-from="top" data-placement-align="left" data-animate-enter="animated rotateIn"
                                            data-animate-exit="animated rotateOut" data-color-name="bg-black">
                                        ROTATE IN/OUT
                                    </button>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-3 col-lg-2">
                                    <button type="button" class="btn bg-teal btn-block waves-effect" data-placement-from="top" data-placement-align="left" data-animate-enter="animated rotateInUpLeft"
                                            data-animate-exit="animated rotateOutUpLeft" data-color-name="bg-black">
                                        ROTATE IN/OUT UP LEFT
                                    </button>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-3 col-lg-2">
                                    <button type="button" class="btn bg-teal btn-block waves-effect" data-placement-from="top" data-placement-align="right" data-animate-enter="animated rotateInUpRight"
                                            data-animate-exit="animated rotateOutUpRight" data-color-name="bg-black">
                                        ROTATE IN/OUT UP RIGHT
                                    </button>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-3 col-lg-2">
                                    <button type="button" class="btn bg-teal btn-block waves-effect" data-placement-from="top" data-placement-align="left" data-animate-enter="animated rotateInDownLeft"
                                            data-animate-exit="animated rotateOutDownLeft" data-color-name="bg-black">
                                        ROTATE IN/OUT DOWN LEFT
                                    </button>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-3 col-lg-2">
                                    <button type="button" class="btn bg-teal btn-block waves-effect" data-placement-from="top" data-placement-align="right" data-animate-enter="animated rotateInDownRight"
                                            data-animate-exit="animated rotateOutDownRight" data-color-name="bg-black">
                                        ROTATE IN/OUT DOWN RIGHT
                                    </button>
                                </div>
                            </div>

                            <div class="row clearfix jsdemo-notification-button">
                                <div class="col-xs-12 col-sm-6 col-md-3 col-lg-2">
                                    <button type="button" class="btn bg-orange btn-block waves-effect" data-placement-from="top" data-placement-align="left"
                                            data-animate-enter="animated zoomIn" data-animate-exit="animated zoomOut" data-color-name="bg-black">
                                        ZOOM IN/OUT
                                    </button>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-3 col-lg-2">
                                    <button type="button" class="btn bg-orange btn-block waves-effect" data-placement-from="top" data-placement-align="left"
                                            data-animate-enter="animated zoomInLeft" data-animate-exit="animated zoomOutLeft" data-color-name="bg-black">
                                        ZOOM IN/OUT LEFT
                                    </button>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-3 col-lg-2">
                                    <button type="button" class="btn bg-orange btn-block waves-effect" data-placement-from="top" data-placement-align="right"
                                            data-animate-enter="animated zoomInRight" data-animate-exit="animated zoomOutRight" data-color-name="bg-black">
                                        ZOOM IN/OUT RIGHT
                                    </button>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-3 col-lg-2">
                                    <button type="button" class="btn bg-orange btn-block waves-effect" data-placement-from="top" data-placement-align="left"
                                            data-animate-enter="animated zoomInUp" data-animate-exit="animated zoomOutUp" data-color-name="bg-black">
                                        ZOOM IN/OUT UP
                                    </button>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-3 col-lg-2">
                                    <button type="button" class="btn bg-orange btn-block waves-effect" data-placement-from="top" data-placement-align="left"
                                            data-animate-enter="animated zoomInDown" data-animate-exit="animated zoomOutDown" data-color-name="bg-black">
                                        ZOOM IN/OUT DOWN
                                    </button>
                                </div>
                            </div>

                            <div class="row clearfix jsdemo-notification-button">
                                <div class="col-xs-12 col-sm-6 col-md-3 col-lg-2">
                                    <button type="button" class="btn bg-purple btn-block waves-effect" data-placement-from="top" data-placement-align="left"
                                            data-animate-enter="animated flipInX" data-animate-exit="animated flipOutX" data-color-name="bg-black">
                                        FLIP IN/OUT X
                                    </button>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-3 col-lg-2">
                                    <button type="button" class="btn bg-purple btn-block waves-effect" data-placement-from="top" data-placement-align="left"
                                            data-animate-enter="animated flipInY" data-animate-exit="animated flipOutY" data-color-name="bg-black">
                                        FLIP IN/OUT Y
                                    </button>
                                </div>
                            </div>

                            <div class="row clearfix jsdemo-notification-button">
                                <div class="col-xs-12 col-sm-6 col-md-3 col-lg-2">
                                    <button type="button" class="btn bg-indigo btn-block waves-effect" data-placement-from="top" data-placement-align="right"
                                            data-animate-enter="animated lightSpeedIn" data-animate-exit="animated lightSpeedOut"
                                            data-color-name="bg-black">
                                        LIGHT SPEED IN/OUT
                                    </button>
                                </div>
                            </div>
                        </div>

						<div class="body">
                            <div class="row clearfix js-sweetalert">
                                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                    <p>A basic message</p>
                                    <button class="btn btn-primary waves-effect" data-type="basic">CLICK ME</button>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                    <p>A title with a text under</p>
                                    <button class="btn btn-primary waves-effect" data-type="with-title">CLICK ME</button>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                    <p>A success message!</p>
                                    <button class="btn btn-primary waves-effect" data-type="success">CLICK ME</button>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                    <p>A warning message, with a function attached to the <b>Confirm</b> button...</p>
                                    <button class="btn btn-primary waves-effect" data-type="confirm">CLICK ME</button>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                    <p>... and by passing a parameter, you can execute something else for <b>Cancel</b>.</p>
                                    <button class="btn btn-primary waves-effect" data-type="cancel">CLICK ME</button>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                    <p>A message with a custom icon</p>
                                    <button class="btn btn-primary waves-effect" data-type="with-custom-icon">CLICK ME</button>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                    <p>An HTML message</p>
                                    <button class="btn btn-primary waves-effect" data-type="html-message">CLICK ME</button>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                    <p>A message with auto close timer</p>
                                    <button class="btn btn-primary waves-effect" data-type="autoclose-timer">CLICK ME</button>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                    <p>A replacement for the <b>prompt</b> function</p>
                                    <button class="btn btn-primary waves-effect" data-type="prompt">CLICK ME</button>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                    <p>With a loader (for AJAX request for example)</p>
                                    <button class="btn btn-primary waves-effect" data-type="ajax-loader">CLICK ME</button>
                                </div>
                            </div>
                        </div>
					
					
	
	
						<div class="body">
                            <div class="row clearfix">
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                    <!-- Nav tabs -->
                                    <ul class="nav nav-tabs tab-nav-right" role="tablist">
                                        <li role="presentation" class="active"><a href="#home_animation_1" data-toggle="tab">HOME</a></li>
                                        <li role="presentation"><a href="#profile_animation_1" data-toggle="tab">PROFILE</a></li>
                                        <li role="presentation"><a href="#messages_animation_1" data-toggle="tab">MESSAGES</a></li>
                                        <li role="presentation"><a href="#settings_animation_1" data-toggle="tab">SETTINGS</a></li>
                                    </ul>

                                    <!-- Tab panes -->
                                    <div class="tab-content">
                                        <div role="tabpanel" class="tab-pane animated flipInX active" id="home_animation_1">
                                            <b>Home Content</b>
                                            <p>
							<table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>FIRST NAME</th>
                                        <th>LAST NAME</th>
                                        <th>USERNAME</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>Mark</td>
                                        <td>Otto</td>
                                        <td>@mdo</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">2</th>
                                        <td>Jacob</td>
                                        <td>Thornton</td>
                                        <td>@fat</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">3</th>
                                        <td>Larry</td>
                                        <td>the Bird</td>
                                        <td>@twitter</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">4</th>
                                        <td>Larry</td>
                                        <td>Jellybean</td>
                                        <td>@lajelly</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">5</th>
                                        <td>Larry</td>
                                        <td>Kikat</td>
                                        <td>@lakitkat</td>
                                    </tr>
                                </tbody>
                            </table>
                                            </p>
                                        </div>
                                        <div role="tabpanel" class="tab-pane animated flipInX" id="profile_animation_1">
                                            <b>Profile Content</b>
                                            <p>
                                                Lorem ipsum dolor sit amet, ut duo atqui exerci dicunt, ius impedit mediocritatem an. Pri ut tation electram moderatius.
                                                Per te suavitate democritum. Duis nemore probatus ne quo, ad liber essent
                                                aliquid pro. Et eos nusquam accumsan, vide mentitum fabellas ne est, eu munere
                                                gubergren sadipscing mel.
                                            </p>
                                        </div>
                                        <div role="tabpanel" class="tab-pane animated flipInX" id="messages_animation_1">
                                            <b>Message Content</b>
                                            <p>
                                                Lorem ipsum dolor sit amet, ut duo atqui exerci dicunt, ius impedit mediocritatem an. Pri ut tation electram moderatius.
                                                Per te suavitate democritum. Duis nemore probatus ne quo, ad liber essent
                                                aliquid pro. Et eos nusquam accumsan, vide mentitum fabellas ne est, eu munere
                                                gubergren sadipscing mel.
                                            </p>
                                        </div>
                                        <div role="tabpanel" class="tab-pane animated flipInX" id="settings_animation_1">
                                            <b>Settings Content</b>
                                            <p>
                                                Lorem ipsum dolor sit amet, ut duo atqui exerci dicunt, ius impedit mediocritatem an. Pri ut tation electram moderatius.
                                                Per te suavitate democritum. Duis nemore probatus ne quo, ad liber essent
                                                aliquid pro. Et eos nusquam accumsan, vide mentitum fabellas ne est, eu munere
                                                gubergren sadipscing mel.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                    <!-- Nav tabs -->
                                    <ul class="nav nav-tabs tab-nav-right" role="tablist">
                                        <li role="presentation" class="active"><a href="#home_animation_2" data-toggle="tab">HOME</a></li>
                                        <li role="presentation"><a href="#profile_animation_2" data-toggle="tab">PROFILE</a></li>
                                        <li role="presentation"><a href="#messages_animation_2" data-toggle="tab">MESSAGES</a></li>
                                        <li role="presentation"><a href="#settings_animation_2" data-toggle="tab">SETTINGS</a></li>
                                    </ul>

                                    <!-- Tab panes -->
                                    <div class="tab-content">
                                        <div role="tabpanel" class="tab-pane animated fadeInRight active" id="home_animation_2">
                                            <b>Home Content</b>
                                            <p>
                                                Lorem ipsum dolor sit amet, ut duo atqui exerci dicunt, ius impedit mediocritatem an. Pri ut tation electram moderatius.
                                                Per te suavitate democritum. Duis nemore probatus ne quo, ad liber essent
                                                aliquid pro. Et eos nusquam accumsan, vide mentitum fabellas ne est, eu munere
                                                gubergren sadipscing mel.
                                            </p>
                                        </div>
                                        <div role="tabpanel" class="tab-pane animated fadeInRight" id="profile_animation_2">
                                            <b>Profile Content</b>
                                            <p>
                                                Lorem ipsum dolor sit amet, ut duo atqui exerci dicunt, ius impedit mediocritatem an. Pri ut tation electram moderatius.
                                                Per te suavitate democritum. Duis nemore probatus ne quo, ad liber essent
                                                aliquid pro. Et eos nusquam accumsan, vide mentitum fabellas ne est, eu munere
                                                gubergren sadipscing mel.
                                            </p>
                                        </div>
                                        <div role="tabpanel" class="tab-pane animated fadeInRight" id="messages_animation_2">
                                            <b>Message Content</b>
                                            <p>
                                                Lorem ipsum dolor sit amet, ut duo atqui exerci dicunt, ius impedit mediocritatem an. Pri ut tation electram moderatius.
                                                Per te suavitate democritum. Duis nemore probatus ne quo, ad liber essent
                                                aliquid pro. Et eos nusquam accumsan, vide mentitum fabellas ne est, eu munere
                                                gubergren sadipscing mel.
                                            </p>
                                        </div>
                                        <div role="tabpanel" class="tab-pane animated fadeInRight" id="settings_animation_2">
                                            <b>Settings Content</b>
                                            <p>
                                                Lorem ipsum dolor sit amet, ut duo atqui exerci dicunt, ius impedit mediocritatem an. Pri ut tation electram moderatius.
                                                Per te suavitate democritum. Duis nemore probatus ne quo, ad liber essent
                                                aliquid pro. Et eos nusquam accumsan, vide mentitum fabellas ne est, eu munere
                                                gubergren sadipscing mel.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
	
						<div class="body">
                            <a class="btn bg-pink waves-effect m-b-15" role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false"
                               aria-controls="collapseExample">
                                LINK WITH HREF
                            </a>
                            <button class="btn bg-cyan waves-effect m-b-15" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false"
                                    aria-controls="collapseExample">
                                BUTTON WITH data-target
                            </button>
                            <div class="collapse" id="collapseExample">
                                <div class="well">
                                    Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Nihil anim keffiyeh helvetica,
                                    craft beer labore wes anderson cred nesciunt sapiente ea proident.
                                </div>
                            </div>
                        </div>
						
                        <div class="body">
                            <div class="row clearfix">
                                <div class="col-xs-12 ol-sm-12 col-md-12 col-lg-12">
                                    <div class="panel-group full-body" id="accordion_19" role="tablist" aria-multiselectable="true">
                                        <div class="panel panel-col-pink">
                                            <div class="panel-heading" role="tab" id="headingOne_19" data-toggle="tooltip" data-placement="top" title="Form Pencairan">
                                                <h4 class="panel-title">
                                                    <a href="<?php echo site_url('pra-rencana-kerja');?>">
                                                        <i class="material-icons">perm_contact_calendar</i> Pencarian Pra Rencana Kerja</a>
                                                </h4>
                                            </div>											
                                           <div id="collapseOne_19" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne_19">
												<div class="body" style="<?php echo (isset($formCari)?'display:none;':'')?>">
												<form action="<?php echo site_url('pra-rencana-kerja/cari');?>" class="form-horizontal" method="post">
													<div class="row clearfix">
														<div class="col-md-3">
															<p><b>Tahun <span class="required">*</span></b></p>
															<?php combobox('db', $tahun, 'tahun', 'tahun', 'tahun', $tahun_, '', 'Pilih Tahun Anggaran', 'class="form-control show-tick" data-live-search="true" tabindex="1" required="required"'); ?>
														</div>
								
														<div class="col-md-3">
															<p><b>SKPD Pelaksana</b></p>
															<?php if ($skpd_aktive == 'yes') { combobox('db', $skpd, 'skpd_kode', 'skpd_kode', 'skpd_nama', $skpd_, '', 'Semua SKPD Pelaksana', 'class="form-control show-tick" data-live-search="true" tabindex="1"'); 
															} else { 
															echo '<select class="form-control show-tick" name="skpd_kode" id="skpd_kode" data-placeholder="Pilih SKPD Pelaksana" class="form-control show-tick" data-live-search="true" tabindex="1" required="required">
															<option value="'.$skpd_kode.'" selected>'.$skpd_nama.'</option>
															</select>';
															} ?>
														</div>
								
														<div class="col-md-3">
															<p><b>Kecamatan</b></p>
															<?php if ($kecamatan_aktive == 'yes') { combobox('db', $kecamatan, 'kecamatan_kode', 'skpd_kd', 'skpd_nama', $kecamatan_, 'show_form_deskel_by_kecamatan();', 'Semua Kecamatan', 'class="form-control show-tick" data-live-search="true" tabindex="1"'); 
															} else {
															echo '<select class="select2_category form-control" name="kecamatan_kode" id="kecamatan_kode" data-placeholder="Pilih Kecamatan" class="form-control show-tick" data-live-search="true" tabindex="1" required="required">
															<option value="'.$kecamatan_kode.'" selected>'.$kecamatan_nama.'</option>
															</select>';
															} ?>
														</div>
								
														<div class="col-md-3">
															<p><b>Desa/Kelurahan</b></p>
															<div class="form-group" id="tampil_combobox_deskel_by_kecamatan">
															<?php if ($deskel_ == 'deskel' || $deskel_ == ''){ ?>
															<select class="form-control show-tick" data-live-search="true" name="deskel_kode" id="deskel_kode">
															<option value="">Semua Desa/Kelurahan</option>
															</select>
															<?php } else {
															combobox('db', $deskel, 'deskel_kode', 'skpd_kd', 'skpd_nama', $deskel_, '', 'Semua Desa/Kelurahan', 'class="form-control show-tick" data-live-search="true" tabindex="1"');
															} ?>									
															</div>
														</div>								
													

														<div class="body">
														<div class="col-md-8">															
															<div class="form-group form-group-sm">
															<div class="form-line">
															<p><b>Nama Kegiatan</b></p>
																<input type="text" class="form-control" name="kegiatan" id="kegiatan" value="<?php echo $kegiatan_;?>" placeholder="Kegiatan...">
															</div>
															</div>
														</div>
														
														<div class="col-md-3">
															<p><b>Jenis Belanja</b></p>
															<div class="demo-radio-button">
																<input type="radio" name="tipe_kode" class="with-gap" id="radio_3" value="1" <?php echo ($tipe_ == 1)?'checked':'';?>>
																<label for="radio_3">Belanja Langsung</label>
																<!--<input type="radio" name="tipe_kode" class="with-gap" id="radio_4" value="2" <?php echo ($tipe_ == 2)?'checked':'';?>>
																<label for="radio_4">Belanja Tidak Langsung</label>-->
															</div>
														</div>
														</div>
													
													</div>
	
														<div class="body">
															<div class="col-md-3">
																<div class="btn-group">
																	<button type="button" class="btn bg-teal dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Tambah Belanja <span class="caret"></span></button>
																		<ul class="dropdown-menu">
																		<li><a href="<?php echo site_url('pra-rencana-kerja/belanja-langsung');?>">Belanja Langsung</a></li>
																		<!--<li><a href="<?php echo site_url('pra-rencana-kerja/belanja-tidak-langsung');?>">Belanja Tidak Langsung</a></li>-->
																		</ul>
																</div>									
															</div>
								                        
															<div class="button-demo">
																<button type="submit" class="btn btn-primary waves-effect">CARI</button>
																	<a href="<?php echo site_url('pra-rencana-kerja');?>" class="btn btn-default waves-effect">Clear</a>
															</div>
														</div>
												</div>
											</form>
                                            </div>
                                        </div>
					<?php if ($tahun_) { ?>
                    <div class="body">
						<script>
							var ajax_source_url = '<?php echo site_url($this->uri->segment(1) . '/datatable/' . $this->uri->segment(3) . '/' . $this->uri->segment(4) . '/' . $this->uri->segment(5) . '/' . $this->uri->segment(6) . '/' . $this->uri->segment(7) . '/' . $this->uri->segment(8)); ?>';
							var ajax_source_field = [
										{ "data": "nomor" },
										{ "data": "kegiatan" },
										{ "data": "alamat" },
										{ "data": "skpd_nama" },
										{ "data": "status_nama" },
										{ "data": "Actions" }
									];
						</script>
						<div class="portlet-body">
							<table class="table table-hover table-bordered" id="tableUtama">
							<thead>
							<tr>
								<th style="width:20px">No</th>
								<th class="hidden-xs">Nama Kegiatan</th>
								<th style="width:200px">Lokasi</th>
								<th style="width:200px">SKPD/Kecamatan</th>
								<th style="width:120px; text-align:center;">Transfer</th>
								<th style="width:90px; text-align:center;">Actions</th>
							</tr>
							</thead>
							<tbody></tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			<?php } else { ?>
			<div class="row" style="height:200px;">
			</div>
			<?php } ?>
			
	
						<div class="body">
                            <nav>
                                <ul class="pagination">
                                    <li class="disabled">
                                        <a href="javascript:void(0);">
                                            <i class="material-icons">chevron_left</i>
                                        </a>
                                    </li>
                                    <li class="active"><a href="javascript:void(0);">1</a></li>
                                    <li><a href="javascript:void(0);" class="waves-effect">2</a></li>
                                    <li><a href="javascript:void(0);" class="waves-effect">3</a></li>
                                    <li><a href="javascript:void(0);" class="waves-effect">4</a></li>
                                    <li><a href="javascript:void(0);" class="waves-effect">5</a></li>
                                    <li>
                                        <a href="javascript:void(0);" class="waves-effect">
                                            <i class="material-icons">chevron_right</i>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </div>					
											
											
											
											
											
											
											
											
							</div>
													
													
													
													
													
													
													
													
													
							
												
												
												
												
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
							
							
							
							
							
							
							
							
							
							
							
							
							
							
							
							
							
							
							

                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Multiple Items To Be Open -->
        </div>
    </section>
	
	<script>
	function show_form_deskel_by_kecamatan(){
		var kecamatan_kode = $('select[name=kecamatan_kode]').val();
		load('pra_rencana_kerja/tampil_combobox_deskel_by_kecamatan/'+kecamatan_kode, '#tampil_combobox_deskel_by_kecamatan');
	}
	</script>