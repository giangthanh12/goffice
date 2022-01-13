<?php
class position extends Controller{
    function __construct(){
        parent::__construct();
    }

    function index(){
        require "layouts/header.php";
        $this->view->render("position/index");
        require "layouts/footer.php";
    }

    function combo(){
        $phongban = isset($_REQUEST['phongban']) ? $_REQUEST['phongban'] : 0;
        $json = $this->model->get_data_combo($phongban);
        echo json_encode($json);
    }

    function list()
    {
        $data = $this->model->listObj();
        echo json_encode($data);
    }

    function loaddata()
    {
        $id = isset($_REQUEST['id'])?$_REQUEST['id']:0;
        $json = $this->model->getdata($id);
        echo json_encode($json);
    }

    function add()
    {
        $name = isset($_REQUEST['name']) ? $_REQUEST['name'] : '';
        $phongban = isset($_REQUEST['phong_ban']) ? $_REQUEST['phong_ban'] : '';
        $tinhtrang = 1;
        $data = array(
            'name' => $name,
            'department' => $phongban,
            'status' => $tinhtrang
        );
        if($this->model->addObj($data)){
            $jsonObj['msg'] = 'Cập nhật dữ liệu thành công';
            $jsonObj['success'] = true;
        } else {
            $jsonObj['msg'] = 'Cập nhật dữ liệu không thành công';
            $jsonObj['success'] = false;
        }
        echo json_encode($jsonObj);
    }

    function update()
    {
        $id = $_REQUEST['id'];
        $name = isset($_REQUEST['name']) ? $_REQUEST['name'] : '';
        $phongban = isset($_REQUEST['phong_ban']) ? $_REQUEST['phong_ban'] : '';
        $data = array(
            'name' => $name,
            'department' => $phongban
        );
        if($this->model->updateObj($id, $data)){
            $jsonObj['msg'] = 'Cập nhật dữ liệu thành công';
            $jsonObj['success'] = true;
        } else {
            $jsonObj['msg'] = 'Cập nhật dữ liệu không thành công';
            $jsonObj['success'] = false;
        }
        
        echo json_encode($jsonObj);
    }

    function del()
    {
        $id = $_REQUEST['id'];
        $data = ['status'=>0];
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