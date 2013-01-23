<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login_model extends User_model {

    //vars

    protected $_data;

    //methods

    /**
     * Validate the user input and set the necessary session variables if everything checks out
     */
    public function login() {

        $this->_data = $this->input->post('fac_login');
        $session_data = array();

        if (empty($this->_data['email']) && empty($this->_data['password'])) {
            $this->error->set_message('Please enter an email address and a password', 'error');
            $this->app->redirect('/user/login');
            return false; //just to break out of the function so nothing else gets processed
        }

        if (empty($this->_data['email'])) {
            $this->error->set_message('Please enter an email address', 'error');
            $this->app->redirect('/user/login');
            return false; //just to break out of the function so nothing else gets processed
        }

        if (empty($this->_data['password'])) {
            $this->error->set_message('Please enter a password', 'error');
            $this->app->redirect('/user/login');
            return false; //just to break out of the function so nothing else gets processed
        }

        if (false === empty($this->_data)) {

            $validation_query = $this->db->query('SELECT name, uid, email, token, last_visit_date, country, state, city FROM fa_users ' .
                    'WHERE email = ' . $this->db->escape($this->_data['email']) .
                    ' AND password = SHA1(' . $this->db->escape($this->_data['password']) .
                    ' ) AND activated IS NULL'
            );

            if (count($validation_query->result()) > 0) {
                                
                //set session variables
                foreach ($validation_query->result() as $session_data) {
                    $session_data = array(
                        'user_id' => $session_data->uid,
                        'user_token' => $session_data->token,
                        'user_lvd' => $session_data->last_visit_date,
                        'user_name' => $session_data->name,
                        'country' => $session_data->country,
                        'state' => $session_data->state,
                        'city' => $session_data->city,                        
                        'email' => $session_data->email                        
                    );
                    $this->session->set_userdata($session_data);
                }

                return true;
            } else {
                $this->error->set_message('Sorry, that user does not appear to be registered yet or you have not activated your account.', 'error');
                $this->app->redirect('/user/login');
            }
        }

        return false;
    }

}

?>