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