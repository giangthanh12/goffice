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
        $chatboxid = isset($_REQUEST['chatboxid']) ? $_REQUEST['chatboxid'] : 0;
        $page = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
        $rows = 15;
        $offset = ($page - 1) * $rows;
        if ($chatboxid > 0) {
            $chatbox = $this->model->get_content_chatbox($chatboxid, $offset, $rows);
            if (count($chatbox) > 0) {
                $json['data'] = $chatbox;
            } else {
                $json['data'] = [];
            }
        } else {
            $json['data'] = [];
        }
        echo json_encode($json);
    }

    function chat()
    {
        $senderid = $_REQUEST['senderid'];
        $receiverid = $_REQUEST['receiverid'];
        $chatboxid = $_REQUEST['chatboxid'];
        $message = $_REQUEST['message'];
//        $detailnhanvien = $this->model->get_info_detail_nhanvien($senderid);
        // tao bang hi chat
        if ($chatboxid == 0) {
            $datachatbox = [
                'name' => '',
                'receiver_id' => $receiverid,
                'sender_id' => $senderid,
                'type' => 0,
                'create_at' => date("Y-m-d H:i:s"),
                'status' => 1
            ];
            $chatboxid = $this->model->addObj($datachatbox);
            if ($chatboxid > 0) {
                $data = [
                    'chat_box_id' => $chatboxid,
                    'sender_id' => $senderid,
                    'datetime' => date("Y-m-d H:i:s"),
                    'message' => $message,
                    'status' => 1
                ];
                $this->model->addTinNhan($data);
                $dataunread = ['chat_box_id' => $chatboxid, 'total_unread' => 1, 'receiver_id' => $receiverid];
                $this->model->addUnread($dataunread);
                $jsonObj['chatboxid'] = $chatboxid;
            }
        } else {
            $data = [
                'chat_box_id' => $chatboxid,
                'sender_id' => $senderid,
                'datetime' => date("Y-m-d H:i:s"),
                'message' => $message,
                'status' => 1
            ];
            if ($this->model->addTinNhan($data)) {
                // chmod($filexml, '0660');
                $totalUnRead = $this->model->checkUnread($chatboxid, $receiverid);
                if ($totalUnRead > 0) {
                    $this->model->updateUnRead($chatboxid, $senderid);
                } else {
                    $dataunread = ['chat_box_id' => $chatboxid, 'total_unread' => 1, 'receiver_id' => $receiverid];
                    $this->model->addUnread($dataunread);
                }
            }
        }
        $jsonObj['chatboxid'] = $chatboxid;
        $jsonObj['success'] = true;
        $jsonObj['receiverid'] = $receiverid;
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

    function readall()
    {
        $chatboxid = $_REQUEST['chatboxid'];
        $receiverid = $_REQUEST['receiverid'];
        $this->model->update_tin_chua_doc($chatboxid, $receiverid, array('total_unread' => 0));
        $jsonObj['msg'] = "Load dữ liệu thành công";
        $jsonObj['success'] = true;
        echo json_encode($jsonObj);
    }

    function checkmessage()
    {
        $nhanvien = isset($_SESSION['user']['nhan_vien']) ? $_SESSION['user']['nhan_vien'] : (isset($_REQUEST['nhanvienid']) ? $_REQUEST['nhanvienid'] : 0);
        if ($nhanvien) {
            $data = $this->model->getUnreadMessage($nhanvien);
            if (count($data) > 0) {
                if (!isset($_SESSION['user']['unreadid']) || $_SESSION['user']['unreadid'] != $data['id']) {
                    $_SESSION['user']['unreadid'] = $data['id'];
                    $jsonObj['code'] = '200';
                    $jsonObj['message'] = $data['message'];
                } else {
                    $jsonObj['code'] = '402' . $data['id'];
                }
            } else {
                $jsonObj['code'] = '401';
            }
        } else {
            $jsonObj['code'] = '400';
        }
        echo json_encode($jsonObj);
    }

    function getReceiverInfo()
    {
        $nhanvien = isset($_REQUEST['nhanvien'])?$_REQUEST['nhanvien']:0;
        if($nhanvien>0) {
            $data = $this->model->getReceiverInfo($nhanvien);
            if (count($data) > 0) {
                $jsonObj['code'] = '200';
                $jsonObj['data'] = $data;
            } else {
                $jsonObj['code'] = '401';
            }
        }else{
            $jsonObj['code'] = '400';
        }
        echo json_encode($jsonObj);
    }
}

?>