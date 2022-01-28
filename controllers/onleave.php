<?php
class onleave extends Controller
{
    static private $funAdd = 0, $funConfirm = 0, $funDel = 0;
    function __construct()
    {
        parent::__construct();
        $model = new model();
        $checkMenuRole = $model->checkMenuRole('onleave');
        if ($checkMenuRole == false)
            header('location:' . HOME);
        $funcs = $model->getFunctions('onleave');
      
        foreach ($funcs as $item) {
            if ($item['function'] == 'add')
                self::$funAdd = 1;
            if ($item['function'] == 'confirm')
                self::$funConfirm = 1;
            if ($item['function'] == 'del')
                self::$funDel = 1;
        }
    }

    function index(){
        require "layouts/header.php";
        $status = isset($_REQUEST['status']) ? $_REQUEST['status'] : '';
        $this->view->funAdd = self::$funAdd;
        $this->view->funConfirm = self::$funConfirm;
        $this->view->funDel = self::$funDel;
        $this->view->list = $this->model->getList($status, 1);
        $this->view->render("onleave/index");
        require "layouts/footer.php";
    }

    function getdata(){
        $json = $this->model->get_data();
        echo json_encode($json);
    }

    function getStaff() {
        $json = $this->model->getStaff();
        echo json_encode($json);
    }
    function update() {
        $id = $_REQUEST['id'];
        if($id == "0" && self::$funAdd == 1) {
            $staffId = $_REQUEST['staffId'];
            $type = $_REQUEST['type'];
            $description = $_REQUEST['description'];
            $shift = $_REQUEST['shift'];
            $date = date("Y-m-d",strtotime(str_replace('/', '-',$_REQUEST['date'])));
            $status = 1;
           
            $data = array(
                'staffId'=>$staffId,
                'type'=>$type,
                'description'=> $description,
                'shift'=>$shift,
                'date'=>$date,
                'status'=>$status,
            );
          $result = $this->model->updateOnLeave($id,$data); // vừa update vừa insert,
          if ($result) {
            $jsonObj['msg'] = "Thêm mới thành công";
            $jsonObj['success'] = true;
            } else {
                $jsonObj['msg'] = "Cập nhật không thành công";
                $jsonObj['success'] = false;
            }
        }
        else if($id > 0 && self::$funConfirm == 1) {
            $staffId = $_REQUEST['staffId'];
            $type = $_REQUEST['type'];
            $description = $_REQUEST['description'];
            $shift = $_REQUEST['shift'];
            $date = date("Y-m-d",strtotime(str_replace('/', '-',$_REQUEST['date'])));
            $status = 2;
            
            $data = array(
                'staffId'=>$staffId,
                'type'=>$type,
                'description'=> $description,
                'shift'=>$shift,
                'date'=>$date,
                'status'=>$status,
            );   
          $result = $this->model->updateOnleave($id,$data); // vừa update vừa insert,
          if ($result) {
            $jsonObj['msg'] = "Cập nhật thành công";
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

    function getitem() {
        $id = $_REQUEST['id'];
        $data = $this->model->getRequestById($id);
        echo json_encode($data);
    }

    function getDayOnLeave() {
        $staffId = $_REQUEST['staffId'];
        $data = $this->model->getDay($staffId);
        echo json_encode($data);
    }

    function del(){
        if (self::$funDel == 0) {
            $jsonObj['msg'] = 'Bạn không có quyền sử dụng chức năng này';
            $jsonObj['success'] = false;
            echo json_encode($jsonObj);
            return false;
        }
            $id = $_REQUEST['id'];
            if ($this->model->delObj($id)) {
                $jsonObj['msg'] = "Đã từ chối đơn phép";
                $jsonObj['success'] = true;
            } else {
                $jsonObj['msg'] = "Xảy ra lỗi khi xóa";
                $jsonObj['success'] = false;
            }
             $jsonObj = json_encode($jsonObj);
        echo $jsonObj;
        }       
    
    function filter() {
        $filter = isset($_REQUEST['filters']) ? $_REQUEST['filters'] : [];
        $status = isset($_REQUEST['status']) ? $_REQUEST['status'] : '';
        if(count($filter) > 0) {
          $filter = implode(',',$filter);
        }
        else {
            $filter = '';
        }
        $data =  $this->model->filterLevel($filter,$status);
        echo json_encode($data);
    }
}

?>
