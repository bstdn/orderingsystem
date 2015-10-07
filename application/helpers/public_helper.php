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

function ci() {
    return get_instance();
}

function showmsg($message, $url = '') {
    $CI = ci();
    $CI->load->model('url_model');
    $CI->url_model->message($message);
    $CI->url_model->url($url);
    $CI->url_model->dump_and_exit();
}

/**
 * 根据key获取一个数组里面的值
 * @param array $arr
 * @param string $key 按点号分开
 * @param mixed $default
 * @return mixed
 * @example
 * ```php
 *    $arr = array('one' => array('two' => '2'));
 *    echo array_value($arr, 'one.two', 'default');
 * ```
 */
if(!function_exists('array_value')) {
    function array_value($arr, $key, $default = '') {
        $keys = explode('.', $key);
        $data = $arr;
        foreach($keys as $one_key) {
            if(
                (is_array($data) || $data instanceof ArrayAccess) &&
                isset($data[$one_key])
            ) {
                $data = $data[$one_key];
            } else {
                return $default;
            }
        }
        return $data;
    }
}

if(!function_exists('array_column')) {
    function array_column($input, $columnKey, $indexKey = null) {
        $columnKeyIsNumber = (is_numeric($columnKey)) ? true : false;
        $indexKeyIsNull = (is_null($indexKey)) ? true : false;
        $indexKeyIsNumber = (is_numeric($indexKey)) ? true : false;
        $result = array();
        foreach((array)$input as $key => $row) {
            if($columnKeyIsNumber) {
                $tmp = array_slice($row, $columnKey, 1);
                $tmp = (is_array($tmp) && !empty($tmp)) ? current($tmp) : null;
            } else {
                $tmp = isset($row[$columnKey]) ? $row[$columnKey] : null;
            }
            if(!$indexKeyIsNull) {
                if($indexKeyIsNumber) {
                    $key = array_slice($row, $indexKey, 1);
                    $key = (is_array($key) && !empty($key)) ? current($key) : null;
                    $key = is_null($key) ? 0 : $key;
                } else {
                    $key = isset($row[$indexKey]) ? $row[$indexKey] : 0;
                }
            }
            $result[$key] = $tmp;
        }
        return $result;
    }
}
