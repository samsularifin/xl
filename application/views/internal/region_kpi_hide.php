<?php
	$this->load->view('internal/head');
?>
<select data-placeholder="Choose a Region..." class="chzn-select span6" tabindex="2" name="regionselected" id="regionselected">
		<?php
			foreach($region as $data){
			?>
			<option value="<?php echo $data->val;?>">
			<?php echo $data->clustercat;?></option>
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

