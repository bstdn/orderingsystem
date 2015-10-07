<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by bstdn
 * User: hexiugang <xiugang.he@chukou1.com>
 * Date: 15/9/13 17:01
 */

class Home extends MY_Controller {
    public function index() {
        $data = array(
            'aa' => 'a'
        );
        $this->view($data);
    }
}
