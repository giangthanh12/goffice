<?php
class project extends Controller
{
    // private $_Data;
    function __construct()
    {
        parent::__construct();

    }

    function index(){
        require "layouts/header.php";
        $this->view->render("project/index");
        require "layouts/footer.php";
    }

    function getData(){
        $status = $_REQUEST['status'];
        $json = $this->model->get_data($status);
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
        $assignerId = $_SESSION['user']['staffId'];
        $name = $_REQUEST['name'];
        $assigneedId = $_REQUEST['assigneedId'];
        $process = $_REQUEST['process'];
        $level = $_REQUEST['level'];
        $description = $_REQUEST['description'];
        $status = $_REQUEST['status'];
        $createDate = date("Y-m-d");
        $deadline = date("Y-m-d",strtotime(str_replace('/', '-',$_REQUEST['date'])));
        $data = array(
            'name'=>$name,
            'assigneeId'=>$assigneedId,
            'assignerId'=> $assignerId,
            'process'=>$process,
            'level'=>$level,
            'description'=>$description,
            'status'=>$status,
            'createDate'=>$createDate,
            'deadline'=>$deadline,
        );
      
      $result = $this->model->updateProject($id,$data); // vừa update vừa insert,
  
      
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
        echo json_encode($data);
    }

    function del(){
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
    function filterLevel() {
        $filter = isset($_REQUEST['filters']) ? $_REQUEST['filters'] : [];
        if(count($filter) > 0) {
          $filter = implode(',',$filter);
          $data =  $this->model->filterLevel($filter);
        }
        else {
            $data = $this->model->get_data('');
        }
        echo json_encode($data);
    }


}

?>
