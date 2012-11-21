<?php
class City_model extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
    function get_all_city()
    {
        //$this->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file'));
        $this->load->driver('cache');

        if (!$city = $this->cache->get('get_all_city')) {
            $this->db->order_by("name", "asc"); 
            $city = $this->db->get('fa_cities');
            $city = $city->result();
            // Save into the cache
            $this->cache->file->save('get_all_city', $city);
        }
        return $city;
    }
    
    function get_list_city()
    {
        $this->load->driver('cache');

        if (!$city = $this->cache->get('get_list_city')) {
            $cities = $this->get_all_city();
            foreach($cities as $ct):
                $city[$ct->id] = $ct->name;
            endforeach;
                        
            // Save into the cache
            $this->cache->file->save('get_list_city', $city);
        }
        return $city;
    }

}
?>
