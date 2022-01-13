<?php

class laborcontracts extends Controller
{
    static private $funAdd = 0, $funEdit = 0, $funDel = 0;

    function __construct()
    {
        parent::__construct();
        $model = new model();
        $checkMenuRole = $model->checkMenuRole('position');
        if ($checkMenuRole == false)
            header('location:' . HOME);
        $funcs = $model->getFunctions('position');
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
        $data = $this->model->listObj();
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
        $nhanvien = $_SESSION['user']['staffId'];
        if (!in_array($nhanvien, [1, 7, 8, 11, 27]))
            return false;
        $id = isset($_REQUEST['id']) ? $_REQUEST['id'] : 0;
        $json = $this->model->getdata($id);
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
        $insuranceSalary = isset($_REQUEST['insuranceSalary']) ? str_replace(',', '', $_REQUEST['insuranceSalary']) : 0;
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
        $data = array(
            'name' => $name,
            'basicSalary' => $basicSalary,
            'salaryPercentage' => $salaryPercentage,
            'insuranceSalary' => $insuranceSalary,
            'allowance' => $allowance,
            'startDate' => $startDate,
            'stopDate' => $stopDate,
            'staffId' => $staffId,
            'departmentId' => $departmentId,
            'position' => $position,
            'branchId' => $branchId,
            'type' => $type,
            'status' => $status,
            'description' => $description
        );
        $contractId = $this->model->addObj($data);
        if ($contractId > 0) {
            $dataRecord = array(
                'name' => 'Ký hợp đồng lao động',
                'staffId' => $staffId,
                'contractId' => $contractId,
                'positionId' => $position,
                'startDate' => $startDate,
                'stopDate' => $stopDate,
                'salary' => $basicSalary,
                'allowance' => $allowance,
                'branchId' => $branchId,
                'departmentId' => $departmentId,
                'status' => 1
            );
            $this->model->addRecord($dataRecord);
            $jsonObj['message'] = 'Cập nhật dữ liệu thành công';
            $jsonObj['code'] = 200;
        } else {
            $jsonObj['message'] = 'Cập nhật dữ liệu không thành công';
            $jsonObj['code'] = 401;
        }
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
        $insuranceSalary = isset($_REQUEST['insuranceSalary']) ? str_replace(',', '', $_REQUEST['insuranceSalary']) : 0;
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
        $data = array(
            'name' => $name,
            'basicSalary' => $basicSalary,
            'salaryPercentage' => $salaryPercentage,
            'insuranceSalary' => $insuranceSalary,
            'allowance' => $allowance,
            'startDate' => $startDate,
            'stopDate' => $stopDate,
            'staffId' => $staffId,
            'departmentId' => $departmentId,
            'position' => $position,
            'branchId' => $branchId,
            'type' => $type,
            'status' => $status,
            'description' => $description
        );
        if ($this->model->updateObj($id, $data)) {
            $jsonObj['msg'] = 'Cập nhật dữ liệu thành công' . $startDate;
            $jsonObj['success'] = true;
        } else {
            $jsonObj['msg'] = 'Cập nhật dữ liệu không thành công';
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