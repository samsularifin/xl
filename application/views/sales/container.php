<!DOCTYPE HTML>
<html lang="en">
<?php echo $this->load->view('sales/head'); ?>
<body>
<div class="layout">
	<?php echo $this->load->view('sales/navbar'); ?>

	<div class="updown"></div>
	<!-- left menu -->
		<?php echo $this->load->view('sales/leftmenu'); ?>
		<div class="main-wrapper">
			<div class="container-fluid">
			
				<?php 
					$this->load->view($page);
				?>
				
			</div>
		</div>
	
</div>
</body>
</html>
