<?php
class project extends Controller
{
    static private $funAdd = 0, $funEdit = 0, $funDel = 0;
    // static protected $funcs;
    function __construct()
    {
        parent::__construct();
        $model = new model();
        $checkMenuRole = $model->checkMenuRole('project');
        if ($checkMenuRole == false)
            header('location:' . HOME);
        $funcs = $model->getFunctions('project');

        foreach ($funcs as $item) {
            if ($item['function'] == 'add')
                self::$funAdd = 1;
            if ($item['function'] == 'edit')
                self::$funEdit = 1;
            if ($item['function'] == 'del')
                self::$funDel = 1;
        }
    }

    function index()
    {

        require "layouts/header.php";
        $this->view->funAdd = self::$funAdd;
        $this->view->funEdit = self::$funEdit;
        $this->view->funDel = self::$funDel;
        $this->view->render("project/index");
        require "layouts/footer.php";
    }

    function getdata()
    {
        $json = $this->model->get_data();
        echo json_encode($json);
    }
    // get levelproject
    function getLevelProject()
    {
        $json = $this->model->getLevelProject();
        echo json_encode($json);
    }
    function getStatusProject()
    {
        $json = $this->model->getStatusProject();
        echo json_encode($json);
    }

    function addStatusProject(){
        if(self::$funAdd == 1) {
            $name = isset($_REQUEST['nameStatusProject']) ? $_REQUEST['nameStatusProject'] : '';
            $color = isset($_REQUEST['colorStatusProject']) ? $_REQUEST['colorStatusProject'] : '';
            if(empty($name) || empty($color)) {
                $jsonObj['msg'] = 'Thông tin bạn nhập không chính xác';
                $jsonObj['success'] = false;
            }
            else {
                $data = array(
                    'name' => $name,
                    'color'=>$color,
                    'status' => 2
                );
                if($this->model->addStatusProject($data)){
                    $jsonObj['msg'] = 'Cập nhật dữ liệu thành công';
                    $jsonObj['success'] = true;
                } else {
                    $jsonObj['msg'] = 'Lỗi cập nhật database';
                    $jsonObj['success'] = false;
                }
            }
        }
        else {
            $jsonObj['msg'] = 'Không có quyền truy cập';
            $jsonObj['success'] = false;
        }
        
        echo json_encode($jsonObj);
    }

    function addLevelProject(){
        if(self::$funAdd == 1) {
            $name = isset($_REQUEST['nameLevelProject']) ? $_REQUEST['nameLevelProject'] : '';
            $color = isset($_REQUEST['colorLevelProject']) ? $_REQUEST['colorLevelProject'] : '';
            if(empty($name) || empty($color)) {
                $jsonObj['msg'] = 'Thông tin bạn nhập không chính xác';
                $jsonObj['success'] = false;
            }
            else {
                $data = array(
                    'name' => $name,
                    'color'=>$color,
                    'status' => 2
                );
                if($this->model->addLevelProject($data)){
                    $jsonObj['msg'] = 'Cập nhật dữ liệu thành công';
                    $jsonObj['success'] = true;
                } else {
                    $jsonObj['msg'] = 'Lỗi cập nhật database';
                    $jsonObj['success'] = false;
                }
            }
        }
        else {
            $jsonObj['msg'] = 'Không có quyền truy cập';
            $jsonObj['success'] = false;
        }
        
        echo json_encode($jsonObj);
    }

    function getStaff()
    {
        $json = $this->model->getStaff();
        echo json_encode($json);
    }
    function update()
    {

        $id = $_REQUEST['id'];

        if (self::$funAdd == 1  && $id == 0) {

            $name = $_REQUEST['name'];
            $managerId = $_REQUEST['managerId'];
            // if (count($_REQUEST['memberId']) < 2) {
            //     $memberId = implode(',', $_REQUEST['memberId']);
            // } else {
                $memberId = str_replace(']', '', str_replace('[', '', json_encode($_REQUEST['memberId'])));
            // }
            $process = !empty($_REQUEST['process']) ? $_REQUEST['process'] : 0;
            $level = $_REQUEST['level'];
            $description = $_REQUEST['description'];
            $status = $_REQUEST['status'];
            $createDate = date("Y-m-d");
            $deadline = date("Y-m-d", strtotime(str_replace('/', '-', $_REQUEST['date'])));
            $data = array(
                'name' => $name,
                'memberId' => $memberId,
                'managerId' => $managerId,
                'process' => $process,
                'level' => $level,
                'description' => $description,
                'status' => $status,
                'createDate' => $createDate,
                'deadline' => $deadline,
            );

            $result = $this->model->updateProject($id, $data); // vừa update vừa insert,
            if ($result) {
                $jsonObj['msg'] = "Thêm mới thành công";
                $jsonObj['success'] = true;
            } else {
                $jsonObj['msg'] = "Thêm mới không thành công";
                $jsonObj['success'] = false;
            }
        } else if (self::$funEdit == 1 && $id > 0) {
            $name = $_REQUEST['name'];
            $managerId = $_REQUEST['managerId'];
            // if (count($_REQUEST['memberId']) < 2) {
            //     $memberId = implode(',', $_REQUEST['memberId']);
            // } else {
                $memberId = str_replace(']', '', str_replace('[', '', json_encode($_REQUEST['memberId'])));
            // }
            $process = !empty($_REQUEST['process']) ? $_REQUEST['process'] : 0;
            $level = $_REQUEST['level'];
            $description = $_REQUEST['description'];
            $status = $_REQUEST['status'];
            $createDate = date("Y-m-d");
            $deadline = date("Y-m-d", strtotime(str_replace('/', '-', $_REQUEST['date'])));
            $data = array(
                'name' => $name,
                'memberId' => $memberId,
                'managerId' => $managerId,
                'process' => $process,
                'level' => $level,
                'description' => $description,
                'status' => $status,
                'createDate' => $createDate,
                'deadline' => $deadline,
            );

            $result = $this->model->updateProject($id, $data); // vừa update vừa insert,
            if ($result) {
                $jsonObj['msg'] = "Cập nhật thành công";
                $jsonObj['success'] = true;
            } else {
                $jsonObj['msg'] = "Thêm mới không thành công";
                $jsonObj['success'] = false;
            }
        } else {
            $jsonObj['msg'] = 'Bạn không có quyền sử dụng chức năng này';
            $jsonObj['success'] = false;
            echo json_encode($jsonObj);
            return false;
        }
        echo json_encode($jsonObj);
    }
    function getitem()
    {
        $id = $_REQUEST['id'];
        $data = $this->model->getProjectById($id);
        $data['memberId'] =  explode(',', str_replace('"', '', $data['memberId']));
        echo json_encode($data);
    }

    function del()
    {

        if (self::$funDel == 0) {
            $jsonObj['msg'] = 'Bạn không có quyền sử dụng chức năng này';
            $jsonObj['success'] = false;
            echo json_encode($jsonObj);
            return false;
        }
        $id = $_REQUEST['id'];
        if ($this->model->delObj($id)) {
            $jsonObj['msg'] = "Đã xóa item";
            $jsonObj['success'] = true;
        } else {
            $jsonObj['msg'] = "Xóa không thành công";
            $jsonObj['success'] = false;
        }


        $jsonObj = json_encode($jsonObj);
        echo $jsonObj;
    }

    function filter()
    {
        $filter = isset($_REQUEST['filters']) ? $_REQUEST['filters'] : [];
        $status = isset($_REQUEST['status']) ? $_REQUEST['status'] : '';
        if (count($filter) > 0) {
            $filter = implode(',', $filter);
        } else {
            $filter = '';
        }
        $data =  $this->model->filterLevel($filter, $status);
        echo json_encode($data);
    }
}
