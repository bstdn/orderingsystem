<?php
/**
 * Created by bstdn
 * User: hexiugang <xiugang.he@chukou1.com>
 * Date: 15/9/13 17:22
 */

require(APPPATH.'views/common/head.php');?>
<div class="container-fluid">
    <div class="row-fluid">
        <?php require(APPPATH.'views/common/leftbar.php');?>
        <div class="span10">
            <?=$content?>
        </div><!--/span-->
    </div><!--/row-->
</div><!--/.fluid-container-->
<?php require(APPPATH.'views/common/footer.php');