<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang='zh-CN' xml:lang='zh-CN' xmlns='http://www.w3.org/1999/xhtml'>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <link rel="shortcut icon" type="image/x-icon" href="assets/image/favicon.ico" />
  <link rel="stylesheet" type="text/css" href="assets/bootstrap/css/bootstrap.min.css" />
  <link rel="stylesheet" type="text/css" href="assets/css/global.css" />
  <title>请登录</title>
</head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4" style="padding-top:200px;">
                    <img src="assets/image/dnspod.jpg" width="360" /><br />
                    <form role="form" onsubmit="return false;">
                        <div class="form-group">
                            <label for="username">用户名</label>
                            <input type="text" class="form-control" id="username" name="username" placeholder="请输入用户名" />
                        </div>
                        <div class="form-group">
                            <label for="password">密码</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="请输入密码" />
                        </div>
                        <input type="button" class="btn btn-default" onclick="ajax_submit_form('/login/check', this.form, '/');" value="登录" />
                        <input type="button" class="btn btn-default" onclick="location.href='/register/';" value="注册" />
                    </form>
                </div><!-- div.col-md-4 -->
                <div class="col-md-4"></div>
            </div><!-- dov.row -->
        </div><!-- div.container -->
        <script type="text/javascript" src="http://libs.baidu.com/jquery/1.8.3/jquery.min.js"></script>
        <script type="text/javascript" src="assets/js/global.js"></script>
    </body>
</html>