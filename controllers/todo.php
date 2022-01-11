<?php

class todo extends Controller
{
    static private $funAdd = 0, $funEdit = 0, $funDel = 0;

    function __construct()
    {
        parent::__construct();
        $model = new model();
        $checkMenuRole = $model->checkMenuRole('todo');
        if ($checkMenuRole == false)
            header('location:' . HOME);
        $funcs = $model->getFunctions('todo');
        foreach ($funcs as $item) {
            if ($item['function'] == 'add')
                self::$funAdd = 1;
            if ($item['function'] == 'edit')
                self::$funEdit = 1;
            if ($item['function'] == 'del')
                self::$funDel = 1;
        }
    }

    function index()
    {
        require "layouts/header.php";
        $deadline = isset($_REQUEST['deadline']) ? $_REQUEST['deadline'] : false;
        $status = isset($_REQUEST['status']) ? $_REQUEST['status'] : '';
        $project = isset($_REQUEST['project']) ? $_REQUEST['project'] : 0;
        $staffId = isset($_REQUEST['assignee']) ? $_REQUEST['assignee'] : $_SESSION['user']['staffId'];
        $this->view->list = $this->model->getList($staffId, $project, $status, $deadline,1);
        $this->view->project = $this->model->getProject($staffId);
        $this->view->tag = $this->model->getLabel();
        $this->view->employee = $this->model->getEmployee();
        $this->view->funAdd = self::$funAdd;
        $this->view->funEdit = self::$funEdit;
        $this->view->funDel = self::$funDel;
        $this->view->render("todo/index");
        require "layouts/footer.php";
    }

    function add()
    {
        if (self::$funAdd == 1) {
            $title = $_REQUEST['newTitle'];
            $project = isset($_REQUEST['newProject'][0]) ? $_REQUEST['newProject'][0] : 0;
            $deadline = $_REQUEST['newDeadline'];
            $label = isset($_REQUEST['newLabel'][0]) ? $_REQUEST['newLabel'][0] : 0;
            $nhanvien = $_REQUEST['newAssignee'];
            $description = $_REQUEST['newDescription'];
            $data = array('title' => $title, 'projectId' => $project, 'deadline' => $deadline, 'description' => $description, 'label' => $label, 'assigneeId' => $nhanvien);
            if ($this->model->addObj($data)) {
                $jsonObj['message'] = "Cập nhật thành công";
                $jsonObj['code'] = 200;
            } else {
                $jsonObj['message'] = "Cập nhật không thành công" . $nhanvien;
                $jsonObj['code'] = 401;
            }
        } else {
            $jsonObj['message'] = "Bạn không có quyền sử dụng chức năng này";
            $jsonObj['code'] = 400;
        }
        $jsonObj = json_encode($jsonObj);
        echo $jsonObj;
    }

    function update()
    {
        if (self::$funEdit == 1) {
            $id = $_REQUEST['id'];
            $title = $_REQUEST['newTitle'];
            $project = isset($_REQUEST['newProject'][0]) ? $_REQUEST['newProject'][0] : 0;
            $deadline = $_REQUEST['newDeadline'];
            $label = isset($_REQUEST['newLabel'][0]) ? $_REQUEST['newLabel'][0] : 0;
            $nhanvien = $_REQUEST['newAssignee'];
            $description = $_REQUEST['newDescription'];
            $data = array('title' => $title, 'projectId' => $project, 'deadline' => $deadline, 'description' => $description, 'label' => $label, 'assigneeId' => $nhanvien);
            if ($this->model->updateObj($id, $data)) {
                $jsonObj['message'] = "Cập nhật thành công";
                $jsonObj['code'] = 200;
            } else {
                $jsonObj['message'] = "Cập nhật không thành công" . $nhanvien;
                $jsonObj['code'] = 401;
            }
        } else {
            $jsonObj['message'] = "Bạn không có quyền sử dụng chức năng này";
            $jsonObj['code'] = 400;
        }
        $jsonObj = json_encode($jsonObj);
        echo $jsonObj;
    }

    function checkOut()
    {
        $id = $_REQUEST['id'];
        $status = $_REQUEST['status'];
        if ($this->model->checkOut($id, $status)) {
            $jsonObj['message'] = "Cập nhật thành công";
            $jsonObj['code'] = 200;
        } else {
            $jsonObj['message'] = "Cập nhật không thành công";
            $jsonObj['code'] = 401;
        }
        $jsonObj = json_encode($jsonObj);
        echo $jsonObj;
    }

    function del()
    {
        if (self::$funDel == 1) {
            $id = $_REQUEST['id'];
            $status = 0;
            if ($this->model->checkOut($id, $status)) {
                $jsonObj['message'] = "Cập nhật thành công";
                $jsonObj['code'] = 200;
            } else {
                $jsonObj['message'] = "Cập nhật không thành công";
                $jsonObj['code'] = 401;
            }
        } else {
            $jsonObj['message'] = "Bạn không có quyền sử dụng chức năng này";
            $jsonObj['code'] = 400;
        }
        $jsonObj = json_encode($jsonObj);

        echo $jsonObj;
    }

    function getProject(){
        $staffId = isset($_REQUEST['staffId']) ? $_REQUEST['staffId'] : $_SESSION['user']['staffId'];
        $project = $this->model->getProject($staffId);
        $jsonObj['message'] = "Success";
        $jsonObj['code'] = 200;
        $jsonObj['data'] = $project;
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
