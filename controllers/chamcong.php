<?php

class chamcong extends Controller
{
    function __construct()
    {
        parent::__construct();
    }

    function index()
    {
        require "layouts/header.php";
        $this->view->render("chamcong/index");
        require "layouts/footer.php";
    }


    function chamcong()
    {
        $jsonObj = [];
        $iplogin = $_SERVER["REMOTE_ADDR"];
        $ipvanphong = isset($_SESSION['user']['ipBranch']) ? $_SESSION['user']['ipBranch'] : '';
        $nhanvien = isset($_SESSION['user']['staffId']) ? $_SESSION['user']['staffId'] : 0;
        if ($nhanvien > 0 && $ipvanphong != '') {
            if ($iplogin == $ipvanphong) {
                if ($this->model->chamcong($nhanvien)) {
                    $jsonObj['message'] = "Success";
                    $jsonObj['code'] = 200;
                } else {
                    $jsonObj['message'] = "Error";
                    $jsonObj['code'] = 401;
                }
            } else {
                $jsonObj['message'] = "Error";
                $jsonObj['code'] = 401;
            }
        } else {
            $jsonObj['message'] = "Error";
            $jsonObj['code'] = 401;
        }
        echo json_encode($jsonObj);
    }

    function bangcongnv()
    {
//        $jsonObj['msg'] = "Error";
//        $jsonObj['code'] = 401;
        $thang = (isset($_REQUEST['thang']) && ($_REQUEST['thang'] != '')) ? $_REQUEST['thang'] : date("m");
        $nam = (isset($_REQUEST['nam']) && ($_REQUEST['nam'] != '')) ? $_REQUEST['nam'] : date("Y");
        $nhanvien = isset($_REQUEST['nhanvienid']) ? $_REQUEST['nhanvienid'] : $_REQUEST['user']['staffId'];
        $data = $this->model->getCong($nhanvien, $thang, $nam);
        if ($data) {
            $jsonObj['success'] = true;
            $jsonObj['data'] = $data;
            $jsonObj['nhanvien'] = $nhanvien;
        } else {
            $jsonObj['success'] = false;
            $jsonObj['msg'] = "Lỗi truy xuất database";
        }
        echo json_encode($jsonObj);
    }

    function checkout()
    {
        $nhanvien = isset($_SESSION['user']['staffId']) ? $_SESSION['user']['staffId'] : 0;
        $ipvanphong = isset($_SESSION['user']['ipBranch']) ? $_SESSION['user']['ipBranch'] : '';
        if ($this->model->checkout($nhanvien, $ipvanphong)) {
            $jsonObj['message'] = "Đã checkout";
            $jsonObj['code'] = 200;
            $jsonObj['data'] = [];
        } else {
            $jsonObj['message'] = "Checkout không thành công";
            $jsonObj['code'] = 401;
            $jsonObj['data'] = [];
        }
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
        $nhanvien = isset($_SESSION['user']['nhan_vien']) ? $_SESSION['user']['nhan_vien'] : 0;
        $date = isset($_REQUEST['ngay']) ? $_REQUEST['ngay'] : '';
        if ($this->model->checkdate($date, $nhanvien) == 0) {
            $jsonObj['mess'] = "Success";
            $jsonObj['code'] = 200;
        } else {
            $jsonObj['msg'] = "Failed";
            $jsonObj['code'] = 401;
        }
        echo json_encode($jsonObj);
    }

    function chamcongtay()
    {
        $id = $_REQUEST['id'];
        $nhanvienid = $_REQUEST['nhanvienid'];
        $ngay = $_REQUEST['ngay'];
        $giovao = $_REQUEST['giovao'];
        $giora = $_REQUEST['giora'];
        $sang = $_REQUEST['congsang'];
        $chieu = $_REQUEST['congchieu'];
        $ghichu = $_REQUEST['ghichu'];
        $data = array(
            'date' => $ngay,
            'staffId'=>$nhanvienid,
            'note' => $ghichu,
            'status' => 0
        );
        if ($giovao > 0)
            $data['checkInTime'] = $giovao;
        if ($giora > 0)
            $data['checkOutTime'] = $giora;
        if ($sang != '')
            $data['morning'] = $sang;
        if ($chieu != '')
            $data['afternoon'] = $chieu;
        if ($this->model->chamcongtay($id,$data)) {
            $jsonObj['message'] = "Cập nhật dữ liệu thành công";
            $jsonObj['code'] = 200;
        } else {
            $jsonObj['message'] = "Cập nhật dữ liệu không thành công";
            $jsonObj['code'] = 401;
        }
        echo json_encode($jsonObj);
    }

}

?>
