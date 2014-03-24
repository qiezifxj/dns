<?php

class DNS_Controller extends CI_Controller{
    
    public function __construct() {
        parent::__construct();
        
        $this->load->model('user');
        if ( ! $this->user->is_login()) {
            $this->output->set_header('Location:/login');
        }
    }
    
    protected function load_view($name = NULL, $param = array(), $active_menu = 'domain')
    {
        $this->load->config('web');
        $web_config_array = array(
            'title' => $this->config->item('web_title'),
            'keywords' => $this->config->item('web_keywords'),
            'description' => $this->config->item('web_description'),
            'active_menu' => $active_menu
        );
        $this->load->view('header', $web_config_array);
        
        if ($name) {
            $this->load->view($name, $param);
        }
        
        $this->load->view('footer');
    }
    
}