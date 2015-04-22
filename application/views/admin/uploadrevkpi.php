
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
							<form enctype="multipart/form-data" class="form-horizontal" action="<?php echo base_url();?>admin/uploadexcel/submit/" method="POST">
								<div class="control-group">
									<label class="control-label">Select Periode</label>
									<div class="controls">
									
										<div id="datetimepicker1" class="input-append span6">
											<input data-format="dd-MM-yyyy" type="text" name="periode" ><span class="add-on "><i data-date-icon="icon-calendar"></i></span>
										</div>
										<select data-placeholder="Choose a BTS..." class="chzn-select span6 pull-right" tabindex="2" name="bts_type">
											<option value="bts_xl">BTS XL</option>
											<option value="bts_axis">BTS AXIS</option>
										</select>
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
										<input type="submit" class="btn btn btn-primary" value="Upload"></input>
										<button type="reset" class="btn btn btn-warning2">Cancel</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
			
		<!--	
		<div class="row-fluid">
				<div class="span12">
				<?php
					if(count($fielddatarev) > 0 && count($datarev)>0){
				?>
					<div class="content-widgets light-gray">
						<div class="widget-head xl_color">
							<h3>Data Rev</h3>
						</div>
						<div class="widget-container">
							
							<table class="responsive table table-striped table-bordered" id="data-table">
							<thead>
							<tr>
								<?php
									foreach($fielddatarev as $val){
								?>
									<th>
										 <?php echo $val;?>
									</th>
								<?php
									}
								?>
							</tr>
							</thead>
							<tbody>
							<?php
								foreach($datarev as $data){
							?>
							<tr>
								<td>
									 <?php
										echo $data->id_revbts;
									 ?>
								</td>
								<td>
									 <?php
										echo $data->period;
									 ?>
								</td>
								<td>
									<?php
										echo $data->Tower_ID_adj;
									?>
								</td>
								<td>
									 <?php
										echo $data->Cluster;
									?>
								</td>
								<td>
									<?php
										echo $data->Kab;
									?>
								</td>
								<td>
									 <?php
										echo $data->Kec;
									?>
								</td>
								<td>
									 <?php
										echo $data->Bts_Type;
									?>
								</td>
								<td>
									 <?php
										echo $data->cvs;
									?>
								</td>
								<td>
									 <?php
										echo $data->Voice;
									?>
								</td>
								<td>
									 <?php
										echo $data->SMS;
									?>
								</td>
								<td>
									 <?php
										echo $data->Data;
									?>
								</td>
								<td>
									 <?php
										echo $data->Other;
									?>
								</td>
								<td>
									 <?php
										echo $data->Total;
									?>
								</td>
							</tr>
							<?php
								}
							?>
							
							</tbody>
							</table>
						</div>
					</div>
				<?php
				}else{
					echo '
							  <div class="alert alert-xl">
								<button type="button" class="close" data-dismiss="alert">&times;</button>
								<strong>Empty data</strong>
							  </div>
							';
				}
			?>				
					
				</div>
			</div>
			
            
            
		</div>-->
	</div>
	
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