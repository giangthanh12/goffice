<?php
class system extends Controller
{
    // private $_Data;
    function __construct()
    {
        parent::__construct();
        // $this->_Data = new Model();
    }

    function index(){
  

        require "layouts/header.php";
        $this->view->system = $this->model->getInfo();
        $this->view->render("system/index");
        require "layouts/footer.php";
    }

   function update() {
        $data = $this->model->getInfo();
        $row = 0;
        foreach ($data as $item) {
            $this->model->updateInfo($item['id'],['value'=>$_REQUEST['tt'.$item['id']]]);
            $row++;
        }
        if($row > 0) {
            $jsonObj['msg'] = "Cập nhật thành công";
            $jsonObj['success'] = true;
        }
        else {
            $jsonObj['msg'] = "Thêm mới không thành công";
            $jsonObj['success'] = false;
        }
        echo json_encode($jsonObj);
   }
}

?>
