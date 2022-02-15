<?php
class used_customer extends Controller
{
    static private $funAdd = 0, $funEdit = 0, $funDel = 0, $funImport = 0;
    function __construct()
    {
        parent::__construct();
        $model = new model();
        $checkMenuRole = $model->checkMenuRole('used_customer');
        if ($checkMenuRole == false)
            header('location:' . HOME);
        $funcs = $model->getFunctions('used_customer');
      
        foreach ($funcs as $item) {
            if ($item['function'] == 'add')
                self::$funAdd = 1;
            if ($item['function'] == 'import')
                self::$funImport = 1;
            if ($item['function'] == 'edit')
                self::$funEdit = 1;
            if ($item['function'] == 'del')
                self::$funDel = 1;
        }
    }
    function index(){
        require "layouts/header.php";
        $this->view->funAdd = self::$funAdd;
        $this->view->funImport = self::$funImport;
        $this->view->funEdit = self::$funEdit;
        $this->view->funDel = self::$funDel;
        $this->view->render("used_customer/index");
        require "layouts/footer.php";
    }

    function getStaff()
    {
        $jsonObj = $this->model->getStaff();
        echo json_encode($jsonObj);
    }
    function combo() {
        $jsonObj = $this->model->get_data_combo();
        echo json_encode($jsonObj);
    }
    function getNational() {
        $jsonObj = $this->model->getNational();
        echo json_encode($jsonObj);
    }
    function getProvince() {
        $jsonObj = $this->model->getProvince();
        echo json_encode($jsonObj);
    }
    function getPosition() {
        $jsonObj = $this->model->getPosition();
        echo json_encode($jsonObj);
    }
    function list()
    {
        $data = $this->model->listObj();
        echo json_encode($data);
    }
    function loadContact() {
        $id = $_GET['id'];
        $data = $this->model->loadContact($id);
        echo json_encode($data);
    }
    function loadTransaction() {
        $id = $_GET['id'];
        $data = $this->model->loadTransaction($id);
        echo json_encode($data);
    }

    function add() {
        if(self::$funAdd == 0) {
            $jsonObj['msg'] = 'Bạn không có quyền sử dụng chức năng này';
            $jsonObj['success'] = false;
            echo json_encode($jsonObj);
            return false;
        }
        $fullName = isset($_REQUEST['fullName']) ? $_REQUEST['fullName'] : false;
        $shortName = !empty($_REQUEST['shortName']) ? $_REQUEST['shortName'] : $_REQUEST['fullName'];
        $phoneNumber = isset($_REQUEST['phoneNumber']) ? $_REQUEST['phoneNumber'] : false;
        $email = isset($_REQUEST['email']) ? $_REQUEST['email'] : false;
        $website = isset($_REQUEST['website']) ? $_REQUEST['website'] : false;
        $staffId = isset($_REQUEST['staffId']) ? $_REQUEST['staffId'] : '';
        $staffInCharge = isset($_SESSION['user']['id']) ? $_SESSION['user']['id'] : false;
        // $nationalId = isset($_REQUEST['nationalId']) ? $_REQUEST['nationalId'] : '';
        $provinceId = isset($_REQUEST['provinceId']) ? $_REQUEST['provinceId'] : '';
        $classify = !empty($_REQUEST['classify']) ? $_REQUEST['classify'] : 1;
        $status = isset($_REQUEST['status']) ? $_REQUEST['status'] : 1;
        if(!$fullName && !$phoneNumber && !$email && !$website) {
            $jsonObj['msg'] = 'Thông tin không chính xác';
            $jsonObj['success'] = false;
            echo json_encode($jsonObj);
            return;
        }
        $data = array(
            'fullName' => $fullName,
            'name'=>$shortName,
            'phoneNumber' => $phoneNumber,
            'email' => $email,
            'website' => $website,
            'staffId' => $staffId,
            'staffInCharge' => $staffInCharge,
            // 'nationalId' => $nationalId,
            'provinceId' => $provinceId,
            'classify'=>$classify,
            'status'=>$status
        );
            if ($this->model->addObj($data)) {
                $jsonObj['msg'] = 'Cập nhật dữ liệu thành công';
                $jsonObj['success'] = true;
            } else {
                $jsonObj['msg'] = 'Cập nhật dữ liệu không thành công';
                $jsonObj['success'] = false;
            }
        
        echo json_encode($jsonObj);
    }
    function loaddata() {
        $id = $_REQUEST['id'];
        $json = $this->model->getdata($id);
        echo json_encode($json);
    }


    function update()
    {
        if(self::$funEdit == 0) {
            $jsonObj['msg'] = 'Bạn không có quyền sử dụng chức năng này';
            $jsonObj['success'] = false;
            echo json_encode($jsonObj);
            return false;
        }
        $id = $_REQUEST['id'];
        $fullName = isset($_REQUEST['fullName']) ? $_REQUEST['fullName'] : false;
        $shortName = !empty($_REQUEST['shortName']) ? $_REQUEST['shortName'] : $_REQUEST['fullName'];
        $taxCode = isset($_REQUEST['taxCode']) ? $_REQUEST['taxCode'] : '';
        $address = isset($_REQUEST['address']) ? $_REQUEST['address'] : '';
        $phoneNumber = isset($_REQUEST['phoneNumber']) ? $_REQUEST['phoneNumber'] : false;
        $email = isset($_REQUEST['email']) ? $_REQUEST['email'] : false;
        $website = isset($_REQUEST['website']) ? $_REQUEST['website'] : false;
        $staffId = isset($_REQUEST['staffId']) ? $_REQUEST['staffId'] : '';
        $staffInCharge = isset($_SESSION['user']['id']) ? $_SESSION['user']['id'] : '';
   
        $field = isset($_REQUEST['field']) ? $_REQUEST['field'] : '';
     
        // $rank = isset($_REQUEST['rank']) ? $_REQUEST['rank'] : '';
        // $bussinessName = isset($_REQUEST['bussinessName']) ? $_REQUEST['bussinessName'] : '';
        // $bussinessAddress = isset($_REQUEST['bussinessAddress']) ? $_REQUEST['bussinessAddress'] : '';
        $bussinessPlace = isset($_REQUEST['bussinessPlace']) ? $_REQUEST['bussinessPlace'] : '';
        $representative = isset($_REQUEST['representative']) ? $_REQUEST['representative'] : '';
        // $authorized = isset($_REQUEST['authorized']) ? $_REQUEST['authorized'] : '';
        $note = isset($_REQUEST['note']) ? $_REQUEST['note'] : '';
        $classify = isset($_REQUEST['classify']) ? $_REQUEST['classify'] : '';
        $type = isset($_REQUEST['type']) ? $_REQUEST['type'] : '';
        // $nationalId = isset($_REQUEST['nationalId']) ? $_REQUEST['nationalId'] : '';
        $provinceId = isset($_REQUEST['provinceId']) ? $_REQUEST['provinceId'] : '';
        $status = isset($_REQUEST['status']) ? $_REQUEST['status'] : 1;
        if(!$fullName && !$phoneNumber && !$email && !$website) {
            $jsonObj['msg'] = 'Thông tin không chính xác';
            $jsonObj['success'] = false;
            echo json_encode($jsonObj);
            return;
        }

        $data = array(
            'fullName' => $fullName,
            'taxCode' => $taxCode,
            'address' => $address,
            'phoneNumber' => $phoneNumber,
            'email' => $email,
            'website' => $website,
            'staffId' => $staffId,
            'staffInCharge' => $staffInCharge,
            'name' => $shortName,
            'field' => $field,
            // 'rank' => $rank,
            // 'businessName' => $bussinessName,
            // 'businessAddress' => $bussinessAddress,
            'office' => $bussinessPlace,
            'representative' => $representative,
            // 'authorized' => $authorized,
            'note' => $note,
            'classify' => $classify,
            'type'=> $type,
            // 'nationalId' => $nationalId,
            'provinceId' => $provinceId,
            'status'=>$status
        );
       
            if ($this->model->updateObj($id, $data)) {
                $jsonObj['msg'] = 'Cập nhật dữ liệu thành công';
                $jsonObj['success'] = true;
            } else {
                $jsonObj['msg'] = 'Cập nhật dữ liệu không thành công';
                $jsonObj['success'] = false;
            }
 
        echo json_encode($jsonObj);
    }
    function del()
    {
        if(self::$funDel == 0) {
            $jsonObj['msg'] = 'Bạn không có quyền sử dụng chức năng này';
            $jsonObj['success'] = false;
            echo json_encode($jsonObj);
            return false;
        }
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

    function importExcel() {
        if(self::$funImport == 0) {
            $jsonObj['msg'] = 'Bạn không có quyền sử dụng chức năng này';
            $jsonObj['success'] = false;
            echo json_encode($jsonObj);
            return false;
        }
        require_once 'libs/phpexcel/PHPExcel/IOFactory.php';
        try {
            $inputFileType = PHPExcel_IOFactory::identify($_FILES['file']['tmp_name']);
            $objReader = PHPExcel_IOFactory::createReader($inputFileType);
            $objPHPExcel = $objReader->load($_FILES['file']['tmp_name']);
            $objReader->setReadDataOnly(true);
            $objWorksheet = $objPHPExcel->getActiveSheet();
            $highestRow = $objWorksheet->getHighestRow();
            $highestColumn = $objWorksheet->getHighestColumn();
            $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
            $banghi = 0;
            $staffid = isset($_REQUEST['staffId2']) ? $_REQUEST['staffId2'] : '';
            $staffInCharge = isset($_SESSION['user']['id']) ? $_SESSION['user']['id'] : false;
            for ($row = 3; $row <= $highestRow; $row++) {
                $fullName = $objPHPExcel->getActiveSheet()->getCell("B$row")->getValue();
                $shortName = $objPHPExcel->getActiveSheet()->getCell("C$row")->getValue();
                $taxCode = $objPHPExcel->getActiveSheet()->getCell("D$row")->getValue();
                $address = $objPHPExcel->getActiveSheet()->getCell("E$row")->getValue();
                $phoneNumber = $objPHPExcel->getActiveSheet()->getCell("F$row")->getValue();
                $email = $objPHPExcel->getActiveSheet()->getCell("G$row")->getValue();
                $website = $objPHPExcel->getActiveSheet()->getCell("H$row")->getValue();
                $field = $objPHPExcel->getActiveSheet()->getCell("I$row")->getValue();
                $bussinessName = $objPHPExcel->getActiveSheet()->getCell("J$row")->getValue();
                $bussinessAddress = $objPHPExcel->getActiveSheet()->getCell("K$row")->getValue();
                $bussinessPlace = $objPHPExcel->getActiveSheet()->getCell("L$row")->getValue();
                $representative = $objPHPExcel->getActiveSheet()->getCell("M$row")->getValue();
                $authorized = $objPHPExcel->getActiveSheet()->getCell("N$row")->getValue();
                $note = $objPHPExcel->getActiveSheet()->getCell("O$row")->getValue();
                $rank = $objPHPExcel->getActiveSheet()->getCell("P$row")->getValue();
                $type = $objPHPExcel->getActiveSheet()->getCell("Q$row")->getValue();
                $classify = $objPHPExcel->getActiveSheet()->getCell("R$row")->getValue();
              
                        $data = [
                            'fullName' => $fullName,
                            'taxCode' => $taxCode,
                            'address' => $address,
                            'phoneNumber' => $phoneNumber,
                            'email' => $email,
                            'website' => $website,
                            'staffid' => $staffid,
                            'staffInCharge' => $staffInCharge,
                            'shortName' => $shortName,
                            'field' => $field,
                            'rank' => $rank,
                            'businessName' => $bussinessName,
                            'businessAddress' => $bussinessAddress,
                            'businessPlace' => $bussinessPlace,
                            'representative' => $representative,
                            'authorized' => $authorized,
                            'note' => $note,
                            'classify' => $classify,
                            'type'=>$type,
                            'nationalId'=>1,
                            'status'=>1
                        ];
                        if ($this->model->addObj($data))
                            $banghi++;
                    
               
            }
            if ($banghi > 0) {
                $jsonObj['msg'] = "Cập nhật thành công $banghi data";
                $jsonObj['success'] = true;
            } else {
                $jsonObj['msg'] = "Lỗi cập nhật database";
                $jsonObj['success'] = false;
            }
        } catch (Exception $e) {
            $jsonObj['msg'] = "Import dữ liệu không thành công";
            $jsonObj['success'] = false;
        }
        echo json_encode($jsonObj);
    }
    function checkPhone() {
        $idCustomer = $_REQUEST['idCustomer'];
        $phone = $_REQUEST['phone'];
   
       if($this->model->checkPhone($idCustomer, $phone)) {
        $jsonObj['msg'] = "Số điện thoại hợp lệ";
        $jsonObj['success'] = true;
       }
       else {
        $jsonObj['msg'] = "Số điện thoại đã tồn tại";
        $jsonObj['success'] = false;
       }
       echo json_encode($jsonObj);
    }
}
?>