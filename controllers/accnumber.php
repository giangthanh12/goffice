<?php
class accnumber extends Controller{
    function __construct(){
        parent::__construct();
    }

    function index(){
        require "layouts/header.php";
        $this->view->render("accnumber/index");
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
        if($id == "") {
            $data = array(
                'name' => $_REQUEST['name'],
                'account' => $_REQUEST['account'],
                'type' => $_REQUEST['type'],
                'status' => $_REQUEST['status'],
            );
            $result = $this->model->updateObj($id,$data); // vừa update vừa insert,
        }
        else if($id > 0) {
             $data = array(
                'name' => $_REQUEST['name'],
                'account' => $_REQUEST['account'],
                'type' => $_REQUEST['type'],
                'status' => $_REQUEST['status'],
            );
            $result = $this->model->updateObj($id,$data); // vừa update vừa insert,
        }
        else {
            $result = false;
        }
      if ($result) {
        $jsonObj['msg'] = "Cập nhật thành công";
        $jsonObj['success'] = true;
    } else {
        $jsonObj['msg'] = "Cập nhật không thành công";
        $jsonObj['success'] = false;
    }
    $jsonObj = json_encode($jsonObj);
    echo $jsonObj;
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