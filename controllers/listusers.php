<?php

class listusers extends Controller
{
    function __construct()
    {
        parent::__construct();
    }

    function index(){
        require "layouts/header.php";
        $this->view->render("listusers/index");
        require "layouts/footer.php";
    }

    function getAllData()
    {
        $data = $this->model->getAllData();
        echo json_encode($data);
    }

    function loadDataById()
    {
        $id=isset($_REQUEST['id'])?$_REQUEST['id']:0;
        $json = $this->model->getDataById($id);
        echo json_encode($json);
    }

    function updateInfo()
    {
        $data = $_REQUEST['data'];
        $id = $_REQUEST['id'];
        if ($this->model->updateinfo($data,$id)) {
            $jsonObj['msg'] = "Cập nhật dữ liệu thành công";
            $jsonObj['success'] = true;
        } else {
            $jsonObj['msg'] = "Lỗi khi cập nhật database";
            $jsonObj['success'] = false;
        }
        echo json_encode($jsonObj);
    }

    function add()
    {
        $data = $_REQUEST['data'];
        if ($this->model->them($data)) {
            $jsonObj['msg'] = "Cập nhật dữ liệu thành công";
            $jsonObj['success'] = true;
        } else {
            $jsonObj['msg'] = "Lỗi khi cập nhật database";
            $jsonObj['success'] = false;
        }
        echo json_encode($jsonObj);
    }

    function del()
    {
        $id = $_REQUEST['id'];
        if ($this->model->xoa($id)) {
            $jsonObj['msg'] = "Cập nhật dữ liệu thành công";
            $jsonObj['success'] = true;
        } else {
            $jsonObj['msg'] = "Lỗi khi xóa dữ liệu".$id;
            $jsonObj['success'] = false;
        }
        echo json_encode($jsonObj);
    }

    function update(){
        $post = $_REQUEST['data'];
        $id = $post['id_user'];
        $data['username'] = $post['username'];
        $data['usernameMd5'] = md5($post['username']);

        if($post['password'] != "" ){
            $data['password'] = md5(md5($post['password']));
        }

        $data['sipPass'] = $post['sip_pass'];
        $data['status'] = $post['tinh_trang'];
        $data['extNum'] = $post['ext_num'];

        if ($this->model->updateObj($data,$id)) {
            $jsonObj['msg'] = "Cập nhật dữ liệu thành công";
            $jsonObj['success'] = true;
        } else {
            $jsonObj['msg'] = "Lỗi khi cập nhật database";
            $jsonObj['success'] = false;
        }
        echo json_encode($jsonObj);
    }

}

?>
