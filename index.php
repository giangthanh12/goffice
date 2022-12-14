<?php
$url = isset($_SERVER["REQUEST_URI"]) ? $_SERVER["REQUEST_URI"] : null;
$url = rtrim($url, '/');
$url = explode('/', $url);

session_start();
date_default_timezone_set("Asia/Ho_Chi_Minh");
ini_set('display_errors', 1);
define('HOME', 'https://' . $_SERVER['HTTP_HOST'] . '/web-g-office');


if ( array_key_exists(2,$url) && $url[2] == "saveFolder") {
  
    if(isset($_REQUEST['folder']))
        $_SESSION['folder'] = $_REQUEST['folder'];
    return false;
}
if (isset($_SESSION['folder'])) {
    $folder = $_SESSION['folder'];
    if (file_exists('users/' . $folder . '/startup.php')) {
        require 'users/' . $folder . '/startup.php';
        define('SID', md5(HOME . "-" . $folder));
        require 'libs/database.php';
        require 'libs/model.php';
        require 'libs/controller.php';
        require 'libs/view.php';
        require 'libs/functions.php';
        require 'libs/bootstrap.php';
        require 'libs/mailin.php';
        $app = new bootstrap();
    } else {
        require 'libs/bootstrap.php';
        $app = new bootstrap();
    }
} else {
  
    if(array_key_exists(2,$url) && $url[2] == "forgetPassword") {
        require "views/index/forgetPassword.php";
    } elseif(array_key_exists(2,$url) && $url[2] == "changePassword") {
        require "views/index/changePassword.php";
    } else {
        if(isset($_COOKIE['folder']) && isset($_COOKIE['username'])) {
          define('SID', md5(HOME . "-" . $_COOKIE['folder']));
          if (file_exists('users/' . $_COOKIE['folder'] . '/startup.php')) {
            require 'users/' . $_COOKIE['folder'] . '/startup.php';
            require 'libs/database.php';
            require 'libs/model.php';
            require 'libs/controller.php';
            require 'libs/view.php';
            require 'libs/functions.php';
            require 'libs/mailin.php';
            $_SESSION['folder'] = $_COOKIE['folder'];
            $model = new model();
            $user =  $model->checkUsername($_COOKIE['username']);
            if($user != [])  {
              $_SESSION['user'] = $user;
              require 'libs/bootstrap.php';
              $app = new bootstrap();
              // header('location:' . HOME);
            }
            else {
              setcookie(SID, true, time() - 604800,'/');
              setcookie('folder', $_COOKIE['folder'], time() - 604800,'/');
              setcookie('username', $_COOKIE['username'], time() - 604800,'/');
              session_destroy();
              require "views/index/login.php";
            }
          }
          else {
         
            setcookie(SID, true, time() - 604800,'/');
            setcookie('folder', $_COOKIE['folder'], time() - 604800,'/');
            setcookie('username', $_COOKIE['username'], time() - 604800,'/');
            session_destroy();
            require "views/index/login.php";
          }
        
        }
   
        else {
      
            require "views/index/login.php";
        }
        
        
    }
}
// }
?>
