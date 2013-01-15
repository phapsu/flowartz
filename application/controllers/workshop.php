<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Workshop extends CI_Controller {

    //vars
    //methods

    public function index() {

        $data['categories'] = $this->config->item('artist_category');
        
        $this->load->model('workshop_model');
        $data['workshop_featured'] = $this->workshop_model->get_workshop_featured();
        $data['workshop_soon'] = $this->workshop_model->get_workshop_soon();
        $data['workshop_nearby'] = $this->workshop_model->get_workshop_nearby();        
        
        $this->load->view('global/header');
        $this->load->view('workshop/index', $data);
        $this->load->view('global/footer');
    }
    
    public function cats($cat_id){
        if(empty ($cat_id)) $this->app->redirect('workshop');
        
        $this->app->set_title('Workshop');
        $this->load->model('workshop_model');
        
        $config = array();
        $config["base_url"] = base_url() . "workshop/cats/".$cat_id;
        $config["total_rows"] = $this->workshop_model->count_workshop_cats($cat_id);
        $config["per_page"] = $this->config->item('numof_workshop_paging');
        $config["uri_segment"] = 4;
        $choice = $config["total_rows"] / $config["per_page"];
        $config["num_links"] = round($choice);

        $this->load->library("pagination");
        $this->pagination->initialize($config);

        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;//echo $page;exit;
        $data["workshop"] = $this->workshop_model->get_workshop_cats($cat_id, $config["per_page"], $page);
        
        $data["links"] = $this->pagination->create_links();
        
        
        $data["action"] = $this->uri->segment(2);     
        
        $this->load->view('global/header');
        $this->load->view('workshop/cats', $data);
        $this->load->view('global/footer');
    }
    
    public function search(){
                
        $this->app->set_title('Search Workshop');
        $this->load->model('workshop_model');
        
        $type_id =0; //=0:a-z; 1:nearby; =2:price; =3:availyblity; =4:skilly; =5:soonely
        $keyword = 'workshop';
        
        $config = array();
        $config["base_url"] = base_url() . "workshop/search";
        $config["total_rows"] = $this->workshop_model->count_workshop_cats($cat_id);
        $config["per_page"] = $this->config->item('numof_workshop_paging');
        $config["uri_segment"] = 3;
        $choice = $config["total_rows"] / $config["per_page"];
        $config["num_links"] = round($choice);

        $this->load->library("pagination");
        $this->pagination->initialize($config);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;//echo $page;exit;
        $data["workshop"] = $this->workshop_model->get_workshop_cats($cat_id, $config["per_page"], $page);
        
        $data["links"] = $this->pagination->create_links();
        
        
        $data["action"] = $this->uri->segment(2);     
        
        $this->load->view('global/header');
        $this->load->view('workshop/cats', $data);
        $this->load->view('global/footer');
    }

    public function add() {

        $session_uid = $this->session->userdata('user_id');
        $this->app->set_title('Add Workshop');

        if (false === $session_uid) {
            $this->app->redirect('user/login/');
        } else {
            $postdata = $this->input->post('fac_workshop');

            if (!empty($postdata)) {

                $this->load->model('workshop_model');
                $this->workshop_model->save($postdata);

                $this->error->set_message('Add Workshop Sucessfully!', 'success');
                //$this->app->redirect('/user/login/');
            }
            
            $this->load->model('user/user_model');
            $this->load->model('user/profile_model');
            
            $data['userinfo'] = $this->profile_model->userinfo();
            
            $data['categories'] = $this->config->item('artist_category');
            $data['skills'] = $this->config->item('artist_level');

            $this->load->view('global/header');
            $this->load->view('workshop/add', $data);
            $this->load->view('global/footer');
        }
    }

    public function edit($id) {

        if (empty($id)) {
            $this->app->redirect('workshop');
        } else {
            $session_uid = $this->session->userdata('user_id');
            $this->app->set_title('Edit Workshop');

            if (false === $session_uid) {
                $this->app->redirect('user/login/');
            } else {

                $postdata = $this->input->post('fac_workshop');
                $this->load->model('workshop_model');

                if (!empty($postdata)) {
                    $this->workshop_model->update($postdata);
                    
                    $this->error->set_message('Update Workshop Sucessfully!', 'success');
                    
                    $this->app->redirect('user/profile');
                }

                $data['workshop'] = $this->workshop_model->get_workshop($id);

                //check permision of workshop
                if (empty($data['workshop']) || $session_uid != $data['workshop'][0]->uid) {
                    $this->app->redirect('workshop');
                }

                $this->load->model('user/user_model');
                $this->load->model('user/profile_model');

                $data['userinfo'] = $this->profile_model->userinfo();



                //add file
                $this->load->model('user/user_model');
                $this->load->model('user/profile_model');
                $data['userinfo'] = $this->profile_model->userinfo();
                $data['files'] = $this->workshop_model->get_files($id);
                $data['workshop_max_files'] = $this->config->item('workshop_max_files');

                //get student enrolled workshop                
                $data['student_enrolled'] = $this->workshop_model->get_student_enrolled($id);





                $data['categories'] = $this->config->item('artist_category');
                $data['skills'] = $this->config->item('artist_level');

                $this->load->view('global/header');
                $this->load->view('workshop/edit', $data);
                $this->load->view('global/footer');
            }
        }
    }

    public function add_file() {

        $session_uid = $this->session->userdata('user_id');
        $this->app->set_title('Add File');

        if (false === $session_uid) {
            $this->app->redirect('user/login/');
        } else {

            $postdata = $this->input->post('fac_workshop');
            $this->load->model('workshop_model');

            $this->workshop_model->add_file($postdata['wid'], $_FILES);

            $this->app->redirect('workshop');
        }
    }

    public function delete_file() {

        $session_uid = $this->session->userdata('user_id');
        $this->app->set_title('Delete File');

        if (false === $session_uid) {
            $this->app->redirect('user/login/');
        } else {

            $postdata = $this->input->post('fac_workshop');

            if (!empty($postdata)) {
                $this->load->model('workshop_model');

                $this->workshop_model->delete_file($postdata['wid'], $postdata);

                $this->error->set_message('Delete Sucessfully!', 'success');
            }
            $this->app->redirect('workshop');
        }
    }

    public function send_message() {

        $session_uid = $this->session->userdata('user_id');
        $this->app->set_title('Send Message');

        if (false === $session_uid) {
            $this->app->redirect('user/login/');
        } else {

            $postdata = $this->input->post('fac_workshop');

            if (!empty($postdata)) {
                $this->load->model('workshop_model');

                //get student enrolled workshop                
                $student_enrolled = $this->workshop_model->get_student_enrolled($postdata['wid']);
                if (count($student_enrolled) > 0) {

                    //send mail to list enrolled workshop
                    $this->load->library('email');
                    $config['mailtype'] = 'html';
                    $this->email->initialize($config);

                    $from = $this->config->item('admin_email');
                    $this->email->from($from);
                    $this->email->subject('Send Message Student Enrolled');

                    $i = 0;
                    foreach ($student_enrolled as $id => $row) {
                        if ($i != 1) {
                            $this->email->to($row->email);
                            $i = 1;
                        } else {
                            $this->email->cc($row->email);
                        }
                    }

                    $message = '';
                    $message .= '<table width="100%" border="0" cellpadding="0" cellspacing="10">';
                    $message .= '<tr><td width="1%" nowrap="">Message:</td></tr>';
                    $message .= '<tr><td width="1%" nowrap="">' . $postdata['message'] . ':</td></tr>';
                    $message .= '</table>';

                    $this->email->message($message);
                    $this->email->send();

                    $this->error->set_message('Send Message Sucessfully!', 'success');
                }
            }

            $this->app->redirect('workshop');
        }
    }

    public function complete_event($id) {
        if (empty($id)) {
            $this->app->redirect('workshop');
        } else {
            if (false === $session_uid) {
                $this->app->redirect('user/login/');
            } else {
                $this->load->model('workshop_model');
                $workshop = $this->workshop_model->get_workshop($id);

                if (!empty($workshop)) {

                    //check permision of workshop
                    if ($session_uid != $workshop[0]->uid) {
                        $this->app->redirect('workshop');
                    }


                    //get student enrolled workshop                
                    $student_enrolled = $this->workshop_model->get_student_enrolled($id);

                    //send mail flowartz to notification finish workshop
                    $this->load->library('email');
                    $config['mailtype'] = 'html';
                    $this->email->initialize($config);

                    $from = $workshop[0]->email;
                    $this->email->from($from);
                    $this->email->subject('Send Email Complete Event');
                    $this->email->to($this->config->item('contact_email'));
                    $message = '';
                    $message .= '<table width="100%" border="0" cellpadding="0" cellspacing="10">';
                    $message .= '<tr><td width="1%" nowrap=""><b>Workshop information</b>:</td></tr>';
                    $message .= '<tr><td width="1%" nowrap="">Workshop name:</td><td>' . $workshop[0]->name . '</td></tr>';
                    $message .= '<tr><td width="1%" nowrap="">Teacher name:</td><td>' . $workshop[0]->teacher_name . '</td></tr>';
                    $message .= '<tr><td width="1%" nowrap="">Date:</td><td>' . date("m/d/Y", strtotime($workshop[0]->date)) . '</td></tr>';
                    $message .= '<tr><td width="1%" nowrap="">Time:</td><td>' . $workshop[0]->time . '</td></tr>';
                    $message .= '<tr><td width="1%" nowrap="">Length:</td><td>' . $workshop[0]->length . '</td></tr>';
                    $message .= '<tr><td width="1%" nowrap="">Frequency:</td><td>' . $workshop[0]->frequency . '</td></tr>';
                    $message .= '<tr><td width="1%" nowrap="">Fee:</td><td>' . $workshop[0]->fee . '</td></tr>';
                    $message .= '</table>';

                    $message .= '<hr>';
                    $message .= '<table width="100%" border="0" cellpadding="0" cellspacing="10">';
                    $message .= '<tr><td width="1%" nowrap=""><b>List Student Enrolled</b>:</td></tr>';

                    foreach ($student_enrolled as $id => $row) {
                        $message .= '<tr><td width="1%" nowrap="">Name: ' . $row->name . '</td><td>Email: ' . $row->email . '</td></tr>';
                    }

                    $message .= '</table>';


                    $this->email->message($message);
                    $this->email->send();


                    //send mail confirm learning
                    if (count($student_enrolled) > 0) {
                        $from = $this->config->item('contact_email');
                        $this->email->from($from);
                        $this->email->subject('Confirm learning');


                        $i = 0;
                        foreach ($student_enrolled as $id => $row) {
                            if ($i != 1) {
                                $this->email->to($row->email);
                                $i = 1;
                            } else {
                                $this->email->cc($row->email);
                            }
                        }

                        $message = '';
                        $message .= '<table width="100%" border="0" cellpadding="0" cellspacing="10">';
                        $message .= '<tr><td width="1%" nowrap="">Please reply to this email to confirm learned:</td></tr>';
                        $message .= '</table>';
                        $message .= '<hr>';
                        $message .= '<table width="100%" border="0" cellpadding="0" cellspacing="10">';
                        $message .= '<tr><td width="1%" nowrap=""><b>Workshop information</b>:</td></tr>';
                        $message .= '<tr><td width="1%" nowrap="">Workshop name:</td><td>' . $workshop[0]->name . '</td></tr>';
                        $message .= '<tr><td width="1%" nowrap="">Teacher name:</td><td>' . $workshop[0]->teacher_name . '</td></tr>';
                        $message .= '<tr><td width="1%" nowrap="">Date:</td><td>' . date("m/d/Y", strtotime($workshop[0]->date)) . '</td></tr>';
                        $message .= '<tr><td width="1%" nowrap="">Time:</td><td>' . $workshop[0]->time . '</td></tr>';
                        $message .= '<tr><td width="1%" nowrap="">Length:</td><td>' . $workshop[0]->length . '</td></tr>';
                        $message .= '<tr><td width="1%" nowrap="">Frequency:</td><td>' . $workshop[0]->frequency . '</td></tr>';
                        $message .= '<tr><td width="1%" nowrap="">Fee:</td><td>' . $workshop[0]->fee . '</td></tr>';
                        $message .= '</table>';

                        $this->email->message($message);
                        $this->email->send();
                    }

                    //update finished workshop
                    $data = array('status' => 1);
                    $this->workshop_model->update($id, $data);
                    //move workshop to experience


                    $this->error->set_message('Complete Event Sucessfully!', 'success');

                    $this->app->redirect('workshop');
                }
            }
        }
    }
        
    //guest view
    public function view($id) {
        if (empty($id)) {
            $this->app->redirect('workshop');
        } else {
            $this->load->model('workshop_model');
            $data['workshop'] = $this->workshop_model->get_workshop($id);
        }
    }

}

?>