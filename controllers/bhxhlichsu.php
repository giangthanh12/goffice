<?php
class bhxhlichsu extends Controller{
    function __construct(){
        parent::__construct();
    }

    function index(){
        require "layouts/header.php";
        $this->view->render("bhxhlichsu/index");
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
            'bhxh' => $_REQUEST['nhan_vien'],
            'ngay_gio' => $_REQUEST['ngay_gio'],
            'ghi_chu' => $_REQUEST['ghi_chu'],
            'tinh_trang' => 1,
        );
        if($this->model->addObj($data)){
            $jsonObj['msg'] = 'Cập nhật dữ liệu thành công';
            $jsonObj['success'] = true;
        } else {
            $jsonObj['msg'] = 'Lỗi cập nhật database';
            $jsonObj['success'] = false;
        }
        echo json_encode($jsonObj);
    }

    function addAll()
    {
       
        $data = array(
            'ngay_gio' => $_REQUEST['ngay_gio_all'],
            'ghi_chu' => $_REQUEST['ghi_chu_all'],
            'tinh_trang' => 1,
        );
        if($this->model->addAll($data)){
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
            'bhxh' => $_REQUEST['nhan_vien'],
            'ngay_gio' => $_REQUEST['ngay_gio'],
            'ghi_chu' => $_REQUEST['ghi_chu'],
            'tinh_trang' => 1,
        );
        if($this->model->updateObj($id, $data)){
            $jsonObj['msg'] = 'Cập nhật dữ liệu thành công';
            $jsonObj['success'] = true;
        } else {
            $jsonObj['msg'] = 'Lỗi cập nhật database bhxh'.$id;
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


    function nhanvien()
    {
        $data = $this->model->nhanvien();
        echo json_encode($data);
    }
    function thanhpho()
    {
        $data = $this->model->thanhpho();
        echo json_encode($data);
    }


    function bhxh()
    {
        $id= $_REQUEST['id'];
        $jsonObj = $this->model->getbhxh($id);
        if($jsonObj){
            $jsonObj['msg'] = "Lấy Mã BHXH thành công";
            $jsonObj['success'] = true;
        }else{
            $jsonObj['msg'] = "Lấy Mã BHXH không thành công";
            $jsonObj['success'] = false;
        }
       
        echo json_encode($jsonObj);
    }








}
?>