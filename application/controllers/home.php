<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by bstdn
 * User: hexiugang <xiugang.he@chukou1.com>
 * Date: 15/9/13 17:01
 */

class Home extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('order_model', 'order');
        $this->load->model('man_model', 'man');
        $this->load->model('business_model', 'business');
        $this->load->model('product_model', 'product');
        $this->load->model('orderlist_model', 'orderlist');
    }

    public function index() {
        $current_order = $this->order->get_current_order();
        if($current_order) {
            $order_list = $this->orderlist->get_list_by_order_id($current_order['id']);
            $man_ids = array_unique(array_column($order_list, 'man_id'));
            $business_ids = array_unique(array_column($order_list, 'business_id'));
            $product_ids = array_unique(array_column($order_list, 'product_id'));
            $man_list = $this->man->get_man_by_id($man_ids);
            $business_list = $this->business->get_business_by_id($business_ids);
            $product_list = $this->product->get_product_by_id($product_ids);
            $no_order_list = $this->man->get_pass_man_list($current_order['id']);
        }
        $data = array(
            'order'         => $current_order,
            'order_list'    => isset($order_list) ? $order_list : array(),
            'man_list'      => isset($man_list) ? $man_list : array(),
            'business_list' => isset($business_list) ? $business_list : array(),
            'product_list'  => isset($product_list) ? $product_list : array(),
            'no_order_list' => isset($no_order_list) ? $no_order_list : array(),
        );
        $this->view($data);
    }

    public function order() {
        $input = $this->input->get();
        if($input['book'] == 1) { //开始订餐
            $current_order = $this->order->get_current_order();
            if($current_order) {
                showmsg('订餐已开始');
            }
            $this->order->start_order();
            showmsg('操作成功');
        } elseif($input['book'] == 2) { //结束订餐
            $this->order->end_order();
            showmsg('操作成功');
        }

        showmsg('参数错误');
    }

    public function book() {
        $input = $this->input->post();
        $check_order = $this->order->get_order_by_id($input['order_id']);
        if(!$check_order) {
            showmsg('订单异常');
        }
        if(!trim($input['username']) || !trim($input['business_name']) || !trim($input['product_name'])) {
            showmsg('姓名、商家、菜名均不能为空');
        }

        $man_id = $this->man->get_man_id(dhtmlspecialchars(trim($input['username'])), $input['order_id']);
        $check_man = $this->orderlist->check_man($input['order_id'], $man_id);
        if($check_man === false || (is_array($check_man) && count($check_man) > 0)) {
            showmsg('姓名:'.$input['username'].'已下单');
        }
        $business_id = $this->business->get_business_id(dhtmlspecialchars(trim($input['business_name'])));
        $product_id = $this->product->get_product_id(dhtmlspecialchars(trim($input['product_name'])));

        $insert = array(
            'order_id'    => $check_order['id'],
            'man_id'      => $man_id,
            'business_id' => $business_id,
            'product_id'  => $product_id,
            'dateline'    => TIMESTAMP,
        );
        $this->orderlist->insert($insert);
        $this->order->update_count($check_order['id']);
        showmsg('下单成功');
    }

    public function remove_book() {
        $input = $this->input->get();
        $orderlist = $this->orderlist->get_by_id($input['id']);
        if(!$orderlist) {
            showmsg('订单不存在');
        }
        $check_order = $this->order->get_order_by_id($orderlist['order_id']);
        if(!$check_order) {
            showmsg('订单异常');
        } elseif($check_order['status'] == 1) {
            showmsg('订单已结束');
        }

        $ret = $this->orderlist->delete_by_id($input['id']);
        if($ret) {
            $this->order->update_count($orderlist['order_id'], '-');
            $this->man->update_use_num($orderlist['man_id'], '-');
            $this->business->update_use_num($orderlist['business_id'], '-');
            $this->product->update_use_num($orderlist['product_id'], '-');
        }

        showmsg('操作成功');
    }

    public function pass_book() {
        $input = $this->input->get();
        if(!is_numeric($input['id']) || !is_numeric($input['order_id']) || !is_numeric($input['type'])) {
            showmsg('参数有误');
        }
        $update = array(
            'pass_order_id' => $input['type'] == 0 ? (int)$input['order_id'] : -1,
        );
        $this->man->update($update, array('id' => (int)$input['id']));
        showmsg('操作成功');
    }
}
