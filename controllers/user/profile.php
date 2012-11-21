<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Profile extends CI_Controller {
	
		//vars
		
			
		
		//methods
	
			public function index(){
				
				$this->load->model('user/user_model');
				$this->load->model('user/profile_model');
				
				$request = $this->request->requestSet();
				$session_id = $this->session->userdata('user_id');
				
				$data['userinfo'] = $this->profile_model->userinfo();
				
				$this->load->view('global/header');	
				$this->load->view('user/profile/my_profile', $data);
				$this->load->view('global/footer');
		
			}
			
		
	}
	
?>