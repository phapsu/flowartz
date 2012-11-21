<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

	class Error {
		
		//vars
			
			protected $_msg = array();
			protected $_class;
		
		//methods
			
			/**
			 * This function will be added to the template somewhere so it's always there, then all a developer needs to do
			 * is call set_message() to show the user errors
			 */	
			public function display_error(){
				
				$error = '';
				$ci =& get_instance();
				$this->_msg = $ci->session->flashdata('_msg');
				$this->_class = $ci->session->flashdata('_class');
				
				if(false === empty($this->_msg)){
					
					//$error =  '<div id="fa_errors" class="'. $this->_type .'">';
					$error =  '<div id="fa-feedback">';
						$error .= '<div class="wrapper clearfix">';
							foreach($this->_msg as $message){
								$error .= '<h4 class="'. $this->_class .'-message">'. $message .'</h4>';
							}
						$error .='</div>';
					$error .= '</div>';
				}
	
				echo $error;
				
			}
			
			public function set_message($msg, $class = 'general'){
				
				$ci =& get_instance();
				
				$ci->session->set_flashdata('_msg', array($msg));
				$ci->session->set_flashdata('_class', $class);
				
			}
		
	}

?>