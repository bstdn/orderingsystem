<?php
/**
 * Created by bstdn
 * User: hexiugang <xiugang.he@chukou1.com>
 * Date: 15/9/28 16:36
 */
?>
<div class="container">
    <table class="table table-bordered">
        <caption>商家列表</caption>
        <thead>
        <tr>
            <th>#</th>
            <th>商家名称</th>
            <th>使用数</th>
            <th>创建时间</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        <?php if($list): ?>
            <?php foreach($list as $v): ?>
                <tr>
                    <td><?=$v['id']?></td>
                    <td><?=$v['business_name']?></td>
                    <td><?=$v['use_num']?></td>
                    <td><?=date('Y-m-d H:i:s', $v['dateline'])?></td>
                    <td>
                        <a class="label label-success" href="<?=site_url('business/edit?id='.$v['id'])?>">编辑</a>
                        <a class="label label-important" href="<?=site_url('business/remove_business?id='.$v['id'])?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="删除~请谨慎操作!">删除</a>
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