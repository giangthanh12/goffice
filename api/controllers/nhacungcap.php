<?php
class Nhacungcap extends Controller{
    function __construct(){
        parent::__construct();
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
                            'ma_so' => $maso,
                            'ten_day_du' => $tendaydu,
                            'dia_chi' => $diachi,
                            'website' => $website,
                            'dien_thoai' => $dienthoai,
                            'email' => $email,
                            'van_phong' => $vanphong,
                            'dai_dien' => $daidien,
                            'chuc_vu' => $chucvu,
                            'ghi_chu' => $ghichu,
                            'ngay' => date('Y-m-d'),
                            'nhan_vien' => $_SESSION['user']['nhan_vien'],
                            'phan_loai' => 1,
                            'tinh_trang' => 1
                        ];
                        if ($this->model->addObj($data))
                            $banghi++;
                    } else {
                        if($checkdt['phan_loai'] != 2){
                            $id = $checkdt['id'];
                            $data = [
                                'phan_loai' => 3
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
            'ma_so' => $maso,
            'ten_day_du' => $fullname,
            'dia_chi' => $diachi,
            'website' => $website,
            'dien_thoai' => $dienthoai,
            'email' => $email,
            'van_phong' => $vanphong,
            'dai_dien' => $daidien,
            'chuc_vu' => $chucvu,
            'loai' => $loai,
            'linh_vuc' => $linhvuc,
            'ghi_chu' => $ghichu,
            'ngay' => date('Y-m-d'),
            'nhan_vien' => $_SESSION['user']['nhan_vien'],
            'phu_trach' => $phutrach,
            'phan_loai' => $phanloai,
            'tinh_trang' => 1
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
            'ma_so' => $maso,
            'ten_day_du' => $fullname,
            'dia_chi' => $diachi,
            'website' => $website,
            'dien_thoai' => $dienthoai,
            'email' => $email,
            'van_phong' => $vanphong,
            'dai_dien' => $daidien,
            'chuc_vu' => $chucvu,
            'loai' => $loai,
            'linh_vuc' => $linhvuc,
            'ghi_chu' => $ghichu,
            'phu_trach' => $phutrach,
            'phan_loai' => $phanloai,
            'tinh_trang' => $tinhtrang
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
        $data = ['tinh_trang'=>0];
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