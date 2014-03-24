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
            'domain'    => $domain,
            'records'   => $records,
            'error'     => $error,
            'domain_id' => $domain_id
        );
        $this->load_view('record_list', $view_data);
    }
    
    public function add($domain_id = 0, $record_id = 0)
    {
        $domain = array();
        $record = array();
        $error  = NULL;
        
        try {
            $api_data = $this->dnsapi->get('Record.Info', array('domain_id' => $domain_id, 'record_id' => $record_id));
            $domain = $api_data['domain'];
            $record = $api_data['record'];
        } catch (Exception $e) {
            $error = $e->getMessage();
        }
        
        //获取域名相关信息
        if (empty($domain)) {
            try {
                $api_data = $this->dnsapi->get('Domain.Info', array('domain_id' => $domain_id));
                $domain = $api_data['domain'];
                $domain['domain'] = $domain['name'];    //为了跟'Record.Info'获取到的域名信息兼容
            } catch (Exception $e) {}
        }
        
        $view_data = array(
            'domain'    =>  $domain,
            'record'    =>  $record,
            'error'     =>  $error
        );
        $this->load_view('record_add', $view_data);
    }
    
    /**
     * 插入或编辑一条记录
     */
    public function insert()
    {
        $api_data = array();
        
        foreach (array('domain_id', 'sub_domain', 'record_type', 'record_line', 'value', 'mx', 'ttl') as $d) {
            $api_data[$d] = $this->input->post($d);
        }
        
        //如果POST中含有record_id字段，则为编辑状态，否则添加
        $api = 'Record.Create';
        if (($record_id = $this->input->post('record_id')) > 0) {
            $api = 'Record.Modify';
            $api_data['record_id'] = $record_id;
        }
        
        $this->load->helper('ajax');
        
        try {
            $this->dnsapi->get($api, $api_data);
        } catch (Exception $e) {
            return ajax_error($e->getMessage());
        }
        
        ajax_success();
    }
    
    /**
     * 锁定或者解除锁定
     */
    public function lock()
    {
        $record_id = $this->input->post('id');
        $domain_id = $this->input->post('domain_id');
        $status    = $this->input->post('status') ? 'disable' : 'enable';

        $this->load->helper('ajax');
        try {
            $this->dnsapi->get('Record.Status', array('domain_id' => $domain_id, 'record_id' => $record_id, 'status' => $status));
        } catch (Exception $e) {
            return ajax_error($e->getMessage());
        }
        
        ajax_success();
    }
    
    /**
     * 删除记录
     */
    public function delete()
    {
        $api_data = array(
            'domain_id' => $this->input->post('domain_id'),
            'record_id' => $this->input->post('id')
        );
        
        $this->load->helper('ajax');
        
        try {
            $this->dnsapi->get('Record.Remove', $api_data);
        } catch (Exception $e) {
            return ajax_error($e->getMessage());
        }
        
        ajax_success();
    }
}


