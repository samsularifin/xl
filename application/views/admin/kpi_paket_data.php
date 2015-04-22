		<div class="row-fluid">
				<div class="span12">
				<?php
					if(!empty($this->input->post('kpi_type'))){
						if(count($data_kpi) >0){
				?>
					<div class="content-widgets light-gray">
						<div class="widget-head xl_color">
							<h3>DATA KPI</h3>
						</div>
						<div class="widget-container">
							<?php
								$no = 1;
								$i = 0;
							?>
							<table class="responsive table table-striped table-bordered" id="data-table">
								<thead>
									<tr>
										<th>Cluster</th>
										<th></th>
									</tr>
								</thead>
							<tbody>
								<?php
									foreach($data_kpi as $data){
								?>
							<tr>
								<?php
							//	foreach($exceldata[$i] as $key => $val){

								?>
									<td>
										 <?php
											echo $data->pcluster;
										//	echo $exceldata[$i][$key];
										 ?>
									</td>
									<td>
										 <?php
											echo number_format($data->voice_pkg, 2);
										//	echo $exceldata[$i][$key];
										 ?>
									</td>
									<td>
										 <?php
											echo number_format($data->sms_pkg, 2);
										//	echo $exceldata[$i][$key];
										 ?>
									</td>
									
									<td>
										 <?php
											echo number_format($data->mass_oth, 2);
										//	echo $exceldata[$i][$key];
										 ?>
									</td>
							</tr>
							<?php
									//}
									}
								?>
							<tr>
								<td><strong>GRAND TOTAL</strong></td>
								<?php
									foreach($data_total as $tot){
								?>
									<td><strong><?php echo number_format($tot->totvoice, 2);?></strong></td>
									<td><strong><?php echo number_format($tot->totsms, 2);?></strong></td>
									<td><strong><?php echo number_format($tot->totmass, 2);?></strong></td>
								<?php
									}
								?>
							</tr>
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
