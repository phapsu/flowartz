<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class App {

    //vars

    protected $_page_title = null;

    //methods

    public function __construct() {

        $this->_page_title = 'Welcome';
    }

    /**
     * Global internal redirect function.
     */
    public function redirect($location) {

        //$this->config->load('flowartz');
        //$is_internal = $this->_is_internal($location);
        //if($is_internal){
        //if($this->config->item('environment') == 'LIVE'){
        //$location = base_url() . $location; //for live
        //}else {
        $location = base_url() . $location; //dev
        //}
        //}

        if ($location) {
            //if($this->config->item('environment') == 'LIVE'){
            //header('Location:'. base_url() . $location); //for live
            //}else {
            header('Location:' . $location); //dev
            //}
        }

        return false;
    }

    /**
     * Validate the token.  This will run every time a form is submitted.
     */
    public function check_token($token = null) {

        $ci = & get_instance();

        $session_token = $ci->session->userdata('user_token');

        if (is_null($token)) {
            $query = 'SELECT token FROM fa_users WHERE token = ' . $ci->db->escape($session_token);
        } else {
            $query = 'SELECT token FROM fa_users WHERE token = ' . $ci->db->escape($token) . ' LIMIT 1';
        }

        $select_query = $ci->db->query($query);
        $result = $select_query->result();

        if ($select_query->num_rows == 1) {
            return $result[0]->token;
        } else {
            $ci->error->set_message('Token invalid.', 'error');

            return false; //here as a technicality so it always returns a boolean even though it will never get this far
        }
    }

    /**
     * Check if a redirect link is internal
     */
    private function _is_internal($link) {

        //die(var_dump(strpos(base_url(), $link)));
        if (strpos(base_url(), $link)) {
            return true;
        }

        return false;
    }

    /**
     * Generates new tokens for signup and password resetting
     */
    public function _generate_new_token($str) {

        return sha1($str).  uniqid();
    }

    /**
     * Sets the title tag for the page you're currently on (should be called in the controller)
     */
    public function set_title($title = null) {

        if (false === is_null($title)) {
            $this->_page_title = trim($title);
        }
    }

    public function page_title() {

        $ci = & get_instance();

        echo $this->_page_title . ' | ' . $ci->config->item('site_name');
    }
    
    //remove item = 0 or null
    public function array_filter_recursive($input) {
        if(empty($input)) return false;
        
        foreach ($input as &$value) {
            if (is_array($value)) {
                $value = $this->array_filter_recursive($value);
            }
        }
        return array_filter($input);
    }
    
    public function pr($var){
        echo '<pre>';
        print_r($var);
        echo '</pre>';
    }
}

?>