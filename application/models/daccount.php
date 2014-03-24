<?php

class Daccount extends DNS_Model
{
    //缓存下账户,多次获取时不需要重复读取数据库
    private $cache = array();
    
    public function __construct() {
        parent::__construct();
    }
    
    /**
     * 获取DNSPOD账户列表
     * @param type $user_id
     * @return type
     */
    public function get_list($user_id = 0)
    {
        $user_id = (int)$user_id;
        
        if (isset($this->cache[$user_id])) {
            return $this->cache[$user_id];
        }
        
        $query = $this->db
            ->select('`id`,`dnspod_username`,`dnspod_password`,`nickname`,`created_at`')
            ->from('account')
            ->where('uid', $user_id)
            ->get()
            ;
        
        if ($query->num_rows() == 0) {
            return array();
        }
        
        $account_list = parent::_ary_change_key($query->result_array(), 'id', 'intval');
        $this->cache[$user_id] = $account_list;
        
        return $account_list;
    }
    
    /**
     * 添加DNSPOD账户
     * @param array $data
     * @return boolean
     */
    public function add(array &$data)
    {
        $fields_required = array('uid', 'dnspod_username', 'dnspod_password', 'nickname');
        foreach ($fields_required as $f) {
            if ( ! isset($data[$f]) OR empty($data[$f])) {
                $this->error = $f.'不能为空';
                return false;
            }
        }
        
        if ($this->account_exists($data['uid'], $data['dnspod_username'])) {
            $this->error = '该账户已经在您帐下！';
            return false;
        }
        
        $data['uid'] = (int)$data['uid'];
        
        //密码加密后保存
        $this->load->library('encrypt');
        $data['dnspod_password'] = $this->encrypt->encode($data['dnspod_password']);
        
        $this->db->insert('account', $data);
        
        return true;
    }
    
    public function account_exists($uid, $username = '')
    {
        $query = $this->db
                ->select('COUNT(*) AS `num`')
                ->from('account')
                ->where('uid', (int)$uid)
                ->where('dnspod_username', $username)
                ->get();
        return ($query->first_row()->num > 0);
    }
}