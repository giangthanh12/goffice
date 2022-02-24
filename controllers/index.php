<?php

class index extends Controller
{
    function __construct()
    {
        parent::__construct();
    }

    function index()
    {
        require "layouts/header.php";
        $this->view->render("index/index");
        require "layouts/footer.php";
    }

    function checkIn()
    {
        $jsonObj = [];
        $checkIp = $this->model->checkIp();
        if ($checkIp==0) {
            $jsonObj['message'] = "Sai địa chỉ IP!";
            $jsonObj['code'] = 401;
            $jsonObj['data'] = [];
            echo json_encode($jsonObj);
            return false;
        }
        if ($checkIp==1) {
            $jsonObj['message'] = "Bạn chưa được cài đặt điểm truy cập";
            $jsonObj['code'] = 402;
            $jsonObj['data'] = [];
            echo json_encode($jsonObj);
            return false;
        }
        $checkin = $this->model->checkInWifi();
        if ($checkin==false) {
            $jsonObj['message'] = "Checkin không thành công";
            $jsonObj['code'] = 403;
            $jsonObj['data'] = [];
            echo json_encode($jsonObj);
            return false;

        }
        $jsonObj['message'] = "Chấm công thành công. Chúc bạn có 1 ngày làm việc vui vẻ!";
        $jsonObj['code'] = 200;
        echo json_encode($jsonObj);
    }

    function checkout(){
        $month = (isset($_REQUEST['month']) && ($_REQUEST['month'] != '')) ? $_REQUEST['month'] : date("m");
        $year = (isset($_REQUEST['year']) && ($_REQUEST['year'] != '')) ? $_REQUEST['year'] : date("Y");
        $staffId = isset($_REQUEST['staffId']) ? $_REQUEST['staffId'] : $_SESSION['user']['staffId'];
        $data = $this->model->getTimekeeping($staffId, $month, $year);
        if ($data) {
            $jsonObj['success'] = true;
            $jsonObj['data'] = $data;
            $jsonObj['staffId'] = $staffId;
        } else {
            $jsonObj['success'] = false;
            $jsonObj['data'] = [];
            $jsonObj['msg'] = "Lỗi truy xuất database";
        }
        echo json_encode($jsonObj);
    }

    function checkOutBtn()
    {
        $checkIp = $this->model->checkIp();
        if ($checkIp == 0) {
            $jsonObj['message'] = "Sai địa chỉ IP!";
            $jsonObj['code'] = 401;
            $jsonObj['data'] = [];
            echo json_encode($jsonObj);
            return false;
        }
        if ($checkIp == 1) {
            $jsonObj['message'] = "Bạn chưa được cài đặt điểm truy cập";
            $jsonObj['code'] = 402;
            $jsonObj['data'] = [];
            echo json_encode($jsonObj);
            return false;
        }
        if ($this->model->checkOutBtn()) {
            $jsonObj['message'] = "Đã checkout";
            $jsonObj['code'] = 200;
            $jsonObj['data'] = [];
        } else {
            $jsonObj['message'] = "Checkout không thành công";
            $jsonObj['code'] = 403;
            $jsonObj['data'] = [];
        }
        echo json_encode($jsonObj);
    }

}

?>
