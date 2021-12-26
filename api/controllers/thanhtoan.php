<?php
class thanhtoan extends Controller
{
    function __construct()
    {
        parent::__construct();
    }

    function combo()
    {
        $phongban = isset($_REQUEST['phongban']) ? $_REQUEST['phongban'] : 0;
        $json = $this->model->get_data_combo($phongban);
        echo json_encode($json);
    }

    function list()
    {
        $data = $this->model->listObj();
        echo json_encode($data);
    }

    function listApi()
    {
        $data = $this->model->listObjApi();
        echo json_encode($data);
    }

    function loaddata()
    {
        $id = isset($_REQUEST['id']) ? $_REQUEST['id'] : 0;
        $json = $this->model->getdata($id);
        echo json_encode($json);
    }

    function add()
    {
        $ngay = isset($_REQUEST['ngay']) ? date("Y-m-d", strtotime(str_replace('/', '-', $_REQUEST['ngay']))) : date("Y-m-d");
        $sotien = isset($_REQUEST['so_tien']) ? str_replace(',', '',$_REQUEST['so_tien']) : 0;
        $noidung = isset($_REQUEST['noi_dung']) ? $_REQUEST['noi_dung'] : '';
        $nhanvien = isset($_REQUEST['nhan_vien']) ? $_REQUEST['nhan_vien'] : 0;
        $tinhtrang = 1;
        $filename = $_FILES['file']['name'];
        $fname = explode('.', $filename);
        $file = '';
        if ($filename != '') {
            if (file_exists(ROOT_DIR . '/uploads/bieumau/' . $filename)) {
                $file = URLFILE . '/uploads/bieumau/' . $filename;
            } else {
                $dir = ROOT_DIR . '/uploads/bieumau/';
                $file = functions::uploadfile('file', $dir, $fname[0]);
                if ($file != '')
                    $file = URLFILE . '/uploads/bieumau/' . $file;
            }
        }
        $data = array(
            'ngay' => $ngay,
            'so_tien' => $sotien,
            'noi_dung' => $noidung,
            'nhan_vien' => $nhanvien,
            'file' => $file,
            'tinh_trang' => $tinhtrang
        );
        if ($this->model->addObj($data)) {
            $jsonObj['msg'] = 'Cập nhật dữ liệu thành công';
            $jsonObj['success'] = true;
        } else {
            $jsonObj['msg'] = 'Cập nhật dữ liệu không thành công';
            $jsonObj['success'] = false;
        }
        echo json_encode($jsonObj);
    }

    function update()
    {
        $id = $_REQUEST['id'];
        $ngay = isset($_REQUEST['ngay']) ? date("Y-m-d", strtotime(str_replace('/', '-', $_REQUEST['ngay']))) : date("Y-m-d");
        $sotien = isset($_REQUEST['so_tien']) ? str_replace(',', '',$_REQUEST['so_tien']) : 0;
        $noidung = isset($_REQUEST['noi_dung']) ? $_REQUEST['noi_dung'] : '';
        $nhanvien = isset($_REQUEST['nhan_vien']) ? $_REQUEST['nhan_vien'] : 0;
        $nguoisua = isset($_SESSION['user']['nhan_vien']) ? $_SESSION['user']['nhan_vien'] : (isset($_REQUEST['nguoi_sua']) ? $_REQUEST['nguoi_sua'] : 0);
        $filename = $_FILES['file']['name'];
        $fname = explode('.', $filename);
        $file = '';
        if ($filename != '') {
            if (file_exists(ROOT_DIR . '/uploads/bieumau/' . $filename)) {
                $file = URLFILE . '/uploads/bieumau/' . $filename;
            } else {
                $dir = ROOT_DIR . '/uploads/bieumau/';
                $file = functions::uploadfile('file', $dir, $fname[0]);
                if ($file != '')
                    $file = URLFILE . '/uploads/bieumau/' . $file;
            }

            $data = array(
                'ngay' => $ngay,
                'so_tien' => $sotien,
                'noi_dung' => $noidung,
                'file' => $file,
                'nhan_vien' => $nhanvien
            );
        } else {
            $data = array(
                'ngay' => $ngay,
                'so_tien' => $sotien,
                'noi_dung' => $noidung,
                'nhan_vien' => $nhanvien
            );
        }
        if ($this->model->updateObj($id, $data, $nguoisua)) {
            $jsonObj['msg'] = 'Cập nhật dữ liệu thành công';
            $jsonObj['success'] = true;
        } else {
            $jsonObj['msg'] = 'Cập nhật dữ liệu không thành công';
            $jsonObj['success'] = false;
        }

        echo json_encode($jsonObj);
    }

    function duyet()
    {
        $id = $_REQUEST['id'];
        $tinhtrang = 2;
        $nhanvien = isset($_SESSION['user']['nhan_vien']) ? $_SESSION['user']['nhan_vien'] : (isset($_REQUEST['nhan_vien']) ? $_REQUEST['nhan_vien'] : 0);
        $data = [
            'nguoi_duyet' => $nhanvien,
            'tinh_trang' => $tinhtrang
        ];
        if ($this->model->duyetphieu($id, $data, $nhanvien)) {
            $ok = $this->model->updateBL($id);
            if ($ok) {
                $jsonObj['msg'] = "Cập nhật dữ liệu thành công";
                $jsonObj['success'] = true;
            }
        } else {
            $jsonObj['msg'] = "Cập nhật dữ liệu không thành công";
            $jsonObj['success'] = false;
        }
        echo json_encode($jsonObj);
    }

    function tuchoi()
    {
        $id = $_REQUEST['id'];
        $nguoisua = isset($_SESSION['user']['nhan_vien']) ? $_SESSION['user']['nhan_vien'] : (isset($_REQUEST['nguoi_sua']) ? $_REQUEST['nguoi_sua'] : 0);
        $data = [
            'tinh_trang' => 3
        ];
        if ($this->model->duyetphieu($id, $data, $nguoisua)) {
            $jsonObj['msg'] = "Cập nhật dữ liệu thành công";
            $jsonObj['success'] = true;
        } else {
            $jsonObj['msg'] = "Cập nhật dữ liệu không thành công";
            $jsonObj['success'] = false;
        }
        echo json_encode($jsonObj);
    }

    function del()
    {
        $id = $_REQUEST['id'];
        $data = ['tinh_trang' => 0];
        $nguoisua = isset($_SESSION['user']['nhan_vien']) ? $_SESSION['user']['nhan_vien'] : (isset($_REQUEST['nguoi_sua']) ? $_REQUEST['nguoi_sua'] : 0);
        if ($this->model->delObj($id, $data, $nguoisua)) {
            $jsonObj['msg'] = "Xóa dữ liệu thành công";
            $jsonObj['success'] = true;
        } else {
            $jsonObj['msg'] = "Xóa dữ liệu không thành công";
            $jsonObj['success'] = false;
        }
        echo json_encode($jsonObj);
    }
}
