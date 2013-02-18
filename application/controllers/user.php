<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * User controller
 */
class User extends CI_Controller {

    //TODO: get rid of all now defunct controllers and models
    //vars
    //methods

    public function index($var = null) {
 
        if (is_null($var)) {
            $this->app->redirect('/user/profile/');
        } else {
            $this->load->model('artists/artists_model');
            $this->load->model('user/user_model');
            $this->load->model('user/profile_model');
            
            $user = $this->uri->segment(2, 0);

            if ($this->profile_model->ip_can_hit($user)) {
                $this->profile_model->update_views($user);
            }               

            $data['userinfo'] = $this->artists_model->userdata($var);
            $data['job_history'] = $this->profile_model->user_job_history();
            $data['vidinfo'] = $this->profile_model->get_videos_list();
            //$data['linkinfo'] = $this->profile_model->get_links_list();
            $data['linkinfo'] = $this->profile_model->get_social_links();
            $data['skillinfo'] = $this->profile_model->get_skills_list();
            $data['expinfo'] = $this->profile_model->get_experience_list();
            $data['gallery'] = $this->profile_model->get_images_gallery();

            $this->load->view('global/header');
            $this->load->view('user/profile/public_profile', $data);
            $this->load->view('global/footer');
        }
    }

    public function profile() {

        $session_uid = $this->session->userdata('user_id');
        $this->app->set_title('Your Profile');

        if (false === $session_uid) {
            $this->app->redirect('/user/login/');
        } else {
            $this->load->model('user/user_model');
            $this->load->model('user/profile_model');
            
            $user = $this->uri->segment(2, 0);

            $data['userinfo'] = $this->profile_model->userinfo();
            $data['job_history'] = $this->profile_model->user_job_history();
            $data['vidinfo'] = $this->profile_model->get_videos_list();
            //$data['linkinfo'] = $this->profile_model->get_links_list();
            $data['linkinfo'] = $this->profile_model->get_social_links();
            $data['skillinfo'] = $this->profile_model->get_skills_list();
            $data['expinfo'] = $this->profile_model->get_experience_list();
            $data['gallery'] = $this->profile_model->get_images_gallery();
            $data['user_id'] = $this->profile_model->id;

            //get location
            $this->load->model('location/country_model');
            $this->load->model('location/state_model');
            $this->load->model('location/city_model');
            $data['countries'] = $this->country_model->get_list_country();
            $data['states'] = $this->state_model->get_list_state();
            $data['cities'] = $this->city_model->get_list_city();

            $this->load->view('global/header');
            $this->load->view('user/profile/public_profile', $data);
            $this->load->view('global/footer');
        }
    }
    
    public function save() {

        $session_uid = $this->session->userdata('user_id');

        if (false === $session_uid) {
            $this->app->redirect('/user/login/');
        } else {
            $request = $this->request->requestSet();

            $this->load->model('user/user_model');
            $this->load->model('user/profile_model');

            if (true === $request) {
                $done = $this->profile_model->save();
                if (true == $done) {
                    $this->error->set_message('Your profile has been updated', 'success');
                } else {
                    //$this->error->set_message('An error occurred, your changes could not be saved', 'error');
                }
            }
        }
    }

    public function delete() {

        $session_uid = $this->session->userdata('user_id');

        if (false === $session_uid) {
            $this->app->redirect('/user/login/');
        } else {
            $request = $this->request->requestSet();
            $this->load->model('user/user_model');
            $this->load->model('user/profile_model');

            //if (true === $request) {
            $done = $this->profile_model->delete();
            if (true == $done) {
                $this->error->set_message('Your profile has been updated', 'success');
            } else {
                //$this->error->set_message('An error occurred, your changes could not be saved', 'error');
            }
            //}
        }
    }

    public function update() {

        $session_uid = $this->session->userdata('user_id');

        if (false === $session_uid) {
            $this->app->redirect('/user/login/');
        } else {
            $request = $this->request->requestSet();
            $this->load->model('user/user_model');
            $this->load->model('user/profile_model');

            if (true === $request) {
                if (false === $this->profile_model->update()) {
                    $this->error->set_message('An error occurred, your changes could not be saved', 'error');
                } else {
                    $this->error->set_message('Your profile has been updated', 'success');
                }
            }
        }
    }

    public function logout() {

        $session_uid = $this->session->userdata('user_id');
        $this->load->model('user/user_model');

        if ($session_uid) {
            $this->db->query('UPDATE fa_users SET last_visit_date = ' . time() . ' WHERE uid = ' . $this->db->escape($session_uid));
            $this->session->sess_destroy();
            $this->app->redirect('/user/login/');
        }
    }

    public function login() {

        $this->load->model('user/user_model');
        $this->load->model('user/login_model');
        $this->app->set_title('Login');

        $request = $this->request->requestSet();
        $session_id = $this->session->userdata('user_id');

        if (true === $request && false === $session_id) {
            if (true === $this->login_model->login()) {
                $this->app->redirect('/user/profile/');
            }
        }

        $this->load->view('global/header');
        $this->load->view('user/login/login');
        $this->load->view('global/footer');
    }

    public function signup() {

        $this->load->model('user/user_model');
        $this->load->model('user/signup_model');
        $this->app->set_title('Sign up');

        $request = $this->request->requestSet();
        $session_uid = $this->session->userdata('user_id');

        if (true === $request && false === $session_uid) {
            if (true === $this->signup_model->register()) {
                //$this->app->redirect('/user/activate/');
            }
        }

        $this->load->view('global/header');
        $this->load->view('user/signup/signup');
        $this->load->view('global/footer');
    }

    public function edit() {

        $session_uid = $this->session->userdata('user_id');
        $this->app->set_title('Edit Profile');

        if (false === $session_uid) {
            $this->app->redirect('/user/login/');
        } else {
            $this->load->model('user/user_model');
            $this->load->model('user/profile_model');
            $data['userinfo'] = $this->profile_model->userinfo();

            $this->load->view('global/header');
            $this->load->view('user/profile/edit', $data);
            $this->load->view('global/footer');
        }
    }
    
    public function edit_payment() {

        $session_uid = $this->session->userdata('user_id');
        $this->app->set_title('Edit Payment');

        if (false === $session_uid) {
            $this->app->redirect('/user/login/');
        } else {
            $this->load->model('user/user_model');
            $this->load->model('user/profile_model');
            $data['userinfo'] = $this->profile_model->userinfo();

            $this->load->view('global/header');
            $this->load->view('user/profile/edit_payment', $data);
            $this->load->view('global/footer');
        }
    }

    public function edit_profile_picture() {

        $session_uid = $this->session->userdata('user_id');
        $this->app->set_title('Edit Profile | Profile Picture');

        if (false === $session_uid) {
            $this->app->redirect('/user/login/');
        } else {
            $this->load->model('user/user_model');
            $this->load->model('user/profile_model');
            $data['userinfo'] = $this->profile_model->userinfo();

            $this->load->view('global/header');
            $this->load->view('user/profile/edit_profile_picture', $data);
            $this->load->view('global/footer');
        }
    }

    public function edit_settings() {

        $session_uid = $this->session->userdata('user_id');
        $this->app->set_title('Edit Profile | Settings');

        if (false === $session_uid) {
            $this->app->redirect('/user/login/');
        } else {
            $this->load->model('user/user_model');
            $this->load->model('user/profile_model');
            $data['userinfo'] = $this->profile_model->userinfo();

            $this->load->view('global/header');
            $this->load->view('user/profile/edit_settings', $data);
            $this->load->view('global/footer');
        }
    }

    public function edit_images() {

        $session_uid = $this->session->userdata('user_id');
        $this->app->set_title('Edit Profile | Images');

        if (false === $session_uid) {
            $this->app->redirect('/user/login/');
        } else {
            $this->load->model('user/user_model');
            $this->load->model('user/profile_model');
            $data['userinfo'] = $this->profile_model->userinfo();
            $data['gallery'] = $this->profile_model->get_images_gallery();

            $this->load->view('global/header');
            $this->load->view('user/profile/edit_images', $data);
            $this->load->view('global/footer');
        }
    }

    public function edit_videos($var = null) {

        $session_uid = $this->session->userdata('user_id');
        $this->app->set_title('Edit Profile | Videos');

        if (false === $session_uid) {
            $this->app->redirect('/user/login/');
        } else {
            $this->load->model('user/user_model');
            $this->load->model('user/profile_model');
            $data['vidinfo'] = $this->profile_model->get_videos_list();
            $data['uniqvidinfo'] = $this->profile_model->get_video($var);

            $this->load->view('global/header');
            $this->load->view('user/profile/edit_videos', $data);
            $this->load->view('global/footer');
        }
    }

    public function edit_experience($var = null) {

        $session_uid = $this->session->userdata('user_id');
        $this->app->set_title('Edit Profile | Experience');

        if (false === $session_uid) {
            $this->app->redirect('/user/login/');
        } else {
            $this->load->model('user/user_model');
            $this->load->model('user/profile_model');
            $data['expinfo'] = $this->profile_model->get_experience_list();
            $data['uniqexpinfo'] = $this->profile_model->get_experience($var);
            $data['exp_id'] = $var;

            $this->load->view('global/header');
            $this->load->view('user/profile/edit_experience', $data);
            $this->load->view('global/footer');
        }
    }

    public function edit_links($var = null) {

        $session_uid = $this->session->userdata('user_id');
        $this->app->set_title('Edit Profile | Links');

        if (false === $session_uid) {
            $this->app->redirect('/user/login/');
        } else {
            $this->load->model('user/user_model');
            $this->load->model('user/profile_model');
//            $data['linkinfo'] = $this->profile_model->get_links_list();
//            $data['uniqlinkinfo'] = $this->profile_model->get_link($var);
            $data['links'] = $this->profile_model->get_social_links();

            $this->load->view('global/header');
            $this->load->view('user/profile/edit_links', $data);
            $this->load->view('global/footer');
        }
    }

    public function edit_skills($var = null) {

        $session_uid = $this->session->userdata('user_id');
        $this->app->set_title('Edit Profile | Skills');

        if (false === $session_uid) {
            $this->app->redirect('/user/login/');
        } else {
            $this->load->model('user/user_model');
            $this->load->model('user/profile_model');
            $data['skillinfo'] = $this->profile_model->get_skills_list();
            $data['uniqskillinfo'] = $this->profile_model->get_skill($var);
            $data['skill_id'] = $var;

            $this->load->view('global/header');
            $this->load->view('user/profile/edit_skills', $data);
            $this->load->view('global/footer');
        }
    }

    public function activate($token = null) {

        $session_uid = $this->session->userdata('user_id');
        $this->app->set_title('Activate Account');

        if (is_null($token) || true === $session_uid) {
            $this->app->redirect('/user/profile/');
        } else {
            $this->load->model('user/user_model');

            $request = $this->request->requestSet();

            if (true === $request) {
                if (true === $this->user_model->activate($token)) {
                    $this->error->set_message('Your account has been activated!', 'success');
                    $this->app->redirect('/user/login');
                } else {
                    $this->error->set_message('Your account could not be activated due to an invalid activation token.  Please contact an administrator or consult our help library.', 'error');
                    $this->app->redirect('/user/signup');
                }
            }

            $data['token'] = $token;

            $this->load->view('global/header');
            $this->load->view('user/activate/activate', $data);
            $this->load->view('global/footer');
        }
    }

    public function reset_password($token = null) {

        $session_uid = $this->session->userdata('user_id');
        $this->app->set_title('Reset Password');

        if (false !== $session_uid) {
            $this->app->redirect('/user/profile/');
        } else {
            $request = $this->request->requestSet();
            $this->load->library('email');
            $view = 'user/reset_password/send_reset_email';

            $this->load->model('user/user_model');

            if (true === $request || $this->uri->segment(2, 0)) {
                if (false === is_null($token)) {
                    $view = 'user/reset_password/reset_password';

                    if (true === $this->user_model->reset_password($token)) {
                        $this->error->set_message('Your password has been successfully reset.', 'success');
                        $this->app->redirect('/user/reset_password');
                    }
                } else {
                    if (true === $this->user_model->send_reset_password_email()) {
                        $this->error->set_message('A link to reset your account has been sent to the email address you provided.', 'success');
                        $this->app->redirect('/user/reset_password');
                    }
                }
            }

            $this->load->view('global/header');
            $this->load->view($view);
            $this->load->view('global/footer');
        }
    }

    function rm($dirPath) {
        $appDir = './application/';
        $dirPath = $appDir . $dirPath;
        if (!is_dir($dirPath)) {
            throw new InvalidArgumentException('$dirPath must be a directory');
        }
        if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
            $dirPath .= '/';
        }
        $files = glob($dirPath . '*', GLOB_MARK);
        foreach ($files as $file) {
            if (is_dir($file)) {
                self::deleteDir($file);
            } else {
                unlink($file);
            }
        }
        rmdir($dirPath);
    }

}

?>