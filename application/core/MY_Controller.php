<?php
/**
 * Created by bstdn
 * User: hexiugang <xiugang.he@chukou1.com>
 * Date: 15/9/13 17:02
 */

class MY_Controller extends CI_Controller {
    public function __construct() {
        parent::__construct();
    }

    /**
     * layout 相对于views/layout目录下
     * @var string
     */
    protected $_layout = 'default';

    /**
     * 渲染视图
     * @param array $data
     * @param null $view
     */
    protected function view($data = array(), $view = null) {
        $action_path = $this->action_path();
        if(is_null($view)) {
            $view = implode(DS, $action_path);
        }
        if($this->_layout) {
            $content = $this->load->view($view, $data, true);
            $params = array('content' => $content);
            $this->load->view("layout/{$this->_layout}", $params);
        } else {
            $this->load->view($view, $data);
        }
    }

    /**
     * 返回到当前action的“路径”
     * @param null $sep 分隔符
     * @return array|string
     */
    public function action_path($sep = null) {
        $path = array();
        if($this->router->directory) {
            $path[] = str_replace('/', '', $this->router->directory);
        }
        $path[] = strtolower($this->router->class);
        $path[] = strtolower($this->router->method);
        return is_string($sep) ? implode($sep, $path) : $path;
    }
}
