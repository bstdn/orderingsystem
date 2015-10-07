<?php
/**
 * Created by bstdn
 * User: hexiugang <xiugang.he@chukou1.com>
 * Date: 15/9/13 17:38
 */
?>
<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset="utf-8">
    <title>订餐系统 - Powered by bstdn.</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?=site_url()?>static/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?=site_url()?>static/bootstrap/css/fluid.css" rel="stylesheet">
    <link href="<?=site_url()?>static/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
    <script type="text/javascript">
        var g = {
            'router': {
                'class': '<?=$this->router->class?>',
                'method': '<?=$this->router->method?>'
            }
        };
    </script>
</head>
<body>
<div class="navbar navbar-inverse navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container-fluid">
            <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="brand">订餐系统</a>
            <div class="nav-collapse collapse">
                <ul class="nav">
                    <li id="nav_home"><a href="<?=site_url('home/index')?>">我要订餐</a></li>
                    <li id="nav_history"><a href="<?=site_url('history/index')?>">订单历史</a></li>
                    <li id="nav_business"><a href="<?=site_url('business/index')?>">商家管理</a></li>
                    <li id="nav_product"><a href="<?=site_url('product/index')?>">菜名管理</a></li>
                    <li id="nav_attachment"><a href="<?=site_url('attachment/index')?>">上传管理</a></li>
                </ul>
            </div><!--/.nav-collapse -->
        </div>
    </div>
</div>