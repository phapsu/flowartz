<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Logout extends CI_Controller {
	
		//vars
		
			
		
		//methods
			
			
			public function index(){

				$session_uid = $this->session->userdata('user_id');
				$this->load->model('user/user_model');

				if($session_uid){
					$this->db->query('UPDATE fa_users SET last_visit_date = '. time() . ' WHERE uid = '. $session_uid);
					$this->session->sess_destroy();
					$this->app->redirect('/user/login/');
				}
				
			}
			
	}

?>