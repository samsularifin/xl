<script type="text/javascript">
 /* $('#growthrange').daterangepicker(null, function(start, end, label) {
	console.log(start.toISOString(), end.toISOString(), label);
  });
   */
   
    </script>
<script type="text/javascript">
if (window.XMLHttpRequest) {
// code for IE7+, Firefox, Chrome, Opera, Safari 
	xmlhttp=new XMLHttpRequest();
 } 
else {
// code for IE6, IE5 
	xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
 }

	function changeFunc() {
		var temp = 1;
		
		var selectBox = document.getElementById("level");
		var selectedValue = selectBox.options[selectBox.selectedIndex].value;
		
		if(selectedValue == "Cluster"){
			xmlhttp.open("POST","<?php echo base_url();?>internal/compare/showcluster",false);		
			xmlhttp.send(null); 
			
			if(xmlhttp.responseText=="") { 
				document.getElementById("showcluster").innerHTML = ""; 
			} 
			else { 
				document.getElementById("showcluster").innerHTML = xmlhttp.responseText;	
			}
		}
		else{
			document.getElementById("showcluster").innerHTML = "";
		}
		if(selectedValue == "Kab"){
			xmlhttp.open("POST","<?php echo base_url();?>internal/compare/showkab",false);		
			xmlhttp.send(null); 
			
			if(xmlhttp.responseText=="") { 
				document.getElementById("showkab").innerHTML = ""; 
			} 
			else { 
				document.getElementById("showkab").innerHTML = xmlhttp.responseText; 
			}
		}
		else{
			document.getElementById("showkab").innerHTML = "";
		}
		if(selectedValue == "Kec"){
			xmlhttp.open("POST","<?php echo base_url();?>internal/compare/showkec",false);		
			xmlhttp.send(null); 
			
			if(xmlhttp.responseText=="") { 
				document.getElementById("showkec").innerHTML = ""; 
			} 
			else { 
				document.getElementById("showkec").innerHTML = xmlhttp.responseText; 
			}
		}
		else{
			document.getElementById("showkec").innerHTML = "";
		}
		if(selectedValue == "Tower ID"){
			xmlhttp.open("POST","<?php echo base_url();?>internal/compare/showtower",false);		
			xmlhttp.send(null); 
			
			if(xmlhttp.responseText=="") { 
				document.getElementById("showtower").innerHTML = ""; 
			} 
			else { 
				document.getElementById("showtower").innerHTML = xmlhttp.responseText; 
			}
		}
		else{
			document.getElementById("showtower").innerHTML = "";
		}
   }
   function csstuff() 
	{
		$('selector').css('var', 'val');
	}
</script>
<script type="text/javascript">
if (window.XMLHttpRequest) {
// code for IE7+, Firefox, Chrome, Opera, Safari 
	xmlhttp=new XMLHttpRequest();
 } 
else {
// code for IE6, IE5 
	xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
}
	function changeFunc2() {
		var temp = 1;
		
		var selectBox = document.getElementById("kab");
		var selectedValue = selectBox.options[selectBox.selectedIndex].value;
		
			xmlhttp.open("POST","<?php echo base_url();?>internal/compare/showclusterkab/"+selectedValue,false);		
			xmlhttp.send(null); 
			
			if(xmlhttp.responseText=="") { 
				document.getElementById("showcluster2").innerHTML = ""; 
			} 
			else { 
				document.getElementById("showcluster2").innerHTML = xmlhttp.responseText; 
		}
	}
	
</script>
<script type="text/javascript">
if (window.XMLHttpRequest) {
// code for IE7+, Firefox, Chrome, Opera, Safari 
	xmlhttp=new XMLHttpRequest();
 } 
else {
// code for IE6, IE5 
	xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
}
	function changeFunckec() {
		var temp = 1;
		
		var selectBox = document.getElementById("kec");
		var selectedValue = selectBox.options[selectBox.selectedIndex].value;
		
			xmlhttp.open("POST","<?php echo base_url();?>internal/compare/showclusterkec/"+selectedValue,false);		
			xmlhttp.send(null); 
			
			if(xmlhttp.responseText=="") { 
				document.getElementById("showclusterkec").innerHTML = ""; 
			} 
			else { 
				document.getElementById("showclusterkec").innerHTML = xmlhttp.responseText; 
		}
	}
	
</script>
<script type="text/javascript">
	 $(function () {
        $(".chzn-select").chosen();
        $(".chzn-select-deselect").chosen({
            allow_single_deselect: true
        });
    });
	$(function () {
        $('#growthrange').daterangepicker({
			format: "MM/yyyy",
			viewMode: "months",
			minViewMode: "months",
			autoclose: true,
			
			locale: {
                applyLabel: 'Apply Date',
                fromLabel: 'First Date',
                toLabel: 'Second Date',
                monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                firstDay: 1
            }
		},
		function (start, end) {
            $('#growthrange span').html(start.toString('MMMM, yyyy') + '-' + end.toString('MMMM, yyyy'));
        });
    });
	
</script>
<!--
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
-->
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
        series: [{
            name: 'Revenue Total',
            data: <?php echo json_encode($jupuktotal1);?>,
			shadow : true,
			dataLabels: {
                enabled: true,
                color: '#045396',
                align: 'center',
                format: '{point.y:.1f}', // one decimal
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
        series: [{
            name: 'Revenue Voice',
            data: <?php echo json_encode($jupukvoice1);?>,
			shadow : true,
			dataLabels: {
                enabled: true,
                color: '#045396',
                align: 'center',
                format: '{point.y:.1f}', // one decimal
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
        series: [{
            name: 'Revenue SMS',
            data: <?php echo json_encode($jupuksms1);?>,
			shadow : true,
			dataLabels: {
                enabled: true,
                color: '#045396',
                align: 'center',
                format: '{point.y:.1f}', // one decimal
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
        series: [{
            name: 'Revenue Other',
            data: <?php echo json_encode($jupukother1);?>,
			shadow : true,
			dataLabels: {
                enabled: true,
                color: '#045396',
                align: 'center',
                format: '{point.y:.1f}', // one decimal
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
        series: [{
            name: 'Revenue Data',
            data: <?php echo json_encode($jupukdata1);?>,
			shadow : true,
			dataLabels: {
                enabled: true,
                color: '#045396',
                align: 'center',
                format: '{point.y:.1f}', // one decimal
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