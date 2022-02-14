<?php
class system extends Controller
{
    // private $_Data;
    static private $funAdd = 0, $funEdit = 0, $funDel = 0;
    function __construct(){
        parent::__construct();
        // $this->_Data = new Model();
        $model = new model();
        $checkMenuRole = $model->checkMenuRole('system');
        if ($checkMenuRole == false)
            header('location:' . HOME);
        $funcs = $model->getFunctions('system');
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
        $this->view->render("system/index");
        require "layouts/footer.php";
    }

    function listObj()
    {
        $data = $this->model->listInfo();
        echo json_encode($data);
    }

    function loadInfo()
    {
        $id = isset($_REQUEST['id'])?$_REQUEST['id']:0;
        $json = $this->model->getInfo($id);
        echo json_encode($json);
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
        $value = isset($_REQUEST['gia_tri']) ? $_REQUEST['gia_tri'] : '';
        if (isset($_FILES['file']['name']) && ($_FILES['file']['name'] != '')) {
            $dir   = ROOT_DIR . '/uploads/';
            $fname = functions::convertname($name);
            $file  = functions::uploadfile('file', $dir, $fname);
            $value  = URLFILE . '/uploads/' . $file;
       } 
            $data = array(
            'name' => $name,
            'value' => $value,
        );

        if($this->model->updateInfo($id, $data)){
            $jsonObj['msg'] = 'Cập nhật dữ liệu thành công';
            $jsonObj['success'] = true;
        } else {
            $jsonObj['msg'] = 'Cập nhật dữ liệu không thành công';
            $jsonObj['success'] = false;
        }
        
        echo json_encode($jsonObj);
    }
}
?>
