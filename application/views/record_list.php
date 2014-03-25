<h3 class="col-md-8" style="padding-left: 0;"><a href="/domain/">我的域名</a> &gt; <?php echo $domain;?></h3>
<div class="col-md-4" style="text-align:right;"><a href="/export/record/<?php echo $domain_id;?>.xml" class="btn btn-default">导出记录</a></div>
<div>
    <table class="table table-striped table-hover table-condensed">
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
                <td><?php echo $r['enabled']==1?'正常':'暂停';?></td>
                <td>
                    <ul class="list-unstyled list-inline">
                        <li><a href="/record/add/<?php echo $domain_id,'/',$r['id'];?>">编辑</a></li>
                        <li><a href="javascript:ajax_delete('/record/lock', <?php echo $r['id'];?>, '/record/<?php echo $domain_id;?>', '<?php echo 'domain_id=',$domain_id,'&status=',$r['enabled'];?>');"><?php echo $r['enabled']==1?'暂停':'启动';?></a></li>
                        <li><a href="javascript:ajax_delete('/record/delete', <?php echo $r['id'];?>, '/record/<?php echo $domain_id;?>', '<?php echo 'domain_id=',$domain_id;?>');">删除</a></li>
                    </ul>
                </td>
            </tr>
        <?php endforeach;else:?>
            <tr><th colspan="8" style="text-align:center;"><?php echo $error;?></th></tr>
        <?php endif;?>
        </tbody>
    </table>
</div>
<button class="btn btn-default" onclick="location.href='/record/add/<?php echo $domain_id;?>';">添加记录</button>
