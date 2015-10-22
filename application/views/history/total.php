<?php
/**
 * Created by bstdn
 * User: hexiugang <xiugang.he@chukou1.com>
 * Date: 15/9/26 22:39
 */
?>
<div class="container">
    <table class="table table-bordered">
        <caption>
            订单统计
            <?php if($order['status'] == 0): ?>
                <?=date('Y年m月d日H时i分', $order['starttime'])?>~未结束
            <?php else: ?>
                <?=date('Y年m月d日H时i分', $order['starttime'])?>~<?=date('Y年m月d日H时i分', $order['endtime'])?>
            <?php endif; ?>
        </caption>
        <thead>
        <tr>
            <th>商家</th>
            <th>菜名</th>
            <th>数量</th>
        </tr>
        </thead>
        <tbody>
        <?php if($order_list): ?>
            <?php foreach($order_list as $v): ?>
                <tr>
                    <td><?=$business_list[$v['business_id']]?></td>
                    <td><?=$product_list[$v['product_id']]?></td>
                    <td><?=$v['sum']?></td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
        </tbody>
    </table>
    <table class="table table-bordered">
        <caption>
            商家订单统计
        </caption>
        <thead>
        <tr>
            <th>商家</th>
            <th>数量</th>
        </tr>
        </thead>
        <tbody>
        <?php if($total_business_list): ?>
            <?php foreach($total_business_list as $v): ?>
                <tr>
                    <td><?=$business_list[$v['business_id']]?></td>
                    <td><?=$v['sum']?></td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
        </tbody>
    </table>
</div>