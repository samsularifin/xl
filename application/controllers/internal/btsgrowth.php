<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Btsgrowth extends CI_Controller {
	function __construct(){
			parent::__construct();
			$this->is_logged_in();
			$this->load->model('internal/mread');
			$this->load->model('internal/mbtsgrowth');
	}
	public function index()
	{	
		$level = $this->session->userdata('log_level');
	
		if($level == 'East' || $level  == 'East 1' || $level == 'East 2'){
			$data['ccluster'] = $this->mread->ccluster();
		}
		else{
			$data['ccluster'] = $this->mread->showgreatercluster($level);
		}
		//$data['ccluster'] = $this->mread->ccluster();
		$data['page'] = "internal/btsgrowth";
		
		$this->load->view('internal/container', $data);
	}
	function ajaxsubmit(){
		/* begin */
		
		if(!empty($this->input->post('cluster'))){
		
		$cluster = $this->input->post('cluster');
		$level = $this->input->post('level');
		
		$bts_type = $this->input->post('bts_type');
		
		$buper = $this->input->post('buper');
		$buter = $this->input->post('buter');
		
	/*	echo $buper."<br/>";
		echo $buter."<br/>";
		exit;*/
		
		$date = $buper." - ".$buter;
		/*echo $date."<br/>";
		
		$date = $this->input->post('growthrange');
		echo $date;
		exit;*/
		$split = explode('-', $date);
		
		$begindate = $split[0];
		$lastdate = $split[1];
		
		$splitagain = explode('/', $begindate);
		$bmonth = $splitagain[0];
		$byear = $splitagain[1];
		//$bdate = $splitagain[0];
		//$bmonth = $splitagain[1];
	//	$byear = $splitagain[2];
		
		$getfdate = $bmonth."".$byear;
		
		$andagain = explode('/', $lastdate);
		
		$lmonth = $andagain[0];
		$lyear = $andagain[1];
		
		//$ldate = $andagain[0];
		//$lmonth = $andagain[1];
		//$lyear = $andagain[2];
		
		$getldate = $lmonth."".$lyear;
		
		$data['getcluster'] = $cluster;
		$data['getlevel'] = $level;
		$data['getfdate'] = $getfdate;
		$data['getldate'] = $getldate;
		$data['getbtstype'] = $getldate;
		
		
		$data['incluster'] = $cluster;
		$data['inlevel'] = $level;
		$data['inperiod'] = $date;
		
		/*echo $cluster."<br/>";
		echo $level."<br/>";
		echo $getfdate."<br/>";
		echo $getldate;
		exit;*/
		
		$data['firststep'] = $this->mbtsgrowth->getfirstcat($cluster,$level, $getfdate, $getldate, $bts_type);
		
		$this->load->view('internal/btsgrowth_result', $data);
		}
		/* end */
	}
	function show(){
		redirect('internal/growth/');
		
	}
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