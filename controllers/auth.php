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
      $username = md5(trim($_REQUEST['username']));
      $password = md5(md5($_REQUEST['password']));
      $data = $this->model->checkIn($username, $password);
      if (isset($data['id'])) {
        $taxcode = $_SESSION['folder'];
        // call g_menus
        if($taxcode != 'gemstech') {
          $curl = curl_init();
          curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://velo.vn/customers/customer_functions/getPackets?token=e594864995037d740cadc97edd181702',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS => array('taxCode' => $taxcode),
          CURLOPT_HTTPHEADER => array(
              'Cookie: PHPSESSID=6mumjsl1rup8dl54nj9tol88rn'
          ),
          ));
          $response = curl_exec($curl);
          curl_close($curl);
         
          $response = json_decode($response);
          $menuIds = $response->data;
          // $_SESSION['menuIds'] = $menuIds;
          setcookie('menuIds', $menuIds, time() + 604800,'/');
        }


        
        $jsonObj['code'] = 200;
        $jsonObj['data'] = $data;
        $_SESSION[SID] = true;
        // set cookie
        setcookie(SID, true, time() + 604800,'/',);
        setcookie('folder',$_SESSION['folder'] , time() + 604800,'/');
        setcookie('username', $username, time() + 604800,'/');

        // setcookie("testcookie", "value1hostonly", time(), "/", HOME, 0, true);
        
        $_SESSION['user'] = $data;
        $this->model->updateDeadline();
      } else {
        $jsonObj['message'] = "Th??ng tin ????ng nh???p kh??ng ch??nh x??c";
        $jsonObj['code'] = 401;
      }
    } else {
      $jsonObj['message'] = "Ch??a nh???p t??i kho???n ho???c m???t kh???u ";
      $jsonObj['code'] = 402;
    }
    $jsonObj = json_encode($jsonObj);
    echo $jsonObj;
  }

  function logout()
  {
    
    setcookie(SID, true, time() - 604800,'/');
    setcookie('folder', $_COOKIE['folder'], time() - 604800,'/');
    setcookie('username', $_COOKIE['username'], time() - 604800,'/');
    if(isset($_COOKIE['menuIds'])) {
      setcookie('menuIds', $_COOKIE['menuIds'], time() - 604800,'/');
    }
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
        $jsonObj['msg'] = "Token c?? t???n t???i";
        $jsonObj['success'] = true;
      } else {
        $jsonObj['msg'] = "Token kh??ng t???n t???i";
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
      $jsonObj['message'] = "Vui l??ng nh???p email ????? x??c nh???n!";
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
          $jsonObj['message'] = "G???i email kh??ng th??nh c??ng";
          $jsonObj['success'] = false;
        } else {
          $jsonObj['message'] = "Vui l??ng ki???m tra email ????? x??c nh???n thay ?????i m???t kh???u";
          $jsonObj['success'] = true;
        }
      } else {
        $jsonObj['message'] = "T??i kho???n kh??ng t???n t???i trong h??? th???ng!";
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
      $jsonObj['message'] = "Link h???t h???n!";
      $jsonObj['success'] = false;
      echo json_encode($jsonObj);
      return false;
    } else {
      $userId = $this->model->checkActiveCode($activeCode);
      if ($userId == 0) {
        $jsonObj['message'] = "Link h???t h???n!";
        $jsonObj['success'] = false;
        echo json_encode($jsonObj);
        return false;
      } else {
        $newPass = isset($_REQUEST['newPass']) ? $_REQUEST['newPass'] : '';
        $confirmPass = isset($_REQUEST['confirmPass']) ? $_REQUEST['confirmPass'] : '';
        if ($newPass == '') {
          $jsonObj['message'] = "B???n ch??a nh???p m???t kh???u m???i!";
          $jsonObj['success'] = false;
          echo json_encode($jsonObj);
          return false;
        }
        if ($confirmPass == '') {
          $jsonObj['message'] = "B???n ch??a x??c nh???n m???t kh???u m???i!";
          $jsonObj['success'] = false;
          echo json_encode($jsonObj);
          return false;
        }
        if ($newPass != $confirmPass) {
          $jsonObj['message'] = "M???t kh???u kh??ng kh???p!";
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
          $jsonObj['message'] = "Thay ?????i m???t kh???u kh??ng th??nh c??ng!";
          $jsonObj['success'] = false;
          echo json_encode($jsonObj);
        } else {
          $jsonObj['message'] = "Thay ?????i m???t kh???u th??nh c??ng!";
          $jsonObj['success'] = true;
          echo json_encode($jsonObj);
        }
      }
    }
  }
}
