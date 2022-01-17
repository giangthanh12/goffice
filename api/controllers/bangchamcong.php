<?php
class bangchamcong extends Controller
{
    function __construct()
    {
        parent::__construct();
    }

    function list()
    {
        $thang = isset($_REQUEST['thang']) ? $_REQUEST['thang'] : date('m');
        $nam = isset($_REQUEST['nam']) ? $_REQUEST['nam'] : date('Y');
        $data = $this->model->listObj($thang,$nam);
        echo json_encode($data);
    }

    function add()
    {
        $thang = $_REQUEST['thang'];
        $nam = $_REQUEST['nam'];
        if ($this->model->addObj($thang,$nam)) {
                $jsonObj['msg']     = "Tạo bảng chấm công thành công";
                $jsonObj['success'] = true;
        } else {
                $jsonObj['msg']     = "Bảng chấm công đã tồn tại";
                $jsonObj['success'] = false;
        }
       echo json_encode($jsonObj);
    }
}
