<?php

use function GuzzleHttp\Psr7\parse_request;

class accountsettings extends Controller
{
    function __construct()
    {
        parent::__construct();
    }

    function loaddata()
    {
        $id = isset($_SESSION['user']['id']) ? $_SESSION['user']['id'] : (isset($_REQUEST['id']) ? $_REQUEST['id'] : '');
        $jsonObj = $this->model->getData($id);
        echo json_encode($jsonObj);
    }

    function thayanh()
    {
        $id = isset($_SESSION['user']['id']) ? $_SESSION['user']['id'] : (isset($_REQUEST['id']) ? $_REQUEST['id'] : '');
        $filename = $_FILES['hinhanh']['name'];
        $fname = explode('.', $filename);
        $hinhanh = '';
        if ($filename != '') {
            if (file_exists(ROOT_DIR . '/uploads/nhanvien/' . $filename)) {
                $hinhanh = URLFILE.'/uploads/nhanvien/' . $filename;
            } else {
                $dir = ROOT_DIR . '/uploads/nhanvien/';
                $file = functions::uploadfile('hinhanh', $dir, $fname[0]);
                if ($file != '')
                    $hinhanh =  URLFILE.'/uploads/nhanvien/' . $file;
            }
        }
        if ($this->model->thayanh($hinhanh, $id)) {
            $_SESSION['user']['hinhanh'] = $hinhanh;
            $jsonObj['filename'] = $hinhanh;
            $jsonObj['msg'] = "Cập nhật dữ liệu thành công";
            $jsonObj['success'] = true;
        } else {
            $jsonObj['msg'] = "Lỗi khi cập nhật database";
            $jsonObj['success'] = false;
        }
        echo json_encode($jsonObj);
    }

    function xoaanh()
    {
        $id = isset($_SESSION['user']['id']) ? $_SESSION['user']['id'] : (isset($_REQUEST['id']) ? $_REQUEST['id'] : '');
        $data = [
            'hinh_anh' => ''
        ];
        if ($this->model->updateObj($id, $data)) {
            $_SESSION['user']['hinhanh'] = URLFILE.'/uploads/avatar-s-11.jpg';
            $jsonObj['success'] = true;
        } else {
            $jsonObj['success'] = false;
        }
        echo json_encode($jsonObj);
    }

    function update()
    {
        $id = isset($_SESSION['user']['id']) ? $_SESSION['user']['id'] : (isset($_REQUEST['id']) ? $_REQUEST['id'] : '');
        $name = isset($_REQUEST['name']) ? $_REQUEST['name'] : '';
        $email = isset($_REQUEST['email']) ? $_REQUEST['email'] : '';
        $dienthoai = isset($_REQUEST['dien_thoai']) ? $_REQUEST['dien_thoai'] : '';
        $ngaysinh = isset($_REQUEST['ngay_sinh']) ? date("Y-m-d", strtotime(str_replace('/', '-', $_REQUEST['ngay_sinh']))) : date("Y-m-d");
        $cmnd = isset($_REQUEST['cmnd']) ? $_REQUEST['cmnd'] : '';
        $ngaycap = isset($_REQUEST['ngay_cap']) ? date("Y-m-d", strtotime(str_replace('/', '-', $_REQUEST['ngay_cap']))) : date("Y-m-d");
        $noicap = isset($_REQUEST['noi_cap']) ? $_REQUEST['noi_cap'] : '';
        $quequan = isset($_REQUEST['que_quan']) ? $_REQUEST['que_quan'] : '';
        $diachi = isset($_REQUEST['dia_chi']) ? $_REQUEST['dia_chi'] : '';
        $ghichu = isset($_REQUEST['ghi_chu']) ? $_REQUEST['ghi_chu'] : '';
        $data = [
            'name' => $name,
            'email' => $email,
            'dien_thoai' => $dienthoai,
            'ngay_sinh' => $ngaysinh,
            'cmnd' => $cmnd,
            'ngay_cap' => $ngaycap,
            'noi_cap' => $noicap,
            'que_quan' => $quequan,
            'dia_chi' => $diachi,
            'ghi_chu' => $ghichu
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
        $id = isset($_SESSION['user']['id']) ? $_SESSION['user']['id'] : (isset($_REQUEST['id']) ? $_REQUEST['id'] : '');
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
        $id = isset($_SESSION['user']['id']) ? $_SESSION['user']['id'] : (isset($_REQUEST['id']) ? $_REQUEST['id'] : '');
        $oldpass = isset($_REQUEST['oldpass']) ? $_REQUEST['oldpass'] : '';
        $newpass = isset($_REQUEST['newpass']) ? $_REQUEST['newpass'] : '';
        $renewpass = isset($_REQUEST['renewpass']) ? $_REQUEST['renewpass'] : '';
        $password = $this->model->getPass($id);
        if ($password == md5(md5($oldpass))) {
            if ($newpass == $renewpass) {
                $data = [
                    'mat_khau' => md5(md5($newpass))
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
