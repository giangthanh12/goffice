<?php

class chiendichtd extends Controller
{
    function __construct()
    {
        parent::__construct();
    }

    function list()
    {
        $rows = isset($_REQUEST['length']) ? $_REQUEST['length'] : 30;
        $offset = isset($_REQUEST['start']) ? $_REQUEST['start'] : 0;
        $draw = isset($_REQUEST['draw']) ? $_REQUEST['draw'] : 1;
        $keyword = isset($_REQUEST['search']['value']) ? $_REQUEST['search']['value'] : '';
        $jsonObj = $this->model->listObj($draw, $keyword, $offset, $rows);
        echo json_encode($jsonObj);
    }

    function saveadd()
    {
        $dexuattd = isset($_REQUEST['dexuattd']) ? $_REQUEST['dexuattd'] : '';
        $name = isset($_REQUEST['name']) ? $_REQUEST['name'] : '';
        $nguoiphutrach = isset($_REQUEST['nguoi_phu_trach']) ? $_REQUEST['nguoi_phu_trach'] : '';
        $nguoitheodoi = isset($_REQUEST['nguoi_theo_doi']) ? $_REQUEST['nguoi_theo_doi'] : '';
        $ngaybatdau = isset($_REQUEST['ngay_bat_dau']) ? date("Y-m-d", strtotime(str_replace('/', '-', $_REQUEST['ngay_bat_dau']))) : '';
        $ngayketthuc = isset($_REQUEST['ngay_ket_thuc']) ? date("Y-m-d", strtotime(str_replace('/', '-', $_REQUEST['ngay_ket_thuc']))) : '';
        $chiphidukien = isset($_REQUEST['chi_phi_du_kien']) ? str_replace(',', '',$_REQUEST['chi_phi_du_kien']) : '';

        $gioitinh = isset($_REQUEST['gioi_tinh']) ? $_REQUEST['gioi_tinh'] : '';
        $chinhanh = isset($_REQUEST['chi_nhanh']) ? $_REQUEST['chi_nhanh'] : '';
        $phongban = isset($_REQUEST['phong_ban']) ? $_REQUEST['phong_ban'] : '';
        $vitri = isset($_REQUEST['vi_tri']) ? $_REQUEST['vi_tri'] : '';
        $hinhthuc = isset($_REQUEST['hinh_thuc_lam_viec']) ? $_REQUEST['hinh_thuc_lam_viec'] : '';
        $soluong = isset($_REQUEST['so_luong']) ? $_REQUEST['so_luong'] : '';
        $minluong = isset($_REQUEST['min_luong']) ? str_replace(',', '',$_REQUEST['min_luong']) : '';
        $maxluong = isset($_REQUEST['max_luong']) ? str_replace(',', '',$_REQUEST['max_luong']) : '';
        $hantuyen = isset($_REQUEST['han_tuyen']) ? date("Y-m-d", strtotime(str_replace('/', '-', $_REQUEST['han_tuyen']))) : '';
        $lydo = isset($_REQUEST['ly_do']) ? $_REQUEST['ly_do'] : '';
        $mintuoi = isset($_REQUEST['min_tuoi']) ? $_REQUEST['min_tuoi'] : '';
        $maxtuoi = isset($_REQUEST['max_tuoi']) ? $_REQUEST['max_tuoi'] : '';
        $mincao = isset($_REQUEST['min_cao']) ? $_REQUEST['min_cao'] : '';
        $maxcao = isset($_REQUEST['max_cao']) ? $_REQUEST['max_cao'] : '';
        $minnang = isset($_REQUEST['min_nang']) ? $_REQUEST['min_nang'] : '';
        $maxnang = isset($_REQUEST['max_nang']) ? $_REQUEST['max_nang'] : '';
        $chuyennganh = isset($_REQUEST['chuyen_nganh']) ? $_REQUEST['chuyen_nganh'] : '';
        $trinhdo = isset($_REQUEST['trinh_do']) ? $_REQUEST['trinh_do'] : '';
        $kinhnghiem = isset($_REQUEST['kinh_nghiem']) ? $_REQUEST['kinh_nghiem'] : '';
        $mota = isset($_REQUEST['mo_ta']) ? $_REQUEST['mo_ta'] : '';
        $nguoitao = isset($_REQUEST['nguoi_tao']) ? $_REQUEST['nguoi_tao'] : $_SESSION['user']['nhan_vien'];;
        $data = array(
            'dexuattd' => $dexuattd, 
            'nguoi_phu_trach' => $nguoiphutrach, 
            'nguoi_theo_doi' => $nguoitheodoi, 
            'ngay_bat_dau' => $ngaybatdau, 
            'ngay_ket_thuc' => $ngayketthuc, 
            'chi_phi_du_kien' => $chiphidukien, 
            'name' => $name, 
            'gioi_tinh' => $gioitinh, 
            'chi_nhanh' => $chinhanh, 
            'phong_ban' => $phongban, 
            'vi_tri' => $vitri,
            'hinh_thuc_lam_viec' => $hinhthuc, 
            'so_luong' => $soluong, 
            'min_luong' => $minluong, 
            'max_luong' => $maxluong,
            'han_tuyen' => $hantuyen, 
            'ly_do' => $lydo, 
            'min_tuoi' => $mintuoi, 
            'max_tuoi' => $maxtuoi,
            'min_cao' => $mincao, 
            'max_cao' => $maxcao,
            'min_nang' => $minnang, 
            'max_nang' => $maxnang, 
            'chuyen_nganh' => $chuyennganh, 
            'trinh_do' => $trinhdo,
            'kinh_nghiem' => $kinhnghiem, 
            'mo_ta' => $mota, 
            'nguoi_tao' => $nguoitao,
            'tinh_trang' => 1
        );
        $temp = $this->model->addObj($data);
        if ($temp) {
            $jsonObj['msg'] = "Cập nhật dữ liệu thành công";
            $jsonObj['success'] = true;
        } else {
            $jsonObj['msg'] = "Cập nhật dữ liệu không thành công";
            $jsonObj['success'] = false;
        }
        echo json_encode($jsonObj);
    }

    function saveedit()
    {
        $id = $_REQUEST['id'];
        $dexuattd = isset($_REQUEST['dexuattd']) ? $_REQUEST['dexuattd'] : '';
        $name = isset($_REQUEST['name']) ? $_REQUEST['name'] : '';
        $nguoiphutrach = isset($_REQUEST['nguoi_phu_trach']) ? $_REQUEST['nguoi_phu_trach'] : '';
        $nguoitheodoi = isset($_REQUEST['nguoi_theo_doi']) ? $_REQUEST['nguoi_theo_doi'] : '';
        $ngaybatdau = isset($_REQUEST['ngay_bat_dau']) ? date("Y-m-d", strtotime(str_replace('/', '-', $_REQUEST['ngay_bat_dau']))) : '';
        $ngayketthuc = isset($_REQUEST['ngay_ket_thuc']) ? date("Y-m-d", strtotime(str_replace('/', '-', $_REQUEST['ngay_ket_thuc']))) : '';
        $chiphidukien = isset($_REQUEST['chi_phi_du_kien']) ? str_replace(',', '',$_REQUEST['chi_phi_du_kien']) : '';

        $gioitinh = isset($_REQUEST['gioi_tinh']) ? $_REQUEST['gioi_tinh'] : '';
        $chinhanh = isset($_REQUEST['chi_nhanh']) ? $_REQUEST['chi_nhanh'] : '';
        $phongban = isset($_REQUEST['phong_ban']) ? $_REQUEST['phong_ban'] : '';
        $vitri = isset($_REQUEST['vi_tri']) ? $_REQUEST['vi_tri'] : '';
        $hinhthuc = isset($_REQUEST['hinh_thuc_lam_viec']) ? $_REQUEST['hinh_thuc_lam_viec'] : '';
        $soluong = isset($_REQUEST['so_luong']) ? $_REQUEST['so_luong'] : '';
        $minluong = isset($_REQUEST['min_luong']) ? str_replace(',', '',$_REQUEST['min_luong']) : '';
        $maxluong = isset($_REQUEST['max_luong']) ? str_replace(',', '',$_REQUEST['max_luong']) : '';
        $hantuyen = isset($_REQUEST['han_tuyen']) ? date("Y-m-d", strtotime(str_replace('/', '-', $_REQUEST['han_tuyen']))) : '';
        $lydo = isset($_REQUEST['ly_do']) ? $_REQUEST['ly_do'] : '';
        $mintuoi = isset($_REQUEST['min_tuoi']) ? $_REQUEST['min_tuoi'] : '';
        $maxtuoi = isset($_REQUEST['max_tuoi']) ? $_REQUEST['max_tuoi'] : '';
        $mincao = isset($_REQUEST['min_cao']) ? $_REQUEST['min_cao'] : '';
        $maxcao = isset($_REQUEST['max_cao']) ? $_REQUEST['max_cao'] : '';
        $minnang = isset($_REQUEST['min_nang']) ? $_REQUEST['min_nang'] : '';
        $maxnang = isset($_REQUEST['max_nang']) ? $_REQUEST['max_nang'] : '';
        $chuyennganh = isset($_REQUEST['chuyen_nganh']) ? $_REQUEST['chuyen_nganh'] : '';
        $trinhdo = isset($_REQUEST['trinh_do']) ? $_REQUEST['trinh_do'] : '';
        $kinhnghiem = isset($_REQUEST['kinh_nghiem']) ? $_REQUEST['kinh_nghiem'] : '';
        $mota = isset($_REQUEST['mo_ta']) ? $_REQUEST['mo_ta'] : '';
        $nguoitao = isset($_REQUEST['nguoi_tao']) ? $_REQUEST['nguoi_tao'] : $_SESSION['user']['nhan_vien'];;
        $data = array(
            'dexuattd' => $dexuattd, 
            'nguoi_phu_trach' => $nguoiphutrach, 
            'nguoi_theo_doi' => $nguoitheodoi, 
            'ngay_bat_dau' => $ngaybatdau, 
            'ngay_ket_thuc' => $ngayketthuc, 
            'chi_phi_du_kien' => $chiphidukien, 
            'name' => $name, 
            'gioi_tinh' => $gioitinh, 
            'chi_nhanh' => $chinhanh, 
            'phong_ban' => $phongban, 
            'vi_tri' => $vitri,
            'hinh_thuc_lam_viec' => $hinhthuc, 
            'so_luong' => $soluong, 
            'min_luong' => $minluong, 
            'max_luong' => $maxluong,
            'han_tuyen' => $hantuyen, 
            'ly_do' => $lydo, 
            'min_tuoi' => $mintuoi, 
            'max_tuoi' => $maxtuoi,
            'min_cao' => $mincao, 
            'max_cao' => $maxcao,
            'min_nang' => $minnang, 
            'max_nang' => $maxnang, 
            'chuyen_nganh' => $chuyennganh, 
            'trinh_do' => $trinhdo,
            'kinh_nghiem' => $kinhnghiem, 
            'mo_ta' => $mota, 
            'nguoi_tao' => $nguoitao
        );
        $temp = $this->model->updateObj($id,$data);
        if ($temp) {
            $jsonObj['msg'] = "Cập nhật dữ liệu thành công";
            $jsonObj['success'] = true;
        } else {
            $jsonObj['msg'] = "Cập nhật dữ liệu không thành công";
            $jsonObj['success'] = false;
        }
        echo json_encode($jsonObj);
    }

    function loaddetail()
    {
        $id = $_REQUEST['id'];
        $jsonObj = $this->model->getDetail($id);
        echo json_encode($jsonObj);
    }

    function loaddata()
    {
        $id = $_REQUEST['id'];
        $jsonObj = $this->model->getData($id);
        echo json_encode($jsonObj);
    }

    function addngansach() 
    {
        $id = $_REQUEST['id'];
        $ungvien = $_REQUEST['ung_vien'];
        
        $temp = $this->model->updateObj($id,$ungvien);
        if ($temp > 0) {
            $jsonObj['msg'] = "Đã thêm thành công ".$temp." ứng viên";
            $jsonObj['success'] = true;
        } else {
            $jsonObj['msg'] = "Cập nhật dữ liệu không thành công";
            $jsonObj['success'] = false;
        }
        echo json_encode($jsonObj);
    }

    function adduvchiendich() 
    {
        $id = $_REQUEST['id'];
        $ungvien = $_REQUEST['ung_vien'];
        $temp = $this->model->addUVCD($id,$ungvien);
        if ($temp > 0) {
            $jsonObj['msg'] = "Đã thêm thành công ".$temp." ứng viên";
            $jsonObj['success'] = true;
        } else {
            $jsonObj['msg'] = "Cập nhật dữ liệu không thành công";
            $jsonObj['success'] = false;
        }
        echo json_encode($jsonObj);
    }

    // function duyet()
    // {
    //     $id = $_REQUEST['id'];
    //     $soluong = isset($_REQUEST['so_luong']) ? $_REQUEST['so_luong'] : '';
    //     $minluong = isset($_REQUEST['min_luong']) ? str_replace(',', '',$_REQUEST['min_luong']) : '';
    //     $maxluong = isset($_REQUEST['max_luong']) ? str_replace(',', '',$_REQUEST['max_luong']) : '';
    //     $hantuyen = isset($_REQUEST['han_tuyen']) ? date("Y-m-d", strtotime(str_replace('/', '-', $_REQUEST['han_tuyen']))) : '';
    //     $mota = isset($_REQUEST['mo_ta']) ? $_REQUEST['mo_ta'] : '';
    //     $data = [
    //         'so_luong' => $soluong,
    //         'min_luong' => $minluong,
    //         'max_luong' => $maxluong,
    //         'han_tuyen' => $hantuyen,
    //         'mo_ta' => $mota,
    //         'tinh_trang' => 2
    //     ];
    //     $temp = $this->model->updateObj($id,$data);
    //     if ($temp) {
    //         $jsonObj['msg'] = "Cập nhật dữ liệu thành công";
    //         $jsonObj['success'] = true;
    //     } else {
    //         $jsonObj['msg'] = "Cập nhật dữ liệu không thành công";
    //         $jsonObj['success'] = false;
    //     }
    //     echo json_encode($jsonObj);
    // }

    // function hoanduyet()
    // {
    //     $id = $_REQUEST['id'];
    //     $data = [
    //         'tinh_trang' => 1
    //     ];
    //     $temp = $this->model->updateObj($id,$data);
    //     if ($temp) {
    //         $jsonObj['msg'] = "Cập nhật dữ liệu thành công";
    //         $jsonObj['success'] = true;
    //     } else {
    //         $jsonObj['msg'] = "Cập nhật dữ liệu không thành công";
    //         $jsonObj['success'] = false;
    //     }
    //     echo json_encode($jsonObj);
    // }

    // function noduyet()
    // {
    //     $id = $_REQUEST['id'];
    //     $data = [
    //         'tinh_trang' => 3
    //     ];
    //     $temp = $this->model->updateObj($id,$data);
    //     if ($temp) {
    //         $jsonObj['msg'] = "Cập nhật dữ liệu thành công";
    //         $jsonObj['success'] = true;
    //     } else {
    //         $jsonObj['msg'] = "Cập nhật dữ liệu không thành công";
    //         $jsonObj['success'] = false;
    //     }
    //     echo json_encode($jsonObj);
    // }

    function del()
    {
        $id = $_REQUEST['id'];
        $data = [
            'tinh_trang' => 0
        ];
        $temp = $this->model->updateObj($id,$data);
        if ($temp) {
            $jsonObj['msg'] = "Cập nhật dữ liệu thành công";
            $jsonObj['success'] = true;
        } else {
            $jsonObj['msg'] = "Cập nhật dữ liệu không thành công";
            $jsonObj['success'] = false;
        }
        echo json_encode($jsonObj);
    }

}
?>