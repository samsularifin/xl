<?php
	$this->load->view('internal/head');
?>
<select data-placeholder="Choose a Level..." class="chzn-select span6" tabindex="2" name="tower" onchange="changeFunckec();" name="tower" id="tower">
	<option value=""></option>
		<?php
			foreach($tower_id as $data){
			?>
			<option value="<?php echo $data->Tower_ID_adj;?>">
			<?php echo $data->Tower_ID_adj;?></option>
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

