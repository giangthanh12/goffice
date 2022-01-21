<?php
class product extends Controller{
    function __construct(){
        parent::__construct();
    }

    function index(){

        require "layouts/header.php";
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


