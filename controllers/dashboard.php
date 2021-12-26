<?php
class dashboard extends Controller{
    function __construct(){
        parent::__construct();
    }
    function index(){
        require "layouts/header.php";
        $this->view->render("dashboard/index");
        require "layouts/footer.php";
    }

    function getdata(){
        $json = $this->model->getdata();
        // $json = array('thongbao'=>array('nguoigui'=>'zz', 'name'=>'xxx'),'tinmoi'=>25);
        echo json_encode($json);
    }

    function activeuser(){
        $this->model->activeuser();
        echo ('OK');
    }

    function deactiveuser(){
        $this->model->deactiveuser($id);
        echo ('OK');
    }

    function getactive(){
        $users = implode(",",$_REQUEST['users']);
        $temp = $this->model->getactive($users);
        echo json_encode($temp);
    }

    function del(){
        $id = $_REQUEST['id'];
        $temp = $this->model->delObj($id);
        if($temp){
            $jsonObj['msg'] = "Xóa dữ liệu thành công";
            $jsonObj['success'] = true;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
            $jsonObj['msg'] = "Xóa dữ liệu không thành công";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }
        $this->view->render("dashboard/del");
    }
}
?>
