<?php
class congviec extends Controller{
    function __construct(){
        parent::__construct();
    }

    function index(){
        $nhanvien = isset($_REQUEST['id'])?$_REQUEST['id']:$_SESSION['user']['nhan_vien'];
        $json = $this->model->get_data($nhanvien);
        echo json_encode($json);
    }

    function getitem(){ // lay thong tin cong viec chi tiet vào form)
        $id = $_REQUEST['id'];
        $json = $this->model->getitem($_REQUEST['id']);
        echo json_encode($json);
    }

    function nhanvien(){
        $id = $_REQUEST['id'];
        $json = $this->model->get_nhanvien($id);
        echo json_encode($json);
    }

    function update(){
        $id = $_REQUEST['id'];
        $name = $_REQUEST['name'];
        $deadline = date("Y-m-d", strtotime($_REQUEST['deadline']));
        $label = $_REQUEST['label'];
        $nhanvien = $_REQUEST['nhanvien'];
        $file = $_REQUEST['file'];
        $comment = $_REQUEST['comment'];
        if ($nhanvien>0)
            $data = array('name'=>$name, 'deadline'=>$deadline, 'label'=>$label, 'nhan_vien'=>$nhanvien);
        else
            $data = array('name'=>$name, 'deadline'=>$deadline, 'label'=>$label);
        if ($this->model->capnhat($id, $data, $file, $comment)) {
            $jsonObj['msg'] = "Cập nhật thành công";
            $jsonObj['success'] = true;
        } else {
            $jsonObj['msg'] = "Cập nhật không thành công".$id;
            $jsonObj['success'] = false;
        }
        $jsonObj = json_encode($jsonObj);
        echo $jsonObj;
    }

    function move(){
        $id = $_REQUEST['id'];
        $tinhtrang = $_REQUEST['board'];
        // if ($board>0)
        $data = array('tinh_trang'=>$tinhtrang);
        if ($this->model->move($id, $data)) {
            $jsonObj['msg'] = "Cập nhật thành công";
            $jsonObj['success'] = true;
        } else {
            $jsonObj['msg'] = "Cập nhật không thành công";
            $jsonObj['success'] = false;
        }
        $jsonObj = json_encode($jsonObj);
        echo $jsonObj;
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
}
?>
