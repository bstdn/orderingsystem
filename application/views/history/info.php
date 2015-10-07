<?php
/**
 * Created by bstdn
 * User: hexiugang <xiugang.he@chukou1.com>
 * Date: 15/9/28 15:36
 */
?>
<div class="container">
    <table class="table table-bordered">
        <caption>
            订单详情
            <?php if($order['status'] == 0): ?>
                <?=date('Y年m月d日H时i分', $order['starttime'])?>~未结束
            <?php else: ?>
                <?=date('Y年m月d日H时i分', $order['starttime'])?>~<?=date('Y年m月d日H时i分', $order['endtime'])?>
            <?php endif; ?>
        </caption>
        <thead>
            <tr>
                <th>姓名</th>
                <th>商家</th>
                <th>菜名</th>
                <th>时间</th>
            </tr>
        </thead>
        <tbody>
        <?php if($order_list): ?>
        <?php foreach($order_list as $v): ?>
            <tr id="tr-copy_order_<?=$v['id']?>">
                <td><?=$man_list[$v['man_id']]?></td>
                <td><?=$business_list[$v['business_id']]?></td>
                <td><?=$product_list[$v['product_id']]?></td>
                <td><?=date('Y-m-d H:i:s', $v['dateline'])?></td>
            </tr>
        <?php endforeach; ?>
    <?php endif; ?>
    </tbody>
    </table>
</div>