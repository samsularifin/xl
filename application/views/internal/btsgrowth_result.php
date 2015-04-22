<?php
	if(!empty($this->input->post('cluster'))){
		if(count($firststep) > 0){

			$space = explode(" ", $getldate);
			$ambil = $space[1];
		
			?>
			<div class="row-fluid">
					<div class="span12">
						<div class="content-widgets light-gray">
							<div class="widget-head xl_color">
								<h3>Growth Data</h3>
							</div>
							<div class="widget-container">
								<table class="responsive table table-striped table-bordered" id="data-table">
								<thead>
								<tr>
									<td style="text-align:center; font-weight:bold">
										<?php
											echo $getcluster;
										?>
									</td>
									<!-- begin -->
									<td colspan="5" style="text-align:center; font-weight:bold; background:#72bc52">
											<?php
												$gfm = substr($getfdate,0,-5);
												$glm = substr($ambil,0,-4);
												
												$gfy = substr($getfdate,2);
												$gly = substr($ambil,2);
												
												/*echo $gfm."<br/>";
												echo $glm."<br/>";
												echo $gfy."<br/>";
												echo $gly."<br/>";
												exit;*/

												echo month($gfm).", ". $gfy;
											?>
											
									</td>
											
									<td colspan="5" style="text-align:center; font-weight:bold; background:#fef980">
										<?php
												echo month($glm).", ". $gly;
										?>
									</td>
									<td colspan="5" style="text-align:center; font-weight:bold">
										Growth (%)
									</td>		
									
								</tr>
							<tr>
									
									<!--	end -->
										<th>
											<?php echo $getlevel;?>
										</th>
										
										<!-- first month -->
										<th style="background:#72bc52">
											 Voice
										</th>
										<th style="background:#72bc52">
											SMS
										</th>
										<th style="background:#72bc52">
											 Data
										</th>
										<th style="background:#72bc52">
											 Order
										</th>
										<th style="background:#72bc52">
											 Total
										</th>
										
										<!-- second month -->
										<th style="background:#fef980">
											 Voice
										</th>
										<th style="background:#fef980">
											SMS
										</th>
										<th style="background:#fef980">
											 Data
										</th>
										<th style="background:#fef980">
											 Other
										</th>
										<th style="background:#fef980">
											 Total
										</th>
										
										
										<!-- growth -->
										<th>
											 Voice
										</th>
										<th>
											SMS
										</th>
										<th>
											 Data
										</th>
										<th>
											 Other
										</th>
										<th>
											 Total
										</th>
									
								</tr>
								</thead>
								<tbody>
								<?php
									foreach($firststep as $val){
										$getLabel = $val->label;
									
										$fsql = $this->db->query("SELECT period, $getlevel AS label, sum( voice ) AS voice, sum( sms ) AS sms, sum( data ) AS data, sum( other ) AS other, sum( total ) AS total
										FROM revbts
										WHERE Substr(period, 3,6) = '$getfdate'
										AND cluster = '$getcluster'
										AND $getlevel = '$getLabel'
										GROUP BY $getlevel");
										
										
										$lsql = $this->db->query("SELECT period, $getlevel AS label, sum( voice ) AS voice, sum( sms ) AS sms, sum( data ) AS data, sum( other ) AS other, sum( total ) AS total
										FROM revbts
										WHERE Substr(period, 3,6) = '$ambil'
										AND cluster = '$getcluster'
										AND $getlevel = '$getLabel'
										GROUP BY $getlevel");
											
											
											if(count($fsql->result()) > 0 && count($lsql->result()) > 0){
								?>
								<tr>
									
									<?php		
										foreach ($fsql->result() as $frow){
											$div1 = substr($frow->period, 0,-6);
											
											if ($frow->voice == 0)
												$frow->voice = 1;
											if ($frow->sms == 0)
												$frow->sms = 1;
											if ($frow->data == 0)
												$frow->data = 1;
											if ($frow->other == 0)
												$frow->other = 1;
											if($frow->total == 0)
												$frow->total = 1;
												
									?>
									<td>
										 <?php
											echo $getLabel;
										 ?>
									</td>
									<td>
										 <?php
											echo number_format($frow->voice/1000000,2);
										 ?>
									</td>
									<td>
										 <?php
											echo number_format($frow->sms/1000000,2);
										 ?>
									</td>
									<td>
										<?php
											echo number_format($frow->data/1000000,2);
										?>
									</td>
									<td>
										 <?php
											echo number_format($frow->other/1000000,2);
										?>
									</td>
									<td>
										<?php
											echo number_format($frow->total/1000000,2);
										?>
									</td>
									<?php
									}
								?>
								
								<!-- kedua -->
									<?php
										foreach ($lsql->result() as $lrow){
											$div2 = substr($lrow->period, 0,-6);
											
											if ($lrow->voice == 0)
												$lrow->voice = 1;
											if ($lrow->sms == 0)
												$lrow->sms = 1;
											if ($lrow->data == 0)
												$lrow->data = 1;
											if ($lrow->other == 0)
												$lrow->other = 1;
											if($lrow->total == 0)
												$lrow->total = 1;
						
											?>
										<td>
											 <?php
												echo number_format($lrow->voice/1000000,2);
											 ?>
										</td>
										<td>
											 <?php
												echo number_format($lrow->sms/1000000,2);
											 ?>
										</td>
										<td>
											<?php
												echo number_format($lrow->data/1000000,2);
											?>
										</td>
										<td>
											 <?php
												echo number_format($lrow->other/1000000,2);
											?>
										</td>
										<td>
											<?php
												echo number_format($lrow->total/1000000,2);
											?>
										</td>
									<?php	
										}
										$gv=($lrow->voice/$div2-$frow->voice/$div1)/($frow->voice/$div1)*100;
										$gs=($lrow->sms/$div2-$frow->sms/$div1)/($frow->sms/$div1)*100;
										$gd=($lrow->data/$div2-$frow->data/$div1)/($frow->data/$div1)*100;
										$go=($lrow->other/$div2-$frow->other/$div1)/($frow->other/$div1)*100;
										$gt=($lrow->total/$div2-$frow->total/$div1)/($frow->total/$div1)*100;
										?>
										
										<!-- growth -->
										<?php
											if($gv <0){
												?>
												<td style="color:red"><?php echo number_format($gv)."%";?>
												<?php
											}else{
										?>
											<td>
												 <?php
													echo number_format($gv)."%";
												 ?>
											</td>
										<?php
											}
											
											if($gs < 0 ){
												?><td style="color:red">
													<?php
														echo number_format($gs)."%";
													?>
												</td>
												<?php
											}else{
											?>
											<td>
												 <?php
													echo number_format($gs)."%";
												 ?>
											</td>
										<?php
											}
											
											if($gd < 0){
												?>
												<td style="color:red">
													<?php
														echo number_format($gd)."%";
													?>
												</td>
												<?php
											}else{
										?>
											<td>
												<?php
													echo number_format($gd)."%";
												?>
											</td>
										<?php
											}
											if($go < 0){
												?>
												<td style="color:red">
												<?php
													echo number_format($go)."%";
												?>
												</td>
											<?php		
											}else{
											?>
											<td>
												 <?php
													echo number_format($go)."%";
												?>
											</td>
										<?php
											}
											
											if($gt < 0){
												?>
												<td style="color:red">
												<?php
													echo number_format($gt)."%";
												?>
												</td>
											<?php
											}else{	
											?>
											<td>
												<?php
													echo number_format($gt)."%";
												?>
											</td>
											<?php
											}
				
									
								?>
								<!-- end kedua -->
								</tr>
								<?php
									}
									}
								?>
								
								</tbody>
								</table>
							</div>
						</div>
					<?php
					
					}else{
						echo '
								  <div class="alert alert-xl">
									<button type="button" class="close" data-dismiss="alert">&times;</button>
									<strong>Empty data</strong>
								  </div>
								  <style>
					body.loading {
						  visibility: hidden;
					}
					.loading{
						  visibility: hidden;
					}
					</style>
								';
					}
				?>				
						
					</div>
				</div>
				
			</div>
			<?php
			
			}else{
				echo '
					  <div class="alert alert-xl">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						<strong>Empty data</strong>
					  </div>
				';
		}
		function month($month){
		switch($month){
			case "01":
				$mchar = "January";
				 break;
			case "02":
				$mchar = "February";
				 break;
			case "03":
				$mchar = "March";
				 break;
			case "04":
				$mchar = "April";
				 break;
			case "05":
				$mchar = "May";
				 break;
			case "06":
				$mchar = "June";
				 break;
			case "07":
				$mchar = "July";
				 break;
			case "08":
				$mchar = "August";
				 break;
			case "09":
				$mchar = "September";
				 break;
			case "10":
				$mchar = "October";
				 break;
			case "11":
				$mchar = "November";
				 break;
			case "12":
				$mchar = "December";
				 break;
			default:
				echo "Cannot find Month";
			
		}
		return $mchar;
	}
	?>
	
<script>
	$(function () {
                $("#data-table").dataTable({
					//"aaSorting":[[11, 'asc'], [12, 'desc'], [13, 'asc']],
					bFilter:true,
					bSortable: true,
					//bRetrieve: true,
					"columns": [
						null,
						null,
						null,
						null,
						null,
						null,
						null,
						null,
						null,
						null,
						//{ "orderDataType": "dom-text" },
						{ "orderDataType": "dom-text", "type": "numeric" },
						{ "orderDataType": "dom-text", "type": "numeric" },
						{ "orderDataType": "dom-text", "type": "numeric" },
						{ "orderDataType": "dom-text", "type": "numeric" },
						{ "orderDataType": "dom-text", "type": "numeric" },
						{ "orderDataType": "dom-text", "type": "numeric" },
					]
					/*aoColumnDefs: [{"aTargets":[0], "bSortable": true},
					{"aTargets":[1], "bSortable": true},
					{"aTargets":[2], "bSortable": true},
					{"aTargets":[3], "bSortable": true},
					{"aTargets":[4], "bSortable": true},
					{"aTargets":[5], "bSortable": true},
					{"aTargets":[6], "bSortable": true},
					{"aTargets":[7], "bSortable": true},
					{"aTargets":[8], "bSortable": true},
					{"aTargets":[9], "bSortable": true},
					{"aTargets":[10], "bSortable": true},
					{"aTargets":[11], "bSortable": true},
					{"aTargets":[12], "bSortable": true},
					{"aTargets":[13], "bSortable": true},
					{"aTargets":[14], "bSortable": true}]
                    //"sDom": "<'row-fluid'<'span6'l><'span6'f>r>t<'row-fluid'<'span6'i><'span6'p>>"
                    /*"oTableTools": {
			"aButtons": [
				"copy",
				"print",
				{
					"sExtends":    "collection",
					"sButtonText": 'Save <span class="caret" />',
					"aButtons":    [ "csv", "xls", "pdf" ]
				}
			]
		}*/
                });
            });
</script>