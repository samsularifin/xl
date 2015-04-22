<div class="row-fluid ">
				<div class="span12">
					<div class="primary-head">
						<h3 class="page-header">Dashbord Page</h3>
						<ul class="top-right-toolbar">
							
						</ul>
					</div>
					<ul class="breadcrumb">
						<li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
						<li><a href="#">Library</a><span class="divider"><i class="icon-angle-right"></i></span></li>
						<li class="active">Grid</li>
					</ul>
				</div>
			</div>
			<div class="row-fluid">
				<div class="span12">
					<div class="content-widgets gray">
						<div class="widget-head xl_color">
							<h3><i class="icon-home"></i>Home Page</h3>
						</div>
						
						<div class="widget-container">
							<?php
								$tamp = 0;
								$level = $this->session->userdata('log_level');
		
								if($level == 'East' || $level == 'East 1' || $level == 'East 2'){
									?>
									<div id="ctrend"></div>
								<?php
									}else{
								foreach($grcluster as $nclust){
									?>
									<div id="ctrend<?php echo $tamp;?>"></div>
									<?php
										echo br(2);
										$tamp++;
								}
								}
							?>
							<!-- khusus vas buat ngambil total nya -->
							<?php
								$counter = 0;
								foreach($second_query as $frow){
									$temp[$counter] = $frow;
										$ftotal = $frow[$counter]->stotal/1000000;
										
										foreach($third_query as $lrow){
											$ltotal = $lrow[$counter]->stotal/1000000;
										}
										/* total XL + Axis Ex VAS */
										$total = $ftotal + $ltotal;
										
												
								}
								$GLOBALS['total'] = $total;
								
										
							?>
							<div class="row-fluid" style="margin:25px 0px 35px 0px">
							<?php
								$counter = 0;
								foreach($second_query as $frow){
									$temp[$counter] = $frow;
									
									
										$period = month(substr($frow[$counter]->pperiod, 2,2));
										$fvoice = ($frow[$counter]->svoice/1000000);
										$fsms = ($frow[$counter]->ssms/1000000);
										$fother = ($frow[$counter]->sother/1000000);
										//$jvoice = $frow[$counter]->svoice/1000000;
										
										$ftotal = $frow[$counter]->stotal/1000000;
										$fdata = $frow[$counter]->sdata/1000000;
										$fv151 = $frow[$counter]->s151/1000000;
										$fv123 = $frow[$counter]->s123/1000000;
										$fpayu = $frow[$counter]->spayu/1000000;
										
										foreach($third_query as $lrow){
											$lvoice = ($lrow[$counter]->svoice/1000000);
											$lsms = ($lrow[$counter]->ssms/1000000);
											$lother = ($lrow[$counter]->sother/1000000);
											//$jvoice = $frow[$counter]->svoice/1000000;
											
											$ltotal = $lrow[$counter]->stotal/1000000;
											$ldata = $lrow[$counter]->sdata/1000000;
											$lv151 = $lrow[$counter]->s151/1000000;
											$lv123 = $lrow[$counter]->s123/1000000;
											$lpayu = $lrow[$counter]->spayu/1000000;
										}
										
										$voice = $fvoice + $lvoice;
										$sms = $fsms + $lsms;
										$other = $fother + $lother;
										//$jvoice = $frow[$counter]->svoice/1000000;
										
										/* total XL + Axis Ex VAS */
										$total = $ftotal + $ltotal;
										
										/*vas */
										$vas = ($total/$GLOBALS['total']* 13766330628)/1000000;
										
										$vasxl = $vas * $ftotal / $total;
										$vasaxis = $vas * $ltotal / $total;
										
										$vasplus = ($vasxl + $vasaxis);
										
										
										//echo $total;
										//exit;
										
										$data = $fdata + $ldata;
										$v151 = $fv151 + $lv151;
										$v123 = $fv123 + $lv123;
										$payu = $fpayu + $lpayu;
									/*
									$data
									
									*/
									//echo $data."<br/><br/>hh";

										$div1 = substr($frow[$counter]->pperiod, 3,-6);
								
									//echo substr($frow[$counter]->pperiod, 2,2);

									$jupukbulan1[] = $period;
									$jupukdata1[] = $data;
									$jupukvoice1[] = $voice;
									$jupuksms1[] = $sms;
									$jupukother1[] = $other;
									$jupuktotal[] = $total;
									$jupukvas[] = $vasplus;
									
									echo var_dump($jupukvas)."vas<br/><br/>";
									echo var_dump($jupuktotal)."tot<br/><br/>" ;
									
									echo var_dump($vasxl)."vasxl<br/><br/>";
									echo var_dump($vasaxis)."vasaxis<br/><br/>";
									
									$jupuk151[] = $v151;
									$jupuk123[] = $v123;
									$jupukpayu[] = $payu;
									
												
								}
								//echo $vas;
								//exit;
								
										
							?>
							
								
							</div>
						</div>
						
					</div>
				</div>
			</div>
<?php
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

<?php
	$tamp = 0;
	$level = $this->session->userdata('log_level');
		
	if($level == 'East' || $level == 'East 1' || $level == 'East 2'){
		?>

<script type="text/javascript">
$(function () {
    $("#ctrend").highcharts({
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
            name: 'Vas',
            data: <?php echo json_encode($jupukvas);?>,
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
<?php
	}else{
		foreach($grcluster as $nclust){
		?>
		<script type="text/javascript">
$(function () {
    $("#ctrend<?php echo $tamp;?>").highcharts({
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
            data: <?php echo json_encode($jupuktotal);?>,
			index:0,
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

        }]
    });
});
</script>
		<?php
		$tamp++;
		}
	}
?>