<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Trending extends CI_Controller {
	function __construct(){
			parent::__construct();
			$this->is_logged_in();
			$this->load->model('internal/mread');	
			$this->load->model('internal/mtrending');
	}
	public function index()
	{	
		if($this->session->userdata('log_level') == 'East'){
			$data['level'] = $this->mread->level();
		}else if($this->session->userdata('log_level') == 'East 1' || $this->session->userdata('log_level') == 'East 2'){
			$data['level'] = $this->mread->leveleast();
		}
		else{
			$data['level'] = $this->mread->levelgreater($this->session->userdata('log_level'));
		}
		$data['page'] = "internal/trending";
		
		$this->load->view('internal/container', $data);
	}
	function ajaxsubmit(){
		
			$level = $this->input->post('level');
			$moth = $this->input->post('m');
			$datatype = $this->input->post('data_type');
			$charttype = $this->input->post('chart_type');
			
			$bts_type = $this->input->post('bts_type');
			
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
			
			$data['indatatype'] = $datatype;
			$data['inperiod'] = $date;
			$data['inchart'] = $charttype;
			
			$data['first_only_month'] = $bmonth;
			$data['first_only_year'] = $byear;
			
			$data['last_only_year'] = $lmonth;
			$data['last_only_year'] = $lyear;
			
			$data['buper'] = $buper;
			$data['buter'] = $buter;

				
			if($level == 'East'){
				$parameter = 'East';
				$fq = $this->mtrending->fget_first_step_east($parameter, $getfdate, $getldate);
				$data['fq'] = $this->mtrending->fget_first_step_east($parameter, $getfdate, $getldate);
				
				if(count($fq)>0)
				{
					//echo "HALO";
					foreach ($fq as $row)
					{
					   // echo $row->name; # THIS WORKS
						$getperiod = $row->Period; 
						//echo $getperiod;
						
						$data['second_query'][] = $this->mtrending->query_east($parameter, $datatype, $getperiod, $bts_type);
						# THIS DOES NOT WORK
					}
					//echo json_encode($data);
					//exit;
						
				}
				
			}else if($level == 'East 1'){
				$parameter = 'East 1';
				
				$fq = $this->mtrending->fget_first_step_east($parameter, $getfdate, $getldate);
				$data['fq'] = $this->mtrending->fget_first_step_east($parameter, $getfdate, $getldate);
				
				if (count($fq) >0)
				{
					//echo "HALO";
					foreach ($fq as $row)
					{
					   // echo $row->name; # THIS WORKS
						$getperiod = $row->Period; 
						//echo $getperiod;
						
						$data['second_query'][] = $this->mtrending->query_east_1($parameter, $datatype, $getperiod, $bts_type);
						# THIS DOES NOT WORK
					}
					//echo json_encode($data);
					//exit;
						
				}
				
			}else if($level == 'East 2'){
				$parameter = 'East 2';
				
				$fq = $this->mtrending->fget_first_step_east($parameter, $getfdate, $getldate);
				$data['fq'] = $this->mtrending->fget_first_step_east($parameter, $getfdate, $getldate);
				
				if (count($fq) > 0)
				{
					//echo "HALO";
					foreach ($fq as $row)
					{
					   // echo $row->name; # THIS WORKS
						$getperiod = $row->Period; 
						//echo $getperiod;
						
						$data['second_query'][] = $this->mtrending->query_east_1($parameter, $datatype, $getperiod, $bts_type);
						# THIS DOES NOT WORK
					}
					//echo json_encode($data);
					//exit;
						
				}
				
			}
			else if($level == 'Cluster'){
				$parameter = 'Cluster';
				$namec = $this->input->post('cselected');
				$fq = $this->mtrending->first_step_query($getfdate, $getldate);
				
				$data['fq'] = $this->mtrending->first_step_query($getfdate, $getldate);
				if (count($fq) >0)
				{
					//echo "HALO";
					foreach ($fq as $row)
					{
					   // echo $row->name; # THIS WORKS
						$getperiod = $row->Period; 
						//echo $getperiod;
						
						$data['second_query'][] = $this->mtrending->second_step_cluster($parameter, $datatype, $getperiod, $namec, $bts_type);
						# THIS DOES NOT WORK
					}
					//echo json_encode($data);
					//exit;
						
				}
			}
			else if($level == 'Kab'){
				$parameter = 'Kab';
				$kab = $this->input->post('kab');
				$pcluster = $this->input->post('pccluster');
				
				$fq = $this->mtrending->first_step_query($getfdate, $getldate);
				$data['fq'] = $this->mtrending->first_step_query($getfdate, $getldate);
				
				if (count($fq))
				{
					//echo "HALO";
					foreach ($fq as $row)
					{
					   // echo $row->name; # THIS WORKS
						$getperiod = $row->Period; 
						//echo $getperiod;
						
						$data['second_query'][] = $this->mtrending->second_step_kab($parameter, $datatype, $getperiod, $kab, $pcluster, $bts_type);
						# THIS DOES NOT WORK
					}
					//echo json_encode($data);
					//exit;
						
				}
				
			}else if($level == 'Kec'){
				$parameter = 'Kec';
				$kec = $this->input->post('kec');
				$kab = $this->input->post('kab');
				$pcluster = $this->input->post('pcclusterkec');
				
				/*echo $parameter."<br/>";
				echo $kec."<br/>";
				echo $kab."<br/>";
				echo $pcluster."<br/>";
				exit;*/
				
				$fq = $this->mtrending->first_step_query($getfdate, $getldate);
				$data['fq'] = $this->mtrending->first_step_query($getfdate, $getldate);
				
				if (count($fq))
				{
					//echo "HALO";
					foreach ($fq as $row)
					{
					   // echo $row->name; # THIS WORKS
						$getperiod = $row->Period; 
						//echo $getperiod;
						
						$data['second_query'][] = $this->mtrending->second_step_kec($parameter, $datatype, $getperiod, $kec, $kab, $pcluster, $bts_type);
						# THIS DOES NOT WORK
					}
					//echo json_encode($data);
					//exit;
						
				}
				
			}else if($level == 'Tower_ID_adj'){
				$parameter = 'Tower_ID_adj';
				$tower = $this->input->post('tower');
				
				$fq = $this->mtrending->first_step_query($getfdate, $getldate);
				$data['fq'] = $this->mtrending->first_step_query($getfdate, $getldate);
				
				if (count($fq))
				{
					foreach ($fq as $row)
					{
						$getperiod = $row->Period; 
						$data['second_query'][] = $this->mtrending->second_step_tower_id($parameter, $datatype, $tower, $getperiod, $bts_type);
					}
				}
			}
			
			//jika selain east, east1 dan east 2, dibuatin variable sendiri pada saat query
		
				//$cluster = $this->input->post('cluster');
		
								
				//$data['firststep'] = $this->mread->getfirstcat($cluster,$level, $getfdate, $getldate);
		$this->load->view('internal/trending_result', $data);
	}
	function showcluster(){
		$data['ccluster'] = $this->mread->ccluster();	
		$this->load->view('internal/cluster_hide', $data);
		
	}
	function showclustergreater($gr){
		$data['ccluster'] = $this->mread->showgreatercluster(urldecode($gr));	
		$this->load->view('internal/cluster_hide', $data);
	}
	function showkabkec($kk){
		$data['ckab'] = $this->mread->kabkec(urldecode($kk));
		$this->load->view('internal/kab_kec_hide', $data);
	}
	function showclusterkab($c){
		$data['pcluster'] = $this->mread->pcluster(urldecode($c));
		$this->load->view('internal/pcluster', $data);
	}
	function showkabgreater($lev){
		$data['ckab'] = $this->mread->showgreaterkab(urldecode($lev));	
		$this->load->view('internal/kab_hide', $data);
	}
	function showclusterkec2($c){
		$data['pclusterkec'] = $this->mread->pcluster(urldecode($c));
		$this->load->view('internal/pclusterkec', $data);
	}
	function showkab(){
		$data['ckab'] = $this->mread->kab();	
		$this->load->view('internal/kab_hide', $data);
	}
	function showkec(){
		$data['ckec'] = $this->mread->kec();	
		$this->load->view('internal/kec_hide', $data);
	}
	function showkecgreater($kec){
		$data['ckec'] = $this->mread->greaterkec(urldecode($kec));	
		$this->load->view('internal/kec_hide', $data);
	}
	function showclusterkec($c){
		$data['pclusterkec'] = $this->mread->pclusterkec(urldecode($c));
		$this->load->view('internal/pclusterkec', $data);
	}
	function showtowerid(){
		$data['tower_id'] = $this->mread->tower_id();	
		$this->load->view('internal/tower_hide', $data);
	}
	function month($month){
		switch($month){
			case '01':
				return "January";
				 break;
			case '02':
				return "February";
				 break;
			case '03':
				return "March";
				 break;
			case '04':
				return "April";
				 break;
			case '05':
				return "May";
				 break;
			case '06':
				return "June";
				 break;
			case '07':
				return "July";
				 break;
			case '08':
				return "August";
				 break;
			case '09':
				return "September";
				 break;
			case '10':
				return "October";
				 break;
			case '11':
				return "November";
				 break;
			case '12':
				return "December";
				 break;
			default:
				echo "Cannot find Month";
			
		}
	}
	function logout(){
			$this->session->unset_userdata('username');
			$this->session->unset_userdata('is_logged_in');
			$this->session->unset_userdata('tipe');
			redirect('internal/login'); 
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