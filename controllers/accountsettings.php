<?php

use function GuzzleHttp\Psr7\parse_request;

class accountsettings extends Controller
{
    function __construct()
    {
        parent::__construct();
    }

    function index(){
        require "layouts/header.php";
        $this->view->render("accountsettings/index");
        require "layouts/footer.php";
    }

    function loaddata()
    {
        $id = isset($_SESSION['user']['staffId']) ? $_SESSION['user']['staffId'] : 0;
        $jsonObj = $this->model->getData($id);
        echo json_encode($jsonObj);
    }

    function thayanh()
    {
        $id =  $_SESSION['user']['staffId'];
        $filename = $_FILES['hinhanh']['name'];
        $fname = explode('.', $filename);
        $hinhanh = '';
        if ($filename != '') {
            if (file_exists(ROOT_DIR . '/uploads/nhanvien/' . $filename)) {
                $hinhanh =  $filename;
            } else {
                $dir = ROOT_DIR . '/uploads/nhanvien/';
                $file = functions::uploadfile('hinhanh', $dir, $fname[0]);
                if ($file != '')
                    $hinhanh =   $file;
            }
        }
        if ($this->model->thayanh($hinhanh, $id)) {
            $_SESSION['user']['avatar'] = $hinhanh;
            $jsonObj['filename'] = $hinhanh;
            $jsonObj['msg'] = "Cập nhật dữ liệu thành công";
            $jsonObj['success'] = true;
        } else {
            $jsonObj['msg'] = "Lỗi khi cập nhật database";
            $jsonObj['success'] = false;
        }
        echo json_encode($jsonObj);
    }

    // function xoaanh()
    // {
    //     $id = isset($_SESSION['user']['staffId']) ? $_SESSION['user']['staffId'] : 0;
    //     $data = [
    //         'avatar' => ''
    //     ];
    //     if ($this->model->updateObj($id, $data)) {
    //         $_SESSION['user']['avatar'] = URLFILE.'/uploads/avatar-s-11.jpg';
    //         $jsonObj['msg'] = "Cập nhật dữ liệu thành công";
    //         $jsonObj['success'] = true;
    //     } else {
    //         $jsonObj['msg'] = "Lỗi khi cập nhật database";
    //         $jsonObj['success'] = false;
    //     }
    //     echo json_encode($jsonObj);
    // }

    function update()
    {
        $id = isset($_SESSION['user']['staffId']) ? $_SESSION['user']['staffId'] : 0;
        $name = isset($_REQUEST['name']) ? $_REQUEST['name'] : '';
        $email = isset($_REQUEST['email']) ? $_REQUEST['email'] : '';
        $dienthoai = isset($_REQUEST['dien_thoai']) ? $_REQUEST['dien_thoai'] : '';
      
        $data = [
            'name' => $name,
            'email' => $email,
            'phoneNumber' => $dienthoai,
        ];
        if ($this->model->updateObj($id, $data)) {
            $_SESSION['user']['hoten'] = $name;
            $jsonObj['msg'] = "Cập nhật dữ liệu thành công";
            $jsonObj['success'] = true;
        } else {
            $jsonObj['msg'] = "Lỗi khi cập nhật database";
            $jsonObj['success'] = false;
        }
        echo json_encode($jsonObj);
    }    

    function updateInfo()
    {
        $id = isset($_SESSION['user']['staffId']) ? $_SESSION['user']['staffId'] : 0;
        $name = isset($_REQUEST['name']) ? $_REQUEST['name'] : '';
        $ngaysinh = isset($_REQUEST['ngay_sinh']) ? date("Y-m-d", strtotime(str_replace('/', '-', $_REQUEST['ngay_sinh']))) : date("Y-m-d");
        $cmnd = isset($_REQUEST['cmnd']) ? $_REQUEST['cmnd'] : '';
        $ngaycap = isset($_REQUEST['ngay_cap']) ? date("Y-m-d", strtotime(str_replace('/', '-', $_REQUEST['ngay_cap']))) : date("Y-m-d");
        $noicap = isset($_REQUEST['noi_cap']) ? $_REQUEST['noi_cap'] : '';
        $quequan = isset($_REQUEST['que_quan']) ? $_REQUEST['que_quan'] : '';
        $diachi = isset($_REQUEST['dia_chi']) ? $_REQUEST['dia_chi'] : '';
        $ghichu = isset($_REQUEST['ghi_chu']) ? $_REQUEST['ghi_chu'] : '';
        $data = [
            'birthday' => $ngaysinh,
            'idCard' => $cmnd,
            'idDate' => $ngaycap,
            'idAddress' => $noicap,
            'province' => $quequan,
            'address' => $diachi,
            'description' => $ghichu
        ];
        if ($this->model->updateObj($id, $data)) {
            $_SESSION['user']['hoten'] = $name;
            $jsonObj['msg'] = "Cập nhật dữ liệu thành công";
            $jsonObj['success'] = true;
        } else {
            $jsonObj['msg'] = "Lỗi khi cập nhật database";
            $jsonObj['success'] = false;
        }
        echo json_encode($jsonObj);
    }

    function updatesocial()
    {
        $id = isset($_SESSION['user']['staffId']) ? $_SESSION['user']['staffId'] : 0;
        $twitter = isset($_REQUEST['twitter']) ? $_REQUEST['twitter'] : '';
        $facebook = isset($_REQUEST['facebook']) ? $_REQUEST['facebook'] : '';
        $zalo = isset($_REQUEST['zalo']) ? $_REQUEST['zalo'] : '';
        $instagram = isset($_REQUEST['instagram']) ? $_REQUEST['instagram'] : '';
        $wechat = isset($_REQUEST['wechat']) ? $_REQUEST['wechat'] : '';
        $linkedin = isset($_REQUEST['linkedin']) ? $_REQUEST['linkedin'] : '';
        $data = [
            'twitter' => $twitter,
            'facebook' => $facebook,
            'zalo' => $zalo,
            'instagram' => $instagram,
            'wechat' => $wechat,
            'linkein' => $linkedin
        ];
        if ($this->model->updateSocial($id, $data)) {
            $jsonObj['msg'] = "Cập nhật dữ liệu thành công";
            $jsonObj['success'] = true;
        } else {
            $jsonObj['msg'] = "Lỗi khi cập nhật database";
            $jsonObj['success'] = false;
        }
        echo json_encode($jsonObj);
    }

    function changepass()
    {
        $id = isset($_SESSION['user']['id']) ? $_SESSION['user']['id'] : 0;
        $oldpass = isset($_REQUEST['oldpass']) ? $_REQUEST['oldpass'] : '';
        $newpass = isset($_REQUEST['newpass']) ? $_REQUEST['newpass'] : '';
        $renewpass = isset($_REQUEST['renewpass']) ? $_REQUEST['renewpass'] : '';
        $password = $this->model->getPass($id);
        if ($password == md5(md5($oldpass))) {
            if ($newpass == $renewpass) {
                $data = [
                    'password' => md5(md5($newpass))
                ];
                if ($this->model->changePass($id, $data)) {
                    $jsonObj['msg'] = "Cập nhật dữ liệu thành công";
                    $jsonObj['success'] = true;
                } else {
                    $jsonObj['msg'] = "Lỗi khi cập nhật database";
                    $jsonObj['success'] = false;
                }
            } else {
                $jsonObj['msg'] = "Mật khẩu không khớp nhau";
                $jsonObj['success'] = false;
            }
        } else {
            $jsonObj['msg'] = "Mật khẩu không chính xác";
            $jsonObj['success'] = false;
        }
        echo json_encode($jsonObj);
    }
}
