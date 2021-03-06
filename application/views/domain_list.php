<h3 class="col-md-8" style="padding-left:0;">我的域名</h3>
<div class="col-md-4" style="text-align:right;"><a href="/export/domain.xml" class="btn btn-default">导出域名</a></div>
<div>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>名称</th>
                <th>套餐</th>
                <th>记录数</th>
                <th>是否备案</th>
                <th>状态</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
        <?php if(is_array($domains)&&!empty($domains)):foreach($domains as $d):?>
            <tr>
                <td><?php echo $d['id'];?></td>
                <td><?php echo $d['name'];?></td>
                <td><?php echo $d['grade_title'];?></td>
                <td><?php echo $d['records'];?></td>
                <td><?php echo $d['beian'];?></td>
                <td><?php echo $d['status'];?></td>
                <td>
                <div class="view">
                    <ul class="list-unstyled list-inline">
                        <li><a href="javascript:ajax_delete('/domain/delete',<?php echo $d['id'];?>, '/domain/');">删除</a></li>
                        <li><a href="/record/<?php echo $d['id'];?>">查看记录</a></li>
                    </ul>
                </div>
                </td>
            </tr>
        <?php endforeach;else:?>
            <tr><th colspan="7" style="text-align:center;"><strong><?php echo $error;?></strong></th></tr>
        <?php endif;?>
        </tbody>
    </table>
</div>

<div>
    <h3>添加域名</h3>
    <form role="form" action="" method="post" onsubmit="return false;">
        <div class="form-group">
            <label for="domain_name">域名名称</label>
            <input type="text" name="domain_name" class="form-control" id="domain_name" placeholder="输入需要添加的域名" />
        </div>
        <input type="button" value="提交" class="btn btn-default" onclick="ajax_submit_form('/domain/add', this.form, '/domain');" />
    </form>
</div>


<div>
    <h3>导入域名</h3>
    <form role="form" action="/import/domain" method="post" enctype="multipart/form-data" onsubmit="$(this).find('input[type=submit]').attr('disabled',true);">
        <div class="form-group">
            <label for="domain_xml">域名XML文件</label>
            <input type="file" name="upload_xml" id="domain_xml" />
        </div>
        <input type="submit" class="btn btn-default" />
    </form>
</div>
