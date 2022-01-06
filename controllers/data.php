<?php
class data extends Controller
{
    function __construct()
    {
        parent::__construct();
    }

    function index()
    {
        require "layouts/header.php";
        $this->view->render("data/index");
        require "layouts/footer.php";
    }

    // function movetolead()
    // {
    //     $data = $_REQUEST['data'];
    //     if ($this->model->movetolead($data)) {
    //         $jsonObj['msg'] = "Cập nhật dữ liệu thành công";
    //         $jsonObj['success'] = true;
    //     } else {
    //         $jsonObj['msg'] = "Cập nhật dữ liệu không thành công";
    //         $jsonObj['success'] = false;
    //     }
    //     echo json_encode($jsonObj);
    // }

    // function movelead_id()
    // {
    //     $data = $_REQUEST['id'];
    //     if ($this->model->movetolead($data)) {
    //         $jsonObj['msg'] = "Cập nhật dữ liệu thành công";
    //         $jsonObj['success'] = true;
    //     } else {
    //         $jsonObj['msg'] = "Cập nhật dữ liệu không thành công";
    //         $jsonObj['success'] = false;
    //     }
    //     echo json_encode($jsonObj);
    // }

    function importData()
    {
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

            for ($row = 3; $row <= $highestRow; $row++) {
                $tenkh = $objPHPExcel->getActiveSheet()->getCell("B$row")->getValue();
                $phoneNumber = $objPHPExcel->getActiveSheet()->getCell("C$row")->getValue();
                if ($tenkh != '') {
                    $phoneNumber = str_replace("'", "", $phoneNumber);
                    $checkPhoneNumber = $this->model->checkPhoneNumber($phoneNumber, 0);
                    if ($checkPhoneNumber == true) {
                        $email = $objPHPExcel->getActiveSheet()->getCell("D$row")->getValue();
                        $diachi = $objPHPExcel->getActiveSheet()->getCell("E$row")->getValue();
                        $congty = $objPHPExcel->getActiveSheet()->getCell("F$row")->getValue();
                        $mst = $objPHPExcel->getActiveSheet()->getCell("G$row")->getValue();
                        // $linhvuc = $objPHPExcel->getActiveSheet()->getCell("H$row")->getValue();
                        $website = $objPHPExcel->getActiveSheet()->getCell("H$row")->getValue();
                        $social = $objPHPExcel->getActiveSheet()->getCell("I$row")->getValue();
                        $ghichu = $objPHPExcel->getActiveSheet()->getCell("J$row")->getValue();
                        $data = [
                            'inputDate' => date('Y-m-d'),
                            'name' => $tenkh,
                            'phoneNumber' => $phoneNumber,
                            'email' => $email,
                            'note' => $ghichu,
                            'address' => $diachi,
                            'connectorName' => $congty,
                            'taxCode' => $mst,
                            // 'linh_vuc' => $linhvuc,
                            'website' => $website,
                            'social' => $social,
                            'status' => 1
                        ];
                        if ($this->model->addObj($data))
                            $banghi++;
                    }
                }
            }
            if ($banghi > 0) {
                $jsonObj['msg'] = "Cập nhật thành công $banghi data";
                $jsonObj['success'] = true;
            } else {
                $jsonObj['msg'] = "Data đã tồn tại ";
                $jsonObj['success'] = false;
            }
        } catch (Exception $e) {
            $jsonObj['msg'] = "Import dữ liệu không thành công";
            $jsonObj['success'] = false;
        }
        echo json_encode($jsonObj);
    }

    // function listAll()
    // {
    //     $result = $this->model->listAll();
    //     echo json_encode($result);
    // }

    function list()
    {
        // $phutrach = isset($_SESSION['user']['staffId']) ? $_SESSION['user']['staffId'] : (isset($_REQUEST['phu_trach']) ? $$_REQUEST['phu_trach'] : '');
        $keyword = isset($_REQUEST['search']['value']) ? $_REQUEST['search']['value'] : (isset($_REQUEST['keyword']) ? $_REQUEST['keyword'] : '');
        $offset = isset($_REQUEST['start']) ? $_REQUEST['start'] : 0;
        $rows = isset($_REQUEST['length']) ? $_REQUEST['length'] : 30;
        // $page = isset($_REQUEST['page']) ? $_REQUEST['page']: 1;
        // $offset = ($page - 1) * $rows;
        $nhanvien = isset($_REQUEST['nhanvien']) && $_REQUEST['nhanvien'] != '' && $_REQUEST['nhanvien'] != 0 ? $_REQUEST['nhanvien'] : '';
        $tungay = isset($_REQUEST['tu_ngay']) && $_REQUEST['tu_ngay'] != '' ? date("Y-m-d", strtotime(str_replace('/', '-', $_REQUEST['tu_ngay']))) : '';
        $denngay = isset($_REQUEST['den_ngay']) && $_REQUEST['den_ngay'] != '' ? date("Y-m-d", strtotime(str_replace('/', '-', $_REQUEST['den_ngay']))) : '';
        $result = $this->model->listObj($keyword, $nhanvien, $tungay, $denngay, $offset, $rows);
        $totalData = $result['total'];

        $data['data'] = $result['data'];
        $data['draw'] = intval(isset($_REQUEST['draw']) ? $_REQUEST['draw'] : 1);
        $data['recordsTotal'] = $totalData;
        $data['recordsFiltered'] = $totalData;
        echo json_encode($data);
    }

    // function listApi()
    // {
    //     $keyword =  isset($_REQUEST['keyword']) ? $_REQUEST['keyword'] : '';
    //     $rows = isset($_REQUEST['length']) ? $_REQUEST['length'] : 30;
    //     $page = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
    //     $offset = ($page - 1) * $rows;
    //     $result = $this->model->listObjApi($keyword, $offset, $rows);
    //     echo json_encode($result);
    // }

    function loaddata()
    {
        $id = isset($_REQUEST['id']) ? $_REQUEST['id'] : 0;
        $json = $this->model->getData($id);
        echo json_encode($json);
    }

    function loadhistory()
    {
        $id = isset($_REQUEST['id']) ? $_REQUEST['id'] : 0;
        $json = $this->model->getHistory($id);
        echo json_encode($json);
    }

    function add()
    {
        $data['name'] = isset($_REQUEST['name']) ? $_REQUEST['name'] : '';
        $data['phoneNumber'] = isset($_REQUEST['phoneNumber']) ? $_REQUEST['phoneNumber'] : '';
        $data['address'] = isset($_REQUEST['address']) ? $_REQUEST['address'] : '';
        $data['email'] = isset($_REQUEST['email']) ? $_REQUEST['email'] : '';
        $data['sourceId'] = isset($_REQUEST['sourceId']) ? $_REQUEST['sourceId'] : 0;
        $data['note'] = isset($_REQUEST['note']) ? $_REQUEST['note'] : '';
        $data['inputId'] = isset($_SESSION['user']['staffId']) ? $_SESSION['user']['staffId'] : (isset($_REQUEST['inputId']) ? $_REQUEST['inputId'] : 0);
        $data['inputDate'] = date('Y-m-d');
        $data['status'] = 1;
        $checkPhoneNumber = $this->model->checkPhoneNumber($data['phoneNumber'], 0);
        if ($checkPhoneNumber == true) {
            if ($this->model->addObj($data)) {
                $jsonObj['msg'] = "Cập nhật dữ liệu thành công";
                $jsonObj['success'] = true;
            } else {
                $jsonObj['msg'] = "Cập nhật dữ liệu không thành công";
                $jsonObj['success'] = false;
            }
        } else {
            $jsonObj['msg'] = "Số điện thoại đã tồn tại trong hệ thống!";
            $jsonObj['success'] = false;
        }

        echo json_encode($jsonObj);
    }

    function update()
    {
        $id = $_REQUEST['id'];
        $data['name'] = isset($_REQUEST['ename']) ? $_REQUEST['ename'] : '';
        $data['phoneNumber'] = isset($_REQUEST['ephoneNumber']) ? $_REQUEST['ephoneNumber'] : '';
        $data['address'] = isset($_REQUEST['eaddress']) ? $_REQUEST['eaddress'] : '';
        $data['email'] = isset($_REQUEST['eemail']) ? $_REQUEST['eemail'] : '';
        $data['sourceId'] = isset($_REQUEST['esourceId']) ? $_REQUEST['esourceId'] : 0;
        $data['connectorName'] = isset($_REQUEST['econnectorName']) ? $_REQUEST['econnectorName'] : '';
        $data['taxCode'] = isset($_REQUEST['etaxCode']) ? $_REQUEST['etaxCode'] : '';
        $data['type'] = isset($_REQUEST['etype']) ? $_REQUEST['etype'] : 0;
        $data['note'] = isset($_REQUEST['enote']) ? $_REQUEST['enote'] : '';
        $staffId = isset($_REQUEST['estaffId']) ? $_REQUEST['estaffId'] : 0;
        if ($staffId != 0) {
            $data['staffId'] = $staffId;
            $data['assignmentDate'] = date('Y-m-d');
        } 
        $data['status'] = isset($_REQUEST['estatus']) ? $_REQUEST['estatus'] : 1;
        $checkPhoneNumber = $this->model->checkPhoneNumber($data['phoneNumber'], $id);
        if ($checkPhoneNumber == true) {
            if ($this->model->updateObj($id, $data)) {
                $jsonObj['msg'] = 'Cập nhật dữ liệu thành công';
                $jsonObj['success'] = true;
            } else {
                $jsonObj['msg'] = 'Cập nhật dữ liệu không thành công';
                $jsonObj['success'] = false;
            }
        } else {
            $jsonObj['msg'] = "Số điện thoại đã tồn tại trong hệ thống!";
            $jsonObj['success'] = false;
        }
        echo json_encode($jsonObj);
    }

    function chiadata()
    {
        $data = $_REQUEST['data'];
        $staffId = $_REQUEST['cstaffId'];
        if ($this->model->chiadata($staffId, $data)) {
            $jsonObj['msg'] = "Cập nhật dữ liệu thành công";
            $jsonObj['success'] = true;
        } else {
            $jsonObj['msg'] = "Cập nhật dữ liệu không thành công";
            $jsonObj['success'] = false;
        }

        echo json_encode($jsonObj);
    }

    function addDataReport()
    {
        $dataId = $_REQUEST['dataId'];
        $description = $_REQUEST['description'];
        $staffId = isset($_SESSION['user']['staffId']) ? $_SESSION['user']['staffId'] : 0;
        $data = [
            'dataId' => $dataId,
            'staffId' => $staffId,
            'dateTime' => date('Y-m-d H:i:s'),
            'description' => $description,
            'status' => 1
        ];
        if ($this->model->addDataReport($data)) {
            $jsonObj['msg'] = "Cập nhật nhật ký thành công";
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
        if ($this->model->updateObj($id, $data)) {
            $jsonObj['msg'] = "Xóa dữ liệu thành công";
            $jsonObj['success'] = true;
        } else {
            $jsonObj['msg'] = "Xóa dữ liệu không thành công";
            $jsonObj['success'] = false;
        }
        echo json_encode($jsonObj);
    }
}
