<?php
class function_menu extends Controller{
    function __construct(){
        parent::__construct();
        if($_SESSION['user']['classify']>1)
            header('location'.HOME);
    }

    function index(){


        require "layouts/header.php";
        $this->view->render("functions/index");
        require "layouts/footer.php";
    }


    function list()
    {

        $datatable['data']=$this->model->listObj();
        foreach ($datatable['data'] AS $key=>$row) {

            if($row['level']>0)
                $datatable['data'][$key]['name']='---'.$datatable['data'][$key]['name'];
        }
        echo json_encode($datatable); // này là một mảng
    }
    function getFunctionById() {
        $id = isset($_REQUEST['menuId'])?$_REQUEST['menuId']:0;
        $datatable['data'] = $this->model->getFunctionById($id);

        foreach ($datatable['data'] AS $key=>$row) {

            if($row['level']>0)
                $datatable['data'][$key]['text']='---'.$datatable['data'][$key]['text'];
        }


        echo json_encode($datatable['data']); // này là một mảng
    }

    function add()
    {

        if(isset($_REQUEST['name']) && $_REQUEST['name']!='') {
            $data = array(
                'name' => isset($_REQUEST['name']) ? $_REQUEST['name'] : '',
                'menuid' => isset($_REQUEST['menuid']) ? $_REQUEST['menuid'] : 0,
                'icon' => isset($_REQUEST['icon']) ? $_REQUEST['icon'] : '',
                'function' => isset($_REQUEST['function']) ? $_REQUEST['function'] : '',
                'parentid' => !empty($_REQUEST['parentid']) ? $_REQUEST['parentid'] : 0,
                'sortOrder' => !empty($_REQUEST['sortOrder']) ? $_REQUEST['sortOrder'] : 0,
                'color' => $_REQUEST['color'],
                'active' => 1,
                'type' => isset($_REQUEST['type']) ? $_REQUEST['type'] : 1,
            );

            if ($this->model->addObj($data)) {
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
        $id = isset($_GET['id']) ? $_GET['id']:0;
        if(isset($_REQUEST['name']) && $_REQUEST['name']!='') {
            $data = array(
                'name' => isset($_REQUEST['name']) ? $_REQUEST['name'] : '',
                'menuid' => isset($_REQUEST['menuid']) ? $_REQUEST['menuid'] : 0,
                'icon' => isset($_REQUEST['icon']) ? $_REQUEST['icon'] : '',
                'function' => isset($_REQUEST['function']) ? $_REQUEST['function'] : '',
                'parentid' => !empty($_REQUEST['parentid']) ? $_REQUEST['parentid'] : 0,
                'sortOrder' => !empty($_REQUEST['sortOrder']) ? $_REQUEST['sortOrder'] : 0,
                'color' => $_REQUEST['color'],
                'type' => $_REQUEST['type'],
                'active' => $_REQUEST['active']
            );
            if ($this->model->updateObj($id, $data)) {
                $jsonObj['msg'] = 'Cập nhật dữ liệu thành công';
                $jsonObj['success'] = true;
            } else {
                $jsonObj['msg'] = 'Lỗi cập nhật database bhxh' . $id;
                $jsonObj['success'] = false;
            }
            echo json_encode($jsonObj);
        }
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