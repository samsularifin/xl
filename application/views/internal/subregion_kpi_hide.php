<?php
	$this->load->view('internal/head');
?>
<select data-placeholder="Choose Sub Region..." class="chzn-select span6" tabindex="2" name="subregionselected" id="subregionselected">
		<?php
			foreach($subregion as $data){
			?>
			<option value="<?php echo $data->val;?>">
			<?php echo $data->nameast;?></option>
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

