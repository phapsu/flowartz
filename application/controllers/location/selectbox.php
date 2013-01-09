<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Selectbox extends CI_Controller {

    //vars
    //methods

    public function index() {
        $postdata = $this->input->post('location');        
        
        $this->load->model('location/country_model');
        $this->load->model('location/state_model');
        $this->load->model('location/city_model');
        $data['countries'] = $this->country_model->get_list_country();
        $data['country_iso3'] = $this->country_model->get_iso3_by_id();
        $data['states'] = $this->state_model->get_all_state();
        $data['state_alias'] = $this->state_model->get_alias_by_id();
        $data['cities'] = $this->city_model->get_all_city();
        $data['user_data'] = $postdata;
        
        $this->load->view('location/selectbox', $data);
        //$this->output->cache(10080);            
    }

}

?>