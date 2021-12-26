<?php
class System extends Controller
{
    // private $_Data;
    function __construct()
    {
        parent::__construct();
        // $this->_Data = new Model();
    }

    function index(){
        require "layouts/header.php";
        $this->view->render("system/index");
        require "layouts/footer.php";
    }

    function banner()
    {
        $jsonObj['code'] = 200;
        $jsonObj['msg'] = "Success";
        $jsonObj['data'] = [['id'=>1, 'link'=>'https://gemstech.com.vn', 'image'=>'https://gemstech.com.vn/uploads/home/ahrm.png'],
              ['id'=>2, 'link'=>'https://gemstech.com.vn', 'image'=>'https://gemstech.com.vn/uploads/home/acrm.png'],
              ['id'=>3, 'link'=>'https://gemstech.com.vn', 'image'=>'https://gemstech.com.vn/uploads/home/atodo.png'],
              ['id'=>4, 'link'=>'https://gemstech.com.vn', 'image'=>'https://gemstech.com.vn/uploads/home/aticket.png'],
            ];
        $jsonObj = json_encode($jsonObj);
        echo $jsonObj;
    }

    function resetpass()
    {
        $jsonObj['code'] = 200;
        $jsonObj['msg'] = "Success";
        $jsonObj['data'] = [];
        $jsonObj = json_encode($jsonObj);
        echo $jsonObj;
    }

    function logout()
    {
        $token = isset($_REQUEST['token']) ? $_REQUEST['token'] : '';
        if ($this->model->logout($token)) {
            session_destroy();
            $jsonObj['msg'] = "Goodbye";
            $jsonObj['success'] = true;
        } else {
            $jsonObj['msg'] = "Lỗi khi xóa token";
            $jsonObj['success'] = false;
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
