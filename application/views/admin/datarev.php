			<div class="row-fluid">
				<div class="span12">
					<div class="content-widgets light-gray">
						<div class="widget-head xl_color">
							<h3>Data Rev</h3>
						</div>
						<div class="widget-container">
							
							<table class="responsive table table-striped table-bordered" id="data-table">
							<thead>
							<tr>
								<?php
									foreach($fielddatarev as $val){
								?>
									<th>
										 <?php echo $val;?>
									</th>
								<?php
									}
								?>
							</tr>
							</thead>
							<tbody>
							<?php
								foreach($datarev as $data){
							?>
							<tr>
								<td>
									 <?php
										echo $data->id_revbts;
									 ?>
								</td>
								<td>
									 <?php
										echo $data->period;
									 ?>
								</td>
								<td>
									<?php
										echo $data->Tower_ID_adj;
									?>
								</td>
								<td>
									 <?php
										echo $data->Cluster;
									?>
								</td>
								<td>
									<?php
										echo $data->Kab;
									?>
								</td>
								<td>
									 <?php
										echo $data->Kec;
									?>
								</td>
								<td>
									 <?php
										echo $data->Bts_Type;
									?>
								</td>
								<td>
									 <?php
										echo $data->cvs;
									?>
								</td>
								<td>
									 <?php
										echo $data->Voice;
									?>
								</td>
								<td>
									 <?php
										echo $data->SMS;
									?>
								</td>
								<td>
									 <?php
										echo $data->Data;
									?>
								</td>
								<td>
									 <?php
										echo $data->Other;
									?>
								</td>
								<td>
									 <?php
										echo $data->Total;
									?>
								</td>
							</tr>
							<?php
								}
							?>
							
							</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			
            
            
		</div>
	</div>