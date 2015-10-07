<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by bstdn
 * User: hexiugang <xiugang.he@chukou1.com>
 * Date: 15/9/30 15:06
 */

class Attachment extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('attachment_model', 'attachment');
        $this->_layout = 'default_without_leftbar';
    }

    public function index() {
        $attachment_list = $this->attachment->get_list();
        $data = array(
            'attachment_list' => $attachment_list,
        );
        $this->view($data);
    }

    public function do_upload() {
        $upload_config['upload_path'] = HOMEBASE.'web/uploads/';
        $upload_config['allowed_types'] = 'gif|jpg|jpeg|png|jpe';
        $upload_config['max_size'] = '2048';
        $this->load->library('upload', $upload_config);

        if(!$this->upload->do_upload()) {
            showmsg($this->upload->display_errors());
        } else {
            $data = $this->upload->data();
            $data['attachment'] = str_replace($upload_config['upload_path'], '', $data['full_path']);
            $param = array(
                'dateline'     => TIMESTAMP,
                'file_name'    => $data['file_name'],
                'file_size'    => $data['file_size'],
                'is_image'     => $data['is_image'],
                'image_width'  => $data['image_width'],
                'image_height' => $data['image_height'],
                'attachment'   => $data['attachment'],
            );
            $this->attachment->insert($param);
            showmsg('操作成功');
        }
    }

    public function remove_atta() {
        $input = $this->input->get();
        $attachment = $this->attachment->get_by_id($input['id']);
        if(!$attachment) {
            showmsg('订单不存在');
        }
        $this->attachment->delete_by_id($input['id']);
        @unlink(HOMEBASE.'web/uploads/'.$attachment['attachment']);
        showmsg('操作成功');
    }
}
