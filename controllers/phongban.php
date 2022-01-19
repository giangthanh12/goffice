<?php
class phongban extends Controller{
    private $funs;
    function __construct(){
        parent::__construct();
        $model = new model();
        $checkMenuRole = $model->checkMenuRole('phongban');
        if($checkMenuRole==false)
            header('location:'.HOME);
    }

    function index(){
        $this->view->funs = $funs = $this->model->getFunctions('phongban');
        require "layouts/header.php";
        $this->view->render("phongban/index");
        require "layouts/footer.php";
    }
    function getFunctions(){
        $funs = $this->model->getFunctions('phongban');
        echo json_encode($funs);
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

    function add()
    {
        $name = isset($_REQUEST['name']) ? $_REQUEST['name'] : '';
        $description = isset($_REQUEST['description']) ? $_REQUEST['description'] : '';
        $status = 1;
        $data = array(
            'name' => $name,
            'description' => $description,
            'status' => $status
        );
        if($this->model->addObj($data)){
            $jsonObj['message'] = 'Cập nhật dữ liệu thành công';
            $jsonObj['code'] = 200;
        } else {
            $jsonObj['message'] = 'Cập nhật dữ liệu không thành công';
            $jsonObj['code'] = 401;
        }
        echo json_encode($jsonObj);
    }

    function update()
    {
        $id = $_REQUEST['id'];
        $name = isset($_REQUEST['name']) ? $_REQUEST['name'] : '';
        $description = isset($_REQUEST['description']) ? $_REQUEST['description'] : '';
        $data = array(
            'name' => $name,
            'description' => $description
        );
        if($this->model->updateObj($id, $data)){
            $jsonObj['message'] = 'Cập nhật dữ liệu thành công';
            $jsonObj['code'] = 200;
        } else {
            $jsonObj['message'] = 'Cập nhật dữ liệu không thành công';
            $jsonObj['code'] = 401;
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