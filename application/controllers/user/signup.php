<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Signup extends CI_Controller {
	
		//vars
		
			
		
		//methods
		
			public function index(){
			
				$this->load->model('user/user_model');
				$this->load->model('user/signup_model');
		
				$request = $this->request->requestSet();
				$session_uid = $this->session->userdata('uid');
	
				if($request && false === $session_uid){ 
					if(true === $this->signup_model->register()){
						$this->app->redirect('/user/activate/');
					}
				}
				
				$this->load->view('global/header');	
				$this->load->view('user/signup/signup');
				$this->load->view('global/footer');
		
			}
		
	}

?>