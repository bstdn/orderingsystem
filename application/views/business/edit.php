<?php
/**
 * Created by bstdn
 * User: hexiugang <xiugang.he@chukou1.com>
 * Date: 15/9/28 17:34
 */
?>
<div class="container">
    <form class="form-horizontal" method="post" action="<?=site_url('business/edit')?>">
        <div class="control-group">
            <label class="control-label" for="business_name">商家名称</label>
            <div class="controls">
                <input type="text" id="business_name" name="business_name" placeholder="商家名称" value="<?=$info['business_name']?>">
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