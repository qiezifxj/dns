<?php

class Domain extends DNS_Controller
{
    private $cur_account = NULL;
    
    public function __construct()
    {
        parent::__construct();
        
        if (empty($this->account_list)) {
            header('Location:/');
        }
        
        $this->load->library('encrypt');
        
        //获取当前账户的用户名和密码
        $cur_account = $this->account_list[$this->account_id];
        $this->cur_account['login_email'] = $cur_account['dnspod_username'];
        $this->cur_account['login_password'] = $this->encrypt->decode($cur_account['dnspod_password']);
        
        //加载API类
        $this->load->library('dnsapi', $this->cur_account);
    }
    
    /**
     * 域名列表
     */
    public function index()
    {
        $domains = array();
        $error = NULL;
        try {
            $api_data = $this->dnsapi->get('Domain.List');
            $domains = $api_data['domains'];
        }
        catch(Exception $e) {
            $error = $e->getMessage();
        }
        
        $this->load_view('domain_list', array('domains' => $domains, 'error' => $error));
        
    }
    
    /**
     * 添加域名
     */
    public function add()
    {
        $domain_name = $this->input->post('domain_name');
        $this->load->helper('ajax');
        
        try {
            $this->dnsapi->get('Domain.Create', array('domain' => $domain_name));
            ajax_success();
        }
        catch (Exception $e) {
            ajax_error($e->getMessage());
        }
    }
    
    /**
     * 删除域名
     */
    public function delete()
    {
        $id = $this->input->post('id');
        
        $this->load->helper('ajax');
        
        try {
            $this->dnsapi->get('Domain.Remove', array('domain_id' => $id));
        }
        catch(Exception $e) {
            return ajax_error($e->getMessage());
        }
        
        ajax_success();
    }
    
}