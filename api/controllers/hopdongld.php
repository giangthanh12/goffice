<?php
class hopdongld extends Controller{
    function __construct(){
        parent::__construct();
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

    function combo(){
        $json = $this->model->get_data_combo();
        echo json_encode($json);
    }

    function loaddata()
    {
        $id = isset($_REQUEST['id'])?$_REQUEST['id']:0;
        $json = $this->model->getdata($id);
        echo json_encode($json);
    }

    function add()
    {
        $name = isset($_REQUEST['name']) ? $_REQUEST['name'] : '';
        $luongcoban = isset($_REQUEST['luong_co_ban']) ? str_replace(',', '',$_REQUEST['luong_co_ban']) : 0;
        $tyleluong = isset($_REQUEST['ty_le_luong']) ? $_REQUEST['ty_le_luong'] : 0;
        $luongbaohiem = isset($_REQUEST['luong_bao_hiem']) ? str_replace(',', '',$_REQUEST['luong_bao_hiem']) : 0;
        $phucap = isset($_REQUEST['phu_cap']) ? str_replace(',', '',$_REQUEST['phu_cap']) : 0;
        $ngaydilam = isset($_REQUEST['ngay_di_lam']) ? date("Y-m-d",strtotime(str_replace('/', '-',$_REQUEST['ngay_di_lam']))) : '';
        $ngayketthuc = isset($_REQUEST['ngay_ket_thuc']) ? date("Y-m-d",strtotime(str_replace('/', '-',$_REQUEST['ngay_ket_thuc']))) : '';
        $nhanvien = isset($_REQUEST['nhan_vien']) ? $_REQUEST['nhan_vien'] : 0;
        $phongban = isset($_REQUEST['phong_ban']) ? $_REQUEST['phong_ban'] : 0;
        $vitri = isset($_REQUEST['vi_tri']) ? $_REQUEST['vi_tri'] : 0;
        $chinhanh = isset($_REQUEST['chi_nhanh']) ? $_REQUEST['chi_nhanh'] : 0;
        $ca = isset($_REQUEST['ca']) ? $_REQUEST['ca'] : 0;
        $loai = isset($_REQUEST['loai']) ? $_REQUEST['loai'] : 0;
        $tinhtrang = isset($_REQUEST['tinh_trang']) ? $_REQUEST['tinh_trang'] : 1;
        $ghichu = isset($_REQUEST['ghi_chu']) ? $_REQUEST['ghi_chu'] : '';
        $data = array(
            'name' => $name,
            'luong_co_ban' => $luongcoban,
            'ty_le_luong' => $tyleluong,
            'luong_bao_hiem' => $luongbaohiem,
            'phu_cap' => $phucap,
            'ngay_di_lam' => $ngaydilam,
            'ngay_ket_thuc' => $ngayketthuc,
            'nhan_vien' => $nhanvien,
            'phong_ban' => $phongban,
            'vi_tri' => $vitri,
            'chi_nhanh' => $chinhanh,
            'ca' => $ca,
            'loai' => $loai,
            'tinh_trang' => $tinhtrang,
            'ghi_chu' => $ghichu
        );
        if($this->model->addObj($data)){
            $jsonObj['msg'] = 'Cập nhật dữ liệu thành công';
            $jsonObj['success'] = true;
        } else {
            $jsonObj['msg'] = 'Cập nhật dữ liệu không thành công';
            $jsonObj['success'] = false;
        }
        echo json_encode($jsonObj);
    }

    function update()
    {
        $id = $_REQUEST['id'];
        $name = isset($_REQUEST['name']) ? $_REQUEST['name'] : '';
        $luongcoban = isset($_REQUEST['luong_co_ban']) ? str_replace(',', '',$_REQUEST['luong_co_ban']) : 0;
        $tyleluong = isset($_REQUEST['ty_le_luong']) ? $_REQUEST['ty_le_luong'] : 0;
        $luongbaohiem = isset($_REQUEST['luong_bao_hiem']) ? str_replace(',', '',$_REQUEST['luong_bao_hiem']) : 0;
        $phucap = isset($_REQUEST['phu_cap']) ? str_replace(',', '',$_REQUEST['phu_cap']) : 0;
        $ngaydilam = isset($_REQUEST['ngay_di_lam']) ? date("Y-m-d",strtotime(str_replace('/', '-',$_REQUEST['ngay_di_lam']))) : '';
        $ngayketthuc = isset($_REQUEST['ngay_ket_thuc']) ? date("Y-m-d",strtotime(str_replace('/', '-',$_REQUEST['ngay_ket_thuc']))) : '';
        $nhanvien = isset($_REQUEST['nhan_vien']) ? $_REQUEST['nhan_vien'] : 0;
        $phongban = isset($_REQUEST['phong_ban']) ? $_REQUEST['phong_ban'] : 0;
        $vitri = isset($_REQUEST['vi_tri']) ? $_REQUEST['vi_tri'] : 0;
        $chinhanh = isset($_REQUEST['chi_nhanh']) ? $_REQUEST['chi_nhanh'] : 0;
        $ca = isset($_REQUEST['ca']) ? $_REQUEST['ca'] : 0;
        $loai = isset($_REQUEST['loai']) ? $_REQUEST['loai'] : 0;
        $tinhtrang = isset($_REQUEST['tinh_trang']) ? $_REQUEST['tinh_trang'] : 1;
        $ghichu = isset($_REQUEST['ghi_chu']) ? $_REQUEST['ghi_chu'] : '';
        $data = array(
            'name' => $name,
            'luong_co_ban' => $luongcoban,
            'ty_le_luong' => $tyleluong,
            'luong_bao_hiem' => $luongbaohiem,
            'phu_cap' => $phucap,
            'ngay_di_lam' => $ngaydilam,
            'ngay_ket_thuc' => $ngayketthuc,
            'nhan_vien' => $nhanvien,
            'phong_ban' => $phongban,
            'vi_tri' => $vitri,
            'chi_nhanh' => $chinhanh,
            'ca' => $ca,
            'loai' => $loai,
            'tinh_trang' => $tinhtrang,
            'ghi_chu' => $ghichu
        );
        if($this->model->updateObj($id, $data)){
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