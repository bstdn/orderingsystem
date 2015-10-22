<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by bstdn
 * User: hexiugang <xiugang.he@chukou1.com>
 * Date: 15/9/20 13:49
 */

class Order_model extends MY_Model {

    protected $_table_name = 'order';

    public function get_current_order() {
        $this->db->where('status', self::STATUS_NORMAL);
        $this->db->order_by('id', 'DESC');
        $result = $this->db->get($this->_table_name, 1);
        return $result->num_rows() ? $result->row_array() : array();
    }

    public function get_last_order() {
        $this->db->order_by('id', 'DESC');
        $result = $this->db->get($this->_table_name, 1);
        return $result->num_rows() ? $result->row_array() : array();
    }

    public function get_list() {
        $this->db->order_by('id', 'DESC');
        $result = $this->db->get($this->_table_name);
        return $result->num_rows() ? $result->result_array() : array();
    }

    public function get_top($top = 10) {
        $this->db->order_by('id', 'DESC');
        $result = $this->db->get($this->_table_name, $top);
        return $result->num_rows() ? $result->result_array() : array();
    }

    public function get_order_by_id($id) {
        if(!is_numeric($id)) {
            return array();
        }
        $this->db->where('id', $id);
        $result = $this->db->get($this->_table_name, 1);
        return $result->num_rows() ? $result->row_array() : array();
    }

    public function start_order() {
        $insert = array(
            'starttime' => TIMESTAMP,
        );
        $this->db->insert($this->_table_name, $insert);
        return $this->db->insert_id();
    }

    public function end_order() {
        $update = array(
            'endtime' => TIMESTAMP,
            'status' => self::STATUS_DELETE,
        );
        $this->db->where('status', self::STATUS_NORMAL);
        $this->db->update($this->_table_name, $update);
        return $this->db->affected_rows();
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

    public function update_count($id, $opeation = '+', $num = 1) {
        if(!is_numeric($id) && intval($num) <= 0) {
            return false;
        }
        $opeation = $opeation == '+' ? '+' : '-';
        $this->db->where('id', $id);
        $this->db->set('count', 'count'.$opeation.$num, FALSE);
        $this->db->update($this->_table_name);
        return true;
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

    public function delete_by_id($id) {
        if(!is_numeric($id)) {
            return false;
        }
        $this->db->where('id', $id);
        $this->db->delete($this->_table_name);
        return true;
    }

    //状态:0正常,1结束
    const STATUS_NORMAL = 0;
    const STATUS_DELETE = 1;
}
