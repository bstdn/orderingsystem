/**
 * Created by bstdn on 15/9/25.
 */

$(function() {
    $("[data-toggle='tooltip']").tooltip();

    $('#nav_'+ g.router.class).addClass('active');

    //我也要来一份~复制到表单!
    $('.copy_order').click(function() {
        var tr_copy_order = $('#tr-copy_order_'+$(this).attr('data-id'));
        $('#business_name').val(tr_copy_order.children().eq(1).html());
        $('#product_name').val(tr_copy_order.children().eq(2).html());
        $('#username').focus();
    });

    //复制商家到表单
    $('.copy_business').click(function() {
        var clone = $(this).clone();
        if(clone.children('span')) {
            clone.children('span').remove();
        }
        $('#business_name').val(clone.html()).focus();
    });

    //复制菜名到表单
    $('.copy_product').click(function() {
        var clone = $(this).clone();
        if(clone.children('span')) {
            clone.children('span').remove();
        }
        $('#product_name').val(clone.html()).focus();
    });

    //复制姓名到表单
    $('.copy_username').click(function() {
        var clone = $(this).clone();
        $('#username').val(clone.html()).focus();
    });
});
