<?php
class interview_result extends Controller{

    function __construct(){
        parent::__construct();
    }

    function index(){
   
        require "layouts/header.php";
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
            'basicSalary' => $_REQUEST['basicSalary'],
            'salaryPercentage' => $_REQUEST['salaryPercentage'],
            'allowance' => $_REQUEST['allowance'],
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
   
}
?>