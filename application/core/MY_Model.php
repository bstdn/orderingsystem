<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by bstdn
 * User: hexiugang <xiugang.he@chukou1.com>
 * Date: 15/9/15 10:30
 */

class MY_Model extends CI_Model {

    public function __construct() {
        $this->load->database();
        parent::__construct();
    }
}
