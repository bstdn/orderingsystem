<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by bstdn
 * User: hexiugang <xiugang.he@chukou1.com>
 * Date: 15/9/28 17:14
 */

class MY_Input extends CI_Input {

    public function is_post() {
        return $this->method() === 'post';
    }

    public function is_get() {
        return $this->method() === 'get';
    }

    public function method($upper = FALSE) {
        return ($upper)
            ? strtoupper($this->server('REQUEST_METHOD'))
            : strtolower($this->server('REQUEST_METHOD'));
    }
}
