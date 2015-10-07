<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by bstdn
 * User: hexiugang <xiugang.he@chukou1.com>
 * Date: 15/9/20 16:56
 */

class Man_model extends MY_Model {

    protected $_table_name = 'man';

    public function get_by_id($id) {
        if(!is_numeric($id)) {
            return array();
        }
        $this->db->where('id', $id);
        $result = $this->db->get($this->_table_name, 1);
        return $result->num_rows() ? $result->row_array() : array();
    }

    public function get_man_by_id($id) {
        $ret = array();
        if(!$id) {
            return $ret;
        }
        $id = (array)$id;
        $this->db->select(array('id', 'name'));
        $this->db->where_in('id', $id);
        $result = $this->db->get($this->_table_name);
        if($result->num_rows()) {
            foreach($result->result_array() as $row) {
                $ret[$row['id']] = $row['name'];
            }
        }

        return $ret;
    }

    public function get_pass_man_list($order_id) {
        $ret = array();
        if(!$order_id) {
            return $ret;
        }
        $this->db->select(array('id', 'name'));
        $this->db->where_not_in('pass_order_id', array($order_id, -1));
        $result = $this->db->get($this->_table_name);
        if($result->num_rows()) {
            foreach($result->result_array() as $row) {
                $ret[$row['id']] = $row['name'];
            }
        }

        return $ret;
    }

    public function get_man_id($name, $order_id) {
        $name = trim($name);
        $this->db->select('id');
        $this->db->where('name', $name);
        $ret = $this->db->get($this->_table_name, 1);
        if($ret->num_rows()) {
            $result = $ret->row_array();
            $this->update_use_num($result['id']);
            $this->update(array('pass_order_id' => $order_id), array('id' => $result['id']));
            return $result['id'];
        } else {
            $insert = array(
                'name'          => $name,
                'use_num'       => 1,
                'pass_order_id' => $order_id,
                'dateline'      => TIMESTAMP,
            );
            return $this->insert($insert);
        }
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
