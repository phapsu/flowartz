<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Search extends CI_Controller {

    public function __construct() {
        parent:: __construct();
        $this->load->helper("url");
        $this->load->model('search/search_model');
        $this->load->library("pagination");
    }
    public function index() {

        $postdata = $this->input->post('fac_search');
        $keyword = isset($postdata['q']) ? $postdata['q'] : '';
        $searchByLocation = (isset($postdata['location'])) ? $postdata['location'] : '';        
//        $keyword = (!empty($postdata['q'])) ? $postdata['q'] : $this->session->userdata('search_string');
//        $searchByLocation = (!empty($postdata['location'])) ? $postdata['location'] : $this->session->userdata('search_location');
        
        if(!$this->session->userdata('search_string') || $keyword != $this->session->userdata('search_string')){
            //nothing
        }else{
            $keyword = $this->session->userdata('search_string');
        }
        
        if(!$this->session->userdata('search_location') || $searchByLocation != $this->session->userdata('search_location')){
            //nothing
        }else{
            $searchByLocation = $this->session->userdata('search_location');
        }
        
        //print_r($searchByLocation);exit;
        if(!$keyword && !$searchByLocation){
            $this->session->unset_userdata('search_string');
            $this->session->unset_userdata('search_location');
        }
        
        $data = null;        
        
        if ($searchByLocation || $keyword) {
            $keyword = ($keyword) ? $this->db->escape_like_str($keyword) : "";
            $searchByLocation = ($searchByLocation) ? $this->db->escape_like_str($searchByLocation) : "";
            $this->session->set_userdata(array(
                        'search_string' => $keyword,
                        'search_location' => $searchByLocation
                    ));
            //echo $this->search_model->record_count();exit;
            $config = array();
            $config["base_url"] = base_url() . "search/index";
            $config["total_rows"]  = $this->search_model->record_count();
            $config["per_page"]    = 4;
            $config["uri_segment"] = 3;
            $choice = $config["total_rows"] / $config["per_page"];
            $config["num_links"] = round($choice);

            $this->pagination->initialize($config);

            $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
            $data["results"] = $this->search_model->fetch_record($config["per_page"], $page);
            $data["links"] = $this->pagination->create_links();
        }
        
        //get location
        $this->load->model('location/country_model');
        $this->load->model('location/state_model');
        $this->load->model('location/city_model');
        $data['countries'] = $this->country_model->get_list_country();
        $data['states'] = $this->state_model->get_list_state();
        $data['cities'] = $this->city_model->get_list_city();

        $this->load->view('global/header');
        $this->load->view('artists/artists', $data);
        $this->load->view('global/footer');
    }

    /*
      public function index($keyword = null) {

      $postdata = $this->input->post('fac_search');
      $data = null;

      if ($postdata['action'] == 1) {
      //$postdata['q'] = str_replace(' ', '', $postdata['q']);
      $this->app->redirect('/search/' . $postdata['q']);
      }

      if (false === is_null($keyword)) {
      $this->load->model('search/search_model');
      $data['users'] = $this->search_model->search($keyword);
      $data['keyword'] = $keyword;
      }

      $this->load->view('global/header');
      $this->load->view('artists/artists', $data);
      $this->load->view('global/footer');
      }
     */
}

?>