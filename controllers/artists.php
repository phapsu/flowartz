<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Artists extends CI_Controller {

    //vars
    //methods
    public function __construct() {
        parent:: __construct();
        $this->load->helper("url");
        $this->load->model("artists/artists_model");
        $this->load->library("pagination");
        
        //get location
        $this->load->model('location/country_model');
        $this->load->model('location/state_model');
        $this->load->model('location/city_model');        
    }

    public function index() {
        $this->app->set_title('Artists');
        //delete session search
        $this->session->unset_userdata('search_string');
        $this->session->unset_userdata('search_location');
        
        $config = array();
        $config["base_url"] = base_url() . "artists/index";
        $config["total_rows"] = $this->artists_model->artist_count();
        $config["per_page"] = $this->config->item('numof_artist_paging');
        $config["uri_segment"] = 3;
        $choice = $config["total_rows"] / $config["per_page"];
        $config["num_links"] = round($choice);

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;//echo $page;exit;
        $data["results"] = $this->artists_model->fetch_artists($config["per_page"], $page);
        $data["links"] = $this->pagination->create_links();
        $data["action"] = $this->uri->segment(2);       
        
        //get location
        $data['countries'] = $this->country_model->get_list_country();
        $data['states'] = $this->state_model->get_list_state();
        $data['cities'] = $this->city_model->get_list_city();

        $this->load->view('global/header');
        $this->load->view('artists/artists', $data);
        $this->load->view('global/footer');
    }
    
    public function popular() {
        $this->app->set_title('Popular Artists');
        //delete session search
        $this->session->unset_userdata('search_string');
        $this->session->unset_userdata('search_location');
        
        $config = array();
        $config["base_url"] = base_url() . "artists/popular";
        $config["total_rows"] = $this->artists_model->popular_artist_count();
        $config["per_page"] = $this->config->item('numof_artist_paging');
        $config["uri_segment"] = 3;
        $choice = $config["total_rows"] / $config["per_page"];
        $config["num_links"] = round($choice);

        $this->pagination->initialize($config);

        //$this->uri->segment(n); // n=1 for controller, n=2 for method, etc
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data["results"] = $this->artists_model->fetch_popular_artists($config["per_page"], $page);
        $data["links"] = $this->pagination->create_links();
        $data["action"] = $this->uri->segment(2);
        
        //get location
        $data['countries'] = $this->country_model->get_list_country();
        $data['states'] = $this->state_model->get_list_state();
        $data['cities'] = $this->city_model->get_list_city();

        $this->load->view('global/header');
        $this->load->view('artists/artists', $data);
        $this->load->view('global/footer');
    }

//    public function index() {
//
//        $this->load->model('artists/artists_model');
//        $this->app->set_title('Artists');
//
//        $data['users'] = $this->artists_model->userdata();
//
//        $this->load->view('global/header');
//        $this->load->view('artists/artists', $data);
//        $this->load->view('global/footer');
//    }

//    public function popular() {
//
//        $this->load->model('artists/artists_model');
//        $this->app->set_title('Popular Artists');
//
//        $data['users'] = $this->artists_model->popular();
//
//        $this->load->view('global/header');
//        $this->load->view('artists/artists', $data);
//        $this->load->view('global/footer');
//    }

}

?>