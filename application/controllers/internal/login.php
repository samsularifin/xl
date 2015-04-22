<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {
	function __construct(){
			parent::__construct();
			$this->load->model('internal/mread');	
	}
	function index()
	{
		$this->load->view('login_internal');
	}
	function masuk(){
		$username = $this->input->post('username');
		$pass = $this->input->post('password');
		
		if(empty($username) or empty($pass)){
			$this->session->set_flashdata('msg','Please fill all of the form input');
			redirect('internal/login');
		}
		$rememberme = $this->input->post('rememberme');
		
			if(!$rememberme){
				$this->session->sess_expiration = 7200;
				$this->session->sess_expire_on_close = TRUE;
			}
			
			$query = $this->mread->login_validasi();
			
			if($query)
			   {
				 $sess_array = array();
				 foreach($query as $data)
				 {
				   $sess_array = array(
					 'username' => $data->username,
					 'tipe' =>"internal",
					 'log_level'=> $data->level,
					 'log_cluster' => $data->lcluster,
					 'is_logged_in' =>TRUE
				   );
				   $this->session->set_userdata($sess_array);
				 }
				 redirect('internal/dashbord/');
			   }
			else{
				$this->session->set_flashdata('msg', 'Invalid username and password');
				redirect('internal/login');
			}
	}
}