<?php

class nhatkychung extends Controller
{
    function __construct()
    {
        parent::__construct();
    }

    function index(){
        require "layouts/header.php";
        $this->view->render("nhatkychung/index");
        require "layouts/footer.php";
    }

    function getData()
    {
        $data = $this->model->getlist();
        echo json_encode($data);
    }

    function loaddata()
    {
        $id=isset($_REQUEST['id'])?$_REQUEST['id']:0;
        $json = $this->model->getdata($id);
        echo json_encode($json);
    }

    function updateinfo()
    {
        $data = $_REQUEST['data'];
        $id = $_REQUEST['id'];
        if ($this->model->updateinfo($data,$id)) {
            $jsonObj['msg'] = "Cập nhật dữ liệu thành công";
            $jsonObj['success'] = true;
        } else {
            $jsonObj['msg'] = "Lỗi khi cập nhật database";
            $jsonObj['success'] = false;
        }
        echo json_encode($jsonObj);
    }

    function thayanh()
    {
        $id = $_REQUEST['myid'];
        $filename = $_FILES['hinhanh']['name'];
        $hinhanh = '';
        if ($filename!='') {
            $dir = ROOT_DIR . '/uploads/nhanvien/';
            $file = functions::uploadfile('hinhanh', $dir, $id);
            if ($file!='')
                $hinhanh = URLFILE.'/uploads/nhanvien/'.$file;
        }
        if ($this->model->thayanh($hinhanh,$id)) {
            $jsonObj['filename'] = $hinhanh;
            $jsonObj['msg'] = "Cập nhật dữ liệu thành công".$file;
            $jsonObj['success'] = true;
        } else {
            $jsonObj['msg'] = "Lỗi khi cập nhật database";
            $jsonObj['success'] = false;
        }
        echo json_encode($jsonObj);
    }

    function them()
    {
        $data = $_REQUEST['data'];
        if ($this->model->them($data)) {
            $jsonObj['msg'] = "Cập nhật dữ liệu thành công";
            $jsonObj['success'] = true;
        } else {
            $jsonObj['msg'] = "Lỗi khi cập nhật database";
            $jsonObj['success'] = false;
        }
        echo json_encode($jsonObj);
    }

    function xoa()
    {
        $id = $_REQUEST['id'];
        if ($this->model->xoa($id)) {
            $jsonObj['msg'] = "Cập nhật dữ liệu thành công";
            $jsonObj['success'] = true;
        } else {
            $jsonObj['msg'] = "Lỗi khi xóa dữ liệu".$id;
            $jsonObj['success'] = false;
        }
        echo json_encode($jsonObj);
    }

    function thoiviec()
    {
        $id = $_REQUEST['id'];
        if ($this->model->thoiviec($id)) {
            $jsonObj['msg'] = "Cập nhật dữ liệu thành công";
            $jsonObj['success'] = true;
        } else {
            $jsonObj['msg'] = "Lỗi khi cập nhật database".$id;
            $jsonObj['success'] = false;
        }
        echo json_encode($jsonObj);
    }

    function thanhpho() {
        $data = $this->model->thanhpho();
        echo json_encode($data);
    }

}

?>
