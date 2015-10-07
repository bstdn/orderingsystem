<?php
/**
 * Created by bstdn
 * User: hexiugang <xiugang.he@chukou1.com>
 * Date: 15/9/20 14:55
 */

class Url_model extends CI_Model {

    protected $_message;
    protected $_time = 3;
    protected $_url;

    public function url($url) {
        if(!$url) {
            $this->_url = ci()->input->get_request_header('Referer', true);
        } else {
            $this->_url = $url;
        }
        return $this;
    }

    public function time($time){
        $this->_time = (int)$time;
        return $this;
    }

    public function message($message, $escape = true) {
        $this->_message = $escape?ci()->security->xss_clean($message):$message;
        return $this;
    }

    public function dump_and_exit() {
        $this->dump();
        ci()->output->_display();
        exit;
    }

    public function dump() {
        $CI = ci();
        $data = array(
            'message' => $this->_message,
            'url' => $this->_url,
            'time' => $this->_time,
        );
        $CI->load->view('widget/dump', $data);
    }
}
