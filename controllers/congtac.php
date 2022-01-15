<?php

class congtac extends Controller
{
    function __construct()
    {
        parent::__construct();
    }

    function index()
    {
        require "layouts/header.php";
        $this->view->render("congtac/index");
        require "layouts/footer.php";
    }

    function getAllData()
    {
        $data = $this->model->getAllData();
        echo json_encode($data);
    }

    // function getAllStaff()
    // {
    //     $this->view->staff = $this->model->getAllStaff();
    //     echo json_encode($data);
    // }

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

    function getStaff() {
        $jsonObj = $this->model->getStaff();
        echo json_encode($jsonObj);
    }

    function getContract()
    {
        $id = isset($_REQUEST['id']) ? $_REQUEST['id'] : 0;
        $json = $this->model->getContractByStaffId($id);
        echo json_encode($json);
    }

    // function loadDataById()
    // {
    //     $id = isset($_REQUEST['id']) ? $_REQUEST['id'] : 0;
    //     $json = $this->model->getDataById($id);
    //     echo json_encode($json);
    // }

    // function updateInfo()
    // {
    //     $data = $_REQUEST['data'];
    //     $id = $_REQUEST['id'];
    //     if ($this->model->updateinfo($data, $id)) {
    //         $jsonObj['msg'] = "Cập nhật dữ liệu thành công";
    //         $jsonObj['success'] = true;
    //     } else {
    //         $jsonObj['msg'] = "Lỗi khi cập nhật database";
    //         $jsonObj['success'] = false;
    //     }
    //     echo json_encode($jsonObj);
    // }

    // function add()
    // {
    //     $username = $_POST['username'];
    //     $checkUsername = $this->model->checkUsername($username);
    //     if ($checkUsername == 0) {
    //         $usernameMd5 = md5($_POST['username']);
    //         $staffId = $_POST['staffId'];
    //         $groupId = $_POST['groupId'];
    //         $password = md5(md5($_POST['password']));
    //         $data = [
    //             'username' => $username,
    //             'usernameMd5' => $usernameMd5,
    //             'staffId' => $staffId,
    //             'groupId' => $groupId,
    //             'password' => $password,
    //             'classify'=>2,
    //             'status' => 1];
    //         if ($this->model->addObj($data)) {
    //             $jsonObj['message'] = "Cập nhật dữ liệu thành công";
    //             $jsonObj['code'] = 200;
    //         } else {
    //             $jsonObj['message'] = "Lỗi khi cập nhật database";
    //             $jsonObj['code'] = 401;
    //         }
    //     } else {
    //         $jsonObj['message'] = "Username đã tồn tại trong hệ thống";
    //         $jsonObj['code'] = 402;
    //     }
    //     echo json_encode($jsonObj);
    // }

    function del($id)
    {
        $id = $_REQUEST['id'];
        
        if ($this->model->delObj($id)) {
            $jsonObj['msg'] = 'Cập nhật dữ liệu thành công';
            $jsonObj['success'] = true;
        } else {
            $jsonObj['msg'] = 'Cập nhật dữ liệu không thành công';
            $jsonObj['success'] = false;
        }
        echo json_encode($jsonObj); 
    }

    function update($id)
    {
        $id = $_REQUEST['id'];
        $name = $_REQUEST['name'];
        $type = $_REQUEST['type'];
        $staffId = $_REQUEST['staffId'];
        $branchId = $_REQUEST['branchId'];
        $departmentId = $_REQUEST['departmentId'];
        $positionId = $_REQUEST['positionId'];
        $percentage = $_REQUEST['salaryPercentage'];
        $insurance = str_replace(',','',$_REQUEST['insuranceSalary']);
        $salary = str_replace(',','',$_REQUEST['salary']);
        $allowance = str_replace(',','',$_REQUEST['allowance']);
        $startDate = date('Y-m-d',strtotime($_REQUEST['startDate']));
        $stopDate = date('Y-m-d',strtotime($_REQUEST['stopDate']));
        $shift = $_REQUEST['shift'];
        $description = $_REQUEST['description'];
        $data1 = [
           'status' => 2
        ];
        $data2 = [
            'name' => $name,
            'type' => $type,
            'staffId' => $staffId,
            'branchId' => $branchId,
            'departmentId' => $departmentId,
            'position' => $positionId,
            'basicSalary' => $salary,
            'salaryPercentage' => $percentage,
            'insuranceSalary' => $insurance,
            'allowance' => $allowance,
            'startDate' => $startDate,
            'stopDate' => $stopDate,
            'shift' => $shift,
            'description' => $description,
            'status' => '1'
        ];
       
        if($id == '') { //Nếu chưa có hợp đồng
             if ($this->model->addObj($data2)) {
                $jsonObj['msg'] = 'Cập nhật dữ liệu thành công';
                $jsonObj['success'] = true;
            } else {
                $jsonObj['msg'] = 'Cập nhật dữ liệu không thành công';
                $jsonObj['success'] = false;
            }
            echo json_encode($jsonObj); 
        } else { //Nếu đã có hợp đồng
            if ($this->model->updateObj($data1,$id)) {
                $jsonObj['msg'] = 'Cập nhật dữ liệu thành công';
                $jsonObj['success'] = true;
            } else {
                $jsonObj['msg'] = 'Cập nhật dữ liệu không thành công';
                $jsonObj['success'] = false;
            }
            if ($this->model->addObj($data2)) {
                $jsonObj['msg'] = 'Cập nhật dữ liệu thành công';
                $jsonObj['success'] = true;
            } else {
                $jsonObj['msg'] = 'Cập nhật dữ liệu không thành công';
                $jsonObj['success'] = false;
            }
        echo json_encode($jsonObj); 
        }
    }

    // function getMenus(){
    //     $userId = isset($_REQUEST['userId']) ? $_REQUEST['userId'] : 0;
    //     $json = $this->model->getMenusByUser($userId);
    //     echo json_encode($json);
    // }

    // function setFunctionRole(){
    //     $userId = isset($_REQUEST['userId']) ? $_REQUEST['userId'] : 0;
    //     $funcId = isset($_REQUEST['funcId']) ? $_REQUEST['funcId'] : 0;
    //     $check = isset($_REQUEST['check']) ? $_REQUEST['check'] : 0;
    //     $this->model->setFunctionRole($userId,$funcId,$check);
    //     echo $funcId;
    // }

    // function setMenuRole(){
    //     $userId = isset($_REQUEST['userId']) ? $_REQUEST['userId'] : 0;
    //     $menuId = isset($_REQUEST['menuId']) ? $_REQUEST['menuId'] : 0;
    //     $check = isset($_REQUEST['check']) ? $_REQUEST['check'] : 0;
    //     if($userId>0 && $menuId>0)
    //         $this->model->setMenuRole($userId,$menuId,$check);
    // }

}

?>
