<?php

class contracttype extends Controller
{
    function __construct()
    {
        parent::__construct();
    }

    function index()
    {
        require "layouts/header.php";
        $this->view->render("contracttype/index");
        require "layouts/footer.php";
    }


    function list()
    {
        $data = $this->model->listObj();
        echo json_encode($data);
    }

    function loaddata()
    {
        $id = isset($_REQUEST['id']) ? $_REQUEST['id'] : 0;
        $json = $this->model->getdata($id);
        echo json_encode($json);
    }

    function add()
    {
        $name = isset($_POST['name']) ? $_POST['name'] : '';
        $note = isset($_POST['note']) ? $_POST['note'] : '';
        $data = array(
            'name' => $name,
            'note' => $note,
            'status' => 1
        );
        if ($this->model->addObj($data)) {
            $jsonObj['message'] = 'Cập nhật dữ liệu thành công';
            $jsonObj['code'] = 200;
        } else {
            $jsonObj['message'] = 'Cập nhật dữ liệu không thành công';
            $jsonObj['code'] = 401;
        }
        echo json_encode($jsonObj);
    }

    function update()
    {
        $id = $_REQUEST['id'];
        $name = isset($_POST['name']) ? $_POST['name'] : '';
        $note = isset($_POST['note']) ? $_POST['note'] : '';
        $data = array(
            'name' => $name,
            'note' => $note
        );
        if ($this->model->updateObj($id, $data)) {
            $jsonObj['message'] = 'Cập nhật dữ liệu thành công';
            $jsonObj['code'] = 200;
        } else {
            $jsonObj['message'] = 'Cập nhật dữ liệu không thành công';
            $jsonObj['code'] = 401;
        }

        echo json_encode($jsonObj);
    }

    function del()
    {
        $id = $_REQUEST['id'];
        $data = ['status' => 0];
        if ($this->model->delObj($id, $data)) {
            $jsonObj['message'] = 'Xóa dữ liệu thành công!';
            $jsonObj['code'] = 200;
        } else {
            $jsonObj['message'] = 'Xóa dữ liệu không thành công!';
            $jsonObj['code'] = 401;
        }
        echo json_encode($jsonObj);
    }


}

?>