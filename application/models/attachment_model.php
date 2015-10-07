<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by bstdn
 * User: hexiugang <xiugang.he@chukou1.com>
 * Date: 15/9/30 15:11
 */

class Attachment_model extends MY_Model {

    protected $_table_name = 'attachment';

    public function get_by_id($id) {
        if(!is_numeric($id)) {
            return array();
        }
        $this->db->where('id', $id);
        $result = $this->db->get($this->_table_name, 1);
        return $result->num_rows() ? $result->row_array() : array();
    }

    public function get_list() {
        $this->db->order_by('id', 'DESC');
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
}
