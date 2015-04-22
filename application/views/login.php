<!DOCTYPE HTML>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Login sales</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="Dashbord panel sales">
<meta name="author" content="XL Pemuda">
<!-- styles -->
<link href="<?php echo base_url();?>assets/css/bootstrap.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/css/bootstrap-responsive.css" rel="stylesheet">
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/font-awesome.css">
<!--[if IE 7]>
            <link rel="stylesheet" href="css/font-awesome-ie7.min.css">
        <![endif]-->
<link href="<?php echo base_url();?>assets/css/style.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/css/styles.css" rel="stylesheet">
<!--[if IE 7]>
            <link rel="stylesheet" type="text/css" href="css/ie/ie7.css" />
        <![endif]-->
<!--[if IE 8]>
            <link rel="stylesheet" type="text/css" href="css/ie/ie8.css" />
        <![endif]-->
<!--[if IE 9]>
            <link rel="stylesheet" type="text/css" href="css/ie/ie9.css" />
        <![endif]-->
<link href="<?php echo base_url();?>assets/css/aristo-ui.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/css/elfinder.css" rel="stylesheet">
<!--<link href='http://fonts.googleapis.com/css?family=Dosis' rel='stylesheet' type='text/css'>-->
<!--fav and touch icons -->
<link rel="shortcut icon" href="ico/favicon.ico">
<link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo base_url();?>assets/ico/apple-touch-icon-144-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo base_url();?>assets/ico/apple-touch-icon-114-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo base_url();?>assets/ico/apple-touch-icon-72-precomposed.png">
<link rel="apple-touch-icon-precomposed" href="<?php echo base_url();?>assets/ico/apple-touch-icon-57-precomposed.png">
<!--============j avascript===========-->
<script src="<?php echo base_url();?>assets/js/jquery.js"></script>
<script src="<?php echo base_url();?>assets/js/jquery-ui-1.10.1.custom.min.js"></script>
<script src="<?php echo base_url();?>assets/js/bootstrap.js"></script>
</head>
<body>
<div class="layout">
	<div class="loginpadding">	
	<div class="container">
	
		<div class="newlog">
		<div class="content-widgets light-gray">
			<div class="widget-container">
				<!-- login -->
					<div class="row-fluid">
					<div class="content-widgets light-gray">
						<?php
									if($this->session->flashdata('msg') != ''){
									echo '
									  <div class="alert">
										<button type="button" class="close" data-dismiss="alert">&times;</button>'.$this->session->flashdata('msg').'
									  </div>
									';
								}
								?>
						<div class="widget-head-login xl_color">
							<img src="<?php echo base_url();?>assets/images/xllogo.png" class="logo"></img>
							<h3>PLEASE SIGN IN</h3>
						</div>
						<div class="widget-container">
							
							<form action="<?php echo base_url();?>login/masuk/" class="form-horizontal" method="POST">
								<div class="control-group">
									<label class="control-label">Username</label>
									<div class="controls">
										<input type="text" placeholder="Username" class="span12" name="username">
									</div>
								</div>
								
								<div class="control-group">
									<label class="control-label">Password</label>
									<div class="controls">
										<input type="password" placeholder="Password" class="span12" name="password">
									</div>
								</div>
								<div class="control-group">
								 <label class="control-label">
									<input type="checkbox" name="rememberme" value="accepted">
								Remember me </label>
								</div>
						  <div class="form-actions">
									<button type="submit" class="btn btn-primary">Login</button>
									<button type="reset" class="btn">Reset</button>
								</div>
							</form>
						</div>
					</div>
				</div>
				</div>
				<!-- end login -->
			
				</div>
			</div>
		</div>
	</div>
</div>
</body>
</html>