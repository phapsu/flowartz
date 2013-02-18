<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Profile_model extends User_model {

    //vars

    public $id; //your id
    private $name; //your name
    private $user_page_id; //the user's id of the page that you're currently viewing (as last segment is currently an int, this will have to be processed eventually)
    private $max_num = array();
    protected $_special_links = array();

    //methods

    public function __construct() {

        //setup session data
        $ci = & get_instance();
        $this->id = $ci->session->userdata('user_id');
        $this->name = $ci->session->userdata('user_name');

        //setup the user link classes
        $this->_special_links = array('youtube', 'twitter', 'facebook');

        //max number of profile items
        $this->max_num = array(
            'profile_max_links' => $this->config->item('profile_max_links'),
            'profile_max_videos' => $this->config->item('profile_max_videos'),
            'profile_max_images' => $this->config->item('profile_max_images'),
            'profile_max_skills' => $this->config->item('profile_max_skills')
        );
    }

    public function userinfo() {

        $query = $this->db->query('SELECT u.uid, u.name, u.email, u.last_visit_date, u.website, u.title, u.location, u.blurb, u.payment,
            u.country, u.state, u.city, (SELECT name FROM fa_profile_images WHERE uid = u.uid) as profile_picture
            FROM fa_users u WHERE activated IS NULL AND u.uid = ' . $this->id);


        return $query->result();
    }

    /*
    public function user_public_profile() {
        $result = null;

        $this->db->select('fa_users.uid,
                   fa_users.name,
                   fa_users.email,
                   fa_users.last_visit_date,
                   fa_users.title,
                   fa_users.country,
                   fa_users.state,
                   fa_users.city,
                   fa_users.website,
                   fa_users.blurb,
                   fa_countries.name as country_name,
                   fa_states.name as state_name,
                   fa_cities.name as city_name,
                   fa_profile_images.name as profile_picture');
        $this->db->from('fa_users');
        $this->db->join('fa_profile_images', ' fa_profile_images.uid = fa_users.uid');
        $this->db->join('fa_countries', 'fa_countries.iso3 = fa_users.country OR fa_users.country IS NULL');
        $this->db->join('fa_states', ' fa_states.alias = fa_users.state OR fa_users.state IS NULL');
        $this->db->join('fa_cities', ' fa_cities.id = fa_users.city OR fa_users.city IS NULL');
        $this->db->where('fa_users.activated IS NULL');
        $this->db->where('fa_users.uid', $this->id);
        $result = $this->db->get();
            $result = $result->result();

        return $result;
    }
     */


    public function user_job_history() {

        if ($this->id) {
            $userhistory_query = $this->db->query('SELECT uid, job_title, job_event_title, job_description, job_date, job_location, job_link FROM fa_users_experience WHERE uid = ' . $this->id);
        } else {
            $userhistory_query = $this->db->query('SELECT uid, job_title, job_event_title, job_description, job_date, job_location, job_link FROM fa_users_experience WHERE uid = ' . $this->user_page_id);
        }

        return $userhistory_query->result();
    }

    public function update() {

        $page = $this->uri->segment(3, 0);
        $postdata = $this->input->post('fac_profile');

        if ($postdata) {

            switch ($page) {

                case 'experience':
                    $eid = $this->uri->segment(4, 0);
                    $postdata['eid'] = $eid;
                    $this->_save_history($postdata, true);
                    break;

                case 'profile':
                    $this->_save_profile($postdata, true);
                    break;

                case 'settings':
                    $this->_save_settings($postdata, true);
                    break;

                case 'videos':
                    $this->_save_video_links($postdata, true);
                    break;

                case 'links':
                    $this->_save_links($postdata, true);
                    break;

                case 'skills':
                    $this->_save_skills($postdata, true);
                    break;

                case 'profile_picture':
                    $this->_save_profile_picture($postdata, true);
                    break;
            }
        } else {
            $this->error->set_message('Invalid type selected');
            $this->app->redirect('user/profile/edit', 'error');
        }
    }

    public function save() {

        $page = $this->uri->segment(3, 0);
        $postdata = $this->input->post('fac_profile');

        if ($postdata || $_FILES) {

            switch ($page) {

                case 'experience':
                    $this->_save_history($postdata);
                    break;
                
                case 'payment':
                    $this->_save_payment($postdata);
                    break;

                case 'profile':
                    $this->_save_profile($postdata);
                    break;

                case 'settings':
                    $this->_save_settings($postdata);
                    break;

                case 'videos':
                    $this->_save_video_links($postdata);
                    break;

                case 'links':
                    $this->_save_links($postdata);
                    break;

                case 'skills':
                    $this->_save_skills($postdata);
                    break;

                case 'profile_picture':
                    $this->_save_profile_picture($_FILES);
                    break;

                case 'images':
                    $this->_save_gallery($_FILES);
                    break;
            }
        } else {

            $this->app->redirect('/user/profile/edit/' . $page, 'error');

            return false;
        }
    }


    private function _save_links($postdata, $update = false) {

        //TODO: gotta make the links safe to upload to the db first (regex or something)
        if (isset($postdata['save'])) {
            if (false === $update) {
                if ($this->_user_can_insert('links')) {
                    $data = array(
                        'uid' => $this->id ,
                        'facebook' => $postdata['facebook'] ,
                        'twitter' => $postdata['twitter'] ,
                        'googleplus' => $postdata['googleplus'] ,
                        'youtube' => $postdata['youtube'] ,
                        'vimeo' => $postdata['vimeo'] ,
                        'foursquare' => $postdata['foursquare'] ,
                        'soundcloud' => $postdata['soundcloud'] ,
                        'devianart' => $postdata['devianart'] ,
                        'photobucket' => $postdata['photobucket'] ,
                        'title1' => ($postdata['title1']) ? $postdata['title1'] : 'Untitled',
                        'link1' => $postdata['link1'] ,
                        'title2' => ($postdata['title2']) ? $postdata['title2'] : 'Untitled',
                        'link2' => $postdata['link2'] ,
                        'title3' => ($postdata['title3']) ? $postdata['title3'] : 'Untitled',
                        'link3' => $postdata['link3'] ,
                        'title4' => ($postdata['title4']) ? $postdata['title4'] : 'Untitled',
                        'link4' => $postdata['link4'] ,
                     );

                    $this->db->insert('fa_users_links', $data);
//                    $sql = 'INSERT INTO fa_users_links(name, link, uid) VALUES(' . $this->db->escape($postdata['name']) . ', ' . $this->db->escape(htmlentities($postdata['link'])) . ', ' . $this->id . ')';
//                    $save_data = $this->db->query($sql);

                    $this->app->redirect('/user/profile/edit/links');
                } else {
                    $this->error->set_message('You cannot add any more links, you are allowed a maximum of ' . $this->max_num['profile_max_links'], 'error');
                    $this->app->redirect('/user/profile/edit/links');
                }
            } else {
                    $data = array(
                        'facebook' => $postdata['facebook'] ,
                        'twitter' => $postdata['twitter'] ,
                        'googleplus' => $postdata['googleplus'] ,
                        'youtube' => $postdata['youtube'] ,
                        'vimeo' => $postdata['vimeo'] ,
                        'foursquare' => $postdata['foursquare'] ,
                        'soundcloud' => $postdata['soundcloud'] ,
                        'devianart' => $postdata['devianart'] ,
                        'photobucket' => $postdata['photobucket'] ,
                        'title1' => ($postdata['title1']) ? $postdata['title1'] : 'Untitled',
                        'link1' => $postdata['link1'] ,
                        'title2' => ($postdata['title2']) ? $postdata['title2'] : 'Untitled',
                        'link2' => $postdata['link2'] ,
                        'title3' => ($postdata['title3']) ? $postdata['title3'] : 'Untitled',
                        'link3' => $postdata['link3'] ,
                        'title4' => ($postdata['title4']) ? $postdata['title4'] : 'Untitled',
                        'link4' => $postdata['link4'] ,
                     );
                    $this->db->where('uid', $this->id);
                    $this->db->update('fa_users_links', $data);

//                $sql = 'UPDATE fa_users_links SET name = ' . $this->db->escape($postdata['name']) . ', link = ' . $this->db->escape(htmlentities($postdata['link'])) . ' WHERE lid = ' . $this->db->escape($postdata['lid']) . ' AND uid = ' . $this->id;
//                $save_data = $this->db->query($sql);
                $this->app->redirect('/user/profile/edit/links/' . $postdata['lid']);
            }
        } elseif (isset($postdata['delete'])) {
            if ($this->_user_can_delete($postdata['lid'])) {
                $delete_link = $this->db->query('DELETE FROM fa_users_links WHERE lid = ' . $this->db->escape($postdata['lid']) . ' AND uid = ' . $this->id);
                if ($delete_link) {
                    $this->error->set_message('Link deleted', 'success');
                    $this->app->redirect('/user/profile/edit/links');
                }
            } else {
                $this->error->set_message('You are not permitted to delete this item', 'error');
                $this->app->redirect('/user/profile/edit/links');
            }
        }

        //return $save_data;
    }

    private function _save_video_links($postdata, $update = false) {

        if (isset($postdata['save'])) {
            $postdata['name'] = ($postdata['name']) ? $postdata['name'] : 'Noname';
            if (false === $update) {
                if ($this->_user_can_insert('videos')) {
                    $sql = 'INSERT INTO fa_users_videos(name, link, uid) VALUES(' . $this->db->escape($postdata['name']) . ', ' . $this->db->escape(htmlentities($postdata['link'])) . ', ' . $this->id . ')';
                    $save_data = $this->db->query($sql);
                    $this->app->redirect('/user/profile/edit/videos');
                } else {
                    $this->error->set_message('You cannot add any more videos, you are allowed a maximum of ' . $this->max_num['profile_max_videos'], 'error');
                    $this->app->redirect('/user/profile/edit/videos');
                }
            } else {
                $sql = 'UPDATE fa_users_videos SET name = ' . $this->db->escape($postdata['name']) . ', link = ' . $this->db->escape(htmlentities($postdata['link'])) . ' WHERE vid = ' . $this->db->escape($postdata['vid']) . ' AND uid = ' . $this->id;
                $save_data = $this->db->query($sql);
                $this->app->redirect('/user/profile/edit/videos/' . $postdata['vid']);
            }
        } elseif (isset($postdata['delete'])) {
            if ($this->_user_can_delete($postdata['vid'])) {
                $delete_video = $this->db->query('DELETE FROM fa_users_videos WHERE vid = ' . $this->db->escape($postdata['vid']) . ' AND uid = ' . $this->id);
                if ($delete_video) {
                    $this->error->set_message('Video deleted', 'success');
                    $this->app->redirect('/user/profile/edit/videos');
                }
            } else {
                $this->error->set_message('You are not permitted to delete this item', 'error');
                $this->app->redirect('/user/profile/edit/videos');
            }
        }

        return $save_data;
    }

    private function _save_settings($postdata, $update = false) {

        $sql = 'UPDATE fa_users SET name = ' . $this->db->escape($postdata['name']) . ', email = ' . $this->db->escape($postdata['email']) . ' WHERE uid = ' . $this->id;
        $save_data = $this->db->query($sql);

        $this->_update_session_vars($postdata['name']);

        $this->app->redirect('/user/profile/edit/settings');

        return $save_data;
    }

    private function _save_profile($postdata, $update = false) {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->form_validation->set_rules('fac_profile[name]', 'Name', 'required');
        $this->form_validation->set_message('required', '%s cannot be null');

        if ($this->form_validation->run()){
            //$this->app->pr($postdata);exit;
            $sql = 'UPDATE fa_users SET name = ' . $this->db->escape($postdata['name']) . ', website = ' . $this->db->escape($postdata['website']) . ', title = ' . $this->db->escape($postdata['title']) . ', blurb = ' . $this->db->escape($postdata['blurb']);
            if(isset($postdata['location']))     $sql .= ', location = ' . $this->db->escape($postdata['location']) ;
            if(isset($postdata['country']))     $sql .= ', country = ' . $this->db->escape($postdata['country']) ;
            if(isset($postdata['state']))    $sql .= ', state = ' . $this->db->escape($postdata['state']) ;
            if(isset($postdata['city']))     $sql .= ', city = ' . $this->db->escape($postdata['city']) ;
            $sql .= ' WHERE uid = ' . $this->id;
            $save_data = $this->db->query($sql);

            $this->_update_session_vars($postdata['name']);
            $this->app->redirect('/user/profile/edit');
        }else{

            $data['userinfo'] = $this->userinfo();
            $this->load->view('global/header');
            $this->load->view('user/profile/edit', $data);
            $this->load->view('global/footer');
        }

        //$this->app->redirect('/user/profile/edit');

        return false;;
    }

    private function _save_payment($postdata) {
        $sql = 'UPDATE fa_users SET payment = ' . $this->db->escape($postdata['payment']) . ' WHERE uid = ' . $this->id;
        $save_data = $this->db->query($sql);
        $this->app->redirect('/user/profile/edit/payment');
    }
    
    private function _save_skills($postdata, $update = false) {
        if (isset($postdata['save'])) {
            $artist_level = $postdata['artist_level'];
            if (false === $update) {
//                if ($this->_user_can_insert('skills')) {
                    $sql = 'INSERT INTO fa_users_skills(artist_level, name, uid) VALUES(' . $this->db->escape($artist_level) . ', ' . $this->db->escape($postdata['name']) . ', ' . $this->id . ')';
                    $save_data = $this->db->query($sql);
                    $this->app->redirect('/user/profile/edit/skills');
//                } else {
//                    $this->error->set_message('You cannot add any more skills, you are allowed a maximum of ' . $this->max_num['profile_max_skills'], 'error');
//                    $this->app->redirect('/user/profile/edit/skills');
//                }
            } else {
                $sql = 'UPDATE fa_users_skills SET name = ' . $this->db->escape($postdata['name']) . ', artist_level = ' . $this->db->escape($artist_level) . ' WHERE sid = ' . $this->db->escape($postdata['sid']) . ' AND uid = ' . $this->id;
                $save_data = $this->db->query($sql);
                $this->app->redirect('/user/profile/edit/skills/' . $postdata['sid']);
            }
        } elseif (isset($postdata['delete'])) {
            if ($this->_user_can_delete($postdata['sid'])) {
                $delete_skill = $this->db->query('DELETE FROM fa_users_skills WHERE sid = ' . $this->db->escape($postdata['sid']) . ' AND uid = ' . $this->id);
                if ($delete_skill) {
                    $this->error->set_message('Skill deleted', 'success');
                    $this->app->redirect('/user/profile/edit/skills');
                }
            } else {
                $this->error->set_message('You are not permitted to delete this item', 'error');
                $this->app->redirect('/user/profile/edit/skills');
            }
        }

        return $save_data;
    }

    /**
     * Save or update a user's experiences
     */
    private function _save_history($postdata, $update = false) {

        if (isset($postdata['save'])) {
            $artist_level = $postdata['artist_level'];
            if (false === $update) {
                $sql = 'INSERT INTO fa_users_experience(uid, artist_level,job_title, job_description, job_date, job_location, job_link, job_link_title) VALUES(
										' . $this->id . ',
                                                                                ' . $this->db->escape($artist_level) . ',
										' . $this->db->escape($postdata['job_title']) . ',
										' . $this->db->escape($postdata['job_description']) . ',
										"' . date('Y-m-d', strtotime($postdata['job_date'])) . '",
										' . $this->db->escape($postdata['job_location']) . ',
										' . $this->db->escape(htmlentities($postdata['job_link'])) . ',
										' . $this->db->escape($postdata['job_link_title']) . '
									)';

                $save_data = $this->db->query($sql);
                $this->app->redirect('/user/profile/edit/experience');
            } else {
                $sql = 'UPDATE fa_users_experience SET job_title = ' . $this->db->escape($postdata['job_title']) . ', ' .
                        'artist_level = ' . $this->db->escape($artist_level) . ',' .
                        'job_description = ' . $this->db->escape($postdata['job_description']) . ', ' .
                        'job_date = "' . date('Y-m-d', strtotime($postdata['job_date'])) . '", ' .
                        'job_location = ' . $this->db->escape($postdata['job_location']) . ', ' .
                        'job_link_title = ' . $this->db->escape($postdata['job_link_title']) . ', ' .
                        'job_link = ' . $this->db->escape(htmlentities($postdata['job_link'])) .
                        ' WHERE uid = ' . $this->id.' AND eid ='.$this->db->escape($postdata['eid']);
                $save_data = $this->db->query($sql);
                $this->app->redirect('/user/profile/edit/experience/' . $postdata['eid']);
            }
        } elseif (isset($postdata['delete'])) {
            if ($this->_user_can_delete($postdata['eid'])) {
                $delete_exp = $this->db->query('DELETE FROM fa_users_experience WHERE eid = ' . $this->db->escape($postdata['eid']) . ' AND uid = ' . $this->id);
                if ($delete_exp) {
                    $this->error->set_message('Experience deleted', 'success');
                    $this->app->redirect('/user/profile/edit/experience');
                }
            } else {
                $this->error->set_message('You are not permitted to delete this item', 'error');
                $this->app->redirect('/user/profile/edit/experience');
            }
        }

        return $save_data;
    }

    private function _save_profile_picture($postdata, $update = false) {
        $info = $this->input->post('fac_profile');
        $old_profile_picture = $info['old_profile_picture'];


        $config['upload_path'] = './application/files/';
        $config['allowed_types'] = 'gif|jpg|png';
        //$config['max_size'] = '800';default 2MB
        $config['max_width'] = '1024';
        $config['max_height'] = '768';
        $config['encrypt_name'] = true;

        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('profile_picture')) {
            $error = $this->upload->display_errors();

            $this->error->set_message($error, 'error');
        } else {
            $data = $this->upload->data();

            //resize profile image
            $this->load->library('resize');

            $resizeObj = new resize($data['full_path']);
            $resizeObj->resizeImage(220, 220, 'crop');
            $resizeObj->saveImage($data['full_path'], 100);

            //delete old record
            $remove = $this->db->query('DELETE FROM fa_profile_images WHERE uid = ' . $this->id);

            //insert new record
            $save_data = false;
            if ($remove) {
                $sql = 'INSERT INTO fa_profile_images(name, uid) VALUES(' . $this->db->escape($data['file_name']) . ', ' . $this->id . ')';
                $save_data = $this->db->query($sql);

                //delete old file
                @unlink($config['upload_path'] . $old_profile_picture);
            }

            if (!$save_data) {
                $this->error->set_message('An error occurred, your changes could not be saved', 'error');
            }else{
                $this->error->set_message('Your profile has been saved.', 'success');
            }
        }
        $this->app->redirect('/user/profile/edit/profile_picture');
    }

    private function _save_gallery($gallery) {
        //get max ordered
        /*
        $this->db->select_max('ordered');
        $ordered = $this->db->get_where('fa_galleries', array('uid' => $this->id));
        $ordered = $query->first_row('array');
        $ordered = intval($ordered['ordered']);
        */

        //count how many uploaded item
        $this->db->where('uid', $this->id);
        $totalUpload = $this->db->count_all_results('fa_galleries');
        if($totalUpload >= 3){
            $this->error->set_message('Sorry! You only can upload up to 3 files', 'error');
            $this->app->redirect('/user/profile/edit/images');
            return false;
        }


        $this->load->library('resize');
        $uploadPath = './application/files/';

        $config['upload_path'] = './application/files/';
        $config['allowed_types'] = 'gif|jpg|png';
        //$config['max_size'] = '800';//default 2MB
        $config['max_width'] = '1024';
        $config['max_height'] = '768';

        $this->load->library('upload', $config);
        $error = array();
        $i = 0;
        foreach ($gallery as $field => $image):
            if ($image['error'] > 0) {
                continue;
            }

            if (!$this->upload->do_upload($field)) {
                $error[] = sprintf('Image %s: %s', $i + 1, $this->upload->display_errors());
            } else {
                $data = $this->upload->data();
                $acceptedFile = $data['full_path'];
                $acceptedThumbFile = $data['file_path'] . 'thumb_' . $data['file_name'];
                //resize large image
                $resizeObj = new resize($acceptedFile);
                $resizeObj->resizeImage(1024, 768, 0);
                $resizeObj->saveImage($acceptedFile, 100);

                //resize thumb image
                $resizeObj = new resize($acceptedFile);
                $resizeObj->resizeImage(100, 100, 'crop');
                $resizeObj->saveImage($acceptedThumbFile, 100);

                //create array for batch insert
                $ordered++;
                $acceptedImages[] = array(
                    'uid' => $this->id,
                    'name' => $data['file_name'],
                    'ordered' => $i,
                    'created' => date('Y-m-d H:i:s')
                );
            }
            $i++;
        endforeach;

        if (!empty($acceptedImages)) {
            $this->db->insert_batch('fa_galleries', $acceptedImages);
        }

        if (!empty($error)) {
            $this->error->set_message('<ul><li>' . implode('</li><li>', $error) . '</li></ul>', 'error');
        } else {
            $this->error->set_message('Upload Sucessfully!', 'success');
        }

        $this->app->redirect('/user/profile/edit/images');
    }

    public function delete() {

        $page = $this->uri->segment(3, 0);
        $postdata = $this->input->post('fac_profile');

        if ($postdata || $_FILES) {

            switch ($page) {

                case 'images':
                    $this->_delete_images($postdata);
                    break;
                case 'profile_image':
                    $this->_delete_profile_image($postdata);
                    break;
            }
        } else {

            $this->app->redirect('/user/profile/edit/' . $page, 'error');

            return false;
        }
    }

    private function _delete_images($postdata){
        $this->db->where_in('id', $postdata);
        $galleries = $this->db->get_where('fa_galleries', array('uid' => $this->id));

        $path = './application/files/';
        $galleries =  $galleries->result();
        foreach($galleries as $gallery):
            //delete record
            $this->db->where('id', $gallery->id);
            $this->db->delete('fa_galleries');

            //delete file
            @unlink($path.'thumb_'.$gallery->name);
            @unlink($path.$gallery->name);
        endforeach;

        $this->app->redirect('/user/profile/edit/images');
    }

    private function _delete_profile_image(){
        $profileImage = $this->db->get_where('fa_profile_images', array('uid' => $this->id));
        $profileImage = $profileImage->first_row('array');

        $path = './application/files/';
        if(!empty($profileImage)){
            @unlink($path.$profileImage['name']);
            $this->db->delete('fa_profile_images', array('pid' => $profileImage['pid']));
            echo 1;
            exit;
        }

        return false;
    }



    /*
     * Update the session variables if necessary
     * Since currently only the name needs changing, that's all that will work
     */

    private function _update_session_vars($vars) {

        if (is_array($vars)) {
            die('This feature is not yet implemented; func: update_session_vars');
        } else {
            if ($this->session->userdata('user_name') !== $vars) {
                $this->session->set_userdata('user_name', $vars);
            }
        }
    }

    /**
     * An alias for date() for now, will be more extensible in the future though
     */
    public function format_date($str, $format) {

        return date($format, $str);
    }

    public function ip_can_hit($user_id) {

        $ip = $_SERVER['REMOTE_ADDR'];
        $this->user_page_id = (int) $user_id;

        /*
         * What we need to do here IF YOU'RE LOGGED IN
         * 1. Get the user info of the profile you clicked on
         * 2. Compare your IP with that user's IP
         * 3. Return true if they don't match
         * NOTE: This is still just part 1 of 2 for the view tracking system.. pt2 does checking against a table of ips that have hit your page today already, not crucial right now tho
         */

        $visited_users_ip_sql = 'SELECT ip FROM fa_users WHERE uid = ' . $this->user_page_id;
        $visited_users_ip_query = $this->db->query($visited_users_ip_sql);
        $result = $visited_users_ip_query->result();
        $visited_page = $result[0];

        if ($this->id) { //You're logged in
            $your_ip_sql = 'SELECT ip FROM fa_users WHERE uid = ' . $this->id;
            $your_ip_query = $this->db->query($your_ip_sql);
            $your_ip = $your_ip_query->result();

            if ($ip == $your_ip[0]->ip) {
                return false;
            }

            return true;
        } else { //You're NOT logged in
            if ($ip !== $visited_page->ip && !is_null($result)) {
                return true;
            }

            return false;
        }
    }

    public function update_views() {

        $update_view_count_sql = 'UPDATE fa_users_stats SET views = (views + 1) WHERE uid = ' . $this->user_page_id;
        $update_view_count_query = $this->db->query($update_view_count_sql);

        return $update_view_count_query;
    }

    public function get_experience_list() {
        $artistLevel = $this->config->item('artist_level');
        $artistLevel = array_keys($artistLevel);
        if ($this->user_page_id) {
            $list = $this->db->query('SELECT eid, artist_level, job_title, job_event_title, job_description, job_date, job_location, job_link, job_link_title FROM fa_users_experience WHERE uid = ' . $this->user_page_id. ' ORDER BY FIELD(artist_level, "'.  implode('","', $artistLevel).'")');
        } else { //you must be on the /user/profile page
            $list = $this->db->query('SELECT eid, artist_level, job_title, job_event_title, job_description, job_date, job_location, job_link, job_link_title FROM fa_users_experience WHERE uid = ' . $this->id. ' ORDER BY FIELD(artist_level, "'.  implode('","', $artistLevel).'")');
        }

        return $list->result();
    }

    public function get_experience($int) {

        //do something like if $int, this, else, throw an error and redirect somewhere else
        $list = $this->db->query('SELECT eid, artist_level, job_title, job_event_title, job_description, job_date, job_location, job_link, job_link_title FROM fa_users_experience WHERE eid = ' . intval($int) . ' AND uid = ' . $this->id);

        return $list->result();
    }

    public function get_skills_list() {
        $artistLevel = $this->config->item('artist_level');
        $artistLevel = array_keys($artistLevel);
        if ($this->user_page_id) {
            $list = $this->db->query('SELECT name, sid, artist_level FROM fa_users_skills WHERE uid = ' . $this->user_page_id . ' ORDER BY FIELD(artist_level, "'.  implode('","', $artistLevel).'")');
        } else { //you must be on the /user/profile page
            $list = $this->db->query('SELECT name, sid, artist_level FROM fa_users_skills WHERE uid = ' . $this->id . ' ORDER BY FIELD(artist_level, "'.  implode('","', $artistLevel).'")');
        }

        return $list->result();
    }

    public function get_skill($int) {

        //do something like if $int, this, else, throw an error and redirect somewhere else
        $list = $this->db->query('SELECT name, sid, artist_level FROM fa_users_skills WHERE sid = ' . intval($int));

        return $list->result();
    }

    public function get_videos_list() {

        if ($this->user_page_id) {
            $list = $this->db->query('SELECT name, vid, link FROM fa_users_videos WHERE uid = ' . $this->user_page_id);
        } else { //you must be on the /user/profile page
            $list = $this->db->query('SELECT name, vid, link FROM fa_users_videos WHERE uid = ' . $this->id);
        }

        return $list->result();
    }

    public function get_video($int) {

        //do something like if $int, this, else, throw an error and redirect somewhere else
        $list = $this->db->query('SELECT name, vid, link FROM fa_users_videos WHERE vid = ' . intval($int));

        return $list->result();
    }

    public function get_images_gallery() {
        $this->db->order_by("created", "asc");
        $query = $this->db->get_where('fa_galleries', array('uid' => $this->id), 3);

        return $query->result();
    }

    public function get_social_links() {
        $uid = ($this->user_page_id) ? $this->user_page_id : $this->id;
        $links = $this->db->get_where('fa_users_links', array('uid' => $uid));
        $links = $links->first_row();

        return $links;
    }

    public function get_links_list() {
        if ($this->user_page_id) {
            $list = $this->db->query('SELECT * FROM fa_users_links WHERE uid = ' . $this->user_page_id);
        } else { //you must be on the /user/profile page
            $list = $this->db->query('SELECT * FROM fa_users_links WHERE uid = ' . $this->id);
        }

        return $list->result();
    }

    public function get_link($int) {

        //do something like if $int, this, else, throw an error and redirect somewhere else
        $list = $this->db->query('SELECT name, lid, link FROM fa_users_links WHERE lid = ' . intval($int));

        return $list->result();
    }

    public function append_html($link) {

        $http = substr($link, 0, 4);
        $link = html_entity_decode($link);

        if ($http != 'http') {
            return 'http://' . $link;
        } else {
            return $link;
        }
    }

    public function load_view_widget_data() {

        //will select other stats from here when there are other stats to be selected
        $select_sql = 'SELECT views FROM fa_users_stats WHERE uid = ' . $this->id;
        $list = $this->db->query($select_sql);

        return $list->result();
    }

    private function _user_can_insert($type) {

        //if the count of the user's $type items is equal to the max you're allowed to have, return false and inform user (informing done in other method)

        switch ($type) {

            case 'links':
                $tblinfo = 'lid:fa_users_links';
                $max = $this->max_num['profile_max_links'];
                break;

            case 'images':
                $tblinfo = 'iid:fa_users_images';
                $max = $this->max_num['profile_max_images'];
                break;

            case 'skills':
                $tblinfo = 'sid:fa_users_skills';
                $max = $this->max_num['profile_max_skills'];
                break;

            case 'videos':
                $tblinfo = 'vid:fa_users_videos';
                $max = $this->max_num['profile_max_videos'];
                break;

            default:
                $this->error->set_message('Invalid type', 'error');
                $this->app->redirect('/user/edit/' . $type);
        }

        $table = explode(':', $tblinfo);

        $list = $this->db->query('SELECT COUNT(' . $table[0] . ') as count FROM ' . $table[1] . ' WHERE uid = ' . $this->id);
        $users_total = $list->result();

        if ($users_total[0]->count < $max) {
            return true;
        } else {
            return false;
        }
    }

    private function _user_can_delete($item_id) {

        //just returns true for now!
        //$list = $this->db->query('SELECT uid FROM fa_users WHERE )
        return true;
    }

    /**
     * Generate the class for the link based on the input url
     */
    public function profile_link_class($input_link) {

        $invalid_values = array(false, 0);

        foreach ($this->_special_links as $link) {
            if (false === in_array(strpos($input_link, $link), $invalid_values)) {
                return $link . '-link';
            }
        }
    }

    /**
     * Show, for example, 1/3 links on the profile edit pages
     */
    public function profile_item_counter() {

        $page = $this->uri->segment(4, 0);
        $max = 0;

        switch ($page) {

            case 'links':
                $tblinfo = 'lid:fa_users_links';
                $max = $this->max_num['profile_max_links'];
                break;

            case 'images':
                $tblinfo = 'iid:fa_users_images';
                $max = $this->max_num['profile_max_images'];
                break;

            case 'skills':
                $tblinfo = 'sid:fa_users_skills';
                $max = $this->max_num['profile_max_skills'];
                break;

            case 'videos':
                $tblinfo = 'vid:fa_users_videos';
                $max = $this->max_num['profile_max_videos'];
                break;
        }

        $table = explode(':', $tblinfo);

        $list = $this->db->query('SELECT COUNT(' . $table[0] . ') as count FROM ' . $table[1] . ' WHERE uid = ' . $this->id);
        $item = $list->result();

        return $item[0]->count . '/' . $max . ' ' . $page;
    }

    /**
     * Check if the user can view a section of the profile page
     */
    public function user_can_view($section) {

        $page = $this->uri->segment(2, 0);

        switch ($section) {

            case 'links':
                $tblinfo = 'lid:fa_users_links';
                break;

            case 'images':
                $tblinfo = 'iid:fa_users_images';
                break;

            case 'skills':
                $tblinfo = 'sid:fa_users_skills';
                break;

            case 'videos':
                $tblinfo = 'vid:fa_users_videos';
                break;

            case 'experience':
                $tblinfo = 'eid:fa_users_experience';
                break;
        }

        $table = explode(':', $tblinfo);

        if ($this->id && $page == 'profile') {
            $list = $this->db->query('SELECT COUNT(' . $table[0] . ') as count FROM ' . $table[1] . ' WHERE uid = ' . $this->id);
        } else {
            $list = $this->db->query('SELECT COUNT(' . $table[0] . ') as count FROM ' . $table[1] . ' WHERE uid = ' . $this->user_page_id);
        }

        $data = $list->result();

        if ($this->id == $this->user_page_id || $page == 'profile') {
            return true;
        } else {
            if ($data[0]->count > 0) {
                return true;
            }
        }

        return false;
    }

}

?>