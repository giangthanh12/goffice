<?php

class Chatbox extends Controller
{
    private $_Data;

    function __construct()
    {
        parent::__construct();
        $this->_Data = new Model();
    }

    function index()
    {

    }

    function list_contact()
    {
        $listnv = isset($_REQUEST['listnv']) ? $_REQUEST['listnv'] : '';
        $json = $this->model->get_list_all_nhanvien($_REQUEST['userid'], $listnv);
        echo json_encode($json);
    }

    function list_chatbox()
    {
        $json = $this->model->get_list_chatbox($_REQUEST['userid']);
        echo json_encode($json);
    }

    function list_content_chat_point()
    {
        $userid = isset($_REQUEST['userid']) ? $_REQUEST['userid'] : 0;
        $chatgroup = isset($_REQUEST['chatgroup']) ? $_REQUEST['chatgroup'] : 0;
        if ($chatgroup == 0) {
            $idenemy = isset($_REQUEST['idenemy']) ? $_REQUEST['idenemy'] : 0;
            $chatbox = $this->model->get_content_chatbox($userid, $idenemy);
        } else {
            $code = isset($_REQUEST['code']) ? $_REQUEST['code'] : 0;
            $chatbox = $this->model->get_content_chatbox_via_code($code);
        }
        if (count($chatbox) > 0) {
            $filechat = ROOT_DIR . '/chatbox/' . $chatbox[0]['file'];
            $doc = new DOMDocument();
            $doc->load($filechat);
            $result = $doc->getElementsByTagName("chatbox");
            $json = array();
            $array = array();
            foreach ($result as $row) {
                $tag_userid = $row->getElementsByTagName("user_id");
                $user_id = $tag_userid->item(0)->nodeValue;
                $tag_name = $row->getElementsByTagName("name");
                $name = $tag_name->item(0)->nodeValue;
                $tag_time = $row->getElementsByTagName("time");
                $time = $tag_time->item(0)->nodeValue;
                $tag_msg = $row->getElementsByTagName("msg");
                $msg = $tag_msg->item(0)->nodeValue;
                $userinfo = $this->model->get_info_detail($user_id);
                $array[] = array('user_id' => $user_id, 'name' => $name, 'datetime' => date("d/m/Y H:i:s",strtotime($time)), 'msg' => $msg, 'hinh_anh' => $userinfo[0]['hinh_anh'],'time'=>strtotime($time));
            }
            $data = array('tin_chua_doc' => 0);
            $this->model->update_tin_chua_doc($chatbox[0]['code'], $userid, $data);
            $json['data'] = $array;
        } else {
            $json['data'] = [];
        }
        echo json_encode($json);
    }
    function chattest(){
        echo 'abc';
    }

    function chat()
    {
        $userid = $_REQUEST['userid'];
        $enemyid = $_REQUEST['id_enemy'];
        $codechat = $_REQUEST['chat_code'];
        $msg = $_REQUEST['msg_chat'];
        $detail_nhanvien = $this->model->get_info_detail_nhanvien($userid);
        // tao bang hi chat
        if ($codechat == 0) {
            // kiem tra xem co ton tai lich su chat chua
            $chatbox = $this->model->get_content_chatbox($userid, $enemyid);
            if (count($chatbox) > 0) {
                $filexml = ROOT_DIR . '/chatbox/' . $chatbox[0]['file'];
                $time = date("Y-m-d H:i:s");
                $dom = new DOMDocument();
                $dom->formatOutput = true;
                $dom->load($filexml, LIBXML_NOBLANKS);
                $root = $dom->documentElement;
                $newresult = $root->appendChild($dom->createElement('chatbox'));
                $newresult->setAttribute('id', time());
                $newresult->appendChild($dom->createElement('user_id', $userid));
                $newresult->appendChild($dom->createElement('name', $detail_nhanvien[0]['name']));
                $newresult->appendChild($dom->createElement('time', $time));
                $newresult->appendChild($dom->createElement('msg', $msg));
                $dom->save($filexml) or die('XML Create Error');
                // cap nhat tin nhan cuoi
                $data = array('create_at' => $time, 'tin_nhan_cuoi' => $msg);
                $this->model->updateObj($chatbox[0]['code'], $data);
                // cap nhat tin chua doc
                $read = $this->model->check_exit_into_read($chatbox[0]['code'], $enemyid);
                $data_read = array('tin_chua_doc' => $read[0]['tin_chua_doc'] + 1);
                $this->model->update_tin_chua_doc($chatbox[0]['code'], $enemyid, $data_read);
                $this->model->update_tin_chua_doc($chatbox[0]['code'], $userid, array('tin_chua_doc' => 0));
                $jsonObj['code'] = $chatbox[0]['code'];
            } else {
                $code = time() . $userid+$enemyid;
                $filexml = $code . '.xml';
                $data = array('code' => $code, 'name' => '', 'nhan_vien' => $enemyid, 'nguoi_tao' => $userid,
                    'chat_group' => 0, 'create_at' => date("Y-m-d H:i:s"), 'file' => $filexml,
                    'tin_nhan_cuoi' => $msg);
                $this->model->addObj($data);
                ////////////////////////////////////////////////
                $dom = new DOMDocument('1.0', 'UTF-8');
                $dom->formatOutput = true;
                $root = $dom->createElement('gemstech');
                $dom->appendChild($root);
                $result = $dom->createElement('chatbox');
                $root->appendChild($result);
                $result->setAttribute('id', time());
                $result->appendChild($dom->createElement('user_id', $userid));
                $result->appendChild($dom->createElement('name', $detail_nhanvien[0]['name']));
                $result->appendChild($dom->createElement('time', date('H:i:s d-m-Y')));
                $result->appendChild($dom->createElement('msg', $msg));
                $dom->save(ROOT_DIR . '/chatbox/' . $filexml) or die('XML Create Error');
                //  chmod(ROOT_DIR.'/chatbox/'.$filexml, '0660');
                $data_read = array('tin_chua_doc' => 1, 'code' => $code, 'nhan_vien' => $enemyid);
                $this->model->add_tin_chua_doc($data_read);
                $this->model->update_tin_chua_doc($code, $userid, array('tin_chua_doc' => 0));
                $jsonObj['code'] = $code;
            }
        } else {
            $chatbox = $this->model->get_chatbox_via_code($codechat);
            $filexml = ROOT_DIR . '/chatbox/' . $chatbox[0]['file'];
            $time = date("Y-m-d H:i:s");
            $dom = new DOMDocument();
            $dom->formatOutput = true;
            $dom->load($filexml, LIBXML_NOBLANKS);
            $root = $dom->documentElement;
            $newresult = $root->appendChild($dom->createElement('chatbox'));
            $newresult->setAttribute('id', time());
            $newresult->appendChild($dom->createElement('user_id', $userid));
            $newresult->appendChild($dom->createElement('name', $detail_nhanvien[0]['name']));
            $newresult->appendChild($dom->createElement('time', $time));
            $newresult->appendChild($dom->createElement('msg', $msg));
            $dom->save($filexml) or die('XML Create Error');
            // chmod($filexml, '0660');
            $data = array('create_at' => $time, 'tin_nhan_cuoi' => $msg);
            if ($chatbox[0]['chat_group'] = 0) {
                $read1 = $this->model->check_exit_into_read($codechat, $chatbox[0]['nguoi_tao']);
                if (count($read1) > 0) {
                    $data_read = array('tin_chua_doc' => $read1[0]['tin_chua_doc'] + 1);
                    $this->model->update_tin_chua_doc($codechat, $chatbox[0]['nguoi_tao'], $data_read);
                } else {
                    $data_read = array('tin_chua_doc' => 1, 'code' => $codechat, 'nhan_vien' => $chatbox[0]['nguoi_tao']);
                    $this->model->add_tin_chua_doc($data_read);
                }
                $read2 = $this->model->check_exit_into_read($codechat, $chatbox[0]['nhan_vien']);
                if (count($read1) > 0) {
                    $data_read = array('tin_chua_doc' => $read1[0]['tin_chua_doc'] + 1);
                    $this->model->update_tin_chua_doc($codechat, $chatbox[0]['nhan_vien'], $data_read);
                } else {
                    $data_read = array('tin_chua_doc' => 1, 'code' => $codechat, 'nhan_vien' => $chatbox[0]['nhan_vien']);
                    $this->model->add_tin_chua_doc($data_read);
                }
            } else {
                $read1 = $this->model->check_exit_into_read($codechat, $chatbox[0]['nguoi_tao']);
                if (count($read1) > 0) {
                    $data_read = array('tin_chua_doc' => $read1[0]['tin_chua_doc'] + 1);
                    $this->model->update_tin_chua_doc($codechat, $chatbox[0]['nguoi_tao'], $data_read);
                } else {
                    $data_read = array('tin_chua_doc' => 1, 'code' => $codechat, 'nhan_vien' => $chatbox[0]['nguoi_tao']);
                    $this->model->add_tin_chua_doc($data_read);
                }
                $nhanvien = explode(",", $chatbox[0]['nhan_vien']);
                foreach ($nhanvien as $row) {
                    $read1 = $this->model->check_exit_into_read($codechat, $row);
                    if (count($read1) > 0) {
                        $data_read = array('tin_chua_doc' => $read1[0]['tin_chua_doc'] + 1);
                        $this->model->update_tin_chua_doc($codechat, $row, $data_read);
                    } else {
                        $data_read = array('tin_chua_doc' => 1, 'code' => $codechat, 'nhan_vien' => $row);
                        $this->model->add_tin_chua_doc($data_read);
                    }
                }
            }
            $this->model->update_tin_chua_doc($chatbox[0]['code'], $userid, array('tin_chua_doc' => 0));
            $this->model->updateObj($chatbox[0]['code'], $data);
            $jsonObj['code'] = $codechat;
        }
        $jsonObj['msg'] = "Chat thành công";
        $jsonObj['success'] = true;
        $jsonObj['nguoinhan'] = $enemyid;
        echo json_encode($jsonObj);
    }

    function add_group()
    {
        $userid = $_REQUEST['userid'];
        $name = $_REQUEST['title_group'];
        $thanhvien = implode(",", $_REQUEST['list_users']);
        $code = time() . $userid;
        $filexml = $code . '.xml';
        $detail_nhanvien = $this->model->get_info_detail_nhanvien($userid);
        //////////////////////////////////////////////////////////////////////////
        $data = array('code' => $code, 'name' => $name, 'nhan_vien' => $thanhvien, 'nguoi_tao' => $userid,
            'file' => $filexml, 'chat_group' => 1, 'create_at' => date("Y-m-d H:i:s"));
        $temp = $this->model->addObj($data);
        if ($temp) {
            $dom = new DOMDocument('1.0', 'UTF-8');
            $dom->formatOutput = true;
            $root = $dom->createElement('gemstech');
            $dom->appendChild($root);
            $result = $dom->createElement('chatbox');
            $root->appendChild($result);
            $result->setAttribute('id', time());
            $result->appendChild($dom->createElement('user_id', $userid));
            $result->appendChild($dom->createElement('name', $detail_nhanvien[0]['name']));
            $result->appendChild($dom->createElement('time', date('H:i:s d-m-Y')));
            $result->appendChild($dom->createElement('msg', 'Xin chào'));
            $dom->save(ROOT_DIR . '/chatbox/' . $filexml) or die('XML Create Error');
            //        chmod(ROOT_DIR.'/chatbox/'.$filexml, '0660');
            $jsonObj['msg'] = "Tạo nhóm thành công";
            $jsonObj['success'] = true;
        } else {
            $jsonObj['msg'] = "Tạo nhóm không thành công";
            $jsonObj['success'] = false;
        }
        echo json_encode($jsonObj);
    }

    function return_total_unread()
    {
        $userid = $_REQUEST['userid'];
        $json = $this->model->get_total_tin_nhan_chua_doc($userid);
        $jsonObj['total'] = $json;
        echo json_encode($jsonObj);

    }

    function combo()
    {
        $json = $this->model->get_data_combo();
        echo json_encode($json);
    }

    function userinfo()
    {
        $id = $_REQUEST['id'];
        $json = $this->model->get_info_detail($id);
        $jsonObj['msg'] = "Load dữ liệu thành công";
        $jsonObj['success'] = true;
        $jsonObj['data'] = $json;
        echo json_encode($jsonObj);
    }

    function readall(){
        $chatcode = $_REQUEST['chatcode'];
        $nhanvien = $_REQUEST['nhanvien'];
        $this->model->update_tin_chua_doc($chatcode, $nhanvien, array('tin_chua_doc' => 0));
        $jsonObj['msg'] = "Load dữ liệu thành công";
        $jsonObj['success'] = true;
        echo json_encode($jsonObj);
    }
}

?>