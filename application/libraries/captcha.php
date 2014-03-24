<?php

class Captcha
{
    private $CI = NULL;
    
    public function __construct() {
        $this->CI = & get_instance();
        $this->CI->load->helper('captcha');
        $this->CI->load->helper('rand_string');
    }
    
    /**
     * 设置验证码
     * @return string 用于显示图片的img标签(HTML code)
     */
    public function make_captcha()
    {
        $captcha_code = rand_string(6);
        
        $this->CI->session->set_userdata('captcha', $captcha_code);
        
        $captcha_config = array(
            'word' => $captcha_code,
            'img_path' => WEB_ROOT.'/public_html/assets/captcha/',
            'img_url' => '/assets/captcha/',
//            'img_width' => 80
        );
        $captcha = create_captcha($captcha_config);
        return $captcha['image'];
    }
    
    /**
     * 检查验证码
     * @param string $code
     * @return boolean
     */
    public function check_captcha($code = '')
    {
        $captcha_code = $this->CI->session->userdata('captcha');
        
        if ($code === $captcha_code) {
            $this->CI->session->set_userdata('captcha', '');
            return true;
        }
        
        return false;
    }
}