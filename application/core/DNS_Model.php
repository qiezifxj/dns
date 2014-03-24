<?php

class DNS_Model extends CI_Model{
    
    protected $error = '';

    public function __construct() {
        parent::__construct();
    }
    
    public function get_error(){
        return $this->error;
    }
    
    /**
     * 从数组中获取数据
     * @param type $array   数组
     * @param type $key     键值
     * @param type $default 默认值
     * @param type $filter  过滤函数
     */
    public static function _g($array = array(), $key = '', $default = '', $filter = '')
    {
        if (isset($array[$key])) {
            $default = $array[$key];
        }
        
        if (function_exists($filter)) {
            $default = $filter($default);
        }
        
        return $default;
    }
}