<?php
if(!empty($this->input->post('level'))){
		$level = $this->input->post('level');
		?>
		
		<?php
	//if(count($first_step) > 0){
		//foreach($first_step as $f){
		//$period = $f->Period;
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
				else if($level == 'Tower_ID_adj'){
					echo "Search for <strong>Tower ID</strong> Level, 
						Tower name : <strong>".$this->input->post('tower')."</strong>";
				}
				
			?>
        </div>
		
		<?php
		if(count($fq)>0){
			//echo var_dump($second_query);
			//exit;
		if(count($second_query[0]) > 0){
			$space = explode(" ", $getldate);
			$ambil = $space[1];
			
			$gfm = substr($getfdate,0,2);
			$glm = substr($ambil,0,2);
			
			$gfy = substr($getfdate,4);
			$gly = substr($ambil,4);
	
		?>
		<div class="row-fluid">
				<div class="span12">
					<!-- chart -->
					<div class="content-widgets white">
						<div class="widget-head xl_color">
							<h3>Revenue Chart</h3>
						</div>
						
						<div class="widget-container">
							<div id="ctrend" style="height:400px"></div>
							<?php
								echo br(2);
							?>
							<div id="chart" style="height: 400px">
									
							
							</div>
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
											<td>TOTAL</td>
											<?php
												$counter = 0;
		
												foreach ($second_query as $frow){
													$temp[$counter] = $frow;

													if($counter > 0){
														if($indatatype == 'AVG'){
															$gtotal =  ($temp[$counter][0]->total - $temp[$counter - 1][0]->total)  / ($temp[$counter -1][0]->total) * 100;
														}else{
															$gtotal =  ($temp[$counter][0]->total/substr($temp[$counter][0]->Period, 0,-6) - $temp[$counter - 1][0]->total / substr($temp[$counter - 1][0]->Period, 0,-6))  / ($temp[$counter -1][0]->total/substr($temp[$counter -1][0]->Period, 0,-6)) * 100;
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
						
								<div class="row-fluid">	
									<?php
										if($GLOBALS['checkchart'] < 6){
									?>
									<div class="span6">
										<?php
											$this->load->view('internal/tr_voice_chart');
										?>
									</div>
									<?php
										}else{
											$this->load->view('internal/tr_voice_chart');
										}
									?>
									<!-- end div>-->
									<?php
										if($GLOBALS['checkchart'] < 6){
									?>
									<div class="span6">
										<?php
											$this->load->view('internal/tr_sms_chart');
										?>
									</div>
									<?php
										}else{
											$this->load->view('internal/tr_sms_chart');
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
											$this->load->view('internal/tr_other_chart');
										?>
									</div>
									<?php
										}else{
											$this->load->view('internal/tr_other_chart');
										}
										
										/*data */
										if($GLOBALS['checkchart'] < 6){
										?>
										<div class="span6">
											<?php
												$this->load->view('internal/tr_data_chart');
											?>
										</div>
										<?php
										}else{
											$this->load->view('internal/tr_data_chart');
										}
										/*end data */
										
									?>
								</div>
									<!-- end div -->
									
								</div>
						</div>
						
					</div>
					<!-- end chart -->
					
							<?php
								echo br(1);
							?>
							
								
<?php	
	
			$counter = 0;
			
			foreach ($second_query as $frow){
				$temp[$counter] = $frow;

				//echo $val;
				//for($i=0;$i<count($frow);$i++){

				$period = $frow[0]->Period/1000000;
				$sms = $frow[0]->sms/1000000;
				$voice = $frow[0]->voice/1000000;
				$other = $frow[0]->other/1000000;
				$total = $frow[0]->total/1000000;
				$data = $frow[0]->data/1000000;

				$div1 = substr($frow[0]->Period, 0,-6);


				$jupukbulan1[] = month(substr($period, 3,2));
				$jupukdata1[] = $data;
				$jupukvoice1[] = $voice;
				$jupuksms1[] = $sms;
				$jupukother1[] = $other;
				$jupuktotal1[] = $total;
				
				$counter++;


			}
						?>
					
					
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
	}
	
	function month($month){
		switch($month){
			case "01":
				$mchar = "Jan";
				 break;
			case "02":
				$mchar = "Feb";
				 break;
			case "03":
				$mchar = "Mar";
				 break;
			case "04":
				$mchar = "Apr";
				 break;
			case "05":
				$mchar = "May";
				 break;
			case "06":
				$mchar = "Jun";
				 break;
			case "07":
				$mchar = "Jul";
				 break;
			case "08":
				$mchar = "Aug";
				 break;
			case "09":
				$mchar = "Sep";
				 break;
			case "10":
				$mchar = "Oct";
				 break;
			case "11":
				$mchar = "Nov";
				 break;
			case "12":
				$mchar = "Dec";
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
            margin: 75,
            options3d: {
                enabled: false,
                alpha: 10,
                beta: 25,
                depth: 70
            }
        },
        title: {
           text: 'Revenue From <?php echo month($gfm).", ". $gfy." To ". month($glm).", ". $gly;?>',
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
            stackLabels: {
				useHTML: true,
				x: 0,
                y:-28,				
                style: {
                    fontSize: '9px',
                    fontFamily: 'Verdana, sans-serif',
					color:'#722c84',
					//textShadow: "1px 1px #000"
                },
                enabled: true,
				formatter: function() {
                     return Highcharts.numberFormat(this.total, 0);
                },
            }
        },
		plotOptions: {
            column: {
                stacking: 'normal',
                dataLabels: {
                    enabled: true,
                    color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white',
            
                }
            }
        },
		tooltip: {
			 formatter: function() {
				 return 'The value for <b>' + this.x + '</b> is <b>' + Highcharts.numberFormat(this.y,5) + '</b>, in '+ this.series.name;
			 }
		  },
        series: [{
            name: 'Total',
            data: <?php echo json_encode($jupuktotal1);?>,
			index:4,
			shadow : true,
			dataLabels: {
                enabled: true,
                color: '#fff',
                align: 'center',
                formatter: function() {
                     return Highcharts.numberFormat(this.y, 2);
                },// one decimal
                y: 0, // 10 pixels down from the top
                style: {
                    fontSize: '9px',
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
                     return Highcharts.numberFormat(this.y, 2);
                }, // one decimal
                y: 0, // 10 pixels down from the top
                style: {
                    fontSize: '9px',
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
                     return Highcharts.numberFormat(this.y, 2);
                }, // one decimal
                y: 0, // 10 pixels down from the top
                style: {
                    fontSize: '9px',
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
                     return Highcharts.numberFormat(this.y, 2);
                }, // one decimal
                y: 0, // 10 pixels down from the top
                style: {
                    fontSize: '9px',
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
                     return Highcharts.numberFormat(this.y, 2);
                }, // one decimal
                y: 0, // 10 pixels down from the top
                style: {
                    fontSize: '9px',
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
            text: 'Total Revenue From <?php echo month($gfm).", ". $gfy." To ". month($glm).", ". $gly;?>',
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
              //  pointWidth: 100//width of the column bars irrespective of the chart size
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
            text: 'Voice Revenue From <?php echo month($gfm).", ". $gfy." To ". month($glm).", ". $gly;?>',
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
              //  pointWidth: 60//width of the column bars irrespective of the chart size
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
            text: 'SMS Revenue From <?php echo month($gfm).", ". $gfy." To ". month($glm).", ". $gly;?>',
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
            text: 'Other Revenue From <?php echo month($gfm).", ". $gfy." To ". month($glm).", ". $gly;?>',
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
            text: 'Data Revenue From <?php echo month($gfm).", ". $gfy." To ". month($glm).", ". $gly;?>',
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



