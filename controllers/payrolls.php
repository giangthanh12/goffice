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
        echo json_encode($data);
    }

    function addPayRolls()
    {
        if (self::$funAdd == 0)
            return false;
        $month = isset($_REQUEST['month']) ? $_REQUEST['month'] : date("m");
        $year = isset($_REQUEST['year']) ? $_REQUEST['year'] : date("Y");
        if ($this->model->addObj($month, $year)) {
            $jsonObj['message'] = "Đã lập lại bảng lương tháng " . $month . '/' . $year;
            $jsonObj['code'] = 200;
        } else {
            $jsonObj['message'] = "Bảng lương tháng này đã tồn tại";
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
            $jsonObj['message'] = 'Cập nhật dữ liệu thành công';
            $jsonObj['code'] = 200;
        } else {
            $jsonObj['message'] = 'Cập nhật dữ liệu không thành công';
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
            $jsonObj['message'] = "Đã duyệt bảng lương tháng " . $month . '/' . $year;
            $jsonObj['code'] = 200;
        } else {
            $jsonObj['message'] = "Duyệt bảng lương không thành công";
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
            $jsonObj['message'] = "Đã duyệt bảng lương";
            $jsonObj['code'] = 200;
        } else {
            $jsonObj['message'] = "Duyệt bảng lương không thành công";
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
            $jsonObj['message'] = "Đã hoàn duyệt bảng lương";
            $jsonObj['code'] = 200;
        } else {
            $jsonObj['message'] = "Hoàn duyệt bảng lương không thành công";
            $jsonObj['code'] = 401;
        }
        echo json_encode($jsonObj);
    }

}
