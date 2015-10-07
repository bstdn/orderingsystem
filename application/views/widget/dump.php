<?php
/**
 * Created by bstdn
 * User: hexiugang <xiugang.he@chukou1.com>
 * Date: 15/9/20 15:17
 */
require(APPPATH.'views/common/head.php');?>
    <div class="container">
        <div class="hero-unit">
            <h3><?php echo $message?></h3>
            <p><strong id="dumpTimeNum"><?php echo $time;?></strong> 秒后自动跳转，或直接<a href="<?php echo $url; ?>">点击此链接</a></p>
        </div>
    </div>
    <script type="text/javascript">
        window.onload = function() {
            var obj = document.getElementById("dumpTimeNum");
            var time = <?=$time?>;
            if(time == 0) {
                window.location = '<?=$url?>';
            } else {
                var interval = setInterval(function() {
                    if(time > 0) {
                        time = time - 1;
                        if(obj) obj.innerHTML = time;
                    } else {
                        window.location = '<?=$url?>';
                        clearInterval(interval);
                    }
                }, 1000);
            }
        }
    </script>
<?php require(APPPATH.'views/common/footer.php');