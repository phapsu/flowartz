<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

	class Widgets extends App {
	
		//vars
		
			
		
		//methods
		
			/**
			 * Loads the user's view widget
			 */
			public function views(){
			
				$ci =& get_instance();
				
				$ci->load->model('user/user_model');
				$ci->load->model('user/profile_model');
				
				$data['widget_data'] = $ci->profile_model->load_view_widget_data();
				
				$ci->load->view('widgets/views', $data);
			
			}
	
	}
	
?>