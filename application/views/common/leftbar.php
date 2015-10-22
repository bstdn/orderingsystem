<?php
/**
 * Created by bstdn
 * User: hexiugang <xiugang.he@chukou1.com>
 * Date: 15/9/13 17:39
 */

$this->load->model('order');
$this->load->model('business');
$this->load->model('product');
$order_list = $this->order->get_top();
$business_list = $this->business->get_hot();
$product_list = $this->product->get_hot();
?>
<div class="span3">
    <div class="well sidebar-nav">
        <ul class="nav nav-list">
            <li class="nav-header">订单历史TOP10</li>
            <?php if($order_list): ?>
                <?php foreach($order_list as $v): ?>
                    <?php if($v['status'] == 0): ?>
                        <li class="active"><a href="<?=site_url('history/total?id='.$v['id'])?>"><?=date('Ymd-H:i', $v['starttime'])?>~订餐中</a></li>
                    <?php else: ?>
                        <li><a href="<?=site_url('history/total?id='.$v['id'])?>"><?=date('Ymd-H:i', $v['starttime'])?>~<?=date('Ymd-H:i', $v['endtime'])?></a></li>
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php endif; ?>
            <li class="nav-header">热门商家TOP10</li>
            <?php if($business_list): ?>
                <?php foreach($business_list as $v): ?>
                    <li><a class="btn-link copy_business" data-toggle="tooltip" data-placement="top" title="" data-original-title="复制商家到表单!"><?=$v['business_name']?><span class="label label-info"><?=$v['use_num']?></span></a></li>
                <?php endforeach; ?>
            <?php endif; ?>
            <li class="nav-header">热门菜名TOP10</li>
            <?php if($product_list): ?>
                <?php foreach($product_list as $v): ?>
                    <li><a class="btn-link copy_product" data-toggle="tooltip" data-placement="top" title="" data-original-title="复制菜名到表单!"><?=$v['product_name']?><span class="label label-important"><?=$v['use_num']?></span></a></li>
                <?php endforeach; ?>
            <?php endif; ?>
        </ul>
    </div><!--/.well -->
</div><!--/span-->