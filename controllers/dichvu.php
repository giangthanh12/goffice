<?php
class Dichvu extends Controller{
    function __construct(){
        parent::__construct();
    }
    function index(){
        require "layouts/header.php";
        $this->view->render("dichvu/index");
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
            'name' => $_REQUEST['name'],
            'phan_loai' => $_REQUEST['phan_loai'],
            'nhacungcap' => $_REQUEST['nhacungcap'],
            'don_vi_tinh' => $_REQUEST['don_vi_tinh'],
            'don_gia' => $_REQUEST['don_gia'],
            'gia_von' => $_REQUEST['gia_von'],
            'thue_vat' => $_REQUEST['thue_vat'],
            'tax' => $_REQUEST['tax'],
            'so_luong' => $_REQUEST['so_luong'],
            'gia_han' => $_REQUEST['gia_han'],
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

    function update()
    {
        $id = $_REQUEST['id'];
        $data = array(
            'name' => $_REQUEST['name'],
            'phan_loai' => $_REQUEST['phan_loai'],
            'nhacungcap' => $_REQUEST['nhacungcap'],
            'don_vi_tinh' => $_REQUEST['don_vi_tinh'],
            'don_gia' => $_REQUEST['don_gia'],
            'gia_von' => $_REQUEST['gia_von'],
            'thue_vat' => $_REQUEST['thue_vat'],
            'tax' => $_REQUEST['tax'],
            'so_luong' => $_REQUEST['so_luong'],
            'gia_han' => $_REQUEST['gia_han'],
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


    function phanloai()
    {
        $data = $this->model->phanloai();
        echo json_encode($data);
    }
    function nhacungcap()
    {
        $data = $this->model->nhacungcap();
        echo json_encode($data);
    }
    function don_vi_tinh()
    {
        $data = $this->model->don_vi_tinh();
        echo json_encode($data);
    }


    function baogiam()
    {
        $data = array(
            'bhxh' => $_REQUEST['id_bhxh'],
            'nhan_vien' => $_REQUEST['id_nhanvien'],
            'ngay_gio' => $_REQUEST['ngay_gio_bg'],
            'ghi_chu'=> $_REQUEST['ghi_chu_bg'],
            'tinh_trang' => 1,
        );
        if($this->model->baogiam($data)){
            $jsonObj['msg'] = 'Cập nhật dữ liệu thành công';
            $jsonObj['success'] = true;
        } else {
            $jsonObj['msg'] = 'Lỗi cập nhật database';
            $jsonObj['success'] = false;
        }
        echo json_encode($jsonObj);
    }

    function del_bg()
    {
        $id = $_REQUEST['id'];
        $data = ['tinh_trang'=>0];
        if($this->model->del_bg($id,$data)){
            $jsonObj['msg'] = "Xóa dữ liệu thành công";
            $jsonObj['success'] = true;
        } else {
            $jsonObj['msg'] = "Xóa dữ liệu không thành công";
            $jsonObj['success'] = false;
        } 
        echo json_encode($jsonObj);
    }









    function listbaogiam()
    {
        $data = $this->model->listbaogiam();
        echo json_encode($data);
    }

    function loaddata_bg()
    {
        $id=isset($_REQUEST['id'])?$_REQUEST['id']:0;
        $json = $this->model->loaddata_bg($id);
        echo json_encode($json);
    }
    function update_bg()
    {
        $id = $_REQUEST['id'];
        $data = array(
            'ngay_gio' => $_REQUEST['ngay_gio_bg'],
            'ghi_chu' => $_REQUEST['ghi_chu_bg'],
        );
        if($this->model->update_bg($id, $data)){
            $jsonObj['msg'] = 'Cập nhật dữ liệu thành công';
            $jsonObj['success'] = true;
        } else {
            $jsonObj['msg'] = 'Lỗi cập nhật database bhxh'.$id;
            $jsonObj['success'] = false;
        }
        echo json_encode($jsonObj);
    }








}
?>