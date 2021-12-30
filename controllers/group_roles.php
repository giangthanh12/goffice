<?php
class group_roles extends Controller{
    function __construct(){
        parent::__construct();
    }

    function index(){
        require "layouts/header.php";
        $this->view->render("group_roles/index");
        require "layouts/footer.php";
    }

    function list()
    {
        $data = $this->model->listObj();
        echo json_encode($data);
    }

    function getGroupRole()
    {
        $id = isset($_REQUEST['id']) ? $_REQUEST['id'] : 0;
        $json = $this->model->getGroupRole($id);
        echo json_encode($json);
    }

    function addGroupRole()
    {
        $name = (isset($_REQUEST['name']) && $_REQUEST['name'] != '') ? $_REQUEST['name'] : '';
        if($name == ''){
            $jsonObj['msg'] = 'Tên nhóm không được để trống!';
            $jsonObj['success'] = false;
            echo json_encode($jsonObj);
            return false;
        }
        $data = array(
            'name' => $name,
            'status' => 1
        );
        if($this->model->addGroupRole($data)){
            $jsonObj['msg'] = 'Cập nhật dữ liệu thành công';
            $jsonObj['success'] = true;
        } else {
            $jsonObj['msg'] = 'Cập nhật dữ liệu không thành công';
            $jsonObj['success'] = false;
        }
        echo json_encode($jsonObj);
    }

    function updateGroupRole()
    {
        $id = $_REQUEST['id'];
        $name = isset($_REQUEST['name']) ? $_REQUEST['name'] : '';
        $data = array(
            'name' => $name
        );
        if($this->model->updateGroupRole($id, $data)){
            $jsonObj['msg'] = 'Cập nhật dữ liệu thành công';
            $jsonObj['success'] = true;
        } else {
            $jsonObj['msg'] = 'Cập nhật dữ liệu không thành công';
            $jsonObj['success'] = false;
        }
        echo json_encode($jsonObj);
    }

    function deleteGroupRole()
    {
        $id = $_REQUEST['id'];
        $data = ['status'=>0];
        if($this->model->updateGroupRole($id, $data)){
            $jsonObj['msg'] = "Xóa dữ liệu thành công";
            $jsonObj['success'] = true;
        } else {
            $jsonObj['msg'] = "Xóa dữ liệu không thành công";
            $jsonObj['success'] = false;
        } 
        echo json_encode($jsonObj);
    }

}
?>