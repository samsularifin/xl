<!DOCTYPE HTML>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Dashbord Sales </title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="Admin Panel Template">
<meta name="author" content="Westilian: Kamrujaman Shohel">
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
<!--<link href='http://fonts.googleapis.com/css?family=Dosis' rel='stylesheet' type='text/css'>-->
<!--fav and touch icons -->
<link rel="shortcut icon" href="ico/favicon.ico">
<link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo base_url();?>assets/ico/apple-touch-icon-144-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo base_url();?>assets/ico/apple-touch-icon-114-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo base_url();?>assets/ico/apple-touch-icon-72-precomposed.png">
<link rel="apple-touch-icon-precomposed" href="<?php echo base_url();?>assets/ico/apple-touch-icon-57-precomposed.png">
<!--============ javascript ===========-->
<script src="<?php echo base_url();?>assets/js/jquery.js"></script>
<script src="<?php echo base_url();?>assets/js/jquery-ui-1.10.1.custom.min.js"></script>
<script src="<?php echo base_url();?>assets/js/bootstrap.js"></script>
<script src="<?php echo base_url();?>assets/js/accordion.nav.js"></script>
<script src="<?php echo base_url();?>assets/js/custom.js"></script>
<script src="<?php echo base_url();?>assets/js/respond.min.js"></script>
<script src="<?php echo base_url();?>assets/js/ios-orientationchange-fix.js"></script>
</head>
<body>
<div class="layout">
	<?php/*
	echo "<pre>";
print_r($this->session->all_userdata());
echo "</pre>";*/
?>
	<!-- Navbar
    ================================================== -->
	<div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
          <div class="nav-collapse collapse">
			<div class="container">
				<span class="home-link"><a href="index.html" class="icon-home"></a></span><a class="brand" href="./index.html"><img src="<?php echo base_url();?>assets/images/xllogo.png" width="50" height="50" alt="XL"></a>
				
			</div>
        </div>
      </div>
    </div>
	<div class="leftbar leftbar-close clearfix">
		<div class="admin-info clearfix">
			<div class="admin-thumb">
				<i class="icon-user"></i>
			</div>
			<div class="admin-meta">
				<ul>
					<li class="admin-username"><?php echo $this->session->userdata['username'];?></li>
					<li><a href="#">Edit Profile</a></li>
					<li><a href="#">View Profile </a>
					<a href="<?php echo base_url();?>sales/dashbord/logout/">
					<i class="icon-lock"></i> Logout</a></li>
				</ul>
			</div>
		</div>
		<div class="left-nav clearfix">
			<div class="left-primary-nav2">
				<ul id="myTab">
					<!--<li><a href="#main" class="icon-desktop" title="Dashboard"></a></li>
					<li><a href="#forms" class="icon-th-large" title="Forms"></a></li>
					<li class="active"><a href="#features" class="icon-beaker" title="Features"></a></li>
					<li><a href="#ui-elements" class="icon-list-alt" title="UI&nbsp;Elements"></a></li>-->
					<li><a href="#pages" class="icon-file-alt" title="Pages"></a></li>
					<li><a href="#chart" class="icon-bar-chart" title="Chart"></a></li>
				</ul>
				<ul>
					<li><a href="chat.html" class="icon-comments" title="Chat"></a></li>
					<li><a href="text-editor.html" class="icon-pencil" title="WYSIWYG editor"></a></li>
				</ul>
			</div>
			<div class="responsive-leftbar">
				<i class="icon-list"></i>
			</div>
			<div class="left-secondary-nav tab-content">
								<div class="tab-pane active" id="pages">
					<h4 class="side-head">Pages</h4>
					<ul class="accordion-nav">
						<li><a href="#"><i class="icon-minus-sign"></i>MENU 1</a></li>
						<li><a href="page-403.html"><i class="icon-file-alt"></i>MENU 2</a></li>
						
						<li><a href="login.html"><i class="icon-unlock"></i> MENU 3</a></li>
                                
					</ul>
				</div><!--
				<div class="tab-pane" id="chart">
					<h4 class="side-head">Charts</h4>
					<ul class="accordion-nav">
						<li><a href="flot-chart.html"><i class="icon-bar-chart"></i> Flot Charts</a></li>
						<li><a href="google-chart.html"><i class="icon-google-plus-sign"></i> Goolge<span>Quisque commodo lectus sit amet sem </span></a></li>
					</ul>
				</div>-->	
			</div>
		</div>
	</div>
	<div class="main-wrapper">
		<div class="container-fluid">
			<div class="row-fluid ">
				<div class="span12">
					<div class="primary-head">
						<h3 class="page-header">Page</h3>
						<!--<ul class="top-right-toolbar">
							<li><a data-toggle="dropdown" class="dropdown-toggle blue-violate" href="#" title="Users"><i class="icon-user"></i></a>
							</li>
							<li><a href="#" class="green" title="Upload"><i class=" icon-upload-alt"></i></a></li>
							<li><a href="#" class="bondi-blue" title="Settings"><i class="icon-cogs"></i></a></li>
						</ul>-->
					</div>
					<ul class="breadcrumb">
						<li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
						<li><a href="#">Library</a><span class="divider"><i class="icon-angle-right"></i></span></li>
						<li class="active">Grid</li>
					</ul>
				</div>
			</div>
			<div class="row-fluid">
				<div class="span12">
					<div class="content-widgets gray">
						<div class="widget-head blue">
							<h3><i class="icon-ambulance"></i>Halaman Sales</h3>
						</div>
						
						<div class="widget-container">
							<h3>Halo Sales </h3>
							<p>
								
							</p>
						</div>
					</div>
				</div>
			</div>
			
			
		</div>
	</div>
	<div class="copyright">
		<p>
			&copy; 2013 westilian
		</p>
	</div>
	<div class="scroll-top">
		<a href="#" class="tip-top" title="Go Top"><i class="icon-double-angle-up"></i></a>
	</div>
</div>
</body>
</html>