<?php

class listusers extends Controller
{
    function __construct()
    {
        parent::__construct();
    }

    function index()
    {
        require "layouts/header.php";
        $this->view->render("listusers/index");
        require "layouts/footer.php";
    }

    function getAllData()
    {
        $data = $this->model->getAllData();
        echo json_encode($data);
    }

    function loadDataById()
    {
        $id = isset($_REQUEST['id']) ? $_REQUEST['id'] : 0;
        $json = $this->model->getDataById($id);
        echo json_encode($json);
    }

    function updateInfo()
    {
        $data = $_REQUEST['data'];
        $id = $_REQUEST['id'];
        if ($this->model->updateinfo($data, $id)) {
            $jsonObj['msg'] = "Cập nhật dữ liệu thành công";
            $jsonObj['success'] = true;
        } else {
            $jsonObj['msg'] = "Lỗi khi cập nhật database";
            $jsonObj['success'] = false;
        }
        echo json_encode($jsonObj);
    }


    function add()
    {
        $username = $_POST['username'];
        $checkUsername = $this->model->checkUsername($username);
        if ($checkUsername == 0) {
            $usernameMd5 = md5($_POST['username']);
            $staffId = $_POST['staffId'];
            $groupId = $_POST['groupId'];
            $password = md5(md5($_POST['password']));
            $data = [
                'username' => $username,
                'usernameMd5' => $usernameMd5,
                'staffId' => $staffId,
                'groupId' => $groupId,
                'password' => $password,
                'classify'=>2,
                'status' => 1];
            if ($this->model->addObj($data)) {
                $jsonObj['message'] = "Cập nhật dữ liệu thành công";
                $jsonObj['code'] = 200;
            } else {
                $jsonObj['message'] = "Lỗi khi cập nhật database";
                $jsonObj['code'] = 401;
            }
        } else {
            $jsonObj['message'] = "Username đã tồn tại trong hệ thống";
            $jsonObj['code'] = 402;
        }
        echo json_encode($jsonObj);
    }

    function del()
    {
        $id = $_REQUEST['id'];
        if ($this->model->delObj($id)) {
            $jsonObj['message'] = "Cập nhật dữ liệu thành công";
            $jsonObj['code'] = 200;
        } else {
            $jsonObj['message'] = "Lỗi khi xóa dữ liệu" ;
            $jsonObj['code'] = 401;
            $jsonObj['data'] = $id;
        }
        echo json_encode($jsonObj);
    }

    function update()
    {
        $id = $_REQUEST['id'];
        $staffId = $_POST['staffId'];
        $groupId = $_POST['groupId'];
        $password = $_POST['password'];
        $data = [
            'staffId' => $staffId,
            'groupId' => $groupId
        ];
        if($password!='')
            $data['password'] = md5(md5($password));
        if ($this->model->updateObj($data,$id)) {
            $jsonObj['message'] = "Cập nhật dữ liệu thành công";
            $jsonObj['code'] = 200;
        } else {
            $jsonObj['message'] = "Lỗi khi cập nhật database";
            $jsonObj['code'] = 401;
        }
        echo json_encode($jsonObj);
    }

    function getMenus(){
        $userId = isset($_REQUEST['userId']) ? $_REQUEST['userId'] : 0;
        $json = $this->model->getMenusByUser($userId);
        echo json_encode($json);
    }

    function setFunctionRole(){
        $userId = isset($_REQUEST['userId']) ? $_REQUEST['userId'] : 0;
        $funcId = isset($_REQUEST['funcId']) ? $_REQUEST['funcId'] : 0;
        $check = isset($_REQUEST['check']) ? $_REQUEST['check'] : 0;
        $this->model->setFunctionRole($userId,$funcId,$check);
        echo $funcId;
    }

    function setMenuRole(){
        $userId = isset($_REQUEST['userId']) ? $_REQUEST['userId'] : 0;
        $menuId = isset($_REQUEST['menuId']) ? $_REQUEST['menuId'] : 0;
        $check = isset($_REQUEST['check']) ? $_REQUEST['check'] : 0;
        if($userId>0 && $menuId>0)
            $this->model->setMenuRole($userId,$menuId,$check);
    }

    function updateRoles(){
        $listMenus = isset($_REQUEST['menus']) ? $_REQUEST['menus'] : [];
        $listFuncs = isset($_REQUEST['functions']) ? $_REQUEST['functions'] : [];
        $userId = isset($_REQUEST['userId']) ? $_REQUEST['userId'] : 0;
        $menus = '';
        $functions = '';
        if(count($listMenus)>0){
            $menus = implode($listMenus,",");
        }
        if(count($listFuncs)>0){
            $functions = implode($listFuncs,",");
        }
        $data = ['menuIds'=>$menus,'functionIds'=>$functions];
        if($this->model->updateUserRole($userId, $data)){
            $jsonObj['message'] = "Cập nhật thành công";
            $jsonObj['code'] = 200;
        }else{
            $jsonObj['message'] = "Cập nhật không thành công";
            $jsonObj['code'] = 401;
        }
        echo json_encode($jsonObj);
    }

}

?>
