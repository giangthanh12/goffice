<?php

class Bootstrap
{
    function __construct()
    {
        $url = isset($_GET['url']) ? $_GET['url'] : null;
        $url = rtrim($url, '/');
        $url = explode('/', $url);
        if (empty($url[0])) {
            // echo '<script>window.location.href="https://velo.vn"</script>';
            return false;
        }
        if (empty($url[1]) && empty($url[2])) {
            $jsonObj['message'] = "Doanh nghiệp của bạn đã được đăng ký sử dụng phần mềm";
            $jsonObj['code'] = 200;
            $jsonObj['data'] = [];
            http_response_code(200);
            echo json_encode($jsonObj);
            return false;
        }

        if (empty($url[1]) || empty($url[2])) {
            $jsonObj['message'] = "Api không tồn tại";
            $jsonObj['code'] = 502;
            $jsonObj['data'] = [];
            http_response_code(502);
            echo json_encode($jsonObj);
            return false;
        }
        $checkUrl1 = false;
        $arrayUrl1 = ['auth', 'system'];
        if (in_array($url[1], $arrayUrl1))
            $checkUrl1 = true;
        $checkUrl2 = false;
        $arrayUrl2 = ['login', 'check_token', 'forgetPassword', 'checkActiveCode'];
        if (in_array($url[2], $arrayUrl2))
            $checkUrl2 = true;
        if(isset($_REQUEST['token']) && $_REQUEST['token']!='GofficeGemstech@1234'){
            $checkUrl1 = false;
            $checkUrl2 = false;
        }
        if ($checkUrl1 == false || $checkUrl2 == false) {
            if (!isset($_REQUEST['token'])) {
                $jsonObj['message'] = "Bạn chưa nhập token";
                $jsonObj['code'] = 401;
                http_response_code(401);
                $jsonObj['data'] = [];
                echo json_encode($jsonObj);
                return false;
            } else {
                $model = new Model();
                $checktoken = $model->check_token($_REQUEST['token']);
                if ($checktoken <= 0) {
                    $jsonObj['message'] = "Token không tồn tại";
                    $jsonObj['code'] = 402;
                    http_response_code(402);
                    $jsonObj['data'] = [];
                    echo json_encode($jsonObj);
                    return false;
                } else {
                    $jsonObj['message'] = "Success";
                    $jsonObj['code'] = 200;
                    http_response_code(200);
                    $jsonObj['data'] = [];
                }
            }
        }


        $file = 'controllers/' . $url[1] . '.php';
        if (file_exists($file)) {
            require $file;
        } else {
            echo 'Không tồn tại file';
            return false;
        }
        $controller = new $url[1];
        $controller->loadModel($url[1]);

        // calling methods
        if (isset($url[2])) {
            if (method_exists($controller, $url[2])) {
                $controller->{$url[2]}($url[2]);
            } else {
                'Không tồn tại method';
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
}
