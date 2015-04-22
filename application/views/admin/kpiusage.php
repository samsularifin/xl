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
						<h3 class="page-header">UPLOAD FILE</h3>
						
					</div>
					<ul class="breadcrumb">
						<li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
						<li><a href="#">Library</a><span class="divider"><i class="icon-angle-right"></i></span></li>
						<li class="active">Form</li>
						<?php
							echo $this->breadcrumbs->show();
						?>
					</ul>
<div class="row-fluid">
				<div class="span12">
				
				<?php
						if($this->session->flashdata('scupload') != ''){
							echo '
							  <div class="alert alert-success-xl">
								<button type="button" class="close" data-dismiss="alert">&times;</button>'.$this->session->flashdata('scupload').'
							  </div>
							';
						}else if($this->session->flashdata('flupload') != ''){
							echo '
							  <div class="alert-error">
								<button type="button" class="close" data-dismiss="alert">&times;</button>'.$this->session->flashdata('flupload').'
							  </div>
							';
						}
				?>
					<div class="content-widgets gray">
						<div class="widget-head xl_color">
							<h3> File Upload</h3>
						</div>
						
						<div class="widget-container">
							<form enctype="multipart/form-data" class="form-horizontal" action="<?php echo base_url();?>admin/kpi/cusubmit/" method="POST" id="formcp">
								<div class="control-group">
									<label class="control-label">Select Type</label>
									<div class="controls">
										<select data-placeholder="Choose a BTS..." class="chzn-select span6 pull-right" tabindex="2" name="kpi_type">
												<option value="KPI_XL">XL</option>
												<option value="KPI_AXIS">AXIS</option>
											</select>
										</div>
								</div>
								<div class="control-group">
									<label class="control-label">Date time</label>
									<div class="controls">								
										<div id="datetimepicker1" class="input-append span6">
											<input data-format="dd-MM-yyyy" type="text" name="times"><span class="add-on "><i data-date-icon="icon-calendar"></i></span>
										</div>
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">Input File</label>
									<div class="controls">
										<div class="fileupload fileupload-new" data-provides="fileupload">
											<div class="input-append">
												<div class="uneditable-input">
													<i class="icon-file fileupload-exists"></i><span class="fileupload-preview"></span>
												</div>
												
												<span class="btn btn-file"><span class="fileupload-new">Select file</span><span class="fileupload-exists">Change</span>
												<input type="file" id="file" name="file"/>
												</span><a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
											</div>
										</div>
									</div>
								</div>
								<div class="form-actions">
									<div class="icon-upload_lagi left-addon">
										<i class="icon-upload-alt"></i>
										<input type="submit" id="upload" class="btn btn btn-primary" value="Upload"></input>
										<button type="reset" class="btn btn btn-warning2">Cancel</button>
										<div class="loading"> </div>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
	</div>
<div id="result">
<script type="text/javascript" >
$(function() {
	 			
	$('#nothing').click(function() {
		$('#result').html("");
		
		$('.loading').ajaxStart(function(){$(this).show();});//this method for ajax start
		$('.loading').ajaxStop(function(){$(this).hide();});//this method for ajax stop
		$('.loading').ajaxSuccess(function(){$(this).hide();});
		$('.loading').ajaxComplete(function(){$(this).hide();});
		$('.loading').ajaxError(function(){$(this).hide();});
		
		$('#form').ajaxForm(function(result) {
			 $.ajax({
				type: "POST",
				url: "<?php echo base_url();?>admin/kpi/cpsubmit/",
				data:  $('#formcp').serialize(),
				success: function(html){
					$("#result").prepend(html);
				},
				error: function(){
					alert('failure');
				}
				
			});
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
        $('#datetimepicker1').datetimepicker({
            language: 'pt-BR',
			pickTime: false
        });
    });
</script>
</div>