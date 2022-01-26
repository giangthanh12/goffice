<?php
class customer extends Controller
{
    function __construct()
    {
        parent::__construct();
    }

    function listCustomers()
    {
        $json = $this->model->listCustomers();
        if ($json == 0) {
            $jsonObj['message'] = "Lỗi lấy dữ liệu";
            $jsonObj['code'] = 401;
            $jsonObj['data'] = [];
            http_response_code(200);
            echo json_encode($jsonObj);
            return false;
        } else {
            $jsonObj['message'] = "Lấy dữ liệu thành công";
            $jsonObj['code'] = 200;
            $jsonObj['data'] = $json;
            http_response_code(200);
            echo json_encode($jsonObj);
            return true;
        }
        echo json_encode($json);
    }

    function detailCustomer()
    {
        $customerId = isset($_REQUEST['customerId']) ? $_REQUEST['customerId'] : '';
        if ($customerId == '') {
            $jsonObj['message'] = "Chưa nhập customerId";
            $jsonObj['code'] = 401;
            $jsonObj['data'] = [];
            http_response_code(200);
            echo json_encode($jsonObj);
            return false;
        } else {
            $json = $this->model->detailCustomer($customerId);
            if ($json == 0) {
                $jsonObj['message'] = "Lỗi lấy dữ liệu";
                $jsonObj['code'] = 402;
                $jsonObj['data'] = [];
                http_response_code(200);
                echo json_encode($jsonObj);
                return false;
            } else {
                $jsonObj['message'] = "Lấy dữ liệu thành công";
                $jsonObj['code'] = 200;
                $jsonObj['data'] = $json;
                http_response_code(200);
                echo json_encode($jsonObj);
                return true;
            }
            echo json_encode($json);
        }
    }

    function listCustomerCares()
    {
        $customerId = isset($_REQUEST['customerId']) ? $_REQUEST['customerId'] : '';
        if ($customerId == '') {
            $jsonObj['message'] = "Chưa nhập customerId";
            $jsonObj['code'] = 401;
            $jsonObj['data'] = [];
            http_response_code(200);
            echo json_encode($jsonObj);
            return false;
        } else {
            $json = $this->model->listCustomerCares($customerId);
            if ($json == 0) {
                $jsonObj['message'] = "Lỗi lấy dữ liệu";
                $jsonObj['code'] = 402;
                $jsonObj['data'] = [];
                http_response_code(200);
                echo json_encode($jsonObj);
                return false;
            } else {
                $jsonObj['message'] = "Lấy dữ liệu thành công";
                $jsonObj['code'] = 200;
                $jsonObj['data'] = $json;
                http_response_code(200);
                echo json_encode($jsonObj);
                return true;
            }
            echo json_encode($json);
        }
    }
}
