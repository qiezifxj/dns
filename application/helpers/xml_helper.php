<?php

/**
 * 数组转为XML
 */
if ( ! function_exists('array2xml')) {
    function array2xml(array $array, $root = 'root', $child = 'item', $output = false)
    {
        $xml_element = new SimpleXMLElement('<'.$root.'></'.$root.'>');
        
        data2xml($xml_element, $array, $child);
        
        $xml = $xml_element->asXML();
        
        if ($output) { //输出,而不是返回
            header('Content-type:text/xml');
            echo $xml;
            return;
        }
        
        return $xml;
    }
}

/**
 * 部分功能移出,方便递归处理
 */
if ( ! function_exists('data2xml')) {
    function data2xml(SimpleXMLElement &$xml, array $data, $item = 'item')
    {
        foreach ($data as $key => $value) {
            is_numeric($key) && $key = $item;
            if(is_array($value) || is_object($value)){
                $child = $xml->addChild($key);
                data2xml($child, $value, $item);
            } else {
                $child = $xml->addChild($key, $value);
            } 
        } 
    }
}


