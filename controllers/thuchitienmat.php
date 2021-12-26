<?php
class Thuchitienmat extends Controller{
    function __construct(){
        parent::__construct();
    }

    function index(){
        require "layouts/header.php";
        $this->view->render("thuchitienmat/index");
        require "layouts/footer.php";
    }

    function list()
    {
        $data = $this->model->listObj();
        echo json_encode($data);
    }


    function loaddata()
    {
        $id=isset($_REQUEST['id'])?$_REQUEST['id']:0;
        $json = $this->model->getdata($id);
        echo json_encode($json);
    }

    function add()
    {
        $data = array(
            'ngay_gio' => $_REQUEST['ngay_gio'],
            'dien_giai' => $_REQUEST['dien_giai'],
            'khach_hang' => $_REQUEST['khach_hang'],
            'nhan_vien' => $_REQUEST['nhan_vien'],
            'tai_khoan' => $_REQUEST['tai_khoan'],
            'loai' => $_REQUEST['loai'],
            'hach_toan' => $_REQUEST['hach_toan'],
            'so_tien' => $_REQUEST['so_tien'],
            'tinh_trang' => 1
        );
        $time_now = date('H:i:s', time());
        $data['ngay_gio'] = $_REQUEST['ngay_gio'] . " " . $time_now;
        if($this->model->addObj($data)){
            $jsonObj['msg'] = 'Cập nhật dữ liệu thành công';
            $jsonObj['success'] = true;
        } else {
            $jsonObj['msg'] = 'Lỗi cập nhật database';
            $jsonObj['success'] = false;
        }
        echo json_encode($jsonObj);
    }

    function update()
    {
        $id = $_REQUEST['id'];
        $data = array(
            'dien_giai' => $_REQUEST['dien_giai'],
            'khach_hang' => $_REQUEST['khach_hang'],
            'nhan_vien' => $_REQUEST['nhan_vien'],
            'tai_khoan' => $_REQUEST['tai_khoan'],
            'loai' => $_REQUEST['loai'],
            'hach_toan' => $_REQUEST['hach_toan'],
            'so_tien' => $_REQUEST['so_tien']
        );
        $ngay_gio = substr($_REQUEST['ngay_gio'], 0, 10);
        $time_now = date('H:i:s', time());
        $data['ngay_gio'] = $ngay_gio . " " . $time_now;
        if($this->model->updateObj($id, $data)){
            $jsonObj['msg'] = 'Cập nhật dữ liệu thành công';
            $jsonObj['success'] = true;
        } else {
            $jsonObj['msg'] = 'Lỗi cập nhật database';
            $jsonObj['success'] = false;
        }
        echo json_encode($jsonObj);
    }

    function chotsodu()
    {
        if($this->model->updateChotsodu()){
            $jsonObj['msg'] = 'Cập nhật dữ liệu thành công';
            $jsonObj['success'] = true;
        } else {
            $jsonObj['msg'] = 'Lỗi cập nhật database';
            $jsonObj['success'] = false;
        }
        echo json_encode($jsonObj);
    }

    function del()
    {
        $id = $_REQUEST['id'];
        $data = ['tinh_trang'=>0];
  

        if($this->model->delObj($id,$data)){
            $jsonObj['msg'] = "Xóa dữ liệu thành công";
            $jsonObj['success'] = true;
        } else {
            $jsonObj['msg'] = "Xóa dữ liệu không thành công";
            $jsonObj['success'] = false;
        } 
        echo json_encode($jsonObj);
    }


    function khachhang() {
        $data = $this->model->khachhang();
        echo json_encode($data);
    }
   
    function nhanvien() {
        $data = $this->model->nhanvien();
        echo json_encode($data);
    }


















}
?>