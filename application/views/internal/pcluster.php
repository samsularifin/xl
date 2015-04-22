<select data-placeholder="Choose Cluster..." class="chzn-select span6" tabindex="2" name="pccluster">
		<option value=""></option>
		<?php
			foreach($pcluster as $data){
			?>
			<option value="<?php echo $data->Cluster;?>">
			<?php echo $data->Cluster;?></option>
			<?php
		}?>
	
</select>