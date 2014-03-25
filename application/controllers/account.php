<?php

class Account extends DNS_Controller
{
    
    public function __construct()
    {
        parent::__construct();
        
        $this->load->model('daccount');
    }
    
    public function index()
    {
        $this->load_view('account_list', array('list' => $this->account_list), 'account');
    }
	
    /**
     * 添加DNSPOD账户
     * @return type
     */
	public function add()
    {
        $login_email = $this->input->post('username');
        $login_password = $this->input->post('password');
        
        $api_param = array(
            'login_email' => $login_email,
            'login_password' => $login_password
        );
        $this->load->library('dnsapi', $api_param);
        $this->load->helper('ajax');
        
        //调用API获取用户信息,以确定用户是否合法
        try{
            $api_data = $this->dnsapi->get('User.Detail');
            $info = $api_data['info'];
//            print_r($info);
        }
        catch (Exception $e) {
            return ajax_error($e->getMessage());
        }
        
        $data = array(
            'uid' => $this->user->id,
            'dnspod_username' => $login_email,
            'dnspod_password' => $login_password,
            'nickname' => $info['user']['nick']
        );
        
        if ($this->daccount->add($data)) {
            ajax_success();
        } else {
            ajax_error($this->daccount->get_error());
        }
    }
    
    public function set_account($account_id = 0)
    {
        $this->session->set_userdata('account_id', (int)$account_id);
        
        $this->output->set_header('Location:/domain');
    }
}

