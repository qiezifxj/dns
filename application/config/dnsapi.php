<?php

/**
 * 调用DNSPOD的api时的一些配置
 */

$dnsapi = array();

//UserAgent的格式必须为：程序英文名称/版本(联系邮箱)，比如：MJJ DDNS Client/1.0.0 (shallwedance@126.com)
$dnsapi['useragent'] = 'F-XJ DNS Client/1.0 (qiezifxj@gmail.com)';

//lang {en,cn} 返回的错误语言，可选，默认为en，建议用cn
$dnsapi['lang'] = 'cn';

$config['dnsapi'] = $dnsapi;