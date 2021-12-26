<?php
class bangluong extends Controller
{
    function __construct()
    {
        parent::__construct();
    }

    function index(){
        require "layouts/header.php";
        $this->view->render("bangluong/index");
        require "layouts/footer.php";
    }

    function list()
    {
        $thang = isset($_REQUEST['thang']) ? $_REQUEST['thang'] : date('m');
        $nam = isset($_REQUEST['nam']) ? $_REQUEST['nam'] : date('Y');
        $nhanvien = $_SESSION['user']['staffId'] ;
        $data = $this->model->listObj($thang,$nam,$nhanvien);
        echo json_encode($data);
    }

    function lapbang()
    {
        $nhanvien = $_SESSION['user']['staffId'];
        if (!in_array($nhanvien,[1,7,8,11,27]))
            return false;
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
        $nhanvien = $_SESSION['user']['staffId'];
        if (!in_array($nhanvien,[1,7,8,11,27]))
            return false;
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
        $nhanvien = $_SESSION['user']['staffId'];
        if (!in_array($nhanvien,[1,7,8,11,27]))
            return false;
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

    function checkduyet(){
        $thang = isset($_REQUEST['thang']) ? $_REQUEST['thang']:date("m");
        $nam = isset($_REQUEST['nam']) ? $_REQUEST['nam'] : date("Y");
        if ($this->model->checkduyet($thang, $nam)) {
            $jsonObj['code'] = 200;
        } else {
            $jsonObj['message']     = "Đã duyệt bảng lương tháng ".$thang.'/'.$nam." không thể lập lại";
            $jsonObj['code'] = 401;
        }
        echo json_encode($jsonObj);
    }

}
