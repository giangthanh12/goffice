<?php
class onleave extends Controller
{
    static protected $funcs;
    function __construct()
    {
        parent::__construct();
    }

    function index(){
        $this->view->funs = self::$funcs;
        require "layouts/header.php";
        $status = isset($_REQUEST['status']) ? $_REQUEST['status'] : '';
        $this->view->list = $this->model->getList($status, 1);
        $this->view->render("onleave/index");
        require "layouts/footer.php";
    }

    function getdata(){
        $json = $this->model->get_data();
        echo json_encode($json);
    }
    // get levelproject
    // function getLevelProject(){
    //     $json = $this->model->getLevelProject();
    //     echo json_encode($json);
    // }
    // function getStatusProject() {
    //     $json = $this->model->getStatusProject();
    //     echo json_encode($json);
    // }
    function getStaff() {
        $json = $this->model->getStaff();
        echo json_encode($json);
    }
    function update() {
        $id = $_REQUEST['id'];
        if(functions::checkFuns(self::$funcs,'add') && $id == 0) {
            $staffId = $_REQUEST['staffId'];
            $type = $_REQUEST['type'];
            $description = $_REQUEST['description'];
            $shift = $_REQUEST['shift'];
            $date = date("Y-m-d",strtotime(str_replace('/', '-',$_REQUEST['date'])));
            $status = 1;
            // $name = $_REQUEST['name'];
            // $managerId = $_REQUEST['managerId'];
            // $memberId = str_replace(']','',str_replace('[', '', json_encode($_REQUEST['memberId'])));
            // $process = !empty($_REQUEST['process']) ? $_REQUEST['process'] : 0;
            // $level = $_REQUEST['level'];
            // $description = $_REQUEST['description'];
            // $status = $_REQUEST['status'];
            // $createDate = date("Y-m-d");
            // $deadline = date("Y-m-d",strtotime(str_replace('/', '-',$_REQUEST['date'])));
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
        else if(functions::checkFuns(self::$funcs,'loaddata') && $id > 0) {
            $staffId = $_REQUEST['staffId'];
            $type = $_REQUEST['type'];
            $description = $_REQUEST['description'];
            $shift = $_REQUEST['shift'];
            $date = date("Y-m-d",strtotime(str_replace('/', '-',$_REQUEST['date'])));
            $status = 2;
            // $name = $_REQUEST['name'];
            // $managerId = $_REQUEST['managerId'];
            // $memberId = implode(',',$_REQUEST['memberId']);
            // $process = !empty($_REQUEST['process']) ? $_REQUEST['process'] : 0;
            // $level = $_REQUEST['level'];
            // $description = $_REQUEST['description'];
            // $status = $_REQUEST['status'];
            // $createDate = date("Y-m-d");
            // $deadline = date("Y-m-d",strtotime(str_replace('/', '-',$_REQUEST['date'])));
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
        if(functions::checkFuns(self::$funcs,'del')) {
            $id = $_REQUEST['id'];
            if ($this->model->delObj($id)) {
                $jsonObj['msg'] = "Đã từ chối đơn phép";
                $jsonObj['success'] = true;
            } else {
                $jsonObj['msg'] = "Xảy ra lỗi khi xóa";
                $jsonObj['success'] = false;
            }
        }
        else {
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
