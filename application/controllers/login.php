<?php

class Login extends CI_Controller
{
    public function __construct() {
        parent::__construct();
    }
    
    /**
     * 显示用户登录表单
     */
    public function index()
    {
        $this->load->view('login');
    }
    
    /**
     * 检查用户登录
     */
    public function check()
    {
        $this->load->helper('ajax');
        
        $this->load->model('user');
        if ($this->user->login('post')) {
            ajax_success();
            return;
        }
        
        return ajax_error($this->user->get_error());
    }
    
    /**
     * 显示用户注册表单
     */
    public function register()
    {
        $this->load->library('captcha');
        $captcha_html = $this->captcha->make_captcha();
        
        $this->load->view('register', array('captcha' => $captcha_html));
    }
    
    /**
     * 接收POST数据并进行用户注册
     * @return type
     */
    public function reg()
    {
        $this->load->library('captcha');
        $this->load->helper('ajax');
        
//        $captcha = $this->input->post('captcha');
//        if ( ! $this->captcha->check_captcha($captcha)) {
//            return ajax_error('验证码错误');
//        }
        
        $this->load->model('user');
        if ( ! $this->user->register($this->input->post())) {
            return ajax_error($this->user->get_error());
        }
        
        return ajax_success();
    }
}