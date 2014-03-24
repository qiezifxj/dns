<?php

class Daccount extends DNS_Model
{
    public function __construct() {
        parent::__construct();
    }
    
    public function get_list($user_id = 0)
    {
        $query = $this->db
            ->select('`id`,`dnspod_username`,`nickname`,`created_at`')
            ->from('account')
            ->where('uid', (int)$user_id)
            ->get()
            ;
        
        if ($query->num_rows() == 0) {
            return array();
        }
        
        return $query->result_array();
    }
}