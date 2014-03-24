function ajax_submit_form(form_url, form_obj, form_jumpto){
    var form_data = jQuery(form_obj).serialize();
    
    jQuery.ajax({
        url : form_url,
        type : 'post',
        dataType : 'json',
        data : form_data,
        success : function(d){
            d.success && (location.href = form_jumpto);
            d.error && alert('保存失败:' + d.error);
        }
    });
}

function ajax_delete(del_url, del_id, del_jumpto, extra_data){
    if ( ! confirm('确定执行该操作吗?')) return;
    
    if (typeof extra_data === 'undefined') {
        extra_data = '';
    }
    
    jQuery.ajax({
        url : del_url,
        type : 'post',
        dataType : 'json',
        data : 'id=' + del_id + '&' + extra_data,
        success : function(d){
            d.success && (location.href = del_jumpto);
            d.error && alert('删除失败:' + d.error);
        }
    });
}
