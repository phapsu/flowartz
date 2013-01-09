<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class User_model extends CI_Model {
		
		//vars
		
			protected $_email = null;
		
		//methods
		
			public function __construct(){
			
				parent::__construct();
				
			}
			
			/**
			 * Validate the user's email
			 */
			public function is_valid_email($email){
				
				//$ci =& get_instance();
				$this->load->helper('email');
				$this->_email = $email;
				
				$sql = 'SELECT email FROM fa_users WHERE email LIKE "%'. $this->db->escape_like_str($email) .'%"';
				$validation_query = $this->db->query($sql);

				if($validation_query->num_rows == 1 && valid_email($email)){
					return false;
				}else {
					return true;
				}
				
			}
			
			/**
			 * Returns the user's email if it has been successfully validated
			 */
			public function valid_email(){
				
				if(false === is_null($this->_email)){
					return $this->_email;
				}
				
			}
			
			/**
			 * Generate a default name for the user from their email address.
			 * Can be changed later by editing their profile
			 */
			public function name_from_email(){
				
				$parts = explode('@', $this->_email);
				
				return $parts[0];
				
			}
			
			/**
			 * Activate a user once they click the link in the email
			 */
			public function activate($hash){
				
				//$postdata = $this->request->getVar('fac_activate');
				$postdata = $this->input->post('fac_activate');
				$security_question = strip_slashes($postdata['question']);
				$security_answer = $postdata['answer'];
				
				$select_query = $this->db->query('SELECT uid FROM fa_users WHERE activated = '. $this->db->escape($hash));
				
				if($select_query->num_rows == 1){
					$update_query = $this->db->query('UPDATE fa_users SET activated = NULL, sec_q = '. $this->db->escape($security_question) .', sec_a = '. $this->db->escape($security_answer) .' WHERE activated = '. $this->db->escape($hash));
					return true;
				}
				
				return false;
				
			}
			
			public function send_reset_password_email(){
				
				if($this->request->requestSet()){
					//$ci =& get_instance();
					$this->load->library('email');
					$data = $this->input->post('fac_reset');
					
					$activate_sql = 'SELECT token FROM fa_users WHERE activated IS NULL AND email = '. $this->db->escape($data['email']);
					$activate_query = $this->db->query($activate_sql);
					$activation_data = $activate_query->result();
					
					if(false === empty($activation_data)){
						$activate_url = base_url() . 'user/reset_password/'. $activation_data[0]->token;
						
						$config['mailtype'] = 'html';
						$this->email->initialize($config);
						
						$this->email->from($this->config->item('admin_email'));
						$this->email->to($data['email']);
						$this->email->subject('Flowartz Password Reset');
						$this->email->message('<p>Looks like you forgot your password!  Fear not, it isn\'t lost to the abyss of time.  Give the following link a click to set yourself up with a new password.</p><p><a href="'. $activate_url .'">Click me to reset your account</a></p><p>Thanks, the Flowartz Team.</p>');	
						
						return $this->email->send();
						
					}else {
						$this->error->set_message('The email address you entered was not found in our database.', 'error');
						$this->app->redirect('/user/reset_password');
					}
				}
				
			}
			
			public function reset_password($token){
				
				$data = $this->input->post('fac_reset');
				$valid_token = $this->app->check_token($token);
				
				if(false !== $valid_token){
					$select_query = $this->db->query('SELECT email FROM fa_users WHERE token = '. $this->db->escape($valid_token));
					$result = $select_query->result();
					$valid_email = $result[0]->email;
					
					$password = $this->db->escape($data['password_1']);
					$new_token = $this->app->_generate_new_token($password, $valid_email);
					
					if($this->request->requestSet()){
						$update_query = $this->db->query('UPDATE fa_users SET password = SHA1('. $password .') WHERE token = '. $this->db->escape($valid_token));
						$update_query_2 = $this->db->query('UPDATE fa_users SET token = '. $this->db->escape($new_token) .' WHERE email = '. $this->db->escape($valid_email));
						$this->error->set_message('Your password has been rest.', 'success');
						$this->app->redirect('/user/login');
					}
				}else {
					$this->error->set_message('Token invalid.', 'error');
					$this->app->redirect('/user/login');
				}
				
			}
			
			public function last_insert_id(){
			
				$last_insert_id_sql = 'SELECT LAST_INSERT_ID() as lid FROM fa_users';
				$last_insert_id_query = $this->db->query($last_insert_id_sql);
				$lid = $last_insert_id_query->result();
				
				return $lid[0]->lid;
			
			}
			
	}

?>