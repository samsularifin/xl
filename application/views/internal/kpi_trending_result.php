<?php
if(count($fq)>0){
			//echo var_dump($second_query);
			//exit;
		if(count($second_query[0]) > 0){
		
		?>
<div class="row-fluid">
		<div class="span12">
			<!-- chart -->
			<div class="content-widgets white">
				<div class="widget-head xl_color">
					<h3>Revenue Chart</h3>
				</div>
				
				<div class="widget-container">
					<div id="ctrend"></div>
					<?php
						echo br(2);
					?>
					<div id="chart" style="height: 400px"></div>
					
					<div style="margin:20px 0px 20px 0px;">
							<table class="paper-table responsive">
								<thead>
									<tr>
									<td><?php /*echo $getlevel; */?>GROWTH</td>
										<?php
											$counter = 0;
												foreach ($second_query as $frow){
													$GLOBALS['checkchart'] = $counter;
													$temp[$counter] = $frow;

													if($counter > 0){
														
														?>
														
														<th style="text-align:center"><?php echo month(Substr($temp[$counter - 1][0]->pperiod, 2,2))." - ".month(Substr($temp[$counter][0]->pperiod, 2,2));?></th> 
													<?php
													}
													
													$counter++;

												}
											?>
									</tr> 
								  </thead>
								   <tbody>
											 
										<tr>
											<td>TOTAL</td>
											<?php
												$counter = 0;
		
												foreach ($second_query as $frow){
													$temp[$counter] = $frow;

													if($counter > 0){
														
														$gtotal =  ($temp[$counter][0]->stotal/substr($temp[$counter][0]->pperiod, 0,-6) - $temp[$counter - 1][0]->stotal / substr($temp[$counter - 1][0]->pperiod, 0,-6))  / ($temp[$counter -1][0]->stotal/substr($temp[$counter -1][0]->pperiod, 0,-6)) * 100;
														
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
						
								<div class="row-fluid">	
									<?php
										if($GLOBALS['checkchart'] < 6){
									?>
									<div class="span6">
										<?php
											$this->load->view('internal/tr_kpi_voice_chart');
										?>
									</div>
									<?php
										}else{
											$this->load->view('internal/tr_kpi_voice_chart');
										}
									?>
									<!-- end div>-->
									<?php
										if($GLOBALS['checkchart'] < 6){
									?>
									<div class="span6">
										<?php
											$this->load->view('internal/tr_kpi_sms_chart');
										?>
									</div>
									<?php
										}else{
											$this->load->view('internal/tr_kpi_sms_chart');
										}
									?>
									<!-- end div -->
								</div>
								
								<div class="row-fluid">	
									<?php
										if($GLOBALS['checkchart'] < 6){
									?>
									<div class="span6">
										<?php
											$this->load->view('internal/tr_kpi_other_chart');
										?>
									</div>
									<?php
										}else{
											$this->load->view('internal/tr_kpi_other_chart');
										}
										
										/*data */
										if($GLOBALS['checkchart'] < 6){
										?>
										<div class="span6">
											<?php
												$this->load->view('internal/tr_kpi_data_chart');
											?>
										</div>
										<?php
										}else{
											$this->load->view('internal/tr_kpi_data_chart');
										}
										/*end data */
										
									?>
								</div>
								<!-- 123 and 151 chart -->
								<div class="row-fluid">	
									<?php
										if($GLOBALS['checkchart'] < 6){
									?>
									<div class="span6">
										<?php
											$this->load->view('internal/tr_kpi_123_chart');
										?>
									</div>
									<?php
										}else{
											$this->load->view('internal/tr_kpi_123_chart');
										}
										
										/*data */
										if($GLOBALS['checkchart'] < 6){
										?>
										<div class="span6">
											<?php
												$this->load->view('internal/tr_kpi_151_chart');
											?>
										</div>
										<?php
										}else{
											$this->load->view('internal/tr_kpi_151_chart');
										}
										/*end data */
										
									?>
								</div>
									<!-- end div -->
					
					<?php
	$counter = 0;
	foreach($second_query as $frow){
		$temp[$counter] = $frow;
		
		if($inbts_type == 'KPI_AXISXL'){
					$period = month(substr($frow[0]->pperiod, 2,2));
					$fvoice = ($frow[0]->svoice/1000000);
					$fsms = ($frow[0]->ssms/1000000);
					$fother = ($frow[0]->sother/1000000);
					//$jvoice = $frow[0]->svoice/1000000;
					
					$ftotal = $frow[0]->stotal/1000000;
					$fdata = $frow[0]->sdata/1000000;
					$fv151 = $frow[0]->s151/1000000;
					$fv123 = $frow[0]->s123/1000000;
					$fpayu = $frow[0]->spayu/1000000;
					
					foreach($third_query as $lrow){
						$lvoice = ($lrow[0]->svoice/1000000);
						$lsms = ($lrow[0]->ssms/1000000);
						$lother = ($lrow[0]->sother/1000000);
						//$jvoice = $frow[0]->svoice/1000000;
						
						$ltotal = $lrow[0]->stotal/1000000;
						$ldata = $lrow[0]->sdata/1000000;
						$lv151 = $lrow[0]->s151/1000000;
						$lv123 = $lrow[0]->s123/1000000;
						$lpayu = $lrow[0]->spayu/1000000;
					}
					
					$voice = $fvoice + $lvoice;
					$sms = $fsms + $lsms;
					$other = $fother + $lother;
					//$jvoice = $frow[0]->svoice/1000000;
					
					$total = $ftotal + $ltotal;
					$data = $fdata + $ldata;
					$v151 = $fv151 + $lv151;
					$v123 = $fv123 + $lv123;
					$payu = $fpayu + $lpayu;
					
		}else{
					
			$period =  month(substr($frow[0]->pperiod, 2,2));
			$voice = $frow[0]->svoice/1000000;
			$sms = $frow[0]->ssms/1000000;
			$other = $frow[0]->sother/1000000;
			//$jvoice = $frow[0]->svoice/1000000;
			
			$total = $frow[0]->stotal/1000000;
			$data = $frow[0]->sdata/1000000;
			$v151 = $frow[0]->s151/1000000;
			$v123 = $frow[0]->s123/1000000;
			$payu = $frow[0]->spayu/1000000;
					

			$div1 = substr($frow[0]->pperiod, 3,-6);
		}
		//echo substr($frow[0]->pperiod, 2,2);

		$jupukbulan1[] = $period;
		$jupukdata1[] = $data;
		$jupukvoice1[] = $voice;
		$jupuksms1[] = $sms;
		$jupukother1[] = $other;
		$jupuktotal[] = $total;
		
		$jupuk151[] = $v151;
		$jupuk123[] = $v123;
		$jupukpayu[] = $payu;
					
	/*	echo $period."<br/><br/><br/>";
		echo $voice."<br/>";
		echo $sms."<br/><br/><br/>";
		echo $other."<br/>";*/
	}?>
				</div>
			</div>
		</div>
</div>
	<?php
				}else{
					echo '
						<div class="row-fluid">
							<div class="span12 alert alert-warning" style="text-align:center">
							<button type="button" class="close" data-dismiss="alert">&times;</button>Data Not Found
							</div>
						</div>
						';
						
				}
			}else{
						echo '
						<div class="row-fluid">
							<div class="span12 alert alert-warning" style="text-align:center">
							<button type="button" class="close" data-dismiss="alert">&times;</button>Data based on date Not Found
							</div>
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
	
    $('#ctrend').highcharts({
        chart: {
            type:'column',
            // defaultSeriesType: 'bar',
           // margin: 75,
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
			series: {
                minPointLength: 100,
                dataLabels: {
                    enabled: true,

                },
            },
            column: {
				dataLabels: {
					overflow: 'none',
					crop: false,
					enabled: true,
					color: '#89A54E',
            style: {
                fontWeight: 'bold'
            },
                 }
            }
        },
		credits: {
            enabled: false
        },
        xAxis: {
            categories: <?php echo json_encode($jupukbulan1);?>
        },
        yAxis: {
            stackLabels: {
				useHTML: true,
				x: 0,
                y:-28,				
                style: {
                    fontSize: '12px',
                    fontFamily: 'Verdana, sans-serif',
					color:'#4cab30',
					textShadow: "1px 1px #045396"
                },
                enabled: true,
				formatter: function() {
                     return Highcharts.numberFormat(this.total/1000000, 2);
                },
            }
        },
		plotOptions: {
            column: {
                stacking: 'normal',
                dataLabels: {
                    enabled: true,
					crop: false,
					//inside: false,
					//padding: 8, // <-- Instead of x
				//	y: -1, // This is only to beautify
					overflow: 'none',
                    color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white',
            
                }
            }
        },
		/*colors: [
                '#045396',
                '#7ec26b',
                'fef646'
         ],
		/*legend: {
                align: 'right',
                x: -100,
                verticalAlign: 'top',
                y: 20,
                floating: true,
                backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColorSolid) || 'white',
                borderColor: '#CCC',
                borderWidth: 1,
                shadow: false
        },*/
		tooltip: {
			 formatter: function() {
				 return 'The value for <b>' + this.x + '</b> is <b>' + Highcharts.numberFormat(this.y,1) + '</b>, in '+ this.series.name;
			 }
		  },
        series: [{
            name: 'Total',
            data: <?php echo json_encode($jupuktotal);?>,
			index:4,
			shadow : true,
			dataLabels: {
                enabled: true,
                color: '#fff',
                align: 'center',
                formatter: function() {
                     return Highcharts.numberFormat(this.y/1000000, 2);
                },// one decimal
                y: 0, // 10 pixels down from the top
                style: {
                    fontSize: '13px',
                    fontFamily: 'Verdana, sans-serif'
                }
            }

        }, {
            name: 'Voice',
            data: <?php echo json_encode($jupukvoice1);?>,
			index:2,
			shadow : true,
			dataLabels: {
                enabled: true,
                color: '#fff',
                align: 'center',
                formatter: function() {
                     return Highcharts.numberFormat(this.y/1000000, 2);
                }, // one decimal
                y: 0, // 10 pixels down from the top
                style: {
                    fontSize: '13px',
                    fontFamily: 'Verdana, sans-serif'
                }
            }

        },
		{
            name: 'SMS',
            data: <?php echo json_encode($jupuksms1);?>,
			index:1,
			shadow : true,
			dataLabels: {
                enabled: true,
                color: '#fff',
                align: 'center',
                formatter: function() {
                     return Highcharts.numberFormat(this.y/1000000, 2);
                }, // one decimal
                y: 0, // 10 pixels down from the top
                style: {
                    fontSize: '13px',
                    fontFamily: 'Verdana, sans-serif'
                }
            }

        }, {
            name: 'Other',
            data: <?php echo json_encode($jupukother1);?>,
			index:0,
			shadow : true,
			dataLabels: {
                enabled: true,
                color: '#fff',
                align: 'center',
                formatter: function() {
                     return Highcharts.numberFormat(this.y/1000000, 2);
                }, // one decimal
                y: 0, // 10 pixels down from the top
                style: {
                    fontSize: '13px',
                    fontFamily: 'Verdana, sans-serif'
                }
            }

        }, {
            name: 'Data',
            data: <?php echo json_encode($jupukdata1);?>,
			index:3,
			shadow : true,
			dataLabels: {
                enabled: true,
                color: '#fff',
                align: 'center',
                formatter: function() {
                     return Highcharts.numberFormat(this.y/1000000, 2);
                }, // one decimal
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
					dataLabels: {
					enabled: true,
					crop: false,
					overflow: 'none'
				},	
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
		tooltip: {
			 formatter: function() {
				 return 'The value for <b>' + this.x + '</b> is <b>' + Highcharts.numberFormat(this.y,5) + '</b>, in '+ this.series.name;
			 }
		  },
        series: [{
            name: 'Revenue Total',
            data: <?php echo json_encode($jupuktotal);?>,
			shadow : true,
			dataLabels: {
                enabled: true,
                color: '#045396',
                align: 'center',
                formatter: function() {
                     return Highcharts.numberFormat(this.y/1000000, 2);
                }, // one decimal
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
					dataLabels: {
					enabled: true,
					crop: false,
					overflow: 'none'
				},	
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
                formatter: function() {
                     return Highcharts.numberFormat(this.y/1000000, 2);
                },  // one decimal
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
    $('#chartsms').highcharts({
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
                //pointWidth: 60//width of the column bars irrespective of the chart size
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
                formatter: function() {
                     return Highcharts.numberFormat(this.y/1000000, 2);
                },  // one decimal
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
               // pointWidth: 60//width of the column bars irrespective of the chart size
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
                formatter: function() {
                     return Highcharts.numberFormat(this.y/1000000, 2);
                },  // one decimal
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
                //pointWidth: 60//width of the column bars irrespective of the chart size
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
                formatter: function() {
                     return Highcharts.numberFormat(this.y/1000000, 2);
                },  // one decimal
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
    $('#chart123').highcharts({
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
            text: 'Month on Month 123 Revenue',
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
                //pointWidth: 60//width of the column bars irrespective of the chart size
            }
        },
		tooltip: {
			 formatter: function() {
				 return 'The value for <b>' + this.x + '</b> is <b>' + Highcharts.numberFormat(this.y,5) + '</b>, in '+ this.series.name;
			 }
		  },
        series: [{
            name: 'Revenue 123',
            data: <?php echo json_encode($jupuk123);?>,
			shadow : true,
			dataLabels: {
                enabled: true,
                color: '#045396',
                align: 'center',
                formatter: function() {
                     return Highcharts.numberFormat(this.y/1000000, 2);
                }, // one decimal
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
    $('#chart151').highcharts({
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
            text: 'Month on Month 151 Revenue',
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
                //pointWidth: 60//width of the column bars irrespective of the chart size
            }
        },
		tooltip: {
			 formatter: function() {
				 return 'The value for <b>' + this.x + '</b> is <b>' + Highcharts.numberFormat(this.y,5) + '</b>, in '+ this.series.name;
			 }
		  },
        series: [{
            name: 'Revenue 151',
            data: <?php echo json_encode($jupuk151);?>,
			shadow : true,
			dataLabels: {
                enabled: true,
                color: '#045396',
                align: 'center',
                formatter: function() {
                     return Highcharts.numberFormat(this.y/1000000, 2);
                },  // one decimal
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