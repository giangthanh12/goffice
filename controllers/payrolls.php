<?php

class payrolls extends Controller
{
    static private $funCheck = 0, $funAdd = 0, $funEdit = 0;

    function __construct()
    {
        parent::__construct();
        $model = new model();
        $checkMenuRole = $model->checkMenuRole('payrolls');
        if ($checkMenuRole == false)
            header('location:' . HOME);
        if ($_SESSION['user']['classify'] == 1) {
            self::$funCheck = 1;
            self::$funAdd = 1;
            self::$funEdit = 1;
        }
        $functions = $model->getFunctions("payrolls");
        foreach ($functions as $item) {
            switch ($item['function']) {
                case 'check';
                    self::$funCheck = 1;
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

    function index()
    {
        require "layouts/header.php";
        $this->view->funCheck = self::$funCheck;
        $this->view->funAdd = self::$funAdd;
        $this->view->funEdit = self::$funEdit;
        $this->view->render("payrolls/index");
        require "layouts/footer.php";
    }

    function list()
    {
        $month = isset($_REQUEST['month']) ? $_REQUEST['month'] : date('m');
        $year = isset($_REQUEST['year']) ? $_REQUEST['year'] : date('Y');
        if (self::$funCheck == 0)
            $staffId = $_SESSION['user']['staffId'];
        else
            $staffId = isset($_REQUEST['staffId']) ? $_REQUEST['staffId'] : 0;
        
        $data['data'] = $this->model->listObj($month, $year, $staffId,self::$funCheck);
        $total = 0;
        foreach($data['data'] as $key=>$value) {
            $salary = ($value['basicSalary'] / $value['wokingDays']) * $value['totalWorkDays'];
               $provisionalSalary = $salary;
               $provisionalSalary += $value['allowance'];
               $provisionalSalary +=$value['revenueBonus'];
               $provisionalSalary +=$value['tetBonus']; 
               $provisionalSalary += $value['otherBonus'];
               $totalSalary = $provisionalSalary;
               $totalSalary -= $value['insurance'];
               $totalSalary -= $value['advance'];
               $data['data'][$key]['thuclinh'] = round($totalSalary);
               $total+= round($totalSalary);
           }
           $data['total'] = $total;
           echo json_encode($data);
    }

    function addPayRolls()
    {
        if (self::$funAdd == 0)
            return false;
        $month = isset($_REQUEST['month']) ? $_REQUEST['month'] : date("m");
        $year = isset($_REQUEST['year']) ? $_REQUEST['year'] : date("Y");
        if ($this->model->addObj($month, $year)) {
            $jsonObj['message'] = "???? l???p l???i b???ng l????ng th??ng " . $month . '/' . $year;
            $jsonObj['code'] = 200;
        } else {
            $jsonObj['message'] = "B???ng l????ng th??ng n??y ???? t???n t???i";
            $jsonObj['code'] = 401;
        }
        echo json_encode($jsonObj);
    }

    function update()
    {
        if (self::$funEdit == 0)
            return false;
        $id = $_REQUEST['id'];
        $revenueBonus = isset($_REQUEST['revenueBonus']) ? str_replace(',', '', $_REQUEST['revenueBonus']) : 0;
        $tetBonus = isset($_REQUEST['tetBonus']) ? str_replace(',', '', $_REQUEST['tetBonus']) : 0;
        $otherBonus = isset($_REQUEST['otherBonus']) ? str_replace(',', '', $_REQUEST['otherBonus']) : 0;
        $insurance = isset($_REQUEST['insurance']) ? str_replace(',', '', $_REQUEST['insurance']) : 0;
        $advance = isset($_REQUEST['advance']) ? str_replace(',', '', $_REQUEST['advance']) : 0;
        $data = array(
            'revenueBonus' => $revenueBonus,
            'tetBonus' => $tetBonus,
            'otherBonus' => $otherBonus,
            'insurance' => $insurance,
            'advance' => $advance,
        );
        if ($this->model->updateObj($id, $data)) {
            $jsonObj['message'] = 'C???p nh???t d??? li???u th??nh c??ng';
            $jsonObj['code'] = 200;
        } else {
            $jsonObj['message'] = 'C???p nh???t d??? li???u kh??ng th??nh c??ng';
            $jsonObj['code'] = 401;
        }
        echo json_encode($jsonObj);
    }

    function checkAll()
    {
        if (self::$funCheck == 0)
            return false;
        $month = isset($_REQUEST['month']) ? $_REQUEST['month'] : date("m");
        $year = isset($_REQUEST['year']) ? $_REQUEST['year'] : date("Y");
        if ($this->model->checkPayRolls($month, $year)) {
            $jsonObj['message'] = "???? duy???t b???ng l????ng th??ng " . $month . '/' . $year;
            $jsonObj['code'] = 200;
        } else {
            $jsonObj['message'] = "Duy???t b???ng l????ng kh??ng th??nh c??ng";
            $jsonObj['code'] = 401;
        }
        echo json_encode($jsonObj);
    }

    function checkPayRoll()
    {
        if (self::$funCheck == 0)
            return false;
        $id = isset($_POST['id']) ? $_REQUEST['id'] : 0;
        if ($id <= 0) {
            return false;
        }
        $data = ['status' => 2];
        if ($this->model->updateObj($id, $data)) {
            $jsonObj['message'] = "???? duy???t b???ng l????ng";
            $jsonObj['code'] = 200;
        } else {
            $jsonObj['message'] = "Duy???t b???ng l????ng kh??ng th??nh c??ng";
            $jsonObj['code'] = 401;
        }
        echo json_encode($jsonObj);
    }

    function uncheckPayRoll()
    {
        if (self::$funCheck == 0)
            return false;
        $id = isset($_POST['id']) ? $_REQUEST['id'] : 0;
        if ($id <= 0) {
            return false;
        }
        $data = ['status' => 1];
        if ($this->model->updateObj($id, $data)) {
            $jsonObj['message'] = "???? ho??n duy???t b???ng l????ng";
            $jsonObj['code'] = 200;
        } else {
            $jsonObj['message'] = "Ho??n duy???t b???ng l????ng kh??ng th??nh c??ng";
            $jsonObj['code'] = 401;
        }
        echo json_encode($jsonObj);
    }

    function exportexcel(){
        $month = isset($_REQUEST['month']) ? $_REQUEST['month'] : date('m');
        $year = isset($_REQUEST['year']) ? $_REQUEST['year'] : date('Y');
        // echo $month;
        // return;
        $funCheck = self::$funCheck;
        $staffId = 0;
        $this->view->year=$year;
        $this->view->month=$month;
        $this->view->payrolls = $this->model->listObj($month,$year,$staffId,$funCheck);
        $this->view->render('payrolls/export');
    }

}
