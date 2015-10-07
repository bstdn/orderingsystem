<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by bstdn
 * User: hexiugang <xiugang.he@chukou1.com>
 * Date: 15/9/20 17:19
 */

class Orderlist_model extends MY_Model {

    protected $_table_name = 'orderlist';

    public function get_by_id($id) {
        if(!is_numeric($id)) {
            return array();
        }
        $this->db->where('id', $id);
        $result = $this->db->get($this->_table_name, 1);
        return $result->num_rows() ? $result->row_array() : array();
    }

    public function get_list_by_order_id($id) {
        if(!is_numeric($id)) {
            return array();
        }
        $this->db->where('order_id', $id);
        $this->db->order_by('id', 'ASC');
        $result = $this->db->get($this->_table_name);
        return $result->num_rows() ? $result->result_array() : array();
    }

    public function get_total_list_by_order_id($id) {
        if(!is_numeric($id)) {
            return array();
        }
        $this->db->select('*, COUNT(product_id) AS sum');
        $this->db->where('order_id', $id);
        $this->db->group_by('product_id');
        $this->db->order_by('business_id', 'ASC');
        $result = $this->db->get($this->_table_name);
        return $result->num_rows() ? $result->result_array() : array();
    }

    public function check_man($order_id, $man_id) {
        if(!is_numeric($order_id) || !is_numeric($man_id)) {
            return false;
        }
        $this->db->where('order_id', $order_id);
        $this->db->where('man_id', $man_id);
        $result = $this->db->get($this->_table_name);
        return $result->num_rows() ? $result->result_array() : array();
    }

    public function insert($param) {
        $data = array();
        foreach($param as $k => $v) {
            if(!is_null($v)) {
                $data[$k] = $v;
            }
        }
        if(!$data) {
            return false;
        }
        $this->db->insert($this->_table_name, $data);
        return $this->db->insert_id();
    }

    public function delete_by_id($id) {
        if(!is_numeric($id)) {
            return false;
        }
        $this->db->where('id', $id);
        $this->db->delete($this->_table_name);
        return true;
    }

    public function delete_by_order_id($id) {
        if(!is_numeric($id)) {
            return false;
        }
        $this->db->where('order_id', $id);
        $this->db->delete($this->_table_name);
        return true;
    }
}
