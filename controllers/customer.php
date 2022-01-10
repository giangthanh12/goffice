<?php
class customer extends Controller
{
    function __construct()
    {
        parent::__construct();
    }
    function index(){
        require "layouts/header.php";
        $this->view->render("customer/index");
        require "layouts/footer.php";
    }

    function getStaff()
    {
        $jsonObj = $this->model->getStaff();
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
        $fullName = isset($_REQUEST['fullName']) ? $_REQUEST['fullName'] : false;
        $taxCode = isset($_REQUEST['taxCode']) ? $_REQUEST['taxCode'] : false;
        $address = isset($_REQUEST['address']) ? $_REQUEST['address'] : false;
        $phoneNumber = isset($_REQUEST['phoneNumber']) ? $_REQUEST['phoneNumber'] : false;
        $email = isset($_REQUEST['email']) ? $_REQUEST['email'] : false;
        $website = isset($_REQUEST['website']) ? $_REQUEST['website'] : false;
        $staffId = isset($_REQUEST['staffId']) ? $_REQUEST['staffId'] : false;
        $staffInCharge = isset($_SESSION['user']['id']) ? $_SESSION['user']['id'] : false;
        $office = isset($_REQUEST['office']) ? $_REQUEST['office'] : false;
        $field = isset($_REQUEST['field']) ? $_REQUEST['field'] : false;
        $fieldDetail = isset($_REQUEST['fieldDetail']) ? $_REQUEST['fieldDetail'] : '';
        $rank = isset($_REQUEST['rank']) ? $_REQUEST['rank'] : false;
        $bussinessName = isset($_REQUEST['bussinessName']) ? $_REQUEST['bussinessName'] : false;
        $bussinessAddress = isset($_REQUEST['bussinessAddress']) ? $_REQUEST['bussinessAddress'] : false;
        $bussinessPlace = isset($_REQUEST['bussinessPlace']) ? $_REQUEST['bussinessPlace'] : false;
        $representative = isset($_REQUEST['representative']) ? $_REQUEST['representative'] : false;
        $authorized = isset($_REQUEST['authorized']) ? $_REQUEST['authorized'] : false;
        $note = isset($_REQUEST['note']) ? $_REQUEST['note'] : '';
        $classify = isset($_REQUEST['classify']) ? $_REQUEST['classify'] : false;
        $type = isset($_REQUEST['type']) ? $_REQUEST['type'] : false;
        $nationalId = isset($_REQUEST['nationalId']) ? $_REQUEST['nationalId'] : false;
        $provinceId = isset($_REQUEST['provinceId']) ? $_REQUEST['provinceId'] : false;
        $status = isset($_REQUEST['status']) ? $_REQUEST['status'] : 2;
        if(!$fullName && !$taxCode && !$address && !$phoneNumber && !$email && !$website && !$staffId && !$staffInCharge && !$office && !$field && !$rank && !$bussinessName && !$bussinessAddress && !$bussinessPlace && !$representative && !$authorized && !$classify && !$nationalId && !$provinceId && !$type ) {
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
            'staffid' => $staffId,
            'staffInCharge' => $staffInCharge,
            'office' => $office,
            'field' => $field,
            'fieldDetail' => $fieldDetail,
            'rank' => $rank,
            'businessName' => $bussinessName,
            'businessAddress' => $bussinessAddress,
            'businessPlace' => $bussinessPlace,
            'representative' => $representative,
            'authorized' => $authorized,
            'note' => $note,
            'classify' => $classify,
            'type'=> $type,
            'nationalId' => $nationalId,
            'provinceId' => $provinceId,
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
        $id = $_REQUEST['id'];
        $fullName = isset($_REQUEST['fullName']) ? $_REQUEST['fullName'] : false;
        $taxCode = isset($_REQUEST['taxCode']) ? $_REQUEST['taxCode'] : false;
        $address = isset($_REQUEST['address']) ? $_REQUEST['address'] : false;
        $phoneNumber = isset($_REQUEST['phoneNumber']) ? $_REQUEST['phoneNumber'] : false;
        $email = isset($_REQUEST['email']) ? $_REQUEST['email'] : false;
        $website = isset($_REQUEST['website']) ? $_REQUEST['website'] : false;
        $staffId = isset($_REQUEST['staffId']) ? $_REQUEST['staffId'] : false;
        $staffInCharge = isset($_SESSION['user']['id']) ? $_SESSION['user']['id'] : false;
        $office = isset($_REQUEST['office']) ? $_REQUEST['office'] : false;
        $field = isset($_REQUEST['field']) ? $_REQUEST['field'] : false;
        $fieldDetail = isset($_REQUEST['fieldDetail']) ? $_REQUEST['fieldDetail'] : '';
        $rank = isset($_REQUEST['rank']) ? $_REQUEST['rank'] : false;
        $bussinessName = isset($_REQUEST['bussinessName']) ? $_REQUEST['bussinessName'] : false;
        $bussinessAddress = isset($_REQUEST['bussinessAddress']) ? $_REQUEST['bussinessAddress'] : false;
        $bussinessPlace = isset($_REQUEST['bussinessPlace']) ? $_REQUEST['bussinessPlace'] : false;
        $representative = isset($_REQUEST['representative']) ? $_REQUEST['representative'] : false;
        $authorized = isset($_REQUEST['authorized']) ? $_REQUEST['authorized'] : false;
        $note = isset($_REQUEST['note']) ? $_REQUEST['note'] : '';
        $classify = isset($_REQUEST['classify']) ? $_REQUEST['classify'] : false;
        $type = isset($_REQUEST['type']) ? $_REQUEST['type'] : false;
        $nationalId = isset($_REQUEST['nationalId']) ? $_REQUEST['nationalId'] : false;
        $provinceId = isset($_REQUEST['provinceId']) ? $_REQUEST['provinceId'] : false;
        $status = isset($_REQUEST['status']) ? $_REQUEST['status'] : 2;
        if(!$fullName && !$taxCode && !$address && !$phoneNumber && !$email && !$website && !$staffId && !$staffInCharge && !$office && !$field && !$rank && !$bussinessName && !$bussinessAddress && !$bussinessPlace && !$representative && !$authorized && !$classify && !$nationalId && !$provinceId && !$type ) {
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
            'staffid' => $staffId,
            'staffInCharge' => $staffInCharge,
            'office' => $office,
            'field' => $field,
            'fieldDetail' => $fieldDetail,
            'rank' => $rank,
            'businessName' => $bussinessName,
            'businessAddress' => $bussinessAddress,
            'businessPlace' => $bussinessPlace,
            'representative' => $representative,
            'authorized' => $authorized,
            'note' => $note,
            'classify' => $classify,
            'type'=> $type,
            'nationalId' => $nationalId,
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
        $id = $_REQUEST['id'];
        $data = ['status' => 2];
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
                $taxCode = $objPHPExcel->getActiveSheet()->getCell("C$row")->getValue();
                $address = $objPHPExcel->getActiveSheet()->getCell("D$row")->getValue();
                $phoneNumber = $objPHPExcel->getActiveSheet()->getCell("E$row")->getValue();
                $email = $objPHPExcel->getActiveSheet()->getCell("F$row")->getValue();
                $website = $objPHPExcel->getActiveSheet()->getCell("G$row")->getValue();
                $office = $objPHPExcel->getActiveSheet()->getCell("H$row")->getValue();
                $field = $objPHPExcel->getActiveSheet()->getCell("I$row")->getValue();
                $fieldDetail = $objPHPExcel->getActiveSheet()->getCell("J$row")->getValue();
                $bussinessName = $objPHPExcel->getActiveSheet()->getCell("K$row")->getValue();
                $bussinessAddress = $objPHPExcel->getActiveSheet()->getCell("L$row")->getValue();
                $bussinessPlace = $objPHPExcel->getActiveSheet()->getCell("M$row")->getValue();
                $representative = $objPHPExcel->getActiveSheet()->getCell("N$row")->getValue();
                $authorized = $objPHPExcel->getActiveSheet()->getCell("O$row")->getValue();
                $note = $objPHPExcel->getActiveSheet()->getCell("P$row")->getValue();
                $rank = $objPHPExcel->getActiveSheet()->getCell("Q$row")->getValue();
                $type = $objPHPExcel->getActiveSheet()->getCell("R$row")->getValue();
                $classify = $objPHPExcel->getActiveSheet()->getCell("S$row")->getValue();
              
                        $data = [
                            'fullName' => $fullName,
                            'taxCode' => $taxCode,
                            'address' => $address,
                            'phoneNumber' => $phoneNumber,
                            'email' => $email,
                            'website' => $website,
                            'staffid' => $staffid,
                            'staffInCharge' => $staffInCharge,
                            'office' => $office,
                            'field' => $field,
                            'rank' => $rank,
                            'fieldDetail' => $fieldDetail,
                            'businessName' => $bussinessName,
                            'businessAddress' => $bussinessAddress,
                            'businessPlace' => $bussinessPlace,
                            'representative' => $representative,
                            'authorized' => $authorized,
                            'note' => $note,
                            'classify' => $classify,
                            'type'=>$type,
                            'nationalId'=>237,
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
}
?>