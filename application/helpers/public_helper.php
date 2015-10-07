<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by bstdn
 * User: hexiugang <xiugang.he@chukou1.com>
 * Date: 15/9/13 16:48
 */

/**
 * 代码调试
 */
function p() {
    $argc = func_get_args();
    echo '<pre>';
    foreach($argc as $var) {
        print_r($var);
        echo '<br/>';
    }
    echo '</pre>';
    exit;
    return;
}

/**
 * 代码调试
 */
function pr() {
    $argc = func_get_args();
    echo '<pre>';
    foreach($argc as $var) {
        print_r($var);
        echo '<br/>';
    }
    echo '</pre>';
}

/**
 * 代码调试
 */
function d() {
    $argc = func_get_args();
    foreach($argc as $var) {
        var_dump($var);
        echo '<br/>';
    }
    exit;
    return;
}
