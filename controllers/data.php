<?php
class data extends Controller
{
    function __construct()
    {
        parent::__construct();
    }
    function index(){
        require "layouts/header.php";
        $this->view->render("data/index");
        require "layouts/footer.php";
    }

    function movetolead()
    {
        $data = $_REQUEST['data'];
        if ($this->model->movetolead($data)) {
            $jsonObj['msg'] = "Cập nhật dữ liệu thành công";
            $jsonObj['success'] = true;
        } else {
            $jsonObj['msg'] = "Cập nhật dữ liệu không thành công";
            $jsonObj['success'] = false;
        }
        echo json_encode($jsonObj);
    }
    function movelead_id()
    {
        $data = $_REQUEST['id'];
        if ($this->model->movetolead($data)) {
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
            $banghi = 0;
            $phutrach = isset($_REQUEST['phutrach_import']) ? $_REQUEST['phutrach_import'] : '';
            if($phutrach == ""){$phutrach = $_SESSION['user']['nhan_vien'];}

            for ($row = 3; $row <= $highestRow; $row++) {
                $tenkh = $objPHPExcel->getActiveSheet()->getCell("B$row")->getValue();
                $dienthoai = $objPHPExcel->getActiveSheet()->getCell("C$row")->getValue();
                if ($tenkh != '') {
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
                            'tinh_trang' => 1
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

    function listAll()
    {
        $result = $this->model->listAll();
        echo json_encode($result);
    }

    function listWeb()
    {
        // $phutrach = isset($_SESSION['user']['nhan_vien']) ? $_SESSION['user']['nhan_vien'] : (isset($_REQUEST['phu_trach']) ? $$_REQUEST['phu_trach'] : '');
        $keyword = isset($_REQUEST['search']['value']) ? $_REQUEST['search']['value'] : (isset($_REQUEST['keyword']) ? $_REQUEST['keyword'] : '');
        $offset = isset($_REQUEST['start']) ? $_REQUEST['start'] : 0;
        $rows = isset($_REQUEST['length']) ? $_REQUEST['length'] : 30;
        // $page = isset($_REQUEST['page']) ? $_REQUEST['page']: 1;
        // $offset = ($page - 1) * $rows;
        $nhanvien = isset($_REQUEST['nhan_vien']) && $_REQUEST['nhan_vien'] != '' && $_REQUEST['nhan_vien'] != 0 ? $_REQUEST['nhan_vien'] : $_SESSION['user']['nhan_vien'];
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

    function listApi()
    {
        $keyword =  isset($_REQUEST['keyword']) ? $_REQUEST['keyword'] : '';
        $rows = isset($_REQUEST['length']) ? $_REQUEST['length'] : 30;
        $page = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
        $offset = ($page - 1) * $rows;
        $result = $this->model->listObjApi($keyword, $offset, $rows);
        echo json_encode($result);
    }

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
        $data['ho_ten'] = isset($_REQUEST['ho_ten']) ? $_REQUEST['ho_ten'] : '';
        $data['dien_thoai'] = isset($_REQUEST['dien_thoai']) ? $_REQUEST['dien_thoai'] : '';
        $data['dia_chi'] = isset($_REQUEST['dia_chi']) ? $_REQUEST['dia_chi'] : '';
        $data['email'] = isset($_REQUEST['email']) ? $_REQUEST['email'] : '';
        $data['phan_loai'] = isset($_REQUEST['phan_loai']) ? $_REQUEST['phan_loai'] : 0;
        $data['ghi_chu'] = isset($_REQUEST['ghi_chu']) ? $_REQUEST['ghi_chu'] : '';
        $data['nguoi_nhap'] = isset($_SESSION['user']['nhan_vien']) ? $_SESSION['user']['nhan_vien'] : (isset($_REQUEST['nguoi_nhap']) ? $_REQUEST['nguoi_nhap'] : 0);
        $data['ngay_nhap'] = date('Y-m-d');
        $data['nhan_vien'] = $_SESSION['user']['nhan_vien'];
        $data['tinh_trang'] = 1;
        $checkdt = $this->model->checkdt($data['dien_thoai']);
        if ($checkdt == true) {
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

    function chiadata()
    {
        $data = $_REQUEST['data'];
        $nhanvien = $_REQUEST['nhanvien'];
        if ($this->model->chiadata($nhanvien, $data)) {
            $jsonObj['msg'] = "Cập nhật dữ liệu thành công";
            $jsonObj['success'] = true;
        } else {
            $jsonObj['msg'] = "Cập nhật dữ liệu không thành công";
            $jsonObj['success'] = false;
        }

        echo json_encode($jsonObj);
    }

    function addnhatky()
    {
        $iddata = $_REQUEST['iddata'];
        $ghichu = $_REQUEST['ghi_chu'];
        $nhanvien = isset($_SESSION['user']['nhan_vien']) ? $_SESSION['user']['nhan_vien'] : (isset($_REQUEST['nhanvienid']) ? $_REQUEST['nhanvienid'] : 0);
        $data = [
            'id_data' => $iddata,
            'nhan_vien' => $nhanvien,
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

    function del()
    {
        $id = $_REQUEST['id'];
        $data = ['tinh_trang' => 0];
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
