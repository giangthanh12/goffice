<?php
class todo extends Controller{
    function __construct(){
        parent::__construct();
    }

    function index(){
        $nhanvien = (isset($_REQUEST['id']) && $_REQUEST['id']>0)?$_REQUEST['id']:$_SESSION['user']['nhan_vien'];
        $json = $this->model->get_data($nhanvien);
        echo json_encode($json);
    }

    function getitem(){ // lay thong tin cong viec chi tiet vào form)
        $id = $_REQUEST['id'];
        $json = $this->model->getitem($_REQUEST['id']);
        echo json_encode($json);
    }

    function nhanvien(){
        $id = (isset($_REQUEST['id']) && $_REQUEST['id']>0)?$_REQUEST['id']:$_SESSION['user']['nhan_vien'];
        $json = $this->model->get_nhanvien($id);
        echo json_encode($json);
    }

    function update(){
        $id = $_REQUEST['id'];
        $name = $_REQUEST['name'];
        $deadline = date("Y-m-d", strtotime($_REQUEST['deadline']));
        $label = $_REQUEST['label'];
        $nhanvien = ($_REQUEST['nhanvien']>0)?$_REQUEST['nhanvien']:$_SESSION['user']['nhan_vien'];;
        $file = $_REQUEST['file'];
        $comment = $_REQUEST['comment'];
        $data = array('name'=>$name, 'mo_ta'=>$comment, 'label'=>$label, 'nhan_vien'=>$nhanvien);
        if ($this->model->capnhat($id, $data, $file, $comment,$deadline)) {
            $jsonObj['msg'] = "Cập nhật thành công";
            $jsonObj['success'] = true;
        } else {
            $jsonObj['msg'] = "Cập nhật không thành công";
            $jsonObj['success'] = false;
        }
        $jsonObj = json_encode($jsonObj);
        echo $jsonObj;
    }

    function comment(){
        $id = $_REQUEST['id'];
        $data = $this->model->comment($id);
        echo json_encode($data);
    }

    function del(){
        $id = $_REQUEST['id'];
        if ($this->model->delObj($id)) {
            $jsonObj['msg'] = "Đã xóa item";
            $jsonObj['success'] = true;
        } else {
            $jsonObj['msg'] = "Xóa không thành công";
            $jsonObj['success'] = false;
        }
        $jsonObj = json_encode($jsonObj);
        echo $jsonObj;
    }

    function addcomment(){
        $id = $_REQUEST['id'];
        $comment = $_REQUEST['comment'];
        $return = $this->model->addcomment($id,$comment);
        if ($return['query']) {
            $jsonObj['msg'] = "Cập nhật thành công";
            $jsonObj['success'] = true;
            $jsonObj['receiver'] = $return['receiver'];
        } else {
            $jsonObj['msg'] = "Lỗi khi cập nhật database";
            $jsonObj['success'] = false;
        }
        $jsonObj = json_encode($jsonObj);
        echo $jsonObj;
    }

    function completed(){
        $id = $_REQUEST['id'];
        if ($this->model->completed($id)) {
            $jsonObj['msg'] = "Chúc mừng bạn đã hoàn thành task này";
            $jsonObj['success'] = true;
        } else {
            $jsonObj['msg'] = "Lỗi khi cập nhật database";
            $jsonObj['success'] = false;
        }
        $jsonObj = json_encode($jsonObj);
        echo $jsonObj;
    }

    function checkcomm() // dùng cho notification
    {
        $data = $this->model->checkcomm();
        echo json_encode($data);
    }

}
?>
