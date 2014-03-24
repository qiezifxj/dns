<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang='zh-CN' xml:lang='zh-CN' xmlns='http://www.w3.org/1999/xhtml'>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <base href="<?php echo $base_url;?>" />
  <link rel="shortcut icon" type="image/x-icon" href="assets/image/favicon.ico" />
  <link rel="stylesheet" type="text/css" href="assets/bootstrap/css/bootstrap.min.css" />
  <link rel="stylesheet" type="text/css" href="assets/css/global.css" />
  <title><?php echo $title;?></title>
  <meta name="Keywords" content="<?php echo $keywords;?>"/>
</head>
    <body>
        <header class="navbar navbar-inverse bs-docs-nav" role="banner">
            <div class="container">
                <nav class="collapse navbar-collapse bs-navbar-collapse" role="navigation">
                    <ul class="nav navbar-nav">
                        <li><a href="/" style="font-size:50px; font-family:'楷体'">DNSPOD域名管理</a></li>
                    </ul>
                    <ul class='nav navbar-nav navbar-right'>
                        <li style="padding-top:15px;"><font color="white"><strong>当前账户:</strong></font>
                            <select onchange="location.href='/setaccount/'+this.value;">
                            <?php if (!is_array($account_list) OR empty($account_list)):?>
                                <option value="0"><i>没有DNSPOD账户</i></option>
                            <?php else: foreach($account_list as $a):?>
                                <option <?php if($account_id == $a['id']){echo 'selected="selected"';}?> value="<?php echo $a['id'];?>"><?php echo $a['nickname'],'(',$a['dnspod_username'],')';?></option>
                            <?php endforeach;endif;?>
                            </select>
                        </li>
                    </ul>
                </nav>
            </div>
        </header>
        <div class="container">
            <div class="row">
                <div class="col-md-2">
                    <ul class="nav nav-pills nav-stacked">
                        <li <?php if('account' == $active_menu):?>class="active"<?php endif;?>><a href="/">我的DNSPOD账户</a></li>
                        <li <?php if('domain' == $active_menu):?>class="active"<?php endif;?>><a href="/domain">我的域名</a></li>
                    </ul>
                </div>
                <div class="col-md-10">