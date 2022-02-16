<?php
class system extends Controller
{
    // private $_Data;
    static private $funAdd = 0, $funEdit = 0, $funDel = 0;
    function __construct()
    {
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

    function index()
    {
        require "layouts/header.php";
        $this->view->data = $this->model->listInfo();
        $this->view->funAdd = self::$funAdd;
        $this->view->funEdit = self::$funEdit;
        $this->view->funDel = self::$funDel;
        $this->view->render("system/index");
        require "layouts/footer.php";
    }

    // function listObj()
    // {
    //     $data = $this->model->listInfo();
    //     echo json_encode($data);
    // }

    // function loadInfo()
    // {
    //     $id = isset($_REQUEST['id'])?$_REQUEST['id']:0;
    //     $json = $this->model->getInfo($id);
    //     echo json_encode($json);
    // }

    function update()
    {
        $row = 0;
       
        for ($i =  1; $i <= 8; $i++) {
          

            if ($i == 7 || $i == 8) {
                if (isset($_FILES['gia_tri'.$i]['name']) && $_FILES['gia_tri'.$i]['name'] != '') {
                    $name = isset($_FILES['gia_tri'.$i]['name']) ? $_FILES['gia_tri'.$i]['name'] : '';
                    $dir   = ROOT_DIR . '/uploads/';
                    $fname = functions::convertname($name);
                    $file  = functions::uploadfile('gia_tri'.$i, $dir, $fname);
                    $value  = URLFILE . '/uploads/' . $file;
                    $data = array(
                        'value' => $value,
                    );
                    $this->model->updateInfo($i, $data);
                }
            } 
            else {
               
                $value = isset($_REQUEST['gia_tri' . $i]) ? $_REQUEST['gia_tri' . $i] : '';
                $data = array(
                    'value' => $value,
                );
                $this->model->updateInfo($i, $data);
            }
           
            $row++;
        }


        if ($row > 0) {
            $jsonObj['message'] = 'Cập nhật dữ liệu thành công';
            $jsonObj['code'] = 200;
        } else {
            $jsonObj['message'] = 'Cập nhật dữ liệu không thành công';
            $jsonObj['code'] = 401;
        }

        echo json_encode($jsonObj);
    }
}
