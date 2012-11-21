<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Search_model extends CI_model {

    //vars
    //methods

    public function __construct() {

        //parent::__construct();
    }
/*
    public function search($keyword = null) {

        $sql = 'SELECT u.name, u.uid, u.title, u.location, u.blurb, u.website, s.name as skill_name, (SELECT name FROM fa_profile_images WHERE uid = u.uid) as profile_picture FROM 
					fa_users AS u,
					fa_users_skills AS s WHERE 
						u.name LIKE "%' . $this->db->escape_like_str(urldecode($keyword)) . '%"
						OR
						s.name LIKE "%' . $this->db->escape_like_str(urldecode($keyword)) . '%"
						AND 
						s.uid = u.uid
					GROUP BY u.uid
					';

        $select_query = $this->db->query($sql);

        return $select_query->result();
    }
*/    
    public function record_count() {
        $keyword = $this->session->userdata('search_string');
        $search_location = $this->session->userdata('search_location');
        
        $this->db->from('fa_users');
        $this->db->join('fa_profile_images', ' fa_profile_images.uid = fa_users.uid');
        $this->db->join('fa_users_stats', ' fa_users_stats.uid = fa_users.uid');
        if($keyword){
            $this->db->join('fa_users_skills', ' fa_users_skills.uid = fa_users.uid');
        }
        $this->db->where('fa_users.activated IS NULL');
        if($search_location){
            $this->db->where('fa_users.city', $search_location);
        }
        if($keyword){
            $this->db->like('fa_users.name', $keyword);
            $this->db->or_like('fa_users_skills.name', $keyword);
        }        
        if($keyword){
            $this->db->group_by('fa_users.uid');
        }        
        if($keyword){
            return  $this->db->get()->num_rows();
        }
        return $this->db->count_all_results();
    }


    public function fetch_record($limit, $start) {
        $keyword = $this->session->userdata('search_string');
        $search_location = $this->session->userdata('search_location');
        
        
        
        $this->db->select('fa_users.uid, 
                   fa_users.name, 
                   fa_users.title, 
                   fa_users.country, 
                   fa_users.state, 
                   fa_users.city, 
                   fa_users.website, 
                   fa_profile_images.name as profile_picture');
        $this->db->from('fa_users');
        $this->db->join('fa_profile_images', ' fa_profile_images.uid = fa_users.uid');
        $this->db->join('fa_users_stats', ' fa_users_stats.uid = fa_users.uid');
        if($keyword){
            $this->db->join('fa_users_skills', ' fa_users_skills.uid = fa_users.uid');
        }
        $this->db->limit($limit, $start);
        $this->db->where('fa_users.activated IS NULL');
        if($search_location){
            $this->db->where('fa_users.city', $search_location);
        }
        if($keyword){
            $this->db->like('fa_users.name', $keyword);
            $this->db->or_like('fa_users_skills.name', $keyword);
        }        
        if($keyword){
            $this->db->group_by('fa_users.uid');
        }
        
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