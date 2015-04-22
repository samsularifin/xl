<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kpi extends CI_Controller {
	function __construct(){
			parent::__construct();
			$this->is_logged_in();
			
			$this->load->model('internal/mread');
			$this->load->model('internal/mkpitrending');
			$this->load->model('internal/mkpicompare');
	}
	function index(){
		$data['page'] = "admin/uploadrevkpi";
		$this->load->view('admin/container', $data);
	}
	function trending(){
		if($this->session->userdata('log_level') == 'East'){
			$data['level'] = $this->mread->kpi_level();
		}else if($this->session->userdata('log_level') == 'East 1' || $this->session->userdata('log_level') == 'East 2'){
			$data['level'] = $this->mread->kpi_leveleast();
		}
		else{
			$data['level'] = $this->mread->kpi_levelgreater($this->session->userdata('log_level'));
		}
		$data['category'] = $this->mread->kpi_data();
		$data['page'] = "internal/kpi_trending";
		$this->load->view('internal/container', $data);
		
	}
	function showregion(){
		$data['region'] = $this->mread->showkpiregion();	
		$this->load->view('internal/region_kpi_hide', $data);
	}
	function showsubregion(){
		$data['subregion'] = $this->mread->showkpisubregion();	
		$this->load->view('internal/subregion_kpi_hide', $data);
	}
	function shownascluster(){
		$level = $this->session->userdata('log_level');
		
		if($level == 'East' || $level == 'East 1' || $level == 'East 2'){
			$data['nascluster'] = $this->mread->shownascluster();
		}else{
			$data['greatercluster'] = $this->mread->showgreatercluster($level);
		}	
		$this->load->view('internal/nas_cluster_hide', $data);
	}
	function tsubmit(){
		
			$level = $this->input->post('level');
			$bts_type = $this->input->post('bts_type');
			$cat_data = $this->input->post('cat_data');
			$charttype = $this->input->post('chart_type');
			
			
			$buper = $this->input->post('buper');
			$buter = $this->input->post('buter');
			
			$date = $buper." - ".$buter;
			//$date = $this->input->post('growthrange');
			$split = explode('-', $date);
			
			$begindate = $split[0];
			$lastdate = $split[1];
			
			$splitagain = explode('/', $begindate);
			$bmonth = $splitagain[0];
			$byear = $splitagain[1];
			
			$getfdate = $bmonth."".$byear;
			
			$andagain = explode('/', $lastdate);
			$lmonth = $andagain[0];
			$lyear = $andagain[1];
			
			$getldate = $lmonth."".$lyear;
			
			$data['getlevel'] = $level;
			$data['getfdate'] = $getfdate;
			$data['getldate'] = $getldate;
			
			//$data['indatatype'] = $datatype;
			$data['inperiod'] = $date;
			$data['inchart'] = $charttype;
			$data['inbts_type'] = $bts_type;
			
			$data['first_only_month'] = $bmonth;
			$data['first_only_year'] = $byear;
			
			$data['last_only_year'] = $lmonth;
			$data['last_only_year'] = $lyear;
			
			$data['buper'] = $buper;
			$data['buter'] = $buter;

				
			if($level == 'region'){
				$rname = $this->input->post('regionselected');
		
				$fq = $this->mkpitrending->fget_first_step_region($rname, $getfdate, $getldate, $bts_type);
				$data['fq'] = $this->mkpitrending->fget_first_step_region($rname, $getfdate, $getldate, $bts_type);
				
				if(count($fq)>0)
				{
					//echo "HALO";
					foreach ($fq as $row)
					{
					   // echo $row->name; # THIS WORKS
						$getperiod = $row->pperiod; 
						//echo $getperiod;
						
						$data['second_query'][] = $this->mkpitrending->query_region($rname, $getperiod, $bts_type);
						
						if($bts_type == 'KPI_AXISXL'){
							$data['third_query'][] = $this->mkpitrending->query_region_second($rname, $getperiod, $bts_type);
						}
						# THIS DOES NOT WORK
					}
					//echo json_encode($data);
					//exit;
						
				}
				
			}else if($level == 'sregion'){
				$sname = $this->input->post('subregionselected');
				
				$fq = $this->mkpitrending->fget_first_step_region($sname, $getfdate, $getldate, $bts_type);
				$data['fq'] = $this->mkpitrending->fget_first_step_region($sname, $getfdate, $getldate, $bts_type);
				
				if (count($fq) >0)
				{
					//echo "HALO";
					foreach ($fq as $row)
					{
					   // echo $row->name; # THIS WORKS
						$getperiod = $row->pperiod; 
						//echo $getperiod;
						
						$data['second_query'][] = $this->mkpitrending->query_region($sname, $getperiod, $bts_type);
						
						if($bts_type == 'KPI_AXISXL'){
							$data['third_query'][] = $this->mkpitrending->query_region_second($sname, $getperiod, $bts_type);
						}# THIS DOES NOT WORK
					}
					//echo json_encode($data);
					//exit;
						
				}
				
			}else if($level == 'cluster'){
				$sname = $this->input->post('cselected');
				
				$fq = $this->mkpitrending->fget_first_step_region($sname, $getfdate, $getldate, $bts_type);
				$data['fq'] = $this->mkpitrending->fget_first_step_region($sname, $getfdate, $getldate, $bts_type);
				
				if (count($fq) >0)
				{
					//echo "HALO";
					foreach ($fq as $row)
					{
					   // echo $row->name; # THIS WORKS
						$getperiod = $row->pperiod; 
						//echo $getperiod;
						
						$data['second_query'][] = $this->mkpitrending->query_region($sname, $getperiod, $bts_type);
						if($bts_type == 'KPI_AXISXL'){
							$data['third_query'][] = $this->mkpitrending->query_region_second($sname, $getperiod, $bts_type);
						}
						# THIS DOES NOT WORK
					}
					//echo json_encode($data);
					//exit;
						
				}
				
			}
			
		$this->load->view('internal/kpi_trending_result', $data);
	}
	function compare(){
		if($this->session->userdata('log_level') == 'East'){
			$data['level'] = $this->mread->kpi_level();
		}else if($this->session->userdata('log_level') == 'East 1' || $this->session->userdata('log_level') == 'East 2'){
			$data['level'] = $this->mread->kpi_leveleast();
		}
		else{
			$data['level'] = $this->mread->kpi_levelgreater($this->session->userdata('log_level'));
		}
		$data['category'] = $this->mread->kpi_data();
		$data['page'] = "internal/kpi_compare";
		$this->load->view('internal/container', $data);
	}
	function csubmit(){
		
			$level = $this->input->post('level');
			$bts_type = $this->input->post('bts_type');
			$cat_data = $this->input->post('cat_data');
			$charttype = $this->input->post('chart_type');
			
			
			$buper = $this->input->post('buper');
			$buter = $this->input->post('buter');
			
			$date = $buper." - ".$buter;
			//$date = $this->input->post('growthrange');
			$split = explode('-', $date);
			
			$begindate = $split[0];
			$lastdate = $split[1];
			
			$splitagain = explode('/', $begindate);
			$bmonth = $splitagain[0];
			$byear = $splitagain[1];
			
			$getfdate = $bmonth."".$byear;
			
			$andagain = explode('/', $lastdate);
			$lmonth = $andagain[0];
			$lyear = $andagain[1];
			
			$getldate = $lmonth."".$lyear;
			
			$data['getlevel'] = $level;
			$data['getfdate'] = $getfdate;
			$data['getldate'] = $getldate;
			
			//$data['indatatype'] = $datatype;
			$data['inperiod'] = $date;
			$data['inchart'] = $charttype;
			$data['inbts_type'] = $bts_type;
			
			$data['first_only_month'] = $bmonth;
			$data['first_only_year'] = $byear;
			
			$data['last_only_year'] = $lmonth;
			$data['last_only_year'] = $lyear;
			
			$data['buper'] = $buper;
			$data['buter'] = $buter;

				
			if($level == 'region'){
				$rname = $this->input->post('regionselected');
		
				$fq = $this->mkpicompare->fget_first_step_region($getfdate, $getldate, $bts_type);
				$data['fq'] = $this->mkpicompare->fget_first_step_region($getfdate, $getldate, $bts_type);
				
				if(count($fq)>0)
				{
					//echo "HALO";
					foreach ($fq as $row)
					{
					   // echo $row->name; # THIS WORKS
						$getperiod = $row->pperiod; 
						//echo $getperiod;
						
						$data['second_query'][] = $this->mkpicompare->query_region($rname, $getperiod, $bts_type);
						
						if($bts_type == 'KPI_AXISXL'){
							$data['third_query'][] = $this->mkpicompare->query_region_second($rname, $getperiod, $bts_type);
						}
						# THIS DOES NOT WORK
					}
					//echo json_encode($data);
					//exit;
						
				}
				
			}else if($level == 'sregion'){
				$sname = $this->input->post('subregionselected');
				
				$fq = $this->mkpicompare->fget_first_step_region($getfdate, $getldate, $bts_type);
				$data['fq'] = $this->mkpicompare->fget_first_step_region($getfdate, $getldate, $bts_type);
				
				if (count($fq) >0)
				{
					//echo "HALO";
					foreach ($fq as $row)
					{
					   // echo $row->name; # THIS WORKS
						$getperiod = $row->pperiod; 
						//echo $getperiod;
						
						$data['second_query'][] = $this->mkpicompare->query_region($sname, $getperiod, $bts_type);
						
						if($bts_type == 'KPI_AXISXL'){
							$data['third_query'][] = $this->mkpicompare->query_region_second($sname, $getperiod, $bts_type);
						}# THIS DOES NOT WORK
					}
					//echo json_encode($data);
					//exit;
						
				}
				
			}else if($level == 'cluster'){
				$sname = $this->input->post('cselected');
				
				$fq = $this->mkpicompare->fget_first_step_region($getfdate, $getldate, $bts_type);
				$data['fq'] = $this->mkpicompare->fget_first_step_region($getfdate, $getldate, $bts_type);
				
				if (count($fq) >0)
				{
					//echo "HALO";
					foreach ($fq as $row)
					{
					   // echo $row->name; # THIS WORKS
						$getperiod = $row->pperiod; 
						//echo $getperiod;
						
						$data['second_query'][] = $this->mkpicompare->query_region($sname, $getperiod, $bts_type);
						if($bts_type == 'KPI_AXISXL'){
							$data['third_query'][] = $this->mkpicompare->query_region_second($sname, $getperiod, $bts_type);
						}
						# THIS DOES NOT WORK
					}
					//echo json_encode($data);
					//exit;
						
				}
				
			}/*else if($level == 'allcluster'){
				$fq = $this->mkpicompare->fget_first_step_region($getfdate, $getldate, $bts_type);
				$data['fq'] = $this->mkpicompare->fget_first_step_region($getfdate, $getldate, $bts_type);
				
				//if (count($fq) >0)
				//{
					//echo "HALO";
					$grcluster = $this->mread->showgreatercluster($this->session->userdata('log_level'));
					$data['grcluster'] = $this->mread->showgreatercluster($this->session->userdata('log_level'));
					
					if (count($grcluster) >0){
						foreach($grcluster as $grclstr){
							$clstr = $grclstr->cluster;
							
							foreach ($fq as $row)
							{
							   // echo $row->name; # THIS WORKS
								$getperiod = $row->pperiod; 
								//echo $getperiod;
								
								$data['second_query'][] = $this->mkpicompare->query_region($clstr, $getperiod, $bts_type);
								if($bts_type == 'KPI_AXISXL'){
									$data['third_query'][] = $this->mkpicompare->query_region_second($clstr, $getperiod, $bts_type);
								}
								# THIS DOES NOT WORK
							}
						}
					//echo json_encode($data);
					//exit;
					}
						
				//}
				$this->load->view('internal/kpi_compare_allcluster', $data);
			}*/
		//if($level != 'allcluster'){	
			$this->load->view('internal/kpi_compare_result', $data);
		//}
	}
	function data(){
		$data['page'] = "admin/data_kpi";
		$this->load->view('admin/container', $data);
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
			
			if(!isset($is_logged_in) || $is_logged_in != true || $tipe != "internal"){
				$this->session->set_flashdata('msg', 'Access denied! You don\'t have permission to access this page or session has expired. Please use login form!');
				redirect('internal/login');	
			}
	}
}