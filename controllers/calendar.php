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
        $staffId = $_REQUEST['staffId'];
        $month = (isset($_REQUEST['month']) && $_REQUEST['month'] != '') ? $_REQUEST['month'] : date("m");
        $year = (isset($_REQUEST['year']) && $_REQUEST['year'] != '') ? $_REQUEST['year'] : date("Y");
        $data = $this->model->listCalendars($month, $year,$staffId);
        if ($data) {
            $jsonObj['success'] = true;
            $jsonObj['data'] = $data;
        } else {
            $jsonObj['success'] = false;
            $jsonObj['msg'] = "Lỗi truy xuất database";
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
            $jsonObj['msg'] = "Lỗi truy xuất database";
        }
        echo json_encode($jsonObj);
    }

}

?>
