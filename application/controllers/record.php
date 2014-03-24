<?php

class Record extends DNS_Controller
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
    
    public function index($domain_id = 0)
    {
        $domain     = '';
        $records    = array();
        $error      = '';
        
        try {
            $api_data = $this->dnsapi->get('Record.List', array('domain_id' => $domain_id));
//            print_r($api_data);exit;
            $domain = $api_data['domain']['name'];
            $records= $api_data['records'];
        }
        catch(Exception $e) {
            $error = $e->getMessage();
        }
        
        $view_data = array(
            'domain' => $domain,
            'records'=> $records,
            'error'  => $error
        );
        $this->load_view('record_list', $view_data);
    }
}