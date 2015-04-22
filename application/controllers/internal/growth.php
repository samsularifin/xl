<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Compare extends CI_Controller {
	function __construct(){
			parent::__construct();
			$this->is_logged_in();
			$this->load->model('internal/mread');	
	}
	public function index()
	{	$level = $this->session->userdata('log_level');
	
		if($level == 'East' || $level  == 'East 1' || $level == 'East 2'){
			$data['ccluster'] = $this->mread->ccluster();
		}
		else{
			$data['ccluster'] = $this->mread->showgreatercluster($level);
		}
		$data['ccluster'] = $this->mread->ccluster();
		$data['page'] = "internal/compare";
		
		/* begin */
		if(!empty($this->input->post('cluster'))){
		
		$cluster = $this->input->post('cluster');
		$level = $this->input->post('level');
		
		//$data['month_selected'] =$this->month('02');
		
		
		$date = $this->input->post('growthrange');
		$split = explode('-', $date);
		
		$begindate = $split[0];
		$lastdate = $split[1];
		
		$splitagain = explode('/', $begindate);
		$bdate = $splitagain[0];
		$bmonth = $splitagain[1];
		$byear = $splitagain[2];
		
		$getfdate = $bdate."".$bmonth."".$byear;
		
		$andagain = explode('/', $lastdate);
		$ldate = $andagain[0];
		$lmonth = $andagain[1];
		$lyear = $andagain[2];
		
		$getldate = $ldate."".$lmonth."".$lyear;
		
		$data['getcluster'] = $cluster;
		$data['getlevel'] = $level;
		$data['getfdate'] = $getfdate;
		$data['getldate'] = $getldate;
		
		
		$data['incluster'] = $cluster;
		$data['inlevel'] = $level;
		$data['inperiod'] = $date;
		
		$data['firststep'] = $this->mread->getfirstcat($cluster,$level, $getfdate, $getldate);
		}
		/* end */
		$this->load->view('internal/container', $data);
	}
	function show(){
		redirect('internal/growth/');
		
		
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