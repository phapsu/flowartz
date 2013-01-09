<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Classroom_model extends User_model {

    //vars

    public $id; //id
    public $uid; //user_id
    public $type_id; //type_id
    private $name; //your name
    private $user_page_id; //the user's id of the page that you're currently viewing (as last segment is currently an int, this will have to be processed eventually)

    //methods

    public function __construct() {

        //setup session data
        $ci = & get_instance();
        $this->uid = $ci->session->userdata('user_id');
        $this->name = $ci->session->userdata('user_name');
        $this->type_id = $ci->session->userdata('type_id');
    }

    public function save() {

        $postdata = $this->input->post('fac_classroom');

        $from_date = !empty($postdata['from_date']) ? date("Y-m-d", strtotime($postdata['from_date'])) : null;
        $to_date = !empty($postdata['to_date']) ? date("Y-m-d", strtotime($postdata['to_date'])) : null;

        if ($postdata) {
            $data = array(
                'uid' => $this->uid,
                'name' => $postdata['name'],
                'paypal_code' => $postdata['paypal_code'],
                'from_date' => $from_date,
                'to_date' => $to_date,
                'fee' => $postdata['fee'],
                'fee_currency' => $postdata['fee_currency'],
                'description' => $postdata['description']
            );

            $this->db->insert('fa_users_classes', $data);

            $this->app->redirect('/user/classroom');
        } else {

            $this->app->redirect('/user/classroom');

            return false;
        }
    }

    public function update() {

        $postdata = $this->input->post('fac_classroom');

        if ($postdata) {
            $data = array(
                'uid' => $this->id,
                'name' => $postdata['name'],
                'paypal_code' => $postdata['paypal_code'],
                'from_date' => $postdata['from_date'],
                'to_date' => $postdata['to_date'],
                'fee' => $postdata['fee'],
                'fee_currency' => $postdata['fee_currency'],
                'description' => $postdata['description']
            );

            $this->db->where('cid', $this->id);
            $this->db->update('fa_users_links', $data);

            $this->app->redirect('/user/classroom');
        } else {

            $this->app->redirect('/user/classroom');

            return false;
        }
    }

    public function delete() {

        $postdata = $this->input->post('fac_classroom');

        if ($postdata) {
            $data = array(
                'uid' => $this->id,
                'name' => $postdata['name'],
                'paypal_code' => $postdata['paypal_code'],
                'from_date' => $postdata['from_date'],
                'to_date' => $postdata['to_date'],
                'fee' => $postdata['fee'],
                'fee_currency' => $postdata['fee_currency'],
                'description' => $postdata['description']
            );

            $delete_link = $this->db->query('DELETE FROM fa_users_links WHERE lid = ' . $this->db->escape($postdata['lid']) . ' AND uid = ' . $this->id);

            $this->app->redirect('/user/classroom');
        } else {

            $this->app->redirect('/user/classroom');

            return false;
        }
    }

    public function my_classroom() {

        $query = $this->db->query('SELECT * FROM fa_users_classes WHERE fa_users_classes.uid = ' . $this->uid);

        return $query->result();
    }

    public function show_classroom($user_id=null) {
        if (!empty($user_id)) {
            $query = $this->db->query('SELECT * FROM fa_users_classes WHERE fa_users_classes.status=0 and fa_users_classes.uid = ' . $user_id);

            return $query->result();
        }
        return false;
    }
    
    public function view_class($class_id=null){
        if(!empty ($class_id)){
            $query = $this->db->query('SELECT * FROM fa_users_classes WHERE fa_users_classes.cid = ' . $class_id);

            return $query->result();
        }
        return false;
    }
    
    public function user_can_view(){
        
        $user_id = $this->uri->segment(2, 0);
        
        if($user_id='profile') return true; //can see
        else{
            if($user_id==$this->uid) return true; //can see
            else return false; //can't see
        }
        
        return false;
    }

}

?>