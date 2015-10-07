<?php
/**
 * Created by bstdn
 * User: hexiugang <xiugang.he@chukou1.com>
 * Date: 15/9/28 16:40
 */
?>
<div class="container">
    <table class="table table-bordered">
        <caption>菜名列表</caption>
        <thead>
        <tr>
            <th>#</th>
            <th>产品名称</th>
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
                    <td><?=$v['product_name']?></td>
                    <td><?=$v['use_num']?></td>
                    <td><?=date('Y-m-d H:i:s', $v['dateline'])?></td>
                    <td>
                        <a class="label label-success" href="<?=site_url('product/edit?id='.$v['id'])?>">编辑</a>
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