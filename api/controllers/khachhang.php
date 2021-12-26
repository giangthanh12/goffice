<?php
class Khachhang extends Controller
{
    function __construct()
    {
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
            $phutrach = isset($_REQUEST['phutrach_import']) ? $_REQUEST['phutrach_import'] : '';
            if($phutrach == ""){$phutrach = $_SESSION['user']['nhan_vien'];}
            for ($row = 3; $row <= $highestRow; $row++) {
                $tendaydu = $objPHPExcel->getActiveSheet()->getCell("B$row")->getValue();
                $daidien = $objPHPExcel->getActiveSheet()->getCell("C$row")->getValue();
                $dienthoai = $objPHPExcel->getActiveSheet()->getCell("D$row")->getValue();
                if ($tendaydu != '') {
                    $dienthoai = str_replace("'", "", $dienthoai);
                    $checkdt = $this->model->checkdt($dienthoai);
                    if ($checkdt == true) {
                        $email = $objPHPExcel->getActiveSheet()->getCell("D$row")->getValue();
                        $diachi = $objPHPExcel->getActiveSheet()->getCell("E$row")->getValue();
                        $congty = $objPHPExcel->getActiveSheet()->getCell("F$row")->getValue();
                        $mst = $objPHPExcel->getActiveSheet()->getCell("G$row")->getValue();
                        $linhvuc = $objPHPExcel->getActiveSheet()->getCell("H$row")->getValue();
                        $website = $objPHPExcel->getActiveSheet()->getCell("I$row")->getValue();
                        $social = $objPHPExcel->getActiveSheet()->getCell("J$row")->getValue();
                        $ghichu = $objPHPExcel->getActiveSheet()->getCell("K$row")->getValue();
                        $data = [
                            'ma_so' => $mst,
                            'ten_day_du' => $tendaydu,
                            'dia_chi' => $diachi,
                            'website' => $website,
                            'dien_thoai' => $dienthoai,
                            'email' => $email,
                            'ghi_chu' => $ghichu,
                            'ngay' => date('Y-m-d'),
                            'nhan_vien' => $phutrach,
                            'phan_loai' => 1,
                            'tinh_trang' => 1,
                            'cong_ty' => $congty,

                          
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
        $id = $_REQUEST['id'];
        $json = $this->model->getdata($id);
        echo json_encode($json);
    }

    function loaddichvu()
    {
        $id = isset($_REQUEST['id']) ? $_REQUEST['id'] : 0;
        $json = $this->model->loaddichvu($id);
        echo json_encode($json);
    }

    function add()
    {
        $maso = isset($_REQUEST['ma_so']) ? $_REQUEST['ma_so'] : '';
        $name = isset($_REQUEST['name']) ? $_REQUEST['name'] : '';
        $fullname = isset($_REQUEST['ten_day_du']) ? $_REQUEST['ten_day_du'] : '';
        if (strlen($fullname) == 0)
            $fullname = $name;
        $diachi = isset($_REQUEST['dia_chi']) ? $_REQUEST['dia_chi'] : '';
        $website = isset($_REQUEST['website']) ? $_REQUEST['website'] : '';
        $dienthoai = isset($_REQUEST['dien_thoai']) ? $_REQUEST['dien_thoai'] : '';
        $email = isset($_REQUEST['email']) ? $_REQUEST['email'] : '';
        $vanphong = isset($_REQUEST['van_phong']) ? $_REQUEST['van_phong'] : '';
        $daidien = isset($_REQUEST['dai_dien']) ? $_REQUEST['dai_dien'] : '';
        $chucvu = isset($_REQUEST['chuc_vu']) ? $_REQUEST['chuc_vu'] : '';
        
        $loai = isset($_REQUEST['loai']) ? $_REQUEST['loai'] : 0;
        $linhvuc = isset($_REQUEST['linh_vuc']) ? $_REQUEST['linh_vuc'] : 0;
        $ghichu = isset($_REQUEST['ghi_chu']) ? $_REQUEST['ghi_chu'] : '';
        $phanloai = isset($_REQUEST['phan_loai']) ? $_REQUEST['phan_loai'] : 3;
        $userid = isset($_SESSION['user']['nhan_vien']) ? $_SESSION['user']['nhan_vien'] : $_REQUEST['nhan_vien'];

        $phutrach = isset($_REQUEST['phu_trach']) ? $_REQUEST['phu_trach'] : '';
        if($phutrach == ""){$phutrach = $_SESSION['user']['nhan_vien'];}
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
            'nhan_vien' => $userid,
            'phu_trach' => $phutrach,
            'phan_loai' => $phanloai,
            'tinh_trang' => 1
        );
        $checkdt = $this->model->checkdt($dienthoai);
        if ($checkdt == true) {
            if ($this->model->addObj($data)) {
                $jsonObj['msg'] = 'Cập nhật dữ liệu thành công';
                $jsonObj['success'] = true;
            } else {
                $jsonObj['msg'] = 'Cập nhật dữ liệu không thành công';
                $jsonObj['success'] = false;
            }
        } else {
            $jsonObj['msg'] = 'Số điện thoại đã tồn tại trong hệ thống';
            $jsonObj['success'] = false;
        }
        echo json_encode($jsonObj);
    }

    function update()
    {
        $id = $_REQUEST['id'];
        $maso = isset($_REQUEST['ma_so']) ? $_REQUEST['ma_so'] : '';
        $name = isset($_REQUEST['name']) ? $_REQUEST['name'] : '';
        $fullname = isset($_REQUEST['ten_day_du']) ? $_REQUEST['ten_day_du'] : '';
        if (strlen($fullname) == 0)
            $fullname = $name;
        $diachi = isset($_REQUEST['dia_chi']) ? $_REQUEST['dia_chi'] : '';
        $website = isset($_REQUEST['website']) ? $_REQUEST['website'] : '';
        $dienthoai = isset($_REQUEST['dien_thoai']) ? $_REQUEST['dien_thoai'] : '';
        $email = isset($_REQUEST['email']) ? $_REQUEST['email'] : '';
        $vanphong = isset($_REQUEST['van_phong']) ? $_REQUEST['van_phong'] : '';
        $daidien = isset($_REQUEST['dai_dien']) ? $_REQUEST['dai_dien'] : '';
        $chucvu = isset($_REQUEST['chuc_vu']) ? $_REQUEST['chuc_vu'] : '';
        $phutrach = isset($_REQUEST['phu_trach']) ? $_REQUEST['phu_trach'] : 0;
        $loai = isset($_REQUEST['loai']) ? $_REQUEST['loai'] : 0;
        $tinhtrang = isset($_REQUEST['tinh_trang']) ? $_REQUEST['tinh_trang'] : 0;
        $linhvuc = isset($_REQUEST['linh_vuc']) ? $_REQUEST['linh_vuc'] : 0;
        $ghichu = isset($_REQUEST['ghi_chu']) ? $_REQUEST['ghi_chu'] : '';
        $phanloai = isset($_REQUEST['phan_loai']) ? $_REQUEST['phan_loai'] : 3;
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
        $checkdt = $this->model->checkeditdt($dienthoai,$id);
        if ($checkdt == true) {
            if ($this->model->updateObj($id, $data)) {
                $jsonObj['msg'] = 'Cập nhật dữ liệu thành công';
                $jsonObj['success'] = true;
            } else {
                $jsonObj['msg'] = 'Cập nhật dữ liệu không thành công';
                $jsonObj['success'] = false;
            }
        } else {
            $jsonObj['msg'] = 'Số điện thoại đã tồn tại trong hệ thống';
            $jsonObj['success'] = false;
        }
        echo json_encode($jsonObj);
    }

    function del()
    {
        $id = $_REQUEST['id'];
        $data = ['tinh_trang' => 0];
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
