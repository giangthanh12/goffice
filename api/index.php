<?php
header('Access-Control-Allow-Origin: *');
header('Content-type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers:Access-Control-Allow-Headers, Content-type, Access-Control-Allow-Methods, Authorization, X-Request-With');
session_start();
date_default_timezone_set("Asia/Ho_Chi_Minh");
ini_set('display_errors', 1);
define('HOME', 'https://' . $_SERVER['HTTP_HOST'] . '/goffice');
$url = isset($_GET['url']) ? $_GET['url'] : null;
$url = rtrim($url, '/');
$url = explode('/', $url);
$folder = $url[0];
if (file_exists($_SERVER['DOCUMENT_ROOT'].'/goffice'.'/users/' . $folder . '/startup.php')) {
    require  $_SERVER['DOCUMENT_ROOT'].'/goffice'.'/users/' . $folder . '/startup.php';
}else{
    $jsonObj['code'] = 501;
    $jsonObj['message'] = 'Sai mã doanh nghiệp';
    $jsonObj['data'] = [];
    http_response_code(501);
    echo json_encode($jsonObj);
    return false;
}
define('SID', md5(URL));
// Library
require 'libs/Database.php';

// Use an autoloader!
require 'libs/Bootstrap.php';
require 'libs/Controller.php';
require 'libs/Model.php';
require 'libs/functions.php';


$app = new Bootstrap();

?>
