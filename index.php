<?php
$url = isset($_GET['url']) ? $_GET['url'] : null;
$url = rtrim($url, '/');
$url = explode('/', $url);
session_start();
date_default_timezone_set("Asia/Ho_Chi_Minh");
ini_set('display_errors', 1);
define('HOME', 'http://' . $_SERVER['HTTP_HOST'] . '/WEB-G-OFFICE');


if ($url[0] == "saveFolder") {
    if(isset($_REQUEST['folder']))
        $_SESSION['folder'] = $_REQUEST['folder'];
    return false;
}
if (isset($_SESSION['folder'])) {
    $folder = $_SESSION['folder'];
  
// function isMobile() {
//     return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
// }
// if(isMobile())
//     header('Location: https://vdata.com.vn/vpdtm/');
// else {
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

    require "views/index/login.php";
}
// }
?>
