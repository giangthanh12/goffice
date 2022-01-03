<?php
class project_levels extends Controller{
    function __construct(){
        parent::__construct();
    }

    function index(){
        require "layouts/header.php";
        $this->view->render("project_levels/index");
        require "layouts/footer.php";
    }


    function list()
    {
            $data=$this->model->listObj();
            echo json_encode($data); // này là một mảng
    }
    function combo(){
        $datatable['data']=$this->model->get_data_combo();
        foreach ($datatable['data'] AS $key=>$row) {

            if($row['level']>0)
               $datatable['data'][$key]['text']='---'.$datatable['data'][$key]['text'];
        }

        echo json_encode($datatable['data']);
    }
    function add()
    {
        $name = isset($_REQUEST['name']) ? $_REQUEST['name'] : '';
        $color = isset($_REQUEST['color']) ? $_REQUEST['color'] : '';
        $status = isset($_REQUEST['status']) ? $_REQUEST['status'] : 1;
        if(empty($name) || empty($color)) {
            $jsonObj['msg'] = 'Thông tin bạn nhập không chính xác';
            $jsonObj['success'] = false;
        }
        else {
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
        echo json_encode($jsonObj);
    }


    function loaddata()
    {
        $id = isset($_REQUEST['id'])?$_REQUEST['id']:0;
        $json = $this->model->getdata($id);
        echo json_encode($json);
    }
    function update() {
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


