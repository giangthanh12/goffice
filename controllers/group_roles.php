<?php
class group_roles extends Controller{
    function __construct(){
        parent::__construct();
    }

    function index(){
        require "layouts/header.php";
        $this->view->render("group_roles/index");
        require "layouts/footer.php";
    }

    function list()
    {
        $data = $this->model->listObj();
        echo json_encode($data);
    }

    function getGroupRole()
    {
        $id = isset($_REQUEST['id']) ? $_REQUEST['id'] : 0;
        $json['data'] = $this->model->getGroupRole($id);
        // 
        $json['data2'] = $this->model->getMenusByGroup($id);
        echo json_encode($json);
    }

    function addGroupRole()
    {
        $name = (isset($_REQUEST['name']) && $_REQUEST['name'] != '') ? $_REQUEST['name'] : '';
        $listMenus = isset($_REQUEST['menus']) ? $_REQUEST['menus'] : '';
        $listFuncs = isset($_REQUEST['functions']) ? $_REQUEST['functions'] : '';
        $data = array(
            'name' => $name,
            'status' => 1
        );
        $idGroup = $this->model->addGroupRole($data);
        if($idGroup > 0) {
            $data = ['menuIds'=>$listMenus,'functionIds'=>$listFuncs];
            if($this->model->updateGroupRole($idGroup, $data)){
                $jsonObj['msg'] = 'Cập nhật dữ liệu thành công';
                $jsonObj['success'] = true;
            }else{
                $jsonObj['msg'] = 'Cập nhật dữ liệu không thành công';
                $jsonObj['success'] = false;
            }
        }
        else {
            $jsonObj['msg'] = 'Cập nhật dữ liệu không thành công';
            $jsonObj['success'] = false;
        }
        echo json_encode($jsonObj);
    }

    function updateGroupRole()
    {
        $id = $_REQUEST['id'];
        $name = isset($_REQUEST['name']) ? $_REQUEST['name'] : '';
        $listMenus = isset($_REQUEST['menus']) ? $_REQUEST['menus'] : '';
        $listFuncs = isset($_REQUEST['functions']) ? $_REQUEST['functions'] : '';
        $data = array(
            'name' => $name,
            'menuIds'=>$listMenus,
            'functionIds'=>$listFuncs
        );
        if($this->model->updateGroupRole($id, $data)){
            $jsonObj['msg'] = 'Cập nhật dữ liệu thành công';
            $jsonObj['success'] = true;
        } else {
            $jsonObj['msg'] = 'Cập nhật dữ liệu không thành công';
            $jsonObj['success'] = false;
        }
        echo json_encode($jsonObj);
    }

    function deleteGroupRole()
    {
        $id = $_REQUEST['id'];
        $data = ['status'=>0];
        if($this->model->updateGroupRole($id, $data)){
            $jsonObj['msg'] = "Xóa dữ liệu thành công";
            $jsonObj['success'] = true;
        } else {
            $jsonObj['msg'] = "Xóa dữ liệu không thành công";
            $jsonObj['success'] = false;
        } 
        echo json_encode($jsonObj);
    }

    function getMenus(){
        $groupId = isset($_REQUEST['groupId']) ? $_REQUEST['groupId'] : 0;
        $json = $this->model->getMenusByGroup($groupId);
        echo json_encode($json);
    }
    function getMenusAdd(){
        // $groupId = isset($_REQUEST['groupId']) ? $_REQUEST['groupId'] : 0;
        $json = $this->model->getMenu();
        echo json_encode($json);
    }
//
//    function setFunctionRole(){
//        $groupId = isset($_REQUEST['groupId']) ? $_REQUEST['groupId'] : 0;
//        $funcId = isset($_REQUEST['funcId']) ? $_REQUEST['funcId'] : 0;
//        $check = isset($_REQUEST['check']) ? $_REQUEST['check'] : 0;
//        $this->model->setFunctionRole($groupId,$funcId,$check);
//        echo $funcId;
//    }

//    function setMenuRole(){
//        $groupId = isset($_REQUEST['groupId']) ? $_REQUEST['groupId'] : 0;
//        $menuId = isset($_REQUEST['menuId']) ? $_REQUEST['menuId'] : 0;
//        $check = isset($_REQUEST['check']) ? $_REQUEST['check'] : 0;
//        if($groupId>0 && $menuId>0)
//        $this->model->setMenuRole($groupId,$menuId,$check);
//    }

    function updateRoles(){
        $listMenus = isset($_REQUEST['menus']) ? $_REQUEST['menus'] : [];
        $listFuncs = isset($_REQUEST['functions']) ? $_REQUEST['functions'] : [];
        $groupId = isset($_REQUEST['groupId']) ? $_REQUEST['groupId'] : 0;
        $menus = '';
        $functions = '';
        if(count($listMenus)>0){
            $menus = implode($listMenus,",");
        }
        if(count($listFuncs)>0){
            $functions = implode($listFuncs,",");
        }
        $data = ['menuIds'=>$menus,'functionIds'=>$functions];
        if($this->model->updateGroupRole($groupId, $data)){
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