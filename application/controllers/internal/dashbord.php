<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashbord extends CI_Controller {
	function __construct(){
			parent::__construct();
			$this->is_logged_in();
			$this->load->model('internal/mread');	
			$this->load->model('internal/mdashbord');
	}
	public function index()
	{
		$fq = $this->mdashbord->fget_first_step_region();
		$data['fq'] = $this->mdashbord->fget_first_step_region();
		
		$level = $this->session->userdata('log_level');
		
		if(count($fq)>0)
		{			
			if($level == 'East' || $level == 'East 1' || $level == 'East 2'){
				foreach ($fq as $row)
					{
						$getperiod = $row->pperiod;
						$clstr = $this->session->userdata('log_cluster');

						
						$data['second_query'][] = $this->mdashbord->query_region($clstr, $getperiod);
						$data['third_query'][] = $this->mdashbord->query_region_second($clstr, $getperiod);

					}
			}else{
				$grcluster = $this->mread->showgreatercluster($this->session->userdata('log_level'));
				$data['grcluster'] = $this->mread->showgreatercluster($this->session->userdata('log_level'));
				
				
				if (count($grcluster) >0){
					
					//$clstr = array();
					$counter = 0;
					$clstr = array();
					$temp = array();
					
					foreach($grcluster as $grclstr){
						$temp[$counter] = $grclstr;
						$clstr[$counter] = $grclstr->Cluster;
						
						$counter++;
					}
					echo var_dump($clstr);
					//exit;
					$counter = 0;
						foreach ($fq as $row)
						{
							
							$getperiod = $row->pperiod; 
							
							$data['second_query'][] = $this->mdashbord->query_region($clstr[$counter], $getperiod);
							$data['third_query'][] = $this->mdashbord->query_region_second($clstr[$counter], $getperiod);
							
							$counter++;
							
						}
							//print_r ($data['second_query'][0]);
							//exit;
					}
				}
			}
		$data['page'] = "internal/beranda2";
		$this->load->view('internal/container', $data);
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