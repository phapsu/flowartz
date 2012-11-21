<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Signup_model extends User_model {

    //vars

    protected $data;

    //methods

    public function __construct() {

        //parent::__construct();
    }

    public function register() {

        $this->data = $this->input->post('fac_signup');

        if ($this->data) {

            /**
             * Make sure the two passwords match (even though this is handled client side as well) and that
             * we have a valid email address
             */
            if ($this->is_valid_email($this->data['email']) && ($this->data['password'] === $this->data['confirm'])) {

                $user_email = $this->valid_email();
                $user_name = $this->name_from_email();
                $user_password = sha1($this->data['password']);
                $activated = sha1(time() . $user_password);
                $token = $this->app->_generate_new_token($user_password . $user_email);
                $join_date = time();
                $ip = $_SERVER['REMOTE_ADDR'];

                /* Build the insert queries */
                $insert_user_sql = 'INSERT INTO fa_users (name, password, email, activated, join_date, ip, token) VALUES (' .
                        $this->db->escape($user_name) . ', ' .
                        $this->db->escape($user_password) . ', ' .
                        $this->db->escape($user_email) . ', ' .
                        $this->db->escape($activated) . ', ' .
                        $this->db->escape($join_date) . ', ' .
                        $this->db->escape($ip) . ', ' .
                        $this->db->escape($token) .
                        ')';

                $insert_user_query = $this->db->simple_query($insert_user_sql);

                /* Get the last insert id */
                $last_insert_id = $this->last_insert_id();

                $insert_stats_sql = 'INSERT INTO fa_users_stats (uid) VALUES (' . $last_insert_id . ')';
                $insert_settings_sql = 'INSERT INTO fa_users_settings (uid) VALUES (' . $last_insert_id . ')';
                

                /* Run the relational db inserts, need a better method eventually */
                $insert_stats_query = $this->db->simple_query($insert_stats_sql);
                $insert_settings_query = $this->db->simple_query($insert_settings_sql);                

                if (true === $insert_user_query
                        && true === $insert_stats_query
                        && true === $insert_settings_query                        
                ) {
					//insert profile
					$delete_profile_image_sql = 'DELETE FROM fa_profile_images WHERE uid = ' . $last_insert_id;
					$this->db->simple_query($delete_profile_image_sql);
					$insert_profile_image_sql = 'INSERT INTO  fa_profile_images (uid) VALUES (' . $last_insert_id . ')';
					$this->db->simple_query($insert_profile_image_sql);
				
                    //send the registration email
                    $this->_send_registration_email($user_email,$activated);

                    $this->error->set_message("Your account has been registered but it must be activated before you can use it.  Please check your email (including junk and spam folders) for an activation code.");
                    $this->app->redirect('/user/signup');

                    //$this->error->set_message('Registration Error: Could not send the registration email, the email address you provided is not valid', 'error');
                    //$this->app->redirect('/user/signup');
                } else {
                    $this->error->set_message("Registration Error: A problem occurred during the registration process.  Please try again, or contact an administrator.");
                    $this->app->redirect('/user/signup');
                }

                return $insert_query; //bool, not result
            } else {
                $this->error->set_message("Registration error: The email address you've chosen is either in use, not valid, or your passwords did not match.");
                $this->app->redirect('/user/signup');
            }
        }

        return false;
    }

    protected function _send_registration_email($to, $activated=null) {

        $ci = & get_instance();
        $ci->load->library('email');

		if(!$activated){
			$activate_sql = 'SELECT activated FROM fa_users WHERE activated IS NOT NULL AND email = ' . $this->db->escape($to);
			$activate_query = $this->db->query($activate_sql);
			$activation_data = $activate_query->result();
			$activated = $activation_data[0]->activated;
		}
		
        $activate_url = base_url() . 'user/activate/' . $activated;

        $config['mailtype'] = 'html';
        $this->email->initialize($config);

        $ci->email->from($ci->config->item('admin_email'));
        $ci->email->to($to);
        $ci->email->subject('Flowartz Registration');
        $ci->email->message('<p>Welcome to Flowartz!  You\'re almost there, just click the following link to activate your account and choose your security question and you\'re all set!</p><p><a href="' . $activate_url . '">Click me to activate!</a></p><p>Thanks, the Flowartz Team.</p>');

        $ci->email->send();
    }

}

?>