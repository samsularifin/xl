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
					<a href="<?php echo base_url();?>admin/dashbord/logout/">
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
					<li class="active"><a href="#pages" class="icon-upload" title="Upload File"></a></li>
					<li><a href="#kpi" class="icon-move" title="Chart"></a></li>
				</ul>
			</div>
			<div class="responsive-leftbar">
				<i class="icon-list"></i>
			</div>
			<div class="left-secondary-nav tab-content">
				
				<div class="tab-pane active" id="pages">
					<h4 class="side-head">Upload File </h4>
					<ul class="accordion-nav">
						<li><a href="<?php echo base_url();?>admin/uploadexcel/"><i class="icon-upload"></i>Import Rev BTS</a></li>
                                
					</ul>
				</div>
			</div>
			<div class="left-secondary-nav tab-content">
				
				<div class="tab-pane" id="kpi">
					<h4 class="side-head">Upload File KPI </h4>
					<ul class="accordion-nav">
						<li><a href="<?php echo base_url();?>admin/kpi/cp/"><i class="icon-upload"></i>Import Cluster Packet</a></li>
						<li><a href="<?php echo base_url();?>admin/uploadexcel/"><i class="icon-upload"></i>Import Cluster Usage</a></li>
                                
					</ul>
				</div>
			</div>
		</div>
	</div>