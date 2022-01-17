<?php
class Donhang extends Controller{
    function __construct(){
        parent::__construct();
    }

    function index(){
        require "layouts/header.php";
        $this->view->render("donhang/index");
        require "layouts/footer.php";
    }

    function list()
    {
        $data = $this->model->listObj();
        echo json_encode($data);
    }

    function loaddata()
    {
        $id=isset($_REQUEST['id'])?$_REQUEST['id']:0;
        $json = $this->model->getdata($id);
        echo json_encode($json);
    }
  

    function add()
    {
        
        $filename = $_FILES['file']['name'];
        $fname = explode('.',$filename);
        $file = '';
        if ($filename != '') {
            $dir = ROOT_DIR . '/uploads/donhang/';
            $file = functions::uploadfile('file', $dir, $fname[0]);
            if ($file != '')
                $file = 'uploads/donhang/' . $file;
        }
        $data = array(
            'ngay' => $_REQUEST['ngay'],
            'khach_hang' => $_REQUEST['khach_hang'],
            'nhan_vien' => $_REQUEST['nhan_vien'],
            'tinh_trang' => 1,
            'tinh_trang_tt' => 1,
            'tien_truoc_ck' => $_REQUEST['tong_donhang'],
            'chiet_khau' => $_REQUEST['chiet_khau'],
            'tien_sau_ck' => $_REQUEST['thanh_toan'],
            'noi_dung' => $_REQUEST['ghi_chu'],
            'id_child' => $_REQUEST['id_sp'],
            'so_luong_child' => $_REQUEST['so_luong'],
            'dongia_child' => $_REQUEST['don_gia'],
            'loai_child' => $_REQUEST['loai'],
            'ngays_child' => $_REQUEST['ngay_s'],
            'ngaye_child' => $_REQUEST['ngay_e'],
            'thuevat_child' => $_REQUEST['thue'],
            'tienthue_child' => $_REQUEST['tien_thue'],
            'chietkhau_child' => $_REQUEST['chiet_khau_tm'],
            'thanhtien_child' => $_REQUEST['thanh_tien'],
            'dinh_kem' => $file,
        );
        $id_bg = $_REQUEST['id'];
        if($id_bg > 0){
            //update tinhtrang BG
            $this->model->update_status_bg($id_bg);
        }
       
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
        $filename = $_FILES['file']['name'];
        $fname = explode('.',$filename);
        $file = '';

        if ($filename != '') {
            
            $get_file = $this->model->get_files($id);
            $file = $get_file['dinh_kem'];
            if($file <> ''){
                unlink(ROOT_DIR .'/'.$file);
            }
            
            $dir = ROOT_DIR . '/uploads/donhang/';
            $file = functions::uploadfile('file', $dir, $fname[0]);
                if ($file != ''){
                    $file = 'uploads/donhang/' . $file;
                }
        }
        $data = array(
            'ngay' => $_REQUEST['ngay'],
            'khach_hang' => $_REQUEST['khach_hang'],
            'nhan_vien' => $_REQUEST['nhan_vien'],
            'tinh_trang' => $_REQUEST['tinh_trang'],
            'tien_truoc_ck' => $_REQUEST['tong_donhang'],
            'chiet_khau' => $_REQUEST['chiet_khau'],
            'tien_sau_ck' => $_REQUEST['thanh_toan'],
            'noi_dung' => $_REQUEST['ghi_chu'],
            'id_child' => $_REQUEST['id_sp'],
            'so_luong_child' => $_REQUEST['so_luong'],
            'dongia_child' => $_REQUEST['don_gia'],
            'loai_child' => $_REQUEST['loai'],
            'ngays_child' => $_REQUEST['ngay_s'],
            'ngaye_child' => $_REQUEST['ngay_e'],
            'thuevat_child' => $_REQUEST['thue'],
            'tienthue_child' => $_REQUEST['tien_thue'],
            'chietkhau_child' => $_REQUEST['chiet_khau_tm'],
            'thanhtien_child' => $_REQUEST['thanh_tien'],
            'dinh_kem' => $file,
        );
        
        
        if($this->model->updateObj($id, $data)){
            $jsonObj['msg'] = 'Cập nhật dữ liệu thành công';
            $jsonObj['success'] = true;
        } else {
            $jsonObj['msg'] = 'Lỗi cập nhật database bhxh'.$id;
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


    function nhanvien()
    {
        $data = $this->model->nhanvien();
        echo json_encode($data);
    }
    function khachhang()
    {
        $data = $this->model->khachhang();
        echo json_encode($data);
    }
    function dichvu()
    {
        $data = $this->model->dichvu();
        echo json_encode($data);
    }
    function sanpham()
    {
        $data = $this->model->sanpham();
        echo json_encode($data);
    }
    function tai_khoan()
    {
        $data = $this->model->taikhoan();
        echo json_encode($data);
    }
    


    function load_dichvu(){
        $id = $_REQUEST['id'];
        $data = $this->model->getdata_dichvu($id);
        echo json_encode($data);
    }
    function load_sanpham(){
        $id = $_REQUEST['id'];
        $data = $this->model->getdata_sanpham($id);
        echo json_encode($data);
    }

    function xoafile()
    {
        $id = $_REQUEST['id'];
        $data = array(
            'dinh_kem' => "",
        );
        $get_file = $this->model->get_files($id);
        $file = $get_file['dinh_kem'];
        unlink(ROOT_DIR .'/'.$file);
        if($this->model->xoafile($id, $data)){
            $jsonObj['msg'] = 'Xóa file thành công';
            $jsonObj['success'] = true;
        } else {
            $jsonObj['msg'] = 'Lỗi xóa file';
            $jsonObj['success'] = false;
        }
        echo json_encode($jsonObj);
    }


    
    function lichsuchamsoc(){
        $id = $_REQUEST['id'];
        $data = $this->model->lichsuchamsoc($id);
        echo json_encode($data);
    }

    function add_chamsoc(){
        $nhanvien = isset($_SESSION['user']['nhan_vien']) ? $_SESSION['user']['nhan_vien'] : (0);
        $data = array(
            'bao_gia' => $_REQUEST['id_bg'],
            'status' => $_REQUEST['status_cskh'],
            'ghi_chu' => $_REQUEST['ghi_chu_care'],
            'nhan_vien' => $nhanvien,
            'ngay_gio' => date('Y-m-d H:i:s'),
        );
       
        if($this->model->add_chamsoc($data)){
            $jsonObj['msg'] = 'Cập nhật dữ liệu thành công';
            $jsonObj['success'] = true;
        } else {
            $jsonObj['msg'] = 'Lỗi cập nhật database';
            $jsonObj['success'] = false;
        }
        echo json_encode($jsonObj);
    }

    function add_thanhtoan(){
        $nhanvien = isset($_SESSION['user']['nhan_vien']) ? $_SESSION['user']['nhan_vien'] : (0);
        $data_socai = array(
            'don_hang' => $_REQUEST['id_bg'],
            'tai_khoan' => $_REQUEST['tai_khoan_pay'],
            'dien_giai' => $_REQUEST['ghi_chu_pay'],
            'so_tien' => $_REQUEST['so_tien_pay'],
            'nhan_vien' => $nhanvien,
            'ngay_gio' => $_REQUEST['ngay_gio_pay'],
            'loai' => 0,
            'name' => 'Thanh toán đơn hàng '.$_REQUEST['id_bg'],
            'tinh_trang' => 1,
        );
       
        if($this->model->add_thanhtoan($data_socai)){
            $jsonObj['msg'] = 'Cập nhật dữ liệu thành công';
            $jsonObj['success'] = true;
        } else {
            $jsonObj['msg'] = 'Lỗi cập nhật database';
            $jsonObj['success'] = false;
        }
        echo json_encode($jsonObj);
    }

    function lichsuthanhtoan(){
        $id = $_REQUEST['id'];
        $data = $this->model->lichsuthanhtoan($id);
        echo json_encode($data);
    }

    function loaddata_thanhtoan(){
        $id = $_REQUEST['id'];
        $data = $this->model->loaddata_thanhtoan($id);
        echo json_encode($data);
    }

    function update_thanhtoan(){
        $id_socai = $_REQUEST['id_bg'];

        $data=[
            'tai_khoan' => $_REQUEST['tai_khoan_pay'],
            'dien_giai' => $_REQUEST['ghi_chu_pay'],
            'so_tien' => $_REQUEST['so_tien_pay'],
            'ngay_gio' => $_REQUEST['ngay_gio_pay'],
        ];

        if($this->model->update_thanhtoan($id_socai,$data)){
            $jsonObj['msg'] = 'Cập nhật dữ liệu thành công';
            $jsonObj['success'] = true;
        } else {
            $jsonObj['msg'] = 'Lỗi cập nhật database';
            $jsonObj['success'] = false;
        }
        echo json_encode($jsonObj);
    }
    

    function xoathanhtoan()
    {
        $id_socai = $_REQUEST['id'];
        $data = ['tinh_trang'=>0];

        $update_donhang = $this->model->update_donhang($id_socai);
        if($this->model->xoathanhtoan($id_socai,$data)){
            $jsonObj['msg'] = "Xóa dữ liệu thành công";
            $jsonObj['success'] = true;
            $jsonObj['donhang'] = $update_donhang;
        } else {
            $jsonObj['msg'] = "Xóa dữ liệu không thành công";
            $jsonObj['success'] = false;
        } 
        echo json_encode($jsonObj);
    }






}
?>