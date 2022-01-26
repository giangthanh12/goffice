<?php

class chamcong extends Controller
{
    function __construct()
    {
        parent::__construct();
    }


    function checkinWifi()
    {
        $jsonObj = [];
        $ipLogin = isset($_REQUEST['ipLogin']) ? $_REQUEST['ipLogin'] : '';
        $staffId = isset($_REQUEST['staffId']) ? $_REQUEST['staffId'] : 0;
        $ipPoint = isset($_REQUEST['idAccessPoint']) ? $_REQUEST['idAccessPoint'] : '';
        if ($staffId == 0) {
            $jsonObj['message'] = "Chưa có thông tin nhân viên checkin";
            $jsonObj['code'] = 401;
            http_response_code(401);
            $jsonObj['data'] = [];
            echo json_encode($jsonObj);
            return false;
        }
        if ($ipLogin == '') {
            $jsonObj['message'] = "Chưa có nhập địa chỉ ip nhân viên";
            $jsonObj['code'] = 403;
            http_response_code(403);
            $jsonObj['data'] = [];
            echo json_encode($jsonObj);
            return false;
        }
        $jsonObj = [];
        if ($ipPoint == '') {
            $jsonObj['message'] = "Bạn chưa được cài đặt điểm truy cập";
            $jsonObj['code'] = 402;
            http_response_code(402);
            $jsonObj['data'] = [];
            echo json_encode($jsonObj);
            return false;
        }
        $checkIp = $this->model->checkIp($ipLogin,$ipPoint);
        if ($checkIp == 0) {
            $jsonObj['message'] = "Sai địa chỉ IP!";
            $jsonObj['code'] = 404;
            http_response_code(404);
            $jsonObj['data'] = [];
            echo json_encode($jsonObj);
            return false;
        }
        $checkin = $this->model->checkInWifi($staffId);
        if ($checkin == 0) {
            $jsonObj['message'] = "Bạn đã checkin trước đó";
            $jsonObj['code'] = 201;
            http_response_code(201);
            $jsonObj['data'] = [];
            echo json_encode($jsonObj);
            return false;
        }
        if ($checkin == 2) {
            $jsonObj['message'] = "Checkin không thành công";
            $jsonObj['code'] = 405;
            http_response_code(405);
            $jsonObj['data'] = [];
            echo json_encode($jsonObj);
            return false;

        }
        $jsonObj['message'] = "Checkin thành công";
        $jsonObj['code'] = 200;
        http_response_code(200);
        $jsonObj['data']['checkInTime'] = $checkin;
        echo json_encode($jsonObj);
    }

    function bangcongnv()
    {
//        $jsonObj['msg'] = "Error";
//        $jsonObj['code'] = 401;
        $thang = (isset($_REQUEST['thang']) && ($_REQUEST['thang'] != '')) ? $_REQUEST['thang'] : date("m");
        $nam = (isset($_REQUEST['nam']) && ($_REQUEST['nam'] != '')) ? $_REQUEST['nam'] : date("Y");
        $nhanvien = isset($_SESSION['user']['nhan_vien']) ? $_SESSION['user']['nhan_vien'] : isset($_REQUEST['nhanvienid']) ? $_REQUEST['nhanvienid'] : 0;
        $data = $this->model->getCong($nhanvien, $thang, $nam);
        if ($data) {
            $jsonObj['success'] = true;
            $jsonObj['data'] = $this->model->getCong($nhanvien, $thang, $nam);
            $jsonObj['nhanvien'] = $nhanvien;
        } else {
            $jsonObj['success'] = false;
            $jsonObj['msg'] = "Lỗi truy xuất database";
        }
        echo json_encode($jsonObj);
    }

    function checkout()
    {
        $jsonObj = [];
        $ipLogin = isset($_REQUEST['ipLogin']) ? $_REQUEST['ipLogin'] : '';
        $staffId = isset($_REQUEST['staffId']) ? $_REQUEST['staffId'] : 0;
        $ipPoint = isset($_REQUEST['idAccessPoint']) ? $_REQUEST['idAccessPoint'] : '';
        if ($staffId == 0) {
            $jsonObj['message'] = "Chưa có thông tin nhân viên checkin";
            $jsonObj['code'] = 401;
            $jsonObj['data'] = [];
            http_response_code(401);
            echo json_encode($jsonObj);
            return false;
        }
        if ($ipLogin == '') {
            $jsonObj['message'] = "Chưa có nhập địa chỉ ip nhân viên";
            $jsonObj['code'] = 403;
            http_response_code(403);
            $jsonObj['data'] = [];
            echo json_encode($jsonObj);
            return false;
        }
        if ($ipPoint == '') {
            $jsonObj['message'] = "Bạn chưa được cài đặt điểm truy cập";
            $jsonObj['code'] = 402;
            http_response_code(402);
            $jsonObj['data'] = [];
            echo json_encode($jsonObj);
            return false;
        }
        $checkIp = $this->model->checkIp($ipLogin,$ipPoint);
        if ($checkIp == 0) {
            $jsonObj['message'] = "Không sử dụng đúng wifi để chấm công!";
            $jsonObj['code'] = 404;
            http_response_code(404);
            $jsonObj['data'] = [];
            echo json_encode($jsonObj);
            return false;
        }
        $checkout = $this->model->checkout($staffId);
        if ($checkout == false) {
            $jsonObj['message'] = "Checkout không thành công";
            $jsonObj['code'] = 405;
            http_response_code(405);
            $jsonObj['data'] = [];
            echo json_encode($jsonObj);
            return false;

        }
        $jsonObj['message'] = "Checkout thành công";
        $jsonObj['code'] = 200;
        http_response_code(200);
        $jsonObj['data']['checkOutTime'] = $checkout;
        echo json_encode($jsonObj);

    }

    function suagio()
    {
        if (isset($_REQUEST['id'])) {
            $id = $_REQUEST['id'];
            $nhanvien = $_REQUEST['nhanvienid'];
            $ngay = $_REQUEST['ngay'];
            $giovao = $_REQUEST['giovao'];
            $giora = $_REQUEST['giora'];
            // $congsang = $_REQUEST['congsang'];
            //   $congchieu = $_REQUEST['congchieu'];
            $ghichu = $_REQUEST['ghichu'];
            $data = [
                'gio_vao' => $giovao,
                'gio_ra' => $giora,
                // 'sang'=>$congsang,
                //   'chieu'=>$congchieu,
                'ghi_chu' => $ghichu,
                'ngay' => $ngay,
                'nhan_vien' => $nhanvien
            ];
            if ($this->model->suagio($id, $data)) {
                $jsonObj['msg'] = "Success";
                $jsonObj['code'] = 200;
            } else {
                $jsonObj['msg'] = "Error";
                $jsonObj['code'] = 401;
            }
        } else {
            $jsonObj['msg'] = "Khai báo thiếu parameter";
            $jsonObj['code'] = 400;
        }
        echo json_encode($jsonObj);
    }

    function checkdate()
    {
        $nhanvien = isset($_SESSION['user']['nhan_vien']) ? $_SESSION['user']['nhan_vien'] : isset($_REQUEST['nhanvienid']) ? $_REQUEST['nhanvienid'] : 0;
        $date = isset($_REQUEST['ngay']) ? $_REQUEST['ngay'] : '';
        if ($this->model->checkdate($date, $nhanvien) == 0) {
            $jsonObj['msg'] = "Success";
            $jsonObj['code'] = 200;
        } else {
            $jsonObj['msg'] = "Failed";
            $jsonObj['code'] = 401;
        }
        echo json_encode($jsonObj);
    }

}

?>
