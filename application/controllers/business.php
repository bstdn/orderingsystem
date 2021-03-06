<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by bstdn
 * User: hexiugang <xiugang.he@chukou1.com>
 * Date: 15/9/28 16:19
 */

class Business extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('business_model', 'business');
        $this->_layout = 'default_without_leftbar';
    }

    public function index() {
        $this->load->library('pagination');

        $input = array(
            'limit'  => $this->input->get('limit') ?: 10,
            'offset' => $this->input->get('per_page') ?: '',
        );
        $order = $this->business->query($input);

        $pagination_config['base_url'] = site_url('business/index?limit='.$input['limit']);
        $pagination_config['total_rows'] = array_value($order, 'count', 0);
        $pagination_config['per_page'] = $input['limit'];
        $pagination_config['next_link'] = '&raquo;';
        $pagination_config['prev_link'] = '&laquo;';
        $pagination_config['full_tag_open'] = '<div class="pagination"><ul>';
        $pagination_config['full_tag_close'] = '</ul></div>';
        $pagination_config['first_tag_open'] = '<li>';
        $pagination_config['first_tag_close'] = '</li>';
        $pagination_config['last_tag_open'] = '<li>';
        $pagination_config['last_tag_close'] = '</li>';
        $pagination_config['first_url'] = site_url('business/index');
        $pagination_config['cur_tag_open'] = '<li class="active"><a>';
        $pagination_config['cur_tag_close'] = '</a></li>';
        $pagination_config['next_tag_open'] = '<li>';
        $pagination_config['next_tag_close'] = '</li>';
        $pagination_config['prev_tag_open'] = '<li>';
        $pagination_config['prev_tag_close'] = '</li>';
        $pagination_config['num_tag_open'] = '<li>';
        $pagination_config['num_tag_close'] = '</li>';
        $pagination_config['page_query_string'] = true;
        $this->pagination->initialize($pagination_config);

        $data = array(
            'list'  => array_value($order, 'data', array()),
            'count' => array_value($order, 'count', 0),
            'input' => $input,
        );

        $this->view($data);
    }

    public function edit() {
        if($this->input->is_post()) {
            $this->_edit_post();
        } else {
            $this->_edit_get();
        }
    }

    protected function _edit_post() {
        $input = $this->input->post();
        if(!is_numeric($input['id'])) {
            showmsg('参数错误');
        }
        $business = $this->business->get_by_id($input['id']);
        if(!$business) {
            showmsg('记录不存在');
        }
        if(!trim($input['business_name'])) {
            showmsg('商家名称不能为空');
        }
        $data = array(
            'business_name' => dhtmlspecialchars(trim($input['business_name'])),
        );
        $where = array(
            'id' => $input['id'],
        );
        $this->business->update($data, $where);
        showmsg('操作成功', 'index');
    }

    protected function _edit_get() {
        $input = $this->input->get();
        if(!is_numeric($input['id'])) {
            showmsg('参数错误');
        }
        $business = $this->business->get_by_id($input['id']);
        if(!$business) {
            showmsg('记录不存在');
        }
        $data = array(
            'info' => $business,
        );
        $this->view($data);
    }

    public function remove_business() {
        $input = $this->input->get();
        $business = $this->business->get_by_id($input['id']);
        if(!$business) {
            showmsg('商家不存在');
        } elseif($business['use_num'] > 0) {
            showmsg('商家已使用，不能删除');
        }
        $this->business->delete_by_id($input['id']);

        showmsg('操作成功');
    }
}
