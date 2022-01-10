<?php
class todo extends Controller{
    function __construct(){
        parent::__construct();
    }

    function index(){
        require "layouts/header.php";
        $deadline = isset($_REQUEST['deadline'])?$_REQUEST['deadline']:false;
        $status = isset($_REQUEST['status'])?$_REQUEST['status']:'';
        $project = isset($_REQUEST['project'])?$_REQUEST['project']:0;
        $nhanvien = isset($_REQUEST['assignee'])?$_REQUEST['assignee']:$_SESSION['user']['staffId'];
        $this->view->list=$this->model->getList($nhanvien, $project, $status,$deadline);
        $this->view->project=$this->model->getProject();
        $this->view->tag=$this->model->getLabel();
        $this->view->employee=$this->model->getEmployee();
        $this->view->render("todo/index");
        require "layouts/footer.php";
    }

    function update(){
        $id = $_REQUEST['id'];
        $title = $_REQUEST['newTitle'];
        $project = isset($_REQUEST['newProject'])?$_REQUEST['newProject'][0]:0;
        $deadline = $_REQUEST['newDeadline'];
        $label = isset($_REQUEST['newLabel'])?$_REQUEST['newLabel'][0]:0;
        $nhanvien = $_REQUEST['newAssignee'];
        $description = $_REQUEST['newDescription'];
        $data = array('title'=>$title, 'projectId'=>$project, 'deadline'=>$deadline,'description'=>$description, 'label'=>$label, 'assigneeId'=>$nhanvien);
        if ($this->model->capnhat($id, $data)) {
            $jsonObj['msg'] = "Cập nhật thành công";
            $jsonObj['success'] = true;
        } else {
            $jsonObj['msg'] = "Cập nhật không thành công".$nhanvien;
            $jsonObj['success'] = false;
        }
        $jsonObj = json_encode($jsonObj);
        echo $jsonObj;
    }

    function checkOut(){
        $id = $_REQUEST['id'];
        $status = $_REQUEST['status'];
        if ($this->model->checkOut($id, $status)) {
            $jsonObj['msg'] = "Cập nhật thành công";
            $jsonObj['success'] = true;
        } else {
            $jsonObj['msg'] = "Cập nhật không thành công".$id;
            $jsonObj['success'] = false;
        }
        $jsonObj = json_encode($jsonObj);
        echo $jsonObj;
    }


    // function getData(){
    //     $nhanvien = (isset($_REQUEST['nhanvien']) && $_REQUEST['nhanvien']>0)?$_REQUEST['nhanvien']:$_SESSION['user']['staffId'];
    //     $json = $this->model->get_data($nhanvien);
    //     echo json_encode($json);
    // }
    //
    // function getitem(){ // lay thong tin cong viec chi tiet vào form)
    //     $id = $_REQUEST['id'];
    //     $json = $this->model->getitem($_REQUEST['id']);
    //     echo json_encode($json);
    // }
    //
    // function nhanvien(){
    //     $id = (isset($_REQUEST['id']) && $_REQUEST['id']>0)?$_REQUEST['id']:$_SESSION['user']['staffId'];
    //     $json = $this->model->get_nhanvien($id);
    //     echo json_encode($json);
    // }
    //
    //
    // function comment(){
    //     $id = $_REQUEST['id'];
    //     $data = $this->model->comment($id);
    //     echo json_encode($data);
    // }
    //
    // function del(){
    //     $id = $_REQUEST['id'];
    //     if ($this->model->delObj($id)) {
    //         $jsonObj['msg'] = "Đã xóa item";
    //         $jsonObj['success'] = true;
    //     } else {
    //         $jsonObj['msg'] = "Xóa không thành công";
    //         $jsonObj['success'] = false;
    //     }
    //     $jsonObj = json_encode($jsonObj);
    //     echo $jsonObj;
    // }
    //
    // function addcomment(){
    //     $id = $_REQUEST['id'];
    //     $comment = $_REQUEST['comment'];
    //     $return = $this->model->addcomment($id,$comment);
    //     if ($return['query']) {
    //         $jsonObj['msg'] = "Cập nhật thành công";
    //         $jsonObj['success'] = true;
    //         $jsonObj['receiver'] = $return['receiver'];
    //     } else {
    //         $jsonObj['msg'] = "Lỗi khi cập nhật database";
    //         $jsonObj['success'] = false;
    //     }
    //     $jsonObj = json_encode($jsonObj);
    //     echo $jsonObj;
    // }
    //
    // function completed(){
    //     $id = $_REQUEST['id'];
    //     if ($this->model->completed($id)) {
    //         $jsonObj['msg'] = "Chúc mừng bạn đã hoàn thành task này";
    //         $jsonObj['success'] = true;
    //     } else {
    //         $jsonObj['msg'] = "Lỗi khi cập nhật database";
    //         $jsonObj['success'] = false;
    //     }
    //     $jsonObj = json_encode($jsonObj);
    //     echo $jsonObj;
    // }
    //
    // function checkcomm() // dùng cho notification
    // {
    //     $data = $this->model->checkcomm();
    //     echo json_encode($data);
    // }

}
?>
