<?php

class User extends DNS_Model{
    
    private $id         = 0;
    private $username   = '';
    private $password   = '';
    private $nickname   = '';
    private $created_at = '';
    
    public function __construct() {
        parent::__construct();
        
        $this->login('session');
    }
    
    /**
     * 登录
     * @param string $type  登录类型('session' or 'post')
     * @return boolean  是否登录成功
     */
    public function login($type = 'session')
    {
        if ('session' == $type) {
            $username = $this->session->userdata('username');
            $password = $this->session->userdata('password');
        } else {
            $username = $this->input->post('username');
            $password = $this->input->post('password');
        }
        
        if ( ! $this->check_login($username, $password)) {
            return false;
        }
        
        if ('post' == $type) {
            $session_data = array(
                'username' => $username,
                'password' => $password
            );
            $this->session->set_userdata($session_data);
        }
        
        return true;
    }
    
    /**
     * 检查登录
     * @param string $username  用户名
     * @param string $password  密码
     * @return boolean          是否登录成功
     */
    public function check_login($username = '', $password = '')
    {
        $query = $this->db->select('*')->from('user')->where('username', $username)->where('password', md5($password))->limit(1)->get();
        
        if ($query->num_rows() == 0) {
            $this->error = '用户名或密码错误';
            return false;
        }
        
        $userinfo = $query->first_row('array');
        foreach ($userinfo as $key => $val) {
            $this->$key = $val;
        }
        
        return true;
    }
    
    /**
     * 用户注册
     * @param array $data 数据(应包含username,nickname,password,password_confirm字段)
     */
    public function register(array $data)
    {
        $username = parent::_g($data, 'username', '', 'trim');
        $nickname = parent::_g($data, 'nickname', '', 'trim');
        $password = parent::_g($data, 'password', '', 'trim');
        $password_cinfirm = parent::_g($data, 'password_confirm', '', 'trim');
        
        if (empty($username)) {
            $this->error = '用户名不能为空';
            return false;
        }
        
        if (empty($nickname)) {
            $this->error = '别名不能为空';
            return false;
        }
        
        if (empty($password)) {
            $this->error = '密码不能为空';
            return false;
        }
        
        if ($password !== $password_cinfirm) {
            $this->error = '两次输入密码不一致';
            return false;
        }
        
        if ($this->username_exists($username)) {
            $this->error = '此用户名已经存在！';
            return false;
        }
        
        $data = array(
            'username' => $username,
            'password' => md5($password),
            'nickname' => $nickname
        );
        $this->db->insert('user', $data);
        
        return true;
    }
    
    public function __get($key)
    {
        if ('id' == $key OR 'username' == $key OR 'nickname' == $key) {
            return $this->$key;
        } else {
            return parent::__get($key);
        }
    }
    
    /**
     * 是否已经登录(根据id来验证)
     * @return boolean  是否已经登录
     */
    public function is_login()
    {
        return ($this->id > 0);
    }
    
    /**
     * 检查用户名是否已经存在
     * @param type $username
     * @return boolean
     */
    private function username_exists($username)
    {
        $query = $this->db->select('COUNT(*) AS `num`')->from('user')->where('username', $username)->get();
        
        if ($query->first_row()->num > 0) {
            return true;
        }
        
        return false;
    }
    
}