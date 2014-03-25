<?php

class Export extends DNS_Controller
{
    public function __construct() {
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
    
    public function index()
    {
        
    }
    
    /**
     * 导出域名
     */
    public function domain()
    {
        $domains = NULL;
        $error  = '';
        
        try {
            $api_data = $this->dnsapi->get('Domain.List');
            $domains = $api_data['domains'];
        }
        catch (Exception $e) {
            $error = $e->getMessage();
        }
        
        if ( ! empty($domains)) {
            $xml_data = &$domains;
        } else {
            $xml_data = array('error' => $error);
        }

        $this->load->helper('xml');
        array2xml($xml_data, 'domains', 'domain', true);
    }
    
    public function record($domain_id = 0)
    {
        $records = NULL;
        $error = '';
        
        try {
            $api_data   = $this->dnsapi->get('Record.List', array('domain_id' => $domain_id));
            $records    = $api_data['records'];
        }
        catch(Exception $e) {
            $error = $e->getMessage();
        }
        
        if (empty($records)) {
            $xml_data = array('error' => $error);
        } else {
            $xml_data = &$records;
        }
        
        $this->load->helper('xml');
        array2xml($xml_data, 'domains', 'domain', true);
    }
}