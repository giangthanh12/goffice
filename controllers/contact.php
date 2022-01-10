<?php
class contact extends Controller{

    function __construct(){
        parent::__construct();
     
    }

    function index(){
  
        require "layouts/header.php";
        $this->view->render("contact/index");
        require "layouts/footer.php";
    }


    function list()
    {
            $data=$this->model->listObj();
            echo json_encode($data); // này là một mảng
    }


    function getCustomer() {
        $jsonObj = $this->model->getCustomer();
        echo json_encode($jsonObj);
    }
  
    function add()
    {
            $name = !empty($_REQUEST['name']) ? $_REQUEST['name'] : '';
            $customerId = !empty($_REQUEST['customerId']) ? $_REQUEST['customerId'] : '';
            $phoneNumber = !empty($_REQUEST['phoneNumber']) ? $_REQUEST['phoneNumber'] : '';
            $email = !empty($_REQUEST['email']) ? $_REQUEST['email'] : '';
            $facebook = !empty($_REQUEST['facebook']) ? $_REQUEST['facebook'] : '';
            $zalo = !empty($_REQUEST['zalo']) ? $_REQUEST['zalo'] : '';
            $note = !empty($_REQUEST['note']) ? $_REQUEST['note'] : '';
            $status = !empty($_REQUEST['status']) ? $_REQUEST['status'] : 1;
            if(empty($name) && empty($customerId) && empty($phoneNumber) && empty($email) ) {
                $jsonObj['msg'] = 'Thông tin bạn nhập không chính xác';
                $jsonObj['success'] = false;
            }
            else {
                $data = array(
                    'name' => $name,
                    'customerId'=>$customerId,
                    'phoneNumber' =>$phoneNumber,
                    'email'=>$email,
                    'facebook' =>$facebook,
                    'zalo'=>$zalo,
                    'note' =>$note,
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
  
        $id = isset($_GET['id']) ? $_GET['id']:0;
        $name = !empty($_REQUEST['name']) ? $_REQUEST['name'] : '';
            $customerId = !empty($_REQUEST['customerId']) ? $_REQUEST['customerId'] : '';
            $phoneNumber = !empty($_REQUEST['phoneNumber']) ? $_REQUEST['phoneNumber'] : '';
            $email = !empty($_REQUEST['email']) ? $_REQUEST['email'] : '';
            $facebook = !empty($_REQUEST['facebook']) ? $_REQUEST['facebook'] : '';
            $zalo = !empty($_REQUEST['zalo']) ? $_REQUEST['zalo'] : '';
            $note = !empty($_REQUEST['note']) ? $_REQUEST['note'] : '';
            $status = !empty($_REQUEST['status']) ? $_REQUEST['status'] : 1;
            if(empty($name) && empty($customerId) && empty($phoneNumber) && empty($email) ) {
                $jsonObj['msg'] = 'Thông tin bạn nhập không chính xác';
                $jsonObj['success'] = false;
            } else {
            $data = array(
                'name' => $name,
                    'customerId'=>$customerId,
                    'phoneNumber' =>$phoneNumber,
                    'email'=>$email,
                    'facebook' =>$facebook,
                    'zalo'=>$zalo,
                    'note' =>$note,
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


