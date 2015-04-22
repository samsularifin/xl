<?php
	$this->load->view('internal/head');
?>
<select data-placeholder="Choose a Level..." class="chzn-select span6" tabindex="2" name="kec" onchange="changeFunckec();" name="kec" id="kec">
		<option value=""></option>
		<?php
			foreach($ckec as $data){
			?>
			<option value="<?php echo $data->Kec;?>">
			<?php echo $data->Kec;?></option>
			<?php
		}?>
	
</select>
<div id="showkabkec"></div>
<script type="text/javascript">
	 $(function () {
        $(".chzn-select").chosen();
        $(".chzn-select-deselect").chosen({
            allow_single_deselect: true
        });
    });
</script>

