<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashbord extends CI_Controller {
	function __construct(){
			parent::__construct();
			$this->is_logged_in();
			$this->load->model('sales/mread');	
	}
	public function index()
	{
		$data['page'] = "sales/beranda";
		$this->load->view('sales/container', $data);
	}
	function logout(){
			$this->session->unset_userdata('username');
			$this->session->unset_userdata('is_logged_in');
			$this->session->unset_userdata('tipe');
			redirect('sales/login'); 
	}
	function is_logged_in(){
			$is_logged_in = $this->session->userdata('is_logged_in');
			$tipe = $this->session->userdata('tipe');
			
			if(!isset($is_logged_in) || $is_logged_in != true || $tipe != "sales" ){
				$this->session->set_flashdata('msg', 'Access denied! You don\'t have permission to access this page or session has expired. Please use login form!');
				redirect('sales/login');	
			}
	}
}