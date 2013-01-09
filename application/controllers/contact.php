<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Contact extends CI_Controller {
	
		//vars
		
			
		
		//methods
		
			public function index(){
				
				$this->load->view('global/header');	
				$this->load->view('contact/contact');
				$this->load->view('global/footer');
				
			}
		
	}		
		
?>