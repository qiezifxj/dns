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
    
    /**
     * 导出记录
     */
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
        array2xml($xml_data, 'records', 'record', true);
    }
    
    /**
     * 导入
     * @param string $type  'domain' OR 'record'
     * @param type $id      导入记录时的domain_id
     */
    public function import($type = 'domain', $id = NULL)
    {
        if ('domain' != $type AND 'record' != $type) {
            return header('Location:/domain');
        }
        
        $upload = $_FILES['upload_xml'];
        if (empty($upload) OR 0 != $upload['error']) {
            return header('Location:/domain');
        }
        
        /**
         * 域名和记录添加所需字段 => 在XML中的名称
         */
        $fields = array(
            'domain' => array(
                'domain' => 'name',
                'is_mark'=> 'is_mark'
            ),
            'record' => array(
                'sub_domain' => 'name',
                'record_type' => 'type',
                'record_line' => 'line',
                'value' => 'value',
                'mx' => 'mx',
                'ttl' => 'ttl'
            )
        );
        
        $xmldom = simplexml_load_file($upload['tmp_name']);
        
        foreach ($xmldom->$type as $v) {
            $api_data = array();
            if ('record' == $type) {
                $api_data['domain_id'] = $id;
            }
            
            foreach ($fields[$type] as $f => $name) {
                $api_data[$f] = $v->$name;
            }

            try {
                $this->dnsapi->get(ucfirst($type).'.Create', $api_data);
            }
            catch(Exception $e){}
        }
        
        return header('Location:/'.$type.'/'.$id);
    }
}