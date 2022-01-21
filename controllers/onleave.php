<?php
class onleave extends Controller
{
    
    function __construct()
    {
        parent::__construct();
        $model = new model();
        $checkMenuRole = $model->checkMenuRole('onleave');
        if ($checkMenuRole == false)
            header('location:' . HOME);
        if ($_SESSION['user']['classify'] == 1) {
            self::$funDel = 1;
            self::$funAdd = 1;
            self::$funEdit = 1;
        }
        $functions = $model->getFunctions("payrolls");
        foreach ($functions as $item) {
            switch ($item['function']) {
                case 'del';
                    self::$funDel = 1;
                    break;
                case 'add';
                    self::$funAdd = 1;
                    break;
                case 'edit';
                    self::$funEdit = 1;
                    break;
            }
        }
    }

    function index(){
        require "layouts/header.php";
        $this->view->funDel = self::$funDel;
        $this->view->funAdd = self::$funAdd;
        $this->view->funEdit = self::$funEdit;
        $status = isset($_REQUEST['status']) ? $_REQUEST['status'] : '';
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
        if($id == "") {
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
        }
        else if($id > 0) {
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
    
    // function filter() {
    //     $filter = isset($_REQUEST['filters']) ? $_REQUEST['filters'] : [];
    //     $status = isset($_REQUEST['status']) ? $_REQUEST['status'] : '';
    //     if(count($filter) > 0) {
    //       $filter = implode(',',$filter);
    //     }
    //     else {
    //         $filter = '';
    //     }
    //     $data =  $this->model->filterLevel($filter,$status);
    //     echo json_encode($data);
    // }
}

?>