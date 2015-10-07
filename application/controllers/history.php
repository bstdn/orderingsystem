<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by bstdn
 * User: hexiugang <xiugang.he@chukou1.com>
 * Date: 15/9/27 14:46
 */

class History extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('order_model', 'order');
        $this->load->model('man_model', 'man');
        $this->load->model('business_model', 'business');
        $this->load->model('product_model', 'product');
        $this->load->model('orderlist_model', 'orderlist');
        $this->_layout = 'default_without_leftbar';
    }

    public function index() {
        $this->load->library('pagination');

        $input = array(
            'limit'  => $this->input->get('limit') ?: 10,
            'offset' => $this->input->get('per_page') ?: '',
        );
        $order = $this->order->query($input);

        $pagination_config['base_url'] = site_url('history/index?limit='.$input['limit']);
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
        $pagination_config['first_url'] = site_url('history/index');
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

    public function info() {
        $input = $this->input->get();
        if(!is_numeric($input['id'])) {
            showmsg('参数错误');
        }
        $current_order = $this->order->get_order_by_id($input['id']);
        if(!$current_order) {
            showmsg('记录不存在');
        }
        $order_list = $this->orderlist->get_list_by_order_id($current_order['id']);
        $man_ids = array_unique(array_column($order_list, 'man_id'));
        $business_ids = array_unique(array_column($order_list, 'business_id'));
        $product_ids = array_unique(array_column($order_list, 'product_id'));
        $man_list = $this->man->get_man_by_id($man_ids);
        $business_list = $this->business->get_business_by_id($business_ids);
        $product_list = $this->product->get_product_by_id($product_ids);
        $data = array(
            'order'         => $current_order,
            'order_list'    => isset($order_list) ? $order_list : array(),
            'man_list'      => isset($man_list) ? $man_list : array(),
            'business_list' => isset($business_list) ? $business_list : array(),
            'product_list'  => isset($product_list) ? $product_list : array(),
        );
        $this->view($data);
    }

    public function total() {
        $input = $this->input->get();
        if(!is_numeric($input['id'])) {
            showmsg('参数错误');
        }
        $current_order = $this->order->get_order_by_id($input['id']);
        if(!$current_order) {
            showmsg('记录不存在');
        }
        $order_list = $this->orderlist->get_total_list_by_order_id($current_order['id']);
        $business_ids = array_unique(array_column($order_list, 'business_id'));
        $product_ids = array_unique(array_column($order_list, 'product_id'));
        $business_list = $this->business->get_business_by_id($business_ids);
        $product_list = $this->product->get_product_by_id($product_ids);
        $data = array(
            'order'         => $current_order,
            'order_list'    => isset($order_list) ? $order_list : array(),
            'business_list' => isset($business_list) ? $business_list : array(),
            'product_list'  => isset($product_list) ? $product_list : array(),
        );
        $this->view($data);
    }

    public function remove_order() {
        $input = $this->input->get();
        if(!is_numeric($input['id'])) {
            showmsg('参数错误');
        }
        $order = $this->order->get_order_by_id($input['id']);
        if(!$order) {
            showmsg('订单不存在');
        }
        $order_list = $this->orderlist->get_list_by_order_id($order['id']);
        foreach($order_list as $v) {
            $this->man->update_use_num($v['man_id'], '-');
            $this->business->update_use_num($v['business_id'], '-');
            $this->product->update_use_num($v['product_id'], '-');
        }
        $this->orderlist->delete_by_order_id($order['id']);
        $this->order->delete_by_id($order['id']);

        showmsg('操作成功');
    }
}
