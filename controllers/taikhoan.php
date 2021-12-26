<?php
class Taikhoan extends Controller{
    function __construct(){
        parent::__construct();
    }

    function index(){
        require "layouts/header.php";
        $this->view->render("taikhoan/index");
        require "layouts/footer.php";
    }

    function list()
    {
        $data = $this->model->listObj();
        echo json_encode($data);
    }

    // function combo(){
    //     $json = $this->model->get_data_combo();
    //     $this->view->jsonObj = json_encode($json);
    //     $this->view->render("khachhang/combo");
    // }

    function loaddata()
    {
        $id=isset($_REQUEST['id'])?$_REQUEST['id']:0;
        $json = $this->model->getdata($id);
        echo json_encode($json);
    }

    function add()
    {
        
        $name = $_REQUEST['name'];
        $so_tk = $_REQUEST['so_tk'];
        $ngan_hang = $_REQUEST['ngan_hang'];
        $data = array(
            'name' => $name,
            'so_tk' => $so_tk,
            'ngan_hang' => $ngan_hang,
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
        $name = $_REQUEST['name'];
        $so_tk = $_REQUEST['so_tk'];
        $ngan_hang = $_REQUEST['ngan_hang'];
        $tinh_trang = $_REQUEST['tinh_trang'];
       
        $data = array(
            'name' => $name,
            'so_tk' => $so_tk,
            'ngan_hang' => $ngan_hang,
            'tinh_trang' => $tinh_trang,
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
            $jsonObj['msg'] = "Xóa dữ liệu không thành công";
            $jsonObj['success'] = false;
        } 
        echo json_encode($jsonObj);
    }
}
?>