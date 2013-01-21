<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Workshop extends CI_Controller {

    //vars
    //methods

    public function index() {

        $data['categories'] = $this->config->item('artist_category');
        $data['skills'] = $this->config->item('artist_level');
        $this->load->model('workshop_model');
        $data['workshop_featured'] = $this->workshop_model->get_workshop_featured();
        $data['workshop_soon'] = $this->workshop_model->get_workshop_soon();
        $data['workshop_nearby'] = $this->workshop_model->get_workshop_nearby();

        $this->load->view('global/header');
        $this->load->view('workshop/index', $data);
        $this->load->view('global/footer');
    }

    public function cats($cat_id) {
        if (empty($cat_id))
            $this->app->redirect('workshop');

        $this->app->set_title('Workshop');
        $this->load->model('workshop_model');

        $config = array();
        $config["base_url"] = base_url() . "workshop/cats/" . $cat_id;
        $config["total_rows"] = $this->workshop_model->count_workshop_cats($cat_id);
        $config["per_page"] = $this->config->item('numof_workshop_paging');
        $config["uri_segment"] = 4;
        $choice = $config["total_rows"] / $config["per_page"];
        $config["num_links"] = round($choice);

        $this->load->library("pagination");
        $this->pagination->initialize($config);

        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0; //echo $page;exit;
        $data["workshop"] = $this->workshop_model->get_workshop_cats($cat_id, $config["per_page"], $page);

        $data["links"] = $this->pagination->create_links();


        $data["action"] = $this->uri->segment(2);
        $cats = $this->config->item('artist_category');
        $data["cat_name"] = $cats[$cat_id];

        $data['category_id'] = $cat_id;
        $data['categories'] = $cats;
        $data['skills'] = $this->config->item('artist_level');

        $this->load->view('global/header');
        $this->load->view('workshop/cats', $data);
        $this->load->view('global/footer');
    }

    public function tag($tag) {

        print_r($tag);
        exit;


        if (empty($tag))
            $this->app->redirect('workshop');

        $this->app->set_title('Workshop');
        $this->load->model('workshop_model');

        $config = array();
        $config["base_url"] = base_url() . "workshop/tag/" . $tag;
        $tag = urldecode($tag);
        $config["total_rows"] = $this->workshop_model->count_workshop_tag($tag);
        $config["per_page"] = $this->config->item('numof_workshop_paging');
        $config["uri_segment"] = 4;
        $choice = $config["total_rows"] / $config["per_page"];
        $config["num_links"] = round($choice);

        $this->load->library("pagination");
        $this->pagination->initialize($config);

        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0; //echo $page;exit;
        $data["workshop"] = $this->workshop_model->get_workshop_tag($tag, $config["per_page"], $page);

        $data["links"] = $this->pagination->create_links();


        $data["action"] = $this->uri->segment(2);
        $cats = $this->config->item('artist_category');
        $data["cat_name"] = $cats[$cat_id];

        $data['tag'] = $tag;
        $data['categories'] = $cats;
        $data['skills'] = $this->config->item('artist_level');

        $this->load->view('global/header');
        $this->load->view('workshop/tag', $data);
        $this->load->view('global/footer');
    }

    public function all() {

        $this->app->set_title('Workshop');
        $this->load->model('workshop_model');

        $config = array();
        $config["base_url"] = base_url() . "workshop/all";
        $config["total_rows"] = $this->workshop_model->count_workshop_all();
        $config["per_page"] = $this->config->item('numof_workshop_paging');
        $config["uri_segment"] = 3;
        $choice = $config["total_rows"] / $config["per_page"];
        $config["num_links"] = round($choice);

        $this->load->library("pagination");
        $this->pagination->initialize($config);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0; //echo $page;exit;
        $data["workshop"] = $this->workshop_model->get_workshop_all($config["per_page"], $page);

        $data["links"] = $this->pagination->create_links();


        $data["action"] = $this->uri->segment(2);

        $data['categories'] = $this->config->item('artist_category');
        $data['skills'] = $this->config->item('artist_level');

        $this->load->view('global/header');
        $this->load->view('workshop/all', $data);
        $this->load->view('global/footer');
    }

    public function search() {

        $this->app->set_title('Search Workshop');
        $this->load->model('workshop_model');

        $postdata = $this->input->post('fac_workshop');
        if (empty($postdata['type_id']))
            $type_id = 0;
        else
            $type_id = $postdata['type_id'];

        //$type_id =0:a-z; 1:nearby; =2:price; =3:availyblity; =4:skilly; =5:soonely
        $keyword = $postdata['keyword'];

        $config = array();
        $config["base_url"] = base_url() . "workshop/search";
        $config["total_rows"] = $this->workshop_model->count_workshop_search($keyword, $type_id);
        $config["per_page"] = $this->config->item('numof_workshop_paging');
        $config["uri_segment"] = 3;
        $choice = $config["total_rows"] / $config["per_page"];
        $config["num_links"] = round($choice);

        $this->load->library("pagination");
        $this->pagination->initialize($config);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0; //echo $page;exit;
        $data["workshop"] = $this->workshop_model->get_workshop_search($keyword, $type_id, $config["per_page"], $page);

        $data["workshop_tag"] = $this->workshop_model->get_workshop_search_tag($keyword, $type_id);

        $data["links"] = $this->pagination->create_links();

        $data["action"] = $this->uri->segment(2);

        $data['categories'] = $this->config->item('artist_category');
        $data['tags'] = $this->workshop_model->get_workshop_all_tags();

        $data['skills'] = $this->config->item('artist_level');
        $data['keyword'] = $keyword;
        $data['type_id'] = $type_id;

        $this->load->view('global/header');
        $this->load->view('workshop/search', $data);
        $this->load->view('global/footer');
    }

    public function popup($id=null) {
        $data['wid'] = $id;

        $this->load->view('workshop/popup', $data);
    }

    public function popup_send_mail($id=null) {

        $wid = $this->input->post('wid');
        if ($wid) {
            //send email

            $workshop = $this->workshop_model->get_email_workshop($wid);


            $this->load->library('email');
            $config['mailtype'] = 'html';
            $this->email->initialize($config);

            $from = $this->input->post('email');
            $this->email->from($from);
            $this->email->subject('Send Message To Teacher');

            $this->email->to($workshop[0]->email);

            $message = '';
            $message .= '<table width="100%" border="0" cellpadding="0" cellspacing="10">';
            $message .= '<tr><td width="1%" nowrap="">Message:</td></tr>';
            $message .= '<tr><td width="1%" nowrap="">' . $this->input->post('message') . ':</td></tr>';
            $message .= '</table>';

            $this->email->message($message);
            $this->email->send();

//            log_message("error", "from email:".$from);
//            log_message("error", "to email:".$workshop[0]->email);
//            log_message("error", "message:".$this->input->post('message'));
//            
            //$this->error->set_message('Send Message Sucessfully!', 'success');
        } else {
            $data['wid'] = $id;

            $this->load->view('workshop/popup_send_mail', $data);
        }
    }

    public function add_favorite() {
        $session_data = array();

        $wowkshop_id = $_POST['id'];
        $wowkshop_name = $_POST['name'];

        $favorite = $this->session->userdata('Favorite');
        if ($favorite) {
            foreach ($favorite as $row) {
                if ($wowkshop_id != $row['workshop_id']) {
                    $session_data['Favorite'][] = array(
                        'workshop_id' => $row['workshop_id'],
                        'workshop_name' => $row['workshop_name'],
                    );
                }
            }
        }

        $session_data['Favorite'][] = array(
            'workshop_id' => $wowkshop_id,
            'workshop_name' => $wowkshop_name
        );

        $this->session->set_userdata($session_data);

        return 1;
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
                $workshop_id = $this->workshop_model->save($postdata);

                $this->error->set_message('Add Workshop Sucessfully!', 'success');
                $this->app->redirect('/workshop/edit/' . $workshop_id);
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
                    $this->error->set_message('You are not authorized to access that location.', 'error');
                    $this->app->redirect('workshop');
                }

                //add file               
                $data['files'] = $this->workshop_model->get_files($id);
                $data['workshop_max_files'] = $this->config->item('workshop_max_files');

                //get student enrolled workshop                
                $data['enrolled'] = $this->workshop_model->get_student_enrolled($id);

                $data['categories'] = $this->config->item('artist_category');
                $data['skills'] = $this->config->item('artist_level');

                //total fee
                $data['total_enrolled'] = count($data['enrolled']);
                $fee = explode("$", $data['workshop'][0]->fee);
                if (isset($fee[1]))
                    $fee = $fee[1];
                else
                    $fee = $fee[0];

                $surcharge = $this->config->item('workshop_surcharge');
                $total = ($fee * $data['total_enrolled']);
                $total_surcharge = ($surcharge * $total ) / 100;
                $total_surcharge = round($total_surcharge, 3);

                $data['surcharge'] = $surcharge;
                $data['total'] = $total;
                $data['total_surcharge'] = $total_surcharge;
                $data['total_real'] = $total - $total_surcharge;

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

            $this->app->redirect('workshop/edit/' . $postdata['wid']);
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
            $this->app->redirect('workshop/edit/' . $postdata['wid']);
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

                $this->app->redirect('workshop/edit/' . $postdata['wid']);
            }

            $this->app->redirect('workshop');
        }
    }

    public function complete_event() {

        $session_uid = $this->session->userdata('user_id');
        $this->app->set_title('Complete Event');

        if (false === $session_uid) {
            $this->app->redirect('user/login/');
        } else {

            $postdata = $this->input->post('fac_workshop');

            if (!empty($postdata)) {

                $this->load->model('workshop_model');
                $workshop = $this->workshop_model->get_workshop($postdata['wid']);

                if (!empty($workshop)) {

                    //check permision of workshop
                    if ($session_uid != $workshop[0]->uid) {
                        $this->error->set_message('You are not authorized to access that location.', 'error');
                        $this->app->redirect('workshop');
                    }

                    //get student enrolled workshop                
                    $student_enrolled = $this->workshop_model->get_student_enrolled($postdata['wid']);

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

                    //insert workshop to experience
                    $job_date = !empty($workshop[0]->date) ? date("Y-m-d", strtotime($workshop[0]->date)) : null;

                    $data_experience = array(
                        'uid' => $session_uid,
                        'job_event_title' => $workshop[0]->name,
                        'job_description' => $workshop[0]->description,
                        'job_date' => $job_date,
                        'job_location' => $workshop[0]->location,
                        'artist_level' => $workshop[0]->skill_level
                    );

                    $this->db->insert('fa_users_experience', $data_experience);

                    $this->error->set_message('Complete Event Sucessfully!', 'success');

                    $this->app->redirect('user/profile');
                }
            }
        }
    }

    //guest view
    public function view($id) {
        if (empty($id)) {
            $this->app->redirect('workshop');
        } else {
            $session_uid = $this->session->userdata('user_id');
            $this->app->set_title('View Workshop');

            if (false === $session_uid) {
                $this->app->redirect('user/login/');
            } else {

                $this->load->model('workshop_model');
                $data['workshop'] = $this->workshop_model->get_workshop($id);

                $data['categories'] = $this->config->item('artist_category');
                $data['skills'] = $this->config->item('artist_level');

                $this->load->view('global/header');
                $this->load->view('workshop/view', $data);
                $this->load->view('global/footer');
            }
        }
    }

    public function enroll($id) {
        if (empty($id)) {
            $this->app->redirect('workshop');
        } else {
            $this->load->model('workshop_model');
            $data['workshop'] = $this->workshop_model->get_workshop($id);

            $data['categories'] = $this->config->item('artist_category');
            $data['skills'] = $this->config->item('artist_level');
            $data['enrolled'] = $this->workshop_model->get_student_enrolled($id);
            //add file               
            $data['files'] = $this->workshop_model->get_files($id);

            $this->load->view('global/header');
            $this->load->view('workshop/enroll', $data);
            $this->load->view('global/footer');
        }
    }

}

?>