										<div id="chart3" style="height: 400px"></div>
										<div style="margin:20px 0px 20px 0px;">
									<table class="paper-table responsive">
										<thead>
											<tr>
												<td><?php /*echo $getlevel; */?>GROWTH</td>
												<?php
													$counter = 0;
														foreach ($second_query as $frow){
															$temp[$counter] = $frow;

															if($counter > 0){
																
																?>
																
																<th style="text-align:center"><?php echo month(Substr($temp[$counter - 1][0]->Period, 2,2))." - ".month(Substr($temp[$counter][0]->Period, 2,2));?></th> 
															<?php
															}
															
															$counter++;

														}
													?>
											</tr> 
										  </thead>
										   <tbody>
													 
												<tr>
													<td>SMS</td>
													<?php
														$counter = 0;
				
														foreach ($second_query as $frow){
															$temp[$counter] = $frow;

															if($counter > 0){
																if($indatatype == 'AVG'){
																	$gtotal =  ($temp[$counter][0]->sms - $temp[$counter - 1][0]->sms)  / ($temp[$counter -1][0]->sms) * 100;
																}else{
																	$gtotal =  ($temp[$counter][0]->sms/substr($temp[$counter][0]->Period, 0,-6) - $temp[$counter - 1][0]->sms / substr($temp[$counter - 1][0]->Period, 0,-6))  / ($temp[$counter -1][0]->sms/substr($temp[$counter -1][0]->Period, 0,-6)) * 100;
																}
																
																if($gtotal<0){
																	?>
																<td style="color:red; text-align:center"><?php echo number_format($gtotal)."%";?></td>
																<?php
																}else{
																?>
																<td style="text-align:center"><?php 
																	
																	echo number_format($gtotal)."%";?></td>
															<?php
																}
															}
															
															$counter++;

														}
													?>
												</tr>
												</tr>
														
											
									</tbody>
														
								</table>
						</div>
						<?php
											echo br(2);
										?>