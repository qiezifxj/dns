<?php

class DNS_Controller extends CI_Controller{
    
    protected $account_list = NULL;
    protected $account_id   = 0;

    public function __construct() {
        parent::__construct();
        
        $this->load->model('user');
        if ( ! $this->user->is_login()) {
            $this->output->set_header('Location:/login');
        }
        
        $this->account_list = $this->daccount->get_list($this->user->id);
        if (empty($this->account_list)) {
            return;
        }
        
        $account_id = $this->session->userdata('account_id');
        if ( ! isset($this->account_list[$account_id])) {
            $account_id = key($this->account_list);
            $this->session->set_userdata('account_id', $account_id);
        }
        
        $this->account_id = $account_id;
    }
    
    /**
     * 封装视图加载函数
     * @param string $name  视图名称
     * @param array $param  参数
     * @param string $active_menu   当前活跃菜单
     */
    protected function load_view($name = NULL, $param = array(), $active_menu = 'domain')
    {
        $this->load->config('web');
        
        $web_config_array = array(
            'title' => $this->config->item('web_title'),
            'keywords' => $this->config->item('web_keywords'),
            'description' => $this->config->item('web_description'),
            'base_url' => $this->config->item('web_baseurl'),
            'active_menu' => $active_menu,
            'account_list' => $this->account_list,
            'account_id' => $this->account_id
        );
        $this->load->view('header', $web_config_array);
        
        if ($name) {
            $this->load->view($name, $param);
        }
        
        $this->load->view('footer');
    }
    
}