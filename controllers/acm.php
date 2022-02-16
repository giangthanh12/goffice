<?php
class acm extends Controller{
    static private $funAdd = 0, $funEdit = 0, $funDel = 0;
    function __construct(){
        parent::__construct();
        $model = new model();
        $checkMenuRole = $model->checkMenuRole('acm');
        if ($checkMenuRole == false)
            header('location:' . HOME);
        $funcs = $model->getFunctions('acm');
      
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

   function totalAccountBalance() {
       // lấy thông tin tài khoản
        $accounts = $this->model->taikhoan();
        foreach($accounts as $key=>$account) {
            $sodutk = $this->model->getSodutk($account['id']);
            $accounts[$key]['sodu'] = $sodutk;
        }
        echo json_encode($accounts);
   }

   

    function update() {
        $id = $_REQUEST['id'];
        if($id == "" && self::$funAdd == 1) {
           $sodutk = $this->model->getSodutk( $_REQUEST['account']);
          
           if(str_replace(',','',$_REQUEST['asset']) > $sodutk && $_REQUEST['action'] == 2) {
            $jsonObj['msg'] = "Số dư tài khoản không đủ";
            $jsonObj['success'] = false;
            echo json_encode($jsonObj);
            return false;
           }
            $data = array(
                'content' => $_REQUEST['content'],
                'customerId' => $_REQUEST['customer'],
                'staffId' => $_SESSION['user']['staffId'],
                'accnumber' => $_REQUEST['account'],
                'classify' => $_REQUEST['classify'],
                'type' => $_REQUEST['type'],
                'asset' => $_REQUEST['asset'],
                'note' => $_REQUEST['note'],
                'authorized' => $_REQUEST['authorized'],
                'contractId' => $_REQUEST['contract'],
                'status' => $_REQUEST['status'],
                'action'=>$_REQUEST['action']
            );
            $dateTime = date("Y-m-d",strtotime($_REQUEST['dateTime']));
            $time_now = date('H:i:s', time());
            $data['dateTime'] = $dateTime . " " . $time_now;

            $result = $this->model->updateObj($id,$data); // vừa update vừa insert,
            if ($result) {
                $jsonObj['msg'] = "Thêm mới thành công";
                $jsonObj['success'] = true;
            } else {
                $jsonObj['msg'] = "Cập nhật không thành công";
                $jsonObj['success'] = false;
            }
        }
        else if($id > 0 && self::$funEdit == 1) {
            $sodutk = $this->model->getSodutk( $_REQUEST['account']);
                if(str_replace(',','',$_REQUEST['asset']) > $sodutk && $_REQUEST['action'] == 2) {
                    $jsonObj['msg'] = "Số dư tài khoản không đủ";
                    $jsonObj['success'] = false;
                    echo json_encode($jsonObj);
                    return false;
                }
            $data = array(
                'content' => $_REQUEST['content'],
                'customerId' => $_REQUEST['customer'],
                'staffId' => $_SESSION['user']['staffId'],
                'accnumber' => $_REQUEST['account'],
                'classify' => $_REQUEST['classify'],
                'type' => $_REQUEST['type'],
                'asset' => $_REQUEST['asset'],
                'note' => $_REQUEST['note'],
                'authorized' => $_REQUEST['authorized'],
                'contractId' => $_REQUEST['contract'],
                'status' => $_REQUEST['status'],
                'action'=>$_REQUEST['action']
            );
            $dateTime = date("Y-m-d",strtotime($_REQUEST['dateTime']));
            $time_now = date('H:i:s', time());
            $data['dateTime'] = $dateTime . " " . $time_now;
            
            $result = $this->model->updateObj($id,$data); // vừa update vừa insert,
            if ($result) {
                $jsonObj['msg'] = "Thêm mới thành công";
                $jsonObj['success'] = true;
            } else {
                $jsonObj['msg'] = "Cập nhật không thành công";
                $jsonObj['success'] = false;
            }
        }
        else {
            $jsonObj['msg'] = 'Bạn không có quyền sử dụng chức năng này';
            $jsonObj['success'] = false;
            echo json_encode($jsonObj);
            return false;
        }
    $jsonObj = json_encode($jsonObj);
    echo $jsonObj;
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

    function hopdong() {
        $data = $this->model->contract();
        echo json_encode($data);
    }

    function getClassify() {
        $type = isset($_REQUEST['type']) ? $_REQUEST['type'] : 1;
        $data = $this->model->getClassify($type);
        echo json_encode($data);
    }
}
?>