<?php
class Country_model extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
    function get_all_country()
    {
        $this->load->driver('cache');

        if (!$country = $this->cache->get('get_all_country')) {
            $this->db->order_by("name", "asc"); 
            $country = $this->db->get('fa_countries');
            $country = $country->result();
            // Save into the cache
            $this->cache->file->save('get_all_country', $country);
        }
        return $country;
    }
    
    function get_list_country()
    {
        $this->load->driver('cache');

        if (!$country = $this->cache->get('get_list_country')) {
            $countries = $this->get_all_country();
            $country[''] = '--';
            foreach($countries as $ct):
                $country[$ct->iso3] = $ct->name;
            endforeach;
                        
            // Save into the cache
            $this->cache->file->save('get_list_country', $country);
        }
        return $country;
    }
    
    function get_iso3_by_id()
    {
        $this->load->driver('cache');

        if (!$country = $this->cache->get('get_iso3_by_id')) {
            $countries = $this->get_all_country();
            foreach($countries as $ct):
                $country[$ct->id] = $ct->iso3;
            endforeach;
                        
            // Save into the cache
            $this->cache->file->save('get_iso3_by_id', $country);
        }
        return $country;
    }

}?>
