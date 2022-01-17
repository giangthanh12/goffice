<?php

class Bootstrap
{
    function __construct()
    {
        $url = isset($_GET['url']) ? $_GET['url'] : null;
        $url = rtrim($url, '/');
        $url = explode('/', $url);
        $folder = $_SESSION['folder'];
        if (file_exists('users/' . $folder . '/startup.php') == false) {
            if($url[0] == "forgetPassword") {
                require "views/index/forgetPassword.php";
                return false;
            }
            if($url[0] == "changePassword") {
                require "views/index/changePassword.php";
                return false;
            }
            if ($url[0] != "auth")
                require "views/index/login.php";
            else {
                $jsonObj['code'] = 301;
                $jsonObj['message'] = "Mã doanh nghiệp không có trong hệ thống";
                echo json_encode($jsonObj);
            }
            return false;
        }
        if ($url[0] == "forgetPassword") {
            require "views/index/forgetPassword.php";
            return false;
        }
        if($url[0] == "changePassword") {
            require "views/index/changePassword.php";
            return false;
        }
        if (!isset($_SESSION[SID])) {
            if (empty($url[0])) {
                require "views/index/login.php";
                return false;
            } elseif ($url[0] != "auth" || empty($url[1])) {
                header('Location: ' . HOME);
                return false;
            }
        }
        if (empty($url[0])) {
            $url[0] = "index";
        }
        if (empty($url[1])) {
            // echo '<script>window.location.href="https://velo.vn"</script>';
            $url[1] = "index";
        }

        if (empty($url[1])) {
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


        $file = 'controllers/' . $url[0] . '.php';
        if (file_exists($file)) {
            require $file;
        } else {
            $this->error();
        }
        $controller = new$url[0];
        $controller->loadModel($url[0]);

        // calling methods
        if (isset($url[1])) {
            if (method_exists($controller, $url[1])) {
                $controller->{$url[1]}($url[1]);
            } else {
                $this->error();
            }
        } else {
            $controller->index();
        }
//        else {
//            if (isset($url[2])) {
//                if (method_exists($controller, $url[2])) {
//                    $controller->{$url[2]}();
//                } else {
//                    $this->error();
//                }
//            } else {
//                $controller->index();
//            }
//        }
    }

    function error()
    {
        require 'controllers/thongbao.php';
        $controller = new thongbao();
        $controller->index();
        return false;
    }
}
