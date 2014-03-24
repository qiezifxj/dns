<?php

if ( ! function_exists('ajax_success')) {
    function ajax_success()
    {
        echo json_encode(array('success' => 1));
    }
}

if ( ! function_exists('ajax_error')) {
    function ajax_error($msg = '')
    {
        echo json_encode(array('error' => $msg));
    }
}


