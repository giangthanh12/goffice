<?php

class timekeeping extends Controller
{
    static private $funAdd = 0, $funEdit = 0;
    function __construct()
    {
        parent::__construct();
        $model = new model();
        $checkMenuRole = $model->checkMenuRole('timekeeping');
        if ($checkMenuRole == false)
            header('location:' . HOME);
        $funcs = $model->getFunctions('timekeeping');
     
      
        foreach ($funcs as $item) {
            if ($item['function'] == 'add')
                self::$funAdd = 1;
            if ($item['function'] == 'edit')
                self::$funEdit = 1;
      
        }
    }

    function index()
    {
        $page = 'timekeeping';
        
        require "layouts/header.php";
       
        $this->view->funAdd = self::$funAdd;
        $this->view->funEdit = self::$funEdit;
        $this->view->render("timekeeping/index");
        require "layouts/footer.php";
    }



    function getTimeKeeping()
    {
//        $jsonObj['msg'] = "Error";
//        $jsonObj['code'] = 401;
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

    function checkout()
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
        if ($this->model->checkout()) {
            $jsonObj['message'] = "Đã checkout";
            $jsonObj['code'] = 200;
            $jsonObj['data'] = $this->model->checkout();
        } else {
            $jsonObj['message'] = "Checkout không thành công";
            $jsonObj['code'] = 403;
            $jsonObj['data'] = [];
        }
        echo json_encode($jsonObj);
    }

    function checkdate()
    {
        $staffId = $_REQUEST['staffId'];
        $date = isset($_REQUEST['date']) ? $_REQUEST['date'] : '';
        if ($this->model->checkdate($date, $staffId) == 0) {
            $jsonObj['mess'] = "Success";
            $jsonObj['code'] = 200;
        } else {
            $jsonObj['msg'] = "Failed";
            $jsonObj['code'] = 401;
        }
        echo json_encode($jsonObj);
    }

    function manualTimekeeping()
    {
        
        $id = $_REQUEST['id'];
        if(self::$funAdd == 1 && empty($id)) {
            $staffId = $_REQUEST['staffId'];
            $date = $_REQUEST['date'];
            $checkInTime = $_REQUEST['checkInTime'];
            $checkOutTime = $_REQUEST['checkOutTime'];
            if ($checkInTime == '00:00:00' || $checkInTime == '') {
                $jsonObj['message'] = "Bạn chưa nhập giờ vào!";
                $jsonObj['code'] = 402;
                echo json_encode($jsonObj);
                return false;
            }
            $data = array(
                'date' => $date,
                'staffId' => $staffId,
                'status' => 1
            );
            if ($checkInTime > 0)
                $data['checkInTime'] = $checkInTime;
            if ($checkOutTime > 0)
                $data['checkOutTime'] = $checkOutTime;
            if ($this->model->manualTimekeeping($id, $data)) {
                $jsonObj['message'] = "Cập nhật dữ liệu thành công";
                $jsonObj['code'] = 200;
            } else {
                $jsonObj['message'] = "Cập nhật dữ liệu không thành công";
                $jsonObj['code'] = 401;
            }
        }
        else if(self::$funEdit == 1 && !empty($id) && $id > 0 ) {
            $staffId = $_REQUEST['staffId'];
            $date = $_REQUEST['date'];
            $checkInTime = $_REQUEST['checkInTime'];
            $checkOutTime = $_REQUEST['checkOutTime'];
            if ($checkInTime == '00:00:00' || $checkInTime == '') {
                $jsonObj['message'] = "Bạn chưa nhập giờ vào!";
                $jsonObj['code'] = 402;
                echo json_encode($jsonObj);
                return false;
            }
            $data = array(
                'date' => $date,
                'staffId' => $staffId,
                'status' => 1
            );
            if ($checkInTime > 0)
                $data['checkInTime'] = $checkInTime;
            if ($checkOutTime > 0)
                $data['checkOutTime'] = $checkOutTime;
            if ($this->model->manualTimekeeping($id, $data)) {
                $jsonObj['message'] = "Cập nhật dữ liệu thành công";
                $jsonObj['code'] = 200;
            } else {
                $jsonObj['message'] = "Cập nhật dữ liệu không thành công";
                $jsonObj['code'] = 401;
            }
        }
        else  {
            $jsonObj['message'] = 'Bạn không có quyền sử dụng chức năng này';
            $jsonObj['code'] = 401;
        }
        echo json_encode($jsonObj);
    }

}

?>
