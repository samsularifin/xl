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
					<a href="<?php echo base_url();?>internal/dashbord/logout/">
					<i class="icon-lock"></i> Logout</a></li>
				</ul>
			</div>
		</div>
		<div class="left-nav clearfix">
			<div class="left-primary-nav3">
				<ul id="myTab">
					<!--<li><a href="#main" class="icon-desktop" title="Dashboard"></a></li>
					<li><a href="#forms" class="icon-th-large" title="Forms"></a></li>
					<li class="active"><a href="#features" class="icon-beaker" title="Features"></a></li>
					<li><a href="#ui-elements" class="icon-list-alt" title="UI&nbsp;Elements"></a></li>-->
					<li class="active"><a href="#pages" class="icon-file-alt" title="Pages"></a></li>
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
					<h4 class="side-head">GROWTH</h4>
					<ul class="accordion-nav">
						<li><a href="<?php echo base_url();?>internal/growth/"><i class="icon-search"></i>GROWTH SEARCH</a></li>
						<li><a href="page-403.html"><i class="icon-file-alt"></i>MENU 2</a></li>
						
						<li><a href="login.html"><i class="icon-unlock"></i> MENU 3</a></li>
                                
					</ul>
				</div>
			</div>
		</div>
	</div>