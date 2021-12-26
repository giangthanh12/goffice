<?php
class Taisanbaohanh extends Controller{
    function __construct(){
        parent::__construct();
    }

    function list()
    {
        $data = $this->model->listObj();
        echo json_encode($data);
    }
    function list_lichsu()
    {
        $id = $_REQUEST['id'];
        $data = $this->model->list_lichsu($id);
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
            
            'tai_san' => $_REQUEST['tai_san'],
            'so_luong' => $_REQUEST['so_luong'],
            'ngay_gio' => $_REQUEST['ngay_gio'],
            'ghi_chu' => $_REQUEST['ghi_chu'],
            'tinh_trang' => 1
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
            'tai_san' => $_REQUEST['tai_san'],
            'so_luong' => $_REQUEST['so_luong'],
            'ngay_gio' => $_REQUEST['ngay_gio'],
            'ghi_chu' => $_REQUEST['ghi_chu'],
            
        );
        if($this->model->updateObj($id, $data)){
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
            $jsonObj['msg'] = "Lỗi cập nhật database";
            $jsonObj['success'] = false;
        } 
        echo json_encode($jsonObj);
    }

    function taisan()
    {
        $json = $this->model->taisan();
        echo json_encode($json);
    }
    function nhanvien()
    {
        $json = $this->model->nhanvien();
        echo json_encode($json);
    }

    function get_sl()
    {
        $id = $_REQUEST['id'];
        $json = $this->model->get_sl($id);
        echo json_encode($json);
    }
    
    function get_slbh()
    {
        $id = $_REQUEST['id'];
        $json = $this->model->get_slbh($id);
        echo json_encode($json);
    }



    function thuhoi()
    {
        $data = array(
            'bao_hanh' => $_REQUEST['id_bh'],
            'tai_san' => $_REQUEST['id_tsth'],
            'so_luong' => $_REQUEST['so_luong_th'],
            'ngay_gio' => $_REQUEST['ngay_gio_th'],
            'ghi_chu' => $_REQUEST['ghi_chu_th'],
            'status' => 0
        );
        if($this->model->add_thuhoi($data)){
            $jsonObj['msg'] = 'Cập nhật dữ liệu thành công';
            $jsonObj['success'] = true;
        } else {
            $jsonObj['msg'] = 'Lỗi cập nhật database';
            $jsonObj['success'] = false;
        }
        echo json_encode($jsonObj);
    }
    


}
?>