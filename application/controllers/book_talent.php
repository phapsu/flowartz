<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class book_talent extends CI_Controller {

    //vars
    //methods

    public function index() {

        $this->data = $this->input->post('book');
        if(!empty($this->data)){
            //echo "<pre>";print_r($this->data);echo "</pre>";exit;
            $ci = & get_instance();
            $ci->load->library('email');
            $config['mailtype'] = 'html';
            $this->email->initialize($config);

            $from = ($this->data['email_address']) ? $this->data['email_address'] : $ci->config->item('admin_email');
            $ci->email->from($from);
            $ci->email->to($ci->config->item('contact_email'));
            $ci->email->subject('Book Talent');
            
            $this->load->helper('inflector');
            $message = '';
            $message .= '<table width="100%" border="0" cellpadding="0" cellspacing="10">';
            foreach ($this->data as $idx => $val){
                $message .= '<tr><td width="1%" nowrap="">'.  humanize($idx).':</td><td>&nbsp;&nbsp;'.$val.'</td></tr>';
            }
            $message .= '</table>';
            $ci->email->message($message);
            $ci->email->send();            
            
            $this->app->redirect('/book_talent/thankyou/');
        }
        $this->load->view('global/header');
        $this->load->view('book_talent/index');
        $this->load->view('global/footer');
    }
    
    public function thankyou(){
        $this->load->view('global/header');
        $this->load->view('book_talent/thankyou');
        $this->load->view('global/footer');        
    }

}

?>