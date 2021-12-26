<?php
class Taisan extends Controller{
    function __construct(){
        parent::__construct();
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

    function add(){
        $data = array(
            'name' => $_REQUEST['name'],
            'so_luong' => $_REQUEST['so_luong'],
            'sl_tonkho' => $_REQUEST['so_luong'],
            'don_vi' => $_REQUEST['don_vi'],
            'nhom_ts' => $_REQUEST['nhom_ts'],
            'so_tien' => $_REQUEST['so_tien'],
            'khau_hao' => $_REQUEST['khau_hao'],
            'bao_hanh' => $_REQUEST['bao_hanh'],
            'ngay_gio' => $_REQUEST['ngay_gio'],
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
        $data = array(
            'name' => $_REQUEST['name_add'],
            'so_luong' => $_REQUEST['so_luong_add'],
            'don_vi' => $_REQUEST['don_vi_add'],
            'nhom_ts' => $_REQUEST['nhom_ts_add'],
            'so_tien' => $_REQUEST['so_tien_add'],
            'ngay_gio' => $_REQUEST['ngay_gio_add'],
        );
        $data_info = array(
            'nha_cungcap' => $_REQUEST['nha_cungcap'],
            'dia_chi' => $_REQUEST['dia_chi'],
            'sdt' => $_REQUEST['sdt'],
            'ghi_chu' => $_REQUEST['ghi_chu'],
        );
        $this->model->updateObj_info($id, $data_info);
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
            $jsonObj['msg'] = "Không thể xoá tài sản đang được cấp phát";
            $jsonObj['success'] = false;
        } 
        echo json_encode($jsonObj);
    }

    function nhomtaisan()
    {
        $json = $this->model->getnhomts();
        echo json_encode($json);
    }
    function don_vi()
    {
        $json = $this->model->don_vi();
        echo json_encode($json);
    }

    function thayanh()
    {
        $id = $_REQUEST['id_taisan'];
        $filename = $_FILES['hinhanh']['name'];
        $hinhanh = '';
        if ($filename!='') {
            $dir = ROOT_DIR . '/uploads/taisan/';
            $file = functions::uploadfile('hinhanh', $dir, $id);
            if ($file!='')
                $hinhanh = URLFILE.'/uploads/taisan/'.$file;
        }
        if ($this->model->thayanh($hinhanh,$id)) {
            $jsonObj['filename'] = $hinhanh;
            $jsonObj['msg'] = "Cập nhật dữ liệu thành công".$file;
            $jsonObj['success'] = true;
        } else {
            $jsonObj['msg'] = "Lỗi khi cập nhật database $id";
            $jsonObj['success'] = false;
        }
        echo json_encode($jsonObj);
    }



    function baohong()
    {
        $id = $_REQUEST['id_baohong'];
        $data['status'] = $_REQUEST['status'];
        $data['so_luong_hong'] = $_REQUEST['so_luong_hong'];
        if($this->model->baohong($id,$data)){
            $jsonObj['msg'] = "Xóa dữ liệu thành công";
            $jsonObj['success'] = true;
        } else {
            $jsonObj['msg'] = "Không thể xoá tài sản đang được cấp phát";
            $jsonObj['success'] = false;
        } 
        echo json_encode($jsonObj);
    }

}
?>