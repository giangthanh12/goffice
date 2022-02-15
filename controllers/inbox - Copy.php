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
        $this->view->list = $this->model->getList($type);
        $this->view->type = $type;
        $this->view->count = $this->model->getCount();
        $this->view->employee=$this->model->getEmployee();
        $this->view->render("inbox/index");
        require "layouts/footer.php";
    }

    function getInboxNotSeen() {
        $val = $this->model->getInboxNotSeen();
        if ($val >= 0) {
            $jsonObj['val'] = $val;
            $jsonObj['msg'] = "Cập nhật thành công";
            $jsonObj['success'] = true;
        } else {
            $jsonObj['val'] = $val;
            $jsonObj['msg'] = "Xóa không thành công";
            $jsonObj['success'] = false;
        }
        echo json_encode($jsonObj);
    }
    function deleteMsg(){
        $ids = $_REQUEST['ids'];
        $type = $_REQUEST['type'];
       
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
        $type = $_REQUEST['type'];
        
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
        $avatar = $this->model->getAvatar($_SESSION['user']['staffId']);
        $title = $_REQUEST['emailSubject'];
        $content = $_REQUEST['body'];
        
        $files = $_FILES['files'];
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
            $data['attachmentFile']=$filenames;
        }
        $row = 0;
        foreach($_REQUEST['email-to'] as $item) {
            $data = array('senderId'=>$_SESSION['user']['staffId'], 'title'=>$title, 'content'=>$content,
            'receiverId'=>json_encode([$item]), 'status'=>1, 'dateTime'=>date('Y-m-d H:i:s'), 'link'=>'inbox');
            $this->model->add($data);
            $row++;
        }

        if ($row > 0) {
            $jsonObj['data'] = array('senderId'=>$_SESSION['user']['staffId'], 'avatar'=>$avatar, 'title'=>$title, 'content'=>$content,
            'receiverId'=>$receiverId, 'status'=>1, 'dateTime'=>date('Y-m-d H:i:s'), 'link'=>'inbox');
            $jsonObj['msg'] = "Đã gửi thông báo";
            $jsonObj['success'] = true;
        } else {
            $jsonObj['msg'] = "Lỗi khi cập nhật database".$receiverId;
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

?>
