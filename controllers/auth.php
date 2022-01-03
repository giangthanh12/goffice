<?php

class auth extends Controller
{
  // private $_Data;
  function __construct()
  {
    parent::__construct();
    // $this->_Data = new Model();
  }

  function index()
  {
  }

  function login()
  {
    if (isset($_REQUEST['username']) && isset($_REQUEST['password'])) {
      $username = md5($_REQUEST['username']);
      $password = md5(md5($_REQUEST['password']));
      $data = $this->model->checkIn($username, $password);
      if (isset($data['id'])) {
        $jsonObj['code'] = 200;
        $jsonObj['data'] = $data;
        $_SESSION[SID] = true;
        $_SESSION['user'] = $data;
        $this->model->updateDeadline();
      } else {
        $jsonObj['message'] = "Thông tin đăng nhập không chính xác";
        $jsonObj['code'] = 401;
      }
    } else {
      $jsonObj['message'] = "Chưa nhập tài khoản hoặc mật khẩu ";
      $jsonObj['code'] = 402;
    }
    $jsonObj = json_encode($jsonObj);
    echo $jsonObj;
  }

  function logout()
  {
    session_destroy();
    http_response_code(200);
    $jsonObj['message'] = "Goodbye";
    $jsonObj['code'] = 200;
    $jsonObj = json_encode($jsonObj);
    echo $jsonObj;
  }

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

  function resetPassword()
  {
    $email = isset($_REQUEST['email']) ? $_REQUEST['email'] : '';
    $taxCode = isset($_REQUEST['taxCode']) ? $_REQUEST['taxCode'] : '';
    if ($email == '') {
      $jsonObj['message'] = "Vui lòng nhập email để xác nhận!";
      $jsonObj['success'] = false;
    } else {
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
          $jsonObj['success'] = false;
        } else {
          $jsonObj['message'] = "Vui lòng kiểm tra email để xác nhận thay đổi mật khẩu";
          $jsonObj['success'] = true;
        }
      } else {
        $jsonObj['message'] = "Tài khoản không tồn tại trong hệ thống!";
        $jsonObj['success'] = false;
      }
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
          // 'activeCode' => ''
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
}
