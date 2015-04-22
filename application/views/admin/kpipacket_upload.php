		<div class="row-fluid">
				<div class="span12">
				<?php
					if(!empty($this->input->post('kpi_type'))){
						if(count($exceldata) >0){
				?>
					<div class="content-widgets light-gray">
						<div class="widget-head xl_color">
							<h3>Data Rev</h3>
						</div>
						<div class="widget-container">
							<?php
								$no = 1;
								$i = 0;
							?>
							<table class="responsive table table-striped table-bordered" id="data-table">
								<thead>
								<?php
									
								?>
								</thead>
							<tbody>
								<?php
									foreach($exceldata as $data){
								?>
							<tr>
								<?php
							//	foreach($exceldata[$i] as $key => $val){

								?>
									<td>
										 <?php
											echo $data->rowlabels;
										//	echo $exceldata[$i][$key];
										 ?>
									</td>
									<td>
										 <?php
											echo number_format($data->swp_blackberry, 2);
										//	echo $exceldata[$i][$key];
										 ?>
									</td>
									<td>
										 <?php
											echo number_format($data->swp_blackberry151, 2);
										//	echo $exceldata[$i][$key];
										 ?>
									</td>
									
									<td>
										 <?php
											echo number_format($data->swp_internet, 2);
										//	echo $exceldata[$i][$key];
										 ?>
									</td>
									<td>
										 <?php
											echo number_format($data->swp_internet151, 2);
										//	echo $exceldata[$i][$key];
										 ?>
									</td>
									<td>
										 <?php
											echo number_format($data->swp_vas151, 2);
										//	echo $exceldata[$i][$key];
										 ?>
									</td>
							</tr>
							<?php
									//}
									}
								?>
							<!--<tr>
								<td><strong>GRAND TOTAL</strong></td>
								<td><strong><?php echo $totvoice;?></strong></td>
								<td><strong><?php echo $totsms;?></strong></td>
								<td><strong><?php echo $totmass;?></strong></td>
							</tr>-->
							</tbody>
							<?php
								 $no++;
								 $i++;
								//}
							?>
							</table>
						</div>
					</div>
				<?php
					}
				}else{
					echo '
							  <div class="alert alert-xl">
								<button type="button" class="close" data-dismiss="alert">&times;</button>
								<strong>Empty data</strong>
							  </div>
							';
				}
			?>				
					
				</div>
			</div>
			
            
            
		</div>