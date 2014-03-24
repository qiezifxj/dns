<?php

class Test extends CI_Controller
{
    public function __construct() {
        parent::__construct();
    }
    
    public function index()
    {
        $this->load->library('encrypt');
        $str = 'Pi=3.14159';
        
        echo 'before:',$str,'<br />';
        $enc = $this->encrypt->encode($str);
        echo 'e n c :',$enc,' , len:',strlen($enc),'<br />';
        echo 'after :',  $this->encrypt->decode($enc);
    }
}