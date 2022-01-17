<?php
class bangluong extends Controller
{
    function __construct()
    {
        parent::__construct();
    }

    function list()
    {
        $thang = isset($_REQUEST['thang']) ? $_REQUEST['thang'] : date('m');
        $nam = isset($_REQUEST['nam']) ? $_REQUEST['nam'] : date('Y');
        $nhanvien = isset($_SESSION['user']['nhan_vien']) ? $_SESSION['user']['nhan_vien'] :(isset($_REQUEST['nhan_vien']) ? $_REQUEST['nhan_vien'] : '');
        $data = $this->model->listObj($thang,$nam,$nhanvien);
        echo json_encode($data);
    }

    function lapbang()
    {
        $thang = isset($_REQUEST['thang']) ? $_REQUEST['thang'] : date("m");
        $nam = isset($_REQUEST['nam']) ? $_REQUEST['nam'] : date("Y");
        if ($this->model->lapbangluong($thang, $nam)) {
            $jsonObj['msg']     = "Đã lập lại bảng lương tháng ".$thang.'/'.$nam;
            $jsonObj['success'] = true;
        } else {
            $jsonObj['msg']     = "Bảng lương tháng này đã tồn tại";
            $jsonObj['success'] = false;
        }
        echo json_encode($jsonObj);
    }

    function update()
    {
        $id = $_REQUEST['id'];
        $thuongds = isset($_REQUEST['thuong_ds']) ? str_replace(',', '',$_REQUEST['thuong_ds']) : 0;
        $thuonglt = isset($_REQUEST['thuong_lt']) ? str_replace(',', '',$_REQUEST['thuong_lt']) : 0;
        $thuongkhac = isset($_REQUEST['thuong_khac']) ? str_replace(',', '',$_REQUEST['thuong_khac']) : 0;
        // $tamung = isset($_REQUEST['tam_ung']) ? $_REQUEST['tam_ung'] : 0;
        $data = array(
            'thuong_ds' => $thuongds,
            'thuong_lt' => $thuonglt,
            'thuong_khac' => $thuongkhac,
            // 'tam_ung' => $tamung,
        );
        if ($this->model->updateObj($id,$data)) {
            $jsonObj['msg'] = 'Cập nhật dữ liệu thành công';
            $jsonObj['success'] = true;
        } else {
            $jsonObj['msg'] = 'Cập nhật dữ liệu không thành công';
            $jsonObj['success'] = false;
        }
        echo json_encode($jsonObj);
    }

    function duyet()
    {
        $thang = isset($_REQUEST['thang']) ? $_REQUEST['thang']:date("m");
        $nam = isset($_REQUEST['nam']) ? $_REQUEST['nam'] : date("Y");
        if ($this->model->duyet($thang, $nam)) {
            $jsonObj['msg']     = "Đã duyệt bảng lương tháng ".$thang.'/'.$nam;
            $jsonObj['success'] = true;
        } else {
            $jsonObj['msg']     = "Duyệt bảng lương không thành công";
            $jsonObj['success'] = false;
        }
        echo json_encode($jsonObj);
    }

}
