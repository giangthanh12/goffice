<?php
class Lead extends Controller
{
    function __construct()
    {
        parent::__construct();
    }

    function movetokh()
    {
        $data = $_REQUEST['data'];
        $rows = explode(',', $data);
        foreach ($rows as $row) {
            $id = $row;
            $data = $this->model->loaddata($id);
            $data = [
                'ten_day_du' => $data['ho_ten'],
                'dia_chi' => $data['dia_chi'],
                'dien_thoai' => $data['dien_thoai'],
                'email' => $data['email'],
                'cong_ty' => $data['cong_ty'],
                'ma_so' => $data['mst'],
                'website' => $data['website'],
                'nhan_vien' => $_SESSION['user']['nhan_vien'],
                'phu_trach' => $data['nhan_vien'],
                'phan_loai' => 1,
                'tinh_trang' => 1,
                'ngay' => date('Y-m-d')
            ];
            $update = ['tinh_trang' => 9];
            $this->model->updateObj($id, $update);
        }
        if ($this->model->movetokh($data)) {
            $jsonObj['msg'] = "Cập nhật dữ liệu thành công";
            $jsonObj['success'] = true;
        } else {
            $jsonObj['msg'] = "Cập nhật dữ liệu không thành công";
            $jsonObj['success'] = false;
        }
        echo json_encode($jsonObj);
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
            $phutrach = isset($_REQUEST['phutrach_import']) ? $_REQUEST['phutrach_import'] : '';
            if($phutrach == ""){$phutrach = $_SESSION['user']['nhan_vien'];}

            $banghi = 0;
            for ($row = 3; $row <= $highestRow; $row++) {
                $tenkh = $objPHPExcel->getActiveSheet()->getCell("B$row")->getValue();
                $dienthoai = $objPHPExcel->getActiveSheet()->getCell("C$row")->getValue();
                if ($tenkh != '') {
                    $dienthoai = str_replace("'", "", $dienthoai);
                    $checkdt = $this->model->checkdt($dienthoai);
                    if ($checkdt == false) {
                        $email = $objPHPExcel->getActiveSheet()->getCell("D$row")->getValue();
                        $diachi = $objPHPExcel->getActiveSheet()->getCell("E$row")->getValue();
                        $congty = $objPHPExcel->getActiveSheet()->getCell("F$row")->getValue();
                        $mst = $objPHPExcel->getActiveSheet()->getCell("G$row")->getValue();
                        $linhvuc = $objPHPExcel->getActiveSheet()->getCell("H$row")->getValue();
                        $website = $objPHPExcel->getActiveSheet()->getCell("I$row")->getValue();
                        $social = $objPHPExcel->getActiveSheet()->getCell("J$row")->getValue();
                        $ghichu = $objPHPExcel->getActiveSheet()->getCell("K$row")->getValue();
                        $data = [
                            'ngay_nhap' => date('Y-m-d'),
                            'ho_ten' => $tenkh,
                            'dien_thoai' => $dienthoai,
                            'email' => $email,
                            'ghi_chu' => $ghichu,
                            'dia_chi' => $diachi,
                            'cong_ty' => $congty,
                            'mst' => $mst,
                            'linh_vuc' => $linhvuc,
                            'website' => $website,
                            'social' => $social,
                            'phan_loai' => isset($_REQUEST['phan_loai_import']) ? $_REQUEST['phan_loai_import'] : 2,
                            'nguoi_nhap' => $_SESSION['user']['nhan_vien'],
                            'nhan_vien' => $phutrach,
                            'tinh_trang' => 6
                        ];
                        if ($this->model->addObj($data))
                            $banghi++;
                    } else {
                        if ($checkdt['tinh_trang'] != 6) {
                            $id = $checkdt['id'];
                            $data = [
                                'tinh_trang' => 6
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
        // $phutrach = isset($_SESSION['user']['nhan_vien']) ? $_SESSION['user']['nhan_vien'] : (isset($_REQUEST['phu_trach']) ? $$_REQUEST['phu_trach'] : '');
        $keyword = isset($_REQUEST['search']['value']) ? $_REQUEST['search']['value'] : (isset($_REQUEST['keyword']) ? $_REQUEST['keyword'] : '');
        $nhanvien = isset($_REQUEST['nhan_vien']) && $_REQUEST['nhan_vien'] != '' && $_REQUEST['nhan_vien'] != 0 ? $_REQUEST['nhan_vien'] : $_SESSION['user']['nhan_vien'];


        $tungay = isset($_REQUEST['tu_ngay']) && $_REQUEST['tu_ngay'] != '' ? date("Y-m-d", strtotime(str_replace('/', '-', $_REQUEST['tu_ngay']))) : '';
        $denngay = isset($_REQUEST['den_ngay']) && $_REQUEST['den_ngay'] != '' ? date("Y-m-d", strtotime(str_replace('/', '-', $_REQUEST['den_ngay']))) : '';
        $result = $this->model->listObj($keyword, $nhanvien, $tungay, $denngay);
        echo json_encode($result);
    }

    function loaddata()
    {
        $id = isset($_REQUEST['id']) ? $_REQUEST['id'] : 0;
        $json = $this->model->getData($id);
        echo json_encode($json);
    }

    function update()
    {
        $id = $_REQUEST['id'];
        $data['ho_ten'] = isset($_REQUEST['ho_ten']) ? $_REQUEST['ho_ten'] : '';
        $data['dien_thoai'] = isset($_REQUEST['dien_thoai']) ? $_REQUEST['dien_thoai'] : '';
        $data['dia_chi'] = isset($_REQUEST['dia_chi']) ? $_REQUEST['dia_chi'] : '';
        $data['email'] = isset($_REQUEST['email']) ? $_REQUEST['email'] : '';
        $data['phan_loai'] = isset($_REQUEST['phan_loai']) ? $_REQUEST['phan_loai'] : 0;
        $data['ghi_chu'] = isset($_REQUEST['ghi_chu']) ? $_REQUEST['ghi_chu'] : '';
        $data['nhan_vien'] = isset($_REQUEST['nhan_vien']) ? $_REQUEST['nhan_vien'] : 0;
        $data['tinh_trang'] = isset($_REQUEST['tinh_trang']) ? $_REQUEST['tinh_trang'] : 1;
        $checkdt = $this->model->checkeditdt($data['dien_thoai'],$id);
        if ($checkdt == true) {
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

    function addnhatky()
    {
        $iddata = $_REQUEST['iddata'];
        $ghichu = $_REQUEST['ghi_chu'];
        $data = [
            'id_data' => $iddata,
            'nhan_vien' => $_SESSION['user']['nhan_vien'],
            'ngay_gio' => date('Y-m-d H:i:s'),
            'ghi_chu' => $ghichu,
            'tinh_trang' => 1
        ];
        if ($this->model->addnhatky($data)) {
            $jsonObj['msg'] = "Cập nhật nhật ký thành công";
            $jsonObj['success'] = true;
        } else {
            $jsonObj['msg'] = "Cập nhật dữ liệu không thành công";
            $jsonObj['success'] = false;
        }
        echo json_encode($jsonObj);
    }
}
