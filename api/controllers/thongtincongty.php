<?php
class Thongtincongty extends Controller{
    function __construct(){
        parent::__construct();
    }

    function loaddata()
    {
        $id=isset($_REQUEST['id'])?$_REQUEST['id']:0;
        $json = $this->model->getdata($id);
        echo json_encode($json);
    }

    function update()
    {
        $id = 0;
        $data = array(
            'name' => $_REQUEST['name'],
            'ten_giao_dich' => $_REQUEST['ten_giao_dich'],
            'ma_so_thue' => $_REQUEST['ma_so_thue'],
            'ngay_thanh_lap' => $_REQUEST['ngay_thanh_lap'],
            'ma_so_dkkd' => $_REQUEST['ma_so_dkkd'],
            'ngay_cap' => $_REQUEST['ngay_cap'],
            'noi_cap' => $_REQUEST['noi_cap'],
            'nguoi_dai_dien' => $_REQUEST['nguoi_dai_dien'],
            'chuc_danh' => $_REQUEST['chuc_danh'],
            'dia_chi' => $_REQUEST['dia_chi'],
            'dien_thoai' => $_REQUEST['dien_thoai'],
            'fax' => $_REQUEST['fax'],
            'email' => $_REQUEST['email'],
            'website' => $_REQUEST['website'],
        );
        if($this->model->updateObj($id, $data)){
            $jsonObj['msg'] = 'Cập nhật dữ liệu thành công';
            $jsonObj['success'] = true;
        } else {
            $jsonObj['msg'] = 'Lỗi cập nhật database';
            $jsonObj['success'] = false;
        }
        echo json_encode($jsonObj);
    }


    function thayanh()
    {
        $id = 0;
        $filename = $_FILES['hinhanh']['name'];
        $hinhanh = '';
        if ($filename!='') {
            $dir = ROOT_DIR . '/uploads/';
            $file = functions::uploadfile('hinhanh', $dir, $id);
            if ($file!='')
                $hinhanh = URLFILE.'/uploads/'.$file;
        }
        if ($this->model->thayanh($hinhanh,$id)) {
            $jsonObj['filename'] = $hinhanh;
            $jsonObj['msg'] = "Cập nhật dữ liệu thành công".$file;
            $jsonObj['success'] = true;
        } else {
            $jsonObj['msg'] = "Lỗi khi cập nhật database";
            $jsonObj['success'] = false;
        }
        echo json_encode($jsonObj);
    }

}
?>