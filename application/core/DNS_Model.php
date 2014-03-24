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
    
    /**
     * 更改数组key(如在account列表中修改改为account_id作为key)
     * @param array $array
     * @param type $key
     * @param type $filter
     * @return array
     */
    public static function _ary_change_key(array $array, $key, $filter = '')
    {
        $ret = array();
        
        foreach ($array as $v) {
            $kval = self::_g($v, $key, '', $filter);
            $ret[$kval] = $v;
        }
        
        return $ret;
    }
}