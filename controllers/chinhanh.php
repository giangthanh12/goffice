<?php
class chinhanh extends Controller{
    // private $_Data;
    static private $funAdd = 0, $funEdit = 0, $funDel = 0;
    function __construct(){
        parent::__construct();
        // $this->_Data = new Model();
        $model = new model();
        $checkMenuRole = $model->checkMenuRole('chinhanh');
        if ($checkMenuRole == false)
            header('location:' . HOME);
        $funcs = $model->getFunctions('chinhanh');
        
        foreach ($funcs as $item) {
            if ($item['function'] == 'add')
                self::$funAdd = 1;
            if ($item['function'] == 'edit')
                self::$funEdit = 1;
            if ($item['function'] == 'del')
                self::$funDel = 1;
        }

    }
    function getWorkspaces() {
        $json = $this->model->getWorkspaces();
        echo json_encode($json);
    }

    function index(){
        require "layouts/header.php";
        $this->view->funAdd = self::$funAdd;
        $this->view->funEdit = self::$funEdit;
        $this->view->funDel = self::$funDel;
        $this->view->render("chinhanh/index");
        require "layouts/footer.php";
    }

    function listdata()
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
        if (self::$funAdd == 0) {
            $jsonObj['msg'] = 'Bạn không có quyền sử dụng chức năng này';
            $jsonObj['success'] = false;
            echo json_encode($jsonObj);
            return false;
        }
        $name = isset($_REQUEST['name']) ? $_REQUEST['name'] : '';
        $address = isset($_REQUEST['address']) ? $_REQUEST['address'] : '';
        $status = 1;
        $workspaces = '';
        foreach ($_REQUEST['workspaces'] as $item) {
            $workspaces.= json_encode($item);
        }
        $workspaces = str_replace('""', '","',$workspaces);
        $data = array(
            'name' => $name,
            'workplaceIds'=>$workspaces,
            'address' => $address,
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
        $address = isset($_REQUEST['address']) ? $_REQUEST['address'] : '';
        $workspaces = '';
        foreach ($_REQUEST['workspaces'] as $item) {
            $workspaces.= json_encode($item);
        }
        $workspaces = str_replace('""', '","',$workspaces);
        $data = array(
            'name' => $name,
            'workplaceIds'=>$workspaces,
            'address' => $address
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