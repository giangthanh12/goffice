<?php

class recruitmentcamp extends Controller
{
    function __construct()
    {
        parent::__construct();
    }
    function index(){
        require "layouts/header.php";
        $this->view->render("recruitmentcamp/index");
        require "layouts/footer.php";
    }

    function list()
    {
        $jsonObj = $this->model->listObj();
        echo json_encode($jsonObj);
    }

    function getStaff() {
        $jsonObj = $this->model->getStaff();
        echo json_encode($jsonObj);
    }
    function getCandidate() {
        $id = $_REQUEST['id']; 
        
        $jsonObj = $this->model->getCandidate($id);
      
        echo json_encode($jsonObj);
    }
    function getDepartment() {
        $jsonObj = $this->model->getDepartment();
        echo json_encode($jsonObj);
    }
    function getBranch() {
        $jsonObj = $this->model->getBranch();
        echo json_encode($jsonObj);
    }
    
    function getPosition() {
        $jsonObj = $this->model->getPosition();
        echo json_encode($jsonObj);
    }
    
    function add() {
        $filename = $_FILES['file1']['name'];
        $fname = explode('.',$filename);
        $file = '';
        if ($filename != '') {
            $dir = ROOT_DIR . '/uploads/recruitment/';
            $file = functions::uploadfile('file1', $dir, $fname[0]);
            if ($file != '')
                $file = 'uploads/baogia/' . $file;
        }
        $creatorId = isset($_SESSION['user']['staffId']) ? $_SESSION['user']['staffId'] : false;
        $title = isset($_REQUEST['title']) ? $_REQUEST['title'] : '';
        $inChargeId = isset($_REQUEST['inChargeId']) ? $_REQUEST['inChargeId'] : '';
        $followerId = isset($_REQUEST['followerId']) ? implode(',',$_REQUEST['followerId']) : '';
        $estimateCost = isset($_REQUEST['estimateCost']) ?  str_replace(',', '',$_REQUEST['estimateCost']) : '';
        $startDate = isset($_REQUEST['startDate']) ? date("Y-m-d", strtotime($_REQUEST['startDate'])) : '';
        $endDate = isset($_REQUEST['endDate']) ? date("Y-m-d", strtotime($_REQUEST['endDate'])) : '';
        $department = isset($_REQUEST['department']) ? $_REQUEST['department'] : '';
        $branch = isset($_REQUEST['branch']) ? $_REQUEST['branch'] : '';
        $position = isset($_REQUEST['position']) ? $_REQUEST['position'] : '';
        $workOn = isset($_REQUEST['workOn']) ? $_REQUEST['workOn'] : '';
        $minSalary = isset($_REQUEST['minSalary']) ?  str_replace(',', '',$_REQUEST['minSalary']) : '';
        $maxSalary = isset($_REQUEST['maxSalary']) ?  str_replace(',', '',$_REQUEST['maxSalary']) : '';
        $quantity = isset($_REQUEST['quantity']) ? $_REQUEST['quantity'] : '';
        $minAge = isset($_REQUEST['minAge']) ? $_REQUEST['minAge'] : '';
        $maxAge = isset($_REQUEST['maxAge']) ? $_REQUEST['maxAge'] : '';
        $educationLevel = isset($_REQUEST['educationLevel']) ? $_REQUEST['educationLevel'] : '';
        $professional = isset($_REQUEST['professional']) ? $_REQUEST['professional'] : '';
        $yearOfExperience = isset($_REQUEST['yearOfExperience']) ? $_REQUEST['yearOfExperience'] : '';
        $description = isset($_REQUEST['description']) ? $_REQUEST['description'] : '';
        $data = array(
            'creatorId' => $creatorId, 
            'title' => $title, 
            'inChargeId' => $inChargeId, 
            'followerId' => $followerId, 
            'estimateCost' => $estimateCost, 
            'startDate' => $startDate, 
            'stopDate' => $endDate, 
            'department' => $department, 
            'position' => $position, 
            'branch' => $branch,
            'workOn' => $workOn, 
            'quantity' => $quantity, 
            'minSalary' => $minSalary, 
            'maxSalary' => $maxSalary,
            'minAge' => $minAge, 
            'maxAge' => $maxAge, 
            'educationLevel' => $educationLevel, 
            'professional' => $professional,
            'yearsOfExperience' => $yearOfExperience, 
            'description' => $description,
            'file'=>$file,
            'status' => 1
        );
      
        $temp = $this->model->addObj($data);
        if ($temp) {
            $jsonObj['msg'] = "Cập nhật dữ liệu thành công";
            $jsonObj['success'] = true;
        } else {
            $jsonObj['msg'] = "Cập nhật dữ liệu không thành công";
            $jsonObj['success'] = false;
        }
        echo json_encode($jsonObj);
    }
    function addCandidate() {
        $camId = $_REQUEST['camId'];
        $canId = $_REQUEST['canId'];
        if(isset($canId) && !empty($canId)) {
            try {
                $row = 0;
                foreach($canId as $val) {
                  $data = array('campId'=>$camId, 'canId'=>$val, 'status'=>1);
                  $result =  $this->model->addSortlist($data);
                  if($result) $row++;
                }
                if($row > 0) {
                    $jsonObj['msg'] = "Cập nhật thành công $row data";
                    $jsonObj['success'] = true;
                }
                else {
                    $jsonObj['msg'] = "Lỗi cập nhật database";
                    $jsonObj['success'] = false;
                }
            }
            catch (Exception $e) {
                $jsonObj['msg'] = "Cập nhật dữ liệu không thành công";
                $jsonObj['success'] = false;
            }
        }
        else {
            $jsonObj['msg'] = "Cập nhật dữ liệu không thành công";
            $jsonObj['success'] = false;
        }
        echo json_encode($jsonObj);
        
    }
    function loadListCandidate() {
        $id = $_REQUEST['id'];
        $jsonObj = $this->model->getListCandidate($id);
        echo json_encode($jsonObj);

    }
    function delCandidate() {
        $id = $_REQUEST['id'];
        $data = ['status' => 0];
        if ($this->model->delCandidate($id, $data)) {
            $jsonObj['msg'] = "Xóa dữ liệu thành công";
            $jsonObj['success'] = true;
        } else {
            $jsonObj['msg'] = "Xóa dữ liệu không thành công";
            $jsonObj['success'] = false;
        }
        echo json_encode($jsonObj);
    }
    function loaddata() {
        $id = $_REQUEST['id'];
        $json = $this->model->getdata($id);
        echo json_encode($json);
    }
    function update() {
        $id = isset($_REQUEST['id']) ? $_REQUEST['id'] : 0;
        $filename = $_FILES['file2']['name'];
        $fname = explode('.',$filename);
        $file = '';
        if ($filename != '') {
            $dir = ROOT_DIR . '/uploads/recruitment/';
            $file = functions::uploadfile('file2', $dir, $fname[0]);
            if ($file != '')
                $file = 'uploads/baogia/' . $file;
        }

        $title = isset($_REQUEST['title1']) ? $_REQUEST['title1'] : '';
        $inChargeId = isset($_REQUEST['inChargeId1']) ? $_REQUEST['inChargeId1'] : '';
        $followerId = isset($_REQUEST['followerId1']) ? implode(',',$_REQUEST['followerId1']) : '';
        $estimateCost = isset($_REQUEST['estimateCost1']) ?  str_replace(',', '',$_REQUEST['estimateCost1']) : '';
        $startDate = isset($_REQUEST['startDate1']) ? date("Y-m-d", strtotime($_REQUEST['startDate1'])) : '';
        $endDate = isset($_REQUEST['endDate1']) ? date("Y-m-d", strtotime($_REQUEST['endDate1'])) : '';
        $department = isset($_REQUEST['department1']) ? $_REQUEST['department1'] : '';
        $branch = isset($_REQUEST['branch1']) ? $_REQUEST['branch1'] : '';
        $position = isset($_REQUEST['position1']) ? $_REQUEST['position1'] : '';
        $workOn = isset($_REQUEST['workOn1']) ? $_REQUEST['workOn1'] : '';
        $minSalary = isset($_REQUEST['minSalary1']) ?  str_replace(',', '',$_REQUEST['minSalary1']) : '';
        $maxSalary = isset($_REQUEST['maxSalary1']) ?  str_replace(',', '',$_REQUEST['maxSalary1']) : '';
        $quantity = isset($_REQUEST['quantity1']) ? $_REQUEST['quantity1'] : '';
        $minAge = isset($_REQUEST['minAge1']) ? $_REQUEST['minAge1'] : '';
        $maxAge = isset($_REQUEST['maxAge1']) ? $_REQUEST['maxAge1'] : '';
        $educationLevel = isset($_REQUEST['educationLevel1']) ? $_REQUEST['educationLevel1'] : '';
        $professional = isset($_REQUEST['professional1']) ? $_REQUEST['professional1'] : '';
        $yearOfExperience = isset($_REQUEST['yearOfExperience1']) ? $_REQUEST['yearOfExperience1'] : '';
        $description = isset($_REQUEST['description1']) ? $_REQUEST['description1'] : '';
        $data = array(
            'title' => $title, 
            'inChargeId' => $inChargeId, 
            'followerId' => $followerId, 
            'estimateCost' => $estimateCost, 
            'startDate' => $startDate, 
            'stopDate' => $endDate, 
            'department' => $department, 
            'position' => $position, 
            'branch' => $branch,
            'workOn' => $workOn, 
            'quantity' => $quantity, 
            'minSalary' => $minSalary, 
            'maxSalary' => $maxSalary,
            'minAge' => $minAge, 
            'maxAge' => $maxAge, 
            'educationLevel' => $educationLevel, 
            'professional' => $professional,
            'yearsOfExperience' => $yearOfExperience, 
            'description' => $description,
            'file'=>$file,
            'status' => 1
        );
      
        $temp = $this->model->updateObj($id,$data);
        if ($temp) {
            $jsonObj['msg'] = "Cập nhật dữ liệu thành công";
            $jsonObj['success'] = true;
        } else {
            $jsonObj['msg'] = "Cập nhật dữ liệu không thành công";
            $jsonObj['success'] = false;
        }
        echo json_encode($jsonObj);
    }
    function del()
    {
        $id = $_REQUEST['id'];
        $data = ['status' => 0];
        if ($this->model->delObj($id, $data)) {
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