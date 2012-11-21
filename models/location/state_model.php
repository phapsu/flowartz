<?php

class State_model extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    function get_all_state() {
        //$this->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file'));
        $this->load->driver('cache');

        if (!$state = $this->cache->get('get_all_state')) {
            $this->db->order_by("name", "asc"); 
            $state = $this->db->get('fa_states');
            $state = $state->result();
            // Save into the cache
            $this->cache->file->save('get_all_state', $state);
        }
        return $state;
    }
    
    function get_list_state()
    {
        $this->load->driver('cache');

        if (!$state = $this->cache->get('get_list_state')) {
            $states = $this->get_all_state();
            foreach($states as $ct):
                $state[$ct->alias] = $ct->name;
            endforeach;
                        
            // Save into the cache
            $this->cache->file->save('get_list_state', $state);
        }
        return $state;
    }
    
    function get_alias_by_id() {
        $this->load->driver('cache');

        if (!$state = $this->cache->get('get_alias_by_id')) {
            $states = $this->get_all_state();
            foreach ($states as $ct):
                $state[$ct->id] = $ct->alias;
            endforeach;

            // Save into the cache
            $this->cache->file->save('get_alias_by_id', $state);
        }
        return $state;
    }

}

?>
