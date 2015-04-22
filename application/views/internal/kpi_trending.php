<style>
	.loading{
		display:    none;
		position:   fixed;
		z-index:    1000;
		top:        0;
		left:       0;
		height:     100%;
		width:      100%;
		background: rgba( 255, 255, 255, .8 ) 
					url('<?php echo base_url();?>assets/images/loading2.gif') 
					50% 50% 
					no-repeat;
		}
	body.loading {
		overflow: hidden;   
	}
</style>
<?php
	$GLOBALS['checkchart'] = '';
?>
<div class="primary-head">
						<h3 class="page-header">TRENDING PAGE</h3>
						
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
							<h3>KPI TRENDING PAGE</h3>
						</div>
						<div class="widget-container">
							<form class="form-horizontal" method="POST" action="<?php echo base_url();?>internal/kpi/tsubmit/" name="formsearch" id="form">
								<div class="control-group">
								<label class="control-label">Choose Level:</label>
									<div class="controls">
										<select data-placeholder="Choose Level..." class="chzn-select span6" tabindex="2" name="level" id="level" onchange="changeFunc();">
											<option></option>
											<?php
												foreach($level as $data){
											?>
											<option value="<?php echo $data->value;?>">
												
											<?php echo $data->kpilevelname;?></option>
											<?php
												}
											
											?>
										</select>
										<select data-placeholder="Choose a BTS..." class="chzn-select span6 pull-right" tabindex="2" name="bts_type">
											<option value="KPI_XL">XL</option>
											<option value="KPI_AXIS">AXIS</option>
											<option value="KPI_AXISXL">XL + AXIS</option>
										</select>
										<div id="showregion"></div>
										<div id="showsubregion"></div>
										<div id="shownascluster"></div>
									</div>
									
								</div>
								<div class="control-group">
									<label class="control-label">Date Range :</label>
									<div class="controls">
										<div class="input-prepend span6" style="margin-right:3px">
											<div id="datetimepicker1" class="input-append">
											<input data-format="MM/yyyy" type="text" name="buper"style="width:155px"><span class="add-on "><i data-time-icon="icon-time" data-date-icon="icon-calendar"></i></span>
											</div>
											<div id="datetimepicker4" class="input-append">
												<input data-format="MM/yyyy" type="text" name="buter"style="width:155px"><span class="add-on"><i data-time-icon="icon-time" data-date-icon="icon-calendar"></i></span>
											</div>
										</div>
										<select data-placeholder="Chart Type..." class="chzn-select span6 pull-right" tabindex="2" name="chart_type">
											<option value="line"
											<?php
												if(!empty($this->input->post('level'))){
														if($inchart == "line"){
															echo "selected='selected'";
														}
													}
											?>>Line</option>
											<option value="column"
											<?php
												if(!empty($this->input->post('level'))){
														if($inchart == "column"){
															echo "selected='selected'";
														}
													}
											?>>Bar</option>
										</select>
									</div>
									
								</div>
								
								<div class="form-actions">
								
									<div class="icon-upload_lagi left-addon">
										<i class="icon-search"></i>
										<input type="submit" id="searchgrowh" name="search" class="btn btn btn-primary" value="Search Growth"></input>
										<button type="reset" class="btn btn btn-warning2">Reset</button>
										<div class="loading"> </div>
									</div>
								</div>
								
								
								</div>
								
							</form>
							
						</div>
						
					</div>
</div>
<div id="result">
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
</div>
<script type="text/javascript" >
$(function() {
	$('#searchgrowh').click(function() {
		$('#result').html("");
		
		$('.loading').ajaxStart(function(){$(this).show();});//this method for ajax start
		$('.loading').ajaxStop(function(){$(this).hide();});//this method for ajax stop
		$('.loading').ajaxSuccess(function(){$(this).hide();});
		$('.loading').ajaxComplete(function(){$(this).hide();});
		$('.loading').ajaxError(function(){$(this).hide();});
		
		 $.ajax({
			type: "POST",
			url: "<?php echo base_url();?>internal/kpi/tsubmit/",
			data:  $('#form').serialize(),
			statusCode: {
			  404: function() {
					alert('page not found');
				}
			 },
			cache: false,
			success: function(html){
				$("#result").prepend(html);
			},
			error: function(){
				alert('failure');
			},
			
		});
		return false;
	});
	
});
</script>

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
		
		if(selectedValue == "region"){
			xmlhttp.open("POST","<?php echo base_url();?>internal/kpi/showregion/",false);		
			xmlhttp.send(null); 
			
			if(xmlhttp.responseText=="") { 
				document.getElementById("showregion").innerHTML = ""; 
			} 
			else { 
				document.getElementById("showregion").innerHTML = xmlhttp.responseText;	
			}
		}
		else{
			document.getElementById("showregion").innerHTML = "";
		}
		if(selectedValue == "sregion"){
			xmlhttp.open("POST","<?php echo base_url();?>internal/kpi/showsubregion",false);		
			xmlhttp.send(null); 
			
			if(xmlhttp.responseText=="") { 
				document.getElementById("showsubregion").innerHTML = ""; 
				
			} 
			else { 
				document.getElementById("showsubregion").innerHTML = xmlhttp.responseText; 
			}
		}
		else{
			document.getElementById("showsubregion").innerHTML = "";
		}
		if(selectedValue == "cluster"){
			xmlhttp.open("POST","<?php echo base_url();?>internal/kpi/shownascluster",false);		
			xmlhttp.send(null); 
			
			if(xmlhttp.responseText=="") { 
				document.getElementById("shownascluster").innerHTML = ""; 
			} 
			else { 
				document.getElementById("shownascluster").innerHTML = xmlhttp.responseText; 
			}
		}
		else{
			document.getElementById("shownascluster").innerHTML = "";
		}
   }
   function csstuff() 
	{
		$('selector').css('var', 'val');
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
			autoclose: true,
			viewMode: "months",
			minViewMode: "months",
			
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
<script>
	/*====DATE Time Picker====*/
    $(function () {
        $('#datetimepicker1').datetimepicker({
            format: "MM/yyyy",
			autoclose: true,
			viewMode: "months",
			minViewMode: "months",
			pickTime: false
        });
    });
    $(function () {
        $('#datetimepicker4').datetimepicker({
            format: "MM/yyyy",
			autoclose: true,
			viewMode: "months",
			minViewMode: "months",
			pickTime: false
        });
    });
</script>

	

		