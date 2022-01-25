<?php
class acm extends Controller{
    function __construct(){
        parent::__construct();
    }

    function index(){
        require "layouts/header.php";
        $this->view->render("acm/index");
        require "layouts/footer.php";
    }

    function list()
    {
        $data = $this->model->listObj();
        echo json_encode($data);
    }


    function loaddata()
    {
        $id=isset($_REQUEST['id'])?$_REQUEST['id']:0;
        $json = $this->model->getdata($id);
        echo json_encode($json);
    }

    function add()
    {
        $data = array(
            'content' => $_REQUEST['content'],
            'customerId' => $_REQUEST['customer'],
            'staffId' => $_REQUEST['staff'],
            'accnumber' => $_REQUEST['account'],
            'classify' => $_REQUEST['classify'],
            'type' => $_REQUEST['type'],
            'asset' => $_REQUEST['asset'],
            'note' => $_REQUEST['note'],
            'status' => 1
        );
        $time_now = date('H:i:s', time());
        $data['dateTime'] = $_REQUEST['dateTime'] . " " . $time_now;
        if($this->model->addObj($data)){
            var_dump($data['dateTime']);
            $jsonObj['msg'] = 'Cập nhật dữ liệu thành công';
            $jsonObj['success'] = true;
        } else {
            var_dump($data['dateTime']);
            $jsonObj['msg'] = 'Lỗi cập nhật database';
            $jsonObj['success'] = false;
        }
        echo json_encode($jsonObj);
    }

    // function update()
    // {
    //     $id = $_REQUEST['id'];
    //     if($id == "") {
    //         $data = array(
    //             'content' => $_REQUEST['content'],
    //             'customerId' => $_REQUEST['customer'],
    //             'staffId' => $_REQUEST['staff'],
    //             'accnumber' => $_REQUEST['account'],
    //             'classify' => $_REQUEST['classify'],
    //             'type' => $_REQUEST['type'],
    //             'asset' => $_REQUEST['asset'],
    //             'note' => $_REQUEST['note'],
    //             'authorized' => $_REQUEST['authorized'],
    //             'contract' => $_REQUEST['contract'],
    //             'status' => $_REQUEST['status'],
    //         );
    //         $dateTime = substr($_REQUEST['dateTime'], 0, 10);
    //         $time_now = date('H:i:s', time());
    //         $data['dateTime'] = $dateTime . " " . $time_now;
            
    //         if($this->model->updateObj($id, $data)){
    //             $jsonObj['msg'] = 'Cập nhật dữ liệu thành công';
    //             $jsonObj['success'] = true;
    //         } else {
    //             $jsonObj['msg'] = 'Lỗi cập nhật database';
    //             $jsonObj['success'] = false;
    //         }
    //     } else if($id > 0) {

    //     }
        
       
    //     echo json_encode($jsonObj);
    // }

    function update() {
        $id = $_REQUEST['id'];
        if($id == "") {
            $data = array(
                'content' => $_REQUEST['content'],
                'customerId' => $_REQUEST['customer'],
                'staffId' => $_REQUEST['staff'],
                'accnumber' => $_REQUEST['account'],
                'classify' => $_REQUEST['classify'],
                'type' => $_REQUEST['type'],
                'asset' => $_REQUEST['asset'],
                'note' => $_REQUEST['note'],
                'authorized' => $_REQUEST['authorized'],
                'contractId' => $_REQUEST['contract'],
                'status' => $_REQUEST['status'],
            );
            $dateTime = date("Y-m-d",strtotime(str_replace('/', '-',$_REQUEST['dateTime'])));
            $time_now = date('H:i:s', time());
            $data['dateTime'] = $dateTime . " " . $time_now;

            $result = $this->model->updateObj($id,$data); // vừa update vừa insert,
        }
        else if($id > 0) {
            $data = array(
                'content' => $_REQUEST['content'],
                'customerId' => $_REQUEST['customer'],
                'staffId' => $_REQUEST['staff'],
                'accnumber' => $_REQUEST['account'],
                'classify' => $_REQUEST['classify'],
                'type' => $_REQUEST['type'],
                'asset' => $_REQUEST['asset'],
                'note' => $_REQUEST['note'],
                'authorized' => $_REQUEST['authorized'],
                'contractId' => $_REQUEST['contract'],
                'status' => $_REQUEST['status'],
            );
            $dateTime = date("Y-m-d",strtotime(str_replace('/', '-',$_REQUEST['dateTime'])));
            $time_now = date('H:i:s', time());
            $data['dateTime'] = $dateTime . " " . $time_now;
            
            $result = $this->model->updateObj($id,$data); // vừa update vừa insert,
        }
        else {
            $result = false;
        }
      if ($result) {
        $jsonObj['msg'] = "Cập nhật thành công";
        $jsonObj['success'] = true;
    } else {
        $jsonObj['msg'] = "Cập nhật không thành công";
        $jsonObj['success'] = false;
    }
    $jsonObj = json_encode($jsonObj);
    echo $jsonObj;
    }

    // function chotsodu()
    // {
    //     if($this->model->updateChotsodu()){
    //         $jsonObj['msg'] = 'Cập nhật dữ liệu thành công';
    //         $jsonObj['success'] = true;
    //     } else {
    //         $jsonObj['msg'] = 'Lỗi cập nhật database';
    //         $jsonObj['success'] = false;
    //     }
    //     echo json_encode($jsonObj);
    // }

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


    function khachhang() {
        $data = $this->model->khachhang();
        echo json_encode($data);
    }
    function taikhoan() {
        $data = $this->model->taikhoan();
        echo json_encode($data);
    }
   
    function nhanvien() {
        $data = $this->model->nhanvien();
        echo json_encode($data);
    }

    function contract() {
        $data = $this->model->contract();
        echo json_encode($data);
    }
}
?>