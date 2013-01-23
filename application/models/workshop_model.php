<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Workshop_model extends CI_Model {

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

    public function save($postdata) {

        if ($postdata) {
            
            $date = !empty($postdata['date']) ? date("Y-m-d", strtotime($postdata['date'])) : null;
            $length = intval($postdata['length']);            
            $to_date = (!empty($date)) ? date("Y-m-d", strtotime($date +$length+' days')) : null;
            
            $data = array(
                'uid' => $this->uid,
                'name' => $postdata['name'],
                'teacher_name' => $postdata['teacher_name'],
                'date' => $date,
                'to_date' => $to_date,
                'time' => $postdata['time'],
                'length' => $postdata['length'],
                'time' => $postdata['time'],
                'frequency' => $postdata['frequency'],
                'location' => $postdata['location'],
                'cat_id' => $postdata['cat_id'],
                'tag' => $postdata['tag'],
                'skill_level' => $postdata['skill_level'],
                'spot_available' => $postdata['spot_available'],
                'tools_required' => $postdata['tools_required'],
                'fee' => $postdata['fee'],                
                'description' => $postdata['description']
            );

            $this->db->insert('fa_workshops', $data);

            return $this->db->insert_id();
        } else {
            return false;
        }
    }

    public function update($postdata) {
        if ($postdata) {
            $date = !empty($postdata['date']) ? date("Y-m-d", strtotime($postdata['date'])) : null;
            $length = intval($postdata['length']);            
            $to_date = (!empty($date)) ? date("Y-m-d", strtotime($date +$length+' days')) : null;
            
            $data = array(
                'uid' => $this->uid,
                'name' => $postdata['name'],
                'teacher_name' => $postdata['teacher_name'],
                'date' => $date,
                'to_date' => $to_date,
                'time' => $postdata['time'],
                'length' => $postdata['length'],
                'time' => $postdata['time'],
                'frequency' => $postdata['frequency'],
                'location' => $postdata['location'],
                'cat_id' => $postdata['cat_id'],
                'tag' => $postdata['tag'],
                'skill_level' => $postdata['skill_level'],
                'spot_available' => $postdata['spot_available'],
                'tools_required' => $postdata['tools_required'],
                'fee' => $postdata['fee'],                
                'description' => $postdata['description']
            );
                    
            $this->db->where('wid', $postdata['wid']);
            $this->db->update('fa_workshops', $data);
               return true;
        } else {

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

    public function my_workshop() {

        $query = $this->db->query('SELECT * FROM fa_workshops WHERE fa_workshops.uid = ' . $this->uid);

        return $query->result();
    }

    public function get_workshop($id, $admin=false) {
        if (!$admin) {
            $query = $this->db->query('SELECT w.*, i.name as i_name, u.email as email FROM fa_workshops as w left join fa_profile_images as i on w.uid = i.uid left join fa_users as u on w.uid = u.uid WHERE w.status=0 and w.wid = ' . $id);
        }
        else{
            $query = $this->db->query('SELECT w.*, i.name as i_name, u.email as email FROM fa_workshops as w left join fa_profile_images as i on w.uid = i.uid left join fa_users as u on w.uid = u.uid WHERE w.wid = ' . $id);
        }
        
        return $query->result();        
    }
    
    public function get_email_workshop($workshop_id){
        $query = $this->db->query('SELECT u.email FROM fa_workshops as w left join fa_users as u on w.uid = u.uid WHERE w.wid = ' . $workshop_id);
        
        return $query->result(); 
    }
    
    public function get_workshop_enrolled($id, $admin=false) {
        if (!$admin) {
            $query = $this->db->query('SELECT w.*, i.name as i_name FROM fa_workshops as w left join fa_profile_images as i on w.uid = i.uid WHERE w.status=0 and w.wid = ' . $id);
        }
        else{
            $query = $this->db->query('SELECT w.*, i.name as i_name FROM fa_workshops as w left join fa_profile_images as i on w.uid = i.uid WHERE w.wid = ' . $id);
        }
        
        return $query->result();        
    }
    
    //get workshop feature: (workshop in a week)
    public function get_workshop_featured(){
        
        $sunday = date("Y-m-d H:i:s", strtotime('Sunday'));
        $monday = date("Y-m-d H:i:s", strtotime('Sunday -6 days'));
        
        $sql = 'SELECT w.* , i.name as i_name FROM fa_workshops as w left join fa_profile_images as i on w.uid = i.uid WHERE DATEDIFF( "' . $sunday . '" , w.date) >= 0 and DATEDIFF( "' . $monday . '" , w.date) <= 0 and w.status = 0';
        //$sql = 'SELECT * FROM fa_workshops as w WHERE DATEDIFF( "' . $sunday . '" , w.date) >= 0 and DATEDIFF( "' . $monday . '" , w.date) <= 0 and w.status = 0';
        $sql .=' order by w.date desc limit 4';
        
        $query = $this->db->query($sql);
        return $query->result();        
    }
    
    //get workshop soon: (workshop in a next week)
    public function get_workshop_soon(){
        
        $sunday = date("Y-m-d H:i:s", strtotime('Sunday'));
        
        $sql = 'SELECT w.* , i.name as i_name FROM fa_workshops as w left join fa_profile_images as i on w.uid = i.uid WHERE DATEDIFF( "' . $sunday . '" , w.date) <= 0 and w.status = 0';
        //$sql = 'SELECT * FROM fa_workshops as w WHERE DATEDIFF( "' . $sunday . '" , w.date) <= 0 and w.status = 0';
        $sql .=' order by w.date desc limit 4';
        
        $query = $this->db->query($sql);
        return $query->result();        
    }
    
    //get workshop nearby: default: city Toronto
    public function get_workshop_nearby(){
        
        $sql = "SELECT w.* , i.name as i_name FROM fa_workshops as w left join fa_profile_images as i on w.uid = i.uid WHERE w.location like '%Toronto%'";
        $sql .=' order by w.date desc limit 4';
        
        $query = $this->db->query($sql);
        return $query->result();        
    }
    
    //get workshop in category
    public function get_workshop_all_tags(){
        
        $sql = "SELECT distinct tag FROM fa_workshops as w WHERE w.status = 0";
        $sql .=' order by w.date desc';
        
        $query = $this->db->query($sql);
        return $query->result();  
    }
    
    //get workshop in category
    public function get_workshop_all($limit=null, $start=null){
        
        $this->db->select('w.* , i.name as i_name');
        $this->db->from('fa_workshops as w');
        $this->db->join('fa_profile_images as i', ' w.uid = i.uid');
                
        if(!empty ($limit)){
            $this->db->limit($limit, $start);
        }
        
        $this->db->where('w.status = 0');
        
        $this->db->order_by("w.date", "DESC");        
        $query = $this->db->get();
   
        return $query->result();
    }
    
    public function count_workshop_all(){
        $this->db->from('fa_workshops');        
        $this->db->where('status = 0 ');
        return $this->db->count_all_results();
    }
    
    //get workshop in category
    public function get_workshop_cats($cat_id, $limit=null, $start=null){
        
        $this->db->select('*');
        $this->db->from('fa_workshops as w');
        //$this->db->join('fa_profile_images as i', ' w.uid = i.uid');
                
        if(!empty ($limit)){
            $this->db->limit($limit, $start);
        }
        
        $this->db->where('w.status = 0 and w.cat_id = '.$cat_id);
        
        $this->db->order_by("w.date", "DESC");        
        $query = $this->db->get();
   
        return $query->result();
    }
    
    public function count_workshop_cats($cat_id){
        $this->db->from('fa_workshops');        
        $this->db->where('status = 0 and cat_id = '.$cat_id);
        return $this->db->count_all_results();
    }
    
    //get workshop in tag
    public function get_workshop_tag($tag, $limit=null, $start=null){
        
        $this->db->select('*');
        $this->db->from('fa_workshops as w');
        //$this->db->join('fa_profile_images as i', ' w.uid = i.uid');
                
        if(!empty ($limit)){
            $this->db->limit($limit, $start);
        }
        
        $this->db->where("w.status = 0 and w.tag = '".$tag."'");
        
        $this->db->order_by("w.date", "DESC");        
        $query = $this->db->get();
   
        return $query->result();
    }
    
    public function count_workshop_tag($tag){
        $this->db->from('fa_workshops');        
        $this->db->where("status = 0 and tag = '".$tag."'");
        return $this->db->count_all_results();
    }
    
    //get workshop in category
    public function get_workshop_search($keyword, $type_id, $limit=null, $start=null){
        
        $this->db->select('*');
        $this->db->from('fa_workshops as w');
        //$this->db->join('fa_profile_images as i', ' w.uid = i.uid');
        
        if(!empty ($limit)){
            $this->db->limit($limit, $start);
        }
        
        switch ($type_id):
            case 0:{
                //a-z
                $this->db->where("w.status = 0 and w.name like '%".$keyword."%'");
                break;
            }
            case 1:{
                //nearby
                $this->db->where("w.status = 0 and w.location like '%".$keyword."%'");
                break;
            }
            case 2:{
                //price
                $this->db->where("w.status = 0 and w.fee like '%".$keyword."%'");
                break;
            }
            case 3:{
                //availyblity                
                $this->db->where("DATEDIFF(NOW() , w.date) >= 0 and DATEDIFF(NOW() , w.to_date) <= 0 and w.status = 0 and w.name like '%".$keyword."%'");
                
                break;
            }
            case 4:{
                //skilly
                $keyword = explode(" ", $keyword);
                $keyword = $keyword[0];
                
                $this->db->where("w.status = 0 and w.skill_level like '%".$keyword."%'"); // chi lay position dau 0
                break;
            }
            default:{
                //soonely
                $sunday = date("Y-m-d H:i:s", strtotime('Sunday'));
                $this->db->where("DATEDIFF( '" . $sunday . "' , w.date) <= 0 and w.status = 0 and w.name like '%".$keyword."%'");
                break;
            }
        endswitch;        
        
        $this->db->order_by("w.date", "DESC");        
        $query = $this->db->get();
   
        return $query->result();
    }
    
    public function get_workshop_search_tag($keyword, $type_id){
        
        $this->db->distinct();
        $this->db->select('tag');
        $this->db->from('fa_workshops as w');
        //$this->db->join('fa_profile_images as i', ' w.uid = i.uid');
         
        switch ($type_id):
            case 0:{
                //a-z
                $this->db->where("w.status = 0 and w.name like '%".$keyword."%'");
                break;
            }
            case 1:{
                //nearby
                $this->db->where("w.status = 0 and w.location like '%".$keyword."%'");
                break;
            }
            case 2:{
                //price
                $this->db->where("w.status = 0 and w.fee like '%".$keyword."%'");
                break;
            }
            case 3:{
                //availyblity                
                $this->db->where("DATEDIFF(NOW() , w.date) >= 0 and DATEDIFF(NOW() , w.to_date) <= 0 and w.status = 0 and w.name like '%".$keyword."%'");
                
                break;
            }
            case 4:{
                //skilly
                $keyword = explode(" ", $keyword);
                $keyword = $keyword[0];
                
                $this->db->where("w.status = 0 and w.skill_level like '%".$keyword."%'"); // chi lay position dau 0
                break;
            }
            default:{
                //soonely
                $sunday = date("Y-m-d H:i:s", strtotime('Sunday'));
                $this->db->where("DATEDIFF( '" . $sunday . "' , w.date) <= 0 and w.status = 0 and w.name like '%".$keyword."%'");
                break;
            }
        endswitch;        
            
        $query = $this->db->get();
        
        $data = array();
        
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row->tag;
            }
            return $data;
        }
        return false;
    }
    
    public function count_workshop_search($keyword, $type_id){
        $this->db->from('fa_workshops as w');        
        switch ($type_id):
            case 0:{
                //a-z
                $this->db->where("w.status = 0 and w.name like '%".$keyword."%'");
                break;
            }
            case 1:{
                //nearby
                $this->db->where("w.status = 0 and w.location like '%".$keyword."%'");
                break;
            }
            case 2:{
                //price
                $this->db->where("w.status = 0 and w.fee like '%".$keyword."%'");
                break;
            }
            case 3:{
                //availyblity                
                $this->db->where("DATEDIFF(NOW() , w.date) >= 0 and DATEDIFF(NOW() , w.to_date) <= 0 and w.status = 0 and w.name like '%".$keyword."%'");
                
                break;
            }
            case 4:{
                //skilly
                $keyword = explode(" ", $keyword);
                $keyword = $keyword[0];
                
                $this->db->where("w.status = 0 and w.skill_level like '%".$keyword."%'"); // chi lay position dau 0
                break;
            }
            default:{
                //soonely
                $sunday = date("Y-m-d H:i:s", strtotime('Sunday'));
                $this->db->where("DATEDIFF( '" . $sunday . "' , w.date) <= 0 and w.status = 0 and w.name like '%".$keyword."%'");
                break;
            }
        endswitch;    
        
        return $this->db->count_all_results();
    }    
    
    public function get_files($id) {
        $this->db->order_by("created", "asc");
        $query = $this->db->get_where('fa_workshops_files', array('wid' => $id));

        return $query->result();
    }
    
    public function add_file($workshop_id, $gallery) {
        //get max ordered
        /*
        $this->db->select_max('ordered');
        $ordered = $this->db->get_where('fa_galleries', array('uid' => $this->id));
        $ordered = $query->first_row('array');
        $ordered = intval($ordered['ordered']);
        */

        //count how many uploaded item
        $this->db->where('wid', $workshop_id);
        $totalUpload = $this->db->count_all_results('fa_workshops_files');
        $workshop_max_files= $this->config->item('workshop_max_files');
        if($totalUpload >= $workshop_max_files){
            $this->error->set_message('Sorry! You only can upload up to '.$workshop_max_files.' files', 'error');
            //$this->app->redirect('/user/profile/edit/images');
            return false;
        }
        
        $uploadPath = './application/files/';

        $config['upload_path'] = './application/files/';
        //$config['allowed_types'] = 'gif|jpg|png';
        $config['allowed_types'] = 'doc|pdf|gif|jpg|png|xls|zip|rar';
        $config['max_size'] = '10240';//10MB
        

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
                
                //create array for batch insert
                
                $acceptedImages[] = array(
                    'wid' => $workshop_id,
                    'name' => $data['file_name'],
                    'ordered' => $i,
                    'created' => date('Y-m-d H:i:s')
                );
            }
            $i++;
        endforeach;

        if (!empty($acceptedImages)) {
            $this->db->insert_batch('fa_workshops_files', $acceptedImages);
        }

        if (!empty($error)) {
            $this->error->set_message('<ul><li>' . implode('</li><li>', $error) . '</li></ul>', 'error');
        } else {
            $this->error->set_message('Upload Sucessfully!', 'success');
        }

        return true;
    }
    
    public function delete_file($workshop_id, $postdata){
        $this->db->where_in('id', $postdata);
        $files = $this->db->get_where('fa_workshops_files', array('wid' => $workshop_id));

        $path = './application/files/';
        $files =  $files->result();
        foreach($files as $file):
            //delete record
            $this->db->where('id', $file->id);
            $this->db->delete('fa_workshops_files');

            //delete file
            @unlink($path.$file->name);
        endforeach;

        return true;
    }

    public function get_student_enrolled($workshop_id, $limit=null, $start=null){
//        $sql = 'SELECT ip FROM fa_users WHERE uid = ' . $this->user_page_id;
//        $query = $this->db->query($visited_users_ip_sql);
//        return $query->result();
        
        
        $this->db->select('fa_users.uid, 
                   fa_users.name, 
                   fa_users.email, 
                   fa_users.title, 
                   fa_users.country, 
                   fa_users.state, 
                   fa_users.city, 
                   ipn_orders.payment_fee,
                   ipn_orders.payment_gross,
                   fa_profile_images.name as profile_picture');
        $this->db->from('ipn_order_items');
        $this->db->join('ipn_orders', ' ipn_order_items.order_id = ipn_orders.id');
        $this->db->join('fa_users', ' fa_users.uid = ipn_orders.custom');        
        $this->db->join('fa_profile_images', ' fa_profile_images.uid = fa_users.uid');
        
        
        if(!empty ($limit)){
            $this->db->limit($limit, $start);
        }
        
        $this->db->where("ipn_order_items.item_name ='#".$workshop_id."'");
        
        $this->db->order_by("ipn_order_items.created_at", "ASC");        
        $query = $this->db->get();
        
//        if ($query->num_rows() > 0) {
//            foreach ($query->result() as $row) {
//                $data[] = $row;
//            }
//            return $data;
//        }
        return $query->result();
    }
    
    public function user_can_view() {
        $page = $this->uri->segment(2, 0);
        
        if ($page == 'profile')
            return true; //can see
        else  return false;
    }

}

?>