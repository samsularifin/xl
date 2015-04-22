<!DOCTYPE HTML>
<html lang="en">
<?php echo $this->load->view('admin/head'); ?>
<body>
<div class="layout">
	<?php echo $this->load->view('admin/navbar'); ?>

	<div class="updown"></div>
	<!-- left menu -->
		<?php echo $this->load->view('admin/leftmenu'); ?>
		<div class="main-wrapper">
			<div class="container-fluid">
			
				<?php 
					$this->load->view($page);
				?>
				
			</div>
		</div>
	
</div>
<?php
	echo $this->load->view('admin/script');
?>
</body>
</html>
