<?php

class laborcontracts extends Controller
{
    static private $funAdd = 0, $funEdit = 0, $funDel = 0;

    function __construct()
    {
        parent::__construct();
        $model = new model();
        $checkMenuRole = $model->checkMenuRole('laborcontracts');
        if ($checkMenuRole == false)
            header('location:' . HOME);
        $funcs = $model->getFunctions('laborcontracts');
        foreach ($funcs as $item) {
            if ($item['function'] == 'add')
                self::$funAdd = 1;
            if ($item['function'] == 'edit')
                self::$funEdit = 1;
            if ($item['function'] == 'del')
                self::$funDel = 1;
        }
    }

    function index()
    {
        require "layouts/header.php";
        $this->view->funAdd = self::$funAdd;
        $this->view->funEdit = self::$funEdit;
        $this->view->funDel = self::$funDel;
        $this->view->render("laborcontracts/index");
        require "layouts/footer.php";
    }

    function list()
    {
        if(self::$funAdd==1 || self::$funEdit==1 || self::$funDel==1)
            $viewAll = true;
        else
            $viewAll=false;
        $data = $this->model->listObj($viewAll);
        echo json_encode($data);
    }

    function listDel()
    {
        $data = $this->model->listDel();
        echo json_encode($data);
    }

    function combo()
    {
        $json = $this->model->get_data_combo();
        echo json_encode($json);
    }

    function loaddata()
    {
        if(self::$funAdd==1 || self::$funEdit==1 || self::$funDel==1)
            $viewAll = true;
        else
            $viewAll=false;
        $id = isset($_REQUEST['id']) ? $_REQUEST['id'] : 0;
        $json = $this->model->getdata($id,$viewAll);
        echo json_encode($json);
    }

    function add()
    {
        if (self::$funAdd == 0) {
            $jsonObj['message'] = 'Bạn không có quyền sử dụng chức năng này';
            $jsonObj['code'] = 400;
            echo json_encode($jsonObj);
            return false;
        }
        $name = isset($_REQUEST['name']) ? $_REQUEST['name'] : '';
        if ($name == '') {
            return false;
        }
        $basicSalary = isset($_REQUEST['basicSalary']) ? str_replace(',', '', $_REQUEST['basicSalary']) : 0;
        $salaryPercentage = isset($_REQUEST['salaryPercentage']) ? $_REQUEST['salaryPercentage'] : 0;
        $shiftId = isset($_REQUEST['shiftId']) ? $_REQUEST['shiftId'] : 0;
        $allowance = isset($_REQUEST['allowance']) ? str_replace(',', '', $_REQUEST['allowance']) : 0;
        $startDate = isset($_REQUEST['startDate']) && $_REQUEST['startDate'] != '' ? functions::convertDate($_REQUEST['startDate']) : '';
        if ($startDate == '') {
            return false;
        }
        $stopDate = isset($_REQUEST['stopDate']) && $_REQUEST['stopDate'] != '' ? functions::convertDate($_REQUEST['stopDate']) : '';
        $staffId = isset($_REQUEST['staffId']) ? $_REQUEST['staffId'] : 0;
        if ($staffId == 0 || $staffId == '') {
            return false;
        }
        $departmentId = isset($_REQUEST['departmentId']) ? $_REQUEST['departmentId'] : 0;
        $position = isset($_REQUEST['position']) ? $_REQUEST['position'] : 0;
        $branchId = isset($_REQUEST['branchId']) ? $_REQUEST['branchId'] : 0;
        $workPlaceId = isset($_REQUEST['workPlaceId']) ? $_REQUEST['workPlaceId'] : 0;
        $type = isset($_REQUEST['type']) ? $_REQUEST['type'] : 0;
        $status = isset($_REQUEST['status']) ? $_REQUEST['status'] : 1;
        $description = isset($_REQUEST['description']) ? $_REQUEST['description'] : '';
        $data = array(
            'name' => $name,
            'basicSalary' => $basicSalary,
            'salaryPercentage' => $salaryPercentage,
            'shiftId' => $shiftId,
            'allowance' => $allowance,
            'startDate' => $startDate,
            'stopDate' => $stopDate,
            'staffId' => $staffId,
            'departmentId' => $departmentId,
            'position' => $position,
            'branchId' => $branchId,
            'workPlaceId'=>$workPlaceId,
            'type' => $type,
            'status' => $status,
            'description' => $description
        );
        $contractId = $this->model->addObj($data);
        if ($contractId > 0) {
            $jsonObj['message'] = 'Cập nhật dữ liệu thành công';
            $jsonObj['code'] = 200;
        } else {
            $jsonObj['message'] = 'Cập nhật dữ liệu không thành công';
            $jsonObj['code'] = 401;
        }
        echo json_encode($jsonObj);
    }

    function update()
    {

        if (self::$funEdit == 0) {
            $jsonObj['message'] = 'Bạn không có quyền sử dụng chức năng này';
            $jsonObj['code'] = 400;
            echo json_encode($jsonObj);
            return false;
        }
        $id = isset($_REQUEST['id']) ? $_REQUEST['id'] : '';
        if ($id == '' || $id == 0) {
            return false;
        }
        $name = isset($_REQUEST['name']) ? $_REQUEST['name'] : '';
        if ($name == '') {
            return false;
        }
        $basicSalary = isset($_REQUEST['basicSalary']) ? str_replace(',', '', $_REQUEST['basicSalary']) : 0;
        $salaryPercentage = isset($_REQUEST['salaryPercentage']) ? $_REQUEST['salaryPercentage'] : 0;
        $shiftId = isset($_REQUEST['shiftId']) ? $_REQUEST['shiftId'] : 0;
        $allowance = isset($_REQUEST['allowance']) ? str_replace(',', '', $_REQUEST['allowance']) : 0;
        $startDate = isset($_REQUEST['startDate']) && $_REQUEST['startDate'] != '' ? functions::convertDate($_REQUEST['startDate']) : '';
        if ($startDate == '') {
            return false;
        }
        $stopDate = isset($_REQUEST['stopDate']) && $_REQUEST['stopDate'] != '' ? functions::convertDate($_REQUEST['stopDate']) : '';
        $staffId = isset($_REQUEST['staffId']) ? $_REQUEST['staffId'] : 0;
        if ($staffId == 0 || $staffId == '') {
            return false;
        }
        $departmentId = isset($_REQUEST['departmentId']) ? $_REQUEST['departmentId'] : 0;
        $position = isset($_REQUEST['position']) ? $_REQUEST['position'] : 0;
        $branchId = isset($_REQUEST['branchId']) ? $_REQUEST['branchId'] : 0;
        $type = isset($_REQUEST['type']) ? $_REQUEST['type'] : 0;
        $status = isset($_REQUEST['status']) ? $_REQUEST['status'] : 1;
        $description = isset($_REQUEST['description']) ? $_REQUEST['description'] : '';
        $workPlaceId = isset($_REQUEST['workPlaceId']) ? $_REQUEST['workPlaceId'] : 0;
        $data = array(
            'name' => $name,
            'basicSalary' => $basicSalary,
            'salaryPercentage' => $salaryPercentage,
            'shiftId' => $shiftId,
            'allowance' => $allowance,
            'startDate' => $startDate,
            'stopDate' => $stopDate,
            'staffId' => $staffId,
            'departmentId' => $departmentId,
            'position' => $position,
            'branchId' => $branchId,
            'workPlaceId'=>$workPlaceId,
            'type' => $type,
            'status' => $status,
            'description' => $description
        );
        if ($this->model->updateObj($id, $data)) {
            $jsonObj['message'] = 'Cập nhật dữ liệu thành công';
            $jsonObj['code'] = 200;
        } else {
            $jsonObj['message'] = 'Cập nhật dữ liệu không thành công';
            $jsonObj['code'] = 401;
        }

        echo json_encode($jsonObj);
    }

    function del()
    {
        $id = $_REQUEST['id'];
        $data = ['status' => 0];
        if ($this->model->delObj($id, $data)) {
            $jsonObj['message'] = "Xóa dữ liệu thành công";
            $jsonObj['code'] = 200;
        } else {
            $jsonObj['message'] = "Xóa dữ liệu không thành công";
            $jsonObj['code'] = false;
        }
        echo json_encode($jsonObj);
    }
}

?>