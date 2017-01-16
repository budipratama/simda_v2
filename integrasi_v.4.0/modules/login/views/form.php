<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<meta content="<?php echo $this->config->item('project_description');?>" name="description"/>
	<meta content="<?php echo $this->config->item('powered_by');?>" name="author"/>
	<meta name="google-site-verification" content="Ym91sbya7vPRw8XO1_yNARQUZ7EuR9HkeR7w2WSRc_8" />
    <title>Halaman Login - Integrasi | Kab. Bekasi</title>
    <!-- Favicon-->
    <link rel="icon" href="<?php echo base_url('favicon.ico');?>" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="<?php echo base_url('public/templates/integrasi_v.4.0/plugins/bootstrap/css/bootstrap.css');?>" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="<?php echo base_url('public/templates/integrasi_v.4.0/plugins/node-waves/waves.css');?>" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="<?php echo base_url('public/templates/integrasi_v.4.0/plugins/animate-css/animate.css');?>" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="<?php echo base_url('public/templates/integrasi_v.4.0/css/style.css');?>" rel="stylesheet">	
</head>

<body class="login-page">
    <div class="login-box">
        <div class="logo">
            <a href="javascript:void(0);"><b>INTEGRASI</b></a>
            <small>Kabupaten Bekasi</small>
        </div>
        <div class="card">
            <div class="body">
				<form class="login-form" id="sign_in" action="<?php echo site_url('login/validasi');?>" method="post">
                    <div class="msg">Login Form</div>
					<?php echo validation_errors(); ?>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                        <div class="form-line">
                            <input type="text" class="form-control" name="username" placeholder="Username" required autofocus>
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                        <div class="form-line">
                            <input type="password" class="form-control" name="password" placeholder="Password" required>
                        </div>
                    </div>
					<div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">event</i>
                        </span>
                       <div class="col-md-5">
							<select name="tahun" class="form-control">
								<option>2016</option>
								<option>2017</option>
							</select>
						</div>
                    </div>
                    <div class="row">
                        <div class="col-xs-8 p-t-5">
                            <input type="checkbox" name="remember" id="remember" value="1" class="filled-in chk-col-pink">
                            <label for="remember">Ingat saya</label>
                        </div>
                        <div class="col-xs-4">
                            <button class="btn btn-block bg-pink waves-effect" type="submit">SIGN IN</button>
                        </div>
                    </div>
                    <div class="row m-t-15 m-b--20">
                        <div class="col-xs-6">
                        </div>
                        <div class="col-xs-6 align-right">
                            <a href="forgot-password.html">Forgot Password?</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Jquery Core Js -->
    <script src="<?php echo base_url('public/templates/integrasi_v.4.0/plugins/jquery/jquery.min.js');?>"></script>

    <!-- Bootstrap Core Js -->
    <script src="<?php echo base_url('public/templates/integrasi_v.4.0/plugins/bootstrap/js/bootstrap.js');?>"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="<?php echo base_url('public/templates/integrasi_v.4.0/plugins/node-waves/waves.js');?>"></script>

    <!-- Validation Plugin Js -->
    <script src="<?php echo base_url('public/templates/integrasi_v.4.0/plugins/jquery-validation/jquery.validate.js');?>"></script>

    <!-- Custom Js -->
    <script src="<?php echo base_url('public/templates/integrasi_v.4.0/js/admin.js');?>"></script>
    <script src="<?php echo base_url('public/templates/integrasi_v.4.0/js/pages/examples/sign-in.js');?>"></script>
</body>
</html>