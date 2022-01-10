<?php
class transaction extends Controller{
    function __construct(){
        parent::__construct();
    }

    function index(){

        require "layouts/header.php";
        $this->view->render("transaction/index");
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
    function update() {
    
        $id = isset($_GET['id']) ? $_GET['id']:'';
        $name = isset($_REQUEST['name']) ? $_REQUEST['name'] : '';
        $customerId = isset($_REQUEST['customerId']) ? $_REQUEST['customerId'] : '';
        $performerId = isset($_REQUEST['performerId']) ? $_REQUEST['performerId'] : '';
        $asset = isset($_REQUEST['asset']) ? $_REQUEST['asset'] : '';
        $type = isset($_REQUEST['type']) ? $_REQUEST['type'] : '';
        $date = date("Y-m-d H:i",strtotime(str_replace('/', '-',$_REQUEST['date'])));
        $description = isset($_REQUEST['description']) ? $_REQUEST['description'] : '';
        $status = isset($_REQUEST['status']) ? $_REQUEST['status'] : 1;
        if(empty($name) && empty($customerId) && empty($performerId) && empty($asset) &&  empty($type) && empty($date)) {
            $jsonObj['msg'] = 'Thông tin bạn nhập không chính xác';
            $jsonObj['success'] = false;
        } else {
            $data = array(
                'name' => $name,
                'customerId'=>$customerId,
                'performerId' =>$performerId,
                'asset' =>$asset,
                'type' =>$type,
                'dateTime' =>$date,
                'description'=>$description,
                'status' =>$status,
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
            $data = ['status'=>2];
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


