<?php
	$this->load->view('internal/head');
?>
<select data-placeholder="Choose a Level..." class="chzn-select span6" tabindex="2" name="cselected" id="cselected">
		<?php
			$level = $this->session->userdata('log_level');
		
			if($level == 'East' || $level == 'East 1' || $level == 'East 2'){
					foreach($nascluster as $data){
				?>
				<option value="<?php echo $data->ncluster;?>">
				<?php echo $data->ncluster;?></option>
				<?php
			}
			}else{
			foreach($greatercluster as $data){
				?>
				<option value="<?php echo $data->Cluster;?>">
				<?php echo $data->Cluster;?></option>
				<?php
			}
		}?>
	
</select>

<script type="text/javascript">
	 $(function () {
        $(".chzn-select").chosen();
        $(".chzn-select-deselect").chosen({
            allow_single_deselect: true
        });
    });
</script>

