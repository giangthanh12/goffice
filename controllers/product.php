<?php
class product extends Controller{
    static private $funAdd = 0, $funEdit = 0, $funDel = 0;
    function __construct(){
        parent::__construct();
        $model = new model();
        $checkMenuRole = $model->checkMenuRole('product');
        if ($checkMenuRole == false)
            header('location:' . HOME);
        $funcs = $model->getFunctions('product');
      
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
        $this->view->render("product/index");
        require "layouts/footer.php";
        
    }
    function list()
    {
        $data=$this->model->listObj();
        echo json_encode($data); // này là một mảng
    }
    function getCustomer() {
        $json = $this->model->getCustomer();
        echo json_encode($json);
    }
    function getStaff() {
        $json = $this->model->getStaff();
        echo json_encode($json);
    }

    function loaddata()
    {  
        $id = isset($_REQUEST['id'])?$_REQUEST['id']:0;
        $json = $this->model->getdata($id);
        echo json_encode($json);
    }
    function add() {
        if (self::$funAdd == 0) {
            $jsonObj['msg'] = 'Bạn không có quyền sử dụng chức năng này';
            $jsonObj['success'] = false;
            echo json_encode($jsonObj);
            return false;
        }
        $name = isset($_REQUEST['name']) ? $_REQUEST['name'] : '';
        $supplier = isset($_REQUEST['supplier']) ? $_REQUEST['supplier'] : '';
        $unit = isset($_REQUEST['unit']) ? $_REQUEST['unit'] : '';
        $vat = isset($_REQUEST['vat']) ? $_REQUEST['vat'] : '';
        $type = isset($_REQUEST['type']) ? $_REQUEST['type'] : '';
        $price = isset($_REQUEST['price']) ? str_replace(',','',$_REQUEST['price']) : '';
       
        if(empty($name) && empty($supplier) && empty($unit) && empty($vat) &&  empty($price)) {
            $jsonObj['msg'] = 'Thông tin bạn nhập không chính xác';
            $jsonObj['success'] = false;
        } else {
            $data = array(
                'name' => $name,
                'supplier'=>$supplier,
                'unit' =>$unit,
                'type'=>$type,
                'vat' =>$vat,
                'price' =>$price,
                'status' =>1,
            );
           
            if($this->model->addObj($data)){
                $jsonObj['msg'] = 'Thêm dữ liệu thành công';
                $jsonObj['success'] = true;
            } else {
                $jsonObj['msg'] = 'Lỗi cập nhật database';
                $jsonObj['success'] = false;
            }
        }
   
        echo json_encode($jsonObj);
    }
    function update() {
        if (self::$funEdit == 0) {
            $jsonObj['msg'] = 'Bạn không có quyền sử dụng chức năng này';
            $jsonObj['success'] = false;
            echo json_encode($jsonObj);
            return false;
        }
        $id = isset($_GET['id']) ? $_GET['id']:'';
        $name = isset($_REQUEST['name']) ? $_REQUEST['name'] : '';
        $supplier = isset($_REQUEST['supplier']) ? $_REQUEST['supplier'] : '';
        $unit = isset($_REQUEST['unit']) ? $_REQUEST['unit'] : '';
        $vat = isset($_REQUEST['vat']) ? $_REQUEST['vat'] : '';
        $type = isset($_REQUEST['type']) ? $_REQUEST['type'] : '';
        $price = isset($_REQUEST['price']) ? str_replace(',','',$_REQUEST['price']) : '';
       
        if(empty($name) && empty($supplier) && empty($unit) && empty($vat) &&  empty($price)) {
            $jsonObj['msg'] = 'Thông tin bạn nhập không chính xác';
            $jsonObj['success'] = false;
        } else {
            $data = array(
                'name' => $name,
                'supplier'=>$supplier,
                'unit' =>$unit,
                'type'=>$type,
                'vat' =>$vat,
                'price' =>$price,
                'status' =>1,
            );
           
            if($this->model->updateObj($id, $data)){
                $jsonObj['msg'] = 'Cập nhật dữ liệu thành công';
                $jsonObj['success'] = true;
            } else {
                $jsonObj['msg'] = 'Lỗi cập nhật database';
                $jsonObj['success'] = false;
            }
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


