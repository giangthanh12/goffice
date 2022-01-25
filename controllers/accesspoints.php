<?php

class accesspoints extends Controller
{
    static private $funAdd = 0, $funEdit = 0, $funDel = 0;
    function __construct()
    {
        parent::__construct();
        $model = new model();
        $checkMenuRole = $model->checkMenuRole('accesspoints');
        if ($checkMenuRole == false)
            header('location:' . HOME);
        $funcs = $model->getFunctions('accesspoints');
      
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
        $this->view->funAdd = self::$funAdd;
        $this->view->funEdit = self::$funEdit;
        $this->view->funDel = self::$funDel;
        $this->view->render("accesspoints/index");
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
        if (self::$funAdd == 0) {
            $jsonObj['msg'] = 'Bạn không có quyền sử dụng chức năng này';
            $jsonObj['success'] = false;
            echo json_encode($jsonObj);
            return false;
        }
        $name = isset($_POST['name']) ? $_POST['name'] : '';
        $address = isset($_POST['address']) ? $_POST['address'] : '';
        $ip = isset($_POST['ip']) ? $_POST['ip'] : '';
        $checkIp = $this->model->checkIp($ip, 0);
        if ($checkIp > 0) {
            $jsonObj['message'] = 'Địa chỉ IP đã có trong hệ thống';
            $jsonObj['code'] = 402;
            echo json_encode($jsonObj);
            return false;
        }
        $data = array(
            'name' => $name,
            'address' => $address,
            'ip' => $ip,
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
        if (self::$funEdit == 0) {
            $jsonObj['msg'] = 'Bạn không có quyền sử dụng chức năng này';
            $jsonObj['success'] = false;
            echo json_encode($jsonObj);
            return false;
        }
        $id = $_REQUEST['id'];
        $name = isset($_POST['name']) ? $_POST['name'] : '';
        $address = isset($_POST['address']) ? $_POST['address'] : '';
        $ip = isset($_POST['ip']) ? $_POST['ip'] : '';
        $checkIp = $this->model->checkIp($ip, $id);
        if ($checkIp > 0) {
            $jsonObj['message'] = 'Địa chỉ IP đã có trong hệ thống';
            $jsonObj['code'] = 402;
            echo json_encode($jsonObj);
            return false;
        }
        $data = array(
            'name' => $name,
            'address' => $address,
            'ip' => $ip
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
        if (self::$funDel == 0) {
            $jsonObj['msg'] = 'Bạn không có quyền sử dụng chức năng này';
            $jsonObj['success'] = false;
            echo json_encode($jsonObj);
            return false;
        }
        $id = $_REQUEST['id'];
        $data = ['status' => 0];
        if ($this->model->delObj($id, $data)) {
            $jsonObj['message'] = 'Xóa dữ liệu thành công!';
            $jsonObj['success'] = true;
        } else {
            $jsonObj['message'] = 'Xóa dữ liệu không thành công!';
            $jsonObj['success'] = false;
        }
        echo json_encode($jsonObj);
    }


}

?>