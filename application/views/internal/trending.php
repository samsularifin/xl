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
							<h3>TRENDING PAGE</h3>
						</div>
						<div class="widget-container">
							<form class="form-horizontal" method="POST" action="<?php echo base_url();?>internal/trending/" name="formsearch" id="form">
								<div class="control-group">
								<label class="control-label">Choose Level:</label>
									<div class="controls">
										<select data-placeholder="Choose Level..." class="chzn-select span6" tabindex="2" name="level" id="level" onchange="changeFunc();">
											
											<option></option>
											<?php
												foreach($level as $data){
											?>
											<option value="<?php echo $data->value;?>"
											<?php
													if(!empty($this->input->post('level'))){
														if($getlevel == $data->nama_level){
															echo "selected='selected' onchange='changeFunc();'";
														}
													}
												?>>
												
											<?php echo $data->nama_level;?></option>
											<?php
												}
											
											?>
										</select>
										<select data-placeholder="Choose a BTS..." class="chzn-select span6 pull-right" tabindex="2" name="bts_type">
											<option value="bts_xl">BTS XL</option>
											<option value="bts_axis">BTS AXIS</option>
										</select>
										<div id="showcluster"></div>
										<div id="showkab"></div>
										<div id="showkec"></div>
										<div id="showtower"></div>
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
										
									</div>
									
								</div>
								<!--<div class="control-group">
									<label class="control-label">Date Range :</label>
									<div class="controls">
										<div class="input-prepend">
											<span class="add-on"><i class="icon-calendar"></i></span>
											<?php
													if(!empty($this->input->post('level'))){
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
									
								</div>-->
								<div class="control-group">
								<label class="control-label">Data Type:</label>
									<div class="controls">
										<select data-placeholder="Choose Data..." class="chzn-select span6" tabindex="2" name="data_type" id="data_type">
											<option value="SUM"
											<?php
													if(!empty($this->input->post('level'))){
														if($indatatype == "SUM"){
															echo "selected='selected'";
														}
													}
												?>
											>TOTAL</option>
											<option value="AVG"
											<?php
													if(!empty($this->input->post('level'))){
														if($indatatype == "AVG"){
															echo "selected='selected'";
														}
													}
												?>>AVERAGE</option>
											
										</select>
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
			url: "<?php echo base_url();?>internal/trending/ajaxsubmit/",
			data:  $('#form').serialize(),
			cache: false,
			success: function(html){
				$("#result").prepend(html);
			},
			error: function(){
				alert('failure');
			}
			
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
		
		if(selectedValue == "Cluster"){
		<?php
			$lev = $this->session->userdata('log_level');
			
			if($lev == 'East' || $lev == 'East 1' || $lev == 'East 2'){
		?>
			xmlhttp.open("POST","<?php echo base_url();?>internal/trending/showcluster",false);		
			
		<?php
			}else{
				?>
				xmlhttp.open("POST","<?php echo base_url();?>internal/trending/showclustergreater/<?php echo $lev;?>",false);	
				<?php
			}
		?>
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
			<?php
			$lev = $this->session->userdata('log_level');
			
			if($lev == 'East' || $lev == 'East 1' || $lev == 'East 2'){
		?>
			xmlhttp.open("POST","<?php echo base_url();?>internal/trending/showkab",false);		
			<?php
				}else{
				?>
				xmlhttp.open("POST","<?php echo base_url();?>internal/trending/showkabgreater/<?php echo $lev;?>",false);	
				<?php
			}
			?>
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
			<?php
			$lev = $this->session->userdata('log_level');
			
			if($lev == 'East' || $lev == 'East 1' || $lev == 'East 2'){
			?>
				xmlhttp.open("POST","<?php echo base_url();?>internal/trending/showkec",false);		
			<?php
				}else{
				?>
				xmlhttp.open("POST","<?php echo base_url();?>internal/trending/showkecgreater/<?php echo $lev;?>",false);	
				<?php
			}
			?>
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
		if(selectedValue == "Tower_ID_adj"){
			xmlhttp.open("POST","<?php echo base_url();?>internal/trending/showtowerid",false);		
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
		
			xmlhttp.open("POST","<?php echo base_url();?>internal/trending/showclusterkab/"+selectedValue,false);		
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
		
			xmlhttp.open("POST","<?php echo base_url();?>internal/trending/showkabkec/"+selectedValue,false);		
			xmlhttp.send(null); 
			
			if(xmlhttp.responseText=="") { 
				document.getElementById("showkabkec").innerHTML = ""; 
			} 
			else { 
				document.getElementById("showkabkec").innerHTML = xmlhttp.responseText; 
		}
	}
	
</script>


<!-- Kec Spesifik -->
<script type="text/javascript">
if (window.XMLHttpRequest) {
// code for IE7+, Firefox, Chrome, Opera, Safari 
	xmlhttp=new XMLHttpRequest();
 } 
else {
// code for IE6, IE5 
	xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
}
	function changeKecKab() {
		var temp = 1;
		
		var selectBox = document.getElementById("kab");
		var selectedValue = selectBox.options[selectBox.selectedIndex].value;
		
			xmlhttp.open("POST","<?php echo base_url();?>internal/trending/showclusterkec2/"+selectedValue,false);		
			xmlhttp.send(null); 
			
			if(xmlhttp.responseText=="") { 
				document.getElementById("showclusterkec").innerHTML = ""; 
			} 
			else { 
				document.getElementById("showclusterkec").innerHTML = xmlhttp.responseText; 
		}
	}
	
</script>
<!-- end kec -->
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
	$(function () {
                $('#data-table').dataTable({
                    "sDom": "<'row-fluid'<'span6'l><'span6'f>r>t<'row-fluid'<'span6'i><'span6'p>>"
                   
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

	

		