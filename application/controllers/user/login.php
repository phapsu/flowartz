<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Login extends CI_Controller {
	
		//vars
		
			
		
		//methods
	
			public function index(){
				
				$this->load->model('user/user_model');
				$this->load->model('user/login_model');
				
				$request = $this->request->requestSet();
				$session_id = $this->session->userdata('user_id');

				if($request && false === $session_id){ 
					if(true === $this->login_model->login()){
						$this->app->redirect('/user/profile/');
					}
				}
				
				$this->load->view('global/header');	
				$this->load->view('user/login/login');
				$this->load->view('global/footer');
		
			}
		
	}

?>