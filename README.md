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
* 核心文件(Core)
	* /core/DNS_Controller.php 重载控制器基类
	* /core/DNS_Model.php 重载模型基类
* 控制器(Controller)
	* /controller/login.php 登录注册相关
	* /controller/account.php 关联DNSPOD账户
	* /controller/domain.php 域名相关操作
	* /controller/record.php 记录相关操作
* 模型(Model)
* 模板(View)
* 类库(Library)
* 函数库(Helper)
* 配置文件(Config)
