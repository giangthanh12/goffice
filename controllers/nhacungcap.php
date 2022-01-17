<?php
class Nhacungcap extends Controller{
    function __construct(){
        parent::__construct();
    }
    function index(){
        require "layouts/header.php";
        $this->view->render("nhacungcap/index");
        require "layouts/footer.php";
    }

    function nhapexcel()
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
                $tendaydu = $objPHPExcel->getActiveSheet()->getCell("B$row")->getValue();
                $daidien = $objPHPExcel->getActiveSheet()->getCell("C$row")->getValue();
                $dienthoai = $objPHPExcel->getActiveSheet()->getCell("D$row")->getValue();
                if ($tendaydu != '') {
                    $dienthoai = str_replace("'", "", $dienthoai);
                    $checkdt = $this->model->checkdt($dienthoai);
                    if ($checkdt == false) {
                        $email = $objPHPExcel->getActiveSheet()->getCell("E$row")->getValue();
                        $website = $objPHPExcel->getActiveSheet()->getCell("F$row")->getValue();
                        $vanphong = $objPHPExcel->getActiveSheet()->getCell("G$row")->getValue();
                        $diachi = $objPHPExcel->getActiveSheet()->getCell("H$row")->getValue();
                        $maso = $objPHPExcel->getActiveSheet()->getCell("I$row")->getValue();
                        $chucvu = $objPHPExcel->getActiveSheet()->getCell("J$row")->getValue();
                        $ghichu = $objPHPExcel->getActiveSheet()->getCell("K$row")->getValue();
                        $data = [
                            'taxCode' => $maso,
                            'fullName' => $tendaydu,
                            'address' => $diachi,
                            'website' => $website,
                            'phoneNumber' => $dienthoai,
                            'email' => $email,
                            'office' => $vanphong,
                            'representative' => $daidien,
                            'position' => $chucvu,
                            'note' => $ghichu,
                            'date' => date('Y-m-d'),
                            'staffId' => $_SESSION['user']['staffId'],
                            'classify' => 1,
                            'status' => 1
                        ];
                        if ($this->model->addObj($data))
                            $banghi++;
                    } else {
                        if($checkdt['classify'] != 2){
                            $id = $checkdt['id'];
                            $data = [
                                'classify' => 3
                            ];
                            if ($this->model->updateObj($id, $data))
                                $banghi++;
                        }
                    }
                }
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

    function list()
    {
        $data = $this->model->listObj();
        echo json_encode($data);
    }

    function combo(){
        $json = $this->model->get_data_combo();
        echo json_encode($json);
    }

    function loaddata()
    {
        $id=isset($_REQUEST['id'])?$_REQUEST['id']:0;
        $json = $this->model->getdata($id);
        echo json_encode($json);
    }

    function add()
    {
        $maso = $_REQUEST['ma_so'];
        $name = $_REQUEST['name'];
        $fullname = $_REQUEST['ten_day_du'];
        if (strlen($fullname) == 0)
            $fullname = $name;
        $diachi = $_REQUEST['dia_chi'];
        $website = $_REQUEST['website'];
        $dienthoai = $_REQUEST['dien_thoai'];
        $email = $_REQUEST['email'];
        $vanphong = $_REQUEST['van_phong'];
        $daidien = $_REQUEST['dai_dien'];
        $chucvu = $_REQUEST['chuc_vu'];
        $phutrach = $_REQUEST['phu_trach'];
        $loai = $_REQUEST['loai'];
        $linhvuc = $_REQUEST['linh_vuc'];
        $ghichu = $_REQUEST['ghi_chu'];
        $phanloai = $_REQUEST['phan_loai'];
        $data = array(
            'name' => $name,
            'taxCode' => $maso,
            'fullName' => $fullname,
            'address' => $diachi,
            'website' => $website,
            'phoneNumber' => $dienthoai,
            'email' => $email,
            'office' => $vanphong,
            'representative' => $daidien,
            'position' => $chucvu,
            'type' => $loai,
            'field' => $linhvuc,
            'note' => $ghichu,
            'date' => date('Y-m-d'),
            'staffId' => $_SESSION['user']['staffId'],
            'staffInCharge' => $phutrach,
            'classify' => $phanloai,
            'status' => 1
        );
        if($this->model->addObj($data)){
            $jsonObj['msg'] = 'Cập nhật dữ liệu thành công';
            $jsonObj['success'] = true;
        } else {
            $jsonObj['msg'] = 'Lỗi cập nhật database';
            $jsonObj['success'] = false;
        }
        echo json_encode($jsonObj);
    }

    function update()
    {
        $id = $_REQUEST['id'];
        $maso = $_REQUEST['ma_so'];
        $name = $_REQUEST['name'];
        $fullname = $_REQUEST['ten_day_du'];
        if (strlen($fullname) == 0)
            $fullname = $name;
        $diachi = $_REQUEST['dia_chi'];
        $website = $_REQUEST['website'];
        $dienthoai = $_REQUEST['dien_thoai'];
        $email = $_REQUEST['email'];
        $vanphong = $_REQUEST['van_phong'];
        $daidien = $_REQUEST['dai_dien'];
        $chucvu = $_REQUEST['chuc_vu'];
        $phutrach = $_REQUEST['phu_trach'];
        $loai = $_REQUEST['loai'];
        $tinhtrang = $_REQUEST['tinh_trang'];
        $linhvuc = $_REQUEST['linh_vuc'];
        $ghichu = $_REQUEST['ghi_chu'];
        $phanloai = $_REQUEST['phan_loai'];
        $data = array(
            'name' => $name,
            'taxCode' => $maso,
            'fullName' => $fullname,
            'address' => $diachi,
            'website' => $website,
            'phoneNumber' => $dienthoai,
            'email' => $email,
            'office' => $vanphong,
            'representative' => $daidien,
            'position' => $chucvu,
            'type' => $loai,
            'field' => $linhvuc,
            'note' => $ghichu,
            'date' => date('Y-m-d'),
            'staffInCharge' => $phutrach,
            'classify' => $phanloai,
            'status' => $tinhtrang
        );
        if($this->model->updateObj($id, $data)){
            $jsonObj['msg'] = 'Cập nhật dữ liệu thành công';
            $jsonObj['success'] = true;
        } else {
            $jsonObj['msg'] = 'Lỗi cập nhật database';
            $jsonObj['success'] = false;
        }
        echo json_encode($jsonObj);
    }

    function del()
    {
        $id = $_REQUEST['id'];
        $data = ['status'=>0];
        if($this->model->delObj($id,$data)){
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