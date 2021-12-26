<?php

class chatbox extends Controller
{
    function __construct()
    {
        parent::__construct();
        $model = new Model();
//        if ($model->checkright('chatbox') == false)
//            header('Location: ' . URL);
    }

    function index()
    {
        require HEADER;
        $js = "chatbox";
        $this->view->nhanvien = $this->model->nhanvien();
//        $this->view->listUsersChats = $this->listUsersChats();
        $this->view->render('chatbox/index');
        require FOOTER;
    }

    function listUsersChats()
    {
        $userReceiveId = isset($_REQUEST['userReceiveId']) ? $_REQUEST['userReceiveId'] : 0;
        $updateOnline = isset($_REQUEST['updateOnline']) ? $_REQUEST['userReceiveId'] : 0;
        $jsonObj = $this->model->listUsersChats($userReceiveId,$updateOnline);
        $key = 0;
        $json = "";
//        foreach ($jsonObj as $item) {
//            $key++;
//            $json .= '<li value="' . $item['id'] . '" ' . $item['isactive'] . '>';
//            $json .= '<span class="avatar">';
//            $json .= '<img src="' . $item['hinh_anh'] . '"height="42" width="42" alt="' . $item['name'] . ' image"/>';
//            $json .= '<span class="avatar-status-'.$item['online'].'"></span></span>';
//            $json .= '<div class="chat-info flex-grow-1">';
//            $json .= '<h5 class="mb-0">' . $item['name'] . '</h5>';
//            $json .= '<p class="card-text text-truncate">';
//            $json .= '' . $item['lastmessenger'] . '';
//            $json .= '</p>';
//            $json .= '</div>';
//            $json .= '<div class="chat-meta text-nowrap">';
//            $json .= '<small class="float-right mb-25 chat-time">' . date("h:i A", $item['lastHour']) . '</small>';
//            if ($item['totalUnread'] > 0)
//                $json .= '<span class="badge badge-danger badge-pill float-right">' . $item['totalUnread'] . '</span>';
//            $json .= '</div>';
//            $json .= '</li>';
//        }
//        $show = $key == 0 ? "show" : "";
//        $json .= '<li class="no-results ' . $key . '">';
//        $json .= '<h6 class="mb-0">No Chats Found</h6>';
//        $json .= '</li>';
        echo json_encode($jsonObj);
    }


    function loaduser()
    {
        $userReceiveId = $_REQUEST['userReceiveId'];
        $nhanvien = $this->model->getUserInfo($userReceiveId);
        $chat_navbar = '';
        $chat_navbar .= '<div class="sidebar-toggle d-block d-lg-none mr-1">';
        $chat_navbar .= '<i data-feather="menu" class="font-medium-5"></i>';
        $chat_navbar .= '</div>';
        $chat_navbar .= '<div class="avatar avatar-border user-profile-toggle m-0 mr-1">';
        if ($nhanvien['hinh_anh'] != '')
            $chat_navbar .= '<img src="' . $nhanvien['hinh_anh'] . '"';
        else
            $chat_navbar .= '<img src="' . URL . '/template/images/default_avatar.png"';
        $chat_navbar .= ' alt="avatar" height="36" width="36"/>';
        $chat_navbar .= '<span class="avatar-status-busy"></span>';
        $chat_navbar .= '</div>';
        $chat_navbar .= '<h6 class="mb-0">' . $nhanvien['name'] . '</h6>';
        $jsonObj = $chat_navbar;
        $this->view->jsonObj = $jsonObj;
        $this->view->render('common/json');
    }

    function loadmessages()
    {
        $rows = [];
        $result = [];
        $userReceiveId = $_REQUEST['userReceiveId'];
        if (isset($_GET['newest'])) {
            $newest = (filter_var($_GET['newest'], FILTER_SANITIZE_NUMBER_FLOAT));
            $newest = str_replace(array('+', '-'), '', $newest);
            $rows = $this->model->getMessengerNewest($newest, $userReceiveId);
        } elseif (isset($_GET['first'])) {
            $first = (filter_var($_GET['first'], FILTER_SANITIZE_NUMBER_FLOAT));
            $first = str_replace(array('+', '-'), '', $first);
            $rows = $this->model->getMessengerFirst($first, $userReceiveId);
        }
        $result['data'] = [];
        foreach ($rows['data'] as $row) {
            $poruka = functions::xss($row['message']);
            $poruka = functions::smilies($poruka);
            if (functions::isImage($poruka)) {
                $poruka = "<a href='" . $poruka . "' class='pop' target='_blank'><img class='pop-inner' src='" . $poruka . "'/></a>";
            } elseif (functions::isYoutube($poruka)) {
                $poruka = functions::convertYoutube($poruka);
            } else {
                $poruka = functions::linkify($poruka);
            }
            $poruka = functions::showBBcodes($poruka);
            $time = date('H:i:s', $row['time']);
            $isadmin = "0";
            $arr = array(
                "msg_id" => $row['Id'],
                "user_id" => $row['senderId'],
                "time" => $time,
                "name" => $row['name'],
                "message" => $poruka,
                'hinh_anh' => '',
                'receiverImg'=>$row['receiverImg'],
                'senderImg'=>$row['senderImg'],
                "candel" => $isadmin);
            array_push($result['data'], $arr);
        }
        $result['sql'] = $rows['sql'];
        echo json_encode($result, JSON_PRETTY_PRINT);
    }

    function addMessenger()
    {
        $msg = $_REQUEST['messenger'];
        if ($msg != '') {
            $userReceiveId = $_REQUEST['userReceiveId'];
            $userSendId = $_SESSION['user']['nhan_vien'];
            $userSendName = $_SESSION['user']['nhanvien'];
            $data = array(
                "receiveType" => 1,
                "receiverId" => $userReceiveId,
                "senderId" => $userSendId,
                "name" => $userSendName,
                "message" => $msg,
                'time' => time(),
                "ip" => $_SERVER['REMOTE_ADDR'],
                "tinh_trang" => 1);
            if ($this->model->addObj($data))
                $jsonObj = true;
            else
                $jsonObj = false;
            $this->view->jsonObj = $jsonObj;
            $this->view->render('common/json');
        }
    }

//    function InsertBanGhi()
//    {
//        for ($i = 0; $i < 10000; $i++) {
//            $this->model->InsertBanGhi();
//        }
//    }
}

?>

