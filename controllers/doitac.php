<?php
class Doitac extends Controller{
    function __construct(){
        parent::__construct();
    }

    function index(){
        require "layouts/header.php";
        $this->view->render("doitac/index");
        require "layouts/footer.php";
    }

    function list()
    {
        $data = $this->model->listObj();
        echo json_encode($data);
    }

    // function combo(){
    //     $json = $this->model->get_data_combo();
    //     $this->view->jsonObj = json_encode($json);
    //     $this->view->render("khachhang/combo");
    // }

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
            $jsonObj['msg'] = 'C???p nh???t d??? li???u th??nh c??ng';
            $jsonObj['success'] = true;
        } else {
            $jsonObj['msg'] = 'L???i c???p nh???t database';
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
            $jsonObj['msg'] = 'C???p nh???t d??? li???u th??nh c??ng';
            $jsonObj['success'] = true;
        } else {
            $jsonObj['msg'] = 'L???i c???p nh???t database';
            $jsonObj['success'] = false;
        }
        echo json_encode($jsonObj);
    }

    function del()
    {
        $id = $_REQUEST['id'];
        $data = ['tinh_trang'=>0];
        if($this->model->delObj($id,$data)){
            $jsonObj['msg'] = "X??a d??? li???u th??nh c??ng";
            $jsonObj['success'] = true;
        } else {
            $jsonObj['msg'] = "X??a d??? li???u kh??ng th??nh c??ng";
            $jsonObj['success'] = false;
        } 
        echo json_encode($jsonObj);
    }
}
?>