<div>
    <h3><a href="/domain">我的域名</a> &gt; <a href="/record/<?php echo $domain['id'];?>"><?php echo $domain['domain'];?></a> &gt; 添加记录</h3>
    <form role="form" action="" method="post" onsubmit="return false;">
        <div class="form-group">
            <label for="sub_domain">记录名称</label>
            <input type="text" class="form-control" name="sub_domain" id="name" value="<?php echo @$record['sub_domain'];?>" />
        </div>
        <div class="form-group">
            <label for="record_type">记录类型</label>
            <select id="record_type" name="record_type" class="form-control">
                <option value="A">A</option>
                <option value="CNAME">CNAME</option>
                <option value="MX">MX</option>
                <option value="TXT">TXT</option>
                <option value="NS">NS</option>
                <option value="AAAA">AAAA</option>
                <option value="SRV">SRV</option>
                <option value="URL">URL</option>
            </select>
        </div>
        <div class="form-group">
            <label for="record_line">记录线路</label>
            <select id="record_line" name="record_line" class="form-control">
                <option value="默认">默认</option>
                <option value="联通">联通</option>
                <option value="电信">电信</option>
                <option value="教育网">教育网</option>
                <option value="百度">百度</option>
            </select>
        </div>
        <div class="form-group">
            <label for="value">记录值</label>
            <input type="text" class="form-control" name="value" id="value" value="<?php echo @$record['value'];?>" />
        </div>
        <div class="form-group" id="sub_domain_mx">
            <label for="mx">MX</label>
            <input type="text" class="form-control" name="mx" id="mx" placeholder="范围：1-20" value="<?php echo @$record['mx'];?>" />
        </div>
        <div class="form-group">
            <label for="ttl">TTL</label>
            <input type="text" class="form-control" name="ttl" id="ttl" placeholder="范围：1-604800" value="<?php echo @$record['ttl'];?>" />
        </div>
        <?php if ( ! empty($record)):?>
        <input type="hidden" name="record_id" value="<?php echo $record['id'];?>" />
        <?php endif;?>
        <input type="hidden" name="domain_id" value="<?php echo $domain['id'];?>" />
        <input type="button" value="添加" class="btn btn-default" onclick="ajax_submit_form('/record/insert/', this.form, '/record/<?php echo $domain['id'];?>');" />
    </form>
</div>