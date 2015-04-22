<?php
	$this->load->view('internal/head');
?>
<select data-placeholder="Choose Kabupaten..." class="chzn-select span6" tabindex="2" name="kab" id="kab" onchange="changeKecKab();" name="kab" >
		<option value=""></option>
		<?php
			foreach($ckab as $data){
			?>
			<option value="<?php echo $data->Kab;?>">
			<?php echo $data->Kab;?></option>
			<?php
		}?>
	
</select>
<div id="showclusterkec"></div>
<script type="text/javascript">
	 $(function () {
        $(".chzn-select").chosen();
        $(".chzn-select-deselect").chosen({
            allow_single_deselect: true
        });
    });
</script>

