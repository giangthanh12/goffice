<?php
class baogia extends Controller{
    function __construct(){
        parent::__construct();
    }

    function index(){
        require "layouts/header.php";
        $this->view->render("Baogia/index");
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
            $dir = ROOT_DIR . '/uploads/baogia/';
            $file = functions::uploadfile('file', $dir, $fname[0]);
            if ($file != '')
                $file = 'uploads/baogia/' . $file;
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
       
        if($this->model->addObj($data)){
            $jsonObj['msg'] = 'Cập nhật dữ liệu thành công';
            $jsonObj['success'] = true;
        } else {
            $jsonObj['msg'] = 'Lỗi cập nhật database';
            $jsonObj['success'] = false;
        }
        echo json_encode($jsonObj);
    }

    function add_to_lead()
    {
        $id_lead = $_REQUEST['khach_hang_bg'];
        //update tinh trang lead
        $data_lead = $this->model->load_id_lead($id_lead);
        $data_lead_row = [
            'ten_day_du' => $data_lead['ho_ten'],
            'dia_chi' => $data_lead['dia_chi'],
            'dien_thoai' => $data_lead['dien_thoai'],
            'email' => $data_lead['email'],
            'nhan_vien' => $_SESSION['user']['nhan_vien'],
            'phan_loai' => 1,
            'tinh_trang' => 1,
            'ngay' => date('Y-m-d')
        ];
        $update = ['tinh_trang' => 9];
        $this->model->update_lead($id_lead, $update);
        $id_kh = $this->model->movetokh($data_lead_row);


        $filename = $_FILES['file']['name'];
        $fname = explode('.',$filename);
        $file = '';
        if ($filename != '') {
            $dir = ROOT_DIR . '/uploads/baogia/';
            $file = functions::uploadfile('file', $dir, $fname[0]);
            if ($file != '')
                $file = 'uploads/baogia/' . $file;
        }
        $data = array(
            'ngay' => $_REQUEST['ngay'],
            'khach_hang' => $id_kh['id'],
            'nhan_vien' => $_REQUEST['nhan_vien_bg'],
            'tinh_trang' => $_REQUEST['tinh_trang_bg'],
            'tien_truoc_ck' => $_REQUEST['tong_donhang'],
            'chiet_khau' => $_REQUEST['chiet_khau'],
            'tien_sau_ck' => $_REQUEST['thanh_toan'],
            'noi_dung' => $_REQUEST['ghi_chu_bg'],
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
       
        if($this->model->addObj($data)){
            $jsonObj['msg'] = 'Cập nhật dữ liệu thành công';
            $jsonObj['success'] = true;
        } else {
            $jsonObj['msg'] = 'Lỗi cập nhật database';
            $jsonObj['success'] = false;
        }
        echo json_encode($jsonObj);
    }

    function add_to_kh()
    {
        $id_kh = $_REQUEST['khach_hang_bg'];
        
        $update = ['tinh_trang' => 2];
        $this->model->update_kh($id_kh, $update);
 
        $filename = $_FILES['file']['name'];
        $fname = explode('.',$filename);
        $file = '';
        if ($filename != '') {
            $dir = ROOT_DIR . '/uploads/baogia/';
            $file = functions::uploadfile('file', $dir, $fname[0]);
            if ($file != '')
                $file = 'uploads/baogia/' . $file;
        }
        $data = array(
            'ngay' => $_REQUEST['ngay'],
            'khach_hang' => $id_kh,
            'nhan_vien' => $_REQUEST['nhan_vien_bg'],
            'tinh_trang' => $_REQUEST['tinh_trang_bg'],
            'tien_truoc_ck' => $_REQUEST['tong_donhang'],
            'chiet_khau' => $_REQUEST['chiet_khau'],
            'tien_sau_ck' => $_REQUEST['thanh_toan'],
            'noi_dung' => $_REQUEST['ghi_chu_bg'],
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


            $dir = ROOT_DIR . '/uploads/baogia/';
            $file = functions::uploadfile('file', $dir, $fname[0]);
            if ($file != '')
                $file = 'uploads/baogia/' . $file;
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
            'thuevat_child' => $_REQUEST['thue'],
			'ngays_child' => $_REQUEST['ngay_s'],
            'ngaye_child' => $_REQUEST['ngay_e'],
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
    function loaddata_lead()
    {
        $id = $_REQUEST['id'];
        $data = $this->model->loaddata_lead($id);
        echo json_encode($data);
    }
    function loaddata_kh()
    {
        $id = $_REQUEST['id'];
        $data = $this->model->loaddata_kh($id);
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
    function status_cskh()
    {
        $data = $this->model->status_cskh();
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
        $nhanvien = isset($_SESSION['user']['nhan_vien']) ? $_SESSION['user']['nhan_vien'] : 0;
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

    function load_id_lead(){
        $id = $_REQUEST['id'];
        $data = $this->model->load_id_lead($id);
        echo json_encode($data);
    }
    function load_id_kh(){
        $id = $_REQUEST['id'];
        $data = $this->model->load_id_kh($id);
        echo json_encode($data);
    }
    






}
?>