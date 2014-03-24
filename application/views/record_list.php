<div>
    <h3><a href="/domain/">我的域名</a> &gt; <?php echo $domain;?></h3>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>线路</th>
                <th>类型</th>
                <th>TTL</th>
                <th>Value</th>
                <th>状态</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
        <?php if(is_array($records)&& !empty($records)):foreach($records as $r):?>
            <tr>
                <td><?php echo $r['id'];?></td>
                <td><?php echo $r['name'];?></td>
                <td><?php echo $r['line'];?></td>
                <td><?php echo $r['type'];?></td>
                <td><?php echo $r['ttl'];?></td>
                <td><?php echo $r['value'];?></td>
                <td><?php echo $r['status'];?></td>
                <td></td>
            </tr>
        <?php endforeach;else:?>
            <tr><th colspan="8" style="text-align:center;"><?php echo $error;?></th></tr>
        <?php endif;?>
        </tbody>
    </table>
</div>