<?php

class Dnsapi
{
    private $login_email    =   '';
    private $login_password =   '';
    
    private $CI     = NULL;
    private $error  = '';
    
    private $api_domain =   'https://dnsapi.cn/';
    
    public function __construct($login_email = '', $login_password = '')
    {
        $this->login_email = $login_email;
        $this->login_password = $login_password;
        
        $this->CI->load->helper('curl');
    }
    
    public function get($api, array $data = array())
    {
        $post_data  = $this->make_post_data($data);
        $res_json   = curl_post($this->api_domain.$api, $post_data);
        $res        = json_decode($res_json, true);
        
        if ( ! $this->check($res)) {
            throw new Exception($this->error);
            return false;
        }
        
        return $res;
    }
    
    /**
     * 检查从DNSPOD api返回的数据是否请求成功
     * @param array $res
     * @return boolean 是否成功
     */
    private function check(array $res)
    {
        $status = $res['status'];
        
        if (1 == $status['code']) {
            return true;
        }
        
        $this->error = $status['message'];
        return false;
    }
    
    /**
     * 制作接口调用时的POST数据
     * @param array $data   数据
     * @return string       格式化后的数据
     */
    private function make_post_data(array $data = array())
    {
        $data_str = 'login_email='.$this->login_email.'&login_password='.$this->login_password.'&format=json&lang=cn';
        
        foreach ($data as $dkey => $dval) {
            $data_str .= '&'.$dkey.'='.$dval;
        }
        
        return $data_str;
    }
    
}