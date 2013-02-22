<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Artists_model extends CI_model {

    //vars

    protected $_data = null;
    protected $_postdata = null;

    //methods

    public function __construct() {

        //parent::__construct();
    }

    public function userdata($id = null) {

        if (is_null($id) || !is_numeric($id)) {
            $select_query = $this->db->query('SELECT u.name, u.uid, u.title, u.location, u.website, (SELECT name FROM fa_profile_images WHERE uid = u.uid LIMIT 1) as profile_picture FROM fa_users u WHERE u.activated IS NULL ORDER BY u.uid DESC');
        } else {
            $select_query = $this->db->query('SELECT u.uid, u.name, u.email, u.last_visit_date, u.website, u.title, u.location, u.blurb, (SELECT name FROM fa_profile_images WHERE uid = u.uid LIMIT 1) as profile_picture FROM fa_users u WHERE activated IS NULL AND u.uid  = ' . (int) $id);
        }

        return $select_query->result();
    }

    public function artist_count() {
        $this->db->from('fa_users');
        $this->db->join('fa_profile_images', ' fa_profile_images.uid = fa_users.uid');
        $this->db->where('activated IS NULL');
        return $this->db->count_all_results();
    }

    public function fetch_artists($limit, $start) {
        $this->db->select('fa_users.uid, 
                   fa_users.name, 
                   fa_users.title, 
                   fa_users.country, 
                   fa_users.state, 
                   fa_users.city, 
                   fa_profile_images.name as profile_picture');
        $this->db->from('fa_users');
        $this->db->join('fa_profile_images', ' fa_profile_images.uid = fa_users.uid');
        $this->db->limit($limit, $start);
        $this->db->where('activated IS NULL');
        $this->db->order_by("fa_users.uid", "DESC");        
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }

    public function popular($id = null) {

        $select_query = $this->db->query('SELECT u.name, u.uid, u.title, u.location, u.website, 
            (SELECT views FROM fa_users_stats WHERE uid = u.uid) as views, 
            (SELECT name FROM fa_profile_images WHERE uid = u.uid) as profile_picture FROM fa_users u, fa_users_stats s 
            WHERE u.activated IS NULL GROUP BY u.uid ORDER BY views DESC');

        return $select_query->result();
    }    
    
    public function popular_artist_count() {
        $this->db->from('fa_users');
        $this->db->join('fa_profile_images', ' fa_profile_images.uid = fa_users.uid');
        $this->db->join('fa_users_stats', ' fa_users_stats.uid = fa_users.uid');
        $this->db->where('activated IS NULL');
        return $this->db->count_all_results();
    }

    public function fetch_popular_artists($limit, $start) {
        $this->db->select('fa_users.uid, 
                   fa_users.name, 
                   fa_users.title, 
                   fa_users.country, 
                   fa_users.state, 
                   fa_users.city, 
                   fa_users.website, 
                   fa_users_stats.views, 
                   fa_profile_images.name as profile_picture');
        $this->db->from('fa_users');
        $this->db->join('fa_profile_images', ' fa_profile_images.uid = fa_users.uid');
        $this->db->join('fa_users_stats', ' fa_users_stats.uid = fa_users.uid');
        $this->db->limit($limit, $start);
        $this->db->where('activated IS NULL');
        $this->db->order_by("fa_users_stats.views", "DESC");
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }

}

?>