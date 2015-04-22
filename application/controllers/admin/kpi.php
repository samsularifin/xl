<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kpi extends CI_Controller {
	function __construct(){
			parent::__construct();
			$this->is_logged_in();
			
            $this->load->library(array('PHPExcel','PHPExcel/IOFactory'));
			$this->load->model('admin/mread');	
			$this->load->model('admin/minsert');
			$this->load->model('admin/mdelete');
			$this->load->library('breadcrumbs');
	}
	function index(){
		$data['page'] = "admin/uploadrevkpi";
		$this->load->view('admin/container', $data);
	}
	function cp(){
		$data['page'] = "admin/kpipacket";
		$this->load->view('admin/container', $data);
	}
	function cu(){
		$data['page'] = "admin/kpiusage";
		$this->load->view('admin/container', $data);
	}
	function swp(){
		$data['page'] = "admin/kpiswp";
		$this->load->view('admin/container', $data);
	}
	function cpsubmit(){
		$typo = $this->input->post('kpi_type');
		$periode = $this->input->post('times');
		
		$fileName = time().$_FILES['file']['name'];
		
		if(!empty($typo) && !empty($periode) && !empty($fileName)){
		
			$ambil = explode("-",$periode);
				
			$date= $ambil[0];
			$month = $ambil[1];
			$year = $ambil[2];
			
			$times = $date."".$month."".$year;
			
			
			$config['upload_path'] = './assets/excelupload/';
			$config['file_name'] = $fileName;
			$config['allowed_types'] = 'xls|xlsx|csv';
			$config['max_size']        = 10000;
			
			$this->load->library('upload');
			$this->upload->initialize($config);
			
			if(! $this->upload->do_upload('file') )
				$this->upload->display_errors();
				
			$media = $this->upload->data('file');
			$inputFileName = './assets/excelupload/'.$media['file_name'];
			
			try {
				$inputFileType = IOFactory::identify($inputFileName);
				$objReader = IOFactory::createReader($inputFileType);
				$objPHPExcel = $objReader->load($inputFileName);
			} catch(Exception $e) {
				die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
			}

			$sheet = $objPHPExcel->getSheet(0);
			$highestRow = $sheet->getHighestRow();
			$highestColumn = $sheet->getHighestColumn();
			
			$totvoice = 0;
			$totsms = 0;
			$totmass = 0;
			
			if($typo == 'KPI_XL'){
				for ($row = 2; $row <= $highestRow-2; $row++){                 
					 $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
														NULL,
														TRUE,
														FALSE);	
						$totvoice += $rowData[0][1];
						$totsms += $rowData[0][2];
						$totmass += $rowData[0][3];
						
				 }
				for ($row = 2; $row <= $highestRow-1; $row++){                 
					 $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
														NULL,
														TRUE,
														FALSE);	
						
						if($rowData[0][0] == 'UNKNOWN'){
							//echo "Halo ".$rowData[0][1];
							 $GLOBALS['uvoice'] = $rowData[0][1];
							 $GLOBALS['usms'] = $rowData[0][2];
							 $GLOBALS['umass'] = $rowData[0][3];
						}
				   }
				   $GLOBALS['totvoice'] = $totvoice;
				   $GLOBALS['totsms'] = $totsms;
				   $GLOBALS['totmass'] = $totmass;
				   
				   for ($row = 2; $row <= $highestRow-2; $row++){                 
					 $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
														NULL,
														TRUE,
														FALSE);
														
							$filesget = array(
									"pperiod" => $times,
									"pcluster"=> $rowData[0][0],
									"voice_pkg"=> ($rowData[0][1]/$GLOBALS['totvoice']*$GLOBALS['uvoice'])+$rowData[0][1],
									"sms_pkg"=> ($rowData[0][2]/$GLOBALS['totsms'] * $GLOBALS['usms'])+$rowData[0][2],
									"mass_oth"=> ($rowData[0][3]/$GLOBALS['totmass'] * $GLOBALS['umass'])+ $rowData[0][3],
									"ptype"=>$typo
						);
						//$data['exceldata'][] = (object) $filesget;
						$insert = $this->db->insert("clstrpkt_kpi", $filesget);
						
						if($insert){
							$this->session->set_flashdata('scupload', 'File successfully uploaded');
						}else{
							$this->session->set_flashdata('flupload', 'Upload failed. Please try again!');
						}
					}
			   }else if($typo == 'KPI_AXIS'){
					for ($row = 2; $row <= $highestRow-2; $row++){                 
					 $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
														NULL,
														TRUE,
														FALSE);	
						$totsms += $rowData[0][1];
						$totmass += $rowData[0][2];
						
				   }
					for ($row = 2; $row <= $highestRow-1; $row++){                 
					 $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
														NULL,
														TRUE,
														FALSE);	
						
						if($rowData[0][0] == 'UNKNOWN'){
							 $GLOBALS['usms'] = $rowData[0][1];
							 $GLOBALS['umass'] = $rowData[0][2];
						}
				   }
				   $GLOBALS['totsms'] = $totsms;
				   $GLOBALS['totmass'] = $totmass;
				   
				   /*echo $GLOBALS['totsms']."<br/>";
				   echo $GLOBALS['totmass']."<br/>";
				   
				   echo $GLOBALS['usms']."<br/>";
				   echo $GLOBALS['umass']."<br/>";
				   exit;
				   */
				  for ($row = 2; $row <= $highestRow-2; $row++){                 
					 $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
														NULL,
														TRUE,
														FALSE);
							$filesget = array(
									"pperiod" => $times,
									"pcluster"=> $rowData[0][0],
									"sms_pkg"=> ($rowData[0][1]/$GLOBALS['totsms'] * $GLOBALS['usms'])+$rowData[0][1],
									"mass_oth"=> ($rowData[0][2]/$GLOBALS['totmass'] * $GLOBALS['umass'])+ $rowData[0][2],
									"ptype"=>$typo
						);
						
						//$data['exceldata'][] = (object) $filesget;
						$insert = $this->db->insert("clstrpkt_kpi", $filesget);
						
						if($insert){
							$this->session->set_flashdata('scupload', 'File successfully uploaded');
						}else{
							$this->session->set_flashdata('flupload', 'Upload failed. Please try again!');
						}
					}
			   }
		  }else{
			$this->session->set_flashdata('flupload', 'Please fill all of the form');
		  }
		  redirect('admin/kpi/cp/');
	}
	function cusubmit(){
		$typo = $this->input->post('kpi_type');
		$periode = $this->input->post('times');
		
		$fileName = time().$_FILES['file']['name'];
		
		if(!empty($typo) && !empty($periode) && !empty($fileName)){
		
			$ambil = explode("-",$periode);
				
			$date= $ambil[0];
			$month = $ambil[1];
			$year = $ambil[2];
			
			$times = $date."".$month."".$year;
			
			$config['upload_path'] = './assets/excelupload/';
			$config['file_name'] = $fileName;
			$config['allowed_types'] = 'xls|xlsx|csv';
			$config['max_size']        = 10000;
			
			$this->load->library('upload');
			$this->upload->initialize($config);
			
			if(! $this->upload->do_upload('file') )
				$this->upload->display_errors();
				
			$media = $this->upload->data('file');
			$inputFileName = './assets/excelupload/'.$media['file_name'];
			
			try {
				$inputFileType = IOFactory::identify($inputFileName);
				$objReader = IOFactory::createReader($inputFileType);
				$objPHPExcel = $objReader->load($inputFileName);
			}catch(Exception $e) {
				die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
			}

			$sheet = $objPHPExcel->getSheet(0);
			$highestRow = $sheet->getHighestRow();
			$highestColumn = $sheet->getHighestColumn();
			
			$totvoice = 0;
			$totsms = 0;
			$totgprs = 0;
	
				for ($row = 2; $row <= $highestRow-2; $row++){                 
					 $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
														NULL,
														TRUE,
														FALSE);	
						$totvoice += $rowData[0][1];
						$totsms += $rowData[0][2];
						$totgprs += $rowData[0][3];
						
				 }
				for ($row = 2; $row <= $highestRow-1; $row++){                 
					 $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
														NULL,
														TRUE,
														FALSE);	
						
						if($rowData[0][0] == 'UNKNOWN'){
							//echo "Halo ".$rowData[0][1];
							 $GLOBALS['uvoice'] = $rowData[0][1];
							 $GLOBALS['usms'] = $rowData[0][2];
							 $GLOBALS['ugprs'] = $rowData[0][3];
						}
				   }
				   $GLOBALS['totvoice'] = $totvoice;
				   $GLOBALS['totsms'] = $totsms;
				   $GLOBALS['totgprs'] = $totgprs;
				   
				   for ($row = 2; $row <= $highestRow-2; $row++){                 
					 $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
														NULL,
														TRUE,
														FALSE);
														
							$filesget = array(
									"uperiod" => $times,
									"ucluster"=> $rowData[0][0],
									"uvoice_usg"=> ($rowData[0][1]/$GLOBALS['totvoice']*$GLOBALS['uvoice'])+$rowData[0][1],
									"usms_usg"=> ($rowData[0][2]/$GLOBALS['totsms'] * $GLOBALS['usms'])+$rowData[0][2],
									"ugprs"=> ($rowData[0][3]/$GLOBALS['totgprs'] * $GLOBALS['ugprs'])+ $rowData[0][3],
									"utype"=>$typo
						);
						//$data['exceldata'][] = (object) $filesget;
						$insert = $this->db->insert("clstrusage_kpi", $filesget);
						
						if($insert){
							$this->session->set_flashdata('scupload', 'File successfully uploaded');
						}else{
							$this->session->set_flashdata('flupload', 'Upload failed. Please try again!');
					}
				}
			}else{
				$this->session->set_flashdata('flupload', 'Please fill all of the form');
		  }
		  //$data['page'] = "admin/kpipacket_upload";
		 // $this->load->view("admin/container", $data);
		  redirect('admin/kpi/cu/');
	}
	function swpsubmit(){
		$typo = $this->input->post('kpi_type');
		$periode = $this->input->post('times');
		
		$fileName = time().$_FILES['file']['name'];
		
		if(!empty($typo) && !empty($periode) && !empty($fileName)){
		
			$ambil = explode("-",$periode);
				
			$date= $ambil[0];
			$month = $ambil[1];
			$year = $ambil[2];
			
			$times = $date."".$month."".$year;
			
			
			$config['upload_path'] = './assets/excelupload/';
			$config['file_name'] = $fileName;
			$config['allowed_types'] = 'xls|xlsx|csv';
			$config['max_size']        = 10000;
			
			$this->load->library('upload');
			$this->upload->initialize($config);
			
			if(! $this->upload->do_upload('file') )
				$this->upload->display_errors();
				
			$media = $this->upload->data('file');
			$inputFileName = './assets/excelupload/'.$media['file_name'];
			
			try {
				$inputFileType = IOFactory::identify($inputFileName);
				$objReader = IOFactory::createReader($inputFileType);
				$objPHPExcel = $objReader->load($inputFileName);
			} catch(Exception $e) {
				die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
			}

			$sheet = $objPHPExcel->getSheet(0);
			$highestRow = $sheet->getHighestRow();
			$highestColumn = $sheet->getHighestColumn();
			
			$totandroid = 0;
			$totbb = 0;
			$totbb151 = 0;
			$totcyborg = 0;
			$totgaruda = 0;
			$totinet = 0;
			$totinet151 = 0;
			$totmass151 = 0;
			$totpr = 0;
			$totsmphn = 0;
			$totvas151 = 0;
			$totbebas = 0;
			$totxon = 0;
			
			if($typo == 'KPI_XL'){
				for ($row = 2; $row <= $highestRow-2; $row++){                 
					 $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
														NULL,
														TRUE,
														FALSE);	
						if($rowData[0][1] == NULL){
							$rowData[0][1] = 0;
						}if($rowData[0][2] == NULL){
							$rowData[0][2] = 0;
						}if($rowData[0][3] == NULL){
							$rowData[0][3] = 0;
						}if($rowData[0][4] == NULL){
							$rowData[0][4] == 0;
						}if($rowData[0][5] == NULL){
							$rowData[0][5] == 0;
						}if($rowData[0][6] == NULL){
							$rowData[0][6] = 0;
						}if($rowData[0][7] == NULL){
							$rowData[0][7] = 0;
						}if($rowData[0][8] == NULL){
							$rowData[0][8] = 0;
						}if($rowData[0][9] == NULL){
							$rowData[0][9] = 0;
						}if($rowData[0][10] == NULL){
							$rowData[0][10] = 0;
						}if($rowData[0][11] == NULL){
							$rowData[0][11] = 0;
						}if($rowData[0][12] == NULL){
							$rowData[0][12] = 0;
						}if($rowData[0][13] == NULL){
							$rowData[0][13] = 0;
						}
						
						$totandroid += $rowData[0][1];
						$totbb += $rowData[0][2];
						$totbb151 += $rowData[0][3];
						$totcyborg += $rowData[0][4];
						$totgaruda += $rowData[0][5];
						$totinet += $rowData[0][6];
						$totinet151 += $rowData[0][7];
						$totmass151 += $rowData[0][8];
						$totpr += $rowData[0][9];
						$totsmphn += $rowData[0][10];
						$totvas151 += $rowData[0][11];
						$totbebas += $rowData[0][12];
						$totxon += $rowData[0][13];
						
				 }
				for ($row = 2; $row <= $highestRow-1; $row++){                 
					 $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
														NULL,
														TRUE,
														FALSE);	
						
						if($rowData[0][0] == 'UNKNOWN'){
							 $GLOBALS['uandroid'] = $rowData[0][1];
							 $GLOBALS['ubb'] = $rowData[0][2];
							 $GLOBALS['ubb151'] = $rowData[0][3];
							 $GLOBALS['ucyborg'] = $rowData[0][4];
							 $GLOBALS['ugaruda'] = $rowData[0][5];
							 $GLOBALS['uinet'] = $rowData[0][6];
							 $GLOBALS['uinet151'] = $rowData[0][7];
							 $GLOBALS['umass151'] = $rowData[0][8];
							 $GLOBALS['upr'] = $rowData[0][9];
							 $GLOBALS['usmphn'] = $rowData[0][10];
							 $GLOBALS['uvas151'] = $rowData[0][11];
							 $GLOBALS['ubebas'] = $rowData[0][12];
							 $GLOBALS['uxon'] = $rowData[0][13];
							
						}
				   }
				   $GLOBALS['totandroid'] = $totandroid;
				   $GLOBALS['totbb'] = $totbb;
				   $GLOBALS['totbb151'] = $totbb151;
				   $GLOBALS['totcyborg'] = $totcyborg;
				   $GLOBALS['totgaruda'] = $totgaruda;
				   $GLOBALS['totinet'] = $totinet;
				   $GLOBALS['totinet151'] = $totinet151;
				   $GLOBALS['totmass151'] = $totmass151;
				   $GLOBALS['totpr'] = $totpr;
				   $GLOBALS['totsmphn'] = $totsmphn;
				   $GLOBALS['totvas151'] = $totvas151;
				   $GLOBALS['totbebas'] = $totbebas;
				   $GLOBALS['totxon'] = $totxon;
				   ///
				   
				   if($GLOBALS['totpr'] == 0){
						$GLOBALS['totpr'] = 1;
				   }else if($GLOBALS['totbb'] == 0){
						$GLOBALS['totbb'] == 1;
				   }
				   else if($GLOBALS['totbb151'] == 0){
						$GLOBALS['totbb151'] == 1;
				   }
				   else if($GLOBALS['totcyborg'] == 0){
						$GLOBALS['totcyborg'] == 1;
				   }
				   else if($GLOBALS['totgaruda'] == 0){
						$GLOBALS['totgaruda'] == 1;
				   }
				   else if($GLOBALS['totinet'] == 0){
						$GLOBALS['totinet'] == 1;
				   }
				   else if($GLOBALS['totinet151'] == 0){
						$GLOBALS['totinet151'] == 1;
				   }
				   else if($GLOBALS['totmass151'] == 0){
						$GLOBALS['totmass151'] == 1;
				   }
				   else if($GLOBALS['totsmphn'] == 0){
						$GLOBALS['totsmphn'] == 1;
				   }
				   else if($GLOBALS['totvas151'] == 0){
						$GLOBALS['totvas151'] == 1;
				   }
				   else if($GLOBALS['totbebas'] == 0){
						$GLOBALS['totbebas'] == 1;
				   }
				   else if($GLOBALS['totxon'] == 0){
						$GLOBALS['totxon'] == 1;
				   }
				  
				   for ($row = 2; $row <= $highestRow-2; $row++){                 
					 $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
														NULL,
														TRUE,
														FALSE);
														
							$filesget = array(
									"speriod" => $times,
									"rowlabels"=> $rowData[0][0],
									"swp_android"=> ($rowData[0][1]/$GLOBALS['totandroid'] * $GLOBALS['uandroid'])+$rowData[0][1],
									"swp_blackberry"=> ($rowData[0][2]/ $GLOBALS['totbb'] * $GLOBALS['ubb'])+ $rowData[0][2],
									"swp_blackberry151"=> ($rowData[0][3]/$GLOBALS['totbb151'] * $GLOBALS['ubb151'])+ $rowData[0][3],
									"swp_cyborg"=> ($rowData[0][4]/$GLOBALS['totcyborg'] * $GLOBALS['ucyborg'])+ $rowData[0][4],
									"swp_garuda"=> ($rowData[0][5]/$GLOBALS['totgaruda'] * $GLOBALS['ugaruda'])+ $rowData[0][5],
									"swp_internet"=> ($rowData[0][6]/$GLOBALS['totinet'] * $GLOBALS['uinet'])+ $rowData[0][6],
									"swp_internet151"=> ($rowData[0][7]/$GLOBALS['totinet151'] * $GLOBALS['uinet151'])+ $rowData[0][7],
									"swp_mass151"=> ($rowData[0][8]/ $GLOBALS['totmass151'] * $GLOBALS['umass151'])+ $rowData[0][8],
									"swp_premiumrush"=> ($rowData[0][9]/$GLOBALS['totpr'] * $GLOBALS['upr'])+ $rowData[0][9],
									"swp_smarthphone"=> ($rowData[0][10]/$GLOBALS['totsmphn'] * $GLOBALS['usmphn'])+ $rowData[0][10],
									"swp_vas151"=> ($rowData[0][11]/$GLOBALS['totvas151'] * $GLOBALS['uvas151'])+ $rowData[0][11],
									"swp_xlbebas"=> ($rowData[0][12]/ $GLOBALS['totbebas'] * $GLOBALS['ubebas'])+ $rowData[0][12],
									"swp_xtraon"=> ($rowData[0][13]/$GLOBALS['totxon'] * $GLOBALS['uxon'])+ $rowData[0][13],
									"swp_type"=>$typo
						);
						//$data['exceldata'][] = (object) $filesget;
						$insert = $this->db->insert("mdsrev_kpi", $filesget);
						
						if($insert){
							$this->session->set_flashdata('scupload', 'File successfully uploaded');
						}else{
							$this->session->set_flashdata('flupload', 'Upload failed. Please try again!');
						}
					}
			   }else if($typo == 'KPI_AXIS'){
					for ($row = 2; $row <= $highestRow-2; $row++){                 
					 $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
														NULL,
														TRUE,
														FALSE);	
						$totbb += $rowData[0][1];
						$totbb151 += $rowData[0][2];
						$totinet += $rowData[0][3];
						$totinet151 += $rowData[0][4];
						$totvas151 += $rowData[0][5];
						
				   }
					for ($row = 2; $row <= $highestRow-1; $row++){                 
					 $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
														NULL,
														TRUE,
														FALSE);	
						
						if($rowData[0][0] == 'UNKNOWN'){
							 $GLOBALS['ubb'] = $rowData[0][1];
							 $GLOBALS['ubb151'] = $rowData[0][2];
							 $GLOBALS['uinet'] = $rowData[0][3];
							 $GLOBALS['uinet151'] = $rowData[0][4];
							 $GLOBALS['uvas151'] = $rowData[0][5];
						}
				   }
				   $GLOBALS['totbb'] = $totbb;
				   $GLOBALS['totbb151'] = $totbb151;
				   $GLOBALS['totinet'] = $totinet;
				   $GLOBALS['totinet151'] = $totinet151;
				   $GLOBALS['totvas151'] = $totvas151;
				  
				  for ($row = 2; $row <= $highestRow-2; $row++){                 
					 $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
														NULL,
														TRUE,
														FALSE);
							$filesget = array(
									"speriod" => $times,
									"rowlabels"=> $rowData[0][0],
									"swp_blackberry"=> ($rowData[0][1]/$GLOBALS['totbb'] * $GLOBALS['ubb'])+$rowData[0][1],
									"swp_blackberry151"=> ($rowData[0][2]/$GLOBALS['totbb151'] * $GLOBALS['ubb151'])+ $rowData[0][2],
									"swp_internet"=> ($rowData[0][3]/$GLOBALS['totinet'] * $GLOBALS['uinet'])+ $rowData[0][3],
									"swp_internet151"=> ($rowData[0][4]/$GLOBALS['totinet151'] * $GLOBALS['uinet151'])+ $rowData[0][4],
									"swp_vas151"=> ($rowData[0][5]/$GLOBALS['totvas151'] * $GLOBALS['uvas151'])+ $rowData[0][5],
									"swp_type"=>$typo
						);
						
						//$data['exceldata'][] = (object) $filesget;
						$insert = $this->db->insert("mdsrev_kpi", $filesget);
						
						if($insert){
							$this->session->set_flashdata('scupload', 'File successfully uploaded');
						}else{
							$this->session->set_flashdata('flupload', 'Upload failed. Please try again!');
						}
					}
			   }
		  }else{
			$this->session->set_flashdata('flupload', 'Please fill all of the form');
		  }
		 // $data['page'] = "admin/kpipacket_upload";
		  //$this->load->view("admin/container", $data);
		  redirect('admin/kpi/swp/');
	}
	function data(){
		$data['page'] = "admin/data_kpi";
		$this->load->view('admin/container', $data);
	}
	function ajaxsubmit(){
		$periode = $this->input->post('times');
		$type = $this->input->post('kpi_type');
		$kpiname = $this->input->post('cs_type');
		
		$ambil = explode("-",$periode);
				
		$date= $ambil[0];
		$month = $ambil[1];
		$year = $ambil[2];
		
		$times = $date."".$month."".$year;
			
		if($kpiname == 'cp'){
			$data['data_kpi'] = $this->mread->baca_data_kpi($times, $type, $kpiname);
			$data['data_total'] = $this->mread->baca_sum_data_kpi($times, $type, $kpiname);
			$this->load->view('admin/kpi_paket_data', $data);
			
		}else if($type == 'cu'){
			$this->load->model();	
		}else if($type == 'swp'){
		}
		
	}
	function logout(){
			$this->session->unset_userdata('username');
			$this->session->unset_userdata('is_logged_in');
			$this->session->unset_userdata('tipe');
			redirect('admin/login'); 
	}
	function is_logged_in(){
			$is_logged_in = $this->session->userdata('is_logged_in');
			$tipe = $this->session->userdata('tipe');
			
			if(!isset($is_logged_in) || $is_logged_in != true || $tipe != "admin"){
				$this->session->set_flashdata('msg', 'Access denied! You don\'t have permission to access this page or session has expired. Please use login form!');
				redirect('admin/login');	
			}
	}
}


/*

SELECT 
SUM(p.voice_pkg + u.uvoice_usg) AS svoice, 
SUM(p.sms_pkg + u.usms_usg) AS ssms,			 
SUM((m.swp_blackberry+m.swp_blackberry151+m.swp_internet+m.swp_internet151+m.swp_cyborg+m.swp_garuda+m.swp_premiumrush+m.swp_smarthphone+m.swp_xlbebas+m.swp_xtraon) + u.ugprs) AS sdata,
SUM(p.mass_oth + m.swp_mass151) AS sother,
SUM((p.voice_pkg + u.uvoice_usg)+(p.sms_pkg + u.usms_usg)+((m.swp_blackberry+m.swp_blackberry151+m.swp_internet+m.swp_internet151+m.swp_cyborg+m.swp_garuda+m.swp_premiumrush+m.swp_smarthphone+m.swp_xlbebas+m.swp_xtraon) + u.ugprs)
+(p.mass_oth + m.swp_mass151)) AS stotal,
p.pperiod
			FROM
			clstrpkt_kpi p, clstrusage_kpi u, mdsrev_kpi m
			WHERE (Substr(p.pperiod, 3,6)) = '032015'
			AND (Substr(u.uperiod, 3,6)) = '032015'
			AND (Substr(m.speriod, 3,6)) = '032015'
			AND u.ucluster LIKE 'E%'
			AND p.pcluster LIKE 'E%'
			AND m.rowlabels LIKE 'E%'
			AND u.ucluster = p.pcluster
			AND u.ucluster = m.rowlabels
			AND u.utype = 'KPI_XL'
			AND p.ptype = 'KPI_XL'
			AND m.swp_type = 'KPI_XL'*/
