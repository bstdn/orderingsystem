<?php
/**
 * Created by bstdn
 * User: hexiugang <xiugang.he@chukou1.com>
 * Date: 15/9/28 17:00
 */
?>
<div class="container">
    <form class="form-horizontal" method="post" action="<?=site_url('product/edit')?>">
        <div class="control-group">
            <label class="control-label" for="product_name">产品名称</label>
            <div class="controls">
                <input type="text" id="product_name" name="product_name" placeholder="产品名称" value="<?=$info['product_name']?>">
            </div>
        </div>
        <div class="control-group">
            <div class="controls">
                <input type="hidden" name="id" value="<?=isset($info['id']) ? $info['id'] : 0?>">
                <button type="submit" class="btn btn-large btn-info">提交</button>
            </div>
        </div>
    </form>
</div>