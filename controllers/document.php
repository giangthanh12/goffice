<?php

class document extends Controller
{
    static private $funcs;
    function __construct()
    {
        parent::__construct();
        $model = new model();
        $checkMenuRole = $model->checkMenuRole('document');
        if ($checkMenuRole == false)
        header('location:' . HOME);
        self::$funcs = $model->getFunctions('document');
    }

    function index()
    {
        $this->view->funs  = self::$funcs;
        require "layouts/header.php";
        $this->view->render("document/index");
        require "layouts/footer.php";
    }

    function list()
    {
        $data = $this->model->listObj();
        echo json_encode($data);
    }

    // function listDel()
    // {
    //     $data = $this->model->listDel();
    //     echo json_encode($data);
    // }

    // function combo()
    // {
    //     $json = $this->model->get_data_combo();
    //     echo json_encode($json);
    // }

    function loaddata()
    {
        $id = isset($_REQUEST['id']) ? $_REQUEST['id'] : 0;
        $json = $this->model->getdata($id);
        echo json_encode($json);
    }

    function add()
    {
    // if(functions::checkFuns(self::$funcs,'add')) {
        $name = isset($_REQUEST['name']) ? $_REQUEST['name'] : '';
        $dateTime = isset($_REQUEST['dateTime']) && $_REQUEST['dateTime'] != '' ? functions::convertDate($_REQUEST['dateTime']) : '';
        $staffId = isset($_REQUEST['staffId']) ? $_REQUEST['staffId'] : 0;
        $linkToFile = isset($_REQUEST['linkToFile']) ? $_REQUEST['linkToFile'] : '';
        $description = isset($_REQUEST['description']) ? $_REQUEST['description'] : '';
        $data = array(
            'name' => $name,
            'linkToFile' => $linkToFile,
            'dateTime' => $dateTime,
            'staffId' => $staffId,
            'description' => $description,
            'status' => 1
        );
       
        if ($this->model->addObj($data)) {
            $jsonObj['msg'] = 'Cập nhật dữ liệu thành công';
            $jsonObj['success'] = true;
        } else {
            $jsonObj['msg'] = 'Không có quyền truy cập';
            $jsonObj['success'] = false;
        }
    // } else {
    //     $jsonObj['msg'] = 'Không có quyền truy cập';
    //     $jsonObj['success'] = false;
    // } 
        echo json_encode($jsonObj);
    }

    function update()
    {
    // if(functions::checkFuns(self::$funcs,'loaddata')) {
        $id = $_REQUEST['id'];
        $name = isset($_REQUEST['name']) ? $_REQUEST['name'] : '';
        $dateTime = isset($_REQUEST['dateTime']) && $_REQUEST['dateTime'] != '' ? functions::convertDate($_REQUEST['dateTime']) : '';
        $staffId = isset($_REQUEST['staffId']) ? $_REQUEST['staffId'] : 0;
        $linkToFile = isset($_REQUEST['linkToFile']) ? $_REQUEST['linkToFile'] : '';
        $description = isset($_REQUEST['description']) ? $_REQUEST['description'] : '';
        $data = array(
            'name' => $name,
            'linkToFile' => $linkToFile,
            'dateTime' => $dateTime,
            'staffId' => $staffId,
            'description' => $description
        );
        if ($this->model->updateObj($id, $data)) {
            $jsonObj['msg'] = 'Cập nhật dữ liệu thành công' . $dateTime;
            $jsonObj['success'] = true;
        } else {
            $jsonObj['msg'] = 'Không có quyền truy cập';
            $jsonObj['success'] = false;
        }
    // }else {
    //     $jsonObj['msg'] = 'Không có quyền truy cập';
    //     $jsonObj['success'] = false;
    // }
        echo json_encode($jsonObj);
    }

    function del()
    {
        // if(functions::checkFuns(self::$funcs,'del')) {
        $id = $_REQUEST['id'];
        $data = ['status' => 0];
        if ($this->model->delObj($id, $data)) {
            $jsonObj['msg'] = "Xóa dữ liệu thành công";
            $jsonObj['success'] = true;
        } else {
            $jsonObj['msg'] = "Xóa dữ liệu không thành công";
            $jsonObj['success'] = false;
        }
    // }else {
    //     $jsonObj['msg'] = "Không có quyền truy cập";
    //     $jsonObj['success'] = false;
    // }
        echo json_encode($jsonObj);
    }
}

?>