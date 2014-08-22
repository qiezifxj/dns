DNS
===================================
	通过DNSPOD API实现域名和记录的各种操作

使用步骤
----------------------------------
1. 注册账户
2. 关联DNSPOD账户
3. 管理域名和记录

主要文件(都位于application下)
----------------------------------
* 类库(Library)
	* [/libraries/dnsapi.php](./application/libraries/dnsapi.php) 接口类，负责调用DNSPOD API
* 核心文件(Core)
	* [/core/DNS_Controller.php](https://github.com/qiezifxj/dns/blob/master/application/core/DNS_Controller.php) 重载控制器基类
	* [/core/DNS_Model.php](https://github.com/qiezifxj/dns/blob/master/application/core/DNS_Model.php) 重载模型基类
* 控制器(Controller)
	* [/controller/login.php](https://github.com/qiezifxj/dns/blob/master/application/controllers/login.php) 登录注册相关
	* [/controller/account.php](https://github.com/qiezifxj/dns/blob/master/application/controllers/account.php) 关联DNSPOD账户
	* [/controller/domain.php](https://github.com/qiezifxj/dns/blob/master/application/controllers/domain.php) 域名相关操作
	* [/controller/record.php](https://github.com/qiezifxj/dns/blob/master/application/controllers/record.php) 记录相关操作
	* [/controller/export.php](https://github.com/qiezifxj/dns/blob/master/application/controllers/export.php) 域名和记录的导入导出操作
* 模型(Model)
	* [/models/user.php](https://github.com/qiezifxj/dns/blob/master/application/models/user.php) 用户登录注册等，与数据库交互
	* [/models/daccount.php](https://github.com/qiezifxj/dns/blob/master/application/models/daccount.php) 管理DNSPOD账户，负责与数据库交互
* 模板(View)
	* [/views/header.php](https://github.com/qiezifxj/dns/blob/master/application/views/header.php) 头，除登陆注册外，其他所有页面共用
	* [/views/footer.php](https://github.com/qiezifxj/dns/blob/master/application/views/footer.php) 尾，同上...
	* [/views/login.php](https://github.com/qiezifxj/dns/blob/master/application/views/login.php) 登录
	* [/views/register](https://github.com/qiezifxj/dns/blob/master/application/views/register.php) 注册
	* [/views/account_list.php](https://github.com/qiezifxj/dns/blob/master/application/views/account_list.php) DNSPOD账户列表
	* [/views/domain_list.php](https://github.com/qiezifxj/dns/blob/master/application/views/domain_list.php) 域名列表
	* [/views/record_list.php](https://github.com/qiezifxj/dns/blob/master/application/views/record_list.php) 记录列表
	* [/views/record_add.php](https://github.com/qiezifxj/dns/blob/master/application/views/record_add.php) 添加记录
* 函数库(Helper)
	* [/helpers/ajax_helper.php](https://github.com/qiezifxj/dns/blob/master/application/helpers/ajax_helper.php) 负责处理ajax请求的成功和失败
	* [/helpers/curl_helper.php](https://github.com/qiezifxj/dns/blob/master/application/helpers/curl_helper.php) 目前主要是curl_post函数，接口类需要用
	* [/helpers/xml_helper.php](https://github.com/qiezifxj/dns/blob/master/application/helpers/xml_helper.php) 数组与XML转化等操作
* 配置文件(Config)
	* [/config/web.php](https://github.com/qiezifxj/dns/blob/master/application/config/web.php) 网站基本配置
	* [/config/dnsapi.php](https://github.com/qiezifxj/dns/blob/master/application/config/dnsapi.php) 接口调用时的一些配置

数据库
----------------------------------
* [/database.sql](https://github.com/qiezifxj/dns/blob/master/database.sql)

# 预览地址
* [dns.f-xj.org](http://dns.f-xj.org/)

# To Be Continued
* DNSPOD账户的编辑删除等操作暂时未作
* Domains和Records 本应在本地数据库保存，限于时间，暂时未作，因此每次都请求API，响应时间较慢
