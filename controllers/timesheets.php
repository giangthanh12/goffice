<?php

class timesheets extends Controller
{
    function __construct()
    {
        parent::__construct();
    }

    function index()
    {
        require "layouts/header.php";
        $this->view->render("timesheets/index");
        require "layouts/footer.php";
    }

    function list()
    {
        $month = isset($_REQUEST['month']) ? $_REQUEST['month'] : date('m');
        $year = isset($_REQUEST['year']) ? $_REQUEST['year'] : date('Y');
        $data = $this->model->listObj($month, $year);
        echo json_encode($data);
    }

    function add()
    {
        $month = isset($_REQUEST['month']) ? $_REQUEST['month'] : date('m');
        $year = isset($_REQUEST['year']) ? $_REQUEST['year'] : date('Y');
        if ($this->model->getCong($month, $year)) {
            $jsonObj['message'] = "Tạo bảng chấm công thành công";
            $jsonObj['code'] = 200;
        } else {
            $jsonObj['message'] = "Bảng chấm công đã tồn tại";
            $jsonObj['code'] = 401;
        }
        echo json_encode($jsonObj);
    }
}
