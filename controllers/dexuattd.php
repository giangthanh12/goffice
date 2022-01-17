<?php

class dexuattd extends Controller
{
    function __construct()
    {
        parent::__construct();
    }
    function index(){
        require "layouts/header.php";
        $this->view->render("dexuattd/index");
        require "layouts/footer.php";
    }

    function combo()
    {
        $jsonObj = $this->model->get_data_combo();
        echo json_encode($jsonObj);
    }

    function trinhdouv()
    {
        $jsonObj = [
            ["id" => "1", "text" => "Sơ cấp"],
            ["id" => "2", "text" => "Trung cấp"],
            ["id" => "3", "text" => "Cao đẳng"],
            ["id" => "4", "text" => "Thạc sĩ"],
            ["id" => "5", "text" => "Tiến sĩ"],
            ["id" => "6", "text" => "Cử nhân"],
            ["id" => "7", "text" => "Kỹ sư"],
            ["id" => "8", "text" => "Đại học"],
            ["id" => "9", "text" => "Trung cấp nghề"],
            ["id" => "10", "text" => "Tại chức"],
            ["id" => "11", "text" => "Cao đẳng nghề"],
            ["id" => "12", "text" => "Trung học phổ thông"],
            ["id" => "13", "text" => "Trung cấp chuyên nghiệp"],
            ["id" => "14", "text" => "Sơ cấp nghề"],
            ["id" => "15", "text" => "Trung học cơ sở"],
            ["id" => "16", "text" => "Chứng chỉ hành nghề"],
            ["id" => "17", "text" => "Không yêu cầu"],
            ["id" => "18", "text" => "Khác"],
        ];
        echo json_encode($jsonObj);
    }

    function kinhnghiemuv()
    {
        $jsonObj = [
            ["id" => "1", "text" => "Chưa có kinh nghiệm"],
            ["id" => "2", "text" => "Dưới 1 năm"],
            ["id" => "3", "text" => "1 năm"],
            ["id" => "4", "text" => "2 năm"],
            ["id" => "5", "text" => "3 năm"],
            ["id" => "6", "text" => "4 năm"],
            ["id" => "7", "text" => "5 năm"],
            ["id" => "8", "text" => "Trên 5 năm"]
        ];
        echo json_encode($jsonObj);
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
        $name = isset($_REQUEST['name']) ? $_REQUEST['name'] : '';
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
        $name = isset($_REQUEST['name']) ? $_REQUEST['name'] : '';
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
        $data = array(
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
            'mo_ta' => $mota
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

    function duyet()
    {
        $id = $_REQUEST['id'];
        $soluong = isset($_REQUEST['so_luong']) ? $_REQUEST['so_luong'] : '';
        $minluong = isset($_REQUEST['min_luong']) ? str_replace(',', '',$_REQUEST['min_luong']) : '';
        $maxluong = isset($_REQUEST['max_luong']) ? str_replace(',', '',$_REQUEST['max_luong']) : '';
        $hantuyen = isset($_REQUEST['han_tuyen']) ? date("Y-m-d", strtotime(str_replace('/', '-', $_REQUEST['han_tuyen']))) : '';
        $mota = isset($_REQUEST['mo_ta']) ? $_REQUEST['mo_ta'] : '';
        $data = [
            'so_luong' => $soluong,
            'min_luong' => $minluong,
            'max_luong' => $maxluong,
            'han_tuyen' => $hantuyen,
            'mo_ta' => $mota,
            'tinh_trang' => 2
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

    function hoanduyet()
    {
        $id = $_REQUEST['id'];
        $data = [
            'tinh_trang' => 1
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

    function noduyet()
    {
        $id = $_REQUEST['id'];
        $data = [
            'tinh_trang' => 3
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