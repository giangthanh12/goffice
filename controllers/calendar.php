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


}

?>
