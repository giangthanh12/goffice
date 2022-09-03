<?php

class Bootstrap
{
    function __construct()
    {
      
        $url = isset($_SERVER["REQUEST_URI"]) ? $_SERVER["REQUEST_URI"] : null;
        $url = rtrim($url, '/');
        $url = explode('/', $url);
        $folder = $_SESSION['folder'];
        if (file_exists('users/' . $folder . '/startup.php') == false) {
            if(array_key_exists(2,$url) &&  $url[2] == "forgetPassword") {
                require "views/index/forgetPassword.php";
                return false;
            }
            if(array_key_exists(2,$url) && $url[2] == "changePassword") {
                require "views/index/changePassword.php";
                return false;
            }
            if (array_key_exists(2,$url) && $url[2] != "auth")
                require "views/index/login.php";
            else {
                $jsonObj['code'] = 301;
                $jsonObj['message'] = "Mã doanh nghiệp không có trong hệ thống";
                echo json_encode($jsonObj);
            }
            return false;
        }
        if (array_key_exists(2,$url) && $url[2] == "forgetPassword") {
            require "views/index/forgetPassword.php";
            return false;
        }
        if(array_key_exists(2,$url) && $url[0] == "changePassword") {
            require "views/index/changePassword.php";
            return false;
        }
        // if (!isset($_SESSION[SID])) {
        if (!isset($_COOKIE[SID])) {
            if (empty($url[2])) {
                require "views/index/login.php";
                return false;
            } elseif ($url[2] != "auth" || empty($url[3])) {
                header('Location: ' . HOME);
                return false;
            }
        }
        
        if (empty($url[2])) {
            $url[2] = "index";
        }
        if (empty($url[3])) {
            // echo '<script>window.location.href="https://velo.vn"</script>';
            $url[3] = "index";
        }

        if (empty($url[3])) {
            require 'controllers/index.php';
            $controller = new Index();
            $controller->index();
            return false;
        }
//        if (isset($_SESSION[SID]) && $_SESSION[SID] != md5(URL)) {
//            $jsonObj['msg'] = $_SESSION[SID];
//            $jsonObj['success'] = false;
//            echo json_encode($jsonObj);
//          //  return false;
//        }


        $file = 'controllers/' . $url[2] . '.php';
        if (file_exists($file)) {
            require $file;
        } else {
            $this->error();
        }
        $controller = new$url[2];
        $controller->loadModel($url[2]);

        // calling methods
        if (isset($url[3])) {
            $url = $url[3];
            $check = strpos((string) $url, "?");
            if($check) {
                $url_ar = explode("?", $url);
                $url = $url_ar[0];
            }
            if (method_exists($controller, $url)) {
                $controller->{$url}($url);
            } else {
                //getdata?status=
                $this->error();
            }
        } else {
            $controller->index();
        }
    }
    function error()
    {
        require 'controllers/thongbao.php';
        $controller = new thongbao();
        $controller->index();
        return false;
    }
}
