<?php
class workspaces extends Controller{
    private $_Data;
    function __construct(){
        parent::__construct();
        $this->_Data = new Model();
    }
    function index(){
        require "layouts/header.php";
        $this->view->render("workspaces/index");
        require "layouts/footer.php";
    }

    function list()
    {
        $data = $this->model->listObj();
        echo json_encode($data);
    }

    function combo(){
        $json = $this->model->get_data_combo();
        echo json_encode($json);
    }

    function loaddata()
    {
        $id = isset($_REQUEST['id'])?$_REQUEST['id']:0;
        $json = $this->model->getdata($id);
        echo json_encode($json);
    }

    function getBranch() {
        $jsonObj = $this->model->getBranch();
        echo json_encode($jsonObj);
    }

    function add()
    {
        $name = isset($_REQUEST['name']) ? $_REQUEST['name'] : '';
        $branch = isset($_REQUEST['branch']) ? $_REQUEST['branch'] : '';
        $diachi = isset($_REQUEST['dia_chi']) ? $_REQUEST['dia_chi'] : '';
        $tinhtrang = 1;
        $data = array(
            'name' => $name,
            'branchId' => $branch,
            'address' => $diachi,
            'status' => $tinhtrang,
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
        $branch = isset($_REQUEST['branch']) ? $_REQUEST['branch'] : '';
        $diachi = isset($_REQUEST['dia_chi']) ? $_REQUEST['dia_chi'] : '';
        $data = array(
            'name' => $name,
            'branchId' => $branch,
            'address' => $diachi,
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