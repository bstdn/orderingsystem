<?php
/**
 * Created by bstdn
 * User: hexiugang <xiugang.he@chukou1.com>
 * Date: 15/9/27 15:10
 */
?>
<div class="container">
    <table class="table table-bordered">
        <caption>订单历史列表</caption>
        <thead>
        <tr>
            <th>#</th>
            <th>开始时间</th>
            <th>结束时间</th>
            <th>订单数</th>
            <th>状态</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        <?php if($list): ?>
            <?php foreach($list as $v): ?>
                <tr>
                    <td><?=$v['id']?></td>
                    <td><?=date('Y-m-d H:i:s', $v['starttime'])?></td>
                    <td><?=$v['status']==1?date('Y-m-d H:i:s', $v['endtime']):'订餐中'?></td>
                    <td><?=$v['count']?></td>
                    <td><?=$v['status']==0?'<span class="label label-success">正常</span>':'<span class="label">已结束</span>';?></td>
                    <td>
                        <a class="label label-success" href="<?=site_url('history/info?id='.$v['id'])?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="查看订单详情">查看</a>
                        <a class="label label-info" href="<?=site_url('history/total?id='.$v['id'])?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="查看订单统计">统计</a>
                        <?php if($v['status'] == 1 && $v['count'] == 0): ?>
                            <a class="label label-important" href="<?=site_url('history/remove_order?id='.$v['id'])?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="删除~请谨慎操作!">删除</a>
                        <?php endif; ?>
                        <?php if($v['status'] == 1 && isset($last_order['id']) && $v['id'] == $last_order['id']): ?>
                            <a class="label label-inverse" href="<?=site_url('history/reset_order?id='.$v['id'])?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="恢复订餐">恢复</a>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
        </tbody>
    </table>
    <div>
        <?=$this->pagination->create_links();?>
    </div>
</div>