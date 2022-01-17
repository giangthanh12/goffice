<?php

class Auth extends Controller
{
    // private $_Data;
    function __construct()
    {
        parent::__construct();
        // $this->_Data = new Model();
    }

    function login()
    {
        if (isset($_REQUEST['username']) && isset($_REQUEST['password'])) {
            $username = md5($_REQUEST['username']);
            $password = md5(md5($_REQUEST['password']));
            $data = $this->model->login($username, $password);
            if (isset($data['id'])) {
                $token = md5(time() . $data['id']);
                $this->model->updateToken($username, $password, $token);
                $jsonObj['code'] = 200;
                $jsonObj['data'] = $data;
                $jsonObj['data']['token']=$token;
                http_response_code(200);
                $this->model->updateDeadline();
            } elseif ($data == 0) {
                $jsonObj['message'] = "Lỗi API";
                $jsonObj['code'] = 400;
                http_response_code(400);
            } else {
                $jsonObj['message'] = "Thông tin đăng nhập không chính xác";
                $jsonObj['code'] = 402;
                http_response_code(402);
            }
        } else {
            $jsonObj['message'] = "Chưa nhập tài khoản hoặc mật khẩu ";
            $jsonObj['code'] = 401;
            http_response_code(401);
        }
        $jsonObj = json_encode($jsonObj);
        echo $jsonObj;
    }

    function logout()
    {
        $token = isset($_REQUEST['token']) ? $_REQUEST['token'] : '';

        $userid = isset($_SESSION['user']['id']) ? $_SESSION['user']['id'] : (isset($_REQUEST['userId']) ? $_REQUEST['userId'] : 0);
        if ($userid > 0) {
            if ($this->model->logout($token, $userid)) {
                session_destroy();
                http_response_code(200);
                $jsonObj['message'] = "Goodbye";
                $jsonObj['code'] = 200;
            } else {
                http_response_code(401);
                $jsonObj['message'] = "Failed";
                $jsonObj['code'] = 401;
            }
        } else {
            http_response_code(402);
            $jsonObj['message'] = "Failed";
            $jsonObj['code'] = 402;
        }
        $jsonObj = json_encode($jsonObj);
        echo $jsonObj;
    }

    // function info_auth(){
    //     $token = $_REQUEST['token'];
    //     $info = $this->model->get_info_user_via_token($token);
    //     $this->view->jsonObj = json_encode($info);
    //     $this->view->render("auth/info_auth");
    // }

    function check_token()
    {
        if (isset($_REQUEST['token'])) {
            $token = $_REQUEST['token'];
            if ($this->model->check_token($token) > 0) {
                $jsonObj['msg'] = "Token có tồn tại";
                $jsonObj['success'] = true;
            } else {
                $jsonObj['msg'] = "Token không tồn tại";
                $jsonObj['success'] = false;
            }
            echo json_encode($jsonObj);
        }
    }
}

?>
