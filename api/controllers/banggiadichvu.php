<?php
class Banggiadichvu extends Controller{
    function __construct(){
        parent::__construct();
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
            'dich_vu' => $_REQUEST['dich_vu'],
            'ngay_gio_s' => $_REQUEST['ngay_gio_s'],
            'ngay_gio_e' => $_REQUEST['ngay_gio_e'],
            'so_tien' => $_REQUEST['so_tien'],
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
            'dich_vu' => $_REQUEST['dich_vu'],
            'ngay_gio_s' => $_REQUEST['ngay_gio_s'],
            'ngay_gio_e' => $_REQUEST['ngay_gio_e'],
            'so_tien' => $_REQUEST['so_tien'],
            'ghi_chu' => $_REQUEST['ghi_chu'],
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


    function dichvu()
    {
        $data = $this->model->dichvu();
        echo json_encode($data);
    }






}
?>