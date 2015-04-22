<div class="primary-head">
						<h3 class="page-header">GROWTH SEARCH</h3>
						
					</div>
					<ul class="breadcrumb">
						<li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
						<li><a href="#">Library</a><span class="divider"><i class="icon-angle-right"></i></span></li>
						<li class="active">Form</li>
					</ul>
	<div class="row-fluid">
				<div class="span12">
					<div class="content-widgets gray">
						<div class="widget-head xl_color">
							<h3>GROWTH SEARCH</h3>
						</div>
						<div class="widget-container">
							<form class="form-horizontal" method="POST" action="<?php echo base_url();?>internal/growth/" name="formsearch">
								<div class="control-group">
								<label class="control-label">Choose :</label>
									<div class="controls">
										<select data-placeholder="Choose a Cluster..." class="chzn-select span6" tabindex="2" name="cluster">
											<option value=""></option>
											<?php
												foreach($ccluster as $data){
											?>
											<option value="<?php echo $data->Cluster;?>"
											<?php
													if(!empty($this->input->post('cluster'))){
														if($incluster == $data->Cluster){
															echo "selected='selected'";
														}
													}
												?>>
												
											<?php echo $data->Cluster;?></option>
											<?php
												}
											
											?>
										</select>
										<select data-placeholder="Choose a Level..." class="chzn-select span6 pull-right" tabindex="2" name="level">
											<option value=""></option>
											<option value="cluster"
											<?php
													if(!empty($this->input->post('cluster'))){
														if($inlevel == "cluster"){
															echo "selected='selected'";
														}
													}
												?>
											>Cluster</option>
											<option value="Kec"
											<?php
													if(!empty($this->input->post('cluster'))){
														if($inlevel == "Kec"){
															echo "selected='selected'";
														}
													}
												?>
											>Kecamatan</option>
											<option value="Kab"
											<?php
													if(!empty($this->input->post('cluster'))){
														if($inlevel == "Kab"){
															echo "selected='selected'";
														}
													}
												?>
											>Kabupaten</option>
											<option value="cvs"
											<?php
													if(!empty($this->input->post('cluster'))){
														if($inlevel == "cvs"){
															echo "selected='selected'";
														}
													}
												?>
											>Canvasser</option>
											<option value="Tower_ID_adj"
											<?php
													if(!empty($this->input->post('cluster'))){
														if($inlevel == "Tower_ID_adj"){
															echo "selected='selected'";
														}
													}
												?>
											>Tower ID</option>
										</select>
									</div>
									
								</div>
								
								<div class="control-group">
									<label class="control-label">Date Range :</label>
									<div class="controls">
										<div class="input-prepend">
											<span class="add-on"><i class="icon-calendar"></i></span>
											<?php
													if(!empty($this->input->post('cluster'))){
														?>
														<input type="text" name="growthrange" id="growthrange" value="<?php echo $inperiod;?>"/>
														<?php
													}else{
												?>
											<input type="text" name="growthrange" id="growthrange"/>
											<?php
												}
											?>
										</div>
										
									</div>
									
								</div>
								
								<div class="form-actions">
									<div class="icon-upload_lagi left-addon">
										<i class="icon-search"></i>
										<input type="submit" name="search" class="btn btn btn-primary" value="Search Growth"></input>
										<button type="reset" class="btn btn btn-warning2">Reset</button>
									</div>
								</div>
								
								
								
								</div>
							</form>
						</div>
						
					</div>
</div>
<?php
	if(!empty($this->input->post('cluster'))){
	if(count($firststep) > 0){
		
	
		$space = explode(" ", $getldate);
		$ambil = $space[1];
		
		/*echo $ambil;
		exit;
		/*desain */
		?>
		<div class="row-fluid">
				<div class="span12">
					<!-- chart -->
					<div class="content-widgets white">
						<div class="widget-head xl_color">
							<h3>Line Chart</h3>
						</div>
						
						<div class="widget-container">
							<div id="chart" style="height: 400px"></div>
						
								<div class="row-fluid">						
									<div class="span6">
										<div id="chart2" style="height: 400px"></div>
									</div>
									<div class="span6">
										<div id="chart3" style="height: 400px"></div>
									</div>
								</div>
								<div class="row-fluid">	
									<div class="span6">
										<div id="chart4" style="height: 400px"></div>
									</div>
									<div class="span6">
										<div id="chart5" style="height: 400px"></div>
									</div>
								</div>
						
						</div>
						
					</div>
					<!-- end chart -->
					
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
											$gfm = substr($getfdate,2,-5);
											$glm = substr($ambil,2,-4);
											
											$gfy = substr($getfdate,4);
											$gly = substr($ambil,4);

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
										WHERE period = '$getfdate'
										AND cluster = '$getcluster'
										AND $getlevel = '$getLabel'
										GROUP BY $getlevel");
										
										
										$lsql = $this->db->query("SELECT period, $getlevel AS label, sum( voice ) AS voice, sum( sms ) AS sms, sum( data ) AS data, sum( other ) AS other, sum( total ) AS total
										FROM revbts
										WHERE period = '$ambil'
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
										echo number_format($frow->voice/1000,2);
									 ?>
								</td>
								<td>
									 <?php
										echo number_format($frow->sms/1000,2);
									 ?>
								</td>
								<td>
									<?php
										echo number_format($frow->data/1000,2);
									?>
								</td>
								<td>
									 <?php
										echo number_format($frow->other/1000,2);
									?>
								</td>
								<td>
									<?php
										echo number_format($frow->total/1000,2);
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
											echo number_format($lrow->voice/1000,2);
										 ?>
									</td>
									<td>
										 <?php
											echo number_format($lrow->sms/1000,2);
										 ?>
									</td>
									<td>
										<?php
											echo number_format($lrow->data/1000,2);
										?>
									</td>
									<td>
										 <?php
											echo number_format($lrow->other/1000,2);
										?>
									</td>
									<td>
										<?php
											echo number_format($lrow->total/1000,2);
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
									
			/*$clgv= "<font color='black'>";
			$clgs= "<font color='black'>";
			$clgd= "<font color='black'>";
			$clgo= "<font color='black'>";
			$clgt= "<font color='black'>";
			if($gv<0)$clgv = "<font color='red'>";
			if($gs<0)$clgs = "<font color='red'>";
			if($gd<0)$clgd = "<font color='red'>";
			if($go<0)$clgo = "<font color='red'>";
			if($gt<0)$clgt = "<font color='red'>";
			echo "<td align='right'>".$clgv. number_format($gv)."%</td>";
			echo "<td align='right'>".$clgs. number_format($gs)."%</td>";
			echo "<td align='right'>".$clgd. number_format($gd)."%</td>";
			echo "<td align='right'>".$clgo. number_format($go)."%</td>";
			echo "<td align='right'>".$clgt. number_format($gt)."%</td></tr>"; */
								
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
				
				/*}else{
					echo '
							  <div class="alert alert-xl">
								<button type="button" class="close" data-dismiss="alert">&times;</button>
								<strong>Empty data</strong>
							  </div>
							';
				}*/
			?>				
					
				</div>
			</div>
			
		</div>
		<?php
		
	}else{
		echo "halo";
	}
	}
	for($i =1; $i<= 12;$i++){
		if($i<10){
			//$temp = month("0".$i);
		}else{
			//$temp = month($i);
		}
		//$bulan[] = $temp;
	}
	//var_dump($bulan);
	
	function month($month){
		switch($month){
			case '01':
				$mchar = "January";
				 break;
			case '02':
				$mchar = "February";
				 break;
			case '03':
				$mchar = "March";
				 break;
			case '04':
				$mchar = "April";
				 break;
			case '05':
				$mchar = "May";
				 break;
			case '06':
				$mchar = "June";
				 break;
			case '07':
				$mchar = "July";
				 break;
			case '08':
				$mchar = "August";
				 break;
			case '09':
				$mchar = "September";
				 break;
			case '10':
				$mchar = "October";
				 break;
			case '11':
				$mchar = "November";
				 break;
			case '12':
				$mchar = "December";
				 break;
			default:
				echo "Cannot find Month";
			
		}
		echo $mchar;
	}
?>
<script type="text/javascript">
	 $(function () {
        $(".chzn-select").chosen();
        $(".chzn-select-deselect").chosen({
            allow_single_deselect: true
        });
    });
	$(function () {
        $('#growthrange').daterangepicker({
			format: 'dd/MM/yyyy',
			
			locale: {
                applyLabel: 'Apply Date',
                fromLabel: 'First Date',
                toLabel: 'Second Date',
                customRangeLabel: 'Custom Range',
                daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
                monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                firstDay: 1
            }
		},
		function (start, end) {
            $('#growthrange span').html(start.toString('MMMM d, yyyy') + '-' + end.toString('MMMM d, yyyy'));
        });
    });
	
</script>
<script>
	$(function () {
                $('#data-table').dataTable({
                    "sDom": "<'row-fluid'<'span6'l><'span6'f>r>t<'row-fluid'<'span6'i><'span6'p>>"
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

<script type="text/javascript">
$(function () {
    $('#chart').highcharts({
        chart: {
            type: 'line',
            margin: 75,
            options3d: {
                enabled: false,
                alpha: 10,
                beta: 25,
                depth: 70
            }
        },
        title: {
            text: 'Data chart'
        },
        subtitle: {
            text: 'Notice the difference between a 0 value and a null point'
        },
        plotOptions: {
            column: {
                depth: 25
            }
        },
		credits: {
            enabled: false
        },
        xAxis: {
            categories: Highcharts.getOptions().lang.shortMonths
        },
        yAxis: {
            title: {
                text: null
            }
        },
        series: [{
            name: 'Sales',
            data: [2, 3, 0]
        }]
    });
});
		</script>
		
		
<script type="text/javascript">
$(function () {
    $('#chart2').highcharts({
        chart: {
            type: 'line',
            margin: 75,
            options3d: {
                enabled: false,
                alpha: 10,
                beta: 25,
                depth: 70
            }
        },
        title: {
            text: '3D chart with null values'
        },
        subtitle: {
            text: 'Notice the difference between a 0 value and a null point'
        },
        plotOptions: {
            column: {
                depth: 25
            }
        },
		credits: {
            enabled: false
        },
        xAxis: {
            categories: Highcharts.getOptions().lang.shortMonths
        },
        yAxis: {
            title: {
                text: null
            }
        },
        series: [{
            name: 'Voice',
            data: [2, 3, 10]
        }]
    });
});
		</script>
		<script type="text/javascript">
$(function () {
    $('#chart3').highcharts({
        chart: {
            type: 'line',
            margin: 75,
            options3d: {
                enabled: false,
                alpha: 10,
                beta: 25,
                depth: 70
            }
        },
        title: {
            text: '3D chart with null values'
        },
        subtitle: {
            text: 'Notice the difference between a 0 value and a null point'
        },
        plotOptions: {
            column: {
                depth: 25
            }
        },
		credits: {
            enabled: false
        },
        xAxis: {
            categories: Highcharts.getOptions().lang.shortMonths
        },
        yAxis: {
            title: {
                text: null
            }
        },
        series: [{
            name: 'SMS',
            data: [2, 4, 5]
        }]
    });
});
		</script>
	
	
	<script type="text/javascript">
$(function () {
    $('#chart4').highcharts({
        chart: {
            type: 'line',
            margin: 75,
            options3d: {
                enabled: false,
                alpha: 10,
                beta: 25,
                depth: 70
            }
        },
        title: {
            text: '3D chart with null values'
        },
        subtitle: {
            text: 'Notice the difference between a 0 value and a null point'
        },
        plotOptions: {
            column: {
                depth: 25
            }
        },
		credits: {
            enabled: false
        },
        xAxis: {
            categories: Highcharts.getOptions().lang.shortMonths
        },
        yAxis: {
            title: {
                text: null
            }
        },
        series: [{
            name: 'Other',
            data: [2, 3, null, 4, 0, 5, 1, 4, 6, 3]
        }]
    });
});
		</script>
		
		
		
		
		<script type="text/javascript">
$(function () {
    $('#chart5').highcharts({
        chart: {
            type: 'line',
            margin: 75,
            options3d: {
                enabled: false,
                alpha: 10,
                beta: 25,
                depth: 70
            }
        },
        title: {
            text: '3D chart with null values'
        },
        subtitle: {
            text: 'Notice the difference between a 0 value and a null point'
        },
        plotOptions: {
            column: {
                depth: 25
            }
        },
		credits: {
            enabled: false
        },
        xAxis: {
            categories: Highcharts.getOptions().lang.shortMonths
        },
        yAxis: {
            title: {
                text: null
            }
        },
        series: [{
            name: 'Total',
            data: [2, 3, null, 4, 0, 5, 1, 4, 6, 3]
        }]
    });
});
		</script>