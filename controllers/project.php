<?php
class project extends Controller
{
    static protected $funcs;
    function __construct()
    {
        parent::__construct();
        $model = new model();
        $checkMenuRole = $model->checkMenuRole('project');
        if ($checkMenuRole == false)
        header('location:' . HOME);
        self::$funcs = $model->getFunctions('project'); 
    }

    function index(){
        $this->view->funs  = self::$funcs;
        require "layouts/header.php";
        $this->view->render("project/index");
        require "layouts/footer.php";
    }

    function getdata(){
        $json = $this->model->get_data();
        echo json_encode($json);
    }
    // get levelproject
    function getLevelProject(){
        $json = $this->model->getLevelProject();
        echo json_encode($json);
    }
    function getStatusProject() {
        $json = $this->model->getStatusProject();
        echo json_encode($json);
    }
    function getStaff() {
        $json = $this->model->getStaff();
        echo json_encode($json);
    }
    function update() {
        $id = $_REQUEST['id'];
        if(functions::checkFuns(self::$funcs,'add') && $id == 0) {
            $assignerId = $_SESSION['user']['staffId'];
            $name = $_REQUEST['name'];
            $managerId = $_REQUEST['managerId'];
            $assigneeId = str_replace(']','',str_replace('[', '', json_encode($_REQUEST['assigneeId'])));
            $process = $_REQUEST['process'];
            $level = $_REQUEST['level'];
            $description = $_REQUEST['description'];
            $status = $_REQUEST['status'];
            $createDate = date("Y-m-d");
            $deadline = date("Y-m-d",strtotime(str_replace('/', '-',$_REQUEST['date'])));
            $data = array(
                'name'=>$name,
                'assigneeId'=>$assigneeId,
                'assignerId'=> $assignerId,
                'managerId'=> $managerId,
                'process'=>$process,
                'level'=>$level,
                'description'=>$description,
                'status'=>$status,
                'createDate'=>$createDate,
                'deadline'=>$deadline,
            );
            
          $result = $this->model->updateProject($id,$data); // vừa update vừa insert,
        }
        else if(functions::checkFuns(self::$funcs,'loaddata') && $id > 0) {
            $assignerId = $_SESSION['user']['staffId'];
            $name = $_REQUEST['name'];
            $managerId = $_REQUEST['managerId'];
            $assigneeId = implode(',',$_REQUEST['assigneeId']);
            $process = $_REQUEST['process'];
            $level = $_REQUEST['level'];
            $description = $_REQUEST['description'];
            $status = $_REQUEST['status'];
            $createDate = date("Y-m-d");
            $deadline = date("Y-m-d",strtotime(str_replace('/', '-',$_REQUEST['date'])));
            $data = array(
                'name'=>$name,
                'assigneeId'=>$assigneeId,
                'assignerId'=> $assignerId,
                'managerId'=> $managerId,
                'process'=>$process,
                'level'=>$level,
                'description'=>$description,
                'status'=>$status,
                'createDate'=>$createDate,
                'deadline'=>$deadline,
            );
            
          $result = $this->model->updateProject($id,$data); // vừa update vừa insert,
        }
        else {
           
            $result = false;
        }
      if ($result) {
        $jsonObj['msg'] = "Cập nhật thành công";
        $jsonObj['success'] = true;
        } else {
            $jsonObj['msg'] = "Cập nhật không thành công";
            $jsonObj['success'] = false;
        }
        $jsonObj = json_encode($jsonObj);
        echo $jsonObj;
    }
    function getitem() {
        $id = $_REQUEST['id'];
        $data = $this->model->getProjectById($id);
        $data['assigneeId'] =  explode(',',str_replace('"','',$data['assigneeId']) );
        echo json_encode($data);
    }

    function del(){
        if(functions::checkFuns(self::$funcs,'del')) {
            $id = $_REQUEST['id'];
            if ($this->model->delObj($id)) {
                $jsonObj['msg'] = "Đã xóa item";
                $jsonObj['success'] = true;
            } else {
                $jsonObj['msg'] = "Xóa không thành công";
                $jsonObj['success'] = false;
            }
        }
        else {
            $jsonObj['msg'] = "Xóa không thành công";
            $jsonObj['success'] = false;
        }
        
        $jsonObj = json_encode($jsonObj);
        echo $jsonObj;
    }
    
    function filter() {
        $filter = isset($_REQUEST['filters']) ? $_REQUEST['filters'] : [];
        $status = isset($_REQUEST['status']) ? $_REQUEST['status'] : '';
        if(count($filter) > 0) {
          $filter = implode(',',$filter);
        }
        else {
            $filter = '';
        }
        $data =  $this->model->filterLevel($filter,$status);
        echo json_encode($data);
    }
}

?>
