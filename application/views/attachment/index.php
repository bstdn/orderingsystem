<?php
/**
 * Created by bstdn
 * User: hexiugang <xiugang.he@chukou1.com>
 * Date: 15/9/30 15:30
 */
?>
<div class="container">
    <?php if($attachment_list): ?>
        <?php foreach($attachment_list as $v): ?>
            <p>
                <img src="<?=site_url('uploads').DS.$v['attachment']?>"/>
                <a class="btn btn-danger btn-large" href="<?=site_url('attachment/remove_atta?id='.$v['id'])?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="删除~请谨慎操作!">删除</a>
            </p>
            <hr/>
        <?php endforeach; ?>
    <?php endif; ?>
    <form class="form-horizontal" method="post" action="<?=site_url('attachment/do_upload')?>" enctype="multipart/form-data">
        <div class="control-group">
            <label class="control-label" for="business_name">上传图片</label>
            <div class="controls">
                <input type="file" id="userfile" name="userfile">
            </div>
        </div>
        <div class="control-group">
            <div class="controls">
                <button type="submit" class="btn btn-large btn-info">提交</button>
            </div>
        </div>
    </form>
</div>
