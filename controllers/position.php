<?php
class position extends Controller{
    static private $funAdd = 0, $funEdit = 0, $funDel = 0;
    function __construct(){
        parent::__construct();
        $model = new model();
        $checkMenuRole = $model->checkMenuRole('position');
        if ($checkMenuRole == false)
            header('location:' . HOME);
        $funcs = $model->getFunctions('position');
      
        foreach ($funcs as $item) {
            if ($item['function'] == 'add')
                self::$funAdd = 1;
            if ($item['function'] == 'edit')
                self::$funEdit = 1;
            if ($item['function'] == 'del')
                self::$funDel = 1;
        }
    }

    function index(){
        require "layouts/header.php";
        $this->view->funAdd = self::$funAdd;
        $this->view->funEdit = self::$funEdit;
        $this->view->funDel = self::$funDel;
        $this->view->render("position/index");
        require "layouts/footer.php";
    }

    function combo(){
        $phongban = isset($_REQUEST['phongban']) ? $_REQUEST['phongban'] : 0;
        $json = $this->model->get_data_combo($phongban);
        echo json_encode($json);
    }

    function listdata()
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
        if (self::$funAdd == 0) {
            $jsonObj['msg'] = 'Bạn không có quyền sử dụng chức năng này';
            $jsonObj['success'] = false;
            echo json_encode($jsonObj);
            return false;
        }
        $name = isset($_REQUEST['name']) ? $_REQUEST['name'] : '';
        $description = isset($_REQUEST['description']) ? $_REQUEST['description'] : '';
        $departmentId = isset($_REQUEST['departmentId']) ? $_REQUEST['departmentId'] : 1;
        $status = 1;
        $data = array(
            'name' => $name,
            'departmentId'=>$departmentId,
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
        if (self::$funEdit == 0) {
            $jsonObj['msg'] = 'Bạn không có quyền sử dụng chức năng này';
            $jsonObj['success'] = false;
            echo json_encode($jsonObj);
            return false;
        }
        $id = $_REQUEST['id'];
        $name = isset($_REQUEST['name']) ? $_REQUEST['name'] : '';
        $description = isset($_REQUEST['description']) ? $_REQUEST['description'] : '';
        $departmentId = isset($_REQUEST['departmentId']) ? $_REQUEST['departmentId'] : 1;
        $data = array(
            'name' => $name,
            'departmentId'=>$departmentId,
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
        if (self::$funDel == 0) {
            $jsonObj['msg'] = 'Bạn không có quyền sử dụng chức năng này';
            $jsonObj['success'] = false;
            echo json_encode($jsonObj);
            return false;
        }
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