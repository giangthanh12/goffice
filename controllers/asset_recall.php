<?php
class asset_recall extends Controller{
    function __construct(){
        parent::__construct();
    }

    function index(){
        require "layouts/header.php";
        $this->view->render("asset_recall/index");
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
    function update()
    {
        $id = $_REQUEST['id'];
       $data = array(
            'tai_san' => $_REQUEST['id_ts'],
            'cap_phat' => $_REQUEST['id_cp'],
            'so_luong' => 1,
            'ngay_gio' => date('Y-m-d', strtotime($_REQUEST['ngay_gio'])),
            'tra_coc' => $_REQUEST['tra_coc'],
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
    function capphat()
    {
        $json = $this->model->capphat();
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


    


}
?>