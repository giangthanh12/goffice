<?php
class interview_result extends Controller{
    static private $funSign = 0;
    function __construct(){
        parent::__construct();
        $model = new model();
        $checkMenuRole = $model->checkMenuRole('interview_result');
        if ($checkMenuRole == false)
            header('location:' . HOME);
        $funcs = $model->getFunctions('interview_result');
        foreach ($funcs as $item) {
            if ($item['function'] == 'signContract')
                self::$funSign = 1;
           
        }
    }

    function index(){
   
        require "layouts/header.php";
        $this->view->funSign = self::$funSign;
        $this->view->render("interview_result/index");
        require "layouts/footer.php";
    }

    function list()
    {
        $data = $this->model->listObj();
        echo json_encode($data);
    }
    // load hisIssue
    function getBranch() {
        $jsonObj = $this->model->getBranch();
        echo json_encode($jsonObj);
    }
    function getDepartment() {
        $jsonObj = $this->model->getDepartment();
        echo json_encode($jsonObj);
    }
    function getPosition() {
        $jsonObj = $this->model->getPosition();
        echo json_encode($jsonObj);
    }
    function getworkPlace() {
        $jsonObj = $this->model->getworkPlace();
        echo json_encode($jsonObj);
    }
    
    function getShift() {
        $jsonObj = $this->model->getShift();
        echo json_encode($jsonObj);
    }
    function signContract() {
        if (self::$funSign == 0) {
            $jsonObj['msg'] = 'Bạn không có quyền sử dụng chức năng này';
            $jsonObj['success'] = false;
            echo json_encode($jsonObj);
            return false;
        }
        $applicantId = $_GET['applicantId'];
        $id = $_GET['id'];
        $staffId = $this->model->insertStaffGetId($applicantId);
        if($staffId  < 0) {
            $jsonObj['msg'] = 'Lỗi cập nhật database';
            $jsonObj['success'] = false;
            echo json_encode($jsonObj);
            return;
        }
  
        $data = array(
            'staffId'=>$staffId,
            'name' => $_REQUEST['name'],
            'type' => $_REQUEST['type'],
            'startDate' =>date("Y-m-d",strtotime($_REQUEST['startDate'])),
            'stopDate' => date("Y-m-d",strtotime($_REQUEST['stopDate'])),
            'basicSalary' => str_replace(',','',$_REQUEST['basicSalary']),
            'salaryPercentage' => $_REQUEST['salaryPercentage'],
            'allowance' => str_replace(',','',$_REQUEST['allowance']),
            'position' => $_REQUEST['position'],
            'branchId' => $_REQUEST['branchId'],
            'departmentId' => $_REQUEST['departmentId'],
            'description' => $_REQUEST['description'],
            'workPlaceId'=> $_REQUEST['workPlaceId'],
            'shiftId'=> $_REQUEST['shiftId'],
            'status' => 1
        );
     
        if($this->model->signContract($data,$id,$applicantId)){
            $jsonObj['msg'] = 'Cập nhật dữ liệu thành công';
            $jsonObj['success'] = true;
        } else {
            $jsonObj['msg'] = 'Lỗi cập nhật database';
            $jsonObj['success'] = false;
        }
        echo json_encode($jsonObj);
    }
    function checkQty() {
        $id = $_REQUEST['id'];
        if($this->model->checkqty($id)) {
            $jsonObj['success'] = true;
        }
        else {
            $jsonObj['success'] = false;
        }
        echo json_encode($jsonObj);
    }
   
}
?>