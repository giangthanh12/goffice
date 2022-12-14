<?php
class task_status extends Controller{
    static private $funcs, $funAdd = 0, $funEdit = 0, $funDel = 0;
    function __construct(){
        parent::__construct();
        $model = new model();
        $checkMenuRole = $model->checkMenuRole('task_status');
        if ($checkMenuRole == false)
        header('location:' . HOME);
        $funcs = $model->getFunctions('task_status'); 
        foreach ($funcs as $item) {
            if ($item['function'] == 'add')
                self::$funAdd = 1;
            if ($item['function'] == 'loaddata')
                self::$funEdit = 1;
            if ($item['function'] == 'del')
                self::$funDel = 1;
        }
        self::$funcs = $funcs;
    }

    function index(){
        $this->view->funs  = self::$funcs;
        $this->view->funAdd = self::$funAdd;
        $this->view->funEdit = self::$funEdit;
        $this->view->funDel = self::$funDel;
        require "layouts/header.php";
        $this->view->render("task_status/index");
        require "layouts/footer.php";
    }


    function list()
    {
            $data=$this->model->listObj();
            echo json_encode($data); // này là một mảng
    }
  
    function add()
    {
        if(functions::checkFuns(self::$funcs,'add')) {
            $name = isset($_REQUEST['name']) ? $_REQUEST['name'] : '';
            $color = isset($_REQUEST['color']) ? $_REQUEST['color'] : '';
            $status = isset($_REQUEST['status']) ? $_REQUEST['status'] : 1;
            // if(empty($name) || empty($color)) {
            //     $jsonObj['msg'] = 'Thông tin bạn nhập không chính xác';
            //     $jsonObj['success'] = false;
            // }
            // else {
                $data = array(
                    'name' => $name,
                    'color'=>$color,
                    'status' =>$status
                );
                if($this->model->addObj($data)){
                    $jsonObj['msg'] = 'Cập nhật dữ liệu thành công';
                    $jsonObj['success'] = true;
                } else {
                    $jsonObj['msg'] = 'Lỗi cập nhật database';
                    $jsonObj['success'] = false;
                }
            }
        // }
        else {
            $jsonObj['msg'] = 'Không có quyền truy cập';
            $jsonObj['success'] = false;
        }
        echo json_encode($jsonObj);
    }


    function loaddata()
    {  
        $id = isset($_REQUEST['id'])?$_REQUEST['id']:0;
        $json = $this->model->getdata($id);
        echo json_encode($json);
    }
    function update() {
        if(functions::checkFuns(self::$funcs,'loaddata')) {
        $id = isset($_GET['id']) ? $_GET['id']:'';
        $name = isset($_REQUEST['name']) ? $_REQUEST['name'] : '';
        $color = isset($_REQUEST['color']) ? $_REQUEST['color'] : '';
        $status = isset($_REQUEST['status']) ? $_REQUEST['status'] : 1;
        if(empty($name) || empty($color) || empty($id)) {
            $jsonObj['msg'] = 'Thông tin bạn nhập không chính xác';
            $jsonObj['success'] = false;
        } else {
            $data = array(
                'name' => $name,
                'color'=>$color,
                'status' =>$status
            );
            if($this->model->updateObj($id, $data)){
                $jsonObj['msg'] = 'Cập nhật dữ liệu thành công';
                $jsonObj['success'] = true;
            } else {
                $jsonObj['msg'] = 'Lỗi cập nhật database bhxh'.$id;
                $jsonObj['success'] = false;
            }
        }
    }
    else {
        $jsonObj['msg'] = 'Không có quyền truy cập';
        $jsonObj['success'] = false;
    }
        echo json_encode($jsonObj);
    }
    function del()
    {
        if(functions::checkFuns(self::$funcs,'loaddata')) {
            $id = $_REQUEST['id'];
            $data = ['status'=>0];
            if($this->model->delObj($id,$data)){
                $jsonObj['msg'] = "Xóa dữ liệu thành công";
                $jsonObj['success'] = true;
            } else {
                $jsonObj['msg'] = "Xóa dữ liệu không thành công";
                $jsonObj['success'] = false;
            }
        }
        else {
            $jsonObj['msg'] = 'Không có quyền truy cập';
            $jsonObj['success'] = false;
        }
        echo json_encode($jsonObj);
    }
}
?>


