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
        $this->view->employee = $this->model->getEmployee();
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
        if ($staffId == '') {
            return false;
        }
        $work = isset($_REQUEST['work']) ? $_REQUEST['work'] : 0;
        $temp = explode("/", $startDate);
        $monthStart = $temp[1];
        $yearStart = $temp[2];
        $dateStart = ltrim($temp[0], "0");
        $temp = explode("/", $endDate);
        $monthEnd = $temp[1];
        $yearEnd = $temp[2];
        if ($monthStart != $monthEnd || $yearStart != $yearEnd) {
            $jsonObj['message'] = "Ngày chấm công chọn không cùng tháng cùng năm!";
            $jsonObj['code'] = 402;
            echo json_encode($jsonObj);
            return false;
        }
        $dateEnd = ltrim($temp[0], "0");
        $data = [];
        for ($dateStart; $dateStart <= $dateEnd; $dateStart++) {
            if ($dateStart < 10)
                $i = "0" . $dateStart;
            else
                $i = $dateStart;
            $data['date_' . $i] = $work;
        }
        if ($this->model->updateWork($staffId, $data, $monthStart, $yearStart)) {
            $jsonObj['message'] = "Tạo bảng chấm công thành công";
            $jsonObj['code'] = 200;
        } else {
            $jsonObj['message'] = "Bảng chấm công đã tồn tại";
            $jsonObj['code'] = 401;
        }
        echo json_encode($jsonObj);
    }
}
