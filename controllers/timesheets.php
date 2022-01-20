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

    function update()
    {
        $startDate = isset($_REQUEST['startDate']) ? $_REQUEST['startDate'] : '';
        $endDate = isset($_REQUEST['endDate']) ? $_REQUEST['endDate'] : '';
        $staffId = isset($_REQUEST['staffId']) ? $_REQUEST['staffId'] : '';
        $work = isset($_REQUEST['work']) ? $_REQUEST['work'] : 0;
        $temp = explode("/", $startDate);
        $start = str_replace("0", $temp[0]);
        $temp = explode("/", $endDate);
        $end = $temp[0];
        $data = [];
        for ($start; $start <= $end; $start++) {
            if ($start < 10)
                $i = "0" . $start;
            else
                $i = $start;
            $data['date_' . $i] = $work;
        }
//        if ($this->model->updateWork($data)) {
//            $jsonObj['message'] = "Tạo bảng chấm công thành công";
//            $jsonObj['code'] = 200;
//        } else {
//            $jsonObj['message'] = "Bảng chấm công đã tồn tại";
//            $jsonObj['code'] = 401;
//        }
        echo json_encode($data);
    }
}
