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
<div class="primary-head">
						<h3 class="page-header">BTS GROWTH</h3>
						
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
							<h3>BTS GROWTH</h3>
						</div>
						<div class="widget-container">
							<form class="form-horizontal" method="POST" action="<?php echo base_url();?>internal/btsgrowth/ajaxsubmit/" name="formsearch" id="form">
								<div class="control-group">
								<label class="control-label">Choose :</label>
									<div class="controls">
										<select data-placeholder="Choose a Cluster..." class="chzn-select span6" tabindex="2" name="cluster">
											<option value=""></option>
											<?php
												foreach($ccluster as $data){
											?>
											<option value="<?php echo $data->Cluster;?>">
												
											<?php echo $data->Cluster;?></option>
											<?php
												}
											
											?>
										</select>
										<select data-placeholder="Choose a Level..." class="chzn-select span6 pull-right" tabindex="2" name="level">
											<option value=""></option>
											<option value="Cluster">Cluster</option>
											<option value="Kec">Kecamatan</option>
											<option value="Kab">Kabupaten</option>
											<option value="cvs">Canvasser</option>
											<option value="Tower_ID_adj">Tower ID</option>
										</select>
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
										<select data-placeholder="Choose a BTS..." class="chzn-select span6 pull-right" tabindex="2" name="bts_type">
											<option value="bts_xl">BTS XL</option>
											<option value="bts_axis">BTS AXIS</option>
										</select>
										
									</div>
									
								</div>
								<!--<div class="control-group">
									<label class="control-label">Date Picker</label>
									<div class="controls">
										
									</div>
								</div>-->
								
								
								<div class="form-actions">
									<div class="icon-upload_lagi left-addon">
										<i class="icon-search"></i>
										<input type="submit" name="search" id="btsgrowh" class="btn btn btn-primary" value="Search Growth"></input>
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
</div>
<script type="text/javascript" >
$(function() {
	$("#btsgrowh").click(function() {
		$('#result').html("");
		//$('.loading').fadeIn(100,0);
		//$('.loading').fadeOut('slow');
		
		$('.loading').ajaxStart(function(){$(this).show();});//this method for ajax start
		$('.loading').ajaxStop(function(){$(this).hide();});//this method for ajax stop
		
		$.ajax({
			type: "POST",
			url: "<?php echo base_url();?>internal/btsgrowth/ajaxsubmit/",
			data:  $('#form').serialize(),
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

