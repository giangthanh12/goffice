<?php
class bhxh extends Controller{
    function __construct(){
        parent::__construct();
    }
    function index(){
        require "layouts/header.php";
        $this->view->render("bhxh/index");
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
            'nhan_vien' => $_REQUEST['nhan_vien'],
            'ma_bhxh' => $_REQUEST['ma_bhxh'],
            'muc_dong' => $_REQUEST['muc_dong'],
            'thanh_pho' => $_REQUEST['thanh_pho'],
            'cty_dong' => $_REQUEST['cty_dong'],
            'nld_dong' => $_REQUEST['nld_dong'],
            'ngay_gio' => $_REQUEST['ngay_gio'],
            'ghi_chu' => $_REQUEST['ghi_chu'],
            'diadiem_dk' => $_REQUEST['diadiem_dk'],
            'diadiem_dkkcb' => $_REQUEST['diadiem_dkkcb'],
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
            'nhan_vien' => $_REQUEST['nhan_vien'],
            'ma_bhxh' => $_REQUEST['ma_bhxh'],
            'muc_dong' => $_REQUEST['muc_dong'],
            'thanh_pho' => $_REQUEST['thanh_pho'],
            'cty_dong' => $_REQUEST['cty_dong'],
            'nld_dong' => $_REQUEST['nld_dong'],
            'ngay_gio' => $_REQUEST['ngay_gio'],
            'ghi_chu' => $_REQUEST['ghi_chu'],
            'diadiem_dk' => $_REQUEST['diadiem_dk'],
            'diadiem_dkkcb' => $_REQUEST['diadiem_dkkcb'],
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