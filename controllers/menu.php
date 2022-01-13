<?php
class menu extends Controller{
    function __construct(){
        parent::__construct();
        if($_SESSION['user']['classify']>1)
            header('location'.HOME);
    }

    function index(){
     
       
        require "layouts/header.php";
        $this->view->render("menu/index");
        require "layouts/footer.php";
    }


    function list()
    {

            $datatable['data']=$this->model->listObj();
            foreach ($datatable['data'] AS $key=>$row) {
                if($row['level']>0) {
                    $strLv = '';
                    for($i=0;$i<$row['level'];$i++)
                        $strLv .='---';
                    $datatable['data'][$key]['name'] = $strLv  .'&nbsp;'. $datatable['data'][$key]['name'];
                }
            }
        
       
       echo json_encode($datatable); // này là một mảng
    }
    function combo(){
        $type = isset($_REQUEST['type'])?$_REQUEST['type']:1;
        $datatable['data']=$this->model->get_data_combo($type);
        foreach ($datatable['data'] AS $key=>$row) {
            if($row['level']>0) {
                $strLv = '';
                for($i=0;$i<$row['level'];$i++)
                    $strLv .='---';
                $datatable['data'][$key]['text'] = $strLv .'&nbsp;'. $datatable['data'][$key]['text'];
            }
        }

        echo json_encode($datatable['data']); 
    }
    function add()
    {
        if(isset($_REQUEST['name']) && $_REQUEST['name']!='') {
            $data = array(
                'name' => isset($_REQUEST['name']) ? $_REQUEST['name'] : '',
                'link' => isset($_REQUEST['link']) ? $_REQUEST['link'] : '',
                'icon' => isset($_REQUEST['icon']) ? $_REQUEST['icon'] : '',
                'parentId' => !empty($_REQUEST['parentId']) ? $_REQUEST['parentId'] : 0,
                'sortOrder' => !empty($_REQUEST['sortOrder']) ? $_REQUEST['sortOrder'] : 0,
                'type' => !empty($_REQUEST['type']) ? $_REQUEST['type'] : 1,
                'active' => isset($_REQUEST['active']) ? $_REQUEST['active'] : 1
            );
            if ($this->model->addObj($data)) {
                $jsonObj['message'] = 'Cập nhật dữ liệu thành công';
                $jsonObj['code'] = 200;
            } else {
                $jsonObj['message'] = 'Lỗi cập nhật database';
                $jsonObj['code'] = 401;
            }
        }else{
            $jsonObj['message'] = 'Bạn chưa nhập tên menu';
            $jsonObj['code'] = 400;
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
        if($id>0 && $_REQUEST['name']!='') {
            $data = array(
                'name' => isset($_REQUEST['name']) ? $_REQUEST['name'] : '',
                'link' => isset($_REQUEST['link']) ? $_REQUEST['link'] : '',
                'icon' => isset($_REQUEST['icon']) ? $_REQUEST['icon'] : '',
                'parentId' => !empty($_REQUEST['parentId']) ? $_REQUEST['parentId'] : 0,
                'sortOrder' => !empty($_REQUEST['sortOrder']) ? $_REQUEST['sortOrder'] : 0,
                'type' => !empty($_REQUEST['type']) ? $_REQUEST['type'] : 1,
                'active' => isset($_REQUEST['active']) ? $_REQUEST['active'] : 1,

            );
            if ($this->model->updateObj($id, $data)) {
                $jsonObj['message'] = 'Cập nhật dữ liệu thành công';
                $jsonObj['code'] = 200;
            } else {
                $jsonObj['message'] = 'Lỗi cập nhật database';
                $jsonObj['code'] = 401;
            }
        }else{
            $jsonObj['message'] = 'Bạn chưa nhập tên menu';
            $jsonObj['code'] = 402;
        }
        echo json_encode($jsonObj);
    }
    function del()
    {
        $id = $_REQUEST['id'];
        $data = ['status'=>0];
        if($this->model->delObj($id,$data)){
            $jsonObj['message'] = 'Xóa dữ liệu thành công';
            $jsonObj['code'] = 200;
        } else {
            $jsonObj['message'] = 'Xóa dữ liệu không thành công';
            $jsonObj['code'] = 401;
        } 
        echo json_encode($jsonObj);
    }
}
?>