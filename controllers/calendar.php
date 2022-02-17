<?php

class calendar extends Controller
{
    function __construct()
    {
        parent::__construct();
    }

    function index()
    {
        require "layouts/header.php";
        $this->view->render("calendar/index");
        require "layouts/footer.php";
    }

    function listCalendars()
    {
        $staffId = isset($_REQUEST['staffId']) ? $_REQUEST['staffId'] : $_SESSION['user']['staffId'];
        $month = (isset($_REQUEST['month']) && $_REQUEST['month'] != '') ? $_REQUEST['month'] : date("m");
        $year = (isset($_REQUEST['year']) && $_REQUEST['year'] != '') ? $_REQUEST['year'] : date("Y");
        $data = $this->model->listCalendars($month, $year,$staffId);
        if ($data) {
            $jsonObj['success'] = true;
            $jsonObj['data'] = $data;
        } else {
            $jsonObj['success'] = false;
            $jsonObj['msg'] = "Cập nhật dữ liệu không thành công";
        }
        echo json_encode($jsonObj);
    }

    function updateCalendar()
    {
        $calendarId = $_REQUEST['id'];
        $title = $_REQUEST['title'];
        $description = $_REQUEST['description'];
        $objectType = $_REQUEST['objectType'];
        $objectTable = '';
        if($objectType==1) {
            $objectTable = '';
        } else if ($objectType==2) {
            $objectTable = 'interview';
        } else if ($objectType==3) {
            $objectTable = 'tasks';
        } else if ($objectType==4) {
            $objectTable = '';
        } else if ($objectType==5) {
            $objectTable = '';
        }
        $objectId = $_REQUEST['objectId'];
        $data = [
            'title' => $title,
            'description' => $description,
        ];
        if ($this->model->updateCalendar($calendarId,$objectTable,$objectId,$data)) {
            $jsonObj['success'] = true;
            $jsonObj['msg'] = "Cập nhật dữ liệu thành công";
        } else {
            $jsonObj['success'] = false;
            $jsonObj['msg'] = "Cập nhật dữ liệu không thành công";
        }
        echo json_encode($jsonObj);
    }

    function addCalendar()
    {
        $title = $_REQUEST['title'];
        $startDate = $_REQUEST['startDate'];
        $endDate = $_REQUEST['endDate'];
        $description = $_REQUEST['description'];
        $objectType = $_REQUEST['objectType'];
        $objectId = $_REQUEST['objectId'];
        $data = [
            'title' => $title,
            'staffId' => $_SESSION['user']['staffId'],
            'startDate' => $startDate,
            'endDate' => $endDate,
            'description' => $description,
            'objectType' => $objectType,
            'objectId' => $objectId,
            'status' => 1
        ];
        if ($this->model->addObj($data)) {
            $jsonObj['success'] = true;
            $jsonObj['msg'] = "Cập nhật dữ liệu thành công";
        } else {
            $jsonObj['success'] = false;
            $jsonObj['msg'] = "Cập nhật dữ liệu không thành công";
        }
        echo json_encode($jsonObj);
    }

    function delCalendar()
    {
        $calendarId = $_REQUEST['id'];
        if ($this->model->updateObj($calendarId,['status'=>0])) {
            $jsonObj['success'] = true;
            $jsonObj['msg'] = "Cập nhật dữ liệu thành công";
        } else {
            $jsonObj['success'] = false;
            $jsonObj['msg'] = "Cập nhật dữ liệu không thành công";
        }
        echo json_encode($jsonObj);
    }

}

?>
