<?php
class classifyledger extends Controller{
    static private $funAdd = 0, $funEdit = 0, $funDel = 0;
    function __construct(){
        parent::__construct();
        $model = new model();
        $checkMenuRole = $model->checkMenuRole('classifyledger');
        if ($checkMenuRole == false)
            header('location:' . HOME);
        $funcs = $model->getFunctions('classifyledger');
      
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
        $this->view->render("classifyLedger/index");
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


    function update() {
        $id = $_REQUEST['id'];
        if($id == "" && self::$funAdd == 1 ) {
       
            $data = array(
                'name' => $_REQUEST['name'],
                'note' => $_REQUEST['note'],
                'status' => 1,
            );
            $result = $this->model->updateObj($id,$data); // vừa update vừa insert,
            if ($result) {
                $jsonObj['msg'] = "Thêm mới thành công";
                $jsonObj['success'] = true;
            } else {
                $jsonObj['msg'] = "Cập nhật không thành công";
                $jsonObj['success'] = false;
            }
        }
        else if($id > 0 && self::$funEdit == 1) {
     
            $data = array(
                'name' => $_REQUEST['name'],
                'note' => $_REQUEST['note'],
                'status' => 1,
            );
            $result = $this->model->updateObj($id,$data); // vừa update vừa insert,
            if ($result) {
                $jsonObj['msg'] = "Cập nhật thành công";
                $jsonObj['success'] = true;
            } else {
                $jsonObj['msg'] = "Cập nhật không thành công";
                $jsonObj['success'] = false;
            }
        }
        else {
            $jsonObj['msg'] = 'Bạn không có quyền sử dụng chức năng này';
            $jsonObj['success'] = false;
            echo json_encode($jsonObj);
            return false;
        }
    
    $jsonObj = json_encode($jsonObj);
    echo $jsonObj;
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