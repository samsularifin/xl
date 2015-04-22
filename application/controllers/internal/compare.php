<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Compare extends CI_Controller {
	function __construct(){
			parent::__construct();
			$this->is_logged_in();
			$this->load->model('internal/mread');
			$this->load->model('internal/mcompare');
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
		$data['page'] = "internal/compare";
		
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

				
			if($level == 'East'){
				$parameter = 'East';
				$data['first_step'] = $this->mcompare->first_step_east();
				$data['first_query'] = $this->mcompare->query_east($parameter, $datatype,$getfdate, $bts_type);
				$data['second_query'] = $this->mcompare->query_east2($parameter, $datatype, $getldate,  $bts_type);
				$data['first_pei_chart'] = $this->mcompare->query_pie_first_east($parameter, $datatype, $getfdate,  $bts_type);
				$data['second_pei_chart'] = $this->mcompare->query_pie_second_east($parameter, $datatype, $getldate,  $bts_type);
				
			}else if($level == 'East 1'){
				$parameter = 'East 1';
				
				$data['first_step'] = $this->mcompare->first_step_east1($parameter);
				$data['first_query'] = $this->mcompare->query_east_1_1($parameter, $datatype,$getfdate, $bts_type);
				$data['second_query'] = $this->mcompare->query_east_1_2($parameter, $datatype, $getldate, $bts_type);
				$data['first_pei_chart'] = $this->mcompare->query_pie_first_east1($parameter, $datatype,$getfdate, $bts_type);
				$data['second_pei_chart'] = $this->mcompare->query_pie_second_east1($parameter, $datatype, $getldate, $bts_type);
			}else if($level == 'East 2'){
				$parameter = 'East 2';
				
				$data['first_step'] = $this->mcompare->first_step_east1($parameter);
				$data['first_query'] = $this->mcompare->query_east_1_1($parameter, $datatype,$getfdate, $bts_type);
				$data['second_query'] = $this->mcompare->query_east_1_2($parameter, $datatype, $getldate, $bts_type);
				$data['first_pei_chart'] = $this->mcompare->query_pie_first_east1($parameter, $datatype,$getfdate, $bts_type);
				$data['second_pei_chart'] = $this->mcompare->query_pie_second_east1($parameter, $datatype, $getldate, $bts_type);
			}
			else if($level == 'Cluster'){
				$parameter = 'Cluster';
				$namec = $this->input->post('cselected');
				$data['first_step'] = $this->mcompare->first_step_cluster($parameter, $namec);
				$data['first_query'] = $this->mcompare->query_cluster_1($namec, $datatype,$getfdate , $bts_type);
				$data['second_query'] = $this->mcompare->query_cluster_2($namec, $datatype, $getldate, $bts_type);
				$data['first_pei_chart'] = $this->mcompare->query_pie_first_cluster($namec, $datatype,$getfdate , $bts_type);
				$data['second_pei_chart'] = $this->mcompare->query_pie_second_cluster($namec, $datatype, $getldate, $bts_type);
			}
			else if($level == 'Kab'){
				$parameter = 'Kab';
				$kab = $this->input->post('kab');
				$pcluster = $this->input->post('pccluster');
				
				$data['first_step'] = $this->mcompare->first_step_kab($parameter, $kab, $pcluster);
				$data['first_query'] = $this->mcompare->query_kab_1($kab, $datatype,$getfdate, $pcluster, $bts_type);
				$data['second_query'] = $this->mcompare->query_kab_2($kab, $datatype, $getldate, $pcluster, $bts_type);
				$data['first_pei_chart'] = $this->mcompare->query_pie_first_kabupaten($kab, $datatype, $getfdate, $pcluster, $bts_type);
				$data['second_pei_chart'] = $this->mcompare->query_pie_second_kabupaten($kab, $datatype, $getldate, $pcluster, $bts_type);	
			
			}else if($level == 'Kec'){
				$parameter = 'Kec';
				$kec = $this->input->post('kec');
				$kab = $this->input->post('kab');
				$pcluster = $this->input->post('pcclusterkec');
				
				$data['first_step'] = $this->mcompare->first_step_kec($parameter, $kec, $kab, $pcluster);
				$data['first_query'] = $this->mcompare->query_kec_1($kec, $kab, $datatype,$getfdate, $pcluster, $bts_type);
				$data['second_query'] = $this->mcompare->query_kec_2($kec, $kab, $datatype, $getldate, $pcluster, $bts_type);
				$data['first_pei_chart'] = $this->mcompare->query_pie_first_kecamatan($kec, $kab, $datatype, $getfdate, $pcluster, $bts_type);
				$data['second_pei_chart'] = $this->mcompare->query_pie_second_kecamatan($kec, $kab, $datatype, $getldate, $pcluster, $bts_type);
				
			}else if($level == 'Tower_ID_adj'){
				$parameter = $this->input->post('tower');
				
				$data['first_step'] = $this->mcompare->first_tower_id($parameter);
				$data['first_query'] = $this->mcompare->tower_id_1($parameter, $datatype, $getfdate, $bts_type);
				$data['second_query'] = $this->mcompare->tower_id_2($parameter, $datatype, $getldate, $bts_type);
				$data['first_pei_chart'] = $this->mcompare->query_pie_first_tower_id($parameter, $datatype, $getfdate, $bts_type);
				$data['second_pei_chart'] = $this->mcompare->query_pie_second_tower_id($parameter, $datatype, $getldate, $bts_type);
			}
		$this->load->view('internal/compare_hide', $data);
	}
	function showkabkec($kk){
		$data['ckab'] = $this->mread->kabkec(urldecode($kk));
		$this->load->view('internal/kab_hide', $data);
	}
	function showcluster(){
		$data['ccluster'] = $this->mread->ccluster();	
		$this->load->view('internal/cluster_hide', $data);
		
	}
	function showclusterkab($c){
		$data['pcluster'] = $this->mread->pcluster(urldecode($c));
		$this->load->view('internal/pcluster', $data);
	}
	function showkab(){
		$data['ckab'] = $this->mread->kab();	
		$this->load->view('internal/kab_hide', $data);
	}
	function showkec(){
		$data['ckec'] = $this->mread->kec();	
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