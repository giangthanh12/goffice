<?php
class position extends Controller{
    function __construct(){
        parent::__construct();
    }

    function listPositions()
    {
        $data = $this->model->listPositions();
        $jsonObj['message'] = "Lấy dữ liệu thành công";
        $jsonObj['code'] = 200;
        $jsonObj['data'] = $data;
        http_response_code(200);
        echo json_encode($jsonObj);
    }

}
?>