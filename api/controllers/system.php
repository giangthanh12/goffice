<?php
class System extends Controller
{
    // private $_Data;
    function __construct()
    {
        parent::__construct();
        // $this->_Data = new Model();
    }

    function banner()
    {
        $jsonObj['code'] = 200;
        $jsonObj['msg'] = "Success";
        $jsonObj['data'] = [
            ['id' => 1, 'link' => 'https://gemstech.com.vn', 'image' => 'https://gemstech.com.vn/uploads/home/ahrm.png'],
            ['id' => 2, 'link' => 'https://gemstech.com.vn', 'image' => 'https://gemstech.com.vn/uploads/home/acrm.png'],
            ['id' => 3, 'link' => 'https://gemstech.com.vn', 'image' => 'https://gemstech.com.vn/uploads/home/atodo.png'],
            ['id' => 4, 'link' => 'https://gemstech.com.vn', 'image' => 'https://gemstech.com.vn/uploads/home/aticket.png'],
        ];
        $jsonObj = json_encode($jsonObj);
        echo $jsonObj;
    }

    function checkOldPassword()
    {
        $id = isset($_REQUEST['staffId']) ? $_REQUEST['staffId'] : 0;
        if ($id == 0) {
            $jsonObj['message'] = "Chưa nhập staffId";
            $jsonObj['code'] = 401;
            $jsonObj['data'] = [];
            http_response_code(401);
            echo json_encode($jsonObj);
            return false;
        } else {
            $json = $this->model->checkId($id);
            if ($json == 0) {
                $jsonObj['message'] = "Nhân viên không tồn tại trong hệ thống";
                $jsonObj['code'] = 401;
                $jsonObj['data'] = [];
                http_response_code(401);
                echo json_encode($jsonObj);
                return false;
            }
        }
        $password = isset($_REQUEST['password']) ? $_REQUEST['password'] : '';
        if ($password == '') {
            $jsonObj['message'] = "Chưa nhập mật khẩu";
            $jsonObj['code'] = 401;
            $jsonObj['data'] = [];
            http_response_code(401);
            echo json_encode($jsonObj);
            return false;
        }
        $json = $this->model->checkOldPassword($id, $password);
        if ($json == 0) {
            $jsonObj['message'] = "Mật khẩu cũ không chính xác";
            $jsonObj['code'] = 402;
            $jsonObj['data'] = [];
            http_response_code(402);
            echo json_encode($jsonObj);
        } else {
            $jsonObj['message'] = "Thành công";
            $jsonObj['code'] = 200;
            $jsonObj['data'] = [];
            http_response_code(200);
            echo json_encode($jsonObj);
        }
    }

    function changePassword()
    {
        $id = isset($_REQUEST['staffId']) ? $_REQUEST['staffId'] : 0;
        if ($id == 0) {
            $jsonObj['message'] = "Chưa nhập staffId";
            $jsonObj['code'] = 401;
            $jsonObj['data'] = [];
            http_response_code(401);
            echo json_encode($jsonObj);
            return false;
        } else {
            $json = $this->model->checkId($id);
            if ($json == 0) {
                $jsonObj['message'] = "Nhân viên không tồn tại trong hệ thống";
                $jsonObj['code'] = 401;
                $jsonObj['data'] = [];
                http_response_code(401);
                echo json_encode($jsonObj);
                return false;
            }
        }
        $newPassword = isset($_REQUEST['newPassword']) ? $_REQUEST['newPassword'] : '';
        if ($newPassword == '') {
            $jsonObj['message'] = "Chưa nhập mật khẩu mới";
            $jsonObj['code'] = 401;
            $jsonObj['data'] = [];
            http_response_code(401);
            echo json_encode($jsonObj);
            return false;
        }
        $confirmPassword = isset($_REQUEST['confirmPassword']) ? $_REQUEST['confirmPassword'] : '';
        if ($confirmPassword == '') {
            $jsonObj['message'] = "Chưa nhập lại mật khẩu";
            $jsonObj['code'] = 401;
            $jsonObj['data'] = [];
            http_response_code(401);
            echo json_encode($jsonObj);
            return false;
        }
        if ($newPassword != $confirmPassword) {
            $jsonObj['message'] = "Mật khẩu không khớp";
            $jsonObj['code'] = 401;
            $jsonObj['data'] = [];
            http_response_code(401);
            echo json_encode($jsonObj);
            return false;
        } else {
            $json = $this->model->changePassword($id, $newPassword);
            if ($json == 0) {
                $jsonObj['message'] = "Đổi mật khẩu không thành công";
                $jsonObj['code'] = 402;
                $jsonObj['data'] = [];
                http_response_code(402);
                echo json_encode($jsonObj);
            } else {
                $jsonObj['message'] = "Đổi mật khẩu thành công";
                $jsonObj['code'] = 200;
                $jsonObj['data'] = [];
                http_response_code(200);
                echo json_encode($jsonObj);
            }
        }
    }

    function forgetPassword()
    {
        $email = isset($_REQUEST['email']) ? $_REQUEST['email'] : '';
        // $taxCode = isset($_REQUEST['taxCode']) ? $_REQUEST['taxCode'] : '';
        // if ($taxCode == '') {
        //     $jsonObj['message'] = "Chưa nhập taxCode";
        //     $jsonObj['code'] = 401;
        //     $jsonObj['data'] = [];
        //     http_response_code(401);
        //     echo json_encode($jsonObj);
        //     return false;
        // }
        $url = $_GET['url'];
        $url = rtrim($url, '/');
        $url = explode('/', $url);
        $taxCode = $url[0];
        if ($email == '') {
            $jsonObj['message'] = "Chưa nhập email";
            $jsonObj['code'] = 401;
            $jsonObj['data'] = [];
            http_response_code(401);
            echo json_encode($jsonObj);
            return false;
        }
        $result = $this->model->checkEmail($email);
        if ($result != 0) {
            $activeCode = substr(str_shuffle('1234567890'), 0, 6);
            $data = [
                'activeCode' => $activeCode
            ];
            $url = HOME . '/changePassword?taxCode=' . $taxCode . '&activeCode=' . MD5(MD5($activeCode));
            $this->model->addActiveCode($result['userId'], $data);
            $json = $this->model->sendEmail($email, $result['name'], $url);
            if ($json == 0) {
                $jsonObj['message'] = "Gửi email không thành công";
                $jsonObj['code'] = 402;
                http_response_code(402);
            } else {
                $jsonObj['message'] = "Vui lòng kiểm tra email để xác nhận thay đổi mật khẩu";
                $jsonObj['code'] = 200;
                http_response_code(402);
            }
        } else {
            $jsonObj['message'] = "Tài khoản không tồn tại trong hệ thống!";
            $jsonObj['code'] = 402;
            http_response_code(402);
        }
        echo json_encode($jsonObj);
    }

    function changePass()
    {
        $activeCode = isset($_REQUEST['activeCode']) ? $_REQUEST['activeCode'] : '';
        $taxCode = isset($_REQUEST['taxCode']) ? $_REQUEST['taxCode'] : '';
        if ($activeCode == '' || file_exists('users/' . $taxCode . '/startup.php') == false) {
            $jsonObj['message'] = "Link hết hạn!";
            $jsonObj['success'] = false;
            echo json_encode($jsonObj);
            return false;
        } else {
            $userId = $this->model->checkActiveCode($activeCode);
            if ($userId == 0) {
                $jsonObj['message'] = "Link hết hạn!";
                $jsonObj['success'] = false;
                echo json_encode($jsonObj);
                return false;
            } else {
                $newPass = isset($_REQUEST['newPass']) ? $_REQUEST['newPass'] : '';
                $confirmPass = isset($_REQUEST['confirmPass']) ? $_REQUEST['confirmPass'] : '';
                if ($newPass == '') {
                    $jsonObj['message'] = "Bạn chưa nhập mật khẩu mới!";
                    $jsonObj['success'] = false;
                    echo json_encode($jsonObj);
                    return false;
                }
                if ($confirmPass == '') {
                    $jsonObj['message'] = "Bạn chưa xác nhận mật khẩu mới!";
                    $jsonObj['success'] = false;
                    echo json_encode($jsonObj);
                    return false;
                }
                if ($newPass != $confirmPass) {
                    $jsonObj['message'] = "Mật khẩu không khớp!";
                    $jsonObj['success'] = false;
                    echo json_encode($jsonObj);
                    return false;
                }
                $data = [
                    'password' => md5(md5($newPass)),
                    'activeCode' => ''
                ];
                $result = $this->model->changePass($userId, $data);
                if ($result == 0) {
                    $jsonObj['message'] = "Thay đổi mật khẩu không thành công!";
                    $jsonObj['success'] = false;
                    echo json_encode($jsonObj);
                } else {
                    $jsonObj['message'] = "Thay đổi mật khẩu thành công!";
                    $jsonObj['success'] = true;
                    echo json_encode($jsonObj);
                }
            }
        }
    }

    // function logout()
    // {
    //     $token = isset($_REQUEST['token']) ? $_REQUEST['token'] : '';
    //     if ($this->model->logout($token)) {
    //         session_destroy();
    //         $jsonObj['msg'] = "Goodbye";
    //         $jsonObj['success'] = true;
    //     } else {
    //         $jsonObj['msg'] = "Lỗi khi xóa token";
    //         $jsonObj['success'] = false;
    //     }
    //     $jsonObj = json_encode($jsonObj);
    //     echo $jsonObj;
    // }

    // function info_auth(){
    //     $token = $_REQUEST['token'];
    //     $info = $this->model->get_info_user_via_token($token);
    //     $this->view->jsonObj = json_encode($info);
    //     $this->view->render("auth/info_auth");
    // }

    // function check_token()
    // {
    //     if (isset($_REQUEST['token'])) {
    //         $token = $_REQUEST['token'];
    //         if ($this->model->check_token($token) > 0) {
    //             $jsonObj['msg'] = "Token có tồn tại";
    //             $jsonObj['success'] = true;
    //         } else {
    //             $jsonObj['msg'] = "Token không tồn tại";
    //             $jsonObj['success'] = false;
    //         }
    //         echo json_encode($jsonObj);
    //     }
    // }

}
