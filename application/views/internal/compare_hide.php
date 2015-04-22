<style>
.datalabelInside {
position:absolute;
}

 #datalabelInside1 {
color:#fff;
left:-300px;

}
</style>
<?php
	if(!empty($this->input->post('level'))){
	
	$level = $this->input->post('level');
	if(count($first_step) > 0){
	
	?>
	<div class="alert green_xl">
			<?php
				if($level == 'East'){
					echo "Search for <strong>East</strong> Level";
				}else if($level == 'East 1'){
					echo "Search for <strong>East 1</strong> Level";
				}else if($level == 'East 2'){
					echo "Search for <strong>East 2</strong> Level";
				}else if($level == 'Cluster'){
					echo "Search for <strong>Cluster</strong> Level, 
						Cluster name : <strong>".$this->input->post('cselected')."</strong>";
				}
				else if($level == 'Kab'){
					echo "Search for <strong>Kabupaten</strong> Level, 
						Kabupaten name : <strong>".$this->input->post('kab')."</strong>, 
						Cluster name : <strong>".$this->input->post('pccluster')."</strong>";
				}
				else if($level == 'Kec'){
					echo "Search for <strong>Kecamatan</strong> Level, 
						Kecamatan name : <strong>".$this->input->post('kec')."</strong>, 
						Kabupaten name : <strong>".$this->input->post('kab')."</strong>, 
						Cluster name : <strong>".$this->input->post('pccluster')."</strong>";
				}
				
			?>
        </div>
		
	<?php
		$space = explode(" ", $getldate);
		$ambil = $space[1];
		
	/*	foreach($query_month as $bul){
			$getbul[] = $bul->Period;
			
		}*/
		
		/*echo $ambil;
		exit;
		/*desain */
		
		?>
		<?php
								if(count($first_query) > 0 && count($second_query)>0){
							?>
		<div class="row-fluid">
				<div class="span12">
					<!-- chart -->
					<div class="content-widgets white">
						<div class="widget-head xl_color">
							<h3>Revenue Chart</h3>
						</div>
						
						<div class="widget-container">
							<div class="row-fluid">	
								<div class="span6">
									<div id="pielable" style="height: 400px; padding:20px 0px 20px 0px">
									</div>
								</div>
								<div class="span6">
									<div id="pielable2" style="height: 400px; padding:20px 0px 20px 0px">
									</div>
								</div>
							</div>
							<div id="chart" style="height: 400px; padding:20px 0px 20px 0px"></div>
								
								<div class="row-fluid">						
									<div class="span6">
										<div id="chart2" style="height: 400px; padding:20px 0px 20px 0px"></div>
									</div>
									<div class="span6">
										<div id="chart3" style="height: 400px; padding:20px 0px 20px 0px"></div>
									</div>
								</div>
								<div class="row-fluid">	
									<div class="span6">
										<div id="chart4" style="height: 400px; padding:20px 0px 20px 0px"></div>
									</div>
									<div class="span6">
										<div id="chart5" style="height: 400px; padding:20px 0px 20px 0px"></div>
									</div>
								</div>
						
						</div>
						
					</div>
					<!-- end chart -->
					
					<div class="content-widgets light-gray">
						<div class="widget-head xl_color">
							<h3>Revenue Growth</h3>
						</div>
						<div class="widget-container">
							<?php
								echo br(1);
							?>
							<table class="responsive table table-striped table-bordered">
							<thead>
							<tr>
								<td style="text-align:center; font-weight:bold">
									<?php
										echo $getlevel;
									?>
								</td>
								<!-- begin -->
								<td colspan="5" style="text-align:center; font-weight:bold; background:#72bc52">
										<?php
											$gfm = substr($getfdate,0,2);
											$glm = substr($ambil,0,2);
											
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
							
							<tr>
								
								<?php	
									$b1b1 = 0;
									$b2g = 0;
									$b3g = 0;
									foreach($first_pei_chart as $pieval){
										$monthlagi1 = month(substr($pieval->period, 2,2));
										
										$bts_val = $pieval->Bts_Type;
										if($bts_val == '1:1'){
											$b1b1  += $pieval->Bts_Type;
										}else if($bts_val == '2G SA'){
											$b2g += $pieval->Bts_Type;
										}else if($bts_val == '3G SA'){
											$b3g += $pieval->Bts_Type;
										}
									}
									
									$jum = $b1b1 + $b2g + $b3g;
									
									$valb1 = $b1b1 / $jum * 100;
									$valb2 = $b2g / $jum * 100;
									$valb3 = $b3g / $jum * 100;
									
									
									
									$b1b12 = 0;
									$b2g2 = 0;
									$b3g2 = 0;
									foreach($second_pei_chart as $pieval2){
										$monthlagi2 = month(substr($pieval2->period, 2,2));
										
										$bts_val2 = $pieval2->Bts_Type;
										if($bts_val2 == '1:1'){
											$b1b12  += $pieval2->Bts_Type; 
										}else if($bts_val2 == '2G SA'){
											$b2g2 += $pieval2->Bts_Type;
										}else if($bts_val2 == '3G SA'){
											$b3g2 += $pieval2->Bts_Type;
										}
									}
									
									$jum2 = $b1b12 + $b2g2 + $b3g2;
									
									$valb12 = $b1b12 / $jum2 * 100;
									$valb22 = $b2g2 / $jum2 * 100;
									$valb32 = $b3g2 / $jum2 * 100;
									
									//echo json_encode($b1b12, $b2g2, $b3g2);

									/*echo number_format($valb1, 2)."<br/>";
									echo number_format($valb2, 2)."<br/>";
									echo number_format($valb3, 2)."<br/>";*/
									
									$mentah = array();
									array_push($mentah, $b1b12, $b2g2, $b3g2);
									
									
								
									foreach ($first_query as $frow){
										$div1 = substr($frow->Period, 0,-6);
										$jupukbulan1[] = month(substr($frow->Period, 2,2));
										
											$grdata1 = $frow->data/1000000;
											$grvoice1 = $frow->voice/1000000;
											$grsms1 = $frow->sms/1000000;
											$grother1 = $frow->other/1000000;
											$grtotal1 = $frow->total/1000000;
										
										if($indatatype == 'AVG'){
											$jupukdata1[] = ($frow->data/$div1)/1000000;
											$jupukvoice1[] = ($frow->voice/$div1)/1000000;
											$jupuksms1[] = ($frow->sms/$div1)/1000000;
											$jupukother1[] = ($frow->other/$div1)/1000000;
											$jupuktotal1[] = ($frow->total/$div1)/1000000;
											
										
										}else{
											$jupukdata1[] = $frow->data/1000000;
											$jupukvoice1[] = $frow->voice/1000000;
											$jupuksms1[] = $frow->sms/1000000;
											$jupukother1[] = $frow->other/1000000;
											$jupuktotal1[] = $frow->total/1000000;
											
											$grdata = ($frow->data/$div1)/1000000;
											$grvoice = ($frow->voice/$div1)/1000000;
											$grsms = ($frow->sms/$div1)/1000000;
											$grother = ($frow->other/$div1)/1000000;
											$grtotal = ($frow->total/$div1)/1000000;
										}
										
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
										echo $this->input->post('data_type');
									 ?>
								</td>
								<td>
									 <?php
										if($indatatype == 'AVG'){
											echo number_format(($frow->voice/$div1)/1000000,2);
										}
										echo number_format($frow->voice/1000000,2);
									 ?>
								</td>
								<td>
									 <?php	
										if($indatatype == 'AVG'){
											echo number_format(($frow->sms/$div1)/1000000,2);
										}
										echo number_format($frow->sms /1000000,2);
									 ?>
								</td>
								<td>
									<?php
										if($indatatype == 'AVG'){
											echo number_format(($frow->data/$div1)/1000000,2);
										}
										echo number_format($frow->data/1000000,2);
									?>
								</td>
								<td>
									 <?php
										if($indatatype == 'AVG'){
											echo number_format(($frow->other/$div1)/1000000,2);
										}
										echo number_format($frow->other/1000000,2);
									?>
								</td>
								<td>
									<?php
										if($indatatype == 'AVG'){
											echo number_format(($frow->total/$div1)/1000000,2);
										}
										echo number_format($frow->total/1000000,2);
									?>
								</td>
								<?php
								}
							?>
							
							<!-- kedua -->
								<?php
									foreach ($second_query as $lrow){
										$div2 = substr($lrow->Period, 0,-6);
										
										$jupukbulan2[] = month(substr($lrow->Period, 2,2));
										//echo month(substr($lrow->period, 2,2));
										//exit;
										$grdata2 = $lrow->data/1000000;
										$grvoice2 = $lrow->voice/1000000;
										$grsms2 = $lrow->sms/1000000;
										$grother2 = $lrow->other/1000000;
										$grtotal2 = $lrow->total/1000000;
										
										if($indatatype == 'AVG'){
											$jupukdata2[] = ($lrow->data/$div2)/1000000;
											$jupukvoice2[] = ($lrow->voice/$div2)/1000000;
											$jupuksms2[] = ($lrow->sms/$div2)/1000000;
											$jupukother2[] = ($lrow->other/$div2)/1000000;
											$jupuktotal2[] = ($lrow->total/$div2)/1000000;
										
										}else{
											$jupukdata2[] = $lrow->data/1000000;
											$jupukvoice2[] = $lrow->voice/1000000;
											$jupuksms2[] = $lrow->sms/1000000;
											$jupukother2[] = $lrow->other/1000000;
											$jupuktotal2[] = $lrow->total/1000000;
										}
										
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
											if($indatatype == 'AVG'){
												echo number_format(($lrow->voice/$div2)/1000000,2);
											}
											echo number_format($lrow->voice/1000000,2);
										 ?>
									</td>
									<td>
										 <?php
											if($indatatype == 'AVG'){
												echo number_format(($lrow->sms/$div2)/1000000,2);
											}
											echo number_format($lrow->sms/1000000,2);
										 ?>
									</td>
									<td>
										<?php
											if($indatatype == 'AVG'){
												echo number_format(($lrow->data/$div2)/1000000,2);
											}
											echo number_format($lrow->data/1000000,2);
										?>
									</td>
									<td>
										 <?php
											if($indatatype == 'AVG'){
												echo number_format(($lrow->other/$div2)/1000000,2);
											}
											echo number_format($lrow->other/1000000,2);
										?>
									</td>
									<td>
										<?php
											if($indatatype == 'AVG'){
												echo number_format(($lrow->total/$div2)/1000000,2);
											}
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
									
									//echo json_encode($jupukbulan2);
									
									array_push($jupukbulan1,$jupukbulan2);
									array_push($jupukdata1,$jupukdata2);
									array_push($jupukvoice1, $jupukvoice2);
									array_push($jupuksms1, $jupuksms2);
									array_push($jupukother1, $jupukother2);
									array_push($jupuktotal1,$jupuktotal2);
									//print_r($jupukdata1);
									
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
								}else{
					echo '
					<div class="row-fluid">
						<div class="span12 alert alert-warning" style="text-align:center">
						<button type="button" class="close" data-dismiss="alert">&times;</button>Data Not Found
						</div>
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
							
							</tbody>
							</table>
							<?php
								echo br(1);
							?>
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
					}else{
			echo '
					<div class="row-fluid">
						<div class="span12 alert alert-warning" style="text-align:center">
						<button type="button" class="close" data-dismiss="alert">&times;</button>Data Not Found
						</div>
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

<script type="text/javascript">
$(function() {
        $(".paper-table").tablecloth({
          theme: "paper",
          striped: true,
          sortable: true,
          condensed: false
        });
      });
</script>
<script type="text/javascript">
	 $(function () {
        $(".chzn-select").chosen();
        $(".chzn-select-deselect").chosen({
            allow_single_deselect: true
        });
    });
</script>
<script type="text/javascript">
	$(function () {
	
	var windowSize = $(window).width();
	var distance = -60;

	if(windowSize > 700)
		distance -= 30;
		
    // Make monochrome colors and set them as default for all pies
    Highcharts.getOptions().plotOptions.pie.colors = (function () {
        var colors = [],
            base = Highcharts.getOptions().colors[0],
            i;

        for (i = 0; i < 10; i += 1) {
            // Start out with a darkened base color (negative brighten), and end
            // up with a much brighter color
            colors.push(Highcharts.Color(base).brighten((i - 1) / 7).get());
        }
        return colors;
    }());

    // Build the chart
    $('#pielable').highcharts({
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false
        },
        title: {
            text: 'Percentage of BTS Type on <?php echo $monthlagi1;?>'
        },
		tooltip: {
                    headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                    pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of <?php echo $jum;?><br/>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        color: '#fff',
                        connectorColor: '#fff',
						distance: distance,
                        useHTML:true,
                        formatter: function() {
                            counter++;
                            return '<div class="datalabel"><b>'+ this.point.name +'</b>: '+ Highcharts.numberFormat(this.percentage,2) +' %</div><div class="datalabelInside" id="datalabelInside'+counter+'"><b>'+ <?php echo $mentah[1];?> +'</b></div>';
                        }
                    }
            }
        },
		credits: {
            enabled: false
        },
        series: [{
            type: 'pie',
            name: 'Bts Type',
            data:
			[
                ['1:1',   <?php echo json_encode($valb1);?>],
                ['2G SA',   <?php echo json_encode($valb2);?>],
                ['3G SA',   <?php echo json_encode($valb3);?>]
            ]
        }]
    });
});
</script>
<script type="text/javascript">
	$(function () {
	counter = 0;
	
    // Make monochrome colors and set them as default for all pies
    Highcharts.getOptions().plotOptions.pie.colors = (function () {
        var colors = [],
            base = Highcharts.getOptions().colors[0],
            i;

        for (i = 0; i < 10; i += 1) {
            // Start out with a darkened base color (negative brighten), and end
            // up with a much brighter color
            colors.push(Highcharts.Color(base).brighten((i - 1) / 7).get());
        }
        return colors;
    }());
	
	var windowSize = $(window).width();
	var distance = -60;

	if(windowSize > 700)
		distance -= 30;

    // Build the chart
    $('#pielable2').highcharts({
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false
        },
        title: {
            text: 'Percentage of BTS Type on <?php echo $monthlagi2;?>'
        },
        tooltip: {
                    headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                    pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of <?php echo $jum2;?><br/>'
        },
       /* plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                    style: {
                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                    }
                }
            }
        },*/
		 plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        color: '#fff',
                        connectorColor: '#fff',
						distance: distance,
                        useHTML:true,
                        formatter: function() {
                            counter++;
                            return '<div class="datalabel"><b>'+ this.point.name +'</b>: '+ Highcharts.numberFormat(this.percentage,2) +' %</div><div class="datalabelInside" id="datalabelInside'+counter+'"><b>'+ <?php echo $mentah[1];?> +'</b></div>';
                        }
                    }
                }
            },
		credits: {
            enabled: false
        },
        series: [{
            type: 'pie',
            name: 'Bts Type',
            data:
			[
                ['1:1',   <?php echo json_encode($valb12);?>],
                ['2G SA',   <?php echo json_encode($valb22);?>],
                ['3G SA',   <?php echo json_encode($valb32);?>]
            ]
        }]
    });
});
</script>	
<script type="text/javascript">
$(function () {
    $('#chart').highcharts({
        chart: {
            type: <?php echo json_encode($inchart);?>,
            margin: 75,
            options3d: {
                enabled: false,
                alpha: 10,
                beta: 25,
                depth: 70
            }
        },
        title: {
            text: '(Month on Month Total Revenue)',
			style: {
                    fontSize: '18px',
                    fontFamily: 'Verdana, sans-serif'
            }
        },
		subtitle: {
            text: '(In Mio)'
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
            categories: <?php echo json_encode($jupukbulan1);?>
        },
        yAxis: {
            title: {
                text: null
            }
        },
		plotOptions: {
            series: {
                pointWidth: 100//width of the column bars irrespective of the chart size
            }
        },
		 tooltip: {
			 formatter: function() {
				 return 'The value for <b>' + this.x + '</b> is <b>' + Highcharts.numberFormat(this.y,5) + '</b>, in '+ this.series.name;
			 }
		  },
        series: [{
            name: 'Revenue Total',
            data: <?php echo json_encode($jupuktotal1);?>,
			shadow : true,
			dataLabels: {
                enabled: true,
                color: '#045396',
                align: 'center',
                format: '{point.y:.2f}', // one decimal
                y: 0, // 10 pixels down from the top
                style: {
                    fontSize: '13px',
                    fontFamily: 'Verdana, sans-serif'
                }
            }
        }]
    });
});
		</script>
		
		
<script type="text/javascript">
$(function () {
    $('#chart2').highcharts({
        chart: {
            type: <?php echo json_encode($inchart);?>,
            margin: 75,
            options3d: {
                enabled: false,
                alpha: 10,
                beta: 25,
                depth: 70
            }
        },
        title: {
            text: 'Month on Month Voice Revenue',
			style: {
                    fontSize: '18px',
                    fontFamily: 'Verdana, sans-serif'
            }
        },
		subtitle: {
            text: '(In Mio)'
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
            categories: <?php echo json_encode($jupukbulan1);?>
        },
        yAxis: {
            title: {
                text: null
            }
        },
		plotOptions: {
            series: {
                pointWidth: 60//width of the column bars irrespective of the chart size
            }
        },
		tooltip: {
			 formatter: function() {
				 return 'The value for <b>' + this.x + '</b> is <b>' + Highcharts.numberFormat(this.y,5) + '</b>, in '+ this.series.name;
			 }
		  },
        series: [{
            name: 'Revenue Voice',
            data: <?php echo json_encode($jupukvoice1);?>,
			shadow : true,
			dataLabels: {
                enabled: true,
                color: '#045396',
                align: 'center',
                format: '{point.y:.2f}', // one decimal
                y: 0, // 10 pixels down from the top
                style: {
                    fontSize: '13px',
                    fontFamily: 'Verdana, sans-serif'
                }
            }
        }]
    });
});
		</script>
		<script type="text/javascript">
$(function () {
    $('#chart3').highcharts({
        chart: {
            type: <?php echo json_encode($inchart);?>,
            margin: 75,
            options3d: {
                enabled: false,
                alpha: 10,
                beta: 25,
                depth: 70
            }
        },
        title: {
            text: 'Month on Month SMS Revenue',
			style: {
                    fontSize: '18px',
                    fontFamily: 'Verdana, sans-serif'
            }
        },
		subtitle: {
            text: '(In Mio)'
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
            categories: <?php echo json_encode($jupukbulan1);?>
        },
        yAxis: {
            title: {
                text: null
            }
        },
		plotOptions: {
            series: {
                pointWidth: 60//width of the column bars irrespective of the chart size
            }
        },
		tooltip: {
			 formatter: function() {
				 return 'The value for <b>' + this.x + '</b> is <b>' + Highcharts.numberFormat(this.y,5) + '</b>, in '+ this.series.name;
			 }
		 },
        series: [{
            name: 'Revenue SMS',
            data: <?php echo json_encode($jupuksms1);?>,
			shadow : true,
			dataLabels: {
                enabled: true,
                color: '#045396',
                align: 'center',
                format: '{point.y:.2f}', // one decimal
                y: 0, // 10 pixels down from the top
                style: {
                    fontSize: '13px',
                    fontFamily: 'Verdana, sans-serif'
                }
            }
        }]
    });
});
		</script>
	
	
	<script type="text/javascript">
$(function () {
    $('#chart4').highcharts({
        chart: {
            type: <?php echo json_encode($inchart);?>,
            margin: 75,
            options3d: {
                enabled: false,
                alpha: 10,
                beta: 25,
                depth: 70
            }
        },
        title: {
            text: 'Month on Month Other Revenue',
			style: {
                    fontSize: '18px',
                    fontFamily: 'Verdana, sans-serif'
            }
        },
		subtitle: {
            text: '(In Mio)'
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
            categories: <?php echo json_encode($jupukbulan1);?>
        },
        yAxis: {
            title: {
                text: null
            }
        },
		plotOptions: {
            series: {
                pointWidth: 60//width of the column bars irrespective of the chart size
            }
        },
		tooltip: {
			 formatter: function() {
				 return 'The value for <b>' + this.x + '</b> is <b>' + Highcharts.numberFormat(this.y,5) + '</b>, in '+ this.series.name;
			 }
		  },
        series: [{
            name: 'Revenue Other',
            data: <?php echo json_encode($jupukother1);?>,
			shadow : true,
			dataLabels: {
                enabled: true,
                color: '#045396',
                align: 'center',
                format: '{point.y:.2f}', // one decimal
                y: 0, // 10 pixels down from the top
                style: {
                    fontSize: '13px',
                    fontFamily: 'Verdana, sans-serif'
                }
            }
        }]
    });
});
		</script>
		
		
		
		
		<script type="text/javascript">
$(function () {
    $('#chart5').highcharts({
        chart: {
            type: <?php echo json_encode($inchart);?>,
            margin: 75,
            options3d: {
                enabled: false,
                alpha: 10,
                beta: 25,
                depth: 70
            }
        },
        title: {
            text: 'Month on Month Data Revenue',
			style: {
                    fontSize: '18px',
                    fontFamily: 'Verdana, sans-serif'
            }
        },
		subtitle: {
            text: '(In Mio)'
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
            categories: <?php echo json_encode($jupukbulan1);?>
        },
        yAxis: {
            title: {
                text: null
            }
        },
		plotOptions: {
            series: {
                pointWidth: 60//width of the column bars irrespective of the chart size
            }
        },
		tooltip: {
			 formatter: function() {
				 return 'The value for <b>' + this.x + '</b> is <b>' + Highcharts.numberFormat(this.y,5) + '</b>, in '+ this.series.name;
			 }
		  },
        series: [{
            name: 'Revenue Data',
            data: <?php echo json_encode($jupukdata1);?>,
			shadow : true,
			dataLabels: {
                enabled: true,
                color: '#045396',
                align: 'center',
                format: '{point.y:.2f}', // one decimal
                y: 0, // 10 pixels down from the top
                style: {
                    fontSize: '13px',
                    fontFamily: 'Verdana, sans-serif'
                }
            }
        }]
    });
});
		</script>