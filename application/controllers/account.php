<?php

class Account extends DNS_Controller{
    
    public function __construct() {
        parent::__construct();
    }
    
    public function index(){
        $this->load->model('daccount');
        $accounts = $this->daccount->get_list($this->user->id);

        $this->load_view('account_list', array('list' => $accounts), 'account');
    }
}

