<?php
class inbox extends Controller
{
    function __construct()
    {
        parent::__construct();
    }

    function index()
    {
        require "layouts/header.php";
        $type = isset($_REQUEST['type'])?$_REQUEST['type']:'inbox';
        $this->view->list = $this->model->getList(0,5,$type);
        $this->view->count = $this->model->getCount();
        $this->view->type = $type;
        $this->view->employee=$this->model->getEmployee();
        $this->view->render("inbox/index");
        require "layouts/footer.php";
    }

    function deleteMsg(){
        $type = isset($_REQUEST['type'])?$_REQUEST['type']:'inbox';
        $ids = $_REQUEST['ids'];
        if ($this->model->deleteMsg($ids,$type)) {
            $jsonObj['msg'] = "Cập nhật thành công";
            $jsonObj['success'] = true;
        } else {
            $jsonObj['msg'] = "Xóa không thành công".$ids;
            $jsonObj['success'] = false;
        }
        $jsonObj = json_encode($jsonObj);
        echo $jsonObj;
    }

    function loadMsg()
    {
        $id = $_REQUEST['id'];
        $type = isset($_REQUEST['type'])?$_REQUEST['type']:'inbox';
        $data = $this->model->loadMsg($id,$type);
        if (sizeof($data)>0) {
            $jsonObj['data'] = $data;
            $jsonObj['success'] = true;
        } else {
            $jsonObj['msg'] = "Load data fail".$id;
            $jsonObj['success'] = false;
        }
        $jsonObj = json_encode($jsonObj);
        echo $jsonObj;
    }

    function sendMsg()
    {
        $receiverId = json_encode($_REQUEST['email-to']);
        if ($receiverId=='["0"]')
        $_REQUEST['email-to'] = $this->model->getIdStaff();
        $title = $_REQUEST['emailSubject'];
        $content = $_REQUEST['body'];
        $info = $this->model->getInfoSender($_SESSION['user']['staffId']);
        $data = array('senderId'=>$_SESSION['user']['staffId'], 'title'=>$title, 'content'=>$content,
            'receiverId'=>$receiverId, 'status'=>1, 'dateTime'=>date('Y-m-d H:i:s'), 'link'=>'inbox');
            $attachmentFile = '';
            if($_FILES['files']['name'][0]!='') {
            $dir = ROOT_DIR . '/uploads/dinhkem/';
            $filenames = '';
            for($i=0;$i<count($_FILES['files']['name']);$i++) {
                $fname = functions::upfiles($_FILES['files']['name'][$i], $_FILES['files']['size'][$i], $_FILES['files']['tmp_name'][$i], $dir);
                if ($fname!='')
                    if($filenames=='')
                        $filenames = $fname;
                    else
                        $filenames .= ','.$fname;
            }
            $attachmentFile = $filenames;
        }
       
        $row = 0;
        $dataInboxReceiver= [];
        $inboxIds= [];

        $dataSend = array('senderId'=>$_SESSION['user']['staffId'], 'title'=>$title, 'content'=>$content,
        'receiverId'=>0, 'status'=>1, 'dateTime'=>date('Y-m-d H:i:s'), 'attachmentFile'=>$attachmentFile, 'link'=>'inbox');
        $idInbox = $this->model->addInboxSend($dataSend);
        if($idInbox < 0) {
            $jsonObj['msg'] = "Lỗi khi cập nhật database".$receiverId;
            $jsonObj['success'] = false;
            echo json_encode($jsonObj);
            return;
        }
        foreach($_REQUEST['email-to'] as $key=>$item) {
            $data = array('senderId'=>$_SESSION['user']['staffId'], 'title'=>$title, 'content'=>$content,
            'receiverId'=>json_encode([$item]), 'status'=>1,'attachmentFile'=>$attachmentFile, 'dateTime'=>date('Y-m-d H:i:s'), 'link'=>'inbox');
            $idInbox = $this->model->add($data);
            $inboxIds[] = $idInbox;
            $dataInboxReceiver[] = array('inboxId'=> $idInbox, 'receiverId'=>$item);
            $row++;
        }
      
        if ($row > 0) {
            $jsonObj['data'] = array('senderId'=>$_SESSION['user']['staffId'], 'avatar'=>$info['avatar'],'nameSender'=>$info['name'] ,'title'=>$title, 'content'=>$content,
            'receiverId'=>$_REQUEST['email-to'], 'status'=>1,'idInbox'=>$dataInboxReceiver,'inboxIds'=>$inboxIds, 'dateTime'=>date('Y-m-d H:i:s'), 'link'=>'inbox');
            $jsonObj['msg'] = "Đã gửi thông báo thành công";
            $jsonObj['success'] = true;
        } else {
            $jsonObj['msg'] = "Lỗi khi cập nhật database".$receiverId;
            $jsonObj['success'] = false;
        }
        echo json_encode($jsonObj);
    }
    function getListInbox() {
        $page = $_REQUEST['page'];
        $selectedType = isset($_REQUEST['selectedType']) ? $_REQUEST['selectedType'] :'inbox';
        $num_per_page = 5;
        $start = ($page-1)*$num_per_page;
        $data = $this->model->getList($start,$num_per_page,$selectedType);
        if(count($data) > 0) {
            $jsonObj['data'] = $data;
            $jsonObj['success'] = true;
        }
        else {
            $jsonObj['data'] = [];
            $jsonObj['success'] = false;
        }
        echo json_encode($jsonObj);
    }

    function getdata()
    {
        $type = isset($_REQUEST['type'])?$_REQUEST['type']:'inbox';
        $data = $this->model->getdata($type);
        echo json_encode($data);
    }

    function unread()
    {
        $data = $this->model->unread();
        echo $data;
    }

    function sent()
    {
        $data = $this->model->getsentitem();
        echo json_encode($data);
    }
    function getCount() {
        $data = $this->model->getCount();
        echo json_encode($data);
    }

    // function send()
    // {
    //     //
    //     $receiverId = $_REQUEST['receiverId'];
    //     $title = $_REQUEST['title'];
    //     $content = $_REQUEST['content'];
    //     $data = array('title'=>$title, 'content'=>$content, 'receiverId'=>$receiverId, 'status'=>1);
    //     $files = $_FILES['files'];
    //     if($_FILES['files']['name'][0]!='') {
    //         $dir = ROOT_DIR . '/uploads/dinhkem/';
    //         $filenames = '';
    //         for($i=0;$i<count($_FILES['files']['name']);$i++) {
    //             $fname = functions::upfiles($_FILES['files']['name'][$i], $_FILES['files']['size'][$i], $_FILES['files']['tmp_name'][$i], $dir);
    //             if ($fname!='')
    //                 if($filenames=='')
    //                     $filenames = $fname;
    //                 else
    //                     $filenames .= ','.$fname;
    //         }
    //         $data['attachmentFile']=$filenames;
    //     }
    //     $receiver = $this->model->add($data);
    //     if ($receiver!='') {
    //         $jsonObj['msg'] = "Đã gửi thông báo";
    //         $jsonObj['success'] = true;
    //         $jsonObj['receiver'] = $receiver;
    //     } else {
    //         $jsonObj['msg'] = "Lỗi khi cập nhật database";
    //         $jsonObj['success'] = false;
    //     }
    //     echo json_encode($jsonObj);
    // }
    //
    // function checkmail() // dùng cho notification
    // {
    //     $data = $this->model->checkmail();
    //     echo json_encode($data);
    // }
    //
    // function markunread()
    // {
    //     $ids = $_REQUEST['ids'];
    //     if ($this->model->markunread($ids)) {
    //         $jsonObj['msg'] = "Cập nhật dữ liệu thành công";
    //         $jsonObj['success'] = true;
    //     } else {
    //         $jsonObj['msg'] = "Lỗi khi cập nhật database";
    //         $jsonObj['success'] = false;
    //     }
    //     echo json_encode($jsonObj);
    // }
    //
    // function thayanh()
    // {
    //     $id = $_REQUEST['myid'];
    //     $filename = $_FILES['hinhanh']['name'];
    //     $hinhanh = '';
    //     if ($filename!='') {
    //         $dir = ROOT_DIR . '/uploads/nhanvien/';
    //         $file = functions::uploadfile('hinhanh', $dir, $id);
    //         if ($file!='')
    //             $hinhanh = URLFILE.'/uploads/nhanvien/'.$file;
    //     }
    //     if ($this->model->thayanh($hinhanh,$id)) {
    //         $jsonObj['filename'] = $hinhanh;
    //         $jsonObj['msg'] = "Cập nhật dữ liệu thành công".$file;
    //         $jsonObj['success'] = true;
    //     } else {
    //         $jsonObj['msg'] = "Lỗi khi cập nhật database";
    //         $jsonObj['success'] = false;
    //     }
    //     echo json_encode($jsonObj);
    // }

    // function xoa()
    // {
    //     $ids = $_REQUEST['ids'];
    //     if ($this->model->xoa($ids)) {
    //         $jsonObj['msg'] = "Cập nhật dữ liệu thành công";
    //         $jsonObj['success'] = true;
    //     } else {
    //         $jsonObj['msg'] = "Lỗi khi xóa dữ liệu".$ids;
    //         $jsonObj['success'] = false;
    //     }
    //     echo json_encode($jsonObj);
    // }
    //
    //
    //
    // function nhanvien() { // nap du lieu vao select2 de chon nguoi nhan, cc, bcc
    //     $data = $this->model->nhanvien();
    //     echo json_encode($data);
    // }

}
