<?php
class Taisancapphat extends Controller{
    function __construct(){
        parent::__construct();
    }

    function index(){
        require "layouts/header.php";
        $this->view->render("taisancapphat/index");
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
            'name' => 'CP-'.time(),
            'tai_san' => $_REQUEST['tai_san'],
            'nhan_vien' => $_REQUEST['nhan_vien'],
            'so_luong' => $_REQUEST['so_luong'],
            'ngay_gio' => $_REQUEST['ngay_gio'],
            'dat_coc' => $_REQUEST['dat_coc'],
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
            'tai_san' => $_REQUEST['id_ts'],
            'nhan_vien' => $_REQUEST['nhan_vien'],
            'so_luong' => $_REQUEST['so_luong'],
            'ngay_gio' => $_REQUEST['ngay_gio'],
            'dat_coc' => $_REQUEST['dat_coc'],
            'ghi_chu' => $_REQUEST['ghi_chu'],
            'tinh_trang' => 1
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
            $jsonObj['msg'] = "Thu hồi hết tài sản trước khi xoá";
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

    function get_sltonkho()
    {
        $id = $_REQUEST['id'];
        $json = $this->model->get_sltonkho($id);
        echo json_encode($json);
    }
    
    function get_slcp()
    {
        $id = $_REQUEST['id'];
        $json = $this->model->get_slcp($id);
        echo json_encode($json);
    }



    function thuhoi()
    {
        $data = array(
            'cap_phat' => $_REQUEST['id_cp'],
            'tai_san' => $_REQUEST['id_tsth'],
            'so_luong' => $_REQUEST['so_luong_th'],
            'ngay_gio' => $_REQUEST['ngay_gio_th'],
            'tra_coc' => $_REQUEST['tra_coc'],
            'ghi_chu' => $_REQUEST['ghi_chu_th'],
            'tinh_trang' => 1
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