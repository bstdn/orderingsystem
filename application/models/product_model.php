<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by bstdn
 * User: hexiugang <xiugang.he@chukou1.com>
 * Date: 15/9/20 16:56
 */

class Product_model extends MY_Model {

    protected $_table_name = 'product';

    public function get_by_id($id) {
        if(!is_numeric($id)) {
            return array();
        }
        $this->db->where('id', $id);
        $result = $this->db->get($this->_table_name, 1);
        return $result->num_rows() ? $result->row_array() : array();
    }

    public function get_product_by_id($id) {
        $ret = array();
        if(!$id) {
            return $ret;
        }
        $id = (array)$id;
        $this->db->select(array('id', 'product_name'));
        $this->db->where_in('id', $id);
        $result = $this->db->get($this->_table_name);
        if($result->num_rows()) {
            foreach($result->result_array() as $row) {
                $ret[$row['id']] = $row['product_name'];
            }
        }

        return $ret;
    }

    public function get_product_id($name) {
        $name = trim($name);
        $this->db->select('id');
        $this->db->where('product_name', $name);
        $ret = $this->db->get($this->_table_name, 1);
        if($ret->num_rows()) {
            $result = $ret->row_array();
            $this->update_use_num($result['id']);
            return $result['id'];
        } else {
            $insert = array(
                'product_name' => $name,
                'use_num'       => 1,
                'dateline'      => TIMESTAMP,
            );
            return $this->insert($insert);
        }
    }

    public function query($input) {
        $result = array(
            'count' => $this->_build_count($input),
            'data' => $this->_build_query($input),
        );
        return $result;
    }

    protected function _build_query($input) {
        $this->_build_base($input);
        if($limit = array_value($input, 'limit')) {
            $offset = array_value($input, 'offset');
            $this->db->limit($limit, $offset);
        }
        $this->db->order_by('id DESC');
        $result = $this->db->get($this->_table_name);
        return $result->num_rows() ? $result->result_array() : array();
    }

    protected function _build_base($input) {
    }

    protected function _build_count($input) {
        $this->_build_base($input);
        return $this->db->count_all_results($this->_table_name);
    }

    public function get_hot($top = 5) {
        $this->db->select(array('product_name', 'use_num'));
        $this->db->order_by('use_num', 'DESC');
        $result = $this->db->get($this->_table_name, $top);
        return $result->num_rows() ? $result->result_array() : array();
    }

    public function update_use_num($id, $opeation = '+', $num = 1) {
        if(!is_numeric($id) && intval($num) <= 0) {
            return false;
        }
        $opeation = $opeation == '+' ? '+' : '-';
        $this->db->where('id', $id);
        $this->db->set('use_num', 'use_num'.$opeation.$num, FALSE);
        $this->db->update($this->_table_name);
        return true;
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

    public function update($param, $where) {
        $data = array();
        foreach($param as $k => $v) {
            if(!is_null($v)) {
                $data[$k] = $v;
            }
        }
        if(!$data) {
            return false;
        }
        $this->db->update($this->_table_name, $data, $where);
        return $this->db->affected_rows();
    }
}
