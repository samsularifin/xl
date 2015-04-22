<?php
	$this->load->view('internal/head');
?>
<select data-placeholder="Choose a Level..." class="chzn-select span6" tabindex="2" name="cselected" id="cselected">
	<option value=""></option>
		<?php
			foreach($ccluster as $data){
			?>
			<option value="<?php echo $data->Cluster;?>">
			<?php echo $data->Cluster;?></option>
			<?php
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

