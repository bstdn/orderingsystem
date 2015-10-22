<?php
/**
 * Created by bstdn
 * User: hexiugang <xiugang.he@chukou1.com>
 * Date: 15/9/13 17:23
 */
?>
<div class="btn-group">
    <?php if($order): ?>
        <a href="<?=site_url('home/order?book=2')?>" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="一般由前台妹妹操作哦~请谨慎操作!" class="btn btn-danger">结束订餐</a>
    <?php else: ?>
        <a href="<?=site_url('home/order?book=1')?>" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="一般由前台妹妹操作哦~请谨慎操作!" class="btn btn-primary">开始订餐</a>
    <?php endif; ?>
</div>
<table class="table table-bordered">
    <caption>订单列表</caption>
    <thead>
        <tr>
            <th>姓名</th>
            <th>商家</th>
            <th>菜名</th>
            <th>操作</th>
        </tr>
    </thead>
    <tbody>
    <?php if($order_list): ?>
        <?php foreach($order_list as $v): ?>
            <tr id="tr-copy_order_<?=$v['id']?>">
                <td><?=$man_list[$v['man_id']]?></td>
                <td><?=$business_list[$v['business_id']]?></td>
                <td><?=$product_list[$v['product_id']]?></td>
                <td>
                    <a class="label label-info copy_order" data-id="<?=$v['id']?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="我也要来一份~复制到表单!">复制</a>
                    <a class="label label-important" href="<?=site_url('home/remove_book?id='.$v['id'])?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="删除~请谨慎操作!">删除</a>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php endif; ?>
    </tbody>
</table>

<div class="container-fluid">
    <div class="row-fluid">
        <div class="span7">
            <form class="form-horizontal" method="post" action="<?=site_url('home/book')?>">
                <div class="control-group">
                    <label class="control-label" for="username">姓名</label>
                    <div class="controls">
                        <input type="text" id="username" name="username" placeholder="请填写真实姓名">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="business_name">商家</label>
                    <div class="controls">
                        <input type="text" id="business_name" name="business_name" placeholder="请填写餐馆名称">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="product_name">菜名</label>
                    <div class="controls">
                        <input type="text" id="product_name" name="product_name" placeholder="请填写菜名">
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls">
                        <input type="hidden" name="order_id" value="<?=isset($order['id']) ? $order['id'] : 0?>">
                        <button type="submit" class="btn btn-large btn-info">下单</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="span5">
            <table class="table table-bordered">
                <caption>未订餐名单</caption>
                <thead>
                <tr>
                    <th>姓名</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                <?php if($no_order_list): ?>
                    <?php foreach($no_order_list as $k => $v): ?>
                        <tr>
                            <td><a class="btn-link copy_username" data-toggle="tooltip" data-placement="top" title="" data-original-title="复制姓名到表单!"><?=$v?></a></td>
                            <td>
                                <a class="label label-info" href="<?=site_url('home/pass_book?id='.$k.'&order_id='.$order['id'].'&type=0')?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="跳过这次订单!">不点</a>
                                <a class="label label-important" href="<?=site_url('home/pass_book?id='.$k.'&order_id='.$order['id'].'&type=1')?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="以后都不点!">总不点</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>