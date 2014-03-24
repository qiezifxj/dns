<div>
    <h3>我的账户</h3>
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>DNSPod Username</th>
                <th>Nickname</th>
                <th>Operator</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!is_array($list) || empty($list)):?>
            <tr><td colspan="4" align="center"><strong>暂无</strong></td></tr>
            <?php else: foreach($list as $a):?>
            <tr>
                <td><?php echo $a['id'];?></td>
                <td><?php echo $a['dnspod_username'];?></td>
                <td><?php echo $a['nickname'];?></td>
                <td></td>
            </tr>
            <?php endforeach;endif;?>
        </tbody>
    </table>
</div>
<br /><br />
<div>
    <h3>添加DNSPOD账户</h3>
    <from role="form" action="" method="post" onsubmit="return false;">
        <div class="form-group">
            <label for="username">账户名</label>
            <input type="email" name="username" class="form-control" id="username" placeholder="输入DNSPOD登录邮箱" />
        </div>
        <div class="form-group">
            <label for="password">账户密码</label>
            <input type="password" name="password" class="form-control" id="password" placeholder="DNSPOD登录密码" />
        </div>
        <input type="button" value="提交" class="btn btn-default" onclick="ajax_submit_form('/account/add', this.form, '/');" />
    </from>
</div>