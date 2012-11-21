<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class About extends CI_Controller {

    //vars
    //methods

    public function index() {

        $this->load->view('global/header');
        $this->load->view('about/index');
        $this->load->view('global/footer');
    }

}

?>